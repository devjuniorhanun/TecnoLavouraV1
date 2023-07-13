<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



    <style>
        .recibo {
            padding: 5px;
            font-weight: bold;
            font-size: 50px;
            text-align: center;
            color: #000;
        }

        #example .col {
            border: 1px solid black;
        }

        table {
            width: 100%;
            height: 240px;
            border-collapse: collapse;
            border: 1px solid black;
            text-align: left;
            table-layout: fixed;
        }
        tr {
            border: 1px solid black;
        }
    </style>

    <title>Transferencias</title>
</head>

<body>
    @foreach($transferencias as $transferencia)

    <table>
        <tr>
            <th width=95%>DADOS DO DEPOSITANTE.:</th>
            <th width=5% style="text-align: right">{{$loop->iteration}}</th>
        </tr>
        <tr>
            <th width=50%>NOME.: {{($transferencia->produtor_id == 1) ? 'PAULO ROBERTO TITOTO' : 'LEONARDO NAVES TITOTO'}}</th>
            <th width=50%>FAZENDA.: {{($transferencia->produtor_id == 1) ? 'SANTA MARTHA' : 'CANADA'}}</th>
        </tr>
        <tr>
            <tr>
                <th colspan="2" width=100%>DADOS DO BENEFICIARIO.:</th>
            </tr>
        </tr>
        <tr>
            <td>FAVORECIDO.: {{ $transferencia->fornecedor->razao_social }}</td>
            <td>CPF/CNPJ.: {{ $transferencia->fornecedor->cpf_cnpj }}</td>
        </tr>
        <tr>
            <td>BANCO.: {{ $transferencia->fornecedor->banco }}</td>
            <td>AGENCIA.: {{ $transferencia->fornecedor->agencia }}</td>
        </tr>
        <tr>
            <td width=30%>OP.: {{ $transferencia->fornecedor->operacao }}</td>
            <td width=70%>C/{{$transferencia->fornecedor->tipo_conta}}.: {{ $transferencia->fornecedor->num_conta }}</td>
        </tr>
        <tr>
            <td>VALOR.: {{number_format($transferencia->valor, 2, ',', '.')}}</td>
            <td>( {{extenso(number_format($transferencia->valor, 2, ',', '.'))}} )</td>
        </tr>
        <tr>
            <td colspan="2">DESCRIÇÃO PAGAMENTO.: {{$transferencia->descricao}}</td>
        </tr>
        <tr>
            <td colspan="2">AUTORIZADO POR.: LEONARDO NAVES TITOTO</td>
        </tr>

    </table><br>
    @endforeach
</body>

</html>