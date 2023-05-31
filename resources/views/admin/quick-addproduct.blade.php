<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
    <meta name="viewport" content="width=device-width,initial-scale=0.7,minimum-scale=1.0,maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ isset($page) ? ucfirst($page) : 'Home' }}</title>

    <!-- <script src="{{ url('/assets-web') }}/../cdn-cgi/apps/head/2oc_RD5SS6wgN5SiQnSEnWVNHg8.js"></script> -->
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/fontawesome-pro-5/css/all.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/bootstrap-select/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/slick/slick.min.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/animate.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/mapbox-gl/mapbox-gl.min.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/fonts/font-phosphor/css/phosphor.min.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/vendors/fonts/tuesday-night/stylesheet.min.css">
    <link rel="stylesheet" href="{{ url('/assets-admin') }}/third_party/admin/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/css/themes.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/css/inc_style.css">
    <link href="{{ url('/assets-web') }}/customcss/website/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/customcss/website/flaticon.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/customcss/website/ionicons.min.css">
    <!-- Summernote -->
    <link href="{{ url('/assets-admin') }}/third_party/admin/summernote/summernote.css" rel="stylesheet">
    <link href="{{ url('/assets-admin') }}/third_party/admin/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/assets-admin') }}/third_party/admin/chartist/css/chartist.min.css">

    <link rel="stylesheet" href="{{ url('/public') }}/third_party/toastr/css/toastr.min.css" />

    <link rel="icon" href="{{ url('/assets-web') }}/images/favicon.png">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="twitter:title" content="Home 08">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="images/logo_01.png">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta property="og:url" content="home-08">
    <meta property="og:title" content="Home 08">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta property="og:image" content="images/logo_01.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <style>
        .close-icon{
            position: absolute;
            right: 8px;
            top: 3px;
        }
        .gap-2{
            gap: 4px
        }
        span.select2.select2-container.select2-container--default {
            width: 100% !important
        }

        .cursor-pointer {
            cursor: pointer;

        }

        .image-box {
            display: block;
            width: 14vw;
            height: 9vw;
        }

        div.show-image {
            position: relative;


        }

        div.show-image:hover img {
            opacity: 0.5;
        }

        div.show-image:hover video {
            opacity: 0.5;
        }

        div.show-image:hover .delete {
            display: block;
        }


        div.show-image .delete {
            position: absolute;
            display: none;
        }

        div.show-image .delete {
            top: .5rem;
            left: 86%;
        }

        div.show-image .markprimary {
            top: .5rem;
            left: 66%;
        }

        div.show-image .primary {
            top: .5rem;
            left: 04%;
        }

        div.show-image .secondary {
            top: .5rem;
            left: 04%;
        }

        div.show-image .markprimary {
            position: absolute;
            display: none;
        }

        div.show-image .primary {
            position: absolute;
            display: none;
        }

        div.show-image .secondary {
            position: absolute;
            display: none;
        }

        div.show-image:hover .markprimary {
            display: block;
        }

        div.show-image:hover .primary {
            display: block;
        }

        div.show-image:hover .secondary {
            display: block;
        }

        .note-editable,
        .note-code {
            height: 350px;
            /* custom size */
            min-height: 350px;
            /* custom size */
            max-height: 350px !important;
            /* custom size */
        }

        .gap {
            gap: 5px
        }

        .numbermbl {
            display: inline-block;
            position: relative;
            right: -7px;
            font-size: 12px;
            background-color: #da3f3f;
            height: 22px;
            width: 22px;
            color: #fff;
            line-height: 22px;
            border-radius: 50%;
            text-align: center;
        }

        .main-header .dropdown-menu-listing {
            top: 60px;
        }

        /* .img-header-20 {
            height: 20rem !important;
        } */

        .img-header-left-7 {
            height: 7rem
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        body::-webkit-scrollbar-thumb {
            background: #d5d5d5;
        }

        /* Handle on hover */
        body::-webkit-scrollbar-thumb:hover {
            background: #909090;
        }

        li.nav-item.dropdown.header-profile {
            list-style-type: none;
        }
    </style>
    <style>
        @media only screen and (min-width: 1749px) {
            ul.navbar-nav.hover-menu.main-menu.px-0.mx-xl-n5.menu_ul li {
                padding: 20px 10px !important;
            }
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    <style>
        .recent_viewed:hover {
            text-decoration: underline;
            text-decoration-color: #006f7a;
        }

        .text .arrow-center {
            width: 2.5vw;
            height: 2.5vw;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
        }

        .image-overlay:hover .overlay {
            opacity: 0.8;
        }

        .image-box {
            height: 6vw;
            width: 6vw;

        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 6vw;
            width: 6vw;
            opacity: 0;
            transition: 0.3s ease;
            background-color: #4e4e4e;
            border: 1px solid #707070;
            border-radius: 5px;
        }

        .image-overlay {
            position: relative;
            width: 9vw;
            padding: 0;
            margin-right: 2vw;
            text-align: center;
        }

        .text .fa-trash-alt {
            color: #ffffff;
            font-size: 1.2vw;
            position: absolute;
            top: 0%;
            right: 0%;
            transform: translate(-50%, 25%);
        }

        .arrow-icon-move-box p {
            margin: 0;
            font-size: 0.9vw !important;
            color: #ffffff !important;
            font-weight: 500 !important;
            text-align: center !important;
            font-style: normal !important;
            white-space: nowrap;
            position: absolute;
            bottom: 0%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .selfi-view .modal-dialog {
            max-width: 574px !important;
        }

        .selfi-img {
            border-radius: 2%;
            height: 125px;
            width: 125px;
        }

        .custom-file-input-check {
            position: relative;
            z-index: 2;
            width: 100%;
            height: calc(1.47em + 1.3125rem + 2px);
            margin: 0;
            overflow: hidden;
            opacity: 0;
        }

        .ag-courses-item_link:hover .ag-courses-item_bg {
            -webkit-transform: scale(10);
            -ms-transform: scale(10);
            transform: scale(10);
        }

        .ag-courses-item_bg {
            height: 128px;
            width: 128px;
            background-color: #006f7a;
            z-index: 1;
            position: absolute;
            top: -75px;
            right: -75px;
            border-radius: 50%;
            -webkit-transition: all .5s ease;
            -o-transition: all .5s ease;
            transition: all .5s ease;
        }

        .ag-courses-item_link:hover,
        .ag-courses-item_link:hover .ag-courses-item_date {
            text-decoration: none;
            color: #006f7a;
        }

        .ag-courses-item_link {
            display: block;
            padding: 30px 20px;
            background-color: #f3c9b3;
            overflow: hidden;
            position: relative;
        }

        .ag-courses_item {
            -ms-flex-preferred-size: calc(6.33333% - 30px);
            flex-basis: calc(6.33333% - 30px);
            margin: 0 15px 30px;
            overflow: hidden;
            border-radius: 28px;
        }

        .relative {
            position: relative;
        }

        .img {
            overflow: hidden;
        }


        .img-product-gall {
            height: 28rem;
        }

        .img1-section2 {
            height: 26rem;
        }

        .img2-section2 {
            height: 13rem;
        }

        /* width */
        .spot-section {
            height: 21rem;
        }

        .card-img-overlay {
            position: absolute;
            top: 88px;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1.25rem;
            border-radius: 0;
        }

        .fix {
            height: 480px;
            overflow: hidden;
        }


        .spot-section-img {
            height: 7.5em;
            border: 1px solid transparent;

        }

        .recomendations-img {
            height: 24rem;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        img.prod_img_detail_acc_sec.fadeInLeft.animated.img2-section2.img-w20 {
            width: 53% !important;
            margin-top: 298px;
            margin-left: -123px;
        }

        #pills-recently-viewed {
            max-height: unset !important
        }

        @media only screen and (max-width: 480px) {
            .last-section-pro-detail {
                flex-direction: column !important;
                align-items: center !important;
            }

            a#writeReview_btn,
            a#pills-recommendations-tab,
            #pills-recently-viewed-tab,
            #pills-recently-viewed-tab {
                font-size: 14px !important
            }

            a#writeQuestion_btn {
                position: absolute;
                bottom: 159px;
                left: 179px;
                font-size: 11px
            }

            .card-img-overlay {

                top: 0px;
            }

            .border-left {
                border: 0px solid transparent;
                border-color: transparent !important;
                margin-right: 14px;

            }

            img.prod_img_detail_acc_sec.fadeInLeft.animated.img2-section2.img-w20 {
                width: 100% !important;
            }

            .flex-sm-column-mbl {
                flex-direction: column;
                align-items: center
            }

            .recently-view-mbl {
                padding-left: 5rem !important;
            }

            .mbl-class {
                text-align: center
            }

            .row.no-gutters.mb-2.align-items-center.rating-result.r-result {
                justify-content: center
            }

            .w-70-unset {
                width: unset !important;
                margin: 20px 0px 5px 0px !important;
                text-align: center
            }

            img.prod_img_detail_acc.fadeInLeft.animated.img-w25 {
                width: 100%;
                height: 60vh !important;
            }

            .question_sec {
                max-width: 100%;
                flex: 51% !important;
                margin: 10px 15px 0 15px !important;

            }

            .review_sec {
                max-width: 100% !important;
                flex: 50% !important;
            }

            .img-product-gall {
                height: 14rem;

            }

            .img1-section2 {
                height: 17rem;
            }

            .ingredientTabBtn,
            .revque_btn {
                font-size: 19px !important
            }

            .h_to_use_img {
                height: 17rem;
            }

            .text-center-mbl {
                text-align: center !important
            }

            .spot-section {
                height: unset !important;
            }
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
    <script>
        var site = '<?php echo session('site'); ?>';

        var userId = '<?php echo session('userId'); ?>';
        var productId = "<?php echo isset($productDetails['PRODUCT_ID']) ? $productDetails['PRODUCT_ID'] : ''; ?>";
        var baseurl = "<?php echo url('/assets-admin'); ?>";
    </script>
</head>


<body class="home">

    <main id="content" ng-app="project1">
        <div class="" id="details-header" ng-controller="projectinfo1">

            <section class=" sec_inc_1">
                <div class="container container-custom container-xxl mt-5 mt-md-0 mt-xl-5 mt-xxl-5">
                    <div class="row no-gutters">
                        <div class="col-md-6 col-xl-8 mb-8 mb-md-0 pr-xl-0 pr-md-3">
                            <div class="row no-gutters mx-n1">
                                <form class="" id="uploadattch" method="POST"
                                    action="uploadProductImageAttachment" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="POST">

                                    {{ csrf_field() }}

                                    <input type="hidden" id="userId" name="userId" value="<?php echo session('userId'); ?>">
                                    <input type="hidden" id="sourceId" name="sourceId"
                                        value="@{{ QuickProduct.PRODUCT_ID }}">
                                    <input type="hidden" id="sourceCode" name="sourceCode" value="PRODUCT_IMG">
                                    <input type="file" id="uploadattl" name="uploadattl" class="file-input"
                                        style="display: none;">

                                </form>
                                <div class="col-sm-6 col-6 px-1 mb-2">

                                    <img src="{{ url('/assets-admin') }}/images/admin/Placeholder.jpg"
                                        onclick="form1();" alt="Image"
                                        class="prod_img_detail img-w35 img-product-gall cursor-pointer"
                                        style="border:5px dotted grey">
                                </div>
                                <div class id="p_att">

                                </div>


                                <div class="col-md-6 px-1 pb-1" ng-repeat="row in displayImagesLov">

                                    <div class="show-image">

                                        <img src="@{{ row.DOWN_PATH }}" alt="Image"
                                            class="prod_img_detail img-w35 img-product-gall">
                                        <span class="badge badge-warning primary"
                                            ng-if="row.PRIMARY_FLAG == '1'">Primary</span>
                                        <span class="badge badge-warning secondary"
                                            ng-if="row.SECONDARY_FLAG == '1'">Secondary</span>
                                        <button class="btn btn-danger btn-sm delete"
                                            ng-click="deleteProductImage(@{{ row.IMAGE_ID }})">DELETE</button>
                                        <button class="btn btn-info btn-sm markprimary"
                                            ng-click="markProdImagePriSec(@{{ row.IMAGE_ID }})">Mark Image</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 pl-xl-6 pl-md-3" ng-show="basicEditView == '0'">
                            <div class="primary-summary-inner">
                                <h2 class="fs-30 mb-0" id="p7">{{ $productDetails['P_1'] }}</h2>
                                <p class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-1 pt-4 pb-4"
                                    id="p8">
                                    {{ $productDetails['P_2'] }}</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-sm-6 col-6">
                                                <p class="mb-1 fs" id="p9">{{ $productDetails['P_3'] }}</p>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <p class="mb-1 fs text-right" id="p10">
                                                    {{ $productDetails['P_4'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-3" id="p11">{{ $productDetails['P_5'] }}</p>

                                <form class="cart-roww">
                                    <div class="row align-items-end no-gutters mx-n2">
                                        <div class="col-sm-4 form-group px-2 mb-6">
                                            <label class="text-primary fs-19-qua font-weight-bold my-3"
                                                for="number">Quantity: </label>
                                            <p class="mb-1 fs" id="p12">{{ $productDetails['P_6'] }}</p>
                                            {{-- <input type="number" class="form-control"> --}}
                                        </div>
                                        <div class="col-sm-8 mb-6 px-2 d-flex gap">
                                            <button type="button" class="btn btn-primary btn-block text-capitalize"
                                                ng-click="editBasicInfo()">Edit</button>

                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 pl-xl-6 pl-md-3" ng-show="basicEditView != '0'">
                            <div class="primary-summary-inner">
                                <input type="text" class="form-control" placeholder="Product Name" id="p1"
                                    ng-model="QuickProduct['P_1']">
                                <input type="text" class="form-control mt-1" placeholder="Sub Title"
                                    id="p2" ng-model="QuickProduct['P_2']">
                                {{-- <p
                                    class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-1 pt-4 pb-4">
                                    For Women</p> --}}
                                <div class="row">
                                    <div class="col-lg-12 mt-1">
                                        <div class="row">
                                            <div class="col-sm-6 col-6">
                                                <input type="text" class="form-control" id="p3"
                                                    placeholder="Price" ng-model="QuickProduct['P_3']">
                                                {{-- <p class="mb-1 fs">$1,000.00</p> --}}
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                {{-- <p class="mb-1 fs text-right">1000</p> --}}
                                                <input type="text" class="form-control" id="p4"
                                                    placeholder="Size" ng-model="QuickProduct['P_4']">

                                            </div>
                                        </div>


                                    </div>
                                </div>
                                {{-- <p class="mb-3">It is a long established fact that a reader will be distracted by the
                                    readable content of a page when looking at its layout. It is a long established fact
                                    that a reader will be distracted by the readable content of a page when looking at
                                    its layout.</p> --}}
                                <div class="col-md-12 p-0 mt-1">
                                    <textarea id="p5" class="form-control" name="" id="" rows="8"
                                        ng-model="QuickProduct['P_5']"></textarea>
                                </div>

                                <form class="cart-roww">
                                    <div class="row align-items-end no-gutters mx-n2">
                                        <div class="col-sm-4 form-group px-2 mb-6">
                                            <label class="text-primary fs-19-qua font-weight-bold my-3"
                                                for="number">Quantity: </label>
                                            <input type="number" class="form-control" id='p6'
                                                ng-model="QuickProduct['P_6']">
                                        </div>
                                        <div class="col-sm-8 mb-6 px-2 d-flex gap">
                                            <button type="button" class="btn btn-primary text-capitalize w-50"
                                                ng-click="updateBasicInfo()">Update</button>
                                            <button type="button" class="btn btn-primary text-capitalize w-50"
                                                ng-click="cancelBasicInfo()">Cancel</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="pb-11 pb-lg-6">
                <div class="container container-custom container-xxl mt-8">
                    <h3 class="text-center my-4">Features <i class="fas fa-plus-circle cursor-pointer"
                            ng-click="addFeaturesModal()"></i></h3>
                    <div class=" features_slider"
                        data-slick-options='{"slidesToShow": 5,"pauseOnHover":true, "autoplay":true,"infinite": true,"dots":false,"arrows":false,"responsive":[
                        {"breakpoint": 1400,"settings": {"slidesToShow": 5}},
                        {"breakpoint": 1200,"settings": {"slidesToShow": 3}},
                        {"breakpoint": 992,"settings": {"slidesToShow": 2}},
                        {"breakpoint": 768,"settings": {"slidesToShow": 1}},
                        {"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>

                        <p class="text-center">No Features Added...</p>
                    </div>
                </div>
            </section>
            <section class="pb-11 pb-lg-6">
                <div class="container container-custom container-xxl">
                    <div class="collapse-tabs">
                        <ul class="nav nav-pills d-md-flex d-block border-bottom" style="display: none !important;"
                            id="pills-tab" role="tablist">
                            <li class="nav-item"><a
                                    class="nav-link active show font-weight-600 px-0 pb-3 mr-md-10 mr-4 text-active-primary border-active-primary bg-transparent rounded-0 lh-14375"
                                    id="pills-description-tab" data-toggle="pill" href="#pills-description"
                                    role="tab" aria-controls="pills-description" aria-selected="false">Tab
                                    1</a></li>
                        </ul>
                        <div class=" bg-white-md shadow-none pt-md-0 px-0 ml-0 mr-0">
                            <div id="collapse-tabs-accordion-01">
                                <div class="tab-pane tab-pane-parent fade show active" id="pills-description"
                                    role="tabpanel">
                                    <div class="card border-0 bg-transparent">
                                        <div class="card-header border-0 d-none bg-transparent px-0 py-1"
                                            id="headingDetails-01">
                                            <h5 class="mb-0">
                                                <button
                                                    class="btn lh-2 py-1 px-6 shadow-none w-100 collapse-parent border text-primary"
                                                    data-toggle="false" data-target="#description-collapse-01"
                                                    aria-expanded="true" aria-controls="description-collapse-01">
                                                    Tab
                                                    1</button>
                                            </h5>
                                        </div>
                                        <div id="description-collapse-01" class="collapsible collapse show"
                                            aria-labelledby="headingDetails-01"
                                            data-parent="#collapse-tabs-accordion-01" style="">
                                            <div id="accordion-style-01"
                                                class="accordion accordion-01 border-md-0 border p-md-0">
                                                <div class="card-body p-0">
                                                    <div class="row " style="">
                                                        <div class="col-12 text-right"
                                                            ng-show="SecondSectionEdit == '0'">
                                                            <i class="fa fa-pencil-square-o cursor-pointer"
                                                                aria-hidden="true" ng-click="EditSecondSection()"></i>
                                                        </div>

                                                        <h5 class="col-12 mb-2 font-weight-500 fs-24 pb-8 text-center"
                                                            id="p17" style="margin: 0 auto;"
                                                            ng-show="SecondSectionEdit == '0'">For Women </h5>
                                                        <div class="col-md-6 mb-6 mb-md-0">
                                                            <img id="p15"
                                                                src="https://jusoutbeauty.com/site/public/uploads/product/images/292.jpg"
                                                                alt="Image"
                                                                class="prod_img_detail_acc fadeInLeft animated img1-section2 img-w35">
                                                            <img id="p16"
                                                                src="https://jusoutbeauty.com/site/public/uploads/product/images/293.jpg"
                                                                alt="Image"
                                                                class="prod_img_detail_acc_sec fadeInLeft animated img2-section2 img-w20">

                                                        </div>
                                                        <div class="col-md-6 pro-details"
                                                            ng-show="SecondSectionEdit != '0'">
                                                            <button class="btn btn-primary mb-2 float-right mx-2"
                                                                ng-click="CloseSecondSection()">Cancel</button>
                                                            <button class="btn btn-primary mb-2 float-right"
                                                                ng-click="UpdateSecondSection()">Update</button>

                                                            <input type="text" class="form-control mb-1"
                                                                ng-model="QuickProduct['P_17']">
                                                            <div class="summernote" id="SecondSectionSummerNote">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pro-details"
                                                            style="height: 32rem;overflow-y:auto"
                                                            ng-show="SecondSectionEdit == '0'">
                                                            <h5 class="mb-2 font-weight-500 fs-20">
                                                            </h5>
                                                            <p id="p18"><span style="text-align: justify;">It is
                                                                    a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span><span
                                                                    style="text-align: justify;">It is a long
                                                                    established fact that a reader will be distracted by
                                                                    the readable content of a page when looking at its
                                                                    layout.&nbsp;</span></p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>

                                                    {{-- <div class="row pt-10 align-items-center subsc_ec">

                                                        <div class="col-md-6 ">
                                                            <h3 class="mb-2 font-weight-500 fs-35">Subscription</h3>
                                                            <p class="mb-6">Indulge in the convenience and exclusive
                                                                benefits offered with our subscription service. Simply
                                                                select how frequently you'd like to recieve your
                                                                products,
                                                                and we'll ensure you never run on empty. You may adjust
                                                                your delivery preferences at any time.</p>

                                                            <a href="#" data-toggle="tooltip"
                                                                data-placement="left"
                                                                title="Click to see more Ingredients"
                                                                class="preview btn btn-primary"> <span>Learn More
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6 mb-6 mb-md-0">
                                                            <img src="https://jusoutbeauty.com/site/assets-web/images/image-new.jpg"
                                                                alt="The Iconic Silhouette "
                                                                class="fadeInRight animated subs_img">

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr> --}}
                                                    <section class="pt-10 pt-lg-8 py-8">
                                                        <div class="">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col-md-7"></div>
                                                                <div class="col-md-5">
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-block text-capitalize float-right w-50"
                                                                        ng-show="VideoEditView == '0'"
                                                                        ng-click="showVideoInfo()">Edit</button>
                                                                    <button type="button"
                                                                        class="btn btn-primary text-capitalize w-25 float-right"
                                                                        ng-click="updateVideoInfo()"
                                                                        ng-show="VideoEditView != '0'">Update</button>
                                                                    <button type="button"
                                                                        class="btn btn-primary text-capitalize w-25 float-right mx-2"
                                                                        ng-click="cancelVideoInfo()"
                                                                        ng-show="VideoEditView != '0'">Cancel</button>
                                                                </div>
                                                                <div class="col-md-8 mb-8 mb-md-0">
                                                                    <div class="fix">
                                                                        <img src="{{ url('/assets-admin') }}/images/admin/Placeholder.jpg"
                                                                            ng-show="video.V_4 == ''"
                                                                            onclick="form2();"
                                                                            class="prod_img_detail img-w35 img-product-gall cursor-pointer"
                                                                            style="border:5px dotted grey">

                                                                        <div class=" hover-zoom-in"
                                                                            ng-show="video.V_4 != ''">
                                                                            <button class="btn btn-primary mb-2"
                                                                                onclick="form2();">Edit</button>
                                                                            <video src="@{{ video.V_4 }}"
                                                                                class="card-img"></video>
                                                                            <div
                                                                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center p-4">
                                                                                <a href="@{{ video.V_3 }}"
                                                                                    data-gtf-mfp="true"
                                                                                    data-mfp-options='{"type":"iframe","preloader":false}'
                                                                                    class="mb-3 mb-sm-7 w-45px h-45px w-sm-65 h-sm-65 d-flex justify-content-center align-items-center rounded-circle fs-sm-20 border border-white text-white bg-hover-primary border-hover-primary"><i
                                                                                        class="fas fa-play"></i></a>
                                                                                <p
                                                                                    class="text-uppercase text-white fs-sm-30 letter-spacing-375px font-weight-800">
                                                                                    lookbook
                                                                                    video</p>
                                                                            </div>
                                                                        </div>
                                                                        <form class="" id="uploadattch2"
                                                                            method="POST"
                                                                            action="uploadProductVideoAttachment"
                                                                            enctype="multipart/form-data">
                                                                            <input type="hidden" name="_method"
                                                                                value="POST">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" id="userId"
                                                                                name="userId"
                                                                                value="<?php echo session('userId'); ?>">
                                                                            <input type="hidden" id="sourceId"
                                                                                name="sourceId"
                                                                                value="@{{ QuickProduct.PRODUCT_ID }}">
                                                                            <input type="hidden" id="videoId"
                                                                                name="videoId"
                                                                                value="@{{ video.ID }}">
                                                                            <input type="hidden" id="sourceCode"
                                                                                name="sourceCode"
                                                                                value="PRODUCT_VIDEO">
                                                                            <input type="file" id="uploadatt2"
                                                                                name="uploadattl" class="file-input"
                                                                                style="display: none;">
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 pl-xl-7 pl-7"
                                                                    id="videoSectionSummerNote1"
                                                                    ng-show="VideoEditView == '0'"
                                                                    style="height:40rem;overflow-y:auto">
                                                                    <h3 class="fs-35 mb-5" id="video_heading">
                                                                        Mascara </h3>

                                                                    <p id="video_desc"><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its layout.&nbsp;</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-4 pl-xl-7 pl-7"
                                                                    id="videoSectionSummerNote2"
                                                                    ng-show="VideoEditView != '0'">
                                                                    <input type="text" class="form-control my-2"
                                                                        ng-model="video['V_1']">
                                                                    <div class="summernote" id="VideoSummerView">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <br>
                                                    <hr>
                                                    <section class="pb-10 pb-lg-0 mob_tab_sec">
                                                        <div class="">
                                                            <h5 class="text-center mb-3">Ingredients</h5>
                                                            <h3 class="text-center mb-9">Backed by Science to Optimize
                                                                Skin Wellness <i class="fas fa-plus-circle cursor-pointer" ng-click="addSpotForModal()"></i></h3>
                                                            <ul
                                                                class="nav nav-pills justify-content-center mb-lg-9 mb-6">
                                                                <li class="nav-item px-5 d-flex align-items-center gap-2"><a
                                                                        class="pointer nav-link cursor-pointer ingredientTabBtn text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary border-active-primary font-weight-300 font-weight-active-400"
                                                                        id="spotlightTabBtn">Spotlight Ingredients</a> 
                                                                </li>
                                                                <li class="nav-item px-5 d-flex align-items-center gap-2"><a
                                                                        class="pointer nav-link cursor-pointer ingredientTabBtn text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary border-active-primary font-weight-300 font-weight-active-400 active"
                                                                        id="formulatedTabBtn">Formulated
                                                                        Ingredients</a>
                                                                </li>
                                                            </ul>
                                                            <div class="p-0 m-0" id="pills-tabContent">
                                                                <div class="tabbspotlight" id="tabbspotlight"
                                                                    style="display: none;">
                                                                    <section class="pb-11 pb-lg-0" id="">
                                                                        <div
                                                                            class="container container-custom container-xxl">
                                                                            <div class="row" id="spotlight_data">
                                                                                <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section"
                                                                                    style="background-color:#57813a96">
                                                                                    <img class="spot-section-img"
                                                                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                                                                    <p
                                                                                        class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                        Glycerin</p>
                                                                                    <p>
                                                                                        A humectant that helps to
                                                                                        attract and retain
                                                                                        moisture in the skin, providing
                                                                                        hydration and a smooth
                                                                                        appearance.
                                                                                    </p>

                                                                                </div>
                                                                                <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section"
                                                                                    style="background-color:#57813a96">
                                                                                    <img class="spot-section-img"
                                                                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                                                                    <p
                                                                                        class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                        Polyethylene Terephthalate</p>
                                                                                    <p>
                                                                                        Used in cosmetics to create
                                                                                        shimmering and
                                                                                        glittering effects. It is often
                                                                                        found in products that have a
                                                                                        sparkly ...</p>

                                                                                </div>
                                                                                <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section"
                                                                                    style="background-color:#57813a96">
                                                                                    <img class="spot-section-img"
                                                                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                                                                    <p
                                                                                        class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                        Caprylic/Capric Triglyceride</p>
                                                                                    <p>
                                                                                        It is a lightweight and
                                                                                        non-greasy emollient
                                                                                        that helps to improve the
                                                                                        spreadability of the product and
                                                                                        provides ...</p>

                                                                                </div>
                                                                                <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section"
                                                                                    style="background-color:#57813a96">
                                                                                    <img class="spot-section-img"
                                                                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                                                                    <p
                                                                                        class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                        Phenoxyethanol</p>
                                                                                    <p>
                                                                                        It helps to maintain the
                                                                                        stability and safety of the
                                                                                        product. Is another preservative
                                                                                        commonly used in
                                                                                        cosmetics ...</p>

                                                                                </div>


                                                                                <div
                                                                                    class="col-sm-12 ing_btn_prod_detail pt-4 text-center">
                                                                                    <a href="javascript:;"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="left"
                                                                                        title=""
                                                                                        class="preview btn btn-primary"
                                                                                        data-original-title="Click to see more Ingredients">
                                                                                        <span data-toggle="modal"
                                                                                            data-target="#ingred_pop">List
                                                                                            of Full Ingredients </span>
                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </section>
                                                                </div>
                                                                <div class="tabbformulated" id="tabbformulated"
                                                                    style="">
                                                                    <section class="pb-11 pb-lg-0" id="">
                                                                        <div
                                                                            class="container container-custom container-xxl">
                                                                            <div class="row" id="formulated_data">

                                                                                <div
                                                                                    class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section">
                                                                                    <img class="spot-section-img"
                                                                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                                                                    <p
                                                                                        class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                        Talc</p>

                                                                                    Is a naturally occurring mineral
                                                                                    that is used
                                                                                    as a filler in cosmetics. It helps
                                                                                    to improve the texture, absorb e...
                                                                                </div>
                                                                                <div
                                                                                    class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section">
                                                                                    <img class="spot-section-img"
                                                                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                                                                    <p
                                                                                        class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                        Zinc Stearate</p>
                                                                                    A mineral-derived compound that acts
                                                                                    as a bulking agent and provides a
                                                                                    silky texture to cosmetics. It helps
                                                                                    to improve a...
                                                                                </div>
                                                                                <div
                                                                                    class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section">
                                                                                    <img class="spot-section-img"
                                                                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                                                                    <p
                                                                                        class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                        Sodium Dehydroacetate</p>

                                                                                    A preservative that helps to prevent
                                                                                    the
                                                                                    growth of microorganisms and extend
                                                                                    the shelf life of the product.

                                                                                </div>
                                                                                <div
                                                                                    class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section">
                                                                                    <img class="spot-section-img"
                                                                                        src="https://jusoutbeauty.com/site/assets-web/images/cannabis-ingredient.webp">
                                                                                    <p
                                                                                        class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                        Iron Oxides - CI
                                                                                        77491/77492/77499</p>

                                                                                    Mineral pigments that provide
                                                                                    various shades
                                                                                    of brown, red, and black colors in
                                                                                    cosmetics.

                                                                                </div>

                                                                                <div
                                                                                    class="col-sm-12 ing_btn_prod_detail pt-4 text-center">
                                                                                    <a href="javascript:;"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="left"
                                                                                        title=""
                                                                                        class="preview btn btn-primary"
                                                                                        data-original-title="Click to see more Ingredients">
                                                                                        <span data-toggle="modal"
                                                                                            data-target="#ingred_pop">List
                                                                                            of Full Ingredients </span>
                                                                                    </a>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </section>
                                                                </div>
                                                                <div class="modal fade quick-view" id="ingred_pop"
                                                                    tabindex="-1" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content p-0">
                                                                            <div class="modal-body p-0">
                                                                                <button type="button"
                                                                                    class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    <span aria-hidden="true"
                                                                                        class="fs-20"><i
                                                                                            class="fal fa-times"></i></span>
                                                                                </button>
                                                                                <div class="pop_content_prod_detail">
                                                                                    <h3>Full List of ingredients</h3>
                                                                                    <hr>
                                                                                    <div class="row">


                                                                                        <p class="col-lg-12">

                                                                                            Talc, Zinc Stearate, Sodium
                                                                                            Dehydroacetate, Iron Oxides
                                                                                            - CI 77491/77492/77499,
                                                                                            Glycerin, Polyethylene
                                                                                            Terephthalate,
                                                                                            Caprylic/Capric
                                                                                            Triglyceride, Phenoxyethanol
                                                                                        </p>


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <br>

                                                    <section style="background-color: #f38c7b;">
                                                        <div class="pb-10 pb-lg-8 py-8">
                                                            <div class="container container-xl">
                                                                <h2 class="text-center mb-9" style="color: #fff;">
                                                                    How To
                                                                    Use: AM and PM <i
                                                                    class="fas fa-plus-circle cursor-pointer" ng-click="addNewUses();"></i></h2>
                                                                <div class="row" id="steps_users">
                                                                    <div class="col-md-4 mb-6 mb-md-0 ">
                                                                        <div class="card border-0">
                                                                            <img src="https://jusoutbeauty.com/site/public/uploads/product/uses/1683527807-106.jpg"
                                                                                alt="Image"
                                                                                class="card-img h_to_use_img">
                                                                            <div
                                                                                class="card-body pt-6 px-0 pb-0 text-center">
                                                                                <a href="#"
                                                                                    class="fs-18 font-weight-500 lh-1444">Mascara</a>
                                                                                <p class="mb-6">
                                                                                    It is a long established fact that a
                                                                                    reader will be distracted by the
                                                                                    readable content of a page when
                                                                                    looking at its layout.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4 mb-6 mb-md-0 pt-14 step_2">
                                                                        <div class="card border-0">
                                                                            <img src="https://jusoutbeauty.com/site/public/uploads/product/uses/1683527845-107.jpg"
                                                                                alt="Image"
                                                                                class="card-img h_to_use_img">
                                                                            <div
                                                                                class="card-body pt-6 px-0 pb-0 text-center">
                                                                                <a href="#"
                                                                                    class="fs-18 font-weight-500 lh-1444">mascara</a>
                                                                                <p class="mb-6">
                                                                                    It is a long established fact that a
                                                                                    reader will be distracted by the
                                                                                    readable content of a page when
                                                                                    looking at its layout.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4 mb-6 mb-md-0 ">
                                                                        <div class="card border-0">
                                                                            <img src="https://jusoutbeauty.com/site/public/uploads/product/uses/1683527885-108.jpg"
                                                                                alt="Image"
                                                                                class="card-img h_to_use_img">
                                                                            <div
                                                                                class="card-body pt-6 px-0 pb-0 text-center">
                                                                                <a href="#"
                                                                                    class="fs-18 font-weight-500 lh-1444">mascara</a>
                                                                                <p class="mb-6">
                                                                                    It is a long established fact that a
                                                                                    reader will be distracted by the
                                                                                    readable content of a page when
                                                                                    looking at its layout.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                    <section class="pt-10 pt-lg-8 py-8">
                                                        <div class="">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col-md-6 mb-8 mb-md-0 hover-zoom-in">

                                                                    <img class="clinical-note"
                                                                        src="https://jusoutbeauty.com/site/public/uploads/product/images/298.jpg"
                                                                        alt="Clinical Note">

                                                                </div>
                                                                <div class="col-md-6 px-6 px-md-0 pl-xl-7"
                                                                    style="height:30rem;overflow-y:auto">
                                                                    <h3 class="fs-42 mb-5">Clinical Note</h3>
                                                                    <p><span style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its
                                                                            layout.&nbsp;</span><span
                                                                            style="text-align: justify;">It is a long
                                                                            established fact that a reader will be
                                                                            distracted by the readable content of a page
                                                                            when looking at its layout.&nbsp;</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pb-lg-13">
                <div class="container container-custom container-xxl">
                    <ul class="nav nav-pills justify-content-center mb-lg-9 mb-6 last-section-pro-detail"
                        role="tablist">

                        <li class="nav-item px-5"><a
                                class="pointer nav-link active text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary font-weight-300 font-weight-active-400 recent_viewed"
                                id="pills-recommendations-tab" data-toggle="pill" href="#pills-recommendations"
                                role="tab" aria-controls="pills-recommendations" aria-selected="true">Complete
                                Your JusOGlow</a>
                        </li>
                        <li class="nav-item px-5"><a
                                class="pointer nav-link  text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary font-weight-300 font-weight-active-400 recent_viewed"
                                id="pills-recently-viewed-tab" data-toggle="pill" href="#pills-hand-picked"
                                role="tab" aria-controls="pills-recently-viewed" aria-selected="true">
                                Your Daily HandPicked</a></li>
                        <li class="nav-item px-5"><a
                                class="pointer nav-link  text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary font-weight-300 font-weight-active-400 recent_viewed"
                                id="pills-recently-viewed-tab" data-toggle="pill" href="#pills-recently-viewed"
                                role="tab" aria-controls="pills-recently-viewed" aria-selected="true">Recently
                                Viewed</a></li>
                        <!--Border Active primary-->
                    </ul>
                    <div class="tab-content p-0 m-0 shadow-none" id="pills-tabContent">
                        <div class="tab-pane fade show active" style="margin-bottom: 20px" id="pills-recommendations"
                            role="tabpanel" aria-labelledby="pills-recommendations-tab">
                            <div class="slick-slider "
                                data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>



                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="108">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/274.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/270.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="108" data-type='single'>
                                                        <i class="icon fal fa-star wish_108 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="108" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail" data-id="108">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Nail Polish</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$3.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>





                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="111">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/297.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/295.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="111" data-type='single'>
                                                        <i class="icon fal fa-star wish_111 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="111" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail" data-id="111">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Mascara</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$1,000.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                                <li class="list-inline-item" title="Dark505">
                                                    <a href="javascript:;" class="d-block swatches-item"
                                                        style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/16.jpg'); background-repeat:no-repeat;background-position: center;">
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" title="reord123">
                                                    <a href="javascript:;" class="d-block swatches-item"
                                                        style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/50.jpg'); background-repeat:no-repeat;background-position: center;">
                                                    </a>
                                                </li>
                                            </ul>





                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="119">
                                                <img src="https://www.jusoutbeauty.com/site/public/uploads/product/images/319.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://www.jusoutbeauty.com/site/public/uploads/product/images/320.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="119" data-type='single'>
                                                        <i class="icon fal fa-star wish_119 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="119" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail" data-id="119">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Laborum id nesciunt</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$83.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>





                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="120">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="120" data-type='single'>
                                                        <i class="icon fal fa-star wish_120 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="120" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail" data-id="120">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Eye Liner</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$0.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>





                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="122">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="122" data-type='single'>
                                                        <i class="icon fal fa-star wish_122 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="122" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail" data-id="122">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Nude 10 Shade Matte Eyeshadow Palette</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$12.99
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>





                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="121">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/321.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/322.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="121" data-type='single'>
                                                        <i class="icon fal fa-star wish_121 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="121" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail" data-id="121">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Whitening Cream</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$300.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                                <li class="list-inline-item" title="V-Deep705">
                                                    <a href="javascript:;" class="d-block swatches-item"
                                                        style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/23.jpg'); background-repeat:no-repeat;background-position: center;">
                                                    </a>
                                                </li>
                                            </ul>





                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="modal fade quick-view" id="product-recommendations-1" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content p-0">
                                        <div class="modal-body p-0">
                                            <button type="button"
                                                class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="fs-20"><i
                                                        class="fal fa-times"></i></span>
                                            </button>
                                            <div class="row no-gutters">
                                                <div class="col-sm-6">
                                                    <div style="background-image: url('images/product.jpg');"
                                                        class="h-100 bg-img-cover-center ratio ratio-1-1"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="p-3 py-lg-8 pl-lg-8 pr-lg-7">
                                                        <a href="store.html"
                                                            class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-2 d-block">
                                                            Sweaters</a>
                                                        <div class="d-flex align-items-center">
                                                            <h2 class="fs-30 mb-1">
                                                                <a href="product-detail.html">Hoodie with pouch
                                                                    pocket</a>
                                                            </h2>
                                                        </div>
                                                        <p class="mb-6 fs-20 text-primary lh-14">$79.00</p>
                                                        <div class="d-flex align-items-center flex-wrap">
                                                            <ul
                                                                class="list-inline d-flex justify-content-sm-end justify-content-center mb-0 rating-result">
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                            </ul>
                                                            <p
                                                                class="text-primary mb-0 fs-14 lh-1 overflow-hidden pl-3">
                                                                <span class="pr-2">5.0</span><span
                                                                    class="mr-2 border-right border-light-dark"></span><a
                                                                    href="#">See 3 Reviews</a>
                                                            </p>
                                                        </div>
                                                        <p class="mt-2 mb-6">Posuere in netus a eu varius adipiscing
                                                            suspendisse elementum vitae tempor suspendisse ullamcorper
                                                            aenean taciti morbi potenti.</p>
                                                        <form>
                                                            <div
                                                                class="form-group shop-swatch-color shop-swatch-color-02 mb-6">
                                                                <label class="mb-2"><span
                                                                        class="font-weight-500 text-primary mr-2">Color:</span>
                                                                    <span class="var text-capitalize"></span></label>
                                                                <ul
                                                                    class="list-inline d-flex justify-content-start mb-0">
                                                                    <li class="list-inline-item"><a href="#"
                                                                            class="d-block swatches-item"
                                                                            data-var="green-revitalizing"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Korma"
                                                                            style="background-color: #903711;"> </a>
                                                                    </li>
                                                                    <li class="list-inline-item"><a href="#"
                                                                            class="d-block swatches-item"
                                                                            data-var="black"
                                                                            style="background-color: #000;"> </a></li>
                                                                    <li class="list-inline-item"><a href="#"
                                                                            class="d-block swatches-item"
                                                                            data-var="green-revitalizing"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Alto"
                                                                            style="background-color: #D8D8D8;"> </a>
                                                                    </li>
                                                                </ul>
                                                                <input type="hidden" name="swatches-color"
                                                                    class="swatches-select" value="min">
                                                            </div>
                                                            <div class="form-group shop-swatch swatch-size mb-7">
                                                                <label class="mb-2"><span
                                                                        class="font-weight-500 text-primary mr-2">Select
                                                                        a
                                                                        Size:</span>
                                                                    <span class="var text-uppercase">S</span></label>
                                                                <ul class="list-inline d-flex">
                                                                    <li class="list-inline-item mr-2 selected"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="xs">XS</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="s">S</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="M">M</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="L">L</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="XL">XL</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="XXL">XXL</a></li>
                                                                </ul>
                                                                <input type="hidden" name="swatches-size"
                                                                    class="swatches-select" value="xs">
                                                            </div>
                                                            <div class="row align-items-end no-gutters mx-n2">
                                                                <div class="col-sm-3 form-group px-2 mb-6 mb-sm-0">
                                                                    <label
                                                                        class="text-primary fs-16 font-weight-bold mb-3">Quantity:
                                                                    </label>
                                                                    <div class="input-group position-relative w-100">
                                                                        <a href="#"
                                                                            class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i
                                                                                class="far fa-minus"></i></a> <input
                                                                            name="number" type="number"
                                                                            class="form-control w-100 px-6 text-center input-quality bg-transparent text-primary"
                                                                            value="1" required> <a
                                                                            href="#"
                                                                            class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i
                                                                                class="far fa-plus"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9 mb-6 mb-sm-0 px-2">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-block text-capitalize">add
                                                                        to
                                                                        cart</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="tab-pane fade" style="margin-bottom: 20px" id="pills-recently-viewed"
                            role="tabpanel" aria-labelledby="pills-recommendations-tab">
                            <div class="slick-slider "
                                data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>



                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">

                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="106">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/255.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/256.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="106" data-type='single'>
                                                        <i class="icon fal fa-star wish_106 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="106" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="106">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Fare Cream for men</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$500.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>


                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">

                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="119">
                                                <img src="https://www.jusoutbeauty.com/site/public/uploads/product/images/319.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://www.jusoutbeauty.com/site/public/uploads/product/images/320.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="119" data-type='single'>
                                                        <i class="icon fal fa-star wish_119 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="119" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="119">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Laborum id nesciunt</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$83.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>


                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">

                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="120">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="120" data-type='single'>
                                                        <i class="icon fal fa-star wish_120 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="120" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="120">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Eye Liner</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$0.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>


                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">

                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="108">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/274.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/270.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="108" data-type='single'>
                                                        <i class="icon fal fa-star wish_108 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="108" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="108">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Nail Polish</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$3.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade quick-view" id="product-recommendations-1" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content p-0">
                                        <div class="modal-body p-0">
                                            <button type="button"
                                                class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                                data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" class="fs-20"><i
                                                        class="fal fa-times"></i></span>
                                            </button>
                                            <div class="row no-gutters">
                                                <div class="col-sm-6">
                                                    <div style="background-image: url('images/product.jpg');"
                                                        class="h-100 bg-img-cover-center ratio ratio-1-1"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="p-3 py-lg-8 pl-lg-8 pr-lg-7">
                                                        <a href="store.html"
                                                            class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-2 d-block">
                                                            Sweaters</a>
                                                        <div class="d-flex align-items-center">
                                                            <h2 class="fs-30 mb-1">
                                                                <a href="product-detail.html">Hoodie with pouch
                                                                    pocket</a>
                                                            </h2>
                                                        </div>
                                                        <p class="mb-6 fs-20 text-primary lh-14">$79.00</p>
                                                        <div class="d-flex align-items-center flex-wrap">
                                                            <ul
                                                                class="list-inline d-flex justify-content-sm-end justify-content-center mb-0 rating-result">
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                                <li class="list-inline-item"><span
                                                                        class="text-primary fs-12 lh-2"><i
                                                                            class="fas fa-star"></i></span>
                                                                </li>
                                                            </ul>
                                                            <p
                                                                class="text-primary mb-0 fs-14 lh-1 overflow-hidden pl-3">
                                                                <span class="pr-2">5.0</span><span
                                                                    class="mr-2 border-right border-light-dark"></span><a
                                                                    href="#">See 3 Reviews</a>
                                                            </p>
                                                        </div>
                                                        <p class="mt-2 mb-6">Posuere in netus a eu varius adipiscing
                                                            suspendisse elementum vitae tempor suspendisse ullamcorper
                                                            aenean taciti morbi potenti.</p>
                                                        <form>
                                                            <div
                                                                class="form-group shop-swatch-color shop-swatch-color-02 mb-6">
                                                                <label class="mb-2"><span
                                                                        class="font-weight-500 text-primary mr-2">Color:</span>
                                                                    <span class="var text-capitalize"></span></label>
                                                                <ul
                                                                    class="list-inline d-flex justify-content-start mb-0">
                                                                    <li class="list-inline-item"><a href="#"
                                                                            class="d-block swatches-item"
                                                                            data-var="green-revitalizing"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Korma"
                                                                            style="background-color: #903711;"> </a>
                                                                    </li>
                                                                    <li class="list-inline-item"><a href="#"
                                                                            class="d-block swatches-item"
                                                                            data-var="black"
                                                                            style="background-color: #000;"> </a></li>
                                                                    <li class="list-inline-item"><a href="#"
                                                                            class="d-block swatches-item"
                                                                            data-var="green-revitalizing"
                                                                            data-toggle="tooltip"
                                                                            data-placement="top" title="Alto"
                                                                            style="background-color: #D8D8D8;"> </a>
                                                                    </li>
                                                                </ul>
                                                                <input type="hidden" name="swatches-color"
                                                                    class="swatches-select" value="min">
                                                            </div>
                                                            <div class="form-group shop-swatch swatch-size mb-7">
                                                                <label class="mb-2"><span
                                                                        class="font-weight-500 text-primary mr-2">Select
                                                                        a
                                                                        Size:</span>
                                                                    <span class="var text-uppercase">S</span></label>
                                                                <ul class="list-inline d-flex">
                                                                    <li class="list-inline-item mr-2 selected"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="xs">XS</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="s">S</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="M">M</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="L">L</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="XL">XL</a></li>
                                                                    <li class="list-inline-item mr-2"><a
                                                                            href="#"
                                                                            class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                            data-var="XXL">XXL</a></li>
                                                                </ul>
                                                                <input type="hidden" name="swatches-size"
                                                                    class="swatches-select" value="xs">
                                                            </div>
                                                            <div class="row align-items-end no-gutters mx-n2">
                                                                <div class="col-sm-3 form-group px-2 mb-6 mb-sm-0">
                                                                    <label
                                                                        class="text-primary fs-16 font-weight-bold mb-3">Quantity:
                                                                    </label>
                                                                    <div class="input-group position-relative w-100">
                                                                        <a href="#"
                                                                            class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i
                                                                                class="far fa-minus"></i></a> <input
                                                                            name="number" type="number"
                                                                            class="form-control w-100 px-6 text-center input-quality bg-transparent text-primary"
                                                                            value="1" required> <a
                                                                            href="#"
                                                                            class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i
                                                                                class="far fa-plus"></i> </a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9 mb-6 mb-sm-0 px-2">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-block text-capitalize">add
                                                                        to
                                                                        cart</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>


                        <!---Handpicked Start -->
                        <div class="tab-pane fade" style="margin-bottom: 20px" id="pills-hand-picked"
                            role="tabpanel" aria-labelledby="pills-recommendations-tab">
                            <div class="slick-slider "
                                data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>



                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="108" data-type="">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/274.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/270.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="108" data-type='single'>
                                                        <i class="icon fal fa-star wish_108 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="108" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="108">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Nail Polish</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$3.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>


                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="111" data-type="">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/297.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/295.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="111" data-type='single'>
                                                        <i class="icon fal fa-star wish_111 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="111" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="111">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Mascara</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$1,000.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                                <li class="list-inline-item" title="Dark505">
                                                    <a href="javascript:;" class="d-block swatches-item"
                                                        style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/16.jpg'); background-repeat:no-repeat;background-position: center;">
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" title="reord123">
                                                    <a href="javascript:;" class="d-block swatches-item"
                                                        style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/50.jpg'); background-repeat:no-repeat;background-position: center;">
                                                    </a>
                                                </li>
                                            </ul>


                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="119" data-type="">
                                                <img src="https://www.jusoutbeauty.com/site/public/uploads/product/images/319.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://www.jusoutbeauty.com/site/public/uploads/product/images/320.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="119" data-type='single'>
                                                        <i class="icon fal fa-star wish_119 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="119" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="119">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Laborum id nesciunt</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$83.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>


                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="120" data-type="">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="120" data-type='single'>
                                                        <i class="icon fal fa-star wish_120 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="120" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="120">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Eye Liner</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$0.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>


                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="122" data-type="">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/assets-web/images/product_placeholder.png"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="122" data-type='single'>
                                                        <i class="icon fal fa-star wish_122 "></i>
                                                    </a>
                                                    <!-- <a href="#" data-toggle="tooltip" data-placement="left"
               title="Quick view"
               class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
               <span data-toggle="modal"
               data-target="#product-recommendations-1"> <i
                class="fal fa-eye"></i>
              </span>
              </a> -->
                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="122" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="122">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Nude 10 Shade Matte Eyeshadow Palette</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$12.99
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                            </ul>


                                        </div>
                                    </div>
                                </div>


                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                            <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                                data-id="121" data-type="">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/321.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 img-h30-m image-active">
                                                <img src="https://jusoutbeauty.com/site/public/uploads/product/images/322.jpg"
                                                    alt="Product 01"
                                                    class="card-img-top all-products img-h60 image-hover">
                                            </a>
                                            <div
                                                class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                <div></div>
                                                <div class="content-change-vertical d-flex flex-column ml-auto">
                                                    <a href="javascript:;" data-toggle="tooltip"
                                                        data-placement="left" title="Add to wish list"
                                                        class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                        data-productId="121" data-type='single'>
                                                        <i class="icon fal fa-star wish_121 "></i>
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                    data-type="single" data-id="121" data-quantity='1'>+ Quick
                                                    Add</a>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                            <ul class="list-inline fs-12 d-flex mb-1">
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                                <li class="list-inline-item text-primary mr-0">
                                                    <i class="fas fa-star" style="color:gray;"></i>
                                                </li>
                                            </ul>
                                            <div class="d-flex align-items-center mb-2 productdetail"
                                                data-id="121">
                                                <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                                    <a href="javascript:;">Whitening Cream</a>
                                                </h3>
                                                <p class="fs-15 text-primary mb-0 ml-auto">
                                                    <span class="text-line-through text-body mr-1"></span>$300.00
                                                </p>
                                            </div>
                                            <ul
                                                class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                                <li class="list-inline-item" title="V-Deep705">
                                                    <a href="javascript:;" class="d-block swatches-item"
                                                        style="background-image: url('http://www.jusoutbeauty.com/site/public/uploads/shades/23.jpg'); background-repeat:no-repeat;background-position: center;">
                                                    </a>
                                                </li>
                                            </ul>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <!-- Handpicked End -->

                    </div>
                </div>
            </section>
            <div class="modal fade quick-view" id="learnmore_pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 631px !important;">
                    <div class="modal-content p-0">
                        <div class="modal-body p-0">
                            <button type="button"
                                class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                ng-click="hideSubscrptionDetailModal();">
                                <span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
                            </button>
                            <div class="pop_content_prod_detail">

                                <div class="row">

                                    <p class="col-lg-12"
                                        style="max-height: 500px;
                            overflow: auto;">
                                    </p>

                                </div>
                                <div class="row">

                                    <div class="col-lg-12 text-right">
                                        <a style="text-decoration-line: underline;font"
                                            href="https://jusoutbeauty.com/site/subscription"><em>Read More
                                                >></em></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirmProdImageModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- 	<h5 class="modal-title">Change State</h5> -->
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-12">
                                    <label><b>Selected Image mark as primary or secondary!!!</b></label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light"
                                ng-click="closeProdImageModal();">Close</button>
                            <button type="button" class="btn btn-warning"
                                ng-click="markProductDetailImageFlag(1);">Mark Primary</button>
                            <button type="button" class="btn btn-warning"
                                ng-click="markProductDetailImageFlag(2);">Mark Secondary</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addFeaturesModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- 	<h5 class="modal-title">Change State</h5> -->
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-12">
                                    <label><b>Product Features<span class="required-field">*</span></b></label>
                                    <select class="default-placeholder select2-hidden-accessible" id="p13"
                                        multiple='multiple' ng-model="QuickProduct['P_13']"
                                        ng-options="item as item.name for item in featurelov track by item.id">
                                        <option value="">---SELECT---</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light"
                                ng-click="closeFeaturesModal();">Close</button>
                            <button type="button" class="btn btn-primary"
                                ng-click="updateFeaturesModal();">Update</button>
                            {{-- <button type="button" class="btn btn-warning" ng-click="markProductDetailImageFlag(2);">Mark Secondary</button> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addFeaturesModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- 	<h5 class="modal-title">Change State</h5> -->
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-12">
                                    <label><b>Product Features<span class="required-field">*</span></b></label>
                                    
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light"
                                ng-click="closeFeaturesModal();">Close</button>
                            <button type="button" class="btn btn-primary"
                                ng-click="updateFeaturesModal();">Update</button>
                            {{-- <button type="button" class="btn btn-warning" ng-click="markProductDetailImageFlag(2);">Mark Secondary</button> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addSpotForModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- 	<h5 class="modal-title">Change State</h5> -->
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <label class="col-form-label" for="ing_category"><b>Ingredient Category</b> <span class="text-danger">*</span> </label>
                                        <select class="form-control" ng-model="ingredient['I_1']" ng-change="getIngredientsWrtCategory();">
                                            <option value="">---SELECT---</option>
                                            <option value="Formulated">Formulated</option>
                                            <option value="Spotlight">Spotlight</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <label class="col-form-label" for="ingredient"><b>Ingredient</b> <span class="text-danger">*</span> </label> 
                                        <select class="form-control" id="i2" ng-model="ingredient['I_2']"
                                                ng-options="item as item.name for item in ingredientsLov track by item.id">
                                            <option value="">---SELECT---</option>
                                        </select>
                                    </div>
                                </div>
                               

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light"
                                ng-click="closeFeaturesModal();">Close</button>
                                <button class="btn btn-rounded btn-warning cmbm-6vw mt-2" ng-click="saveProductIngredient();">Add</button>
                            {{-- <button type="button" class="btn btn-warning" ng-click="markProductDetailImageFlag(2);">Mark Secondary</button> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="usesStepsModal">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Step</h5>
							<button type="button" class="close" data-dismiss="modal">
								<span>&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<div class="row">
							   <div class="col-6">
							     <label><b>Sequence Number<span class="required-field">*</span></b></label>
							     <input type="number" class="form-control" id="u1" ng-model="uses['U_1']">
							   </div>
							</div>
							<div class="row mt-4">
							   <div class="col-12">
							     <label><b>Title<span class="required-field">*</span></b></label>
							     <input type="text" class="form-control" id="u2" ng-model="uses['U_2']">
							   </div>
							</div>
							<div class="row mt-4">
								<div class="col-sm-12">
									<label><b>Short Description<span class="required-field">*</span></b></label>
									<textarea class="form-control" id="u4" rows="4" ng-model="uses['U_4']" placeholder="Enter Short Description..."></textarea>
								</div>
							</div>
							<div class="col-sm-12 col-12 register-new-product-picture-para-box mt-4">
								<div class="row register-new-product-picture-para">
									<div class="col-sm-4 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form4();" style="">
										<img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
										<p>360 X 450</p>
									</div>
									<div class="col-sm-7">
										<div class="row" id="ps_att">
											<div class="col-3 image-overlay margin-r1" id="img_file" ng-show="uses.U_3 != ''">
												<img src="@{{uses.U_3}}" alt="" class="image-box">
												<div class="overlay">
													<div class="text">
														<img class="fa-trash-alt" src="{{url('/assets-admin')}}/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductUsesImage(@{{uses.ID}})" title="Delete Image">
														<div class="arrow-icon-move-box">
															<img class="arrow-center" src="{{url('/assets-admin')}}/images/admin/feather-move.svg" alt="">
															<p>Move Position</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<form class="" id="uploadattch4" method="POST" action="uploadProductUsesImage" enctype="multipart/form-data">
										<input type="hidden" name="_method" value="POST">
           								{{ csrf_field() }}
           								<input type="hidden" id="userId" name="userId" value="<?php echo session('userId');?>">
										<input type="hidden" id="sourceId" name="sourceId" value="@{{QuickProduct.PRODUCT_ID}}">
										<input type="hidden" id="usesId" name="usesId" value="@{{uses.ID}}">
										<input type="hidden" id="sourceCode" name="sourceCode" value="PRODUCT_USES_IMG"> 
										<input type="file" id="uploadatt4" name="uploadattl" class="file-input" style="display: none;">
									</form>

								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-warning" ng-click="saveProductUses();">Save changes</button>
						</div>
					</div>
				</div>
			</div>
        </div>

    </main>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Your SDK code -->
    <script src="{{ url('/assets-web') }}/vendors/jquery.min.js"></script>
    <script src="{{ url('/assets-web') }}/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ url('/assets-web') }}/vendors/bootstrap/bootstrap.bundle.js"></script>
    {{-- <script src="{{ url('/assets-web') }}/vendors/bootstrap-select/js/bootstrap-select.min.js"></script> --}}
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
<script src="{{ url('/assets-admin') }}/customjs/script_adminquickaddproduct.js?v={{ time() }}"></script>

<script src="{{ url('/assets-admin') }}/third_party/admin/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="{{ url('/assets-admin') }}/third_party/admin/select2/js/select2.full.min.js"></script>
<script src="{{ url('/assets-admin') }}/js/admin/plugins-init/select2-init.js"></script>
<!-- Summernote -->
<script src="{{ url('/assets-admin') }}/third_party/admin/summernote/js/summernote.min.js"></script>
<!-- Summernote init -->
<script src="{{ url('/assets-admin') }}/js/admin/plugins-init/summernote-init.js"></script>
<script>
    function form1() {
        $("#uploadattl").click();
    }

    function form2() {
        $("#uploadatt2").click();
    }
    $(document).on("click", "#spotlightTabBtn", function() {

        $(".ingredientTabBtn").removeClass('active');
        $("#spotlightTabBtn").addClass('active');
        $("#tabbspotlight").show();
        $("#tabbformulated").hide();

    });
    $(document).on("click", "#formulatedTabBtn", function() {

        $(".ingredientTabBtn").removeClass('active');
        $("#formulatedTabBtn").addClass('active');
        $("#tabbspotlight").hide();
        $("#tabbformulated").show();

    });

    function form4(){
        $("#uploadatt4").click();
    }
</script>

</html>
