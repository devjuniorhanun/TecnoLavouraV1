<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        table {
            width: 100%;
            text-align: center;
            table-layout: fixed;
        }
    </style>
    <title>Contrato de Transportadores</title>
</head>

<body lang="pt-BR" text="#000000" link="#000080" vlink="#800000" dir="ltr">
    <p class="western" style="line-height: 0.47cm; margin-bottom: 0.4cm; background: #ffffff">

        <font color="#444444">
            <font face="Arial, sans-serif"><u><b>CONTRATO
                        DE PRESTAÇÃO DE SERVIÇOS DE TRANSPORTE</b></u></font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="margin-bottom: 0.35cm">
        <font face="Arial, sans-serif">
            <font size="2" style="font-size: 9pt"><b>IDENTIFICAÇÃO
                    DAS PARTES: </b></font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="margin-bottom: 0.35cm">
        <font face="Arial, sans-serif">
            <font size="2" style="font-size: 9pt"><b>CONTRATANTE:
                </b></font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
        <font face="Arial, sans-serif">
            <font size="2" style="font-size: 9pt"><b>LEONARDO
                    NAVES TITOTO</b>, brasileiro, casado, agricultor, portador do RG nº 29.090.476-6
                SSP/SP, inscrito no CPF/MF sob nº 273.596.528-71, com endereço na
                Fazenda Santa Martha, Rod. Br 452, KM 110, Zona Rural, na Cidade de
                Bom Jesus – GO, doravante denominado CONTRATANTE;</font>
        </font>
        <font face="Arial, sans-serif">
            <font size="2" style="font-size: 9pt"><b>
                </b></font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>CONTRATADA:</b></span> {{$transportadores->razao_social}}, com sede em na {{$transportadores->endereco}}, Nº{{$transportadores->numero}},
                    {{$transportadores->bairro}},CEP: {{$transportadores->cep}} {{$transportadores->cidade}} - {{$transportadores->estado}}, inscrita no CNPJ E OU CPF
                    sob o nº {{$transportadores->cpf_cnpj}},neste ato representado pelo mesmo.</span>
                </font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">As
                    partes acima identificadas acordam com o presente Contrato de
                    Prestação de Serviços de Transporte, que se regerá pelas
                    cláusulas seguintes:</font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DO
                        OBJETO DO CONTRATO</b></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">As
                    Para a execução dos serviços,
                    objeto deste instrumento, os CONTRATADOS
                    utilizarão o(s) Caminh(ão)(õe)s:

                </font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">
                    @foreach($motoristas as $motorista)
                    Placa - {{$motorista->placa}}<br>
                    @endforeach

                </font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula1ª.</b></span> O
                    OBJETO do presente instrumento, é a prestação de serviços pela
                    CONTRATADA, de transporte rodoviário para a CONTRATANTE, de Milho e
                    Milheto Safrinha Ano 2023, dentro do território nacional.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DOS
                        HORÁRIOS</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 2ª.</b></span> Serão prestados os serviços de transporte pela CONTRATADA, todos os
                    dias úteis do mês, nos horários de 07:00 horas às 17:00 horas.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 3ª.</b></span>
                    A CONTRATADA, poderá executar serviços em horários e dias de modo
                    extraordinário, devendo no entanto, serem comunicados com
                    antecedência de 02 dias, sendo os mesmos remunerados separadamente.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DAS
                        RESPONSABILIDADES</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 4ª.</b></span>
                    A CONTRATADA utilizará para o transporte das cargas, veículos de
                    sua propriedade, responsabilizando-se pela conservação das
                    mercadorias que transportar, respondendo pela destruição ou
                    inutilização das mesmas.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 5ª.</b></span>
                    É de inteira responsabilidade da CONTRATADA, caso ocorra algum
                    acidente no curso do transporte da carga, ressarcindo todo e qualquer
                    dano causado a terceiro, bem como a destruição ou inutilização
                    das mercadorias.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 6ª</b></span>.
                    É de inteira responsabilidade da CONTRATADA, cumprir todas as
                    obrigações do código nacional de transito.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DA
                        REMUNERAÇÃO</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 7ª.</b></span>
                    Pagará a CONTRATANTE pelos serviços prestados pela CONTRATADA, o
                    valor de R$1,28 (Hum Real e Vinte e Oito Centavos) por saca de 60
                    Kilos.</span></font>

            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">
                    Os Pagamentos serão efetuados na Conta.: Banco - {{$transportadores->banco}}, Agencia - {{$transportadores->agencia}}, Conta - {{$transportadores->num_conta}}, Tipo Conta - {{$transportadores->tipo_conta}} </span></font>

            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DA
                        RESCISÃO</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 8ª.</b></span>
                    Este contrato poderá ser rescindido a qualquer tempo, bastando para
                    isso que seja notificada a outra parte com antecedência mínima de
                    10 dias.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 9ª.</b></span>
                    A violação de qualquer cláusula aqui disposta rescindirá
                    automaticamente o presente contrato, facultando a parte que não deu
                    causa pleitear em juízo eventual indenização.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DO
                        PRAZO</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 10ª.</b></span>
                    Tem prazo indeterminado o presente contrato, entrando em vigor a
                    partir da assinatura por ambas as partes.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DO
                        FORO</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 11ª.</b></span>
                    As partes elegem o foro da comarca de Bom Jesus de Goiás - GO, para
                    dirimir quaisquer controvérsias oriundas do CONTRATO.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">Por
                    estarem assim justos e contratados, firmam o presente instrumento, em
                    duas vias de igual teor, juntamente com 2 (duas) testemunhas.</font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">

            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR">Bom
                        Jesus de Goiás, {{ $dia }}.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <br />
        <br />

    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">
                    <table>
                        <tr>
                            <td>
                                _______________________________<br>
                                {{$transportadores->razao_social}}
                            </td>
                            <td>
                                _______________________________<br>
                                LEONARDO NAVES TITOTO
                            </td>
                        </tr>
                    </table>
                </font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444"> </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span>
                        <table>
                            <tr>
                                <td>
                                    _______________________________<br>
                                    TESTEMUNHA
                                </td>
                                <td>
                                    _______________________________<br>
                                    TESTEMUNHA
                                </td>
                            </tr>
                        </table>

                    </span></font>
            </font>
    </p>
    <br><br><br><br><br><br><br><br><br><br><br>
    <p class="western" style="line-height: 0.47cm; margin-bottom: 0.4cm; background: #ffffff">

        <font color="#444444">
            <font face="Arial, sans-serif"><u><b>CONTRATO
                        DE PRESTAÇÃO DE SERVIÇOS DE TRANSPORTE</b></u></font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="margin-bottom: 0.35cm">
        <font face="Arial, sans-serif">
            <font size="2" style="font-size: 9pt"><b>IDENTIFICAÇÃO
                    DAS PARTES: </b></font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="margin-bottom: 0.35cm">
        <font face="Arial, sans-serif">
            <font size="2" style="font-size: 9pt"><b>CONTRATANTE:
                </b></font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="text-indent: 1.25cm; margin-bottom: 0.35cm">
        <font face="Arial, sans-serif">
            <font size="2" style="font-size: 9pt"><b>PAULO ROBERTO TITOTO</b>, brasileiro, casado, agricultor, portador do RG nº 4.498.475-3
                SSP/SP, inscrito no CPF/MF sob nº 744.932.058-49, com endereço na
                Fazenda Santa Martha, Rod. Br 452, KM 110, Zona Rural, na Cidade de
                Bom Jesus – GO, doravante denominado CONTRATANTE;</font>
        </font>
        <font face="Arial, sans-serif">
            <font size="2" style="font-size: 9pt"><b>
                </b></font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>CONTRATADA:</b></span> {{$transportadores->razao_social}}, com sede em na {{$transportadores->endereco}}, Nº{{$transportadores->numero}},
                    {{$transportadores->bairro}},CEP: {{$transportadores->cep}} {{$transportadores->cidade}} - {{$transportadores->estado}}, inscrita no CNPJ E OU CPF
                    sob o nº {{$transportadores->cpf_cnpj}},neste ato representado pelo mesmo.</span>
                </font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">As
                    partes acima identificadas acordam com o presente Contrato de
                    Prestação de Serviços de Transporte, que se regerá pelas
                    cláusulas seguintes:</font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DO
                        OBJETO DO CONTRATO</b></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">As
                    Para a execução dos serviços,
                    objeto deste instrumento, os CONTRATADOS
                    utilizarão o(s) Caminh(ão)(õe)s:

                </font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">As
                    @foreach($motoristas as $motorista)
                    Placa - {{$motorista->placa}}<br>
                    @endforeach

                </font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula1ª.</b></span> O
                    OBJETO do presente instrumento, é a prestação de serviços pela
                    CONTRATADA, de transporte rodoviário para a CONTRATANTE, de Milho e
                    Milheto Safrinha Ano 2023, dentro do território nacional.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DOS
                        HORÁRIOS</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 2ª.</b></span> Serão prestados os serviços de transporte pela CONTRATADA, todos os
                    dias úteis do mês, nos horários de 07:00 horas às 17:00 horas.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 3ª.</b></span>
                    A CONTRATADA, poderá executar serviços em horários e dias de modo
                    extraordinário, devendo no entanto, serem comunicados com
                    antecedência de 02 dias, sendo os mesmos remunerados separadamente.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DAS
                        RESPONSABILIDADES</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 4ª.</b></span>
                    A CONTRATADA utilizará para o transporte das cargas, veículos de
                    sua propriedade, responsabilizando-se pela conservação das
                    mercadorias que transportar, respondendo pela destruição ou
                    inutilização das mesmas.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 5ª.</b></span>
                    É de inteira responsabilidade da CONTRATADA, caso ocorra algum
                    acidente no curso do transporte da carga, ressarcindo todo e qualquer
                    dano causado a terceiro, bem como a destruição ou inutilização
                    das mercadorias.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 6ª</b></span>.
                    É de inteira responsabilidade da CONTRATADA, cumprir todas as
                    obrigações do código nacional de transito.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DA
                        REMUNERAÇÃO</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 7ª.</b></span>
                    Pagará a CONTRATANTE pelos serviços prestados pela CONTRATADA, o
                    valor de R$1,28 (Hum Real e Vinte e Oito Centavos) por saca de 60
                    Kilos.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">
                    Os Pagamentos serão efetuados na Conta.: Banco - {{$transportadores->banco}}, Agencia -
                    {{$transportadores->agencia}}, Conta - {{$transportadores->num_conta}}, Tipo Conta -
                    {{$transportadores->tipo_conta}}, em nome de {{$transportadores->nome_banco}} </span>
                </font>

            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DA
                        RESCISÃO</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 8ª.</b></span>
                    Este contrato poderá ser rescindido a qualquer tempo, bastando para
                    isso que seja notificada a outra parte com antecedência mínima de
                    10 dias.</span></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 9ª.</b></span>
                    A violação de qualquer cláusula aqui disposta rescindirá
                    automaticamente o presente contrato, facultando a parte que não deu
                    causa pleitear em juízo eventual indenização.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DO
                        PRAZO</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 10ª.</b></span>
                    Tem prazo indeterminado o presente contrato, entrando em vigor a
                    partir da assinatura por ambas as partes.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><b>DO
                        FORO</b></font>
            </font>
        </font>
    </p>
    <p lang="nb-NO" class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span lang="pt-BR"><b>Cláusula 11ª.</b></span>
                    As partes elegem o foro da comarca de Bom Jesus de Goiás - GO, para
                    dirimir quaisquer controvérsias oriundas do CONTRATO.</span></font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">Por
                    estarem assim justos e contratados, firmam o presente instrumento, em
                    duas vias de igual teor, juntamente com 2 (duas) testemunhas.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western" align="right">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">Bom Jesus - GO, </font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><span lang="pt-BR">{{ $dia }}</span></font>
        </font>

    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <br />
        <br />

    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt">
                    <table>
                        <tr>
                            <td>
                                _______________________________<br>
                                {{$transportadores->razao_social}}
                            </td>
                            <td>
                                _______________________________<br>
                                PAULO ROBERTO TITOTO
                            </td>
                        </tr>
                    </table>
                </font>
            </font>
        </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444"> </font>
    </p>
    <p class="western" align="justify" style="line-height: 0.72cm; margin-bottom: 0.4cm; background: #ffffff">
        <font color="#444444">
            <font face="Arial, sans-serif">
                <font size="2" style="font-size: 9pt"><span>
                        <table>
                            <tr>
                                <td>
                                    _______________________________<br>
                                    TESTEMUNHA
                                </td>
                                <td>
                                    _______________________________<br>
                                    TESTEMUNHA
                                </td>
                            </tr>
                        </table>

                    </span></font>
            </font>
    </p>
</body>

</html>