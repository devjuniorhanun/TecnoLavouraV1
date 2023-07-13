@extends(backpack_view('blank'))

@php
use Illuminate\Support\Facades\DB;
$colherido = number_format(DB::table('lancamento_safras')->where('safra_id', '=', '8')->whereNull('deleted_at')->select(DB::raw('SUM(peso_liquido) as peso'))->first()->peso, 0, '.', '.');
$sacos = number_format(DB::table('lancamento_safras')->where('safra_id', '=', '8')->whereNull('deleted_at')->select(DB::raw('SUM(saco_liquido) as sacoLiquido'))->first()->sacoLiquido, 0, '.', '.');
//dd($sacos);
Widget::add()->to('before_content')->type('div')->class('row')->content([
// notice we use Widget::make() to add widgets as content (not in a group)
Widget::make()
->type('progress')
->class('card border-0 text-white bg-primary')
->progressClass('progress-bar')
->description('Quantidade Colhido Kg.')
->value($colherido),
Widget::make()
->type('progress')
->class('card border-0 text-white bg-success')
->progressClass('progress-bar')
->description('Quantidade Colhido Sc.')
->value($sacos),
/*Widget::make()
->type('progress')
->class('card border-0 text-white bg-warning')
->progressClass('progress-bar')
->description('Quantidade Colhido Sc.')
->value($sacos),*/

]);


$widgets['after_content'][] = [
'type' => 'div',
'class' => 'row',
'content' => [ // widgets
[
'type' => 'chart',
'wrapperClass' => 'col-md-6',
// 'class' => 'col-md-6',
'controller' => \App\Http\Controllers\Admin\Charts\TalhaoChartController::class,
'content' => [
'header' => 'Talhões', // optional
// 'body' => 'This chart should make it obvious how many new users have signed up in the past 8 days.<br><br>', // optional
]
],


]
];
@endphp

@section('content')
@endsection