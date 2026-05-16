<?php

$files = [

// ============================================================
// MODELS
// ============================================================

'app/Models/Recipe.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        "user_id","title","description","instructions",
        "prep_time","cook_time","servings",
        "cuisine_type","difficulty","image_path"
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function ingredients() { return $this->belongsToMany(Ingredient::class,"recipe_ingredient")->withPivot("quantity")->withTimestamps(); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function favorites() { return $this->hasMany(Favorite::class); }
    public function ratings() { return $this->hasMany(Rating::class); }
    public function isFavoritedBy(User $user): bool { return $this->favorites()->where("user_id",$user->id)->exists(); }
    public function averageRating(): float { return $this->ratings()->avg("rating") ?? 0; }
}',

'app/Models/Ingredient.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ["name"];
    public function recipes() { return $this->belongsToMany(Recipe::class,"recipe_ingredient")->withPivot("quantity")->withTimestamps(); }
}',

'app/Models/Comment.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["recipe_id","user_id","content"];
    public function recipe() { return $this->belongsTo(Recipe::class); }
    public function user() { return $this->belongsTo(User::class); }
}',

'app/Models/Favorite.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ["user_id","recipe_id"];
    public function user() { return $this->belongsTo(User::class); }
    public function recipe() { return $this->belongsTo(Recipe::class); }
}',

'app/Models/Rating.php' => '<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ["recipe_id","user_id","rating","review"];
    public function recipe() { return $this->belongsTo(Recipe::class); }
    public function user() { return $this->belongsTo(User::class); }
}',

// ============================================================
// CONTROLLERS
// ============================================================

'app/Http/Controllers/RecipeController.php' => '<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with("user","ratings");
        if ($request->search) $query->where("title","like","%".$request->search."%");
        if ($request->difficulty) $query->where("difficulty",$request->difficulty);
        if ($request->cuisine) $query->where("cuisine_type",$request->cuisine);
        $recipes = $query->latest()->paginate(12);
        return view("recipes.index",compact("recipes"));
    }

    public function create()
    {
        $ingredients = Ingredient::orderBy("name")->get();
        return view("recipes.create",compact("ingredients"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title"                    => "required|string|max:255",
            "description"              => "required|string",
            "instructions"             => "required|string",
            "prep_time"                => "required|integer|min:1",
            "cook_time"                => "required|integer|min:1",
            "servings"                 => "required|integer|min:1",
            "cuisine_type"             => "required|string",
            "difficulty"               => "required|in:facile,moyen,difficile",
            "image"                    => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "ingredients"              => "required|array",
            "ingredients.*.id"         => "required|exists:ingredients,id",
            "ingredients.*.quantity"   => "required|string",
        ]);

        if ($request->hasFile("image"))
            $validated["image_path"] = $request->file("image")->store("recipes","public");

        $validated["user_id"] = Auth::id();
        $recipe = Recipe::create($validated);

        foreach ($request->ingredients as $ing)
            $recipe->ingredients()->attach($ing["id"],["quantity"=>$ing["quantity"]]);

        return redirect()->route("recipes.show",$recipe)->with("success","Recette créée avec succès !");
    }

    public function show(Recipe $recipe)
    {
        $recipe->load("user","ingredients","comments.user","ratings.user","favorites");
        $averageRating    = $recipe->averageRating();
        $userHasFavorited = Auth::check() && $recipe->isFavoritedBy(Auth::user());
        $userRating       = Auth::check() ? $recipe->ratings()->where("user_id",Auth::id())->first() : null;
        return view("recipes.show",compact("recipe","averageRating","userHasFavorited","userRating"));
    }

    public function edit(Recipe $recipe)
    {
        $this->authorize("update",$recipe);
        $ingredients = Ingredient::orderBy("name")->get();
        $recipe->load("ingredients");
        return view("recipes.edit",compact("recipe","ingredients"));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $this->authorize("update",$recipe);
        $validated = $request->validate([
            "title"                    => "required|string|max:255",
            "description"              => "required|string",
            "instructions"             => "required|string",
            "prep_time"                => "required|integer|min:1",
            "cook_time"                => "required|integer|min:1",
            "servings"                 => "required|integer|min:1",
            "cuisine_type"             => "required|string",
            "difficulty"               => "required|in:facile,moyen,difficile",
            "image"                    => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "ingredients"              => "required|array",
            "ingredients.*.id"         => "required|exists:ingredients,id",
            "ingredients.*.quantity"   => "required|string",
        ]);

        if ($request->hasFile("image")) {
            if ($recipe->image_path) Storage::disk("public")->delete($recipe->image_path);
            $validated["image_path"] = $request->file("image")->store("recipes","public");
        }

        $recipe->update($validated);
        $recipe->ingredients()->detach();
        foreach ($request->ingredients as $ing)
            $recipe->ingredients()->attach($ing["id"],["quantity"=>$ing["quantity"]]);

        return redirect()->route("recipes.show",$recipe)->with("success","Recette mise à jour !");
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorize("delete",$recipe);
        if ($recipe->image_path) Storage::disk("public")->delete($recipe->image_path);
        $recipe->delete();
        return redirect()->route("recipes.index")->with("success","Recette supprimée !");
    }
}',

