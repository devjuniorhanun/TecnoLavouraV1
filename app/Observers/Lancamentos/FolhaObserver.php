<?php

namespace App\Observers\Lancamentos;

use App\Models\CentroAdministrativo;
use App\Models\Lancamentos\Folha;
use Illuminate\Support\Str;
class FolhaObserver
{
    /**
     * Handle the Folha "creating" event.
     *
     * @param  \App\Models\Lancamentos\Folha  $folha
     * @return void
     */
    public function creating(Folha $folha)
    {
        $data = $folha;
        
        if (mb_strpos($data['valor_lancamento'], ',') !== false) {
            $data['valor_lancamento'] = Str::replace('.', "", $data['valor_lancamento']);
            $folha->valor_lancamento = Str::replace(',', ".", $data['valor_lancamento']);
        }
        $folha->centro_administrativo_id = CentroAdministrativo::where('fazenda_id','=',$folha->centro_administrativo_id)->first()->id;
        
    }

    /**
     * Handle the Folha "updating" event.
     *
     * @param  \App\Models\Lancamentos\Folha  $folha
     * @return void
     */
    public function updating(Folha $folha)
    {
        $data = $folha;

        if (mb_strpos($data['valor_lancamento'], ',') !== false) {
            $data['valor_lancamento'] = Str::replace('.', "", $data['valor_lancamento']);
            $folha->valor_lancamento = Str::replace(',', ".", $data['valor_lancamento']);
        }
    }

    /**
     * Handle the Folha "deleted" event.
     *
     * @param  \App\Models\Lancamentos\Folha  $folha
     * @return void
     */
    public function deleted(Folha $folha)
    {
        //
    }

    /**
     * Handle the Folha "restored" event.
     *
     * @param  \App\Models\Lancamentos\Folha  $folha
     * @return void
     */
    public function restored(Folha $folha)
    {
        //
    }

    /**
     * Handle the Folha "force deleted" event.
     *
     * @param  \App\Models\Lancamentos\Folha  $folha
     * @return void
     */
    public function forceDeleted(Folha $folha)
    {
        //
    }
}
