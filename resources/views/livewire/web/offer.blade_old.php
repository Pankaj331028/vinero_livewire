<div>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">

    <ul class="nav nav-pills accountpills" id="pills-tab" role="tablist">
        <input type="hidden" name="" value="my_offer" id="offer-steps" wire:model="steps">
        <input type="hidden" name="" id="realState" value="{{$this->realStateAgency}}">
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if( $this->step == 1) active @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-myoffer" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" value="my_offer" wire:click="fetch_data({{ $s = 1 }})">My
                offer</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 2 || $this->step_count == 2) active @elseif(in_array($step, [3,4,5,6,7,8,9,10]) || $this->step_count > 1) @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-transaction" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 2 }})">Transaction overview</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 3 || $this->step_count == 3) active @elseif(in_array($step, [4,5,6,7,8,9,10]) || $this->step_count > 2) @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-acquisition" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 3 }})">Acquisition strategy</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 4 || $this->step_count == 4) active @elseif(in_array($step, [5,6,7,8,9,10]) || $this->step_count > 3) @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-contract" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 4 }})">Contract Timings</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 5 || $this->step_count == 5) active @elseif(in_array($step, [6,7,8,9,10]) || $this->step_count > 4) @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-documents" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 5 }})">Documents verification and upload</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 6 || $this->step_count == 6) active @elseif(in_array($step, [7,8,9,10]) || $this->step_count > 5) @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-iteminclude" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 6 }})">Items included and excluded in the sale</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 7 || $this->step_count == 7) active @elseif(in_array($step, [8,9,10]) || $this->step_count > 6) @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-costs" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 7 }})">Allocation of Costs</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 8 || $this->step_count == 8) active @elseif(in_array($step, [9,10]) || $this->step_count > 7) @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-summary" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 8 }})">Offer Summary and approval</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 9) active @elseif(in_array($step, [10]) || $this->step_count > 8) @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-fc" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 9 }})">Financial credentials</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs-account tabs-offers @if($step == 10) active  @else disabled @endif" id="pills-offer-tab"
                data-bs-toggle="pill" data-bs-target="#pills-es" type="button" role="tab"
                aria-controls="pills-offer" aria-selected="false" wire:click="fetch_data({{ $s = 10 }})">Electronic signature</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <!-- offer section -->
        <div class="tab-pane make-An-text @if( $this->step == 1) active show @endif" id="pills-myoffer" role="tabpanel"
            aria-labelledby="pills-offer-tab">
            <div class="row position-relative">
                <form wire:submit.prevent="submit" enctype="multipart/form-data" style="overflow:scroll;">
                    <table class=" table-responsive-sm table table-bordered2 offertable" id="offertable">
                        <thead>
                            <tr style="text-align: center;">
                                <td colspan="2"><label for="" class="col-form-label offerlabel"><strong>Offer
                                            id</strong></label>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Property address
                                        <div class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="If this is not the correct address, please contact us. info@Qonectin.com"
                                                style="font-size: larger;"><img src="images/info.png"></a>
                                        </div>
                                    </label>
                                </td>

                                <td><span>{{$this->step1['address'] ?? ''}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Date offer submitted</label>
                                </td>

                                <td><span>{{$this->step1['submission_date'] ?? ''}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Offer due date</label></td>

                                <td><span>{{$this->step1['due_date'] ?? ''}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer(s)
                                        <div class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="enter all Buyers separated by semi-colon ;"
                                                style="font-size: larger;"><img src="images/info.png"></a>

                                        </div>
                                    </label></td>
                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step1.buyer_name') is-invalid
                                    @enderror"
                                    wire:model="step1.buyer_name">
                                    @error('step1.buyer_name') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Entity</label></td>

                                <td><select
                                        class="form-select offerselect @error('step1.entity') is-invalid @enderror"
                                        wire:model="step1.entity" @if($this->control_mode == 0) disabled @endif>
                                        <option value="" selected>Select one</option>
                                        <option value="principal">Principal</option>
                                        <option value="llc">llc</option>
                                        <option value="trust">Trust</option>
                                        <option value="corporation">Corporation</option>
                                        <option value="legal_entity">Legal entity</option>
                                    </select>
                                    @error('step1.entity') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Represented by buyer's
                                        agent</label></td>
                                <td>
                                    <ul class="nav nav-pills tabsmoreinfoto" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link buood" id="pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-home" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="false">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                        wire:model="step1.buyer_representative" type="radio"
                                                        id="inlineCheckbox1" name="justcheck" value="yes"
                                                        @if($this->control_mode == 0) disabled @endif>
                                                    <label class="form-check-label tbselect"
                                                        for="inlineCheckbox1">Yes</label>
                                                </div>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link buood active" id="pills-profile-tab"
                                                data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                                role="tab" aria-controls="pills-profile" aria-selected="true">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                        wire:model="step1.buyer_representative" type="radio"
                                                        id="inlineCheckbox2" name="justcheck" value="no"
                                                        @if($this->control_mode == 0) disabled @endif>
                                                    <label class="form-check-label tbselect"
                                                        for="inlineCheckbox2">No</label>
                                                </div>
                                            </button>
                                        </li>
                                    </ul>
                                    @error('step1.buyer_representative')
                                    <div class="error-label text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            @if ($this->realStateAgency == 1 && $this->step1['buyer_representative'] == 'no') 
                            <tr style="text-align: center;">
                                <td colspan="2"><label for="" class="col-form-label offerlabel"><strong>Real estate
                                            agency</strong>
                                        <div class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="contact us if you need assistance info@Qonectin.com"
                                                style="font-size: larger;">&#x1F6C8;</a>
                                        </div>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller's brokerage firm</label>
                                </td>

                                <td><span>{{$this->step1['seller_brokerage_firm'] ?? ''}}</span></td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller's Agent</label></td>

                                <td><span>{{$this->step1['seller_agent_name'] ?? ''}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's brokerage firm</label>
                                </td>

                                <td><input type="text"
                                        class="form-control makeAnOffer-input @error('step1.brokerage_firm') is-invalid @enderror"
                                        wire:model="step1.brokerage_firm" id="brokerage_firm" readonly>
                                    @error('step1.brokerage_firm') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's brokerage
                                        license</label></td>

                                <td><input type="text"
                                        class="form-control makeAnOffer-input @error('step1.brokerage_license') is-invalid @enderror"
                                        wire:model="step1.brokerage_license" id="brokerage_license" readonly>
                                    @error('step1.brokerage_license') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's agent</label></td>

                                <td><input type="text"
                                        class="form-control makeAnOffer-input @error('step1.agent_name') is-invalid @enderror"
                                        wire:model="step1.agent_name" id="agent_name" readonly>
                                    @error('step1.agent_name')  
                                    <div class="invalid-feedback text-danger">
                                        {{ $message}}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's agent license</label>
                                </td>

                                <td><input type="text"
                                        class="form-control makeAnOffer-input @error('step1.agent_license') is-invalid @enderror"
                                        wire:model="step1.agent_license" id="agent_license" readonly>
                                    @error('step1.agent_license') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's agent cell
                                        phone</label></td>

                                <td><input type="number"
                                        class="form-control makeAnOffer-input @error('step1.agent_phone') is-invalid @enderror"
                                        wire:model="step1.agent_phone" id="agent_phone" readonly>
                                    @error('step1.agent_phone') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller's paid buyer's agent
                                        commission</label></td>

                                <td><input type="number"
                                        class="form-control makeAnOffer-input @error('step1.agent_comission') is-invalid @enderror"
                                        wire:model="step1.agent_comission" id="agent_comission" readonly>
                                    @error('step1.agent_comission') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            @else
                            <tr style="text-align: center;">
                                <td colspan="2"><label for="" class="col-form-label offerlabel"><strong>Real estate
                                            agency</strong>
                                        <div class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="contact us if you need assistance info@Qonectin.com"
                                                style="font-size: larger;"><img src="images/info.png"></a>
                                        </div>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller's brokerage firm</label>
                                </td>

                                <td><span>{{$this->step1['seller_brokerage_firm'] ?? ''}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller's Agent</label></td>

                                <td><span>{{$this->step1['seller_agent_name'] ?? ''}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's brokerage firm</label>
                                </td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step1.brokerage_firm') is-invalid
                                    @enderror"
                                    wire:model="step1.brokerage_firm" id="brokerage_firm">
                                    @error('step1.brokerage_firm') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's brokerage
                                        license</label></td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step1.brokerage_license')
                                    is-invalid @enderror"
                                    wire:model="step1.brokerage_license" id="brokerage_license">
                                    @error('step1.brokerage_license') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's agent</label></td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step1.agent_name') is-invalid
                                    @enderror"
                                    wire:model="step1.agent_name" id="agent_name">
                                    @error('step1.agent_name') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message}}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's agent license</label>
                                </td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step1.agent_license') is-invalid
                                    @enderror"
                                    wire:model="step1.agent_license" id="agent_license">
                                    @error('step1.agent_license') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Buyer's agent cell
                                        phone</label></td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step1.agent_phone') is-invalid
                                    @enderror"
                                    wire:model="step1.agent_phone" id="">
                                    @error('step1.agent_phone') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller's paid buyer's agent
                                        commission</label>
                                </td>

                                <td><select
                                        class="form-select offerselect @error('step1.agent_comission') is-invalid @enderror"
                                        wire:model="step1.agent_comission" @if($this->control_mode == 0) disabled @endif>
                                        <option value="" selected>Select one</option>
                                        <option value="0">0%</option>
                                        <option value="0.25">0.25%</option>
                                        <option value="0.50">0.50%</option>
                                        <option value="0.75">0.75%</option>
                                        <option value="1">1%</option>
                                        <option value="1.25">1.25%</option>
                                        <option value="1.50">1.50%</option>
                                        <option value="1.75">1.75%</option>
                                        <option value="2">2%</option>
                                        <option value="2.25">2.25%</option>
                                        <option value="2.50">2.50%</option>
                                        <option value="2.75">2.75%</option>
                                        <option value="3">3%</option>
                                    </select>
                                    @error('step1.agent_comission')
                                     <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center my-4 make-an-offerButton">
                        <button type="button" wire:click="changeStep(2)" value="transaction" class="ms-4 btn btn-warning col-4"
                            name="offerSubmit2"  @if($this->control_mode == 0) disabled @endif value="1">Save &
                            Next</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="tab-pane make-An-text @if($step == 2 || $this->step_count == 2) active show @else fade @endif" id="pills-transaction"
            role="tabpanel" aria-labelledby="pills-offer-tab">
            <div class="row position-relative">
                <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                    <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                        <thead>
                            <tr style="text-align: center;">
                                <td colspan="2"><label for="" class="col-form-label offerlabel"><strong>Transaction
                                            Information</strong></label>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Offered price </label></td>
                                <td>
                                    <div class="col-md-12 my-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="hidden" name="" value="{{$this->property_rate}}" id=""
                                                wire:model="property_rate">
                                            <input type="text" @if($this->control_mode == 0) readonly @endif
                                            class="form-control makeAnOffer-input inputNumber offerPrice @error('step2.offered_price')
                                            is-invalid @enderror"
                                            wire:model="step2.offered_price" id="offered_prices" onKeyup="NetPrice()">
                                            @error('step2.offered_price') <div class="invalid-feedback text-danger">{{
                                                $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller credit, if any, to
                                        buyer</label></td>

                                <td><select
                                    class="form-select offerselect @error('step2.seller_credit') is-invalid @enderror offer_amount"
                                    wire:model="step2.seller_credit" @if($this->control_mode == 0) disabled @endif id="seller_credit" onChange="NetPrice()">
                                    <option value="" selected>Select one</option>
                                    <option value="0">0%</option>
                                    <option value="0.25">0.25%</option>
                                    <option value="0.50">0.50%</option>
                                    <option value="0.75">0.75%</option>
                                    <option value="1">1%</option>
                                    <option value="1.25">1.25%</option>
                                    <option value="1.50">1.50%</option>
                                    <option value="1.75">1.75%</option>
                                    <option value="2">2%</option>
                                    <option value="2.25">2.25%</option>
                                    <option value="2.50">2.50%</option>
                                    <option value="2.75">2.75%</option>
                                    <option value="3">3%</option>
                                    <option value="3.25">3.25%</option>
                                    <option value="3.50">3.50%</option>
                                    <option value="3.75">3.75%</option>
                                    <option value="4">4%</option>
                                    <option value="4.25">4.25%</option>
                                    <option value="4.50">4.50%</option>
                                    <option value="4.75">4.75%</option>
                                    <option value="5">5%</option>
                                </select>
                                    @error('step2.seller_credit') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Net price after commission &
                                        credits</label></td>
                                <td>
                                    <div class="col-md-12 my-2">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" @if($this->control_mode == 0) readonly @endif
                                            class="form-control makeAnOffer-input inputNumber  @error('step2.net_price')
                                            is-invalid @enderror"
                                            wire:model="step2.net_price" id="net_price" readonly>
                                            @error('step2.net_price') <div class="invalid-feedback text-danger">{{ $message
                                                }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Days to close of escrow</label>
                                </td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step2.close_escrow_days') is-invalid
                                        @enderror"
                                        wire:model="step2.close_escrow_days">
                                        <option value="" selected>Select one</option>                                       
                                        @for ( $i=1; $i<=60; $i++) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}
                                            </option>
                                            @endfor
                                    </select>
                                    @error('step2.close_escrow_days') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            {{-- <tr>
                                <td> <label for="" class="col-form-label offerlabel">Commission</label>
                                </td>

                                <td><input type="text" class="form-control makeAnOffer-input"
                                        value="{{$data_step2['commission'] ?? ''}}" readonly></td>
                            </tr> --}}
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Expiration of offer</label>
                                </td>
                                <td><span>1 day after deadline date {{$this->step2['expiry_date'] ?? ''}} or upon buyers withdrawal of offer</span>
                                </td>
                            </tr>
                            <tr style="text-align: center;">
                                <td colspan="2"><label for="" class="col-form-label offerlabel"><strong>Time Of
                                            Possession</strong>
                                        <div class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Terms can be negotiated under “Other Terms and Conditions"
                                                style="font-size: larger;"><img src="images/info.png"></a>
                                        </div>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Occupancy</label></td>

                                <td><span>{{$this->step2['occupancy'] ?? ''}}</span>
                                </td>
                            </tr>
                            {{-- <tr>

                                <td> <label for="" class="col-form-label offerlabel">Possession</label></td>

                                <td>{{$this->step2['possession'] ?? ''}}
                                </td>
                            </tr> --}}
                            <tr style="text-align: center;">
                                <td colspan="2"><label for="" class="col-form-label offerlabel"><strong> Possession </strong></label>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Close of escrow</label></td>

                                <td>
                                    @if ($this->step2['possession'] == 'close_escrow')
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    @elseif($this->step2['possession'] == 'rent_back')
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    @else
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller rent back</label></td>

                                <td>
                                    @if ($this->step2['possession'] == 'close_escrow')
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    @elseif($this->step2['possession'] == 'rent_back')
                                    {{$this->step2['possession_rent_back']." days" ?? ''}} 
                                    @else
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">TOPA submitted by
                                        seller</label></td>

                                <td>
                                    @if ($this->step2['possession'] == 'close_escrow')
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    @elseif($this->step2['possession'] == 'rent_back')
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    @elseif($this->step2['possession_tenant_rights'] == 'topa')
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    @elseif($this->step2['possession_tenant_rights'] == 'other')
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Final verification of
                                        condition</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step2.final_verification') is-invalid
                                        @enderror"
                                        wire:model="step2.final_verification">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=10; $i++) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}
                                            </option>
                                            @endfor
                                    </select>
                                    @error('step2.final_verification') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Assignment request</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step2.assignment_request') is-invalid
                                        @enderror"
                                        wire:model="step2.assignment_request">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=17; $i++) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}
                                            </option>
                                            @endfor
                                    </select>
                                    @error('step2.assignment_request') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="text-center my-4 make-an-offerButton">

                        <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn
                            btn-warning col-4" wire:click="changeStep(3)"
                            name="offerSubmit2" value="1">Save & Next</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="tab-pane make-An-text  @if($step == 3 || $this->step_count == 3) active show @else fade @endif" id="pills-acquisition"
            role="tabpanel" aria-labelledby="pills-offer-tab">
            <div class="row position-relative">
                <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                    <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                        <thead>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Estimated closing costs</label>
                                </td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.estimated_closing_costs')
                                        is-invalid @enderror"
                                        wire:model="step3.estimated_closing_costs" id="estimated_closing_costs" onKeyup="DownPayment()">
                                        <option value="0">0%</option>
                                        <option value="1.25">1.25%</option>
                                        <option value="2.50">2.50%</option>
                                        <option value="3.75" selected>3.75%</option>
                                        <option value="5">5%</option>
                                        <option value="6.25">6.25%</option>
                                        <option value="7">7%</option>
                                    </select>
                                    @error('step3.estimated_closing_costs') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr style="text-align: center;">
                                <td colspan="2"><label for="" class="col-form-label offerlabel"><strong>Buyer's
                                            Investment</strong></label>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Initial deposit amount</label>
                                </td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step3.initial_deposit_amount')
                                    is-invalid @enderror"
                                    wire:model="step3.initial_deposit_amount" id="initial_deposit_amount" onKeyup="DownPayment()">
                                    @error('step3.initial_deposit_amount') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Within days</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.within_days') is-invalid
                                        @enderror"
                                        wire:model="step3.within_days">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected>3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    @error('step3.within_days')
                                     <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Deposit increase</label></td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step3.deposit_increase')
                                    is-invalid @enderror"
                                    wire:model="step3.deposit_increase" id="deposit_increase" onKeyup="DownPayment()">
                                    @error('step3.deposit_increase')
                                     <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Days to deposit
                                        increase</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.deposit_increase_days')
                                        is-invalid @enderror"
                                        wire:model="step3.deposit_increase_days">
                                        <option value="" selected>N/A</option>
                                        <option value="inspection_removal" selected>upon removal inspection contingency</option>
                                        @for ( $i=1; $i<=10; $i++ ) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                    @error('step3.deposit_increase_days') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Balance of down payment</label>
                                </td>
                                <td><span wire:model="step3.down_payment">{{$this->step3['down_payment'] ?? ''}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="" class="col-form-label offerlabel"><strong>Purchase
                                            loan(s)</strong></label></td>

                                <td class="text-center"><label for="" class="form-label topofferlabel"><strong>1st
                                            Loan</strong></label></td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Mortgage loan
                                        amount</label></td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step3.loan_amount_1') is-invalid
                                    @enderror"
                                    wire:model="step3.loan_amount_1" id="loan_amount_1">
                                    @error('step3.loan_amount_1') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Mortgage loan interest
                                        rate</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.loan_interest_1') is-invalid
                                        @enderror"
                                        wire:model="step3.loan_interest_1">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=0; $i<=15; $i=$i+0.125 ) <option value="{{$i}}">{{$i}}%</option>
                                            @endfor
                                    </select>
                                    @error('step3.loan_interest_1') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Mortgage loan
                                        points</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.loan_points_1') is-invalid
                                        @enderror"
                                        wire:model="step3.loan_points_1">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=12; $i++ ) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                    @error('step3.loan_points_1') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Direct lender</label>
                                </td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step3.direct_lender_1') is-invalid
                                    @enderror"
                                    wire:model="step3.direct_lender_1">
                                    @error('step3.direct_lender_1') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Type of financing</label>
                                </td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.financing_type_1') is-invalid
                                        @enderror"
                                        wire:model="step3.financing_type_1">
                                        <option value="conventional">Conventional</option>
                                        <option value="FHA">FHA</option>
                                        <option value="VA">VA</option>
                                        <option value="seller_financing">Seller financing</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('step3.financing_type_1') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Additional financing
                                        terms</label>
                                </td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step3.additional_terms_1')
                                    is-invalid @enderror"
                                    wire:model="step3.additional_terms_1">
                                    @error('step3.additional_terms_1') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td><label for="" class="col-form-label offerlabel"><strong>Purchase
                                            loan(s)</strong></label></td>

                                <td class="text-center"><label for="" class="form-label topofferlabel"><strong>2nd
                                            Loan</strong></label></td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Mortgage loan
                                        amount</label></td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step3.loan_amount_2') is-invalid
                                    @enderror"
                                    wire:model="step3.loan_amount_2" id="loan_amount_2">
                                    @error('step3.loan_amount_2') 
                                    <div class="invalid-feedback text-danger">
                                        {{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Mortgage loan interest
                                        rate</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.loan_interest_2') is-invalid
                                        @enderror"
                                        wire:model="step3.loan_interest_2">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=0; $i<=15; $i=$i+0.125 ) <option value="{{$i}}">{{$i}}%</option>
                                            @endfor
                                    </select>
                                    @error('step3.loan_interest_2') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Mortgage loan
                                        points</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.loan_points_2') is-invalid
                                        @enderror"
                                        wire:model="step3.loan_points_2">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=12; $i++ ) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                    @error('step3.loan_points_2') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Direct lender</label>
                                </td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step3.direct_lender_2') is-invalid
                                    @enderror"
                                    wire:model="step3.direct_lender_2">
                                    @error('step3.direct_lender_2') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Type of financing</label>
                                </td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step3.financing_type_2') is-invalid
                                        @enderror"
                                        wire:model="step3.financing_type_2">
                                        <option value="conventional">Conventional</option>
                                        <option value="FHA">FHA</option>
                                        <option value="VA">VA</option>
                                        <option value="seller_financing">Seller financing</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('step3.financing_type_2') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Additional financing
                                        terms</label>
                                </td>

                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input @error('step3.additional_terms_2')
                                    is-invalid @enderror"
                                    wire:model="step3.additional_terms_2">
                                    @error('step3.additional_terms_2') <div class="invalid-feedback text-danger">{{
                                        $message }}</div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Loan to value</label>
                                </td>
                                <td><span>65% LTV</span>
                                    {{-- <input type="text" class="form-control makeAnOffer-input"
                                        value="{{$data_step3['down_payment'] ?? ''}}"> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center my-4 make-an-offerButton">

                        <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn
                            btn-warning col-4" wire:click="changeStep(4)"
                            name="offerSubmit2" value="1">Save & Next</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="tab-pane make-An-text  @if($step == 4 || $this->step_count == 4) active show @else fade @endif" id="pills-contract"
            role="tabpanel" aria-labelledby="pills-offer-tab">
            <div class="row position-relative">
                <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                    <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                        <thead>
                            <tr style="text-align: center;">
                                <td colspan="2"><label for=""
                                        class="col-form-label offerlabel"><strong>Contingencies</strong></label>
                                </td>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Loan contingency
                                        removal</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.loan_contingency') is-invalid
                                        @enderror"
                                        wire:model="step4.loan_contingency">
                                        <option value="">Select one</option>
                                        @for ( $i=1; $i<=20; $i++ ) <option value="{{$i}}" @if($i == 17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.loan_contingency') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Appraisal contingency</label>
                                </td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.appraisal_contingency')
                                        is-invalid @enderror"
                                        wire:model="step4.appraisal_contingency">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.appraisal_contingency') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Investigation of
                                        property</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.investigation_property')
                                        is-invalid @enderror"
                                        wire:model="step4.investigation_property">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.investigation_property') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Right to access the
                                        property</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.property_access') is-invalid
                                        @enderror"
                                        wire:model="step4.property_access">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.property_access') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Review of seller
                                        documents</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.review_documents') is-invalid
                                        @enderror"
                                        wire:model="step4.review_documents">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.review_documents') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Preliminary ("Title")
                                        report</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.preliminary_report') is-invalid
                                        @enderror"
                                        wire:model="step4.preliminary_report">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.preliminary_report') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Review of leased or
                                        liened items</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.review_of_leased') is-invalid
                                        @enderror"
                                        wire:model="step4.review_of_leased">
                                        <option selected>NA</option>
                                        @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.review_of_leased')
                                     <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Common Interest
                                        disclosures</label></td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.common_interest_disclosures')
                                        is-invalid @enderror"
                                        wire:model="step4.common_interest_disclosures">
                                        <option selected>NA</option>
                                        @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.common_interest_disclosures') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Sale of buyers property</td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.sale_buyer_property')
                                        is-invalid @enderror"
                                        wire:model="step4.sale_buyer_property">
                                        <option selected>NA</option>
                                        @for ( $i=1; $i<=20; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.sale_buyer_property') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr style="text-align: center;">
                                <td colspan="2"><label for=""
                                        class="col-form-label offerlabel"><strong>Compliances</strong></label>
                                </td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Seller Delivery of Documents
                                </td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.seller_delivery_document')
                                        is-invalid @enderror"
                                        wire:model="step4.seller_delivery_document">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.seller_delivery_document') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Sign and return Escrow Holder
                                        Provisions and Instructions</td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.provisions_instructions')
                                        is-invalid @enderror"
                                        wire:model="step4.provisions_instructions">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.provisions_instructions') 
                                    <div  class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Install smoke alarm(s), CO
                                        detector(s), water heater bracing</td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.smoke_alarm') is-invalid
                                        @enderror"
                                        wire:model="step4.smoke_alarm">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.smoke_alarm') 
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Evidence of representative
                                        authority</td>

                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.evidence_authority') is-invalid
                                        @enderror"
                                        wire:model="step4.evidence_authority">
                                        <option value="" selected>Select one</option>
                                        @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.evidence_authority') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Time to pay fees for ordering
                                        HOA documents
                                <td><select @if($this->control_mode == 0) disabled @endif
                                        class="form-select offerselect @error('step4.hoa_documents') is-invalid
                                        @enderror"
                                        wire:model="step4.hoa_documents">
                                        <option selected>NA</option>
                                        @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                            @endfor
                                    </select>
                                    @error('step4.hoa_documents') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>


                        </tbody>
                    </table>
                    <div class="text-center my-4 make-an-offerButton">

                        <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn
                            btn-warning col-4" wire:click="changeStep(5)"
                            name="offerSubmit2" value="1" >Save & Next</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="tab-pane make-An-text  @if($step == 5 || $this->step_count == 5) active show @else fade @endif" id="pills-documents"
            role="tabpanel" aria-labelledby="pills-offer-tab">
            <div class="row position-relative">
                <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                    <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                        <thead>
                            <tr>
                                <td><label for="" class="col-form-label offerlabel"><strong>Verification of all cash
                                            offer</strong>
                                        <div class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="you must upload documentation that supports your financial capacity to complete the transaction."
                                                style="font-size: larger;"><img src="images/info.png"></a>
                                        </div>
                                    </label></td>

                                <td class="text-center"><label for="" class="form-label topofferlabel"></label></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Verified amount</label></td>
                                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                    class="form-control makeAnOffer-input inputNumber
                                    @error('step5.cash_verified_amount') is-invalid @enderror"
                                    wire:model="step5.cash_verified_amount"
                                    @if($data_step5['cash_verification']==0) readonly @endif id="">
                                    @error('step5.cash_verified_amount') 
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror</td>
                            </tr>
                            <tr>
                                <td> <label for="" class="col-form-label offerlabel">Upload</label></td>

                                <td><input type="file" @if($this->control_mode == 0) disabled @endif
                                    class="form-control makeAnOffer-input @error('step5.cash_verified_image')
                                    is-invalid @enderror"
                                    wire:model="step5.cash_verified_image" multiple
                                    @if($data_step5['cash_verification']==0) disabled @endif>
                                    <div wire:loading wire:target="step5.cash_verified_image">Uploading...</div>
                                    @error('step5.cash_verified_image')
                                    <em class="invalid-feedback">{{$message}}</em>
                                    @enderror
                                    @error('step5.cash_verified_image.*')
                                    <em class="invalid-feedback">{{$message}}</em>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    @if (!empty($step5['cash_verified_image']))
                                    <div class="row justify-content-center mb-4">
                                        @foreach($step5['cash_verified_image'] as $key => $cert)
                                        @if(gettype($cert)!='string' &&
                                        in_array($cert->getClientOriginalExtension(),['doc','docx','pdf']))
                                        @php
                                        $file='';
                                        switch($cert->getClientOriginalExtension()){
                                        case 'pdf': $file=asset('images/pdf.png');break;
                                        case 'doc': $file=asset('images/doc.png');break;
                                        case 'docx': $file=asset('images/doc.png');break;
                                        }
                                        @endphp
                                        <a href="javascript:;" class="position-absolute right-0"
                                            wire:click="removeTempImage1({{$key}})"><i class="fa fa-trash"></i></a>
                                        <img src="{{$file}}" />
                                    </div>
                                    @elseif(in_array($cert->getClientOriginalExtension(),['png','jpg']))
                                    <div class="col-md-1 position-relative">
                                        <a href="javascript:;" class="position-absolute right-0"
                                            wire:click="removeTempImage1({{$key}})"><i class="fa fa-trash"></i></a>
                                        <img src="{{$cert->temporaryUrl()}}" width="100%" />
                                    </div>
                                    @endif
                                    @endforeach
                                    </div>
                                    @endif
                                    @if (!empty($cash_verified_image))
                                    <div class="row justify-content-center mb-4">
                                        @foreach($cash_verified_image as $key => $cert)
                                        <div class="col-md-1 position-relative">
                                            @if(in_array(pathinfo($cert, PATHINFO_EXTENSION),['doc','docx','pdf']))
                                            @php
                                            $file='';
                                            $extension = pathinfo($cert, PATHINFO_EXTENSION);
                                            switch($extension){
                                            case 'pdf': $file=asset('images/pdf.png');break;
                                            case 'doc': $file=asset('images/doc.png');break;
                                            case 'docx': $file=asset('images/doc.png');break;
                                            }
                                            @endphp
                                            <a href="javascript:;" class="position-absolute right-0"
                                                wire:click="removeImage1({{$key}},{{$certificate_ids[$key]}})"><i
                                                    class="fa fa-trash"></i></a>
                                            <img src="{{$file}}" />
                                            @elseif(in_array(pathinfo($cert, PATHINFO_EXTENSION),['png','jpg']))
                                            <a href="javascript:;" class="position-absolute right-0"
                                                wire:click="removeImage1({{$key}},{{$certificate_ids[$key]}})"><i
                                                    class="fa fa-trash"></i></a>
                                            <img src="{{$cert}}" width="100%" />
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </td>
                            </tr>

            <tr>
                <td><label for="" class="col-form-label offerlabel"><strong>Verification of down
                            payment $ closing</strong></label></td>

                <td class="text-center"><label for="" class="form-label topofferlabel"></label></td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">Verified amount</label></td>

                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                    class="form-control makeAnOffer-input inputNumber @error('step5.downpayment_verified_amount')
                    is-invalid @enderror"
                    wire:model="step5.downpayment_verified_amount" id="">
                    @error('step5.downpayment_verified_amount') 
                    <div class="invalid-feedback text-danger">
                        {{$message }}
                    </div>
                    @enderror</td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">Upload</label></td>

                <td><input type="file" @if($this->control_mode == 0) disabled @endif
                    class="form-control makeAnOffer-input @error('step5.downpayment_verified_image') is-invalid
                    @enderror"
                    wire:model="step5.downpayment_verified_image" multiple>
                    <div wire:loading wire:target="step5.downpayment_verified_image">Uploading...</div>
                    @error('step5.downpayment_verified_image')
                    <em class="invalid-feedback">{{$message}}</em>
                    @enderror
                    @error('step5.downpayment_verified_image.*')
                    <em class="invalid-feedback">{{$message}}</em>
                    @enderror

                </td>
            <tr>
                <td colspan="2">
                    @if (!empty($step5['downpayment_verified_image']))
                    <div class="row justify-content-center mb-4">
                        @foreach($step5['downpayment_verified_image'] as $key => $cert)
                        @if(gettype($cert)!='string' &&
                        in_array($cert->getClientOriginalExtension(),['doc','docx','pdf']))
                        <div class="col-md-1 position-relative">
                            @php
                            $file='';
                            switch($cert->getClientOriginalExtension()){
                            case 'pdf': $file=asset('images/pdf.png');break;
                            case 'doc': $file=asset('images/doc.png');break;
                            case 'docx': $file=asset('images/doc.png');break;
                            }
                            @endphp
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeTempImage2({{$key}})"><i class="fa fa-trash"></i></a>
                            <img src="{{$file}}" />
                        </div>
                        @elseif(in_array($cert->getClientOriginalExtension(),['png','jpg']))
                        <div class="col-md-1 position-relative">
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeTempImage2({{$key}})"><i class="fa fa-trash"></i></a>
                            <img src="{{$cert->temporaryUrl()}}" width="100%" />
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    @if (!empty($downpayment_verified_image))
                    <div class="row justify-content-center mb-4">
                        @foreach($downpayment_verified_image as $key => $cert)
                        <div class="col-md-1 position-relative">
                            @if(in_array(pathinfo($cert, PATHINFO_EXTENSION),['doc','docx','pdf']))
                            @php
                            $file='';
                            $extension = pathinfo($cert, PATHINFO_EXTENSION);
                            switch($extension){
                            case 'pdf': $file=asset('images/pdf.png');break;
                            case 'doc': $file=asset('images/doc.png');break;
                            case 'docx': $file=asset('images/doc.png');break;
                            }
                            @endphp
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeImage2({{$key}},{{$certificate_ids[$key]}})"><i
                                    class="fa fa-trash"></i></a>
                            <img src="{{$file}}" />
                            @elseif(in_array(pathinfo($cert, PATHINFO_EXTENSION),['png','jpg']))
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeImage2({{$key}},{{$certificate_ids[$key]}})"><i
                                    class="fa fa-trash"></i></a>
                            <img src="{{$cert}}" width="100%" />
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </td>
            </tr>
            </tr>
            <tr>
                <td><label for="" class="col-form-label offerlabel"><strong>verification of loan
                            application</strong></label></td>

                <td class="text-center"><label for="" class="form-label topofferlabel"></label></td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">Status</label></td>

                <td><select @if($this->control_mode == 0) disabled @endif
                        class="form-select offerselect @error('step5.loan_contingency') is-invalid @enderror"
                        wire:model="step5.loan_contingency" @if($data_step5['cash_verification']==0)
                        disabled @endif>
                        <option value="" selected>Select one</option>
                        <option value="pre_approval">Pre approval</option>
                        <option value="pre_qualification">Pre qualification</option>
                        <option value="all_cash">all cash</option>
                    </select>
                    @error('step5.loan_contingency') 
                    <div class="invalid-feedback text-danger">
                        {{$message }}
                    </div>
                    @enderror</td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">Amount</label></td>

                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                    class="form-control makeAnOffer-input inputNumber @error('step5.loan_application_amount')
                    is-invalid @enderror"
                    wire:model="step5.loan_application_amount"
                    @if($data_step5['cash_verification']==0) readonly @endif id="">
                    @error('step5.loan_application_amount') 
                    <div class="invalid-feedback text-danger">
                        {{ $message }}
                    </div>
                    @enderror</td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">Interest rate</label></td>

                <td><select @if($this->control_mode == 0) disabled @endif
                        class="form-select offerselect @error('step5loan_interest_rate') is-invalid @enderror"
                        wire:model="step5loan_interest_rate"
                        @if($data_step5['cash_verification']==0) disabled @endif>
                        <option value="" selected>Select one</option>
                        @for ( $i=1; $i<=12; $i++ ) <option value="{{$i}}%">{{$i}}%</option>
                            @endfor
                    </select>
                    @error('step5loan_interest_rate') <div class="invalid-feedback text-danger">{{
                        $message }}</div>
                    @enderror</td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">Direct lender</label></td>

                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                    class="form-control makeAnOffer-input @error('step5.direct_lender_name') is-invalid @enderror"
                    wire:model="step5.direct_lender_name"
                    @if($data_step5['cash_verification']==0) readonly @endif>
                    @error('step5.direct_lender_name') <div class="invalid-feedback text-danger">{{
                        $message }}</div>
                    @enderror</td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">Upload</label></td>

                <td><input type="file" @if($this->control_mode == 0) disabled @endif
                    class="form-control makeAnOffer-input @error('step5.loan_application_image') is-invalid
                    @enderror"
                    wire:model="step5.loan_application_image" multiple
                    @if($data_step5['cash_verification'] == 0) disabled @endif>
                    <div wire:loading wire:target="step5.loan_application_image">Uploading...</div>
                    @error('step5.loan_application_image')
                    <em class="invalid-feedback">{{$message}}</em>
                    @enderror
                    @error('step5.loan_application_image.*')
                    <em class="invalid-feedback">{{$message}}</em>
                    @enderror
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    @if (!empty($step5['loan_application_image']))
                    <div class="row justify-content-center mb-4">
                        @foreach($step5['loan_application_image'] as $key => $cert)
                        @if(gettype($cert)!='string' &&
                        in_array($cert->getClientOriginalExtension(),['doc','docx','pdf']))
                        <div class="col-md-1 position-relative">
                            @php
                            $file='';
                            switch($cert->getClientOriginalExtension()){
                            case 'pdf': $file=asset('images/pdf.png');break;
                            case 'doc': $file=asset('images/doc.png');break;
                            case 'docx': $file=asset('images/doc.png');break;
                            }
                            @endphp
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeTempImage3({{$key}})"><i class="fa fa-trash"></i></a>
                            <img src="{{$file}}" />
                        </div>
                        @elseif(in_array($cert->getClientOriginalExtension(),['png','jpg']))
                        <div class="col-md-1 position-relative">
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeTempImage3({{$key}})"><i class="fa fa-trash"></i></a>
                            <img src="{{$cert->temporaryUrl()}}" width="100%" />
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    @if (!empty($loan_application_image))
                    <div class="row justify-content-center mb-4">
                        @foreach($loan_application_image as $key => $cert)
                        <div class="col-md-1 position-relative">
                            @if(in_array(pathinfo($cert, PATHINFO_EXTENSION),['doc','docx','pdf']))
                            @php
                            $file='';
                            $extension = pathinfo($cert, PATHINFO_EXTENSION);
                            switch($extension){
                            case 'pdf': $file=asset('images/pdf.png');break;
                            case 'doc': $file=asset('images/doc.png');break;
                            case 'docx': $file=asset('images/doc.png');break;
                            }
                            @endphp
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeImage3({{$key}},{{$certificate_ids[$key]}})"><i
                                    class="fa fa-trash"></i></a>
                            <img src="{{$file}}" />
                            @elseif(in_array(pathinfo($cert, PATHINFO_EXTENSION),['png','jpg']))
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeImage3({{$key}},{{$certificate_ids[$key]}})"><i
                                    class="fa fa-trash"></i></a>
                            <img src="{{$cert}}" width="100%" />
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </td>                 
            </tr>
            <tr>
                <td><label for="" class="col-form-label offerlabel"><strong>Other
                            documents</strong></label></td>

                <td class="text-center"><label for="" class="form-label topofferlabel"></label></td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">State document type</label>
                </td>

                <td><input type="text" @if($this->control_mode == 0) readonly @endif
                    class="form-control makeAnOffer-input @error('step5.other_documents') is-invalid @enderror"
                    wire:model="step5.other_documents">
                    @error('step5.other_documents') 
                    <div class="invalid-feedback text-danger">
                        {{$message }}
                    </div>
                    @enderror</td>
            </tr>
            <tr>
                <td> <label for="" class="col-form-label offerlabel">Upload</label></td>

                <td>
                    <input type="file" @if($this->control_mode == 0) disabled @endif
                    class="form-control makeAnOffer-input @error('step5.other_document_image') is-invalid @enderror"
                    wire:model="step5.other_document_image" multiple>
                    <div wire:loading wire:target="step5.other_document_image">Uploading...</div>
                    @error('step5.other_document_image')
                    <em class="invalid-feedback">{{$message}}</em>
                    @enderror
                    @error('step5.other_document_image.*')
                    <em class="invalid-feedback">{{$message}}</em>
                    @enderror
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    @if (!empty($step5['other_document_image']))
                    <div class="row justify-content-center mb-4">
                        @foreach($step5['other_document_image'] as $key => $cert)
                        @if(gettype($cert)!='string' &&
                        in_array($cert->getClientOriginalExtension(),['doc','docx','pdf']))
                        <div class="col-md-1 position-relative">
                            @php
                            $file='';
                            switch($cert->getClientOriginalExtension()){
                            case 'pdf': $file=asset('images/pdf.png');break;
                            case 'doc': $file=asset('images/doc.png');break;
                            case 'docx': $file=asset('images/doc.png');break;
                            }
                            @endphp
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeTempImage4({{$key}})"><i class="fa fa-trash"></i></a>
                            <img src="{{$file}}" />
                        </div>
                        @elseif(in_array($cert->getClientOriginalExtension(),['png','jpg']))
                        <div class="col-md-1 position-relative">
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeTempImage4({{$key}})"><i class="fa fa-trash"></i></a>
                            <img src="{{$cert->temporaryUrl()}}" width="100%" />
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    @if (!empty($other_document_image))
                    <div class="row justify-content-center mb-4">
                        @foreach($other_document_image as $key => $cert)
                        <div class="col-md-1 position-relative">
                            @if(in_array(pathinfo($cert, PATHINFO_EXTENSION),['doc','docx','pdf']))
                            @php
                            $file='';
                            $extension = pathinfo($cert, PATHINFO_EXTENSION);
                            switch($extension){
                            case 'pdf': $file=asset('images/pdf.png');break;
                            case 'doc': $file=asset('images/doc.png');break;
                            case 'docx': $file=asset('images/doc.png');break;
                            }
                            @endphp
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeImage4({{$key}},{{$certificate_ids[$key]}})"><i
                                    class="fa fa-trash"></i></a>
                            <img src="{{$file}}" />
                            @elseif(in_array(pathinfo($cert, PATHINFO_EXTENSION),['png','jpg']))
                            <a href="javascript:;" class="position-absolute right-0"
                                wire:click="removeImage4({{$key}},{{$certificate_ids[$key]}})"><i
                                    class="fa fa-trash"></i></a>
                            <img src="{{$cert}}" width="100%" />
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </td>               
            </tr>
            </tbody>
            </table>
            <div class="text-center my-4 make-an-offerButton">

                <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn btn-warning
                    col-4" wire:click="changeStep(6)"
                    name="offerSubmit2" value="1">Save & Next</button>
            </div>
            </form>
        </div>
    </div>

    <div class="tab-pane make-An-text  @if($step == 6 || $this->step_count == 6) active show @else fade @endif" id="pills-iteminclude"
        role="tabpanel" aria-labelledby="pills-offer-tab">
        <div class="row position-relative">
            <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                    <thead>
                        <tr>
                            <td><label for="" class="col-form-label offerlabel"><strong>Items included and
                                        excluded in the sale</strong>
                                    <div class="list-inline-item">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Items Seller included and exclude in the sale.  Buyers can negotiate items in this section. N/A is not applicable"
                                            style="font-size: larger;"><img src="images/info.png"></a>
                                    </div>
                                </label></td>

                            <td class="text-center"><label for="" class="form-label topofferlabel">Seller</label>
                            </td>
                            <td class="text-center"><label for="" class="form-label topofferlabel">Buyer</label>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $step6_item = config()->get('constants.step6_items');
                        @endphp
                        @foreach ($this->step6['items'] as $k => $i)
                        <tr>
                            <td style="width: 30%;"> <label for="" class="col-form-label offerlabel">{{$k}}</label>
                            </td>

                            <td style="width: 20%;"> <label for="" class="col-form-label offerlabel">{{$i}}</label>
                            </td>
                            <td>
                                <select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step6.{{$k}}') is-invalid @enderror"
                                    wire:model="step6.{{$k}}">
                                    <option value="">(Yes/No)</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A" @if($i == 'N/A') selected disabled @endif>N/A</option>
                                </select>
                                @error('step6.'.$k)
                                <div class="error-label text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Additional items</label></td>

                            <td><input type="text" value="{{$step6['seller']['additional_items'] ?? ''}}" readonly>
                            </td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step6.additional_items') is-invalid
                                @enderror"
                                wire:model="step6.additional_items">
                                @error('step6.additional_items') 
                                <div class="invalid-feedback text-danger">
                                    {{$message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Excluded items</label></td>

                            <td><input type="text" value="{{$step6['seller']['excluded_items'] ?? ''}}" readonly>
                            </td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step6.excluded_items') is-invalid
                                @enderror"
                                wire:model="step6.excluded_items">
                                @error('step6.excluded_items') <div class="invalid-feedback text-danger">{{
                                    $message }}</div>
                                @enderror</td>
                        </tr>


                    </tbody>
                </table>
                <div class="text-center my-4 make-an-offerButton">

                    <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn btn-warning
                        col-4" wire:click="changeStep(7)"
                        name="offerSubmit2" value="1">Save & Next</button>
                </div>
            </form>
        </div>
    </div>

    <div class="tab-pane make-An-text  @if($step == 7 || $this->step_count == 7) active show @else fade @endif" id="pills-costs"
        role="tabpanel" aria-labelledby="pills-offer-tab">
        <div class="row position-relative">
            <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                    <thead>
                        <tr>
                            <td><label for="" class="col-form-label offerlabel"><strong>Allocation of
                                        costs</strong>
                                    <div class="list-inline-item">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Buyers can negotiate items in this section."
                                            style="font-size: larger;"><img src="images/info.png"></a>
                                    </div>
                                </label></td>

                            <td class="text-center"><label for="" class="form-label topofferlabel"></label></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Natural hazards zone disclosure
                                    report</label>
                            </td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.natural_hazard_zone') is-invalid
                                    @enderror"
                                    wire:model="step7.natural_hazard_zone">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">50-50</option>
                                </select>
                                @error('step7.natural_hazard_zone') 
                                <div class="invalid-feedback text-danger">
                                    {{$message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Includes environmental</label>
                            </td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.environmental') is-invalid
                                    @enderror"
                                    wire:model="step7.environmental">
                                    <option value="" selected>Select one</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                                @error('step7.environmental') 
                                <div class="invalid-feedback text-danger">
                                    {{$message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Provided by</label></td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step7.provided_by') is-invalid
                                @enderror"
                                wire:model="step7.provided_by">
                                @error('step7.provided_by') 
                                <div class="invalid-feedback text-danger">
                                    {{$message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Other</label></td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step7.other') is-invalid @enderror"
                                wire:model="step7.other">
                                @error('step7.other') <div class="invalid-feedback text-danger">{{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Other report</label></td>

                            <td>
                                <input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step7.report_name') is-invalid
                                @enderror"
                                wire:model="step7.report_name">
                                @error('step7.report_name') <div class="invalid-feedback text-danger">{{
                                    $message }}</div>
                                @enderror
                                <select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.paid_by') is-invalid @enderror"
                                    wire:model="step7.paid_by">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                </select>
                                @error('step7.paid_by') 
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Smoke alarm, CO detect</label>
                            </td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.smoke_alarms') is-invalid
                                    @enderror"
                                    wire:model="step7.smoke_alarms">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                </select>
                                @error('step7.smoke_alarms') 
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Gov.. required point of
                                    sale</label></td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.gov_reports') is-invalid @enderror"
                                    wire:model="step7.gov_reports">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                </select>
                                @error('step7.gov_reports') <div class="invalid-feedback text-danger">{{
                                    $message }}</div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Government required point of
                                    sale corrective</label></td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.gov_required_point') is-invalid
                                    @enderror"
                                    wire:model="step7.gov_required_point">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                </select>
                                @error('step7.gov_required_point') <div class="invalid-feedback text-danger">{{
                                    $message }}</div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Escrow fees</label></td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.escrow_fees') is-invalid @enderror"
                                    wire:model="step7.escrow_fees">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                    <option value="pay_own_fee">Pay own fee</option>
                                </select>
                                @error('step7.escrow_fees')
                                 <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Escrow holder</label></td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step7.escrow_holder') is-invalid
                                @enderror"
                                wire:model="step7.escrow_holder">
                                @error('step7.escrow_holder') 
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Owner's title insurance</label>
                            </td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.insurance_policy') is-invalid
                                    @enderror"
                                    wire:model="step7.insurance_policy">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                </select>
                                @error('step7.insurance_policy') 
                                <div class="invalid-feedback text-danger">
                                    {{$message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Tittle company (if
                                    different)</label></td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step7.title_company') is-invalid
                                @enderror"
                                wire:model="step7.title_company">
                                @error('step7.title_company')
                                 <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Byuer's lender title insurance
                                    policy</label>
                            </td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.buyer_lender_policy') is-invalid
                                    @enderror"
                                    wire:model="step7.buyer_lender_policy">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                </select>
                                @error('step7.buyer_lender_policy') 
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">County transfer tax</label>
                            </td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.country_transfer_tax') is-invalid
                                    @enderror"
                                    wire:model="step7.country_transfer_tax">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                </select>
                                @error('step7.country_transfer_tax') 
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">City transfer tax</label></td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.city_transfer_tax') is-invalid
                                    @enderror"
                                    wire:model="step7.city_transfer_tax">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                </select>
                                @error('step7.city_transfer_tax') 
                                <div class="invalid-feedback text-danger">
                                    {{$message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Home warranty plan</label></td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step7.warranty_plan') is-invalid
                                    @enderror"
                                    wire:model="step7.warranty_plan">
                                    <option value="" selected>Select one</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="50">505-50</option>
                                    <option value="waives">Waives</option>
                                </select>
                                @error('step7.warranty_plan')
                                 <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Issued by</label></td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step7.issued_by') is-invalid
                                @enderror"
                                wire:model="step7.issued_by">
                                @error('step7.issued_by')
                                <div class="invalid-feedback text-danger">
                                    {{ $message}}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Cost not to exceed</label></td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step7.cost_not_exceed') is-invalid
                                @enderror"
                                wire:model="step7.cost_not_exceed">
                                @error('step7.cost_not_exceed') 
                                <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Other terms &
                                    conditions</label></td>

                            <td><input type="text" @if($this->control_mode == 0) readonly @endif
                                class="form-control makeAnOffer-input @error('step7.other_terms') is-invalid
                                @enderror"
                                wire:model="step7.other_terms">
                                @error('step7.other_terms') <div class="invalid-feedback text-danger">{{
                                    $message }}</div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Property type</label></td>

                            <td><input type="text" class="form-control makeAnOffer-input"
                                    value="{{$this->step7['property_type'] ?? ''}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Disclosur hoa fee</label></td>

                            <td><input type="text" class="form-control makeAnOffer-input"
                                    value="{{$this->step7['disclosure_hoa_fee'] ?? ''}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Hoa certification fee</label>
                            </td>

                            <td><input type="text" class="form-control makeAnOffer-input"
                                    value="{{$this->step7['hoa_certification_fee'] ?? ''}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Hoa transfer fee</label></td>

                            <td><input type="text" class="form-control makeAnOffer-input"
                                    value="{{$this->step7['hoa_transfer_fee'] ?? ''}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Private transfer fee</label>
                            </td>

                            <td><input type="text" class="form-control makeAnOffer-input"
                                    value="{{$this->step7['private_transfer_fee'] ?? ''}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Other fee</label></td>

                            <td><input type="text" class="form-control makeAnOffer-input"
                                    value="{{$this->step7['other_fee'] ?? ''}}" readonly>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="text-center my-4 make-an-offerButton">

                    <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn btn-warning
                        col-4" wire:click="changeStep(8)"
                        name="offerSubmit2" value="1">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="tab-pane make-An-text  @if($step == 8 || $this->step_count == 8) active show @else fade @endif" id="pills-summary"
        role="tabpanel" aria-labelledby="pills-offer-tab">
        <div class="row position-relative">
            <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                    <thead>
                        <tr>
                            <td><label for="" class="col-form-label offerlabel"><strong>Offer
                                        summary</strong>
                                    <div class="list-inline-item">
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Verify your Offer Summary. Go back to Smart Offer Terms Manager to edit your offer."
                                            style="font-size: larger;"><img src="images/info.png"></a>
                                    </div>
                                </label></td>

                            <td class="text-center"><label for="" class="form-label topofferlabel"></label></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">offered_price</label></td>

                            <td><span>{{$this->step8['offered_price'] ?? ''}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">closing_cost</label></td>

                            <td>{{$this->step8['closing_cost'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">seller_credit</label></td>

                            <td>{{$this->step8['seller_credit'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">closed_funds</label></td>

                            <td>{{$this->step8['closed_funds'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">mortgage_loan_1</label></td>

                            <td>{{$this->step8['mortgage_loan_1'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">mortgage_loan_2</label></td>

                            <td>{{$this->step8['mortgage_loan_2'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">initial_deposit</label></td>

                            <td>{{$this->step8['initial_deposit'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">deposit_increase</label></td>

                            <td>{{$this->step8['deposit_increase'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">closing_balance</label></td>

                            <td>{{$this->step8['closing_balance'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">escrow_closing</label></td>

                            <td>{{$this->step8['escrow_closing'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Approve offer</label></td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step8.approve') is-invalid @enderror"
                                    wire:model="step8.approve">
                                    <option value="" selected>Select one</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('step8.approve') <div class="invalid-feedback text-danger">{{ $message }}
                                </div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Read the Buyers
                                    Advisory</label>
                            </td>
                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step8.buyer_advisory') is-invalid
                                    @enderror"
                                    wire:model="step8.buyer_advisory">
                                    <option value="" selected>Select one</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('step8.buyer_advisory') <div class="invalid-feedback text-danger">{{
                                    $message
                                    }}</div>
                                @enderror</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">I need to talk to a
                                    realtor</label>
                            </td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step8.talk_with_realtor') is-invalid
                                    @enderror"
                                    wire:model="step8.talk_with_realtor">
                                    <option value="" selected>Select one</option>
                                    <option value="call_with_agent">Buyer</option>
                                    <option value="decline">Seller</option>
                                </select>
                                @error('step8.talk_with_realtor') <div class="invalid-feedback text-danger">{{
                                    $message }}</div>
                                @enderror</td>
                        </tr>
                        <tr>

                            <td> <label for="" class="col-form-label offerlabel">I want to submit my offer
                                    without
                                    the assistance of a realtor</label></td>

                            <td><select @if($this->control_mode == 0) disabled @endif
                                    class="form-select offerselect @error('step8.submit_without_assistance')
                                    is-invalid @enderror"
                                    wire:model="step8.submit_without_assistance">
                                    <option value="" selected>Select one</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                @error('step8.submit_without_assistance') <div class="invalid-feedback text-danger">
                                    {{ $message }}</div>
                                @enderror</td>

                        </tr>
                    </tbody>
                </table>
                <div class="text-center my-4 make-an-offerButton">

                    <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn btn-warning
                        col-4" wire:click="changeStep(9)"
                        name="offerSubmit2" value="1">Save & Next</button>
                </div>
            </form>
        </div>
    </div>

    <div class="tab-pane make-An-text  @if($step == 9) active show @else fade @endif" id="pills-fc" role="tabpanel"
        aria-labelledby="pills-offer-tab">
        <div class="row position-relative">
            <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                    <thead>
                        <tr>
                            <td><label for="" class="col-form-label offerlabel"><strong>Financial
                                        Credentials</strong></label></td>

                            <td class="text-center"><label for="" class="form-label topofferlabel"></label></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">My current offer</label></td>

                            <td><span>{{$this->step9['current_offer'] ?? ''}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Value i qualify for</label></td>

                            <td>
                                <span>{{$this->step9['qualify_value'] ?? ''}}</span>
                            </td>
                        </tr>
                        @if ($this->step9['loan_amount_1'] == 0 || $this->step9['loan_amount_2'] == 0)

                        @else
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Proof of funds</label></td>

                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Load preapproval</label></td>

                            <td>
                                {{$this->step9['loan_amount_1'] ?? ''}} - {{$this->step9['loan_amount_2'] ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Direct lender</label></td>

                            <td>
                                {{$this->step9['direct_lender_1'] ?? ''}} - {{$this->step9['direct_lender_2'] ??
                                ''}}
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Interest rate</label></td>

                            <td>
                                {{$this->step9['loan_interest_1'] ?? ''}} - {{$this->step9['loan_interest_2'] ??
                                ''}}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Upload</label></td>

                            <td><input type="file" @if($this->control_mode == 0) disabled @endif
                                class="form-control makeAnOffer-input @error('step9.file') is-invalid @enderror"
                                wire:model="step9.file">
                                @error('step9.file')
                                <div class="error-label text-danger">
                                    {{$message}}
                                </div>
                                @enderror                                
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">I certify that this information is
                                    true and correct
                                    and established the maximum amount that i can offer in the purchase of this
                                    property</label></td>

                            <td><input type="checkbox" class="@error('step9.tnc') is-invalid @enderror" name=""
                                    value="1" id="" wire:model="step9.tnc">
                                @error('step9.tnc')
                                 <div class="invalid-feedback text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="text-center my-4 make-an-offerButton">

                    <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn btn-warning
                        col-4" wire:click="changeStep(10)"
                        name="offerSubmit2" value="1">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="tab-pane make-An-text  @if($step == 10) active show @else fade @endif" id="pills-es" role="tabpanel"
        aria-labelledby="pills-offer-tab">
        <div class="row position-relative">
            <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                <table class=" table-responsive-sm table table-bordered offertable" id="offertable">
                    <thead>
                        <tr>
                            <td><label for="" class="col-form-label offerlabel"><strong>Electronic
                                        signature</strong></label></td>

                            <td class="text-center"><label for="" class="form-label topofferlabel"></label></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2"> address</td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Your current bid</label></td>

                            <td><span>{{$this->step10['current_bid'] ?? ''}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Financial qualification</label>
                            </td>

                            <td><span>{{$this->step10['financial_qulification'] ?? ''}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Bid per square feet</label></td>

                            <td><span>{{$this->step10['bid_per_sqfeet'] ?? ''}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Est mortgage payment</label></td>

                            <td><span>{{$this->step10['est_morgage'] ?? ''}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="" class="col-form-label offerlabel">Upload file</label></td>

                            <td>
                                <input type="file"
                                    class="form-control makeAnOffer-input @error('step10.file') is-invalid @enderror"
                                    wire:model="step10.file" @if($this->control_mode == 0) disabled @endif >
                                @error('step10.file')
                                <em class="invalid-feedback">{{$message}}</em>
                                @enderror
                                <div wire:loading wire:target="step10.file">Uploading...</div>
                                @if (!empty($step10['file']))
                                <div class="justify-content-center mb-1">
                                    @if(gettype($step10['file'])!='string' &&
                                    in_array($step10['file']->getClientOriginalExtension(),['doc','docx','pdf']))
                                    @php
                                    $file='';
                                    switch($step10['file']->getClientOriginalExtension()){
                                    case 'pdf': $file=asset('images/pdf.png');break;
                                    case 'doc': $file=asset('images/doc.png');break;
                                    case 'docx': $file=asset('images/doc.png');break;
                                    }
                                    @endphp
                                    <img src="{{$file}}" />
                                </div>
                                @elseif(gettype($step10['file'])=='string')
                                <div class="justify-content-center mb-1">
                                <img src="{{$step10['file']}}" height="50px" width="50px"/>
                                </div>
                                @elseif(in_array($step10['file']->getClientOriginalExtension(),['png','jpg']))
                                <div class="justify-content-center mb-1">
                                    <img src="{{$step10['file']->temporaryUrl()}}" height="50px" width="50px" />
                                </div>
                                @endif
                                @endif
                            </td>
                        </tr>
                        <tr style="text-align: center;">
                            <td colspan="2">Please review and sign the "property disclosures" and your offer. The
                                purchase terms you submitted heve been populated in the CAR RPA (Property purchase
                                agreement)
                                attached. Click here to review</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td colspan="2"> <a href="{{route('download-pdf')}}" @if($this->control_mode == 0)
                                    class="disabled" @endif target="_blank"><div
                                        style="height: 50px; border: dotted;">
                                        Review</div></a></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td colspan="2">By submitting below I hereby consent to use legally binding electronic
                                signature in connection with the purchase of the property</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center my-4 make-an-offerButton">

                    <button type="button" @if($this->control_mode == 0) disabled @endif class="ms-4 btn btn-warning
                        col-4" wire:click="changeStep(11)"
                        name="offerSubmit2" value="1">Approve And Sign</button>
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>



{{-- <script>
    $(document).ready(function(){
    var id = $("#realState").val();
    alert(id);
    if (id == 'no') {

    $("#brokerage_firm").attr('readonly', true);
    $("#brokerage_license").attr('readonly', true);
    $("#agent_name").attr('readonly', true);
    $("#agent_license").attr('readonly', true);
    $("#agent_phone").attr('readonly', true);
    $("#agent_comission").attr('readonly', true);
    }
    else{
    $("#brokerage_firm").attr('readonly', false);
    $("#brokerage_license").attr('readonly', false);
    $("#agent_name").attr('readonly', false);
    $("#agent_license").attr('readonly', false);
    $("#agent_phone").attr('readonly', false);
    $("#agent_comission").attr('readonly', false);
    }
    });
</script> --}}
<script>
    function DownPayment() {
        var offered_price = $('#offered_prices').val().split(",").join("");
        var initial_deposit_amount = $('#initial_deposit_amount').val();
        var deposit_increase = $('#deposit_increase').val();
        var loan_amount_1 = $('#loan_amount_1').val();
        var loan_amount_2 = $('#loan_amount_2').val();
        var estimated_closing_costs = $('#estimated_closing_costs').val();
        var seller_credit = $('#seller_credit').val();

        var multiply = parseFloat(estimated_closing_costs) * parseInt(offered_price);
        var closing_cost = parseInt(offered_price) * parseFloat(estimated_closing_costs) / 100;

        var down_payment1 = (parseInt(offered_price) - initial_deposit_amount - deposit_increase - loan_amount_1 - loan_amount_2 + closing_cost - parseFloat(seller_credit));
        //var down_payment = (offered_price - initial_deposit_amount - deposit_increase - loan_amount_1 - loan_amount_2 + parseFloat(estimated_closing_costs) * parseInt(offered_price) - parseFloat(seller_credit));
        //console.log(down_payment1);
        $('#balance_of_downPayment').text(down_payment1);
    }
</script>
<script>
    function NetPrice() {

        var offer_price =  $('#offered_prices').val();
       // var offer_price=offer_price.replace('$','');
        // console.log(offer_price);
        var seller_credit = $('#seller_credit').val();
        if (offer_price == '') {
            alert('Fill offer price field');
        }else{
            var diffrence = parseInt(offer_price) * parseFloat(seller_credit) / 100;
            // var text="$";
            var net_amount = offer_price - diffrence;
            // var net_amount = text.concat(" ",net_amount);
        }
        @this.set('step2.net_price', net_amount);
    }
</script>
<script>
    $(document).ready(function(){
        $('.tabs-offers').on('click', function(e){
            var steps = $(this).text();
            if (steps == 'Transaction overview') {
                $('#offer-steps').val('transaction');
            }else if(steps == 'Acquisition strategy'){
                $('#offer-steps').val('strategy');
            }else if(steps == 'Contract Timings'){
                $('#offer-steps').val('contract_timings');
            }else if(steps == 'Documents verification and upload'){
                $('#offer-steps').val('doc_verification');
            }else if(steps == 'Items included and excluded in the sale'){
                $('#offer-steps').val('items_include_exclude');
            }else if(steps == 'Allocation of Costs'){
                $('#offer-steps').val('allocation_cost');
            }else if(steps == 'Offer Summary and approval'){
                $('#offer-steps').val('summary');
            }

        });
    });
    // $(document).ready(function(){
    //     $('.offerPrice').keypress(function() {
    //         $(this).val(function(i,v) {
    //             return '$' + v.replace('$',''); 
    //         });
    //     });
    // });
</script>
</div>