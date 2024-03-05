<div>
    <div class="modal-content">

        <div class="modal-header web">
            <h4>Offer of interest</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div style="height: 160px; overflow: auto;">
        <div class="modal-body">
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <form wire:submit.prevent="submitOfferInterest">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label offerlabel">My preferred way of communication is<span class="text-danger">*</span></label>
                    </div>
                </div>
                <input type="hidden" class="form-control @error('offer_id') is-invalid @enderror"
                wire:model="offer_id" value="{{$this->offer_id}}">
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" value="text" name="communication" id="" wire:model="type" @if($loguser->user_type == "seller" && $loguser->optin_out == "OPTOUT" || $loguser->user_type == "seller-agent" && $loguser->optin_out == "OPTIN") disabled @endif> &nbsp;Text
                    </div>
                    <div class="col-md-4">
                        <input type="radio" value="email" name="communication" id="" wire:model="type" @if($loguser->user_type == "seller" && $loguser->optin_out == "OPTOUT" || $loguser->user_type == "seller-agent" && $loguser->optin_out == "OPTIN") disabled @endif> &nbsp;Email
                    </div>
                    <div class="col-md-4">
                        <input type="radio" value="phone" name="communication" id="" wire:model="type" @if($loguser->user_type == "seller" && $loguser->optin_out == "OPTOUT" || $loguser->user_type == "seller-agent" && $loguser->optin_out == "OPTIN") disabled @endif> &nbsp;Phone
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @error('type') <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if($hidden)
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label offerlabel">What time is more convenient to contact you<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div>
                    <div class="col-md-12">
                        <select class="form-control @error('time') is-invalid @enderror" wire:model="time">
                        <option value="">Select one</option>
                        <option value="9-12">9-12 AM</option>
                        <option value="12-3">12-3 PM</option>
                        <option value="3-6">3-6 PM</option>
                        <option value="anytime">Anytime</option>
                        </select>
                        @error('time') <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @endif
        </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal" @if($loguser->user_type == "seller" && $loguser->optin_out == "OPTOUT" || $loguser->user_type == "seller-agent" && $loguser->optin_out == "OPTIN") disabled @endif>Save changes</button>
        </div>
        </form>
    </div>
</div>
