<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
        return [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',

        ];
    }

    public function message(){
        return [
            'name.required'=>'le nom est requis',
            'email.required'=>'le mot de passe est requis',
            'email.email'=>'le mail n\'est pas valide',
            'email.unique'=>'Cette adresse est lié à un compte',
        ];
    }
}
