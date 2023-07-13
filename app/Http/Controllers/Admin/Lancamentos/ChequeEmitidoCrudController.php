<?php

namespace App\Http\Controllers\Admin\Lancamentos;

use App\Http\Requests\Lancamentos\ChequeEmitidoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ChequeEmitidoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ChequeEmitidoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Lancamentos\ChequeEmitido::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lancamentos/cheque');
        CRUD::setEntityNameStrings('Cheque', 'Cheques Emitidos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->enableExportButtons();
        CRUD::column('produtor_id')->label('Produtor.:')->type('select')
        ->entity('produtor')
        ->attribute('razao_social')->size(4);
        CRUD::column('data_lancamento')->label('Lançamento.:')->size(2)->type('datetime')->format('D/M/YYYY');
        CRUD::column('valor_lancamento')->label('Valor.:')->size(2)->type('number')
        ->prefix('R$ ')
        ->decimals(2)
        ->dec_point(',')
        ->thousands_sep('.');
        CRUD::column('para_quem')->label('Para Quem.:')->size(2);
        CRUD::column('nome_banco')->label('Banco.:')->size(2);
        CRUD::column('agencia')->label('Agência.:')->size(2);
        CRUD::column('num_conta')->label('Conta.:')->size(2);
        CRUD::column('num_cheque')->label('Cheque.:')->size(2);
        CRUD::column('descricao_lancamento')->label('Descrição.:')->size(2);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ChequeEmitidoRequest::class);

        CRUD::field('produtor_id')->label('Produtor.:')->type('select')
        ->entity('produtor')
        ->attribute('razao_social')->size(3);
        CRUD::field('data_lancamento')->label('Lançamento.:')->size(2);
        CRUD::field('valor_lancamento')->label('Valor.:')->size(2)->attributes(['class' => 'form-control valores']);
        CRUD::field('para_quem')->label('Para Quem.:')->size(2);
        CRUD::field('nome_banco')->label('Banco.:')->size(2);
        CRUD::field('agencia')->label('Agência.:')->size(2);
        CRUD::field('num_conta')->label('Conta.:')->size(2);
        CRUD::field('num_cheque')->label('Cheque.:')->size(2);
        CRUD::field('descricao_lancamento')->label('Descrição.:')->size(2);
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
