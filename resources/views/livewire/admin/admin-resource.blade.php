<div>
    <x-alert>
    </x-alert>
    <form class="kt-form kt-form--label-right" wire:submit.prevent="submitresource">
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group row">
                        {{-- <div class="row mb-4 w-100" id="row_1">
                            <div class="col-lg-12 col-xl-3">
                                <label class="required">Type:</label>
                                <div style="display: flex;">
                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                        <input type="checkbox" wire:model="type" value="agent" class="form-checkbox  @error('type') is-invalid @enderror">Agent
                                        <span></span>
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                        <input type="checkbox" wire:model="type" value="seller" class="form-checkbox  @error('type') is-invalid @enderror">Seller
                                        <span></span>
                                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                        <input type="checkbox" wire:model="type" value="buyer" class="form-checkbox  @error('type') is-invalid @enderror">Buyer
                                        <span></span>
                                    </label>
                                </div>
                                @error('type')
                                <div class="error-label text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div> --}}
                        <div style="display: flex;gap: 20px; "  >
                        <div class="row mb-4 w-100" id="row_1">
                            <div class="col-lg-12 col-xl-3">
                                <label class="required">Title:</label>

                                    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Resource Title" wire:model="name">
                                    @error('name')
                                        <em class="error invalid-feedback" id="{{'name'}}-error">
                                            {{ $message }}
                                        </em>
                                    @enderror

                            </div>
                        </div>
                        <div class="row mb-4 w-100" id="row_1">
                            
                            <div class="col-lg-12 col-xl-3">
                            	<label class="required">File:</label>
                            	<input class="form-control @error('file') is-invalid @enderror" type="file" wire:model="file">
                                @if(isset($oldfilepath))
                                <img class="p-3" src="{{ asset($oldfilepath) }}" alt="" width="100px" height="80px">
                                @endif
                                
                                @error('file')
                                    <em class="error invalid-feedback" id="{{ 'file'}}-error">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                            
                        </div>  
                        </div>
                        <div class="row mb-4 w-100" id="row_1">
                            <div class="col-lg-12 col-xl-3">
                                <label class="required">Short description:</label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="" wire:model="short_description" maxlength="500"></textarea>
                                    {{-- <input class="form-control @error('short_description') is-invalid @enderror" type="text" placeholder="Resource Short Description" wire:model="short_description"> --}}
                                    @error('short_description')
                                        <em class="error invalid-feedback" id="{{'short_description'}}-error">
                                            {{ $message }}
                                        </em>
                                    @enderror

                            </div>
                        </div>                      
                        <div class="col-lg-8 col-xl-8">
                            <label class="required">Description:</label>
                            <div wire:ignore>                                
                                <textarea class="form-control summernote" id="" wire:model="content" width="100px"></textarea>                               
                            </div>
                            <div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control @error('content') is-invalid @enderror" wire:model="content"> 
                                        @error('content')
                                            <em class="invalid-feedback">
                                                {{$message}}
                                            </em>
                                        @enderror 
                                </div>
                            </div>
                        </div>                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-3 col-xl-3">
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <button class="btn btn-primary btn-bold" type="submit">
                            {{$types=='add'?'Save':'Update'}}
                        </button>
                        <a class="btn btn-secondary" href="{{route('resource')}}">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{URL::asset('vendors/summernote/dist/summernote.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		window.addEventListener('update-summernote',function(event){
			

		    	$('.summernote').summernote('destroy');
		    	$('.summernote').summernote({
		            height: 300,
		            minHeight: null, // set minimum height of editor
		            maxHeight: null, // set maximum height of editor
		            focus: false, // set focus to editable area after initializing summernote
		            lineWrapping: true,
		            prettifyHtml: true,
		            callbacks: {
		                onChange: function(contents, $editable) {
		                	if(contents == "<p><br></p>"){
		                		contents = '';
		                	}
		                	console.log(contents);
		                    @this.set('content', contents);
		                }
		            },
		        });
		  
			$('.summernote').each(function(index,item){

				var slug = $(this).attr('id').replace('summernote_','');
		    	$(this).summernote('destroy');
		    	$(this).summernote({
		            height: 300,
		            minHeight: null, // set minimum height of editor
		            maxHeight: null, // set maximum height of editor
		            focus: false, // set focus to editable area after initializing summernote
		            lineWrapping: true,
		            prettifyHtml: true,
		            callbacks: {
		                onChange: function(contents, $editable) {
		                	if(contents == "<p><br></p>"){
		                		contents = '';
		                	}
		                	console.log(contents);
		                    @this.set('section_content.' + slug, contents);
		                }
		            },
		        });
			})
		
		});


			
		    	$('.summernote').summernote({
		            height: 300,
		            minHeight: null, // set minimum height of editor
		            maxHeight: null, // set maximum height of editor
		            focus: false, // set focus to editable area after initializing summernote
		            lineWrapping: true,
		            prettifyHtml: true,
		            callbacks: {
		                onChange: function(contents, $editable) {
		                	if(contents == "<p><br></p>"){
		                		contents = '';
		                	}
		                	console.log(contents);
		                    @this.set('content', contents);
		                }
		            },
		        });
		
    	$('.summernote').each(function(index,item){

			var slug = $(this).attr('id').replace('summernote_','');
	    	$(this).summernote({
	            height: 300,
	            minHeight: null, // set minimum height of editor
	            maxHeight: null, // set maximum height of editor
	            focus: false, // set focus to editable area after initializing summernote
	            lineWrapping: true,
	            prettifyHtml: true,
	            callbacks: {
	                onChange: function(contents, $editable) {
	                	if(contents == "<p><br></p>"){
	                		contents = '';
	                	}

	                    @this.set('section_content.' + slug, contents);
	                }
	            },
	        });
		})
		
	})
</script>