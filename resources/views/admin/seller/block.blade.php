@extends('layouts.app')
@section('title', $title)
@section('content')
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<x-breadcrumb title="{{$title}}" module="seller" link="{{url($previous_url)}}"></x-breadcrumb>
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
                                        <h4>{{('Block/Unblock Agent')}}</h4>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <form class="kt-form kt-form--label-right"
                                    action="{{ route('seller-block-update', $seller->id) }}" method="post"
                                    enctype="multipart/form-data" id="block_form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="previous_url" value="{{$previous_url}}">
                                    <div class="kt-section__content kt-section__content--solid">
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="form-group row">

                                            <div class="col-lg-6">
                                                <label class="">Name:</label><span class="text-sucees"> {{
                                                    $seller->name }}</span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="">Email :</label><span class="text-sucees"> {{
                                                    $seller->email_id ?? ''}}</span>
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="">VMS Number :</label><span class="text-sucees"> {{
                                                    $seller->phone_no ?? ''}}</span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="">OPT :</label><span class="text-sucees"> {{ $seller->optin_out ?? ''}}</span>
                                            </div>
                                         </div>
                                         <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label class="">Block/Unblock Status:</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Select</option>
                                                    @if($seller->status == 0 || $seller->status == 1 || $seller->status == 2 )
                                                    <option value="3" {{ $seller->status == 3 ? 'selected' : '' }}>Block</option>
                                                    @else
                                                    <option value="1" {{ $seller->status == 1 ? 'selected' : '' }}>Unblock</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="">Block/Unblock Comment: </label>
                                                <textarea class="form-control" name="block_comment"
                                                    id="block_comment"> {{ $seller->block_comment ?? ''}}</textarea>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-8">
                                                    <button type="Submit" class="btn btn-primary">Update</button>
                                                    <a href="{{url($previous_url)}}" class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection