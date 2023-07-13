<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubGrupoProdutoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SubGrupoProdutoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubGrupoProdutoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\SubGrupoProduto::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/subgrupoproduto');
        CRUD::setEntityNameStrings('Sub Grupo Produto', 'Sub Grupo Produto');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('grupo_produto_id')
            ->type('select')
            ->entity('grupoProduto')
            ->attribute('nome');
        CRUD::column('nome');
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
        CRUD::setValidation(SubGrupoProdutoRequest::class);

        CRUD::field('grupo_produto_id')
        ->label('Grupo')
            ->type('select2')
            ->entity('subGrupoProdutos')
            ->model('App\Models\GrupoProduto')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->orderBy('nome', 'ASC')->get();
            })
            ->size(4);
            CRUD::field('nome')->label('Sub Grupo.:')->size(4);
            CRUD::field('status')->label('Status.:')->size(4)->type('enum');

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

        CRUD::column('grupo_produto_id')
            ->label('Grupo.:')
            ->type('select')
            ->entity('GrupoProduto')
            ->attribute('nome')
            ->size(4);
        CRUD::column('nome')->label('Sub Grupo.:')->size(4);
        CRUD::column('status')->label('Status')->size(4)->type('enum');
    }
}
