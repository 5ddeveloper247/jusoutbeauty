@include('web.web-header')
<style>
    /* Add this style in your CSS file or inside the <style> tag of your HTML */
        .rab {
        position: relative;
    }

    .rab .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Adjust the transparency (0.5 in this case) */
     /* Place the overlay behind the content */
    }

    /* Add any additional styles for the text or adjust existing styles as needed */
    .rab h2 {
        position: relative;
        z-index: 2; /* Set text color to white to make it visible on the dark overlay */
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
        style="background-repeat: no-repeat; background-image: url('{{ url('assets-web') }}/images/πρασινες-νότες-big.jpg'); background-size: cover;">
    <div class="container container-xl">

        <div class=" no-gutters" style="justify-content: center">
            <h2 class="mb-2 text-center font-size-banner" data-animate="fadeInRight" style="color: white;">Eco Vibes
            </h2>
        </div>

    </div>

</section> --}}
<section class="py-10 py-lg-18 rab" id="details-header"
    style="background-repeat: no-repeat; background-image: url('{{ url('assets-web') }}/images/πρασινες-νότες-big.jpg'); background-size: cover;">
    <div class="overlay"></div> <!-- Add the overlay div here -->
    <div class="container container-xl">
        <div class="no-gutters" style="justify-content: center">
            <h2 class="mb-2 text-center font-size-banner" data-animate="fadeInRight" style="color: white;">Eco Vibes
            </h2>
        </div>
    </div>
</section>


    <section class="pt-10 pt-lg-10 pb-10" >
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section2-img" style=";box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/evovibes-1.jpg"
                        alt="Beeswax">
                </div>
                <div class="col-md-6 pl-7 ecovibes">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class="mb-5">"Evo Vibes"</h2>
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

    {{-- <div class='greengradientabove'></div> --}}

    <section class="pt-10 pt-lg-10 pb-10 evo_vibes_bgcolor" >
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1 fadeInRight animated">
                    <img class="giving-section3-img" style=";box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/evovibes-1.jpg"
                        alt="Our approach">
                </div>
                <div class="col-md-6 pr-xl-7 order-1 order-md-first ecovibes">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class="mb-5 text-white">"Evo Vibes"</h2>
                    <div class="text-white" style="height: 75vh;overflow:auto">
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

    {{-- <div class='greengradientbelow'></div> --}}

    <section class="pt-10 pt-lg-10 pb-10">
        <div class="container container-custom">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 fadeInLeft animated">
                    <img class="giving-section3-img" style=";box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;" src="{{ url('/assets-web') }}/images/evovibes-1.jpg"
                        alt="Designed to last">
                </div>
                <div class="col-md-6 pl-7 ecovibes">
                    {{-- <h5>Ingredient</h5> --}}
                    <h2 class="mb-5">"Evo Vibes"</h2>
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
                    <img loading="lazy" class="last-section-giving" style=";box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); border-radius:10px;"
                        src="{{ url('/assets-web') }}/images/Red-lipstick-for-every-look.png" alt="Our approach">
                </div>
                <div class="col-md-6 pr-xl-7 order-1 order-md-first ecovibes">
                    {{-- <h5>Lusty looks</h5> --}}
                    <h2 class=" mb-5 ">"Red Lips"</h2>
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


</main>

@include('web.web-footer')
<script>
    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top', '77px');
    }
</script>
