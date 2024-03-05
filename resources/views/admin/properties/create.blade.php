@extends('layouts.app')
@section('title', $title)
@section('content')
<style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
  </style>
<x-breadcrumb title="Create Properties" module="properties" link="{{route('properties')}}"></x-breadcrumb>
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
                                  <h4>{{('Create Properties')}}</h4>  
                            
                                </div>

                            </div>
										<!--begin::Form-->
         <form class="kt-form kt-form--label-right" action="{{ route('store-properties') }}" method="post" enctype="multipart/form-data" id="property_form">
                                {{csrf_field()}}

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


                                <div class="kt-portlet__body">
                                    <div class="form-group row">

        
                                        <div class="col-lg-3">
                                            <label class="">Property Id  : </label><span class="text-danger">*</span>

                                            <input type="text" class="form-control" id="vms_property_id" name="vms_property_id" value="{{$propertyid}}" readonly />

                                        </div>
                                        <div class="col-lg-3">
                                            <label class="">Property Name :</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="property_name" name="property_name" value="" />
                                                         
                                       
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="">Property address  :</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="property_address" name="property_address" value="" />
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="">Owner :</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="owner_name" name="owner_name" value="" />
                                        </div>
                                    </div>


<!-- second row -->
<div class="form-group row">

        
<div class="col-lg-3">
    <label class="">VMS Start date  : </label><span class="text-danger">*</span>

    <div class="input-group date">

<input type="text" class="form-control" name="vms_start_date" readonly placeholder="Select date" id="start_date"  value="{{Request::get('vms_start_date')}}" />

<div class="input-group-append">

    <span class="input-group-text">

        <i class="la la-calendar-check-o"></i>

    </span>

</div>

</div>


</div>
<div class="col-lg-3">
    <label class="">VMS End date :</label><span class="text-danger">*</span>

    <div class="input-group date">

<input type="text" class="form-control" name="vms_end_date" readonly placeholder="Select date" id="end_date"  value="{{Request::get('vms_end_date')}}" />

<div class="input-group-append">

    <span class="input-group-text">

        <i class="la la-calendar-check-o"></i>

    </span>

</div>

</div>


</div>
<div class="col-lg-3">
    <label class="">Reserved price  :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="reserved_price" name="reserved_price" value="" />
</div>
<div class="col-lg-3">
    <label class="">Square footage :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="square_foot_rate" name="square_foot_rate" value="" />
</div>
</div>


<!-- third row -->
<div class="form-group row">

        
<div class="col-lg-3">
    <label class="">Offer increase  : </label><span class="text-danger">*</span>

    <select class="form-control" id="offer_increase" name="offer_increase">
    <option value="">Select Any one</option>
    <option value="1%">1%</option>
    <option value="2%">2%</option>
    <option value="3%">3%</option>
    <option value="4%">4%</option>
    <option value="5%">5%</option>
    <option value="6%">6%</option>
    <option value="7%">7%</option>
    <option value="8%">8%</option>
    <option value="9%">9%</option>
    <option value="10%">10%</option>
   </select>

</div>
<div class="col-lg-3">
    <label class="">Discloures :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="discloures" name="discloures" value="" />
</div>
<div class="col-lg-3">
    <label class="">Occupancy  :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="occupacy" name="occupacy" value="" />
</div>
<div class="col-lg-3">
    <label class="">Possession :</label><span class="text-danger">*</span>

    <select class="form-control" id="possession" name="possession">
    <option value="">Select Any one</option>
    <option value="Close of escrow">Close of escrow</option>
    <option value="Month/day">Month/day</option>
    <option value="Seller rent back">Seller rent back</option>
    <option value="Tenant's rights">Tenant's rights</option>
 
   </select>

</div>
</div>


<!-- fourth row -->
<div class="form-group row">

        
<div class="col-lg-3">
    <label class="">Property type  : </label><span class="text-danger">*</span>

    <select class="form-control" id="property_type" name="property_type">
    <option value="">Select Any one</option>
    <option value="Single Family Dwelling">Single Family Dwelling</option>
    <option value="TIC">TIC</option>
    <option value="Condo">Condo</option>
    <option value="Multiunit">Multiunit</option>
 
   </select>

