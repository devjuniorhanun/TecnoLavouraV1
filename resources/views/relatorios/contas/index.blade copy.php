@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Relátorio de Contas Pagas Mês Nobembro de 2021</span>
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
                    <th scope="col">Fornecedor(a)</th>
                    <th scope="col">Centro de Custo</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Lançamento</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Valor</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">Descrição</th>
                </tr>
            </thead>
            <tbody>
                @php
                $valorTotal = 0;
                $grupoId = 0;
                $totalGrupo = 0;
                $totalGrupoDesconto = 0;
                $teste = 0;
                $grupoId = 0;
                $totalFolha = 0;
                $totalCheque = 0;
                $totalAdiantamento = 0;
                $fechamentoGrupo = 0;
                //dd(count($registros));
                $i = 0;
                @endphp
                @forelse ($registros as $lista)
                @if($lista->centro_custo_id != 8)
                @php
                $i++;
                $valorTotal += ($lista->valor - $lista->valor_desconto);
                if($lista->fornecedor_id != $grupoId)
                {
                if($totalGrupo > 0){
                @endphp
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td><b>Total.:</b></td>
                    <td colspan="2"><b>{{ number_format($totalGrupo, 2, ',', '.') }}</b></td>
                    <td colspan="2">&nbsp;</td>

                </tr>

                @php
                }
                $grupoId = $lista->fornecedor_id;
                $totalGrupo = 0;
                $totalGrupoDesconto = 0;

                }
                if($lista->fornecedor_id == $grupoId){
                $totalGrupo += $lista->valor;
                $totalGrupoDesconto += $lista->valor_desconto;

                }


                @endphp
                <tr>
                    <td>{{ substr($lista->fornecedor->nome_fantasia,0,25) }}</td>
                    <td>{{ $lista->centroCusto->nome }}</td>
                    <td>{{ $lista->numero_documento }}</td>
                    <td>{{ Carbon\Carbon::parse($lista->data_documento)->format('d/m/Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($lista->data_vencimento)->format('d/m/Y') }}</td>
                    <td>{{ number_format($lista->valor, 2, ',', '.') }}</td>
                    <td>&nbsp;</td>
                    <td>{{ $lista->descricao}}</td>
                </tr>
                @if($i == (count($registros)))
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td><b>Total.:</b></td>
                    <td colspan="2"><b>{{ number_format($totalGrupo, 2, ',', '.') }}</b></td>
                    <td colspan="2">&nbsp;</td>

                </tr>
                @endif
                @endif



                @empty
                <p>Não foi encontrado Nem um Registro</p>
                @endforelse
                <tr>
                    <td colspan="11"><b>Folha de Pagamento</b></td>
                </tr>
                @forelse ($registros as $lista)
                @if($lista->centro_custo_id == 8)
                @php
                $i++;
                $valorTotal += ($lista->valor - $lista->valor_desconto);
                if($lista->fornecedor_id != $grupoId)
                {
                if($totalGrupo > 0){
                @endphp


                @php
                }
                $grupoId = $lista->fornecedor_id;
                $totalGrupo = 0;
                $totalGrupoDesconto = 0;

                }
                if($lista->fornecedor_id == $grupoId){
                $totalGrupo += $lista->valor;
                $totalGrupoDesconto += $lista->valor_desconto;

                }


                @endphp
                <tr>
                    <td colspan="2">{{ substr($lista->fornecedor->nome_fantasia,0,25) }}</td>

                    <td colspan="5">{{ $lista->descricao}}</td>
                    <td>{{ number_format($lista->valor, 2, ',', '.') }}</td>
                    <td>&nbsp;</td>


                </tr>

                @endif



                @empty
                <p>Não foi encontrado Nem um Registro</p>
                @endforelse

                @foreach($folhaPagamento as $folha)
                @php $totalFolha += $folha->valor_lancamento; @endphp
                <tr>
                    <td colspan="2">{{$folha->produtor->razao_social}}</td>
                    <td colspan="3">{{$folha->centroAdministrativo->fazenda->nome}}</td>
                    <td colspan="2">{{$folha->descricao_lancamento}}</td>
                    <td>{{ number_format($folha->valor_lancamento, 2, ',', '.')}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6">&nbsp;</td>
                    <td><b>Total.:</b></td>
                    <td colspan="2"><b>{{ number_format($totalFolha, 2, ',', '.') }}</b></td>
                </tr>
                <tr>
                    <td colspan="11"><b>Cheques</b></td>
                </tr>
                @if(!empty($cheques))
                @foreach($cheques as $cheque)
                @php $totalCheque += $cheque->valor_lancamento; @endphp
                <tr>
                    <td colspan="2">{{$cheque->para_quem}}</td>
                    <td colspan="5">{{$cheque->descricao_lancamento}}</td>
                    <td>{{ number_format($cheque->valor_lancamento, 2, ',', '.')}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6">&nbsp;</td>
                    <td><b>Total.:</b></td>
                    <td colspan="2"><b>{{ number_format($totalCheque, 2, ',', '.') }}</b></td>
                </tr>
                @endif
                @if(!empty($caixaAdiantamento))
                <tr>
                    <td colspan="11"><b>Adiantamentos</b></td>
                </tr>
                @foreach($caixaAdiantamento as $adiantamento)
                @php $totalAdiantamento += $adiantamento->valor_lancamento; @endphp
                <tr>
                    <td colspan="7">{{$adiantamento->descricao_lancamento}}</td>
                    <td>{{ number_format($adiantamento->valor_lancamento, 2, ',', '.')}}</td>
                </tr>

                @endforeach


                <tr>
                    <td colspan="6">&nbsp;</td>
                    <td><b>Total.:</b></td>
                    <td colspan="2"><b>{{ number_format($totalAdiantamento, 2, ',', '.') }}</b></td>
                </tr>

                @endif
                

            </tbody>

        </table>
        <table>
            <tr>

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
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><b>Total.:<b></td>
                <td><b>{{ number_format(($valorTotal + $totalFolha + $totalCheque + $totalAdiantamento), 2, ',', '.') }}<b></td>
            </tr>

        </table>
    </div>
</div>

@endsection
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection