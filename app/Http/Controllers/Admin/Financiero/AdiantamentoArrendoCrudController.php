<?php

namespace App\Http\Controllers\Admin\Financiero;

use App\Http\Requests\AdiantamentoArrendoRequest;
use App\Models\Financeiro\AdiantamentoArrendo;
use App\Models\Fornecedor;
use App\Models\LancamentoContaApagar;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AdiantamentoArrendoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AdiantamentoArrendoCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Financeiro\AdiantamentoArrendo::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/adiantamentoarrendo');
        CRUD::setEntityNameStrings('Adiantamento Arrendo', 'Adiantamentos Arrendos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('safra_id')
            ->type('select')
            ->entity('safra')
            ->attribute('nome');
        CRUD::column('fornecedor_id')
            ->type('select')
            ->entity('fornecedor')
            ->attribute('nome_fantasia');

        CRUD::column('data_pagamento')->type('datetime')->format('DD/MM/YYYY')->label('Valor Pagamento');
        CRUD::column('valor_pagamento')->type('number')
        ->label('Valor Pagamento')
            ->prefix('R$ ')
            ->decimals(2)
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('tipo_adiantamento')->type('enum')->label('Adiantamento');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(AdiantamentoArrendoRequest::class);

        CRUD::field('safra_id')
            ->label('Safra.:')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Safra')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

            CRUD::field('fornecedor_id')
            ->label('Fornecedor.:')
            ->type('select2')
            ->attribute('razao_social')
            ->model('App\Models\Fornecedor')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade','=','ARRENDO')->orderBy('razao_social', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('data_pagamento')->label('Data.:')->size(2);
        CRUD::field('valor_pagamento')->label('Valor.:')->size(2)->attributes(['class' => 'form-control']);
        CRUD::field('tipo_adiantamento')->label('Tipo Adiantamento.:')->type('enum')->size(2);
        CRUD::field('nome_fornecedor')->label('Nome Recibo.:')->size(4);
        CRUD::field('cpf_cnpj')->label('Cpf / Cnpj.:')->size(3);
        CRUD::field('nome_banco')->label('Banco.:')->size(3);        
        CRUD::field('agencia')->label('Agência.:')->size(2);
        CRUD::field('num_conta')->label('Nº Conta.:')->size(2);
        CRUD::field('num_cheque')->label('Nº Cheque.:')->size(2);

        

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();
        $fornecedor = Fornecedor::find($data['fornecedor_id']);

        // Retira transforma a virgula em ponto
        if (isset($data['valor_pagamento'])) {
            $data['valor_pagamento'] = str_replace('.', "", $data['valor_pagamento']);
            $data['valor_pagamento'] = str_replace(',', ".", $data['valor_pagamento']);
            $data['nome_fornecedor'] = $data['nome_fornecedor'];
            $data['cpf_cnpj'] = $data['cpf_cnpj'];
            $data['nome_banco'] = $data['nome_banco'];
            $data['agencia'] = $data['agencia'];
            $data['num_conta'] = $data['num_conta'];
            $data['num_cheque'] = $data['num_cheque'];
        }

        $model = AdiantamentoArrendo::create($data);

        switch ($data['tipo_adiantamento'] == 'DEPOSITO') {
            case 'DEPOSITO':
                $tipoPagamento = 'TRANSFERÊNCIA';
                break;
            case 'CHEQUE':
                $tipoPagamento = 'CHEQUE';
                break;
            default:
                $tipoPagamento = 'DINHEIRO';
                break;
        }

        $conta = [
            'numero_documento' => $model->id,
            'fornecedor_id' => $data['fornecedor_id'],
            'centro_custo_id' => 1,
            'data_documento' => $data['data_pagamento'],
            'data_vencimento' => $data['data_pagamento'],
            'descricao' => 'Pagamento de Arrendo' . $model->fornecedor->razao_social,
            'valor' => $data['valor_pagamento'],
            'tipo' => $tipoPagamento,
            'status' => 'APAGO'
        ];


        $contaApagar = LancamentoContaApagar::create($conta);

        // show a success message
        \Alert::success(trans('Adiantamento Cadastro com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }

    public function show($id)
    {
        $this->crud->hasAccessOrFail('show');
        /// get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;
        $setFromDb = $this->crud->get('show.setFromDb');

        // set columns from db
        if ($setFromDb) {
            $this->crud->setFromDb();
        }
        //dd($this->data['entry']);

        return view('financeiro.adiantamento.arrendo', $this->data);
    }
}
