<?php

namespace App\Http\Controllers\Admin\Silo;

use App\Http\Requests\ContratoEmbarqueRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContratoEmbarqueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContratoEmbarqueCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Silo\ContratoEmbarque::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contratoembarque');
        CRUD::setEntityNameStrings('Contrato Embarque', 'Contratos Embarques');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('safra_id')->type('select')
            ->entity('Safra')
            ->attribute('nome')
            ->size(4);
        CRUD::column('cultura_id')->type('select')
            ->entity('Cultura')
            ->attribute('nome')
            ->size(4);
        CRUD::column('fornecedor_id')->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('num_contrato')->label('Núm Contrato');
        CRUD::column('status')->type('enum');

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
        CRUD::setValidation(ContratoEmbarqueRequest::class);

        CRUD::field('safra_id')
            ->type('select2')
            ->entity('safra')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('cultura_id')
            ->type('select2')
            ->entity('cultura')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(2);
        CRUD::field('fornecedor_id')
            ->type('select2')
            ->entity('fornecedor')
            ->attribute('nome_fantasia')
            //->model('App\Models\CentroCusto')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade', '=', 'ARMAZÉNS GERAIS')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('num_contrato')->label('Núm Contrato')->size(2);
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

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column('safra_id')->type('select')
            ->entity('Safra')
            ->attribute('nome')
            ->size(4);

        CRUD::column('cultura_id')->type('select')
            ->entity('Cultura')
            ->attribute('nome')
            ->size(4);

        CRUD::column('fornecedor_id')->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('num_contrato')->label('Núm Contrato');
    }
}
