@include('web.web-header')
<style>
    .height-40 {
        height: 40px;
    }

    .mt-50 {
        margin-top: 0.16rem !important;
        margin-left: 5px;
    }

    .input-group {
        border-radius: 0.375rem;
    }

    .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }

    .input-group-text {
        display: flex;
        align-items: center;
        padding: 0.422rem 0.75rem;
        font-size: 0.9375rem;
        font-weight: 400;
        line-height: 1.5;
        color: #b6bee3;
        text-align: center;
        white-space: nowrap;
        background-color: transparent;
        border: 1px solid #d2d2d2;
        border-radius: 0.375rem;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .amt_00 {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;

    }


    .input-group>.form-control,
    .input-group>.form-select,
    .input-group>.form-floating {
        position: relative;
        flex: 1 1 auto;
        width: 1%;
        min-width: 0;
    }
     @media screen and (min-width: 1650px){
    .py-lg-18 {
    padding-top: 358px !important;
    padding-bottom: 358px !important;}
}
 @media screen and (min-width: 1200px){
    #content {
        padding-top: 111px !important
    }
}
</style>
<main id="content" ng-app="project1" style="padding-top: 183px">
    <div ng-controller="projectinfo1">
        <section class="py-10  py-lg-18 rab" id="details-header"
            style="background-repeat: no-repeat ;background-size: cover;background-image: url('{{ url('assets-web') }}/images/960x0.jpg')">
            <div class="container container-xl">
            	<div class="row no-gutters" style="justify-content: center">
                  	<div class="mw-370">
                    	<h2 class="mb-2 text-center" data-animate= "fadeInRight" style="color: white; font-size: 100px">Giving</h2>
                	</div>
            	</div>
          	</div>
        </section>
        <section class="pt-10 pt-lg-13">
            <div class="container container-custom">
                <div class="text-center mw-730 mx-auto">
                    <img class="mb-5" src="{{ url('/assets-web') }}/images/icon-home-09.png" alt="" class="giv_img">

                    <p>Beyond finding honestly good holiday gifts for your loved ones, this season is all about
                        indulgence! What says indulge more than self-care gifts, beauty gift sets + baby gifts for new
                        parents who will appreciate cute + comfy diapers more than you know? So go on, babe, indulge -
                        we know you’ll find the perfect gift!. </p>
                    <p>Together, we can work to make sure everyone has access to a shower everyday. But we can’t do it
                        alone. So wake up, take a shower, and join us. Let’s do it together </p>
                    <div class="text-center">
                        <button ng-click="donatePayment();" class="btn btn-primary">Donate</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-10 pt-lg-10 mt-10 pb-10" style="background-color:#006f7a;">
            <div class="container container-custom">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-6 mb-8 mb-md-0 inc-sec-img">
                        <img src="{{ url('/assets-web') }}/images/Picture8.jpg"
                            alt="OUR SOCIAL CAUSE IS MINDFULNESS AND A UNIQUE JOURNEY.">
                    </div>
                    <div class="col-md-6 pl-xl-7">
                        <h2 class=" mb-5">OUR SOCIAL CAUSE IS MINDFULNESS AND A UNIQUE JOURNEY.</h2>
                        <p>We strongly believe that by supporting the most vulnerable in society - elderly, children and
                            young women - we can help give them the opportunity to turn their dreams into reality.

                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus beatae aliquid qui quasi
                            consectetur quod aspernatur recusandae ab omnis inventore? Maxime repudiandae dolor quidem
                            laudantium.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-10 pt-lg-13">
            <div class="container container-custom container-xl">
                <h2 class="text-center mb-9">WE ARE ONE, REGARDLESS OF SHADE</h2>
                <div class="row mx-xl-8">
                    <div class="col-md-4 mb-6 mb-md-0 px-xl-8">
                        <div class="card text-center border-0 align-items-center">
                            <div class="">
                                <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                            </div>
                            <div class="card-body pt-3 pb-0 px-0">
                                <h5 class="fs-20 mb-2 font-weight-500 card-title">Soft Fabric</h5>
                                <p class="card-title">Get complimentary ground shipping on every order.Donâ€™t love it?
                                    Send
                                    it back, on us.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-6 mb-md-0 px-xl-8">
                        <div class="card text-center border-0 align-items-center">
                            <div class="">
                                <img src="{{ url('/assets-web') }}/images/icon-box-09.png" alt="Lightweight">
                            </div>
                            <div class="card-body pt-3 pb-0 px-0">
                                <h5 class="fs-20 mb-2 font-weight-500 card-title">Lightweight</h5>
                                <p class="card-title">Join Minimog Rewards to earn gift cards and enjoy exclusive member
                                    benefits.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-6 mb-md-0 px-xl-8">
                        <div class="card text-center border-0 align-items-center">
                            <div class="">
                                <img src="{{ url('/assets-web') }}/images/icon-box-10.png" alt="All Day Comfort">
                            </div>
                            <div class="card-body pt-3 pb-0 px-0">
                                <h5 class="fs-20 mb-2 font-weight-500 card-title">All Day Comfort</h5>
                                <p class="card-title">We believe getting dressed should be the easiest part of your day.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-10 py-lg-18  mt-10"
            style="background-image:url({{ url('/assets-web') }}/images/discover-banner.jpg);background-repeat:no-repeat;background-size:cover;">
            <div class="container full_sec">
                <h2 class="text-center mb-5 text-white">JUSOUTBEAUTY THE SWEET <br>AND CARING</h2>

            </div>
        </section>
        <section class="py-10 pt-lg-14 pb-lg-13">
            <div class="container full_sec">
                <h2 class=" text-center mb-5">JUSOUTBEAUTY THE SWEET AND CARING</h3>
                <p class="text-center mw-670 mx-auto mb-8">
                    WE ARE BEAUTY BECOMES DAILY BRAND - BIRTH FROM NECESSITY - BUILT FROM POVERTY - WE ARE THE EVERYDAY
                    BASIC - AFFORDABLE - WITHOUT - LOOSING EFFECTIVENESS
                </p>
                <div class="text-center">
                    <a href="javascript:;" ng-click="donatePayment();" class="btn btn-primary">Donate</a>
                </div>
            </div>
        </section>

        <div class="modal fade" id="show_giving_modal_clover">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="justify-content-center">Thanks for donating!</h4>
                    </div>
                    <div class="modal-body">
                        <!--                 <form> -->
                        <div class="row" id="clover_first">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="firstname" class="sr-only">First Name</label>
                                    <input type="text" class="form-control" id="firstname" ng-model="giving['G_1']"
                                        placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="lastname" class="sr-only">First Name</label>
                                    <input type="text" class="form-control" id="lastname" ng-model="giving['G_2']"
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        ng-model="giving['G_3']" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="pnumber" class="sr-only">Phone Number</label>
                                    <input type="number" class="form-control" id="pnumber"
                                        ng-model="giving['G_4']" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" placeholder="Amount" id="g5"
                                        ng-model="giving['G_5']" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text amt_00">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="clover_second" style="display:none">
                            <div class="col-md-12">
                                <input type="hidden" name="id" id="accesskey" value="{{ $pakmskey }}">

                                <div class="container">
                                    <form action="makePayment" method="post" id="payment-form">
                                        @csrf
                                        <input type="hidden" name="userId" value="{{ session('userId') }}">
                                        <input type="hidden" name="paymentType" value="giving">

                                        <input type="hidden" name="G_1" value="@{{ giving.G_1 }}">
                                        <input type="hidden" name="G_2" value="@{{ giving.G_2 }}">
                                        <input type="hidden" name="G_3" value="@{{ giving.G_3 }}">
                                        <input type="hidden" name="G_4" value="@{{ giving.G_4 }}">



                                        <div class="form-row top-row">
                                            <div id="amount" class="field card-number">
                                                <input type="hidden" name="amount" value="@{{ cloverGivingAmount }}"
                                                    placeholder="Amount">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label
                                                class="ml-2 fs-13 letter-spacing-01 font-weight-600 text-uppercase">CREDIT
                                                CARD NUMBER</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 form-row top-row card-number border border-bottom border-dark pt-2 pl-2 rounded mb-2 ml-2"
                                                style="height: 40px;">
                                                <div id="card-number" class="field height-40"></div>
                                                <div class="input-errors" id="card-number-errors" role="alert">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-4" style="height: 40px;">
                                                <label
                                                    class="fs-13 letter-spacing-01 font-weight-600 text-uppercase">MONTH/YEAR</label>
                                            </div>
                                            <div class="col-sm-4" style="height: 40px;">
                                                <label
                                                    class="fs-13 letter-spacing-01 font-weight-600 text-uppercase">CVV</label>
                                            </div>
                                            <div class="col-sm-3 ml-2" style="height: 40px;">
                                                <label
                                                    class="fs-13 letter-spacing-01 font-weight-600 text-uppercase">ZIP</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4 form-row border border-bottom border-dark pt-2 pl-2 rounded mb-2 ml-2"
                                                style="height: 40px;">
                                                <div id="card-date" class="field third-width height-40"></div>
                                                <div class="input-errors" id="card-date-errors" role="alert"></div>
                                            </div>
                                            <div class="col-sm-4 form-row border border-bottom border-dark pt-2 pl-2 rounded mb-2 ml-2"
                                                style="height: 40px;">
                                                <div id="card-cvv" class="field third-width height-40"></div>
                                                <div class="input-errors" id="card-cvv-errors" role="alert"></div>
                                            </div>
                                            <div class="col-sm-3 form-row border border-bottom border-dark pt-2 pl-2 rounded mb-2 ml-2"
                                                style="height: 40px;">
                                                <div id="card-postal-code" class="field third-width height-40"></div>
                                                <div class="input-errors" id="card-postal-code-errors"
                                                    role="alert"></div>
                                            </div>
                                        </div>

                                        <div id="card-response" role="alert"></div>

                                        <div class="button-container mr-4 mt-3 " style="z-index:99; display:none;">
                                            <button class="btn btn-secondary h6" id="payNow_btn">Pay Now</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--                 </form> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark light" ng-click="backtoStep1();"
                            ng-show="paymentStep == '2'">Back</button>
                        <button type="button" class="btn btn-danger light"
                            ng-click="close_giving_modal_clover()">Close</button>
                        <button type="button" class="btn btn-success light" ng-click="makePayment()">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('web.web-footer')

