<?php

namespace App\Observers\Lancamentos;

use App\Models\Lancamentos\ChequeEmitido;
use Illuminate\Support\Str;

class ChequeEmitidoObserver
{
    /**
     * Handle the ChequeEmitido "creating" event.
     *
     * @param  \App\Models\Lancamentos\ChequeEmitido  $chequeEmitido
     * @return void
     */
    public function creating(ChequeEmitido $chequeEmitido)
    {
        $data = $chequeEmitido;
        
        if (mb_strpos($data['valor_lancamento'], ',') !== false) {
            $data['valor_lancamento'] = Str::replace('.', "", $data['valor_lancamento']);
            $chequeEmitido->valor_lancamento = Str::replace(',', ".", $data['valor_lancamento']);
        }
    }

    /**
     * Handle the ChequeEmitido "updating" event.
     *
     * @param  \App\Models\Lancamentos\ChequeEmitido  $chequeEmitido
     * @return void
     */
    public function updating(ChequeEmitido $chequeEmitido)
    {
        $data = $chequeEmitido;
        
        if (mb_strpos($data['valor_lancamento'], ',') !== false) {
            $data['valor_lancamento'] = Str::replace('.', "", $data['valor_lancamento']);
            $chequeEmitido->valor_lancamento = Str::replace(',', ".", $data['valor_lancamento']);
        }
    }

    /**
     * Handle the ChequeEmitido "deleted" event.
     *
     * @param  \App\Models\Lancamentos\ChequeEmitido  $chequeEmitido
     * @return void
     */
    public function deleted(ChequeEmitido $chequeEmitido)
    {
        //
    }

    /**
     * Handle the ChequeEmitido "restored" event.
     *
     * @param  \App\Models\Lancamentos\ChequeEmitido  $chequeEmitido
     * @return void
     */
    public function restored(ChequeEmitido $chequeEmitido)
    {
        //
    }

    /**
     * Handle the ChequeEmitido "force deleted" event.
     *
     * @param  \App\Models\Lancamentos\ChequeEmitido  $chequeEmitido
     * @return void
     */
    public function forceDeleted(ChequeEmitido $chequeEmitido)
    {
        //
    }
}
