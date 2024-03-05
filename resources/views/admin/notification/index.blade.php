@extends('layouts.app')
@section('title', 'Notifications')
@push('styles')
<link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@section('content')
<x-breadcrumb title="Notifications"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__body">
                            <table class="table table-bordered" class="display nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 25%;"></th>
                                        <th colspan="2" style="width: 25%;">Today</th>
                                        <th style="width: 25%;">Yesterday</th>
                                        <th style="width: 25%;">Daily average last week</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ route('show-notifications', 'type=new_property') }}"> VMS Open</a></td>
                                        <td colspan="2">{{ $today_vms_open }}</td>
                                        <td>{{ $yesterday_vms_open }}</td>
                                        <td>{{ $lastWeek_vms_open }}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('show-notifications', 'type=new_offer') }}">New Buyer's offer</a></td>
                                        <td colspan="2">{{ $today_new_offers }}</td>
                                        <td>{{ $yesterday_new_offers }}</td>
                                        <td>{{ $lastWeek_new_offers }}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('show-notifications', 'type=offer_improve') }}">Improved offer</a></td>
                                        <td colspan="2">{{ $today_improved_offers }}</td>
                                        <td>{{ $yesterday_improved_offers }}</td>
                                        <td>{{ $lastWeek_improved_offers }}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('show-notifications', 'type=counter_offer') }}">Counter offer</a></td>
                                        <td colspan="2">{{ $today_counter_offers }}</td>
                                        <td>{{ $yesterday_counter_offers }}</td>
                                        <td>{{ $lastWeek_counter_offers }}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('show-notifications', 'type=in_contract') }}">In contract</a></td>
                                        <td colspan="2">{{ $today_in_contract }}</td>
                                        <td>{{ $yesterday_in_contract }}</td>
                                        <td>{{ $lastWeek_in_contract }}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('show-notifications', 'type=no_sale') }}">No sale</a></td>
                                        <td colspan="2">{{ $today_no_sale }}</td>
                                        <td>{{ $yesterday_no_sale }}</td>
                                        <td>{{ $lastWeek_no_sale }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
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
    <script src="/vendor/datatables/buttons.server-side.js"></script>

@endpush