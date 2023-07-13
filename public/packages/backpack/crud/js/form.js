/*
 *
 * Backpack Crud / Form
 *
 */

jQuery(function($) {
    // Define o dominio
    var url = window.location.host;
    $(".cpf").mask("999.999.999-99");
    $(".placa").mask("SSS-9A99");

    ("use strict");
    $(".cpfcnpj").keydown(function() {
        try {
            $(".cpfcnpj").unmask();
        } catch (e) {}

        var tamanho = $(".cpfcnpj").val().length;

        if (tamanho < 11) {
            $(".cpfcnpj").mask("999.999.999-99");
        } else {
            $(".cpfcnpj").mask("99.999.999/9999-99");
        }

        // ajustando foco
        var elem = this;
        setTimeout(function() {
            // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val("");
        $(this).val(currentValue);
    });
    $(".telefone").mask("(00) 0000-0000");
    $(".celular").mask("(00) 00000-0000");
    $(".areas").mask("#.##0,00", { reverse: true });
    $(".inscricao").mask("00.000.000-0");
    //$('.valores').mask("#.##0,00", { reverse: true });
    $(".valores").mask("#.##0,00", { reverse: true });
    $(".volume").mask("#.##0,000", { reverse: true });
    $(".peso").mask("#.##0", { reverse: true });
    $(".desabilitado").attr("readonly", true);
    // Calcula a Quantidade de bombas por aplicação
    $("#vazao").focusout(function() {
        var volumeBomba = $("#volume_bomba").val();
        var vazao = $("#vazao").val();
        var idTalhao = $("#talhao_id").val();
        //alert(idTalhao)
        var capacidadeBomba;
        //volumeBomba = volumeBomba.replace(".", "")
        //volumeBomba = volumeBomba.replace(",", ".")
        vazao = vazao.replace(".", "");
        vazao = vazao.replace(",", ".");
        capacidadeBomba = parseFloat(
            parseFloat(volumeBomba) / parseFloat(vazao)
        );
        $("#capacidade_bomba").val(capacidadeBomba.toFixed(3));
        axios
            .get(`http://${url}/admin/servicoagricola/areaTalhao/${idTalhao}`)
            .then(response => {
                var areaTalhao = response.data;
                var quantBomba = areaTalhao / capacidadeBomba;
                $("#bomba_recomendada").val(quantBomba.toFixed(3));
                $("#area").val(areaTalhao);
            })
            .catch(error => {
                console.log(error);
            });
    });

    $("#bomba_usada").focusout(function() {
        var bombaRecomendada = $("#bomba_recomendada").val();
        var bombaUsada = $("#bomba_usada").val();
        var bombaUsada = bombaUsada.replace(",", ".");
        var diferencaBomba = (bombaUsada * 100) / bombaRecomendada - 100;
        if (bombaUsada > 0) {
            $("#diferenca_bomba").val(diferencaBomba.toFixed(3));
        }
    });

    /**
     * Função para calcular.
     * Peso liquido, Quantidade de sacos, valor do frete
     */
    $("#peso_desconto").focusout(function() {
        var pesoBruto = $("#peso_bruto").val(); // Peso Bruto
        var pesoDesconto = $("#peso_desconto").val(); // Peso do Desconto
        var idLocacao = $("#talhao_id").val(); // Id do Talhão
        var idArmazen = $("#armazem_id").val(); // Id do Armazem
        var idMotorista = $("#motorista_id").val(); // Id do Motorista
        var idColhedor = $("#colhedor_id").val(); // Id do Colhedor
        var totalPeso = pesoBruto - pesoDesconto; // Total do Peso
        var valorDesconto = (pesoDesconto / pesoBruto) * 100; // Porcentagem de desconto
        var sacoBruto = pesoBruto / 60; // Quantidade de Sacos Bruto
        var saco_liquido = totalPeso / 60; // Quantidade de Saco Liquido

        $("#peso_liquido").val(totalPeso);
        $("#desconto").val(valorDesconto.toFixed(2));
        $("#saco_bruto").val(sacoBruto.toFixed(3));
        $("#saco_liquido").val(saco_liquido.toFixed(3));
        axios
            .get(
                `http://${url}/admin/lancamentosafra/frete/${idLocacao}/${idArmazen}/${idMotorista}/${idColhedor}`
            )
            .then(response => {
                //alert(response.data["frete"]["frete"]);
                var valorFrete = sacoBruto * response.data["frete"]["frete"];
                $("#valor_frete").val(valorFrete.toFixed(2));
                $("#motorista_fornecedor_id").val(
                    response.data["motorista"]["fornecedor_id"]
                );
                $("#locacao_talhao_id").val(response.data["locacao"]["id"]);
                $("#variedade_cultura_id").val(
                    response.data["locacao"]["variedade_cultura_id"]
                );
                $("#cultura_id").val(response.data["locacao"]["cultura_id"]);
                $("#colhedor_fornecedor_id").val(
                    response.data["colhedor"]["fornecedor_id"]
                );
                $("#matriz_frete_id").val(response.data["frete"]["id"]);
                $("#freteValor").val(response.data["frete"]["frete"]);
                //alert(response.data["frete"]["frete"]);
                $("#armazen_fornecedor_id").val(
                    response.data["percuso"]["fornecedor_id"]
                );
            })
            .catch(error => {
                console.log(error);
            });
    });

    /**
     * Função para calcular.
     * Peso liquido, Quantidade de sacos, valor do frete
     */
    $("#segunda_pesagam").focusout(function() {
        var primeiraPesagem = $("#primeira_pesagem").val(); // Peso Bruto
        var umidade = $("#umidade").val(); // Peso do Desconto
        var segundaPesagam = $("#segunda_pesagam").val(); // Peso do Desconto
        var valorDesconto = 0;
        var pesoBruto = primeiraPesagem - segundaPesagam;
        var sacoBruto = pesoBruto / 60;
        var pesoLiquido = pesoBruto;
        var sacoLiquido = pesoBruto / 60;

        if (umidade > 14) {
            var descontoUmidade = (umidade - 14) * 1.5;
            valorDesconto = (pesoBruto * descontoUmidade) / 100;
            pesoBrutos = pesoBruto - valorDesconto;
            pesoLiquido = pesoBrutos;
            sacoLiquido = pesoBrutos / 60;

            //alert(valorDesconto);
        }
        $("#desconto").val(valorDesconto);
        $("#peso_bruto").val(pesoBruto);
        $("#peso_liquido").val(pesoLiquido);
        $("#saco_bruto").val(sacoBruto.toFixed(3));
        $("#saco_liquido").val(sacoLiquido.toFixed(3));
    });

    $("#quantidade").focusout(function() {
        var quantidade = $("#quantidade").val(); // Peso Bruto
        var frotaId = $("#frota_id").val(); // Peso do Desconto
        var postoId = $("#posto_combustivel_id").val(); // Id do Talhão
        var produtoId = $("#produto_id").val(); // Id do Armazem
        var horimetro = $("#horimetro").val(); // Id do Armazem

        axios
            .get(
                `http://${url}/admin/lancamentocombustivel/estoque/${frotaId}/${postoId}/${produtoId}/${quantidade}/${horimetro}`
            )
            .then(response => {
                if (response.data["estoque"] === "Vazio") {
                    alert(response.data["estoque"]);
                    $("#produtividade").val();
                } else {
                    $("#produtividade").val(response.data["produtividade"]);
                }

                /*var valorFrete = sacoBruto * response.data['frete']['frete'];
                $("#valor_frete").val(valorFrete.toFixed(2));
                $("#motorista_fornecedor_id").val(response.data['motorista']['fornecedor_id']);
                $("#locacao_talhao_id").val(response.data['locacao']['id']);
                $("#variedade_cultura_id").val(response.data['locacao']['variedade_cultura_id']);
                $("#cultura_id").val(response.data['locacao']['cultura_id']);
                $("#colhedor_fornecedor_id").val(response.data['colhedor']['fornecedor_id']);
                $("#matriz_frete_id").val(response.data['frete']['id']);
                $("#armazen_fornecedor_id").val(response.data['percuso']['fornecedor_id']);    */
            })
            .catch(error => {
                console.log(error);
            });
    });

    $("#num_controle").focusout(function() {
        var numControle = $("#num_controle").val(); // Númeroumero Controle Interno
        var numRomaneio = $("#num_romaneio").val(); // Número Romaneio

        axios
            .get(
                `http://${url}/admin/lancamentosafra/controles/${numControle}/${numRomaneio}`
            )
            .then(response => {
                if (response.data["numControle"] === "Lançado") {
                    alert("Controle já Lançado");
                }
                if (response.data["numRomaneio"] === "Lançado") {
                    alert("Romaneio já Lançado");
                }
            })
            .catch(error => {
                console.log(error);
            });
    });

    /* $("#valor_lancamento").focusout(function () {
        var valorVancamento = $("#valor_lancamento").val();
        var teste = $('.valor_lancamento').mask("#.##0,00");
        alert(teste);

    });*/
});
