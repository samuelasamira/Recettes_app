<?php
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
}