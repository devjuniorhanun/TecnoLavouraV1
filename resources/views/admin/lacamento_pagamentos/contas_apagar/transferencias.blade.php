@extends(backpack_view('blank'))


@section('content')
<div class="row no-print">
    <div class="col">
        {{-- Abre o formulário --}}
        {!! Form::open(['route' => 'transferenciaDiaPdf','target' => '_blank']) !!}
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
@foreach($transferencias as $transferencia)



<div class="container-fluid font-weight-bolder" id="example">
    <div class="row">
        <div class="col col-md-11 text-center">DADOS DO DEPOSITANTE.:</div>
        <div class="col col-md-1 text-right">{{$loop->iteration}}</div>
    </div>
    <div class="row">
        <div class="col">NOME.: {{($transferencia->produtor_id == 1) ? 'PAULO ROBERTO TITOTO' : 'LEONARDO NAVES TITOTO'}}</div>
        <div class="col">FAZENDA.: {{($transferencia->produtor_id == 1) ? 'SANTA MARTHA' : 'CANADA'}}</div>
    </div>
    <div class="row">
        <div class="col text-center">DADOS DO BENEFICIARIO.:</div>
    </div>
    <div class="row">
        <div class="col">FAVORECIDO.: {{ $transferencia->fornecedor->razao_social }}</div>
        <div class="col">CPF/CNPJ.: {{ $transferencia->fornecedor->cpf_cnpj }}</div>
    </div>
    <div class="row">
        <div class="col">BANCO.: {{ $transferencia->fornecedor->banco }}</div>
        <div class="col">AGENCIA.: {{ $transferencia->fornecedor->agencia }}</div>
    </div>
    <div class="row">
        <div class="col">OP.: {{ $transferencia->fornecedor->operacao }}</div>
        <div class="col">C/{{$transferencia->fornecedor->tipo_conta}}.: {{ $transferencia->fornecedor->num_conta }}</div>
    </div>
    <div class="row">
        <div class="col col-md-3">VALOR.: {{number_format($transferencia->valor, 2, ',', '.')}} </div>
        <div class="col">( {{extenso(number_format($transferencia->valor, 2, ',', '.'))}} )</div>
    </div>
    <div class="row">
        <div class="col">DESCRIÇÃO PAGAMENTO.: {{$transferencia->descricao}}</div>
    </div>
    <div class="row">
        <div class="col">AUTORIZADO POR.: LEONARDO NAVES TITOTO</div>
    </div>

</div>

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


@endsection