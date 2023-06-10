@include('web.web-header')
<style>
    .giving-section2-img,
    .giving-section3-img,
    .last-section-giving {
        width: 50rem;
        height: 64rem;

    }

    @media screen and (min-width: 0px) and (max-width: 614px) {

        .giving-section2-img,
        .giving-section3-img,
        .last-section-giving {
            width: 37rem;
            height: auto;
        }
    }
    @media screen and (min-width: 1650px) {
        .py-lg-18 {
     padding-top: 358px !important;
    padding-bottom: 358px !important;}
    }
</style>
<main id="content" style="padding-top: 111px">
<section class="py-10  py-lg-18 rab" id="details-header"
        style="background-repeat: no-repeat; background-image:url('{{ url('assets-web') }}/images/images.jpg'); background-size: cover;">
    <div class="container container-xl">

        <div class=" no-gutters" style="justify-content: center">
            <h2 class="mb-2 text-center font-size-banner" data-animate="fadeInRight" style="color: white;">Ingredients
            </h2>
        </div>

    </div>

</section>
    <section class="pt-10 pt-lg-10 pb-10">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section2-img" src="{{ url('/assets-web') }}/images/giving-section2.jpg"
                        alt="Beeswax">
                </div>
                <div class="col-md-6 pl-xl-7 ">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class="mb-5">"Beeswax"</h2>
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
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="peachgradientabove">
    </div>

    <section class="pt-10 pt-lg-10 pb-10" style="background-color:#f3c9b3 ;">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1 fadeInRight animated">
                    <img class="giving-section3-img" src="{{ url('/assets-web') }}/images/Aloe-vera.jpg"
                        alt="Our approach">
                </div>
                <div class="col-md-6 pr-xl-7 order-1 order-md-first">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class="mb-5">"Aloe vera"</h2>
                    <p>Also known as nature’s first aid kit.
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
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="peachgradientbelow">
    </div>

    <section class="pt-10 pt-lg-10 pb-10">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section3-img" src="{{ url('/assets-web') }}/images/Coconut-Oil.jpg"
                        alt="Designed to last">
                </div>
                <div class="col-md-6 pl-xl-7">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class=" mb-5">"Coconut Oil"</h2>
                    <p>Coconut Oil is absolutely packed with nutrients.
                        A perfectly natural way to nourish dry, unhappy skin.
                        It infuses skin with moisture, enhancing shine,
                        elasticity, and youthful glow to hair and skin.
                </div>
            </div>
        </div>
    </section>



    {{-- <section class="py-10 py-lg-13 overflow-hidden text-mob"
        style="background: url('{{ url('assets-web') }}/images/discover-banner.jpg'); background-repeat: no-repeat;
        background-size: cover; opacity: 0.9; padding:15px;">
        <h2 class="text-center fs-42 mb-9">Eco-Vibes</h2>
        <div class="slick-slider custom-slider-03"
        data-slick-options='{"slidesToShow": 1,"autoplay":true,"dots":true,"arrows":false,"centerMode":false,"centerPadding":"450px","infinite":true,"responsive":[{"breakpoint": 1450,"settings": {"slidesToShow": 2,"centerMode":false,"arrows":false}},{"breakpoint": 2199,"settings": {"slidesToShow": 3,"centerMode":false,"arrows":false}},{"breakpoint": 1200,"settings": {"centerMode":false,"arrows":false}},{"breakpoint": 992,"settings": {"centerMode":false,"arrows":false}}]}'>

            <div class="box" data-animate="fadeIn">
                <div class="card border-0 bg-transparent">
                    <div class="card-body px-3 py-0 d-flex flex-column align-items-center text-center">
                        <p class=" fs-20 font-weight-500 mb-8 text-primary">JUSOUTBEAUTY</p>
                        <ul class="list-inline mb-5 d-flex fs-15">
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 v"><i class="fas fa-star"></i></li>
                        </ul>
                        <p class="card-text mb-7 fs-20 fs-sm-26 lh-1444 mw-750 mx-auto text-primary">
                            â€œ Lorem ipsum dolor sit amet, consectetur adipisicing elit.Placeat quos, animi adipisci
                            cumque minus pariatur.â€�
                        </p>
                        <p class=" fs-18 mb-0 text-primary"><span class="font-weight-600 text-primary">Dean D. ,
                            </span>Basic Jean
                        </p>
                    </div>
                </div>
            </div>
            <div class="box" data-animate="fadeIn">
                <div class="card border-0 bg-transparent">
                    <div class="card-body px-3 py-0 d-flex flex-column align-items-center text-center">
                        <p class=" fs-20 font-weight-500 mb-8 text-primary">JUSOUTBEAUTY</p>
                        <ul class="list-inline mb-5 d-flex fs-15">
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 v"><i class="fas fa-star"></i></li>
                        </ul>
                        <p class="card-text mb-7 fs-20 fs-sm-26 lh-1444 mw-750 mx-auto text-primary">
                            â€œ Lorem ipsum dolor sit amet, consectetur adipisicing elit.Placeat quos, animi adipisci
                            cumque minus pariatur.â€�
                        </p>
                        <p class=" fs-18 mb-0 text-primary"><span class="font-weight-600 text-primary">Dean D. ,
                            </span>Basic Jean
                        </p>
                    </div>
                </div>
            </div><div class="box" data-animate="fadeIn">
                <div class="card border-0 bg-transparent">
                    <div class="card-body px-3 py-0 d-flex flex-column align-items-center text-center">
                        <p class=" fs-20 font-weight-500 mb-8 text-primary">JUSOUTBEAUTY</p>
                        <ul class="list-inline mb-5 d-flex fs-15">
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 v"><i class="fas fa-star"></i></li>
                        </ul>
                        <p class="card-text mb-7 fs-20 fs-sm-26 lh-1444 mw-750 mx-auto text-primary">
                            â€œ Lorem ipsum dolor sit amet, consectetur adipisicing elit.Placeat quos, animi adipisci
                            cumque minus pariatur.â€�
                        </p>
                        <p class=" fs-18 mb-0 text-primary"><span class="font-weight-600 text-primary">Dean D. ,
                            </span>Basic Jean
                        </p>
                    </div>
                </div>
            </div><div class="box" data-animate="fadeIn">
                <div class="card border-0 bg-transparent">
                    <div class="card-body px-3 py-0 d-flex flex-column align-items-center text-center">
                        <p class=" fs-20 font-weight-500 mb-8 text-primary">JUSOUTBEAUTY</p>
                        <ul class="list-inline mb-5 d-flex fs-15">
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 v"><i class="fas fa-star"></i></li>
                        </ul>
                        <p class="card-text mb-7 fs-20 fs-sm-26 lh-1444 mw-750 mx-auto text-primary">
                            â€œ Lorem ipsum dolor sit amet, consectetur adipisicing elit.Placeat quos, animi adipisci
                            cumque minus pariatur.â€�
                        </p>
                        <p class=" fs-18 mb-0 text-primary"><span class="font-weight-600 text-primary">Dean D. ,
                            </span>Basic Jean
                        </p>
                    </div>
                </div>
            </div>
            <div class="box" data-animate="fadeIn">
                <div class="card border-0 bg-transparent">
                    <div class="card-body px-3 py-0 d-flex flex-column align-items-center text-center">
                        <p class=" fs-20 font-weight-500 mb-8 text-primary">JUSOUTBEAUTY</p>
                        <ul class="list-inline mb-5 d-flex fs-15">
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 text-primary"><i class="fas fa-star"></i></li>
                            <li class="list-inline-item  mr-0 v"><i class="fas fa-star"></i></li>
                        </ul>
                        <p class="card-text mb-7 fs-20 fs-sm-26 lh-1444 mw-750 mx-auto text-primary">
                            â€œ Lorem ipsum dolor sit amet, consectetur adipisicing elit.Placeat quos, animi adipisci
                            cumque minus pariatur.â€�
                        </p>
                        <p class="fs-18 mb-0 text-primary"><span class="font-weight-600 text-primary">Dean D. ,
                            </span>Basic Jean
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="pt-10 pt-lg-10 pb-10 bottom_sec">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1 fadeInLeft animated">
                    <img loading="lazy" class="last-section-giving"
                        src="{{ url('/assets-web') }}/images/Rosemary.jpg" alt="Our approach">
                </div>
                <div class="col-md-6 pr-xl-7 order-1 order-md-first">
                    {{-- <h5>Lusty looks</h5> --}}
                    <h2 class='mb-5 '>"Rosemary"</h2>
                    <p>Rosemary can help lighten your skin and reduce dark spots. This leafy green helps reduce any
                        redness or puffiness on the skin as it is packed with anti-inflammatory agents. The antioxidants
                        rosemary carries will also help fight off acne and prevent breakouts.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-10 pt-lg-10 pb-10 bottom_sec">
            @foreach ($ingredients as $ingredient)
                <p>{{ $ingredient->DESCRIPTION }}</p>
                <img src="{{ $ingredient->DOWN_PATH }}" alt="">
            @endforeach
    </section>

</main>

@include('web.web-footer')
<script>
    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top', '77px');
    }
</script>
