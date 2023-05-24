@include('web.web-header')
<main id="content">
    <section class="py-lg-19 mt-15 py-14 bg-img-cover-center banner_sec_reward" id="details-header"
        style="background-image: url('{{ url('/assets-web') }}/images/shadeimg.webp');background-color: #F2F2F2">
        <div class="container container-xxl">
            <h1 class="fs-40 fs-lg-60" data-animate="fadeInUp">Welcome to Jusout<br> Beauty Rewards!</h1>
            <p class="text-primary fs-18 font-weight-500 mb-4 lh-1444" data-animate="fadeInUp">As a rewards member, you’ll
                get closer to earning exclusive<br> rewards every time you shop.</p>
            <div class="d-flex">
                <div class="text-center mr-3">
                    <a href="#" class="btn btn-primary">Sign In</a>
                </div>
                <div class="text-center">
                    <a href="#" class="btn btn-primary">Sign Up</a>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-10 pt-lg-13 reward_page_sec_two">
        <div class="container container-xl">
            <h2 class="text-center fs-42 mb-9">How It Works</h2>
            <div class="row mx-xl-8">
                <div class="col-md-4 mb-6 mb-md-0 px-xl-8">
                    <div class="card text-center border-0 align-items-center">
                        <div class="">
                            <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        </div>
                        <div class="card-body pt-3 pb-0 px-0">
                            <h5 class="fs-20 mb-2 font-weight-500 card-title">JOIN NOW</h5>
                            <p class="card-title">Create an account and start earning.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-6 mb-md-0 px-xl-8">
                    <div class="card text-center border-0 align-items-center">
                        <div class="">
                            <img src="{{ url('/assets-web') }}/images/icon-box-09.png" alt="Lightweight">
                        </div>
                        <div class="card-body pt-3 pb-0 px-0">
                            <h5 class="fs-20 mb-2 font-weight-500 card-title">EARN POINTS</h5>
                            <p class="card-title">Earn points every time
                                you shop.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-6 mb-md-0 px-xl-8">
                    <div class="card text-center border-0 align-items-center">
                        <div class="">
                            <img src="{{ url('/assets-web') }}/images/icon-box-10.png" alt="All Day Comfort">
                        </div>
                        <div class="card-body pt-3 pb-0 px-0">
                            <h5 class="fs-20 mb-2 font-weight-500 card-title">REDEEM POINTS</h5>
                            <p class="card-title">Redeem points for
                                exclusive discounts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-10 pt-lg-13 pb-10 table_sec_reward">
        <div class="container container-xl">
            <div class="container">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-3 shadow-sm no_gap_reward">
                        <div class="card-header tab_head_reward">
                            <h4 class="my-0 font-weight-normal pt-6" style="color: #fff;">Benefits</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li class="pb-3">Points Per Dollar</li>
                                <li class="pb-3">Birthday Reward</li>
                                <li class="pb-3">Email support</li>
                                <li class="pb-3">Exclusive Offers</li>
                                <li class="pb-3">Double Points Events</li>
                                <li class="pb-3">Free Shipping</li>
                                <li class="pb-3">New Tier Entry Gift</li>
                                <li class="pb-3">Auto Replenishment</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-sm no_gap_reward">
                        <div class="card-header tab_head_reward">
                            <h4 class="my-0 font-weight-normal" style="color: #fff;">Premier</h4>
                            <p>1 - 399<br>Points / Year</p>
                        </div>
                        <div class="card-body tab_head_reward">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li class="pb-3">1x</li>
                                <li class="pb-3">100 points</li>
                                <li class="pb-3"><span class="tick_reward"></span></li>
                                <li class="pb-3">2x</li>
                                <li class="pb-3">Over $35</li>
                                <li class="pb-3">-</li>
                                <li class="pb-3">2x</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-sm no_gap_reward">
                        <div class="card-header tab_head_reward">
                            <h4 class="my-0 font-weight-normal" style="color: #fff;">Elite</h4>
                            <p>400-599<br>Points / Years</p>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li class="pb-3">1.25x</li>
                                <li class="pb-3">125 points</li>
                                <li class="pb-3"><span class="tick_reward"></span></li>
                                <li class="pb-3">2.5x</li>
                                <li class="pb-3">Priority*</li>
                                <li class="pb-3">$10 off</li>
                                <li class="pb-3">2x</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-sm no_gap_reward">
                        <div class="card-header tab_head_reward">
                            <h4 class="my-0 font-weight-normal" style="color: #fff;">Icon</h4>
                            <p>600+<br>Points / Year</p>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li class="pb-3">1.5x</li>
                                <li class="pb-3">150 points</li>
                                <li class="pb-3"><span class="tick_reward"></span></li>
                                <li class="pb-3">3x</li>
                                <li class="pb-3">2 Day*</li>
                                <li class="pb-3">$20 off</li>
                                <li class="pb-3">2x</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <p>*Certain restrictions apply.<a href="#"> Click here for more details.</a></p>
        </div>
    </section>
    <section class="py-10 pt-lg-14 pb-lg-13 rede_sec_reward" style="background-color: #f89880">
        <div class="container full_sec">
            <p class="text-center" style="color:#fff;">Redeem for discounts</p>
            <h3 class="fs-37 text-center mb-5 pl-19 pr-19 pink_sec_reward" style="color:#fff;">Start redeeming once
                you reach 100 points. Simply apply your points at checkout for a discount on full size products.</h3>
            <div class="">
                <hr style="width: 430px; border-top: 3px solid #fff;" class="mob_hr_reward">
                <h3 class="fs-37 text-center mb-5 inc_bord" style="color:#fff;"><strong>Every 100 points =
                        $10</strong></h3>
                <hr style="width: 430px; border-top: 3px solid #fff;" class="mob_hr_reward">
            </div>
            <div class="row pt-3" style="justify-content: center;">
                <div class="col-lg-3 box_sec_reward">
                    <h3 class="fs-37 text-center mb-5 inc_bord" style="color:#fff;">$10 Off
                        <br><span class="fs-24">100 Points</span>
                    </h3>
                </div>
                <div class="col-lg-3 box_sec_reward">
                    <h3 class="fs-37 text-center mb-5 inc_bord" style="color:#fff;">$12 Off
                        <br><span class="fs-24">200 Points</span>
                    </h3>
                </div>
                <div class="col-lg-3 box_sec_reward">
                    <h3 class="fs-37 text-center mb-5 inc_bord" style="color:#fff;">$30 Off
                        <br><span class="fs-24">300 Points</span>
                    </h3>
                </div>
                <div class="col-lg-3 box_sec_reward">
                    <h3 class="fs-37 text-center mb-5 inc_bord" style="color:#fff;">$40 Off
                        <br><span class="fs-24">400 Points</span>
                    </h3>
                </div>
            </div>

        </div>
    </section>
    <section class="py-10 pt-lg-14 pb-lg-13 points_sec_reward" style="background-color: #e7e7e7;">
        <div class="container bot_sec_cont_reward">
            <div class="row">
                <div class="col-lg-4 bot_col_reward" id="point_sec_1">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_1">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">50 points</h5>
                        <p class="card-title">Create an Account</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none;" id="grid-btn-1">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
                <div class="col-lg-4 bot_col_reward" id="point_sec_2">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_2">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">1 Point Per Dollar</h5>
                        <p class="card-title">Per $1 Spent</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-2">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
                <div class="col-lg-4 bot_col_reward" id="point_sec_3">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_3">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">2x Points</h5>
                        <p class="card-title">Every Auto Replenishment Subscription</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-3">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 bot_col_reward" id="point_sec_4">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_4">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">100 Points</h5>
                        <p class="card-title">Happy Birthday</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-4">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
                <div class="col-lg-4 bot_col_reward" id="point_sec_5">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_5">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">30 points</h5>
                        <p class="card-title">Leave a Review</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-5">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
                <div class="col-lg-4 bot_col_reward" id="point_sec_6">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_6">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">40 Points</h5>
                        <p class="card-title">Leave a Photo Review</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-6">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 bot_col_reward" id="point_sec_7">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_7">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">50 Points</h5>
                        <p class="card-title">Video Review</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-7">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
                <div class="col-lg-4 bot_col_reward" id="point_sec_8">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_8">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">20 points</h5>
                        <p class="card-title">Follow Us on Instagram</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-8">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
                <div class="col-lg-4 bot_col_reward" id="point_sec_9">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_9">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">20 Points</h5>
                        <p class="card-title">Follow Us on facebook</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-9">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 bot_col_reward" id="point_sec_10">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_10">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">150 Points</h5>
                        <p class="card-title">Refer a Friend</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-10">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
                <div class="col-lg-7 bot_col_reward" id="point_sec_11">
                    <div class="card text-center border-0 align-items-center bg-transparent" id="tex_sec_rew_11">
                        <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        <h5 class="fs-20 mb-2 font-weight-500 card-title">50 Points</h5>
                        <p class="card-title">SMS Subscription</p>
                    </div>
                    <div class="grid-btn lign-items-center text-center" style="display: none" id="grid-btn-11">
                        <a href="store.html" class="btn btn-outline-primary hov-btn-reward pb-3">Sign in</a>
                        <p class="text-center pt-6" style="color: #fff">Already a Member? <a href="#"
                                style="color: #fff">Log in</a></p>
                    </div>
                </div>
            </div>
    </section>
</main>
@include('web.web-footer')
<script>
	function close_topbar(){
        $("#topbar").removeClass('d-xl-flex');
        $("#details-header").removeClass('mt-15');
        $("#details-header").addClass('mt-11');

    }
</script>