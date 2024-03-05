@extends('web.master_old')
@section('web.main')
<style>
  .survey-dashboard {
    padding: 27px 0px;
    background: #212529;
}
.survey-welcome h2 {
  color: #efdb4d;
    font-family: futuramedium;
  }
.survey-subsection {
    background: #f6f5e3;
    padding: 25px 0px;
}
.survey-subsection p {
    font-size: 18PX;
    text-align: center
}

.survey-question {
    display: flex !important;
    list-style: none;
    justify-content: space-between;
}

.survey-question li a:hover{
  color: #000
}
.survey-question li a {
    box-sizing: border-box;
    width: 40px;
    height: 40px;
    border: 1px solid #aba895;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 25px;
}
.quiz-question {
    font-family: futura;
    font-size: 23px;
}
.Circle-button.active {
    background: #f4df4e;
    font-family: futuramedium;
}
.warningbutton{
  font-size: 25px;
  font-family: Futurabold;
}
.spantop {
    font-size: 14px;
}
@media(max-width:767.98px) {
  .spantop {
    font-size: 15px;
}
.quiz-question {
    font-size: 20px;
}
.survey-question li a {
    width: 40px;
    height: 40px;
    font-size: 20px;
}
.warningbutton {
    font-size: 20px;
}
.survey-welcome h2 {
    font-size: 25px;
}
.survey-dashboard {
    padding: 20px 0px;
}
}
@media(max-width:575.98px) {
.survey-question {
    padding: 0;
    justify-content: space-around;
}
.survey-question li a {
    width: 30px;
    height: 30px;
    font-size: 15px;
}
.spantop {
    font-size: 14px;
}
.quiz-question {
    font-size: 18px;
    font-family: 'futura';
    font-weight: 700;
}
.warningbutton {
    font-size: 16px;
}
.survey-subsection p {
    font-size: 20px;
    text-align: center;
}
.survey-welcome h2 {
    font-size: 22px;
}
.survey-dashboard {
    padding: 18px 0px;
}
}
@media(max-width: 479.98px) {
  .quiz-question {
    font-size: 16px;
    font-family: 'futura';
    font-weight: 600;
}
.client-review-this {
    padding: 0;
}
.spantop {
    font-size: 10px;
}
.survey-welcome h2 {
    font-size: 20px;
}
.survey-dashboard {
    padding: 15px 0px;
}
}
#offer-info table {
    width: 100%;
}
#offer-info table td {
    border: 1px solid #ddd;
    padding: 7px;
    font-size: 18px;
    font-weight: 400;
}
.offer-close button {
    background: #f0e04d;
    font-size: 16px;
}
</style>
<input type="hidden" name="" id="control_monitor" value="{{$user->optin_out}}">
<div class="parent-toolsection">
  <section class="welcome-dashboard">
    <div class="container">
      <div class="buyer-welcome">
        <h3>Welcome <br><strong class="strong-text">Buyer Dashboard</strong></h3>
        <span class="location-span"><img src="{{asset('web/images/location.png')}}" alt="img of locatoin" class="location-img">{{$dashboard->property_address ?? ''}}</span>
      </div>
    </div>
  </section>
  <section class="offer-deadline">
    <div class="container">
      <div class="row offer">
        <div class="col-md-6 ">
          {{-- <button type="button" onclick="startFCM()"> allow notification</button> --}}
            <span class="offer-span">Offer Deadline</span><br><br>
            <span><i class="fa-solid fa-calendar" class="calender-icon"></i> <strong class="timetext">&nbsp;&nbsp;{{$dashboard->deadline ?? ''}}</strong>&nbsp;&nbsp;</span>
        </div>
        {{-- @csrf
        <a href="{{route('download-pdf')}}" target="_blank">Download PDF</a>  --}}
        <div class="col-md-6 more-button">
          <button type="button" class="btn bg-white mr-2 px-4" data-bs-toggle="modal" data-bs-target="#offer-info">More
          </button>
          <div class="modal fade" id="offer-info" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4>Offer Details</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                    <table>
                      <tr>
                        <td>Buyer's agent</td>
                        <td>{{$dashboard->agent_name }}</td>
                      </tr>
                      <tr>
                        <td>Your current bid</td>
                        <td>{{ '$ '.$dashboard->offered_price }}</td>
                      </tr>
                      <tr>
                        <td>Financial qualifications</td>
                        <td>{{ '$ '.$dashboard->proof_funds }}</td>
                      </tr>
                      <tr>
                        <td>Bid per square feet</td>
                        <td>{{ '$ '.$dashboard->bid_per_sqfeet }}</td>
                      </tr>
                      <tr>
                        <td>Est Mortgage Payment<br><span>(verify with your lender)</span></td>
                        <td>{{ '$ '.$dashboard->mortgage_loan }}</td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-12 mt-5 text-center offer-close">
                    <button type="button" class="btn p-2 px-5" data-bs-dismiss="modal" aria-label="Close">OK</button>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            </div>

            <label class="dropdowntt ">
              <div class="dd-button action-btn">
                Actions
              </div>
              <input type="checkbox" class="dd-input" id="test">
              <ul class="dd-menu action-hide " id="action-hid">
                <li ><a href="{{route('offer')}}">My Offer</a> </li>
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#modify-offer">Modify Offer</a> </li>
                @if ($property->agent_id == null)
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#buyer-control-monitor2">Opt In / Out</a> </li>
                @else
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#buyer-control-monitor3">Opt In / Out</a> </li>
                @endif

              </ul>
            </label>
        </div>

      </div>
      <div class="row types-list">
        <div class="col-md-8 offer-price">
          <img src="{{asset('web/images/uploaa.png')}}" alt="image of offer" class="offer-listimg">
          <div class="boxdiv">
            <p class="text-p">Offer uploaded</p>
            <span class="offer-span">{{$dashboard->offered_price ?? ''}}</span>
          </div>
        </div>
        <div class="col-md-4 time-list">
          <small class="date&time ">{{$dashboard->submitted_on ?? ''}}</small>
        </div>
      </div>
      <div class="row types-list">
        <div class="col-md-8 offer-price">
          <img src="{{asset('web/images/envelope.png')}}" alt="image of offer" class="offer-listimg">
            <span class="offer-span">Offer emailed to Seller and Agent</span>
        </div>
        <div class="col-md-4 time-list">
          <small class="date&time ">{{$dashboard->dashboard_dates->email_recevied ?? ''}}</small>
        </div>
      </div>
      @if($dashboard->dashboard_dates->improved_on != "")
      <div class="row types-list">
        <div class="col-md-8 offer-price">
          <img src="{{asset('web/images/pr.png')}}" alt="image of offer" class="offer-listimg">
          <div class="boxdiv">
            <p class="text-p">Offer Price Improved</p>
            <span class="offer-span">$1,675,000</span>
          </div>
        </div>
        <div class="col-md-4 time-list">
          <small class="date&time ">{{$dashboard->dashboard_dates->improved_on ?? ''}}</small>
        </div>
      </div>
      @endif
      @if($dashboard->dashboard_dates->notified_on != "")
      <div class="row types-list">
        <div class="col-md-8 offer-price">
          <img src="{{asset('web/images/pr.png')}}" alt="image of offer" class="offer-listimg">
          <div class="boxdiv">
            <p class="text-p">Offer notified to seller agent</p>
          </div>
        </div>
        <div class="col-md-4 time-list">
          <small class="date&time ">{{$dashboard->dashboard_dates->notified_on ?? ''}}</small>
        </div>
      </div>
      @endif
      @if($dashboard->dashboard_dates->withdrawan_on != "")
      <div class="row types-list">
        <div class="col-md-8 offer-price">
          <img src="{{asset('web/images/withdrawn.png')}}" alt="image of offer" class="offer-listimg">
          <span class="offer-span">Offer Withdrawn</span>
        </div>
        <div class="col-md-4 time-list">
          <small class="date&time ">{{$dashboard->dashboard_dates->withdrawan_on ?? ''}}</small>
        </div>
      </div>
      @endif
      @if($dashboard->dashboard_dates->offer_accepted != "")
      <div class="row types-list">
        <div class="col-md-8 offer-price">
          <img src="{{asset('web/images/Conterg.png')}}" alt="image of offer" class="offer-listimg">
          <span class="offer-span">Congratulations ! <span class="soanoff">The seller has Ac...</span> </span>
        </div>
        <div class="col-md-4 time-list">
          <small class="date&time ">{{$dashboard->dashboard_dates->offer_accepted ?? ''}}</small>
        </div>
      </div>
      @endif
      @if($dashboard->dashboard_dates->financial_improved != "")
      <div class="row types-list">
        <div class="col-md-8 offer-price">
          <img src="{{asset('web/images/withdrawn.png')}}" alt="image of offer" class="offer-listimg">
          <span class="offer-span">Offer Financial Improved</span>
        </div>
        <div class="col-md-4 time-list">
          <small class="date&time ">{{$dashboard->dashboard_dates->financial_improved ?? ''}}</small>
        </div>
      </div>
      @endif
      @if($dashboard->dashboard_dates->counter_on != "")
      <div class="row types-list">
        <div class="col-md-8 offer-price">
          <img src="{{asset('web/images/withdrawn.png')}}" alt="image of offer" class="offer-listimg">
          <span class="offer-span">Counter Offer</span>
        </div>
        <div class="col-md-4 time-list">
          <small class="date&time ">{{$dashboard->dashboard_dates->counter_on ?? ''}}</small>
        </div>
      </div>
      @endif
    </div>
  </section>
