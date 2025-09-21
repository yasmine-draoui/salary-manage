<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class submitDefineAccessRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'password'=>'required|same:confirm_password',
            'confirm_password'=>'required|same:password'
        ];
    }

    public function message():array
    {
        return [
            'password.same'=>'les mots de passe ne sont pas identiques',
            'confirm_password.same'=>'les mots de passe ne sont pas identiques'
        ];
    }
}
