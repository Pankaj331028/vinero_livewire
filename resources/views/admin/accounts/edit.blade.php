@extends('layouts.app')
@section('title','Edit Account')
@section('content')
<x-breadcrumb title="Edit Account" module="Accounts" link="{{route('accounts')}}">
</x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        @livewire('admin.manage-account',['type'=>'edit','slug'=>$id,'previous_url' => URL::previous()])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
