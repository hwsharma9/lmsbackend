<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'menu_name' => 'required|min:2|max:40',
            'icon_class' => 'required|max:50', //|regex:[/^[a-zA-Z0-9\-\s]*$/]
            'permission_id' => 'nullable'
        ];
    }

    public function message()
    {
        return [
            //     'icon_class.regex' => 'Please enter character, number, space and (-) symbol only in Icon Class Name.',
        ];
    }
}
