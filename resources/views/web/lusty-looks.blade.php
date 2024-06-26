@include('web.web-header')
<style>

    /* Add this style in your CSS file or inside the <style> tag of your HTML */
        .overlay-section {
        position: relative;
        color: #fff; /* Set text color to white to make it visible on the dark overlay */
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Adjust the transparency (0.5 in this case) */
    }

    .overlay h2{
        position: relative;
        z-index: 2;
    }
    /* .giving-section2-img,
    .giving-section3-img,
    .last-section-giving {
        width: 50rem;
        height: 64rem;
    } */
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
{{-- <section class="py-10  py-lg-18 rab" id="details-header"
        style="background-repeat: no-repeat; background-image: url('{{ url('assets-web') }}/images/best-banner.jpg'); background-size: cover;">
    <div class="container container-xl">

        <div class=" no-gutters" style="justify-content: center">
            <h2 class="mb-2 text-center font-size-banner" data-animate="fadeInRight" style="color: white;">Lusty Looks
            </h2>
        </div>

    </div>

</section> --}}
<section class="py-10 py-lg-18 rab overlay-section" id="details-header"
    style="background-repeat: no-repeat; background-image: url('{{ url('assets-web') }}/images/best-banner.jpg'); background-size: cover; ">
    <div class="overlay"></div> <!-- Add the overlay div here -->
    <div class="container container-xl">
        <div class="no-gutters" style="justify-content: center">
            <h2 class="mb-2 text-center font-size-banner text-white" data-animate="fadeInRight">Lusty Looks</h2>
        </div>
    </div>
</section>

    <section class="pt-10 pt-lg-10 pb-10">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section2-img" style=";box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/last-looks.jpg"
                        alt="Beeswax">
                </div>
                <div class="col-md-6 pl-7 lusty">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class="mb-5">"Beeswax"</h2>
                    <div style="height: 75vh;overflow:auto">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Sunt voluptates libero ea ex, similique rerum illum tempora nesciunt
                            quaerat blanditiis corporis, ipsa accusamus. Nesciunt aspernatur voluptatem
                            ex, eos neque provident beatae natus ea eius, obcaecati aperiam quaerat tempora fuga id maiores
                            explicabo quod eveniet excepturi dolore soluta nam? Iusto, aliquam! Cum non nam esse possimus
                            ipsam laborum voluptate repudiandae quos numquam. Deserunt blanditiis laudantium fuga voluptatem
                            aut odit excepturi repudiandae in molestiae consequuntur eligendi, dolorem, quibusdam magni
                            veniam, sunt esse! Vitae id dolores reprehenderit aliquid quisquam, at distinctio tempore saepe
                            nisi?.Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Sunt voluptates libero ea ex, similique rerum illum tempora nesciunt
                            quaerat blanditiis corporis, ipsa accusamus. Nesciunt aspernatur voluptatem
                            ex, eos neque provident beatae natus ea eius, obcaecati aperiam quaerat tempora fuga id maiores
                            explicabo quod eveniet excepturi dolore soluta nam? Iusto, aliquam! Cum non nam esse possimus
                            ipsam laborum voluptate repudiandae quos numquam. Deserunt blanditiis laudantium fuga voluptatem
                            aut odit excepturi repudiandae in molestiae consequuntur eligendi, dolorem, quibusdam magni
                            veniam, sunt esse! Vitae id dolores reprehenderit aliquid quisquam, at distinctio tempore saepe
                            nisi?.Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Sunt voluptates libero ea ex, similique rerum illum tempora nesciunt
                            quaerat blanditiis corporis, ipsa accusamus. Nesciunt aspernatur voluptatem
                            ex, eos neque provident beatae natus ea eius, obcaecati aperiam quaerat tempora fuga id maiores
                            explicabo quod eveniet excepturi dolore soluta nam? Iusto, aliquam! Cum non nam esse possimus
                            ipsam laborum voluptate repudiandae quos numquam. Deserunt blanditiis laudantium fuga voluptatem
                            aut odit excepturi repudiandae in molestiae consequuntur eligendi, dolorem, quibusdam magni
                            veniam, sunt esse! Vitae id dolores reprehenderit aliquid quisquam, at distinctio tempore saepe
                            nisi?.  nisi?.Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Sunt voluptates libero ea ex, similique rerum illum tempora nesciunt
                            quaerat blanditiis corporis, ipsa accusamus. Nesciunt aspernatur voluptatem
                            ex, eos neque provident beatae natus ea eius, obcaecati aperiam quaerat tempora fuga id maiores
                            explicabo quod eveniet excepturi dolore soluta nam? Iusto, aliquam! Cum non nam esse possimus
                            ipsam laborum voluptate repudiandae quos numquam. Deserunt blanditiis laudantium fuga voluptatem
                            aut odit excepturi repudiandae in molestiae consequuntur eligendi, dolorem, quibusdam magni
                            veniam, sunt esse! Vitae id dolores reprehenderit aliquid quisquam, at distinctio tempore saepe
                            nisi?.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="pickgradientabove">
    </div> --}}

    <section class="pt-10 pt-lg-10 pb-10 lustylooks">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1 fadeInRight animated">
                    <img class="giving-section3-img" style=";box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/last-looks.jpg"
                        alt="Our approach">
                </div>
                <div class="col-md-6 pr-xl-7 order-1 order-md-first lusty">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class="mb-5 text-white">"Aloe vera"</h2>
                    <div style="height: 75vh;overflow:auto">
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
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Sunt voluptates libero ea ex, similique rerum illum tempora nesciunt
                            quaerat blanditiis corporis, ipsa accusamus. Nesciunt aspernatur voluptatem
                            ex, eos neque provident beatae natus ea eius, obcaecati aperiam quaerat tempora fuga id maiores
                            explicabo quod eveniet excepturi dolore soluta nam? Iusto, aliquam! Cum non nam esse possimus
                            ipsam laborum voluptate repudiandae quos numquam. Deserunt blanditiis laudantium fuga voluptatem
                            aut odit excepturi repudiandae in molestiae consequuntur eligendi, dolorem, quibusdam magni
                            veniam, sunt esse! Vitae id dolores reprehenderit aliquid quisquam, at distinctio tempore saepe
                            nisi?.Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Sunt voluptates libero ea ex, similique rerum illum tempora nesciunt
                            quaerat blanditiis corporis, ipsa accusamus. Nesciunt aspernatur voluptatem
                            ex, eos neque provident beatae natus ea eius, obcaecati aperiam quaerat tempora fuga id maiores
                            explicabo quod eveniet excepturi dolore soluta nam? Iusto, aliquam! Cum non nam esse possimus
                            ipsam laborum voluptate repudiandae quos numquam. Deserunt blanditiis laudantium fuga voluptatem
                            aut odit excepturi repudiandae in molestiae consequuntur eligendi, dolorem, quibusdam magni
                            veniam, sunt esse! Vitae id dolores reprehenderit aliquid quisquam, at distinctio tempore saepe
                            nisi?.Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Sunt voluptates libero ea ex, similique rerum illum tempora nesciunt
                            quaerat blanditiis corporis, ipsa accusamus. Nesciunt aspernatur voluptatem
                            ex, eos neque provident beatae natus ea eius, obcaecati aperiam quaerat tempora fuga id maiores
                            explicabo quod eveniet excepturi dolore soluta nam? Iusto, aliquam! Cum non nam esse possimus
                            ipsam laborum voluptate repudiandae quos numquam. Deserunt blanditiis laudantium fuga voluptatem
                            aut odit excepturi repudiandae in molestiae consequuntur eligendi, dolorem, quibusdam magni
                            veniam, sunt esse! Vitae id dolores reprehenderit aliquid quisquam, at distinctio tempore saepe
                            nisi?.  nisi?.Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Sunt voluptates libero ea ex, similique rerum illum tempora nesciunt
                            quaerat blanditiis corporis, ipsa accusamus. Nesciunt aspernatur voluptatem
                            ex, eos neque provident beatae natus ea eius, obcaecati aperiam quaerat tempora fuga id maiores
                            explicabo quod eveniet excepturi dolore soluta nam? Iusto, aliquam! Cum non nam esse possimus
                            ipsam laborum voluptate repudiandae quos numquam. Deserunt blanditiis laudantium fuga voluptatem
                            aut odit excepturi repudiandae in molestiae consequuntur eligendi, dolorem, quibusdam magni
                            veniam, sunt esse! Vitae id dolores reprehenderit aliquid quisquam, at distinctio tempore saepe
                            nisi?.
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="pickgradientbelow">
    </div> --}}

    <section class="pt-10 pt-lg-10 pb-10">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section3-img" style=";box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/last-looks.jpg"
                        alt="Designed to last">
                </div>
                <div class="col-md-6 pl-7 lusty">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class=" mb-5">"Coconut Oil"</h2>
                    <div style="height: 75vh;overflow:auto">
                        <p>Coconut Oil is absolutely packed with nutrients. 
                            A perfectly natural way to nourish dry, unhappy skin. 
                            It infuses skin with moisture, enhancing shine, 
                            elasticity, and youthful glow to hair and skin.
                            Coconut Oil is absolutely packed with nutrients. 
                            A perfectly natural way to nourish dry, unhappy skin. 
                            It infuses skin with moisture, enhancing shine, 
                            elasticity, and youthful glow to hair and skin.
                            Coconut Oil is absolutely packed with nutrients. 
                            A perfectly natural way to nourish dry, unhappy skin.
                             It infuses skin with moisture, enhancing shine,
                              elasticity, and youthful glow to hair and skin.
                              Coconut Oil is absolutely packed with nutrients. 
                              A perfectly natural way to nourish dry, unhappy skin. 
                              It infuses skin with moisture, enhancing shine, 
                              elasticity, and youthful glow to hair and skin.
                              Coconut Oil is absolutely packed with nutrients. 
                              A perfectly natural way to nourish dry, unhappy skin.
                               It infuses skin with moisture, enhancing shine, 
                               elasticity, and youthful glow to hair and skin.
                               Coconut Oil is absolutely packed with nutrients. 
                               A perfectly natural way to nourish dry, unhappy skin. 
                               It infuses skin with moisture, enhancing shine, 
                               elasticity, and youthful glow to hair and skin.
                               Coconut Oil is absolutely packed with nutrients. 
                               A perfectly natural way to nourish dry, unhappy skin. 
                               It infuses skin with moisture, enhancing shine, 
                               elasticity, and youthful glow to hair and skin.
                               Coconut Oil is absolutely packed with nutrients. 
                               A perfectly natural way to nourish dry, unhappy skin.
                               It infuses skin with moisture, enhancing shine, 
                               elasticity, and youthful glow to hair and skin.
                               Coconut Oil is absolutely packed with nutrients. 
                               A perfectly natural way to nourish dry, unhappy skin.
                               It infuses skin with moisture, enhancing shine, 
                               elasticity, and youthful glow to hair and skin.
                               Coconut Oil is absolutely packed with nutrients. 
                               A perfectly natural way to nourish dry, unhappy skin.
                               It infuses skin with moisture, enhancing shine, 
                               elasticity, and youthful glow to hair and skin.
                               Coconut Oil is absolutely packed with nutrients. 
                               A perfectly natural way to nourish dry, unhappy skin.
                               
                        </p>
                    </div>
                   
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
                    <img loading="lazy" class="last-section-giving" style=";box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/Red-lipstick-for-every-look.png" alt="Our approach">
                </div>
                <div class="col-md-6 pr-xl-7 order-1 order-md-first lusty">
                    {{-- <h5>Lusty looks</h5> --}}
                    <h2>"Red Lips"</h2>
                    <div style="height: 75vh;overflow:auto">
                        <p>The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                            verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                            their names, and select one that has a little brown in it.
                            The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                            verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                            their names, and select one that has a little brown in it.
                            The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                            verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                            their names, and select one that has a little brown in it.
                            The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                            verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                            their names, and select one that has a little brown in it.
                            The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                            verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                            their names, and select one that has a little brown in it.
                            The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                            verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                            their names, and select one that has a little brown in it.
                            The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                            verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                            their names, and select one that has a little brown in it.
                            The trick here is to pick a formula that looks moist (that's sexy), but not superglossy (that can
                            verge into slutty territory). Look for lipsticks with "moisturizing," "creamy," or "butter" in
                            their names, and select one that has a little brown in it.
                        </p>
                    </div>
                    
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
