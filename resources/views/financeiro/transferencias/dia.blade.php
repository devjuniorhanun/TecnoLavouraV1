@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Transferencia</span>
    </h2>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row no-print">
            <div class="col">
                {{-- Abre o formulário --}}
                {!! Form::open(['route' => 'transferencia-dia']) !!}
                {{-- Chama os campos do formulário --}}
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="ciclo_id">&nbsp;</label><br>
                        {{ Form::date('dataInicial', \Carbon\Carbon::now())}}
                {{ Form::date('dataFinal', \Carbon\Carbon::now())}}
                        {!! Form::submit('Filtrar', ['id' => 'Filtrar','class' => 'btn btn-info btn-sm']); !!}
                    </div>
                </div>
                {{-- Fecha o formulário --}}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
    <div class="card-body">


        <table class="table border table-sm font-weight-bolder">
            <thead>
                <tr>
                    <th>
                        <center>RELAÇÃO DE PAGAMENTOS A SEREM EFETUADOS</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php $i = 0; @endphp


                @foreach($transferencias as $transferencia)





                @php $i++ ; @endphp
                <tr>
                    <td>
                        <table class="table border font-weight-bolder">
                            <tr>
                                <td class="text-center border">DADOS DO DEPOSITANTE.:</td>
                                <td class="text-right"><b>{{ $i }}</b></td>

                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="table border font-weight-bolder ">
                            <tr>
                                <td class="text-right border">NOME.:</td>
                                <td class="border">PAULO ROBERTO TITOTO</td>
                                <td class="text-right">FAZENDA.:</td>
                                <td class="border">SANTA MARTHA</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="borde text-center">
                    <td>DADOS DO BENEFICIARIO.:</td>
                </tr>
                <tr>
                    <td>
                        <table class="table font-weight-bolder">
                            <tr>
                                <td class="text-right">BANCO.:</td>
                                <td>{{ $transferencia->fornecedores[0]['banco'] }}</td>
                                <td class="text-right">NR BCO.:</td>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="text-right">AGENCIA.:</td>
                                <td>{{ $transferencia->fornecedores[0]['agencia'] }}</td>
                                <td class="text-right">OP.:</td>
                                <td>{{ ($transferencia->fornecedores[0]['op'] != "null" )? $transferencia->fornecedores[0]['op'] : '' }}</td>
                                <td class="text-right">Num/C.:</td>
                                <td>{{ $transferencia->fornecedores[0]['conta'] }}</td>
                                <td class="text-right">Conta.:</td>
                                <td>{{ (isset($transferencia->fornecedores[0]['op']))? 'POUPANÇA' : 'CORRENTE'  }}</td>
                            </tr>
                            <tr>
                                <td class="text-right">FAVORECIDO.:</td>
                                <td>{{ $transferencia->fornecedores[0]['contato'] }}</td>
                                <td class="text-right">CONTATO.:</td>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td class="text-right">CPF/CNPJ.:</td>
                                <td>{{ $transferencia->fornecedores[0]['cpf_cnpj'] }}</td>
                                <td class="text-right">VALOR.:</td>
                                <td class="text-danger" colspan="5">( {{number_format($transferencia->fornecedores[0]['valor'], 2, ',', '.')}} )</td>
                            </tr>
                            <tr>
                                <td class="text-right">COD ID.:</td>
                                <td></td>
                                <td>&nbsp;</td>
                                <td class="text-danger" colspan="5">( {{extenso(number_format($transferencia->fornecedores[0]['valor'], 2, ',', '.'))}} )</td>
                            </tr>
                            <tr>
                                <td>DESCRIÇÃO PAGAMENTO.:</td>
                                <td colspan="7">{{$transferencia->fornecedores[0]['descricao']}}</td>
                            </tr>
                            <tr>
                                <td>AUTORIZADO POR.:</td>
                                <td colspan="7">LEONARDO NAVES TITOTO</td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr class="testeA">
                    <td class="testeA">&nbsp;</td>
                </tr>

                @endforeach
            </tbody>

        </table>
    </div>
    @endsection

    @section('after_styles')
    <!-- DATA TABLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css').'?v='.config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css').'?v='.config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet" href="{{ asset('css/printa.css') }}">
    @endsection