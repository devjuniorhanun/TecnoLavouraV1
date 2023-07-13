<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TenantRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TenantCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TenantCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Tenant::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tenant');
        CRUD::setEntityNameStrings('Empresa', 'Empresas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('nome')->label('Empresa');
        CRUD::column('cnpj');
        CRUD::column('email');
        CRUD::column('telefone');

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
        CRUD::setValidation(TenantRequest::class);

        CRUD::field('cnpj')
            ->size(3)
            ->label('Cpf / Cnpj.:')
            ->attributes(['class' => 'form-control cpfcnpj']);
        CRUD::field('inscricao')
            ->size(3)
            ->label('Rg / Inscrição.:');
        CRUD::field('nome')
            ->size(4)
            ->label('Nome.:');
        CRUD::field('status')
            ->size(2)
            ->type('enum');
        CRUD::field('url')
            ->size(4)
            ->label('Site.:');
        CRUD::field('email')
            ->size(4)
            ->label('Email.:');
        CRUD::field('telefone')
            ->size(4)
            ->label('Telefone.:')
            ->attributes(['class' => 'form-control telefone']);


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

        CRUD::column('cnpj')
            ->size(4)
            ->label('Cpf / Cnpj');
        CRUD::column('inscricao')
            ->size(4)
            ->label('Rg / Inscrição');
        CRUD::column('nome')
            ->size(4)
            ->label('Empresa');
        CRUD::column('url')
            ->size(4)
            ->label('Site');
        CRUD::column('email')
            ->size(4)
            ->label('Email');
        CRUD::column('telefone')
            ->size(4)
            ->label('Telefone');
    }
}
