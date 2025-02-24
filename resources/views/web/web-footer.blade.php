<footer class="footer back_cs pt-10">
    <style>
        /* #cookieModal {
        position: fixed;
        left: -20%;
        top: 30%;
    }

    .modal-dialog.modal-sm.custom-max-width {
        max-width: 400px;
    }

    .modal-footer {
        text-align: right;
    }

    .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }

    /* Media Queries for Responsiveness */

        /* Small devices (up to 576px) */
        @media (max-width: 576px) {
            #cookieModal {
                left: 4%;
                top: 0;
            }

            .modal-dialog.modal-sm.custom-max-width {
                max-width: 90%;
            }
        }

        /* Medium devices (576px - 768px) */
        @media (min-width: 576px) and (max-width: 768px) {
            .modal-dialog.modal-sm.custom-max-width {
                max-width: 300px;
            }
        }

        /* Large devices (768px - 992px) */
        @media (min-width: 768px) and (max-width: 992px) {
            .modal-dialog.modal-sm.custom-max-width {
                max-width: 400px;
            }
        }

        /* Extra-large devices (992px and above) */
        @media (min-width: 992px) {
            .modal-dialog.modal-sm.custom-max-width {
                max-width: 500px;
            }
        }

        #tictk:hover {
            filter: invert(100%)
        }

        .back_cs {
            background: linear-gradient(to right, #F7EFED, #F9A7A9, #F7EFED);

        }

        form.footer-formm .fa-envelope:before {
            padding-left: unset
        }

        .text-black {
            color: #000;
        }

        @media screen and (min-width: 0px) and (max-width: 614px) {
            .d-sm-unset {
                display: unset !important;
                text-align: center;
            }

            .text-align-sm {
                text-align: center;
            }

            ul.ul-mbl-site {
                list-style-type:  circle;
            }

            form.footer-formm .fa-envelope:before {
                padding-left: unset
            }

            .footer-heading {
                font-size: 25px;
                text-transform: capitalize;
            }
        }

        */
    </style>

    <div class="py-4">
        <div class="container container-xxl container-footer">
            <div class="row align-items-center first-rw">
                <div class="col-lg-12 mb-4 mb-lg-0 text-center footer-links-account">
                    <h2 class="mb-4 footer-text-white footer-heading">Yu Jus Enough and Let's Be
                        Bestie</h2>
                    <p class="lh-2 mb-4 fs-14 footer-text-white">Don't Mis Out-All the exclusives' events,
                        skincare tips, Special Offers straight to yur inbox</p>
                    <form class="footer-formm">
                        <div class="input-group position-relative rounded">

                            <span
                                class="d-inline-flex align-items-center position-absolute pos-fixed-left-center z-index-2 left-15">
                                <i class="fal fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control border-0 bg-transparent pl-7 m-0"
                                id="footerEmailSubs" placeholder="Enter your email" style="z-index: 1;">

                            <span class="d-inline-flex align-items-center z-index-2" style="margin-right: -45px;">
                                <i class="fal fa-phone"></i>
                            </span>
                            <input type="number" class="form-control border-0 bg-transparent pl-7" id="footerPhoneSubs"
                                placeholder="Phone" style="z-index: 1;" minlength="11" maxlength="14">

                            <div
                                class="input-group-append fs-14 position-absolute pos-fixed-right-center z-index-2 pr-3">
                                <button type="button" class="bg-transparent border-0 outline-none"
                                    onclick="footerEmailSubscription();">
                                    <i class="far fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
            <br>
            <!--     <div class="row align-items-center first-rw">-->
            <!--<div class="col-lg-12 mb-4 mb-lg-4 text-center footer-links-account">-->
            <!--     <a href="#">Your Account </a><a href="#">Track Your Order </a><a href="#">Contact</a><a href="#">FAQs</a><a href="#">Shipping & Returns</a><a href="blog-page.html">Blogs</a><a href="subscription.html">Subscription</a>-->

            <!--    </div>-->


            <!--</div>-->
            <p class="text-align-sm  text-subs fs-14 footer-text-white">By subscribing to JusOut Beauty you consent to
                receive recurring
                automated promotional and personalized marketing messages (e.g.,
                cart reminders) via automated technology including email and text
                messages. Consent is not a condition of any purchase. View <a class="footer-text-white"
                    href="{{ url('/customer-help') }}" onclick="informationflag('term of use')"> <u>Terms of
                        Use</u> </a> & <a class="footer-text-white" href="{{ url('/customer-help') }}"
                    onclick="informationflag('privacy policy')"> <u>Privacy Policy</u></a>. Message and data rates may
                apply.
                Reply HELP for help or STOP to opt-out.</p>
            <br>
            <div class="row align-items-center first-rw">
                <div class="col-lg-4 mb-4 mb-lg-0 footer_sec"></div>
                <div class="col-lg-2 mb-4 mb-lg-0 footer_sec">
                    <p
                        class="mb-0 text-uppercase text-left font_size_cl letter-spacing-07px font-weight-600 footer-text-white ptag">
                        @jusOSkin
                    </p>
                </div>
                <div class="col-lg-3 d-flex justify-content-lg-start justify-content-md-start justify-content-center">
                    <ul class="list-inline icon_size_cl ml-3 mb-0">

                        @if (isset($footerSocialIcons))
                            @if (isset($footerSocialIcons['facebookEnable']) && $footerSocialIcons['facebookEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['facebookLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class=" social-media footer-text-white fab fa-facebook-f"></i></a>
                                </li>
                            @endif
                            @if (isset($footerSocialIcons['instagramEnable']) && $footerSocialIcons['instagramEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['instagramLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class=" social-media footer-text-white fab fa-instagram"></i></a>
                                </li>
                            @endif
                            @if (isset($footerSocialIcons['twitterEnable']) && $footerSocialIcons['twitterEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['twitterLink'] }}"
                                        class="text-body social-media" id="tictk" target="_blank">
                                        {{-- <i class="social-media footer-text-white fab fa-tiktok"></i> --}}
                                        <img style="width: 35px;
                                        padding: 0px;
                                        margin-bottom: 6px;"
                                            src="{{ url('/assets-admin') }}/images/admin/tiktok-black.png"
                                            class="rounded-circle  user_img social-media" alt="" />
                                    </a>
                                </li>
                            @endif
                            @if (isset($footerSocialIcons['linkedInEnable']) && $footerSocialIcons['linkedInEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['linkedInLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class="social-media footer-text-white fab fa-linkedin"></i></a>
                                </li>
                            @endif
                            @if (isset($footerSocialIcons['youtubeEnable']) && $footerSocialIcons['youtubeEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['youtubeLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class="social-media footer-text-white fab fa-youtube"></i></a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
                {{-- <div class="col-lg-2 mb-4 mb-lg-0 footer_sec">
                    <p class="mb-0 text-uppercase text-left font_size_cl text-primary letter-spacing-07px font-weight-600">
                        @JUSOUTBEAUTY
                    </p>
                </div>
                <div class="col-lg-3 d-flex justify-content-lg-start justify-content-center">
                    <ul class="list-inline icon_size_cl ml-3 mb-0">
                        @if (isset($footerSocialIcons))
                            @if (isset($footerSocialIcons['facebookEnable']) && $footerSocialIcons['facebookEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['facebookLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class="social-media fab fa-facebook-f"></i></a>
                                </li>
                            @endif
                            @if (isset($footerSocialIcons['instagramEnable']) && $footerSocialIcons['instagramEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['instagramLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class="social-media fab fa-instagram"></i></a>
                                </li>
                            @endif
                            @if (isset($footerSocialIcons['twitterEnable']) && $footerSocialIcons['twitterEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['twitterLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class="social-media fab fa-twitter"></i></a>
                                </li>
                            @endif
                            @if (isset($footerSocialIcons['linkedInEnable']) && $footerSocialIcons['linkedInEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['linkedInLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class="social-media fab fa-linkedin"></i></a>
                                </li>
                            @endif
                            @if (isset($footerSocialIcons['youtubeEnable']) && $footerSocialIcons['youtubeEnable'] == '1')
                                <li class="list-inline-item mr-1"><a href="{{ $footerSocialIcons['youtubeLink'] }}"
                                        class="text-body social-media" target="_blank"><i
                                            class="social-media fab fa-youtube"></i></a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div> --}}
                <div class="col-lg-1 mb-4 mb-lg-0 footer_sec"></div>
            </div>
            <br>
            <div class="row align-items-center first-rw" style="padding-bottom: 0px !important;">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <p class="mb-0 text-left fs-14  letter-spacing-07px font-weight-600 footer-text-white ptag">CONTACT
                        US</p>
                </div>
            </div>
            <div class="row align-items-center first-rw">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <p class="mb-0 text-left fs-14 letter-spacing-07px ptag ">
                        <a href="mailto:clientservices@jusoutbeauty.com" class="footer-text-white">
                            <i class="fa fa-envelope"> </i> clientservices@jusoutbeauty.com
                        </a>
                    </p>
                </div>
                <div class="col-lg-2 mb-4 mb-lg-0">
                    <p class="mb-0 text-left fs-14  letter-spacing-07px text-lg-center ">
                        <a href="tel:+92 866 848 2168" class="footer-text-white">
                            <i class="fa fa-phone"> </i> 866-848-2168
                        </a>
                    </p>
                </div>
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <p class="mb-0 text-left fs-14 letter-spacing-07px text-lg-right footer-text-white ptag">
                        <i class="fa fa-clock"> </i> Operating Hours: 6am-1am EST Mon-Sat,
                        excluding holidays

                    </p>
                </div>
            </div>
            <br>
            <div class="row first-rw footer-aboutus">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <p class="mb-0 text-left fs-14 letter-spacing-07px font-weight-600 footer-text-white ptag">ABOUT US</p>
                    <p class="mb-0 text-left fs-14  letter-spacing-07px footer-text-white ptag">Welcome
                        to JusOut Beauty, all inclusive, high performance, natural
                        skincare, and makeup - Yur Jus Enough beauty products to glow from
                        within.</p>
                </div>
                <div class="col-lg-2 mb-4 mb-lg-0 footer-text-white">
                    <p class="mb-0 text-left fs-14  letter-spacing-07px font-weight-600 footer-text-white ptag">COMPANY
                    </p>
                    <ul>
                        <li><a href="{{ session('site') }}/who-we-are" class="footer-text-white">Meet Founder</a></li>
                        <li><a href="{{ session('site') }}/who-we-are" class="footer-text-white">Our Story</a></li>
                        <!-- 						<li><a href="#">Careers</a></li> -->
                        <li><a href="{{ session('site') }}/eco-vibes" class="footer-text-white">Sustainability</a>
                        </li>
                        <li><a href="{{ session('site') }}/ingredients" class="footer-text-white">Ingredients</a>
                        </li>
                        <li><a href="{{ session('site') }}/blog-page" class="footer-text-white">Blogs</a></li>

                    </ul>
                </div>
                <div class="col-lg-2 mb-4 mb-lg-0 footer-text-white">
                    <p class="mb-0 text-left fs-14 letter-spacing-07px font-weight-600 ptag">CUSTOMER CARE</p>
                    <ul>
                        <li><a href="{{ url('/customer-help') }}" onclick="informationflag('customer')"
                                class="footer-text-white">Customer Service</a></li>
                        <li><a href="{{ url('/customer-help') }}" onclick="informationflag('contact')"
                                class="footer-text-white">Contact Us</a> </li>
                        <li><a href="{{ url('/customer-help') }}" id="v-pills-settings-tab-5"
                                class="footer-text-white" onclick="informationflag('track order')">Track Order</a>
                        </li>
                        <li><a href="{{ url('/customer-help') }}" id="v-pills-settings-tab-4"
                                class="footer-text-white" onclick="informationflag('shipping')">Shipping & Returns</a>
                        </li>
                        <li><a href="{{ url('/subscription') }}" class="footer-text-white">Subscribe +
                                Save</a></li>
                        <!-- 						<li><a href="#">FAQs</a></li> -->
                        <?php if(session()->has('userId')){?>
                        <li><a href="{{ url('/user-login') }}" class="footer-text-white">My Account</a></li>
                        <?php }else{?>
                        <li><a href="{{ url('/user-login') }}" class="footer-text-white">My Accounts</a></li>
                        <?php }?>
                        <li><a href="{{ url('/customer-help') }}" class="footer-text-white"
                                onclick="informationflag('faq')">FAQs</a></li>

                    </ul>
                </div>
                <div class="col-lg-2 mb-4 mb-lg-0 footer-text-white">
                    <p class="mb-0 text-left fs-14 letter-spacing-07px font-weight-600 ptag">BEAUTY
                        & SKIN</p>
                    <ul>
                        <li><a href="{{ session('site') }}/Shop-All" class="footer-text-white"
                                data-type="SUB_CATEGORY">Shop Products</a></li>
                        <li><a href="{{ session('site') }}/Shop-All" data-type="SUB_CATEGORY"
                                class="footer-text-white">Shop Subscription</a></li>
                        <li><a href="{{ session('site') }}/user-shade-finder" class="footer-text-white">Shade
                                Finder</a></li>
                        <li><a href="javascript:;" class="toShopListing footer-text-white" data-id="6"
                                data-type="CATEGORY" data-categoryslug="Skincare">Skincare</a></li>
                        <li><a href="javascript:;" class="toShopListing footer-text-white" data-id="7"
                                data-type="CATEGORY" data-categoryslug="Makeup">Makeup</a></li>
                        <li><a href="javascript:;" class="toShopListing footer-text-white" data-id="8"
                                data-type="CATEGORY" data-categoryslug="Nutrition">Nutrition</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 mb-4 mb-lg-0 footer-text-white">
                    <p class="mb-0 text-left fs-14 letter-spacing-07px font-weight-600 ptag">OFFERS
                    </p>
                    <ul>
                        {{-- <li><a href="{{ session('site') }}/user-login">Student Discount</a></li> --}}
                        {{-- <li><a href="{{ session('site') }}/reward">Beauty Rewards</a></li> --}}
                        {{-- <li><a href="{{ session('site') }}/user-login">Refer a Friend</a></li> --}}
                        <li><a href="{{ url('/home') }}#bestSelOnlineExc_section"
                                class="refferAfrieend footer-text-white">Online Exclusive</a></li>
                        <li><a href="{{ url('/home') }}#bestSelOnlineExc_section"
                                class="refferAfrieend footer-text-white">Best Of Month</a></li>
                        <li><a href="{{ url('/home') }}#to_day_offer"
                                class="refferAfrieend1 footer-text-white">Today Offer</a></li>
                    </ul>
                </div>
            </div>
            <br>
            <div class="row first-rw footer-text-white">

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 mb-lg-0 ">
                    <p class="mb-0 text-uppercase text-left fs-14 letter-spacing-07px text-center">
                        A© 2022 <a href="#" class="footer-text-white">Jusout Beauty</a> All Rights Reserved
                    </p>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 text-center d-sm-unset footer-txt">
                    <a href="{{ url('/customer-help') }}" id="v-pills-home-tab"
                        onclick="informationflag('term of use')" class="footer-text-white">Terms of
                        Use</a> &nbsp;|&nbsp; <a href="{{ url('/customer-help') }}" id="v-pills-profile-tab-1"
                        id="v-pills-home-tab" onclick="informationflag('privacy policy')"
                        class="footer-text-white">Privacy Policy</a>&nbsp; |&nbsp; <a
                        href="{{ url('/customer-help') }}" class="footer-text-white" id="v-pills-messages-tab-2"
                        id="v-pills-home-tab"onclick="informationflag('accessibility')"
                        class="footer-text-white">Accessibility</a>
                    &nbsp;|&nbsp; <a href="{{ url('/customer-help') }}" id="v-pills-settings-tab-3"
                        id="v-pills-home-tab"onclick="informationflag('cookies settings/policy')"
                        class="footer-text-white">Cookies Settings/Policy</a>
                    <!--<ul class="list-inline fs-18 ml-3 mb-0">-->
                    <!--<li class="list-inline-item mr-6">-->
                    <!--<a href="#" class="text-body hover-primary"><i class="fab fa-facebook-f"></i></a>-->
                    <!--</li>-->
                    <!--<li class="list-inline-item mr-6">-->
                    <!--<a href="#" class="text-body hover-primary"><i class="fab fa-instagram"></i></a>-->
                    <!--</li>-->
                    <!--<li class="list-inline-item mr-6">-->
                    <!--<a href="#" class="text-body hover-primary"><i class="fab fa-twitter"></i></a>-->
                    <!--</li>-->
                    <!--<li class="list-inline-item mr-6">-->
                    <!--<a href="#" class="text-body hover-primary"><i class="fab fa-linkedin"></i></a>-->
                    <!--</li>-->
                    <!--<li class="list-inline-item mr-6">-->
                    <!--<a href="#" class="text-body hover-primary"><i class="fab fa-youtube"></i></a>-->
                    <!--</li>-->
                    <!--</ul>-->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- wathsapp -->
<style>
    .float {
        position: fixed;
        width: 44px;
        height: 44px;
        bottom: 155px;
        right: 26px;
        background-color: #f9a7a9;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .15) !important;
        z-index: 100;
    }

    .my-float {
        margin-top: 7px;
    }

    .cookie-frame {
        position: fixed;
        bottom: -85%;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 999;
        display: none;
        align-items: center;
        justify-content: center;
        transition: bottom 2s ease-out;
        /* Add transition effect */
        transition-delay: 1s;
        /* Add delay */
    }

    .cookie-frame.open {
        display: block;
        transition: bottom 1s ease-out;
        /* Add transition effect */
        transition-delay: 1s;
        /* No delay when opening */
    }

    .cookie-frame.hide {
        /* Move to the original hidden position */
        transition: bottom 1s ease-out;
        /* Add transition effect */
        transition-delay: 1s;
        /* No delay when hiding */
    }


    .cookie-content {
        background-color: #f9f9f9;
        padding: 5px 20px 5px 20px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .cookie-content .text {
        padding-left: 80px;
    }

    .btn {
        margin-top: 10px;
    }

    .btn-my {
        color: #0e0d21 !important;
        border-color: #3d94b7;
        background-color: #f4f2f3;
    }

    .btn-my:hover {
        color: white !important;
        background-color: #c0a9bd;
        border-color: #b73d94;
        outline: #b73d94;
    }

    .btn-my:focus,
    .btn-my:active {
        color: white;
        /* background-color: #b73d94; */
        border-color: #b73d94;
        outline: #b73d94;
    }
    .cookie-txt{
    font-size: 12px;
    text-align: left;
    }

    @media (max-width: 174px) {
        .cookie-frame.open {}

        .cookie-content {
            background-color: #f9f9f9;
            padding: 5px;
            padding-bottom: 10px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }
    }

    @media (min-width: 174px) and (max-width: 200px) {

        /* Styles for mobile devices */
        .cookie-frame.open {}

        .cookie-content {
            background-color: #f9f9f9;
            padding: 5px;
            padding-bottom: 10px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }
    }

    @media (min-width: 200px) and (max-width: 252px) {

        /* Styles for mobile devices */
        .cookie-frame.open {}

        .cookie-content {
            background-color: #f9f9f9;
            padding: 5px;
            padding-bottom: 10px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }
    }

    @media (min-width: 252px) and (max-width: 300px) {

        /* Styles for mobile devices */
        .cookie-frame.open {
            /* bottom: -72%;  */
            /* Adjust the bottom position for mobile devices */
        }

        .cookie-content {
            background-color: #f9f9f9;
            padding: 5px;
            padding-bottom: 10px;
            /* text-align: center; */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .btn {
            margin-top: 0;
        }

        .cookie-content .text {
            padding-left: 0px;
        }
    }

    @media (min-width: 300px) and (max-width: 438px) {

        /* Styles for mobile devices */
        .cookie-frame.open {
            /* Adjust the bottom position for mobile devices */
        }

        .cookie-content {
            background-color: #f9f9f9;
            padding: 5px;
            padding-bottom: 10px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .btn {
            margin-top: 0;
        }

        .cookie-content .text {
            padding-left: 5px;
        }
    }

    @media (min-width: 438px) and (max-width: 576px) {

        /* Styles for mobile devices */
        .cookie-frame.open {
            /* Adjust the bottom position for mobile devices */
        }

        .cookie-content {
            background-color: #f9f9f9;
            padding: 5px;
            padding-bottom: 10px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .btn {
            margin-top: 0;
        }

        .cookie-content .text {
            padding-left: 10px;
        }
    }


    @media (min-width: 577px) and (max-width: 992px) {

        /* Styles for tablets and smaller screens */
        .cookie-frame.open {
            /* Adjust the bottom position for tablets and smaller screens */
        }

        .cookie-content .text {
            padding-left: 50px;
        }
    }


    @media (min-width: 992px) {

        /* Styles for larger screens */
        .cookie-frame.open {
            /* Adjust the bottom position for larger screens */
        }

        .cookie-content .text {
            padding-left: 80px;
        }
    }

    @media screen and (min-width: 0px) and (max-width: 425px) {
        .cookie-frame {
            bottom: -78%;
        }
     
    }
  
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=19142991742" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
<!-- wathsapp -->


<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>




<script src="{{ url('/assets-web') }}/vendors/jquery.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/bootstrap/bootstrap.bundle.js"></script>
<script src="{{ url('/assets-web') }}/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/slick/slick.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/waypoints/jquery.waypoints.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/counter/countUp.js"></script>
<script src="{{ url('/assets-web') }}/vendors/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/hc-sticky/hc-sticky.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/jparallax/TweenMax.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/mapbox-gl/mapbox-gl.js"></script>
<script src="{{ url('/assets-web') }}/vendors/isotope/isotope.js"></script>
<script src="{{ url('/assets-web') }}/vendors/jquery.fullscreen.min.js"></script>
<script src="{{ url('/assets-web') }}/vendors/chartjs/chart.min.js"></script>
<script src="{{ url('/assets-web') }}/js/theme.js"></script>

<script>
    var acc = document.getElementsByClassName("accordion_inc_home");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>

<script src="{{ url('/assets-web') }}/js/theme.js"></script>
<svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1"
    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <symbol id="icon-five-bars" viewBox="0 0 44 32">
            <path
                d="M1.846 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M11.692 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M21.538 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M31.385 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M41.231 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
        </symbol>
        <symbol id="icon-four-bars" viewBox="0 0 34 32">
            <path
                d="M1.846 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M11.692 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M21.538 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M31.385 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
        </symbol>
        <symbol id="icon-three-bars" viewBox="0 0 42 32">
            <path
                d="M40 4c0 1.325-1.075 2.4-2.4 2.4h-35.2c-1.325 0-2.4-1.075-2.4-2.4s1.075-2.4 2.4-2.4h35.2c1.325 0 2.4 1.075 2.4 2.4z">
            </path>
            <path
                d="M40 16.8c0 1.325-1.075 2.4-2.4 2.4h-35.2c-1.325 0-2.4-1.075-2.4-2.4s1.075-2.4 2.4-2.4h35.2c1.325 0 2.4 1.075 2.4 2.4z">
            </path>
            <path
                d="M40 29.6c0 1.325-1.075 2.4-2.4 2.4h-35.2c-1.325 0-2.4-1.075-2.4-2.4s1.075-2.4 2.4-2.4h35.2c1.325 0 2.4 1.075 2.4 2.4z">
            </path>
        </symbol>
        <symbol id="icon-three-vertical-bars" viewBox="0 0 25 32">
            <path
                d="M1.846 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M11.692 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M21.538 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
        </symbol>
        <symbol id="icon-two-bars" viewBox="0 0 15 32">
            <path
                d="M1.846 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
            <path
                d="M11.692 0c1.020 0 1.846 0.827 1.846 1.846v27.077c0 1.020-0.827 1.846-1.846 1.846s-1.846-0.827-1.846-1.846v-27.077c0-1.020 0.827-1.846 1.846-1.846z">
            </path>
        </symbol>
        <symbol id="icon-flash" viewBox="0 0 19 32">
            <path
                d="M18.473 13.925l-9.61 17.741c-0.142 0.2-0.356 0.333-0.641 0.333-0.071 0-0.142 0-0.214 0-0.356-0.133-0.569-0.4-0.498-0.734l2.349-13.273-9.112-0.133c-0.285 0-0.498-0.133-0.641-0.333s-0.142-0.467 0-0.667l10.678-16.541c0.214-0.267 0.569-0.4 0.854-0.267 0.356 0.133 0.498 0.467 0.427 0.8l-2.99 12.139h8.756c0.214 0 0.498 0.133 0.641 0.333 0.071 0.133 0.071 0.4 0 0.6z">
            </path>
        </symbol>
        <symbol id="icon-paylay" viewBox="0 0 32 32">
            <path
                d="M28.982 7.663c-0.102-1.629-0.636-3.023-1.596-4.162-1.829-2.17-5.116-3.314-9.507-3.314-1.708-0-10.539-0.186-10.628-0.186-0.006 0-0.011 0-0.017 0-0.355 0-0.665 0.239-0.743 0.587l-5.922 26.421c-0.051 0.226 0.004 0.455 0.149 0.636s0.363 0.278 0.594 0.278h3.927l-0.716 3.139c-0.052 0.226 0.002 0.467 0.147 0.648s0.363 0.291 0.595 0.291h9.904c0.364 0 0.679-0.259 0.747-0.618l1.242-6.457 4.638-0.038c0.023-0 0.046-0.001 0.069-0.004 0.078-0.008 7.864-0.884 9.416-9.937 0.668-3.902-0.81-6.095-2.299-7.282zM7.841 1.523c2.068 0.045 8.561 0.19 10.038 0.19 3.871 0 6.834 1 8.343 2.791 1.125 1.335 1.496 3.201 1.103 5.493-1.401 8.175-7.955 9.166-8.546 9.234l-5.531 0.064c-0.002 0-0.004 0-0.005 0-0.364 0-0.677 0.152-0.747 0.51l-1.318 6.601h-8.914l5.577-24.882zM29.78 14.687c-1.319 7.695-7.49 8.61-8.036 8.676l-5.223 0.042c-0.362 0.003-0.672 0.266-0.741 0.622l-1.24 6.457h-8.319l0.581-2.562h5.002c0.364 0 0.677-0.25 0.747-0.607l1.318-6.699 4.943 0.036c0.025 0 0.051 0 0.077-0.002 0.083-0.008 8.3-0.886 9.938-10.446 0.027-0.158 0.051-0.315 0.072-0.47 0.938 1.236 1.235 2.895 0.883 4.953z">
            </path>
        </symbol>
        <symbol id="icon-Play" viewBox="0 0 32 32">
            <path fill="none" stroke="currentColor" stroke-linejoin="round" stroke-linecap="round"
                stroke-miterlimit="4" stroke-width="2"
                d="M28.519 15.147l-17.997-10.999c-0.152-0.093-0.325-0.143-0.503-0.147s-0.353 0.041-0.508 0.128c-0.155 0.087-0.284 0.213-0.374 0.367s-0.137 0.328-0.137 0.505v21.997c0 0.178 0.047 0.352 0.137 0.505s0.219 0.28 0.374 0.367c0.155 0.087 0.33 0.131 0.508 0.128s0.351-0.054 0.503-0.147l17.997-10.999c0.146-0.089 0.267-0.215 0.351-0.364s0.128-0.318 0.128-0.489-0.044-0.34-0.128-0.489c-0.084-0.149-0.205-0.275-0.351-0.364z">
            </path>
        </symbol>
        <symbol id="icon-card" viewBox="0 0 39 32">
            <path fill="currentColor" stroke="currentColor"
                d="M38.685 3.756c-0.51-0.603-1.225-0.972-2.012-1.037l-27.735-2.316c-0.788-0.066-1.553 0.179-2.157 0.689-0.601 0.508-0.969 1.219-1.037 2.003l-0.558 5.235h-2.228c-1.631 0-2.958 1.327-2.958 2.958v17.362c0 1.631 1.327 2.958 2.958 2.958h27.832c1.631 0 2.958-1.327 2.958-2.958v-2.816l0.988 0.082c0.083 0.007 0.166 0.010 0.248 0.010 1.521 0 2.817-1.17 2.946-2.712l1.445-17.301c0.066-0.787-0.179-1.553-0.689-2.157v0zM2.958 9.868h27.832c0.783 0 1.42 0.637 1.42 1.42v1.582h-30.671v-1.582c0-0.783 0.637-1.42 1.42-1.42v0zM1.538 14.409h30.671v3.191h-30.671v-3.191zM30.79 30.069h-27.832c-0.783 0-1.42-0.637-1.42-1.42v-9.511h30.671v9.511c0 0.783-0.637 1.42-1.42 1.42zM37.841 5.785l-1.445 17.301c-0.065 0.78-0.753 1.362-1.533 1.297l-1.116-0.093v-13.001c0-1.631-1.327-2.958-2.958-2.958h-24.056l0.541-5.080c0.001-0.006 0.001-0.012 0.002-0.018 0.065-0.78 0.753-1.362 1.533-1.297l27.735 2.316c0.378 0.032 0.721 0.208 0.966 0.498s0.362 0.657 0.331 1.035v0z">
            </path>
            <path fill="currentColor" stroke="currentColor"
                d="M28.99 21.425h-7.403c-0.425 0-0.769 0.344-0.769 0.769v4.83c0 0.425 0.344 0.769 0.769 0.769h7.403c0.425 0 0.769-0.344 0.769-0.769v-4.83c0-0.425-0.344-0.769-0.769-0.769zM28.221 26.255h-5.865v-3.291h5.865v3.291z">
            </path>
        </symbol>
    </defs>
</svg>
<div class="position-fixed pos-fixed-bottom-right p-6 z-index-10" data-toggle="tooltip" data-placement="left"
    title="Back To Top">
    <a href="{{ url('/store') }}"
        class="gtf-back-to-top text-decoration-none hover-dark shadow p-0 rounded-circle fs-20 d-flex align-items-center justify-content-center text-light uparrow"
        style="height: 44px;width: 44px"><i class="fal fa-arrow-up"></i></a>
</div>
<div class="canvas-sidebar cart-canvas">
    <div class="canvas-overlay"></div>
    <div class="card border-0 pt-4 h-100">
        <div class="px-6 text-right">
            <span class="canvas-close d-inline-block fs-14 mb-1 ml-auto lh-1 "><i class="fal fa-times"></i></span>
        </div>
        <div class="card-header bg-transparent border-0 p-0 mx-6">
            <h3 class="fs-14 mb-1 font-weight-500">Shopping cart</h3>
            <p class="fs-14 mb-5 " id="itemCounts">1 Item(s)</p>
            <div class="custom-progress">
                <h4 class="fs-14 mb-3 border-bottom">ORDER SUMMARY</h4>

            </div>
        </div>
        <div class="card-body px-6 overflow-y-auto" id="cartRightMenuListingHTML">

            <!-- ============== CART RIGHT MENU HTML ============= -->

        </div>
        <div class="card-footer mt-auto border-0 px-6 pt-3">



            <div>
                <div class="d-flex align-items-center mb-0 fs-14 font-weight-500">
                    <span>Subtotal</span>
                    <span class="d-block ml-auto" id="cartSubTotal">$0.00</span>

                </div>
                <div class="mb-1 fs-14">Taxes and shipping calculated at checkout</div> <br>
                <a href="javascript:;" class="btn btn-primary btn-block mb-3 checkout-btn fs-14">Check Out</a>
                <!-- {{ url('/checkout') }} -->
                <input type="hidden" id="cartCount" value="0">

            </div>
        </div>
    </div>
</div>
<div class="mfp-hide search-popup mfp-with-anim bg-white" id="search-popup">
    <div class="container container-xxl">
        <nav class="navbar navbar-expand-xl px-0 py-2 py-xl-0 row no-gutters main-header align-items-start">
            <div class="col-xl-2">
                <a class="navbar-brand mr-0" href="{{ url('/store') }}"> <img
                        src="{{ url('/assets-web') }}/images/logo-black.png" alt="Minimog">
                </a>
            </div>
            <div class="col-xl-8 d-flex justify-content-center position-static">
                <form class="w-100">
                    <div class="input-group position-relative mb-2 mw-830 mx-auto">
                        <input type="text" class="form-control form-control bg-transparent border-primary rounded"
                            placeholder="Search product">
                        <div class="input-group-append position-absolute pos-fixed-right-center">
                            <button class="input-group-text bg-transparent border-0 px-0 fs-28 pr-3" type="submit">
                                <i class="fal fa-search fs-20 font-weight-normal"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <p class="text-muted mb-0 mr-3 ">Popular Searches</p>
                        <nav class="nav">
                            <a class="nav-link text-decoration-underline py-0 px-2"
                                href="{{ url('/store') }}">T-Shirt</a> <a
                                class="nav-link text-decoration-underline py-0 px-2"
                                href="{{ url('/store') }}">Blue</a> <a
                                class="nav-link text-decoration-underline py-0 px-2"
                                href="{{ url('/store') }}">Jacket</a>
                        </nav>
                    </div>
                </form>
            </div>
            <div class="col-xl-2 position-relative">
                <div class="d-flex align-items-center justify-content-end">
                    <ul
                        class="navbar-nav flex-row justify-content-xl-end align-items-center d-flex flex-wrap py-0 navbar-right">
                        <li class="nav-item" data-toggle="tooltip" title="Account"><a class="nav-link px-2 py-0"
                                href="{{ url('/dashboard/dashboard') }}"> <i class="fal fa-user-alt"></i>
                            </a></li>
                        <li class="nav-item" data-toggle="tooltip" title="Wishlist"><a
                                class="nav-link position-relative px-2 py-0" href="{{ url('wishlist') }}"> <i
                                    class="fal fa-star"></i> <span
                                    class="position-absolute number bg-secondary">0</span></a></li>
                        <li class="nav-item" data-toggle="tooltip" title="Cart"><a
                                class="nav-link position-relative px-2 menu-cart py-0 d-inline-flex align-items-center mr-n2"
                                href="{{ url('/store') }}" data-canvas="true"
                                data-canvas-options='{"container":".cart-canvas"}'> <i
                                    class="fal fa-shopping-bag"></i> <span
                                    class="position-absolute number bg-secondary">2</span>
                            </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="sidenav canvas-sidebar bg-white">
    <div class="canvas-overlay"></div>
    <div class="pt-5 pb-7 card border-0 h-100">
        <div class="d-flex align-items-center card-header border-0 py-0 pl-8 pr-7 mb-9 bg-transparent">
            <a href="{{ url('home') }}" class="d-block w-179px"> <img
                    src="{{ url('/assets-web') }}/images/logo-black.png" alt="Jusout">
            </a> <span class="canvas-close d-inline-block text-right fs-24 ml-auto lh-1 "><i
                    class="fal fa-times"></i></span>
        </div>
        <div class="overflow-y-auto pb-6 pl-8 pr-7 card-body pt-0">
            <ul class="navbar-nav main-menu px-0 ">

                <?php if(isset($categoryProducts) && !empty($categoryProducts)){?>
                <?php foreach($categoryProducts as $value){?>

                <li aria-haspopup="true" aria-expanded="false"
                    class="nav-item dropdown py-1 px-0 d-flex justify-content-between">


                    <a class="nav-link dropdown-toggle p-0 "
                        href="<?= url('/') ?>/Store/<?= $value['CATEGORY_SLUG'] ?>"
                        data-id="<?= $value['CATEGORY_ID'] ?>" data-type="CATEGORY"
                        data-categoryslug="<?= $value['CATEGORY_SLUG'] ?>" data-type="CATEGORY"> <?= $value['NAME'] ?>
                    </a>

                    <i class="fas fa-plus list-sub-cate-icon " id="menuicon_<?= $value['CATEGORY_ID'] ?>"
                        onclick="menutoggle(<?= $value['CATEGORY_ID'] ?>);"></i>

                </li>
                <ul class="list-sub-cate ul-mbl-site ulMblSite" id="ul-mbl-site_<?= $value['CATEGORY_ID'] ?>"
                    style="display:none;">
                    <?php $subCategories = $value['subCategories']; ?>
                    {{-- <li>


                        <a class="dropdown-link" href="{{ session('site') }}/Shop-All">Shop All</a>
                    </li> --}}
                    @if (!empty($subCategories))
                        @foreach ($subCategories as $category)
                            <div class="dropdown-item">
                                {{-- toShopListing  ---> removed after made url href --}}
                                <a class="dropdown-link "
                                    href="<?= url('/') ?>/Store/<?= $value['CATEGORY_SLUG'] ?>/<?= $category['SUB_CATEGORY_SLUG'] ?>"
                                    data-id="<?= $category['SUB_CATEGORY_ID'] ?>" data-type="SUB_CATEGORY"
                                    data-subcategoryslug="<?= $category['SUB_CATEGORY_SLUG'] ?>"
                                    data-categoryslug="<?= $value['CATEGORY_SLUG'] ?>">{{ $category['DISPLAY_NAME'] }}</a>
                            </div>
                        @endforeach
                    @endif

                </ul>
                <?php }?>

                <?php }?>

                <!-- <li aria-haspopup="true" aria-expanded="false"
     class="nav-item dropdown py-1 px-0"><a
     class="nav-link dropdown-toggle p-0" href="{{ url('/skincare') }}">
      Skincare </a></li>
    <li aria-haspopup="true" aria-expanded="false"
     class="nav-item dropdown py-1 px-0"><a
     class="nav-link dropdown-toggle p-0" href="{{ url('/makeup') }}">
      Makeup </a></li>
    <li aria-haspopup="true" aria-expanded="false"
     class="nav-item dropdown py-1 px-0"><a
     class="nav-link dropdown-toggle p-0" href="{{ url('/nutrition') }}">
      Nutrition </a></li> -->
                <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0"><a
                        class="nav-link dropdown-toggle p-0 footer-text-white"
                        href="{{ session('site') }}/user-shade-finder" style=""> Shade
                        Finder </a></li>
                {{-- <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0"><a
                        class="nav-link dropdown-toggle p-0" href="{{ url('become_a_partner') }}"> Partner </a></li> --}}
                <li aria-haspopup="true" aria-expanded="false"
                    class="nav-item dropdown py-1 px-0 d-flex justify-content-between">
                    <a class="nav-link dropdown-toggle p-0" href="#!">
                        Routine
                    </a>
                    <i class="fas fa-plus list-sub-cate-icon " id="menuicon_routine"
                        onclick="menutoggleRoutine();"></i>

                </li>
                <ul class="list-sub-cate ul-mbl-site ulMblSite" id="ul-mbl-site_routine" style="display:none;">



                    @if (!empty($routineformbl))

                        <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0 " style="display: block;">
                            ROUTINE BY NEEDS</h4>

                        @foreach ($routineformbl as $routinembl)
                            {{-- @dd($key,$routinembl) --}}
                            {{-- @if (count($routinembl) && isset($routinembl)) --}}
                            {{-- @foreach ($routinembl as $key => $routinembllist) --}}
                            {{-- @dd($routines[0]['IDENTIFY']) --}}
                            @if ($routinembl['IDENTIFY'] == 1)
                                <li class="">
                                    <a class="dropdown-link"
                                        href="{{ url('routine-detail') . '/' . $routinembl['seqNo'] }}">{{ $routinembl['NAME'] }}</a>
                                </li>
                            @endif
                            {{-- @endforeach  --}}
                            {{-- @else
                                <li class="">
                                    <a class="dropdown-link" href="{{ url('routine-detail').'/'.$routinembl['seqNo']}}">{{ $routinembl['NAME'] }}</a>
                                </li> --}}
                            {{-- @endif --}}
                        @endforeach


                        <h4 class="dropdown-header fs-16 mb-3 mt-3 lh-1 font-weight-500 p-0 " style="display: block;">
                            ROUTINE BY AGE</h4>

                        @foreach ($routineformbl as $routinembl)
                            @if ($routinembl['IDENTIFY'] == 2)
                                <li class="">
                                    <a class="dropdown-link"
                                        href="{{ url('routine-detail') . '/' . $routinembl['seqNo'] }}">{{ $routinembl['NAME'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif

                </ul>

                <li aria-haspopup="true" aria-expanded="false"
                    class="nav-item dropdown py-1 px-0 d-flex justify-content-between"><a
                        class="nav-link dropdown-toggle p-0" href="{{ url('/discover') }}">
                        Discover </a>
                    <i class="fas fa-plus list-sub-cate-icon " id="menuicon_discover"
                        onclick="menutogglediscover();"></i>
                </li>
                <ul class="list-sub-cate ul-mbl-site ulMblSite" id="ul-mbl-site_discover" style="display:none;">

                    <li>
                        <a class="" href="{{ url('/who-we-are') }}">
                            Who We Are
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ url('/ingredients') }}">
                            Ingredients
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ url('/eco-vibes') }}">
                            Eco Vibes
                        </a>
                    </li>
                    <li>
                        <a class="" href="{{ url('/lusty-looks') }}">
                            Lusty's Looks
                        </a>
                    </li>

                </ul>
                <li aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-1 px-0"><a
                        class="nav-link dropdown-toggle p-0" href="{{ url('/giving') }}">
                        Giving </a></li>

            </ul>
        </div>
        {{-- <div class="card-footer bg-transparent border-0 mt-auto pl-8 pr-7 pb-0 pt-4">
            <ul class="list-inline d-flex align-items-center mb-3">
                <li class="list-inline-item mr-4"><a href="{{ url('/store') }}" class="fs-20 lh-1"><i
                            class="fab fa-pinterest-p"></i></a></li>
                <li class="list-inline-item mr-4"><a href="{{ url('/store') }}" class="fs-20 lh-1"><i
                            class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item mr-4"><a href="{{ url('/store') }}" class="fs-20 lh-1"><i
                            class="fab fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="{{ url('/store') }}" class="fs-20 lh-1"><i
                            class="fab fa-twitter"></i></a></li>
            </ul>
            <p class="mb-0 text-gray">
                Â© 2022 Jusout.<br> All rights reserved.
            </p>
        </div> --}}
    </div>
</div>




<div class="modal sign-in" id="sign-in" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header p-6 border-0">
                <nav class="nav nav-tabs w-100" id="nav-tab">
                    <a class="nav-link active border-bottom-0" id="nav-log-in-tab" data-toggle="tab"
                        href="{{ url('/store') }}nav-log-in">Log in</a>
                    <a class="nav-link border-bottom-0" id="nav-register-tab" data-toggle="tab"
                        href="{{ url('/store') }}nav-register">Register</a>
                </nav>
                <button type="button" class="close opacity-10 fs-32 pt-1 position-absolute" data-dismiss="modal"
                    aria-label="Close" style="right: 30px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-9 pb-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-log-in" role="tabpanel"
                        aria-labelledby="nav-log-in-tab">
                        <h4 class="fs-34 text-center mb-6">Sign In</h4>
                        <p class="text-center fs-16 mb-7">
                            DonÃ¢â‚¬â„¢t have an account yet? <a href="{{ url('/store') }}"
                                class=" border-bottom text-decoration-none">Sign up</a>
                            for free
                        </p>
                        <form>
                            <input name="email" type="email" class="form-control mb-3" placeholder="Your email"
                                required> <input name="password" type="password" class="form-control"
                                placeholder="Password" required>
                            <div class="d-flex align-items-center justify-content-between mt-5 mb-4">
                                <div class="custom-control custom-checkbox">
                                    <input name="stay-signed-in" type="checkbox" class="custom-control-input"
                                        id="staySignedIn"> <label class="custom-control-label "
                                        for="staySignedIn">Stay
                                        signed in</label>
                                </div>
                                <a href="{{ url('/store') }}" class=" text-decoration-underline">Forgot
                                    your
                                    password?</a>
                            </div>
                            <button type="submit" value="Login" class="btn btn-primary btn-block">Log In</button>
                            <div class="border-bottom mt-6"></div>
                            <div class="text-center mt-n2 lh-1 mb-4">
                                <span class="fs-14 bg-white lh-1 mt-n2 px-4">or Log-in with</span>
                            </div>
                            <div class="d-flex">
                                <a href="{{ url('/store') }}"
                                    class="btn btn-outline-primary btn-block border-2x border mr-5"><i
                                        class="fab fa-facebook-f mr-2" style="color: #2E58B2"></i>Facebook</a>
                                <a href="{{ url('/store') }}"
                                    class="btn btn-outline-primary btn-block border-2x border mt-0"><i
                                        class="fab fa-google mr-2" style="color: #DD4B39"></i>Google</a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
                        <h4 class="fs-34 text-center mb-6">Sign Up</h4>
                        <p class="text-center fs-16 mb-7">
                            Already have an account? <a href="{{ url('/store') }}"
                                class=" border-bottom text-decoration-none">Log in</a>
                        </p>
                        <form>
                            <input name="first-name" type="text" class="form-control mb-3"
                                placeholder="First name" required> <input name="last-name" type="text"
                                class="form-control mb-3" placeholder="Last name" required> <input name="email"
                                type="email" class="form-control mb-3" placeholder="Your email" required> <input
                                name="password" type="password" class="form-control" placeholder="Password"
                                required>
                            <div class="custom-control custom-checkbox mt-4 mb-5 mr-xl-6">
                                <input name="agree" type="checkbox" class="custom-control-input" id="termsOfUse">
                                <label class="custom-control-label " for="termsOfUse">
                                    Yes, I agree with Grace <a
                                        href="{{ url('customer-help#v-pills-profile') }}">Privacy
                                        Policy</a> and <a href="{{ url('/store') }}">Terms of Use</a>
                                </label>
                            </div>
                            <button type="submit" value="Login" class="btn btn-primary btn-block">Sign Up</button>
                            <div class="border-bottom mt-6"></div>
                            <div class="text-center mt-n2 lh-1 mb-4">
                                <span class="fs-14 bg-white lh-1 mt-n2 px-4">or Sign Up with</span>
                            </div>
                            <div class="d-flex">
                                <a href="{{ url('/store') }}"
                                    class="btn btn-outline-primary btn-block border-2x border mr-5"><i
                                        class="fab fa-facebook-f mr-2" style="color: #2E58B2"></i>Facebook</a>
                                <a href="{{ url('/store') }}"
                                    class="btn btn-outline-primary btn-block border-2x border mt-0"><i
                                        class="fab fa-google mr-2" style="color: #DD4B39"></i>Google</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="show_shade_modal_sidebar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">Product Name</th>
                                <th class="center">Shade Name</th>
                            </tr>
                        </thead>
                        <tbody id="showShadeName">
                            <tr>
                                <td class="center"></td>
                                <td class="center"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="closeSideBarShadeModal()">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->






<!-- <div class="canvas-sidebar filter-canvas">
 <div class="canvas-overlay"></div>
 <div class="card border-0 px-6 overflow-y-auto bg-white h-100 pb-6">
  <div class="card-header bg-transparent py-0 border-0">
   <div class="text-right pb-7">
    <span
     class="canvas-close d-inline-block text-right fs-24 pt-2 mr-n6 text-body"><i
     class="fal fa-times"></i></span>
   </div>
   <h4 class="fs-34 mb-0">Filter</h4>
  </div>
  <div class="card-body">
   <div class="card border-0 mb-7">
    <div class="card-header bg-transparent border-0 p-0">
     <h4 class="card-title fs-18 font-weight-500 mb-3">Size</h4>
    </div>
    <div class="card-body p-0">
     <ul class="list-inline">
      <li class="list-inline-item mr-2"><a href="{{ url('/store') }}"
       class="btn border border-hover-primary bg-transparent w-45px p-2 font-weight-normal text-primary">XS</a>
       <a href="{{ url('/store') }}"
       class="btn border border-hover-primary bg-transparent w-45px p-2 font-weight-normal text-primary">S</a>
       <a href="{{ url('/store') }}"
       class="btn border border-hover-primary bg-transparent w-45px p-2 font-weight-normal text-primary">M</a>
       <a href="{{ url('/store') }}"
       class="btn border border-hover-primary bg-transparent w-45px p-2 font-weight-normal text-primary">L</a>
      </li>
     </ul>
    </div>
   </div>
   <div class="card border-0 widget-color mb-7">
    <div class="card-header bg-transparent border-0 p-0">
     <h3 class="card-title fs-20 mb-0">Colors</h3>
    </div>
    <div class="card-body px-0 pt-4 pb-0">
     <ul class="list-inline mb-0">
      <li class="list-inline-item mr-2"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #d0a272;"></a></li>
      <li class="list-inline-item"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #68412d;"></a></li>
      <li class="list-inline-item"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #000000;"></a></li>
      <li class="list-inline-item"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #aa5959;"></a></li>
      <li class="list-inline-item"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #8db4d2;"></a></li>
      <li class="list-inline-item"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #c2c3a0;"></a></li>
      <li class="list-inline-item"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #c7857d;"></a></li>
      <li class="list-inline-item"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #e3e1e7;"></a></li>
      <li class="list-inline-item"><a href="{{ url('/store') }}"
       class="d-block item" style="background-color: #b490b0;"></a></li>
     </ul>
    </div>
   </div>
   <div class="card border-0 mb-7">
    <div class="card-header bg-transparent border-0 p-0">
     <h3 class="card-title fs-18 font-weight-500 mb-0">Categories</h3>
    </div>
    <div class="card-body px-0 pt-2 pb-0">
     <ul class="list-unstyled mb-0">
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Sweaters</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Dress</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Coats
        & Jackets</a></li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Handbag</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Boots</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Sunglasses</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Shirts</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body d-inline-block lh-12">Sale Items !</a></li>
     </ul>
    </div>
   </div>
   <div class="card border-0 mb-7">
    <div class="card-header bg-transparent border-0 p-0">
     <h3 class="card-title fs-18 font-weight-500 mb-0">Price</h3>
    </div>
    <div class="card-body px-0 pt-2 pb-0">
     <ul class="list-unstyled mb-0">
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">All
      </a></li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">$10
        - $100</a></li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">$100
        - $200</a></li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">$200
        - $300</a></li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">$300
        - $400</a></li>
     </ul>
    </div>
   </div>
   <div class="card border-0 mb-7">
    <div class="card-header bg-transparent border-0 p-0">
     <h3 class="card-title fs-18 font-weight-500 mb-0">Brand</h3>
    </div>
    <div class="card-body px-0 pt-2 pb-0">
     <ul class="list-unstyled mb-0">
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Pull
        & Bear</a></li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Guess</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Zara</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Columbia</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Mango</a>
      </li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Forever
        21</a></li>
      <li class="mb-1"><a href="{{ url('/store') }}"
       class="text-body hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">H&M</a>
      </li>
     </ul>
    </div>
   </div>
  </div>
 </div>
</div> -->
<form class="" id="shoplistingRedirectForm" method="POST" action="{{ url('/storeListing') }}"
    enctype="multipart/form-data" style="display:none;">
    <input type="hidden" name="_method" value="POST">
    {{ csrf_field() }}
    <input type="hidden" class="userId" id="userId" name="userId" value="<?php echo session('userId'); ?>">
    <input type="hidden" class="sourceId" id="sourceId" name="sourceId" value="">
    <input type="hidden" class="sourceCode" id="sourceCode" name="sourceCode" value="">
    <input type="hidden" class="sourceType" id="sourceType" name="sourceType" value="">
    <input type="hidden" class="category" id="category" name="category" value="">
    <input type="hidden" class="subcategory" id="subcategory" name="subcategory" value="">
</form>
<form class="" id="productDetailRedirectForm" method="POST" action="" enctype="multipart/form-data"
    style="display:none;">
    @method('POST')
    {{-- <input type="hidden" name="_method" value="POST"> --}}
    {{-- {{ csrf_field() }} --}}
    @csrf
    <input type="hidden" class="userId1" id="userId1" name="userId" value="<?php echo session('userId'); ?>">
    <input type="hidden" class="sourceId1" id="sourceId1" name="sourceId" value="">
    <input type="hidden" class="sourceCode1" id="sourceCode1" name="sourceCode" value="">
    <input type="hidden" class="sourceType1" id="sourceType1" name="sourceType" value="">
    <input type="hidden" class="category" id="category" name="category" value="">
    <input type="hidden" class="subcategory" id="subcategory" name="subcategory" value="">
    <input type="hidden" class="slug" id="slug" name="slug" value="">
</form>
</body>


<!-- angular files -->
<script src="{{ url('/public') }}/third_party/angular/angular.min.js"></script>
<script src="{{ url('/public') }}/third_party/angular/drag.js"></script>
<script src="{{ url('/public') }}/third_party/angular/smart.js"></script>

<!--  toastr and loading overlay -->
<script src="{{ url('/public') }}/third_party/jquery-loading-overlay/src/loadingoverlay.js"></script>
<script src="{{ url('/public') }}/third_party/toastr/js/toastr.min.js"></script>

<!-- jquery file upload plugin  -->
<script src="{{ url('/public') }}/third_party/file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="{{ url('/public') }}/third_party/file-upload/js/jquery.fileupload.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    var site = "<?php echo session('site'); ?>";
    var checkoutUrl = "<?php echo url('/checkout'); ?>";
</script>
<script src="{{ url('/assets-web') }}/customjs/common.js?v={{ time() }}"></script>
<script>
    // function searchAllNames(){

    //     $.ajax({
    //         method  : "GET",
    //         url: site+"/search-all-names",
    //         success: function(response){
    //             // data =[];
    //             // $.each( response, function( index, value ){
    //             //     data.push(value.NAME);
    //                 console.log(response);
    //                  startautosuggestion(response);
    //         }
    //     });
    // }

    //         function startautosuggestion(availableTags){

    //             $( ".tags" ).autocomplete({
    //                 source: availableTags
    //             });
    //         }

    function menutoggle(i) {

        if ($("#menuicon_" + i).hasClass('fa-plus')) {
            $('.ulMblSite').hide(1000);
            $(".list-sub-cate-icon").addClass('fa-plus');
            $(".list-sub-cate-icon").removeClass('fa-minus');
            $("#ul-mbl-site_" + i).show(1000);
        } else if ($("#menuicon_" + i).hasClass('fa-minus')) {
            $("#ul-mbl-site_" + i).hide(1000);
        }
        $("#menuicon_" + i).toggleClass('fa-minus', 500);
        $("#menuicon_" + i).toggleClass('fa-plus', 500);




    }

    function menutogglediscover() {
        if ($("#menuicon_discover").hasClass('fa-plus')) {
            $('.ulMblSite').hide(1000);
            $(".list-sub-cate-icon").addClass('fa-plus');
            $(".list-sub-cate-icon").removeClass('fa-minus');
            $("#ul-mbl-site_discover").show(1000);
        } else if ($("#menuicon_discover").hasClass('fa-minus')) {
            $("#ul-mbl-site_discover").hide(1000);
        }

        $("#menuicon_discover").toggleClass('fa-minus', 500);
        $("#menuicon_discover").toggleClass('fa-plus', 500);
    }

    function menutoggleRoutine() {
        if ($("#menuicon_routine").hasClass('fa-plus')) {
            $('.ulMblSite').hide(1000);
            $(".list-sub-cate-icon").addClass('fa-plus');
            $(".list-sub-cate-icon").removeClass('fa-minus');
            $("#ul-mbl-site_routine").show(1000);
        } else if ($("#menuicon_routine").hasClass('fa-minus')) {
            $("#ul-mbl-site_routine").hide(1000);
        }

        $("#menuicon_routine").toggleClass('fa-minus', 500);
        $("#menuicon_routine").toggleClass('fa-plus', 500);
    }
</script>

<script>
    function informationflag($text) {
        localStorage.setItem("information", $text);
    }

    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "158773151449430");
    chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v16.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        js.style.zIndex = "-1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
