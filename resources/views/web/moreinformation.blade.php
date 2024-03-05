@extends('web.master')
@section('web.main')
    
<!--banner video sta  -->
<section class="signvideo">
<video loop="" muted="" autoplay="" width="100%" controls>
<source src="{{asset('web/images/RMF-Lounge-2.mp4')}}" type="video/mp4">
<source src="{{asset('web/images/RMF-Lounge-2.mp4')}}" type="video/ogg">
</video>
<div class="container positiosig">
<div class="row signformmore">
<div class="col-lg-8  ">
<div class="videocaption">
<h1>Doing More from <br>Listing to Sold</h1>
</div>
</div>
      <div class=" col-lg-4 d-block my-lg-0 my-3 signinfomore" style="height:100%">
        <div class="signrespon">
        <h3 class="contacttextForm">SIGN UP</h3>
        <hr class="h-line text-center conttacthr mb-3">
        <p class="lead" style="color:#383838; text-align:center;">To access our free tools and complementary Buyers and Sellers tips and resources.</p>
        <form action="">
        <div class="row">
        <div class="col-md-6 my-2">
        <input type="text" class="form-control logininput" id="exampleInputEmai121" placeholder="First Name"required>
        </div>
        <div class="col-md-6 my-2">
        <input type="text" class="form-control logininput" id="exampleInputEmail22" placeholder="Last Name"required>
        </div>
        <div class="col-md-12 my-2">
        <input type="email" class="form-control logininput" id="exampleInputEmail23" placeholder="Email"required>
        </div>
        <div class="col-md-12 my-2">
        <input type="password" class="form-control logininput" id="exampleInputEmail24" placeholder="Password"required>
        </div>
        <div class="col-md-12 my-2">
        <input type="password" class="form-control logininput" id="exampleInputEmail25" placeholder="Confirm password"required>
        </div>
        <small style="color:#383838;">atleast 8 characters, mix of letters and numbers or sysmbols.</small>
          <strong class="iamana">I am a:</strong>
        <div class="radiochecktypebutton ">
        <ul class="nav nav-pills tabsmoreinfoto" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link buood" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">  <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox1" name="justcheck" value="option1"required>
        <label class="form-check-label tbselect" for="inlineCheckbox1">Buyer</label>
        </div>
        </button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link buood" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">  <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox2" name="justcheck" value="option2"required>
        <label class="form-check-label tbselect" for="inlineCheckbox2">Owner</label>
        </div>
        </button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link buood" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox3" name="justcheck" value="option3" required>
        <label class="form-check-label tbselect" for="inlineCheckbox3">Just Checking </label>
        </div>
        </button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link buood" id="pills-contactu-tab" data-bs-toggle="pill" data-bs-target="#pills-contactu" type="button" role="tab" aria-controls="pills-contactu" aria-selected="false">  <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inlineCheckbox4" name="justcheck" value="option4" required>
        <label class="form-check-label tbselect" for="inlineCheckbox4">Agent </label>
        </div></button>
        </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="accordion" id="accordionExample">

        <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">
        I need a neighborhood Report
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <div class="userchecking">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label usercheckoo">Neighborhood or Property Address</label>
        <input type="text" class="form-control addressbox" id="exampleInputchecko1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko2" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1t" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1t">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2t" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2t">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3t" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3t">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        </div>

        <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
        <label class="form-check-label" for="flexRadioDefault2">
        I want to Submit an offer
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <div class="userchecking">
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">I am a</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1o" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio10">Buyer</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2o" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio20">Agent</label>
        </div>
        </div>
        <form action="">
        <div class="mb-3">
        <label for="exampleInputchecko3" class="form-label usercheckoo">Neighborhood or Property Address</label>
        <input type="text" class="form-control addressbox" id="exampleInputchecko3" aria-describedby="emailHelp">
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1u" value="option1" checked>
        <label class="form-check-label" for="exampleRadios1u">
        Open Offer Page
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2u" value="option2">
        <label class="form-check-label" for="exampleRadios2u">
        I dont have an access code, Please provide me access
        </label>
        </div>
        <p class="checoboxform mt-3"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        </div>

        <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" checked>
        <label class="form-check-label" for="flexRadioDefault3">
        Download resources
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <p class="checoboxform mt-3">Choose one of our REPORTS per day and you will receive immediately it by email</p>
        <form action="">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk1">
        <label class="form-check-label" for="defaultCheckk1">
        Guide to finance and buy a home
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk2">
        <label class="form-check-label" for="defaultCheckk2">
        Selling your home for maximum value
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk3">
        <label class="form-check-label" for="defaultCheckk3">
        Four things to know before buying a home
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk4">
        <label class="form-check-label" for="defaultCheckk4">
        Rent VS Buy
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk5">
        <label class="form-check-label" for="defaultCheckk5">
        Trading Down , empty nesters
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk6">
        <label class="form-check-label" for="defaultCheckk6">
        1030 Tax deferred exchange
        </label>
        </div>
        </form>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked>
        <label class="form-check-label" for="flexRadioDefault4">
        Talk to a 4TURA Trusted Advisor
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputchecko21" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko21" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1tp" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1tp">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2tp" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2tp">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3tp" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3tp">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5" checked>
        <label class="form-check-label" for="flexRadioDefault5">
        Want to know the property values of my home or in my neighborhood
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputchecko1" class="form-label userchecko">Neighborhood or Property Address</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko2" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1tl" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1tl">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2tl" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2tl">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3tl" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3tl">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <!-- 2 -->
        <div class="accordion" id="accordionExample1">
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingSix">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6">
        <label class="form-check-label" for="flexRadioDefault6">
        I need a neighborhood Report
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseSix" class="accordion-collapse collapse " aria-labelledby="headingSix" data-bs-parent="#accordionExample1">
        <div class="accordion-body">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputEmail1e" class="form-label usercheckoo">Neighborhood or Property Address</label>
        <input type="text" class="form-control addressbox" id="exampleInputchecko1e" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1e" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko2e" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1te" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1te">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2te" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2te">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3te" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3te">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingSeven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7" checked>
        <label class="form-check-label" for="flexRadioDefault7">
        Download resources
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample1">
        <div class="accordion-body">
        <form action="">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk12">
        <label class="form-check-label" for="defaultCheckk12">
        Guide to finance and buy a home
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk22">
        <label class="form-check-label" for="defaultCheckk22">
        Selling your home for maximum value
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk32">
        <label class="form-check-label" for="defaultCheckk32">
        Four things to know before buying a home
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk42">
        <label class="form-check-label" for="defaultCheckk42">
        Rent VS Buy
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk52">
        <label class="form-check-label" for="defaultCheckk52">
        Trading Down , empty nesters
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk62">
        <label class="form-check-label" for="defaultCheckk62">
        1030 Tax deferred exchange
        </label>
        </div>
        </form>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingEight">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8" checked>
        <label class="form-check-label" for="flexRadioDefault8">
        Talk to a 4TURA Trusted Advisor
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample1">
        <div class="accordion-body">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputchecko21m" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko21m" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1tpm" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1tpm">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2tpm" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2tpm">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3tpm" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3tpm">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingNine">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault9" checked>
        <label class="form-check-label" for="flexRadioDefault9">
        Want to know the property values of my home or in my neighborhood
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample1">
        <div class="accordion-body">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputchecko1u" class="form-label userchecko">Neighborhood or Property Address</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko1u" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1u" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko2u" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1tlu" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1tlu">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2tlu" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2tlu">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3tlu" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3tlu">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        <!-- 2 -->
        </div>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <!-- 3 -->
        <div class="accordion" id="accordionExample2">
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingTen">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault10">
        <label class="form-check-label" for="flexRadioDefault10">
        I need a neighborhood Report
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseTen" class="accordion-collapse collapse " aria-labelledby="headingTen" data-bs-parent="#accordionExample2">
        <div class="accordion-body">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputEmail1er" class="form-label usercheckoo">Neighborhood or Property Address</label>
        <input type="text" class="form-control addressbox" id="exampleInputchecko1er" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1er" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko2er" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1ter" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1ter">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2ter" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2ter">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3ter" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3ter">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingEleven">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11" checked>
        <label class="form-check-label" for="flexRadioDefault11">
        Download resources
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionExample2">
        <div class="accordion-body">
        <form action="">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk12i">
        <label class="form-check-label" for="defaultCheckk12i">
        Guide to finance and buy a home
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk22i">
        <label class="form-check-label" for="defaultCheckk22i">
        Selling your home for maximum value
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk32i">
        <label class="form-check-label" for="defaultCheckk32i">
        Four things to know before buying a home
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk42i">
        <label class="form-check-label" for="defaultCheckk42i">
        Rent VS Buy
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk52i">
        <label class="form-check-label" for="defaultCheckk52i">
        Trading Down , empty nesters
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="defaultCheckk62i">
        <label class="form-check-label" for="defaultCheckk62i">
        1030 Tax deferred exchange
        </label>
        </div>
        </form>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwelve">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault12" checked>
        <label class="form-check-label" for="flexRadioDefault12">
        Talk to a 4TURA Trusted Advisor
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#accordionExample2">
        <div class="accordion-body">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputchecko21mi" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko21mi" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1i" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1tpmi" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1tpmi">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2tpmi" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2tpmi">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3tpmi" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3tpmi">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingThirteen">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault13" checked>
        <label class="form-check-label" for="flexRadioDefault13">
        Want to know the property values of my home or in my neighborhood
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#accordionExample2">
        <div class="accordion-body">
        <form action="">
        <div class="mb-3">
        <label for="exampleInputchecko1ui" class="form-label userchecko">Neighborhood or Property Address</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko1ui" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1ui" class="form-label userchecko">Cell Phone</label>
        <input type="phone" class="form-control userchecko addressbox" id="exampleInputchecko2ui" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label userchecko">Preferred method of communication</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1tlui" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1tlui">Call</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2tlui" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2tlui">Text</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio3tlui" value="option3">
        <label class="form-check-label labelcheoc" for="inlineRadio3tlui">Email</label>
        </div>
        </div>
        <p class="checoboxform"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        </div>
        <!-- 3 -->
        </div>
        <div class="tab-pane fade" id="pills-contactu" role="tabpanel" aria-labelledby="pills-contactu-tab">
        <!-- 4 -->
        <div class="accordion" id="accordionExample3">
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingFourteen">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault14">
        <label class="form-check-label" for="flexRadioDefault14">
        I want to Submit an offer on behalf of my buyer client
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseFourteen" class="accordion-collapse collapse " aria-labelledby="headingFourteen" data-bs-parent="#accordionExample3">
        <div class="accordion-body">
        <div class="userchecking">
        <div class="mb-3">
        <label for="exampleInputEmail12" class="form-label userchecko">I am a</label> <br>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio1oo" value="option1">
        <label class="form-check-label labelcheoc" for="inlineRadio1oo">Buyer</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input formradiosub" type="radio" name="inlineRadioOptions" id="inlineRadio2oo" value="option2">
        <label class="form-check-label labelcheoc" for="inlineRadio2oo">Agent</label>
        </div>
        </div>
        <form action="">
        <div class="mb-3">
        <label for="exampleInputchecko3o" class="form-label usercheckoo">Neighborhood or Property Address</label>
        <input type="text" class="form-control addressbox" id="exampleInputchecko3o" aria-describedby="emailHelp">
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1uo" value="option1" checked>
        <label class="form-check-label" for="exampleRadios1uo">
        Open Offer Page
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2uo" value="option2">
        <label class="form-check-label" for="exampleRadios2uo">
        I dont have an access code, Please provide me access
        </label>
        </div>
        <p class="checoboxform mt-3"><strong class="strongchecko">YOUR REQUEST IS VERY IMPORTANT TO US, </strong> To speed up response please provide your cellphone and select your preferred method of communication:text,call or email</p>
        </form>
        </div>
        </div>
        </div>
        </div>
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingFifteen">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault15" checked>
        <label class="form-check-label" for="flexRadioDefault15">
        Want to know about career opportunities – Open JPG Recruiting Brochure, no download option
        </label>
        </div>
        </button>
        </h2>
        <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#accordionExample3">
        <div class="accordion-body">
        <!-- <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow. -->
        </div>
        </div>
        </div>
        </div>
        <!-- 4 -->
        </div>
        </div>
        <br>
        <button type="submit" name="button" class="submitmoreInfo" aria-label="create account button">create account</button>
        <p class="subaccounp">By submitting i accept the FUTURA  <a href="#" class="text-reset tdecor" style="text-decoration:none;"> term's of use</a></p>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>
<!-- experience of buyer seller -->
<div class="welcome-sec moreinfo">
<div class="container">
<div class="row">
<div class="col-md-4 mb-5">
<div class="left-bdr">
<h1 class="mt-3 mb-4 ">Redefining the Sellers and Buyer’s Experience</h1>
<a class="btn redefinigbtn" href="#"><img src="{{asset('web/images/rightarrow.png')}}" alt="img of right arrow"/></a>
</div>
</div>
<div class="col-md-8">
<div class="row ">
<div class="col-md-6 leses">
<div class="boxex my-3">
<h4>SELLER'S COMMISION PLAN'S</h4>
</div>
<div class="boxex my-3">
<p>EXCLUSIVE SELLERS’ AGENCY AT 2.5% BUYERS PAY THEIR OWN AGENT'S COMMISION</p>
<p>“BUYERS MARKET” STRATEGIC PRICING AVAILABLE</p>
</div>
<div class="boxex my-3">
<div class="calconic-calculator" data-calculatorid="5fd980b787472b001ed21773"> </div>
</div>
</div>
<div class="col-md-6 reses">
<div class="boxex my-3">
<h4>BUYER'S COMMISSION PLAN OPTIONS</h4>
</div>
<div class="boxex my-3">
<p>ZERO COMMISSION, WHEN YOU SUBMIT YOUR OWN OFFER ON ONE OF OUR LISTED PROPERTIES</p>
<p>.75 FEE, UP TO 6 HOURS OF DOCUMENTS PREPARATION & REVISIONS WITH A REAL ESTATE ATTORNEY</p>
<p>1% COMMISSION, REPRESENTED BY A FUTURA PREFERED REAL ESTATE AGENT</p>
<p>NEGOTIATE YOUR OWN COMMISSION, HIRE YOUR OWN AGENT</p>
<p>COMMISSION ABOVE 1% REBATED TO YOU ON NON FUTURA MLS PROPERTIES FOR FUTURA CLIENTS</p>
</div>
</div>
</div>
<p class="dolsav">Buyer’s commission plans subject to periodic revisions, and might not be available yet in certain markets, call for details</p>
</div>
</div>
</div>
</div>
<!-- pattern section start -->
<div class="pattern ">
<div class="container">
<div class="row">
<div class=" tablebg col-md-10 mx-auto  position-relative">
<h3 class="bg-dark ssr ">We do more for you from listing to sold</h3>

