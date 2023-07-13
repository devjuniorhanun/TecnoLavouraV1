<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProdutorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProdutorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProdutorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Produtor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/produtor');
        CRUD::setEntityNameStrings('Produtor', 'Produtores');
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
        CRUD::column('abreviacao')->label('Abreviação');
        CRUD::column('tipo')->type('enum');
        CRUD::column('cpf_cnpj')->label('Cpf / Cnpj');
        CRUD::column('celular');
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
        CRUD::setValidation(ProdutorRequest::class);

        CRUD::field('razao_social')->label('Razão Social.:')->size(4);
        CRUD::field('nome_fantasia')->label('Nome Fantasia.:')->size(4);
        CRUD::field('abreviacao')->label('Abreviação.:')->size(2);
        CRUD::field('tipo')->label('Tipo.:')->type('enum')->size(2);
        CRUD::field('data_nascimento')->label('Data Nascimento.:')->type('date')->size(2);
        CRUD::field('nascionalidade')->label('Nacionalidade.:')->size(2);
        CRUD::field('naturalidade')->label('Naturalidade.:')->size(2);
        CRUD::field('estado_civel')->label('Estado Civel.:')->type('enum')->size(2);
        CRUD::field('cpf_cnpj')->label('Cpf / Cnpj.:')->size(2);
        CRUD::field('rg_inscriacao')->label('Rg / Inscrição.:')->size(2);
        CRUD::field('email')->label('Email.:')->type('email')->size(4);
        CRUD::field('telefone')->label('Telefone.:')->size(2)->attributes(['class' => 'form-control telefone']);
        CRUD::field('celular')->label('Celular.:')->size(2)->attributes(['class' => 'form-control celular']);
        CRUD::field('status')->label('Status.:')->type('enum')->size(2);
        CRUD::field('cep')->label('Cep.:')->size(2)->attributes(['id' => 'cep']);
        CRUD::field('estado')->label('Estado.:')->size(1)->attributes(['id' => 'estado']);
        CRUD::field('cidade')->label('Cidade.:')->size(2)->attributes(['id' => 'cidade']);
        CRUD::field('bairro')->label('Bairro.:')->size(2)->attributes(['id' => 'bairro']);
        CRUD::field('endereco')->label('Endereço.:')->size(3)->attributes(['id' => 'endereco']);
        CRUD::field('complemento')->label('Complemento.:')->size(2);
        CRUD::field('numero')->label('Número.:')->size(2);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();CRUD::column('razao_social')->label('Razão Social.:')->size(4);
        CRUD::column('nome_fantasia')->label('Nome Fantasia.:')->size(4);
        CRUD::column('abreviacao')->label('Abreviação.:')->size(2);
        CRUD::column('tipo')->label('Tipo.:')->type('enum')->size(2);
        CRUD::column('data_nascimento')->label('Data Nascimento.:')->type('date')->size(2);
        CRUD::column('nascionalidade')->label('Nacionalidade.:')->size(2);
        CRUD::column('naturalidade')->label('Naturalidade.:')->size(2);
        CRUD::column('estado_civel')->label('Estado Civel.:')->type('enum')->size(2);
        CRUD::column('cpf_cnpj')->label('Cpf / Cnpj.:')->size(2);
        CRUD::column('rg_inscriacao')->label('Rg / Inscrição.:')->size(2);
        CRUD::column('email')->label('Email.:')->type('email')->size(4);
        CRUD::column('telefone')->label('Telefone.:')->size(2);
        CRUD::column('celular')->label('Celular.:')->size(2);
        CRUD::column('status')->label('Status.:')->type('enum')->size(2);
        CRUD::column('cep')->label('Cep.:')->size(2);
        CRUD::column('estado')->label('Estado.:')->size(2);
        CRUD::column('cidade')->label('Cidade.:')->size(2);
        CRUD::column('bairro')->label('Bairro.:')->size(2);
        CRUD::column('endereco')->label('Endereço.:')->size(2);
        CRUD::column('complemento')->label('Complemento.:')->size(2);
        CRUD::column('numero')->label('Número.:')->size(2);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column('razao_social')->label('Razão Social');
        CRUD::column('nome_fantasia')->label('Nome Fantasia');
        CRUD::column('abreviacao')->label('Abreviação');
        CRUD::column('tipo')->label('Tipo')->type('enum');
        CRUD::column('data_nascimento')->label('Data Nascimento')->type('datetime')->format('DD/MM/YYYY');
        CRUD::column('nascionalidade')->label('Nacionalidade');
        CRUD::column('naturalidade')->label('Naturalidade');
        CRUD::column('estado_civel')->label('Estado Civel')->type('enum');
        CRUD::column('cpf_cnpj')->label('Cpf / Cnpj');
        CRUD::column('rg_inscriacao')->label('Rg / Inscrição');
        CRUD::column('email')->label('Email')->type('email');
        CRUD::column('telefone')->label('Telefone');
        CRUD::column('celular')->label('Celular');
        CRUD::column('status')->label('Status')->type('enum');
        CRUD::column('cep')->label('Cep');
        CRUD::column('estado')->label('Estado');
        CRUD::column('cidade')->label('Cidade');
        CRUD::column('bairro')->label('Bairro');
        CRUD::column('endereco')->label('Endereço');
        CRUD::column('complemento')->label('Complemento');
        CRUD::column('numero')->label('Número');
    }
}
