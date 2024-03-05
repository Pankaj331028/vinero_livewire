<div class="modal fade" id="no-sale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header web">
                <h4 id="no-sale-title">NO SALE-{{Auth::check()?Auth::user()->vms_property_id:''}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
            </div>
            <div class="modal-body model-font-specing">
                <div class="row" style="margin-right: 10px; margin-left: 10px;">
                    <div class="row mt-3">
                        <div class="col-md-12" id="no-sale-body">
                            Despite our best efforts, your property {{Auth::check()?Auth::user()->vms_property_id:''}} remains unsold. Still interested in selling this property? Relist it again to avail more offers.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="offer-withdrawn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header web">
                <h4 id="offer-withdrawn-title">Offer Withdrawn-{{Auth::check()?Auth::user()->vms_property_id:''}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
            </div>
            <div class="modal-body model-font-specing">
                <div class="row" style="margin-right: 10px; margin-left: 10px;">
                    <div class="row mt-3">
                        <div class="col-md-12" id="offer-withdrawn-body">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="sold_out" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header web">
                <h4 id="sold_out-title">Different Offer Accepted</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
            </div>
            <div class="modal-body model-font-specing">
                <div class="row" style="margin-right: 10px; margin-left: 10px;">
                    <div class="row mt-3">
                        <div class="col-md-12" id="sold_out-body">
                            Thank you for your offer, an offer was received with terms agreed and accepted by the Seller, the property is now in contract. we enjoyed working with you.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="offer-interest-received" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header web">
                <h4 id="oir-title">Offer of interest received</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
            </div>
            <div class="modal-body model-font-specing">
                <div class="row" style="margin-right: 10px; margin-left: 10px;">
                    <div class="row model-header-info">
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12" id="oir-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="offer-rejected" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header web">
                <h4 id="rejected-title">Offer not accepted</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white;"></button>
            </div>
            <div class="modal-body model-font-specing">
                <div class="row" style="margin-right: 10px; margin-left: 10px;">
                    <div class="row model-header-info">
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12" id="rejected-body">
                            Your offer has been rejected by the seller! Please continue to bid on other properties you like.
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    $(document).ready(function(){

        var notification_type="{{Request::get('q')}}";

        if (notification_type == 'offer_rejected') {
            $('#offer-rejected').modal('show');
            /*$('#rejected-title').text(payload.data.title);
            $('#rejected-body').text(payload.data.body);*/

            setTimeout(function() {
                window.location = "{{route('weblogout')}}";
            }, 5000);
        }
        if (notification_type == 'no_sale') {
            $('#no-sale').modal('show');
            /*$('#no-sale-title').text(payload.data.title);
            $('#no-sale-body').text(payload.data.body);*/

            setTimeout(function() {
                window.location = "{{route('weblogout')}}";
            }, 5000);
        }
        if (notification_type == 'offer_withdrawn') {
            $('#offer-withdrawn').modal('show');
            /*$('#no-sale-title').text(payload.data.title);
            $('#no-sale-body').text(payload.data.body);*/

            setTimeout(function() {
                window.location = "{{route('weblogout')}}";
            }, 5000);
        }
        if (notification_type == 'offer_interest_received') {
            $('#offer-interest-received').modal('show');
            // $('#oir-title').text(payload.data.title);
            $('#oir-body').text('{{Request::get('msg')}}');
        }
        if (notification_type == 'sold_out') {
            $('#sold_out').modal('show');
            /*$('#sold_out-title').text(payload.data.title);
            $('#sold_out-body').text(payload.data.body);*/

            setTimeout(function() {
                window.location = "{{route('survey')}}";
            }, 5000);
        }

    })

var firebaseConfig = {
    apiKey: "AIzaSyApEnoCReOoSN0lxHVVVgE9pO3J4D59y44",
    authDomain: "vinero-11bda.firebaseapp.com",
    projectId: "vinero-11bda",
    storageBucket: "vinero-11bda.appspot.com",
    messagingSenderId: "153374621337",
    appId: "1:153374621337:web:c3468eb8e473b76de20208",
    measurementId: "G-12S8QVCPJW"
};
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

function startFCM() {
    messaging
        .requestPermission()
        .then(function() {
            return messaging.getToken()
        })
        .then(function(response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("store.token") }}',
                type: 'POST',
                data: {
                    token: response
                },
                dataType: 'JSON',
                success: function(response) {
                    console.log('Token stored.');
                },
                error: function(error) {
                    console.log(error);
                },
            });
        }).catch(function(error) {
            console.log(error);

        });

    messaging.onMessage(function(payload) {
        var control_mode = $('#control_monitor').val();

        if (control_mode == "OPTOUTMODE2") {

        } else {
            console.log(payload);

            const title = payload.data.title;
            const options = {
                body: payload.data.body,
                icon: payload.data.icon,
                image: payload.data.image,
                tag: payload.data.tag,
                type: payload.data.type
            };

            const data = {
                incomplete: payload.data.incomplete,
                action_id: payload.data.action_id,
            };
            new Notification(title, options);
            //console.log('Message received. ', payload);
            //console.log(payload.data);

            var notification_title = payload.data.title;
            var notification_type = payload.data.type

            if (notification_type == 'offer_interest') {
                window.location.href = "{{ route('offer-of-interest')}}";
                //   $('#buyer-offerOfintrest').modal('show');
            }
            if (notification_type == 'offer_rejected') {
                $('#offer-rejected').modal('show');
                $('#rejected-title').text(payload.data.title);
                $('#rejected-body').text(payload.data.body);

                setTimeout(function() {
                    window.location = "{{route('weblogout')}}";
                }, 5000);
            }
            if (notification_type == 'in_contract') {
                window.location.href = "{{ route('congratulations')}}";
            }
            if (notification_type == 'offer_deadline_extend') {
                var base = "/offer-deadline-extension?p=" + payload.data.time;
                window.location.href = base;

            }
            if (notification_type == 'counter_offer') {
                // console.log(payload.data);
                if(payload.data.usertype=='buyer'){
                    /*if(payload.data.multiple_counter=='1'){
                        window.location.href = "{{ route('buyer-view-sellers-counter')}}";
                    }
                    else{
                    */
                        window.location = "/offer-detail/" + payload.data.action_id;
                    // }
                }
                else{
                    window.location.href = "{{ route('buyer-view-sellers-counter')}}";
                }
            }
            if (notification_type == 'highest_bid') {
                window.location.href = "{{ route('bid-final-best')}}";
            }

            if (notification_type == 'higher_offer_received') {
                var base = "/higher-offer-received?q=" + payload.data.diff;
                window.location.href = base;
            }
            if (notification_type == 'incomplete_offer') {

                // $('#incomplete-offer').modal('show');

                var slug = payload.data.incomplete;
                var base = "/incomplete-offer?q=" + slug;
                // var url = base+'?slug='+slug ;
                window.location.href = base;

                // if (payload.data.incomplete == 'fc') {
                //   $('#fc').addClass('text-danger');
                // } else if(payload.data.incomplete == 'proof_funds') {
                //   $('#proof_funds').addClass('text-danger');
                // }
            }
            if (notification_type == 'offer_withdrawn') {
                $('#offer-withdrawn').modal('show');
                $('#offer-withdrawn-title').text(payload.data.title);
                $('#offer-withdrawn-body').text(payload.data.body);

                setTimeout(function() {
                    window.location = "{{route('weblogout')}}";
                }, 5000);
            }
            if (notification_type == 'no_sale') {
                $('#no-sale').modal('show');
                $('#no-sale-title').text(payload.data.title);
                $('#no-sale-body').text(payload.data.body);

                setTimeout(function() {
                    window.location = "{{route('weblogout')}}";
                }, 5000);
            }
            if (notification_type == 'offer_interest_received') {
                $('#offer-interest-received').modal('show');
                $('#oir-title').text(payload.data.title);
                $('#oir-body').text(payload.data.body);
            }
            if (notification_type == 'sold_out') {
                $('#sold_out').modal('show');
                $('#sold_out-title').text(payload.data.title);
                $('#sold_out-body').text(payload.data.body);

                setTimeout(function() {
                    window.location = "{{route('survey')}}";
                }, 5000);
            }
            if (notification_type == 'seller_new_offer'||notification_type == 'offer_improve') {
                window.location = "/offer-detail/" + payload.data.action_id;
            }
        }
    });
}

</script>
