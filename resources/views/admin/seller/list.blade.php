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
                    @include('layouts.vmsfilter')
                    <x-alert>
                    </x-alert>
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head-toolbar text-right">
    @if(Auth::guard('admin')->user()->user_role->name=='admin')
                            <a href="{{ url('admin/sellers?status=1') }}"
                                class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='1') active @endif">Active
                                ({{$active_count}})</a>
                                @else
                            <a href="{{ url('admin/sellers') }}"
                                class="btn btn-label-brand btn-bold btn-sm   @if(empty(request()->status) || request()->status=='1') active @endif">Active
                                ({{$active_count}})</a>
                                @endif
                            <a href="{{ url('admin/sellers?status=0') }}"
                                class="btn btn-label-brand btn-bold btn-sm   @if(request()->status=='0') active @endif">No
                                Sale ({{$inactive_count}})</a>
    @if(Auth::guard('admin')->user()->user_role->name=='admin')
                            <a href="{{ route('seller') }}"
                                class="btn btn-label-brand btn-bold btn-sm   @if(!isset(request()->status)) active @endif">Past
                                Seller ({{$past_count}})</a>
                                @endif
                        </div></br>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__head-actions">
                            </div>
                            </br>
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
@endsection
@push('scripts')
<script src="{{URL::asset('vendors/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
{!! $dataTable->scripts() !!}
<script>
    $(document).on('change', '.updateStatus', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('updateStatus') }}",
            data: {
                id: $(this).data('id'),
                status: $(this).val(),
            },
            type: "post",
            success: function (res) {
                if (res.status == 200) {
                    $('#seller-table').DataTable().draw(false);
                } else {
                    $('#seller-table').DataTable().draw(false);
                }
            }
        })
    })
</script>
@endpush