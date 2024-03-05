@extends('layouts.app')
@section('title', $title)
@section('content')
<x-breadcrumb title="Edite buyer Service" module="Buyer" link="{{route('edit-buyerservice')}}"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid p-4">
                        @livewire('admin.manage-buyer-service',['type' => strtolower($title), 'slug' => $id])
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
