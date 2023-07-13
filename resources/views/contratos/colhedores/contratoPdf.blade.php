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

<body lang="pt-BR" text="#000000" link="#0000ff" vlink="#800000" dir="ltr">
    <div title="header">
        <p align="left" style="line-height: 150%">
            <font face="Arial Narrow, sans-serif"><u><b> CONTRATO PARTICULAR DE PRESTAÇÃO DE SERVIÇOS DE COLHEITA</b></u></font>
        </p>

    </div>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>IDENTIFICAÇÃO
                    DAS PARTES: </b></font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CONTRATANTE:
                </b></font>
        </font>
    </p>
    <p class="western" align="justify" style="text-indent: 1.25cm">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>LEONARDO
                    NAVES TITOTO</b>,
                brasileiro, casado, agricultor, portador do RG nº 29.090.476-6
                SSP/SP, inscrito no CPF/MF sob nº 273.596.528-71, com endereço na
                Fazenda Santa Martha, Rod. Br 452, KM 110, Zona Rural, na Cidade de
                Bom Jesus – GO, doravante denominado CONTRATANTE;</font>
        </font>

    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CONTRATADO:
                    {{$colhedores->razao_social}}, </b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">com
                sede na {{$colhedores->endereco}} nº{{$colhedores->razao_numero}},{{$colhedores->bairro}}, CEP {{$colhedores->cep}}
                {{$colhedores->cidade}} – {{$colhedores->estado}}, inscrito no CNPJ sob nº {{$colhedores->cpj_cnpj}}.
                neste ato representada por seu sócio administrador,
            </font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>{{$colhedores->nome_fantasia}}</b>,
                inscrito no CPF sob nº {{$colhedores->rg_inscricao}}, residente domiciliado na {{$colhedores->endereco}} nº{{$colhedores->numero}},
                {{$colhedores->bairro}}, CEP {{$colhedores->cep}} {{$colhedores->cidade}}
                – {{$colhedores->estado}}.</font>
        </font>
    </p>

    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">As
                partes acima qualificadas firmam o presente instrumento, de acordo
                com as seguintes cláusulas e condições:</font>
        </font>
    </p>
    <p>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DO
                    OBJETO</b></font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA
                    1ª:</b>
                O presente contrato tem por objetivo a PRESTAÇÃO DE SERVIÇOS para
                a colheita mecânica de Milho e Milheto, safrinha agrícola 2023, a ser
                realizada pelo CONTRATADO em áreas de terras da Fazenda Santa
                Martha, bem como em outras áreas de propriedade do CONTRATANTE,
                conforme houver necessidade.</font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>PARÁGRAFO
                    PRIMEIRO:</b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                Para a execução dos serviços, objeto deste instrumento, os
                CONTRATADOS</font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>
                </b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">utilizarão:</font>
        </font>
    </p>


    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                {{ $colhedor->qnt_linha }}
                ( {{extensoNumero(number_format($colhedor->qnt_linha, 0, ',', '.'))}} ) colheitadeira de Milho e Milheto.
            </font>
        </font>
    </p>

    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>PARÁGRAFO
                    SEGUNDO:</b>
                O CONTRATADO declara que as máquinas a serem utilizadas são de sua
                propriedade, e que as máquinas se encontram em perfeito estado de
                uso, e devidamente revisadas.</font>
        </font>
    </p>
    <p>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DO
                    CUSTO E DO PAGAMENTO DOS SERVIÇOS</b></font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA
                    2ª:</b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                Pela execução dos serviços, objeto deste instrumento, o
                CONTRATANTE pagará ao CONTRATADO o percentual 5 % (cinco por cento) do total do Milho e Milheto colhida pelas máquinas ora contratadas,
                considerando-se o volume líquido, ou seja, seca e limpa.</font>
        </font>
    </p>
    <p class="western" align="justify">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>PARÁGRAFO
                        PRIMEIRO</b></font>
            </font>
        </font>
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt">:
                    Adiantamento ou pagamentos dos valores acima, em moeda, serão
                    considerados mera liberalidade e serão convertidos para sacas/kgs de
                    Milho e Milheto, tomando-se por base o valor de mercado da saca de soja do dia
                    do referido pagamento. Tais valores, convertidos em produto, serão
                    descontados do volume final a ser pago.</font>
            </font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DAS
                    OBRIGAÇÕES DO CONTRATANTE</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA
                        3ª:</b>
                    Caberá ao CONTRATANTE:</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">a) Bonificar
                o contratado com vale refeição, a ser combinado entre as partes;</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt">
                    b) Promover
                    condições de transporte de Milho e Milheto
                    colhido, de modo a não interromper o fluxo da colheita;</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                c) Fornecer
                o combustível necessário ao funcionamento das máquinas.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DAS
                    OBRIGAÇÕES DO CONTRATADO</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA
                    4ª:</b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                Caberá ao CONTRATADO, por sua vez: </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">a) Realizar
                o transporte das colheitadeiras de Milho e Milheto até o local onde será
                realizada a colheita, bem como nos, entre as propriedades onde a
                colheita será realizada, e providenciar a retirada das
                colheitadeiras ao final da colheita;</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">b) Realizar
                os serviços com perfeição e qualidade responsabilizando-se por
                todos e quaisquer danos e/ou prejuízos que causar ao CONTRATANTE
                decorrentes da execução dos serviços ora contratados, desde que,
                comprovadamente, sejam decorridos de atos praticados pelo CONTRATADO
                ou seus encarregados;</font>
        </font>
    </p>

    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">c) Responsabilizar-se
                pela ordem e disciplina de seus empregados nas dependências do
                CONTRATANTE, os quais deverão observar e cumprir as normas internas
                de disciplina e segurança;</font>
        </font>
    <p lang="pt-BR" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">d) Efetuar
                o pagamento das obrigações tributárias de sua responsabilidade,
                incluindo o pagamento, na época devida, de tributos que possam
                incidir sobre o contrato ou sobre a prestação dos serviços;</font>
        </font>
    </p>
    <p lang="pt-BR" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">e) Responsabilizar-se,
                integralmente, pelas ferramentas, maquinários e utensílios de sua
                propriedade que serão utilizados no cumprimento deste instrumento;</font>
        </font>
    </p>
    <p class="western" align="justify" style="margin-top: 0.42cm">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">f) Fornecer
                gratuitamente, por sua conta, os Equipamentos de Proteção
                Individual (EPI’s), necessários
                à segurança da mão-de-obra, adequados ao risco, em perfeito estado de
                conservação e funcionamento e disponíveis para
                início imediato,
                com a indicação do Certificado de Aprovação – CA, expedido
                pelo órgão nacional competente em matéria de segurança e saúde
                no trabalho do Ministério do Trabalho e Emprego;</font>
        </font>
        </font>
    <p class="western" align="justify" style="margin-top: 0.42cm">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">g) Fiscalizar
                para que os seus empregados façam uso efetivo dos EPI’S, de
                acordo com a finalidade a que se destinam e respectiva indicação
                de uso, conforme reza a NR – 31;</font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">h) Utilizar
                mão-de-obra especializada, com empregados qualificados aos
                serviços, abstendo-se >de
                contratar menores de 16 anos, bem como, de contratar menores de 18
                anos para trabalho noturno, perigoso ou insalubre</font>
        </font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">;</font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">i) Efetuar
                o registro dos funcionários que contratar para a execução dos
                serviços, anotando a CTPS dos mesmos e responsabilizando-se por
                todos os encargos trabalhistas, civis, previdenciários e
                securitários. Obriga-se, ainda, a cumprir todas as regras de saúde
                e segurança, fazendo com que o pessoal sob sua responsabilidade
                cumpra as disposições legais referentes à segurança, higiene e
                medicina do trabalho, assumindo toda e qualquer obrigação atinente
                a eventuais acidentes de trabalho ou eventuais danos causados a
                terceiros, decorrentes dos serviços ora contratados não existindo
                qualquer responsabilidade do CONTRATANTE nesse sentido, seja direta,
                indireta, solidária ou subsidiária;</font>
        </font>
    </p>
    </ol>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">O
                CONTRATADO deverá apresentar ao CONTRATANTE, as fichas de registros
                dos empregados, as carteiras de trabalho e as guias GFIP – FGTS e
                GPS – INSS, de toda mão-de-obra contratada para a execução dos
                serviços durante a vigência dos serviços, sob pena de retenção
                pelo CONTRATANTE, dos pagamentos devidos ao CONTRATADO, até a
                regularização.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">Providenciar,
                às suas expensas, a reposição de peças, filtros, óleos
                lubrificantes, mão-de-obra para consertos e reparos das
                colheitadeiras.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DO
                    PRAZO</b></font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA 5ª:</b> Os
                serviços serão realizados no período de 19/06/2023 com previsão
                de término até o dia 25/08/2023, sendo que as áreas deverão estar
                em condições adequadas para a colheita.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western"><br />

    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DISPOSIÇÕES GERAIS</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA 6ª: </b>Para
                a realização da manutenção das máquinas o CONTRATADO devera
                utilizar veículos de sua propriedade.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 7ª:</b>
                    Antes de iniciar os serviços de colheita, o CONTRATADO deverá
                    regular as colheitadeiras, obedecendo às orientações ditadas por
                    profissionais indicados pelo CONTRATANTE, podendo este proceder as
                    vistorias que entender necessárias. Noutro giro, não serão
                    admitidas as perdas que excederem ao limite fixado por hectare, pelos
                    Órgãos de pesquisas vinculados ao Ministério da Agricultura. </font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 8ª: </b>O
                    CONTRATADO somente poderá realizar a colheita nos horários
                    determinados pelo Gerente da Fazenda, ou por outra pessoa designada
                    pelo CONTRATANTE, sempre observando as condições adequadas de
                    umidade.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 9ª: </b>O
                    CONTRATADO assume de forma exclusiva e solidária, os riscos a que
                    estão sujeitos, mormente no que diz respeito a avarias, incêndios,
                    sinistros ou roubos, que porventura venham a atingir as
                    colheitadeiras, os veículos e os equipamentos de suas propriedades,
                    cumprindo-lhes empregar os meios necessários à conservação e
                    vigilância dos seus bens, ficando o CONTRATANTE isento de qualquer
                    responsabilidade a respeito.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 10ª: </b>Cumpre
                    ao CONTRATADO advertir seus empregados e/ou prepostos acerca da
                    proibição do consumo de bebidas alcoólicas no local de trabalho,
                    sem exceção de qualquer dia ou horário, com vistas a manter a
                    ordem e a harmonia entre os obreiros, estendendo-se a advertência
                    quanto à prática de atos atentatórios à honra e aos bons
                    costumes, sob pena de atrair para si todas as conseqüências que
                    advierem do mau proceder de seus serviçais.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 11ª: </b>O
                    CONTRATANTE e o CONTRATADO declaram que a presente avença não
                    constitui vínculo empregatício entre eles, sendo competente a
                    justiça comum para dirimir quaisquer dúvidas.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DO FORO</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA 12ª:</b>
                Elegem as partes, o foro da Comarca de Bom Jesus - GO para nele serem
                dirimidas todas e quaisquer dúvidas ou questões porventura
                resultantes deste instrumento.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">Assim,
                por estarem justos e contratados, firmam o presente instrumento em 02
                (duas) vias de igual teor e uma só forma, juntamente com 02 (duas)
                testemunhas.</font>
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
    <p lang="pt-BR" class="western" align="center">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>__________________________________</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western" align="center">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CONTRATANTE: LEONARDO NAVES TITOTO</b></font>
        </font>
    </p><br>
    <p lang="pt-BR" class="western" align="center">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>___________________________________</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western" align="center">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CONTRATADO: {{$colhedores->razao_social}}</b></font>
        </font>
    </p><br>
    <p lang="pt-BR" class="western">
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
    </p>