<script src="{{ url('/assets-web') }}/customjs/script_usergiving.js?v={{time()}}"></script>

<script src="https://checkout.sandbox.dev.clover.com/sdk.js"></script>

<script>
    const accesskey = document.getElementById('accesskey').value;

    const clover = new Clover(accesskey);
    const elements = clover.elements();

    let styles = "";
    const form = document.getElementById('payment-form');
    const cardNumber = elements.create('CARD_NUMBER', styles);
    const cardDate = elements.create('CARD_DATE', styles);
    const cardCvv = elements.create('CARD_CVV', styles);
    const cardPostalCode = elements.create('CARD_POSTAL_CODE', styles);

    cardNumber.mount('#card-number');
    cardDate.mount('#card-date');
    cardCvv.mount('#card-cvv');
    cardPostalCode.mount('#card-postal-code');

    const cardResponse = document.getElementById('card-response');
    const displayCardNumberError = document.getElementById('card-number-errors');
    const displayCardDateError = document.getElementById('card-date-errors');
    const displayCardCvvError = document.getElementById('card-cvv-errors');
    const displayCardPostalCodeError = document.getElementById('card-postal-code-errors');

    // Handle real-time validation errors from the card element
    cardNumber.addEventListener('change', function(event) {
        console.log(`cardNumber changed ${JSON.stringify(event)}`);
    });

    cardNumber.addEventListener('blur', function(event) {
        console.log(`cardNumber blur ${JSON.stringify(event)}`);
    });

    cardDate.addEventListener('change', function(event) {
        console.log(`cardDate changed ${JSON.stringify(event)}`);
    });

    cardDate.addEventListener('blur', function(event) {
        console.log(`cardDate blur ${JSON.stringify(event)}`);
    });

    cardCvv.addEventListener('change', function(event) {
        console.log(`cardCvv changed ${JSON.stringify(event)}`);
    });

    cardCvv.addEventListener('blur', function(event) {
        console.log(`cardCvv blur ${JSON.stringify(event)}`);
    });

    cardPostalCode.addEventListener('change', function(event) {
        console.log(`cardPostalCode changed ${JSON.stringify(event)}`);
    });

    cardPostalCode.addEventListener('blur', function(event) {
        console.log(`cardPostalCode blur ${JSON.stringify(event)}`);
    });


    window.onload = function() {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Use the iframe's tokenization method with the user-entered card details
            clover.createToken()
                .then(function(result) {
                    if (result.errors) {
                        Object.values(result.errors).forEach(function(value) {
                            //displayError.textContent = value;
                            toastr.error(value, '', {
                                timeOut: 3000
                            });
                            //                          alert(value);
                        });
                    } else {

                        cloverTokenHandler(result.token);
                    }
                });
        });
    }

    // Listen for form submission



    function cloverTokenHandler(token) {
        $.LoadingOverlay("show");
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'cloverToken');
        hiddenInput.setAttribute('value', token);
        form.appendChild(hiddenInput);

        form.submit();
    }
</script>

<script>
    //     function show_payment_modal_clover(){
    //         $("#clover_second").show(1000);
    //         $("#clover_first").hide(1000);

    //     }
    //     function close_giving_modal_clover(){
    //         $("#show_giving_modal_clover").modal('hide');
    //     }
    //     function Giving_Page_Clover(){
    //     	$("#clover_second").hide(1000);
    //         $("#clover_first").show(1000);
    //         $("#show_giving_modal_clover").modal('show');
    //     }
    	function close_topbar(){
            $("#topbar").removeClass('d-xl-flex');
            $("#content").css('padding-top','77px');

        }
</script>
