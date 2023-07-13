<?php

namespace App\Http\Controllers\Admin\Cadastro;

use App\Http\Requests\PostoTransferenciaRequest;
use App\Models\Cadastro\PostoCombustivel;
use App\Models\Cadastro\PostoProduto;
use App\Models\Cadastro\PostoTransferencia;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

/**
 * Class PostoTransferenciaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostoTransferenciaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastro\PostoTransferencia::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/postotransferencia');
        CRUD::setEntityNameStrings('Transferência Posto', 'Transferências Postos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->denyAccess('delete');
        $this->crud->denyAccess('update');
        //$this->crud->allowAccess('show');
        // dd(backpack_user()->id); // Pega os dados do Usuarios
        CRUD::column('posto_combustivel_id')->type('select')
            ->label('Principal')
            ->entity('postoCombustivel')
            ->model('\App\Models\Cadastro\PostoCombustivel')
            ->attribute('nome');

            CRUD::column('posto_segundario_id')->type('select')
            ->label('Comboio')
            ->entity('postoCombustivelCombio')
            ->model('\App\Models\Cadastro\PostoCombustivel')
            ->attribute('nome');

        CRUD::column('produto_id')->type('select')
            ->label('Produto')
            ->entity('produto')
            ->model('\App\Models\Produto')
            ->attribute('nome');
        CRUD::column('qtn_estoque')->label('Estoque');

        CRUD::column('user_id')->type('select')
            ->label('Usuário')
            ->entity('user')
            ->model('\App\Models\User')
            ->attribute('name');

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
        CRUD::setValidation(PostoTransferenciaRequest::class);

        CRUD::field('posto_combustivel_id')
            ->label('Principal.:')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Cadastro\PostoCombustivel')
            ->options(function ($query) {
                return $query->where('status', '=', 'ABERTO')->where('tipo_posto', '=', 'PRINCIPAL')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('posto_segundario_id')
            ->label('Segundario.:')
            ->type('select2')
            ->attribute('nome')
            ->model('App\Models\Cadastro\PostoCombustivel')
            ->options(function ($query) {
                return $query->where('status', '=', 'ABERTO')->where('tipo_posto', '=', 'COMBOIO')->orderBy('nome', 'ASC')->get();
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
        CRUD::field('qtn_estoque')->label('Transferência')->size(3);


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

    public function store()
    {

        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();
        // Pega a quantidade de combustivel do posto principal
        $postoP = PostoProduto::where('posto_combustivel_id', '=', $data['posto_combustivel_id'])
            ->where('produto_id', '=', $data['produto_id'])->first();

        // Verificar se o estoque de combustivel e melhor ou igual a quantidade a ser transferida
        if (doubleval($postoP->estoque) >= doubleval($data['qtn_estoque'])) {
            // Retirar a quantidade transferida do posto principal
            $estoque['estoque'] = $postoP->estoque - $data['qtn_estoque'];
            $postoP->update($estoque);

            // Repasa a quantidade transferida para o posto comboio
            $postoS = PostoProduto::where('posto_combustivel_id', '=', $data['posto_segundario_id'])
                ->where('produto_id', '=', $data['produto_id'])->first();
            $estoqueS['estoque'] = $data['qtn_estoque'];
            $postoS->update($estoqueS);

            // Grava quem fez a transferencia do combustivel
            $data['user_id'] = backpack_user()->id;
            $data['posto_segundario_id'] = PostoCombustivel::find($data['posto_segundario_id'])->id;
            $model = PostoTransferencia::create($data);

            // show a success message
        \Alert::success(trans('Transferencia Concluida com Sucesso'))->flash();

        // save the redirect choice for next time
       // $this->crud->setSaveAction();

       return redirect()->route('postotransferencia', ['id' => $model->id]);
        }
        
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->denyAccess('delete');
        $this->crud->denyAccess('update');
        CRUD::column('posto_combustivel_id')->type('select')
            ->label('Principal')
            ->entity('postoCombustivel')
            ->model('\App\Models\Cadastro\PostoCombustivel')
            ->attribute('nome');

            CRUD::column('posto_segundario_id')->type('select')
            ->label('Comboio')
            ->entity('postoCombustivelCombio')
            ->model('\App\Models\Cadastro\PostoCombustivel')
            ->attribute('nome');

        CRUD::column('produto_id')->type('select')
            ->label('Produto')
            ->entity('produto')
            ->model('\App\Models\Produto')
            ->attribute('nome');
        CRUD::column('qtn_estoque')->label('Estoque');

        CRUD::column('user_id')->type('select')
            ->label('Usuário')
            ->entity('user')
            ->model('\App\Models\User')
            ->attribute('name');
    }
}
