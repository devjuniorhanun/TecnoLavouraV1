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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


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
        //CRUD::addClause('where', 'centro_custo_id', '>', 1);

        //$query->whereDate('data_documento', '>=', $request->data_lancamento);
        //where('tipo','=','BOLETO')
        CRUD::orderBy('id', 'DESC');
        //CRUD::orderBy('fornecedor_id');
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

        CRUD::field('produtor_id')
            ->label('Produtor.:')
            ->type('select2')
            ->entity('produtor')
            ->options(function ($query) {
                return $query->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->attribute('nome_fantasia')
            ->size(3);
        CRUD::field('centro_custo_id')
            ->label('Centro Custo.:')
            ->type('select2')
            ->entity('centroCusto')
            ->attribute('nome')
            ->model('App\Models\CentroCusto')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('fornecedor_id')
            ->label('Fornecedor.:')
            ->type('select2')
            ->entity('fornecedor')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('numero_documento')->label('Número Documento.:')->size(2);
        CRUD::field('data_documento')->label('Data Pagamento.:')->size(2);
        CRUD::field('data_vencimento')->label('Data Vencimento.:')->size(2);
        CRUD::field('valor')->label('Valor Pago.:')->size(2);
        CRUD::field('tipo')->label('Tipo.:')->size(2)->type('enum');
        CRUD::field('status')->label('Situação.:')->size(2)->type('enum');
        CRUD::field('descricao')->label('Descição Pagamento.:')->size(2);
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
        // Registro Filtros
        $date = $request->all();
        // Datas
        // Verifica se a data Inicial dos lancamentos foram passado
        //(isset($date['data_lancamento'])) ? $dataInicial = $date['data_lancamento'] : $dataInicial = date("Y-m-01");
        $dataInicial = (isset($date['data_lancamento'])) ? $date['data_lancamento'] : $dataInicial = date("Y-m-t");
        $dataMes = explode("-", $dataInicial);
        $mes_extenso = array(
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Novembro',
            '10' => 'Setembro',
            '11' => 'Outubro',
            '12' => 'Dezembro'
        );
        $mes = $mes_extenso[$dataMes[1]];
        //dd($mes);
        //$dataInicial = date("Y-11-01");
        // Verifica se a data Final dos lancamentos foram passado
        //(isset($date['data_vencimento'])) ? $dataFinal = $date['data_vencimento'] : $dataFinal = date("Y-m-t");
        $dataFinal = (isset($date['data_vencimento'])) ? $date['data_vencimento'] : date("Y-m-t");
        //$dataFinal = date("Y-11-30");
        // Fornecedores
        $fornecedores = Fornecedor::where('finalidade', '=', 'GERAL')->orderBy('razao_social')->get();
        // Centros de Custos
        $centroCusto = CentroCusto::orderBy('nome')->get();
        // Lista os Registros.
        $query = LancamentoContaApagar::query()
            ->where('tipo', '!=', 'SOJA')
            ->whereNull('deleted_at')
            // ->where('enviado', '=', 'NÃO')
            ->where('status', '!=', 'CAIXA')
            //->where('tipo', '!=', 'DIESEL')
            //->where('centro_custo_id', '!=', 47)
            //->where('centro_custo_id', '!=', 8)
            //->where('tipo', '!=', 'DINHEIRO')
            //->where('status', '!=', 'CAIXA')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal);

        // Departamento Pessoal
        $depPessoal = LancamentoContaApagar::query()
            ->whereNull('deleted_at')
            ->where('enviado', '=', 'NÃO')
            ->where('centro_custo_id', '=', 8)
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)->get();

        // Lacamento de Caixa
        $lancaCaixa = LancamentoContaApagar::query()
            ->whereNull('deleted_at')
            ->where('enviado', '=', 'NÃO')
            ->where('tipo', '=', 'DINHEIRO')
            ->where('status', '=', 'CAIXA')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)->get();

        // Adiantamento Caixa
        $caixaAdiantamento = Caixa::query()
            ->whereNull('deleted_at')
            ->where('adiantamento', '=', 'SIM')
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->get();


        // Verifica se o Fornecedor foi passado
        if ($request->fornecedor > 0) {
            $query->where('fornecedor_id', '=', $request->fornecedor);
        }
        // Verifica se o Centro de Custo foi Passo
        if ($request->centroCusto > 0) {
            $query->where('centro_custo_id', '=', $request->centroCusto);
        }
        // Verifica se o tipo pagamento
        if (isset($request->tipo)) {
            $query->where('tipo', '=', $request->tipo);
        }

        $registros = $query->orderBy('fornecedor_id')->get();
        //dd($registros);

        // Folha de Pagamento.
        $folhaPagamento = Folha::query()
            ->whereNull('deleted_at')
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->get();

        // Cheques Emitidos
        $cheques = ChequeEmitido::query()
            ->whereNull('deleted_at')
            //->addSelect(DB::raw('SUM(valor_lancamento) as chequeTotal'))
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->get();
        // Cheques Emitidos
        $totalCheque = ChequeEmitido::query()
            ->whereNull('deleted_at')
            ->addSelect(DB::raw('SUM(valor_lancamento) as chequeTotal'))
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->first()->chequeTotal;
        // dd($cheques);

        $data = [
            'fornecedores' => $fornecedores,
            'centroCusto' => $centroCusto,
            'date' => $date,
            'registros' => $registros,
            'folhaPagamento' => $folhaPagamento,
            'depPessoal' => $depPessoal,
            'lancaCaixa' => $lancaCaixa,
            'caixaAdiantamento' => $caixaAdiantamento,
            'cheques' => $cheques,
            'totalCheque' => $totalCheque,
            'mes' => $mes,
            //'transferencias' => $transferencias,
        ];

        //return $pdf = PDF::loadView('relatorios.contas.indexPdf', $data)->setPaper('a4', 'landscape')->stream();

        return view('relatorios.contas.index', compact(
            'fornecedores',
            'centroCusto',
            'date',
            'registros',
            'folhaPagamento',
            'depPessoal',
            'lancaCaixa',
            'caixaAdiantamento',
            'cheques',
            'totalCheque',
            'mes'
        ));
    }

    public function contasPdf(Request $request)
    {
        // Registro Filtros
        $date = $request->all();
        // Datas
        // Verifica se a data Inicial dos lancamentos foram passado
        $dataInicial = (isset($date['data_lancamento'])) ? $date['data_lancamento'] : $dataInicial = date("Y-m-t");
        $dataMes = explode("-", $dataInicial);
        $mes_extenso = array(
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Novembro',
            '10' => 'Setembro',
            '11' => 'Outubro',
            '12' => 'Dezembro'
        );
        $mes = $mes_extenso[$dataMes[1]];
        $dataFinal = (isset($date['data_vencimento'])) ? $date['data_vencimento'] : date("Y-m-t");
        // Fornecedores
        $fornecedores = Fornecedor::where('finalidade', '=', 'GERAL')->orderBy('razao_social')->get();
        // Centros de Custos
        $centroCusto = CentroCusto::orderBy('nome')->get();
        // Lista os Registros.
        $query = LancamentoContaApagar::query()
            ->where('tipo', '!=', 'SOJA')
            ->where('tipo', '!=', 'DIESEL')
            ->whereNull('deleted_at')
            ->where('status', '!=', 'CAIXA')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal);

        // Departamento Pessoal
        $depPessoal = LancamentoContaApagar::query()
        ->where('tipo', '!=', 'SOJA')
            ->where('tipo', '!=', 'DIESEL')
            ->whereNull('deleted_at')
            ->where('enviado', '=', 'NÃO')
            ->where('centro_custo_id', '=', 8)
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)->get();

        // Lacamento de Caixa
        $lancaCaixa = LancamentoContaApagar::query()
        ->where('tipo', '!=', 'SOJA')
            ->where('tipo', '!=', 'DIESEL')
            ->whereNull('deleted_at')
            ->where('enviado', '=', 'NÃO')
            ->where('tipo', '=', 'DINHEIRO')
            ->where('status', '=', 'CAIXA')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)->get();

        // Adiantamento Caixa
        $caixaAdiantamento = Caixa::query()
            ->whereNull('deleted_at')
            ->where('adiantamento', '=', 'SIM')
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->get();


        // Verifica se o Fornecedor foi passado
        if ($request->fornecedor > 0) {
            $query->where('fornecedor_id', '=', $request->fornecedor);
        }
        // Verifica se o Centro de Custo foi Passo
        if ($request->centroCusto > 0) {
            $query->where('centro_custo_id', '=', $request->centroCusto);
        }
        // Verifica se o tipo pagamento
        if (isset($request->tipo)) {
            $query->where('tipo', '=', $request->tipo);
        }

        $registros = $query->orderBy('fornecedor_id')->get();

        // Folha de Pagamento.
        $folhaPagamento = Folha::query()
            ->whereNull('deleted_at')
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->get();

        // Cheques Emitidos
        $cheques = ChequeEmitido::query()
            ->whereNull('deleted_at')
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->get();

        // Cheques Emitidos
        $totalCheque = ChequeEmitido::query()
            ->whereNull('deleted_at')
            ->addSelect(DB::raw('SUM(valor_lancamento) as chequeTotal'))
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->first()->chequeTotal;

        $data = [
            'fornecedores' => $fornecedores,
            'centroCusto' => $centroCusto,
            'date' => $date,
            'registros' => $registros,
            'folhaPagamento' => $folhaPagamento,
            'depPessoal' => $depPessoal,
            'lancaCaixa' => $lancaCaixa,
            'caixaAdiantamento' => $caixaAdiantamento,
            'cheques' => $cheques,
            'totalCheque' => $totalCheque,
            'mes' => $mes,
        ];

        return $pdf = PDF::loadView('relatorios.contas.indexPdf', $data)->setPaper('a4', 'landscape')->stream();

        
    }

    public function centroCusto(Request $request)
    {
        // Registro Filtros
        $date = $request->all();
        // Datas
        // Verifica se a data Inicial dos lancamentos foram passado
        //(isset($date['data_lancamento'])) ? $dataInicial = $date['data_lancamento'] : $dataInicial = date("Y-m-01");
        $dataInicial = (isset($date['data_lancamento'])) ? $date['data_lancamento'] : $dataInicial = date("Y-m-01");
        //$dataInicial = date("Y-11-01");
        // Verifica se a data Final dos lancamentos foram passado
        //(isset($date['data_vencimento'])) ? $dataFinal = $date['data_vencimento'] : $dataFinal = date("Y-m-t");
        $dataFinal = (isset($date['data_vencimento'])) ? $date['data_vencimento'] : date("Y-m-t");
        //$dataFinal = date("Y-11-30");
        $dataMes = explode("-", $dataInicial);
        $mes_extenso = array(
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Novembro',
            '10' => 'Setembro',
            '11' => 'Outubro',
            '12' => 'Dezembro'
        );
        $mes = $mes_extenso[$dataMes[1]];

        // Fornecedores
        $fornecedores = Fornecedor::where('finalidade', '=', 'GERAL')->orderBy('razao_social')->get();
        // Centros de Custos
        $centroCusto = CentroCusto::orderBy('nome')->get();

        // Lista os Registros.
        $registros = LancamentoContaApagar::query()
            //->where('tipo', '!=', 'DINHEIRO')
            //->where('tipo', '!=', 'CHEQUE')
            //->where('status', '!=', 'CAIXA')
            //->where('tipo', '!=', 'DIESEL')
            ->whereNull('deleted_at')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->select('centro_custo_id')
            ->addSelect(DB::raw('SUM(valor) as valorTotal'))
            ->groupBy('centro_custo_id')
            ->get();

        // Folha de Pagamento.
        $folhaPagamento = Folha::query()
            ->whereNull('deleted_at')
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor_lancamento) as folhaTotal'))
            ->first();

        // Cheques Emitidos
        $cheques = ChequeEmitido::query()
            ->whereNull('deleted_at')
            ->addSelect(DB::raw('SUM(valor_lancamento) as chequeTotal'))
            ->where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->first();

        // Adiantamento Caixa
        $caixaAdiantamento = LancamentoContaApagar::query()
            ->whereNull('deleted_at')
            ->where('tipo', '=', 'CHEQUE')
            ->where('status', '=', 'CAIXA')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor) as adiantamentoTotal'))
            ->first();

        // Cheque Frete
        $chequeFrete = LancamentoContaApagar::query()
            ->whereNull('deleted_at')
            ->where('tipo', '=', 'CHEQUE')
            ->where('status', '=', 'RIBEIRÃO')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor) as total'))
            ->first();
        // Cheque Adiantamento
        $chequeAdiantamento = LancamentoContaApagar::query()
            ->whereNull('deleted_at')
            ->where('tipo', '=', 'CHEQUE')
            ->where('status', '=', 'FAZENDA')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor) as total'))
            ->first();

        // Pagamento do Caixa
        $caixaTotal = LancamentoContaApagar::query()
            ->where('tipo', '=', 'DINHEIRO')
            ->where('status', '=', 'CAIXA')
            ->whereNull('deleted_at')
            ->where('enviado', '=', 'NÃO')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor) as valorTotal'))
            ->first();

        // Pagamento do Diesel
        $diesel = LancamentoContaApagar::query()
            ->where('tipo', '=', 'DIESEL')
            ->whereNull('deleted_at')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor) as total'))
            ->first();

        // Pagamentos em soja
        $soja = LancamentoContaApagar::query()
            ->where('tipo', '=', 'SOJA')
            ->whereNull('deleted_at')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor) as total'))
            ->first();

        $boletos = LancamentoContaApagar::query()
            ->whereNull('deleted_at')
            ->where('tipo', '=', 'BOLETO')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->where('tipo', '!=', 'CHEQUE')
            ->addSelect(DB::raw('SUM(valor) as boletoTotal'))
            ->first();
        //dd($boletos->boletoTotal);

        $transferencia = LancamentoContaApagar::query()
            ->whereNull('deleted_at')
            ->where('tipo', '=', 'TRANSFERÊNCIA')
            ->where('status', '!=', 'COMÉRCIO')
            ->where('status', '=', 'RIBEIRÃO')
            ->where('tipo', '!=', 'CHEQUE')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor) as transferenciaTotal'))
            ->first();

        /*$pagamentos = LancamentoContaApagar::query()
            ->where('enviado', '=', 'NÃO')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->select('tipo')
            ->addSelect(DB::raw('SUM(valor) as valorTotal'))
            ->groupBy('tipo')
            ->get();*/

        $bomJesus = LancamentoContaApagar::query()
            ->whereNull('deleted_at')
            //->where('tipo', '=', 'TRANSFERÊNCIA')
            ->where('status', '=', 'COMÉRCIO')
            ->where('data_documento', '>=', $dataInicial)
            ->where('data_documento', '<=', $dataFinal)
            ->addSelect(DB::raw('SUM(valor) as bomJesusTotal'))
            ->first();




        //dd($folhaPagamento);

        return view('relatorios.contas.centroCusto', compact(
            'fornecedores',
            'centroCusto',
            'date',
            'registros',
            'cheques',
            'folhaPagamento',
            'caixaAdiantamento',
            'caixaTotal',
            'boletos',
            'transferencia',
            'bomJesus',
            'diesel',
            'soja',
            'mes',
            'chequeFrete',
            'chequeAdiantamento'
        ));
    }

    public function marmitas()
    {
        $marmitas = LancamentoContaApagar::where('fornecedor_id', '=', 169)->orderByDesc('id')->get();
        //dd($marmitas);
        return view('financeiro.marmitas.index', compact('marmitas'));
        //return 'ola';
    }

    public function reciboPlantio()
    {
        $plantio = LancamentoContaApagar::where('fornecedor_id', '=', 271)->orderByDesc('id')->get();
        //dd($plantio);
        return view('financeiro.plantio.index', compact('plantio'));
        //return 'ola';

    }

    public function plantioRecibo($idRecibo)
    {
        $entry = LancamentoContaApagar::find($idRecibo);
        //dd($recibo);
        return view('financeiro.plantio.recibo', compact('entry'));
    }

    public function recibo($idRecibo)
    {
        $entry = LancamentoContaApagar::find($idRecibo);
        //dd($recibo);
        return view('financeiro.marmitas.recibo', compact('entry'));
    }

    public function transferenciaDoDia(Request $request)
    {
        // Registro Filtros
        $date = $request->all();

        $dataInicial = (isset($date['dataInicial'])) ? $date['dataInicial'] : $dataInicial = Carbon::now()->format('Y-m-d');
        $dataFinal = (isset($date['dataFinal'])) ? $date['dataFinal'] : '';

        //dd($dataInicial);
        if ((isset($date['dataInicial']))) {
            //dd($date);
            $transferencias = LancamentoContaApagar::where('data_documento', '>=', $dataInicial)
                ->where('tipo', '=', 'TRANSFERÊNCIA')
                ->where('data_documento', '<=', $dataFinal)->get();
        } else {
            $transferencias = LancamentoContaApagar::where('data_documento', '=', $dataInicial)
                ->where('tipo', '=', 'TRANSFERÊNCIA')
                ->get();
        }
        //dd($transferencias);
        $data = [
            'transferencias' => $transferencias,
        ];

        //return $pdf = PDF::loadView('admin.lacamento_pagamentos.contas_apagar.transferenciasPDF', $data)->stream();

        //return $pdf->download('codesolutionstuff.pdf');



        //$pdf = Pdf::loadView('admin.lacamento_pagamentos.contas_apagar.transferencias', $transferencias);
        //    Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
        //return $pdf->download('transferencias.pdf');
        return view('admin.lacamento_pagamentos.contas_apagar.transferencias', compact('transferencias'));
        // dd('transferenciaDoDia');
    }

    public function transferenciaDiaPdf(Request $request)
    {
        // Registro Filtros
        $date = $request->all();


        $dataInicial = (isset($date['dataInicial'])) ? $date['dataInicial'] : $dataInicial = Carbon::now()->format('Y-m-d');
        $dataFinal = (isset($date['dataFinal'])) ? $date['dataFinal'] : '';

        //dd($dataInicial);
        if ((isset($date['dataInicial']))) {
            //dd($date);
            $transferencias = LancamentoContaApagar::where('data_documento', '>=', $dataInicial)
                ->where('tipo', '=', 'TRANSFERÊNCIA')
                ->where('data_documento', '<=', $dataFinal)->get();
        } else {
            $transferencias = LancamentoContaApagar::where('data_documento', '=', $dataInicial)
                ->where('tipo', '=', 'TRANSFERÊNCIA')
                ->get();
        }
        //dd($transferencias);
        $data = [
            'transferencias' => $transferencias,
        ];

        return $pdf = PDF::loadView('admin.lacamento_pagamentos.contas_apagar.transferenciasPDF', $data)->stream();
    }

    public function romaneioBoletos()
    {
        dd('Ola');
    }
}
