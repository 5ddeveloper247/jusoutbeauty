@include('web.web-header')
<style>

.rab {
        position: relative;
    }

    .rab::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* You can adjust the transparency by changing the last value (0.6 in this case) */
    }

    .container-xl {
        position: relative;
        z-index: 1; /* Make sure the content is above the overlay */
    }

    /* Add any additional styles for the content or adjust existing styles as needed */
    .font-size-banner {
        /* Add any other styles for the heading as needed */
    }
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
    @media screen and (min-width: 615px) and (min-width: 768px) {
        .card-ing {
        width: 20vw !important;
        height: 30vw !important;
        overflow: hidden;
        box-shadow: 0 0 15px lightgray;
        justify-content: center;
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }
    }

    @media screen and (min-width: 1650px) {
        .py-lg-18 {
            padding-top: 358px !important;
            padding-bottom: 358px !important;
        }
    }

    .smile-smart-card {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .smile-smart-card .col-sm-3 {
        -ms-flex: 0 0 22% !important;
        flex: 0 0 22% !important;
        max-width: 22% !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px;
    }

    .card-ing {
        width: 20vw;
        height: 26vw;
        overflow: hidden;

        box-shadow: 0 0 15px lightgray;
        justify-content: center;
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
    }

    .card-ing .main-content {
        width: 100%;
        height: 100%;
    }

    .card-ing .overlay-content {
        width: 100%;
        height: 100%;
        background-color: #57813a;
        cursor: pointer;
        color: #080808;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        position: absolute;
        z-index: 1;
        transition: 0.8s;
        top: 0%;
        right: 100%;
        opacity: 0.8;
    }

    .card-ing .overlay-content p {
        text-align: start;
        font-size: 1.4rem;
        letter-spacing: 1px;
    }

    .blue-card-hover-text a {
        font-size: 0.9vw !important;
        color: white;
        text-align: center;
    }

    .blue-card-hover-text {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        position: absolute;
        top: 0;
        padding: 1.2vw;
    }

    .blue-card-hover-text h5 {
        font-size: 1.2vw !important;
        color: white;
        font-weight: bold;
        margin-top: 1vw !important;
    }

    .card-ing .overlay-content p {
        text-align: start;
        font-size: 1.4rem;
        letter-spacing: 1px;
    }

    .blue-card-hover-text p {
        font-size: 0.9vw !important;
        color: white;
        text-align: left;
        margin: 0 0 0 0 !important;
        margin-top: 1.5vw !important;
        margin-bottom: 3vw !important;
    }


    .card-ing:hover .overlay-content {
        transform: translateX(100%);
        opacity: 1;
    }

    .smile-smart-card .col-sm-3 {
        flex: 0 0 22% !important;
        max-width: 22% !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px;
        padding: 0 !important;
    }

    .smile-smart-card-svg {
        display: flex;
        justify-content: center;
    }

    .card-ing .main-content img {
        width: 16vw;
        height: 12vw;
        border-radius: 5px
    }

    .smile-smart-card-svg img {
        width: 14vw;
        margin-bottom: 5vw;
    }

    .smile-smart-card-text h5 {
        font-size: 1vw;
        text-align: center;
        font-weight: bold;
    }

    .smile-smart-card-text p {
        font-size: 1vw;
        text-align: center;
    }

    .heading-c-c-i {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .heading-c-c-i h1 {
        font-size: 2vw;
        font-weight: bold;
        color: #bb85ff;
        margin: 0 2vw;
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
                    <img class="giving-section2-img" style="max-height: 400px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/giving-section2.jpg"
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

    {{-- <div class="peachgradientabove">
    </div> --}}

    <section class="pt-10 pt-lg-10 pb-10" style="background-color:#f3c9b3 ;">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1 fadeInRight animated">
                    <img class="giving-section3-img" style="max-height: 400px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/Aloe-vera.jpg"
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

    {{-- <div class="peachgradientbelow">
    </div> --}}

    <section class="pt-10 pt-lg-10 pb-10">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section3-img" style="max-height: 400px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/Coconut-Oil.jpg"
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

    <section class="pt-10 pt-lg-10 pb-5 bottom_sec">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1 fadeInLeft animated">
                    <img loading="lazy" class="last-section-giving"  style="max-height: 400px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/Rosemary.jpg"
                        alt="Our approach">
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

    <section class="pt-5 pt-lg-10 pb-10 bottom_sec">
        {{-- <div class="container container-custom"> --}}
            <div class="row smile-smart-card">
                @if ($ingredients != null)
                @foreach ($ingredients as $ingredient)
                <div class="col-sm-3 col-5 mb-10">
                    <div class="card-ing">
                        <div class="main-content">
                            <div class="smile-smart-card-svg">
                                <img width="200" height="200" class="my-lg-4 my-2"
                                    src="{{ $ingredient['DOWN_PATH'] ?? 'https://via.placeholder.com/300x200' }}" alt="easy and secure">
                            </div>
                            <div class="smile-smart-card-text">
                                <h5 class="mb-lg-4 mb-2 mt-3 mt-lg-2 text-uppercase">{{ $ingredient['TITLE'] }}</h5>
                                <p class="my-md-4 my-lg-5 my-0 mx-1 mx-md-2 text-capitalize">{{ $ingredient['INGREDIENT_DESCRIPTION'] }}
                                </p>
                            </div>
                        </div>
                        <div class="overlay-content" style="overflow-y: auto;">
                            <div class="blue-card-hover-text">
                                <h5 class="text-uppercase">{{ $ingredient['TITLE'] }}</h5>
                                <p class="text-capitalize">{{ $ingredient['INGREDIENT_DESCRIPTION_FULL'] }}</p>
                                {{-- <a href="#">Learn More <i class="fas fa-arrow-right"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @endif

            {{-- </div> --}}
        </div>

    </section>

</main>

@include('web.web-footer')
<script>
    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top', '77px');
    }
</script>
