<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'required|array',
            'unit' => 'nullable|string|max:50',
            'profit_margin' => 'nullable|numeric|min:0',
            'img_url' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable',
            'featured' => 'sometimes|boolean',
            'active' => 'sometimes|boolean',
        ];
    }
}
