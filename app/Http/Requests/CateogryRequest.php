<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CateogryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->id,
            'status' => 'required|in:active,archived',
            'image'  => 'image|mimes:jpeg,png,jpg,gif|max:1048576',
            'parent_id' => 'nullable|int|exists:categories,id',
        ];
       
    }
}
