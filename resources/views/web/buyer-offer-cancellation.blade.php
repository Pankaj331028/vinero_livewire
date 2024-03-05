@extends('web.master-no-header')
@section('page_title','Offer Cancellation Confirmation')
@section('web.main')
<div class="container-flud card-full-cover">
    <div class="">
        <div class="row  buyer-offer-dashboard">
            <section class="tabs-wrapper buyer-offer-dashboard-in">
                <div class="tabs-container">
                    <div class="tabs-block">
                        <div id="tabs-section" class="tabs contact-form">
                            <section id="buyer-my-offer" class="tab-body entry-content active active-content card-box w-100">
                                <div class="row justify-content-end offerCancellation">
                                    <div class="byuyer-fooer-profile text-end">
                                        {{-- @include('web.common.notification-profile-icone') --}}
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row represented-out offerCancellation">
                                        <div class="card-box text-center pt-0">
                                            <div class="row justify-content-center">
                                                <div class="col-md-6 text-center">
                                                    <img class="w-auto mb-5" src="{{ asset('web/img/offer-confirm.png') }}">
                                                    <h2 class="green-second-heading mb-4 gibson-medium">Offer cancellation confirmation</h2>
                                                    <div class="white-box histort">
                                                        <label class="green-label">We received and processed your offer withdrawal. This notice confirms that the offer is cancelled, null and void, and all parties, buyer, seller and participating brokers agree to mutually release each other from liability in connection with this transaction.</label>
                                                    </div>
                                                    <label class="mt-4">This concludes the biding process. </br>We look forward to seeing you on your next VMS offer.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                <div class="continue-transaction text-center">
                                    <a class="btn tabs-submit-buttons" href="{{ route('buyer-survey') }}">COMPLETE SURVEY</a>
                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    setTimeout(() => {
        window.location.href = "{{ route('weblogout')}}";
    }, 5000);
});

</script> --}}
@endsection
