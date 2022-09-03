<?php

namespace App\Http\Requests\V1;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
        $categories = Category::query()->get()->pluck('id');

        return [
            'title' => ['required', 'string', 'max:100'],
            'price' => ['required', 'numeric'],
            'description' => ['required','string','max:255'],
            'categoryId' => ['required', Rule::in($categories)],
            'image' => ['required', 'mimes:jpeg,jpg,png,bmp'],
            'comment' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'category_id' => $this->categoryId
        ]);
    }
}