</div>
<div wire:ignore.self class="modal fade" id="modify-offer" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    @livewire('web.buyer.bid-modification')
  </div>
</div>
<div wire:ignore.self class="modal fade" id="buyer-control-monitor3" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    @livewire('web.buyer.control-monitor')
  </div>
</div>
<div wire:ignore.self class="modal fade" id="buyer-control-monitor2" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    @livewire('web.buyer.control-monitor', ['monitor'=>'noAgent'])
  </div>
</div>
<div wire:ignore.self class="modal fade" id="buyer-offerOfintrest" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    @livewire('web.buyer.control-monitor', ['monitor'=>'offer-of-intrest'])
  </div>
</div>
{{-- ------------ No sale alert  --------------- --}}
<div wire:ignore.self class="modal fade" id="no-sale" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>NO sale</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 250px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">

              <div class="row model-header-info" id="no-sale-title">

              </div>

            <div class="row mt-3">
              <div class="col-md-12" id="no-sale-body">

              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- -------Higher offer received ----------- --}}
<div wire:ignore.self class="modal fade" id="higher-offer-received" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Heigher offer received</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest">
              <div class="row model-header-info">
                  <div class="col-md-12">
                      <label for="" class="col-form-label offerlabel">
                        This is a courtesy message, a heigher offer has been received, do you want to improve your bid by a
                        $16,200 minimum?
                      </label>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-6">
                    Your current bid
                  </div>
                  <div class="col-md-6">
                    $1650000
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Financial qualifications
                </div>
                <div class="col-md-6">
                  $1700000
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Bid per square feet
              </div>
              <div class="col-md-6">
                $1005
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Est mortgage payment (Verify with your lender)
              </div>
              <div class="col-md-6">
                $4152
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id=""> &nbsp;&nbsp;&nbsp;Improve my offer $1650000
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp; Improve my offer to
              </div>
            </div>
              <div class="row mt-3">
                <div class="col-md-12">
                  <input type="text" name="" id="" class="form-control" wire:model="">
                </div>
              </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp;No action
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-1">
                <input type="checkbox" class="accent-color" name="" id="">
              </div>
              <div class="col-md-11">
                I'm not longer interested, please withdraw my offer and close my file
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                By clicking below I hereby consent to use electronic documents and signatures in connection with the
                purchase of this property
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- ----------Offer accept------------- --}}
<div wire:ignore.self class="modal fade" id="offer-accept" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Heigher offer received</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest" class="text-center">
              <div class="row model-header-info">
                  <div class="col-md-12" style="background: white; text-align: center;">
                      <img src="{{asset('web/images/checkcong.png')}}" alt="" class="ok-icon">
                  </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <p><h3>Thank You</h3></p>
                  <p><h5>For your offer</h5></p>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12">
                  An offer was received with terms agreed and accepted by the seller, the property is now in contract.
                </div>
              </div>
            <div class="row mt-3">
              <div class="col-md-12">
                This concludes the bidding process. We enjoyed working with you
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
          {{-- <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal" style="width: 100px;">Ok</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- ------------Offer deadline extension----- --}}
<div wire:ignore.self class="modal fade" id="offer-deadline-extension" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Offer deadline extension</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest">
              <div class="row model-header-info">
                  <div class="col-md-12">
                      <label for="" class="col-form-label offerlabel" id="notification-body">

                      </label>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-6">
                    Your current bid
                  </div>
                  <div class="col-md-6">
                    $1650000
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Financial qualifications
                </div>
                <div class="col-md-6">
                  $1700000
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Bid per square feet
              </div>
              <div class="col-md-6">
                $1005
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Est mortgage payment (Verify with your lender)
              </div>
              <div class="col-md-6">
                $4152
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp;Confirm my offer $1650000
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp;Improve my offer to
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">

                <input type="text" class="form-control" name="" id="" wire:model="">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp;No action
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-1">
                <input type="checkbox" class="accent-color" name="" id="">
              </div>
              <div class="col-md-11">
                I'm not longer interested, please withdraw my offer and close my file
              </div>
            </div>
            <hr>
            <div class="row mt-3">
              <div class="col-md-12">
                By clicking below I hereby consent to use electronic documents and signatures in connection with the
                purchase of this property
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- ------------ Offer Cancel --------------- --}}
<div wire:ignore.self class="modal fade" id="offer-cancel" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Heigher offer received</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 420px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest" class="text-center">
              <div class="row model-header-info">
                  <div class="col-md-12" style="background: white; text-align: center;">
                      <img src="{{asset('web/images/cancel_done.png')}}" alt="" class="ok-icon">
                  </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <p><h3>Offer cancellation</h3></p>
                  <p><h4>Confirmation</h4></p>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12">
                  We received and processed your offer withdrawal, This notice confirms hat the offer is cancelled, null
                  and vold and all parties, Buyer, Seller and paricipating brokers agree to mutually
                  release each other from liability in connection with this ransaction
                </div>
              </div>
            <div class="row mt-3">
              <div class="col-md-12">
                This concludes the bidding process. We enjoyed working with you
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
          {{-- <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal" style="width: 100px;">Ok</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- ------------ Incomplete Offer --------------- --}}
<div wire:ignore.self class="modal fade" id="incomplete-offer" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Incomplete offer</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 250px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest" class="text-center">
              <div class="row model-header-info">
                 Your offer is important to us please take a few minutes to revise and resubmit.
              </div>

              <div class="row mt-3">
              <div class="col-md-12">
                <ul>1. Buyer's offer terms</ul>
                <ul>2. Buyer's financial credentials
                  <li><span id="fc">Proof of funds to close the transaction: bank statements, etc.</span></li>
                  <li><span id="proof_funds">Direct lender pre-aproval letter we received your offer and noticed</span></li>
                </ul>
                </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-12">
                *missing information please complete and resubmit.
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
          {{-- <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
          <a href="{{route('offer')}}" class="btn btn-primary web-button" data-bs-dismiss="modal" style="width: 100px;">Revice Offer</a>
      </div>
      </form>
  </div>
  </div>
</div>
{{--------------Offer not accepted by seller ---------------}}
<div wire:ignore.self class="modal fade" id="offerNotAccepted" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Heigher offer received</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 350px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest" class="text-center">
              <div class="row model-header-info">
                  <div class="col-md-12" style="background: white; text-align: center;">
                      <img src="{{asset('web/images/cancel_done.png')}}" alt="" class="ok-icon">
                  </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <p><h3 id="notification_title"></h3></p>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12">
                  <p id="notification_description"></p>
                  <p id="date_time"></p>
                </div>
                <div class="col-md-12">
                  <a href="" class="btn btn-primary web-button" id="action"> View Offer</a>
                </div>
              </div>
            <div class="row mt-3">
              <div class="col-md-12">
                This concludes the bidding process. We enjoyed working with you
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
          {{-- <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal" style="width: 100px;">Ok</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{--------------Offer accepted by seller ---------------}}
<div wire:ignore.self class="modal fade" id="offerAccepted" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Heigher offer received</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 300px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest" class="text-center">
              <div class="row model-header-info">
                  <div class="col-md-12" style="background: white; text-align: center;">
                      <img src="{{asset('web/images/checkcong.png')}}" alt="" class="ok-icon">
                  </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <p><h3 id="notification_title"></h3></p>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12">
                  <p id="notification_description"></p>
                  <p id="date_time"></p>
                </div>
                <div class="col-md-12">
                  <a href="" class="btn btn-primary web-button" id="action"> View Offer</a>
                </div>
              </div>
            <div class="row mt-3">
              <div class="col-md-12">
                This concludes the bidding process. We enjoyed working with you
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer" style="justify-content: center;">
          {{-- <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal" style="width: 100px;">Ok</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- -----Bid highest and best offer----------- --}}
<div wire:ignore.self class="modal fade" id="Bid-highest-best-offer" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Heigher offer received</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest">
              <div class="row model-header-info">
                  <div class="col-md-12">
                      <label for="" class="col-form-label offerlabel">
                        This is a courtesy message, Seller received multiple offers and kindly request you to submit your "<b>Highest and best</b>"
                        <br>
                        offer are now due by <b>Feb 22,2022 at 5PM</b>
                      </label>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-6">
                    Your current bid
                  </div>
                  <div class="col-md-6">
                    $1650000
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Financial qualifications
                </div>
                <div class="col-md-6">
                  $1700000
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Bid per square feet
              </div>
              <div class="col-md-6">
                $1005
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Est mortgage payment (Verify with your lender)
              </div>
              <div class="col-md-6">
                $4152
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp;Confirm my offer $1651000
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp; Improve my offer $1650000
              </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                  <input type="text" name="" id="" class="form-control" wire:model="">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-1">
                <input type="checkbox" class="accent-color" name="" id="">
              </div>
              <div class="col-md-11">
                I'm not longer interested, please withdraw my offer and close my file
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                By clicking below I hereby consent to use electronic documents and signatures in connection with the
                purchase of this property
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- -----counter offer------------ --}}
<div wire:ignore.self class="modal fade" id="counter-offer" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Counter Offer</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest">
              <div class="row model-header-info">
                  <div class="col-md-12">
                      <label for="" class="col-form-label offerlabel" id="title">

                      </label>
                  </div>
              </div>
              <div class="row model-header-info">
                <div class="col-md-12">
                    <label for="" class="col-form-label offerlabel" id="body">

                    </label>
                </div>
            </div>
              <div class="row mt-3">
                  <div class="col-md-6">
                    Price to be
                  </div>
                  <div class="col-md-6">
                    $1650000
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Other terms and conditions
                </div>
                <div class="col-md-6">
                  <u><a href="">None/More ></a></u>
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Your current bid
              </div>
              <div class="col-md-6">
                $1650000
              </div>
          </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Financial qualifications
                </div>
                <div class="col-md-6">
                  $1700000
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Bid per square feet
              </div>
              <div class="col-md-6">
                $1005
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Est mortgage payment (Verify with your lender)
              </div>
              <div class="col-md-6">
                $4152
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id=""> &nbsp;&nbsp;&nbsp;I accept counter
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp; I counter to counter
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp; I hereby withdraw my offer
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                By clicking below I hereby consent to use electronic documents and signatures in connection with the
                purchase of this property
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- ------ Counter Offer other terms and conditions-------- --}}
<div wire:ignore.self class="modal fade" id="counter-offer-tc" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Other terms and condition</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest">
              <div class="row model-header-info">
                  <div class="col-md-12">
                      <label for="" class="col-form-label offerlabel">
                        Seller hereby makes the following counter offer
                      </label>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-6">
                    Close to Escrow within (days)
                  </div>
                  <div class="col-md-6">
                    21
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Inspections and prop condition (days)
                </div>
                <div class="col-md-6">
                 10
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Loan contingency (days)
              </div>
              <div class="col-md-6">
                10
              </div>
          </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Escrow company
                </div>
                <div class="col-md-6">
                    Doma
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Escrow number
              </div>
              <div class="col-md-6">
                2123456789
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Escrow officer
              </div>
              <div class="col-md-6">
                Manoj sharma
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Contact information
              </div>
              <div class="col-md-6">
                125-159-156
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Multiple counter offer
              </div>
              <div class="col-md-6">
                <input type="radio" name="" id=""> Yes&nbsp;&nbsp;&nbsp;
                <input type="radio" name="" id="">No
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Other terms
              </div>
              <div class="col-md-6">
                <u>Click here to view and approve</u>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-1">
                <input type="checkbox" name="" id="">
              </div>
              <div class="col-md-11">
                I agree
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                By clicking below I hereby consent to use electronic documents and signatures in connection with the
                purchase of this property
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- ----------Counter to counter offer------------- --}}
<div wire:ignore.self class="modal fade" id="counter-to-counter-offer" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Counter to counter offer</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest">
              <div class="row mt-3">
                  <div class="col-md-6">
                    Price
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="" id="" class="form-control" wire:model="price">
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Close to escrow (Days)
                </div>
                <div class="col-md-6">
                  <input type="text" name="" id="" class="form-control" wire:model="days">
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Inspections and prop condition (Days)
              </div>
              <div class="col-md-6">
                <input type="text" name="" id="" class="form-control" wire:model="inspection">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Loan contingency (Days)
              </div>
              <div class="col-md-6">
                <input type="text" name="" id="" class="form-control" wire:model="loam">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Escrow company
              </div>
              <div class="col-md-6">
                <input type="text" name="" id="" class="form-control" wire:model="company">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Contact info
              </div>
              <div class="col-md-6">
                <input type="text" name="" id="" class="form-control" wire:model="contact">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Escrow officer
              </div>
              <div class="col-md-6">
                <input type="text" name="" id="" class="form-control" wire:model="officer">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Other terms
              </div>
              <div class="col-md-6">
                <textarea name="" id="" cols="30" rows="10"></textarea>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-1">
                <input type="checkbox" name="" id="">
              </div>
              <div class="col-md-11">
                I agree
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                By clicking below I hereby consent to use electronic documents and signatures in connection with the
                purchase of this property
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- -------Offer not accept ------------------ --}}
<div wire:ignore.self class="modal fade" id="offer-not-accept" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Offer not accepted</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest">
              <div class="row model-header-info">
                  <div class="col-md-12">
                      <label for="" class="col-form-label offerlabel text-danger">
                        2-22-2022 Your offer was not accepted!
                        Selller encourages you to reevaluate your comparables and submit an improved offer
                      </label>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-6">
                    Your current bid
                  </div>
                  <div class="col-md-6">
                    $1650000
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  Financial qualifications
                </div>
                <div class="col-md-6">
                  $1700000
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Bid per square feet
              </div>
              <div class="col-md-6">
                $1005
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Est mortgage payment (Verify with your lender)
              </div>
              <div class="col-md-6">
                $4152
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id="">&nbsp;&nbsp;&nbsp; Improve my offer
              </div>
            </div>
              <div class="row mt-3">
                <div class="col-md-12">
                  <input type="text" name="" id="" class="form-control" wire:model="">
                </div>
              </div>
            <div class="row mt-3">
              <div class="col-md-1">
                <input type="checkbox" class="accent-color" name="" id="">
              </div>
              <div class="col-md-11">
                I'm not longer interested, please withdraw my offer and close my file
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                By clicking below I hereby consent to use electronic documents and signatures in connection with the
                purchase of this property
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <input type="checkbox" class="accent-color" name="" id=""> &nbsp;&nbsp;&nbsp; I agree
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- ------------ accept offer by seller----------- --}}
<div wire:ignore.self class="modal fade" id="offer-not-accept" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Offer not accepted</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
      <div class="row" style="margin-right: 10px; margin-left: 10px;">
          <form wire:submit.prevent="submitOfferInterest">
              <div class="row model-header-info">
                  <div class="col-md-12">
                      <label for="" class="col-form-label offerlabel">
                       Please fund escrow and be alert to comply with important contract dates.
                      </label>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-12">
                  <table>
                    <thead>
                      <tr>
                        <td>Action needed</td>
                        <td>Within</td>
                        <td>Calender day due</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Seller's contractual disclosures</td>
                        <td>3 Days</td>
                        <td>Mon Feb 12, 2022</td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  EMD (Deposit)
                </div>
                <div class="col-md-6">
                  $350000 within 3 days
                </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Escrow number
              </div>
              <div class="col-md-6">
                32658 days
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Escrow officer <br>
                415.123.4567 -escraw@gmail.com
              </div>
              <div class="col-md-6">
                Anne efficient
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-6">
                Transaction cordinator <br>
                415.123.4567 -tran@vinero.com
              </div>
              <div class="col-md-6">
                Lucy smith
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-12">
               Looking forward to a smooth close of Escrow and to see you enjoying your new home
              </div>
            </div>
      </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
{{-- survey model --}}
<div wire:ignore.self class="modal fade" id="survey" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header web">
          <h4>Survey</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
      </div>

      <div style="height: 400px; overflow: auto;">
      <div class="modal-body model-font-specing">
        <div class="survey-subsection">
          <div class="container">
            <p class="lead">We enjoyed working with you and appreciate your feedback to help us improve and serve you better</p>
          </div>
          <div class="parent-quiz">
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center py-md-2">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question"></span>
                </div>
                <div class="col-9 client-review-this ">
                  <ul class="survey-question mb-0 p-0">
                  <li><span  class="spantop">Very Unsatisfied</span></li>
                  <li><span class="spantop">Unsatisfied</span></li>
                  <li><span class="spantop">Netural</span></li>
                  <li><span class="spantop">Satisfied</span></li>
                  <li><span class="spantop">Very Satisfied</span></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">User Friendly</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Enjoyed The Experience</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton2 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton2"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton2"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton2"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton2"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Convenience</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton3 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton3"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton3"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton3"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton3"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Complicated</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton4 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton4"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton4"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton4"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton4"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Exting</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton5 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton5"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton5"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton5"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton5"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Intrusive</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton6 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton6"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton6"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton6"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton6"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Kept Me Informed</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton7 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton7"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton7"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton7"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton7"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Kept Me In Countrol</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton8 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton8"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton8"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton8"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton8"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Kept Me Focused</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton9 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton9"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton9"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton9"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton9"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Found Value</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton10 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton10"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton10"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton10"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton10"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Will Use It Again</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton11 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton11"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton11"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton11"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton11"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Will Recommend</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton12 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton12"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton12"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton12"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton12"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Transparency</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton13 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton13"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton13"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton13"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton13"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Fairness</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton14 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton14"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton14"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton14"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton14"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Inclusiveness</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton15 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton15"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton15"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton15"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton15"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">A Better Way</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton16 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton16"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton16"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton16"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton16"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
          <section class="question-row my-md-2 py-md-3" style="background-color:#fff;">
            <div class="container">
              <div class="row my-2 py-2 d-flex align-items-center">
                <div class="col-3 d-flex align-items-center">
                  <span class="quiz-question">Frictions</span>
                </div>
                <div class="col-9 ">
                  <ul id="survey-question" class="survey-question mb-0">
                  <li class="circle-libutton17 active"><a class=" Circle-button ">1</a></li>
                  <li class="circle-libutton17"><a class="Circle-button">2</a></li>
                  <li class="circle-libutton17"><a class="Circle-button">3</a></li>
                  <li class="circle-libutton17"><a class="Circle-button">4</a></li>
                  <li class="circle-libutton17"><a class="Circle-button">5</a></li>
                  </ul>
              </div>
            </div>
            </div>
          </section>
        </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Submit</button>
      </div>
      </form>
  </div>
  </div>
