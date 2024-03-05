@if(session()->has('error'))
<div class="alert alert-outline-danger fade show" id="errorAlert" role="alert">
    <div class="alert-icon">
        <i class="flaticon-warning">
        </i>
    </div>
    <div class="alert-text">
        {{session('error')}}
    </div>
    <div class="alert-close">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">
                <i class="la la-close">
                </i>
            </span>
        </button>
    </div>
</div>
@elseif(session()->has('success'))
<div class="alert alert-outline-success fade show" id="successAlert" role="alert">
    <div class="alert-icon">
        <i class="flaticon-success">
        </i>
    </div>
    <div class="alert-text">
        {{session('success')}}
    </div>
    <div class="alert-close">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">
                <i class="la la-close">
                </i>
            </span>
        </button>
    </div>
</div>
@elseif(session()->has('message'))
<div class="alert alert-outline-success fade show" id="successAlert" role="alert">
    <div class="alert-icon">
        <i class="la la-check-circle">
        </i>
    </div>
    <div class="alert-text">
        {{session('message')}}
    </div>
    <div class="alert-close">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">
                <i class="la la-close">
                </i>
            </span>
        </button>
    </div>
</div>
@endif
