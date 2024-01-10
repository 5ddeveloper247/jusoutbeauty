<?php
// echo session('userId');
// exit();
$userId = session('userId');
?>
@include('web.web-header')
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

<script>
    var instagram_feed = '';
</script>
<style>
    .flower-icon {
        font-size: 40px;
        position: absolute;
        left: 15px;

    }

    /* h2{
        font-size: 36px;
        text-transform: capitalize;
    } */
    .popup-dialog {
        max-width: 1300px;
    }

    .popup-padding {
        padding: 150px 100px;
    }

    .modalcontent-popup {
        color: white
    }

    .mt-20 {
        margin-top: 41.5rem
    }

    .modal-content button.close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 0;
        margin: 0;
        width: 40px;
        height: 40px;
        z-index: 1;
        text-shadow: none;
        background: rgba(0, 0, 0);
        color: white;
        opacity: 0.75;
    }


    .modal-content .modal-body .sale:after {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        content: '';
        width: 50px;
        height: 2px;
        background: #fff;
        margin: 0 auto;
    }

    .modal-content .modal-body.color-1 {
        background: #39bdc8;
    }

    .modal-content .modal-body h2 span {
        font-size: 36PX;
        font-weight: 700;
        margin-left: -40px;
        color: #fff;
    }

    .modal-content .modal-body h2 sup {
        position: absolute;
        top: 50%;
        right: -30px;
        font-size: 30px;
        font-weight: 700;
        margin-top: 10px;
    }

    .modal-content .modal-body h2 sub {
        position: absolute;
        bottom: 50%;
        right: -30px;
        margin-bottom: -35px;
        text-transform: uppercase;
        font-size: 16px;
        font-weight: 700;
    }

    .modal-content .modal-body .icon-2 {
        font-size: 120px !important;
        position: absolute;
        top: 0;
        right: 0;
        line-height: 0;
        z-index: 0;
        color: rgba(255, 255, 255, 0.3);
    }

    .modal-content .modal-body .subheading {
        font-size: 14px;
        text-transform: uppercase;
        color: #000;
        letter-spacing: 1px;
    }

    .modal-content .modal-body .sale {
        font-size: 150px !important;
        font-family: "Pacifico", cursive;
        color: #000;
        position: relative;
        margin-bottom: 30px;
        z-index: 0;
    }

    .modal-dialog {
        max-width: 700px;
    }

    .modal-content .modal-body h2 {
        position: relative;
        display: inline-block;
        line-height: 1;
    }

    .modal-content .modal-body .sale .icon {
        font-size: 79px;
        position: absolute;
        top: 0;
        left: 0;
        line-height: 0;
        z-index: 1;
        color: #fff;
    }

    .modal-content .modal-body .upper {
        text-transform: uppercase;
    }

    /* .hover-change-content .content-change {
    opacity: 0;
    transition: all .5s;
}
.hover-change-content .content-change {
    opacity: 0;
    transition: all .5s;
}
.hover-change-content:hover .content-change {
    opacity: 1;
}
.img-blog-height{
 height: 24rem;
}
.inc_image_blog_1_home{
 height: 14rem;
}
.trend_section_image{
 height:22rem
}
.created_section_img{
 height:20rem
}
.product-inclusive{
  height: 600px;
    background-repeat: no-repeat;
    background-size: cover;
 }
@media screen and (min-width: 0px) and (max-width: 614px) {
 .img-home-pay{
  height:auto !important
 }
 .img-blog-height{
  height: auto;
 }
 .inc_image_blog_1_home{
  height: auto;
 }
 .created_section_img,.trend_section_image {
  height: 15rem;
 }
 .addto-cart{
  padding: 0.6125rem 0.875rem;
 }
 .text-center-mbl{
  text-align: left !important
 }
 .img.card-img-top.inc_image_blog_1_home{
  margin: unset !important;
  margin-top: 12px!important;
 }
 img.inc_image_blog_1_home {
  width: 100% !important;

  margin-left: 8px !important;
 }
 .col-lg-8.col-6.fort_box_home1.cont_box{
  padding-left:0px!important;
  padding-right:32px!important

 }
 .col-lg-4.col-6.fort_box_home{
  padding-right:0px!important;
  padding-left: 24px;
 }
 .inc_image_blog_3{
  margin: unset !important;
  margin-left: 20px !important;
 }
 .col-lg-12.fort_box_home2.bottom_box{
  margin-left: 19px !important;
 }
 .col-lg-12.col-11.fort_box_home2.bottom_box{
  margin-left: 13px !important;
 }
 .blog_text_home {
  position: absolute;
  top: 162px;
  left: 100px;
  color: #fff;
  font-size: 42px;
 }
}
@media only screen and (min-width: 1749px){
 .product-inclusive{
  height: 865px;
    background-repeat: no-repeat;
    background-size: cover;
 }
 button.btn-link-custom.btn-link-custom-02.p-0.bg-transparent.part_head.addto-cart{
  font-size: 29px;
 }
 a.card.border-0.banner-03.hover-zoom-in{
  height: 800px !important;
 }

} */

    .product-inclusive {
        position: relative;
        overflow: hidden;
        /* Make sure the overlay doesn't overflow outside the parent container */
    }

    .product-inclusive .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2);
        /* You can adjust the transparency by changing the last value (0.6 in this case) */
    }

    .quick_view_product_image {
        width: 250px;
        height: 250px;
        margin: 0px auto;
        display: flex;
    }

    .sticky-area {
        background-color: transparent;
    }

    @media screen and (min-width: 0px) and (max-width: 575px) {
        #instaFeed_html {
            width: 371px;
            margin-left: 1rem
        }

        .popup-padding {
            padding: 22px 5px;
        }

        .mt-20 {
            margin-top: 15.5rem;
        }

        .modal-content .modal-body .sale {
            font-size: 80px !important;
            font-family: "Pacifico", cursive;
            color: #000;
            position: relative;
            margin-bottom: 30px;
            z-index: 0;
        }

        .modal-content .modal-body .icon {
            font-size: 40px;
            position: absolute;
            top: 0;
            left: 0;
            line-height: 0;
            z-index: 1;
            color: #fff;
        }

        .modal-content .modal-body h2 span {
            font-size: 65px;
            font-weight: 700;
            margin-left: -40px;
            color: #fff;
        }
    }

    @media screen and (min-width: 576px) {
        .popup-padding {
            padding: 50px 50px;
        }

        .mt-20 {
            margin-top: 24.5rem;
        }

        .popup-dialog {
            max-width: 1100px;
        }

        .modal-content .modal-body .icon {
            font-size: 50px;
            position: absolute;
            top: 0;
            left: 0;
            line-height: 0;
            z-index: 1;
            color: #fff;
        }

    }

    @media screen and (min-width: 768px) {
        .popup-padding {
            padding: 41px 24px !important;
        }

        .mt-20 {
            margin-top: 20.5rem !important;
        }

        .popup-dialog {
            max-width: 561px;
        }

        .modal-content .modal-body h2 span {
            font-size: 36PX;
            font-weight: 700;
            margin-left: -40px;
            color: #fff;
        }

        .modal-content .modal-body .sale {
            font-size: 98px !important;
            font-family: "Pacifico", cursive;
            color: #000;
            position: relative;
            margin-bottom: 30px;
            z-index: 0;
        }

        .modal-content .modal-body .icon {
            font-size: 60px;
            position: absolute;
            top: 0;
            left: 0;
            line-height: 0;
            z-index: 1;
            color: #fff;
        }

    }

    @media screen and (min-width: 992px) {
        .popup-padding {
            padding: 50px 50px !important;
        }

        .mt-20 {
            margin-top: 22.5rem !important;
        }

        .popup-dialog {
            max-width: 822px;
        }


    }

    @media screen and (min-width: 1200px) {
        .modal-content .modal-body .icon {
            font-size: 79px;
            position: absolute;
            top: 0;
            left: 0;
            line-height: 0;
            z-index: 1;
            color: #fff;
        }

        .modal-content .modal-body h2 span {
            font-size: 36PX;
            font-weight: 700;
            margin-left: -40px;
            color: #fff;
        }

        .popup-padding {
            padding: 100px 60px;
        }

        .mt-20 {
            margin-top: 24.5rem !important;
        }

        .modal-content .modal-body .sale {
            font-size: 138px !important;
            font-family: "Pacifico", cursive;
            color: #000;
            position: relative;
            margin-bottom: 30px;
            z-index: 0;
        }

    }

    @media screen and (min-width: 1400px) {
        .modal-content .modal-body .icon {
            font-size: 79px;
            position: absolute;
            top: 0;
            left: 0;
            line-height: 0;
            z-index: 1;
            color: #fff;
        }

        .modal-content .modal-body h2 span {
            font-size: 36PX;
            font-weight: 700;
            margin-left: -40px;
            color: #fff;
        }

        .popup-padding {
            padding: 100px 60px;
        }

        .mt-20 {
            margin-top: 24.5rem !important;
        }

        .modal-content .modal-body .sale {
            font-size: 150px !important;
            font-family: "Pacifico", cursive;
            color: #000;
            position: relative;
            margin-bottom: 30px;
            z-index: 0;
        }

        .popup-dialog {
            max-width: 1139px;
        }

    }

    @media screen and (min-width: 1650px) {
        .popup-padding {
            padding: 150px 100px;
        }

        .mt-20 {
            margin-top: 41.5rem !important;
        }

        .popup-dialog {
            max-width: 1500px;
        }

    }

    .cookies_blocker {
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Change the last value for the opacity level */
        z-index: 100000;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="cookies_blocker" style="display: none;"></div>
<main id="content" style="padding-top: 0px !important" ng-app="project1">
    <div ng-controller="projectinfo1">
        <section class="slick-slider custom-dots-01 mx-0 slider-home-08 d-none d-md-block"
            data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":true,"dots":true,"arrows":false,"fade":true,"cssEase":"ease-in-out","speed":600,"responsive":[{"breakpoint": 576,"settings": {"dots": false}}]}'>

            @if (isset($homeBanner) && !empty($homeBanner))
                @foreach ($homeBanner as $banner)
                    <div class="box px-0">
                        <div class="bg-img-cover-center vh-100"
                            style="background-image: url('{{ $banner['IMAGE_DOWNPATH'] }}');">
                            <div class="container container-xxl h-100">
                                <div class="h-100 d-flex flex-column">
                                    <div data-animate="fadeInDown" class="my-auto text-center">
                                        <h2 class="mb-7 fs-lg-60 fs-xxl-100 lh-111 text-uppercase" style="color: black">
                                            {{ $banner['TITLE'] }}</h2>
                                        <p class=" fs-20 mb-4 font-weight-600 text-capitalize" style="color: black">
                                            {{ $banner['DESCRIPTION'] }}
                                        </p>
                                        <p class="fs-18 lh-178 mb-5 mw-393"></p>
                                        <a href="{{ $banner['BUTTON_LINK'] }}"
                                            class="font-weight-500 btn-link-custom btn-link-custom-03 text-capitalize"
                                            style="color: black">{{ $banner['BUTTON_TEXT'] }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </section>
        {{-- <section class="slick-slider mx-0 d-block d-md-none dots-mb-mt-0 d-block d-md-none slider-home-mobile"
            data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":true,"dots":true,"arrows":false,"fade":true,"cssEase":"ease-in-out","speed":600}'>

            @if (isset($homeBanner) && !empty($homeBanner))
                @foreach ($homeBanner as $banner)
                    <div class="box px-0">
                        <div class="card border-0">
                            <img src="{{ $banner['IMAGE_DOWNPATH'] }}" class="card-img-top" alt="The Blue Original">
                            <div class="card-body p-3">
                                <div class="container container-xl">
                                    <div data-animate="fadeInDown" class="text-center">
                                        <h2 class="mb-2 fs-33 text-uppercase">{{ $banner['TITLE'] }}</h2>
                                        <p class="text-primary fs-20 mb-2 font-weight-600">{{ $banner['DESCRIPTION'] }}
                                        </p>
                                        <a href="{{ $banner['BUTTON_LINK'] }}"
                                            class="btn btn-outline-primary">{{ $banner['BUTTON_TEXT'] }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </section> --}}
        <section class="py-11 pt-lg-13 pb-lg-14">
            <div class="container container-custom container-xl">
                <div class="row">
                    <div class="col-lg-3">


                        <h2 class="mb-5">Trending items</h2>
                        <p class="text-primary fs-20 mb-5 ">Made using clean, non-toxic
                            ingredients, our products are designed for everyone.</p>
                        <a href="{{ session('site') }}/Shop-All" class="btn btn-outline-primary">Shop</a>
                    </div>
                    <div class="col-lg-9">
                        <div class="slick-slider"
                            data-slick-options='{"slidesToShow": 3,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 400,"settings": {"slidesToShow": 1}}]}'>

                            @if (isset($trending) && !empty($trending))

                                @foreach ($trending as $trend)
                                    <div class="box product py-2" data-animate="fadeInUp">
                                        <div class="card border-0">
                                            <div class="position-relative hover-zoom-in">
                                                {{-- productdetail ---> removed after made href url --}}
                                                <a href="{{ url('/') }}/Products/{{ $trend['CATEGORY_SLUG'] }}/{{ $trend['SUB_CATEGORY_SLUG'] ? $trend['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $trend['SLUG'] }}"
                                                    class="d-block overflow-hidden"
                                                    data-id="{{ $trend['PRODUCT_ID'] }}"
                                                    data-category="{{ $trend['CATEGORY_SLUG'] }}"
                                                    data-subcategory="{{ $trend['SUB_CATEGORY_SLUG'] }}"
                                                    data-name="{{ $trend['SLUG'] }}">
                                                    <img src="{{ $trend['productPrimaryImg'] }}" alt="Product"
                                                        class="card-img-top img-h60 trend_section_image image-active">
                                                    <img src="{{ $trend['productSecondaryImg'] }}" alt="Product"
                                                        class="card-img-top img-h60 trend_section_image image-hover">
                                                </a>
                                                <div
                                                    class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                    <div class="content-change-vertical d-flex flex-column ml-auto">
                                                        <a href="javascript:;" data-toggle="tooltip"
                                                            data-placement="left" title="Add to wish list"
                                                            class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                            data-productId="{{ $trend['PRODUCT_ID'] }}"
                                                            data-type='single'>
                                                            <i
                                                                class="icon fal fa-star wish_{{ $trend['PRODUCT_ID'] }} {{ $trend['wishlistFlag'] == '1' ? 'activeWish' : '' }}"></i>
                                                        </a>

                                                        <a href="javascript:;" data-toggle="tooltip"
                                                            data-placement="left" title="Quick view"
                                                            ng-click="quickViewProductDetails({{ $trend['PRODUCT_ID'] }})"
                                                            class="preview d-flex align-items-center justify-content-center text-primary  bgiconcolor  w-45px h-45px rounded-circle">
                                                            <span> <i class="icon fal fa-eye"></i> </span>
                                                        </a>

                                                    </div>
                                                </div>
                                                <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                    @if ($trend['INV_QUANTITY_FLAG'] == 'shade')
                                                        <a href="javascript:;"
                                                            class="btn btn-white btn-block  border-hover-primary hover-white @if (isset($userId)) productdetail @else addto-cart @endif"
                                                            id="qckad" data-id="{{ $trend['PRODUCT_ID'] }}"
                                                            data-category="{{ $trend['CATEGORY_SLUG'] }}"
                                                            data-subcategory="{{ $trend['SUB_CATEGORY_SLUG'] }}"
                                                            data-name="{{ $trend['SLUG'] }}" data-type=""
                                                            data-quickAdd="{{ session('userId') }}">+ Add To Cart</a>
                                                    @elseif($trend['INV_QUANTITY_FLAG'] == 'inv' && $trend['INV_QUANTITY'] > '0')
                                                        <a href="javascript:;"
                                                            class="btn btn-white btn-block  border-hover-primary hover-white addto-cart"
                                                            id="qckad" data-type="single"
                                                            data-id="{{ $trend['PRODUCT_ID'] }}" data-quantity='1'>+
                                                            Add To Cart</a>
                                                    @elseif($trend['INV_QUANTITY_FLAG'] == 'inv' && $trend['INV_QUANTITY'] <= '0')
                                                        <a href="javascript:;"
                                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white"
                                                            id="qckad" disabled>+ Out of Stock</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-body pt-4 px-0 pb-0" data-type="">
                                                <a href="javascript:;"
                                                    class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary"
                                                    data-id="{{ $trend['CATEGORY_ID'] }}" data-type="CATEGORY"
                                                    data-categorySlug="{{ $trend['CATEGORY_SLUG'] }}">
                                                    {{ $trend['CATEGORY_NAME'] }}</a>
                                                <h3
                                                    class="card-title fs-16 font-weight-500 mb-1 lh-14375 text-capitalize">
                                                    {{-- productdetail ---> removed after made url with href --}}
                                                    <a href="{{ url('/') }}/Products/{{ $trend['CATEGORY_SLUG'] }}/{{ $trend['SUB_CATEGORY_SLUG'] ? $trend['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $trend['SLUG'] }}"
                                                        class="" data-id="{{ $trend['PRODUCT_ID'] }}"
                                                        data-category="{{ $trend['CATEGORY_SLUG'] }}"
                                                        data-subcategory="{{ $trend['SUB_CATEGORY_SLUG'] }}"
                                                        data-name="{{ $trend['SLUG'] }}">{{ $trend['PRODUCT_NAME'] }}</a>
                                                </h3>
                                                <p class="text-primary mb-0 card-title lh-14375 cards_length"
                                                    style="height: 48px;">
                                                    {{ $trend['SUB_TITLE'] }}</p>
                                                {{-- @if ($trend['shades']) --}}
                                                <ul
                                                    class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                                    <?php
                                                            $shades = $trend['shades'];
                                                            if(isset($shades) && !empty($shades)){
                                                            foreach ($shades as $shade){

                                                        ?>
                                                    <li class="list-inline-item" title="<?= $shade['SHADE_NAME'] ?>">
                                                        <a href="javascript:;" class="d-block swatches-item"
                                                            style="background-image: url('<?= $shade['shadeprimaryImage'] ?>'); background-repeat:no-repeat;background-position: center;">
                                                        </a>
                                                    </li>
                                                    <?php }?>
                                                    <?php }?>
                                                </ul>
                                                {{-- @else --}}
                                                {{-- <ul style="visibility: hidden" class=" list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                                        <li class="list-inline-item" title="New shade">
                                                                <a href="javascript:;" class="d-block swatches-item" style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/36.jpg'); background-repeat:no-repeat;background-position: center;">
                                                                </a>
                                                                </li>
                                                                                                            <li class="list-inline-item" title="Fair100">
                                                                <a href="javascript:;" class="d-block swatches-item" style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/24.jpg'); background-repeat:no-repeat;background-position: center;">
                                                                </a>
                                                                </li>
                                                        </ul> --}}
                                                {{-- @endif --}}
                                                {{-- <p class="text-primary mb-2 card-title lh-14375">
                                                    ${{ $trend['PRODUCT_PRICE'] }}</p> --}}
                                                <div class="row">
                                                    <div
                                                        class="@if (strlen($trend['DISC_AMOUNT'] < 6)) col-sm-6 @else col-sm-7 @endif col-9 d-flex justify-content-evenly">
                                                        @if ($trend['DISC_AMOUNT'] > 0)
                                                            <p class="text-primary mb-0 card-title lh-14375">
                                                                ${{ $trend['DISC_AMOUNT'] }}</p>
                                                            <small class="ml-1 mt-1 lh-14375"><del>
                                                                    ${{ $trend['PRODUCT_PRICE'] }}</del></small>
                                                        @else
                                                            <p class="text-primary mb-0 card-title lh-14375">
                                                                ${{ $trend['PRODUCT_PRICE'] }}</p>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="@if (strlen($trend['DISC_AMOUNT'] < 6)) col-sm-6 @else  col-sm-5 @endif col-3">
                                                        <p
                                                            class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis">
                                                            {{ $trend['UNIT'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                    </div>
                </div>
            </div>



        </section>



        <section class="bg-img-cover-center h-100 py-16 py-lg-19 d-none d-sm-block pay-section"
            style="background-image: url('{{ url('/assets-web') }}/images/shopnow-ban.jpg');" data-animated-id="4">
            <div class="container container-xl">
                <div class="d-flex">
                    <div class="ml-auto d-flex flex-column align-items-center" style="margin: 0 auto !important;">
                        <h2 class="mb-7 text-center part_head text-capitalize">Pay less, stay
                            in fashion!</h3>

                            <a href="{{ session('site') }}/Shop-All" class="btn btn-primary">All Products</a>

                    </div>
                </div>
            </div>
        </section>

        <section class="py-10 py-lg-13 overflow-hidden testimonial-sec-home">
            <div class="row">
                <div class="col-xl-12">
                    <h2 class="text-center mb-1 ">Our Reviews
                    </h2>
                    <br>
                    <div class="slick-slider custom-slider-03"
                        data-slick-options='{"slidesToShow": 3,"dots":true,"autoplay":true,"arrows":false,"centerMode":false,"centerPadding":"450px","infinite":true,"responsive":[
								{"breakpoint": 560,"settings": {"slidesToShow": 1,"centerMode":false,"arrows":false}},
								{"breakpoint": 1024,"settings": {"slidesToShow": 2,"centerMode":false,"arrows":false}},
								{"breakpoint": 2199,"settings": {"slidesToShow": 3,"centerMode":false,"arrows":false}},
								{"breakpoint": 1200,"settings": {"centerMode":false,"arrows":false}},
								{"breakpoint": 992,"settings": {"centerMode":false,"arrows":false}}]}'>

                        @if (isset($reviews) && !empty($reviews))
                            @foreach ($reviews as $review)
                                <div class="box" data-animate="fadeIn">
                                    <div class="card border-0 bg-transparent">
                                        <div
                                            class="card-body px-3 py-0 d-flex flex-column align-items-center text-center">
                                            <img src="{{ url('/assets-web') }}/images/test-img.jpg">
                                            <p class="text-primary fs-18 mb-0">
                                                <span class="font-weight-600">{{ $review['USERNAME'] }} </span>
                                            </p>
                                            <ul class="list-inline mb-5 d-flex fs-15">
                                                <li class="mr-0"
                                                    style="{{ $review['STAR_RATING'] >= '1' ? 'color: #f9a7a9;' : 'color: #f9a7a9;' }}">
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li class="mr-0"
                                                    style="{{ $review['STAR_RATING'] >= '2' ? 'color: #f9a7a9;' : 'color: #f9a7a9;' }}">
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li class="mr-0"
                                                    style="{{ $review['STAR_RATING'] >= '3' ? 'color: #f9a7a9;' : 'color: #f9a7a9;' }}">
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li class="mr-0"
                                                    style="{{ $review['STAR_RATING'] >= '4' ? 'color: #f9a7a9;' : 'color: #60686b;' }}">
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li class="mr-0"
                                                    style="{{ $review['STAR_RATING'] >= '5' ? 'color: #f9a7a9;' : 'color: #60686b;' }}">
                                                    <i class="fas fa-star"></i>
                                                </li>

                                            </ul>
                                            <p class="card-text our-reviews-card-text text-primary lh-1444 mw-750 mx-auto"
                                                style="font-size: 17px !important">
                                                {{ $review['REVIEW_DESCRIPTION_TRIM'] }}</p>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

        </section>








        <section id="section-next" class="py-10 py-lg-13" style="background-color: #8ed1c9 ;">
            <h2 class="text-center mb-1  text-white">Created For You</h2>
            <br>
            <div class="container container-custom">

                <div class="row">

                    @if (isset($forYou) && !empty($forYou))
                        @foreach ($forYou as $for)
                            <div class="col-6 col-lg-3 product mb-8" data-animate="fadeInUp">
                                <div class="card border-0">
                                    <div class="position-relative hover-zoom-in">
                                        {{-- productdetail ---> removed after made url with href --}}
                                        <a href="{{ url('/') }}/Products/{{ $for['CATEGORY_SLUG'] }}/{{ $for['SUB_CATEGORY_SLUG'] ? $for['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $for['SLUG'] }}"
                                            class="d-block overflow-hidden" data-id="{{ $for['PRODUCT_ID'] }}"
                                            data-category="{{ $for['CATEGORY_SLUG'] }}"
                                            data-subcategory="{{ $for['SUB_CATEGORY_SLUG'] }}"
                                            data-name="{{ $for['SLUG'] }}" data-type="">
                                            <img src="{{ $for['productPrimaryImg'] }}" alt="Product"
                                                class="card-img-top created_section_img img-h45 image-active">
                                            <img src="{{ $for['productSecondaryImg'] }}" alt="Product"
                                                class="card-img-top created_section_img img-h45 image-hover">
                                        </a>
                                        <div
                                            class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                            <div class="content-change-vertical d-flex flex-column ml-auto">
                                                <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                                    title="Add to wish list"
                                                    class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                    data-productId="{{ $for['PRODUCT_ID'] }}" data-type='single'>
                                                    <i
                                                        class="icon fal fa-star wish_{{ $for['PRODUCT_ID'] }} {{ $for['wishlistFlag'] == '1' ? 'activeWish' : '' }}"></i>
                                                </a>

                                                {{-- <a href="javascript:;" data-toggle="tooltip"
                                                            data-placement="left" title="Quick view"
                                                            ng-click="quickViewProductDetails({{ $trend['PRODUCT_ID'] }})"
                                                            class="preview d-flex align-items-center justify-content-center  bgiconcolor  w-45px h-45px rounded-circle">
                                                            <span> <i class="icon fal fa-eye"></i> </span>
                                            Â Â Â Â </a> --}}

                                                <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                                    title="Quick view"
                                                    ng-click="quickViewProductDetails({{ $for['PRODUCT_ID'] }})"
                                                    class="preview d-flex align-items-center justify-content-center text-primary  bgiconcolor  w-45px h-45px rounded-circle">
                                                    <span> <i class="icon fal fa-eye"></i> </span>
                                                </a>

                                            </div>
                                        </div>
                                        <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                            @if ($for['INV_QUANTITY_FLAG'] == 'shade')
                                                <a href="javascript:;"
                                                    class="btn btn-white btn-block  border-hover-primary hover-white @if (isset($userId)) productdetail @else addto-cart @endif"
                                                    id="qckad" data-id="{{ $for['PRODUCT_ID'] }}"
                                                    data-category="{{ $for['CATEGORY_SLUG'] }}"
                                                    data-subcategory="{{ $for['SUB_CATEGORY_SLUG'] }} "
                                                    data-quickAdd="{{ session('userId') }}"
                                                    data-name="{{ $for['SLUG'] }}"
                                                    data-quickAdd="{{ session('userId') }}" data-type="">+ Add To
                                                    Cart</a>
                                            @elseif($for['INV_QUANTITY_FLAG'] == 'inv' && $for['INV_QUANTITY'] > '0')
                                                <a href="javascript:;"
                                                    class="btn btn-white btn-block  border-hover-primary hover-white addto-cart"
                                                    id="qckad" data-type="single"
                                                    data-id="{{ $for['PRODUCT_ID'] }}" data-quantity='1'>+ Add To
                                                    Cart</a>
                                            @elseif($for['INV_QUANTITY_FLAG'] == 'inv' && $for['INV_QUANTITY'] <= '0')
                                                <a href="javascript:;"
                                                    class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white"
                                                    id="qckad" disabled>+ Out of Stock</a>
                                            @endif
                                            <!-- <a href="javascript:;"
                                                class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white  addto-cart"
                                                id="qckad" data-type="single" data-id="{{ $for['PRODUCT_ID'] }}"
                                                data-quantity='1'>+ Quick Add</a> -->
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0 d-flex flex-column">
                                        <a href="javascript:;"
                                            class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary"
                                            data-id="{{ $for['CATEGORY_ID'] }}" data-type="CATEGORY"
                                            data-categorySlug="{{ $for['CATEGORY_SLUG'] }}">
                                            {{ $for['CATEGORY_NAME'] }}</a>
                                        <h3
                                            class="card-title fs-16 font-weight-500 mb-1 lh-14375 ellipsis-m text-capitalize">
                                            {{-- productdetail ---> removed after made url with href --}}
                                            <a href="{{ url('/') }}/Products/{{ $for['CATEGORY_SLUG'] }}/{{ $for['SUB_CATEGORY_SLUG'] ? $for['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $for['SLUG'] }}"
                                                class="" data-id="{{ $for['PRODUCT_ID'] }}"
                                                data-category="{{ $for['CATEGORY_SLUG'] }}"
                                                data-subcategory="{{ $for['SUB_CATEGORY_SLUG'] }}"
                                                data-name="{{ $for['SLUG'] }}"
                                                data-type="">{{ $for['PRODUCT_NAME'] }}</a>
                                        </h3>
                                        <p class="text-primary mb-0 shop-subtitle card-title cards_length lh-14375"
                                            style="height: 48px;">
                                            {{ $for['SUB_TITLE'] }}</p>
                                        {{-- @if ($for['shades']) --}}
                                        <ul class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            <?php
                                                            $shades = $for['shades'];
                                                            if(isset($shades) && !empty($shades)){
                                                            foreach ($shades as $shade){

                                                        ?>
                                            <li class="list-inline-item" title="<?= $shade['SHADE_NAME'] ?>">
                                                <a href="javascript:;" class="d-block swatches-item"
                                                    style="background-image: url('<?= $shade['shadeprimaryImage'] ?>'); background-repeat:no-repeat;background-position: center;">
                                                </a>
                                            </li>
                                            <?php }?>
                                            <?php }?>
                                        </ul>
                                        {{-- @else --}}
                                        {{-- <br> --}}
                                        {{-- <ul style="visibility: hidden" class=" list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            <li class="list-inline-item" title="New shade">
                                                    <a href="javascript:;" class="d-block swatches-item" style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/36.jpg'); background-repeat:no-repeat;background-position: center;">
                                                    </a>
                                                    </li>
                                                                                                <li class="list-inline-item" title="Fair100">
                                                    <a href="javascript:;" class="d-block swatches-item" style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/24.jpg'); background-repeat:no-repeat;background-position: center;">
                                                    </a>
                                                    </li>
                                            </ul> --}}
                                        {{-- @endif --}}
                                        {{-- <div class="mt-auto"> --}}
                                        {{-- <div class="d-flex flex-row justify-content-between"> --}}
                                        {{-- <div class="col-sm-6 col-6"> --}}
                                        <div class="row">
                                            <div
                                                class="@if (strlen($for['DISC_AMOUNT'] < 6)) col-sm-6 @else col-sm-7 @endif col-9 d-flex justify-content-evenly">
                                                @if ($for['DISC_AMOUNT'] > 0)
                                                    <p class="text-primary mb-0 card-title lh-14375">
                                                        ${{ $for['DISC_AMOUNT'] }}</p>
                                                    <small class="ml-1 mt-1 lh-14375"><del>
                                                            ${{ $for['PRODUCT_PRICE'] }}</del></small>
                                                @else
                                                    <p class="text-primary mb-0 card-title lh-14375">
                                                        ${{ $for['PRODUCT_PRICE'] }}</p>
                                                @endif
                                            </div>
                                            <div
                                                class="@if (strlen($for['DISC_AMOUNT'] < 6)) col-sm-6 @else  col-sm-5 @endif col-3">
                                                <p
                                                    class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis">
                                                    {{ $for['UNIT'] }}</p>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <div class="col-sm-6 col-5"> --}}
                                        {{-- <p class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis">{{ $for['UNIT'] }}</p> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- </div> --}}
                                        {{-- <p class="text-primary mb-0 card-title lh-14375">${{ $for['PRODUCT_PRICE'] }} --}}

                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif







                </div>
                <div class="text-center pt-2">
                    <a href="{{ session('site') }}/Store/Shop" class="btn btn-outline-primary"
                        data-type="SUB_CATEGORY"> Shop More </a>
                </div>
            </div>
        </section>

        @if (isset($todayOffer) && !empty($todayOffer))
            <section class="pt-10 pt-lg-13 py-10 py-lg-13 box-shadow-bottom" id="to_day_offer">
                <div class="container container-custom-2">
                    <div class="row ">
                        <div class="col-md-7 mb-7 mb-md-0 " data-animate="fadeInLeft">
                            <img src="{{ $todayOffer['productPrimaryImg'] }}" alt="Poplin top with ruffle trim"
                                class="w-100 " style="height:91vh">
                        </div>
                        <div class="col-md-5 my-auto pl-10" data-animate="fadeInRight">
                            <h2 class="mb-1">
                                Today Offer <br>
                            </h2>
                            <h4 class="fs-18 mb-3">{{ $todayOffer['title'] }}</h4>
                            <div class="countdown d-flex mb-8 mx-n2 mx-sm-n4" data-countdown="true"
                                data-countdown-end="{{ $todayOffer['offerEndTime'] }}">
                                <!-- Feb 27, 2023 18:24:25 -->
                                <div class="countdown-item text-center px-2 px-sm-4">
                                    <span class="fs-30 fs-sm-40 lh-1 text-primary mb-1 font-weight-300 day">00</span>
                                    <span
                                        class="d-block fs-12 text-primary letter-spacing-1px lh-14 text-uppercase font-weight-500">days</span>
                                </div>
                                <div class="separate fs-30 pt-1">:</div>
                                <div class="countdown-item text-center px-2 px-sm-4">
                                    <span class="fs-30 fs-sm-40 lh-1 text-primary mb-1 font-weight-300 hour">00</span>
                                    <span
                                        class="d-block fs-12 text-primary letter-spacing-1px lh-14 text-uppercase font-weight-500">hours</span>
                                </div>
                                <div class="separate fs-30 pt-1">:</div>
                                <div class="countdown-item text-center px-2 px-sm-4">
                                    <span
                                        class="fs-30 fs-sm-40 lh-1 text-primary mb-1 font-weight-300 minute">00</span>
                                    <span
                                        class="d-block fs-12 text-primary letter-spacing-1px lh-14 text-uppercase font-weight-500">minutes</span>
                                </div>
                                <div class="separate fs-30 pt-1">:</div>
                                <div class="countdown-item text-center px-2 px-sm-4">
                                    <span
                                        class="fs-30 fs-sm-40 lh-1 text-primary mb-1 font-weight-300 second">00</span>
                                    <span
                                        class="d-block fs-12 text-primary letter-spacing-1px lh-14 text-uppercase font-weight-500">seconds</span>
                                </div>
                            </div>
                            <p class="mb-7 text-color-subtext">{{ $todayOffer['description'] }}</p>

                            <a href="javascript:;" class="btn btn-outline-primary addto-cart" data-type="single"
                                data-id="{{ $todayOffer['productId'] }}" data-quantity='1'>Add To Cart</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif








        <section class="box-shadow-bottom py-10 py-lg-13"
            style="background-image: url('{{ url('/assets-web') }}/images/brownBg.jpeg'); background-repeat: no-repeat; background-size: cover; background-color:#fffff">

            <div class="container container-custom container-xl">
                <h2 class="mb-0 text-center lh-13 text-center-mbl" data-animate="fadeInUp">Are You
                    Ready For The Matchup</h2>
                <div class="row no-gutters align-items-center mx-n7">

                    <div class="col-md-5 px-7" data-animate="fadeInRight">
                        <h2 class="mb-1">
                            Find Your Shade <br>
                        </h2>

                        <p class="mb-7 mb-8 " style="color:#a09f9f">Discover your Perfect Match</p>
                        <a href="{{ session('site') }}/user-shade-finder" class="btn btn-outline-primary">Take A
                            Quiz</a>
                    </div>
                    <div class="col-md-7 px-7 mb-7 mb-md-0 inc_cont hover-zoom-in " data-animate="fadeInRight">
                        <img src="{{ url('/assets-web') }}/images/product-img-2.png"
                            alt="Poplin top with ruffle trim" class="img-home-pay">
                    </div>
                </div>
            </div>
        </section>












        <section class="pt-lg-11" id="bestSelOnlineExc_section">
            <div class="container-fluid">
                <div class="row">

                    @if (isset($bestSeller) && !empty($bestSeller))
                        {{-- <div class="col-sm-6 mb-0 mb-sm-0 product-inclusive" data-animate="fadeInUp"
                            style="background-image: url('{{ $bestSeller['IMAGE_DOWNPATH'] }}');">
                            <a href="javascript:;" class="card border-0 banner-03 hover-zoom-in"
                                style="background-color: unset !important; height: 600px;">
                                <div class="card-img bg-img-cover-center"></div>
                                <div class="card-img-overlay d-flex flex-column p-2">
                                    <p class="mb-0 card-text font-weight-500 part_head text-uppercase">{{ $bestSeller['TITLE'] }}</p>
                                    <h5 class="card-title fs-36 lh-128 mb-0 part_head text-capitalize">{{ $bestSeller['HEADING'] }}
                                    </h5>
                                    <div class="mt-auto">
                                        <button type="button"
                                            class="btn-link-custom btn-link-custom-02 p-0 bg-transparent part_head"
                                            > Shop Now</button>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                        <div class="col-sm-6 mb-0 mb-sm-0 product-inclusive" data-animate="fadeInUp"
                            style="background-image: url('{{ $bestSeller['IMAGE_DOWNPATH'] }}');">
                            <div class="overlay"></div>
                            <a href="{{ url('/') }}/Products/{{ $bestSeller['CATEGORY_SLUG'] }}/{{ $bestSeller['SUB_CATEGORY_SLUG'] ? $bestSeller['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $bestSeller['SLUG'] }}"
                                class="card border-0 banner-03 hover-zoom-in"
                                style="background-color: unset !important; height: 600px;">
                                <!-- Add the black overlay here -->


                                <!-- Rest of the content -->
                                <div class="card-img bg-img-cover-center"></div>
                                <div class="card-img-overlay d-flex flex-column p-2">
                                    <p class="mb-0 card-text font-weight-500 part_head text-uppercase">
                                        {{ $bestSeller['TITLE'] }}</p>
                                    <h5 class="card-title fs-36 lh-128 mb-0 part_head text-capitalize">
                                        {{ $bestSeller['HEADING'] }}</h5>
                                    <div class="mt-auto">
                                        {{-- productdetail --> removed after made url with href --}}
                                        <button type="button"
                                            class="btn-link-custom btn-link-custom-02 p-0 bg-transparent part_head"
                                            data-id="{{ $bestSeller['PRODUCT_ID'] }}"
                                            data-category="{{ $bestSeller['CATEGORY_SLUG'] }}"
                                            data-subcategory="{{ $bestSeller['SUB_CATEGORY_SLUG'] }}"
                                            data-name="{{ $bestSeller['SLUG'] }}">Shop Now</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                    @if (isset($onlineExclusive) && !empty($onlineExclusive))
                        <div class="col-sm-6 mb-0 product-inclusive" data-animate="fadeInUp"
                            style="background-image: url('{{ $onlineExclusive['IMAGE_DOWNPATH'] }}');">
                            <div class="overlay"></div>
                            <a href="{{ url('/') }}/Products/{{ $onlineExclusive['CATEGORY_SLUG'] }}/{{ $onlineExclusive['SUB_CATEGORY_SLUG'] ? $onlineExclusive['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $onlineExclusive['SLUG'] }}"
                                class="card border-0 banner-03 hover-zoom-in"
                                style="background-color: unset !important; height: 600px;">


                                <div class="card-img bg-img-cover-center"></div>
                                <div class="card-img-overlay d-flex flex-column p-2">
                                    <p class="mb-0 card-text font-weight-500 part_head text-uppercase">
                                        {{ $onlineExclusive['TITLE'] }}</p>
                                    <h5 class="card-title fs-36 lh-128 mb-0 part_head text-capitalize">
                                        {{ $onlineExclusive['HEADING'] }}</h5>
                                    {{-- <p><a href="">Shop Now</a></p> --}}
                                    <div class="mt-auto">
                                        {{-- productdetail --> removed after made url with href --}}
                                        <button type="button"
                                            class="btn-link-custom btn-link-custom-02 p-0 bg-transparent part_head"
                                            data-id="{{ $onlineExclusive['PRODUCT_ID'] }}"
                                            data-category="{{ $onlineExclusive['CATEGORY_SLUG'] }}"
                                            data-subcategory="{{ $onlineExclusive['SUB_CATEGORY_SLUG'] }}"
                                            data-name="{{ $onlineExclusive['SLUG'] }}">Shop Now</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </section>



        <section class="py-12 py-lg-12" style="background-color: #c0a9bd">
            <div class="container container-custom container-xl">
                <h2 class="text-center mb-8 lh-128 text-white">Our Blog
                </h2>
                <div class="row">

                    @if (isset($ourblog) && !empty($ourblog))
                        <div class="col-lg-6 first_box">
                            <div class="box" data-animate="fadeInUp">
                                <div class="card border-0">

                                    <a href="{{ session('site') }}/blog-page" class="hover-shine">
                                        <img src="{{ $ourblog['image'] }}" class="card-img-top img-blog-height"
                                            alt="How to care for your cotton.">
                                    </a>
                                    <div class="card-body px-0 pt-0 pb-0 text-box">
                                        <h3 class="card-title mb-0 fs-20 font-weight-500">
                                            <a class="text-decoration-none blog_text_home text-capitalize"
                                                href="{{ session('site') }}/blog-page">{{ $ourblog['NAME'] }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- <div class="col-lg-6" style="padding: 0px;"> --}}
                    <div class="col-lg-6">
                        <div class="row">

                            @if (isset($blogs[0]))
                                <div class="col-lg-4 col-6 fort_box_home">
                                    <div class="box" data-animate="fadeInUp">
                                        <div class="card border-0 blog_inc_container_home">
                                            <a href="{{ session('site') }}/blog-detail/{{ $blogs[0]['SLUG'] }}"
                                                class="hover-shine">
                                                <img src="{{ $blogs[0]['image'] }}" class="inc_image_blog_1_home"
                                                    alt="How to care for your cotton.">
                                                <div class="middle_cont_blog_home">
                                                    <div class="blog_text_1_home text-capitalize">
                                                        {{ $blogs[0]['TITLE'] }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (isset($blogs[1]))
                                <div class="col-lg-8 col-6 fort_box_home1 cont_box">
                                    <div class="box" data-animate="fadeInUp">
                                        <div class="card border-0 blog_inc_container_home">
                                            <a href="{{ session('site') }}/blog-detail/{{ $blogs[1]['SLUG'] }}"
                                                class="hover-shine">
                                                <img src="{{ $blogs[1]['image'] }}"
                                                    class="card-img-top inc_image_blog_1_home"
                                                    alt="How to care for your cotton.">
                                                <div class="middle_cont_blog_home">
                                                    <div class="blog_text_1_home text-capitalize">
                                                        {{ $blogs[1]['TITLE'] }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                        </div>
                        @endif
                        @if (isset($blogs[2]))
                            <div class="row">
                                <div class="col-lg-12 col-12 fort_box_home2 bottom_box" style="margin-top: 15px;">
                                    <div class="box" data-animate="fadeInUp">
                                        <div class="card border-0 blog_inc_container_home">
                                            <a href="{{ session('site') }}/blog-detail/{{ $blogs[2]['SLUG'] }}"
                                                class="hover-shine">
                                                <img src="{{ $blogs[2]['image'] }}"
                                                    class="inc_image_blog_1_home inc_image_blog_3"
                                                    alt="How to care for your cotton.">
                                                <div class="middle_cont_blog_home">
                                                    <div class="blog_text_1_home text-capitalize">
                                                        {{ $blogs[2]['TITLE'] }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>


        <section class="py-6 py-lg-10 insta_sec_home">
            <div class="container container-custom container-xl">
                <h2 class="mb-3 text-center">Check Out Yu-Jus-Enough on INSTAGRAM</h2>
                <p class="text-center mw-500 mb-9 mx-auto">
                    Tag <span class="font-weight-500 text-primary">@jusoutbeauty</span>
                    in your Instagram photos for a chance to be featured here. Find more
                    inspiration on
                    <a href="https://www.instagram.com/" class="text-decoration-underline font-weight-500">our
                        Instagram.</a>
                </p>
                <div class="slick-slider instafeed_slider" id="instaFeed_html">
                    {{-- <div class="box px-1" data-animate="fadeInUp">
						<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg" alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>
								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>
						</a>
					</div>
					<div class="box px-1" data-animate="fadeInUp">
						<a href=""
							class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg"
							alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>
								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>

						</a>
					</div>
					<div class="box px-1" data-animate="fadeInUp">
						<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg" alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>
								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>
						</a>
					</div>
					<div class="box px-1" data-animate="fadeInUp">
						<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg" alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>
								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>
						</a>
					</div>
					<div class="box px-1" data-animate="fadeInUp">
						<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg" alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>
								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>
						</a>
					</div>
					<div class="box px-1" data-animate="fadeInUp">
						<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg" alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>
								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>
						</a>
					</div>
					<div class="box px-1" data-animate="fadeInUp">
						<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg" alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>
								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>
						</a>
					</div>
					<div class="box px-1" data-animate="fadeInUp">
						<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg" alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>
								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>
						</a>
					</div>
					<div class="box px-1" data-animate="fadeInUp">
						<a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
							<img src="{{ url('/assets-web') }}/images/makeup.jpg" alt="Instagram" class="card-img">
							<div class="card-img-overlay d-flex align-items-center justify-content-center content-change">
								<span class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change" style="position: absolute; top: 25%;">
									<i class="fab fa-instagram"></i>

								</span>
								<div style="display: block; position: absolute; bottom: 23%; left: 83px;">
									<button class="btn btn-outline-primary">shop now</button>
								</div>
							</div>
						</a>
					</div> --}}
                </div>
            </div>
        </section>

        <div class="modal fade quick-view " id="productQuickView" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog quick_view_mbl modal-dialog-scrollable">
                <div class="modal-content p-0 quick_view_mbl_carousel_modal">
                    <div class="modal-body p-0">
                        <button type="button" class="close fs-32 position-absolute pos-fixed-top-right z-index-10"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fs-20"> <i class="fal fa-times"></i>
                            </span>
                        </button>
                        <div class="row no-gutters" id="quick_view_product_details">
                            <div class="col-sm-6">

                                <div id="carouselExampleControls" class="carousel slide quick_view_mbl_carousel"
                                    data-ride="carousel" data-interval="2000">
                                    <div class="carousel-inner">
                                        <div class="carousel-item @{{ $first == '1' ? 'active' : '' }}"
                                            ng-repeat="row in productImagesLoop">
                                            <img class="d-block w-100 quick_view_mbl_carousel_img"
                                                style="height: 35rem" src="@{{ row.downPath }}" alt="First slide">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                        data-slide="prev"> <span class="carousel-control-prev-icon"
                                            aria-hidden="true"></span> <span class="sr-only">Previous</span>
                                    </a> <a class="carousel-control-next" href="#carouselExampleControls"
                                        role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                            <div class="col-sm-6 col-md-6 primary-summary " style="padding: 15px;">
                                <div class="d-flex align-items-center">
                                    <h2 class="mb-0">@{{ QuickView_name }}</h2>
                                </div>
                                <div class="primary-summary-inner">
                                    <p
                                        class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-0 pt-1 pb-1">
                                        Petit
                                        @{{ category_name }}, @{{ subCategory_name }}</p>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="mb-0 fs">$@{{ unit_price }}</p>
                                        </div>
                                        <!-- <div class="col-lg-4">
              <div class="d-flex align-items-center flex-wrap">
               <ul
                class="list-inline d-flex justify-content-sm-end justify-content-center mb-0 rating-result">
                <li class="list-inline-item"><span
                 class="text-primary fs-12 lh-2"><i
                  class="fas fa-star star_col"></i></span></li>
                <li class="list-inline-item"><span
                 class="text-primary fs-12 lh-2"><i
                  class="fas fa-star star_col"></i></span></li>
                <li class="list-inline-item"><span
                 class="text-primary fs-12 lh-2"><i
                  class="fas fa-star star_col"></i></span></li>
                <li class="list-inline-item"><span
                 class="text-primary fs-12 lh-2"><i
                  class="fas fa-star star_col"></i></span></li>
                <li class="list-inline-item"><span
                 class="text-primary fs-12 lh-2"><i
                  class="fas fa-star star_col"></i></span></li>
               </ul>
              </div>
             </div> -->
                                    </div>
                                    <p class="mb-3" style="max-height: 150px; overflow: auto">@{{ short_description }}
                                    </p>

                                    <div style="margin-bottom: 0px;"
                                        ng-if="displayCollectionProductShadesQuickView.length != null || displayCollectionProductShadesQuickView.length != undefined">
                                        <button class="accordion_inc shadeAccord-btn" data-id="1">1.
                                            Choose Shade</button>
                                        <div class="panel_inc" id="chooseShade_container_1">
                                            <div class="form-group shop-swatch-color shop-swatch-color-02 mb-1">
                                                <!-- </label> -->
                                                <img src="@{{ selectedShadeImg_p }}" alt="Product Image"
                                                    class="var text-capitalize quick_view_product_image "
                                                    ng-show="selectedShadeImg_p != ''"> <br> <label
                                                    class="mb-2"><span
                                                        class="font-weight-500 text-primary mr-2">Color:</span> <span
                                                        class="var text-capitalize btn-shade">@{{ selectedShadeName }}</span></label>
                                                <ul class="list-inline d-flex justify-content-start mb-0">
                                                    <li class="list-inline-item"
                                                        ng-repeat="row in displayCollectionProductShadesQuickView"
                                                        ng-click="chooseProdShade(row.PRODUCT_SHADE_ID, row.SHADE_ID, row.PRODUCT_ID, row.SHADE_NAME, row.prodShadeImag_p, row.prodShadeImag_s)"
                                                        title="@{{ row.SHADE_NAME }}"><a href="javascript:;"
                                                            class="d-block swatches-item"
                                                            style="background-image: url('@{{ row.shadeprimaryImage }}'); background-repeat: no-repeat; background-position: center;">
                                                        </a></li>

                                                </ul>

                                                <input type="hidden" id="shadeId" value=""> <input
                                                    type="hidden" id="prodShadeId" value=""> <input
                                                    type="hidden" id="shadeName" value=""> <input
                                                    type="hidden" id="productId" value=""> <input
                                                    type="hidden" id="shadeExistChk"
                                                    value="@{{ (displayCollectionProductShadesQuickView.length == 0 || displayCollectionProductShadesQuickView.length == undefined) ? 'false' : 'true' }}">


                                            </div>
                                            <a href="javascript:;" class="btn btn-primary"
                                                ng-click="confirmProductShade();">Continue</a>
                                        </div>

                                        <!-- <button class="accordion_inc">2. Blow Gel - Choose Shade</button>
                <div class="panel_inc">
                 <img src="{{ url('/assets-web') }}/images/glamorpic.webp" style="width: 250px;"><br>
                        <div class="form-group shop-swatch-color shop-swatch-color-02 mb-0">
                        <label class="mb-2">
                        <span class="font-weight-500 text-primary mr-2">Color:</span>
                        <span class="var text-capitalize">Gray Blue</span></label>
                        <ul class="list-inline d-flex justify-content-start mb-1">
                        <li class="list-inline-item selected">
                        <a href="#" class="d-block swatches-item" data-var="gray blue" style="background-color: #A0ADBC;"> </a>
                        </li>
                        <li class="list-inline-item"><a href="#" class="d-block swatches-item" data-var="black" style="background-color: #000;"></a></li>
                        <li class="list-inline-item"><a href="#" class="d-block swatches-item" data-var="gray blue" style="background-color: #A0ADBC;"> </a></li>
                        <li class="list-inline-item"><a href="#" class="d-block swatches-item" data-var="black" style="background-color: #000;"></a></li>
                        </ul>
                        <input type="hidden" name="swatches-color" class="swatches-select" value="purple">
                        </div>
                        <a href="store.html" class="btn btn-primary">Continue</a>
                        </div> -->
                                    </div>

                                    <form>

                                        <input type="radio" id="single-sub" name="subscriptioncheck"
                                            value="One-Time Purchase" checked> <label for="single-sub"
                                            class="cursor-pointer">One-Time Purchase</label><br> <input type="radio"
                                            id="multiple-sub" name="subscriptioncheck" value="subscription"> <label
                                            for="multiple-sub" class="cursor-pointer">Subscription</label><br>
                                    </form>
                                    <div class=" form-group mb-0 sub-form" style="display: none;">
                                        <div class="d-flex align-items-center mb-1">
                                            <label class="text-primary fs-16 font-weight-bold mb-0"
                                                for="size">Subcription Option:
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                title="Click to see more Ingredients" class="text-right"> <span
                                                    ng-click="showSubscrptionDetailModal();">Learn More </span>
                                            </a>

                                            <div class="modal fade quick-view" id="learnmore_pop" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 631px !important;">
                                                    <div class="modal-content p-0">
                                                        <div class="modal-body p-0">
                                                            <button type="button"
                                                                class="close fs-32 position-absolute pos-fixed-top-right z-index-10 close_learnmore_pop">
                                                                <span aria-hidden="true" class="fs-20"><i
                                                                        class="fal fa-times"></i></span>
                                                            </button>
                                                            <div class="pop_content">

                                                                <div class="row">

                                                                    <p class="col-lg-12">@{{ subscriptionDetails }}</p>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-lg-12 text-right">
                                                                        <a style="text-decoration-line: underline;font"
                                                                            href="{{ url('subscription') }}"><em>Read
                                                                                More >></em></a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <select class="form-control w-100 cursor-pointer" id="subsOption"
                                            ng-model="subs_id" ng-change="fetchSubscriptionDetail();">
                                            <option value="" class="cursor-pointer">Choose an option</option>
                                            <option value="@{{ row.ID }}" class="select-subsoptn"
                                                ng-repeat="row in subscriptionLov">@{{ row.TITLE }}</option>
                                        </select>
                                    </div>
                                    <form class="cart-roww">
                                        <div class="row align-items-end no-gutters mx-n2 mb-1">
                                            <div class="col-sm-3 form-group px-2 mb-0">
                                                <label class="text-primary fs-16 font-weight-bold mb-1"
                                                    for="number">Quantity: </label>

                                                <div class="input-group position-relative w-100">
                                                    <a href="javascript:;"
                                                        class="down position-absolute pos-fixed-left-center pl-2 z-index-2 addsubquantity">
                                                        <i class="far fa-minus"></i>
                                                    </a> <input name="number" type="number" id="quantity"
                                                        class="form-control w-100 px-6 text-center input-quality bg-transparent text-primary quantityinput"
                                                        value="1"> <a href="javascript:;"
                                                        class="up position-absolute pos-fixed-right-center pr-2 z-index-2 addsubquantity">
                                                        <i class="far fa-plus"></i>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="col-sm-8 mb-0 px-2">
                                                <button type="button"
                                                    class="btn btn-primary btn-block text-capitalize quick-addto-cart"
                                                    data-type="@{{ productType }}"
                                                    data-id="@{{ QuickView_productId }}" data-quantity='1'
                                                    data-subs='1'>Add to cart</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="text-primary lh-14375 mb-0 sub-line" style="display: none;">
                                        @{{ subscriptionNote1 }}</p>
                                    <p class="text-primary lh-14375 mb-0 sub-below-line" style="display: none;">
                                        @{{ subscriptionNote2 }}</p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered popup-dialog" role="document" style="">
                <div class="modal-content modalcontent-popup">
                    <div class="modal-header p-0 border-0">
                        <button type="button" class="close d-flex align-items-center justify-content-center"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="ion-ios-close"></span>
                        </button>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-5 col-6 d-flex">
                            <div class="modal-body popup-padding color-1 d-flex" style="background-color:{{ $popupData->BACKGROUND_COLOR }}">
                                <span class="icon-2 flaticon-snowflake"></span>
                                <p class="text-white upper">
                                    <span class="icon flaticon-snowflake text-white"></span>
                                </p>
                                <div class="w-100 text text-center d-flex align-items-center justify-content-center">
                                    <div>
                                        <p class="text-white upper">{{ $popupData->FIRST_TITLE }}
                                            <span class="icon flaticon-snowflake"></span>
                                        </p>
                                    </div>
                                    <div>
                                        <h2>
                                            <span>{{ $popupData->DISCOUNT }}</span>
                                            <sup>%</sup>
                                            <sub>off</sub>
                                        </h2>
                                    </div>
                                    <div>
                                        <p class="upper">{{ $popupData->SECOND_TITLE }}</p>
                                    </div>
                                </div>
                                <div class="w-100 d-flex align-items-center justify-content-center" style="height: 60vh;">
                                    <div class="text-center">
                                        <div style="height: 30%" class="">
                                            <p class="text-white upper">{{ $popupData->FIRST_TITLE }}</p>
                                            <hr class="w-25 text-white">

                                        </div>
                                        <div style="height: 40%" class="d-flex align-items-center justify-content-center">
                                            <h2>
                                                <span style="text-size:36px;">{{ $popupData->DISCOUNT }}</span>
                                                <sup>%</sup>
                                                <sub>off</sub>
                                            </h2>
                                        </div>
                                        <div style="height: 30%" class="d-flex align-items-center justify-content-center">
                                            <p class="upper mt-3">{{ $popupData->SECOND_TITLE }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7 col-6 d-flex">
                            <div class="modal-body p-5 img d-flex align-items-center"
                                style="background-image: url('{{ url($popupData->DOWN_PATH) }}');
							background-size: cover;
							background-repeat: no-repeat;
							background-position: center center;">
                                <div class="text w-100 mt-20">
                                    <a href="{{  $popupData->BUTTON_LINK  }}" class="btn btn-primary d-block py-3 px-0 px-md-4">{{ $popupData->BUTTON_TEXT }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered popup-dialog" role="document">
                <div class="modal-content modalcontent-popup">
                    <div class="modal-header p-0 border-0">
                        <button type="button" class="close d-flex align-items-center justify-content-center"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="ion-ios-close"></span>
                        </button>
                    </div>
                    <div class="row no-gutters text-center">
                        <div class="col-lg-5 col-md-6 col-6 d-flex">
                            <div class="modal-body popup-padding color-1 d-flex"
                                style="background-color:{{ $popupData->BACKGROUND_COLOR }}">
                                <span class="icon-2 flaticon-snowflake"></span>
                                <p class="text-white upper">
                                    <span class="icon flaticon-snowflake text-white"></span>
                                </p>
                                <div class="w-100 d-flex flex-column justify-content-center align-items-center">
                                    <p class="text-white upper mb-3">{{ $popupData->FIRST_TITLE }}</p>
                                    <h2 class="mt-5 mb-5 text-center text-white font-weight-700">
                                        {{ $popupData->MAIN_TITLE }}
                                        {{-- <sup>%</sup>
                          <sub>off</sub> --}}
                                    </h2>
                                    <p class="upper mt-3">{{ $popupData->SECOND_TITLE }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-6 d-flex">
                            <div class="modal-body p-5 img d-flex align-items-center"
                                style="background-image: url('{{ url($popupData->DOWN_PATH) }}'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
                                <div class="text w-100 mt-20">
                                    <a href="{{ $popupData->BUTTON_LINK }}"
                                        class="btn btn-primary d-block py-3 px-0 px-md-4">{{ $popupData->BUTTON_TEXT }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</main>


@include('web.web-footer')

<div class="cookie-frame open" style="display:none;z-index: 100000000;!important;">
    <div class="cookie-content d-flex align-items-center justify-content-center row pr-5 pl-5">
        <div class="col-sm-8 text">
            <p class="text-dark mt-2 mt-md-5 mr-2 mr-md-5" style="font-size: 14px; text-align:left;">By clicking
                Accept Cookies, you agree to the storing of cookies on your device to enhance
                site navigation, analyze site usage, and assist in our marketing efforts.</p>
        </div>
        <div class="d-flex justify-content-center col-sm-4">
            <button class="btn btn-outline-primary mr-2" id="acceptCookiesBtn">Accept</button>
            <button class="btn btn-my" id="declineCookiesBtn">Decline</button>
        </div>
    </div>
</div>

<script src="{{ url('/assets-web') }}/customjs/script_userhome.js?v={{ time() }}"></script>

<script>
    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        // $("#content").css('padding-top','77px');

    }
    $('.down').on('click', function(e) {
        console.log('down')
        e.preventDefault();
        var $parent = $(this).parent('.input-group');
        var $input = $parent.find('input');
        var $value = parseInt($input.val());
        if ($value > 0) {
            $value -= 1;
            $input.val($value);
        }
    });
    $('.up').on('click', function(e) {
        console.log('up')

        e.preventDefault();
        var $parent = $(this).parent('.input-group');
        var $input = $parent.find('input');
        var $value = $input.val();
        if ($value !== '') {
            $value = parseInt($value);
            $value += 1;
            $input.val($value);
        } else {
            $input.val(1);
        }
    });
    $(".close_learnmore_pop").click(function() {
        $("#learnmore_pop").modal('hide');
    });
</script>

@if (!session()->has('homepopup'))
    <script type="text/javascript">
        localStorage.setItem('cookiesAccepted', '');
        $(window).on('load', function() {
            $('#exampleModalCenter').modal('show');
        });
    </script>
    @php
        session()->put('homepopup', 1);
    @endphp
@endif

<script>
    $(document).ready(function() {

        var cookieAccepted = localStorage.getItem('cookiesAccepted');

        setTimeout(function() {
            if (cookieAccepted == '') { //cookieAccepted != 1 && cookieAccepted != '1'
                $('.cookie-frame').slideDown(3000);
                $(".cookies_blocker").show();
            } else {
                $('.cookie-frame').hide();
                $(".cookies_blocker").hide();
            }
        }, 3000);




        // Handle accept button click
        $('#acceptCookiesBtn').click(function() {
            var tokenHash = $('#csrf').val();

            $.ajax({
                url: baseUrl + '/cookies/accept',
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': tokenHash
                },
                success: function(response) {
                    localStorage.setItem('cookiesAccepted', '1');
                    $('.cookie-frame').slideUp(2000);
                    $(".cookies_blocker").hide();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#declineCookiesBtn').click(function() {
            localStorage.setItem('cookiesAccepted', '0');
            $('.cookie-frame').slideUp(2000);
            $(".cookies_blocker").hide();
            // $('.cookie-frame').addClass('hide');
        });
    });
</script>
