<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'images.*'=> ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'name' => ['required','string','max:255'],
            'description' => ['required','string'],
            'short_description' => ['required','string','max:255'],
            'price' => ['required','numeric'],
            'quantity' => ['required','numeric'],
            'sku' => ['required','string','max:255'],
            'colors' => ['nullable'],

        ];
    }
}
