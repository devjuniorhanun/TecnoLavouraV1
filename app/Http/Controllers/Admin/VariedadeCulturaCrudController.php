<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VariedadeCulturaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class VariedadeCulturaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class VariedadeCulturaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\VariedadeCultura::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/variedadecultura');
        CRUD::setEntityNameStrings('Variedade Culturas', 'Variedade Culturas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('cultura_id')
            ->label('Cultura.:')
            ->type('select')
            ->entity('cultura')
            ->attribute('nome')
            ->model('App\Models\Cultura')
            ->size(4);
        CRUD::column('nome')->label('Variedade.:')->size(4);
        CRUD::column('tecnologia')->label('Tecnologia.:')->size(4);
        CRUD::column('ciclo')->label('Ciclo.:')->size(4);
        CRUD::column('status')->label('Status.:')->type('enum')->size(4);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(VariedadeCulturaRequest::class);

        CRUD::field('cultura_id')
            ->label('Cultura.:')
            ->type('select')
            ->entity('cultura')
            ->attribute('nome')
            ->model('App\Models\Cultura')
            ->size(4);
        CRUD::field('nome')->label('Variedade.:')->size(4);
        CRUD::field('tecnologia')->label('Tecnologia.:')->size(4);
        CRUD::field('ciclo')->label('Ciclo.:')->size(4);
        CRUD::field('status')->label('Status.:')->type('enum')->size(4);
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

        CRUD::column('cultura_id')
            ->label('Cultura')
            ->type('select')
            ->entity('cultura')
            ->attribute('nome')
            ->model('App\Models\Cultura')
            ->size(4);
        CRUD::column('nome')->label('Variedade')->size(4);
        CRUD::column('tecnologia')->label('Tecnologia')->size(4);
        CRUD::column('ciclo')->label('Ciclo')->size(4);
        CRUD::column('status')->label('Status')->type('enum')->size(4);
    }
}
