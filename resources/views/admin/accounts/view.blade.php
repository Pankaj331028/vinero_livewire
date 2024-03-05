@extends('layouts.app')
@section('title','Account Details')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/wizard/wizard-2.css')}}">
    <link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@section('content')
<x-breadcrumb title="Account Details" module="Accounts" link="{{url($previous_url)}}">
</x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="row m-0">
                    <div class="kt-portlet border-right border-secondary h-100">
                        <div class="kt-portlet__body p-0">
                            <div class="kt-widget kt-widget--user-profile-3 p-4">
                                <div class="kt-widget__top">
                                    <div class="kt-widget__content">
                                        <x-alert>
                                        </x-alert>
                                        <div class="kt-widget__head float-right">
                                            <div class="kt-widget__action">
                                                <a href="{{route('edit-account',['id'=>$account->id])}}" type="button" class="btn btn-label-success btn-sm btn-upper">Edit</a>&nbsp;
                                                @if($account->status!='DL')
                                                <a type="button" class="btn btn-label-{{config()->get('constants.background.' . $account->status)}} btn-sm btn-upper" title="{{config()->get('constants.account_status.' . $account->status)}}">{{ config()->get('constants.account_status.' . $account->status)}}</a>
                                                {{-- href="{{route('status-account', ['id' => $account->id])}}" --}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--begin::Section-->
                            <div class="kt-section mb-0 listing-wizard">
                                <div class="kt-section__content kt-section__content--fit">
                                    <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
                                        <div class="kt-grid__item kt-wizard-v2__aside">

                                            <!--begin: Form Wizard Nav -->
                                            <div class="kt-wizard-v2__nav">
                                                <div class="kt-wizard-v2__nav-items">
                                                    <a class="kt-wizard-v2__nav-item" href="javascript:;" data-ktwizard-type="step" data-ktwizard-state="current">
                                                        <div class="kt-wizard-v2__nav-body">
                                                            <div class="kt-wizard-v2__nav-label">
                                                                <div class="kt-wizard-v2__nav-label-title">
                                                                    Personal Details
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="kt-wizard-v2__nav-item" href="javascript:;" data-ktwizard-type="step" data-ktwizard-state="current">
                                                        <div class="kt-wizard-v2__nav-body">
                                                            <div class="kt-wizard-v2__nav-label">
                                                                <div class="kt-wizard-v2__nav-label-title">
                                                                    Permissions
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <!--end: Form Wizard Nav -->
                                        </div>
                                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">
                                            <form class="kt-form" id="kt_form">
                                                <!--begin: Form Wizard Step 1-->
                                                <div class="kt-wizard-v2__content mb-0" data-ktwizard-type="step-content" id="profile" data-ktwizard-state="current">
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v2__form">
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                                    Name
                                                                </label>
                                                                <div class="col-lg-6 col-xl-6 col-form-label">
                                                                    {{$account->name}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                                    Mobile Number
                                                                </label>
                                                                <div class="col-lg-6 col-xl-6 col-form-label">
                                                                    {{$account->mobile_number}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                                    Email Address
                                                                </label>
                                                                <div class="col-lg-6 col-xl-6 col-form-label">
                                                                    {{$account->email}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                                    Description
                                                                </label>
                                                                <div class="col-lg-6 col-xl-6 col-form-label">
                                                                    {{$account->description}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 1-->

                                                <!--begin: Form Wizard Step 2-->
                                                <div class="kt-wizard-v2__content mb-0" id="workshop" data-ktwizard-type="step-content">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-section kt-section--first">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label required">
                                                                        Assign Modules
                                                                    </label>
                                                                    <div class="col-lg-8 col-xl-8 m-3 p-1">
                                                                        @foreach(config()->get('constants.modules') as $key => $value)
                                                                            <h5>{{$value['name']}}</h5>
                                                                            <div class="kt-checkbox-inline mb-3">
                                                                                @foreach($value['actions'] as $action)
                                                                                    <label class="kt-checkbox">
                                                                                        <input type="checkbox" onclick="return false" @if($account->hasPermissionTo($action." ".$key)) checked @endif> {{ucwords($action)}}
                                                                                        <span></span>
                                                                                    </label>
                                                                                @endforeach
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kt-widget kt-widget--user-profile-3 p-4">
                                <div class="kt-widget__bottom">
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-calendar"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">{{$account->actions()->where('log_name',$module)->count()}} Activities in <strong class="text-dark">{{Config::get('constants.modules.'.$module)['name']}}</strong> Module</span>
                                            <a href="javascript:;" onclick="showActivitiesTable()" class="kt-widget__value kt-font-brand">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Activity Log
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body table-responsive" id="activities">
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
<script src="{{asset('js/wizard/wizard-2.js')}}"></script>
<script src="{{URL::asset('vendors/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}
<script type="text/javascript">
    function showActivitiesTable() {
        $('html, body').animate({
            scrollTop: $("#activities").offset().top - 200
        }, 2000);
    }

</script>
@endpush