</div>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyDqwkqcBusUbYxN9rwB9Qn1DJi8QQf4sTo",
            authDomain: "vinero-vlcare.firebaseapp.com",
            databaseURL: 'https://vinero-vlcare-default-rtdb.firebaseio.com/',
            projectId: "vinero-vlcare",
            storageBucket: "vinero-vlcare.appspot.com",
            messagingSenderId: "927616492145",
            appId: "1:927616492145:web:a22d83533b3035394171d0",
            measurementId: "G-8VVYCWRLDK"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        function startFCM() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("store.token") }}',
                        type: 'POST',
                        data: {
                            token: response
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            alert('Token stored.');
                        },
                        error: function (error) {
                            alert(error);
                        },
                    });
                }).catch(function (error) {
                    alert(error);
                });
        }
        messaging.onMessage(function (payload) {
          var control_mode = $('#control_monitor').val();
          // console.log(control_mode);
          if (control_mode == "OPTOUTMODE2") {

          } else {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
                image: payload.notification.image,
                tag: payload.notification.tag,
            };
            const data = {
              incomplete: payload.notification.incomplete,
              action_id: payload.notification.action_id,
            };
            new Notification(title, options);
            //console.log('Message received. ', payload);
            //console.log(payload.data);

            var notification_title = payload.notification.title;
            var notification_type = payload.notification.tag;

            if (notification_title == 'Offer of interest') {
              $('#buyer-offerOfintrest').modal('show');
            }
            if (notification_title == 'Offer Not Accepted') {
              $('#offerNotAccepted').modal('show');
              $('#notification_title').text(payload.notification.body);
            }
            if (notification_title == 'Offer Accepted') {
              $('#offerAccepted').modal('show');
              $('#notification_title').text(payload.notification.body);
            }
            if(notification_title == 'Offer deadline extended'){
              $('#offer-deadline-extension').modal('show');
              $('#notification-body').text(payload.notification.body);
            }
            if(notification_type == 'counter_offer'){
              $('#counter-offer').modal('show');
              $('#title').text(payload.notification.title);
              $('#body').text(payload.notification.body);
            }
            if(notification_title == 'highest_bid'){
              $('#higher-offer-received').modal('show');
            }
            if(notification_title == 'incomplete_offer'){
              $('#incomplete-offer').modal('show');
              if (payload.data.incomplete == 'fc') {
                $('#fc').addClass('text-danger');
              } else if(payload.data.incomplete == 'proof_funds') {
                $('#proof_funds').addClass('text-danger');
              }
            }
            if(notification_title == 'no_sale'){
              $('#no-sale').modal('show');
              $('#no-sale-title').text(payload.notification.title);
              $('#no-sale-bosy').text(payload.notification.body);
            }
          }
        });

    </script>
