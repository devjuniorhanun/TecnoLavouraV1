<?php

namespace App\Providers;

use App\Models\{
    Produto,
    ServicoAgricola,
};
use App\Models\Lancamentos\{
    Caixa,
    ChequeEmitido,
    Folha,
};

use App\Observers\{
    CrudProdutoObserver,
    CrudServicoAgricolaObserver
};
use App\Observers\Lancamentos\
{
    CaixaObserver,
    ChequeEmitidoObserver,
    FolhaObserver,
};
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Produto::observe(CrudProdutoObserver::class);
        ServicoAgricola::observe(CrudServicoAgricolaObserver::class);
        Caixa::observe(CaixaObserver::class);
        Folha::observe(FolhaObserver::class);
        ChequeEmitido::observe(ChequeEmitidoObserver::class);
    }
}
