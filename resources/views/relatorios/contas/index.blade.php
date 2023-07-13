@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Relátorio de Contas Pagas Mês de {{$mes}} de 2023</span>
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

            </thead>
            <tbody>
                <tr>
                    <th scope="col">Fornecedor(a)</th>
                    <th scope="col">Centro de Custo</th>
                    <th scope="col">Nº Documento</th>
                    <th scope="col">Lançamento</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Descrição</th>
                </tr>
                @php
                $grupoId = 0; // Id do Grupo
                $totalGrupo = 0; //Valor total dos grupos
                $i = 0;
                $valorTotal = 0; // Valor total de todos os grupos
                $totalFolha = 0; // Valor da Folha de Pagamento
                $totalCaixa = 0; // Total do Caixa
                $totalAdiantamento = 0; // Total de Adiantamentos

                @endphp
                @forelse ($registros as $lista)
                @php
                $i++;
                $valorTotal += $lista->valor;
                if($grupoId == 0){
                $grupoId = $lista->fornecedor_id;
                }

                if($grupoId != $lista->fornecedor_id){
                if($totalGrupo > 0){

                @endphp
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td><b>Total.:</b></td>
                    <td colspan="2"><b>R$ {{ number_format($totalGrupo, 2, ',', '.') }}</b></td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                @php
                }
                $grupoId = $lista->fornecedor_id;
                $totalGrupo = 0;
                }


                if(($grupoId == $lista->fornecedor_id) && ($lista->centro_custo_id != 47)){
                $totalGrupo += $lista->valor;

                @endphp
                <tr>
                    <td>{{$lista->fornecedor->razao_social}}</td>
                    <td>{{ $lista->centroCusto->nome }}</td>
                    <td>{{ $lista->numero_documento }}</td>
                    <td>{{ Carbon\Carbon::parse($lista->data_documento)->format('d/m/Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($lista->data_vencimento)->format('d/m/Y') }}</td>
                    <td>R$ {{ number_format($lista->valor, 2, ',', '.') }}</td>
                    <td>{{ $lista->descricao}}</td>
                </tr>
                @php
                } if($i == count($registros)){

                @endphp
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td><b>Total.:</b></td>
                    <td colspan="2"><b>R$ {{ number_format($totalGrupo, 2, ',', '.') }}</b></td>
                    <td colspan="2">&nbsp;</td>

                </tr>
                @php
                }

                @endphp

                @empty

                <p>Não foi encontrado Nem um Registro</p>
                @endforelse
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="2"><b>Totais Boletos e Transferencias.:</b></td>
                    <td colspan="2"><b>R$ {{ number_format($valorTotal, 2, ',', '.') }}</b></td>
                    <td colspan="2">&nbsp;</td>

                </tr>

            </tbody>
        </table>

        <table class="table border table-striped table-hover table-sm">
            <tr>
                <td colspan="7"><b>Caixa</b></td>
            </tr>
            @foreach($lancaCaixa as $caixa)
            @php $totalCaixa += $caixa->valor; @endphp
            <tr>
                <td colspan="3">{{ $caixa->descricao}}</td>
                <td>{{ Carbon\Carbon::parse($caixa->data_documento)->format('d/m/Y') }}</td>
                <td colspan="3">R$ {{ number_format($caixa->valor, 2, ',', '.') }}</td>

            </tr>
            @endforeach
            <tr>
                <td colspan="3">&nbsp;</td>
                <td><b>Total Caixa.:</b></td>
                <td colspan="2"><b>{{ number_format($totalCaixa, 2, ',', '.') }}</b></td>
            </tr>

        </table>
        <table class="table border table-striped table-hover table-sm">
            <tr>
                <td colspan="7"><b>Cheques</b></td>
            </tr>
            @foreach($cheques as $cheque)


            <tr>
                <td>{{ $cheque->produtor->razao_social}}</td>
                <td>{{ Carbon\Carbon::parse($cheque->data_lancamento)->format('d/m/Y') }}</td>
                <td>{{ $cheque->para_quem}}</td>
                <td>{{ $cheque->descricao_lancamento}}</td>
                <td colspan="3">R$ {{ number_format($cheque->valor_lancamento, 2, ',', '.') }}</td>


            </tr>
            @endforeach
            <tr>
                <td colspan="3">&nbsp;</td>
                <td><b>Total Cheque.:</b></td>
                <td colspan="3">R$ {{ number_format($totalCheque, 2, ',', '.') }}</td>
            </tr>

        </table>
        <table class="table border table-striped table-hover table-sm">
            <tr>
                <td colspan="8"><b>Adiantamentos</b></td>
            </tr>
            @foreach($caixaAdiantamento as $adiantamento)
            @php $totalAdiantamento += $adiantamento->valor_lancamento; @endphp
            <tr>
                <td colspan="6">{{$adiantamento->descricao_lancamento}}</td>
                <td colspan="1">{{ number_format($adiantamento->valor_lancamento, 2, ',', '.')}}</td>
            </tr>

            @endforeach
            <tr>
                <td colspan="4">&nbsp;</td>
                <td colspan="2"><b>Totais Adiantamentos.:</b></td>
                <td colspan="2"><b>{{ number_format($totalAdiantamento, 2, ',', '.') }}</b></td>
            </tr>


        </table>

        <table class="table border table-striped table-hover table-sm">
            <tr>
                <td colspan="8"><b>Folha de Pagamento</b></td>
            </tr>
            @foreach($depPessoal as $pessoal)
            @php $totalFolha += $pessoal->valor; @endphp
            <tr>
                <td colspan="2">{{ substr($pessoal->fornecedor->nome_fantasia,0,25) }}</td>
                <td>{{ $pessoal->centroCusto->nome }}</td>
                <td>{{ Carbon\Carbon::parse($pessoal->data_documento)->format('d/m/Y') }}</td>
                <td colspan="2">{{ $pessoal->descricao}}</td>
                <td>R$ {{ number_format($pessoal->valor, 2, ',', '.') }}</td>
            </tr>


            @endforeach
            @foreach($folhaPagamento as $folha)
            @php $totalFolha += $folha->valor_lancamento; @endphp
            <tr>
                <td colspan="2">{{$folha->produtor->razao_social}}</td>
                <td colspan="2">{{$folha->centroAdministrativo->fazenda->nome}}</td>
                <td colspan="2">{{$folha->descricao_lancamento}}</td>
                <td>{{ number_format($folha->valor_lancamento, 2, ',', '.')}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5">&nbsp;</td>
                <td><b>Total Folha.:</b></td>
                <td colspan="2"><b>{{ number_format($totalFolha, 2, ',', '.') }}</b></td>
            </tr>
            <tfoot>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </tfoot>

        </table>

        <table class="table table-hover border max-width">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-right"><b>Total Geral.:</b></td>
                <td class="text-left"><b>R$ {{ number_format(($valorTotal + $totalFolha + $totalCaixa + $totalAdiantamento + $totalCheque), 2, ',', '.') }}</b></td>

            </tr>
            <tfoot>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection