<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SaveEmployerRequest extends FormRequest
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
            'departement_id'=>'required|integer',
            'nom'=>'required|string',
            'prenom'=>'required|string',
            'email'=>['required','email',Rule::unique('employers')->ignore($this->employer)],
            'contact'=>'required|string',
            'montant_journalier'=>'integer'
        ];
    }
    public function messages():array{
        return [
            'departement_id.required'=>'le département obligatoire',
            'nom.required'=> 'le nom est obligatoire',
            'prenom.required'=>'le prénom est obligatoire',
            'email.required'=>'l email est obligatoire',
            'email.unique'=>'cette adresse mail est déjà prise',
            'contact.required'=>'le contact est obligatoire',
            'montant_journalier.integer'=> 'le montant journalier doit etre numérique'
        ];
    }
}
