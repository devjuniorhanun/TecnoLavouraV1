@extends(backpack_view('blank'))

@section('header')
<div class="container-fluid">
  <h2>
    <span class="text-capitalize">Relátorio de Safra</span>
  </h2>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header">

    <div class="row">
      <div class="col-md-2">
        <strong>Total Colhido.: <br>{{ number_format($totalColhido->liquido, 0, ',', '.') }} Kg</strong>
      </div>
      <div class="col-md-2">
        <strong>Sacos Colhido.: <br>{{ number_format($totalColhido->sacos, 0, ',', '.') }} Sc</strong>
      </div>

      <div class="col-md-2">
        <strong>Frete Pago.: <br>R$ {{ number_format($totalColhido->frete, 2, ',', '.') }}</strong>
      </div>

    </div>
    <div class="row no-print">
      <div class="col">
        {{-- Abre o formulário --}}
        {!! Form::model($date,['route' => 'relatorio_safra']) !!}
        {{-- Chama os campos do formulário --}}
        @include('admin.lacamento_lavoura.form_filtros')
        {{-- Fecha o formulário --}}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-striped table-hover table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Data</th>
          <th scope="col">Motorista</th>
          <th scope="col">Placa</th>
          <th scope="col">Talhão</th>
          <th scope="col">Romaneio</th>
          <th scope="col">Controle</th>
          <th scope="col">Peso Bruto</th>
          <th scope="col">Desconto</th>
          <th scope="col">Peso Líquido</th>
          <th scope="col">Saco Líquido</th>
          <th scope="col">Armazén</th>
          <th scope="col">Colhedor</th>
          <th scope="col">Inscrição</th>
          <th scope="col">Frete</th>
          <th scope="col">Valor Frete</th>
          <th scope="col">Cultura</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($listagem as $lista)
        <tr>
          <th scope="row">{{ $lista->id }}</th>
          <td>{{ Carbon\Carbon::parse($lista->data_colhido)->format('d/m/Y') }}</td>
          <td>{{ $lista->motorista }}</td>
          <td>{{ $lista->placa }}</td>
          <td>{{ $lista->talhao }}</td>
          <td>{{ $lista->num_romaneio }}</td>
          <td>{{ $lista->num_controle }}</td>
          <td>{{ number_format($lista->peso_bruto, 0, ',', '.') }}</td>
          <td>{{ number_format($lista->peso_desconto, 0, ',', '.') }}</td>
          <td>{{ number_format($lista->peso_liquido, 3, ',', '.') }}</td>
          <td>{{ number_format($lista->saco_liquido, 3, ',', '.') }}</td>
          <td>{{ $lista->nomeArmazen }}</td>
          <td>{{ $lista->nomeColhedor }}</td>
          <td>{{ $lista->inscricao }}</td>
          <td>R$ {{ number_format($lista->matrizFrete, 2, ',', '.') }}</td>
          <td>R$ {{ number_format($lista->valor_frete, 2, ',', '.') }}</td>
          <td>{{ $lista->nomeCultura }}</td>

        </tr>
        @empty
        <p>Não foi encontrado Nem um Registro</p>
        @endforelse

      </tbody>
      <tfoot>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Data</th>
          <th scope="col">Motorista</th>
          <th scope="col">Talhão</th>
          <th scope="col">Romaneio</th>
          <th scope="col">Controle</th>
          <th scope="col">P Bruto</th>
          <th scope="col">Desconto</th>
          <th scope="col">P Líquido</th>
          <th scope="col">S Líquido</th>
          <th scope="col">Armazén</th>
          <th scope="col">Colhedor</th>
          <th scope="col">Inscrição</th>
          <th scope="col">Frete</th>
          <th scope="col">Valor</th>
          <th scope="col">Cultura</th>
        </tr>
        
      </tfoot>
    </table>
    <table class="table table-striped table-hover table-sm">
    <tr>
        <th colspan="3">#</th>
          <th scope="col" colspan="2">Peso Bruto</th>
          <th scope="col" colspan="2">Sacos Brutos</th>
          <th scope="col" colspan="2">Desconto Kg</th>
          <th scope="col" colspan="2">Desconto Sc</th>
          <th scope="col" colspan="2">Peso Liquido</th>
          <th scope="col" colspan="3">Sacos Liquido</th>
          
        </tr>
        <tr>
          <th colspan="3">#</th>
          <th scope="col" colspan="2">{{number_format($totalColhido->pesoBruto, 0, ',', '.')}} Kg</th>
          <th scope="col" colspan="2">{{number_format($totalColhido->sacoBruto, 0, ',', '.')}} Sc</th>
          <th scope="col" colspan="2">{{number_format($totalColhido->desconto, 0, ',', '.')}} Kg</th>
          <th scope="col" colspan="2">{{number_format(($totalColhido->desconto/60), 0, ',', '.')}} Kg</th>
          <th scope="col" colspan="2">{{number_format($totalColhido->liquido, 0, ',', '.')}} Kg</th>
          <th scope="col" colspan="3">{{number_format($totalColhido->sacos, 0, ',', '.')}} Kg</th>
          
        </tr>

    </table>
  </div>
  <div class="card-footer text-muted">

  </div>
</div>
@stop
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection