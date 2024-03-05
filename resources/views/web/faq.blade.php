@extends('web.master')
@section('web.main')
  <!-- -- Banner -- -->
  <div class="container-flud banner-main pb-0">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12 text-center banner-left">
          <h1 class="main-heading">Faq...</h1>
          <p class="description"></p>
        </div>
      </div>
    </div>
  </div>
  <!-- -- Banner End -- -->
   <!-- FAQ's -->
  <div class="container-flud faq-main for-faq-page">
    <div class="container width-boxed">
      <div class="row align-items-center">
        <div class="col-md-12 faq-left">
          <div class="sub-heading">FAQ</div>
          <div class="accordion accordion-flush z95" id="accordionFlushExample20">

            @foreach ($faq as $item)
             {{-- Session::get('faqId')  --}}
            <div class="accordion-item">             
              <h2 class="accordion-header @if($loop->first) is-active @endif @if($value == $item->id ) is-active @endif " id="flush-heading{{$item->id}}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$item->id}}" aria-expanded="false" aria-controls="flush-collapse">
                  {{ $item->faq_que ?? '' }}
                </button>
              </h2>
              <div id="flush-collapse{{$item->id}}" class="accordion-collapse collapse @if($loop->first) is-active @endif @if($value == $item->id) show @endif " aria-labelledby="flush-heading{{$item->id}}" data-bs-parent="#accordionFlushExample20">
                <div class="accordion-body">
                   {{ $item->faq_ans ?? '' }}
                </div>
                {{-- <a class="faq-more" href="{{route('web-faq')}}">Read More</a> --}}
              </div> 
            </div>
            @endforeach
            
          </div>
          {{-- <a class="btn primery" href="#">More Questions</a> --}}
        </div>
      </div>
    </div>
  </div>
  @endsection
  