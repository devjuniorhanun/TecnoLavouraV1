<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ColhedorRequest;
use App\Models\Colhedor;
use App\Models\Fornecedor;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

/**
 * Class ColhedorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ColhedorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Colhedor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/colhedor');
        CRUD::setEntityNameStrings('Colhedor', 'Colhedores');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('fornecedor_id')
            ->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('nome')->label('Colhedor');
        CRUD::column('qnt_linha')->label('Qnt Linhas');
        CRUD::column('status');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ColhedorRequest::class);

        CRUD::field('fornecedor_id')
            ->label('Fornecedor.:')
            ->type('select2')
            ->entity('fornecedor')
            ->attribute('nome_fantasia')
            ->options(function ($query) {
                return $query->where('status', '=', 'Ativo')->where('finalidade', '=', 'COLHEDOR')->orderBy('nome_fantasia', 'ASC')->get();
            })
            ->size(3);
        CRUD::field('nome')->label('Frente')->size(3);
        CRUD::field('qnt_linha')->label('Qnt. Maquina')->size(3);
        CRUD::field('status')->size(3)->type('enum');

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
        CRUD::column('fornecedor_id')->type('select')
            ->entity('Fornecedor')
            ->attribute('nome_fantasia');
        CRUD::column('nome')->label('Nome');
        CRUD::column('nome')->label('Frente');
        CRUD::column('qnt_linha')->label('Qnt. Maquina');
        CRUD::column('status')->type('enum');
    }

    public function contratosColhedores()
    {
        $colhedores = Fornecedor::where('finalidade', '=', 'COLHEDOR')->orderBy('razao_social')->get();
        return view('contratos.colhedores.index', compact('colhedores'));
    }

    public function contratoColhedore(Request $request)
    {
        $date = $request->all();
        $mes_extenso = array(
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Novembro',
            '10' => 'Setembro',
            '11' => 'Outubro',
            '12' => 'Dezembro'
        );
        $mes = $mes_extenso[\Carbon\Carbon::parse(now())->format('m')];
        
        $data = [
            'colhedores' => Fornecedor::find($date['fornecedor']),
            'colhedor' => Colhedor::where('fornecedor_id','=',$date['fornecedor'])->first(),
            'dia' => \Carbon\Carbon::parse(now())->format('d') . " " . $mes . " " .\Carbon\Carbon::parse(now())->format('Y'),
        ];
        return $pdf = PDF::loadView('contratos.colhedores.contratoPdf', $data)->stream();
    }
}
