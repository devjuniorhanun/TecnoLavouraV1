<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LancamentoContaApagarRequest;
use App\Models\CentroCusto;
use App\Models\Fornecedor;
use App\Models\LancamentoContaApagar;
use App\Models\Lancamentos\Caixa;
use App\Models\Lancamentos\ChequeEmitido;
use App\Models\Lancamentos\Folha;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class LancamentoContaApagarCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LancamentoContaApagarCrudController extends CrudController
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
        CRUD::setModel(\App\Models\LancamentoContaApagar::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lancamentocontaapagar');
        CRUD::setEntityNameStrings('Contas Apagar', 'Contas Apagares');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->addCustomCrudFilters();
        //CRUD::addClause('whereDate','>=', '2021-09-01');
        CRUD::addClause('where', 'centro_custo_id', '>', 1);

        //$query->whereDate('data_documento', '>=', $request->data_lancamento);
        //where('tipo','=','BOLETO')
        CRUD::orderBy('id', 'DESC');
        CRUD::orderBy('fornecedor_id');
        // CRUD::orderBy('id','desc');
        CRUD::enableExportButtons();
        //$this->crud->addClause('where','enviado', '=', 'NÃO');
        CRUD::column('fornecedor_id')->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('centro_custo_id')->type('select')
            ->entity('centroCusto')
            ->model('App\Models\CentroCusto')
            ->attribute('nome');
        CRUD::column('numero_documento')->label('Nº Docu.');
        CRUD::column('data_documento')->label('Lançamento')->type('datetime')->format('D/M/YYYY');
        CRUD::column('data_vencimento')->label('Vencimento')->type('datetime')->format('D/M/YYYY');
        CRUD::column('descricao')->label('Descrição');
        CRUD::column('valor')->type('number')
            ->decimals(2)
            ->prefix('R$ ')
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('status')->label('Situação');

        //$this->crud->enableDetailsRow();
        // $this->crud->setDetailsRowView('vendor.backpack.crud.details_row.monster');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LancamentoContaApagarRequest::class);

        CRUD::field('centro_custo_id')
            ->type('select2')
            ->entity('centroCusto')
            ->attribute('nome')
            ->model('App\Models\CentroCusto')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('fornecedor_id')
            ->type('select2')
            ->entity('fornecedor')
            ->attribute('nome_fantasia')
            //->model('App\Models\CentroCusto')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('numero_documento')->label('Número Documento')->size(3);
        CRUD::field('data_documento')->label('Data Pagamento')->size(3);
        CRUD::field('data_vencimento')->label('Data Vencimento')->size(3);
        CRUD::field('descricao')->label('Descição Pagamento')->size(3);
        CRUD::field('valor')->label('Valor Pago')->size(2)->attributes(['class' => 'form-control valores']);
        CRUD::field('tipo')->label('Tipo')->size(2)->type('enum');
        CRUD::field('status')->label('Situação')->size(2)->type('enum');
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

        $request = $this->crud->validateRequest();
        $date = $request->all();

        $date['valor'] = str_replace('.', "", $date['valor']);
        $date['valor'] = str_replace(',', ".", $date['valor']);
        //dd($date);

        $model = LancamentoContaApagar::create($date);
        \Alert::success(trans('Conta Cadastrada com Sucesso'))->flash();
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        $request = $this->crud->validateRequest();
        $date = $request->all();


        $date['valor'] = str_replace('.', "", $date['valor']);
        $date['valor'] = str_replace(',', ".", $date['valor']);

        $model = LancamentoContaApagar::find($request->id);


        $model->update($date);
        \Alert::success(trans('Conta Alterada com Sucesso'))->flash();
        $this->crud->setSaveAction();
        return $this->crud->performSaveAction($model->id);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column('fornecedor_id')->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('numero_documento');
        CRUD::column('data_documento')->type('datetime')->format('D/M/YYYY');
        CRUD::column('valor')->type('number')
            ->decimals(2)
            ->prefix('R$ ')
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('descricao')->label('Descição Pagamento')->size(4);
        CRUD::column('status')->label('Situação');
    }

    

    protected function addCustomCrudFilters()
    {
        /*$this->crud->addFilter(
            [ // text filter
                'type'  => 'select2',
                'name'  => 'centro_custo_id',
                'label' => 'Centro Custo',
            ],
            false,
            /*function ($value) { // if the filter is active
                $this->crud->addClause('where', 'text', 'LIKE', "%$value%");
            }
        );*/

        $this->crud->addFilter([ // select2 filter
            'name' => 'centro_custo_id',
            'type' => 'select2',
            'label' => 'Centro Custo',
        ], function () {
            return CentroCusto::all()->keyBy('id')->pluck('nome', 'id')->toArray();
        },);

        $this->crud->addFilter([ // select2 filter
            'name' => 'fornecedor_id',
            'type' => 'select2',
            'label' => 'Fornecedores',
        ], function () {
            return Fornecedor::all()->keyBy('id')->pluck('razao_social', 'id')->toArray();
        },);

        $this->crud->addFilter(
            [
                'type'  => 'date_range',
                'name'  => 'data_documento',
                'label' => 'Lançamento'
            ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                // $this->crud->addClause('where', 'date', $value);
            }
        );
    }

    public function contas(Request $request)
    {
        $fornecedores = Fornecedor::where('finalidade', '=', 'GERAL')->orderBy('razao_social')->get();
        $centroCusto = CentroCusto::orderBy('nome')->get();
        $query = LancamentoContaApagar::query()
        ->where('enviado','=','NÃO')
        ->where('tipo','!=','SOJA')
        ->where('valor','>',0)
        ->where('data_documento', '>=', date("Y-11-01"))
        ->where('data_documento', '<=', date("Y-11-30"));


        if ($request->data_lancamento && $request->data_vencimento) {
            $query->whereDate('data_documento', '>=', $request->data_lancamento);
            $query->whereDate('data_documento', '<=', $request->data_vencimento);
        } /* else {
            if ($request->data_lancamento > 0) {
                //$query->where('data_documento', 'like', '%' . $request->data_lancamento . '%');
                $query->whereDate('data_documento', '>=', $request->data_lancamento);
            }
    
            if ($request->data_vencimento > 0) {
               //$query->where('data_vencimento', 'like', '%' . $request->data_vencimento . '%');
                $query->whereDate('data_vencimento', '<=', $request->data_lancamento);
            }
        /*}*/

        if ($request->fornecedor > 0) {
            $query->where('fornecedor_id', '=', $request->fornecedor);
        }
        if ($request->centroCusto > 0) {
            $query->where('centro_custo_id', '=', $request->centroCusto);
        }
        if (isset($request->tipo)) {
            $query->where('tipo', '=', $request->tipo);
        }
        $date = $request->all();
        $registros = $query->orderBy('fornecedor_id')->orderByDesc('id')->get();
        $folhaPagamento = Folha::query()
        ->where('data_lancamento', '>=', date("Y-11-1"))
        ->where('data_lancamento', '<=', date("Y-11-30"))->get();
        $cheques = ChequeEmitido::query()
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))->get();
        $caixaAdiantamento = Caixa::where('adiantamento','=','SIM')
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))->get();
        $caixaAdiantamentoTotal = Caixa::where('adiantamento','=','SIM')
        ->addSelect(DB::raw('SUM(valor_lancamento) as adiantamentoTotal'))
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))->first();

        $caixaCredito = Caixa::where('tipo_pagamento','=','SAIDA')
        ->where('adiantamento','=','NÃO')
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor_lancamento) as credito'))
        ->first();
        $caixaSaida = Caixa::where('tipo_pagamento','=','SAIDA')
        ->where('adiantamento','=','NÃO')
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))
        //->addSelect(DB::raw('SUM(valor_lancamento) as credito'))
        ->get();
       // dd($caixaSaida);

        $caixaDebito = Caixa::where('tipo_pagamento','=','ENTRADA')
        ->where('adiantamento','=','NÃO')
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor_lancamento) as debito'))
        ->first();
        $caixaDebitoEntrada = Caixa::where('tipo_pagamento','=','ENTRADA')
        ->where('adiantamento','=','NÃO')
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))
        //->addSelect(DB::raw('SUM(valor_lancamento) as debito'))
        ->get();
        
        //dd($caixaAdiantamento);
        return view('relatorios.contas.index', compact('fornecedores', 'registros', 
                                                       'centroCusto', 'date','folhaPagamento',
                                                       'cheques','caixaAdiantamento','caixaCredito', 
                                                       'caixaDebito','caixaAdiantamentoTotal','caixaSaida','caixaDebitoEntrada'));
    }

    public function centroCusto(Request $request)
    {
        $date = $request->all();
        $fornecedores = Fornecedor::where('finalidade', '=', 'GERAL')->orderBy('razao_social')->get();
        $centroCusto = CentroCusto::orderBy('nome')->get();
        //$query = LancamentoContaApagar::whereDate('data_documento', '>=', date("Y-m-01"))->get()->groupBy('centro_custo_id');
        //$P_Dia = date("Y-m-01");
        //$U_Dia = date("Y-m-t");
        //$query->whereDate('data_documento', '>=', date("Y-m-01"));
       // $query->whereDate('data_documento', '<=',$U_Dia);
        //dd($P_Dia . " - " . $U_Dia);
        //dd($query);

        //$registros = $query;

        //$registros = $query->groupBy('centro_custo_id');
        //dd($registros);
        $registros = DB::table('lancamento_conta_apagars')
        ->where('enviado','=','NÃO')
        ->where('data_documento', '>=', date("Y-11-01"))
        ->where('data_documento', '<=', date("Y-11-30"))
        ->join('centro_custos','centro_custos.id','=','lancamento_conta_apagars.centro_custo_id')
        ->select('lancamento_conta_apagars.centro_custo_id','centro_custos.*')
        ->addSelect(DB::raw('SUM(valor) as valorTotal'))
        ->orderBy('centro_custos.nome')
        ->groupBy('lancamento_conta_apagars.centro_custo_id')
        ->get();

        $caixaTotal = DB::table('lancamento_conta_apagars')
        ->where('enviado','=','NÃO')
        ->where('lancamento_conta_apagars.centro_custo_id', '=', 47)
        ->where('data_documento', '>=', date("Y-11-01"))
        ->where('data_documento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor) as valorTotal'))
        ->first();


        $folhaPagamento = Folha::query()
        ->where('data_lancamento', '>=', date("Y-11-1"))
        ->where('data_lancamento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor_lancamento) as folhaTotal'))
        ->first();
        $cheques = ChequeEmitido::query()
        ->addSelect(DB::raw('SUM(valor_lancamento) as chequeTotal'))
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))->first();
        $caixaAdiantamento = Caixa::where('adiantamento','=','SIM')
        ->addSelect(DB::raw('SUM(valor_lancamento) as adiantamentoTotal'))
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))->first();

        $caixaCredito = Caixa::where('tipo_pagamento','=','SAIDA')
        ->where('adiantamento','=','NÃO')
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor_lancamento) as credito'))
        ->first();

        $caixaSaida = Caixa::where('tipo_pagamento','=','SAIDA')
        ->where('adiantamento','=','NÃO')
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))
        //->addSelect(DB::raw('SUM(valor_lancamento) as credito'))
        ->get();
       // dd($caixaSaida);

        $caixaDebito = Caixa::where('tipo_pagamento','=','ENTRADA')
        ->where('adiantamento','=','NÃO')
        ->where('data_lancamento', '>=', date("Y-11-01"))
        ->where('data_lancamento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor_lancamento) as debito'))
        ->first();


        $boletos = LancamentoContaApagar::where('tipo','=','BOLETO')
        ->where('data_documento', '>=', date("Y-11-01"))
        ->where('data_documento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor) as boletoTotal'))
        ->first();
        $transferencia = LancamentoContaApagar::where('tipo','=','TRANSFERÊNCIA')
        ->where('status','=','RIBEIRÃO')
        ->where('data_documento', '>=', date("Y-11-01"))
        ->where('data_documento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor) as transferenciaTotal'))
        ->first();
        $bomJesus = LancamentoContaApagar::where('tipo','=','TRANSFERÊNCIA')
        ->where('status','=','COMÉRCIO')
        ->where('data_documento', '>=', date("Y-11-01"))
        ->where('data_documento', '<=', date("Y-11-30"))
        ->addSelect(DB::raw('SUM(valor) as bomJesusTotal'))
        ->first();
        return view('relatorios.contas.centroCusto', compact('fornecedores', 'registros', 
                                                    'centroCusto', 'date','folhaPagamento','cheques',
                                                    'caixaAdiantamento','caixaCredito', 'caixaDebito',
                                                    'boletos','transferencia',
                                                    'bomJesus','caixaSaida','caixaTotal'));
    }
}
