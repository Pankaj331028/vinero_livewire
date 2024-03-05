@extends('layouts.app')
@section('title', $title)
@section('content')
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }
</style>
<x-breadcrumb title="Edit agent" module="Agent" link="{{$privious_url}}"></x-breadcrumb>
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
                                        <h4>Edit Agent</h4>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <form class="kt-form kt-form--label-right form-valide"
                                    action="{{ route('update-agent', $agent->id) }}" method="post"
                                    enctype="multipart/form-data" id="agent_form">
                                    {{csrf_field()}}
                                    @if(Session::has('flash_message'))
                                    <div style="color:green; text-align:center">
                                        <h4>{{ Session::get('flash_message') }}</h4>
                                    </div>
                                    @endif
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <input type="hidden" name="agent_id" value="{{$agent->id ?? ''}}">
                                    <input type="hidden" name="privious_url" value="{{$privious_url}}">
                                    <div class="kt-portlet__body">
                                        {{-- <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label class="">First Name : </label><span class="text-danger">*</span>
                                                <input class="form-control" id="first_name" name="first_name"
                                                    value="{{old('first_name', $agent->first_name)}}" />
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="">Last Name :</label><span class="text-danger">*</span>
                                                <input class="form-control" id="last_name" name="last_name"
                                                    value="{{old('last_name', $agent->last_name)}}" />
                                            </div>
                                        </div> --}}
                                        <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label class="">Comment/Note : </label><span
                                                        class="text-danger">*</span>
                                                    <textarea class="form-control" id="comment_note"
                                                        name="comment_note">{{old('comment_note', $agent->comment_note)}} </textarea>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label class="">Status : </label><span class="text-danger">*</span>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="">Select status</option>
                                                        <option value="1" {{ $agent->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $agent->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8">
                                                        <button type="Submit" class="btn btn-primary">Update</button>
                                                        <a href="{{$privious_url}}" class="btn btn-secondary">Cancel</a>
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