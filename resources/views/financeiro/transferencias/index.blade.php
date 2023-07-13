@extends(backpack_view('blank'))


@section('content')
@foreach($transferencias->fornecedores as $transferencia)

<div class="container-fluid font-weight-bolder" id="example">
    <div class="row">
        <div class="col col-md-11 text-center">DADOS DO DEPOSITANTE.:</div>
        <div class="col col-md-1 text-right">{{$loop->iteration}}</div>
    </div>
    <div class="row">
        <div class="col">NOME.:</div>
        <div class="col">{{($transferencia['produtores'] == 1) ? 'PAULO ROBERTO TITOTO' : 'LEONARDO NAVES TITOTO'}}</div>
        <div class="col">FAZENDA.:</div>
        <div class="col">{{($transferencia['produtores'] == 1) ? 'SANTA MARTHA' : 'CANADA'}}</div>
    </div>
    <div class="row">
        <div class="col text-center">DADOS DO BENEFICIARIO.:</div>
    </div>
    <div class="row">
        <div class="col">BANCO.:</div>
        <div class="col">{{ $transferencia['banco'] }}</div>
        <div class="col">AGENCIA.:</div>
        <div class="col">{{ $transferencia['agencia'] }}</div>
    </div>
    <div class="row">
        <div class="col">OP.:</div>
        <div class="col">{{ ($transferencia['op'] != "null" )? $transferencia['op'] : '' }}</div>
        <div class="col">Num/C.:</div>
        <div class="col">{{ $transferencia['conta'] }}</div>
        <div class="col">Tipo Conta.:</div>
        <div class="col">{{ $transferencia['tipoConta']  }}</div>
    </div>
    <div class="row">
        <div class="col">FAVORECIDO.:</div>
        <div class="col">{{ $transferencia['contato'] }}</div>
        <div class="col">CPF/CNPJ.:</div>
        <div class="col">{{ $transferencia['cpf_cnpj'] }}</div>
    </div>
    <div class="row">
        <div class="col col-md-1">VALOR.:</div>
        <div class="col col-md-2">( {{number_format($transferencia['valor'], 2, ',', '.')}} )</div>
        <div class="col">( {{extenso(number_format($transferencia['valor'], 2, ',', '.'))}} )</div>
    </div>
    <div class="row">
        <div class="col col-md-3">DESCRIÇÃO PAGAMENTO.:</div>
        <div class="col">{{$transferencia['descricao']}}</div>
    </div>
    <div class="row">
        <div class="col">AUTORIZADO POR.:</div>
        <div class="col">LEONARDO NAVES TITOTO</div>
    </div>
</div>

</div>

<br>
@endforeach
@endsection

@section('after_styles')
<!-- DATA TABLES -->

<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css').'?v='.config('backpack.base.cachebusting_string') }}">

<link rel="stylesheet" href="{{ asset('css/style.css') }}">