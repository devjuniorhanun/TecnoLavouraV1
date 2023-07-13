@extends(backpack_view('blank'))
@php
$defaultBreadcrumbs = [
trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
$crud->entity_name_plural => url($crud->route),
trans('backpack::crud.preview') => false,
];

// if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
$breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp


@section('header')
<section class="container-fluid d-print-none">
    <a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
    <h2>
        <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
    </h2>
</section>
@endsection

@section('content')


@for($i=1;$i<=2;$i++) <div class="row mb-5 recibos">
    <div class="col border rounded">
        <div class="row">
            <div class="col col-md-5 border rounded recibo">Recibo</div>
            <div class="col col-md-2 offset-md-2 border rounded">
                <div class="row">
                    <div class="col"><b>Nº</b></div>
                </div>
                <div class="row">
                    <div class="col numeroRecibo">445</div>
                </div>
            </div>
            <div class="col col-md-3 border rounded">
                <div class="row">
                    <div class="col"><b>Valor R$</b></div>
                </div>
                <div class="row">
                    <div class="col numeroRecibo">R$ 16.100,00</div>
                </div>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col border rounded">
                Recebi(emos) de: <b>Paulo Roberto Titoto</b>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col border rounded">
                Endereço: <b>Fazenda Santa Martha, Rod. BR-452, Km 101 - Zona Rural</b>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col border rounded">
                A importância de: <b>( {{extenso(16100)}} ) </b>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col border rounded">
                Referente a: <b>Pagamento de Parceria de Arrendo de Soja - Safra 22/23. {{ $entry->safra->nome}} </b>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col border rounded">
                <b>
                    <div class="text-center">Recebimento através de </div>
                </b>
            </div>
        </div>

        <div class="row pt-2">
            <div class="col col-md-2 border rounded">{{ $entry->tipo_adiantamento }}</div>
            <div class="col col-md-2 border rounded">
                <div class="row">
                    <div class="col"><b>Banco</b></div>
                </div>
                <div class="row">
                    <div class="col numeroRecibo">BRASIL</div>
                </div>

            </div>
            <div class="col col-md-2 border rounded">
                <div class="row">
                    <div class="col"><b>Agência</b></div>
                </div>
                <div class="row">
                <div class="col numeroRecibo">4392</div>
                </div>
            </div>
            <div class="col col-md-2 border rounded">
                <div class="row">
                    <div class="col"><b>Nº Conta</b></div>
                </div>
                <div class="row">
                    <div class="col numeroRecibo">5797-5</div>
                </div>
            </div>
            <div class="col col-md-2 border rounded">
                <div class="row">
                    <div class="col"><b>Nº Cheque</b></div>
                </div>
                <div class="row">
                    <div class="col numeroRecibo">195393</div>
                </div>
            </div>
            
        </div>

        <div class="row pt-2">
            <div class="col col-md-4">
                <div class="row">
                    <div class="col border rounded">
                        <div class="row">
                            <div class="col">
                                Nome do Emitente
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>NATAL NETO DOS SANTOS</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col border rounded">
                        <div class="row">
                            <div class="col">
                                Endereço
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>FAZENDA SANTA BARBARA NATALLINO</b>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col border rounded">
                        <div class="row">
                            <div class="col">
                                Cpf / Cnpj
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <b>091.935.101-87</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="row">
                    <div class="col border rounded">
                        <div class="row">
                            <div class="col border rounded">
                                <div class="row">
                                    <div class="col">
                                        Data
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        {{ Carbon\Carbon::parse($entry->data_pagamento)->format('d/m/Y')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">&nbsp;</div>
                        </div>
                        <div class="row pt-2">
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                Assinatura
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-2">
                <div class="row">
                    <div class="border rounded pt-5">
                        <div class="col pb-5">
                            <img src="{{ asset('img/logo.png') }}" alt="Santa Martha" class="mx-auto" style="width: 140px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col text-right">
                <small>{{$i}}º Via</small>
            </div>
        </div>
    </div>
    </div>

    @if($i == 1)
    <hr class="mb-5">
    @endif

    @endfor

    @endsection

    @section('after_styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endsection