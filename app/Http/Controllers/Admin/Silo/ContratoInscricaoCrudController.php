<?php

namespace App\Http\Controllers\Admin\Silo;

use App\Http\Requests\ContratoInscricaoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContratoInscricaoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContratoInscricaoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Silo\ContratoInscricao::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contratoinscricao');
        CRUD::setEntityNameStrings('Contrato Inscrição', 'Contratos Inscrições');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('contrato_embarque_id')->type('select')
            ->label('Contrato')
            ->entity('contratoEmbarque')
            ->attribute('num_contrato')
            ->size(4);
        CRUD::column('inscricao_estadual_id')->type('select')
            ->label('Inscrição Estatual')
            ->model('App\Models\Silo\InscricaoEstadual')
            ->entity('inscricaoEstadual')
            ->attribute('inscricao')
            ->size(3);
        CRUD::column('qtn_contrato')->label('Qtn Grão');
        CRUD::column('status');


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
        CRUD::setValidation(ContratoInscricaoRequest::class);

        CRUD::field('contrato_embarque_id')->type('select')
            ->label('Contrato')
            ->model('App\Models\Silo\ContratoEmbarque')
            ->entity('contratoEmbarque')
            ->attribute('num_contrato')
            ->size(4);
        CRUD::field('inscricao_estadual_id')->type('select')
            ->label('Inscrição Estatual')
            ->model('App\Models\Silo\InscricaoEstadual')
            ->entity('inscricaoEstadual')
            ->attribute('inscricao')
            ->size(3);
        CRUD::field('qtn_contrato')->label('Qtn Grão')->size(2);
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
        CRUD::column('contrato_embarque_id')->type('select')
            ->label('Contrato')
            ->entity('contratoEmbarque')
            ->attribute('num_contrato')
            ->size(4);
        CRUD::column('inscricao_estadual_id')->type('select')
            ->label('Inscrição Estatual')
            ->model('App\Models\Silo\InscricaoEstadual')
            ->entity('inscricaoEstadual')
            ->attribute('inscricao')
            ->size(3);
        CRUD::column('qtn_contrato')->label('Qtn Grão')
            ->type('number')
            ->suffix(' Sc')
            //->decimals(2)
            //->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('status');
    }
}
