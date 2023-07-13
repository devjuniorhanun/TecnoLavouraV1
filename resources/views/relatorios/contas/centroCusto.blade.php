@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Relátorio de Contas por Centro de Custo Mês de {{$mes}} de 2023</span>
    </h2>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header no-print">
        <div class="row no-print">
            <div class="col">
                {{-- Abre o formulário --}}
                {!! Form::open(['route' => 'relatorios_contas_centros']) !!}
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
                    <th>Centro de Custo.:</th>
                    <th>Valor</th>

                </tr>
            </thead>
            <tbody>
                @php
                $totalRh = 0; //Valor total do Rh
                $totalGeral = 0; // Valor total dos lançamentos
                $departamentoPessoal = 0; // Adicional Folha
                @endphp
                
            @forelse ($registros as $lista)
            @php $totalGeral += $lista->valorTotal; @endphp
            
           
            <tr>
                    <td>{{$lista->centroCusto->nome}}</td>
                    <td><b>R$ {{ number_format(($lista->valorTotal), 2, ',', '.') }}</b></td>

                </tr>

            @empty
                <p>Não foi encontrado Nem um Registro</p>
                @endforelse
                <tr>
                    <td><b>Totais</b></td>
                    <td><b>R$ {{ number_format(($totalGeral), 2, ',', '.') }}</b></td>

                </tr>

            </tbody>

        </table>

        <table class="table table-striped table-hover max-width table-sm">
            <tr>
                <td colspan="6"><b>Totais de Pagamentos.:</b></td>
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
                <td colspan="5"><b>Adiantamento</b></td>
                <td><b>R$ {{ number_format($caixaAdiantamento->adiantamentoTotal, 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Rural Contabil</b></td>
                <td><b>R$ {{ number_format(($folhaPagamento->folhaTotal), 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="6"><b>Pagamentos Ribeirão.:</b></td>
                
            </tr>
            <tr>
                <td colspan="5"><b>Cheque Frete</b></td>
                <td><b>R$ {{ number_format($chequeFrete->total, 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Cheque Adiantamento</b></td>
                <td><b>R$ {{ number_format($chequeAdiantamento->total, 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Boletos</b></td>
                <td><b>R$ {{ number_format($boletos->boletoTotal, 2, ',', '.') }}<b></td>
            </tr>
            <tr>
                <td colspan="5"><b>Transferências</b></td>
                <td><b>R$ {{ number_format($transferencia->transferenciaTotal, 2, ',', '.') }}<b></td>
            </tr>
            
            <tr>
                    <td colspan="5"><b>Totais Geral</b></td>
                    <td><b>R$ {{ number_format($boletos->boletoTotal + $transferencia->transferenciaTotal +
                                                $caixaTotal->valorTotal  +
                                               $cheques->chequeTotal + $chequeAdiantamento->total +
                                               $folhaPagamento->folhaTotal + $chequeFrete->total , 2, ',', '.') }}<b></td>
                    

                </tr>

        </table>


    </div>



</div>

@endsection
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection