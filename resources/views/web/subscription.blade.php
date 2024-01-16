
@include('web.web-header')
<style>
     .quick_view_product_image {
        width: 250px;
        height: 250px;
        margin: 0px auto;
        display: flex;
    }
    .subs-heading{
            background-color: #f9f9f9;
            padding-top:183px;
            padding-bottom:183px
        }
        .subs_pag_subs {
            height: 80vh;
        }
        .subs-heading{
            height:80vh;
        }

    @media only screen and (max-width: 599px) {
        .subs_pag_subs {
            height: 350px;
        }
        .subs-heading{
            background-color: #f9f9f9;
            padding-top:83px;
            padding-bottom:183px;
        }
    }
    @media only screen and (min-width: 768px) {
        .subs-heading{
		padding-top: 113px;
	}
    }
    @media only screen and (min-width:1023px) {
        .subs-heading {
		padding-top: 16vh;
	 }
    }
   
  

</style>

<main id="content" ng-app="project1">
    <div ng-controller="projectinfo1">
        <section class="pb-2 mt-0 mt-md-8" id="details-header">
            <div class="row">
                <div class="col-lg-4 subs_pag_subs"
                    style="background-image: url('{{ url('/assets-web') }}/images/routine.jpg');background-size: cover;">
                    <img src="" style="height: 400px;">
                </div>
                <div class="col-lg-4 subs_pag_subs">
                    <div class="text-center subs-heading" style="background-color: #8ed1c9; ">
                        <h2 class="fs-24 fs-sm-36 text-center mb-8 text-white">
                            Subscribe + Save 10% Off
                        </h2>
                        <p class="text-white">All Auto-Replenished Products Plus – Free Shipping</p>
                        <p class="text-white">Timeless Beauty Should Be Automatic</p>
                        <div class="text-center">
                            <a href="store.html" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 subs_pag_subs"
                    style="background-image: url('{{ url('/assets-web') }}/images/product-1.jpg');background-size: cover;">

                </div>
            </div>
        </section>
        <section class="pt-12 pb-6 ">
            <h2 class="fs-24 fs-sm-36 text-center mb-8">
                HOW IT WORKS
            </h2>

            <div class="container container-custom container-xl">
                <div class="row">

                    <div class="col-lg-3">
                        <img src="{{ url('/assets-web') }}/images/hiw1.webp">
                    </div>
                    <div class="col-lg-3">
                        <img src="{{ url('/assets-web') }}/images/hiw2.webp">
                    </div>
                    <div class="col-lg-3">
                        <img src="{{ url('/assets-web') }}/images/hiw3.webp">
                    </div>
                    <div class="col-lg-3">
                        <img src="{{ url('/assets-web') }}/images/hiw1.webp">
                    </div>
                </div>
            </div>
            <div class="text-center px-16 pt-6 mid_tex_inc">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
            </div>
        </section>
        <section class="pt-8 pb-8 " style="background-color:#c0a9bd;">
            <h2 class="fs-24 fs-sm-36 text-center mb-8 text-white" >
                Keep It Simple</h2>

            <div class="row px-10 pt-6">
                <div class="col-lg-1"></div>
                <div class="col-lg-2">
                    <div class="text-center mw-730 mx-auto">
                        <img src="{{ url('/assets-web') }}/images/kisimp.webp">
                    </div>
                    <div class="text-center pt-4">
                        <p  class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        </p>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="text-center mw-730 mx-auto">
                        <img src="{{ url('/assets-web') }}/images/kisimp.webp">
                    </div>
                    <div class="text-center pt-4">
                        <p  class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        </p>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="text-center mw-730 mx-auto">
                        <img src="{{ url('/assets-web') }}/images/kisimp.webp">
                    </div>
                    <div class="text-center pt-4">
                        <p  class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        </p>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="text-center mw-730 mx-auto">
                        <img src="{{ url('/assets-web') }}/images/kisimp.webp">
                    </div>
                    <div class="text-center pt-4">
                        <p  class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        </p>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="text-center mw-730 mx-auto">
                        <img src="{{ url('/assets-web') }}/images/kisimp.webp">
                    </div>
                    <div class="text-center pt-4">
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        </p>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>

        </section>
        <section class="pt-8 pb-6 colored_icons">
            <div class="container container-xl">
                <h2 class="fs-24 fs-sm-36 text-center mb-0">
                    NEVER RUN OUT OF YOUR FAVES <br>Auto-Replenish + Save
                </h2>
                <div class="text-center pt-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    </p>
                </div>
                <div class="slick-slider "
                    data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>

                    <?php if(isset($recommandedProducts) && !empty($recommandedProducts)){?>

                    <?php foreach($recommandedProducts as $recommand){?>

                    <div class="box px-1" data-animate="fadeInUp">
                        <div class="card border-0 product px-2">
                            <div class="position-relative">
                                <a href="javascript:;" class="d-block productdetail"
                                    data-id="<?= $recommand['PRODUCT_ID'] ?>">
                                    <img src="<?= $recommand['primaryImage'] ?>" alt="Product 01"
                                        class="card-img-top recomendations-img img-w30">
                                </a>
                                <div
                                    class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                    <div></div>
                                    <div class="content-change-vertical d-flex flex-column ml-auto">
                                        <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                            title="Add to wish list"
                                            class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                            data-productId="<?= $recommand['PRODUCT_ID'] ?>" data-type='single'>
                                            <i
                                                class="fal fa-star wish_<?= $recommand['PRODUCT_ID'] ?> <?= $recommand['wishlistFlag'] == '1' ? 'activeWish' : '' ?>"></i>
                                        </a>
                                        {{-- <a href="javascript:;" data-toggle="tooltip" data-placement="left" title="Quick view" ng-click="quickViewProductDetails(<?= $recommand['PRODUCT_ID'] ?>)" class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                             <span data-toggle="modal" data-target="#productQuickView">
                                            <i class=" icon fal fa-eye"></i>
                                             </span>
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                    <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                        data-type="single" data-id="<?= $recommand['PRODUCT_ID'] ?>" data-quantity='1'>+
                                        Quick Add</a>
                                </div>
                            </div>
                            <div class="card-body pt-4 px-0 pb-0">
                                <ul class="list-inline fs-12 d-flex mb-1">
                                    <li class="list-inline-item text-primary mr-0">
                                        <i class="fas fa-star"
                                            style="<?= $recommand['averageRating'] >= '1' ? 'color:black;' : 'color:gray;' ?>"></i>
                                    </li>
                                    <li class="list-inline-item text-primary mr-0">
                                        <i class="fas fa-star"
                                            style="<?= $recommand['averageRating'] >= '2' ? 'color:black;' : 'color:gray;' ?>"></i>
                                    </li>
                                    <li class="list-inline-item text-primary mr-0">
                                        <i class="fas fa-star"
                                            style="<?= $recommand['averageRating'] >= '3' ? 'color:black;' : 'color:gray;' ?>"></i>
                                    </li>
                                    <li class="list-inline-item text-primary mr-0">
                                        <i class="fas fa-star"
                                            style="<?= $recommand['averageRating'] >= '4' ? 'color:black;' : 'color:gray;' ?>"></i>
                                    </li>
                                    <li class="list-inline-item text-primary mr-0">
                                        <i class="fas fa-star"
                                            style="<?= $recommand['averageRating'] == '5' ? 'color:black;' : 'color:gray;' ?>"></i>
                                    </li>
                                </ul>
                                <div class="d-flex align-items-center mb-2 productdetail"
                                    data-id="<?= $recommand['PRODUCT_ID'] ?>">
                                    <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                        <a href="javascript:;"><?= $recommand['NAME'] ?></a>
                                    </h3>
                                    <p class="fs-15 text-primary mb-0 ml-auto">
                                        <span
                                            class="text-line-through text-body mr-1"></span>$<?= $recommand['UNIT_PRICE'] ?>
                                    </p>
                                </div>
                                <ul class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                    <?php
                                            $shades = $recommand['productShades'];
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





                            </div>
                        </div>
                    </div>

                    <?php }?>

                    <?php }?>

                </div>
                <div class="modal fade quick-view" id="product-recommendations-1" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-0">
                            <div class="modal-body p-0">
                                <button type="button"
                                    class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                    data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
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
                                                    <a href="product-detail.html">Hoodie with pouch pocket</a>
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
                                                <p class="text-primary mb-0 fs-14 lh-1 overflow-hidden pl-3">
                                                    <span class="pr-2">5.0</span><span
                                                        class="mr-2 border-right border-light-dark"></span><a
                                                        href="#">See 3 Reviews</a>
                                                </p>
                                            </div>
                                            <p class="mt-2 mb-6">Posuere in netus a eu varius adipiscing
                                                suspendisse elementum vitae tempor suspendisse ullamcorper
                                                aenean taciti morbi potenti.</p>
                                            <form>
                                                <div class="form-group shop-swatch-color shop-swatch-color-02 mb-6">
                                                    <label class="mb-2"><span
                                                            class="font-weight-500 text-primary mr-2">Color:</span>
                                                        <span class="var text-capitalize"></span></label>
                                                    <ul class="list-inline d-flex justify-content-start mb-0">
                                                        <li class="list-inline-item"><a href="#"
                                                                class="d-block swatches-item"
                                                                data-var="green-revitalizing" data-toggle="tooltip"
                                                                data-placement="top" title="Korma"
                                                                style="background-color: #903711;"> </a></li>
                                                        <li class="list-inline-item"><a href="#"
                                                                class="d-block swatches-item" data-var="black"
                                                                style="background-color: #000;"> </a></li>
                                                        <li class="list-inline-item"><a href="#"
                                                                class="d-block swatches-item"
                                                                data-var="green-revitalizing" data-toggle="tooltip"
                                                                data-placement="top" title="Alto"
                                                                style="background-color: #D8D8D8;"> </a></li>
                                                    </ul>
                                                    <input type="hidden" name="swatches-color"
                                                        class="swatches-select" value="min">
                                                </div>
                                                <div class="form-group shop-swatch swatch-size mb-7">
                                                    <label class="mb-2"><span
                                                            class="font-weight-500 text-primary mr-2">Select a
                                                            Size:</span>
                                                        <span class="var text-uppercase">S</span></label>
                                                    <ul class="list-inline d-flex">
                                                        <li class="list-inline-item mr-2 selected"><a href="#"
                                                                class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                data-var="xs">XS</a></li>
                                                        <li class="list-inline-item mr-2"><a href="#"
                                                                class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                data-var="s">S</a></li>
                                                        <li class="list-inline-item mr-2"><a href="#"
                                                                class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                data-var="M">M</a></li>
                                                        <li class="list-inline-item mr-2"><a href="#"
                                                                class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                data-var="L">L</a></li>
                                                        <li class="list-inline-item mr-2"><a href="#"
                                                                class="fs-12 swatches-item w-40px h-40px d-flex align-items-center justify-content-center rounded-circle border text-primary"
                                                                data-var="XL">XL</a></li>
                                                        <li class="list-inline-item mr-2"><a href="#"
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
                                                                value="1" required> <a href="#"
                                                                class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i
                                                                    class="far fa-plus"></i> </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-9 mb-6 mb-sm-0 px-2">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block text-capitalize">add to
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
            <div class="modal fade quick-view" id="productQuickView" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-0">
                        <div class="modal-body p-0">
                            <button type="button"
                                class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="fs-20"> <i class="fal fa-times"></i>
                                </span>
                            </button>
                            <div class="row no-gutters" id="quick_view_product_details">
                                <div class="col-sm-6">

                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel"
                                        data-interval="2000">
                                        <div class="carousel-inner">
                                            <div class="carousel-item @{{ $first == '1' ? 'active' : '' }}"
                                                ng-repeat="row in productImagesLoop">
                                                <img class="d-block w-100" style="height: 35rem"
                                                    src="@{{ row.downPath }}" alt="First slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls"
                                            role="button" data-slide="prev"> <span
                                                class="carousel-control-prev-icon" aria-hidden="true"></span> <span
                                                class="sr-only">Previous</span>
                                        </a> <a class="carousel-control-next" href="#carouselExampleControls"
                                            role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-6 primary-summary " style="padding: 20px;">
                                    <div class="d-flex align-items-center">
                                        <h2 class="fs-24 mb-0">@{{ QuickView_name }}</h2>
                                    </div>
                                    <div class="primary-summary-inner" style="max-height: 31rem;overflow: scroll;">
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
                                        <p class="mb-3" style="max-height: 150px; overflow: auto">
                                            @{{ short_description }}</p>

                                        <div style="margin-bottom: 0px;">
                                            <button class="accordion_inc shadeAccord-btn" data-id="1">1.
                                                Choose Shade</button>
                                            <div class="panel_inc" id="chooseShade_container_1">
                                                <div class="form-group shop-swatch-color shop-swatch-color-02 mb-1">
                                                    <!-- </label> -->
                                                    <img src="@{{ selectedShadeImg_p }}" alt="Product Image"
                                                        class="var text-capitalize quick_view_product_image "
                                                        ng-show="selectedShadeImg_p != ''"> <br> <label
                                                        class="mb-2"><span
                                                            class="font-weight-500 text-primary mr-2">Color:</span>
                                                        <span
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
                                                class="cursor-pointer">One-Time Purchase</label><br> <input
                                                type="radio" id="multiple-sub" name="subscriptioncheck"
                                                value="subscription"> <label for="multiple-sub"
                                                class="cursor-pointer">Subscription</label><br>
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
                                                                    class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10 close_learnmore_pop">
                                                                    <span aria-hidden="true" class="fs-20"><i
                                                                            class="fal fa-times"></i></span>
                                                                </button>
                                                                <div class="pop_content">

                                                                    <div class="row">

                                                                        <p class="col-lg-12">@{{ subscriptionDetails }}
                                                                        </p>
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
                                                <option value="" class="cursor-pointer">Choose an option
                                                </option>
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
        </section>
    </div>
    <div class="modal fade quick-view" id="productQuickView" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-0">
                <div class="modal-body p-0">
                    <button type="button" class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="fs-20">
                            <i class="fal fa-times"></i>
                        </span>
                    </button>
                    <div class="row no-gutters" id="quick_view_product_details">
                        <div class="col-sm-6">

                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2000">
                                <div class="carousel-inner" ng-show="productImagesLoop != ''">
                                    <div class="carousel-item @{{$first == '1' ? 'active' : ''}}" ng-repeat="row in productImagesLoop">
                                        <img class="d-block w-100" style="height:35rem" src="@{{row.downPath}}" alt="First slide">
                                    </div>
                                </div>
                                <div class="carousel-inner" ng-show="productImagesBundle != ''">
                                    <div class="carousel-item active" >
                                        <img class="d-block w-100" style="height:35rem" src="@{{productImagesBundle}}" alt="First slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-6 col-md-6 primary-summary " style="padding: 15px;">
                            <div class="d-flex align-items-center">
                                <h2 class="fs-24 mb-0">@{{ QuickView_name }}</h2>
                            </div>
                            <div class="primary-summary-inner" style="max-height: 31rem;overflow: scroll;">
                                <p class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-0 pt-1 pb-1" ng-show="category_name != ''">
                                    @{{ category_name }}, @{{ subCategory_name }}</p>
                                <p class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-0 pt-1 pb-1" ng-show="bundleProductNames != ''">
                                    @{{ bundleProductNames }}</p>
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
                                <p class="mb-3" style="max-height:150px;overflow:auto">@{{ short_description }}</p>

                                <div style="margin-bottom: 0px;" ng-if="displayCollectionProductShadesQuickView != ''">
                                    <button class="accordion_inc shadeAccord-btn" data-id="1">1. Choose Shade</button>
                                    <div class="panel_inc" id="chooseShade_container_1">
                                        <div class="form-group shop-swatch-color shop-swatch-color-02 mb-1">
                                            <!-- </label> -->
                                            <img src="@{{selectedShadeImg_p}}" alt="Product Image" class="var text-capitalize quick_view_product_image " ng-show="selectedShadeImg_p != ''">
                                            <br>
                                            <label class="mb-2"><span class="font-weight-500 text-primary mr-2">Color:</span>
                                                <span class="var text-capitalize btn-shade">@{{ selectedShadeName }}</span></label>
                                            <ul class="list-inline d-flex justify-content-start mb-0">
                                               <li class="list-inline-item" ng-repeat="row in displayCollectionProductShadesQuickView"
                                               ng-click="chooseProdShade(row.PRODUCT_SHADE_ID, row.SHADE_ID, row.PRODUCT_ID, row.SHADE_NAME, row.prodShadeImag_p, row.prodShadeImag_s)"
                                               title="@{{ row.SHADE_NAME }}">
                                                   <a href="javascript:;" class="d-block swatches-item" style="background-image: url('@{{ row.shadeprimaryImage }}'); background-repeat:no-repeat;background-position: center;"> </a>
                                               </li>

                                              </ul>

                                            <input type="hidden" id="shadeId" value="">
                                           <input type="hidden" id="prodShadeId" value="">
                                           <input type="hidden" id="shadeName" value="">
                                           <input type="hidden" id="productId" value="">
                                           <input type="hidden" id="shadeExistChk" value="@{{(displayCollectionProductShadesQuickView.length == 0 || displayCollectionProductShadesQuickView.length == undefined) ? 'false' : 'true'}}">


                                        </div>
                                        <a href="javascript:;" class="btn btn-primary" ng-click="confirmProductShade();">Continue</a>
                                    </div>
                                </div>

                                <div class="chooseShade-container" style="margin-bottom: 30px;" ng-if="displayCollectionBundleProductShadesQuickView != ''">
                                   <div id="shadeBundlechooser_container_@{{row.BUNDLE_LINE_ID}}" ng-repeat="row in displayCollectionBundleProductShadesQuickView">
                                       <button class="accordion_inc_prod_detail shadeAccord-btn" data-id="@{{row.BUNDLE_LINE_ID}}">@{{row.seqNo}}. Choose Shade Product @{{row.productName}}</button><!-- chooseShadeBtn -->
                                       <div class="panel_inc_prod_detail" id="chooseShade_container_@{{row.BUNDLE_LINE_ID}}">
                                           <div class="form-group shop-swatch-color shop-swatch-color-02 mb-6 widget-color">

                                               <img src="" alt="Product Image" class="var text-capitalize quick_view_product_image bundleLineShadeImg" id="bundleLineShadeImg_@{{row.BUNDLE_LINE_ID}}" style="display:none;">
                                               <br>

                                               <label class="mb-2">
                                                   <span class="font-weight-500 text-primary mr-2">Color:</span>
                                                   <span class="var text-capitalize" id="shadeName1_@{{row.BUNDLE_LINE_ID}}"></span>
                                               </label>
                                               <ul class="list-inline d-flex justify-content-start mb-0">
                                                   <li class="list-inline-item" class="list-inline-item" ng-repeat="list in row.productShades"
                                                   ng-click="chooseBundleProdShade(row.BUNDLE_LINE_ID, list.PRODUCT_SHADE_ID, list.SHADE_ID, list.PRODUCT_ID, list.SHADE_NAME, list.prodShadeImag_p, list.prodShadeImag_s)"
                                                   title="@{{list.SHADE_NAME}}">
                                                       <a href="javascript:;" class="d-block swatches-item shade_chooser@{{row.BUNDLE_LINE_ID}}" id="shadeAnchor_@{{list.PRODUCT_SHADE_ID}}" style="background-image: url('@{{list.shadeprimaryImage}}'); background-repeat:no-repeat;background-position: center;"> </a>
                                                   </li>

                                               </ul>

                                               <input type="hidden" id="shadeId_@{{row.BUNDLE_LINE_ID}}" value="">
                                               <input type="hidden" id="prodShadeId_@{{row.BUNDLE_LINE_ID}}" value="">
                                               <input type="hidden" id="shadeName_@{{row.BUNDLE_LINE_ID}}" value="">
                                               <input type="hidden" id="productId_@{{row.BUNDLE_LINE_ID}}" value="">
                                               <input type="hidden" id="shadeExistChk_@{{row.BUNDLE_LINE_ID}}" value="@{{(row.productShades.length == 0 || row.productShades.length == undefined) ? 'false' : 'true'}}">
                                           </div>
                                           <a href="javascript:;" class="btn btn-primary" ng-click="confirmBundleProductShade(@{{row.BUNDLE_LINE_ID}});">Continue</a>
                                       </div>
                                   </div>
                               </div>

                            <form>

                               <input type="radio" id="single-sub" name="subscriptioncheck" value="One-Time Purchase"
                                   checked>
                               <label for="single-sub" class="cursor-pointer">One-Time Purchase</label><br>

                               <input type="radio" id="multiple-sub" name="subscriptioncheck" value="subscription">
                               <label for="multiple-sub" class="cursor-pointer">Subscription</label><br>
                           </form>
                            <div class=" form-group mb-0 sub-form" style="display: none;">
                                <div class="d-flex align-items-center mb-1">
                                    <label class="text-primary fs-16 font-weight-bold mb-0" for="size">Subcription Option: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Click to see more Ingredients" class="text-right"> <span data-toggle="modal" data-target="#learnmore_pop">Learn More </span>
                                    </a>

                                    <div class="modal fade quick-view" id="learnmore_pop" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" style="max-width: 631px !important;">
                                            <div class="modal-content p-0">
                                                <div class="modal-body p-0">
                                                    <button type="button" class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10 close_learnmore_pop">
                                                        <span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
                                                    </button>
                                                    <div class="pop_content">

                                                        <div class="row">

                                                            <p class="col-lg-12">@{{ subscriptionDetails }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <select class="form-control w-100 cursor-pointer" id="subsOption" ng-model="subs_id" ng-change="fetchSubscriptionDetail();">
                                   <option value="" class="cursor-pointer">Choose an option</option>
                                   <option value="@{{row.ID}}" class="select-subsoptn" ng-repeat="row in subscriptionLov">@{{row.TITLE}}</option>
                               </select>
                            </div>
                            <form class="cart-roww">
                                <div class="row align-items-end no-gutters mx-n2 mb-1">
                                    <div class="col-sm-3 form-group px-2 mb-0">
                                        <label class="text-primary fs-16 font-weight-bold mb-1" for="number">Quantity: </label>

                                        <div class="input-group position-relative w-100">
                                           <a href="javascript:;"
                                               class="down position-absolute pos-fixed-left-center pl-2 z-index-2 addsubquantity">
                                               <i class="far fa-minus"></i>
                                           </a>

                                           <input name="number" type="number" id="quantity"
                                               class="form-control w-100 px-6 text-center input-quality bg-transparent text-primary quantityinput"
                                               value="1">

                                           <a href="javascript:;"
                                               class="up position-absolute pos-fixed-right-center pr-2 z-index-2 addsubquantity">
                                               <i class="far fa-plus"></i>
                                           </a>
                                       </div>

                                    </div>
                                    <div class="col-sm-8 mb-0 px-2">
                                        <button type="button"
                                           class="btn btn-primary btn-block text-capitalize quick-addto-cart"
                                           data-type="@{{productType}}"
                                           data-id="@{{QuickView_productId}}"
                                           data-quantity='1' data-subs='1'>Add to cart</button>
                                    </div>
                                </div>
                            </form>
                            <p class="text-primary lh-14375 mb-0 sub-line" style="display: none;">@{{ subscriptionNote1 }}</p>
                            <p class="text-primary lh-14375 mb-0 sub-below-line" style="display: none;">@{{ subscriptionNote2 }}</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</main>

<section>
   
<div class="container mt-5 custom">
  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets-web/images/about-us-01.jpg" class="d-block w-100" alt="Slide 1">
        <div class="overlay"></div>
        <div class="carousel-caption">
          <h5>Slide 1 Title</h5>
          <p>Slide 1 Description</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets-web/images/about-us-02.jpg" class="d-block w-100" alt="Slide 2">
        <div class="overlay"></div>
        <div class="carousel-caption">
          <h5>Slide 2 Title</h5>
          <p>Slide 2 Description</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets-web/images/about-us-03.jpg" class="d-block w-100" alt="Slide 3">
        <div class="overlay"></div>
        <div class="carousel-caption">
          <h5>Slide 3 Title</h5>
          <p>Slide 3 Description</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

</section>
<br>
@include('web.web-footer')
{{-- <script src="{{ url('/assets-web') }}/customjs/script_userhome.js?v={{time()}}"></script> --}}
<script src="{{ url('/assets-web') }}/customjs/script_subscription.js?v={{time()}}"></script>

<script>
    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        $("#content").css('padding-top','77px');
        // $("#details-header").removeClass('mt-15');
        // $("#details-header").addClass('mt-11');
    }
</script>
