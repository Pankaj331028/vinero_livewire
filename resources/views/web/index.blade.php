@extends('web.master')
@section('page_title',$page->page_title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_keywords)
@section('web.main')
<link rel="stylesheet" type="text/css" href="{{asset('web/css/mediaelementplayer.css')}}">
<!-- -- Banner -- -->
<div class="container-flud banner-main">
    <div class="container">
        <div class="row">
            <div class="col-md-7 text-center banner-left">
                <h1 class="main-heading">{!! $page->getChild('smart-offer-headingh1') !!}</h1>
                <p class="description">{!! $page->getChild('smart-offer-short-desc') !!}</p>
                <div class="toggle-button-cover">
                    <div class="button-cover">
                        <div class="button b2" id="button-10">
                            <input type="checkbox" class="checkbox chk" value="sell" />
                            <div class="knobs">
                                <span>Buy</span>
                            </div>
                            <div class="layer"></div>
                        </div>
                    </div>
                    <a class="btn primery startnow" href="javascript:void(0)">Start Now</a>
                </div>
                <img src="{{ asset('web/img/main-img.svg') }}" alt="main">
            </div>
            <div class="col-md-5 text-center banner-right">
                <img src="{{ asset('web/img/video_bg.svg ')}}" alt="video">
                <a class="btn primery" href="#how_it_works" data-bs-toggle="modal"><i class="bi bi-play-circle-fill"></i>See How It Works</a>
            </div>
        </div>
    </div>
</div>
<!-- -- Banner End -- -->
<!-- Selling -->
<div class="container-flud selling-main">
    <div class="container width-boxed">
        <div class="sub-heading">{!! $page->getChild('selling-title') !!}</div>
        <div class="row">
            <div class="col-md-6 selling-left listing">
                <h2 class="second-heading mb-5">{!! $page->getChild('selling-heading-h1') !!}</h2>
                {!! $page->getChild('selling-contant') !!}
                <a class="btn primery mt-5" href="{{ route('seller-dashboard') }}">Get Started</a>
            </div>
            <div class="col-md-6 selling-right">
                <img src="{{ asset('web/img/sellers_deshboard.png') }}" alt="Sellers Deshboard">
            </div>
        </div>
    </div>
</div>
<!-- Selling End -->
<!-- Buying -->
<div class="container-flud buying-main">
    <div class="container width-boxed">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="sub-heading">{!! $page->getChild('buying-title') !!}</div>
            </div>
        </div>
        <div class="row flex-row-reverse">
            <div class="col-md-6 buying-right listing">
                <h2 class="second-heading mb-5">{!! $page->getChild('buying-heading-h1') !!}</h2>
                {!! $page->getChild('buying-content') !!}
                <a class="btn primery mt-5" href="{{ route('buyer-dashboard') }}">Learn More</a>
            </div>
            <div class="col-md-6 buying-left">
                <img src="{{ asset('web/img/buyer_deshboard.png') }}" alt="Sellers Deshboard">
            </div>
        </div>
    </div>
</div>
<!-- Buying End -->
<!-- Smart Offers -->
<div class="container-flud smart-offers-main">
    <div class="container width-boxed">
        <div class="sub-heading">{!! $page->getChild('on-the-go-title') !!}</div>
        <div class="row">
            <div class="col-md-5 selling-right">
                <h2 class="second-heading mb-4">{!! $page->getChild('on-the-go-heading-h1') !!}</h2>
                <p class="description">{!! $page->getChild('on-the-go-short-desc') !!}</p>
                <a class="btn primery mt-3 mb-2" href="{{ route('buyer-dashboard') }}">Get Started</a>
                <img src="{{ asset('web/img/smart-offers-before.png') }}" alt="smart-offers">
            </div>
            <div class="col-md-7 selling-left">
                <img src="{{ asset('web/img/video_bg.svg') }}" alt="Videos">
            </div>
        </div>
    </div>
</div>
<!-- Smart Offers End -->
<!-- Qonectin -->
<div class="container-flud qonectin-main">
    <div class="container width-boxed">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="sub-heading">{!! $page->getChild('qonectin-title') !!}</div>
            </div>
        </div>
        <div class="row flex-row-reverse">
            <div class="col-md-6 qonectin-right listing">
                <h2 class="second-heading">{!! $page->getChild('qonectin-heading-h1') !!}</h2>
                {!! $page->getChild('qonectin-content') !!}
                <a class="btn primery" href="{{ route('create-account') }}">Learn More</a>
            </div>
            <div class="col-md-6 qonectin-left">
                <img src="{{ asset('web/img/qonectin-left.png') }}" alt="Sellers Deshboard">
            </div>
        </div>
    </div>
