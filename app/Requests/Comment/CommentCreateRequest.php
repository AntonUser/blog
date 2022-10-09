<?php

namespace App\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest {

    public function authorize() {
        return TRUE;
    }

    public function rules() {
        return [
            'comment_value' => 'string',
            'your_name' => 'string',
            'article_id' => 'string',
        ];
    }

}
