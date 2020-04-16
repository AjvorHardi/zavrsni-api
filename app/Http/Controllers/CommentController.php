<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;
use App\Gradebook;

class CommentController extends Controller
{

    public function index($gradebook_id)
    {

        return Comment::where('gradebook_id', $gradebook_id)->get();

    }


    public function store(Request $request, $gradebook_id)
    {
        $request->validate([
            'body' => 'required | max:1000'
        ]);
        
        $comment = new Comment();
        $comment->body = $request->input('body');

        // $user_id = Auth::user()->id;

        $comment->user_id = 1;
        $comment->gradebook_id = $gradebook_id;

        $gradebook = Gradebook::find($gradebook_id);
        $gradebook->comment()->save($comment);

        $user = User::find($comment->user_id);
        $user->comment()->save($comment);

        return $comment;
    }


    public function destroy($gradebook_id, $comment_id)
    {
        $comment = Comment::find($comment_id);

        $comment->delete();

        return new JSONResponse(true);
    }

}