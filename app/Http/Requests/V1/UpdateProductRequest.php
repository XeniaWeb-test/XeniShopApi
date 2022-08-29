<?php

namespace App\Http\Requests\V1;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'title' => ['required', 'string', 'max:100'],
                'price' => ['required', 'numeric'],
                'description' => ['required', 'string', 'max:255'],
                'categoryId' => ['required', Rule::in($categories)],
                'image' => ['nullable', 'string'],
                'comment' => ['nullable', 'string'],
            ];
        } else {
            return [
                'title' => ['sometimes', 'required', 'string', 'max:100'],
                'price' => ['sometimes', 'required', 'numeric'],
                'description' => ['sometimes', 'required', 'string', 'max:255'],
                'categoryId' => ['sometimes', 'required', Rule::in($categories)],
                'image' => ['sometimes', 'nullable', 'string'],
                'comment' => ['sometimes', 'nullable', 'string'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->categoryId) {
            $this->merge([
                'category_id' => $this->categoryId
            ]);
        }
    }
}
