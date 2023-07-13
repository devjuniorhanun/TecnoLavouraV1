<?php

namespace App\Http\Controllers\Admin\Lancamentos;

use App\Http\Requests\Lancamentos\CaixaRequest;
use App\Models\Lancamentos\Caixa;
use App\Models\Lancamentos\ControleCaixa;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CaixaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CaixaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Lancamentos\Caixa::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lancamentos/caixa');
        CRUD::setEntityNameStrings('Caixa', 'Lancamentos');
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
        CRUD::column('centro_custo_id')->type('select')
            ->entity('centroCusto')
            ->model('App\Models\CentroCusto')
            ->attribute('nome');
        CRUD::column('data_lancamento')->label('Lançamento.:')->size(4)->type('datetime')->format('D/M/YYYY');
        CRUD::column('tipo_pagamento')->label('Tipo.:')->size(4);
        CRUD::column('pagamento_para')->label('Responsável.:')->size(4);
        CRUD::column('valor_lancamento')->label('Valor.:')->size(4)->type('number')
        ->prefix('R$ ')
        ->decimals(2)
        ->dec_point(',')
        ->thousands_sep('.');
        CRUD::column('descricao_lancamento')->label('Descrição.:')->size(4);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CaixaRequest::class);
        // backpack_user()->id
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
        CRUD::field('data_lancamento')->label('Lançamento.:')->size(2);
        //CRUD::field('tipo_pagamento')->label('Tipo.:')->type('enum')->size(2);
        CRUD::field('pagamento_para')->label('Responsável.:')->size(2);
        CRUD::field('valor_lancamento')->label('Valor.:')->size(2)->attributes(['class' => 'form-control valores']);
        CRUD::field('descricao_lancamento')->label('Descrição.:')->size(2);
        CRUD::field('adiantamento')->label('Adiant.:')->type('enum')->size(1);
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

        $model = Caixa::create($data);
        $caixaValor = ControleCaixa::find(1);
        $valor = $caixaValor->valor;

        if($model->tipo_pagamento == 'SAIDA')
        {
            $valor = $valor - $model->valor_lancamento;
        } else {
            $valor = $valor + $model->valor_lancamento;
        }

        $caixaValor->update(['valor' => $valor]);



         // show a success message
         \Alert::success(trans('Caixa Lançado com Sucesso'))->flash();

         // save the redirect choice for next time
         $this->crud->setSaveAction();
 
         return $this->crud->performSaveAction($model->id);

    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();

        $model = Caixa::find($data['id']);
        $model->update($data);
        $caixaValor = ControleCaixa::find(1);
        $valor = $caixaValor->valor;

        if($model->tipo_pagamento == 'SAIDA')
        {
            $valor = $valor - $model->valor_lancamento;
        } else {
            $valor = $valor + $model->valor_lancamento;
        }

        $caixaValor->update(['valor' => $valor]);



         // show a success message
         \Alert::success(trans('Caixa Lançado com Sucesso'))->flash();

         // save the redirect choice for next time
         $this->crud->setSaveAction();
 
         return $this->crud->performSaveAction($model->id);
       
    }

    public function index()
    {
        $this->crud->hasAccessOrFail('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? mb_ucfirst($this->crud->entity_name_plural);
        //$this->data['colhido'] = LancamentoSafra::where('safra_id', '=', '2')->select(DB::raw('SUM(peso_bruto) as peso'))->first()->peso;
        return view('admin.lacamento_lavoura.index', $this->data);
    }

}
