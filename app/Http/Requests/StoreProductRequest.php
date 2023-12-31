<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|unique:products,name',
            'price' => 'integer|min:1|max:99999',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Ten buoc phai nhap',
            'name.min' => 'Ten phai tren 3 ky tu',
            'name.max' => 'Ten phai duoi 255 ky tu',
            'status.required' => 'Trang thai buoc phai chon!',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg', 'max:2048'
        ];
    }
}
