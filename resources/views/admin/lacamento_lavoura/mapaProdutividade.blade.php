@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">Mapa Produtividade Talhões</span>
    </h2>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-1">

            </div>
            <div class="col-md-2">
                <strong>Total Colhido.: <br>{{ number_format($totalColhido->liquido, 2, ',', '.') }} Kg</strong>
            </div>
            <div class="col-md-2">
                <strong>Sacos Colhido.: <br>{{ number_format($totalColhido->sacos, 2, ',', '.') }} Sc</strong>
            </div>
            @foreach($totalColhidoCulutra as $total)
            <div class="col-md-2">
                <strong>{{$total->nome}}.: <br>{{ number_format($total->sacos, 2, ',', '.') }}</strong>
            </div>
            @endforeach
            <div class="col-md-2">
                <strong>Frete Pago.: <br>R$ {{ number_format($totalColhido->frete, 2, ',', '.') }}</strong>
            </div>
        </div>

    </div>
    <div class="card-body">

        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Talhão</th>
                    <th scope="col">Produção</th>
                    <th scope="col">Peso Bruto</th>
                    <th scope="col">Peso Liquido</th>
                    <th scope="col">Área Colhida</th>
                    <th scope="col">Média</th>
                    <th scope="col">Cultura</th>
                </tr>
            </thead>
            <tbody>
                @php
                $sacoLiquido = 0;
                $areaTotal = 0;
                $pBruto = 0;
                $pLiquido = 0;
                @endphp
                @forelse ($produtividade as $lista)
                @php
                $sacoLiquido += $lista->saco_liquido;
                $areaTotal += $lista->area_total;
                $pBruto += $lista->pesoBruto;
                $pLiquido += $lista->pesoLiquido;
                //dd($lista->pesoBruto);
                @endphp
                <tr>
                    <td>{{ $lista->nome }}</td>
                    <td>{{ number_format($lista->saco_liquido, 2, ',', '.') }} Sc</td>
                    <th>{{ number_format($lista->pesoBruto, 2, ',', '.') }} Kg</th>
                    <th>{{ number_format($lista->pesoLiquido, 2, ',', '.') }} Kg</th>
                    <td>{{ number_format($lista->area_total, 2, ',', '.') }} ha</td>
                    <td>{{ number_format($lista->saco_liquido / $lista->area_total, 2, ',', '.') }} Sc</td>
                    <td>{{ $lista->culturaNome }}</td>
                </tr>
                @empty
                <p>Não foi encontrado Nem um Registro</p>
                @endforelse

            </tbody>
            <tfoot>
                <tr>
                    <th scope="col">Talhão</th>
                    <th scope="col">Produção</th>
                    <th scope="col">Peso Bruto</th>
                    <th scope="col">Peso Liquido</th>
                    <th scope="col">Área Colhida</th>
                    <th scope="col">Média</th>
                    <th scope="col">Cultura</th>
                </tr>
                <tr>
                    <th>Média Colhida</th>
                    <th>{{ number_format($sacoLiquido, 2, ',', '.') }} Sc</th>
                    <th>{{ number_format($pBruto, 2, ',', '.') }} Kg</th>
                    <th>{{ number_format($pLiquido, 2, ',', '.') }} Kg</th>
                    <th>{{ number_format($areaTotal, 2, ',', '.') }} Sc</th>
                    <td>{{ number_format($sacoLiquido / $areaTotal, 2, ',', '.') }} Sc</td>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>


@stop
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection
