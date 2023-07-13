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
    @foreach($plantio as $plantio)
    <tr>
        <td>{{$plantio->fornecedor->razao_social}}</td>
        <td>{{$plantio->centroCusto->nome}}</td>
        <td>{{Carbon\Carbon::parse($plantio->data_documento)->format('d/m/Y')}}</td>
        <td><a href="{{route('recibo-plantio',[$plantio->id])}}">Recibo</a></td>   
        
    </tr>

    @endforeach
    </tbody>
</table>

@endsection