<br>
    <div title="header">
        <p align="left" style="line-height: 150%">
            <font face="Arial Narrow, sans-serif"><u><b> CONTRATO PARTICULAR DE PRESTAÇÃO DE SERVIÇOS DE COLHEITA</b></u></font>
        </p>

    </div>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>IDENTIFICAÇÃO
                    DAS PARTES: </b></font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CONTRATANTE:
                </b></font>
        </font>
    </p>
    <p class="western" align="justify" style="text-indent: 1.25cm">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>PAULO ROBERTO TITOTO</b>, brasileiro, casado, agricultor, portador do RG nº 4.498.475-3
                SSP/SP, inscrito no CPF/MF sob nº 744.932.058-49, com endereço na
                Fazenda Santa Martha, Rod. Br 452, KM 110, Zona Rural, na Cidade de
                Bom Jesus – GO, doravante denominado CONTRATANTE;<</font>
        </font>

    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CONTRATADO:
                    {{$colhedores->razao_social}}, </b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">com
                sede na {{$colhedores->endereco}} nº{{$colhedores->razao_numero}},{{$colhedores->bairro}}, CEP {{$colhedores->cep}}
                {{$colhedores->cidade}} – {{$colhedores->estado}}, inscrito no CNPJ sob nº {{$colhedores->cpj_cnpj}}.
                neste ato representada por seu sócio administrador, <b>{{$colhedores->nome_fantasia}}</b>,
                inscrito no CPF sob nº {{$colhedores->rg_inscricao}}, residente domiciliado na {{$colhedores->endereco}} 
                nº{{$colhedores->numero}},{{$colhedores->bairro}}, CEP {{$colhedores->cep}} {{$colhedores->cidade}}
                – {{$colhedores->estado}}.</font>
        </font>
    </p>

    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">As
                partes acima qualificadas firmam o presente instrumento, de acordo
                com as seguintes cláusulas e condições:</font>
        </font>
    </p>
    <p>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DO
                    OBJETO</b></font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA
                    1ª:</b>
                O presente contrato tem por objetivo a PRESTAÇÃO DE SERVIÇOS para
                a colheita mecânica de Milho e Milheto, safrinha agrícola 2023, a ser
                realizada pelo CONTRATADO em áreas de terras da Fazenda Santa
                Martha, bem como em outras áreas de propriedade do CONTRATANTE,
                conforme houver necessidade.</font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>PARÁGRAFO
                    PRIMEIRO:</b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                Para a execução dos serviços, objeto deste instrumento, os
                CONTRATADOS</font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>
                </b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">utilizarão:</font>
        </font>
    </p>


    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                {{ $colhedor->qnt_linha }}
                ( {{extensoNumero(number_format($colhedor->qnt_linha, 0, ',', '.'))}} ) colheitadeira de Milho e Milheto.
            </font>
        </font>
    </p>

    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>PARÁGRAFO
                    SEGUNDO:</b>
                O CONTRATADO declara que as máquinas a serem utilizadas são de sua
                propriedade, e que as máquinas se encontram em perfeito estado de
                uso, e devidamente revisadas.</font>
        </font>
    </p>
    <p>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DO
                    CUSTO E DO PAGAMENTO DOS SERVIÇOS</b></font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA
                    2ª:</b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                Pela execução dos serviços, objeto deste instrumento, o
                CONTRATANTE pagará ao CONTRATADO o percentual 5 % (cinco por cento) do total do Milho e Milheto colhida pelas máquinas ora contratadas,
                considerando-se o volume líquido, ou seja, seca e limpa.</font>
        </font>
    </p>
    <p class="western" align="justify">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>PARÁGRAFO
                        PRIMEIRO</b></font>
            </font>
        </font>
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt">:
                    Adiantamento ou pagamentos dos valores acima, em moeda, serão
                    considerados mera liberalidade e serão convertidos para sacas/kgs de
                    Milho e Milheto, tomando-se por base o valor de mercado da saca de soja do dia
                    do referido pagamento. Tais valores, convertidos em produto, serão
                    descontados do volume final a ser pago.</font>
            </font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DAS
                    OBRIGAÇÕES DO CONTRATANTE</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA
                        3ª:</b>
                    Caberá ao CONTRATANTE:</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">a) Bonificar
                o contratado com vale refeição, a ser combinado entre as partes;</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt">
                    b) Promover
                    condições de transporte de Milho e Milheto
                    colhido, de modo a não interromper o fluxo da colheita;</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                c) Fornecer
                o combustível necessário ao funcionamento das máquinas.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DAS
                    OBRIGAÇÕES DO CONTRATADO</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA
                    4ª:</b></font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">
                Caberá ao CONTRATADO, por sua vez: </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">a) Realizar
                o transporte das colheitadeiras de Milho e Milheto até o local onde será
                realizada a colheita, bem como nos, entre as propriedades onde a
                colheita será realizada, e providenciar a retirada das
                colheitadeiras ao final da colheita;</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">b) Realizar
                os serviços com perfeição e qualidade responsabilizando-se por
                todos e quaisquer danos e/ou prejuízos que causar ao CONTRATANTE
                decorrentes da execução dos serviços ora contratados, desde que,
                comprovadamente, sejam decorridos de atos praticados pelo CONTRATADO
                ou seus encarregados;</font>
        </font>
    </p>

    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">c) Responsabilizar-se
                pela ordem e disciplina de seus empregados nas dependências do
                CONTRATANTE, os quais deverão observar e cumprir as normas internas
                de disciplina e segurança;</font>
        </font>
    <p lang="pt-BR" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">d) Efetuar
                o pagamento das obrigações tributárias de sua responsabilidade,
                incluindo o pagamento, na época devida, de tributos que possam
                incidir sobre o contrato ou sobre a prestação dos serviços;</font>
        </font>
    </p>
    <p lang="pt-BR" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">e) Responsabilizar-se,
                integralmente, pelas ferramentas, maquinários e utensílios de sua
                propriedade que serão utilizados no cumprimento deste instrumento;</font>
        </font>
    </p>
    <p class="western" align="justify" style="margin-top: 0.42cm">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">f) Fornecer
                gratuitamente, por sua conta, os Equipamentos de Proteção
                Individual (EPI’s), necessários
                à segurança da mão-de-obra, adequados ao risco, em perfeito estado de
                conservação e funcionamento e disponíveis para
                início imediato,
                com a indicação do Certificado de Aprovação – CA, expedido
                pelo órgão nacional competente em matéria de segurança e saúde
                no trabalho do Ministério do Trabalho e Emprego;</font>
        </font>
        </font>
    <p class="western" align="justify" style="margin-top: 0.42cm">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">g) Fiscalizar
                para que os seus empregados façam uso efetivo dos EPI’S, de
                acordo com a finalidade a que se destinam e respectiva indicação
                de uso, conforme reza a NR – 31;</font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">h) Utilizar
                mão-de-obra especializada, com empregados qualificados aos
                serviços, abstendo-se >de
                contratar menores de 16 anos, bem como, de contratar menores de 18
                anos para trabalho noturno, perigoso ou insalubre</font>
        </font>
        </font>
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">;</font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">i) Efetuar
                o registro dos funcionários que contratar para a execução dos
                serviços, anotando a CTPS dos mesmos e responsabilizando-se por
                todos os encargos trabalhistas, civis, previdenciários e
                securitários. Obriga-se, ainda, a cumprir todas as regras de saúde
                e segurança, fazendo com que o pessoal sob sua responsabilidade
                cumpra as disposições legais referentes à segurança, higiene e
                medicina do trabalho, assumindo toda e qualquer obrigação atinente
                a eventuais acidentes de trabalho ou eventuais danos causados a
                terceiros, decorrentes dos serviços ora contratados não existindo
                qualquer responsabilidade do CONTRATANTE nesse sentido, seja direta,
                indireta, solidária ou subsidiária;</font>
        </font>
    </p>
    </ol>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">O
                CONTRATADO deverá apresentar ao CONTRATANTE, as fichas de registros
                dos empregados, as carteiras de trabalho e as guias GFIP – FGTS e
                GPS – INSS, de toda mão-de-obra contratada para a execução dos
                serviços durante a vigência dos serviços, sob pena de retenção
                pelo CONTRATANTE, dos pagamentos devidos ao CONTRATADO, até a
                regularização.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">Providenciar,
                às suas expensas, a reposição de peças, filtros, óleos
                lubrificantes, mão-de-obra para consertos e reparos das
                colheitadeiras.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DO
                    PRAZO</b></font>
        </font>
    </p>
    <p class="western" align="justify">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA 5ª:</b> Os
                serviços serão realizados no período de 19/06/2023 com previsão
                de término até o dia 25/08/2023, sendo que as áreas deverão estar
                em condições adequadas para a colheita.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western"><br />

    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DISPOSIÇÕES GERAIS</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA 6ª: </b>Para
                a realização da manutenção das máquinas o CONTRATADO devera
                utilizar veículos de sua propriedade.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 7ª:</b>
                    Antes de iniciar os serviços de colheita, o CONTRATADO deverá
                    regular as colheitadeiras, obedecendo às orientações ditadas por
                    profissionais indicados pelo CONTRATANTE, podendo este proceder as
                    vistorias que entender necessárias. Noutro giro, não serão
                    admitidas as perdas que excederem ao limite fixado por hectare, pelos
                    Órgãos de pesquisas vinculados ao Ministério da Agricultura. </font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 8ª: </b>O
                    CONTRATADO somente poderá realizar a colheita nos horários
                    determinados pelo Gerente da Fazenda, ou por outra pessoa designada
                    pelo CONTRATANTE, sempre observando as condições adequadas de
                    umidade.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 9ª: </b>O
                    CONTRATADO assume de forma exclusiva e solidária, os riscos a que
                    estão sujeitos, mormente no que diz respeito a avarias, incêndios,
                    sinistros ou roubos, que porventura venham a atingir as
                    colheitadeiras, os veículos e os equipamentos de suas propriedades,
                    cumprindo-lhes empregar os meios necessários à conservação e
                    vigilância dos seus bens, ficando o CONTRATANTE isento de qualquer
                    responsabilidade a respeito.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 10ª: </b>Cumpre
                    ao CONTRATADO advertir seus empregados e/ou prepostos acerca da
                    proibição do consumo de bebidas alcoólicas no local de trabalho,
                    sem exceção de qualquer dia ou horário, com vistas a manter a
                    ordem e a harmonia entre os obreiros, estendendo-se a advertência
                    quanto à prática de atos atentatórios à honra e aos bons
                    costumes, sob pena de atrair para si todas as conseqüências que
                    advierem do mau proceder de seus serviçais.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font color="#000000">
            <font face="Arial Narrow, sans-serif">
                <font size="2" style="font-size: 11pt"><b>CLÁUSULA 11ª: </b>O
                    CONTRATANTE e o CONTRATADO declaram que a presente avença não
                    constitui vínculo empregatício entre eles, sendo competente a
                    justiça comum para dirimir quaisquer dúvidas.</font>
            </font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>DO FORO</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CLÁUSULA 12ª:</b>
                Elegem as partes, o foro da Comarca de Bom Jesus - GO para nele serem
                dirimidas todas e quaisquer dúvidas ou questões porventura
                resultantes deste instrumento.</font>
        </font>
    </p>
    <p lang="pt-BR" class="western">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt">Assim,
                por estarem justos e contratados, firmam o presente instrumento em 02
                (duas) vias de igual teor e uma só forma, juntamente com 02 (duas)
                testemunhas.</font>
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
    <p lang="pt-BR" class="western" align="center">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>__________________________________</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western" align="center">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CONTRATANTE: PAULO ROBERTO TITOTO</b></font>
        </font>
    </p><br>
    <p lang="pt-BR" class="western" align="center">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>___________________________________</b></font>
        </font>
    </p>
    <p lang="pt-BR" class="western" align="center">
        <font face="Arial Narrow, sans-serif">
            <font size="2" style="font-size: 11pt"><b>CONTRATADO: {{$colhedores->razao_social}}</b></font>
        </font>
    </p><br>
    <p lang="pt-BR" class="western">
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
    </p>
</html>