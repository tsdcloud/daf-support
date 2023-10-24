<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashRegisterSupplyRequest extends FormRequest
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
             "approvisionneur" => 'required',
             "montant" => 'required|numeric|min:0',
            "provenance" => 'required',
            "mode_approv" => 'required',
            "libelle" => 'required',
            "city_entity_id" => 'required',
            "site_id"=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'approvisionneur.required' => 'L\'approvisionneur est à choisir',
            "provenance.required" => 'La provenance est à déterminer',
            "mode_approv.required" => 'Selectionner le mode d\'approvisionnement',
            "montant.required" => 'Saisir le montant',
            "libelle.required" => 'Saisir le libellé',
            "city_entity_id.required" => 'Vous devez selectionner une ville',
            "site_id.required"=> 'Vous devez selectionner un site',
        ];
    }
}
