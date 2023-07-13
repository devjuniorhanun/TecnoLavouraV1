@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Relátorio de Contas por Centro de Custo Mês Novembro de 2021</span>
    </h2>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header no-print">
        <div class="row no-print">
            <div class="col">
                {{-- Abre o formulário --}}
                {!! Form::open(['route' => 'relatorios_contas']) !!}
                {{-- Chama os campos do formulário --}}
                @include('relatorios.contas.filtro_data_lancamento')
                {{-- Fecha o formulário --}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table border table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>Centro de Custo</th>
                    <th>Valor</th>

                </tr>
            </thead>
            <tbody>
                @php $totalGeral = 0; @endphp
                @forelse ($registros as $lista)
                @php
                $totalGeral += $lista->valorTotal;
                $totalRh = 0;
                @endphp
                @if($lista->nome == "DEPARTAMENTO PESSOAL RH")

                @if(!empty($folhaPagamento))
                @php $totalRh += $folhaPagamento->folhaTotal @endphp
                @endif

                @if(!empty($cheques))
                @php $totalRh += $cheques->chequeTotal @endphp
                @endif

                @if(!empty($caixaAdiantamento))
                @php  $totalRh += $caixaAdiantamento->adiantamentoTotal @endphp
                @endif

                @php $totalGeral += $totalRh; @endphp
                <tr>
                    <td>{{$lista->nome}}</td>
                    <td><b>457.826,04</b></td>

                </tr>


                @endif
                @if($lista->nome != "DEPARTAMENTO PESSOAL RH")
                <tr>
                    <td>{{$lista->nome}}</td>
                    <td><b>R$ {{ number_format(($lista->valorTotal), 2, ',', '.') }}</b></td>

                </tr>
                @endif
                @empty
                <p>Não foi encontrado Nem um Registro</p>
                @endforelse
                

            </tbody>

        </table>
        <table class="table table-striped table-hover max-width table-sm">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><b>Total.:<b></td>
                <td><b>R$ {{ number_format($totalGeral, 2, ',', '.') }}<b></td>

            </tr>

        </table>

        <table class="table table-striped table-hover max-width table-sm">
            <tr>
                <td colspan="6"><b>Totais de Pagamentos</b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Cheques</b></td>
                <td><b>R$ {{ number_format($cheques->chequeTotal, 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Caixa</b></td>
                <td>
                    <b>R$ {{ number_format($caixaTotal->valorTotal, 2, ',', '.')}}</b>
                </td>
            </tr>
            <tr>
                <td colspan="5"><b>Rural Contabil</b></td>
                <td><b>R$ {{ number_format($folhaPagamento->folhaTotal, 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Boletos</b></td>
                <td><b>R$ {{ number_format($boletos->boletoTotal, 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Pagamentos Ribeirão</b></td>
                <td><b>R$ {{ number_format($transferencia->transferenciaTotal, 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Requisição Bom Jesus</b></td>
                <td><b>R$ {{ number_format($bomJesus->bomJesusTotal, 2, ',', '.') }}<b></td>
            </tr>

        </table>
        <table class="table table-striped table-hover max-width table-sm">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><b>Total.:<b></td>
                <td><b>R$ {{ number_format(($totalGeral), 2, ',', '.') }}<b></td>

            </tr>

        </table>


    </div>



</div>

@endsection
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection