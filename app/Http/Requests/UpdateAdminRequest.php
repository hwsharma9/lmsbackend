<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
            'role_id' => 'required',
            'first_name' => 'required',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($this->admin->id)],
            'designation' => 'required|max:350',
            'last_name' => 'required',
            'mobile' => 'required|digits:10',
            'status' => 'required|boolean',
            'captcha' => 'required|captcha'
        ];
    }
}
