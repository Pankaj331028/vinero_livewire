@if(session()->has('error'))
<div class="alert alert-outline-danger fade show p-2 mt-2" id="errorAlert" role="alert">
    <div class="alert-text">
        {{session('error')}}
    </div>
</div>
@elseif(session()->has('success'))
<div class="alert alert-outline-success fade show p-2 mt-2" id="successAlert" role="alert">
    <div class="alert-text">
        {{session('success')}}
    </div>
</div>
@elseif(session()->has('message'))
<div class="alert alert-outline-success fade show p-2 mt-2" id="successAlert" role="alert">
    <div class="alert-text">
        {{session('message')}}
    </div>
</div>
@endif
