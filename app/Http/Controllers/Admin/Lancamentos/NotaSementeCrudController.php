<?php

namespace App\Http\Controllers\Admin\Lancamentos;

use App\Http\Requests\Lancamentos\NotaSementeRequest;
use App\Models\Lancamentos\NotaSemente;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NotaSementeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NotaSementeCrudController extends CrudController
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
        CRUD::setModel(NotaSemente::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lancamentos/notasemente');
        CRUD::setEntityNameStrings('Nota Semente', 'Notas Sementes');
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
        CRUD::column('produtor_id')->type('select')
            ->entity('Produtor')
            ->attribute('razao_social');
        CRUD::column('fornecedor_id')->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
            CRUD::column('nota_fiscal')->label('Nota Fiscal.:')->size(4);
            CRUD::column('data_emissao')->label('Emissão')->type('datetime')->format('DD/MM/YYYY');
            CRUD::column('data_chegada')->label('Chegada')->type('datetime')->format('DD/MM/YYYY');
            CRUD::column('transportadora')->label('Transportadora.:')->size(4);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(NotaSementeRequest::class);

        CRUD::field('produtor_id')
            ->type('select2')
            ->entity('produtor')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->tab('Nota')
            ->size(3);
            CRUD::field('fornecedor_id')
            ->label('Fornecedor.:')
            ->type('select2')
            ->entity('fornecedor')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade', '=', 'SEMENTES')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->tab('Nota')
            ->size(3);
            CRUD::field('nota_fiscal')->size(2)->label('Nº Nota')->tab('Nota');
            CRUD::field('data_emissao')->label('Emissão')->size(3)->tab('Nota');
            CRUD::field('data_chegada')->label('Chegada')->size(3)->tab('Nota');
            CRUD::field('transportadora')->size(3)->label('Transportadora')->tab('Nota');
            CRUD::field('produtos')->type('repeatable')->tab('Sementes')->fields([
                [    // SELECT2
                    'label'             => 'Produto',
                    'type'              => 'select2',
                    'name'              => 'produtos',
                    'attribute'         => 'nome',
                    'model'             => "App\Models\Produto",
                    'store_in'          => 'Sementes',
                    'options'   => (function ($query) {
                        return $query->where('finalidade', '=', 'Sementes')->orderBy('nome')->get();
                    }),
                    'fake'              => true,
                    'wrapperAttributes' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name'              => 'dose_estimada_hectare',
                    'label'             => 'Dose Estinada',
                    'store_in'          => 'produtos',
                    'fake'              => true,
                    'type'              => 'text',
                    'tab'               => 'Sementes',
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-4',
                    ],
                ],
            ]);
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
