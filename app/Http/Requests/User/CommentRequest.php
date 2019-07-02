<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment' => 'required|max:65535'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => '入力必須の項目です。',
            'comment.max' => '65535字以内で入力してください。',
        ];
    }
}
