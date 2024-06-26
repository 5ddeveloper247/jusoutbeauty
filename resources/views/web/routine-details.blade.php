<?php //print_r('<pre>');
// print_r($categoryName);
// exit();
?>
<?php
// echo session('userId');
// exit();
$userId = session('userId');
?>
@php
    use Illuminate\Support\Str;
@endphp
@include('web.web-header')
<script>
    var site = '<?php echo session('site'); ?>';
    var sourceId = "<?php echo isset($sourceId) ? $sourceId : ''; ?>";
    var flag = "<?php echo isset($flag) ? $flag : ''; ?>";
    var categoryName = "<?php echo isset($categoryName['NAME']) ? $categoryName['NAME'] : 'Store'; ?>"
    var subCategoryName = "<?php echo isset($subCategoryName['NAME']) ? $subCategoryName['NAME'] : ''; ?>"
</script>
<style>
    .read-more-btn {
        max-height: 18rem;
        overflow: hidden;
    }

    .accordion>.card>.card-header {
        border-radius: 0;
        margin-bottom: -1px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        align-content: center;
        flex-wrap: wrap;
        border-radius: 5px;
    }

    .card-header.after-coll.collapsed {
        background-color: #F89880;
        color: white;

    }

    .card-header.after-coll {
        background-color: #000000;
        color: white;

    }

    h4.card-title.border-0 {
        font-weight: 600;
        color: white;
        font-size: 1rem
    }

    .accordion .card-header a {
        border-bottom: 0px solid transparent !important;
    }

    .accordion .card-header:after {
        font-family: 'FontAwesome';
        content: "-";
        float: right;
        font-size: 26px;
        font-weight: bold
    }

    .accordion .card-header.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "+";
        font-size: 26px;
        font-weight: bold
    }

    .filter-sidebarr {
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    .quick_view_product_image {
        width: 250px;
        height: 250px;
        margin: 0px auto;
        display: flex;
    }

    .image_hide {
        display: none !important;
    }

    .shade-active:before {
        left: -1px !important;
        top: -1px !important;
    }

    .shade-active {
        padding: 2px;
        /* border: 1px solid black; */
        /* padding-bottom: 2vw; */
        content: '';
        width: 32px !important;
        height: 32px !important;
        display: block;
        position: absolute;
        /* left: -4px; */
        /* top: -4px; */
        border-radius: 50%;
        /* opacity: 0; */
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        transition: all .3s linear;
        border: 1px solid #000;
    }

    .shop-subtitle {
        height: 3rem
    }

    .all-products {
        height: 22rem
    }

    p {
        text-align: center
    }

    .banner-font {
        font-size: 100px
    }

    @media screen and (min-width: 0px) and (max-width: 614px) {
        .banner-font {
            font-size: 51px
        }

        .w-45px {
            width: 35px !important
        }

        .h-45px {
            height: 35px !important;
        }

        #qckad {
            font-size: .8rem;
        }

        .shop-subtitle {
            height: unset
        }

        .all-products {
            height: 16rem
        }

        .hero-section {
            margin-top: 5.5rem !important
        }

        .product-heading {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-subtitle {
            height: 50px;
            /* white-space: nowrap; */
            overflow: hidden;
            text-overflow: ellipsis;
            /* background-size: 100% 100%; */
        }
    }

    .overlay {
        position: relative;
    }

    .overlay::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Adjust the opacity as needed */
        z-index: 1;
    }

    .overlay-content {
        position: relative;
        z-index: 2;
    }

    .breadcrumb-site {
        position: absolute !important;
        top: 50%;
        bottom: 50%;
        left: 35%
    }

    @media (max-width: 767px) {
        .breadcrumb-site {
            position: static !important;
            top: auto;
            bottom: auto;
            left: auto;
            text-align: center;
            /* Center the breadcrumb on small screens */
        }

        .breadcrumb-item {
            display: block;
            margin: 0 auto;
            /* Center the breadcrumb items individually */
        }
    }
