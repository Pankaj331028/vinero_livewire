@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<x-breadcrumb title='Dashboard'>
</x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid background---color" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    @include('layouts.vmsfilter')
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid p-3">
                        <x-alert></x-alert>
                        <h4 class="text-center text-uppercase">Key Performance Indicators (KPI)</h4>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-bordered" class="display nowrap">
                                        <thead>
                                            <tr>
                                                <th width="25%"></th>
                                                <th width="25%">{{ $current_month }}</th>
                                                <th width="25%">{{ $last_month . ' (Previous Month)'}}</th>
                                                <th width="25%">YTD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($properties as $key => $value)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{ $value['current'] }}</td>
                                                <td>{{ $value['month'] }}</td>
                                                <td>{{ $value['year'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table table-bordered" class="display nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th width="22%">{{ $current_month }}</th>
                                                <th width="22%">{{ $last_month . ' (Previous Month)'}}</th>
                                                <th width="22%">YTD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($agents as $key => $value)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{ $value['current'] }}</td>
                                                <td>{{ $value['month'] }}</td>
                                                <td>{{ $value['year'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-bordered" class="display nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th width="22%">{{ $current_month }}</th>
                                                <th width="22%">{{ $last_month . ' (Previous Month)'}}</th>
                                                <th width="22%">YTD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bids as $key => $value)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td>{{ $value['current'] }}</td>
                                                <td>{{ $value['month'] }}</td>
                                                <td>{{ $value['year'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <form action="{{route('index')}}" method="post">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <strong>Comments & Goals (Press Tab Key)</strong>
                                            <textarea class="form-control" id="comments" name="comments" placeholder="Type your comments and press Tab Key" rows="7">{{old('comments', $admin->comments)}}</textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#comments').blur(function(){
            $(this).closest('form').submit();
        })
    })
</script>
@endsection
