<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FrotaRequest;
use App\Models\Frota;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FrotaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FrotaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Frota::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/frota');
        CRUD::setEntityNameStrings('Frota', 'Frotas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('grupo_frota_id')
        ->label('Grupo')
        ->type('select')
            ->entity('grupoFrota')
            ->attribute('nome')
            ->size(4);
        CRUD::column('nome')->label('Frota');
        CRUD::column('marca');
        CRUD::column('modelo');
        CRUD::column('ano');
        CRUD::column('chassi');
        CRUD::column('data_aquisicao');
        CRUD::column('valor_aquisicao');
        CRUD::column('volume_tanque');
        CRUD::column('combustivel');
        CRUD::column('tipo_marcacao');
        CRUD::column('medidor_inicial');
        CRUD::column('medidor_final');
        CRUD::column('observacao');
        CRUD::column('status');
        
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(FrotaRequest::class);

        CRUD::field('grupo_frota_id')
            ->type('select2')
            ->entity('grupoFrota')
            ->model('App\Models\GrupoFrota')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status','=', 'Ativo')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('nome')->label('Frota')->size(3);
        CRUD::field('marca')->size(3);
        CRUD::field('modelo')->size(3);
        CRUD::field('ano')->size(1);
        CRUD::field('chassi')->size(3);
        CRUD::field('data_aquisicao')->size(2)->label('Data Aquisição');
        CRUD::field('valor_aquisicao')->size(2)->label('Valor Aquisição')->attributes(['class' => 'form-control valores']);
        CRUD::field('volume_tanque')->size(2)->attributes(['class' => 'form-control volume']);
        CRUD::field('combustivel')->type('enum')->size(2)->label('Combustível');
        CRUD::field('tipo_marcacao')->type('enum')->size(3)->label('Tipo Marcação');
        CRUD::field('medidor_inicial')->size(2)->attributes(['class' => 'form-control volume']);
        CRUD::field('medidor_final')->size(2)->attributes(['class' => 'form-control volume']);
        CRUD::field('observacao')->size(3)->label('Obervação');
        CRUD::field('status')->type('enum')->size(2);

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

        if (isset($data['valor_aquisicao'])) {
            $data['valor_aquisicao'] = str_replace('.', "", $data['valor_aquisicao']);
            $data['valor_aquisicao'] = str_replace(',', ".", $data['valor_aquisicao']);
        }

        if (isset($data['volume_tanque'])) {
            $data['volume_tanque'] = str_replace('.', "", $data['volume_tanque']);
            $data['volume_tanque'] = str_replace(',', ".", $data['volume_tanque']);
        }

        if (isset($data['medidor_inicial'])) {
            $data['medidor_inicial'] = str_replace('.', "", $data['medidor_inicial']);
            $data['medidor_inicial'] = str_replace(',', ".", $data['medidor_inicial']);
        }

        if (isset($data['medidor_final'])) {
            $data['medidor_final'] = str_replace('.', "", $data['medidor_final']);
            $data['medidor_final'] = str_replace(',', ".", $data['medidor_final']);
        }

        $model = Frota::create($data);

        // show a success message
        \Alert::success(trans('Frota Cadastrada com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();

        if (isset($data['valor_aquisicao'])) {
            $data['valor_aquisicao'] = str_replace('.', "", $data['valor_aquisicao']);
            $data['valor_aquisicao'] = str_replace(',', ".", $data['valor_aquisicao']);
        }

        if (isset($data['volume_tanque'])) {
            $data['volume_tanque'] = str_replace('.', "", $data['volume_tanque']);
            $data['volume_tanque'] = str_replace(',', ".", $data['volume_tanque']);
        }

        if (isset($data['medidor_inicial'])) {
            $data['medidor_inicial'] = str_replace('.', "", $data['medidor_inicial']);
            $data['medidor_inicial'] = str_replace(',', ".", $data['medidor_inicial']);
        }

        if (isset($data['medidor_final'])) {
            $data['medidor_final'] = str_replace('.', "", $data['medidor_final']);
            $data['medidor_final'] = str_replace(',', ".", $data['medidor_final']);
        }

        $model = Frota::find($data['id']);

        $model->update($data);

        // show a success message
        \Alert::success(trans('Frota Alterada com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }
}
