<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MotoristaRequest;
use App\Models\Fornecedor;
use App\Models\Motorista;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Class MotoristaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MotoristaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Motorista::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/motorista');
        CRUD::setEntityNameStrings('Motorista', 'Motoristas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        /*$registros = DB::table('motoristasold')->get();
      // dd($registros);
        foreach($registros as $registro)
        {
            /*dd($registro);
            switch($registro->fornecedor_categoria_id){
                case 1: $finalidade = "TRANSPORTADOR"; break;
                case 2: $finalidade = "COLHEDOR"; break;
                case 3: $finalidade = "FUNCIONÁRIO"; break;
                case 4: $finalidade = "ARMAZÉNS GERAIS"; break;
                case 5: $finalidade = "GERAL"; break;
                case 6: $finalidade = "INSUMOS"; break;
            }
            //dd($finalidade);
            $date = [
                'fornecedor_id' => $registro->fornecedor_id,
                'nome' => $registro->nome,
                'cpf' => $registro->cpf,
                'tipo' => ($registro->tipo == 1)? "SAFRA" : "EMBARQUE",
                'celular' => $registro->celular,
                'placa' => $registro->placa,
                'placa_nome' => $registro->placa_nome,
                'status' => 'ATIVO',
                'cep' => $registro->cep,
                'estado' => $registro->estado,
                'cidade' => $registro->cidade,
                'bairro' => $registro->bairro,
                'endereco' => $registro->endereco,
                'complemento' => $registro->complemento,
                'numero' => $registro->numero,
                
            ];
           Motorista::create($date);
        }
       // dd($registros);*/
        CRUD::column('fornecedor_id')
            ->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('nome')->label('Motorista');
        CRUD::column('cpf');
        CRUD::column('placa');
        CRUD::column('tipo')->type('enum');
        CRUD::column('celular');
        CRUD::column('placa_nome');
        CRUD::column('cep');
        CRUD::column('estado');
        CRUD::column('cidade');
        CRUD::column('bairro');
        CRUD::column('endereco');
        CRUD::column('complemento');
        CRUD::column('numero');
        CRUD::column('status')->type('enum');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MotoristaRequest::class);

        CRUD::field('fornecedor_id')
            ->label('Fornecedor.:')
            ->type('select2')
            ->entity('fornecedor')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade', '=', 'TRANSPORTADOR')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('nome')->label('Motorista')->size(3);
        CRUD::field('cpf')->size(3)->attributes(['class' => 'form-control cpf']);
        CRUD::field('placa')->size(3)->attributes(['class' => 'form-control placa']);
        CRUD::field('tipo')->size(3)->type('enum');
        CRUD::field('celular')->size(3)->attributes(['class' => 'form-control celular']);;
        CRUD::field('cep')->label('Cep.:')->size(2)->attributes(['id' => 'cep']);
        CRUD::field('estado')->label('Estado.:')->size(1)->attributes(['id' => 'estado']);
        CRUD::field('cidade')->label('Cidade.:')->size(3)->attributes(['id' => 'cidade']);
        CRUD::field('bairro')->label('Bairro.:')->size(2)->attributes(['id' => 'bairro']);
        CRUD::field('endereco')->label('Endereço.:')->size(3)->attributes(['id' => 'endereco']);
        CRUD::field('complemento')->label('Complemento.:')->size(2);
        CRUD::field('numero')->label('Número.:')->size(2);
        CRUD::field('status')->size(3)->type('enum');

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
        $data['placa_nome'] = $data['placa'] . '-' . $data['nome'];

        $model = Motorista::create($data);
        // show a success message
        \Alert::success(trans('Motorista Cadastro(a) com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        $data = $request->all();
        $model = Motorista::find($request->id);
        $data['placa_nome'] = $data['placa'] . '-' . $data['nome'];

        $model->update($data);

        // show a success message
        \Alert::success(trans('Motorista Alterador(a) com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }

    public function contratosMotoristas()
    {
        $transportadores = Fornecedor::where('finalidade', '=', 'TRANSPORTADOR')->orderBy('razao_social')->get();
        //dd($transportadores);
        return view('contratos.motoristas.index', compact('transportadores'));
    }

    public function contratoMotorista(Request $request)
    {
        $date = $request->all();
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
        $mes = $mes_extenso[\Carbon\Carbon::parse(now())->format('m')];
        //$dia = 
        
        $data = [
            'transportadores' => Fornecedor::find($date['fornecedor']),
            'motoristas' => Motorista::where('fornecedor_id','=',$date['fornecedor'])->where('status','=','ATIVO')->get(),
            'dia' => \Carbon\Carbon::parse(now())->format('d') . " " . $mes . " " .\Carbon\Carbon::parse(now())->format('Y'),
        ];
        //dd($data['transportadores']);
        return $pdf = PDF::loadView('contratos.motoristas.contratoPdf', $data)->stream();
    }
}
