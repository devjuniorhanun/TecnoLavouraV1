@extends(backpack_view('blank'))
@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Contrato de Trasnportadores</span>
    </h2>
</div>
@endsection

@section('content')


<div class="card-header no-print">
    <div class="row no-print">
        <div class="col">
            {{-- Abre o formulário --}}
            {!! Form::open(['route' => 'contrato_motorista','target' => '_blank']) !!}
            {{-- Chama os campos do formulário --}}
            @include('contratos.motoristas.filtroTransportadores')
            
            {{-- Fecha o formulário --}}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection