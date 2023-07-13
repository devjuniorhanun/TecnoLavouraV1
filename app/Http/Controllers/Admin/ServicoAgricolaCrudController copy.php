<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServicoAgricolaRequest;
use App\Models\Produto;
use App\Models\ServicoAgricola;
use App\Models\Talhao;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ServicoAgricolaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServicoAgricolaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ServicoAgricola::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/servicoagricola');
        CRUD::setEntityNameStrings('Serviço Agrícola', 'Serviços Agrícolas');
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
        CRUD::column('num_os')->label('Nº OS');
        CRUD::column('safra_id')
            ->type('select')
            ->entity('safra')
            ->attribute('nome');
        CRUD::column('cultura_id')
            ->type('select')
            ->entity('cultura')
            ->attribute('nome');
        CRUD::column('talhao_id')
            ->label('Talhão')
            ->type('select')
            ->entity('talhao')
            ->attribute('nome');
        CRUD::column('tipo_operacao_agricula_id')
            ->label('Operação')
            ->type('select')
            ->entity('tipoOperacaoAgricula')
            ->attribute('nome');
        CRUD::column('data')->type('datetime')->format('D/M/YYYY');
        CRUD::column('volume_bomba');
        CRUD::column('vazao')->label('Vazão');
        CRUD::column('capacidade_bomba')->label('Capacidade Bomba');
        CRUD::column('bomba_recomendada')->label('Bomba Recomendada');
        CRUD::column('bomba_usada')->label('Bomba Usadas');
        CRUD::column('diferenca_bomba')->label('Diferença Bomba');
        CRUD::column('area')->label('Área')->type('number')
            ->decimals(2)
            ->suffix(' ha')
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('observacao')->label('Observações');
        CRUD::column('status')->type('enum');
        CRUD::addButtonFromModelFunction('line', 'open_ordem', 'openOrdem', 'beginning');
        CRUD::addButtonFromModelFunction('line', 'open_control', 'openControle', 'beginning');
        CRUD::button('delete')->remove();

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
        CRUD::setValidation(ServicoAgricolaRequest::class);
        CRUD::field('tipo_operacao_agricula_id')
            ->label('Operação Agrícula')
            ->type('select2')
            ->entity('tipoOperacaoAgricula')
            ->model('App\Models\TipoOperacaoAgricula')
            ->attribute('nome')
            ->attributes(['class' => 'form-control talhao'])
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderByDesc('id')->get();
            })
            ->size(3)->tab('Lançamentos');
        CRUD::field('safra_id')
            ->type('select2')
            ->entity('safra')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(3)->tab('Lançamentos');
        CRUD::field('cultura_id')
            ->type('select2')
            ->entity('cultura')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(2)->tab('Lançamentos');
        CRUD::field('talhao_id')
            ->label('Talhão')
            ->type('select2')
            ->entity('talhao')
            ->attribute('nome')
            ->attributes(['class' => 'form-control talhao', 'id' => 'talhao_id'])
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderBy('nome', 'ASC')->get();
            })
            ->size(2)->tab('Lançamentos');
        CRUD::field('num_os')->label('Nº Ordem Serviço')->size(2)->tab('Lançamentos');
        CRUD::field('data')->label('Data Aplicação')->size(2)->tab('Lançamentos');
        CRUD::field('volume_bomba')->label('Volume da Bomba')->value(2500)->size(2)->attributes(['id' => 'volume_bomba'])->tab('Lançamentos');
        CRUD::field('vazao')->label('Vazão Bomba')->value(100)->size(2)->attributes(['id' => 'vazao'])->tab('Lançamentos');
        CRUD::field('area')->label('Área')->size(2)->attributes(['class' => 'form-control desabilitado', 'id' => 'area'])->tab('Lançamentos');
        CRUD::field('capacidade_bomba')->label('Cap. Bomba')->size(2)->attributes(['class' => 'form-control desabilitado', 'id' => 'capacidade_bomba'])->tab('Lançamentos');
        CRUD::field('bomba_recomendada')->label('Bombas Reais')->size(2)->attributes(['class' => 'form-control desabilitado', 'id' => 'bomba_recomendada'])->tab('Lançamentos');
        CRUD::field('bomba_usada')->label('Total Bomba')->size(2)->attributes(['class' => 'form-control', 'id' => 'bomba_usada'])->tab('Lançamentos');
        CRUD::field('diferenca_bomba')->label('Diferença Bomba')->size(2)->attributes(['class' => 'form-control desabilitado', 'id' => 'diferenca_bomba'])->tab('Lançamentos');
        CRUD::field('observacao')->label('Observações')->size(3)->tab('Lançamentos');
        CRUD::field('status')->label('Status')->type('enum')->size(2)->tab('Lançamentos');
        CRUD::field('operadores')->type('repeatable')->tab('Operadores')->fields([
            [
                'name'    => 'operadores',
                'type'    => 'select2',
                'label'   => 'Operadores',
                'attribute' => 'nome',
                'entity' => 'operadorAgriculas',
                'model'             => 'App\Models\OperadorAgricula',
                'options'   => (function ($query) {
                    return $query->orderBy('nome')->get();
                }),
                'store_in'          => 'operadores',
                'fake'              => false,
                'wrapper' => ['class' => 'form-group volumes col-md-4'],
            ],
            [    // SELECT2
                'label'             => 'Função',
                'type'              => 'select2_from_array',
                'name'              => 'tipo_operador',
                'options'           => ['OPERADOR' => 'OPERADOR', 'TANQUEIRO' => 'TANQUEIRO'],
                'tab'               => 'Operadores',
                'store_in'          => 'operadores',
                'fake'              => false,
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
        ]);

        CRUD::field('produtos')->type('repeatable')->tab('Produtos')->fields([
            [    // SELECT2
                'label'             => 'Produto',
                'type'              => 'select2',
                'name'              => 'produtos',
                'attribute'         => 'nome',
                'model'             => "App\Models\Produto",
                'store_in'          => 'produtos',
                'options'   => (function ($query) {
                    return $query->where('finalidade', '=', 'Insumos')->orderBy('nome')->get();
                }),
                'fake'              => true,
                'wrapperAttributes' => ['class' => 'form-group col-md-4'],
            ],
            [
                'name'              => 'dose_estimada_hectare',
                'label'             => 'QTDE. Produto por Bomba',
                'store_in'          => 'produtos',
                'fake'              => true,
                'type'              => 'text',
                'tab'               => 'Produtos',
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-4',
                ],
            ],
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
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
        /*$number2 = 34.600;
$number3 = 15439.093564654;


        dd(round($number3, 3));*/
        $model = ServicoAgricola::create($data);

        foreach (json_decode($data['operadores']) as $operador) {
            $dados = [
                'servico_agricola_id' => $model->id,
                'operador_agricula_id' => $operador->operadores,
                'tipo_operador' => $operador->tipo_operador,

            ];
            $model->operadorAgriculas()->attach($model->id, $dados);
        }
        
        foreach (json_decode($data['produtos']) as $produto) {
           
            
            /*$dose = str_replace('.', "", $produto->dose_estimada_hectare);
            $dose = str_replace(',', ".", $dose) / $model->capacidade_bomba;
            $qtn_bomba = str_replace('.', "", $produto->dose_estimada_hectare);
            $qtn_bomba = str_replace(',', ".", $qtn_bomba);
           /* if($produto->produtos == 31){
                dd($dose);
            }*
            //dd($dose);
            $doseReal = $dose;
            $qtnRecomedada = $dose * $model->capacidade_bomba * $model->bomba_recomendada;
            $qtnReal = $qtnRecomedada;
            if (isset($data['bomba_usada'])) {
                $qtnReal = $dose * $model->capacidade_bomba * $model->bomba_usada;
                $doseReal = $qtnReal / $model->area;

            }*/
            $qtnBomba = str_replace('.', "", $produto->dose_estimada_hectare);
            $qtnBomba = str_replace(',', ".", $qtnBomba);

            $dose = round(($qtnBomba / $model->capacidade_bomba),3);
            $doseReal = $dose;
            $qtnRecomedada = round(($qtnBomba * $model->bomba_recomendada),3);
            $qtnReal = $qtnRecomedada;

            if (isset($data['bomba_usada'])) {
                $doseReal = round(($qtnBomba / $model->bomba_usada),3);
                $qtnReal = round(($qtnBomba * $model->bomba_usada),3);
            }
            
            $dados = [
                'safra_id' => $data['safra_id'],
                'cultura_id' => $data['cultura_id'],
                'talhao_id' => $data['talhao_id'],
                'servico_agricola_id' => $model->id,
                'tipo_operacao_agricula_id' => $data['tipo_operacao_agricula_id'],
                'produto_id' => $produto->produtos,
                'dosagem' => $dose,
                'quantidade' => round($qtnRecomedada, 3),
                'dosagem_real' => $doseReal,
                'quantidade_real' => $qtnReal,
                'qtn_bomba' => $qtnBomba,
            ];

            $model->produtoss()->attach($model->id, $dados);
            $estoque = Produto::find($produto->produtos); // Recebe o registro do produto
            //$qtnRetirada = ceil($dose / $estoque->fator_conversao); // Dose Divide pelo fator de conversao
            //$qtnRetirada = $qtnRetirada * $estoque->fator_conversao; // Quantidade a ser retirada
            //$quantidade = $estoque->estoque - $qtnRetirada; // Quantidade menos estoque
            $qtnEstoque = doubleval($estoque->estoque - $qtnReal); // Quantidade menos estoque
            $estoque->update(['estoque' => $qtnEstoque]); // Salva a retirada
        }

        // show a success message
        \Alert::success(trans('Operação Cadastrada com Sucesso'))->flash();

        // save the redirect choice for next time
        // $this->crud->setSaveAction();

        // return $this->crud->performSaveAction($model->id);
        //return view('admin.servidos_agricola.servicos',compact('registros','listaColhedor'));
        return $this->crud->performSaveAction($model->id);
    }

    public function areaTalhao($idTalhao)
    {
        $area_total =  Talhao::find($idTalhao)->area_total;
        return $area_total;
    }

    public function servico($id)
    {
        return view('admin.servidos_agricola.servicos');
    }

    public function ordem($idServico)
    {
        $servico = ServicoAgricola::find($idServico);
        return view('admin.servidos_agricola.servicos',compact('servico'));
    }

    public function produtos($idServico)
    {
        $produtos = DB::table('produto_servico_agricola')
        ->where('produto_servico_agricola.servico_agricola_id','=',$idServico)
        ->join('produtos','produtos.id','produto_servico_agricola.produto_id')
        ->get();
        $servico = ServicoAgricola::find($idServico);
        //dd($produtos);

        return view('admin.servidos_agricola.produtos',compact('produtos','servico'));
    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        $request = $this->crud->validateRequest();
        $date = $request->all();
        //dd(CRUD::getModel());
        $model = CRUD::getModel()::find($request->id);
        //dd($model);
       /* if(($date['bomba_usada'] != $model->bomba_recomendada) && (isset($date['bomba_usada']))){
            dd("bomdas diferenes");
        }
        dd($date['bomba_usada']);*/
        if($date['bomba_usada'] != $model->bomba_usada && (isset($date['bomba_usada'])))
        {
            if($date['bomba_usada'] != $model->bomba_recomendada)
            {
                if($date['bomba_usada'] > $model->bomba_recomendada) {
                    dd('Vamos tirar do Estoque');
                } else if($date['bomba_usada'] < $model->bomba_recomendada) {
                  //dd($model->produtoss());
                   foreach($model->produtoss() as $produto){
                       //dd($produto);
                   }
                    dd('Vamos colocar do Estoque');
                }
            } else {
                dd("Bombas Iguais");
            }
        }
        

        //dd($date);

    }

    public function show($idServico)
    {
        $servico = ServicoAgricola::find($idServico);
        return view('admin.servidos_agricola.os',compact('servico'));
    }

}
