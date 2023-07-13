<?php

namespace App\Observers\Lancamentos;

use App\Models\Lancamentos\Caixa;
use Illuminate\Support\Str;

class CaixaObserver
{
    /**
     * Handle the Caixa "creating" event.
     *
     * @param  \App\Models\Lancamentos\Caixa  $caixa
     * @return void
     */
    public function creating(Caixa $caixa)
    {
        $data = $caixa;

        if (mb_strpos($data['valor_lancamento'], ',') !== false) {
            $data['valor_lancamento'] = Str::replace('.', "", $data['valor_lancamento']);
            $caixa->valor_lancamento = Str::replace(',', ".", $data['valor_lancamento']);
        }
        $caixa->user_id = backpack_user()->id;
        $caixa->controle_caixa_id = 1;

    }

    /**
     * Handle the Caixa "updating" event.
     *
     * @param  \App\Models\Lancamentos\Caixa  $caixa
     * @return void
     */
    public function updating(Caixa $caixa)
    {
        $data = $caixa;

        if (mb_strpos($data['valor_lancamento'], ',') !== false) {
            $data['valor_lancamento'] = Str::replace('.', "", $data['valor_lancamento']);
            $caixa->valor_lancamento = Str::replace(',', ".", $data['valor_lancamento']);
        }
    }

    /**
     * Handle the Caixa "deleted" event.
     *
     * @param  \App\Models\Lancamentos\Caixa  $caixa
     * @return void
     */
    public function deleted(Caixa $caixa)
    {
        //
    }

    /**
     * Handle the Caixa "restored" event.
     *
     * @param  \App\Models\Lancamentos\Caixa  $caixa
     * @return void
     */
    public function restored(Caixa $caixa)
    {
        //
    }

    /**
     * Handle the Caixa "force deleted" event.
     *
     * @param  \App\Models\Lancamentos\Caixa  $caixa
     * @return void
     */
    public function forceDeleted(Caixa $caixa)
    {
        //
    }
}
