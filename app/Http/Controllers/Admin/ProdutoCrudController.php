<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProdutoRequest;
use App\Models\SubGrupoProduto;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class ProdutoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProdutoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Produto::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/produto');
        CRUD::setEntityNameStrings('Produto', 'Produtos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::enableExportButtons();
        CRUD::addClause('where','grupo_produto_id', '=', '2');
        CRUD::orderBy('nome');
        CRUD::column('grupo_produto_id')
            ->label('Grupo')
            ->type('select')
            ->entity('GrupoProduto')
            ->attribute('nome')
            ->size(3);

        CRUD::column('sub_grupo_produto_id')
            ->label('Sub Grupo')
            ->type('select')
            ->entity('SubGrupoProduto')
            ->attribute('nome')
            ->size(3);

        CRUD::column('nome');
        CRUD::column('estoque')->size(2)
        ->type('number')
            ->decimals(3)
            ->dec_point(',')
            ->thousands_sep('.');
        CRUD::column('finalidade')->type('enum');
        CRUD::column('fator_conversao')->label('Conversão');
        CRUD::column('status')->type('enum');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProdutoRequest::class);

        CRUD::field('grupo_produto_id')
            ->label('Grupo')
            ->type('select2')
            ->entity('grupoProduto')
            ->model('App\Models\GrupoProduto')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->orderBy('nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('sub_grupo_produto_id')
            ->label('Sub Grupo')
            ->type('select2_from_ajax')
            ->entity('subGrupoProduto')
            ->attribute('nome')
            ->data_source('subgrupo')
            ->placeholder('Sub Grupo')
            ->include_all_form_fields(true)
            ->minimum_input_length(0)
            ->dependencies(['grupo_produto_id'])
            ->method('post')
            ->model('App\Models\SubGrupoProduto')
            ->size(3);
        CRUD::field('nome')->label('Produto.:')->size(3);
        CRUD::field('estoque')->label('Estoque.:')->size(3)->attributes(['class' => 'form-control areas']);
        CRUD::field('finalidade')->label('Finalidade.:')->size(3)->type('enum');
        CRUD::field('localizacao_estoque')->label('Localização Estoque.:')->size(3);
        CRUD::field('mcm')->label('Ncm.:')->size(3);
        CRUD::field('qtn_minima')->label('Qtn Minima.:')->size(3);
        CRUD::field('fator_conversao')->label('Fator Conversão.:')->size(3);
        CRUD::field('status')->label('Status.:')->size(3)->type('enum');
        CRUD::field('unidade')->label('Unidade.:')->size(3);
        CRUD::field('valor_unitario')->label('Valor Unitrio.:')->size(3)->attributes(['class' => 'form-control valores']);
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
    public function subgrupo(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');

        if ($search_term) {
            $options = SubGrupoProduto::where('nome', 'LIKE', '%' . $search_term . '%')->orderBy('nome')->paginate(1000000);
        } else {
            $options = SubGrupoProduto::where('grupo_produto_id', $form['grupo_produto_id'])->orderBy('nome')->paginate(1000000);
        }
        return $options;
    }
}
