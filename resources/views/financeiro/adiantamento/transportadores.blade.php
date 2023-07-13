@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Adiantamentos de Transportadores</span>
    </h2>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Qtn Viagem</th>
                    <th scope="col">Transportador</th>
                    <th scope="col">Peso Bruto</th>
                    <th scope="col">Valor Frete</th>
                    <th scope="col">Adiantamentos</th>
                    <th scope="col">Tipo Pag.</th>
                </tr>
            </thead>
            <tbody>
                {{-- Abre o formulário --}}
                {!! Form::open(['route' => 'relatorio_motorista']) !!}
                @forelse ($listaTransportador as $lista)
                <tr>
                    <th scope="row">{{ $lista->qtnViagem }}</th>
                    <td>{{ $lista->nome_fantasia }}</td>
                    <td>{{ number_format($lista->QtnSacoBrutos, 0, '.', '.') }} Sc</td>
                    <td>R$ {{ number_format($lista->valorFrete, 2, ',', '.') }}</td>
                    <td>R$ {{ ($lista->valorAdiantamento)? number_format($lista->valorAdiantamento, 2, ',', '.') : "0"}}</td>
                    <td>tipo</td>
                </tr>
                @empty
                <p>Não foi encontrado Nem um Registro</p>
                @endforelse
                <tr>
                    <td colspan="10">{{-- Fecha o formulário --}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="ciclo_id">&nbsp;</label><br>
                                {!! Form::submit('Gera', ['id' => 'Filtrar','class' => 'btn btn-success btn-sm']); !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>

            </tbody>
            
        </table>
    </div>
</div>


<div class="card-footer text-muted">
</div>
@stop
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection