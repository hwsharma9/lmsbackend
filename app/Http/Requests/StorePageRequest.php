<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePageRequest extends FormRequest
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
            'slug' => 'string|unique:pages',
            'title_hi' => 'required|min:2|max:255|unique:pages',
            'description_hi' => 'required|min:2',
            'title_en' => 'required|min:2|max:255|unique:pages',
            'description_en' => 'required|min:2',
            'status' => 'required|boolean',
            'meta_title' => 'nullable|max:200',
            'meta_keyword' => 'nullable|max:200',
            'meta_description' => 'nullable|max:200',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title_en),
        ]);
    }
}