<table class="table table-bordered border-dark align-middle" id="listingtoSold">
<tbody>
<tr class="border-top-0 tradei">
<th class="border-start-0 border-top-0">Redefining the Traditional Realtor®</th>
<th class="border-top border-dark">FUTURA</th>
<th><span class="vscircle">vs</span></th>
<th class="border-top border-dark ">TRADITIONAL REALTOR®</th>
</tr>
<tr>
<td>Dedicated listing agent</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td><i class="fa-solid fa-check"></i></td>
</tr>
<tr>
<td>Listing contract length</td>
<td>4 months</td>
<td> </td>
<td>6 months</td>
</tr>
<tr>
<td>Luxury marketing</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td>Sometimes</td>
</tr>
<tr>
<td>Professional photos</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td>Sometimes</td>
</tr>
<tr>
<td>Hosted showings</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td>Sometimes</td>
</tr>
<tr>
<td>Hosted open house</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td>Sometimes</td>
</tr>
<tr>
<td>Low commission fees</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td><img src="{{asset('web/images/cross.png')}}" alt="image icon of xmark" class="xmarkImg"></td>
</tr>
<tr>
<td>Pocket listings</td>
<td>Never</td>
<td> </td>
<td>Sometimes</td>
</tr>
<tr>
<td>Sellers pays only sellers' commission</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td><img src="{{asset('web/images/cross.png')}}" alt="image icon of xmark" class="xmarkImg"></td>
</tr>
<tr>
<td>Commission options</td>
<td><i class="las la-check"> </i></td>
<td> </td>
<td><img src="{{asset('web/images/cross.png')}}" alt="image icon of xmark" class="xmarkImg"></td>
</tr>
<tr>
<td>Commission savings($10,000s)</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td><img src="{{asset('web/images/cross.png')}}" alt="image icon of xmark" class="xmarkImg"></td>
</tr>
<tr>
<td>Share listing with mls</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td><i class="fa-solid fa-check"></i></td>
</tr>
<tr>
<td>Internet marketing</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td><i class="fa-solid fa-check"></i></td>
</tr>
<tr>
<td>Single agency presentation</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td><img src="{{asset('web/images/cross.png')}}" alt="image icon of xmark" class="xmarkImg"></td>
</tr>
<tr>
<td>On-line buyer's offer's option</td>
<td><i class="fa-solid fa-check"></i></td>
<td> </td>
<td><img src="{{asset('web/images/cross.png')}}" alt="image icon of xmark" class="xmarkImg"></td>
</tr>
<tr>
<td>Total sellers fees</td>
<td>2.5%</td>
<td> </td>
<td>5 to 6 %</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- pattern section end -->
<!-- sign up section start -->
<div class="signup-sec py-lg-5"><img alt=" building image" class="bg-img mordesignup" src="{{asset('web/images/building-bg.jpg')}}">
<div class="container py-3 py-md-5 position-relative">
<div class="row">
<div class="col headingProactive">
<h1 ><strong class="proac">Our Proactive </strong> Business Model</h1>
<h3>We carefully monitor technology, the real estate industry trends, challenges and opportunities, and the sellers’ and buyers’ concerns, to proactively redesign our unique business model to enrich buyers and sellers experience</h3>
</div>
<div class="col-md-auto align-self-end danielmarket"><img alt=" image of Daniela Marketing photo" class="d-block signup-img " src="{{asset('web/images/DanielaMarketingphoto.png')}}"></div>
<div class="col-lg-4">
<div class="bg-dark proactive p-4" >
<p >Single agency representation <br>Seller pays listing agent’s commission only <br>Buyer has options FROM: choosing an agent or Zero commission with no agents <br>Sellers HAVE ACCESS TO buyer’s offers in real time <br>We don’t endorse nor practice “Pocket Listings” <br>Sellers and buyers have options</p>
</div>
</div>
</div>
</div>
</div>
<div class="container py-3 py-md-5 whoarewe">
<h2 class="">Who we are</h2>
<p>FUTURA is a full-service real estate brokerage that puts the client's interest first! We save consumer's time and money.Unlike other real estate brokerages that use the same standard system and charge home-owners a convectional 5 to 6 percent commission distributed to both the buying agent and listing agent, we believe you should only pay for your portion .We simplify the real estate sale process and transfer tens of thousands of dollars in saving to the home-owner and buyer.</p>
<div>
<div class="collapse" id="collapseExample">
<div class="card card-body collapsediv" >
<h4>a. Savings to you</h4>
<p>FUTURA provides options starting at 2.5 percent to Sellers and ZERO buyer’s commission for FUTURA clients. Traditional commissions typically range between 5% and 6% and these commissions are systematically controlled by the Listing agent.</p>
<h4>b. How does FUTURA pass savings on to the consumer? What’s the catch?</h4>
<p>There is no catch. For years, technology has simplified the way we work, live, and interact with each other. Most of the industry’s Selling and Buying process is done internally and online with superior results in less time. Less time means fewer operating costs. We pass this cost saving to FUTURA Buyers and Sellers as commission savings. Other real estate brokerages keep working the same standard business model with the same conventional commission base and absorb savings for themselves.</p>
<h4>c. Full-service representation</h4>
<p>FUTURA will support you through the entire Selling and Buying process. We will assign an experienced FUTURA Realtor to assist you from the beginning to the completion of your transaction.</p>
<p>FUTURA Marketing plans include professional photography, polished marketing materials, hosted showings, and open houses (subject to covid19 restrictions). We strive to find Sellers the highest possible market value, strategize from appeal to pricing, and navigate to a successful close of escrow.</p>
<p>Our Buyer resources include access to FUTURA Agents, FUTURA Attorneys, open houses, MLS listings, and lead to a beneficial experience where Buyers can submit offers and select commission base on your terms.</p>
<h4>d. Selling with FUTURA </h4>
<p>We follow marketing industry standards among realtors. <strong>Your house will promptly be listed in the MLS</strong>, shared with Buyers’ agents and syndicated to online real estate websites like Zillow and Trulia to maximize exposure and result in more competition among Buyers.</p>
<p><strong>No Pocket Listings</strong></p>
<p>We DO NOT practice pocket listings also known as exclusive listings, double agency or marketed by some agents as off-market-listings and “Coming soon” in the MLS. Pocket listings do not benefit the consumer!.</p>
<p>Pocket listings are limited or never submitted to the MLS thus declining exposure. A system that favors a “special kind of Agent” to show properties only to a “Special Kind of Buyer” is restrictive and unfair to the consumer. Less exposure means reduced competition and lower sale price to the Seller. Pocket listings also stunt Buyers. National Association of Realtors assert that “90% of home buyers search[ed] online during the home-buying process”1, to which 90% of home Buyers would never see pocket listings.</p>
<p>It is unreasonable to properly sell your home while not notifying the market that your home is for sale. So, why do agents encourage pocket listing? Pocket listings benefit the agent. Agents want control of both selling and buying commissions to double their income.</p>
<p><span>1. The National Association of Realtors and Google. <u>The Digital House Hunt: Consumer and Market Trends in Real Estate. </u> Accessed Dec 2020, <a class="text-primary" href="https://www.nar.realtor/sites/default/files/documents/Study-Digital-House-Hunt-2013-01_1.pdf" target="_blank"> https://www.nar.realtor/sites/default/files/documents/Study-Digital-House-Hunt-2013-01_1.pdf</a></span></p>
<h4>e. Assigned Seller and Buyer Commission</h4>
<p>FUTURA Sellers and Buyers are only accountable for their portion of the transaction. Options start at 2.5 percent to Sellers and ZERO Buyer’s commission for FUTURA clients.</p>
<p>FUTURA does not obligate the Seller to pay the buyer’s commission. We offer Buyers the ability to choose their own commission contracts on their own terms. Other brokerages prearrange commission contracts for the Buyer and drive up sale prices to then obligate the Seller to pay both commissions. The Seller and the Buyer lose tens-of-thousands of dollars in lost commission savings.</p>
<h4>f. Consumers against the Real Estate Industry</h4>
<p>Sellers are demanding change among real estate big businesses for years of unfair industry practices. Three United States Federal Courts have open cases in 2020 challenging common real estate practices, including alleged unfair listing contracts that obligate the Seller to pay the Buyer’s commission and violations against anti-trust laws.2</p>
<p>Buyers also challenge the real estate industry for negotiating Buyer’s commission between the Listing agent and the Seller, thus inflating prices. Buyers want to negotiate a fair commission with their own agents.</p>
<p>FUTURA’s Selling commission starts at 2.5 percent and Buyers can negotiate their terms starting with ZERO commission. We put the client’s interest first!</p>
<p >2 U.S. v National Association of Realtors, Illinois Northern District, case open 9/8/2005; Christopher Moehrl, et al. v. The National Association of Realtors, Illinois Northern District, case open 8/22/2019. Joshua Sitzer and Amy Winger, Scott and Rhonda Burnett, and Ryan Hendrickson v. The National Association of Realtors, Realogy Holdings Corp., Homeservices of America, Inc., BHH Affiliates, LLC, HSF Affiliates, LLC, The Long & Foster Companies, Inc., Re/Max, LLC, and Keller Williams Realty, Inc., Missouri Western District, case open 10/8/2019</p>

<div class="row">
<div class="col-md-5" id="who_cal">
<h4 class="mb-3">g.How much can I save with FUTURA?</h4>
<div class="calconic-calculator" data-calculatorid="5fd980b787472b001ed21773"> </div>
</div>
<div class="col">
<h4 class="text-center averageh4"><strong>Average Bay Area Home</strong></h4>
<table class="table table-bordered mt-3 text-center">
<tbody>
<tr>
<th>Listing Price</th>
<th>Other Broker Standard Commission 6%</th>
<th>FUTURA Commission 2.5%</th>
<th>FUTURA Commission Savings</th>
</tr>
<tr>
<td>$750,000</td>
<td>$45,000</td>
<td>$18,750</td>
<td>$26,250</td>
</tr>
<tr>
<td>$1,000,000</td>
<td>$60,000</td>
<td>$25,000</td>
<td>$35,000</td>
</tr>
<tr>
<td>$1,250,000</td>
<td>$75,000</td>
<td>$31,250</td>
<td>$43,750</td>
</tr>
<tr>
<td>$1,500,000</td>
<td>$90,000</td>
<td>$37,500</td>
<td>$52,500</td>
</tr>
<tr>
<td>$1,750,000</td>
<td>$105,000</td>
<td>$43,750</td>
<td>$61,250</td>
</tr>
<tr>
<td>$2,000,000</td>
<td>$120,000</td>
<td>$50,000</td>
<td>$70,000</td>
</tr>
<tr>
</tr>
<tr>
<td>$2,250,000</td>
<td>$135,000</td>
<td>$56,250</td>
<td>$78,750</td>
</tr>
<tr>
<td>$2,500,000</td>
<td>$150,000</td>
<td>$62,500</td>
<td>$87,500</td>
</tr>
<tr>
<td>$2,750,000</td>
<td>$165,000</td>
<td>$68,750</td>
<td>$96,250</td>
</tr>
<tr>
<td>$3,000,000</td>
<td>$180,000</td>
<td>$75,000</td>
<td>$105,000</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<a aria-controls="collapseExample" aria-expanded="false" class="btn btn-primary  compress btn-warning" data-bs-toggle="collapse" href="#collapseExample" id="compressbutton" role="button">+/- Compress content </a></div>
</div>
<!-- sign up section end -->
@endsection