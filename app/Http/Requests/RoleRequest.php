<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the role is authorized to make this request.
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
        $returns = [
            'name'   => $this->role ?
                                ['required', 'max:150', 'unique:role,name,'.$this->role.',role_id']
                                :
                                ['required', 'max:150', 'unique:role,name'],
            'description' => ['nullable', 'max:255'],
        ];

        return $returns;
    }

}
