<?php

namespace App\Http\Controllers\Admin\Silo;

use App\Http\Requests\Silo\EntradaSiloRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EntradaSiloCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EntradaSiloCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Silo\EntradaSilo::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/entradasilo');
        CRUD::setEntityNameStrings('Entrada Silo', 'Entrdas Silos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('safra_id')->type('select')
            ->entity('Safra')
            ->attribute('nome')
            ->size(4);
        CRUD::column('cultura_id')->type('select')
            ->entity('Cultura')
            ->attribute('nome')
            ->size(4);
        CRUD::column('motorista_id')->type('select')
            ->entity('motorista')
            ->attribute('placa_nome');
        CRUD::column('primeira_pesagem')->label('1º Pesagem');
        CRUD::column('segunda_pesagam')->label('2º Pesagem');
        CRUD::column('umidade');
        CRUD::column('inscricao_estadual_id')
            ->label('Inscrição')
            ->type('select')
            ->entity('inscricaoEstadual')
            ->attribute('inscricao');


        CRUD::column('tipo_entrada')->type('enum');
        CRUD::column('impuresa');
        CRUD::column('ardido');
        CRUD::column('partido');
        CRUD::column('avariado');
        CRUD::column('desconto')->label('%');
        CRUD::column('peso_bruto')->label('P. Bruto');
        CRUD::column('peso_liquido')->label('P. Liqui.');
        CRUD::column('saco_bruto')->label('S. Bruto');
        CRUD::column('saco_liquido')->label('S. Liqui.');
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
        CRUD::setValidation(EntradaSiloRequest::class);

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
        CRUD::field('tipo_entrada')->size(2)->label('Tipo')->type('enum');
        CRUD::field('motorista_id')
            ->attributes(['id' => 'motorista_id'])
            ->label('Trasportador.:')
            ->type('select2')
            ->attribute('placa_nome')
            ->model('App\Models\Motorista')
            ->options(function ($query) {
                return $query->where('status', '=', 'ATIVO')->orderBy('placa_nome', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('inscricao_estadual_id')
            ->label('Inscrição.:')
            ->type('select2')
            ->entity('inscricaoEstadual')
            ->model('App\Models\Silo\InscricaoEstadual')
            ->attribute('inscricao')
            ->options(function ($query) {
                return $query->where('status', '=', 'ATIVA')->orderBy('inscricao', 'ASC')->get();
            })
            ->size(2);

        CRUD::field('primeira_pesagem')->size(2)->label('1º Pesagem.:')->attributes(['id' => 'primeira_pesagem', 'class' => 'form-control']);;
        CRUD::field('umidade')->size(2)->label('Umidade.:')->attributes(['id' => 'umidade', 'class' => 'form-control']);;
        CRUD::field('segunda_pesagam')->size(2)->label('2º Pesagem.:')->attributes(['id' => 'segunda_pesagam', 'class' => 'form-control']);;


        CRUD::field('impuresa')->size(2)->label('Inpuresa.:')->attributes(['id' => 'impuresa', 'class' => 'form-control']);;
        CRUD::field('ardido')->size(2)->label('Ardido.:')->attributes(['id' => 'ardido', 'class' => 'form-control']);;
        CRUD::field('partido')->size(2)->label('Partido.:')->attributes(['id' => 'partido', 'class' => 'form-control']);;
        CRUD::field('avariado')->size(2)->label('Avariado.:')->attributes(['id' => 'avariado', 'class' => 'form-control']);;
        CRUD::field('desconto')->size(2)->label('Desconto.:')->attributes(['id' => 'desconto', 'class' => 'form-control desabilitado']);;
        CRUD::field('peso_bruto')->size(2)->label('P. Bruto.:')->attributes(['id' => 'peso_bruto', 'class' => 'form-control desabilitado']);;
        CRUD::field('peso_liquido')->size(2)->label('P. Liquido.:')->attributes(['id' => 'peso_liquido', 'class' => 'form-control desabilitado']);;
        CRUD::field('saco_bruto')->size(2)->label('S. Bruto.:')->attributes(['id' => 'saco_bruto', 'class' => 'form-control desabilitado']);;
        CRUD::field('saco_liquido')->size(2)->label('S. Liquido.:')->attributes(['id' => 'saco_liquido', 'class' => 'form-control desabilitado']);


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
