@extends(backpack_view('blank'))

@php

@endphp

@section('header')
<div class="container-fluid">
  <h2>
    <span class="text-capitalize">Relátorio de Safra</span>
  </h2>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header no-print">
    <div class="row">
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
          <th scope="col">Talhão</th>
          <th scope="col">Romaneio</th>
          <th scope="col">Controle</th>
          <th scope="col">P.Buts.</th>
          <th scope="col">S.Buts</th>
          <th scope="col">Des</th>
          <th scope="col">P.Líq.</th>
          <th scope="col">S.Líq.</th>
          <th scope="col">Armazén</th>
          <th scope="col">Colhedor</th>
          <th scope="col">Inscrição</th>
          <th scope="col">Frete</th>
          <th scope="col">V.Frete</th>
        </tr>
      </thead>
      <tbody>
        @php
        $viagens = 0;
        $peso_bruto = 0;
        $peso_liquido = 0;
        $valor_frete = 0;
        $saco_bruto = 0;
        $saco_liquido = 0;
        $desconto = 0;

        @endphp

        @forelse ($listagem as $lista)

        @php
        $viagens +=1;
        $peso_bruto += $lista->peso_bruto;
        $peso_liquido += $lista->peso_liquido;
        $saco_bruto += $lista->saco_bruto;
        $valor_frete += $lista->valor_frete;
        $saco_liquido += $lista->saco_liquido;
        $desconto += $lista->peso_desconto;

        @endphp

        <tr>
          <th scope="row">{{$viagens}}</th>
          <td>{{ Carbon\Carbon::parse($lista->data_colhido)->format('d/m/Y') }}</td>
          <td>{{ $lista->motorista->nome }}</td>
          <td>{{ $lista->talhao->nome }}</td>
          <td>{{ $lista->num_romaneio }}</td>
          <td>{{ $lista->num_controle }}</td>
          <td>{{ number_format($lista->peso_bruto, 0, ',', '.') }} kg</td>
          <td>{{ number_format($lista->saco_bruto, 0, ',', '.') }} Sc</td>
          <td>{{ number_format($lista->peso_desconto, 0, ',', '.') }} Kg</td>
          <td>{{ number_format($lista->peso_liquido, 0, ',', '.') }} Kg</td>
          <td>{{ number_format($lista->saco_liquido, 0, ',', '.') }} Sc</td>
          <td>{{ $lista->armazem->nome }}</td>
          <td>{{ $lista->colhedor->nome }}</td>
          <td>{{ $lista->fazenda->inscricao_estadual }}</td>
          <td>R$ {{ number_format($lista->matrizFrete->frete, 2, ',', '.') }}</td>
          <td>R$ {{ number_format($lista->valor_frete, 2, ',', '.') }}</td>

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
          <th scope="col">P.Buts.</th>
          <th scope="col">S.Buts</th>
          <th scope="col">Des</th>
          <th scope="col">P.Líq.</th>
          <th scope="col">S.Líq.</th>
          <th scope="col">Armazén</th>
          <th scope="col">Colhedor</th>
          <th scope="col">Frete</th>
          <th scope="col">V.Frete</th>
        </tr>
        <tr>
          <td colspan="2"><strong>Totais</strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
          <td><strong>{{ number_format($peso_bruto, 0, ',', '.')}} Kg</strong></td>
          <td><strong>{{ number_format($saco_bruto, 2, ',', '.')}} Sc</strong></td>
          <td><b>{{number_format($desconto, 0, ',', '.')}} Kg</b></td>
          <td><strong>{{ number_format($peso_liquido, 2, ',', '.')}} Kg</strong></td>
          <td><strong>{{ number_format($saco_liquido, 2, ',', '.')}} Sc</strong></td>
          <td></td>
          <td></td>
          <td></td>
          <td><strong>R$ {{ number_format($valor_frete, 2, ',', '.') }}</strong></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="card-footer text-muted">

  </div>
</div>
@stop
@section('after_styles')
<link rel="stylesheet" href="{{ asset('css/print.css') }}">
@endsection