'app/Http/Controllers/CommentController.php' => '<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate(["content"=>"required|string|min:3|max:1000"]);
        Comment::create(["recipe_id"=>$recipe->id,"user_id"=>Auth::id(),"content"=>$request->content]);
        return back()->with("success","Commentaire ajouté !");
    }

    public function destroy(Comment $comment)
    {
        $this->authorize("delete",$comment);
        $comment->delete();
        return back()->with("success","Commentaire supprimé !");
    }
}',

'app/Http/Controllers/FavoriteController.php' => '<?php
namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        Favorite::firstOrCreate(["user_id"=>Auth::id(),"recipe_id"=>$recipe->id]);
        return back()->with("success","Recette ajoutée aux favoris !");
    }

    public function destroy(Request $request, Recipe $recipe)
    {
        Favorite::where("user_id",Auth::id())->where("recipe_id",$recipe->id)->delete();
        return back()->with("success","Recette retirée des favoris !");
    }
}',

'app/Http/Controllers/RatingController.php' => '<?php
namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate(["rating"=>"required|integer|min:1|max:5","review"=>"nullable|string|max:1000"]);
        Rating::updateOrCreate(
            ["user_id"=>Auth::id(),"recipe_id"=>$recipe->id],
            ["rating"=>$request->rating,"review"=>$request->review]
        );
        return back()->with("success","Note enregistrée !");
    }

    public function destroy(Rating $rating)
    {
        $this->authorize("delete",$rating);
        $rating->delete();
        return back()->with("success","Note supprimée !");
    }
}',

// ============================================================
// POLICIES
// ============================================================

'app/Policies/RecipePolicy.php' => '<?php
namespace App\Policies;
use App\Models\Recipe;
use App\Models\User;

class RecipePolicy
{
    public function update(User $user, Recipe $recipe): bool { return $user->id === $recipe->user_id; }
    public function delete(User $user, Recipe $recipe): bool { return $user->id === $recipe->user_id; }
}',

'app/Policies/CommentPolicy.php' => '<?php
namespace App\Policies;
use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function delete(User $user, Comment $comment): bool { return $user->id === $comment->user_id; }
}',

'app/Policies/RatingPolicy.php' => '<?php
namespace App\Policies;
use App\Models\Rating;
use App\Models\User;

class RatingPolicy
{
    public function delete(User $user, Rating $rating): bool { return $user->id === $rating->user_id; }
}',

// ============================================================
// SEEDERS
// ============================================================

