<div class="form-row">
    <div class="form-group col-md-3">
        <label for="fornecedor">Colhedores.:</label><br>
        <select class="form-control form-control-sm" id="fornecedor" name="fornecedor">
            <option value="0">Colhedoress</option>
            @foreach($colhedores as $lista)
            <option value="{{ $lista->id }}" {{ (isset($date['fornecedor']) && $date['fornecedor'] == $lista->id)? 'selected' : '' }}>{{ $lista->razao_social }}</option>
            @endforeach
        </select>
    </div>
    {!! Form::submit('Gera', ['id' => 'Filtrar','class' => 'btn btn-info btn-sm']); !!}
</div>