<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class LancamentoSafraRequest extends FormRequest
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
        return [
            'data_colhido' => 'required',
            'data_colhido' => 'required',
            'safra_id' => 'required',
            'motorista_id' => 'required',
            'proprietario_id' => 'required',
            'num_romaneio' => 'required',
            'num_controle' => 'required',
            'talhao_id' => 'required',
            'armazem_id' => 'required',
            'peso_bruto' => 'required',
            'peso_desconto' => 'required',
            'peso_liquido' => 'required',
            'colhedor_id' => 'required',
            'fazenda_id' => 'required',
            'desconto' => 'required',
            'peso_liquido' => 'required',
            'saco_liquido' => 'required',
            'saco_bruto' => 'required',
            'valor_frete' => 'required',
            'locacao_talhao_id' => 'required',
            
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
