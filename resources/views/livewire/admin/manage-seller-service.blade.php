<div>
    <x-alert>
    </x-alert>
    <form class="kt-form" wire:submit.prevent="updatePage">
    	<div class="kt-portlet kt-portlet--mobile">			

			<table class="custom-table">
                <tr>
                    <th>SERVICE</th>
                    <th>QONECTIN</th>
                    <th>TRADITIONAL BROKERAGE</th>
                </tr>
                @foreach ($ids as $key => $services)                                    
                <tr style="vertical-align: top;">
                    <td>
                        <label for=""  >{{ $service[$key] }}</label>                       
                        <input type="hidden"  id=""  wire:model="ids.{{ $key }}">
                    </td>
                    <td>
                        <input type="radio"   id=""  wire:model="qonectin.{{ $key }}" value="yes"  >  Yes <br>
                        <input type="radio"    id="" wire:model="qonectin.{{ $key }}" value="no" > No  <br>
                        <input type="radio"   id="" wire:model="qonectin.{{ $key }}" value="never" > Never  <br>
                        <input type="radio"   id="" wire:model="qonectin.{{ $key }}" value="Sometimes" > Sometime  <br>
                        <input type="radio"   id="" wire:model="qonectin.{{ $key }}" value="other" > Other  <br>
                        {{-- <input type="text"  id="" wire:model="other['qonectin_'.{{ $key }}]"> --}}
                        <div class="form-group">
                            <input type="text" class="form-control @error('other.'.$key) is-invalid @enderror @if($qonectin[$key] != 'other') d-none @endif"  id="" wire:model="other.{{ $key }}">
                            @error('other.'.$key) <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </td>
                    <td>
                        <input type="radio"  id="" wire:model="traditional_realtor.{{ $key }}" value="yes" > Yes <br>
                        <input type="radio"  id="" wire:model="traditional_realtor.{{ $key }}" value="no" > No  <br>
                        <input type="radio"  id="" wire:model="traditional_realtor.{{ $key }}" value="never" > Never  <br>
                        <input type="radio"  id="" wire:model="traditional_realtor.{{ $key }}" value="Sometimes" > Sometime  <br>
                        <input type="radio"  id="" wire:model="traditional_realtor.{{ $key }}" value="traditional_other" > Other  <br>
                        {{-- <input type="text" class="form-control @if($traditional_realtor[$key] != 'traditional_other') d-none @endif"  id="" wire:model="traditional_other.{{ $key }}">
                        @error('traditional_realtor.{{ $key }}') <span class="error">{{ $message }}</span> @enderror --}}
                        <div class="form-group">
                            <input type="text" class="form-control @error('traditional_other.'.$key) is-invalid @enderror @if($traditional_realtor[$key] != 'traditional_other') d-none @endif"  id="" wire:model="traditional_other.{{ $key }}">
                            @error('traditional_other.'.$key) <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </td>
                 
                </tr>
                @endforeach
                
            </table>
			<div class="kt-portlet__foot">
				<div class="kt-form__actions">
					<button type="submit" class="btn btn-primary btn-bold">Submit</button>
					{{-- <a type="reset" class="btn btn-secondary" href="{{route('index')}}">Cancel</a> --}}
				</div>
			</div>
		</div>
    </form>
</div>
