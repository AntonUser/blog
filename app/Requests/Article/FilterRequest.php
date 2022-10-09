<?php

namespace App\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest {

    public function authorize() {
        return TRUE;
    }

    public function rules() {
        return [
            'categories' => '',
            'title' => 'string',
            'start_date' => 'string',
            'end_date' => 'string',
        ];
    }

}
