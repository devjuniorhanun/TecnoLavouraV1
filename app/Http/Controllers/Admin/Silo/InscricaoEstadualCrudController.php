<?php

namespace App\Http\Controllers\Admin\Silo;

use App\Http\Requests\InscricaoEstadualRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InscricaoEstadualCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InscricaoEstadualCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Silo\InscricaoEstadual::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/inscricaoestadual');
        CRUD::setEntityNameStrings('Inscrição Estadual', 'Inscrições Estaduais');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('proprietario_id')->type('select')
            ->entity('Proprietario')
            ->attribute('nome_fantasia');
        CRUD::column('fazenda_id')->type('select')
            ->entity('Fazenda')
            ->attribute('nome');
        CRUD::column('inscricao')->label('Inscrição');
        CRUD::column('status')->type('emum');

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
        CRUD::setValidation(InscricaoEstadualRequest::class);

        CRUD::field('proprietario_id')
            ->label('Proprietário.:')
            ->type('select2')
            ->attribute('nome_fantasia')
            ->model('App\Models\Proprietario')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->where('tipo_pagamento', '=', 'Depósito')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(3);
            CRUD::field('fazenda_id')
            ->label('Fazendas.:')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Fazenda')
            ->default(0)
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(4);
        CRUD::field('inscricao')->label('Inscrição')->size(3)->attributes(['class' => 'form-control inscricao']);
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
}
