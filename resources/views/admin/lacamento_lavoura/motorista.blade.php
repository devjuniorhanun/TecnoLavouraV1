@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Relátorio de Transportadores</span>
    </h2>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row no-print">
            <div class="col">
                {{-- Abre o formulário --}}
                {!! Form::open(['route' => 'relatorio_motorista']) !!}
                {{-- Chama os campos do formulário --}}
                @include('admin.lacamento_lavoura.form_filtros_motorista')
                {{-- Fecha o formulário --}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="card-body">
        @php
        $totalFrete = 0;
        @endphp
        @forelse ($registros as $listas)
        @php $i = 0;

        @endphp
        <table class="table table-striped table-hover table-sm table-bordered printFont">

            @foreach ($listas as $lista)
            @if($i == 0)
            @php $i++; @endphp
            @php
            $qntViagem = 0;
            $qntPesoBruto = 0;
            $qntSacoBruto = 0;
            $qntSacoLiquido = 0;
            $mediaFrete = 0;
            $qntFrete = 0;

            $qntAdiantamento = 0;
            @endphp
            <thead>
                <tr>
                    <th scope="col" colspan="13">{{$lista->motorista->nome}}</th>
                </tr>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Talhão</th>
                    <th scope="col">Romaneio</th>
                    <th scope="col">Controle</th>
                    <th scope="col">P. Bruto</th>
                    <th scope="col">S. Bruto</th>
                    <th scope="col">Des.</th>
                    <th scope="col">P. Líquido</th>
                    <th scope="col">S. Líquido</th>
                    <th scope="col">Armazén</th>
                    <th scope="col">Colhedor</th>
                    <th scope="col">Frete</th>
                    <th scope="col">Valor Frete</th>
                </tr>
            </thead>
            <tbody>
                @endif

                @if($i > 0)
                @php
                $qntViagem += $i;
                $qntPesoBruto += $lista->peso_bruto;
                $qntSacoBruto += $lista->saco_bruto;
                $qntSacoLiquido += $lista->saco_liquido;
                $qntFrete += $lista->valor_frete;
                $totalFrete += $lista->valor_frete;
                $mediaFrete += $lista->matrizFrete->frete;

                @endphp
                <tr>
                    <th scope="col">{{ Carbon\Carbon::parse($lista->data_colhido)->format('d/m/Y') }}</th>
                    <th scope="col">{{$lista->talhao->nome}}</th>
                    <th scope="col">{{$lista->num_romaneio}}</th>
                    <th scope="col">{{$lista->num_controle}}</th>
                    <th scope="col">{{number_format($lista->peso_bruto, 0, ',', '.')}} Kg</th>
                    <th scope="col">{{number_format($lista->saco_bruto, 3, ',', '.')}} Sc</th>
                    <th scope="col">{{number_format($lista->peso_desconto, 0, ',', '.')}} Kg</th>
                    <th scope="col">{{number_format($lista->peso_liquido, 0, ',', '.')}} Kg</th>
                    <th scope="col">{{number_format($lista->saco_liquido, 3, ',', '.')}} Sc</th>
                    <th scope="col">{{$lista->armazem->nome}}</th>
                    <th scope="col">{{$lista->colhedor->nome}}</th>
                    <th scope="col">R$ {{number_format($lista->matrizFrete->frete, 2, ',', '.')}}</th>
                    <th scope="col">R$ {{number_format($lista->valor_frete, 2, ',', '.')}}</th>
                </tr>
                @endif
           

            @endforeach
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Talhão</th>
                    <th scope="col">Romaneio</th>
                    <th scope="col">Controle</th>
                    <th scope="col">P. Bruto</th>
                    <th scope="col">S. Bruto</th>
                    <th scope="col">Des.</th>
                    <th scope="col">P. Líquido</th>
                    <th scope="col">S. Líquido</th>
                    <th scope="col">Armazén</th>
                    <th scope="col">Colhedor</th>
                    <th scope="col">Frete</th>
                    <th scope="col">Valor Frete</th>
                </tr>
                <tr>
                    <td><strong>Qnt Viagem</strong></td>
                    <td><strong>{{$qntViagem}}</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong>{{number_format($qntPesoBruto, 0, ',', '.')}} Kg</strong></td>
                    <td><strong>{{number_format($qntSacoBruto, 3, ',', '.')}} Sc</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong>{{number_format($qntSacoLiquido, 3, ',', '.')}} Sc</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong>R$ {{number_format(($mediaFrete / $qntViagem) , 2, ',', '.')}}</strong></td>
                    <td><strong>R$ {{number_format($qntFrete, 2, ',', '.')}}</strong></td>
                </tr>


                </tbody>
        </table>

        @empty
        <p>Não foi encontrado Nem um Registro</p>

        @endforelse
        <div class="row">
            <div class="col col-md-10 text-right"><strong>Total Frete</strong></div>
            <div class="col"><strong>R$ {{number_format($totalFrete , 2, ',', '.')}}</strong></div>
        </div>
        <div class="row">
            <div class="col col-md-10 text-right"><strong>Adiantamento</strong></div>
            <div class="col"><strong>R$ {{number_format($adiantemento , 2, ',', '.')}}</strong></div>
        </div>
        <div class="row">
            <div class="col col-md-10 text-right"><strong>Saldo</strong></div>
            <div class="col"><strong>R$ {{number_format(($totalFrete - $adiantemento), 2, ',', '.')}}</strong></div>
        </div>


    </div>
</div>

@endsection
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection