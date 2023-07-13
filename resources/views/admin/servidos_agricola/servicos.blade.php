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
<div class="row mt-4">
    <div class="col">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col col-md-6 border rounded text-center"><b>PRODUTOS</b></div>
                    <div class="col col-md-6 border rounded text-center"><b>QTD. DE PRODUTOS POR BOMBA</b></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @foreach($servico->produto() as $produto)
                <div class="row">
                    <div class="col col-md-6 border text-center">{{$produto->nome}}</div>
                    <div class="col col-md-6 border text-center">{{ str_replace('.',',',$produto->dosagem * $servico->capacidade_bomba)}} {{$produto->unidade}}</div>
                </div>
                @endforeach

                @for($i = count($servico->produto());$i < 10;$i++) <div class="row">
                    <div class="col col-md-6 border rounded text-center"><b>&nbsp;</b></div>
                    <div class="col col-md-6 border rounded text-center"><b>&nbsp;</b></div>
            </div>
            @endfor


        </div>
    </div>

</div>

</div>

<div class="row mt-4">
    @foreach($servico->operador() as $operador)
    @if($operador->tipo_operador =="OPERADOR")
    <div class="col mt-4  col-md-6 border rounded">
        <div class="row">
            <div class="col border rounded text-center">
                <b>CONTROLE DE APLICAÇÃO DATA.: __/__/____</b>
            </div>
        </div>
        <div class="row">
            <div class="col border rounded">
                <div class="row">
                    <div class="col">Nº UNIPORT.: _________________________</div>
                    <div class="col">FRENTE DE SERVIÇO.:___________________</div>
                </div>
                <div class="row">
                    <div class="col"><b>OPERADOR.: {{ $operador->nome }}</b></div>
                </div>
                <div class="row">
                    <div class="col text-center"><b>APLICAÇÕES ANTEIORES</b></div>
                </div>
                <div class="row">
                    <div class="col">TALHÃO (ANTERIOR).:___________________</div>
                    <div class="col">RESTO DE CALDAS(LT).:__________________</div>
                </div>
                <div class="row">
                    <div class="col">
                        1 ( ) 2 ( ) 3 ( ) 4 ( ) 5 ( ) 6 ( ) 7 ( ) 8 ( ) 9 ( ) 10 ( ) 11 ( ) 12 ( )
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        RESTO DE CALDA (TALHÃO ATUAL).: ___________________
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        TOTAL DE BOMBAS APLICADAS.: ___________________________
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
    @endforeach
    @for($i = count($servico->operador());$i <= 6;$i++) 
    <div class="col mt-4  col-md-6 border rounded">
        <div class="row">
            <div class="col border rounded text-center">
                <b>CONTROLE DE APLICAÇÃO DATA.: __/__/____</b>
            </div>
        </div>
        <div class="row">
            <div class="col border rounded">
                <div class="row">
                    <div class="col">Nº UNIPORT.: _________________________</div>
                    <div class="col">FRENTE DE SERVIÇO.:___________________</div>
                </div>
                <div class="row">
                    <div class="col"><b>OPERADOR.: _________________________</b></div>
                </div>
                <div class="row">
                    <div class="col text-center"><b>APLICAÇÕES ANTEIORES</b></div>
                </div>
                <div class="row">
                    <div class="col">TALHÃO (ANTERIOR).:___________________</div>
                    <div class="col">RESTO DE CALDAS(LT).:__________________</div>
                </div>
                <div class="row">
                    <div class="col">
                        1 ( ) 2 ( ) 3 ( ) 4 ( ) 5 ( ) 6 ( ) 7 ( ) 8 ( ) 9 ( ) 10 ( ) 11 ( ) 12 ( )
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        RESTO DE CALDA (TALHÃO ATUAL).: ___________________
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        TOTAL DE BOMBAS APLICADAS.: ___________________________
                    </div>
                </div>
            </div>

        </div>
    </div>

    @endfor
</div>


<div class="row mt-5">
    <div class="col">TOTAL GERAL DE BOMBAS REIAS APLICADAS.: _____________________________________________________</div>
</div>
@endsection

@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection