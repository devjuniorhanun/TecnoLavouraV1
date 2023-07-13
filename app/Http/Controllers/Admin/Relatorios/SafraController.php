<?php

namespace App\Http\Controllers\Admin\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Colhedor;
use App\Models\LancamentoSafra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SafraController extends Controller
{
    /*public function motoristas()
    {
        $this->crud->hasAccessOrFail('list');
        $registros = LancamentoSafra::where('safra_id', '=', '2')->select(DB::raw('SUM(peso_bruto) as peso'))->first()->peso;
        $listaTransportador = LancamentoSafra::listaTransportador();
        return view('admin.lacamento_lavoura.motoristas', compact('registros', 'listaTransportador'));
    }*/

    public function colhedores()
    {
        $registros = LancamentoSafra::where('safra_id', '=', '2')->select(DB::raw('SUM(peso_bruto) as peso'))->first()->peso;
        $listaColhedor = Colhedor::listaColhedor();
        //dd($listaColhedor);
        return view('relatorios.safras.colhedores',compact('registros','listaColhedor'));
    }
}
