<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MatrizFreteRequest;
use App\Models\LancamentoSafra;
use App\Models\MatrizFrete;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MatrizFreteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MatrizFreteCrudController extends CrudController
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
        CRUD::setModel(\App\Models\MatrizFrete::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/matrizfrete');
        CRUD::setEntityNameStrings('Matriz Frete', 'Matriz Fretes');
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
        $this->crud->addClause('whereHas', 'safra', function($query) {
            $query->where('status', '=', 'Ativa');
        });
        CRUD::column('safra_id')->type('select')
            ->entity('Safra')
            ->attribute('nome')
            ->size(4);
        CRUD::column('bloco');
        CRUD::column('percurso');
        CRUD::column('frete');
        CRUD::column('status');

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
        CRUD::setValidation(MatrizFreteRequest::class);
        CRUD::field('safra_id')
        ->type('select2')
        ->entity('safra')
        ->attribute('nome')
        ->options(function ($query) {
            return $query->where('status','=', 'Ativa')->orderBy('nome', 'ASC')->get();
        })
        ->size(3);
        CRUD::field('bloco')->size(2);
        CRUD::field('percurso')->size(2);
        CRUD::field('frete')->size(2)->attributes(['class' => 'form-control areas']);
        CRUD::field('status')->size(2)->type('enum');

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

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        CRUD::column('safra_id')->type('select')
            ->entity('Safra')
            ->attribute('nome')
            ->size(4);
        CRUD::column('bloco');
        CRUD::column('percurso');
        CRUD::column('frete')->size(2)
        ->type('number')
        ->decimals(2)
        ->prefix('R$ ')
        ->dec_point(',')
        ->thousands_sep('.');
        CRUD::column('status')->type('enum');
    }

    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $data = $this->crud->validateRequest()->all();

        if (isset($data['frete'])) {
            $data['frete'] = str_replace('.', "", $data['frete']);
            $data['frete'] = str_replace(',', ".", $data['frete']);
        }

        $model = MatrizFrete::create($data);

        // show a success message
        \Alert::success(trans('Matriz Cadastrada com Sucesso'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($model->id);
    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        $data = $this->crud->validateRequest()->all();
        //dd($data);
        if (isset($data['frete'])) {
            $data['frete'] = str_replace('.', "", $data['frete']);
            $data['frete'] = str_replace(',', ".", $data['frete']);
        }
        //dd($this->crud->getStrippedSaveRequest());
        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName()), $data);
        $this->data['entry'] = $this->crud->entry = $item;

        // execute the FormRequest authorization and validation, if one is required
        //$data = $this->crud->validateRequest()->all();
        

        $lacamentos = LancamentoSafra::where('matriz_frete_id',$data['id'])
                ->where('safra_id',$data['safra_id'])->get();

        foreach ($lacamentos as $lacamento)
        {
            $novo = LancamentoSafra::find($lacamento->id);
            $novoFrete = $lacamento->saco_bruto * $data['frete'];
            $novo->valor_frete = $novoFrete;
            $novo->save();
        }
        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }
}
