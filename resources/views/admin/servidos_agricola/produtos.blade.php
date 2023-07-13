@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <div class="row  d-print-none">
        <div class="col rounded">
            <h2>
                <span class="text-capitalize">Controle Agriculas</span>
            </h2>
        </div>
    </div>
</div>
@endsection


@section('content')
<div class="row rounded">
    <div class="col col-md-12 border rounded text-center">FAZENDA SANTA MARTHA</div>
    <div class="col col-md-12 border rounded text-center">PAULO ROBERTO TITOTO</div>
</div>
<div class="row rounded mt-4">
    <div class="col col-md-12 border rounded text-center"><b>ORDEN DE SERVIÇO DE APLICAÇÃO DE DEFENSIVOS AGRÍCOLA SAFRA 20/21 Nº {{ $servico->id}}</b></div>
    <div class="col col-md-12 border rounded text-center">
        <div class="row">
            <div class="col col-md-3">TALHÃO.: {{ $servico->talhao->nome }}</div>
            <div class="col col-md-2">ÁREA.: {{ $servico->area }}</div>
            <div class="col col-md-2">VOLUME BOMBA.: {{ $servico->volume_bomba }}</div>
            <div class="col col-md-2">VAZÃO(LT).: {{ $servico->vazao }}</div>
            <div class="col col-md-2">CAP. BOMBA.: {{ $servico->capacidade_bomba }}</div>
        </div>
        <div class="row">
            <div class="col col-md-3">OPERÃO.: {{ $servico->tipoOperacaoAgricula->nome }}</div>
            <div class="col col-md-2">BOMBA PRIVISTA.: {{ $servico->bomba_recomendada }}</div>
            <div class="col col-md-2">BOMBAS REAIS.: </div>
            <div class="col col-md-2">DIFERENÇA(%).: </div>
            <div class="col col-md-2">DATA.: {{ Carbon\Carbon::parse($servico->data)->format('d/m/Y') }}</div>
        </div>
    </div>
</div>
<br>

        {{-- Abre o formulário --}}
        {!! Form::open(['route' => 'relatorio_safra']) !!}
        {{-- Chama os campos do formulário --}}
        @foreach($produtos as $produto)
        <div class="form-group row">
            {!! Form::label('first_weigh', __("$produto->nome").'.:', ['class' => 'col-md-2 col-form-label text-md-right']); !!}
             <div class="col-md-2">
        {!! Form::text('teste', $produto->quantidade, ['class' => 'form-control area','placeholder' => __("translate.Second Weighing")]) !!}
    </div>
        </div>
        

        @endforeach
        
        {{-- Fecha o formulário --}}
        {!! Form::close() !!}

@endsection

@section('after_styles')
<link rel="stylesheet" href="{{ asset('packages/backpack/crud/js/form.js') }}">
@endsection