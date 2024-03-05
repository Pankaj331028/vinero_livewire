<div>
    <div class="modal-content">
        <div class="modal-header web">
            <h4>Offer of interest</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div style="height: 400px; overflow: auto;">
        <div class="modal-body">
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <form wire:submit.prevent="submitOfferManagement">
                <div class="row"> 
                    <div class="col-md-12">
                        <label for="" class="col-form-label offerlabel">Extend offer deadline</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="date" class="form-control @error('extended_date') is-invalid @enderror"
                            wire:model="extended_date" @if($loguser->user_type == "seller" && $loguser->optin_out == "OPTOUT" || $loguser->user_type == "seller-agent" && $loguser->optin_out == "OPTIN") readonly @endif>
                        @error('extended_date') <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control @error('extended_hours') is-invalid @enderror"
                            wire:model="extended_hours" @if($loguser->user_type == "seller" && $loguser->optin_out == "OPTOUT" || $loguser->user_type == "seller-agent" && $loguser->optin_out == "OPTIN") readonly @endif>
                        @error('extended_hours') <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-12">
                        <label for="" class="col-form-label offerlabel">Highest and best offer</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <select class="form-control @error('additional_hours') is-invalid @enderror" wire:model="additional_hours" @if($loguser->user_type == "seller" && $loguser->optin_out == "OPTOUT" || $loguser->user_type == "seller-agent" && $loguser->optin_out == "OPTIN") disabled @endif>
                        <option value="1">1 hr</option>
                        <option value="2">2 hr</option>
                        <option value="3">3 hr</option>
                        <option value="4">4 hr</option>
                        <option value="5">5 hr</option>
                        <option value="6">6 hr</option>
                        <option value="7">7 hr</option>
                        </select>
                        @error('additional_hours') <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="col-form-label offerlabel">Reserved Price</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" readonly class="form-control" value="{{$property->reserved_price ?? ''}}">  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="col-form-label offerlabel">Offers due deadline</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="{{$this->offer_due_deadline}}" readonly class="form-control">  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="col-form-label offerlabel">Offers increase minimum</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" readonly class="form-control" value="{{$property->offer_increase ?? ''}}">  
                    </div>
                </div>
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
