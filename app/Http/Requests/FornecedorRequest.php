<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3);
        return [
            'razao_social' => "required|unique:fornecedors,razao_social,{$id},id",
            'nome_fantasia' => "required|unique:fornecedors,nome_fantasia,{$id},id",
            'cpf_cnpj' => "required|unique:fornecedors,cpf_cnpj,{$id},id",
            'rg_inscricao' => "required|unique:fornecedors,rg_inscricao,{$id},id",
            'nome_banco' => 'required',
            'banco' => 'required',
            'agencia' => 'required',
            'num_conta' => 'required',
            'tipo_conta' => 'required',
            
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
