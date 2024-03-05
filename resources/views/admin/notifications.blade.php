@extends('layouts.app')
@section('title', 'Notifications')
@push('styles')
<link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@section('content')
<x-breadcrumb title="Notifications"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    @include('layouts.vmsfilter')
                    <x-alert>
                    </x-alert>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__head-toolbar ">
                                
                                <a href="{{ route('notifications', 'type=all') }}" class="btn btn-label-brand btn-bold btn-sm @if(request()->type == 'all') active @elseif(request()->get('property_type') == 'all') active @endif">All Notifications ({{ $total }})</a>
                                <a href="{{ route('notifications', 'type=new_property') }}" class="btn btn-label-brand btn-bold btn-sm @if(request()->type == 'new_property') active @elseif(request()->get('property_type') == 'new_property') active @endif">VMS Open ({{ $open }})</a>
                                <a href="{{ route('notifications', 'type=new_offer') }}" class="btn btn-label-brand btn-bold btn-sm @if(request()->type == 'new_offer') active @elseif(request()->get('property_type') == 'new_offer') active @endif">New Buyer's Offer ({{ $new_offers }})</a>
                                <a href="{{ route('notifications', 'type=offer_improve') }}" class="btn btn-label-brand btn-bold btn-sm @if(request()->type == 'offer_improve') active @elseif(request()->get('property_type') == 'offer_improve') active @endif">Improved Offer ({{ $improved_offers }})</a>
                                <a href="{{ route('notifications', 'type=counter_offer') }}" class="btn btn-label-brand btn-bold btn-sm @if(request()->type == 'counter_offer') active @elseif(request()->get('property_type') == 'counter_offer') active @endif">Counter Offer ({{ $counter_offers }})</a>
                                <a href="{{ route('notifications', 'type=in_contract') }}" class="btn btn-label-brand btn-bold btn-sm @if(request()->type == 'in_contract') active @elseif(request()->get('property_type') == 'in_contract') active @endif">In Contract ({{ $in_contract }})</a>
                                <a href="{{ route('notifications', 'type=no_sale') }}" class="btn btn-label-brand btn-bold btn-sm @if(request()->type == 'no_sale') active @elseif(request()->get('property_type') == 'no_sale') active @endif">No Sale ({{ $no_sale }})</a>
                            </div>
                            </br>
                            </br>
                            <!--begin: Datatable -->
                            {!! $dataTable->table() !!}
                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{URL::asset('vendors/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
@endpush