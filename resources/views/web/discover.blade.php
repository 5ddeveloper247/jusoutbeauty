@include('web.web-header')
<style>

    @media screen and (min-width: 0px) and (max-width: 614px) {
        .giving-section2-img,
        .giving-section3-img,
        .last-section-giving {
            width: 37rem;
            height: auto;
        }
        .font-size-banner{
            font-size: 51px
        }
    }
    @media screen and (min-width: 1650px){
        .py-lg-18 {
        padding-top: 358px !important;
        padding-bottom: 358px !important;}
    }

</style>
<main id="content" style="padding-top: 111px">
    <section class="py-10  py-lg-18" id="details-header"
        style="background-repeat: no-repeat; background-image: url('{{ url('assets-web') }}/images/best-banner.jpg'); background-size: cover;">
        <div class="container container-xl">
            <div class="row  no-gutters" style="justify-content: center">

                    <div class="mw-370">
                        <h2 class="mb-2 text-center font-size-banner" data-animate= "fadeInRight" style="color: white; ">Discover</h2>
                        {{-- <p class="part_head">JusOut Beauty, all inclusive, high performance,
                            natural skincare, and makeup -- Yur Jus Enough beauty products to
                            glow from within.
                        </p> --}}
                    </div>

            </div>
        </div>
    </section>

    <section class="pt-10 pt-lg-10 pb-10">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section2-img" src="{{ url('/assets-web') }}/images/who_we_are.jpg"
                        alt="Beeswax">
                </div>
                <div class="col-md-6 pl-xl-7 ">
                    {{-- <h3><b>Who We Are</b></h3> --}}
                    <h2 class="mb-5">"Who We Are"</h2>
                    <p>Beeswax is commonly used in skincare
                        products as it is a surfactant and
                        forms a protective barrier on the surface
                        of the skin. Beeswax is a naturally
                        hydrating ingredient that increases essential
                        moisture in skin and in the relief of itching
                        from sensitive skin. It has an irritation potential
                        of zero, so it will not cause irritation or clog pores,
                        but rather provide a host of benefits such as general
                        healing, antiseptic, antibacterial and antiviral.
                        <a href="http://www.jusoutbeauty.com/site/who-we-are">Read More...</a>
                    </p>

                </div>
            </div>
        </div>
    </section>

    <div class="greygradientabove">
    </div>

    <section class="pt-10 pt-lg-10 pb-10" style="background-color:#60686b;">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1 fadeInRight animated">
                    <img class="giving-section3-img" src="{{ url('/assets-web') }}/images/images.jpg"
                        alt="Our approach">
                </div>
                <div class="col-md-6 pr-xl-7 order-1 order-md-first">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class="mb-5 text-white">Ingredient</h2>
                    <p class="text-white">Also known as nature’s first aid kit.
                        Great for helping small cuts and burns to heal.
                        It’s amazing as a toner to help soothe away razor burn,
                        sunburn, and other small irritations.
                        Contains over 200 active components,
                        including minerals (calcium, magnesium,
                        zinc, chromium, selenium, sodium, iron,
                        potassium, copper and manganese),
                        vitamins (A, C, E, folic acid, B1, B2, B3 and B6),
                        amino acids, enzymes and fatty acids.
                        When used externally it has a wide range of benefits,
                        such as moisturizing and rejuvenating the skin, healing wounds,
                        burns and abrasions, itch prevention, softens the skin, increases elasticity, reduces
                        inflammation and helps supply oxygen to the skin cells. It is a disinfectant, antimicrobial,
                        antibacterial, antiseptic, anti-fungal and antiviral.
                        <a href="http://www.jusoutbeauty.com/site/ingredients">Read More...</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="greygradientbelow">
    </div>

    <section class="pt-10 pt-lg-10 pb-10">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section3-img" src="{{ url('/assets-web') }}/images/πρασινες-νότες-big.jpg"
                        alt="Designed to last">
                </div>
                <div class="col-md-6 pl-xl-7">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class=" mb-5">"Eco-Vibes"</h2>
                    <p>Coconut Oil is absolutely packed with nutrients.
                        A perfectly natural way to nourish dry, unhappy skin.
                        It infuses skin with moisture, enhancing shine,
                        elasticity, and youthful glow to hair and skin.
                        <a href="http://www.jusoutbeauty.com/site/eco-vibes">Read More...</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-10 pt-lg-10 pb-10 bottom_sec" >
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1 fadeInLeft animated">
                    <img loading="lazy" class="last-section-discover" src="{{ url('/assets-web') }}/images/best-banner.jpg" alt="Our approach">
                </div>
                <div class="col-md-6 pr-xl-7 order-1 order-md-first">
                    {{-- <h5>Lusty looks</h5> --}}
                    <h2 class=" mb-5">"Lusty Looks"</h2>
                    <p>The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                        verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                        their names, and select one that has a little brown in it.
                        <a href="http://www.jusoutbeauty.com/site/lusty-looks">Read More...</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-10 py-lg-13 overflow-hidden testimonial-sec-home">
        <div class="row">
            <div class="col-xl-12">
                <h2 class="text-center mb-1 text-capitalize">Our Reviews
                </h2>
                <br>
                <div class="slick-slider custom-slider-03"
                    data-slick-options='{"slidesToShow": 3,"dots":true,"autoplay":true,"arrows":false,"centerMode":false,"centerPadding":"450px","infinite":true,"responsive":[
                        {"breakpoint": 560,"settings": {"slidesToShow": 1,"centerMode":false,"arrows":false}},
                        {"breakpoint": 1450,"settings": {"slidesToShow": 2,"centerMode":false,"arrows":false}},
                        {"breakpoint": 2199,"settings": {"slidesToShow": 3,"centerMode":false,"arrows":false}},
                        {"breakpoint": 1200,"settings": {"centerMode":false,"arrows":false}},
                        {"breakpoint": 992,"settings": {"centerMode":false,"arrows":false}}]}'>

                    @if(isset($reviews) && !empty($reviews))
                    @foreach($reviews as $review)

                    <div class="box" data-animate="fadeIn">
                        <div class="card border-0 bg-transparent">
                            <div class="card-body px-3 py-0 d-flex flex-column align-items-center text-center">
                                <img src="{{ url('/assets-web') }}/images/test-img.jpg">
                                <ul class="list-inline mb-5 d-flex fs-15">
                                    <li class="mr-0" style="{{$review['STAR_RATING'] >= '1' ? 'color: #006f7a;' : 'color: #60686b;'}}"><i class="fas fa-star"></i></li>
                                    <li class="mr-0" style="{{$review['STAR_RATING'] >= '2' ? 'color: #006f7a;' : 'color: #60686b;'}}"><i class="fas fa-star"></i></li>
                                    <li class="mr-0" style="{{$review['STAR_RATING'] >= '3' ? 'color: #006f7a;' : 'color: #60686b;'}}"><i class="fas fa-star"></i></li>
                                    <li class="mr-0" style="{{$review['STAR_RATING'] >= '4' ? 'color: #006f7a;' : 'color: #60686b;'}}"><i class="fas fa-star"></i></li>
                                    <li class="mr-0" style="{{$review['STAR_RATING'] >= '5' ? 'color: #006f7a;' : 'color: #60686b;'}}"><i class="fas fa-star"></i></li>
                                </ul>
                                <p class="card-text mb-7 fs-20 fs-sm-24 text-primary lh-1444 mw-750 mx-auto" style="min-height: 11vw;">{{$review['REVIEW_DESCRIPTION_TRIM']}}</p>
                                <p class="text-primary fs-18 mb-0">
                                    <span class="font-weight-600">{{$review['USERNAME']}} </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>



</main>

@include('web.web-footer')
<script>
    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top','77px');
    }
</script>
