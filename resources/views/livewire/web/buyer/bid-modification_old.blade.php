<div>
    <div class="modal-content">
        <div class="modal-header web">
            <h4>Bid modification</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div style="height: 400px; overflow: auto;">
            <div class="modal-body">
                <div class="row" style="margin-right: 10px; margin-left: 10px;">
                    <form wire:submit.prevent="submitModifyOffer">
                        <div class="row counter-offer">

                            <div class="col-md-4">
                                <label for="" class="col-form-label offerlabel">Current bid</label>
                            </div>
                            <div class="col-md-8">
                                {{$this->current_bid ?? ''}}
                            </div>
                        </div>
                        <div class="row counter-offer">

                            <div class="col-md-4">
                                <label for="" class="col-form-label offerlabel">Financial Qualifications</label>
                            </div>
                            <div class="col-md-8">
                                {{$this->financial_qualification ?? ''}}
                            </div>
                        </div>
                        <div class="row counter-offer">

                            <div class="col-md-4">
                                <label for="" class="col-form-label offerlabel">Bid per square feet</label>
                            </div>
                            <div class="col-md-8">
                                {{$this->bid_per_sqfeet ?? ''}}
                            </div>
                        </div>
                        <div class="row counter-offer">
                            <div class="col-md-4">
                                <label for="" class="col-form-label offerlabel">Est mortgage payment</label>
                                <br>
                                (verify with your lender)
                            </div>
                            <div class="col-md-8">
                                {{$this->est_mortigage_payment ?? ''}}
                            </div>
                        </div>
                        <div class="row counter-offer">
                            <div class="col-md-12">
                                <input type="radio" wire:model="improve" name="improve" value="1" class="improve"
                                    id="improve" @if($this->control_mode == 0) disabled @endif>&nbsp;&nbsp;<label for="" class="col-form-label offerlabel">Improve my offer
                                    to</label>
                            </div>
                        </div>
                        @if ($this->imp == 1)
                        <div class="row counter-offer amount">
                            <div class="col-md-12">
                                <input type="text" class="form-control @error('amount') is-invalid @enderror" id=""
                                    wire:model="amount" @if($this->control_mode == 0) disabled @endif>
                                @error('amount') <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="row counter-offer">
                            <div class="col-md-12">
                                <input type="radio" wire:model="improve" name="improve" value="2" class="improve"
                                    id="improve" @if($this->control_mode == 0) disabled @endif>&nbsp;&nbsp;<label for="" class="col-form-label offerlabel">Upload modified
                                    financial credentials</label>
                            </div>
                        </div>
                        @if ($this->imp == 2)
                        <div class="row counter-offer file">
                            <div class="col-md-12">
                                <input type="file" class="form-control @error('file') is-invalid @enderror"
                                    id="" @if($this->control_mode == 0) disabled @endif>&nbsp;&nbsp;<label for="" class="col-form-label offerlabel">Upload modified
                                        wire:model="file" >
                                @error('file') <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="row counter-offer">
                            <div class="col-md-12">
                                <input type="radio" wire:model="improve" value="3" name="improve" class="improve"
                                    id="" @if($this->control_mode == 0) disabled @endif>&nbsp;&nbsp;<label for="" class="col-form-label offerlabel">Upload modified
                                        id="" >&nbsp;&nbsp;<label for="" class="col-form-label offerlabel">
                                    I'm no longer interested, please withdraw my offer and close my file
                                </label>
                            </div>
                        </div>
                        <div class="row counter-offer">
                            <div class="col-md-12">
                                @error('improve')
                                <div class="error-label text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row counter-offer">
                            <div class="col-md-12">
                                By clicking below i hereby consent to use electronic documents and signatures in
                                connection
                                with the purchase of this property.
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" @if($this->control_mode == 0) disabled @endif id="save-changes"  class="btn btn-primary web-button" data-bs-dismiss="modal">Save changes</button>
        </div>
        <input type="text" name="" id="hide" value="{{$open_model}}">
        </form>
    </div>
    <div wire:ignore.self class="modal fade" id="#cancel-offer" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header web">
                    <h4>Offer Cancel</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div style="height: 400px; overflow: auto;">
                    <div class="modal-body">
                        <div class="row" style="margin-right: 10px; margin-left: 10px;">


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $("#save-changes").on('click', function(){
                var value = $("#hide").val();
                if (value == 1) {
                    $('#cancel-offer').modal('show');
                }
            });
        });
    </script>
</div>
