<?php

namespace App\Http\Controllers\Admin\Silo;

use App\Http\Requests\SaidaSiloRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SaidaSiloCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SaidaSiloCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Silo\SaidaSilo::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/saidasilo');
        CRUD::setEntityNameStrings('Saida Silo', 'Saidas Silo');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('tenant_id');
        CRUD::column('safra_id');
        CRUD::column('cultura_id');
        CRUD::column('contrato_embarque_id');
        CRUD::column('contrato_inscricao_id');
        CRUD::column('motorista_id');
        CRUD::column('uuid');
        CRUD::column('primeira_pesagem');
        CRUD::column('segunda_pesagam');
        CRUD::column('umidade');
        CRUD::column('impuresa');
        CRUD::column('ardido');
        CRUD::column('partido');
        CRUD::column('avariado');
        CRUD::column('desconto');
        CRUD::column('peso_bruto');
        CRUD::column('peso_liquido');
        CRUD::column('saco_bruto');
        CRUD::column('saco_liquido');
        CRUD::column('status');
        CRUD::column('deleted_at');
        CRUD::column('created_at');
        CRUD::column('updated_at');

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
        CRUD::setValidation(SaidaSiloRequest::class);

        CRUD::field('safra_id')
            ->label('Safra.:')
            ->type('select2')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(3);
            CRUD::field('cultura_id')
            ->label('Cultura.:')
            ->type('select2')
            ->entity('cultura')
            ->attribute('nome')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('nome', 'ASC')->get();
            })
            ->size(2);


            CRUD::field('contrato_embarque_id')
            ->label('Contrato.:')
            ->type('select2')
            ->entity('contratoEmbarque')
            ->model('\App\Models\Silo\ContratoEmbarque')
            ->attribute('num_contrato')
            ->options(function ($query) {
                return $query->where('status', '=', 'ABERTO')->orderBy('num_contrato', 'ASC')->get();
            })
            ->size(3);
        
        
            CRUD::field('contrato_inscricao_id')
            ->label('Inscrição')
            ->type('select2_from_ajax')
            ->entity('variedadeCultura')
            ->attribute('nome')
            ->data_source('variedade')
            ->placeholder('Variedade')
            ->include_all_form_fields(true)
            ->minimum_input_length(0)
            ->dependencies(['cultura_id'])
            ->method('post')
            ->model('App\Models\VariedadeCultura')
            ->size(3);


            CRUD::field('motorista_id')
            ->attributes(['id' => 'motorista_id'])
            ->label('Trasportador.:')
            ->type('select2')
            ->attribute('placa_nome')
            ->model('App\Models\Motorista')
            ->options(function ($query) {
                return $query->where('status', '=', 'ATIVO')->where('tipo', '=','EMBARQUE')->orderBy('placa_nome', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('uuid');
        CRUD::field('primeira_pesagem');
        CRUD::field('segunda_pesagam');
        CRUD::field('umidade');
        CRUD::field('impuresa');
        CRUD::field('ardido');
        CRUD::field('partido');
        CRUD::field('avariado');
        CRUD::field('desconto');
        CRUD::field('peso_bruto');
        CRUD::field('peso_liquido');
        CRUD::field('saco_bruto');
        CRUD::field('saco_liquido');
        CRUD::field('status');

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
}
