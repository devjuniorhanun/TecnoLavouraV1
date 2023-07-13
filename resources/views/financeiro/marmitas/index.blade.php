@extends(backpack_view('blank'))


@section('content')
<table class="table border table-sm font-weight-bolder">
    <thead>
        <tr>
            <th colspan="4">
                <center>RELAÇÃO DE PAGAMENTOS A SEREM EFETUADOS</center>
            </th>
        </tr>
    </thead>
    <tbody>
    @foreach($marmitas as $marmitas)
    <tr>
        <td>{{$marmitas->fornecedor->razao_social}}</td>
        <td>{{$marmitas->centroCusto->nome}}</td>
        <td>{{Carbon\Carbon::parse($marmitas->data_documento)->format('d/m/Y')}}</td>
        <td><a href="{{route('recibo-marmitas',[$marmitas->id])}}">Recibo</a></td>   
        
    </tr>

    @endforeach
    </tbody>
</table>

@endsection

