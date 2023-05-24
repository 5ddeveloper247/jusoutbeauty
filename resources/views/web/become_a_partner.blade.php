@include('web.web-header')
<main id="content">
    <style>
        section.pt-10.pt-lg-13.grey_back_inc {
            height: unset !important;
        }

        .inc_image_blog_1_partner {
            width: 8rem;
            height: 30rem !important;
        }

        .blog_text_1_partner {

            height: 22rem !important;
            width: 74rem !important;
            margin-top: 12% !important;
        }

        @media (max-width: 480px) {
            .mob_car {
                height: unset !important;
            }
        }
    </style>
    <section class="py-10 mt-13 mt-md-15 py-lg-15" id="details-header"
        style="background-repeat: no-repeat ;background-size: cover;background-image: url('{{ url('assets-web') }}/images/best-banner.jpg')">
        <div class="container container-xl">
            <div class="row py-2 no-gutters">
                <div class="col-lg-5 offset-lg-7 pl-lg-10" data-animate="fadeInRight">
                    <div class="mw-370">
                        <h2 class="fs-42 mb-1 text-capitalize part_head">MAKE A CHANGE WITH JUSOUTBEAUTY <br>
                            ruffle trim</h2>
                        <a href="#" class="font-weight-500 btn-link-custom part_head">Become JUSOUTBeauty
                            Partner</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-10 pt-lg-13">
        <div class="container">
            <div class="text-center mw-730 mx-auto">
                <h3 class="fs-42 text-center mb-5">ASHEKA BEAUTY-DISCOVER & GROW YOUR OWN WAY
                </h3>
                <a href="#" class="btn btn-primary">Contact us</a>

            </div>
        </div>
    </section>
    <section class="pt-10 pt-lg-13">
        <div class="container container-xl">
            <div class="card border-0 rounded-0 hover-zoom-in">
                <img src="{{ url('/assets-web') }}/images/video.jpg" alt="Video background" class="card-img">
                <div class="card-img-overlay d-flex flex-column align-items-center justify-content-center p-4">
                    <a href="https://www.youtube.com/embed/tgbNymZ7vqY" data-gtf-mfp="true"
                        data-mfp-options='{"type":"iframe","preloader":false}'
                        class="mb-3 mb-sm-7 w-45px h-45px w-sm-115 h-sm-115 d-flex justify-content-center align-items-center rounded-circle fs-sm-20 border border-white text-white bg-hover-primary border-hover-primary"><i
                            class="fas fa-play"></i></a>
                    <p class="text-uppercase text-white fs-sm-30 letter-spacing-375px font-weight-800">Bohemian Rhapsody
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-10 pt-lg-13 pic_box">
        <div class="container container-xl">
            <div class="slick-slider partner"
                data-slick-options='{"slidesToShow": 3,"infinite":true,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":2}},{"breakpoint": 576,"settings": {"slidesToShow":1}}]}'>
                <div class="box" data-animate="fadeInUp">
                    <div class="card border-0">
                        <a href="3" class="hover-shine">
                            <img src="{{ url('/assets-web') }}/images/partner.webp" class="card-img-top"
                                alt="How to care for your cotton.">
                        </a>
                        <div class="card-body px-0 pt-4 pb-0">
                            <h3 class="card-title mb-0 fs-20 font-weight-500">
                                <a class="text-decoration-none border-bottom border-white border-2x border-hover-primary"
                                    href="#">ARE YOU AN INFLUENCER?</a>
                            </h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores ratione facere magnam
                                esse sunt sequi nihil suscipit delectus nostrum. Consequuntur a veritatis pariatur
                                libero, eius, officia ut odio at vitae similique, incidunt eveniet. Pariatur,
                                necessitatibus!
                            </p>
                            <div class="text-center text-md-left">
                                <a href="#" class="btn btn-primary">Join Now</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box" data-animate="fadeInUp">
                    <div class="card border-0">
                        <a href="#" class="hover-shine">
                            <img src="{{ url('/assets-web') }}/images/partner.webp" class="card-img-top"
                                alt="How to care for your cotton.">
                        </a>
                        <div class="card-body px-0 pt-4 pb-0">
                            <h3 class="card-title mb-0 fs-20 font-weight-500">
                                <a class="text-decoration-none border-bottom border-white border-2x border-hover-primary"
                                    href="#">ARE YOU A MAKEUP PRO?</a>
                            </h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores ratione facere magnam
                                esse sunt sequi nihil suscipit delectus nostrum. Consequuntur a veritatis pariatur
                                libero, eius, officia ut odio at vitae similique, incidunt eveniet. Pariatur,
                                necessitatibus!
                            </p>
                            <a href="#" class="btn btn-primary">Join Now</a>
                        </div>
                    </div>
                </div>
                <div class="box" data-animate="fadeInUp">
                    <div class="card border-0">
                        <a href="#" class="hover-shine">
                            <img src="{{ url('/assets-web') }}/images/partner.webp" class="card-img-top"
                                alt="How to care for your cotton.">
                        </a>
                        <div class="card-body px-0 pt-4 pb-0">
                            <h3 class="card-title mb-0 fs-20 font-weight-500">
                                <a class="text-decoration-none border-bottom border-white border-2x border-hover-primary"
                                    href="#">ARE YOU A SKINCARE EXPERT?</a>
                            </h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores ratione facere magnam
                                esse sunt sequi nihil suscipit delectus nostrum. Consequuntur a veritatis pariatur
                                libero, eius, officia ut odio at vitae similique, incidunt eveniet. Pariatur,
                                necessitatibus!
                            </p>
                            <a href="#" class="btn btn-primary">Join Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center pt-9">
            </div>
        </div>
    </section>
    <section class="py-10 pt-lg-13 grey_back_inc mob_car">
        <div class="container container-xl">
            <h3 class="fs-42 text-center mb-5">
                HOW IT WORKS
            </h3>
            <p class="center-text-inc">Lorem ipsum dolor sit amet consectetur<br> adipisicing elit. Repudiandae, aut.
                Lorem ipsum dolor sit amet.</p>
            <div class="slick-slider partner"
                data-slick-options='{"slidesToShow": 3,"infinite":true,"autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":2}},{"breakpoint": 576,"settings": {"slidesToShow":1}}]}'>
                <div class="box" data-animate="fadeInUp">
                    <div class="card border-0 card-size-inc">
                        <div class="card_img">
                            <img src="{{ url('/assets-web') }}/images/work1.webp" class="card_img">
                        </div>

                        <div class="card-body px-0 pt-4 pb-0 step_box">
                            <h3 class="card-title mb-0 fs-20 font-weight-500 center-text-inc">
                                <a class="text-decoration-none border-bottom border-white border-2x border-hover-primary center-text-inc"
                                    href="#">SIGN-UP FOR AN ASHEKA BRAND PARTNER & MAKE MONEY</a>
                            </h3>
                            <p class="center-text-inc">
                                Each Brand Partner is assigned a unique tracking link.

                                When a visitor clicks your link, and makes a purchase, you earn a commission!
                            </p>

                        </div>
                    </div>
                </div>
                <div class="box" data-animate="fadeInUp">
                    <div class="card border-0 card-size-inc">
                        <div class="card_img">
                            <img src="{{ url('/assets-web') }}/images/work2.webp" class="card_img">
                        </div>

                        <div class="card-body px-0 pt-4 pb-0 step_box">
                            <h3 class="card-title mb-0 fs-20 font-weight-500 center-text-inc">
                                <a class="text-decoration-none border-bottom border-white border-2x border-hover-primary center-text-inc"
                                    href="#">SIGN-UP FOR AN ASHEKA BRAND PARTNER & MAKE MONEY</a>
                            </h3>
                            <p class="center-text-inc">
                                Share the Products You Love with spreading the word with Your LINK - adding our banners,
                                sharing our coupons, and curating content with ASHEKA BEAUTY products.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="box" data-animate="fadeInUp">
                    <div class="card border-0 card-size-inc">
                        <div class="card_img">
                            <img src="{{ url('/assets-web') }}/images/work3.webp" class="card_img">
                        </div>

                        <div class="card-body px-0 pt-4 pb-0 step_box">
                            <h3 class="card-title mb-0 fs-20 font-weight-500 center-text-inc">
                                <a class="text-decoration-none border-bottom border-white border-2x border-hover-primary center-text-inc"
                                    href="#">SIGN-UP FOR AN ASHEKA BRAND PARTNER & MAKE MONEY</a>
                            </h3>
                            <ul class="box_li">
                                <li>Personalized Page</li>
                                <li>Full Size Products</li>
                                <li>Online Live Shopping Events</li>
                                <li>Online Store</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 py-lg-8">
        <div class="container container-xl">
            <h3 class="fs-42 text-center mb-5">WHATS IN IT FOR YOU?</h3>
            <div class="row mx-xl-8">
                <div class="col-md-4 mb-2 mb-md-0 px-xl-8">
                    <div class="card text-center border-0 align-items-center">
                        <div class="">
                            <img src="{{ url('/assets-web') }}/images/icon-box-02.png" alt="Soft Fabric">
                        </div>
                        <div class="card-body pt-3 pb-0 px-0">
                            <h5 class="fs-20 mb-2 font-weight-500 card-title">INCOME & FLEXIBILITY</h5>
                            <p class="card-title">
                                With JUSOUTBEAUTY you are your own boss, working with beauty, manage your own time and
                                earn extra income - 20-30% on Asheka Products plus Bonus on Your created Team Sales.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-6 mb-md-0 px-xl-8">
                    <div class="card text-center border-0 align-items-center">
                        <div class="">
                            <img src="{{ url('/assets-web') }}/images/icon-box-09.png" alt="Lightweight">
                        </div>
                        <div class="card-body pt-3 pb-0 px-0">
                            <h5 class="fs-20 mb-2 font-weight-500 card-title">TRAVEL & CELEBRATE</h5>
                            <p class="card-title">Your achievements should never go unrecognised! We reward success
                                with exciting events all over the world.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-6 mb-md-0 px-xl-8">
                    <div class="card text-center border-0 align-items-center">
                        <div class="">
                            <img src="{{ url('/assets-web') }}/images/icon-box-10.png" alt="All Day Comfort">
                        </div>
                        <div class="card-body pt-3 pb-0 px-0">
                            <h5 class="fs-20 mb-2 font-weight-500 card-title">GLOBAL BEAUTY COMMUNITY</h5>
                            <p class="card-title">Be a part of something bigger together with amazing people from all
                                over the world.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 py-lg-8 mob_box_1">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-md-12 px-md-12 pr-xl-14 pl-xl-12 order-1 order-md-first center-text-inc">
                    <h3 class="fs-36 mb-3">THINK BIG... WE ARE AMAZING!</h3>
                    <h3 class="fs-20 mb-5">YOUR PASSION...YOUR PURPOSE</h3>
                    <p>Sell JUSOUTBEAUTY PRODUCTS part-time, full-time, or what fits you life, you decide how much! LOOK
                        what a new Brand Partner like you can earn in your first few months
                    </p>
                    <a href="store" class="btn btn-primary">Shop Now</a>

                </div>
            </div>
        </div>
    </section>


    <section class="py-12 py-lg-8 grey_back_inc">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0">
                    <img src="{{ url('/assets-web') }}/images/bonus.webp" alt="Designed to last">
                </div>
                <div class="col-md-6 px-md-6 pl-xl-14 pr-xl-12">
                    <h3 class="fs-30 mb-3">20-30% COMMISSION</h2>
                        <p>On all beauty orders from Customers, Your Team and discount when you buy for Yourself</p>
                        <div class="mb-6">
                            <div class="media">
                                <img src="{{ url('/assets-web') }}/images/money.png" alt="Soft Fabric"
                                    class="mr-4">
                                <div class="media-body">
                                    <h5 class="fs-20 lh-13 mb-5 font-weight-500">$25 BONUS</h5>
                                    <p class="mb-0">for every $250 in sales each campaign</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <div class="media">
                                <img src="{{ url('/assets-web') }}/images/save-money.png" alt="Lightweight"
                                    class="mr-4">
                                <div class="media-body">
                                    <h5 class="fs-20 lh-13 mb-5 font-weight-500">$50 BONUS</h5>
                                    <p class="mb-0">for every $250 in sales each campaign</p>
                                </div>
                            </div>
                            <div class="text-center text-md-left">
                                <a href="store" class="btn btn-primary inc_btn mb-md-0">Shop Now To Get Your Bonus
                                    Right Now</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </section>
    <section class="py-12 py-lg-8 mob_box_2">
        <div class="container">
            <div class="text-center mw-730 mx-auto">
                <img src="{{ url('/assets-web') }}/images/icon-home-09.png" alt="">
                <h3 class="fs-42 text-center mb-5">Dreams Realized - with Flexibility and Fun. As a Brand Partner You
                    can help women and men Transform to Display their Best Self.
                </h3>
            </div>
        </div>
    </section>
    <section class="py-12 py-lg-8">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1">
                    <img src="{{ url('/assets-web') }}/images/bonus.webp" alt="Our approach">
                </div>
                <div class="col-md-6 px-md-6 pr-xl-14 pl-xl-12 order-1 order-md-first">
                    <h3 class="fs-30 mb-5">HIGH-PERFORMANCE PRODUCTS</h3>
                    <h5 class="fs-20 mb-5">BACKED BY NATURE & SCIENCE</h5>
                    <p>When you sell ASHEKA BEAUTY products, Your customers will get high-performance, quality and safe
                        skincare and on-trend color makeup, just what they're paying for. We test every product to
                        ensure they perform because Mindful Beauty that is Every Day and Innovative Science is at the
                        heart of our brand.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 py-lg-8 grey_back_inc">
        <div class="container">
            <h3 class="fs-42 text-center mb-5">OUR TOP SELLING PRODUCTS</h3>
            <h5 class="fs-30 text-center mb-8">Get Paid to Shop and Share Our Collection of Beauty Products.</h5>
            <!-- <div class="card border-0 blog_inc_container_partner">-->
            <!--<a href="#" class="hover-shine">-->
            <!--<img src="{{ url('/assets-web') }}/images/proswiper.webp" class="inc_image_blog_1_partner" alt="How to care for your cotton.">-->
            <!-- <div class="middle_cont_blog_partner">-->
            <!--    <div class="blog_text_1_partner"><span style="font-size:24px;">Makeup New Product Sample</span><br>Lorem ipsum dolor sit amet consectetur adipisicing.<br>-->
            <!--    <span style="font-size:24px;">$45.00</span><br><span class="text-primary fs-12 lh-2"><i class="fas fa-star star_col"></i></span><span class="text-primary fs-12 lh-2"><i class="fas fa-star star_col"></i></span><span class="text-primary fs-12 lh-2"><i class="fas fa-star star_col"></i></span><span class="text-primary fs-12 lh-2"><i class="fas fa-star star_col"></i></span><span class="text-primary fs-12 lh-2"><i class="fas fa-star star_col"></i></span>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</a>-->
            <!--</div>-->
            <div class="container container-xl">
                <div class="slick-slider partner" style="padding-left:0px !important;padding-right:0px !important;"
                    data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":2}},{"breakpoint": 576,"settings": {"slidesToShow":1}}]}'>
                    <div class="card border-0 blog_inc_container_partner">
                        <a href="#" class="">
                            <img src="{{ url('/assets-web') }}/images/proswiper.webp"
                                class="inc_image_blog_1_partner" alt="How to care for your cotton.">
                            <div class="middle_cont_blog_partner">
                                <div class="blog_text_1_partner"><span style="font-size:24px;">Makeup New Product
                                        Sample</span><br>Lorem ipsum dolor sit amet consectetur adipisicing.<br>
                                    <span style="font-size:24px;">$45.00</span><br><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i class="fas fa-star star_col"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card border-0 blog_inc_container_partner">
                        <a href="#" class="">
                            <img src="{{ url('/assets-web') }}/images/proswiper.webp"
                                class="inc_image_blog_1_partner" alt="How to care for your cotton.">
                            <div class="middle_cont_blog_partner">
                                <div class="blog_text_1_partner"><span style="font-size:24px;">Makeup New Product
                                        Sample</span><br>Lorem ipsum dolor sit amet consectetur adipisicing.<br>
                                    <span style="font-size:24px;">$45.00</span><br><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i class="fas fa-star star_col"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card border-0 blog_inc_container_partner">
                        <a href="#" class="">
                            <img src="{{ url('/assets-web') }}/images/proswiper.webp"
                                class="inc_image_blog_1_partner" alt="How to care for your cotton.">
                            <div class="middle_cont_blog_partner">
                                <div class="blog_text_1_partner"><span style="font-size:24px;">Makeup New Product
                                        Sample</span><br>Lorem ipsum dolor sit amet consectetur adipisicing.<br>
                                    <span style="font-size:24px;">$45.00</span><br><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i
                                            class="fas fa-star star_col"></i></span><span
                                        class="text-primary fs-12 lh-2"><i class="fas fa-star star_col"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
    </section>
    <section class="py-12 py-lg-8">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-md-6 mb-8 mb-md-0 order-first order-md-1">
                    <img src="{{ url('/assets-web') }}/images/charity.webp" alt="Our approach">
                </div>
                <div class="col-md-6 px-md-6 pr-xl-14 pl-xl-12 order-1 order-md-first">
                    <h3 class="fs-30 mb-5">THE BEAUTY OF GIVING BACK</h3>
                    <h5 class="fs-20 mb-5">JOIN US TO SUPPORT AMAZING HIGH SCHOOL GIRLS & BOYS, ELDERLY LIVING ALONE
                        WITH OUR $5 CONTRIBUTION SIGN-UP OPTION.
                    </h5>
                    <div class="text-center text-md-left">
                        <a href="#" class="btn btn-primary inc_btn">Become JUSOUT Beauty Partner</a>
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
        $("#details-header").removeClass('mt-md-15');
        $("#details-header").addClass('mt-md-11');
    }
</script>
