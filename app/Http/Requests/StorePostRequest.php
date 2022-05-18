<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //tags is like dat cuz of postman testing
        //I would prefer it to be
        //'tags' => 'required|array|exists:tags,id'

        return [
            'author_id' => 'required|exists:users,id',
            'title' => 'required',
            'content' => 'required',
            'tags.*' => 'required|exists:tags,id',
            'image' => 'required|exists:images,id'
        ];
    }
}
