<?php

namespace Crud\App\Api\Article\Requests;

use Crud\App\Api\Support\Requests\APIRequest;

class CreateArticleRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author' => 'required|string',
            'body'   => 'required',
            'photo'  => 'required|string'
        ];
    }
}
