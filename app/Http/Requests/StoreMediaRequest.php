<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
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
            'created_by' => 'required',
            'updated_by' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,jpeg,jpg,JPG,JPEG,png,pdf,xls,xlsx,mp4|max:10240',
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
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }
}
