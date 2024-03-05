@extends('layouts.app')
@section('title', $title)
@section('content')
<x-breadcrumb title="{{$title}}" module="Resource" link="{{route('resource')}}"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
  <div class="row">
    <div class="col-xl-12">
    <div class="kt-portlet kt-portlet--height-fluid">
      <div class="kt-portlet__body">
          <div class="kt-widget kt-widget--user-profile-3 border-bottom pb-2">
              <div class="kt-widget__top">
                  <div class="kt-widget__media w-100">
                      
                      <h4>{{('View Resource')}}</h4>
                  </div>
                  
              </div>
          </div>
          <div class="row">
            <div class="kt-portlet">
              <!--begin::Form-->
              <div class="kt-portlet__body">
                <div class="form-group row">

                    <div class="col-lg-3">
                    <label class="">Type :</label><span class="text-sucees"> {{$resources->type
                      ?? '-'}}</span>
                    </div>
                    <div class="col-lg-3">
                    <label class="">Name :</label><span class="text-sucees"> {{$resources->name ??
                      '-'}}</span>
                    </div>
                    <div class="col-lg-3">
                        <label class="">Status : </label><span class="text-sucees"> {{$resources->status == 'AC' ? 'Active' :'Inactive'
                        }}</span>
                    </div> 
                    <div class="col-lg-3">
                    <label class="">File :</label><span class="text-sucees"><img src='{{ asset($resources->file) }}'  width="200" class="img-rounded"  /> </span>   
                    </div>
                    <div class="col-lg-12">
                      <label class="">Short Description :</label><span class="text-sucees"> {!! $resources->short_description ?? '' !!}</span>
                  </div>
                    <div class="col-lg-12">
                        <label class="">Content :</label><span class="text-sucees"> {!! $resources->content ?? '' !!}</span>
                    </div>
                </div>
                
                <div class="form-group row">
                                 
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