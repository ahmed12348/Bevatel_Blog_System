<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Allow access to only users with the roles 'admin' or 'author'
        // return $this->user()->hasAnyRole(['admin', 'author']);
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => [
                'required',
                'string',
                Rule::unique('blogs')->ignore($this->blog), // Exclude current blog from uniqueness check
            ],
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
