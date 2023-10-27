<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDatabaseRouteRequest extends FormRequest
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
            'resides_at' => 'required',
            'controller_name' => 'required',
            'route' => ['required', Rule::unique('database_routes')->ignore($this->databaseroute->id)],
            'named_route' => 'required',
            'method' => 'required',
            'function_name' => 'required'
        ];
    }
}
