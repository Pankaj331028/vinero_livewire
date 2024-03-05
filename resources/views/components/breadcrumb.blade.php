<!-- begin:: Content Head -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            {{$title}}
        </h3>
        <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
            <a href="{{route('index')}}" class="kt-subheader__breadcrumbs-home">
                <i class="flaticon-home"></i>
            </a>
           
	            @if(!empty($module))
	            <span class="kt-subheader__breadcrumbs-separator"></span>
	            <a href="{{$link}}" class="kt-subheader__breadcrumbs-link text-capitalize">
	                {{$module}} 
	            </a>
	            @endif
	            <span class="kt-subheader__breadcrumbs-separator"></span>
	            <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{$title}}</span>
	     
        </div>
    </div>
</div>
<!-- end:: Content Head -->
