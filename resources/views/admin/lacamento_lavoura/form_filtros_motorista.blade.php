<div class="form-row">
    <div class="form-group col-md-2">
        <label for="motorista">Trasnportador(a).:</label><br>
        <select class="form-control form-control-sm" id="motorista" name="motorista">
        <option value="0">Trasnportador(a)</option>
            @foreach($listaTransportador as $lista)
                <option value="{{ $lista->id }}">{{ $lista->razao_social }}</option>
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