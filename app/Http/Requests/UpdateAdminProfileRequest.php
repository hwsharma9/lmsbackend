<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminProfileRequest extends FormRequest
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
            'first_name' => 'required',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($this->admin->id)],
            'last_name' => 'required',
            'mobile' => 'required|digits:10',
            'captcha' => 'required|captcha'
        ];
    }
}
