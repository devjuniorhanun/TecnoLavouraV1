@extends(backpack_view('blank'))

@php
$defaultBreadcrumbs = [
trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
$crud->entity_name_plural => url($crud->route),
trans('backpack::crud.list') => false,
];

// if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
$breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
<div class="container-fluid">
  <h2>
    <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
    <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small>
  </h2>
</div>
@endsection

@section('content')
<!-- Default box -->
<div class="row">

  <!-- THE ACTUAL CONTENT -->
  <div class="{{ $crud->getListContentClass() }}">

    <div class="row mb-0">
      <div class="col-sm-6">
        @if ( $crud->buttons()->where('stack', 'top')->count() || $crud->exportButtons())
        <div class="d-print-none {{ $crud->hasAccess('create')?'with-border':'' }}">

          @include('crud::inc.button_stack', ['stack' => 'top'])

        </div>
        @endif
      </div>
      <div class="col-sm-6">
        <div id="datatable_search_stack" class="mt-sm-0 mt-2 d-print-none"></div>
      </div>
    </div>

    {{-- Backpack List Filters --}}
    @if ($crud->filtersEnabled())
    @include('crud::inc.filters_navbar')
    @endif

    <table id="crudTabled" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
      <thead>
        <tr>
          <th>Produtor.:</th>
          <th>Centro Administrativo.:</th>
          <th>Data Lançamento</th>
          <th>Descrição</th>
          <th>Valor</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($registros as $registro)
        <tr>
          <td>{{ $registro->produtor->razao_social}}</td>
          <td>{{ $registro->centroAdministrativo->fazenda->nome}}</td>
          <td>{{ Carbon\Carbon::parse($registro->data_lancamento )->format('d/m/Y')}}</td>
          <td>{{$registro->descricao_lancamento}}</td>
          <td>R$ {{ number_format($registro->valor_lancamento, 2, ',', '.')}}</td>
        </tr>

        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>Produtor.:</th>
          <th>Centro Administrativo.:</th>
          <th>Data Lançamento</th>
          <th>Descrição</th>
          <th>Valor</th>
        </tr>
      </tfoot>
    </table>

    @if ( $crud->buttons()->where('stack', 'bottom')->count() )
    <div id="bottom_buttons" class="d-print-none text-center text-sm-left">
      @include('crud::inc.button_stack', ['stack' => 'bottom'])

      <div id="datatable_button_stack" class="float-right text-right hidden-xs"></div>
    </div>
    @endif

  </div>

</div>

@endsection

@section('after_styles')
<!-- DATA TABLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css').'?v='.config('backpack.base.cachebusting_string') }}">
<link rel="stylesheet" href="{{ asset('css/print.css') }}">

<!-- CRUD LIST CONTENT - crud_list_styles stack -->
@stack('crud_list_styles')
@endsection

@section('after_scripts')
@include('crud::inc.datatables_logic')
<script src="{{ asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
<script src="{{ asset('packages/backpack/crud/js/form.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
<script src="{{ asset('packages/backpack/crud/js/list.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>

<!-- CRUD LIST CONTENT - crud_list_scripts stack -->
@stack('crud_list_scripts')
@endsection