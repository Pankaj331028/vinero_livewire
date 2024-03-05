@extends('layouts.app')
@section('title', $title)
@section('content')
<x-breadcrumb title="{{$title}}"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-xl-12">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__body">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <x-alert>
                        </x-alert>
                        <div class="kt-widget__top">
                            <div class="kt-widget__media w-100">
                                <p class="text-uppercase font-weight-bold">Property Code - {{ $offer->property_code }}</p>
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <a href="#" class="kt-widget__username">
                                        {{-- {{ $user->name }} @if($user->user_role->role == 'attorney') <span class="badge badge-info mr-2">{{ $user->average_rating }}</span>@endif --}}
                                    </a>
                                    <div class="kt-widget__action">
                                        <i class="flaticon-calendar-1 mr-2"></i><span>{{ \Carbon\Carbon::parse($offer->vms_end_date)->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Download Files-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__body table-responsive">
                    <!--begin: Datatable -->
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab1_content" role="tab" aria-selected="false">
                                My Offer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab2_content" role="tab" aria-selected="false">
                                Transaction Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab3_content" role="tab" aria-selected="true">
                                Acquistion strategy
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab4_content" role="tab" aria-selected="true">
                                Contract timings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab5_content" role="tab" aria-selected="true">
                                Document verification
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab6_content" role="tab" aria-selected="true">
                                Items Include & Exclude
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab7_content" role="tab" aria-selected="true">
                                Allocation of cost
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab8_content" role="tab" aria-selected="true">
                                Financial Credentials
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab9_content" role="tab" aria-selected="true">
                                Smart Negotiations
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget2_tab1_content">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Date offer :</label><span class="text-capitalize"> {{\Carbon\Carbon::parse($offer->date_offers)->format('d M, Y H:i') ?? ''}} </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Buyer name :</label><span class="text-capitalize"> {{$offer->buyer_name ??
                                        ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Legal entity : </label><span class="text-capitalize">
                                        {{$offer->legal_entity ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Represented by :</label><span class="text-capitalize">
                                        {{$offer->represented_by ?? ''}} </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Buyer brokerage firm :</label><span class="text-capitalize">
                                        {{$offer->buyer_brokerage_firm ?? ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Buyer brokerge license : </label><span class="text-capitalize">
                                        {{$offer->buyer_brokerge_license ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Buyer agent :</label><span class="text-capitalize"> {{$offer->buyer_agent
                                        ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Buyer agent license :</label><span class="text-capitalize">
                                        {{$offer->buyer_agent_license ?? ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Buyer agent phone : </label><span class="text-capitalize">
                                        {{$offer->buyer_agent_phone ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Buyer agent commission :</label><span class="text-capitalize">
                                        {{$offer->buyer_agent_commission_percentage . '%' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Buyer agent commission :</label><span class="text-capitalize">
                                        {{ $currency.number_format($offer->buyer_agent_commission) ?? ''}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget2_tab2_content">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Offer price : </label><span class="text-capitalize"> {{$currency.number_format($offer->offer_price)
                                        ?? ''}}</span>
                                </div>
                                {{-- <div class="col-lg-4">
                                    <label class="">Seller credit represent : </label><span class="text-capitalize">{{$offer->seller_credit_repersent ?? ''}} </span>
                                </div> --}}
                                <div class="col-lg-4">
                                    <label class="">Seller credit : </label><span class="text-capitalize">
                                        {{$offer->seller_credit.'%' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Seller credit amount : </label>
                                    <span class="text-capitalize">{{$currency.number_format($offer->seller_credit_amount) ?? ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Net price :</label><span class="text-capitalize"> {{$currency.number_format($offer->net_price) ??
                                        ''}} </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Days of escrow :</label><span class="text-capitalize">{{$offer->days_of_escrow ?? ''}} </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Occupancy :</label><span class="text-capitalize"> {{$offer->occupancy ??
                                        ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Possession :</label><span class="text-capitalize"> {{$offer->possession ??
                                        ''}} </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Final verification : </label><span class="text-capitalize">
                                        {{ $offer->final_verification.' days' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Assignment request :</label><span class="text-capitalize">
                                        {{ $offer->assignment_request.' days' ?? ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="">Expiration offer : </label><span class="text-capitalize">
                                        1 day after offer deadline date ({{ \Carbon\Carbon::parse($offer->vms_end_date)->format('d M, Y') }}) or upon Buyers withdrawal of offer</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget2_tab3_content">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Estimated closing costs : </label><span class="text-capitalize">{{ $offer->estimated_closing_costs.'%' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Initial deposit amount :</label><span class="text-capitalize">{{$currency.number_format($offer->initial_deposit_amount) ?? ''}} </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Within days :</label><span class="text-capitalize"> {{$offer->within_days
                                        ?? ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Deposit Increase : </label><span class="text-capitalize">{{$currency.number_format($offer->deposit_increase) ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Days to increase :</label><span class="text-capitalize">
                                        {{$offer->days_to_increase ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Balance down payment :</label><span class="text-capitalize">{{$currency.number_format($offer->balance_down_payment) ?? ''}} </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <h6>Purchase Loan 1st</h6>
                                <div class="form-group row col-md-12">
                                    <div class="col-lg-4">
                                        <label class="">Mortgage loan amount : </label><span class="text-capitalize">
                                            {{$currency.number_format($offer->first_mortgage_loan_amount) ?? ''}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Loan interest rate :</label><span class="text-capitalize">{{$offer->first_loan_interest_rate.'%' ?? ''}} </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Mortage loan points :</label><span class="text-capitalize">
                                            {{$offer->first_mortage_loan_points ?? ''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <div class="col-lg-4">
                                        <label class="">Direct lender name : </label><span class="text-capitalize">{{$offer->first_direct_lender_name ?? ''}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Type of financing :</label><span class="text-capitalize">
                                            {{$offer->first_type_of_financing ?? ''}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Additional terms :</label><span class="text-capitalize">
                                            {{$offer->first_additional_terms ?? ''}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <h6>Purchase Loan 2nd</h6>
                                <div class="form-group row col-md-12">
                                    <div class="col-lg-4">
                                        <label class="">Mortgage loan amount : </label><span class="text-capitalize">{{$currency.number_format($offer->second_mortgage_loan_amount) ?? ''}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Loan interest rate :</label><span class="text-capitalize">
                                            {{$offer->second_loan_interest_rate.'%' ?? ''}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Mortage loan points :</label><span class="text-capitalize">
                                            {{$offer->second_mortage_loan_points ?? ''}}</span>
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <div class="col-lg-4">
                                        <label class="">Direct lender name : </label><span class="text-capitalize">{{$offer->second_direct_lender_name ?? ''}}</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Type of financing : </label><span class="text-capitalize">{{$offer->second_type_of_financing ?? ''}} </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Additional terms :</label><span class="text-capitalize">{{$offer->second_additional_terms ?? ''}} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Combined Loan to Value (CLTV) : </label><span class="text-capitalize">{{$offer->combined_loan_value ?? ''}}&nbsp;%</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget2_tab4_content">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Loan contingency Removal : </label><span class="text-capitalize">{{$offer->loan_contingency.' days' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Appraisal contingency :</label><span class="text-capitalize">
                                        {{$offer->appraisal_contingency.' days' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Investigation of property :</label><span class="text-capitalize">{{$offer->investigation_property.' days' ?? ''}} </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Right to access the property : </label><span class="text-capitalize">{{$offer->property_access.' days' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Review of seller's documents : </label><span class="text-capitalize">{{$offer->review_documents.' days' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Preliminary "Title" report :</label><span class="text-capitalize">{{$offer->preliminary_report.' days' ?? ''}} </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Review of leased or liened items :</label><span class="text-capitalize">{{$offer->review_of_leased.' days' ?? ''}} </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Common interest disclosures : </label><span class="text-capitalize">{{$offer->common_interest_disclosures.' days' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Sale of buyer's property :</label><span class="text-capitalize">
                                        {{$offer->sale_buyer_property.' days' ?? ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Seller delivery of documents :</label><span class="text-capitalize">
                                        {{$offer->seller_delivery_document.' days' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Sign & return escrow holder provisions and instructions :</label><span class="text-capitalize">{{$offer->provisions_instructions.' days' ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Install smoke alarm(s), CO detector(s), water heater bracing : </label><span class="text-capitalize">{{$offer->smoke_alarm
                                        .' days' ?? ''}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="">Evidence of representative authority :</label><span class="text-capitalize">{{$offer->evidence_authority.' days' ?? ''}} </span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Time to pay for ordering HOA documents :</label><span class="text-capitalize">{{$offer->hoa_documents.' days' ?? ''}} </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget2_tab5_content">
                            {{-- <div class="kt-portlet__head" bis_skin_checked="1"> --}}
                            <div class="">
                                <div class="kt-portlet__head-label" bis_skin_checked="1">
                                    <h5 class="kt-portlet__head-title">
                                        Verification of All Cash
                                    </h5>
                                    <div class="row col-md-12">
                                        <div class="col-lg-4">
                                            <label class="">Verified amount :</label><span class="text-capitalize">{{$offer->cash_verified_amount ?? ''}} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Uploaded Documents:</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($cashFiles as $file)
                                            <div class="mr-3">
                                                <a href="{{ $file->image }}" target="__blank">
                                                    @php
                                                    if(in_array(pathinfo($file->name, PATHINFO_EXTENSION),['doc','docx','pdf'])){
                                                        $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                                        switch($extension){
                                                        case 'pdf': $img=asset('images/pdf.png');break;
                                                        case 'doc': $img=asset('images/doc.png');break;
                                                        case 'docx': $img=asset('images/doc.png');break;
                                                        }
                                                    }
                                                    else{
                                                        $img=$file->image;
                                                    }
                                                    @endphp
                                                    <img src="{{ $img }}" alt="{{ $file->name }}" class="" width="200">
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="kt-portlet__head-label" bis_skin_checked="1">
                                    <h5 class="kt-portlet__head-title">
                                        Verification of Down Payment and Closing Costs
                                    </h5>
                                    <div class="row col-md-12">
                                        <div class="col-lg-4">
                                            <label class="">Verified amount :</label><span class="text-capitalize">{{$offer->downpayment_verified_amount ?? ''}} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Uploaded Documents:</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($downnpaymentFiles as $file)
                                            <div class="mr-3">
                                                @php
                                                    if(in_array(pathinfo($file->name, PATHINFO_EXTENSION),['doc','docx','pdf'])){
                                                        $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                                        switch($extension){
                                                        case 'pdf': $img=asset('images/pdf.png');break;
                                                        case 'doc': $img=asset('images/doc.png');break;
                                                        case 'docx': $img=asset('images/doc.png');break;
                                                        }
                                                    }
                                                    else{
                                                        $img=$file->image;
                                                    }
                                                    @endphp
                                                <a href="{{ $file->image }}" target="__blank"><img src="{{ $img }}" alt="{{ $file->name }}" class="" width="200"></a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="kt-portlet__head-label" bis_skin_checked="1">
                                    <h5 class="kt-portlet__head-title mb-3">
                                        Verification of Loan Application and preapproval
                                    </h5>
                                    <div class="row col-md-12">
                                        <div class="col-lg-4 mb-3">
                                            <label class="">Status :</label><span class="text-capitalize">{{ config()->get('constants.status.'.$offer->loan_application_status) ?? ''}} </span>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="">Amount :</label><span class="text-capitalize">{{ $currency.number_format($offer->first_mortgage_loan_amount).'-'.$currency.number_format($offer->second_mortgage_loan_amount) ?? ''}} </span>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="">Interest Rate :</label><span class="text-capitalize">{{ isset($offer->first_loan_interest_rate)?($offer->first_loan_interest_rate . '% -' . $offer->second_loan_interest_rate . '%'):''}} </span>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label class="">Direct Lender :</label><span class="text-capitalize">{{isset($offer->first_direct_lender_name) ? $offer->first_direct_lender_name . ' - ' . $offer->second_direct_lender_name : ''}} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Uploaded Documents:</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($loanApplicationFiles as $file)
                                            <div class="mr-3">
                                                @php
                                                    if(in_array(pathinfo($file->name, PATHINFO_EXTENSION),['doc','docx','pdf'])){
                                                        $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                                        switch($extension){
                                                        case 'pdf': $img=asset('images/pdf.png');break;
                                                        case 'doc': $img=asset('images/doc.png');break;
                                                        case 'docx': $img=asset('images/doc.png');break;
                                                        }
                                                    }
                                                    else{
                                                        $img=$file->image;
                                                    }
                                                    @endphp
                                                <a href="{{ $file->image }}" target="__blank"><img src="{{ $img }}" alt="{{ $file->name }}" class="" width="200"></a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <div class="kt-portlet__head-label" bis_skin_checked="1">
                                    <h5 class="kt-portlet__head-title">
                                        Other Document(s)
                                    </h5>
                                    <div class="row col-md-12">
                                        <div class="col-lg-4">
                                            <label class="">Document Type :</label><span class="text-capitalize">{{$offer->other_documents ?? ''}} </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Uploaded Documents:</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($otherFiles as $file)
                                            <div class="mr-3">
                                                @php
                                                    if(in_array(pathinfo($file->name, PATHINFO_EXTENSION),['doc','docx','pdf'])){
                                                        $extension = pathinfo($file->name, PATHINFO_EXTENSION);
                                                        switch($extension){
                                                        case 'pdf': $img=asset('images/pdf.png');break;
                                                        case 'doc': $img=asset('images/doc.png');break;
                                                        case 'docx': $img=asset('images/doc.png');break;
                                                        }
                                                    }
                                                    else{
                                                        $img=$file->image;
                                                    }
                                                    @endphp
                                                <a href="{{ $file->image }}" target="__blank"><img src="{{ $img }}" alt="{{ $file->name }}" class="" width="200"></a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!---update doc status--->
                            <div class="border-top mt-5 pt-4">
                                <div class="kt-portlet__head-label" bis_skin_checked="1">
                                    <h5 class="kt-portlet__head-title">
                                        Status
                                    </h5>
                                    <form class="kt-form kt-form--label-right form-valide" action="{{ route('update-document-status', ['id' => $offer->offer_id]) }}" method="post" enctype="multipart/form-data" id="property_form">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{ $offer->offer_id }}">
                                        <div class="kt-section__content kt-section__content--solid">
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    @php
                                                    $statuses = config()->get('constants.doc_status');
                                                    @endphp
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="">Change status</option>
                                                        @foreach($statuses as $key => $status)
                                                        <option value="{{$key}}" {{ ($offer->doc_status == $key ? "selected":"") }}>{{ $status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__foot">
                                                <div class="kt-form__actions">
                                                    <div class="row">
                                                        <div class="col-lg-4"></div>
                                                        <div class="col-lg-8">
                                                            <button type="Submit" class="btn btn-primary">Update</button>
                                                            <a href="{{route('buyer')}}" class="btn btn-secondary">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget2_tab6_content">
                            <div class="form-group row">
                                @foreach (Config::get('constants.items') as $key => $value)
                                @if(isset($offer->{$key}))
                                <div class="col-lg-12">
                                    <label class="col-md-6">{{ $value }} : </label>
                                    <span class="col-md-6 text-capitalize">{{ $offer->{$key} }} </span>
                                </div>
                                @endif
                                @endforeach
                                {{-- <div class="col-lg-12">
                                    <label class="col-md-6">Additional Items </label>
                                    <span class="col-md-6 text-capitalize">{{ $offer->additional_items ?? '-'}} </span>
                                </div>
                                <div class="col-lg-12">
                                    <label class="col-md-6">Excluded Items </label>
                                    <span class="col-md-6 text-capitalize">{{ $offer->excluded_items ?? '-'}} </span>
                                </div> --}}
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget2_tab7_content">
                            <div class="form-group row">
                                <div class="col-lg-4 mb-3">
                                    <label class=""> Natural Hazards Zone Disclosure :</label><span class="text-capitalize">{{ $offer->natural_hazard_zone ? ($offer->natural_hazard_zone=='50'?'50-50':$offer->natural_hazard_zone) : ''}} </span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="">Include Enviromental :</label><span class="text-capitalize"> {{$offer->environmental ??
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="">Provided By :</label><span class="text-capitalize"> {{$offer->provided_by ??
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="">Other :</label><span class="text-capitalize"> {{$offer->other ??
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="">Report Name : </label><span class="text-capitalize"> {{$offer->report_name ??
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="">Paid By : </label><span class="text-capitalize"> {{$offer->paid_by ? ($offer->paid_by=='50'?'50-50':$offer->paid_by) :
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Smoke Alarm, CO detectors, Water heater bracing : </label><span class="text-capitalize"> {{$offer->smoke_alarms ? ($offer->smoke_alarms=='50'?'50-50':$offer->smoke_alarms) :
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Government required point of sale inspections, reports : </label><span class="text-capitalize"> {{$offer->gov_reports ? ($offer->gov_reports=='50'?'50-50':$offer->paid_by) :
                                            ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Government required point of sale corrective, remedial actions : </label><span class="text-capitalize"> {{$offer->gov_required_point ? ($offer->gov_required_point=='50'?'50-50':$offer->gov_required_point) :
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Escrow fees : </label><span class="text-capitalize"> {{$offer->escrow_fees ? ($offer->escrow_fees=='50'?'50-50':$offer->escrow_fees) :
                                            ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Escrow Holder : </label><span class="text-capitalize"> {{$offer->escrow_holder ??
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Owner's title insurance policy : </label><span class="text-capitalize"> {{$offer->insurance_policy ? ($offer->insurance_policy=='50'?'50-50':$offer->insurance_policy) :
                                            ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Title Company : </label><span class="text-capitalize"> {{$offer->title_company ??
                                            ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Buyer's Lender title insurance policy : </label><span class="text-capitalize"> {{$offer->buyer_lender_policy ? ($offer->buyer_lender_policy=='50'?'50-50':$offer->buyer_lender_policy) :
                                            ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Country transfer tax, fees : </label><span class="text-capitalize"> {{$offer->country_transfer_tax ? ($offer->country_transfer_tax=='50'?'50-50':$offer->country_transfer_tax) :
                                            ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">City transfer tax, fees : </label><span class="text-capitalize"> {{$offer->city_transfer_tax ? ($offer->city_transfer_tax=='50'?'50-50':$offer->city_transfer_tax) :
                                            ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                        <label class="">Home warranty plan : </label><span class="text-capitalize"> {{$offer->warranty_plan ? ($offer->warranty_plan=='50'?'50-50':$offer->warranty_plan) :
                                            ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="">Issued by : </label><span class="text-capitalize"> {{$offer->issued_by ??
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="">Cost not to exceed : </label><span class="text-capitalize"> {{$offer->cost_not_exceed ? ($offer->cost_not_exceed=='50'?'50-50':$offer->cost_not_exceed) :
                                        ''}}</span>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label class="">Other terms : </label><span class="text-capitalize"> {{$offer->other_terms ??
                                        ''}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="kt_widget2_tab8_content">
                            <div class="form-group row">
                                @if(isset($financial))
                                <div class="col-lg-4 mb-3">
                                    <label class="">Document : </label>
                                    @php
                                    $file='';
                                    switch(pathinfo($financial->file, PATHINFO_EXTENSION)){
                                    case 'pdf': $file=asset('images/pdf.png');break;
                                    case 'doc': $file=asset('images/doc.png');break;
                                    case 'docx': $file=asset('images/doc.png');break;
                                    }
                                    @endphp

                                    <div class="d-flex flex-wrap">
                                        <span class=""><a href="{{asset($financial->file)}}" target="__blank"><img src="{{$file}}"/></a></span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!---update doc status--->
                            @if(isset($financial->id))
                            <div class="border-top mt-5 pt-4">
                                <div class="kt-portlet__head-label" bis_skin_checked="1">
                                    <h5 class="kt-portlet__head-title">
                                        Status
                                    </h5>
                                    <form class="kt-form kt-form--label-right" action="{{ route('update-fc-status', ['id' => $offer->offer_id]) }}" method="post" enctype="multipart/form-data" id="property1_form">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{ $offer->offer_id }}">
                                        <div class="kt-section__content kt-section__content--solid">
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    @php
                                                    $statuses = config()->get('constants.doc_status');
                                                    @endphp
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="">Change status</option>
                                                        @foreach($statuses as $key => $status)
                                                        <option value="{{$key}}" {{ ($financial->status == $key ? "selected":"") }}>{{ $status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__foot">
                                                <div class="kt-form__actions">
                                                    <div class="row">
                                                        <div class="col-lg-4"></div>
                                                        <div class="col-lg-8">
                                                            <button type="Submit" class="btn btn-primary">Update</button>
                                                            <a href="{{route('buyer')}}" class="btn btn-secondary">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                                <h6>No document uploaded</h6>
                            @endif
                        </div>
                        <div class="tab-pane" id="kt_widget2_tab9_content">
                            <div class="form-group row">
                                @if(!empty($offer->price_improved_on))
                                <div class="col-lg-4 mb-3">
                                    <label class="">Offer increased : </label><span class="text-capitalize">{{ \Carbon\Carbon::parse($offer->price_improved_on)->format('Y-m-d H:i:s') }} </span>
                                </div>
                                @endif
                                @if($offer->status=='CL')
                                <div class="col-lg-4 mb-3">
                                    <label class="">Offer Withdrawn : </label><span class="text-capitalize">{{ \Carbon\Carbon::parse($offer->cancelled_at)->format('Y-m-d H:i:s') }} </span>
                                </div>
                                @endif
                                @if($offer->price_improved!=0)
                                <div class="col-lg-4 mb-3">
                                    <label class="">Offer Withdrawn : </label><span class="text-capitalize">{{ ' From '. Helper::getBladeSetting('currency') . number_format(($offer->offer_price - $offer->improved_price)).' To '. Helper::getBladeSetting('currency').number_format($offer->offer_price)}} </span>
                                </div>
                                @endif
                                @if(isset($financial->id))
                                <div class="col-lg-4 mb-3">
                                    <label class="">Financial Credential Document Improved : </label>
                                    @php
                                    $file='';
                                    switch(pathinfo($financial->file, PATHINFO_EXTENSION)){
                                    case 'pdf': $file=asset('images/pdf.png');break;
                                    case 'doc': $file=asset('images/doc.png');break;
                                    case 'docx': $file=asset('images/doc.png');break;
                                    }
                                    @endphp

                                    <div class="d-flex flex-wrap">
                                        <span class=""><a href="{{asset($financial->file)}}" target="__blank"><img src="{{$file}}"/></a></span>
                                    </div>
                                </div>
                                @else
                                <h6>No document uploaded</h6>
                                @endif
                            </div>
                        </div>
                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
