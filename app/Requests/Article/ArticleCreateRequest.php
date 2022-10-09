<?php

namespace App\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest {

    public function authorize() {
        return TRUE;
    }

    public function rules() {
        return [
            'title' => 'string',
            'author' => 'string',
            'category' => 'string',
            'content' => 'string',
        ];
    }

}
