<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function showComments(ShowCommentRequest $request){
        $comments = Comment::where('mission_id',$request->mission_id)
                             ->leftJoin('users','users.user_id','=','comments.user_id')
                             ->orderBy('comments.created_at', 'desc')
                             ->get(['comments.*','users.first_name','users.last_name','avatar'])->toArray();
        return response()->json($comments);
    }

    public function addComment(StoreCommentRequest $request){
       Comment::create($request->post());
       return response()->json('success');
    }
}
