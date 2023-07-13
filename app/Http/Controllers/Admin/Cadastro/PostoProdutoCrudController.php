<?php

namespace App\Http\Controllers\Admin\Cadastro;

use App\Http\Requests\PostoProdutoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostoProdutoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostoProdutoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastro\PostoProduto::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/postoproduto');
        CRUD::setEntityNameStrings('Posto Produto', 'Posto Produtos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('posto_combustivel_id')->type('select')
            ->label('Posto')
            ->entity('postoCombustivel')
            ->model('\App\Models\Cadastro\PostoCombustivel')
            ->attribute('nome');

        CRUD::column('produto_id')->type('select')
            ->label('Produto')
            ->entity('produto')
            ->model('\App\Models\Produto')
            ->attribute('nome');
        CRUD::column('estoque')->label('Estoque.:');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PostoProdutoRequest::class);

        CRUD::field('posto_combustivel_id')
            ->label('Posto.:')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Cadastro\PostoCombustivel')
            ->options(function ($query) {
                return $query->where('status', '=', 'ABERTO')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('produto_id')
            ->label('Produto.:')
            ->type('select2')
            ->attribute('nome')
            ->model('\App\Models\Produto')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade', '=', 'Combustíveis')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('estoque')->label('Estoque.:')->size(3);
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
