<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class blogValidation extends FormRequest
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
            'title' => 'required|min:5|max:100',
            'desc'  => 'required|min:5|max:60000',
            'featured_image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2548'
        ];
    }
}
