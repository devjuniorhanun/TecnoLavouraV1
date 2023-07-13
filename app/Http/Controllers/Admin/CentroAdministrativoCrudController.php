<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CentroAdministrativoRequest;
use App\Models\Fazenda;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class CentroAdministrativoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CentroAdministrativoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CentroAdministrativo::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/centroadministrativo');
        CRUD::setEntityNameStrings('Centros Administrativos', 'Centros Administrativos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('produtor_id')->type('select')
            ->entity('Produtor')
            ->attribute('razao_social');
        CRUD::column('fazenda_id')
            ->label('Fazenda')
            ->type('select')
            ->entity('Fazenda')
            ->attribute('nome')
            ->size(4);
        CRUD::column('status')->label('Status')->type('enum')->size(4);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CentroAdministrativoRequest::class);

        CRUD::field('produtor_id')
            ->type('select2')
            ->entity('produtor')
            ->attribute('razao_social')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativa')->orderBy('razao_social', 'ASC')->get();
            })
            ->size(3);

        CRUD::field('fazenda_id')
            ->label('Variedade')
            ->type('select2_from_ajax')
            ->entity('fazenda')
            ->attribute('nome')
            ->data_source('fazenda')
            ->placeholder('Fazendas')
            ->include_all_form_fields(true)
            ->minimum_input_length(0)
            ->dependencies(['produtor_id'])
            ->method('post')
            ->model('App\Models\Fazenda')
            ->size(3);
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

        CRUD::column('produtor_id')->type('select')
            ->entity('Produtor')
            ->attribute('razao_social');
        CRUD::column('fazenda_id')
            ->label('Fazenda')
            ->type('select')
            ->entity('Fazenda')
            ->attribute('nome')
            ->size(4);
        CRUD::column('status')->label('Status')->type('enum')->size(4);
    }

    public function fazenda(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');

        if ($search_term) {
            $options = Fazenda::where('nome', 'LIKE', '%' . $search_term . '%')->paginate(1000000);
        } else {
            $options = Fazenda::where('produtor_id', $form['produtor_id'])->paginate(1000000);
        }
        return $options;
    }
}
