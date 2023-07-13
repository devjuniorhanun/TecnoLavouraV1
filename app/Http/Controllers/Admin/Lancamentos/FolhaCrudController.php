<?php

namespace App\Http\Controllers\Admin\Lancamentos;

use App\Http\Requests\Lancamentos\FolhaRequest;
use App\Models\CentroAdministrativo;
use App\Models\Fazenda;
use App\Models\Lancamentos\Folha;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class FolhaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FolhaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Lancamentos\Folha::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/lancamentos/folha');
        CRUD::setEntityNameStrings('folha', 'folhas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     *
    protected function setupListOperation()
    {
        $this->crud->enableExportButtons();
        CRUD::column('produtor_id')->label('Produtor.:')->type('select')
        ->entity('produtor')
        ->attribute('razao_social')->size(4);
        CRUD::column('centro_administrativo_id')->label('Centro Administrativo.:')->type('select')
        ->model('App\Models\Fazenda')
        ->entity('centroAdministrativo')  
        ->searchLogic(true)
        
        ->searchLogic(function ($query, $column, $searchTerm) {
            dd($searchTerm);
            return $searchTerm;
        })
        ->attribute('name')
        
        ->size(4);
        CRUD::column('data_lancamento')->label('Retirou.:')->size(4);
        CRUD::column('valor_lancamento')->label('Valor.:')->size(4);
        CRUD::column('descricao_lancamento')->label('Descrição.:')->size(4);
    }*/

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(FolhaRequest::class);

        CRUD::field('produtor_id')->label('Produtor.:')->type('select')
        ->entity('produtor')
        ->attribute('razao_social')->size(3);
        /*CRUD::field('centro_administrativo_id')->label('Centro Administrativo.:')->type('select')
        ->entity('centroAdministrativo')
        ->model('App\Models\CentroAdministrativo')
        ->attribute('nome')->size(4);*/
        CRUD::field('centro_administrativo_id')
            ->label('Centro Administrativo')
            ->type('select2_from_ajax')
            ->entity('centroAdministrativo')
            ->attribute('nome')
            ->data_source('centroAdministrativo')
            ->placeholder('Centro Administrativo')
            ->include_all_form_fields(true)
            ->minimum_input_length(0)
            ->dependencies(['produtor_id'])
            ->method('post')
            ->model('App\Models\CentroAdministrativo')
            ->size(3);
        CRUD::field('data_lancamento')->label('Lançamento.:')->size(2);
        CRUD::field('valor_lancamento')->label('Valor.:')->size(2)->attributes(['class' => 'form-control valores']);
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

    public function centro (Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');
        //dd($form);

        if ($search_term) {
            $options = CentroAdministrativo::where('nome', 'LIKE', '%' . $search_term . '%')->paginate(1000000);
        } else {
            $options = CentroAdministrativo::where('centro_administrativos.produtor_id', $form['produtor_id'])
            ->join('fazendas', 'fazendas.id', '=', 'centro_administrativos.fazenda_id')

            ->paginate(1000000);
        }
        return $options;
    }

    public function index()
    {
        $this->crud->hasAccessOrFail('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? mb_ucfirst($this->crud->entity_name_plural);
        $registro = Folha::get();
        //dd($registro[0]->centroAdministrativo->fazenda->nome);
        $this->data['registros'] = Folha::orderByDesc('id')->get();
        return view('financeiro.folha.index', $this->data);
    }
}
