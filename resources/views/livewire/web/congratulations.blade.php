<div class="container-flud card-full-cover">
    <div class="">
        <div class="">
            <section class="tabs-wrapper buyer-offer-dashboard-in">
                <div class="tabs-container">
                    <div class="tabs-block congratulations">
                        <div id="tabs-section" class="tabs contact-form mx-auto position-relative">
                            <div>
                                <div class="position-absolute congratulationImg">
                                    <img src="{{ asset('web/img/certificate.png') }}" alt="">
                                </div>
                            </div>

                            <section id="buyer-my-offer" class="cPadding tab-body entry-content active active-content card-box mx-auto w-100">
                                @include('web.common.notification-profile-icone')
                                <div class="container">
                                    <div class="row justify-content-end z96">
                                        <div class="byuyer-fooer-profile text-end">
                                            {{-- <div class="offer-confirm-congratulations">
                                                <img class="w-auto" src="{{ asset('web/img/offer-confirm-congratulations.png') }}">
                                                <div class="card-box w-auto text-center m-auto">
                                                    <h2 class="green-second-heading">CONGRATULATIONS!</h2>
                                                    <h3 class="green-three-heading">The seller accepted your Smart Offer</h3>
                                                </div>
                                            </div> --}}
                                            {{-- <img src="{{ asset('web/img/certificate.png') }}" alt=""> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row represented-out">
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history px-3 py-4 offerAccepted">
                                                <h6>OFFER ACCEPTED</h6>
                                                <div class="card-box history offer-confirm-topspace">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Purchase price</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular seller-brokerage feedback-input" placeholder="$" value={{ $this->getSetting('currency') .number_format($purchase_price) ?? '' }} disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Transaction coordinator</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular seller-brokerage feedback-input" placeholder="Name Phone number Email address" value={{ $transaction_coordinator ?? '' }} disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label>Your transaction coordinator will follow up with your transaction documents.</label>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>EMD (deposit)</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular seller-brokerage feedback-input" placeholder="$" value={{ $this->getSetting('currency').number_format($emd_deposit).' within 3 days' ?? '' }} disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow number</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular seller-brokerage feedback-input" placeholder="$" value={{ $escrow_number ?? '' }} disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow officer</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular seller-brokerage feedback-input" placeholder="Name Phone number Email address" value={{ $escrow_officer ?? '' }} disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history px-3">
                                                <h6 class="pb-5"></h6>
                                                <label class="offer-confirm-topspace offer-confirm-topspace-none">Please deposit funds to escrow and be alert to comply with important contract dates.</label>
                                                <!-- for desktop view -->
                                                <div class="d-none d-md-block">
                                                    <div class="row action-head px-2 pt-3">
                                                        <div class="col-md-4">
                                                            <h3>ACTION NEEDED</h3>
                                                        </div>
                                                        <div class="col-md-4 text-center">
                                                            <h3>WITHIN</h3>
                                                        </div>
                                                        <div class="col-md-4 text-center">
                                                            <h3>DUE DATE</h3>
                                                        </div>
                                                    </div>
                                                    <div class="card-box history mt-0">
                                                        <div class="row py-2">
                                                            <div class="col-md-4">
                                                                <label>Initial deposit to escrow</label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $initial_deposit_escrow_days ?? '' }}</b></label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $initial_deposit_escrow_date ?? '' }}</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row py-2">
                                                            <div class="col-md-4">
                                                                <label>Seller's contractual disclosures</label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $contractual_disclosures_days ?? '' }}</b></label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $contractual_disclosures_date ?? '' }}</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row py-2">
                                                            <div class="col-md-4">
                                                                <label>Loan contingency removal</label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $loan_contingency_days ?? '' }}</b></label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $loan_contingency_date ?? '' }}</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row py-2">
                                                            <div class="col-md-4">
                                                                <label>Inspections contingency removal</label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $inspections_contingency_days ?? '' }}</b></label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $inspections_contingency_date ?? '' }}</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row py-2">
                                                            <div class="col-md-4">
                                                                <label>Title review</label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $title_review_days ?? '' }}</b></label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $title_review_date ?? '' }}</b></label>
                                                            </div>
                                                        </div>
                                                        <div class="row py-2">
                                                            <div class="col-md-4">
                                                                <label>Close of escrow</label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $close_of_escrow_days ?? '' }}</b></label>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <label class="gibson-regular"><b>{{ $close_of_escrow_date ?? '' }}</b></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- for mobile view -->
                                                <div class="d-md-none d-sm-block">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">ACTION NEEDED</label>
                                                            <label>Initial deposit to escrow</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">WITHIN</label>
                                                            <label class="gibson-regular">{{ $initial_deposit_escrow_days ?? '' }}</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">DUE DATE</label>
                                                            <label class="gibson-regular">{{ $initial_deposit_escrow_date ?? '' }}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">ACTION NEEDED</label>
                                                            <label>Seller's contractual disclosures</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">WITHIN</label>
                                                            <label class="gibson-regular">{{ $contractual_disclosures_days ?? '' }}</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">DUE DATE</label>
                                                            <label class="gibson-regular">{{ $contractual_disclosures_date ?? '' }}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">ACTION NEEDED</label>
                                                            <label>Loan contingency removal</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">WITHIN</label>
                                                            <label class="gibson-regular">{{ $loan_contingency_days ?? '' }}</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">DUE DATE</label>
                                                            <label class="gibson-regular">{{ $loan_contingency_date ?? '' }}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">ACTION NEEDED</label>
                                                            <label>Inspections contingency removal</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">WITHIN</label>
                                                            <label class="gibson-regular">{{ $inspections_contingency_days ?? '' }}</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">DUE DATE</label>
                                                            <label class="gibson-regular">{{ $inspections_contingency_date ?? '' }}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">ACTION NEEDED</label>
                                                            <label>Title review</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">WITHIN</label>
                                                            <label class="gibson-regular">{{ $title_review_days ?? '' }}</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">DUE DATE</label>
                                                            <label class="gibson-regular">{{ $title_review_date ?? '' }}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">ACTION NEEDED</label>
                                                            <label>Close of escrow</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">WITHIN</label>
                                                            <label class="gibson-regular">{{ $close_of_escrow_days ?? '' }}</label>
                                                        </div>
                                                        <div class="col-md-12 mt-2">
                                                            <label class="survey-feed-dis">DUE DATE</label>
                                                            <label class="gibson-regular">{{ $close_of_escrow_date ?? '' }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="continue-transaction text-center">
                                    {{-- <button class="btn tabs-submit-buttons">GO BACK TO MAIN DASHBOARD</button> --}}
                                    <a class="btn tabs-submit-buttons" href="{{ route('buyer-survey') }}">COMPLETE SURVEY</a>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
