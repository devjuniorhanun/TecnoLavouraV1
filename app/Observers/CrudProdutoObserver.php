<?php

namespace App\Observers;

use App\Models\Produto;
use Illuminate\Support\Str;

class CrudProdutoObserver
{
    /**
     * Handle the Produto "creating" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function creating(Produto $produto)
    {
        $data = $produto;

        if (mb_strpos($data['estoque'], ',') !== false) {
            $data['estoque'] = Str::replace('.', "", $data['estoque']);
            $produto->estoque = Str::replace(',', ".", $data['estoque']);
        }
        if (mb_strpos($data['valor_unitario'], ',') !== false) {
            $data['valor_unitario'] = Str::replace('.', "", $data['valor_unitario']);
            $produto->valor_unitario = Str::replace(',', ".", $data['valor_unitario']);
        }
    }

    /**
     * Handle the Produto "updating" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function updating(Produto $produto)
    {
        $data = $produto;

        if (mb_strpos($data['estoque'], ',') !== false) {
            $data['estoque'] = Str::replace('.', "", $data['estoque']);
            $produto->estoque = Str::replace(',', ".", $data['estoque']);
        }
        if (mb_strpos($data['valor_unitario'], ',') !== false) {
            $data['valor_unitario'] = Str::replace('.', "", $data['valor_unitario']);
            $produto->valor_unitario = Str::replace(',', ".", $data['valor_unitario']);
        }
    }

    /**
     * Handle the Produto "deleted" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function deleted(Produto $produto)
    {
        //
    }

    /**
     * Handle the Produto "restored" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function restored(Produto $produto)
    {
        //
    }

    /**
     * Handle the Produto "force deleted" event.
     *
     * @param  \App\Models\Produto  $produto
     * @return void
     */
    public function forceDeleted(Produto $produto)
    {
        //
    }
}
