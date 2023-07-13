<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    // Casdastros
    // Cruds Referentes ao Posto
    Route::crud('postocombustivel', 'Cadastro\PostoCombustivelCrudController');
    Route::crud('postoproduto', 'Cadastro\PostoProdutoCrudController');
    Route::crud('postotransferencia', 'Cadastro\PostoTransferenciaCrudController');

    // Lancamentos
    Route::crud('lancamentocombustivel', 'Cadastro\LancamentoCombustivelCrudController');
    Route::any('lancamentocombustivel/estoque/{frotaId}/{postoId}/{produtoId}/{quantidade}/{horimetro}', 'Cadastro\LancamentoCombustivelCrudController@estoque');

    // Lancamentos Sementes
    Route::crud('lancamentos/notasemente', 'Lancamentos\NotaSementeCrudController');

    // Lancamentos Financeiros
    Route::crud('lancamentos/caixa', 'Lancamentos\CaixaCrudController');
    Route::crud('lancamentos/folha', 'Lancamentos\FolhaCrudController');
    Route::any('lancamentos/folha/centroAdministrativo', 'Lancamentos\FolhaCrudController@centro');
    Route::crud('lancamentos/cheque', 'Lancamentos\ChequeEmitidoCrudController');
    Route::crud('lancamentos/transferencia', 'Lancamentos\TransferenciaCrudController');
    Route::any('lancamentos/transferenciasss/{idTransferencia}', 'Lancamentos\TransferenciaCrudController@edit')->name('lancamentos-transferencia');
    Route::any('lancamentos/transferencia-dia', 'LancamentoContaApagarCrudController@transferenciaDoDia')->name('transferencia-dia');
    Route::any('lancamentos/transferenciaDiaPdf', 'LancamentoContaApagarCrudController@transferenciaDiaPdf')->name('transferenciaDiaPdf');
    Route::get('lancamentos/transferencia/{idTransferencia}', 'Lancamentos\TransferenciaCrudController@transferencia')->name('transferencia');

    // Relatorios Financeiros   
    Route::any('relatorios/centro-custo', 'LancamentoContaApagarCrudController@centroCusto');


    Route::crud('tenant', 'TenantCrudController');
    Route::crud('safra', 'SafraCrudController');
    Route::crud('cultura', 'CulturaCrudController');
    Route::crud('variedadecultura', 'VariedadeCulturaCrudController');
    Route::crud('proprietario', 'ProprietarioCrudController');
    Route::crud('produtor', 'ProdutorCrudController');
    Route::crud('fazenda', 'FazendaCrudController');
    Route::crud('talhao', 'TalhaoCrudController');
    Route::crud('locacaotalhao', 'LocacaoTalhaoCrudController');
    Route::post('locacaotalhao/variedade', 'LocacaoTalhaoCrudController@variedade');
    Route::crud('grupoproduto', 'GrupoProdutoCrudController');
    Route::crud('subgrupoproduto', 'SubGrupoProdutoCrudController');
    Route::crud('produto', 'ProdutoCrudController');
    Route::post('produto/subgrupo', 'ProdutoCrudController@subgrupo');
    Route::crud('tipooperacaoagricula', 'TipoOperacaoAgriculaCrudController');
    Route::crud('operadoragricula', 'OperadorAgriculaCrudController');
    Route::crud('centroadministrativo', 'CentroAdministrativoCrudController');
    Route::post('centroadministrativo/fazenda', 'CentroAdministrativoCrudController@fazenda');
    Route::crud('centrocusto', 'CentroCustoCrudController');
    Route::crud('fornecedor', 'FornecedorCrudController');
    Route::crud('lancamentocontaapagar', 'LancamentoContaApagarCrudController');
    Route::any('lancamentocontaapagar/marmitas', 'LancamentoContaApagarCrudController@marmitas');
    Route::any('lancamentocontaapagar/plantio', 'LancamentoContaApagarCrudController@reciboPlantio');
    Route::any('lancamentocontaapagar/marmitas/{idRecibo}', 'LancamentoContaApagarCrudController@recibo')->name('recibo-marmitas');
    Route::any('lancamentocontaapagar/plantio/{idRecibo}', 'LancamentoContaApagarCrudController@plantioRecibo')->name('recibo-plantio');
    Route::crud('grupofrota', 'GrupoFrotaCrudController');
    Route::crud('frota', 'FrotaCrudController');
    Route::crud('servicoagricola', 'ServicoAgricolaCrudController');
    Route::get('servicoagricola/areaTalhao/{idTalhao}', 'ServicoAgricolaCrudController@areaTalhao');
    Route::get('servicoagricola/servico/{idServico}', 'ServicoAgricolaCrudController@servico')->name('servicos');
    Route::get('servicoagricola/{idServico}', 'ServicoAgricolaCrudController@ordem')->name('servicos.ordem');
    Route::get('servicoagricola/produtos/{idServico}', 'ServicoAgricolaCrudController@produtos')->name('servicos.produtos');
    Route::crud('armazem', 'ArmazemCrudController');
    Route::crud('colhedor', 'ColhedorCrudController');
    Route::crud('matrizfrete', 'MatrizFreteCrudController');
    Route::crud('motorista', 'MotoristaCrudController');
    Route::crud('lancamentosafra', 'LancamentoSafraCrudController');
    Route::any('lancamentosafra/locacao', 'LancamentoSafraCrudController@locacao');
    Route::post('lancamentosafra/{id?}/locacao', 'LancamentoSafraCrudController@locacao');
    Route::any('lancamentosafra/frete/{idLocacao}/{idArmazen}/{idMotorista}/{idColhedor}', 'LancamentoSafraCrudController@frete');
    Route::any('lancamentosafra/controles/{numControle}/{numRomaneio}', 'LancamentoSafraCrudController@controles');

    Route::get('relatorios/safra', 'LancamentoSafraCrudController@safra');
    Route::any('relatorios/safras', 'LancamentoSafraCrudController@safras')->name('relatorio_safra');
    Route::get('relatorios/mapaProdutividade', 'LancamentoSafraCrudController@mapaProdutividade');
    Route::get('financeiro/motoristas', 'Financiero\AdiantamentoSafraController@index');
    Route::get('charts/talhao', 'Charts\TalhaoChartController@response')->name('charts.talhao.index');

    // Adiantamentos
    Route::crud('adiantamentomotorista', 'Financiero\AdiantamentoMotoristaCrudController');
    Route::post('adiantamentomotorista/motoristas', 'Financiero\AdiantamentoMotoristaCrudController@motoristas');

    Route::post('adiantamentomotorista/lote', 'LancamentoSafraCrudController@motoristas');


    Route::post('adiantamentomotorista/{id?}/motoristas', 'Financiero\AdiantamentoMotoristaCrudController@motoristas');
    Route::get('adiantamentomotorista/transportadores', 'Financiero\AdiantamentoMotoristaCrudController@transportadores');
    Route::crud('adiantamentocolhedo', 'Financiero\AdiantamentoColhedoCrudController');
    Route::post('adiantamentocolhedo/colhedores', 'Financiero\AdiantamentoColhedoCrudController@colhedores');
    Route::crud('adiantamentoarrendo', 'Financiero\AdiantamentoArrendoCrudController');

    // Relatorios
    Route::any('relatorios/motorista', 'LancamentoSafraCrudController@motorista')->name('relatorio_motorista');
    Route::get('relatorios/motoristas', 'LancamentoSafraCrudController@motoristas'); // aqui
    Route::any('relatorios/motorista/safra', 'LancamentoSafraCrudController@relatorioMotoristaSafra')->name('relatorio_motorista_safra');
    Route::post('relatorios/adiantamento_motoristas', 'LancamentoSafraCrudController@adiantamentoMotoristas')->name('adiantamento_motoristas');
    Route::get('relatorios/colhedores', 'Relatorios\SafraController@colhedores');
    Route::any('relatorios/contas', 'LancamentoContaApagarCrudController@contas')->name('relatorios_contas'); // relatorios_contasPdf
    Route::any('relatorios/contasPdf', 'LancamentoContaApagarCrudController@contasPdf')->name('relatorios_contasPdf'); // relatorios_contasPdf
    Route::any('relatorios/contas_centros', 'LancamentoContaApagarCrudController@centroCusto')->name('relatorios_contas_centros');

    // Silo
    Route::crud('inscricaoestadual', 'Silo\InscricaoEstadualCrudController');
    Route::crud('entradasilo', 'Silo\EntradaSiloCrudController');
    Route::crud('saidasilo', 'Silo\SaidaSiloCrudController');

    // Contratos
    Route::any('contratosMotoristas', 'MotoristaCrudController@contratosMotoristas');
    Route::any('contratoMotorista', 'MotoristaCrudController@contratoMotorista')->name('contrato_motorista');
    Route::any('contratosColhedores', 'ColhedorCrudController@contratosColhedores');
    Route::any('contratoColhedore', 'ColhedorCrudController@contratoColhedore')->name('contrato_colhedore');
    //Route::crud('contratoMotoristas', 'Silo\ContratoInscricaoCrudController');
});
