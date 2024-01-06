<?php
// echo '<pre>';
// print_r($homeBanner);

// Assuming userId is stored in the session as 'userId'
$userId = session('userId');
// echo 'userId: ' . $userId;
// echo 'hello';
// exit();
?>

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

    <link rel="stylesheet" href="{{ url('/assets-web') }}/css/themes.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/css/inc_style.css">
    <link href="{{ url('/assets-web') }}/customcss/website/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/customcss/website/flaticon.css">
    <link rel="stylesheet" href="{{ url('/assets-web') }}/customcss/website/ionicons.min.css">

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

        [ng-cloak],
        [ng\:cloak],
        [data-ng-cloak],
        [x-ng-cloak],
        .ng-cloak,
        .x-ng-cloak {
            display: none !important;
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
</head>
<script>
    var baseUrl = "<?php echo url('/'); ?>";
    var userId = "<?php echo session('userId'); ?>";
    var cartId = "<?php echo session('cartid'); ?>";
</script>

<body class="home">
    <header class="main-header navbar-light header-sticky header-sticky-smart position-absolute fixed-top home">
        <div id="topbar"
            class="d-none d-xl-flex align-items-center alert alert-dismissible fade show p-0 mb-0 rounded-0 border-0"
            style="background: #8ed1c9 !important;">
            <div class="container p-2">
                <p class="mb-0 fs-14 letter-spacing-005 text-uppercase text-center font-weight-500"
                    style="color: white;">COOL NEW COLOR: STERLING SO WORTH IT</p>
            </div>
            <button type="button" onclick="close_topbar()"
                class="close text-dark p-2 pr-3 fs-18 font-weight-300 opacity-10">
                <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button>
        </div>
        <div class="sticky-area">
            <div class="container container-custom container-xxl">
                <div class="d-none d-xl-block">
                    <nav class="navbar navbar-expand-xl px-0 py-2 py-xl-0 row no-gutters">
                        <div class="col-xl-2">
                            <a class="navbar-brand mr-0" href="{{ url('/home') }}">
                                <img src="{{ url('/assets-web') }}/images/Logo1.png" alt="Jusout"
                                    style="position: relative;z-index: 999999">
                            </a>
                        </div>
                        <div class="col-xl-7 d-flex justify-content-center position-static">
                            <ul class="navbar-nav hover-menu main-menu px-0 mx-xl-n5 menu_ul">

                                <?php if(isset($categoryProducts) && !empty($categoryProducts)){?>
                                <?php foreach($categoryProducts as $value){?>

                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-shop dropdown py-2 py-xl-4 px-0 px-xl-2 px-xxl-5">
                                    {{-- toShopListing --> removed after made url with href --}}
                                    <a class="nav-link dropdown-toggle p-0 "
                                        href="<?= url('/') ?>/Store/<?= $value['CATEGORY_SLUG'] ?>"
                                        data-id="<?= $value['CATEGORY_ID'] ?>" data-type="CATEGORY"
                                        data-categoryslug="<?= $value['CATEGORY_SLUG'] ?>">
                                        <!-- {{ session('site') }}/store -->
                                        <?= $value['NAME'] ?> <span class="caret"></span>
                                    </a>
                                    <?php if(strtoupper($value['NAME']) == 'SHOP'){?>
                                    <div
                                        class="dropdown-menu dropdown-menu-xl px-0 pb-8 pt-5 dropdown-menu-listing overflow-hidden x-animated x-fadeInUp">
                                        <div class="container container-xxl d-block">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-2">

                                                    <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0">
                                                        Sub Categories</h4>

                                                    <?php $subCategories = $value['subCategories']; ?>

                                                    <div class="dropdown-item">
                                                        <a class="dropdown-link"
                                                            href="{{ session('site') }}/Shop-All">Shop All</a>
                                                    </div>
                                                    @if (!empty($subCategories))
                                                        @foreach ($subCategories as $category)
                                                            <div class="dropdown-item">
                                                                {{-- toShopListing  ---> removed after made url href --}}
                                                                <a class="dropdown-link "
                                                                    href="<?= url('/') ?>/Store/<?= $value['CATEGORY_SLUG'] ?>/<?= $category['SUB_CATEGORY_SLUG'] ?>"
                                                                    data-id="<?= $category['SUB_CATEGORY_ID'] ?>"
                                                                    data-type="SUB_CATEGORY"
                                                                    data-subcategoryslug="<?= $category['SUB_CATEGORY_SLUG'] ?>"
                                                                    data-categoryslug="<?= $value['CATEGORY_SLUG'] ?>">{{ $category['DISPLAY_NAME'] }}</a>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>


                                                <div class="col-8 h-100 border-left">
                                                    <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0">
                                                        Recommended Products</h4>

                                                    <div class="row">

                                                        <?php $products = $value['recommandedProducts']; ?>
                                                        @if (!empty($products))
                                                            @foreach ($products as $product)
                                                                <div class="col-4 h-100">

                                                                    <div class="col-12 col-lg-12 product mb-8"
                                                                        data-animate="fadeInUp">
                                                                        <div class="card border-0">
                                                                            <div
                                                                                class="position-relative hover-zoom-in ">
                                                                                {{-- productdetail ---> removed after made url with href --}}
                                                                                <a href="{{ url('/') }}/Products/{{ $product['CATEGORY_SLUG'] }}/{{ $product['SUB_CATEGORY_SLUG'] ? $product['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $product['SLUG'] }}"
                                                                                    class="d-block overflow-hidden "
                                                                                    data-id="{{ $product['PRODUCT_ID'] }}"
                                                                                    data-type="{{ $product['CATEGORY_NAME'] }}"
                                                                                    data-category="{{ $product['CATEGORY_SLUG'] }}"
                                                                                    data-subCategory="{{ $product['SUB_CATEGORY_SLUG'] }}"
                                                                                    data-name="{{ $product['SLUG'] }}">
                                                                                    <!-- {{ url('/product-detail') }} -->
                                                                                    <img src="{{ $product['primaryImage'] }}"
                                                                                        alt="Product 01"
                                                                                        class="card-img-top img-header-20 img-h50 image-active">
                                                                                    <img src="{{ $product['primaryImage'] }}"
                                                                                        alt="Product 01"
                                                                                        class="card-img-top img-header-20 img-h50 image-hover">
                                                                                </a>
                                                                                <div
                                                                                    class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                                                    <div
                                                                                        class="content-change-vertical d-flex flex-column ml-auto">
                                                                                        <!-- {{ url('/wishlist') }} -->
                                                                                        <a href="javascript:;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="left"
                                                                                            title="Add to wish list"
                                                                                            class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                                                                            <i class="fas fa-star"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body pt-4 px-0 pb-0">
                                                                                    <a href="javascript:;"
                                                                                        class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary"
                                                                                        data-id="{{ $product['CATEGORY_ID'] }}"
                                                                                        data-type="CATEGORY"
                                                                                        data-categoryslug="{{ $product['CATEGORY_SLUG'] }}">
                                                                                        {{ $product['CATEGORY_NAME'] }}</a>
                                                                                    <!-- {{ url('/store') }} -->
                                                                                    <h3
                                                                                        class="card-title fs-16 font-weight-500 mb-1 lh-14375">
                                                                                        {{-- productdetail ---> removed after made url with href --}}
                                                                                        <a href="{{ url('/') }}/Products/{{ $product['CATEGORY_SLUG'] }}/{{ $product['SUB_CATEGORY_SLUG'] ? $product['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $product['SLUG'] }}"
                                                                                            class=""
                                                                                            data-id="{{ $product['PRODUCT_ID'] }}"
                                                                                            data-type="{{ $product['CATEGORY_NAME'] }}"
                                                                                            data-category="{{ $product['CATEGORY_SLUG'] }}"
                                                                                            data-subCategory="{{ $product['SUB_CATEGORY_SLUG'] }}"
                                                                                            data-name="{{ $product['SLUG'] }}">{{ ucWords($product['NAME']) }}</a>
                                                                                        <!-- {{ url('/product-detail') }} -->
                                                                                    </h3>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            @endforeach
                                                        @endif

                                                        <div class="col-1 h-100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php }else{?>

                                    <div
                                        class="dropdown-menu dropdown-menu-xl px-0 pb-8 pt-5 dropdown-menu-listing overflow-hidden x-animated x-fadeInUp mega-image-cat">
                                        <div class="container container-xxl d-block">

                                            <div class="row p-4">
                                                <div class="col-4 h-100">
                                                    <div class="row">

                                                        <?php $subCategories = $value['subCategories']; ?>

                                                        @if (!empty($subCategories))
                                                            @foreach ($subCategories as $category)
                                                                <a
                                                                    href="<?= url('/') ?>/Store/<?= $value['CATEGORY_SLUG'] ?>/<?= $category['SUB_CATEGORY_SLUG'] ?>">
                                                                    {{-- toShopListing ---> removed after made url with href --}}
                                                                    <div class="col-4 h-100"
                                                                        data-id="<?= $category['SUB_CATEGORY_ID'] ?>"
                                                                        data-type="SUB_CATEGORY"
                                                                        data-subcategoryslug="<?= $category['SUB_CATEGORY_SLUG'] ?>"
                                                                        data-categoryslug="<?= $value['CATEGORY_SLUG'] ?>">
                                                                        <div class="col-12 col-lg-12 product mb-2 ">

                                                                            <h4 class=" fs-14 mb-3 lh-1 font-weight-500 p-0 text-center ellipsis"
                                                                                style="display: block;">
                                                                                {{ $category['DISPLAY_NAME'] }}</h4>
                                                                            <!-- dropdown-header -->
                                                                            <div class="card border-0">
                                                                                <div
                                                                                    class="position-relative hover-zoom-in">
                                                                                    <a href="<?= url('/') ?>/Store/<?= $value['CATEGORY_SLUG'] ?>/<?= $category['SUB_CATEGORY_SLUG'] ?>"
                                                                                        class="d-block overflow-hidden">
                                                                                        <img src="{{ $category['prodImg'] }}"
                                                                                            alt="alt"
                                                                                            class="card-img-top img-header-left-7 image-active"
                                                                                            style="">
                                                                                        <img src="{{ $category['prodImg'] }}"
                                                                                            alt="alt"
                                                                                            class="card-img-top img-header-left-7 image-hover"
                                                                                            style="">
                                                                                    </a>

                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-8 h-100 border-left">
                                                    <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0">
                                                        Recommended Products</h4>

                                                    <div class="row">

                                                        <?php $products = $value['recommandedProducts']; ?>
                                                        @if (!empty($products))
                                                            @foreach ($products as $product)
                                                                <div class="col-4 h-100">

                                                                    <div class="col-12 col-lg-12 product mb-8"
                                                                        data-animate="fadeInUp">
                                                                        <div class="card border-0">
                                                                            <div
                                                                                class="position-relative hover-zoom-in">
                                                                                {{-- productdetail --> removed after made url with href --}}
                                                                                <a href="{{ url('/') }}/Products/{{ $product['CATEGORY_SLUG'] }}/{{ $product['SUB_CATEGORY_SLUG'] ? $product['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $product['SLUG'] }}"
                                                                                    class=""
                                                                                    data-id="{{ $product['PRODUCT_ID'] }}"
                                                                                    data-type="{{ $product['CATEGORY_NAME'] }}"
                                                                                    data-category="{{ $product['CATEGORY_SLUG'] }}"
                                                                                    data-subCategory="{{ $product['SUB_CATEGORY_SLUG'] }}"
                                                                                    data-name="{{ $product['SLUG'] }}"
                                                                                    class="d-block overflow-hidden">
                                                                                    <!-- {{ url('/product-detail') }} -->
                                                                                    <img src="{{ $product['primaryImage'] }}"
                                                                                        alt="Product 01"
                                                                                        class="card-img-top img-header-20 img-h50 image-active">
                                                                                    <img src="{{ $product['primaryImage'] }}"
                                                                                        alt="Product 01"
                                                                                        class="card-img-top img-header-20 img-h50 image-hover">
                                                                                </a>
                                                                                <div
                                                                                    class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                                                                    <div
                                                                                        class="content-change-vertical d-flex flex-column ml-auto">
                                                                                        <!-- {{ url('/wishlist') }} -->
                                                                                        <a href="javascript:;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="left"
                                                                                            title="Add to wish list"
                                                                                            class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                                                                            <i class="fas fa-star"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body pt-4 px-0 pb-0">
                                                                                    <a href="javascript:;"
                                                                                        class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary"
                                                                                        data-id="{{ $product['CATEGORY_ID'] }}"
                                                                                        data-type="CATEGORY"
                                                                                        data-categoryslug="{{ $product['CATEGORY_SLUG'] }}">
                                                                                        {{ $product['CATEGORY_NAME'] }}</a>
                                                                                    <!-- {{ url('/store') }} -->
                                                                                    <h3
                                                                                        class="card-title fs-16 font-weight-500 mb-1 lh-14375">
                                                                                        {{-- productdetail ---> removed after made url with href --}}
                                                                                        <a href="{{ url('/') }}/Products/{{ $product['CATEGORY_SLUG'] }}/{{ $product['SUB_CATEGORY_SLUG'] ? $product['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $product['SLUG'] }}"
                                                                                            class=""
                                                                                            data-id="{{ $product['PRODUCT_ID'] }}"
                                                                                            data-type="{{ $product['CATEGORY_NAME'] }}"
                                                                                            data-category="{{ $product['CATEGORY_SLUG'] }}"
                                                                                            data-subCategory="{{ $product['SUB_CATEGORY_SLUG'] }}"
                                                                                            data-name="{{ $product['SLUG'] }}">{{ $product['NAME'] }}</a>
                                                                                        <!-- {{ url('/product-detail') }} -->
                                                                                    </h3>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            @endforeach
                                                        @endif

                                                        <div class="col-1 h-100"></div>
                                                    </div>
                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                    <?php }?>

                                </li>
                                <?php }?>
                                <?php }?>



                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-home dropdown py-2 py-xl-4 px-0 px-xl-2 px-xxl-5">
                                    <a class="nav-link p-0" href="{{ url('/user-shade-finder') }}">
                                        Shade Finder </a>

                                </li>
                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-shop dropdown py-2 py-xl-4 px-0 px-xl-2 px-xxl-5">
                                    <a class="nav-link dropdown-toggle p-0" href="#"
                                        onclick="menutoggleRoutine();">Routine
                                        <span class="caret"></span>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-xl px-0 pb-8 pt-5 dropdown-menu-listing overflow-hidden x-animated x-fadeInUp">
                                        <div class="container container-xxl d-block">
                                            <div class="row">
                                                <div class="col-4 h-100"></div>
                                                <div class="col-2 h-100">
                                                    <?php $routines = $routine; ?>
                                                    @if (!empty($routines))

                                                        <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0"
                                                            style="display: block;">Routine By Needs</h4>
                                                        @foreach ($routines as $routine)
                                                            @if ($routine['IDENTIFY'] == 1)
                                                                <div class="dropdown-item ">
                                                                    <a class="dropdown-link routinelinks"
                                                                        href="{{ url('routine-detail') . '/' . $routine['seqNo'] }}">{{ $routine['NAME'] }}</a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-2 h-100">

                                                    @if (!empty($routines))

                                                        <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0 "
                                                            style="display: block;">Routine By Age</h4>
                                                        @foreach ($routines as $routine)
                                                            @if ($routine['IDENTIFY'] == 2)
                                                                <div class="dropdown-item ">
                                                                    <a class="dropdown-link routinelinks"
                                                                        href="{{ url('routine-detail') . '/' . $routine['seqNo'] }}">{{ $routine['NAME'] }}</a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                </div>


                                                <div class="col-2 h-100"></div>
                                            </div>


                                        </div>
                                    </div>

                                </li>

                                {{-- <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-home dropdown py-2 py-xl-4 px-0 px-xl-2 px-xxl-5">
                                    <a class="nav-link p-0" href="{{ url('/become_a_partner') }}">
                                        Partner </a>

                                </li> --}}
                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-shop dropdown py-2 py-xl-4 px-0 px-xl-2 px-xxl-5">
                                    <a class="nav-link dropdown-toggle p-0" href="{{ url('discover') }}"> Discover
                                        <span class="caret"></span>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-xl px-0 pb-8 pt-5 dropdown-menu-listing overflow-hidden x-animated x-fadeInUp">
                                        <div class="container container-xxl d-block">


                                            <div class="row">
                                                <div class="col-2 h-100"></div>
                                                <div class="col-2 h-100">

                                                    <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0 text-center"
                                                        style="display: block;"><a href="{{ url('who-we-are') }}">Who
                                                            we are</a></h4>


                                                </div>
                                                <div class="col-2 h-100">

                                                    <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0 text-center"
                                                        style="display: block;"><a
                                                            href="{{ url('ingredients') }}">Ingredients</a></h4>


                                                </div>
                                                <div class="col-2 h-100">

                                                    <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0 text-center"
                                                        style="display: block;"><a href="{{ url('eco-vibes') }}">Eco
                                                            vibes</a></h4>


                                                </div>
                                                <div class="col-2 h-100">

                                                    <h4 class="dropdown-header fs-16 mb-3 lh-1 font-weight-500 p-0 text-center"
                                                        style="display: block;"><a
                                                            href="{{ url('lusty-looks') }}">Lusty's Looks</a></h4>


                                                </div>

                                                <div class="col-2 h-100"></div>
                                            </div>


                                        </div>
                                    </div>

                                </li>
                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-home dropdown py-2 py-xl-4 px-0 px-xl-2 px-xxl-5">
                                    <a class="nav-link p-0" href="{{ url('/giving') }}"> Giving </a>

                                </li>

                            </ul>
                        </div>
                        <div class="col-xl-3 position-relative">
                            <div class="d-flex align-items-center justify-content-end">
                                <ul
                                    class="navbar-nav flex-row justify-content-xl-end align-items-center d-flex flex-wrap py-0 navbar-right">

                                    <?php if(session()->has('userId')){?>

                                    <li class="nav-item dropdown header-profile" data-toggle="tooltip"
                                        title="{{ session('firstName') }} {{ session('lastName') }}">
                                        <a class="nav-link px-3 py-0" href="javascript:void(0)" role="button"
                                            data-toggle="dropdown">
                                            <i class="far fa-user-alt"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ session('site') }}/userDashboard"
                                                class="dropdown-item ai-icon">
                                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg"
                                                    class="text-primary" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <span class="ml-2">Dashboard </span>
                                            </a>
                                            <a href="{{ session('site') }}/userlogout" class="dropdown-item ai-icon">
                                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg"
                                                    class="text-danger" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                    <polyline points="16 17 21 12 16 7"></polyline>
                                                    <line x1="21" y1="12" x2="9"
                                                        y2="12"></line>
                                                </svg>
                                                <span class="ml-2">Logout </span>
                                            </a>
                                        </div>
                                    </li>

                                    <!-- <li class="nav-item" data-toggle="tooltip" title="Logout">
          <a class="nav-link px-3 py-0" href="{{ session('site') }}/userlogout">
           <i class="far fa-user-alt"></i>
          </a>
         </li> -->

                                    <?php }else{?>
                                    <li class="nav-item" data-toggle="tooltip" title="Login"><a
                                            class="nav-link px-3 py-0" href="{{ session('site') }}/user-login"> <i
                                                class="far fa-user-alt"></i>
                                        </a></li>
                                    <?php }?>



                                        {{-- saerch icon on pc --}}
                                     <li class="nav-item" data-toggle="tooltip" title="Search">

                                    <a href="javascript:;"  data-toggle="modal" data-target="#productselfi"
                                    data-mfp-options='{"type":"inline","focus": "#keyword","mainClass":
                                    "mfp-search-form mfp-move-from-top mfp-align-top"}'
                                        class="nav-link nav-search d-flex align-items-center px-3">
                                        <i class="far fa-search"></i>  </a>

                                        {{--   <a href="{{ session('site') }}/Search-All"
                                        {{-- data-gtf-mfp="true"
                                            data-mfp-options='{"type":"inline","focus": "#keyword","mainClass":
                                             "mfp-search-form mfp-move-from-top mfp-align-top"}'
                                            class="nav-link nav-search d-flex align-items-center px-3">
                                            <i  class="far fa-search"></i>
                                        </a> --}}

                                    </li>

                                    <li class="nav-item" data-toggle="tooltip" title="Wishlist">
                                        <a class="nav-link position-relative px-3 py-0"
                                            href="{{ url('/wishlist') }}">
                                            <i class="far fa-star"></i>
                                            <span class="position-absolute number" id="wishlistHeaderCount">0</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="tooltip" title="Cart">
                                        <a class="nav-link position-relative px-3 menu-cart py-0 d-inline-flex align-items-center mr-n2"
                                            data-canvas="true" data-canvas-options='{"container":".cart-canvas"}'>
                                            <i class="far fa-shopping-bag cursor-pointer"></i>
                                            <span class="position-absolute number" id="cartHeaderCount">0</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="d-block d-xl-none">
                    <nav class="navbar navbar-expand-xl px-0 py-2 py-xl-0 w-100 align-items-center">
                        <button class="navbar-toggler border-0 px-0 canvas-toggle" type="button" data-canvas="true"
                            data-canvas-options='{"width":"250px","container":".sidenav"}'>
                            <span class="fs-24 toggle-icon"></span>
                        </button>
                        <a class="navbar-brand d-inline-block mx-auto" href="{{ url('home') }}"> <img
                                src="{{ url('/assets-web') }}/images/logo-black.png" alt="Minimog">
                        </a>

                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link px-3 py-0" href="javascript:void(0)" role="button"
                                data-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-user-alt"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php if(session()->has('userId')){?>

                                <a href="/site/userDashboard" class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                        width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ml-2">Dashboard </span>
                                </a>

                                <?php } ?>


                                <a class="dropdown-item ai-icon" href="{{ url('/wishlist') }}">
                                    <i class="far fa-star"></i>
                                    <span class="ml-2">Wishlist</span>
                                    <span class="numbermbl ml-2" id="wishlistHeaderCountMbl">0</span>
                                </a>
                                <a class="dropdown-item ai-icon" data-canvas="true"
                                    data-canvas-options='{"container":".cart-canvas"}'>
                                    <i class="far fa-shopping-bag"></i>
                                    <span class="ml-2">Checkout</span>
                                    <span class="numbermbl ml-1" id="cartHeaderCountMbl">0</span>
                                </a>
                                <?php if(session()->has('userId')){?>

                                <a href="/site/userlogout" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                        width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ml-2">Logout </span>
                                </a>

                                <?php }else{ ?>
                                <a href="{{ session('site') }}/login" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-success"
                                        width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ml-2">Login </span>
                                </a>

                                <?php  } ?>
                            </div>
                        </li>

                        {{-- search button on mobile  --}}
                        <a href="javascript:;"  data-toggle="modal" data-target="#productselfi"
                        data-mfp-options='{"type":"inline","focus": "#keyword","mainClass":
                        "mfp-search-form mfp-move-from-top mfp-align-top"}'

                        class="nav-search d-block py-0" title="Search"><i
                        class="far fa-search d-block d-xl-block"></i></a> </a>


                         {{-- <a href="{{ url('/assets-web') }}/#search-popup" data-gtf-mfp="true"
                            data-mfp-options='{"type":"inline","focus": "#keyword","mainClass":
                            "mfp-search-form mfp-move-from-top mfp-align-top"}'

                            class="nav-search d-block py-0" title="Search"><i
                            class="far fa-search d-block d-xl-block"></i></a> --}}


                    </nav>
                </div>
            </div>
        </div>
    </header>


    {{-- model for the search icon  --}}

    <input type="hidden" name="_token" id="csrf" value="{{ csrf_token() }}">

         <div class="modal fade selfi-view" id="productselfi" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-0">
                        <div class="modal-header">
                            <h5 class="modal-title">Search Your Desire Product </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                          <div ng-show="selfi.ID == ''">
                                <label style=" display: block !important;text-align:left;">Enter your Product name</label>
                                <input type="text" id="name" name="name" ng-model="selfi['name']"
                                    class="form-control mb-3" placeholder="Search in jusoutbeauty">
                            </div>

                                <a href="{{ session('site') }}/Search-All">   <button type="submit" class="btn btn-primary btn-block savebtn" ng-show="selfi.ID == ''"
                                    ng-click="submitProductSelfi();">Search</button></a>


                            <button type="button" class="btn btn-primary btn-block loaderbtn" disabled
                                style="display: none"><i class="ft-rotate-cw spinner"></i> Processing</button>

                        </div>
                    </div>
                </div>
            </div>
