<div class="pb-4">
    <x-alert>
    </x-alert>
    @if ($type == 'add')
    <form class="kt-form kt-form--label-right" wire:submit.prevent="submitFaq">
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group row">
                        @foreach($inputs as $key=>$value)
                        <div class="row mb-4 w-100"> 

                            <div class="col-lg-5 col-xl-5">
                            	<label class="required">Faq Category <span class="@if($key <=0) d-none @endif">{{ $key + 1 }}.</span></label>
                                
                                <select  class="form-control @error('faq_category_id.'.$key) is-invalid @enderror" wire:model="faq_category_id.{{$key}}">
                                    <option>Select One</option>
                                    @foreach($Faq_category as $Faq_category_data)
                                    <option value="{{ $Faq_category_data->id }}">{{ $Faq_category_data->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('faq_category_id.'.$key)
                                <em class="error invalid-feedback" id="{{ 'faq_category_id.'.$key }}-error">
                                    {{ $message }}
                                </em>
                                @enderror
                            </div>

                            <div class="col-lg-5 col-xl-5">
                            	<label class="required">Question <span class="@if($key <=0) d-none @endif">{{ $key + 1 }}.</span></label>
                                <input class="form-control @error('faq_que.'.$key) is-invalid @enderror" placeholder="Input Topic"
                                type="text" wire:model="faq_que.{{$key}}"/>
                                @error('faq_que.'.$key)
                                    <em class="error invalid-feedback" id="{{ 'faq_que.'.$key }}-error">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                            @if($i > 1)
                            <div class="col-lg-1 col-xl-1 m-auto text-center">
                                <a href="javascript:;" class="btn btn-primary" wire:click="remove({{$key}})"><i class="flaticon-delete pr-0"></i></a>
                            </div>
                            @endif
                            </div>
                            <div class="row mb-4 w-100">
                            {{-- <div class="col-lg-12 col-xl-12">
                            	<label class="required">Answer <span class="@if($key <=0) d-none @endif">{{ $key + 1 }}.</span></label>
                            	<textarea class="form-control @error('faq_ans.'.$key) is-invalid @enderror" type="text" placeholder="Provide Answer for this topic" wire:model="faq_ans.{{$key}}"></textarea>
                                @error('faq_ans.'.$key)
                                    <em class="error invalid-feedback" id="{{ 'faq_ans.'.$key }}-error">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div> --}}

                            <div class="col-lg-8 col-xl-8">
                                <label class="required">Answer: <span class="@if($key <=0) d-none @endif">{{ $key + 1 }}.</span></label>
                                <div wire:ignore>                                
                                    <textarea class="form-control summernote" id="summernote_{{$key}}" wire:model="faq_ans.{{$key}}" width="100px"></textarea>                               
                                </div>
                                <div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control @error('faq_ans.'.$key) is-invalid @enderror" wire:model="faq_ans.{{$key}}"> 
                                        @error('faq_ans.'.$key)
                                        <em class="error invalid-feedback" id="{{ 'faq_ans.'.$key }}-error">
                                            {{ $message }}
                                        </em>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                        </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <a href="javascript:;" class="btn btn-primary m-auto" id="addNewFaq" wire:click="add({{$i}})">Add New FAQ</a>
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
                            Save Changes
                        </button>
                        <a class="btn btn-secondary" href="{{route('faq')}}">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>    
    @elseif($type == 'edit')
    <form class="kt-form kt-form--label-right" wire:submit.prevent="updateFaq">
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group row">
                        @foreach($inputs as $key=>$value)
                        <div class="row mb-4 w-100"> 

                            <div class="col-lg-5 col-xl-5">
                            	<label class="required">Faq Category <span class="@if($key <=0) d-none @endif">{{ $key + 1 }}.</span></label>
                                
                                <select  class="form-control @error('faq_category_id') is-invalid @enderror" wire:model="faq_category_id">
                                    <option>Select One</option>
                                    @foreach($Faq_category as $Faq_category_data)
                                    <option value="{{ $Faq_category_data->id }}">{{ $Faq_category_data->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('faq_category_id')
                                <em class="error invalid-feedback" id="{{'faq_category_id'}}-error">
                                    {{ $message }}
                                </em>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-xl-5">
                            	<label class="required">Question <span class="@if($key <=0) d-none @endif">{{ $key + 1 }}.</span></label>
                                <input class="form-control @error('faq_que') is-invalid @enderror" placeholder="Input Topic"
                                type="text" wire:model="faq_que"/>
                                @error('faq_que')
                                    <em class="error invalid-feedback" id="{{ 'faq_que' }}-error">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div>
                            </div>
                            <div class="row mb-4 w-100">
                            {{-- <div class="col-lg-12 col-xl-5">
                            	<label class="required">Answer <span class="@if($key <=0) d-none @endif">{{ $key + 1 }}.</span></label>
                            	<textarea class="form-control @error('faq_ans') is-invalid @enderror" type="text" placeholder="Provide Answer for this topic" wire:model="faq_ans">{{old('faq_ans')}}</textarea>
                                @error('faq_ans')
                                    <em class="error invalid-feedback" id="{{ 'faq_ans' }}-error">
                                        {{ $message }}
                                    </em>
                                @enderror
                            </div> --}}
                            {{-- @dd($faq_ans); --}}
                            <div class="col-lg-8 col-xl-8">
                                <label class="required">Answer: <span class="@if($key <=0) d-none @endif">{{ $key + 1 }}.</span></label>
                                <div wire:ignore>                                
                                    <textarea class="form-control summernote"  wire:model="faq_ans" width="100px"></textarea>                               
                                </div>
                                <div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control @error('faq_ans') is-invalid @enderror" wire:model="faq_ans"> 
                                        @error('faq_ans')
                                        <em class="error invalid-feedback" id="{{ 'faq_ans' }}-error">
                                            {{ $message }}
                                        </em>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                        </div>
                        @endforeach
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
                            Save Changes
                        </button>
                        <a class="btn btn-secondary" href="{{route('faq')}}">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>   
    @endif
</div>
<script type="text/javascript" src="{{URL::asset('vendors/summernote/dist/summernote.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		window.addEventListener('update-summernote',function(event){
			
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
                                @this.set('faq_ans.' + slug, contents);
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
                    @this.set('faq_ans', contents);
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

                        @this.set('faq_ans.' + slug, contents);
                    }
                },
            });
        })
		
	})
</script>