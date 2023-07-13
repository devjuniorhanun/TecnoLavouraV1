<hr>
<div class="form-row">
    <div class="form-group col-md-1">
        <label for="periodo">Periodo.:</label><br>
        <select class="form-control form-control-sm" id="periodo" name="periodo">
        <option value="0">Periodo</option>
            @foreach($listaData as $lista)
                <option value="{{ $lista->data_colhido }}" {{ (isset($date['periodo']) && $date['periodo'] == $lista->data_colhido)? 'selected' : '' }}>{{ Carbon\Carbon::parse($lista->data_colhido)->format('d/m/Y') }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="motorista">Motorista.:</label><br>
        <select class="form-control form-control-sm" id="motorista" name="motorista">
        <option value="0">Motorista</option>
            @foreach($listaMotorista as $lista)
                <option value="{{ $lista->id }}" {{ (isset($date['motorista']) && $date['motorista'] == $lista->id)? 'selected' : '' }}>{{ $lista->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="talhao">Talhões.:</label><br>
        <select class="form-control form-control-sm" id="talhao" name="talhao">
        <option value="0">Talhão</option>
            @foreach($listaTalhao as $lista)
                <option value="{{ $lista->id }}" {{ (isset($date['talhao']) && $date['talhao'] == $lista->id)? 'selected' : '' }}>{{ $lista->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-1">
        <label for="armazem">Armázens.:</label><br>
        <select class="form-control form-control-sm" id="armazem" name="armazem">
        <option value="0">Armazén</option>
            @foreach($listaArmazem as $lista)
                <option value="{{ $lista->id }}" {{ (isset($date['armazem']) && $date['armazem'] == $lista->id)? 'selected' : '' }}>{{ $lista->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-1">
        <label for="colhedor">Colhedores.:</label><br>
        <select class="form-control form-control-sm" id="colhedor" name="colhedor">
        <option value="0">Colhedores</option>
            @foreach($listaColhedores as $lista)
                <option value="{{ $lista->id }}" {{ (isset($date['colhedor']) && $date['colhedor'] == $lista->id)? 'selected' : '' }}>{{ $lista->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="proprietario">Proprietario.:</label><br>
        <select class="form-control form-control-sm" id="proprietario" name="proprietario">
        <option value="0">Proprietario</option>
            @foreach($listaProprietarios as $lista)
                <option value="{{ $lista->id }}"{{ (isset($date['proprietario']) && $date['proprietario'] == $lista->id)? 'selected' : '' }}>{{ $lista->razao_social }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="fazenda">Inscrição.:</label><br>
        <select class="form-control form-control-sm" id="fazenda" name="fazenda">
        <option value="0">Inscrição</option>
            @foreach($listaFazendas as $lista)
                <option value="{{ $lista->id }}"{{ (isset($date['fazenda']) && $date['fazenda'] == $lista->id)? 'selected' : '' }}>{{ $lista->inscricao_estadual }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="ciclo_id">&nbsp;</label><br>
            {!! Form::submit('Filtrar', ['id' => 'Filtrar','class' => 'btn btn-info btn-sm']); !!}
        </div>
    </div>

</div>