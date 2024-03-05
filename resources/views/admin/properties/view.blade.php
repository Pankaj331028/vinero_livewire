@extends('layouts.app')
@section('title', $title)
@section('content')
<style>
  label.error {
    color: #dc3545;
    font-size: 14px;
  }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<x-breadcrumb title="{{$title}}" module="Properties" link="{{route('properties')}}"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
  <div class="row">
    <div class="col-xl-12">
    <div class="kt-portlet kt-portlet--height-fluid">
      <div class="kt-portlet__body">
          <div class="kt-widget kt-widget--user-profile-3 border-bottom pb-2">
              <div class="kt-widget__top">
                  <div class="kt-widget__media w-100">
                      <h5 class="text-uppercase font-weight-bold">{{ $property->vms_property_id }}</h5>
                  </div>
                  <div class="kt-widget__content">
                      <div class="kt-widget__head justify-content-end">
                        @if (preg_match('/view-buyer/i', Session::get('previous_url')) == 1)
                        @else
                          <div class="kt-widget__action">
                            <i class="flaticon-calendar-1 mr-2"></i><span>{{ \Carbon\Carbon::parse($property->created_at)->format('d M, Y') }}</span>
                            <span class="btn btn-sm btn-upper btn-{{ config('constants.property_status_link.'.$property->status) }} btn-sm btn-upper">{{ config('constants.property_status.'.$property->status) }}</span>&nbsp;
                        </div>
                        @endif
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="kt-portlet">
              <!--begin::Form-->
              <div class="kt-portlet__body">
                <div class="form-group row">

                  <div class="col-lg-3">
                    <label class="">Property address :</label><span class="text-sucees"> {{$property->property_address
                      ?? '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Owner name :</label><span class="text-sucees"> {{$property->owner_name ??
                      '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Owner Phone Number :</label><span class="text-sucees"> {{$property->seller->phone_no ??
                      '-'}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="">Start date : </label><span class="text-sucees"> {{$property->vms_start_date ? date('d M, Y',strtotime($property->vms_start_date)) :
                      '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">End date :</label><span class="text-sucees"> {{$property->vms_end_date ? date('d M, Y',strtotime($property->vms_end_date)) : '-'}}
                    </span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Reserved price :</label><span class="text-sucees"> {{$currency." ".number_format($property->reserved_price) ??
                      '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Square Footage :</label><span class="text-sucees"> {{number_format($property->square_foot_rate)
                      ?? '-'}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="">Minimum Offer increase : </label><span class="text-sucees"> {{$property->offer_increase.'%' ??
                      '-'}}</span>
                  </div>

                  <div class="col-lg-3">
                    <label class="">Occupancy :</label><span class="text-sucees"> {{ $property->occupancy ? config()->get('constants.occupancy.'.$property->occupancy) : '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <?php
                  $start_date = \Carbon\Carbon::parse($property->possession_rent_back);
                  $end_date = \Carbon\Carbon::parse($property->vms_end_date);
                  $different_days = $start_date->diffInDays($end_date);
                  ?>
                    <label class="">Possession :</label><span class="text-sucees"> </span>
                    @if($property->possession == 'rent_back')
                      <span>{{ $property->possession == 'rent_back' ? config()->get('constants.possession.'.$property->possession) .' - '. $different_days . ' days': '-'}}</span>
                    @elseif($property->possession == 'tenant_rights')
                    <span>{{ $property->possession == 'tenant_rights' ? config()->get('constants.possession.'.$property->possession) .' - '. $property->possession_tenant_rights : '-' }}</span>
                    @else
                      <span>{{ config()->get('constants.possession.'.$property->possession) }}</span>
                    @endif
                  </div>
                  <div class="col-lg-3">
                    <label class="">Property type : </label><span class="text-sucees"> {{ $property->property_type ? config()->get('constants.property.'.$property->property_type) : '-' }}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="">HOA Fee for preparing disclosures : </label><span class="text-sucees">
                      {{$property->hoa_certification_fee ?? '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">HOA certification fee : </label><span class="text-sucees">
                      {{$property->disclosure_hoa_fee ?? '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">HOA transfer fees : </label><span class="text-sucees">
                      {{$property->hoa_transfer_fee ?? '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Private transfer fees : </label><span class="text-sucees">
                      {{$property->private_transfer_fee ?? '-'}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="">Other fees or costs : </label><span class="text-sucees" style="word-break: break-all;">
                      {{$property->other_fee ?? '-'}} @if(!empty($property->other_fee_describe)) <br> (<strong>Description:</strong> {{$property->other_fee_describe}}) @endif</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Seller financing :</label><span class="text-sucees text-capitalize"> {{$property->seller_financing
                      ?? '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Seller credit buyer :</label><span class="text-sucees text-capitalize"> {{
                      $property->seller_credit_buyer ?
                      config()->get('constants.buyer_credit.'.$property->seller_credit_buyer) : '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Preferred purchase agreement :</label><span class="text-sucees text-capitalize"> {{
                      config()->get('constants.agreement.'.$property->purchase_agreement)}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="">Seller's brokerage name :</label><span class="text-sucees"> {{$property->brokerage_name ??
                      '-'}} </span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Seller's brokerage license  :</label><span class="text-sucees">
                      {{$property->brokerge_license_no ?? '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Listing Agent's Name :</label><span class="text-sucees"> {{$property->agent_name ??
                      '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Agent Phone Number :</label><span class="text-sucees"> {{ $property->agent_phone ??
                      '-' }}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="">Listing Agent's License : </label><span class="text-sucees"> {{$property->agent_license ??
                      '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Escrow holder :</label><span class="text-sucees"> {{$property->escrow_holder ??
                      '-'}} </span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Escrow number :</label><span class="text-sucees"> {{$property->escrow_number ??
                      '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Escrow officer :</label><span class="text-sucees"> {{$property->escrow_officer ??
                      '-'}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="">Escrow officer email : </label><span class="text-sucees">
                      {{$property->escrow_office_email ?? '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Escrow office phone :</label><span class="text-sucees">
                      {{$property->escrow_office_phone ?? '-'}} </span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Transaction coordinator :</label><span class="text-sucees">
                      {{$property->transaction_coordinator ?? '-'}}</span>
                  </div>
                  <div class="col-lg-3">
                    <label class="">Transaction coordinator email :</label><span class="text-sucees">
                      {{$property->transaction_coordinator_email ?? '-'}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-3">
                    <label class="">Transaction coordinator phone : </label><span class="text-sucees">
                      {{$property->transaction_coordinator_phone ?? '-'}}</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12 mb-5">
                    <label class="">Disclosure </label>
                    <div>
                      @if(str_contains($property->disclosure, '.pdf'))
                        <a href="{{ asset($property->disclosure) }}" target="__blank"><i class="flaticon-file"></i></a>
                      @else
                        <a href="{{ asset($property->disclosure) }}" target="__blank"><img src="{{ asset($property->disclosure) }}" width="300"></a>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label class=""> Item Include Exclude</label>
                    @foreach (json_decode($property->items_include_exclude) as $key => $value)
                      @if(!in_array($key,['additional_items','excluded_items']))
                        <div class="col-lg-12">
                          <label class="col-md-6">{{ config()->get('constants.items.'.$key) }} : </label>
                          <span class="col-md-6 text-capitalize">{{ $value }} </span>
                        </div>
                      @endif
                    @endforeach
                    <div class="col-lg-12">
                      <label class="col-md-6">Additional Items : </label>
                      <span class="col-md-6 text-capitalize">{{ $property->additional_items ?? '-' }} </span>
                    </div>
                    <div class="col-lg-12">
                      <label class="col-md-6">Excluded Items : </label>
                      <span class="col-md-6 text-capitalize">{{ $property->excluded_items ?? '-' }} </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    </div>
  </div>
  @if (preg_match('/view-buyer/i', Session::get('previous_url')) == 1)
  @else
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <div class="kt-portlet">
            <div class="kt-widget kt-widget--user-profile-3 border-bottom pb-2">
              <div class="kt-widget__top">
                  <div class="kt-widget__media w-100">
                      <h5 class="text-uppercase font-weight-bold">Update Status</h5>
                  </div>
              </div>
            </div>
            <!--begin::Form-->
            <form class="kt-form kt-form--label-right form-valide" action="{{ route('change-status', $property->id) }}"
              method="post" enctype="multipart/form-data" id="property_form">
              {{csrf_field()}}
              <input type="hidden" name="previous_url" value="{{Session::get('previous_url')}}">
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
              <div class="kt-section__content kt-section__content--solid">
              </div>
              <div class="kt-portlet__body">
                <div class="row">
                  <div class="col-lg-6 form-group">
                    @php
                    $statuses = config()->get('constants.property_status');
                    //dd(preg_match('/ALL/i', Session::get('previous_url')));
                    @endphp
                    <label class="">Change Status : </label><span class="text-danger">*</span>
                    <select class="form-control" name="status" id="status">
                      <option value="">Change status</option>
                      @foreach($statuses as $key => $status)
                        @if(preg_match('/ALL/i', $property->status) == 1)
                        @if(in_array($key, ['NL','FL','VC','FR','AC']))
                        <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif
                        @elseif(preg_match('/NL/i', $property->status) == 1)
                        @if(in_array($key, ['NL','IP','RJ','FR']))
                        <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif
                        @elseif(preg_match('/IP/i', $property->status) == 1)
                        @if(in_array($key, ['IP','RJ','AC','FR']))
                        <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif
                        @elseif(preg_match('/RJ/i', $property->status) == 1)
                        @if(in_array($key, ['IP','FR']))
                        <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif
                        @elseif(preg_match('/AC/i', $property->status) == 1)
                        @if(in_array($key, ['FL','FR']))
                        <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif
                        @elseif(preg_match('/VC/i', $property->status) == 1)
                        @if(in_array($key, ['IP','RJ','AC','FL','VC','FR']))
                        <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif
                        @elseif(preg_match('/FL/i', $property->status) == 1)
                        @if(in_array($key, ['IP','RJ','AC','FL','VC','FR']))
                        <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif
                        @elseif(preg_match('/FR/i', $property->status) == 1)
                        @if(in_array($key, ['IP','RJ','AC','FL','VC','FR']))
                        <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif
                        @else
                        @endif
                        {{-- @if(in_array($property->status, ['FL', 'FR', 'AC']))
                          @if(in_array($key, ['FL', 'FR', 'AC']))
                            <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                          @endif
                        @else
                          <option value="{{$key}}" {{ ($property->status == $key ? "selected":"") }}>{{ $status }} </option>
                        @endif --}}
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="">Comment/Note : </label><span class="text-danger">*</span>
                    <textarea class="form-control" id="comment_note"
                      name="comment_note" required> {{ $property->comment_note ?? '' }}</textarea>
                  </div>
                </div>
                <div class="kt-portlet__foot">
                  <div class="kt-form__actions">
                    <div class="row">
                      <div class="col-lg-4"></div>
                      <div class="col-lg-8">
                        <button type="Submit" class="btn btn-primary">Update Status</button>
                        <a href="{{url(Session::get('previous_url'))}}" class="btn btn-secondary">Cancel</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <form>
                <!--end::Form-->
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection