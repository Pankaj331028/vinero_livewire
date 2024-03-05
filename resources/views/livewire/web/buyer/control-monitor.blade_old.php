<div>

@if ($monitor == 'noAgent')

    <div class="modal-content">
        <x-alert>
        </x-alert>
        <div class="modal-header web">
            <h4>Control and monitor</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div style="height: 250px; overflow: auto;">
        <div class="modal-body">
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <form wire:submit.prevent="submitoptInOut2">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label offerlabel">Select one option</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" value="OPTIN" name="communication" id="" wire:model="type"> &nbsp;OPTIN

                    </div>
                    <div class="col-md-8">
                        Buyer elects to monitor and controll Qonectin's "Vertial agent".
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" value="OPTOUTMODE2" name="communication" id="" wire:model="type"> &nbsp;OPTOUT MODE 2

                    </div>
                    <div class="col-md-8">
                        Buyer elects not to be informed and opts out of receiving updates.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @error('type') <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal" required>Save changes</button>
        </div>
        </form>
    </div>
@elseif($monitor == 'offer-of-intrest')
    <div class="modal-content">

        <div class="modal-header web">
            <h4>Offer of interest</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div style="height: 200px; overflow: auto;">
        <div class="modal-body">
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <form wire:submit.prevent="submitOfferInterest">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label offerlabel">My preferred way of communication is</label>
                    </div>
                </div>
                {{-- <input type="hidden" class="form-control @error('offer_id') is-invalid @enderror"
                wire:model="offer_id" value="{{$this->offer_id}}"> --}}
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" value="text" name="communication" id="" wire:model="type"> &nbsp;Text

                    </div>
                    <div class="col-md-4">
                        <input type="radio" value="email" name="communication" id="" wire:model="type"> &nbsp;Email

                    </div>
                    <div class="col-md-4">
                        <input type="radio" value="phone" name="communication" id="" wire:model="type"> &nbsp;Phone

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @error('type') <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @if($hidden == 1)
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label offerlabel">What time is more convenient to contact you</label>
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
            <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal">Save changes</button>
        </div>
        </form>
    </div>
@else
    <div class="modal-content">
        <x-alert>
        </x-alert>
        <div class="modal-header web">
            <h4>Control and monitor</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div style="height: 250px; overflow: auto;">
        <div class="modal-body">
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <form wire:submit.prevent="submitoptInOut3">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="col-form-label offerlabel">Select one option</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" value="OPTIN" name="communication" id="" wire:model="type"> &nbsp;OPTIN

                    </div>
                    <div class="col-md-8">
                        Buyer elects to monitor and controll Qonectin's "Vertial agent".
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" value="OPTOUTMODE1" name="communication" id="" wire:model="type"> &nbsp;OPTOUT MODE 1

                    </div>
                    <div class="col-md-8">
                        Buyer elects to monitor and controll Qonectin's "Vertial agent".
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" value="OPTOUTMODE2" name="communication" id="" wire:model="type"> &nbsp;OPTOUT MODE 2

                    </div>
                    <div class="col-md-8">
                        Buyer elects not to be informed and opts out of receiving updates.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @error('type') <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary web-button" data-bs-dismiss="modal" required>Save changes</button>
        </div>
        </form>
    </div>
    @endif
</div>
