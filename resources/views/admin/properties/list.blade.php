@extends('layouts.app')
@section('title', $title)
@push('styles')
<link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<style type="text/css">
    tr:has(span.prior_active){
        background: #faebd7;
    }
</style>
@endpush
@section('content')
<x-breadcrumb title="{{ $title }}"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    @include('layouts.vmsfilter')
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__body">
                            <x-alert>
                            </x-alert>
                            <div class="kt-portlet__head-toolbar ">
                                @if(Helper::checkAccess('list all_property'))
                                        <a href="{{ route('properties', 'state=ALL') }}" class="btn btn-label-brand btn-bold btn-sm  @if(request()->state=='ALL') active @endif">All
                                            Listing ({{ $total_all }})</a>
                                        <a href="{{ route('properties', 'status=NL') }}"
                                            class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='NL') active @endif">New Listing ({{ $total_nl }})</a>
                                        <a href="{{ route('properties', 'status=IP') }}"
                                            class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='IP') active @endif">In Process ({{ $total_ip }})</a>
                                        <a href="{{ route('properties', 'status=RJ') }}"
                                        class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='RJ') active @endif">Rejected ({{ $total_rj }})</a>
                                        @if(Helper::checkAccess('list active_property'))
                                            <a href="{{ route('properties', 'status=AC') }}"
                                            class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='AC') active @endif">VMS Active ({{ $total_ac }})</a>
                                            <a href="{{ route('properties', 'status=VC') }}"
                                            class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='VC') active @endif">VMS 24 hour Close ({{ $total_vc }})</a>
                                        @endif
                                        <a href="{{ route('properties', 'status=FL') }}"
                                        class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='FL') active @endif">Flagged ({{ $total_fl }})</a>
                                        @if(Helper::checkAccess('list farm_property'))
                                            <a href="{{ route('properties', 'status=FR') }}"
                                            class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='FR') active @endif">FARM ({{ $total_fa }})</a>
                                        @endif
                                @endif
                            </div></br>
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
{!! $dataTable->scripts() !!}
@endpush