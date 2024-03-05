@extends('layouts.app')
@section('title', $title)
@push('styles')
	<link href="{{URL::asset('vendors/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@section('content')
<x-breadcrumb title="{{$title}}" module="Buyer" link="{{url($previous_url)}}"></x-breadcrumb>
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
                                        <h4>{{('View Buyer')}}</h4>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <div class="kt-section__content kt-section__content--solid">
                                </div>
                                <div class="kt-portlet__body">
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="">Name: </label><span class="text-sucees">
                                                {{old('full_name', $buyer->full_name)}}</span>
                                        </div>
                                        {{-- <div class="col-lg-3">
                                            <label class="">Last Name:</label><span class="text-sucees">
                                                {{old('last_name', $buyer->last_name)}}</span>
                                        </div> --}}
                                        <div class="col-lg-3">
                                            <label class="">Email :</label><span class="text-sucees">
                                                {{old('email_id', $buyer->email_id)}}</span>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="">Contact Number :</label><span class="text-sucees">
                                                {{old('phone_no', $buyer->phone_no)}}</span>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="">OPT:</label>
                                            <span class="text-sucees"> {{ $buyer->optin_out }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="">Comment/Note: </label>
                                            <p class="text-sucees"> {{ $buyer->comment_note ?? ''}}</p>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="">Block Comment:</label>
                                            <p class="text-sucees"> {{ $buyer->block_comment ?? ''}}</p>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-xl-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__body">
                            <h4 class="mb-5">List of bids/offers</h4>
                            <!--begin: Datatable -->
                            {!! $dataTable->table() !!}
                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Model modal-lg-->
<div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Buyer Survey</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table summary="" aria-labelledby="label_4" cellpadding="4" cellspacing="0" class="form-matrix-table"
                    data-component="matrix">
                    <tbody>
                        <tr class="form-matrix-tr form-matrix-header-tr">
                            <th class="form-matrix-th" style="border:none">
                                &nbsp;
                            </th>
                            <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_0">
                                <label id="label_4_col_0"> Very satisfied </label>
                            </th>
                            <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_1">
                                <label id="label_4_col_1"> Satisfied </label>
                            </th>
                            <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_2">
                                <label id="label_4_col_2"> Neutral </label>
                            </th>
                            <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_3">
                                <label id="label_4_col_3"> Unsatisfied </label>
                            </th>
                            <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_4">
                                <label id="label_4_col_4"> Very unsatisfied </label>
                            </th>
                        </tr>
                        <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_4 label_4_row_0">
                            <th scope="row" class="form-matrix-headers form-matrix-row-headers">
                                <label id="label_4_row_0"> User Friendly </label>
                            </th>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_0_0" class="form-radio" name="q4_overallSatisfaction[0]"
                                    value="Very satisfied" aria-labelledby="label_4_col_0 label_4_row_0">
                                <label for="input_4_0_0" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_0_1" class="form-radio" name="q4_overallSatisfaction[0]"
                                    value="Satisfied" aria-labelledby="label_4_col_1 label_4_row_0">
                                <label for="input_4_0_1" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_0_2" class="form-radio" name="q4_overallSatisfaction[0]"
                                    value="Neutral" aria-labelledby="label_4_col_2 label_4_row_0">
                                <label for="input_4_0_2" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_0_3" class="form-radio" name="q4_overallSatisfaction[0]"
                                    value="Unsatisfied" aria-labelledby="label_4_col_3 label_4_row_0">
                                <label for="input_4_0_3" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_0_4" class="form-radio" name="q4_overallSatisfaction[0]"
                                    value="Very unsatisfied" aria-labelledby="label_4_col_4 label_4_row_0">
                                <label for="input_4_0_4" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                        </tr>
                        <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_4 label_4_row_1">
                            <th scope="row" class="form-matrix-headers form-matrix-row-headers">
                                <label id="label_4_row_1"> Enjoyed Experince </label>
                            </th>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_1_0" class="form-radio" name="q4_overallSatisfaction[1]"
                                    value="Very satisfied" aria-labelledby="label_4_col_0 label_4_row_1">
                                <label for="input_4_1_0" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_1_1" class="form-radio" name="q4_overallSatisfaction[1]"
                                    value="Satisfied" aria-labelledby="label_4_col_1 label_4_row_1">
                                <label for="input_4_1_1" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_1_2" class="form-radio" name="q4_overallSatisfaction[1]"
                                    value="Neutral" aria-labelledby="label_4_col_2 label_4_row_1">
                                <label for="input_4_1_2" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_1_3" class="form-radio" name="q4_overallSatisfaction[1]"
                                    value="Unsatisfied" aria-labelledby="label_4_col_3 label_4_row_1">
                                <label for="input_4_1_3" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_1_4" class="form-radio" name="q4_overallSatisfaction[1]"
                                    value="Very unsatisfied" aria-labelledby="label_4_col_4 label_4_row_1">
                                <label for="input_4_1_4" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                        </tr>
                        <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_4 label_4_row_2">
                            <th scope="row" class="form-matrix-headers form-matrix-row-headers">
                                <label id="label_4_row_2"> Convenience </label>
                            </th>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_2_0" class="form-radio" name="q4_overallSatisfaction[2]"
                                    value="Very satisfied" aria-labelledby="label_4_col_0 label_4_row_2">
                                <label for="input_4_2_0" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_2_1" class="form-radio" name="q4_overallSatisfaction[2]"
                                    value="Satisfied" aria-labelledby="label_4_col_1 label_4_row_2">
                                <label for="input_4_2_1" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_2_2" class="form-radio" name="q4_overallSatisfaction[2]"
                                    value="Neutral" aria-labelledby="label_4_col_2 label_4_row_2">
                                <label for="input_4_2_2" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_2_3" class="form-radio" name="q4_overallSatisfaction[2]"
                                    value="Unsatisfied" aria-labelledby="label_4_col_3 label_4_row_2">
                                <label for="input_4_2_3" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_2_4" class="form-radio" name="q4_overallSatisfaction[2]"
                                    value="Very unsatisfied" aria-labelledby="label_4_col_4 label_4_row_2">
                                <label for="input_4_2_4" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                        </tr>
                        <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_4 label_4_row_3">
                            <th scope="row" class="form-matrix-headers form-matrix-row-headers">
                                <label id="label_4_row_3"> Complicated </label>
                            </th>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_3_0" class="form-radio" name="q4_overallSatisfaction[3]"
                                    value="Very satisfied" aria-labelledby="label_4_col_0 label_4_row_3">
                                <label for="input_4_3_0" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_3_1" class="form-radio" name="q4_overallSatisfaction[3]"
                                    value="Satisfied" aria-labelledby="label_4_col_1 label_4_row_3">
                                <label for="input_4_3_1" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_3_2" class="form-radio" name="q4_overallSatisfaction[3]"
                                    value="Neutral" aria-labelledby="label_4_col_2 label_4_row_3">
                                <label for="input_4_3_2" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_3_3" class="form-radio" name="q4_overallSatisfaction[3]"
                                    value="Unsatisfied" aria-labelledby="label_4_col_3 label_4_row_3">
                                <label for="input_4_3_3" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_3_4" class="form-radio" name="q4_overallSatisfaction[3]"
                                    value="Very unsatisfied" aria-labelledby="label_4_col_4 label_4_row_3">
                                <label for="input_4_3_4" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                        </tr>
                        <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_4 label_4_row_4">
                            <th scope="row" class="form-matrix-headers form-matrix-row-headers">
                                <label id="label_4_row_4"> Exiting </label>
                            </th>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_4_0" class="form-radio" name="q4_overallSatisfaction[4]"
                                    value="Very satisfied" aria-labelledby="label_4_col_0 label_4_row_4">
                                <label for="input_4_4_0" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_4_1" class="form-radio" name="q4_overallSatisfaction[4]"
                                    value="Satisfied" aria-labelledby="label_4_col_1 label_4_row_4">
                                <label for="input_4_4_1" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_4_2" class="form-radio" name="q4_overallSatisfaction[4]"
                                    value="Neutral" aria-labelledby="label_4_col_2 label_4_row_4">
                                <label for="input_4_4_2" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_4_3" class="form-radio" name="q4_overallSatisfaction[4]"
                                    value="Unsatisfied" aria-labelledby="label_4_col_3 label_4_row_4">
                                <label for="input_4_4_3" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_4_4" class="form-radio" name="q4_overallSatisfaction[4]"
                                    value="Very unsatisfied" aria-labelledby="label_4_col_4 label_4_row_4">
                                <label for="input_4_4_4" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                        </tr>
                        <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_4 label_4_row_5">
                            <th scope="row" class="form-matrix-headers form-matrix-row-headers">
                                <label id="label_4_row_5"> Intrusive </label>
                            </th>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_5_0" class="form-radio" name="q4_overallSatisfaction[5]"
                                    value="Very satisfied" aria-labelledby="label_4_col_0 label_4_row_5">
                                <label for="input_4_5_0" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_5_1" class="form-radio" name="q4_overallSatisfaction[5]"
                                    value="Satisfied" aria-labelledby="label_4_col_1 label_4_row_5">
                                <label for="input_4_5_1" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_5_2" class="form-radio" name="q4_overallSatisfaction[5]"
                                    value="Neutral" aria-labelledby="label_4_col_2 label_4_row_5">
                                <label for="input_4_5_2" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_5_3" class="form-radio" name="q4_overallSatisfaction[5]"
                                    value="Unsatisfied" aria-labelledby="label_4_col_3 label_4_row_5">
                                <label for="input_4_5_3" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                            <td class="form-matrix-values">
                                <input type="radio" id="input_4_5_4" class="form-radio" name="q4_overallSatisfaction[5]"
                                    value="Very unsatisfied" aria-labelledby="label_4_col_4 label_4_row_5">
                                <label for="input_4_5_4" class="matrix-choice-label matrix-radio-label"> </label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
{!! $dataTable->scripts() !!}
@endpush