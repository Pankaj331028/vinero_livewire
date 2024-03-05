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

                @if(Session::has('flash_message'))
			<div class="flash-message" style="color:green; text-align:center">
				<h4>{{ Session::get('flash_message') }}</h4>
			</div>
		@endif

                	<x-alert>
                    </x-alert>
                    <div class="kt-portlet kt-portlet--mobile">


                        <div class="kt-portlet__body">
                        <div class="kt-portlet__head-toolbar text-right">
    @if(Auth::guard('admin')->user()->user_role->name=='admin')
    <a href="{{ url('admin/buyers?status=1') }}" class="btn btn-label-brand btn-bold btn-sm   @if(!empty(request()->status) && request()->status=='1') active @endif">Active ({{$active_count}})</a>
    @else
    <a href="{{ url('admin/buyers') }}" class="btn btn-label-brand btn-bold btn-sm   @if(empty(request()->status) || request()->status=='1') active @endif">Active ({{$active_count}})</a>
    @endif
    <a href="{{ url('admin/buyers?status=0') }}" class="btn btn-label-brand btn-bold btn-sm   @if(request()->status=='0') active @endif">Inactive ({{$inactive_count}})</a>
    @if(Auth::guard('admin')->user()->user_role->name=='admin')
    <a href="{{ route('buyer') }}" class="btn btn-label-brand btn-bold btn-sm   @if(!isset(request()->status)) active @endif">Past Bidder ({{$past_count}})</a>
    @endif
	</div></br>
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
        $(document).on('change', '.updateStatus', function()
        {

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
                success: function(res) {

                    $('div.flash-message').html(res.success);
                     alert(res.success);
                  $('.alert-text').html(res);
                   // if(success.status == 200){


                         //$('.alert-outline-success').show().delay(3000).fadeOut('fast');
                    //  $('.alert-outline-success .alert-text').html(res);
                       // $('#buyer-table').DataTable().draw(false);
                        //$('#tutor-table').DataTable().draw(false);
                   // }else{

                       // $('div.flash-message').html(res.success);


                       // $('#buyer-table').DataTable().draw(false);
                        //$('#tutor-table').DataTable().draw(false);

                    //}
                }
            })
        })
    </script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">

     $('.delete_buyer').click(function(event) {
        alert("hi");
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
             // form.submit();
            }
          });
      });

</script>



@endpush