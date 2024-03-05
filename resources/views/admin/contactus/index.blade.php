@extends('layouts.app')
@section('title', $title)
@push('styles')
<link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

@endpush
@section('content')
<x-breadcrumb title="Contect-Us"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                	<x-alert>
                    </x-alert>
                    @include('layouts.common-filter')
                    <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">                      
                            &nbsp;
                            {{-- <a href="{{route ('add-resource')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Add Resource
                            </a> --}}
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
                </div>
            </div>

            </div>
        </div>
    </div>
    @endsection
    @push('scripts')
    
	{{-- <script src="{{URL::asset('vendors/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	{!! $dataTable->scripts() !!} --}}


    <script src="{{URL::asset('vendors/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {!! $dataTable->scripts() !!}
    @endpush

