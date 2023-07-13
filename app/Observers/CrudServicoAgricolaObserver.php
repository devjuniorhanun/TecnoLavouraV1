<?php

namespace App\Observers;

use App\Models\ServicoAgricola;
use Illuminate\Support\Str;

class CrudServicoAgricolaObserver
{
    /**
     * Handle the ServicoAgricola "creating" event.
     *
     * @param  \App\Models\ServicoAgricola  $servicoAgricola
     * @return void
     */
    public function creating(ServicoAgricola $servicoAgricola)
    {
        $data = $servicoAgricola;
       // dd($data);

        if (strpos($data['volume_bomba'], ',')) {
            $data['volume_bomba'] = Str::replace('.', "", $data['volume_bomba']);
            $servicoAgricola->volume_bomba = Str::replace(',', ".", $data['volume_bomba']);
        }
        if (mb_strpos($data['bomba_usada'], ',') !== false) {
            $data['bomba_usada'] = Str::replace('.', "", $data['bomba_usada']);
            $servicoAgricola->bomba_usada = Str::replace(',', ".", $data['bomba_usada']);
        }

        //dd($servicoAgricola);
    }

    /**
     * Handle the ServicoAgricola "updating" event.
     *
     * @param  \App\Models\ServicoAgricola  $servicoAgricola
     * @return void
     */
    public function updating(ServicoAgricola $servicoAgricola)
    {
        $data = $servicoAgricola;
        if (mb_strpos($data['volume_bomba'], ',') !== false) {
            $data['volume_bomba'] = Str::replace('.', "", $data['volume_bomba']);
            $servicoAgricola->volume_bomba = Str::replace(',', ".", $data['volume_bomba']);
        }

        if (mb_strpos($data['bomba_usada'], ',') !== false) {
            $data['bomba_usada'] = Str::replace('.', "", $data['bomba_usada']);
            $servicoAgricola->bomba_usada = Str::replace(',', ".", $data['bomba_usada']);
        }

        
    }

    /**
     * Handle the ServicoAgricola "deleted" event.
     *
     * @param  \App\Models\ServicoAgricola  $servicoAgricola
     * @return void
     */
    public function deleted(ServicoAgricola $servicoAgricola)
    {
        //
    }

    /**
     * Handle the ServicoAgricola "restored" event.
     *
     * @param  \App\Models\ServicoAgricola  $servicoAgricola
     * @return void
     */
    public function restored(ServicoAgricola $servicoAgricola)
    {
        //
    }

    /**
     * Handle the ServicoAgricola "force deleted" event.
     *
     * @param  \App\Models\ServicoAgricola  $servicoAgricola
     * @return void
     */
    public function forceDeleted(ServicoAgricola $servicoAgricola)
    {
        //
    }
}
