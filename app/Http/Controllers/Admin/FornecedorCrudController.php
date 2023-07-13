<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FornecedorRequest;
use App\Models\Fornecedor;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


/**
 * Class FornecedorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FornecedorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Fornecedor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/fornecedor');
        CRUD::setEntityNameStrings('Fornecedor', 'Fornecedores');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        
        CRUD::column('razao_social')->label('Razão Social');
        CRUD::column('cpf_cnpj')->label('Cpf / Cnpj');
        CRUD::column('finalidade')->type('enum');
        CRUD::column('tipo')->type('enum');
        CRUD::column('celular');
        CRUD::column('nome_contato');
        CRUD::column('telefone_contato');

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(FornecedorRequest::class);

        CRUD::field('razao_social')->label('Razão social.:')->size(3)->tab('Fornecedor');
        CRUD::field('nome_fantasia')->label('Nome Fantasia.:')->size(3)->tab('Fornecedor');
        CRUD::field('cpf_cnpj')->label('Cpf / Cnpj.:')->size(3)->attributes(['class' => 'form-control cpfcnpj'])->tab('Fornecedor');
        CRUD::field('rg_inscricao')->label('Rg / Inscrição')->size(3)->tab('Fornecedor');
        CRUD::field('finalidade')->label('Finalidade.:')->type('enum')->size(3)->tab('Fornecedor');
        CRUD::field('tipo')->label('Tipo.:')->type('enum')->size(3)->tab('Fornecedor');
        CRUD::field('email')->label('Email.:')->size(3)->tab('Fornecedor');
        CRUD::field('telefone')->label('Telefone.:')->attributes(['class' => 'form-control telefone'])->size(3)->tab('Fornecedor');
        CRUD::field('celular')->label('Celular.:')->attributes(['class' => 'form-control celular'])->size(3)->tab('Fornecedor');
        CRUD::field('cep')->label('Cep.:')->attributes(['id' => 'cep'])->size(3)->tab('Fornecedor');
        CRUD::field('estado')->label('Estado.:')->attributes(['id' => 'estado'])->size(3)->tab('Fornecedor');
        CRUD::field('cidade')->label('Cidade.:')->attributes(['id' => 'cidade'])->size(3)->tab('Fornecedor');
        CRUD::field('bairro')->label('Bairro.:')->attributes(['id' => 'bairro'])->size(3)->tab('Fornecedor');
        CRUD::field('endereco')->label('Endereço.:')->attributes(['id' => 'endereco'])->size(3)->tab('Fornecedor');
        CRUD::field('complmento')->label('Complemento.:')->size(3)->tab('Fornecedor');
        CRUD::field('numero')->label('Numero.:')->size(3)->tab('Fornecedor');
        CRUD::field('nome_contato')->label('Nome Contato.:')->size(3)->tab('Contato');
        CRUD::field('email_contato')->label('Email Contato.:')->size(3)->tab('Contato');
        CRUD::field('telefone_contato')->label('Telefone Contato.:')->size(3)->tab('Contato');
        CRUD::field('status')->type('enum')->size(3)->tab('Fornecedor');
        CRUD::field('nome_banco')->label('Nome.:')->size(3)->tab('Dados Bancarios');
        CRUD::field('banco')->label('Banco.:')->size(2)->tab('Dados Bancarios');
        CRUD::field('agencia')->label('Agencia.:')->size(2)->tab('Dados Bancarios');
        CRUD::field('num_conta')->label('Nº Conta.:')->size(2)->tab('Dados Bancarios');
        CRUD::field('operacao')->label('OP.:')->size(1)->tab('Dados Bancarios');
        CRUD::field('pix')->label('Pix.:')->size(2)->tab('Dados Bancarios');
        CRUD::field('tipo_conta')->label('Tipo Conta')->type('enum')->size(3)->tab('Dados Bancarios');
        //tipo_conta

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
        CRUD::column('razao_social')->label('Razão social')->size(3);
        CRUD::column('nome_fantasia')->label('Nome Fantasia')->size(3);
        CRUD::column('cpf_cnpj')->label('Cpf / Cnpj')->size(3);
        CRUD::column('rg_inscricao')->label('Rg / Inscrição')->size(3);
        CRUD::column('finalidade')->label('Finalidade')->type('enum')->size(3);
        CRUD::column('tipo')->label('Tipo')->type('enum')->size(3);
        CRUD::column('email')->label('Email')->size(3);
        CRUD::column('telefone')->label('Telefon')->size(3);
        CRUD::column('celular')->label('Celular')->size(3);
        CRUD::column('cep')->label('Cep')->size(3);
        CRUD::column('estado')->label('Estado')->size(3);
        CRUD::column('cidade')->label('Cidade')->size(3);
        CRUD::column('bairro')->label('Bairro')->size(3);
        CRUD::column('endereco')->label('Endereço')->size(3);
        CRUD::column('complmento')->label('Complemento')->size(3);
        CRUD::column('numero')->label('Numero')->size(3);
        CRUD::column('nome_contato')->label('Nome Contato')->size(3);
        CRUD::column('email_contato')->label('Email Contato')->size(3);
        CRUD::column('telefone_contato')->label('Telefone Contato')->size(3);
        CRUD::column('status')->type('enum')->size(3);
        CRUD::column('nome_banco')->label('Nome');
        CRUD::column('banco')->label('Banco');
        CRUD::column('agencia')->label('Agencia');
        CRUD::column('num_conta')->label('Nº Conta');
        CRUD::column('operacao')->label('OP.');
        
    }
}
