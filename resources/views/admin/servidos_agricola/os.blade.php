@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <div class="row  d-print-none">
        <div class="col rounded">
            <h2>
                <span class="text-capitalize">Operação Agrícola</span>
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
    <div class="col col-md-12 border rounded text-center"><b>ORDEN DE SERVIÇO DE APLICAÇÃO DE DEFENSIVOS AGRÍCOLA {{$servico->safra->nome}} -  Nº {{ $servico->num_os}}</b></div>
    <div class="col col-md-12 border rounded text-center">
        <div class="row">
        <div class="col col-md-3">FAZENDA.: {{ $servico->talhao->fazenda->nome }}</div>    
        <div class="col col-md-3">TALHÃO.: {{ $servico->talhao->nome }}</div>
            <div class="col col-md-2">ÁREA.: {{ $servico->area }}</div>
            <div class="col col-md-2">CULTURA.: {{ $servico->cultura->nome }}</div>
            <div class="col col-md-2">VAZÃO(LT).: {{ $servico->vazao }}</div>
            <div class="col col-md-2">CAP. BOMBA.: {{ $servico->capacidade_bomba }}</div>
            <div class="col col-md-2">VOLUME. BOMBA.: {{ $servico->volume_bomba }}</div>
             <div class="col col-md-3">OPERÃO.: {{ $servico->tipoOperacaoAgricula->nome }}</div>
            <div class="col col-md-2">BOMBA PRIVISTA.: {{ $servico->bomba_recomendada }}</div>
            <div class="col col-md-2">BOMBAS REAIS.: {{ @(isset($servico->bomba_usada))? number_format(($servico->bomba_usada), 3, '.', '.') : number_format(($servico->bomba_recomendada), 3, '.', '.') }}</div>
            <div class="col col-md-2">DIFERENÇA(%).: {{ $servico->diferenca_bomba }} %</div>
            <div class="col col-md-2">DATA.: {{ Carbon\Carbon::parse($servico->data)->format('d/m/Y') }}</div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col col-md border rounded text-center"><b>PRODUTOS</b></div>
                    <div class="col col-md border rounded text-center"><b>UNID.</b></div>
                    <div class="col col-md border rounded text-center"><b>QTD. BOMBA</b></div>
                    <div class="col col-md border rounded text-center"><b>DOSE(HA) REC</b></div>
                    <div class="col col-md border rounded text-center"><b>DOSE(HA)REAL</b></div>
                    <div class="col col-md border rounded text-center"><b>DIF.</b></div>
                    <div class="col col-md border rounded text-center"><b>TOTAL PRODUTO.</b></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @foreach($servico->produto() as $produto)
                <div class="row">
                    <div class="col col-md border text-center">{{$produto->nome}}</div>
                    <div class="col col-md border text-center">{{$produto->unidade}}</div>
                    <div class="col col-md border text-center">{{ number_format($produto->qtn_bomba, 3, '.', '.')}} {{$produto->unidade}}</div>
                    <div class="col col-md border text-center">{{ number_format(($produto->dosagem), 3, '.', '.')}} {{$produto->unidade}}</div>
                    <div class="col col-md border text-center">{{ number_format(($produto->dosagem_real), 3, '.', '.')}} {{$produto->unidade}}</div>
                    <div class="col col-md border text-center">{{ $servico->diferenca_bomba }} %</div>
                    <div class="col col-md border text-center">{{number_format(($produto->quantidade_real), 3, '.', '.') }}</div>
                </div>
                @endforeach
            </div>

        </div>
        <div class="row pt-5">
            <div class="col">
                Bombas Reais.: {{ @(isset($servico->bomba_usada))? number_format(($servico->bomba_usada), 3, '.', '.') : number_format(($servico->bomba_recomendada), 3, '.', '.') }}
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">__________________________________</div>
                </div>
                <div class="row">
                    <div class="col-md-2">&nbsp;</div>
                    <div class="col">Vinicius</div>
                </div>
            </div>
        </div>

    </div>


    @endsection

@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection