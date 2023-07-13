@extends(backpack_view('blank'))

@php
$defaultBreadcrumbs = [
trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
$da['crud']->entity_name_plural => url($da['crud']->route),
trans('backpack::crud.list') => false,
];

// if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
$breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
<div class="container-fluid">
    <h2>
        <span class="text-capitalize">{!! $da['crud']->entity_name_plural !!}</span>

    </h2>
</div>
@endsection

@section('content')
<!-- Default box -->
<div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="{{ $da['crud']->getListContentClass() }}">

        <div class="row mb-0">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <div id="datatable_search_stack" class="mt-sm-0 mt-2 d-print-none"></div>
            </div>
        </div>



        <table id="crudTable1" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
            <thead>
                <tr>
                    {{-- Table columns --}}
                    <th scope="col">Data</th>
                    <th scope="col">Motorista</th>
                    <th scope="col">Talhão</th>
                    <th scope="col">Romaneio</th>
                    <th scope="col">Controle</th>
                    <th scope="col">Peso Bruto</th>
                    <th scope="col">Desconto</th>
                    <th scope="col">Peso Líquido</th>
                    <th scope="col">Frete</th>
                    <th scope="col">Valor Frete</th>
                    </th>


                </tr>
            </thead>
            <tbody>
                @foreach($registros as $registro)

                <tr>
                        <td>{{ Carbon\Carbon::parse($registro->data_colhido)->format('d/m/Y') }}</td>
                        <td>{{$registro->motorista->fornecedor->razao_social}}</td>
                        <td>{{$registro->locacaoTalhao->talhao->nome}}</td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th scope="col">Total</th>
                    <th scope="col">Motorista</th>
                    <th scope="col">Talhão</th>
                    <th scope="col">Romaneio</th>
                    <th scope="col">Controle</th>
                    <th scope="col">Peso Bruto</th>
                    <th scope="col">Desconto</th>
                    <th scope="col">Peso Líquido</th>
                    <th scope="col">Frete</th>
                    <th scope="col">Valor Frete</th>
            </tfoot>
        </table>



    </div>

</div>

@endsection



@section('after_scripts')

<script src="{{ asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
<script src="{{ asset('packages/backpack/crud/js/form.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
<script src="{{ asset('packages/backpack/crud/js/list.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>

<!-- CRUD LIST CONTENT - crud_list_scripts stack -->
@stack('crud_list_scripts')
@endsection