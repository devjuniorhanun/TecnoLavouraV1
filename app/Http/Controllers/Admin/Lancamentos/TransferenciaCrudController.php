<?php

namespace App\Http\Controllers\Admin\Lancamentos;

use App\Http\Requests\Lancamentos\TransferenciaRequest;
use App\Models\Fornecedor;
use App\Models\LancamentoContaApagar;
use App\Models\Lancamentos\Transferencia;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

/**
 * Class TransferenciaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransferenciaCrudController extends CrudController
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
        CRUD::setModel(Transferencia::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lancamentos/transferencia');
        CRUD::setEntityNameStrings('Transferência', 'Transferências');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('data_lancamento')->label('Data Lançamento.:')->type('datetime')->format('DD/MM/YYYY');
       // CRUD::addButtonFromModelFunction('line', 'open_ordem', 'openOrdem', 'beginning');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TransferenciaRequest::class);
        CRUD::field('data_lancamento')->size(3)->label('Data.:');
        //CRUD::field('descricao_lancamento')->size(3)->label('Descrição Pagamento.:');

        CRUD::field('fornecedores')->type('repeatable')->fields([
            [
                'name'    => 'produtores',
                'type'    => 'select2',
                'label'   => 'Produtores',
                'attribute' => 'razao_social',
                'entity' => 'produtores',
                'model'             => 'App\Models\Produtor',
                'options'   => (function ($query) {
                    return $query->orderBy('razao_social')->get();
                }),
                'store_in'          => 'produtores',
                'fake'              => false,
                'wrapper' => ['class' => 'form-group volumes col-md-3'],
            ],
            [
                'name'    => 'centro_custo',
                'type'    => 'select2',
                'label'   => 'Centro custo',
                'attribute' => 'nome',
                'entity' => 'centroCusto',
                'model'             => 'App\Models\CentroCusto',
                'options'   => (function ($query) {
                    return $query->orderBy('nome')->get();
                }),
                'store_in'          => 'centroCusto',
                'fake'              => false,
                'wrapper' => ['class' => 'form-group volumes col-md-3'],
            ],
            [
                'name'    => 'fornecedores',
                'type'    => 'select2',
                'label'   => 'Fornecedores',
                'attribute' => 'razao_social',
                'entity' => 'fornecedor',
                'model'             => 'App\Models\Fornecedor',
                'options'   => (function ($query) {
                    return $query->orderBy('razao_social')->get();
                }),
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapper' => ['class' => 'form-group volumes col-md-3'],
            ],
            [    // TYPE
                'label'             => 'Cpf / Cnpj',
                'type'              => 'text',
                'name'              => 'cpf_cnpj',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Número',
                'type'              => 'text',
                'name'              => 'numero_documento',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Valor',
                'type'              => 'text',
                'name'              => 'valor',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Banco.:',
                'type'              => 'text',
                'name'              => 'banco',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Agencia.:',
                'type'              => 'text',
                'name'              => 'agencia',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Op.:',
                'type'              => 'text',
                'name'              => 'op',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-1'],
            ],
            [    // TYPE
                'label'             => 'Tipo Conta.:',
                'type'              => 'select2_from_array',
                'name'              => 'tipoConta',
                'options'           => ['CORRENTE' => 'CORRENTE', 'POUPANÇA' => 'POUPANÇA'],
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Conta.:',
                'type'              => 'text',
                'name'              => 'conta',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Contato.:',
                'type'              => 'text',
                'name'              => 'contato',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Descrição Pagamento.:',
                'type'              => 'textarea',
                'name'              => 'descricao',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Pix.:',
                'type'              => 'text',
                'name'              => 'pix',
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],
            [    // TYPE
                'label'             => 'Status.:',
                'type'              => 'select2_from_array',
                'name'              => 'status',
                'options'           => ['RIBEIRÃO' => 'RIBEIRÃO', 'COMÉRCIO' => 'COMÉRCIO'],
                'store_in'          => 'fornecedores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-2'],
            ],

            
            
        ]);
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

    public function show($idTransferencia)
    {
        //dd($idTransferencia);
        $transferencias = Transferencia::find($idTransferencia);
        //dd($transferencias);
        return view('financeiro.transferencias.index', compact('transferencias'));
    }

    public function transferencia($idTransferencia)
    {
        $transferencias = Transferencia::find($idTransferencia);
        //dd($transferencias);
        return view('financeiro.transferencias.recibo', compact('transferencias'));
    }

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();
        $dadoTransferencia = array();
        foreach (json_decode($data['fornecedores']) as $key => $fornecedor) {
            $forne = Fornecedor::find($fornecedor->fornecedores);
            //--
            if (mb_strpos($fornecedor->valor, ',') !== false) {
                $valor = Str::replace('.', "", $fornecedor->valor);
                $valor = Str::replace(',', ".", $valor);
            } else {
                $valor = $fornecedor->valor;
            }
            //--
            $dadoTransferencia[]  = [
                'produtores' => $fornecedor->produtores,
                'centro_custo' => $fornecedor->centro_custo,
                'fornecedores' => $fornecedor->fornecedores,
                'cpf_cnpj' => $forne->cpf_cnpj,
                'numero_documento' => $key,                
                'valor' => $valor,
                'banco' => $forne->banco,
                'agencia' => $forne->agencia,
                'op' => $forne->operacao,
                'tipoConta' => $forne->tipo_conta,
                'conta' => $forne->num_conta,
                'contato' => $forne->nome_banco,
                'descricao' => $fornecedor->descricao,
                'pix' => $forne->pix,
                'status' => 'RIBEIRÃO',
            ];           

        }
       $data['fornecedores'] = json_encode($dadoTransferencia);
        $model = Transferencia::create($data);
        foreach (json_decode($data['fornecedores']) as $fornecedor) {
            // Tenho que criar o campo produtores no lancamento de contas
            // Criar um campo para transferencia no lancamento de contas
            if (mb_strpos($fornecedor->valor, ',') !== false) {
                $valor = Str::replace('.', "", $fornecedor->valor);
                $valor = Str::replace(',', ".", $valor);
            } else {
                $valor = $fornecedor->valor;
            }
            $modelConta = [
                'centro_custo_id' => $fornecedor->centro_custo,
                'fornecedor_id' => $fornecedor->fornecedores,
                'numero_documento' => $fornecedor->numero_documento,
                'data_documento' => $model->data_lancamento,
                'data_vencimento' => $model->data_lancamento,
                'descricao' => $fornecedor->descricao,
                'valor' => $valor,
                'tipo' => "TRANSFERÊNCIA",
                'status' => $fornecedor->status,
                'transferencia_id' => $model->id,
                'produtor_id' => $fornecedor->produtores
            ];

            LancamentoContaApagar::create($modelConta);

        }
        return redirect()->route('lancamentos/transferencia.edit',[$model->id]);

    }

    /*
    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();
        //dd($data['id']);
        $dadoTransferencia = array();
        foreach (json_decode($data['fornecedores']) as $key => $fornecedor) {
            $forne = Fornecedor::find($fornecedor->fornecedores);
            $dadoTransferencia[]  = [
                'produtores' => $fornecedor->produtores,
                'centro_custo' => $fornecedor->centro_custo,
                'fornecedores' => $fornecedor->fornecedores,
                'cpf_cnpj' => $forne->cpf_cnpj,
                'numero_documento' => $key,
                'valor' => $fornecedor->valor,
                'banco' => $forne->banco,
                'agencia' => $forne->agencia,
                'op' => $forne->operacao,
                'tipoConta' => $forne->tipo_conta,
                'conta' => $forne->num_conta,
                'contato' => $forne->nome_banco,
                'descricao' => $fornecedor->descricao,
                'pix' => $forne->pix,
                'status' => 'RIBEIRÃO',
            ];           

        }
       $data['fornecedores'] = json_encode($dadoTransferencia);
        $model = Transferencia::create($data);
        foreach (json_decode($data['fornecedores']) as $fornecedor) {
            // Tenho que criar o campo produtores no lancamento de contas
            // Criar um campo para transferencia no lancamento de contas
            if (mb_strpos($fornecedor->valor, ',') !== false) {
                $valor = Str::replace('.', "", $fornecedor->valor);
                $valor = Str::replace(',', ".", $valor);
            }
            $modelConta = [
                'centro_custo_id' => $fornecedor->centro_custo,
                'fornecedor_id' => $fornecedor->fornecedores,
                'numero_documento' => $fornecedor->numero_documento,
                'data_documento' => $model->data_lancamento,
                'data_vencimento' => $model->data_lancamento,
                'descricao' => $fornecedor->descricao,
                'valor' => $fornecedor->valor,
                'tipo' => "TRANSFERÊNCIA",
                'status' => $fornecedor->status,
                'transferencia_id' => $model->id,
                'produtor_id' => $fornecedor->produtores
            ];

            LancamentoContaApagar::create($modelConta);

        }
        return redirect()->route('lancamentos/transferencia.edit',[$model->id]);

    }*/

    public function transferenciaDoDia(Request $request)
    {
        // Registro Filtros
        $date = $request->all();
        
        $dataInicial = (isset($date['dataInicial'])) ? $date['dataInicial'] : $dataInicial = Carbon::now()->format('Y-m-d');
        $dataFinal = (isset($date['dataFinal'])) ? $date['dataFinal'] : '';

        //dd($dataInicial);
        if((isset($date['dataInicial'])))
        {
            //dd($date);
            $transferencias = Transferencia::where('data_lancamento', '>=', $dataInicial)
            ->where('data_lancamento', '<=', $dataFinal)->get();
        } else {
            $transferencias = Transferencia::where('data_lancamento', '=',$dataInicial)->get();
        }
        

        //dd($transferencias);
        
        return view('financeiro.transferencias.dia',compact('transferencias') );
       // dd('transferenciaDoDia');
    }
}
