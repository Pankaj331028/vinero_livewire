@extends('layouts.app')
@section('title',$title)

@push('styles')
    <link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@section('content')
<x-breadcrumb title="Accounts">
</x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row mb-3">
                <ul class="nav nav-tabs card-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->status=='AC' || request()->status=='') active @endif" href="{{ url('admin/accounts?status=AC') }}" role="tab">
                            Active
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::has('status') && Request::get('status')=='IN') active @endif" href="{{ url('admin/accounts?status=IN') }}" role="tab">
                            Inactive
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::has('status') && Request::get('status')=='Bench') active @endif" href="{{ url('admin/accounts?status=Bench') }}" role="tab">
                            Bench
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <x-alert>
                    </x-alert>
                    @include('layouts.vmsfilter')
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="tab-content">
                            <div class="tab-pane @if(request()->status=='AC' || request()->status=='') active @endif">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{route('add-account')}}" class="btn btn-primary btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    Appoint Manager
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
                                    {!! $dataTable->table() !!}
                                    <!--end: Datatable -->
                                </div>
                            </div>
                            <div class="tab-pane @if(Request::has('status') && Request::get('status')=='Bench') active @endif" id="decommission" role="tabpanel">
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
                                    {!! $decomDataTable->table() !!}
                                    <!--end: Datatable -->
                                </div>
                            </div>
                            <div class="tab-pane @if(Request::has('status') && Request::get('status')=='IN') active @endif" id="inactive" role="tabpanel">
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
                                    {!! $inactiveDataTable->table() !!}
                                    <!--end: Datatable -->
                                </div>
                            </div>
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
    {!! $decomDataTable->scripts() !!}
    {!! $inactiveDataTable->scripts() !!}
@endpush
