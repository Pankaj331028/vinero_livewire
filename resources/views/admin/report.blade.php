@extends('layouts.app')
@section('title','Reports')
@section('content')

<x-breadcrumb title='Reports'>
</x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-xl-12">
            @include('layouts.vmsfilter')
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__body">
                    <table class="table table-bordered" class="display nowrap">
                        <thead>
                            <tr>
                                <th style="width: 25%;"></th>
                                <th colspan="2" style="width: 25%;">{{ $current_month }}</th>
                                <th style="width: 25%;">{{ $last_month . ' (Previous Month)'}}</th>
                                <th style="width: 25%;">YTD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Number of houses sold</td>
                                <td colspan="2">{{ $house_sold }}</td>
                                <td>{{ $house_sold_submonth }}</td>
                                <td>{{ $house_sold_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Number of houses sold No Buyers Agent</td>
                                <td colspan="2">{{ $no_agent }}</td>
                                <td>{{ $no_agent_submonth }}</td>
                                <td>{{ $no_agent_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Dollar volume of sales</td>
                                <td colspan="2">{{ $dollar_sales }}</td>
                                <td>{{ $dollar_sales_submonth }}</td>
                                <td>{{ $dollar_sales_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Average transaction $</td>
                                <td colspan="2">{{ $avg_transaction }}</td>
                                <td>{{ $avg_transaction_submonth }}</td>
                                <td>{{ $avg_transaction_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Commission Generated</td>
                                <td colspan="2">{{ $commission }}</td>
                                <td>{{ $commission_submonth }}</td>
                                <td>{{ $commission_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Buyer Sales commission</td>
                                <td colspan="2">{{ $buyer_commission }}</td>
                                <td>{{ $buyer_commission_submonth }}</td>
                                <td>{{ $buyer_commission_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Qonection commission</td>
                                <td colspan="2">{{ $qonection_commission }}</td>
                                <td>{{ $qonection_commission_submonth }}</td>
                                <td>{{ $qonection_commission_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Average commission</td>
                                <td colspan="2">{{ $avg_commission }}</td>
                                <td>{{ $avg_commission_submonth }}</td>
                                <td>{{ $avg_commission_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Average Buyer's commission</td>
                                <td colspan="2">{{ $avg_buyer_commission }}</td>
                                <td>{{ $avg_buyer_commission_submonth }}</td>
                                <td>{{ $avg_buyer_commission_ytd }}</td>
                            </tr>
                            <tr>
                                <td>Buyer's commission savings (2.50%)</td>
                                <td colspan="2">{{ $buyer_commission_savings }}</td>
                                <td>{{ $buyer_commission_savings_submonth }}</td>
                                <td>{{ $buyer_commission_savings_ytd }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-xl">
                    <div class="kt-portlet col-md-3 col-lg-3 col-xl-3 mr-5">
    
                        <!--begin::Total Visitors-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Seller Report
                                    </h4>
                                    <h4 class="kt-widget24__title">
                                        {{ $seller_count }}
                                    </h4>
                                </div>
                                <span class="kt-widget24__stats kt-font-brand">
                                   <i class="la la-archive"></i>
                                </span>
                            </div>
                        </div>
                        <!--end::Total Visitors-->
                    </div>
                    <div class="kt-portlet col-md-3 col-lg-3 col-xl-3 mr-5">
                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Buyer Report
                                    </h4>
                                    <h4 class="kt-widget24__title">
                                        {{ $buyer_count }}
                                    </h4>
                                </div>
                                <span class="kt-widget24__stats kt-font-brand">
                                   <i class="la la-archive"></i>
                                </span>
                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                    <div class="kt-portlet col-md-3 col-lg-3 col-xl-3 mr-5">
                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Agent Report
                                    </h4>
                                    <h4 class="kt-widget24__title">
                                        {{ $agent_count }}
                                    </h4>
                                </div>
                                <span class="kt-widget24__stats kt-font-brand">
                                   <i class="la la-archive"></i>
                                </span>
                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                    <div class="kt-portlet col-md-3 col-lg-3 col-xl-3 mr-5">
                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Property Report
                                    </h4>
                                    <h4 class="kt-widget24__title">
                                        {{ $property_count }}
                                    </h4>
                                </div>
                                <span class="kt-widget24__stats kt-font-brand">
                                   <i class="la la-archive"></i>
                                </span>
                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                    <div class="kt-portlet col-md-3 col-lg-3 col-xl-3 mr-5">
                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Bid/Offer Report
                                    </h4>
                                    <h4 class="kt-widget24__title">
                                        {{ $offer_count }}
                                    </h4>
                                </div>
                                <span class="kt-widget24__stats kt-font-brand">
                                   <i class="la la-archive"></i>
                                </span>
                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                    <div class="kt-portlet col-md-3 col-lg-3 col-xl-3 mr-5">
                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Approval Report
                                    </h4>
                                    <h4 class="kt-widget24__title">
                                        {{ $approved_offer_count }}
                                    </h4>
                                </div>
                                <span class="kt-widget24__stats kt-font-brand">
                                   <i class="la la-archive"></i>
                                </span>
                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                    <div class="kt-portlet col-md-3 col-lg-3 col-xl-3 mr-5">
                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title">
                                        Offer Rejection Report
                                    </h4>
                                    <h4 class="kt-widget24__title">
                                        {{ $rejected_offer_count }}
                                    </h4>
                                </div>
                                <span class="kt-widget24__stats kt-font-brand">
                                   <i class="la la-archive"></i>
                                </span>
                            </div>
                        </div>
                        <!--end::New Users-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
