@extends('layouts.app')
@section('title', $title)
@section('content')
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }
    div.dt-buttons{
        float: none !important;
    }
</style>
    <link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<x-breadcrumb title="{{$title}}" module="Properties" link="{{route('properties')}}"></x-breadcrumb>
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
                                        <h4>{{('Bids/Offer')}}</h4>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <div class="kt-portlet__body">
                                    <div class="row ml-auto">
                                        <form>
                                            <div class="form-group">
                                                <label>Sort By</label>
                                                <select name="sortby" class="form-control" onchange="this.form.submit()">
                                                    <option value="date_submitted_new" @if(!empty(request()->get('sortby')) && request()->get('sortby')=='date_submitted') selected @endif>Newest to Oldest Offers</option>
                                                    <option value="date_submitted_old" @if(!empty(request()->get('sortby')) && request()->get('sortby')=='date_submitted') selected @endif>Oldest to Newest Offers</option>
                                                    <option value="offer_price_low" @if(!empty(request()->get('sortby')) && request()->get('sortby')=='offer_price') selected @endif>Lowest to Highest Offer Price</option>
                                                    <option value="offer_price_high" @if(!empty(request()->get('sortby')) && request()->get('sortby')=='offer_price') selected @endif>Highest to Lowest Offer Price</option>
                                                    <option value="net_price" @if(!empty(request()->get('sortby')) && request()->get('sortby')=='net_price') selected @endif>Highest to lowest Net Price</option>
                                                    <option value="escrow_close" @if(!empty(request()->get('sortby')) && request()->get('sortby')=='escrow_close') selected @endif>Shortest Close of Escrow</option>
                                                    <option value="low_cltv" @if(!empty(request()->get('sortby')) && request()->get('sortby')=='low_cltv') selected @endif>Lowest CLTV</option>
                                                </select>
                                                <a href="javascript:;" onclick="window.location='{{URL::current()}}'" class="float-right @if(empty(request()->get('sortby'))) d-none @endif">Reset</a>
                                            </div>
                                        </form>
                                    </div>

                                    @if($offers)
                                        @php
                                        $offer1 ='';
                                        $offer_date = ''; $buyer_name = ''; $legal_entity = ''; $represented_by = ''; $buyer_brokerage_firm = ''; $buyer_brokerge_license = ''; $buyer_agent = ''; $buyer_agent_license = ''; $buyer_agent_phone = ''; $commission_percent = ''; $commission = ''; $offer_price = ''; $seller_credit_any = ''; $seller_credit = ''; $seller_credit_amount = ''; $net_price = ''; $days_of_escrow = ''; $expiration_offer = ''; $occupancy = ''; $possession = ''; $final_verification = ''; $assignment_request = ''; $estimated_closing_costs = ''; $initial_deposit_amount = ''; $within_days = ''; $deposit_increase = ''; $days_to_increase = ''; $loan_amount1 = ''; $interest_rate1 = ''; $mortage_loan_points1 = ''; $direct_lender_name1 = ''; $type_of_financing1 = ''; $additional_terms1 = ''; $loan_amount2 = ''; $interest_rate2 = ''; $mortage_loan_points2 = ''; $direct_lender_name2 = ''; $type_of_financing2 = ''; $additional_terms2 = ''; $balance_down_payment = ''; $combined_loan_value = ''; $loan_contingency = ''; $appraisal_contingency = ''; $investigation_property = ''; $property_access = ''; $review_documents = ''; $preliminary_report = ''; $review_of_leased = ''; $common_interest_disclosures = ''; $sale_buyer_property = ''; $seller_delivery_document = ''; $provisions_instructions = ''; $smoke_alarm = ''; $evidence_authority = ''; $hoa_doc_fee = ''; $cash_verified_amount = ''; $cash_verified_image = ''; $downpayment_verified_image = ''; $downpayment_verified_amount = ''; $loan_application_status = ''; $loan_application_amount = '';$loan_interest_rate = ''; $direct_lender_name = ''; $loan_application_image = ''; $other_documents = ''; $other_doc_image = ''; $natural_hazard_zone = ''; $environmental = ''; $provided_by = ''; $other = ''; $report_name = ''; $paid_by = ''; $smoke_alarms = ''; $sale_inspection = ''; $sale_corrective = ''; $escrow_fees = ''; $escrow_holder = ''; $insurance_policy = ''; $title_company = ''; $buyer_lender_policy = ''; $country_transfer_tax = ''; $city_transfer_tax = ''; $warranty_plan = ''; $issued_by = ''; $cost_not_exceed = ''; $other_terms = ''; $hoa_fee = ''; $certification_fee = ''; $transfer_fee = ''; $private_fee = ''; $other_fee = ''; $other_terms = ''; $buyer_advisory = '';

                                        foreach ($offers as $row) {
                                            $offer1 .= "<th><a href='".route('offer-details', ['id'=> $row->offer_id])."'>" .'Offer '.$row->offer_id . " </a></th>";
                                            $offer_date .= "<td>" . $row->date_offers . "</td>";
                                            $buyer_name .= "<td>" . $row->buyer_name . "</td>";
                                            $legal_entity .= "<td>" . $row->legal_entity. "</td>";
                                            $represented_by .= "<td>" . $row->represented_by. "</td>";
                                            $buyer_brokerage_firm .= "<td>" . $row->buyer_brokerage_firm. "</td>";
                                            $buyer_brokerge_license .= "<td>" . $row->buyer_brokerge_license. "</td>";
                                            $buyer_agent .= "<td>" . $row->buyer_agent. "</td>";
                                            $buyer_agent_license .= "<td>" . $row->buyer_agent_license. "</td>";
                                            $buyer_agent_phone .= "<td>" . $row->buyer_agent_phone. "</td>";
                                            $commission_percent .= "<td>" . $row->buyer_agent_commission_percentage. "</td>";
                                            $commission .= "<td>" . $row->buyer_agent_commission. "</td>";
                                            $offer_price .= "<td>" . number_format($row->offer_price). "</td>";
                                            $seller_credit_any .= "<td>" . $row->seller_credit_buyer. "</td>";
                                            $seller_credit .= "<td>" . $row->seller_credit. "</td>";
                                            $seller_credit_amount .= "<td>" . $row->seller_credit_amount. "</td>";
                                            $net_price .= "<td>" . number_format($row->net_price). "</td>";
                                            $days_of_escrow .= "<td>" . $row->days_of_escrow. "</td>";
                                            $expiration_offer .= "<td>" . $row->expiration_offer. "</td>";
                                            $occupancy .= "<td>" . $row->occupancy. "</td>";
                                            $possession .= "<td>" . $row->possession. "</td>";
                                            $final_verification .= "<td>" . $row->final_verification. "</td>";
                                            $assignment_request .= "<td>" . $row->assignment_request. "</td>";
                                            $estimated_closing_costs .= "<td>" . $row->estimated_closing_costs. "</td>";
                                            $initial_deposit_amount .= "<td>" . $row->initial_deposit_amount. "</td>";
                                            $within_days .= "<td>" . $row->within_days. "</td>";
                                            $deposit_increase .= "<td>" . $row->deposit_increase. "</td>";
                                            $days_to_increase .= "<td>" . $row->days_to_increase. "</td>";

                                            $loan_amount1 .= "<td>" . number_format($row->first_mortgage_loan_amount). "</td>";
                                            $interest_rate1 .= "<td>" . $row->first_loan_interest_rate. "</td>";
                                            $mortage_loan_points1 .= "<td>" . $row->first_mortage_loan_points. "</td>";
                                            $direct_lender_name1 .= "<td>" . $row->first_direct_lender_name. "</td>";
                                            $type_of_financing1 .= "<td>" . $row->first_type_of_financing. "</td>";
                                            $additional_terms1 .= "<td>" . $row->first_additional_terms. "</td>";

                                            $loan_amount2 .= "<td>" . number_format($row->second_mortgage_loan_amount). "</td>";
                                            $interest_rate2 .= "<td>" . $row->second_loan_interest_rate. "</td>";
                                            $mortage_loan_points2 .= "<td>" . $row->second_mortage_loan_points. "</td>";
                                            $direct_lender_name2 .= "<td>" . $row->second_direct_lender_name. "</td>";
                                            $type_of_financing2 .= "<td>" . $row->second_type_of_financing. "</td>";
                                            $additional_terms2 .= "<td>" . $row->second_additional_terms. "</td>";

                                            $balance_down_payment   .= "<td>" . number_format($row->balance_down_payment). "</td>";
                                            $combined_loan_value .= "<td>" . $row->combined_loan_value. "</td>";

                                            $loan_contingency .= "<td>" . $row->loan_contingency. "</td>";
                                            $appraisal_contingency .= "<td>" . $row->appraisal_contingency. "</td>";
                                            $investigation_property .= "<td>" . $row->investigation_property. "</td>";
                                            $property_access   .= "<td>" . $row->property_access. "</td>";
                                            $review_documents .= "<td>" . $row->review_documents. "</td>";
                                            $preliminary_report .= "<td>" . $row->preliminary_report. "</td>";
                                            $review_of_leased .= "<td>" . $row->review_of_leased. "</td>";
                                            $common_interest_disclosures .= "<td>" . $row->common_interest_disclosures. "</td>";
                                            $sale_buyer_property .= "<td>" . $row->sale_buyer_property. "</td>";
                                            $seller_delivery_document .= "<td>" . $row->seller_delivery_document. "</td>";
                                            $provisions_instructions .= "<td>" . $row->provisions_instructions. "</td>";
                                            $smoke_alarm .= "<td>" . $row->smoke_alarm. "</td>";
                                            $evidence_authority .= "<td>" . $row->evidence_authority. "</td>";
                                            $hoa_doc_fee .= "<td>" . $row->hoa_documents. "</td>";

                                            $cash_verified_amount .= "<td>" . number_format($row->cash_verified_amount). "</td>";
                                            $cash_verified_image .= "<td> Uploaded<br>";

                                            $offer = \App\Models\Offers::find($row->offer_id);
                                            if (isset($offer->document->cashVerifiedFiles)) {
                                                foreach($offer->document->cashVerifiedFiles as $key=>$file){
                                                $cash_verified_image.="<a href='".$file->image."' target='_blank'>View Image ".($key+1)."</a><br>";
                                            }
                                            $cash_verified_image.="</td>";
                                            }

                                            if (isset($offer->document->downpaymentFiles)) {
                                            $downpayment_verified_image .= "<td> Uploaded<br>";

                                            foreach($offer->document->downpaymentFiles as $key=>$file){
                                                $downpayment_verified_image.="<a href='".$file->image."' target='_blank'>View Image ".($key+1)."</a><br>";
                                            }
                                            $downpayment_verified_image.="</td>";
                                            }
                                            $downpayment_verified_amount .= "<td>" . number_format($row->downpayment_verified_amount). "</td>";
                                            $loan_application_status .= "<td>" . $row->loan_application_status. "</td>";
                                            $loan_application_amount  .= "<td>" . number_format($row->loan_application_amount). "</td>";
                                            $loan_interest_rate .= "<td>" . $row->loan_interest_rate. "</td>";
                                            $direct_lender_name .= "<td>" . $row->direct_lender_name. "</td>";
                                            if (isset($offer->document->loanApplicationFiles)) {
                                            $loan_application_image .= "<td> Uploaded<br>";

                                            foreach($offer->document->loanApplicationFiles as $key=>$file){
                                                $loan_application_image.="<a href='".$file->image."' target='_blank'>View Image ".($key+1)."</a><br>";
                                            }
                                            $loan_application_image.="</td>";
                                            }
                                            $other_documents .= "<td>" . $row->other_documents. "</td>";
                                            if (isset($offer->document->otherFiles)) {
                                            $other_doc_image .= "<td> Uploaded <br>";

                                            foreach($offer->document->otherFiles as $key=>$file){
                                                $other_doc_image.="<a href='".$file->image."' target='_blank'>View Image ".($key+1)."</a><br>";
                                            }
                                            $other_doc_image.="</td>";
                                            }
                                            $natural_hazard_zone .= "<td>" . $row->natural_hazard_zone. "</td>";
                                            $environmental .= "<td>" . $row->environmental. "</td>";
                                            $provided_by .= "<td>" . $row->provided_by. "</td>";
                                            $other .= "<td>" . $row->other. "</td>";
                                            $report_name .= "<td>" . $row->other. "</td>";
                                            $paid_by .= "<td>" . $row->paid_by. "</td>";
                                            $smoke_alarms .= "<td>" . $row->smoke_alarms. "</td>";
                                            $sale_inspection .= "<td>" . $row->gov_reports. "</td>";
                                            $sale_corrective .= "<td>" . $row->gov_required_point. "</td>";
                                            $escrow_fees .= "<td>" . $row->escrow_fees. "</td>";
                                            $escrow_holder .= "<td>" . $row->escrow_holder. "</td>";
                                            $insurance_policy .= "<td>" . $row->insurance_policy. "</td>";
                                            $title_company .= "<td>" . $row->title_company. "</td>";
                                            $buyer_lender_policy .= "<td>" . $row->buyer_lender_policy. "</td>";
                                            $country_transfer_tax .= "<td>" . $row->country_transfer_tax. "</td>";
                                            $city_transfer_tax .= "<td>" . $row->city_transfer_tax. "</td>";
                                            $warranty_plan .= "<td>" . $row->warranty_plan. "</td>";
                                            $issued_by .= "<td>" . $row->issued_by. "</td>";
                                            $cost_not_exceed .= "<td>" . $row->cost_not_exceed. "</td>";
                                            $other_terms .= "<td>" . $row->other_terms ?? ''. "</td>";
                                            $hoa_fee .= "<td>" . $row->disclosure_hoa_fee ?? ''. "</td>";
                                            $certification_fee .= "<td>" . $row->hoa_certification_fee ?? ''. "</td>";
                                            $transfer_fee .= "<td>" . $row->hoa_transfer_fee ?? ''. "</td>";
                                            $private_fee .= "<td>" . $row->private_transfer_fee ?? ''. "</td>";
                                            $other_fee .= "<td>" . $row->other_fee ?? ''. "</td>";
                                            // $other_terms .= "<td>" . $row->other_terms ?? ''. "</td>";
                                            $buyer_advisory .= "<td> No </td>";

                                        }
                                        @endphp
                                        <div class="table-responsive">
                                            <table id="table_id1" class=" mt-3 kt-kt-datatable__table table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        {!! $offer1 !!}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Offered price</td>
                                                        {!! $offer_price !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Net price after commission & credits</td>
                                                        {!! $net_price !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Days to close of escrow</td>
                                                        {!! $days_of_escrow !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Combined loan to value (CLV)</td>
                                                        {!! $combined_loan_value !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Loan contingency removal</td>
                                                        {!! $loan_contingency !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Appraisal contingency</td>
                                                        {!! $appraisal_contingency !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Investigation of property</td>
                                                        {!! $investigation_property !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Right to access the property</td>
                                                        {!! $property_access   !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Review of seller's documents</td>
                                                        {!! $review_documents !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Preliminary (Title) report</td>
                                                        {!! $preliminary_report !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Review of leased or liened items</td>
                                                        {!! $review_of_leased !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Common interest disclosures</td>
                                                        {!! $common_interest_disclosures !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Sale of buyer's property</td>
                                                        {!! $sale_buyer_property !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Seller delivery of documents</td>
                                                        {!! $seller_delivery_document !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Sign and return escrow holder provisions and instruction</td>
                                                        {!! $provisions_instructions !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Install smoke alarm(s), CO detector(s), water heater</td>
                                                        {!! $smoke_alarm !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Evidence of representative authority</td>
                                                        {!! $evidence_authority !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Time to pay fees for ordering Hoa documents</td>
                                                        {!! $hoa_doc_fee !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Date offer submitted</td>
                                                        {!! $offer_date !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Buyer(s)</td>
                                                        {!! $buyer_name !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Legal entity</td>
                                                        {!! $legal_entity !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Represented by Buyers agent</td>
                                                        {!! $represented_by !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Buyer's brokage firm</td>
                                                        {!! $buyer_brokerage_firm !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Buyer's brokerage lincence</td>
                                                        {!! $buyer_brokerge_license !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Buyer's agent</td>
                                                        {!! $buyer_agent !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Buyer's agent lincence</td>
                                                        {!! $buyer_agent_license !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Buyer's agent cell phone</td>
                                                        {!! $buyer_agent_phone !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Seller's paid buyer's agent commision %</td>
                                                        {!! $commission_percent !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Seller's paid buyer's agent commision $</td>
                                                        {!! $commission !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Seller credit repersent</td>
                                                        {!! $seller_credit_any !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Seller's credit, if any, to buyer</td>
                                                        {!! $seller_credit !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Seller's credit amount, if any, to buyer</td>
                                                        {!! $seller_credit_amount !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Expiration of offer</td>
                                                        {!! $expiration_offer !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Occupancy</td>
                                                        {!! $occupancy !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Possession</td>
                                                        {!! $possession !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Final verification of condition</td>
                                                        {!! $final_verification !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Assignment request</td>
                                                        {!! $assignment_request !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated closing costs</td>
                                                        {!! $estimated_closing_costs !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Initial deposit amount</td>
                                                        {!! $initial_deposit_amount !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Within days</td>
                                                        {!! $within_days !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Deposit increase</td>
                                                        {!! $deposit_increase !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Days to deposit increase</td>
                                                        {!! $days_to_increase !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Balance of downpayment</td>
                                                        {!! $loan_amount1 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>1st mortgage loan amount</td>
                                                        {!! $interest_rate1 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Mortgage loan interest rate</td>
                                                        {!! $mortage_loan_points1 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Mortage loan points</td>
                                                        {!! $direct_lender_name1 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Direct lender's name</td>
                                                        {!! $type_of_financing1 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Type of financing</td>
                                                        {!! $additional_terms1 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Additional finanicing terms</td>
                                                        {!! $loan_amount2 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>2nd mortgage loan amount</td>
                                                        {!! $interest_rate2 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Mortgage loan interest rate</td>
                                                        {!! $mortage_loan_points2 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Mortage loan points</td>
                                                        {!! $direct_lender_name2 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Direct lender's name</td>
                                                        {!! $type_of_financing2 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Type of financing</td>
                                                        {!! $additional_terms2 !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Additional finanicing terms</td>
                                                        {!! $balance_down_payment   !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Verification of All Cash (sufficient funds)</td>
                                                        {!! $cash_verified_amount !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Upload verification of all cash offer</td>
                                                        {!! $cash_verified_image !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Verification of down payment and closing costs</td>
                                                        {!! $downpayment_verified_amount !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Upload verification of down payment</td>
                                                        {!! $downpayment_verified_image !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Verification of loan application and preapproval</td>
                                                        {!! $loan_application_status !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Loan application amount</td>
                                                        {!! $loan_application_amount !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Loan application interest rate</td>
                                                        {!! $loan_interest_rate !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Direct lender's name</td>
                                                        {!! $direct_lender_name !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Upload verification of loan payment</td>
                                                        {!! $loan_application_image !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Upload other document(s) describe</td>
                                                        {!! $other_documents !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Upload other documents</td>
                                                        {!! $other_doc_image !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Natural Hazard Zone Disclosure Report, including tax information</td>
                                                        {!! $natural_hazard_zone !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Includes environmental</td>
                                                        {!! $environmental !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Provided by</td>
                                                        {!! $provided_by !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        {!! $other !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Other report(s) - Enter report Name</td>
                                                        {!! $report_name !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Other report(s) - Paid by</td>
                                                        {!! $paid_by !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Smoke alarms, CO detectors, water heater bracing</td>
                                                        {!! $smoke_alarms !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Government Required Point of Sale inspections, reports</td>
                                                        {!! $sale_inspection !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Government Required Point of Sale corrective/remedial actions</td>
                                                        {!! $sale_corrective !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Escrow fees</td>
                                                        {!! $escrow_fees !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Escrow holder</td>
                                                        {!! $escrow_holder !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Owner's title insurance policy</td>
                                                        {!! $insurance_policy !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Title Company (if different from Escrow Holder)</td>
                                                        {!! $title_company !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Buyer's Lender Title insurance policy</td>
                                                        {!! $buyer_lender_policy !!}
                                                    </tr>
                                                    <tr>
                                                        <td>County transfer tax, fees</td>
                                                        {!! $country_transfer_tax !!}
                                                    </tr>
                                                    <tr>
                                                        <td>City transfer tax, fees</td>
                                                        {!! $city_transfer_tax !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Home warranty plan</td>
                                                        {!! $warranty_plan !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Issued by</td>
                                                        {!! $issued_by !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Cost not to exceed</td>
                                                        {!! $cost_not_exceed !!}
                                                    </tr>
                                                    <tr>
                                                        <td>HOA fee for preparing disclosures                                                    </td>
                                                        {!! $hoa_fee !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Hoa certification fee</td>
                                                        {!! $certification_fee !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Hoa transfer fee</td>
                                                        {!! $transfer_fee !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Private transfer fee</td>
                                                        {!! $private_fee !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Other fee</td>
                                                        {!! $other_fee !!}
                                                    </tr>
                                                    <tr>
                                                        <td>Other terms</td>
                                                        {!! $other_terms !!}
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <span>No offers received</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{URL::asset('vendors/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script>
    $(document).ready( function () {
        $('#table_id1').DataTable({
            dom:'Bfrtip',
            buttons:['excel','csv'],
            "searching":false,
            "ordering":false,
            paging: false,
            "bInfo":false
        });
    } );
</script>
@endsection