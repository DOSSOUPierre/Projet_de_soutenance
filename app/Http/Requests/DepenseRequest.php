<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'montant' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categorie_depenses,id',
            'description' => 'nullable|string|max:255',
            'objet' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'archiver' => 'nullable|boolean',
        ];
    }
}
