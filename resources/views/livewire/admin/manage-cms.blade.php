<div>
    <x-alert>
    </x-alert>
    <form class="kt-form" wire:submit.prevent="updatePage">
    	<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						{!! $page->title !!}
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-actions">
						{{-- <a href="{{route($page->route)}}" target="_blank" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="View Page">
							<i class="flaticon-eye"></i>
						</a> --}}

					</div>
				</div>
			</div>

			<div class="kt-portlet__body">
				<div class="form-group row">
                    <label class="col-xl-4 col-lg-4 col-form-label required">
                        Page Title
                    </label>
                    <div class="col-lg-8 col-xl-8">
                        <input class="form-control @error('title') is-invalid @enderror" placeholder="Enter Page Title" type="text" wire:model="title" maxlength="60" />
                        <small>Maximum 60 Characters allowed</small>
                        @error('title')
                        <em class="error invalid-feedback" id="{{'title'}}-error">
                            {{ $message }}
                        </em>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-4 col-lg-4 col-form-label required">
                        Meta Description
                    </label>
                    <div class="col-lg-8 col-xl-8">
                        <textarea class="form-control @error('meta_desc') is-invalid @enderror" placeholder="Enter Meta Description" type="text" wire:model="meta_desc" rows="5" maxlength="160">{{old('meta_desc')}}</textarea>
                        <small>Maximum 160 Characters allowed</small>
                        @error('meta_desc')
                        <em class="error invalid-feedback" id="{{'meta_desc'}}-error">
                            {{ $message }}
                        </em>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-4 col-lg-4 col-form-label required">
                        Meta Keywords
                    </label>
                    <div class="col-lg-8 col-xl-8">
                        <textarea class="form-control @error('meta_key') is-invalid @enderror" placeholder="Enter Meta Keywords" type="text" wire:model="meta_key" rows="5">{{old('meta_key')}}</textarea>
                        @error('meta_key')
                        <em class="error invalid-feedback" id="{{'meta_key'}}-error">
                            {{ $message }}
                        </em>
                        @enderror
                    </div>
                </div>
				@if(count($sections)<=0)
				<div class="form-group" wire:ignore>
					<label>Content</label>
					<textarea class="form-control summernote">{{$content}}</textarea>
				</div>
				<div class="form-group">
					<input type="hidden" class="form-control @error('content') is-invalid @enderror" wire:model="content">
					@error('content')
					<em class="invalid-feedback">
						{{$message}}
					</em>
					@enderror
				</div>
				@else
	            <div class="kt-section kt-section--first">
	                <div class="kt-section__body">
	                    <div class="kt-portlet kt-portlet--bordered">
	                        <div class="kt-portlet__head">
	                            <div class="kt-portlet__head-label">
	                                <h3 class="kt-portlet__head-title">
	                                    Sections
	                                </h3>
	                            </div>
	                        </div>
	                        <div class="kt-portlet__body">
								@foreach($sections as $section)
									<div class="form-group row">
										<label class="col-xl-4 col-lg-4 col-form-label required">{{$section['title']}}</label>
										@switch($section['type'])
										@case('text')
										<div class="col-lg-8 col-xl-8">
											<input type="text" class="form-control @error('section_content.'.$section['slug']) is-invalid @enderror" wire:model="section_content.{{$section['slug']}}" @if(!empty($section['word_limit'])) maxlength="{{$section['word_limit']}}" @endif>
											@if(!empty($section['word_limit']))
											<small>Maximum {{$section['word_limit']}} characters allowed</small>
											@endif
											@error('section_content.'.$section['slug'])
											<em class="invalid-feedback">
												{{$message}}
											</em>
											@enderror
										</div>
										@break;
										@case('textarea')
										<div class="col-lg-8 col-xl-8">
											<textarea class="form-control @error('section_content.'.$section['slug']) is-invalid @enderror" wire:model="section_content.{{$section['slug']}}" rows="5">{{old('section_content.'.$section['slug'])}}</textarea>
											@error('section_content.'.$section['slug'])
											<em class="invalid-feedback">
												{{$message}}
											</em>
											@enderror
										</div>
										@break;
										@case('editor')
										<div class="col-lg-8 col-xl-8">
											<div wire:ignore>
				                                <textarea class="form-control summernote" id="summernote_{{$section['slug']}}">{{$section_content[$section['slug']]}}</textarea>
				                            </div>
				                            <div>
				                                <input type="hidden" class="form-control @error('section_content.'.$section['slug']) is-invalid @enderror" wire:model="section_content.{{$section['slug']}}">
				                                @error('section_content.'.$section['slug'])
				                                <em class="invalid-feedback">
				                                    {{$message}}
				                                </em>
				                                @enderror
				                            </div>
										</div>
										@break;
										@case('video')
										<div class="col-lg-8 col-xl-8">
											<input type="file" class="form-control @error('section_content.'.$section['slug']) is-invalid @enderror" wire:model="section_content.{{$section['slug']}}" >
											{{-- <input type="text" class="form-control @error('section_content.'.$section['slug']) is-invalid @enderror" wire:model="section_content.{{$section['slug']}}" @if(!empty($section['word_limit'])) maxlength="{{$section['word_limit']}}" @endif> --}}
											{{-- @if(!empty($section['word_limit']))
											<small>Maximum {{$section['word_limit']}} characters allowed</small>
											@endif --}}
											@error('section_content.'.$section['slug'])
											<em class="invalid-feedback">
												{{$message}}
											</em>
											@enderror

											@if($video_cms != "")
												
												<video width="320" height="240" controls>
													<source src="{{ asset($video_cms)}}" type="video/mp4">
												  </video>
											@endif
										</div>
										@break;
										@default
										<div class="col-lg-8 col-xl-8">
											<input type="text" class="form-control @error('section_content.'.$section['slug']) is-invalid @enderror" wire:model="section_content.{{$section['slug']}}" maxlength="{{$section['word_limit']}}">
											@if(!empty($section['word_limit']))
											<small>Maximum {{$section['word_limit']}} characters allowed</small>
											@endif
											@error('section_content.'.$section['slug'])
											<em class="invalid-feedback">
												{{$message}}
											</em>
											@enderror
										</div>
										@break;
										@endswitch
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				@endif
			</div>
			<div class="kt-portlet__foot">
				<div class="kt-form__actions">
					<button type="submit" class="btn btn-primary btn-bold">Submit</button>
					{{-- <a type="reset" class="btn btn-secondary" href="{{route('index')}}">Cancel</a> --}}
				</div>
			</div>
		</div>
    </form>
</div>

<script type="text/javascript" src="{{URL::asset('vendors/summernote/dist/summernote.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		window.addEventListener('update-summernote',function(event){
			@if(count($sections)<=0)

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
		    @else
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
			@endif
		});


			@if(count($sections)<=0)
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
		    @else
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
		@endif
	})
</script>
