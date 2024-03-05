<div>
    <div class="modal-content">
        <div class="modal-header">
            <h4>Extend Deadline</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="submit">
            <div>
                <div class="modal-body contact-form">
                    <x-web-alert>
                    </x-web-alert>
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center">
                            Extended Date & Time<span class="text-danger">*</span>
                        </div>
                        <div class="col-md-8">
                            <div class="row extended-date-main">
                                <div class="col-md-6">
                                    <input type="date" class="feedback-input mb-0 @error('extended_date') is-invalid @enderror" placeholder="Please select extended deadline" data-date="" data-date-format="YYYY-MM-DD" min="{{date("Y-m-d")}}" wire:model="extended_date" id="extended_date" @if($user_control==0) disabled @endif>
                                    @error('extended_date')
                                    <div class="invalid-feedback text-danger">
                                        {{$message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="feedback-input @error('extended_hours') is-invalid @enderror" wire:model="extended_hours" id="extended_hours" @if($user_control==0) disabled @endif>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">pm</span>
                                        </div>
                                        @error('extended_hours')
                                        <div class="invalid-feedback text-danger">
                                            {{$message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center">
                            Highest and best offer<span class="text-danger">*</span>
                        </div>
                        <div class="col-md-8">
                            <select class="feedback-input @error('additional_hours') is-invalid @enderror" wire:model="additional_hours" id="additional_hours" @if($user_control==0) disabled @endif>
                                <option value="1">1 additional Hours</option>
                                <option value="2">2 additional Hours</option>
                                <option value="3">3 additional Hours</option>
                                <option value="4">4 additional Hours</option>
                                <option value="5">5 additional Hours</option>
                            </select>
                            @error('additional_hours')
                            <div class="invalid-feedback text-danger">
                                {{$message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary web-button" @if($user_control==0) disabled @endif>Update</button>
            </div>
        </form>
    </div>
</div>
