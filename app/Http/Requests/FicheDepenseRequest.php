<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FicheDepenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "beneficiaire" => 'required|numeric',
            "montant" => 'required|numeric',
            "mode_paiment" => 'required',
            "controlleur" => 'required|numeric',
            "ordonateur" => 'required|numeric',
            "description" => 'required',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         "beneficiaire.required" => 'Le beneficiaire est a choisir',
    //         "beneficiaire.numeric" => 'Le beneficiaire est a choisir',
    //         "montant.required" => 'Le montant est à préciser',
    //         "montant.numeric" => 'Le montant est de nombre',
    //         "mode_paiment.required" => 'choisissez un mode de paiment',
    //         "controlleur.numeric" => 'Choisissez un controlleur',
    //         "controlleur.required" => 'Choisissez un controlleur',
    //         "ordonateur.required" => 'Choisissez un ordonnateur',
    //         "ordonateur.numeric" => 'Choisissez un ordonnateur',
    //         "description.required" => 'vous devez faire une description de votre fiche',
    //     ];
    // }
}
