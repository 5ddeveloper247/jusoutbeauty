<?php //print_r('<pre>');
// print_r($categoryName);
// exit();
?>
@include('web.web-header')
<script>
    var site = '<?php echo session('site'); ?>';
    var sourceId = "<?php echo isset($sourceId) ? $sourceId : ''; ?>";
    var flag = "<?php echo isset($flag) ? $flag : ''; ?>";
    var categoryName = "<?php echo isset($categoryName['NAME']) ? $categoryName['NAME'] : 'Store'; ?>"
    var subCategoryName = "<?php echo isset($subCategoryName['NAME']) ? $subCategoryName['NAME'] : ''; ?>"
</script>
<style>
    .read-more-btn{
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
    h4.card-title.border-0{
        font-weight: 600;
        color:white
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

    @media screen and (min-width: 0px) and (max-width: 614px) {
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
        }
    }
</style>
<main ng-app="project1">
    
    <section class="py-10 mt-15 mt-15-67 bg-gray-1 hero-section">
        <div class="container">
           
            <h2 class="mb-2 text-center font-size-banner" data-animate= "fadeInRight" style="color: white;">Routine</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center align-items-center fs-15 mb-3">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ session('site') }}/routine" style="color: white; font-size: 30px">Routine</a>
                    </li>
                    <li class="breadcrumb-item d-flex align-items-center"><a class="text-decoration-none"></a>
                    </li>
                </ol>
            </nav>
        </div>
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
    function readmore(){
        if($(".read-more").hasClass('read-more-btn')){

            $(".read-more-click-btn").text('Read Less <<');
            $(".read-more").removeClass('read-more-btn');
        }else{
            $(".read-more-click-btn").text('Read More >>');
            $(".read-more").addClass('read-more-btn');
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
