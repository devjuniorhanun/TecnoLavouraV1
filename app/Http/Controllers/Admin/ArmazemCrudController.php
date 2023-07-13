<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArmazemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArmazemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArmazemCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Armazem::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/armazem');
        CRUD::setEntityNameStrings('Armazén', 'Armazéns');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('fornecedor_id')->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('nome');
        CRUD::column('cidade');
        CRUD::column('percurso');
        CRUD::column('tipo');
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
        CRUD::setValidation(ArmazemRequest::class);

        CRUD::field('fornecedor_id')
            ->label('Fornecedor.:')
            ->type('select2')
            ->entity('fornecedor')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade', '=', 'ARMAZÉNS GERAIS')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('nome')->label('Nome.:')->size(3);
        CRUD::field('cidade')->label('Cidade.:')->size(3);
        CRUD::field('percurso')->label('Percuso.:')->size(3);
        CRUD::field('tipo')->size(3)->label('Tipo.:')->type('enum');
        CRUD::field('status')->size(3)->label('Status.:')->type('enum');

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

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column('fornecedor_id')->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('nome')->label('Nome');
        CRUD::column('cidade')->label('Cidade');
        CRUD::column('percurso')->label('Percuso');
        CRUD::column('tipo')->label('Tipo')->type('enum');
        CRUD::column('status')->label('Status')->type('enum');
    }
}
