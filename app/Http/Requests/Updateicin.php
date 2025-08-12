<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updateicin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            // 'name' => 'required|string|max:255',
            // 'description' => 'nullable|string',
            // 'price' => 'required|numeric|min:0',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048000', // Example for image validation
            // 'image' => 'array|min:1', // Ensure at least one image is provided
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ürün adı gereklidir.',
            'price.required' => 'Fiyat gereklidir.',
            'images.required' => 'En az bir resim yüklenmelidir.',
            'images.*.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'images.*.mimes' => 'Resim formatı jpeg, png, jpg, gif veya svg olmalıdır.',
            'images.*.max' => 'Resim boyutu 2MB\'dan büyük olmamalıdır.',
        ];
    }
}