</div>
<div class="col-lg-3">
    <label class="">itmes include/exclude :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="itmes_include_exclude" name="itmes_include_exclude" value="" />
</div>
<div class="col-lg-3">
    <label class="">Seller financing  :</label><span class="text-danger">*</span>
    
    <select class="form-control" id="seller_financing" name="seller_financing">
    <option value="">Select Any one</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
   </select>

</div>
<div class="col-lg-3">
    <label class="">Seller credit buyer :</label><span class="text-danger">*</span>

    <select class="form-control" id="seller_credit_buyer" name="seller_credit_buyer">
    <option value="">Select Any one</option>
    <option value="yes">Yes</option>
    <option value="no">No</option>
    <option value="will_consider">Will consider</option>
   </select>

    
</div>
</div>


<!-- fifth row -->
<div class="form-group row">

        
<div class="col-lg-3">
    <label class="">Purchase agreement  : </label><span class="text-danger">*</span>

    <select class="form-control" id="purchase_agreement" name="purchase_agreement">
    <option value="">Select Any one</option>
    <option value="CAR Purchase Agreement">CAR Purchase Agreement</option>
    <option value="SFAR Purchase Agreement">SFAR Purchase Agreement</option>
 
   </select>

  
</div>
<div class="col-lg-3">
    <label class="">Brokerage name :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="brokerage_name" name="brokerage_name" value="" />
</div>
<div class="col-lg-3">
    <label class="">Brokerge license_no  :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="brokerge_license_no" name="brokerge_license_no" value="" />
</div>
<div class="col-lg-3">
    <label class="">Agent name :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="agent_name" name="agent_name" value="" />
</div>
</div>

<!-- six row -->
<div class="form-group row">

        
<div class="col-lg-3">
    <label class="">Agent license  : </label><span class="text-danger">*</span>

    <input type="text" class="form-control" id="agent_license" name="agent_license" value=""  />

</div>
<div class="col-lg-3">
    <label class="">Escrow holder :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="escrow_holder" name="escrow_holder" value="" />
</div>
<div class="col-lg-3">
    <label class="">Escrow number  :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="escrow_number" name="escrow_number" value="" />
</div>
<div class="col-lg-3">
    <label class="">Escrow officer :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="escrow_officer" name="escrow_officer" value="" />
</div>
</div>


<!-- seven row -->
<div class="form-group row">

        
<div class="col-lg-3">
    <label class="">Escrow office email  : </label><span class="text-danger">*</span>

    <input type="text" class="form-control" id="escrow_office_email" name="escrow_office_email" value=""  />

</div>
<div class="col-lg-3">
    <label class="">Escrow office phone :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="escrow_office_phone" name="escrow_office_phone" value="" />
</div>

<div class="col-lg-3">
    <label class="">Transaction coordinator :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="transaction_coordinator" name="transaction_coordinator" value="" />
</div>

<div class="col-lg-3">
    <label class="">Transaction coordinator email :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="transaction_coordinator_email" name="transaction_coordinator_email" value="" />
</div>



</div>


<!-- eight row -->
<div class="form-group row">

        
<div class="col-lg-3">
    <label class="">Transaction coordinator phone :</label><span class="text-danger">*</span>
    <input type="text" class="form-control" id="transaction_coordinator_phone" name="transaction_coordinator_phone" value="" />
</div>



</div>






                                </div>
                              


                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-8">
                                               
                                            <button type="Submit" class="btn btn-primary">Create</button>    
                                               
                                            <a href="{{route('properties')}}" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <!--end::Form-->
							</div>      
                            </div>
                        </div>  
                    </div>
                </div>
         
  

            </div>
        </div>
    </div>
    

<script>
$(document).ready(function() {
    $("#property_form").validate({
        rules: {
           
            title: {
                required: true,
            },
            title: {
                required: true,
            },
        }
    });
});
</script>
@endsection