</style>
<main ng-app="project1">
    <?php $routineId = $routineById; ?>
    {{-- <section class="py-10 mt-15 mt-15-67 bg-gray hero-section"
        style="background-image: url(<?= $routineId[0]['IMAGE_DOWNPATH'] ?>) !important;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 50%;
            padding-top: 100px !important;
            padding-bottom: 100px !important;
            background-color: unset !important;
            ">
        <div class="container">

            <h1 class=" mb-2 text-center text-white banner-font" data-animate="fadeInRight"><?= $routineId[0]['NAME'] ?></h1>
            <p class="text-center text-white"><?= $routineId[0]['DESCRIPTION'] ?></p>
            <p class="text-center text-white mx-4">{!! Str::limit($routineId[0]['DESCRIPTION'], 1100,false) !!}</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center align-items-center fs-15 mb-3">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ session('site') }}/routine">Routine</a>
                    </li>
                    <li class="breadcrumb-item d-flex align-items-center"><a class="text-decoration-none"></a>
                    </li>
                </ol>
            </nav>
        </div>
    </section> --}}


    <section class="py-10 mt-10 ">
        <div class="container">
            <div class="row">
                <section class="col-md-6"
                    style="display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;">
                    <div class="routinetxt ">
                    <h2 class="mb-2 text-center" data-animate="fadeInRight">
                        <?= $routineId[0]['NAME'] ?>
                    </h2>
                    <div class="text-justify text-black mx-4">
                        {!! $routineId[0]['DESCRIPTION'] !!} 
                    </div>
                    </div>
                </section>
                <section class="col-md-6 hero-section hero-image"
                    style="background-image: url(<?= $routineId[0]['IMAGE_DOWNPATH'] ?>);
                        background-repeat: no-repeat;
                        background-size: cover;
                        object-fit: cover;
                        background-position: center !important;
                        padding-top: 100px !important;
                        padding-bottom: 100px !important;
                        background-color: unset !important; position:relative">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center fs-15 mb-3"
                            style="">
                            <li class="breadcrumb-item"><a class="text-decoration-none"
                                    href="{{ session('site') }}/home" style="color: white; font-size: 30px">Home</a>
                            </li>
                            <li class="breadcrumb-item d-flex align-items-center"><a class="text-decoration-none"
                                    style="color: white; font-size: 30px">Routine</a>
                            </li>
                        </ol>
                    </nav>
                </section>
            </div>
        </div>
    </section>



    <section class="pb-6 inc_sec" ng-controller="projectinfo1">
        <div class="container container-custom">
            <div class="row no-gutters shop-listing-page-filter">
                {{-- <div class="col-xl-3 pr-md-3 pr-lg-9 primary-sidebar sidebar-sticky filter-sidebarr" id="sidebar"
                    style="display: none">
                    <div class="primary-sidebar-inner">
                        <h2 class="fs-34 mb-6">Filter</h2>

                        <div class="card border-0 mb-7">

                            <div class="card-body px-0 pt-2 pb-0">
                                <ul class="list-unstyled mb-0">
                                    <?php $routinesNeedAge = $routine; ?>
                                    @if (!empty($routinesNeedAge))

                                    <div class="card-header bg-transparent border-0 p-0">
                                        <h3 class="card-title fs-18 font-weight-500 mb-0">ROUTINE BY AGE</h3>
                                    </div>
                                        @foreach ($routinesNeedAge as $routine)
                                        @if ($routine['IDENTIFY'] == 1)
                                        <li class="mb-1 d-flex" id="categoryFilter_">
                                            <a href="{{ url('routine-details').'/'.$routine['seqNo']}}" id="categoryFilterInput_">
                                                {{ $routine['NAME'] }}
                                            </a>
                                         </li>
                                        @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="card border-0 mb-7">

                            <div class="card-body px-0 pt-2 pb-0">
                                <ul class="list-unstyled mb-0">
                                    @if (!empty($routinesNeedAge))

                                    <div class="card-header bg-transparent border-0 p-0">
                                        <h3 class="card-title fs-18 font-weight-500 mb-0">ROUTINE BY AGE</h3>
                                    </div>
                                        @foreach ($routinesNeedAge as $routine)
                                        @if ($routine['IDENTIFY'] == 2)
                                        <li class="mb-1 d-flex" id="categoryFilter_">
                                            <a href="{{ url('routine-details').'/'.$routine['seqNo']}}" id="categoryFilterInput_">
                                                {{ $routine['NAME'] }}
                                            </a>
                                         </li>
                                        @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                    </div>
                </div> --}}
                <div class="col-xl-12 shop-listing-right-portion">
                    {{-- <div class="row">
                        <div class="col-sm-12 mb-4 mb-sm-0 pb-3 sort_inc_shop">
                            <div class="d-flex align-items-center d-xl-none text-primary font-weight-500 mr-6"
                                data-canvas="true" data-canvas-options='{"container":".filter-canvas"}'>
                                Filter
                                <span class="d-inline-block ml-1">
                                    <i class="fal fa-angle-down"></i>
                                </span>
                            </div>
                            <div class="dropdown filter-textt">
                                <a href="#" class="font-weight-500" id="filtersiderbar-leftn"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Show Filter
                                    <svg width="22" height="16" viewBox="0 0 22 16"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="icon-filter" fill-rule="nonzero" fill="none">
                                            <rect fill="#D8D8D8" y="2" width="22" height="2"
                                                rx="1"></rect>
                                            <rect fill="#D8D8D8" y="12" width="22" height="2"
                                                rx="1"></rect>
                                            <circle fill="#373737" cx="15.5" cy="13" r="2.5">
                                            </circle>
                                            <circle fill="#373737" cx="6.5" cy="3" r="2.5">
                                            </circle>
                                        </g>
                                    </svg>
                                </a>
                                <a href="#" class="font-weight-500" id="filtersiderbar-close"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="display: none;">
                                    Hide Filter
                                    <svg width="22" height="16" viewBox="0 0 22 16"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="icon-filter" fill-rule="nonzero" fill="none">
                                            <rect fill="#D8D8D8" y="2" width="22" height="2"
                                                rx="1"></rect>
                                            <rect fill="#D8D8D8" y="12" width="22" height="2"
                                                rx="1"></rect>
                                            <circle fill="#373737" cx="15.5" cy="13" r="2.5">
                                            </circle>
                                            <circle fill="#373737" cx="6.5" cy="3" r="2.5">
                                            </circle>
                                        </g>
                                    </svg>
                                </a>

                            </div>

                        </div>
                    </div> --}}
                    @if (!empty($getTypeNameLov))

                        <div class="row">

                            @foreach ($getTypeNameLov as $TypeName)
                                @if ($TypeName->steps != '')
                                    <div class="col-12 text-center mb-8">
                                        <h1 class="heading-font-routine text-uppercase">{{ $TypeName->TYPE_NAME }}</h1>
                                    </div>
                                    @php $i=1 @endphp
                                    @foreach ($TypeName->steps as $StepsName)
                                        <div class="col-6 col-lg-3 product productshop-listing mb-8 col-xl-3">
                                            <div class="card border-0">
                                                <div class="position-relative hover-zoom-in">
                                                    {{-- productdetail --> removed after made url with href --}}
                                                    <a href="{{ url('/') }}/Products/{{ $StepsName['CATEGORY_SLUG'] }}/{{ $StepsName['SUB_CATEGORY_SLUG'] ? $StepsName['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $StepsName['SLUG'] }}"
                                                        class="d-block overflow-hidden"
                                                        data-id="{{ $StepsName['PRODUCT_ID'] }}"
                                                        data-category="<?= $StepsName['CATEGORY_SLUG'] ?>"
                                                        data-subCategory="<?= $StepsName['SUB_CATEGORY_SLUG'] ?>"
                                                        data-name="<?= $StepsName['SLUG'] ?>"
                                                        data-type="<?= $StepsName['CATEGORY_NAME'] ?>">
                                                        <img src="{{ $StepsName['primaryImage'] }}" alt="Product 01"
                                                            class="card-img-top all-products img-h60 img-h30-m image-active">
                                                        <img src="{{ $StepsName['secondaryImage'] }}" alt="Product 01"
                                                            class="card-img-top all-products img-h60 image-hover">
                                                    </a>

                                                    <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                                        <a href="javascript:;"
                                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-pick @if (isset($userId)) productdetail @else addto-cart @endif"
                                                            data-id="{{ $StepsName['PRODUCT_ID'] }}" id="qckad"
                                                            data-id="{{ $StepsName['PRODUCT_ID'] }}"
                                                            data-category="{{ $StepsName['CATEGORY_SLUG'] }}"
                                                            data-subcategory="{{ $StepsName['SUB_CATEGORY_SLUG'] }}"
                                                            data-name="{{ $StepsName['SLUG'] }}" data-type=""
                                                            data-quickAdd="{{ session('userId') }}">Add To Cart</a>
                                                    </div>
                                                </div>
                                                {{-- productdetail --> removed after made url with href --}}
                                                <div class="card-body pt-4 px-0 pb-0"
                                                    data-id="{{ $StepsName['PRODUCT_ID'] }}"
                                                    data-category="<?= $StepsName['CATEGORY_SLUG'] ?>"
                                                    data-subCategory="<?= $StepsName['SUB_CATEGORY_SLUG'] ?>"
                                                    data-name="<?= $StepsName['SLUG'] ?>"
                                                    data-type="<?= $StepsName['CATEGORY_NAME'] ?>">
                                                    <a href="javascript:;"
                                                        class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary ng-binding">
                                                        STEP {{ $i++ }} </a>

                                                    <h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375 product-heading"
                                                        style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                                        <a
                                                            href="{{ url('/') }}/Products/{{ $StepsName['CATEGORY_SLUG'] }}/{{ $StepsName['SUB_CATEGORY_SLUG'] ? $StepsName['SUB_CATEGORY_SLUG'] . '/' : '' }}{{ $StepsName['SLUG'] }}">{{ $StepsName['NAME'] }}</a>
                                                    </h3>

                                                    {{-- <div class="row">
                                                <div class="col-sm-6 col-7">
                                                    <p class="text-primary mb-0 card-title lh-14375"> <span
                                                            class="ng-binding">$123.00</span> </p>
                                                </div>
                                                <div class="col-sm-6 col-5">
                                                    <p
                                                        class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis ng-binding">
                                                        100</p>
                                                </div>
                                            </div> --}}

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-12">
                                                        <div id="accordion_{{ $StepsName['PRODUCT_ID'] }}"
                                                            class="accordion">
                                                            <div class="card mb-0 rounded">
                                                                <div class="card-header after-coll collapsed how_to_user"
                                                                    data-toggle="collapse"
                                                                    href="#collapse_{{ $StepsName['STEP_ID'] }}">
                                                                    <h4 class="card-title m-0 border-0"
                                                                        style="display: inline-block;">
                                                                        HOW TO USE
                                                                    </h4>
                                                                </div>

                                                                <div id="collapse_{{ $StepsName['STEP_ID'] }}"
                                                                    class="card-body collapse how_to_user"
                                                                    data-parent="#accordion_{{ $StepsName['PRODUCT_ID'] }}">
                                                                    <p
                                                                        class="align-items-center read-more read-more-btn">
                                                                        {{ $StepsName['DESCRIPTION'] }}
                                                                    </p>
                                                                    <a id="remove_{{ $StepsName['PRODUCT_ID'] }}"
                                                                        class="read-more-click-btn"
                                                                        style="float:right;cursor: pointer;"
                                                                        onclick="readmore('remove_{{ $StepsName['PRODUCT_ID'] }}')">Read
                                                                        more >></a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach

                    @endif
                    @if (!isset($i))
                        <div class="col-md-12 ">
                            <p class="text-center read-more read-more-btn">NO ROUTINE ADDED ...
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        </div>

        {{-- <div class="canvas-sidebar filter-canvas">
            <div class="canvas-overlay"></div>
            <div class="card border-0 px-6 overflow-y-auto bg-white h-100 pb-6">
                <div class="card-header bg-transparent py-0 border-0">
                    <div class="text-right pb-7">
                        <span class="canvas-close d-inline-block text-right fs-24 pt-2 mr-n6 text-body"><i
                                class="fal fa-times"></i></span>
                    </div>
                    <h4 class="fs-34 mb-0">Filter</h4>
                </div>
                <div class="card-body">
                    <div class="card border-0 mb-7">

                            <div class="card-body px-0 pt-2 pb-0">
                                <ul class="list-unstyled mb-0">
                                    <?php $routinesNeedAge1 = $routineformbl; ?>
                                    @if (!empty($routinesNeedAge1))

                                    <div class="card-header bg-transparent border-0 p-0">
                                        <h3 class="card-title fs-18 font-weight-500 mb-0">ROUTINE BY NEED</h3>
                                    </div>
                                        @foreach ($routinesNeedAge1 as $routineNeed)
                                        @if ($routineNeed['IDENTIFY'] == 1)
                                        <li class="mb-1 d-flex" id="categoryFilter_">
                                            <a href="{{ url('routine-details').'/'.$routineNeed['seqNo']}}" id="categoryFilterInput_">
                                                {{ $routineNeed['NAME'] }}
                                            </a>
                                         </li>
                                        @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                    </div>

                        <div class="card border-0 mb-7">

                            <div class="card-body px-0 pt-2 pb-0">
                                <ul class="list-unstyled mb-0">
                                    @if (!empty($routinesNeedAge1))

                                    <div class="card-header bg-transparent border-0 p-0">
                                        <h3 class="card-title fs-18 font-weight-500 mb-0">ROUTINE BY AGE</h3>
                                    </div>
                                        @foreach ($routinesNeedAge1 as $routineAge)
                                        @if ($routineAge['IDENTIFY'] == 2)
                                        <li class="mb-1 d-flex" id="categoryFilter_">
                                            <a href="{{ url('routine-details').'/'.$routineAge['seqNo']}}" id="categoryFilterInput_">
                                                {{ $routineAge['NAME'] }}
                                            </a>
                                         </li>
                                        @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>


                </div>
            </div>
        </div> --}}
    </section>
    {{-- <section class="pb-6">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-xl-2"></div>
                <div class="col-xl-8 text-center">
                    <h2 class="mb-5">Trending items</h2>
                    <p class="text-primary fs-18 mb-5 ">Made using clean, non-toxic
                        ingredients, our products are designed for everyone. Made using
                        clean, non-toxic ingredients, our products are designed for
                        everyone. Made using clean, non-toxic ingredients, our products are
                        designed for everyone. Made using clean, non-toxic ingredients, our
                        products are designed for everyone.</p>
                </div>
                <div class="col-xl-2"></div>
            </div>
        </div>
    </section> --}}
