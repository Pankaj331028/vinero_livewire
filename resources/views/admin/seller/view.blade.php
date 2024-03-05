@extends('layouts.app')
@section('title', $title)
@push('styles')
	<link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@section('content')
<x-breadcrumb title="{{$title}}" module="Seller" link="{{url($previous_url)}}"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h4>View Seller</h4>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label class="">Seller Name : </label><span class="text-sucees">
                                                {{old('full_name', $seller->full_name)}}</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="">Date :</label><span class="text-sucees"> {{old('created_at',
                                                $seller->created_at)}}</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="">Total property listed :</label><span
                                                class="text-sucees"> {{ $seller->total_properties }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label class="">Approved bids : </label><span class="text-sucees"> {{
                                                $seller->total_bids_accepted }}</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="">Reject bids :</label><span class="text-sucees"> {{
                                                $seller->total_rejected_bids }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="">Comment/Note: </label>
                                            <p class="text-sucees"> {{ $buyer->comment_note ?? ''}}</p>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="">Block Comment:</label>
                                            <p class="text-sucees"> {{ $buyer->block_comment ?? ''}}</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property listing-->
            <div class="row mt-5">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__body">
                            <h4 class="mb-5">List of properties</h4>
                            <!--begin: Datatable -->
                            {!! $properties->table() !!}
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
{!! $properties->scripts() !!}
@endpush