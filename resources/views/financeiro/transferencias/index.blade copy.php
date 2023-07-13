@extends(backpack_view('blank'))


@section('content')
<table class="table border border-dark table-sm font-weight-bolder">
    <thead>
        <tr>
            <th>
                <center>RELAÇÃO DE PAGAMENTOS A SEREM EFETUADOS</center>
            </th>
        </tr>
    </thead>
    <tbody>
        @php $i = 0; @endphp
        

        @foreach($transferencias->fornecedores as $transferencia)

        
        
        
        
        
        @php $i++ ; @endphp
        <tr>
            <td><table class="table border border-dark font-weight-bolder">
                    <tr>
                        <td class="text-center border border-dark">DADOS DO DEPOSITANTE.:</td>
                        <td class="text-right border border-dark"><b>{{ $i }}</b></td>
                        
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="table border font-weight-bolder border border-dark ">
                    <tr>
                        <td class="text-right border border-dark">NOME.:</td>
                        <td class="border border-dark">{{($transferencia['produtores'] == 1) ? 'PAULO ROBERTO TITOTO' : 'LEONARDO NAVES TITOTO'}}</td>
                        <td class="text-right border border-dark">FAZENDA.:</td>
                        <td class="border border-dark">{{($transferencia['produtores'] == 1) ? 'SANTA MARTHA' : 'CANADA'}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="border border-dark text-center">
            <td>DADOS DO BENEFICIARIO.:</td>
        </tr>
        <tr>
            <td>
                <table class="table font-weight-bolder border border-dark">
                    <tr>
                        <td class="text-right border border-dark">BANCO.:</td>
                        <td class="border border-dark">{{ $transferencia['banco'] }}</td>
                        <td class="text-right border border-dark">AGENCIA.:</td>
                        <td class="border border-dark">{{ $transferencia['agencia'] }}</td>
                    </tr>
                    <tr>
                        
                        @if($transferencia['op'] != "null" )
                        <td class="text-right border border-dark">OP.:</td>
                        <td class="border border-dark">{{ ($transferencia['op'] != "null" )? $transferencia['op'] : '' }}</td>
                        @endif
                        <td class="text-right border border-dark">Num/C.:</td>
                        <td class="border border-dark">{{ $transferencia['conta'] }}</td>
                        <td class="text-right border border-dark">Conta.:</td>
                        <td class="border border-dark">{{ $transferencia['tipoConta']  }}</td>
                    </tr>
                    <tr>
                        <td class="text-right border border-dark">FAVORECIDO.:</td>
                        <td class="border border-dark">{{ $transferencia['contato'] }}</td>
                       
                        <td class="text-right border border-dark">CPF/CNPJ.:</td>
                        <td class="border border-dark">{{ $transferencia['cpf_cnpj'] }}</td>
                        
                    </tr>
                    <tr>
                    <td class="text-right border border-dark">VALOR.:</td>
                        <td class="text-danger border border-dark">( {{number_format($transferencia['valor'], 2, ',', '.')}} )</td>
                        <td class="text-danger border border-dark" colspan="3">( {{extenso(number_format($transferencia['valor'], 2, ',', '.'))}} )</td>
                    </tr>
                    <tr>
                        <td class="border border-dark">DESCRIÇÃO PAGAMENTO.:</td>
                        <td class="border border-dark" colspan="7">{{$transferencia['descricao']}}</td>
                    </tr>
                    <tr>
                        <td class="border border-dark">AUTORIZADO POR.:</td>
                        <td class="border border-dark" colspan="7">LEONARDO NAVES TITOTO</td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr class="testeA" >
            <td class="testeA" >&nbsp;</td>
        </tr>
        
        @endforeach
    </tbody>

</table>
@endsection

@section('after_styles')
<!-- DATA TABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet" href="{{ asset('css/print.css') }}">