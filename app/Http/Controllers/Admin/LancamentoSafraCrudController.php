<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LancamentoSafraRequest;
use App\Models\AdiantamentoMotorista;
use App\Models\Armazem;
use App\Models\Colhedor;
use App\Models\Fazenda;
use App\Models\Fornecedor;
use App\Models\LancamentoContaApagar;
use App\Models\Lancamentos\Transferencia;
use App\Models\LancamentoSafra;
use App\Models\LocacaoTalhao;
use App\Models\MatrizFrete;
use App\Models\Motorista;
use App\Models\Safra;
use App\Models\Talhao;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Class LancamentoSafraCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LancamentoSafraCrudController extends CrudController
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
        CRUD::setModel(\App\Models\LancamentoSafra::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lancamentosafra');
        CRUD::setEntityNameStrings('Lançamento Safra', 'Lançamentos Safras');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->enableExportButtons();
        $this->crud->enableResponsiveTable();
        $this->crud->addClause('whereHas', 'safra', function ($query) {
            $query->where('status', '=', 'Ativa');
        });


        CRUD::column('id')->label('Nº');

        CRUD::column('data_colhido')->type('datetime')->format('DD/MM/YYYY');
        //CRUD::column('motorista_fornecedor_id');
        //CRUD::column('motorista_id');
        CRUD::column('motorista_id')->type('select')
            ->entity('motorista')
            ->attribute('placa_nome');

        CRUD::column('talhao_id')->type('select')
            ->entity('Talhao')
            ->attribute('nome');
        CRUD::column('num_controle')->label('Nº Controler');
        CRUD::column('num_romaneio')->label('Nº Romaneio');
        CRUD::column('peso_bruto')->label('Peso Bruto (Kg)')->type('number')->thousands_sep(".");
        CRUD::column('peso_desconto')->label('Desconto (Kg)')->type('number')->thousands_sep(".");
        CRUD::column('peso_liquido')->label('Peso Liquido (Kg)')->type('number')->thousands_sep(".");
        CRUD::column('armazem_id')->type('select')
            ->entity('Armazem')
            ->attribute('nome');
        CRUD::column('colhedor_id')->type('select')
            ->entity('Colhedor')
            ->attribute('nome');
        CRUD::column('desconto')->label('Desconto (%)');
        CRUD::column('fazenda_id')->type('select')
            ->entity('Fazenda')
            ->attribute('nome');
        CRUD::column('matriz_frete_id')
            ->type('select')
            ->entity('matrizFrete')
            //->model('App\Models\Fornecedor')
            ->attribute('frete');
        CRUD::column('proprietario_id')->type('select')
            ->entity('Proprietario')
            ->attribute('nome_fantasia');
        CRUD::column('saco_bruto')
            ->prefix('Sc ');
        CRUD::column('saco_liquido')
            ->prefix('Sc ');
        //CRUD::column('safra_id');
        CRUD::column('valor_frete')->type('number')
            ->prefix('R$ ')
            ->decimals(2)
            ->dec_point(',')
            ->thousands_sep('.')
            ->label('Frete');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LancamentoSafraRequest::class);
        CRUD::field('data_colhido')->size(3)->label('Data.:');
        CRUD::field('safra_id')
            ->label('Safra.:')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Safra')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('motorista_id')
            ->attributes(['id' => 'motorista_id'])
            ->label('Trasportador.:')
            ->type('select2')
            ->attribute('placa_nome')
            ->model('App\Models\Motorista')
            ->options(function ($query) {
                return $query->where('status', '=', 'ATIVO')->orderBy('placa_nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('proprietario_id')
            ->label('Proprietário.:')
            ->type('select2')
            ->attribute('nome_fantasia')
            ->model('App\Models\Proprietario')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->where('tipo_pagamento', '=', 'Depósito')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('num_romaneio')->label('Nº Romaneio')->size(3)->attributes(['id' => 'num_romaneio']);
        CRUD::field('num_controle')->label('Nº Controle')->size(3)->attributes(['id' => 'num_controle']);
        CRUD::field('locacao_talhao_id')->type('hidden')->attributes(['id' => 'locacao_talhao_id']);

        CRUD::field('talhao_id')
            ->attributes(['id' => 'talhao_id'])
            ->label('Talhão')
            ->model('App\Models\LocacaoTalhao')
            ->type('select2_from_ajax')
            ->attribute('nome')
            ->data_source('locacao')
            ->placeholder('Talhões')
            ->include_all_form_fields(true)
            ->minimum_input_length(0)
            ->dependencies(['safra_id'])
            ->method('post')
            ->size(3);

        CRUD::field('armazem_id')
            ->attributes(['id' => 'armazem_id'])
            ->label('Armazéns')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Armazem')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('colhedor_id')
            ->attributes(['id' => 'colhedor_id'])
            ->label('Colhedores.:')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Colhedor')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('peso_bruto')->size(2)->label('Peso Bruto (Kg).:')->attributes(['id' => 'peso_bruto', 'class' => 'form-control']);
        CRUD::field('peso_desconto')->size(2)->label('Desconto (Kg).:')->attributes(['id' => 'peso_desconto', 'class' => 'form-control']);
        CRUD::field('peso_liquido')->size(2)->label('Peso Liquido (Kg).:')->attributes(['id' => 'peso_liquido', 'class' => 'form-control desabilitado']);



        CRUD::field('fazenda_id')
            ->label('Fazendas Deposito.:')
            ->type('select2')
            ->attribute('inscricao_estadual')
            ->model('App\Models\Fazenda')
            ->default(0)
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('desconto')->size(2)->label('Desconto (%).:')->attributes(['id' => 'desconto', 'class' => 'form-control desabilitado']);

        CRUD::field('saco_bruto')->size(2)->label('Sacos Brutos')->attributes(['id' => 'saco_bruto', 'class' => 'form-control desabilitado']);
        CRUD::field('saco_liquido')->size(2)->label('Sacos Líquido')->attributes(['id' => 'saco_liquido', 'class' => 'form-control desabilitado']);
        CRUD::field('valor_frete')->size(2)->label('Valor Frete.:')->attributes(['id' => 'valor_frete', 'class' => 'form-control desabilitado']);
        CRUD::field('freteValor')->label('Frete Sc.:')->attributes(['id' => 'freteValor', 'class' => 'form-control desabilitado'])->size(2);

        CRUD::field('motorista_fornecedor_id')->type('hidden')->attributes(['id' => 'motorista_fornecedor_id']);
        CRUD::field('armazen_fornecedor_id')->type('hidden')->attributes(['id' => 'armazen_fornecedor_id']);
        CRUD::field('cultura_id')->type('hidden')->attributes(['id' => 'cultura_id']);
        CRUD::field('variedade_cultura_id')->type('hidden')->attributes(['id' => 'variedade_cultura_id']);
        CRUD::field('colhedor_fornecedor_id')->type('hidden')->attributes(['id' => 'colhedor_fornecedor_id']);
        CRUD::field('matriz_frete_id')->type('hidden')->attributes(['id' => 'matriz_frete_id']);
        
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

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column('data_colhido')->type('datetime')->format('DD/MM/YYYY');
        //CRUD::column('motorista_fornecedor_id');
        //CRUD::column('motorista_id');
        CRUD::column('motorista_id')->type('select')
            ->entity('motorista')
            ->with('fornecedor')
            //->model('App\Models\Fornecedor')
            ->attribute('placa_nome');

        CRUD::column('talhao_id')->type('select')
            ->entity('Talhao')
            ->attribute('nome');
        CRUD::column('num_controle')->label('Nº Controler');
        CRUD::column('num_romaneio')->label('Nº Romaneio');
        CRUD::column('peso_bruto')->label('Peso Bruto (Kg)')->type('number')->thousands_sep(".");
        CRUD::column('peso_desconto')->label('Desconto (Kg)')->type('number')->thousands_sep(".");
        CRUD::column('peso_liquido')->label('Peso Liquido (Kg)')->type('number')->thousands_sep(".");
        CRUD::column('armazem_id')->type('select')
            ->entity('Armazem')
            ->attribute('nome');
        CRUD::column('colhedor_id')->type('select')
            ->entity('Colhedor')
            ->attribute('nome');
        CRUD::column('desconto')->label('Desconto (%)');
        CRUD::column('fazenda_id')->type('select')
            ->entity('Fazenda')
            ->attribute('nome');
        CRUD::column('matriz_frete_id')
            ->type('select')
            ->entity('matrizFrete')
            //->model('App\Models\Fornecedor')
            ->attribute('frete');
        CRUD::column('proprietario_id')->type('select')
            ->entity('Proprietario')
            ->attribute('nome_fantasia');
        CRUD::column('saco_bruto')
            ->decimals(3)
            ->prefix('Sc ');
        CRUD::column('saco_liquido')
            ->prefix('Sc ');
        //CRUD::column('safra_id');
        CRUD::column('valor_frete')->type('number')
            ->prefix('R$ ')
            ->decimals(2)
            ->dec_point(',')
            ->thousands_sep('.')
            ->label('Frete');
    }
/*
    public function store()
    {

        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();
        dd($data);
    }
*/
    public function index()
    {
        $this->crud->hasAccessOrFail('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? mb_ucfirst($this->crud->entity_name_plural);
        //$this->data['colhido'] = LancamentoSafra::where('safra_id', '=', '2')->select(DB::raw('SUM(peso_bruto) as peso'))->first()->peso;
        return view('admin.lacamento_lavoura.index', $this->data);
    }

    public function frete($idLocacao, $idArmazen, $idMotorista, $idColhedor)
    {
        $dados = [];
        $dados['locacao'] = LocacaoTalhao::where('talhao_id', '=', $idLocacao)->where('safra_id', '=', 8)->first();
        $bloco = Talhao::find($idLocacao)->bloco;
        $dados['percuso'] = Armazem::find($idArmazen);
        // /$dados['armazem'] = Armazem::find($idArmazen);
        $dados['motorista'] = Motorista::find($idMotorista);
        $dados['colhedor'] = Colhedor::find($idColhedor);
        $dados['frete'] = MatrizFrete::where('status','=','ATIVO')->whereHas('safra', function ($query) {
            $query->where('status', '=', 'Ativa');
        })->where('bloco', '=', $bloco)->where('percurso', '=', $dados['percuso']->percurso)->first();

        //dd($dados['percuso']);
        return $dados;
    }

    public function safra(Request $request)
    {
        $date = $request->all();
        $listagem = LancamentoSafra::Listagem();
        //dd("Safra");

        $totalColhido = LancamentoSafra::totalColhido();
        $totalColhidoCulutra = LancamentoSafra::totalColhidoCulutra();
        $listaData = LancamentoSafra::listaData();
        $listaMotorista = LancamentoSafra::listaMotorista();
        $listaTalhao = LancamentoSafra::listaTalhao();
        $listaArmazem = LancamentoSafra::listaArmazem();
        $listaColhedores = LancamentoSafra::listaColhedores();
        $listaProprietarios = LancamentoSafra::listaProprietarios();
        $listaFazendas = Fazenda::all();
        //dd($listaFazendas);


        return view('admin.lacamento_lavoura.safras', compact(
            'listagem',
            'totalColhido',
            'listaTalhao',
            'listaArmazem',
            'totalColhidoCulutra',
            'listaData',
            'listaMotorista',
            'listaColhedores',
            'listaProprietarios',
            'date',
            'listaFazendas',
        ));
    }

    public function safras(Request $request)
    {
        
        $date = $request->all();
        $totalColhido = LancamentoSafra::totalColhido();
        $totalColhidoCulutra = LancamentoSafra::totalColhidoCulutra();
        $listaData = LancamentoSafra::listaData();
        $listaMotorista = LancamentoSafra::listaMotorista();
        $listaTalhao = LancamentoSafra::listaTalhao();
        $listaArmazem = LancamentoSafra::listaArmazem();
        $listaColhedores = LancamentoSafra::listaColhedores();
        $listaProprietarios = LancamentoSafra::listaProprietarios();
        $listaFazendas = Fazenda::all();
        //dd($listaFazendas);

        $query = LancamentoSafra::query();
        //dd("Safras");
        if ($request->periodo > 0) {
            $query->where('data_colhido', 'like', "%$request->periodo%");
        }
        if ($request->motorista > 0) {
            $query->where('motorista_id', '=', $request->motorista)->get();
        }
        if ($request->talhao > 0) {
            $query->where('talhao_id', '=', $request->talhao)->get();
        }
        if ($request->armazem > 0) {
            $query->where('armazem_id', '=', $request->armazem)->get();
        }
        if ($request->colhedor > 0) {
            $query->where('colhedor_id', '=', $request->colhedor)->get();
        }
        if ($request->proprietario > 0) {
            $query->where('proprietario_id', '=', $request->proprietario)->get();
        }

        if ($request->fazenda > 0) {
            $query->where('fazenda_id', '=', $request->fazenda)->get();
        }

        $listagem = $query->join('safras', 'safras.id', '=', 'lancamento_safras.safra_id')
            ->where('safras.status', '=', 'Ativa')
            ->where('safras.deleted_at', '=', null)
            ->orderBy('num_romaneio')->get();

        return view('admin.lacamento_lavoura.relatorios', compact(
            'listagem',
            'totalColhido',
            'listaTalhao',
            'listaArmazem',
            'totalColhidoCulutra',
            'listaData',
            'listaMotorista',
            'listaColhedores',
            'listaProprietarios',
            'date',
            'listaFazendas',
        ));
    }

    public function motorista(Request $request)
    {
        
        $id = $request->motorista;
        //dd($id);
        //$registros = Motorista::listaMotoristas($id);
        $registros = LancamentoSafra::where('motorista_fornecedor_id', '=', $id)
            ->orderBy('lancamento_safras.created_at')
            ->join('safras', 'safras.id', '=', 'lancamento_safras.safra_id')
            ->where('safras.status', '=', 'Ativa')->get()->groupBy('motorista_id');
        $listaTransportador = LancamentoSafra::listaTransportador();
        //dd($registros);
        $adiantemento = AdiantamentoMotorista::where('fornecedor_id', '=', $id)
            ->where('safra_id', '=', 8)
            ->select(DB::raw('SUM(valor_pagamento) as valorPagamento'))->first()->valorPagamento;
        //dd($adiantemento);
        return view('admin.lacamento_lavoura.motorista', compact('registros', 'listaTransportador', 'adiantemento'));
    }

    public function motoristas()
    {
        
        $this->crud->hasAccessOrFail('list');
        $registros = LancamentoSafra::where('safra_id', '=', 8)->select(DB::raw('SUM(peso_bruto) as peso'))->first()->peso;
        //dd($registros);
        $listaTransportador = LancamentoSafra::listaTransportador();
        return view('admin.lacamento_lavoura.motoristas', compact('registros', 'listaTransportador'));
    }

    public function mapaProdutividade()
    {
        $produtividade = LancamentoSafra::mapaProdutividade();
        $totalColhido = LancamentoSafra::totalColhido();
        $totalColhidoCulutra = LancamentoSafra::totalColhidoCulutra();
        

        return view('admin.lacamento_lavoura.mapaProdutividade', compact('produtividade', 'totalColhido', 'totalColhidoCulutra'));
    }

    public function locacao(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');

        if ($search_term) {
            $options = DB::table('safras')->where('safras.status', '=', 'Ativa')
                ->leftJoin('locacao_talhaos', 'locacao_talhaos.safra_id', '=', 'safras.id')
                ->leftJoin('talhaos', 'talhaos.id', '=', 'locacao_talhaos.talhao_id')
                ->orderBy('talhaos.nome')
                ->where('talhaos.nome', 'LIKE', '%' . $search_term . '%')
                ->select('talhaos.id', 'talhaos.nome')
                ->groupBy('talhaos.id')
                ->where('talhaos.deleted_at', '=', null)
                ->paginate(1000000);
            return $options;
        } else {
            $options = DB::table('safras')->where('safras.status', '=', 'Ativa')
                ->leftJoin('locacao_talhaos', 'locacao_talhaos.safra_id', '=', 'safras.id')
                ->leftJoin('talhaos', 'talhaos.id', '=', 'locacao_talhaos.talhao_id')
                ->orderBy('talhaos.nome')
                ->select('talhaos.id', 'talhaos.nome')
                ->groupBy('talhaos.id')
                ->where('talhaos.deleted_at', '=', null)
                //->pluck('talhaos.nome','locacao_talhaos.id');
                ->paginate(1000000);
        }
        return $options;
    }

    public function controles($numControle, $numRomaneio)
    {
        $dados = [];
        $numControle = LancamentoSafra::where('safra_id', '=', 8)->where('num_controle', '=', $numControle)->first();
        if (isset($numControle)) {
            $dados['numControle'] = "Lançado";
        }
        $numRomaneio = LancamentoSafra::where('safra_id', '=', 8)->where('num_romaneio', '=', $numRomaneio)->first();
        if (isset($numRomaneio)) {
            $dados['numRomaneio'] = "Lançado";
        }

        //dd($dados);
        return $dados;
    }

    public function adiantamentoMotoristas(Request $request)
    {
        $dados = $request->all();
        //dd($dados);
        foreach ($dados['valor_pagamento'] as $key => $dado) {
            // dd($dados['tipoPagamento'][$key]);
            $fornecedor = Fornecedor::find($key);
            // dd($fornecedor);
            // Retira transforma a virgula em ponto
            $data = [];

            $data['fornecedor_id'] = $fornecedor->id;
            $data['data_pagamento'] = date('Y-m-d');
            $data['data_vencimento'] = date('Y-m-d');
            if (isset($dado)) {
                $data['valor_pagamento'] = str_replace('.', "", $dado);
                $data['valor_pagamento'] = str_replace(',', ".", $data['valor_pagamento']);
                $data['nome_fornecedor'] = $fornecedor->nome_banco;
                $data['cpf_cnpj'] = $fornecedor->cpf_cnpj;
                $data['nome_banco'] = $fornecedor->banco;
                $data['agencia'] = $fornecedor->agencia;
                $data['num_conta'] = $fornecedor->num_conta;
                $data['tipo_adiantamento'] = $dados['tipoPagamento'][$key];
                $data['safra_id'] = 8;
                $data['produtor_id'] = $dados['produtor_id'];
                // aqui
                //($data);
                $safraAtiva = Safra::where("status","=","Ativa")->first()->safra;
                $model = AdiantamentoMotorista::create($data);
                $tipoPagamento = ($dados['tipoPagamento'][$key] == 'DEPOSITO') ? 'TRANSFERÊNCIA' : 'CHEQUE';
                //dd($tipoPagamento);
                $conta = [
                    'numero_documento' => $model->id,
                    'fornecedor_id' =>  $fornecedor->id,
                    'centro_custo_id' => 13,
                    'data_documento' => date('Y-m-d'),
                    'data_vencimento' => date('Y-m-d'),
                    'descricao' => 'ADIANTAMENTO DE FRETE ' . $safraAtiva,
                    'valor' => $data['valor_pagamento'],
                    'tipo' => $tipoPagamento,
                    //'status' => 'APAGO',
                    'status' => 'RIBEIRÃO',
                    'produtor_id' => $dados['produtor_id'],
                ];

                

                LancamentoContaApagar::create($conta);
                $fornecedoresTeste[] = array(
                    'produtores' => 1, 'centro_custo' => 1, 'fornecedores' => $fornecedor->id,
                    'numero_documento' => $model->id, 'valor' =>  $data['valor_pagamento'],
                    'banco' => $data['nome_banco'], 'agencia' => $data['agencia'], 'op' => $model->op,
                    'conta' => $data['num_conta'], 'contato' => $fornecedor->razao_social,
                    'descricao' => 'ADIANTAMENTO DE FRETE ' . $safraAtiva , 'cpf_cnpj' => $fornecedor->cpf_cnpj, 
                    'pix' => $fornecedor->pix, 'tipo' => $tipoPagamento,
                );
            }
        }
        $transferencias = [
            'data_lancamento' => Carbon::now(),
            'descricao_lancamento' => 'ADIANTAMENTO DE FRETE ' . $safraAtiva,
            'fornecedores' => $fornecedoresTeste,
        ];
        //dd($transferencias);
        Transferencia::create($transferencias);
        //dd(html_entity_decode(json_encode($fornecedoresTeste)));
        // show a success message
        \Alert::success(trans('Lançanetos Cadastrads com Sucesso'))->flash();

        //return redirect()->route('admin/adiantamentomotorista');
        return redirect()->route('adiantamentomotorista.index');
    }

    public function relatorioMotoristaSafra()
    {
        dd(LancamentoSafra::relatorioMotoristas());
        $relatorios = LancamentoSafra::relatorioMotoristas();
        return view('relatorios.motoristas.safra', compact('relatorios'));
    }

    public function update(Request $request)
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();

        $idFornecedor = Motorista::find($request['motorista_id'])->fornecedor_id;
        //dd($idFornecedor);
        $model = LancamentoSafra::find($data['id']);
        $data['motorista_fornecedor_id'] = $idFornecedor;
        $model->update($data);

        // show a success message
        \Alert::success(trans('Lançamento Alterado com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }
}
