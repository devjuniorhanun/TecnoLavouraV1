<?php

namespace App\Http\Controllers\Admin\Financiero;

use App\Http\Requests\AdiantamentoColhedoRequest;
use App\Models\AdiantamentoColhedo;
use App\Models\LancamentoContaApagar;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class AdiantamentoColhedoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AdiantamentoColhedoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\AdiantamentoColhedo::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/adiantamentocolhedo');
        CRUD::setEntityNameStrings('Colhedor', 'Adiantamento Colhedores');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {$this->crud->addClause('where', 'safra_id', '=', 7);
        CRUD::column('safra_id')
            ->type('select')
            ->entity('safra')
            ->attribute('nome');
        CRUD::column('fornecedor_id')
            ->type('select')
            ->entity('fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('data_pagamento')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('valor_pagamento')->type('number')
            ->prefix('R$ ')
            ->decimals(2)
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('tipo_adiantamento')->type('enum');

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
        CRUD::setValidation(AdiantamentoColhedoRequest::class);

        CRUD::field('produtor_id')
            ->label('Produtor.:')
            ->type('select2')
            ->entity('produtor')
            ->options(function ($query) {
                return $query->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->attribute('nome_fantasia')
            ->size(3);
        CRUD::field('safra_id')
            ->label('Safra.:')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Safra')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);
        /*CRUD::field('fornecedor_id')
            ->label('Colhedor.:')
            ->type('select2_from_ajax')
            ->attribute('razao_social')
            ->data_source('colhedores')
            ->placeholder('Colhedor')
            ->include_all_form_fields(true)
            ->minimum_input_length(0)
            ->method('post')
            ->size(3);*/
            CRUD::field('fornecedor_id')
            ->label('Safra.:')
            ->type('select2')
            ->attribute('razao_social')
            ->model('App\Models\Fornecedor')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade','=','COLHEDOR')->orderBy('razao_social', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('data_pagamento')->label('Data Pagamento.:')->size(3);
        CRUD::field('valor_pagamento')->label('Valor Pagamento.:')->size(2)->attributes(['class' => 'form-control']);
        CRUD::field('tipo_adiantamento')->label('Tipo Adiantamento.:')->type('enum')->size(2);
        CRUD::field('nome_banco')->label('Banco.:')->size(3);
        CRUD::field('agencia')->label('Agência.:')->size(2);
        CRUD::field('num_conta')->label('Nº Conta.:')->size(2);
        CRUD::field('num_cheque')->label('Nº Cheque.:')->size(2);
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

        // Retira transforma a virgula em ponto
        if (isset($data['valor_pagamento'])) {
            $data['valor_pagamento'] = str_replace('.', "", $data['valor_pagamento']);
            $data['valor_pagamento'] = str_replace(',', ".", $data['valor_pagamento']);
        }

        $model = AdiantamentoColhedo::create($data);

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
            'descricao' => 'Adiantamento de Colheita para ' . $model->fornecedor->razao_social,
            'valor' => $data['valor_pagamento'],
            'tipo' => $tipoPagamento,
            'status' => 'RIBEIRÃO'
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

        return view('financeiro.adiantamento.colhedor', $this->data);
    }

    public function colhedores(Request $request)
    {
        $search_term = $request->input('q');
       // $form = collect($request->input('form'))->pluck('value', 'razao_social');

        if ($search_term) {
            $options = DB::table('fornecedors')->where('fornecedors.finalidade', '=', 'COLHEDOR')
            ->join('lancamento_safras', 'lancamento_safras.colhedor_fornecedor_id', '=', 'fornecedors.id')
            ->join('safras', 'safras.id', '=', 'lancamento_safras.safra_id')
            ->leftJoin('adiantamento_colhedos', 'adiantamento_colhedos.fornecedor_id', '=', 'fornecedors.id')
            ->select('fornecedors.*')
            ->where('fornecedors.razao_social',  'LIKE', '%' . $search_term . '%')
            ->orderBy('fornecedors.razao_social')
            ->groupBy('lancamento_safras.colhedor_fornecedor_id')
            ->paginate(1000000);
        } else {
            $options = AdiantamentoColhedo::listaColhedores();
        }
        return $options;
    }
}
