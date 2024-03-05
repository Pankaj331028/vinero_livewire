<div>
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
            <form wire:submit.prevent="submitoptInOut">
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
                        Seller elects to control Qonectin "virtual agent app" and allow listing agent to monitor offer activities.
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <input type="radio" value="OPTOUT" name="communication" id="" wire:model="type"> &nbsp;OPTOUT
                        
                    </div>
                    <div class="col-md-8">
                        Seller elects to surrender control of the app to listing agent and monitor offer activities.
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
</div>
