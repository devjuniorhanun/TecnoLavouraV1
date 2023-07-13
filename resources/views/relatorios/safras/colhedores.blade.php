@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Relátorio de Colhedores</span>
    </h2>
</div>
@endsection

@section('content')
<div class="card">

    <div class="card-header">
        <div class="row">
            <div class="col">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="motorista">Colhedores.:</label><br>
                        <select class="form-control form-control-sm" id="motorista" name="motorista">
                            <option value="0">Colhedores(a)</option>
                            @foreach($listaColhedor as $lista)
                            <option value="{{ $lista->id }}">{{ $lista->razao_social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ciclo_id">&nbsp;</label><br>
                            {!! Form::submit('Filtrar', ['id' => 'Filtrar','class' => 'btn btn-info btn-sm']); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">QtnViagem</th>
                    <th scope="col">Colhedor</th>
                    <th scope="col">Peso Bruto</th>
                    <th scope="col">Qnt %</th>
                    <th scope="col">Adiantamentos</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($listaColhedor as $lista)



                <tr>
                    <th scope="row">{{ $lista->qtnViagem }}</th>
                    <td>{{ $lista->nome_fantasia }}</td>
                    <td>{{ number_format($lista->sacoBruto, 3, ',', '.') }} Sc</td>
                    <td>{{ number_format(($lista->sacoBruto * 0.05), 3, ',', '.') }} Sc</td>
                    <td>{{ ($lista->valorAdiantamento)? number_format($lista->valorAdiantamento, 2, ',', '.') : "0"}}</td>

                </tr>
                @empty
                <p>Não foi encontrado Nem um Registro</p>
                @endforelse

            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>

@endsection