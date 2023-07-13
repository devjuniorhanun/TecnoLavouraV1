@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Relátorio de Motoristas por Safra</span>
    </h2>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table border table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">MOTORISTA</th>
                    <th scope="col">PLACA</th>
                    <th scope="col">PESO BRUTO (KG)</th>
                    <th scope="col">PESO BRUTO (SC)</th>
                    <th scope="col">VALOR DO FRETE</th>
                    <th scope="col">Nº DE VIAGEM</th>
                    <th scope="col">MEDIA FRETE (SC)</th>
                    <th scope="col">MEDIA FRETE (Viagem)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($relatorios as $lista)
                <tr>
                    <td>{{$lista->nome}}</td>
                    <td>{{$lista->placa}}</td>
                    <td>{{ number_format($lista->pesoBrutos, 0, ',', '.') }}</td>
                    <td>{{ number_format($lista->QtnSacoBrutos, 0, ',', '.') }}</td>
                    <td>R$ {{ number_format($lista->totalFrete, 2, ',', '.') }}</td>
                    <td>{{$lista->qtnViagem}}</td>
                    <td>{{ number_format(($lista->totalFrete/$lista->QtnSacoBrutos), 3, ',', '.') }}</td>
                    <td>{{ number_format(($lista->totalFrete/$lista->qtnViagem), 2, ',', '.') }}</td>
                </tr>


                @empty

                <p>Não foi encontrado Nem um Registro</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection






@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection