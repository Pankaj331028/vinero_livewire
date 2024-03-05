@extends('layouts.app')
@section('title', $title)
@push('styles')
<style>

    table {
        text-align: center;
    }
</style>
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
                        @include('layouts.vmsfilter')

                    <div style="background-color: aliceblue;">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            {{-- <li class="nav-item ">
                                <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#pills-all"
                                    role="tab" aria-controls="pills-all" aria-selected="true">All survey</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-univers-tab" data-toggle="pill" href="#pills-univers"
                                    role="tab" aria-controls="pills-univers" aria-selected="false">Universe's survey</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-buyer-tab" data-toggle="pill" href="#pills-buyer" role="tab"
                                    aria-controls="pills-buyer" aria-selected="false">Buyer's survey</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-seller-tab" data-toggle="pill" href="#pills-seller" role="tab"
                                    aria-controls="pills-seller" aria-selected="false">Seller's survey</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-sagent-tab" data-toggle="pill" href="#pills-sagent" role="tab"
                                    aria-controls="pills-sagent" aria-selected="false">Seller's agent survey</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-bagent-tab" data-toggle="pill" href="#pills-bagent" role="tab"
                                    aria-controls="pills-bagent" aria-selected="false">Buyer's agent survey</a>
                            </li>

                        </ul>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        {{-- <div class="tab-pane fade" id="pills-all" role="tabpanel"
                            aria-labelledby="pills-all-tab">
                            <div class="col-xl-12">
                                <x-alert>
                                </x-alert>
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__body">
                                        <div class="kt-portlet__head-actions">
                                        </div>
                                        </br>
                                        <div class="table-responsive">
                                            <!--begin: Datatable -->
                                            {!! $dataTable->table() !!}
                                            <!--end: Datatable -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @php
                        $allsum = 0;
                        @endphp
                        <div class="tab-pane fade" id="pills-buyer" role="tabpanel" aria-labelledby="pills-buyer-tab">
                            <div class="col-xl-12">
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__body">
                                        @php
                                        $colspan = count($buyers)+2;
                                        $length = count($buyers);
                                        @endphp
                                        @if ($length == 0)
                                        <div style="text-align: center;">
                                            <h5>No survey found.</h5>
                                        </div>
                                        @else
                                        <div class="kt-portlet__head-actions">
                                            <div style="display: flex;">
                                                <div style="width:50%;display: flex;">
                                                    <h6>Maximum possible score per card:</h6>&nbsp;<b>{{$score_per_card}}</b>
                                                </div>
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Average Score:</h6>&nbsp;<b>{{$buyer_group_avg_scr}}</b>
                                                </div>
                                            </div>
                                            <div style="display: flex;">
                                                <div style="width:50%;display: flex;">
                                                    <h6>Number of user response:</h6>&nbsp;<b>{{$buyerscount}}</b>
                                                </div>
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Average % Score:</h6>&nbsp;<b>{{$buyer_per_score}}</b>
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="outer">
                                            <div class="inner table-responsive">
                                                <table class="table" class="display nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            @foreach ($buyers as $key => $val)
                                                            <th>
                                                                <a href="{{route('view-buyer',$val->id)}}">{{$val->property_id}}/{{$val->phone_no}}</a>
                                                            </th>
                                                            @endforeach
                                                            <th>Group average</th>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="{{$colspan}}">&nbsp;</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($buyer_data as $key => $item)
                                                        <tr>
                                                            <td>{{$key}}</td>
                                                            @foreach ($item as $k => $v)
                                                            <td>{{$v}}</td>
                                                            @endforeach
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="{{$colspan}}">&nbsp;</td>
                                                        </tr>
                                                        @foreach ($type as $key => $val)
                                                        @foreach ($buyers as $item)
                                                        @php
                                                        $avg = App\Models\Survey::where('id', $item->s_id)->avg($key);
                                                        @endphp
                                                        @endforeach
                                                        @php
                                                        $allsum+= $avg;
                                                        @endphp
                                                        @endforeach
                                                        <tr>
                                                            <th>Algebraic sum</th>
                                                            @foreach ($buyers as $item)
                                                            @php
                                                            $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                            $arrsum = array_sum($sum[0]);
                                                            @endphp
                                                            <th>{{$arrsum}}</th>
                                                            @endforeach
                                                            <th>{{$buyer_group_sum}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Average score</th>
                                                            @foreach ($buyers as $item)
                                                            @php
                                                            $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                            $count = count($sum[0]);
                                                            $arrsum = array_sum($sum[0]);
                                                            $avg = $count>0?$arrsum/$count:0;
                                                            $round= round($avg, 2);
                                                            @endphp
                                                            <th>{{$round}}</th>
                                                            @endforeach
                                                            <th>
                                                                {{$buyer_group_avg_scr}}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Score as a percentage</th>
                                                            @foreach ($buyers as $item)
                                                            @php
                                                            $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                            try{
                                                            $count = count($sum[0]);
                                                            $arrsum = array_sum($sum[0]);
                                                            $avg = $count>0?$arrsum/$count:0;
                                                            $per = $arrsum>0?$count/$arrsum*100:0;
                                                            $perround = round($per, 2);
                                                            }catch(\Exception $e){
                                                            $per=0;
                                                            $perround=0;
                                                            }
                                                            @endphp
                                                            <th>{{$perround}}%</th>
                                                            @endforeach
                                                            <th>
                                                                {{$buyer_per_score}}%
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-seller" role="tabpanel" aria-labelledby="pills-seller-tab">
                            <div class="col-xl-12">
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__body">
                                        @php
                                        $colspan = count($seller)+2;
                                        $length = count($seller);
                                        @endphp
                                        @if ($length == 0)
                                        <div style="text-align: center;">
                                            <h5>No survey found.</h5>
                                        </div>
                                        @else
                                        <div class="kt-portlet__head-actions">
                                            <div style="display: flex;">
                                                <div style="width:50%;display: flex;">
                                                    <h6>Maximum possible score per card:</h6>&nbsp;<b>{{$score_per_card}}</b>
                                                </div>
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Average Score:</h6>&nbsp;<b>{{$seller_group_avg_scr}}</b>
                                                </div>
                                            </div>
                                            <div style="display: flex;">
                                                <div style="width:50%;display: flex;">
                                                    <h6>Number of user response:</h6>&nbsp;<b>{{$sellercount}}</b>
                                                </div>
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Average % Score:</h6>&nbsp;<b>{{$seller_per_score}}</b>
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="table-responsive">
                                            <table class="table" class="display nowrap">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        @foreach ($seller as $key => $val)
                                                        <th>
                                                            <a href="{{route('view-seller',$val->id)}}">{{$val->property_id}}/{{$val->phone_no}}</a>
                                                        </th>
                                                        @endforeach
                                                        <th>Group average</th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="{{$colspan}}">&nbsp;</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($seller_data as $key => $item)
                                                    <tr>
                                                        <td>{{$key}}</td>
                                                        @foreach ($item as $k => $v)
                                                        <td>{{$v}}</td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="{{$colspan}}">&nbsp;</td>
                                                    </tr>
                                                    @foreach ($type as $key => $val)
                                                    @foreach ($seller as $item)
                                                    @php
                                                    $avg = App\Models\Survey::where('id', $item->s_id)->avg($key);
                                                    @endphp
                                                    @endforeach
                                                    @php
                                                    $allsum+= $avg;
                                                    @endphp
                                                    @endforeach
                                                    <tr>
                                                        <th>Algebraic sum</th>
                                                        @foreach ($seller as $item)
                                                        @php
                                                        $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                        $arrsum = array_sum($sum[0]);
                                                        @endphp
                                                        <th>{{$arrsum}}</th>
                                                        @endforeach
                                                        <th>{{$seller_group_sum}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Average score</th>
                                                        @foreach ($seller as $item)
                                                        @php
                                                        $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                        $count = count($sum[0]);
                                                        $arrsum = array_sum($sum[0]);
                                                        $avg = $count>0?$arrsum/$count:0;
                                                        $round= round($avg, 2);
                                                        @endphp
                                                        <th>{{$round}}</th>
                                                        @endforeach
                                                        <th>
                                                            {{$seller_group_avg_scr}}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Score as a percentage</th>
                                                        @foreach ($seller as $item)
                                                        @php
                                                        $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                        try{
                                                        $count = count($sum[0]);
                                                        $arrsum = array_sum($sum[0]);
                                                        $avg = $count>0?$arrsum/$count:0;
                                                        $per = $arrsum>0?$count/$arrsum*100:0;
                                                        $perround = round($per, 2);
                                                        }catch(\Exception $e){
                                                        $per=0;
                                                        $perround=0;
                                                        }
                                                        @endphp
                                                        <th>{{$perround}}%</th>
                                                        @endforeach
                                                        <th>
                                                            {{$seller_per_score}}%
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-sagent" role="tabpanel" aria-labelledby="pills-sagent-tab">
                            <div class="col-xl-12">
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__body">
                                        @php
                                        $colspan = count($sagent)+2;
                                        $length = count($sagent);
                                        @endphp
                                        @if ($length == 0)
                                        <div style="text-align: center;">
                                            <h5>No survey found.</h5>
                                        </div>
                                        @else
                                        <div class="kt-portlet__head-actions">
                                            <div style="display: flex;">
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Maximum possible score per card:</h6>&nbsp;<b>{{$score_per_card}}</b>
                                                </div>
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Average Score:</h6>&nbsp;<b>{{$sagent_group_avg_scr}}</b>
                                                </div>
                                            </div>
                                            <div style="display: flex;">
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Number of user response:</h6>&nbsp;<b>{{$sagentcount}}</b>
                                                </div>
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Average % Score:</h6>&nbsp;<b>{{$sagent_per_score}}</b>
                                                </div>
                                            </div>
                                            </br>
                                            <div class="table-responsive">
                                                <table class="table" class="display nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center;">
                                                                <h5>No survey found.</h5>
                                                            </th>
                                                            @foreach ($sagent as $key => $val)
                                                            <th>
                                                                <a href="{{route('view-agent',$val->id)}}">{{$val->property_id}}/{{$val->phone_no}}</a>
                                                            </th>
                                                            @endforeach
                                                            <th>Group average</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="{{$colspan}}"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($seller_agent_data as $key => $item)
                                                        <tr>
                                                            <td>{{$key}}</td>
                                                            @foreach ($item as $k => $v)
                                                            <td>{{$v}}</td>
                                                            @endforeach
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <th colspan="{{$colspan}}"></th>
                                                        </tr>
                                                        @foreach ($type as $key => $val)
                                                        @foreach ($sagent as $item)
                                                        @php
                                                        $avg = App\Models\Survey::where('id', $item->s_id)->avg($key);
                                                        @endphp
                                                        @endforeach
                                                        @php
                                                        $allsum+= $avg;
                                                        @endphp
                                                        @endforeach
                                                        <tr>
                                                            <th>Algebraic sum</th>
                                                            @foreach ($sagent as $item)
                                                            @php
                                                            $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                            $arrsum = array_sum($sum[0]);
                                                            @endphp
                                                            <th>{{$arrsum}}</th>
                                                            @endforeach
                                                            <th>{{$sagent_group_sum}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Average score</th>
                                                            @foreach ($sagent as $item)
                                                            @php
                                                            $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                            $count = count($sum[0]);
                                                            $arrsum = array_sum($sum[0]);
                                                            $avg = $count>0?$arrsum/$count:0;
                                                            $round= round($avg, 2);
                                                            @endphp
                                                            <th>{{$round}}</th>
                                                            @endforeach
                                                            <th>
                                                                {{$sagent_group_avg_scr}}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Score as a percentage</th>
                                                            @foreach ($sagent as $item)
                                                            @php
                                                            $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                            try{
                                                            $count = count($sum[0]);
                                                            $arrsum = array_sum($sum[0]);
                                                            $avg = $count>0?$arrsum/$count:0;
                                                            $per = $arrsum>0?$count/$arrsum*100:0;
                                                            $perround = round($per, 2);
                                                            }catch(\Exception $e){
                                                            $per=0;
                                                            $perround=0;
                                                            }
                                                            @endphp
                                                            <th>{{$perround}}%</th>
                                                            @endforeach
                                                            <th>
                                                                {{$sagent_per_score}}%
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-bagent" role="tabpanel" aria-labelledby="pills-bagent-tab">
                            <div class="col-xl-12">
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__body">
                                        @php
                                        $colspan = count($bagent);
                                        $length = count($bagent);
                                        @endphp
                                        @if ($length == 0)
                                        <div style="text-align: center;">
                                            <h5>No survey found.</h5>
                                        </div>
                                        @else
                                        <div class="kt-portlet__head-actions">
                                            <div style="display: flex;">
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Maximum possible score per card:</h6>&nbsp;<b>{{$score_per_card}}</b>
                                                </div>
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Average Score:</h6>&nbsp;<b>{{$bagent_group_avg_scr}}</b>
                                                </div>
                                            </div>
                                            <div style="display: flex;">
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Number of user response:</h6>&nbsp;<b>{{$bagentcount}}</b>
                                                </div>
                                                <div style="width: 50%;display:flex;">
                                                    <h6>Average % Score:</h6>&nbsp;<b>{{$bagent_per_score}}</b>
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="table-responsive">
                                            <table class="table" class="display nowrap">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        @foreach ($bagent as $key => $val)
                                                        <th>
                                                            <a href="{{route('view-agent',$val->id)}}">{{$val->property_id}}/{{$val->phone_no}}</a>
                                                        </th>
                                                        @endforeach
                                                        <th>Group average</th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="{{$colspan}}"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($buyer_agent_data as $key => $item)
                                                    <tr>
                                                        <td>{{$key}}</td>
                                                        @foreach ($item as $k => $v)
                                                        <td>{{$v}}</td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="{{$colspan}}"></td>
                                                    </tr>
                                                    @foreach ($type as $key => $val)
                                                    @foreach ($bagent as $item)
                                                    @php
                                                    $avg = App\Models\Survey::where('id', $item->s_id)->avg($key);
                                                    @endphp
                                                    @endforeach
                                                    @php
                                                    $allsum+= $avg;
                                                    @endphp
                                                    @endforeach
                                                    <tr>
                                                        <th>Algebraic sum</th>
                                                        @foreach ($bagent as $item)
                                                        @php
                                                        $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                        $arrsum = array_sum($sum[0]);
                                                        @endphp
                                                        <th>{{$arrsum}}</th>
                                                        @endforeach
                                                        <th>{{$bagent_group_sum}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Average score</th>
                                                        @foreach ($bagent as $item)
                                                        @php
                                                        $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                        $count = count($sum[0]);
                                                        $arrsum = array_sum($sum[0]);
                                                        $avg = $count>0?$arrsum/$count:0;
                                                        $round= round($avg, 2);
                                                        @endphp
                                                        <th>{{$round}}</th>
                                                        @endforeach
                                                        <th>
                                                            {{$bagent_group_avg_scr}}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>Score as a percentage</th>
                                                        @foreach ($bagent as $item)
                                                        @php
                                                        $sum = App\Models\Survey::where('id', $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                        try{
                                                        $count = count($sum[0]);
                                                        $arrsum = array_sum($sum[0]);
                                                        $avg = $count>0?$arrsum/$count:0;
                                                        $per = $arrsum>0?$count/$arrsum*100:0;
                                                        $perround = round($per, 2);
                                                        }catch(\Exception $e){
                                                        $per=0;
                                                        $perround=0;
                                                        }
                                                        @endphp
                                                        <th>{{$perround}}%</th>
                                                        @endforeach
                                                        <th>
                                                            {{$bagent_per_score}}%
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="pills-univers" role="tabpanel"aria-labelledby="pills-univers-tab">

                            <div class="col-xl-12">
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__body">

                                        <div class="kt-portlet__head-actions">
                                        </div>
                                        </br>
                                        <div class="table-responsive">
                                            <table class="table">
                                                @php

                                                $buyer = count($buyers);
                                                $sellr = count($seller);
                                                $agentb = count($bagent);
                                                $agents = count($sagent);
                                                $univers = $buyer + $sellr + $agentb + $agents;
                                                @endphp
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Universe</th>
                                                        <th>Buyers</th>
                                                        <th>Sellers</th>
                                                        <th>Buyer's Agent</th>
                                                        <th>List Agent</th>
                                                    </tr>


                                                                                                        @foreach ($type as $key => $val)
                                                    @if (count($buyers) > 0)
                                                    @foreach ($buyers as $item)
                                                    @php
                                                    $survey = App\Models\Survey::where('user_id',
                                                    $item->id)->value($key);
                                                    $avgby = App\Models\Survey::where('user_id', $item->id)->avg($key);
                                                    $avgb = round($avgby, 2);
                                                    $buyer_algebraic = App\Models\Survey::where('user_id',
                                                    $item->id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                    $buyer_algebraicsum = array_sum($buyer_algebraic[0]);
                                                    $buyer_count = count($buyer_algebraic[0]);
                                                    $buyer_av = $buyer_count>0?$buyer_algebraicsum/$buyer_count:0;
                                                    $buyer_avg = round($buyer_av, 2);
                                                    $buyer_per = $buyer_algebraicsum>0?$buyer_count/$buyer_algebraicsum*100:0;
                                                    $buyer_pers = round($buyer_per, 2);
                                                    @endphp
                                                    @endforeach
                                                    @endif

                                                    @if (count($seller) > 0)
                                                    @foreach ($seller as $item)
                                                    @php
                                                    $survey = App\Models\Survey::where('user_id',
                                                    $item->id)->value($key);
                                                    $avgse = App\Models\Survey::where('user_id', $item->id)->avg($key);
                                                    $avgs = round($avgse, 2);
                                                    $saller_algebraic = App\Models\Survey::where('user_id',
                                                    $item->id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                    $saller_algebraicsum = array_sum($saller_algebraic[0]);
                                                    $saller_count = count($saller_algebraic[0]);
                                                    $saller_av = $saller_count>0?$saller_algebraicsum/$saller_count:0;
                                                    $saller_avg = round($saller_av, 2);
                                                    $saller_per = $saller_algebraicsum>0?$saller_count/$saller_algebraicsum*100:0;
                                                    $saller_pers = round($saller_per, 2);

                                                    @endphp
                                                    @endforeach
                                                    @endif

                                                    @if (count($bagent) > 0)
                                                    @foreach ($bagent as $item)
                                                    @php
                                                    $survey = App\Models\Survey::where('id', $item->s_id)->value($key);
                                                    $avgbyagent = App\Models\Survey::where('id',
                                                    $item->s_id)->avg($key);
                                                    $avgbagent = $avgbyagent > 0 ? round($avgbyagent, 2):0;
                                                    $bagent_algebraic = App\Models\Survey::where('id',
                                                    $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                    if (count($bagent_algebraic) > 0) {
                                                    $bagent_algebraicsum = array_sum($bagent_algebraic[0]);
                                                    $bagent_count = count($bagent_algebraic[0]);
                                                    $bagent_av = $bagent_count > 0 ? $bagent_algebraicsum/$bagent_count:0;
                                                    $bagent_avg = round($bagent_av, 2);
                                                    $bagent_per = $bagent_algebraicsum>0?$bagent_count/$bagent_algebraicsum*100:0;
                                                    $bagent_pers = round($bagent_per, 2);
                                                    }


                                                    @endphp
                                                    @endforeach
                                                    @endif

                                                    @if (count($sagent) > 0)
                                                    @foreach ($sagent as $item)
                                                    @php
                                                    $survey = App\Models\Survey::where('id', $item->s_id)->value($key);
                                                    $avgseagent = App\Models\Survey::where('id',
                                                    $item->s_id)->avg($key);
                                                    $avgsagent = $avgseagent > 0 ? round($avgseagent, 2) : 0;
                                                    $sagent_algebraic = App\Models\Survey::where('id',
                                                    $item->s_id)->get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                    try{
                                                    $sagent_algebraicsum = array_sum($sagent_algebraic[0]);
                                                    $sagent_count = count($sagent_algebraic[0]);
                                                    $sagent_av = $sagent_count>0?$sagent_algebraicsum/$sagent_count:0;
                                                    $sagent_avg = round($sagent_av, 2);
                                                    $sagent_per = $sagent_algebraicsum>0?$sagent_count/$sagent_algebraicsum*100:0;
                                                    $sagent_pers = round($sagent_per, 2);
                                                    }catch(\Exception $e){
                                                    $sagent_per=0;
                                                    $sagent_pers=0;
                                                    }
                                                    @endphp
                                                    @endforeach
                                                    @endif

                                                    @php
                                                    $avgeall = App\Models\Survey::avg($key);
                                                    $avgall = $avgeall > 0 ? round($avgeall, 2):0;
                                                    $final =
                                                    App\Models\Survey::get(['user_friendly','enjoyed_experience','convenience','complicated','exiting','intrusive','kept_me_informed','kept_me_control','kept_me_focused','found_value','will_use_it_again','will_recommend','transparency','fairness','inclusiveness','a_better_way','frictions'])->toArray();
                                                    $all_algebraic = array();

                                                    foreach($final as $value)
                                                        $all_algebraic = array_merge($all_algebraic, $value);

                                                    foreach($all_algebraic as $key => &$value)
                                                        $value = array_sum(array_column($final, $key));

                                                    unset($value);
                                                    //dd(array_sum($all_algebraic));
                                                    if (count($all_algebraic) > 0) {
                                                    try{
                                                    $all_algebraicsum = array_sum($all_algebraic);
                                                    $all_count = count($final);
                                                    $all_av = $all_count>0?$all_algebraicsum/$all_count:0;
                                                    $all_avg = round($all_av, 2);
                                                    $all_per = $all_algebraicsum>0?$all_count/$all_algebraicsum*100:0;
                                                    $all_pers = round($all_per, 2);
                                                    }catch(\Exception $e){
                                                    $all_per=0;
                                                    $all_pers=0;
                                                    }
                                                    }
                                                    @endphp
                                                    @endforeach
                                                    <tr>
                                                        <th>Maximum possible score per card</th>
                                                        <th>{{$score_per_card ?? ''}}</th>
                                                        <th>{{$score_per_card ?? ''}}</th>
                                                        <th>{{$score_per_card ?? ''}}</th>
                                                        <th>{{$score_per_card ?? ''}}</th>
                                                        <th>{{$score_per_card ?? ''}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Number of user response:</th>
                                                        <th>{{$univers}}</th>
                                                        <th>{{$buyer}}</th>
                                                        <th>{{$sellr}}</th>
                                                        <th>{{$agentb}}</th>
                                                        <th>{{$agents}}</th>

                                                    </tr>
                                                    <tr>
                                                        <th>Average Score:</th>
                                                        <th>{{$all_avg ?? ''}}</th>
                                                        <th>{{$buyer_avg ?? ''}}</th>
                                                        <th>{{$saller_avg ?? ''}}</th>
                                                        <th>{{$bagent_avg ?? ''}}</th>
                                                        <th>{{$sagent_avg ?? ''}}</th>

                                                    </tr>
                                                    <tr>
                                                        <th>Average % Score</th>
                                                        <th>{{$all_pers ?? ''}}</th>
                                                        <th>{{$buyer_pers ?? ''}}</th>
                                                        <th>{{$saller_pers ?? ''}}</th>
                                                        <th>{{$bagent_pers ?? ''}}</th>
                                                        <th>{{$sagent_pers ?? ''}}</th>

                                                    </tr>
                                                    <tr>
                                                        <th>Algebraic sum</th>
                                                        <th>{{$all_algebraicsum ?? ''}}</th>
                                                        <th>{{$buyer_algebraicsum ?? ''}}</th>
                                                        <th>{{$saller_algebraicsum ?? ''}}</th>
                                                        <th>{{$bagent_algebraicsum ?? ''}}</th>
                                                        <th>{{$sagent_algebraicsum ?? ''}}</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="6">
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($type as $key => $val)
                                                    @if (count($buyers) > 0)
                                                    @foreach ($buyers as $item)
                                                    @php
                                                    $survey = App\Models\Survey::where('user_id',
                                                    $item->id)->value($key);
                                                    $avgby = App\Models\Survey::where('user_id', $item->id)->avg($key);
                                                    $avgb = round($avgby, 2);
                                                    @endphp
                                                    @endforeach
                                                    @endif

                                                    @if (count($seller) > 0)
                                                    @foreach ($seller as $item)
                                                    @php
                                                    $survey = App\Models\Survey::where('user_id',
                                                    $item->id)->value($key);
                                                    $avgse = App\Models\Survey::where('user_id', $item->id)->avg($key);
                                                    $avgs = round($avgse, 2);
                                                    @endphp
                                                    @endforeach
                                                    @endif

                                                    @if (count($bagent) > 0)
                                                    @foreach ($bagent as $item)
                                                    @php
                                                    $survey = App\Models\Survey::where('id', $item->s_id)->value($key);
                                                    $avgbyagent = App\Models\Survey::where('id',
                                                    $item->s_id)->avg($key);
                                                    $avgbagent = round($avgbyagent, 2);
                                                    @endphp
                                                    @endforeach
                                                    @endif

                                                    @if (count($sagent) > 0)
                                                    @foreach ($sagent as $item)
                                                    @php
                                                    $survey = App\Models\Survey::where('id', $item->s_id)->value($key);
                                                    $avgseagent = App\Models\Survey::where('id',
                                                    $item->s_id)->avg($key);
                                                    $avgsagent = round($avgseagent, 2);
                                                    @endphp
                                                    @endforeach
                                                    @endif
                                                    @php
                                                    $avgeall = App\Models\Survey::avg($key);
                                                    $avgall = round($avgeall, 2);
                                                    @endphp

                                                    <tr>
                                                        <td>{{$val ?? ''}}</td>
                                                        <td>{{$avgall ?? ''}}</td>
                                                        <td>{{$avgb ?? ''}}</td>
                                                        <td>{{$avgs ?? ''}}</td>
                                                        <td>{{$avgbagent ?? ''}}</td>
                                                        <td>{{$avgsagent ?? ''}}</td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
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
</div>
@endsection
@push('scripts')
<script src="{{URL::asset('vendors/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
{!! $dataTable->scripts() !!}
<script type="text/javascript">
    $("#pills-univers table tbody").prepend($("#pills-univers table tbody").find('tr:nth-last-child(-n+3)'));
</script>
@endpush
