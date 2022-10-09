<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Requests\Comment\CommentCreateRequest;

class CommentController extends Controller {

    public function create(CommentCreateRequest $request) {
        $data = $request->validate([
            'comment_value' => 'required',
            'your_name' => 'required',
            'article_id' => 'required',
        ]);

        $comment = new CommentModel();
        $comment->comment_value = $request->input('comment_value');
        $comment->commentator_name = $request->input('your_name');
        $comment->article_model_id = $request->input('article_id');
        $comment->save();
        return redirect("/article/" . $request->input('article_id'));
    }

}
