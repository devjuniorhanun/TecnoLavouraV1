<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SafraRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SafraCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SafraCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Safra::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/safra');
        CRUD::setEntityNameStrings('Safra', 'Safras');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
//        $this->addCustomCrudFilters();
        CRUD::column('nome')->label('Safra.:');
        CRUD::column('data_inicio')->label('Inicio.:')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('data_final')->label('Final.:')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('status')->label('Status.:')->size(3)->type('enum');

        //CRUD::enableDetailsRow();

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
        CRUD::setValidation(SafraRequest::class);

        CRUD::field('nome')->label('Safra.:')->size(3);
        CRUD::field('data_inicio')->label('Inicio.:')->size(3);
        CRUD::field('data_final')->label('Final.:')->size(3);
        CRUD::field('status')->label('Status.:')->size(3)->type('enum');

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

        CRUD::column('nome')->label('Safra')->size(4);
        CRUD::column('data_inicio')->label('Inicio')->type('datetime')->format('DD/MM/YYYY')->size(4);
        CRUD::column('data_final')->label('Final')->type('datetime')->format('DD/MM/YYYY')->size(4);
    }

    /*protected function addCustomCrudFilters()
    {
        CRUD::filter('nome')
            ->type('text')
            ->label('Safra')
            ->whenActive(function ($value) {
                CRUD::addClause('where', 'nome', 'LIKE', "%$value%");
            });
        CRUD::filter('data_inicio')
            ->type('date')
            ->label('Inicio')
            ->whenActive(function ($value) {
                CRUD::addClause('where', 'data_inicio', '=', $value);
            });
        CRUD::filter('data_final')
            ->type('date')
            ->label('Final')
            ->whenActive(function ($value) {
                CRUD::addClause('where', 'data_final', '=', $value);
            });
    }*/
}
