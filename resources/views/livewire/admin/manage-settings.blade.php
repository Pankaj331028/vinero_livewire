<div class="pb-4">
    <x-alert>
    </x-alert>
    <form class="kt-form kt-form--label-right" wire:submit.prevent="submitSettings" enctype="multipart/form-data">
        @foreach($settings as $key => $value)
	        <div class="kt-portlet">
	            <div class="kt-portlet__head">
	                <div class="kt-portlet__head-toolbar">
	                	<strong>{{str_replace('_', ' ', $key)}}</strong>
	                </div>
	            </div>
		        <div class="kt-portlet__body">
		            <div class="kt-section kt-section--first">
		                <div class="kt-section__body">
			                @foreach($value as $field => $val)
								{{-- {{ dd($field) }} --}}
	                    		<div class="form-group row @if($val_types[$field]=='boolean') justify-content-center @endif">
			                        <label class="col-form-label @if($val_types[$field]=='boolean') col-xl-8 col-lg-8 kt-checkbox settings @else col-xl-4 col-lg-4 @endif">
			                            <em class="col-xl-5 col-lg-5 text-break font-normal @if($val_types[$field]=='boolean') d-flex @endif">{{$names[$field]}}</em>

			                        	@if($val_types[$field]=='boolean')
			                            	<input type="checkbox" class="col-xl-5 col-lg-5" wire:model="settings.{{$key}}.{{$field}}" value="1"/>
			                            	<span></span>
			                        	@endif
			                        </label>


			                        @if($val_types[$field]!='boolean')
			                        	<div class="col-lg-6 col-xl-6">
				                            @switch($val_types[$field])

				                                    @case('textarea')
				                            <textarea class="form-control @error('settings.'.$key.'.'.$field) is-invalid @enderror" wire:model="settings.{{$key}}.{{$field}}">{{$textarea[$field]}}</textarea>
				                            @break;
				                                    @case('integer')
				                            <input class="form-control numberInput @error('settings.'.$key.'.'.$field) is-invalid @enderror" type="text" wire:model="settings.{{$key}}.{{$field}}"/>
				                            @break;
				                                    @case('decimal')
				                            <input class="form-control decimalInput @error('settings.'.$key.'.'.$field) is-invalid @enderror" type="text" wire:model="settings.{{$key}}.{{$field}}"/>
				                            @break;
													@case('video')
				                            <input class="form-control @error('settings.'.$key.'.'.$field) is-invalid @enderror" type="file" wire:model="settings.{{$key}}.{{$field}}"/>
											
											@if($this->video[$field] != "")
												
												<video width="320" height="240" controls>
													<source src="{{ asset($this->video[$field]) }}" type="video/mp4">
												  </video>
											@endif
				                            @break;
				                                    @default
				                            <input class="form-control @error('settings.'.$key.'.'.$field) is-invalid @enderror" type="text" wire:model="settings.{{$key}}.{{$field}}"/>
				                            @break;
				                                    @endswitch
				                                    @error('settings.'.$key.'.'.$field)
				                            <em class="error invalid-feedback" id="{{'settings.'.$key.'.'.$field}}-error">
				                                {{ $message }}
				                            </em>
				                            @enderror
				                        </div>
			                        @endif
			                	</div>
			                @endforeach
		                </div>
	                </div>
	            </div>
	        </div>
        @endforeach

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-3 col-xl-3">
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <button class="btn btn-primary btn-bold" type="submit">
                            Save Changes
                        </button>
                        <a class="btn btn-secondary" href="{{route('index')}}">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>