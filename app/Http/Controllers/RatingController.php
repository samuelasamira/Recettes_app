<?php
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
}