<div class="seller-card-inside contact-form p-4">
  @if ($contactus_msg == 2 )
        <div class=""><p class="ackmsg" id="show_message">Your message has been sent. A trusted Qonectin representative will contact you shortly.</p></div>
    @endif
  <div class="row contact-details">
    <div class="col-md-6">
      <li>
        <a href="tel:{{ Helper::getBladeSetting('contact_number') }}">
          <i class="bi bi-telephone-fill"></i> &nbsp;
          {{ Helper::getBladeSetting('contact_number') }}
        </a>
      </li>
    </div>
    <div class="col-md-6">
      <li class="mail">
        <a href="mailto:{{ Helper::getBladeSetting('contact_email') }}" style="text-decoration: none;">
          <i class="bi bi-envelope-fill"></i> &nbsp;
          <u>{{ Helper::getBladeSetting('contact_email') }}</u>
        </a>
      </li>
    </div>
  </div>
  <div class="col-md-12">
    <img src="{{ asset('web/img/contact-details-bottom-big.png') }}">
  </div>
  <form wire:submit.prevent="store">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <input  type="text" class="feedback-input @error('name') is-invalid @enderror" placeholder="Name" wire:model="name" />
          @error('name')
            	<div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>
        <div class="form-group">
          <input  type="text" class="feedback-input @error('email') is-invalid @enderror" placeholder="Email" wire:model="email"/>
          @error('email')
            	<div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>
          <input  type="text" class="feedback-input @error('phone') is-invalid @enderror" minlength="7" maxlength="15" placeholder="Phone (optional)" wire:model="phone"/>
          @error('phone')
            	<div class="invalid-feedback">{{$message}}</div>
          @enderror
      </div>
      <div class="col-md-6 text-start">
        <p>Preferred method of communication</p>
        <div class="form__group">
          <div class="form__radio-group">
            <input type="radio"  id="small" class="form__radio-input" value="Call" wire:model="communication_type">
            <label class="form__label-radio" for="small" class="form__radio-label">
              <span class="form__radio-button"></span> Call
            </label>
          </div>
          <div class="form__radio-group">
            <input type="radio"  id="large" class="form__radio-input" value="Text" wire:model="communication_type">
            <label class="form__label-radio" for="large" class="form__radio-label">
              <span class="form__radio-button"></span> Text
            </label>
          </div>
          <div class="form__radio-group">
            <input type="radio"  id="large" class="form__radio-input" value="Email" wire:model="communication_type">
            <label class="form__label-radio" for="large" class="form__radio-label">
              <span class="form__radio-button"></span> Email
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="row what-can-help mt-4">
      <p class="description h-0">What can we help you with?</p>
      <div class="col-md-12">
        <div class="form__group">
          <div class="form__radio-group">
            <input type="radio"  id="small" class="form__radio-input" value="Sell my home" wire:model="help_type">
            <label class="form__label-radio" for="small" class="form__radio-label">
              <span class="form__radio-button"></span> Sell my home
            </label>
          </div>
          <div class="form__radio-group">
            <input type="radio"  id="large" class="form__radio-input" value="Submit a SMART offer"  wire:model="help_type">
            <label class="form__label-radio" for="large" class="form__radio-label">
              <span class="form__radio-button"></span> Submit a SMART offer
            </label>
          </div>
          <div class="form__radio-group">
            <input type="radio"  id="large" class="form__radio-input" value="Talk to a real estate consultant" wire:model="help_type">
            <label class="form__label-radio" for="large" class="form__radio-label">
              <span class="form__radio-button"></span> Talk to a real estate consultant
            </label>
          </div>
          <div class="form__radio-group">
            <input type="radio"  id="small" class="form__radio-input" value="Buy a home" wire:model="help_type">
            <label class="form__label-radio" for="small" class="form__radio-label">
              <span class="form__radio-button"></span> Buy a home
            </label>
          </div>
          <div class="form__radio-group">
            <input type="radio"  id="large" class="form__radio-input" value="Career opportunities" wire:model="help_type">
            <label class="form__label-radio" for="large" class="form__radio-label">
              <span class="form__radio-button"></span> Career opportunities
            </label>
          </div>
          <div class="form__radio-group">
            <input type="radio"  id="large" class="form__radio-input" value="Find the value of my home" wire:model="help_type">
            <label class="form__label-radio" for="large" class="form__radio-label">
              <span class="form__radio-button"></span> Find the value of my home
            </label>
          </div>
        </div>
        <input  type="text"  class="feedback-input" placeholder="Looking for something else? Tell us." wire:model="description" />
      </div>
    </div>
    <button class="btn contact-form-submit" type="submit" >LET'S TALK!</button>
  </form>
</div>
<script>
  window.addEventListener('show', event => {
    $('html,body').animate({
        scrollTop: $('#show_message').offset().top - 200
    })
});
 
</script>