</div>
<!-- Qonectin End -->
<!-- FAQ's -->
{{-- <div class="container-flud faq-main">
    <div class="container width-boxed">
        <div class="row align-items-center">
            <div class="col-md-6 faq-left">
                <div class="sub-heading">FAQ</div>
                <div class="accordion accordion-flush" id="accordionFlushExample20">
                    @foreach ($faq as $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header @if($loop->first) is-active @endif " id="flush-heading{{$item->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$item->id}}" aria-expanded="false" aria-controls="flush-collapse">
                                {{ $item->faq_que ?? '' }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{$item->id}}" class="accordion-collapse collapse @if($loop->first) is-active @endif " aria-labelledby="flush-heading{{$item->id}}" data-bs-parent="#accordionFlushExample20">
                            <div class="accordion-body">
                                {{ $item->faq_ans ?? '' }}
                            </div>
                            <a class="faq-more faqQustion" href="javascript:void(0)" id="" value="{{$item->id}}">Read More </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="btn primery " href="{{ route('web-faq') }}">More Questions</a>
            </div>
            <div class="col-md-6 faq-right">
                <img src="{{ asset('web/img/faq-right.png') }}" alt="Sellers Deshboard">
            </div>
        </div>
    </div>
</div> --}}

  <!-- FAQ's -->
  <div class="container-flud faq-main">
    <div class="container width-boxed">
      <div class="row">
        <div class="col-md-7 mx-auto faq-left">
			<div class="sub-heading">FAQ</div>

				<div class="pb-4">
					<ul class="ps-0">
						@foreach ($Faq_category as $Faq_category_item)
						<li class="accordion-item bg-white p-2 cursor position-relative">
							<div class="row toggleClick" onClick="toggle({{ $Faq_category_item->id }},this)">
								<label class="cursor float-start w-80 ps-4" style="font-family: inherit;">
									{{ $Faq_category_item->category_name }} <span class="add">+</span> <span class="mins"></span>
								</label>
								<label class="float-end w-20 text-end cursor">
									<img src="{{ asset('web/img/bottom.svg') }}" alt="Show" style="width:20px;">
								</label>
							</div>
							<div id="{{ $Faq_category_item->id }}" class="position-absolute innerFAQ p-2 shadow dNone">
								<ul class="ps-0">
									@foreach ($faq as $faq_item)
									@if($Faq_category_item->id == $faq_item->faq_category_id)
									<li class="px-2 mb-2 bg-light cursor position-relative">
										<div class="row toggleClickInner" onclick="toggle({{ $faq_item->id }},this)">
											<p class="float-start w-80 font14 mb-0">{{  $faq_item->faq_que}}</p>
											<label class="float-end w-20 text-end cursor">
												<img src="{{ asset('web/img/bottom.svg') }}" alt="Show" style="width:20px;">
											</label>
										</div>
										<div id="{{ $faq_item->id }}" class="font14 p-2 shadow position-absolute nestedFAQ dNone">
											<p class="font14 mb-0">
												{!! $faq_item->faq_ans ?? '' !!}
											</p>
										</div>
									</li>
									@endif
									@endforeach
								</ul>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
      		
          <!-- <a class="btn primery" href="#">More Questions</a> -->
        </div>
        <div class="col-md-10 faq-right ms-auto text-right">
          <img src="{{ asset('web/img/faq-right.png') }}" alt="Sellers Deshboard" class="w-50">
        </div>
      </div>
    </div>
  </div>
  <!-- FAQ's End -->

<div class="modal fade" id="how_it_works" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <video width="100%" height="500" id="player1" autoplay loop muted preload controls>
                        <source src="{{asset($page->getChild('see-how-it-works-video'))}}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </form>
    </div>
</div>
</div>
<script src="{{asset('web/js/mediaelement-and-player.min.js')}}"></script>
<script>
$(document).ready(function() {


    var player = new MediaElementPlayer('#player1');

    $(".faqQustion").click(function() {
        var faqId = $(this).attr('value');

        const date = new Date();
        date.setTime(date.getTime() + (360 * 24 * 60 * 60 * 1000));
        let expires = "expires=" + date.toUTCString();
        document.cookie = "faq=" + faqId + ";" + expires + ";path=/";

        if (faqId != '') {
            window.location.href = "{{ route('web-faq')}}";
        }

    });

    $(".startnow").click(function() {
        window.location.href = "{{ route('web-buyer')}}";
        if ($('.chk').is(":checked")) {
            var seller = $("input[type='checkbox']").val();
            if (seller == 'sell') {
                window.location.href = "{{ route('web-seller')}}";
            }
        }
    });

});
</script>
<script>
    function toggle(idName,elem){
        if(!$('#'+idName).is(':visible') && $(elem).hasClass('toggleClick')){
            $('.innerFAQ').hide('slow');
            $('.innerFAQ').closest('.accordion-item').find('.toggleClick.activeToggle').toggleClass("activeToggle");
            $('.innerFAQ').closest('.accordion-item').find('.toggleClick.add').toggleClass("add");
        }
        else if(!$('#'+idName).is(':visible') && $(elem).hasClass('toggleClickInner')){
            $('.nestedFAQ').hide('slow');
            $('.nestedFAQ').closest('.accordion-item').find('.toggleClickInner.activeToggle').toggleClass("activeToggle");
            $('.nestedFAQ').closest('.accordion-item').find('.toggleClickInner.add').toggleClass("add");
        }
        $('#'+idName).slideToggle();
    }
    
    $(document).ready(function(){
    $(".toggleClick").click(function () {
    $(this).toggleClass("activeToggle");
	$(this).toggleClass("add");
    });

    $(".toggleClickInner").click(function () {
    $(this).toggleClass("activeToggle");
    });
    });
</script>
@endsection
