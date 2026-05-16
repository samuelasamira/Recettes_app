<?php
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
}