'database/seeders/IngredientSeeder.php' => '<?php
namespace Database\Seeders;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            "Farine","Sucre","Sel","Beurre","Oeufs","Lait","Levure chimique",
            "Huile de palme","Huile d\'arachide","Poivre",
            "Piment frais","Piment sec","Arachides","Feuilles de manioc",
            "Graine de courge","Noix de coco","Lait de coco","Epinards",
            "Poisson séché","Crevettes séchées","Tomates","Oignons","Ail",
            "Poivrons","Aubergines","Carottes","Pommes de terre","Patates douces",
            "Igname","Taro","Plantain","Maïs","Haricots","Pois de terre",
            "Concombre","Courgettes","Chou","Oignons verts","Persil","Menthe",
            "Poulet","Boeuf","Poisson frais","Escargots","Crevettes",
            "Riz","Pâtes","Semoule","Farine de maïs","Farine de manioc",
            "Mil","Sorgho","Fromage","Crème fraîche","Yaourt","Miel",
            "Sauce soja","Citron","Citron vert","Papaye","Mangue",
            "Banane plantain","Banane douce","Gingembre","Clou de girofle",
            "Cannelle","Noix de muscade","Curcuma","Coriandre","Thym",
            "Laurier","Maggi cube","Bouillon de poisson",
        ];
        foreach ($ingredients as $name)
            Ingredient::firstOrCreate(["name"=>$name]);
    }
}',

'database/seeders/DatabaseSeeder.php' => '<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        User::factory()->create(["name"=>"Test User","email"=>"test@example.com"]);
        $this->call([IngredientSeeder::class]);
    }
}',

];

// ============================================================
// MIGRATIONS
// ============================================================

// On détecte les fichiers de migration existants
$migrationPath = 'database/migrations/';
$migrationFiles = glob($migrationPath . '*.php');

$migrations = [
    'create_recipes_table' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("recipes", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("title");
            $table->text("description");
            $table->text("instructions");
            $table->integer("prep_time");
            $table->integer("cook_time");
            $table->integer("servings");
            $table->string("cuisine_type");
            $table->string("difficulty")->default("moyen");
            $table->string("image_path")->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("recipes"); }
};',

    'create_ingredients_table' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("ingredients", function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("ingredients"); }
};',

    'create_recipe_ingredient_table' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("recipe_ingredient", function (Blueprint $table) {
            $table->id();
            $table->foreignId("recipe_id")->constrained("recipes")->onDelete("cascade");
            $table->foreignId("ingredient_id")->constrained("ingredients")->onDelete("cascade");
            $table->string("quantity");
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("recipe_ingredient"); }
};',

    'create_comments_table' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("comments", function (Blueprint $table) {
            $table->id();
            $table->foreignId("recipe_id")->constrained("recipes")->onDelete("cascade");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->text("content");
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("comments"); }
};',

    'create_favorites_table' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("favorites", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("recipe_id")->constrained("recipes")->onDelete("cascade");
            $table->timestamps();
            $table->unique(["user_id","recipe_id"]);
        });
    }
    public function down(): void { Schema::dropIfExists("favorites"); }
};',

    'create_ratings_table' => '<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("ratings", function (Blueprint $table) {
            $table->id();
            $table->foreignId("recipe_id")->constrained("recipes")->onDelete("cascade");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->integer("rating");
            $table->text("review")->nullable();
            $table->timestamps();
            $table->unique(["user_id","recipe_id"]);
        });
    }
    public function down(): void { Schema::dropIfExists("ratings"); }
};',
];

// Écriture des fichiers normaux
foreach ($files as $path => $content) {
    file_put_contents($path, $content);
    echo "✅ $path\n";
}

// Écriture des migrations dans les bons fichiers
foreach ($migrationFiles as $file) {
    foreach ($migrations as $name => $content) {
        if (str_contains($file, $name)) {
            file_put_contents($file, $content);
            echo "✅ $file\n";
        }
    }
}

echo "\n🎉 Tous les fichiers ont été générés !\n";
echo "👉 Lance maintenant : php artisan migrate:fresh --seed\n";