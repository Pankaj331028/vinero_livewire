@extends('layouts.app')
@section('title','Edit ' . $cms->title)
@push('styles')
<link href="{{URL::asset('vendors/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }
</style>
{{-- <x-breadcrumb title="Edit agent" module="Agent" link="{{$privious_url}}"></x-breadcrumb> --}}

<!-- begin:: Content -->
<x-breadcrumb title="Edit {!!$cms->title!!}">
</x-breadcrumb>
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid p-4">
                        @livewire('admin.manage-cms',['slug'=>$cms->slug])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection