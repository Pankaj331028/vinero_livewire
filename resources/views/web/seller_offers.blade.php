@extends('web.master-no-header')
@section('page_title','Buyer Offers')
@section('web.main')
<div class="container-flud card-full-cover">
    <div>
        <div class="row card-box buyer-offer-dashboard">
            <section class="tabs-wrapper buyer-offer-dashboard-in pe-0">
                <div class="tabs-container">
                    <div class="tabs-block">
                        @livewire('web.seller-offer',['id'=>$id??null])
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
