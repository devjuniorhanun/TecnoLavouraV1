<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TalhaoRequest;
use App\Models\Talhao;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TalhaoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TalhaoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Talhao::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/talhao');
        CRUD::setEntityNameStrings('Talhão', 'Talhões');
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
        CRUD::column('fazenda_id')
            ->label('Fazenda.:')
            ->type('select')
            ->entity('Fazenda')
            ->attribute('nome')
            ->size(4);
        CRUD::column('nome')->label('Talhão.:');
        CRUD::column('area_total')
            ->label('Área Total.:')
            ->size(2)
            ->type('number')
            ->decimals(2)
            ->suffix(' ha')
            ->dec_point(',')
            ->thousands_sep('.');;
        CRUD::column('bloco')->label('Bloco.:');
        CRUD::column('status')->label('Status.:')->type('enum');

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
        CRUD::setValidation(TalhaoRequest::class);


        CRUD::field('fazenda_id')
            ->type('select2')
            ->entity('fazenda')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->orderBy('nome', 'ASC')->get();
            })
            ->size(4);

        CRUD::field('nome')->label('Talhão.:')->size(3);
        CRUD::field('area_total')->label('Área Total.:')->size(2)->attributes(['class' => 'form-control areas']);
        CRUD::field('bloco')->label('Bloco.:')->size(1);
        CRUD::field('status')->label('Status.:')->type('enum')->size(2);

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

        if (isset($data['area_total'])) {
            $data['area_total'] = str_replace('.', "", $data['area_total']);
            $data['area_total'] = str_replace(',', ".", $data['area_total']);
        }

        $model = Talhao::create($data);

        // show a success message
        \Alert::success(trans('Talhão Cadastrado com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();

        if (isset($data['area_total'])) {
            $data['area_total'] = str_replace('.', "", $data['area_total']);
            $data['area_total'] = str_replace(',', ".", $data['area_total']);
        }

        $model = Talhao::find($data['id']);

        $model->update($data);

        // show a success message
        \Alert::success(trans('Talhão Alterado com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column('fazenda_id')
            ->label('Fazenda')
            ->type('select')
            ->entity('Fazenda')
            ->attribute('nome')
            ->size(4);
        CRUD::column('nome')->label('Talhão');
        CRUD::column('area_total')
        ->label('Área Total')
        ->size(2)
            ->type('number')
            ->decimals(2)
            ->suffix(' ha')
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('bloco')->label('Bloco');
        CRUD::column('status')->label('Status')->type('enum');
    }
}
