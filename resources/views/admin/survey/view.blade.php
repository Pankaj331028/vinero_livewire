@extends('layouts.app')
@section('title', $title)
@push('styles')
	<link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@section('content')

<x-breadcrumb title="{{ $title }}"></x-breadcrumb>
<!-- begin:: Content -->
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app" id="kt_app">
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__body">
                          <div class="kt-portlet__head-actions">
                           <h5>Survey Detail</h5>
                           <hr>
                           </div>
                           </br>
                           <div class="row">
                              @php
                                  $type = $survey['user']['user_type'];
                                  $u_id = $survey['user']['id'];
                              @endphp
                             <div class="col-md-4" style="margin-bottom: 20px;">
                              @if ($type == 'buyer')

                                 @if(Helper::checkAccess('view buyer'))
                                 <a href="{{route('view-buyer',$u_id)}}">user Name: <br> {{$survey['user']['full_name'] ?? ''}}/{{$survey['user']['phone_no'] ?? ''}}</a>
                                 @else
                                    user Name: <br> {{$survey['user']['full_name'] ?? ''}}/{{$survey['user']['phone_no'] ?? ''}}
                                 @endif
                              @elseif($type == 'seller')
                                 @if(Helper::checkAccess('view seller'))
                                 <a href="{{route('view-seller',$u_id)}}">user Name: <br> {{$survey['user']['full_name'] ?? ''}}/{{$survey['user']['phone_no'] ?? ''}}</a>
                                 @else
                                 user Name: <br> {{$survey['user']['full_name'] ?? ''}}/{{$survey['user']['phone_no'] ?? ''}}
                                 @endif
                             @else
                                 @if(Helper::checkAccess('view agent'))
                                 <a href="{{route('view-agent',$u_id)}}">user Name: <br> {{$survey['user']['full_name'] ?? ''}}/{{$survey['user']['phone_no'] ?? ''}}</a>
                                 @else
                                 user Name: <br> {{$survey['user']['full_name'] ?? ''}}/{{$survey['user']['phone_no'] ?? ''}}
                                 @endif
                              @endif
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                User friendly: <br> {{$survey->user_friendly}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Enjoyed the Experience: <br> {{$survey->enjoyed_experience}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Convenience: <br> {{$survey->convenience}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Complicated: <br> {{$survey->complicated}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Exiting: <br> {{$survey->exiting}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Intrusive: <br> {{$survey->intrusive}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Kept me informed: <br> {{$survey->kept_me_informed}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Kept me in control: <br> {{$survey->kept_me_control}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Kept me focused: <br> {{$survey->kept_me_focused}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Found Value: <br> {{$survey->found_value}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Will use it again: <br> {{$survey->will_use_it_again}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Will Recommend: <br> {{$survey->will_recommend}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Transparency: <br> {{$survey->transparency}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Fairness: <br> {{$survey->fairness}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Inclusiveness: <br> {{$survey->inclusiveness}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                A Better Way: <br> {{$survey->a_better_way}}
                             </div>
                             <div class="col-md-4" style="margin-bottom: 20px;">
                                Frictions: <br> {{$survey->frictions}}
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
    @push('scripts')
        <script src="{{URL::asset('vendors/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>

    @endpush