<script>
  $(document).ready(function(){
  $(".circle-libutton a").click(function() {
  $(".circle-libutton a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton2 a").click(function() {
  $(".circle-libutton2 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton3 a").click(function() {
  $(".circle-libutton3 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton4 a").click(function() {
  $(".circle-libutton4 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton5 a").click(function() {
  $(".circle-libutton5 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton6 a").click(function() {
  $(".circle-libutton6 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton7 a").click(function() {
  $(".circle-libutton7 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton8 a").click(function() {
  $(".circle-libutton8 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton9 a").click(function() {
  $(".circle-libutton9 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton10 a").click(function() {
  $(".circle-libutton10 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton11 a").click(function() {
  $(".circle-libutton11 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton12 a").click(function() {
  $(".circle-libutton12 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton13 a").click(function() {
  $(".circle-libutton13 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton14 a").click(function() {
  $(".circle-libutton14 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton15 a").click(function() {
  $(".circle-libutton15 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton16 a").click(function() {
  $(".circle-libutton16 a").removeClass("active");
  $(this).addClass("active");
  });
  $(".circle-libutton17 a").click(function() {
  $(".circle-libutton17 a").removeClass("active");
  $(this).addClass("active");
  });
  });

  $(document).ready(function(){
    $(document).click(function(e){
        var click=$(e.target);
        if(click.closest(".action-btn").length==0 && $(".action-hide").is(':visible')){
          $(".action-btn").click();
        }
      });
  });

  </script>
@endsection