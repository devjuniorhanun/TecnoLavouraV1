<?php

namespace App\Http\Controllers\Admin\Cadastro;

use App\Http\Requests\LancamentoCombustivelRequest;
use App\Models\Cadastro\LancamentoCombustivel;
use App\Models\Cadastro\PostoCombustivel;
use App\Models\Cadastro\PostoProduto;
use App\Models\Frota;
use App\Models\Produto;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LancamentoCombustivelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LancamentoCombustivelCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Cadastro\LancamentoCombustivel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lancamentocombustivel');
        CRUD::setEntityNameStrings('Lançamento Combustivel', 'Lançamentos Combustiveis');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('frota_id')->type('select')
            ->label('Frota')
            ->entity('frota')
            ->model('\App\Models\Frota')
            ->attribute('nome');

        CRUD::column('created_at');
        CRUD::column('data_abastecimento');
        CRUD::column('deleted_at');
        CRUD::column('horimetro');
        CRUD::column('posto_combustivel_id');
        CRUD::column('produtividade');
        CRUD::column('produto_id');
        CRUD::column('quantidade');
        CRUD::column('romaneio');
        CRUD::column('tenant_id');
        CRUD::column('updated_at');
        CRUD::column('user_id');
        CRUD::column('uuid');

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
        CRUD::setValidation(LancamentoCombustivelRequest::class);

        CRUD::field('frota_id')
        ->attributes(['id' => 'frota_id'])
            ->label('Frota.:')
            ->type('select2')
            ->attribute('nome')
            ->model('\App\Models\Frota')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('posto_combustivel_id')
        ->attributes(['id' => 'posto_combustivel_id'])
            ->label('Posto.:')
            ->type('select2')
            ->attribute('nome')
            ->model('\App\Models\Cadastro\PostoCombustivel')
            ->options(function ($query) {
                return $query->where('status', '=', 'ABERTO')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('produto_id')
        ->attributes(['id' => 'produto_id'])
            ->label('Produto.:')
            ->type('select2')
            ->attribute('nome')
            ->model('\App\Models\Produto')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade', '=', 'Combustíveis')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('data_abastecimento')->size(3);
        CRUD::field('romaneio')->size(3);
        CRUD::field('horimetro')->size(3)->attributes(['id' => 'horimetro', 'class' => 'form-control']);
        CRUD::field('quantidade')->size(3)->attributes(['id' => 'quantidade', 'class' => 'form-control']);
        CRUD::field('produtividade')->size(3)->attributes(['id' => 'produtividade', 'class' => 'form-control desabilitado']);


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

    /**
     * Método estoque()
     * Responsavel para verificar se existe combustivel em estoque e no posto.
     * Pega o maior horimetro do veiculo para verificar a produtividade da frota
     * 
     */
    public function estoque($frotaId, $postoId, $produtoId, $quantidade, $horimetro)
    {
        $dados = [];
        $quantidade = doubleval($quantidade);
        //dd($quantidade);
        $estoqueCombustivel = Produto::find($produtoId)->first()->estoque; // Estoque do combustivel
        $postoEstoque = PostoProduto::where('posto_combustivel_id', '=', $postoId)
            ->where('produto_id', '=', $produtoId)->first()->estoque;
        //dd($postoEstoque);
        if (($estoqueCombustivel >= $quantidade) && ($postoEstoque >= $quantidade)) {
            //$dados['estoqueCombustivel'] = $estoqueCombustivel;
            $horimetroL = LancamentoCombustivel::where('frota_id', '=', $frotaId)->max('horimetro');
            $dados['produtividade'] = ($horimetro - $horimetroL) / $quantidade;
        } else {
            $dados['estoque'] = "Vazio";
        }
        return $dados;
    }
}
