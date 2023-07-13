<div class="form-row">
    <div class="form-group col-md-2">
        <label for="data_lancamento">Período Inicial.:</label><br>
        {!! Form::date('data_lancamento', (isset($date['data_lancamento']))? $date['data_lancamento'] : '') !!}
    </div>
    <div class="form-group col-md-2">
        <label for="data_vencimento">Periodo Final.:</label><br>
        {!! Form::date('data_vencimento',(isset($date['data_vencimento']))? $date['data_vencimento'] : '') !!}
    </div>
    <div class="form-group col-md-2">
        <label for="fornecedor">Fornecedor(a)s.:</label><br>
        <select class="form-control form-control-sm" id="fornecedor" name="fornecedor">
        <option value="0">Fornecedor(a)s</option>
            @foreach($fornecedores as $lista)
                <option value="{{ $lista->id }}" {{ (isset($date['fornecedor']) && $date['fornecedor'] == $lista->id)? 'selected' : '' }}>{{ $lista->razao_social }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="centroCusto">Centro de Custo.:</label><br>
        <select class="form-control form-control-sm" id="centroCusto" name="centroCusto">
        <option value="0">Centro de Custo</option>
            @foreach($centroCusto as $lista)
                <option value="{{ $lista->id }}" {{ (isset($date['centroCusto']) && $date['centroCusto'] == $lista->id)? 'selected' : '' }}>{{ $lista->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="tipo">Tipo Pagamento.:</label><br>
        <select class="form-control form-control-sm" id="tipo" name="tipo">
        <option value="">Pagamentos</option>
        <option value="BOLETO"{{ (isset($date['tipo']) && $date['tipo'] == 'BOLETO')? 'selected' : '' }}>BOLETO</option>
        <option value="DINHEIRO"{{ (isset($date['tipo']) && $date['tipo'] == 'DINHEIRO')? 'selected' : '' }}>DINHEIRO</option>
        <option value="CHEQUE"{{ (isset($date['tipo']) && $date['tipo'] == 'CHEQUE')? 'selected' : '' }}>CHEQUE</option>
        <option value="TRANSFERÊNCIA"{{ (isset($date['tipo']) && $date['tipo'] == 'TRANSFERÊNCIA')? 'selected' : '' }}>TRANSFERÊNCIA</option>
            
        </select>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="ciclo_id">&nbsp;</label><br>
            {!! Form::submit('Filtrar', ['id' => 'Filtrar','class' => 'btn btn-info btn-sm']); !!}
        </div>
    </div>
    

</div>