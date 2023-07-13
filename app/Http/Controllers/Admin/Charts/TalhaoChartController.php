<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\LancamentoSafra;
use App\Models\Talhao;
use Backpack\CRUD\app\Http\Controllers\ChartController;
//use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;
use Illuminate\Support\Facades\DB;

/**
 * Class TalhaoChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TalhaoChartController extends ChartController
{
    public function setup()
    {
        $talhoes = LancamentoSafra::select('talhao_id')->where('safra_id', '=', 8)->groupBy('talhao_id')->get();

        $nomeTalhao = [];
        $qutSacos = [];
        $cores = [];
        //dd($talhoes);
        foreach ($talhoes as $talhao) {
            //dd($talhao->talhao_id);
            $nomeTalhao[] = Talhao::find($talhao->talhao_id)->nome;
            $qutSacos[] = LancamentoSafra::where('safra_id', '=', 8)->where('talhao_id', '=', $talhao->talhao_id)
                ->select(DB::raw('SUM(peso_bruto) as peso'))->first()->peso;
            $cores[] = 'rgb(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ')';
        }
        //dd($cores);

        $this->chart = new Chart();
        $this->chart->dataset('Red', 'pie', $qutSacos)
            ->color($cores);

        // OPTIONAL
        $this->chart->displayAxes(false);
        $this->chart->displayLegend(true);

        // MANDATORY. Set the labels for the dataset points
        $this->chart->labels($nomeTalhao);

        // RECOMMENDED. Set URL that the ChartJS library should call, to get its data using AJAX.
        $this->chart->load(backpack_url('charts/talhao'));

        // OPTIONAL
        // $this->chart->minimalist(false);
        // $this->chart->displayLegend(true);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    // public function data()
    // {
    //     $users_created_today = \App\User::whereDate('created_at', today())->count();

    //     $this->chart->dataset('Users Created', 'bar', [
    //                 $users_created_today,
    //             ])
    //         ->color('rgba(205, 32, 31, 1)')
    //         ->backgroundColor('rgba(205, 32, 31, 0.4)');
    // }
}
