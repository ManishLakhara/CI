<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * @param ShowCommentRequest $request
     *
     * @return JsonResponse
     */
    public function showComments(ShowCommentRequest $request): JsonResponse{
        $comments = Comment::where('approval_status','PUBLISHED')->where('mission_id',$request->mission_id)
                             ->join('users','users.user_id','=','comments.user_id')
                             ->orderBy('comments.created_at', 'desc')
                             ->get(['comments.*','users.first_name','users.last_name','avatar'])->toArray();
        return response()->json($comments);
    }

    /**
     * @param StoreCommentRequest $request
     *
     * @return JsonResponse
     */
    public function addComment(StoreCommentRequest $request): JsonResponse{
       Comment::create($request->post());
       return response()->json('success');
    }
}