</main>
@include('web.web-footer')

{{-- <script src="{{ url('/assets-web') }}/customjs/script_userstorelisting.js?v={{time()}}"></script> --}}

<script>
    $(document).ready(function() {

        $("#filtersiderbar-leftn").click(function() {
            //$(".filter-sidebarr").toggle();
            $(".shop-listing-right-portion").removeClass("col-xl-12");
            $(".shop-listing-right-portion").addClass("col-xl-9", );
            $(".productshop-listing").removeClass("col-xl-3");
            $(".productshop-listing").addClass("col-xl-4");
            $(".filter-sidebarr").toggle(1000);
            $(this).hide();
            $("#filtersiderbar-close").show();
        });
        $("#filtersiderbar-close").click(function() {
            //$(".filter-sidebarr").toggle();
            $(".filter-sidebarr").toggle();
            $(".shop-listing-right-portion").removeClass("col-xl-9");
            $(".shop-listing-right-portion").addClass("col-xl-12");
            $(".productshop-listing").removeClass("col-xl-4");
            $(".productshop-listing").addClass("col-xl-3");

            $(this).hide();
            $("#filtersiderbar-leftn").show();
        });

        $(".close_learnmore_pop").click(function() {
            $("#learnmore_pop").modal('hide');
        });

    });
</script>
<script>
    function readmore($id) {
        if ($("#read-more_" + $id).hasClass('read-more-btn')) {

            $(".read-more-click-btn").text('Read Less <<');
            $("#read-more_" + $id).removeClass('read-more-btn');
        } else {
            $(".read-more-click-btn").text('Read More >>');
            $("#read-more_" + $id).addClass('read-more-btn');
        }


    }

    function close_topbar() {

        $("#topbar").removeClass('d-xl-flex');
        $(".hero-section").removeClass('mt-15-67');
        $('.hero-section').attr('style', 'padding-top: 230px !important');

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
</script>
