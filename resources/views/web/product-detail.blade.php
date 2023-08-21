@include('web.web-header')
<?php $userId = session('userId'); ?>
<script>
    var site = '<?php echo session('
    site '); ?>';

    var bundleId = "";
    var productId = "<?php echo isset($productDetails['PRODUCT_ID']) ? $productDetails['PRODUCT_ID'] : ''; ?>";
    var baseurl = "<?php echo url('/assets-admin'); ?>";
    var cartId = "<?php echo session('cartId') ? session('cartId') : ''; ?>";

</script>
<style>
    .recent_viewed:hover {
        text-decoration: underline;
        text-decoration-color: #3d94b7;
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
        background-color: #3d94b7;
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
        color: #3d94b7;
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

    /* .list-inline-item {
        padding: 4px;
        width: 40px;
        height: 40px;
    } */

    /* .widget-color .item {
        width: 26px;
        height: 26px;
    }

     .widget-color .item:before {
       content: '';
        width: 29px;
        height: 27px;
        display: block;
        position: absolute;
        left: -1px;
        top: -1px;
        border-radius: 50%;
        opacity: 0;
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        transition: all .3s linear;
        border: unset;
        1px solid #000
        padding: 11px !important;
    }  */

    /* .shade-active:before {
        left: -1px !important;
        top: -1px !important;
    } */

    /* .shade-active {
        padding: 0px;
        border: 1px solid black;
        padding-bottom: 2vw;
        content: '';
        width: 26px !important;
        height: 26px !important;
        display: block;
        position: absolute;
        left: -4px;
        top: -4px;
        border-radius: 50%;
        opacity: 0;
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        transition: all .3s linear;
        border: 1px solid #000;

    }
    a.d-block.item.shade_chooser.shade-active>img{
        height: 26px;
        bottom: 2px;
    } */
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

    /* ::-webkit-scrollbar {
        width: 5px;
    }


    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }


    ::-webkit-scrollbar-thumb {
        background: #d5d5d5;
    }


    ::-webkit-scrollbar-thumb:hover {
        background: #909090;
    } */
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
    .uses_img{
		width: 100% !important;
    	height: 32rem;
	}

    @media only screen and (max-width: 480px) {
     	.uses_img{
			width: 100% !important;
	    	height: 25rem;
		}
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
<main id="content" ng-app="project1">
    <div class="" id="details-header" ng-controller="projectinfo1">
        <?php
		if(isset($productDetails) && !empty($productDetails)){
		$images = isset($productDetails['images']) ? $productDetails['images'] : '';
		?>

        <section class="pt-5 sec_inc_1">
            <div class="container container-custom container-xxl mt-5 mt-md-0 mt-xl-5 mt-xxl-5">
                <div class="row no-gutters">
                    <div class="col-md-6 col-xl-8 mb-8 mb-md-0 pr-xl-0 pr-md-3">
                        <div class="row no-gutters mx-n1">

                            <div class="col-sm-6 col-6 px-1 mb-2" ng-show="selectedShadeImg_p != ''"
                                style="display:none;">
                                <img src="@{{ selectedShadeImg_p }}" alt="Image"
                                    class="prod_img_detail img-w35 img-product-gall">
                            </div>
                            <div class="col-sm-6 col-6 px-1 mb-2" ng-show="selectedShadeImg_s != ''"
                                style="display:none;">
                                <img src="@{{ selectedShadeImg_s }}" alt="Image"
                                    class="prod_img_detail img-w35 img-product-gall">
                            </div>

                            <?php if(!empty($images)){?>
                            <?php foreach($images as $image){?>
                            <div class="col-sm-6 col-6 px-1 mb-2">
                                <img src="<?= $image['downPath'] ?>" alt="Image"
                                    class="prod_img_detail img-w35 img-product-gall">
                            </div>
                            <?php }?>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4 pl-xl-6 pl-md-3 primary-summary summary-sticky" id="summary-sticky">

                        <div class="primary-summary-inner">
                            <h2 class="mb-0 text-capitalize"><?= $productDetails['NAME'] ?></h2>
                            <p
                                class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-1 pt-4 pb-4">
                                <?= $productDetails['SUB_TITLE'] ?></p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-6">
                                            <p class="mb-1 fs">$<?= $productDetails['UNIT_PRICE'] ?></p>
                                        </div>
                                        <div class="col-sm-6 col-6">
                                            <p class="mb-1 fs text-right"><?= $productDetails['UNIT'] ?></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <p class="mb-3"><?= $productDetails['SHORT_DESCRIPTION'] ?></p>

                            <div class="chooseShade-container" style="margin-bottom: 30px;"
                                ng-if="displayCollectionProductShades.length != null || displayCollectionProductShades.length != undefined">
                                <button class="accordion_inc_prod_detail shadeAccord-btn" data-id="1" id="">1. Choose
                                    Shade</button><!-- chooseShadeBtn -->
                                <div class="panel_inc_prod_detail" id="chooseShade_container_1">
                                    <div class="form-group shop-swatch-color shop-swatch-color-02 mb-6 widget-color">
                                        <label class="mb-2">
                                            <span class="font-weight-500 text-primary mr-2">Color:</span>
                                            <span class="var text-capitalize">@{{ selectedShadeName }}</span>

                                        </label>
                                        <ul class="list-inline d-flex justify-content-start mb-0">
                                            <li class="list-inline-item"
                                                ng-repeat="row in displayCollectionProductShades"
                                                ng-click="chooseProdShade(row.PRODUCT_SHADE_ID, row.SHADE_ID, row.PRODUCT_ID, row.SHADE_NAME, row.prodShadeImag_p, row.prodShadeImag_s)"
                                                title="@{{ row.SHADE_NAME }}">
                                                <a href="javascript:;" class="d-block swatches-item"
                                                    style="background-image: url('@{{ row.shadeprimaryImage }}'); background-repeat:no-repeat;background-position: center;">
                                                </a>
                                            </li>

                                        </ul>
                                        {{-- <ul class="list-inline mb-0 d-flex align-items-center">

                                                <li class="list-inline-item"
                                                    ng-repeat="row in displayCollectionProductShades"
                                                    ng-click="chooseProdShade(row.PRODUCT_SHADE_ID, row.SHADE_ID, row.PRODUCT_ID, row.SHADE_NAME, row.prodShadeImag_p, row.prodShadeImag_s)"
                                                    title="@{{ row.SHADE_NAME }}">
                                        <a href="javascript:;" class="d-block item shade_chooser">
                                            <img class="item" src="@{{ row.shadeprimaryImage }}" alt="alt">
                                        </a>
                                        </li>

                                        </ul> --}}
                                        {{-- <ul class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">

                                            <li class="list-inline-item mr-2 mt-2"
                                                ng-repeat="row in displayCollectionProductShades"
                                                ng-click="chooseProdShade(row.PRODUCT_SHADE_ID, row.SHADE_ID, row.PRODUCT_ID, row.SHADE_NAME, row.prodShadeImag_p, row.prodShadeImag_s)"
                                                title="@{{ row.SHADE_NAME }}">
                                        <a href="javascript:;" class="d-block item shade_chooser">
                                            <img class="item" src="@{{ row.shadeprimaryImage }}" alt="alt"
                                                style="width:1vw;">
                                        </a>
                                        </li>

                                        </ul> --}}
                                        <input type="hidden" id="shadeId" value="">
                                        <input type="hidden" id="prodShadeId" value="">
                                        <input type="hidden" id="shadeName" value="">
                                        <input type="hidden" id="productId" value="">
                                        <input type="hidden" id="shadeExistChk"
                                            value="@{{ (displayCollectionProductShades.length == 0 || displayCollectionProductShades.length == undefined) ? 'false' : 'true' }}">
                                    </div>
                                    <a href="javascript:;" class="btn btn-primary"
                                        ng-click="confirmProductShade();">Continue</a>
                                </div>
                            </div>

                            <form>

                                <input type="radio" id="single-sub" name="subscriptioncheck" value="One-Time Purchase"
                                    checked>
                                <label for="single-sub" class="cursor-pointer">One-Time Purchase</label><br>

                                <input type="radio" id="multiple-sub" name="subscriptioncheck" value="subscription">
                                <label for="multiple-sub" class="cursor-pointer">Subscription</label><br>


                            </form>
                            <div class=" form-group mb-7 sub-form" style="display: none;">
                                <div class="d-flex align-items-center mb-3">
                                    <label class="text-primary fs-16 font-weight-bold mb-0 " for="size">Subcription
                                        Option: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                        title="Click to see more" class="text-right">
                                        <span ng-click="showSubscrptionDetailModal();">Learn More </span>
                                        <!-- data-toggle="modal" data-target="#learnmore_pop" -->
                                    </a>


                                </div>
                                <select class="form-control w-100 cursor-pointer" id="subsOption" ng-model="subs_id"
                                    ng-change="fetchSubscriptionDetail();">
                                    <option value="" class="cursor-pointer">Choose an option</option>
                                    <option value="@{{ row.ID }}" class="select-subsoptn"
                                        ng-repeat="row in subscriptionLov">@{{ row.TITLE }}</option>
                                </select>
                            </div>
                            <form class="cart-roww">
                                <div class="row align-items-end no-gutters mx-n2">
                                    <?php if( $productDetails['INV_QUANTITY'] > 0){?>
                                    <div class="col-sm-4 form-group px-2 mb-6">
                                        <label class="text-primary fs-19-qua font-weight-bold mb-3"
                                            for="number">Quantity: </label>

                                        <div class="input-group position-relative w-100">
                                            <a href="javascript:;"
                                                class="down position-absolute pos-fixed-left-center pl-2 z-index-2 addsubquantity">
                                                <i class="far fa-minus"></i>
                                            </a>

                                            <input name="number" type="number" id="quantity"
                                                class="form-control w-100 px-6 text-center input-quality bg-transparent text-primary quantityinput"
                                                value="1" min="1" max="<?php echo $productDetails['INV_QUANTITY']; ?>">

                                            <a href="javascript:;"
                                                class="up position-absolute pos-fixed-right-center pr-2 z-index-2 addsubquantity">
                                                <i class="far fa-plus"></i>
                                            </a>
                                        </div>

                                    </div>
                                    <?php }?>
                                    <div
                                        class="col-sm-{{ ($productDetails['INV_QUANTITY'] <= 0) ? '12' : '8' }} mb-6 px-2">

                                        <?php if($productDetails['INV_QUANTITY_FLAG'] == 'shade'){
                                            if($productDetails['INV_QUANTITY'] > 0){
                                            ?>
                                        <button type="button"
                                            class="btn btn-primary btn-block text-capitalize addto-cart"
                                            data-type="single"
                                            data-id="<?= isset($productDetails['PRODUCT_ID']) ? $productDetails['PRODUCT_ID'] : '' ?>"
                                            data-quantity='1' data-subs='1'>Add to cart</button>

                                        <?php }
                                        else{
                                            echo'<button type="button"
	                                            class="btn btn-primary btn-block text-capitalize" disabled>Out of Stock</button>';
                                        }
                                    }else if($productDetails['INV_QUANTITY_FLAG'] == 'inv' && $productDetails['INV_QUANTITY'] > 0){?>

                                        <button type="button"
                                            class="btn btn-primary btn-block text-capitalize addto-cart"
                                            data-type="single"
                                            data-id="<?= isset($productDetails['PRODUCT_ID']) ? $productDetails['PRODUCT_ID'] : '' ?>"
                                            data-quantity='1' data-subs='1'>Add to cart</button>

                                        <?php }else if($productDetails['INV_QUANTITY_FLAG'] == 'inv' && $productDetails['INV_QUANTITY'] <= 0){?>

                                        <button type="button" class="btn btn-primary btn-block text-capitalize"
                                            disabled>Out of Stock</button>

                                        <?php }?>

                                    </div>
                                </div>
                            </form>

                            <p class="mb-0 sub-line" style="display: none;">
                                @{{ subscriptionNote1 }}</p>
                            <p class="mb-0 sub-below-line" style="display: none;">
                                @{{ subscriptionNote2 }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if(isset($features) && !empty($features)){?>
        <section class="pb-11 pb-lg-6">
            <div class="container container-custom container-xxl mt-8">
                <h2 class="text-center my-4">Features</h2>
                <div class="slick-slider " data-slick-options='{"slidesToShow": 5,"pauseOnHover":true, "autoplay":true,"infinite": true,"dots":false,"arrows":false,"responsive":[
                        {"breakpoint": 1400,"settings": {"slidesToShow": 5}},
                        {"breakpoint": 1200,"settings": {"slidesToShow": 3}},
                        {"breakpoint": 992,"settings": {"slidesToShow": 2}},
                        {"breakpoint": 768,"settings": {"slidesToShow": 1}},
                        {"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>

                    <?php foreach ($features as $row){?>

                    <div class="box px-1" data-animate="fadeInUp">
                        <div class="ag-courses_item">
                            <a href="#!" class="ag-courses-item_link">
                                <div class="ag-courses-item_bg"></div>

                                <div class="ag-courses-item_title">
                                    <li class="product-hero__icons__item d-flex aic">
                                        <div class="product-hero__icons__image relative">
                                            <div class="img fit-contain is-loaded pos-center">

                                                <div class="skeleton"></div>
                                                <img width="70" height="70" src="{{ $row['IMAGE_DOWN_PATH'] }}"
                                                    srcset="{{ $row['IMAGE_DOWN_PATH'] }}" alt="Clean" title="Clean"
                                                    data-fit="contain" class="img__el">
                                            </div>
                                        </div>
                                        <span class="product-hero__icons__text">{{ ucfirst($row['TITLE']) }}</span>
                                    </li>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <?php  } ?>
        <section class="pb-11 pb-lg-6">
            <div class="container container-custom container-xxl">
                <div class="collapse-tabs">
                    <ul class="nav nav-pills d-md-flex d-block border-bottom" style="display: none !important;"
                        id="pills-tab" role="tablist">
                        <li class="nav-item"><a
                                class="nav-link active show font-weight-600 px-0 pb-3 mr-md-10 mr-4 text-active-primary border-active-primary bg-transparent rounded-0 lh-14375"
                                id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab"
                                aria-controls="pills-description" aria-selected="false">Tab 1</a></li>
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
                                                aria-expanded="true" aria-controls="description-collapse-01"> Tab
                                                1</button>
                                        </h5>
                                    </div>
                                    <div id="description-collapse-01" class="collapsible collapse show"
                                        aria-labelledby="headingDetails-01" data-parent="#collapse-tabs-accordion-01"
                                        style="">
                                        <div id="accordion-style-01"
                                            class="accordion accordion-01 border-md-0 border p-md-0">
                                            <div class="card-body p-0">
                                                <div class="row " style="">
                                                    <h2 class="col-12 mb-2 pb-8 text-center text-capitalize"
                                                        style="margin: 0 auto;">About Product<?php //echo $productDetails['SUB_TITLE'] ?>
                                                    </h2>
                                                    <div class="col-md-6 mb-6 mb-md-0">
                                                        <?php if(isset($images[0]['downPath'])){?>
                                                        <img src="<?= $images[0]['downPath'] ?>" alt="Image"
                                                            class="prod_img_detail_acc fadeInLeft animated img1-section2 img-w35">
                                                        <?php }?>
                                                        <?php if(isset($images[1]['downPath'])){?>
                                                        <img src="<?= $images[1]['downPath'] ?>" alt="Image"
                                                            class="prod_img_detail_acc_sec fadeInLeft animated img2-section2 img-w20">
                                                        <?php }?>

                                                    </div>
                                                    <div class="col-md-6 pro-details"
                                                        style="height: 32rem;overflow-y:auto">
                                                        <h2 class="mb-2 text-capitalize">
                                                            <?= $productDetails['DESCRIPTION_TITLE'] ?></h2>
                                                        <p><?= $productDetails['DESCRIPTION'] ?></p>
                                                    </div>
                                                </div>
                                                <br>
                                                <hr>

                                                <div class="row pt-10 align-items-center subsc_ec">
                                                    <div class="col-md-6 ">
                                                        <h2 class="mb-2">
                                                            {{ $productDetails['SUBSCRIPTION_NOTE_TITLE'] }}</h2>
                                                        <p class="mb-6">
                                                            {{ $productDetails['SUBSCRIPTION_NOTE_DESCRIPTION'] }}</p>

                                                        <a href="javascript:;" data-link="<?php echo $productDetails['SUBSCRIPTION_NOTE_LINK'];?>"
                                                            data-toggle="tooltip" data-placement="left"
                                                            title="Click to see more Ingredients"
                                                            class="preview btn btn-primary subscrReadMoreLink"> <span>Read More</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6 mb-6 mb-md-0">
                                                        <img src="{{ $productDetails['SUBSCRIPTION_NOTE_IMAGE']->DOWN_PATH ?? '' }}                                                        "
                                                            alt="The Iconic Silhouette "
                                                            class="fadeInRight animated subs_img">

                                                    </div>
                                                </div>
                                                <br>
                                                <hr>
                                                <section class="pt-10 pt-lg-8 py-5">
                                                    <div class="">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col-md-8 mb-8 mb-md-0">
                                                                <div class="fix">
                                                                    <div class=" hover-zoom-in">
                                                                        <?php
                                                                            if(isset($productDetails['videoDetails']['V_3'])){?>
                                                                        <video
                                                                            src="<?= isset($productDetails['videoDetails']['V_3']) ? $productDetails['videoDetails']['V_3'] : '' ?>"
                                                                            alt="Video background"
                                                                            class="card-img"></video>
                                                                        <?php }else{?>
                                                                        <img class="card-img_if"
                                                                            src="{{ url('assets-web') }}/images/img-video.jpg"
                                                                            alt="">
                                                                        <?php }?>
                                                                        <div
                                                                            class="card-img-overlay d-flex flex-column align-items-center justify-content-center p-4">
                                                                            <a href="<?= isset($productDetails['videoDetails']['V_3']) ? $productDetails['videoDetails']['V_3'] : '' ?>"
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
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 pl-xl-7 pl-7"
                                                                style="height:30rem;overflow-y:auto">
                                                                <h2 class="mb-2 text-capitalize">
                                                                    <?= isset($productDetails['videoDetails']['V_1']) ? $productDetails['videoDetails']['V_1'] : '' ?>
                                                                </h2>
                                                                <p><?= isset($productDetails['videoDetails']['V_2']) ? $productDetails['videoDetails']['V_2'] : '' ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <br>
                                                <hr>
                                                <section class="pb-10 pb-lg-0 mob_tab_sec">
                                                    <div class="">
                                                        <h2 class="text-center mb-3">Ingredients</h2>
                                                        <h4 class="text-center mb-3" style="font-size: 23px;">Backed by
                                                            Science to Optimize
                                                            Skin Wellness</h4>
                                                        <ul class="nav nav-pills justify-content-center mb-lg-9 mb-6">
                                                            <li class="nav-item px-5"><a
                                                                    class="pointer nav-link cursor-pointer ingredientTabBtn active text-gray-02 rounded-0 px-0 py-1 lh-1  bg-transparent text-active-primary border-active-primary font-weight-300 font-weight-active-400"
                                                                    id="spotlightTabBtn"
                                                                    style="font-size: 23px;">Spotlight Ingredients</a>
                                                            </li>
                                                            <li class="nav-item px-5"><a
                                                                    class="pointer nav-link cursor-pointer ingredientTabBtn text-gray-02 rounded-0 px-0 py-1 lh-1 bg-transparent text-active-primary border-active-primary font-weight-300 font-weight-active-400"
                                                                    id="formulatedTabBtn"
                                                                    style="font-size: 23px;">Formulated Ingredients</a>
                                                            </li>
                                                        </ul>
                                                        <div class="p-0 m-0" id="pills-tabContent">
                                                            <div class="tabbspotlight" id="tabbspotlight">
                                                                <section class="pb-11 pb-lg-0" id="">
                                                                    <div
                                                                        class="container container-custom container-xxl">
                                                                        <div class="row">
                                                                            <?php if(isset($spotlightIngredients) && !empty($spotlightIngredients)){?>
                                                                            <?php foreach ($spotlightIngredients as $row){?>
                                                                            <div class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section"
                                                                                style="background-color:#94b73d">
                                                                                <img class="spot-section-img"
                                                                                    src="<?= isset($row['image']['downPath']) ? $row['image']['downPath'] : url('assets-web') . '/images/cannabis-ingredient.webp' ?>">
                                                                                <p
                                                                                    class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                    <?= $row['INGREDIENT_NAME'] ?></p>
                                                                                <p> <?= $row['DESCRIPTION_TEXT'] ?></p>

                                                                            </div>
                                                                            <?php }?>
                                                                            <?php }else{?>
                                                                            <div class="col-sm-12 col-lg-12">
                                                                                <p class="text-center">No record
                                                                                    found...</p>
                                                                            </div>
                                                                            <?php }?>


                                                                            <div
                                                                                class="col-sm-12 ing_btn_prod_detail pt-4 text-center">
                                                                                <a href="javascript:;"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="left"
                                                                                    title="Click to see more Ingredients"
                                                                                    class="preview btn btn-primary">
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
                                                                style="display: none;">
                                                                <section class="pb-11 pb-lg-0" id="">
                                                                    <div
                                                                        class="container container-custom container-xxl">
                                                                        <div class="row">

                                                                            <?php if(isset($formulatedIngredients) && !empty($formulatedIngredients)){?>
                                                                            <?php foreach ($formulatedIngredients as $row){?>
                                                                            <div
                                                                                class="col-sm-6 col-lg-3 mb-6 mb-lg-0 ing_sec_inc_prod_detail pt-5 pb-5 spot-section"  style="background-color:#94b73d">
                                                                                <img class="spot-section-img"
                                                                                    src="<?= isset($row['image']['downPath']) ? $row['image']['downPath'] : url('assets-web') . '/images/cannabis-ingredient.webp' ?>">
                                                                                <p
                                                                                    class="text-primary font-weight-500 lh-14375 mb-3 pt-4 ">
                                                                                    <?= $row['INGREDIENT_NAME'] ?></p>
                                                                                <?= $row['DESCRIPTION_TEXT'] ?>

                                                                            </div>
                                                                            <?php }?>
                                                                            <?php }else{?>
                                                                            <div class="col-sm-12 col-lg-12">
                                                                                <p class="text-center">No record
                                                                                    found...</p>
                                                                            </div>
                                                                            <?php }?>

                                                                            <div
                                                                                class="col-sm-12 ing_btn_prod_detail pt-4 text-center">
                                                                                <a href="javascript:;"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="left"
                                                                                    title="Click to see more Ingredients"
                                                                                    class="preview btn btn-primary">
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
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true"
                                                                                    class="fs-20"><i
                                                                                        class="fal fa-times"></i></span>
                                                                            </button>
                                                                            <div class="pop_content_prod_detail">
                                                                                <h3>Full List of ingredients</h3>
                                                                                <hr>
                                                                                <div class="row">

                                                                                    <?php if(isset($allIngredients) && !empty(isset($allIngredients))){?>

                                                                                    <p class="col-lg-12">

                                                                                        <?php for ($i=0; $i<count($allIngredients); $i++){?>
                                                                                        <?php
                                                                                        if (isset($allIngredients[$i + 1]['INGREDIENT_NAME'])) {
                                                                                            echo $allIngredients[$i]['INGREDIENT_NAME'] . ',';
                                                                                        } else {
                                                                                            echo $allIngredients[$i]['INGREDIENT_NAME'];
                                                                                        }
                                                                                        ?>
                                                                                        <?php }?>
                                                                                    </p>
                                                                                    <?php }else{?>
                                                                                    <p class="col-lg-12 text-center">No
                                                                                        record found...</p>

                                                                                    <?php }?>


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
                                                            <h2 class="text-center mb-9" style="color: #fff;">How To
                                                                Use: AM and PM</h2>
                                                            <div class="row">
                                                                <?php $i=1 ?>
                                                                <?php if(isset($productUses) && !empty($productUses)){?>
                                                                <?php foreach ($productUses as $row){ ?>
                                                                <div
                                                                    class="col-md-4 mb-6 mb-md-0 <?php //echo $i == '2' ? 'pt-14 step_2' : '' ?>">
                                                                    <div class="card border-0">
                                                                        <?php if(isset($productDetails['CATEGORY_NAME'])){
                                                                        	$catName = $productDetails['CATEGORY_NAME'];
                                                                        	?>

                                                                        <?php if($catName == 'Nutrition' || $catName == 'Nutritions' ||
                                                                        			$catName == 'MakeUp' || $catName == 'Make Up'){?>

                                                                        	<?php }else{?>
                                                                        		<img src="<?= $row['DOWN_PATH'] != '' ? $row['DOWN_PATH'] : url('assets-web') . '/images/how-to-step-1.webp' ?>"
                                                                            		alt="Image" class="card-img h_to_use_img uses_img">
                                                                        <?php }}?>


                                                                        <div
                                                                            class="card-body pt-6 px-0 pb-0 text-center">
                                                                            <a href="#"
                                                                                class="fs-18 font-weight-500 lh-1444"><?= $row['USES_TITLE'] ?></a>
                                                                            <p class="mb-6">
                                                                                <?= $row['USES_DESCRIPTION'] ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php ++$i ?>
                                                                <?php }?>
                                                                <?php }else{?>
                                                                <div class="col-12">
                                                                    <p class="text-center" style="color: #fff;">No
                                                                        record found...</p>
                                                                </div>
                                                                <?php }?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>

                                                <section class="pt-10 pt-lg-8">
                                                    <div class="">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col-md-5 mb-8 mb-md-0 hover-zoom-in">
                                                                <?php if(isset($productDetails['clinicalImage'][0]['downPath'])){?>

                                                                <img class="clinical-note"
                                                                    src="<?= $productDetails['clinicalImage'][0]['downPath'] ?>"
                                                                    alt="Clinical Note">

                                                                <?php }else{?>

                                                                <img class="clinical-note"
                                                                    src="{{ url('assets-web') }}/images/img-video.jpg"
                                                                    alt="Clinical Note">

                                                                <?php }?>
                                                            </div>
                                                            <div class="col-md-7 px-6 px-md-0 pl-xl-7"
                                                                style="height:37rem;overflow-y:auto">
                                                                <h2 class="mb-2">Lutie's Hint</h2>
                                                                <p><?= $productDetails['CLINICAL_NOTE'] ?></p>
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

        <section class="py-6 py-lg-6 insta_sec_home">
            <div class="container container-custom container-xl">
                <h2 class="mb-3 text-center text-capitalize">Snap a selfi</h2>
                <p class="text-center mb-3 mx-auto">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad odit est aspernatur quaerat a tempore?
                    Obcaecati voluptatem pariatur ab dolor laborum, a incidunt quisquam illo accusantium alias hic
                    molestiae eius quasi, fugit expedita ut minus, delectus animi vero magnam accusamus numquam ipsum
                    atque. Fugiat hic,
                </p>
                <div class="text-center mb-9">
                    <a href="javascript:;" class="preview btn btn-primary" data-toggle="modal"
                        data-target="#productselfi">
                        <span>Take a Selfi</span>
                    </a>
                </div>
                <?php if(isset($productselfi) && !empty($productselfi)){?>
                <div class="slick-slider slick-sliderproductselfi" id="instaFeed_html"
                data-slick-options='{"slidesToShow": 4,"pauseOnHover":true, "autoplay":true,"infinite": true,"dots":true,"arrows":false,"responsive":[
                    {"breakpoint": 1400,"settings": {"slidesToShow": 4}},
                    {"breakpoint": 1200,"settings": {"slidesToShow": 3}},
                    {"breakpoint": 992,"settings": {"slidesToShow": 2}},
                    {"breakpoint": 768,"settings": {"slidesToShow": 1}},
                    {"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>


                    <?php foreach($productselfi as $productSelfiByProductID){
                        $selfiimages = $productSelfiByProductID['SElFIBYID'];
                    ?>
                    <?php if(isset($selfiimages) && !empty($selfiimages)){?>
                    <?php foreach($selfiimages as $selfiimage){ ?>

                    <?php
                                $img_ext = strtolower($selfiimage['FILE_TYPE']);
                            ?>


                    <?php if($img_ext == 'jpg' || $img_ext == 'png' || $img_ext == 'webp' || $img_ext == 'jpeg'){?>
                    <div class="box px-1" data-animate="fadeInUp">
                        <a href="" class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">
                            <img src="<?= isset($selfiimage['DOWN_PATH']) ? $selfiimage['DOWN_PATH'] :'' ?>" alt=""
                                class="card-img insta-secc-home">
                        </a>
                    </div>
                    <?php }else{ ?>
                    <div class="box px-1" data-animate="fadeInUp">
                        <a target="_blank" href="<?= isset($selfiimage['DOWN_PATH']) ? $selfiimage['DOWN_PATH'] :'' ?>"
                            class="card hover-zoom-in d-block border-0 hover-change-content insta-secc-home">

                            <video width="400" height="300" controls>
                                <source src="<?= isset($selfiimage['DOWN_PATH']) ? $selfiimage['DOWN_PATH'] :'' ?>"
                                    type="video/mp4">
                                <source src="<?= isset($selfiimage['DOWN_PATH']) ? $selfiimage['DOWN_PATH'] :'' ?>"
                                    type="video/ogg">

                            </video>
                            <div
                                class="card-img-overlay d-flex align-items-center justify-content-center content-change">
                                <span
                                    class="d-inline-flex align-items-center justify-content-center w-50px h-50px bg-white text-primary rounded-circle fs-24 content-change"
                                    style="position: absolute; top: 25%;">
                                    <i class="fa fa-play"></i>
                                </span>

                            </div>
                        </a>
                    </div>

                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                    <?php }?>
                </div>

                <?php }else{?>
                <p class="text-center">No Selfi Added....</p>
                <?php }?>

            </div>

            <div class="modal fade selfi-view" id="productselfi" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-0">
                        <div class="modal-header">
                            <h5 class="modal-title">Snap A selfie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">
                            {{-- <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1" style="text-align: center">
                                    <img src="{{ url('/assets-web') }}/images/default-selfi.jpg"
                            onclick="showfileload()" id="hung221" alt="" class="selfi-img" style="">
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 mb-1" style="text-align: center">
                            <img src="" id="hung22" alt="" onclick="showfileload()" class="selfi-img"
                                style="display:none;">
                        </div>

                    </div> --}}

                    {{-- <form action="{{ route('saveProductSelfie') }}" method="POST" id="saveProductSelfie"> --}}
                    <div ng-show="selfi.ID == ''">
                        <label style=" display: block !important;text-align:left;">Enter your name</label>
                        <input type="text" id="name" name="name" ng-model="selfi['name']" class="form-control mb-3"
                            placeholder="Name">

                        <label style=" display: block;text-align:left;">Enter your email</label>
                        <input name="email" type="email" ng-model="selfi['email']" id="email" name="email"
                            class="form-control mb-3" placeholder="Email">
                    </div>


                    {{-- <input name="file" onchange="loadFile(event)" type="file" class="form-control mb-3" placeholder="UPLOAD YOUR SELFIE" id="selfie_img" required="">
                                     --}}
                    <div class="row register-new-product-picture-para" ng-show="selfi.ID  != ''">
                        <div class="col-1"></div>
                        <div class="col-sm-3 image-overlay upload-photo-box" id="imageAttach-btn" onclick="form2();"
                            style="">
                            <img src="{{ url('/assets-admin') }}/images/admin/upload.svg" alt="" width="50">
                            <p>Upload Image/Video</p>
                        </div>
                        <div class="col-sm-7">
                            <div class="row" id="p_att">

                            </div>
                        </div>

                        <form class="" id="uploadattch6" method="POST" action="{{url('/uploadProductImageVideoSelfi')}}"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="sourceId" name="sourceId" value="@{{ selfi.ID }}">
                            <input type="file" id="uploadatt6" name="uploadatt6" class="file-input" multiple
                                style="display: none;">
                        </form>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block savebtn" ng-show="selfi.ID == ''"
                        ng-click="submitProductSelfi();">Submit</button>
                    <button type="submit" class="btn btn-primary btn-block savebtn" ng-show="selfi.ID != ''"
                        ng-click="closeProductSelfi();">Submit</button>
                    <button type="button" class="btn btn-primary btn-block loaderbtn" disabled style="display: none"><i
                            class="ft-rotate-cw spinner"></i> Processing</button>

                    {{-- </form> --}}


                </div>
            </div>
    </div>
    </div>
    </section>
    <section class="pb-5 pb-lg-5">
        <div class="container container-custom container-xxl">
            <ul class="nav nav-pills justify-content-center mb-lg-9 mb-6" role="tablist">
                <li class="nav-item px-5">
                    <a class="cursor-pointer nav-link revque_btn active text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary border-active-primary font-weight-300 font-weight-active-400"
                        id="pillsReviewsTab">Ratings and Reviews</a>
                </li>
                <li class="nav-item px-5"><a
                        class="cursor-pointer nav-link revque_btn text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary border-active-primary font-weight-300 font-weight-active-400"
                        id="pillsQuestionsTab">Questions</a></li>
            </ul>
            <div class=" rating-cont-prod-detail" id="">
                <div class="row">
                    <div class="col-3 d-none d-md-block d-lg-block d-xl-block d-xxl-block"></div>
                    <div class="col-3 review_sec">
                        <div class="border-right" style="">
                            <h2 class="text-center">@{{ averageRating }}</h2>
                            <ul class="list-inline mb-4 d-flex justify-content-center rating-result">
                                <li class="list-inline-item fs-18 text-primary">
                                    <i class="fas fa-star"
                                        style="color: @{{ averageRatingRound >= '1' ? 'black' : 'gray' }};"></i>
                                </li>
                                <li class="list-inline-item fs-18 text-primary">
                                    <i class="fas fa-star"
                                        style="color: @{{ averageRatingRound >= '2' ? 'black' : 'gray' }};"></i>
                                </li>
                                <li class="list-inline-item fs-18 text-primary">
                                    <i class="fas fa-star"
                                        style="color: @{{ averageRatingRound >= '3' ? 'black' : 'gray' }};"></i>
                                </li>
                                <li class="list-inline-item fs-18 text-primary">
                                    <i class="fas fa-star"
                                        style="color: @{{ averageRatingRound >= '4' ? 'black' : 'gray' }};"></i>
                                </li>
                                <li class="list-inline-item fs-18 text-primary">
                                    <i class="fas fa-star"
                                        style="color: @{{ averageRatingRound >= '5' ? 'black' : 'gray' }};"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0 fs-15 text-primary lh-1">
                                <span class="d-inline-block border-right pr-1 mr-1">5.0</span>See
                                @{{ ratingfive }} Reviews
                            </p>
                        </div>
                        <div class="mt-6 mt-md-10">
                            <a href="javascript:;" class="btn btn-outline-primary rev-btnns" id="writeReview_btn">Write
                                a Review</a>
                            <!-- 						<p class="rev-bottomtext">20 Rewards Points On Review</p> -->
                        </div>
                    </div>

                    <div class="col-3 question_sec">
                        <div class="row" style="">
                            <div class="side">
                                <div>5 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-5" style="width:@{{ fiveRatingPercent }}%;"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>@{{ ratingfive }}</div>
                            </div>
                            <div class="side">
                                <div>4 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-4" style="width:@{{ fourRatingPercent }}%;"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>@{{ ratingfour }}</div>
                            </div>
                            <div class="side">
                                <div>3 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-3" style="width:@{{ threeRatingPercent }}%;"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>@{{ ratingthree }}</div>
                            </div>
                            <div class="side">
                                <div>2 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-2" style="width:@{{ twoRatingPercent }}%;"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>@{{ ratingtwo }}</div>
                            </div>
                            <div class="side">
                                <div>1 star</div>
                            </div>
                            <div class="middle">
                                <div class="bar-container">
                                    <div class="bar-1" style="width:@{{ oneRatingPercent }}%;"></div>
                                </div>
                            </div>
                            <div class="side right">
                                <div>@{{ ratingone }}</div>
                            </div>
                        </div>

                        <div class=" mt-6 mt-md-9 mt-786-100">
                            <a href="javascript:;" class="btn btn-outline-primary rev-btnns"
                                id="writeQuestion_btn">Write Your Question</a>
                        </div>
                    </div>
                    <div class="col-3 d-none d-md-block d-lg-block d-xl-block d-xxl-block"></div>
                </div>

            </div>
            <div class="p-0 m-0" id="">
                <div class="" id="pillsReviews_container">
                    <div class="card border-0 mt-9 form-revieww mw-900 mx-auto" id="writeReview_container"
                        style="display: none;">
                        <div class="card-body p-0">
                            <h2 class="text-center mb-9">Write A Review</h2>
                            <form>
                                <div class="d-flex flex-wrap">
                                    <p class="text-primary font-weight-bold mb-0 mr-2 mb-2">Score:</p>
                                    <div class="form-group mb-6 d-flex justify-content-start">
                                        <div class="rate-input">

                                            <input type="radio" id="star5" name="rate" value="5">
                                            <label for="star5" title="text" class="mb-0 mr-1 lh-1">
                                                <i class="icon fal fa-star"></i>
                                            </label>

                                            <input type="radio" id="star4" name="rate" value="4">
                                            <label for="star4" title="text" class="mb-0 mr-1 lh-1">
                                                <i class="icon fal fa-star"></i>
                                            </label>

                                            <input type="radio" id="star3" name="rate" value="3">
                                            <label for="star3" title="text" class="mb-0 mr-1 lh-1">
                                                <i class="icon fal fa-star"></i>
                                            </label>

                                            <input type="radio" id="star2" name="rate" value="2">
                                            <label for="star2" title="text" class="mb-0 mr-1 lh-1">
                                                <i class="icon fal fa-star"></i>
                                            </label>

                                            <input type="radio" id="star1" name="rate" value="1">
                                            <label for="star1" title="text" class="mb-0 mr-1 lh-1">
                                                <i class="icon fal fa-star"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-8">
                                            <input placeholder="Title:*" class="form-control" type="text"
                                                ng-model="review['R_2']">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mb-8">
                                            <textarea class="form-control" placeholder="Your Review" rows="5"
                                                ng-model="review['R_3']"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>What are your top skin concerns? (Optional)</label>
                                        <div class="form-group mb-6">

                                            <input type="radio" id="skin1" name="skin" value="Acne & Blemish">
                                            <label for="skin1">Acne & Blemish</label><br>

                                            <input type="radio" id="skin2" name="skin" value="Acne & Blemish">
                                            <label for="skin2"> Acne & Blemish</label><br>

                                            <input type="radio" id="skin3" name="skin" value="Acne & Blemish">
                                            <label for="skin3"> Acne & Blemish</label><br>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>What are your top skin concerns? (Optional)</label>
                                        <div class="form-group mb-6">

                                            <input type="radio" id="climate1" name="climate" value="Dry">
                                            <label for="climate1">Dry</label><br>

                                            <input type="radio" id="climate2" name="climate" value="Cold">
                                            <label for="climate2">Cold</label><br>

                                            <input type="radio" id="climate3" name="climate" value="Humid">
                                            <label for="climate3">Humid</label><br>

                                            <input type="radio" id="climate4" name="climate" value="Hot">
                                            <label for="climate4">Hot</label><br>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Age Range (Optional)</label>
                                        <div class="form-group mb-6">

                                            <input type="radio" id="age1" name="age" value="17 or Under">
                                            <label for="age1">17 or Under</label><br>

                                            <input type="radio" id="age2" name="age" value="18 to 24">
                                            <label for="age2">18 to 24</label><br>

                                            <input type="radio" id="age3" name="age" value="25 to 34">
                                            <label for="age3">25 to 34</label><br>

                                            <input type="radio" id="age4" name="age" value="35 to 44">
                                            <label for="age4">35 to 44</label><br>

                                            <input type="radio" id="age5" name="age" value="45 to 54">
                                            <label for="age5">45 to 54</label><br>

                                            <input type="radio" id="age6" name="age" value="35 to 45">
                                            <label for="age6">55 to 59</label><br>

                                            <input type="radio" id="age7" name="age" value="35 to 45">
                                            <label for="age7">60 to Above</label><br>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>How likely are you to recommend JusOut Beauty? (1-Lowest,
                                            10-Highest)</label>
                                        <div class="form-group mb-6">

                                            <input type="radio" id="murad1" name="murad" value="1">
                                            <label for="murad1">1</label><br>

                                            <input type="radio" id="murad2" name="murad" value="2">
                                            <label for="murad2"> 2</label><br>

                                            <input type="radio" id="murad3" name="murad" value="3">
                                            <label for="murad3">3</label><br>

                                            <input type="radio" id="murad4" name="murad" value="4">
                                            <label for="murad4"> 4</label><br>

                                            <input type="radio" id="murad5" name="murad" value="5">
                                            <label for="murad5"> 5</label><br>

                                            <input type="radio" id="murad6" name="murad" value="6">
                                            <label for="murad6"> 6</label><br>

                                            <input type="radio" id="murad7" name="murad" value="7">
                                            <label for="murad7"> 7</label><br>

                                            <input type="radio" id="murad8" name="murad" value="8">
                                            <label for="murad8"> 8</label><br>

                                            <input type="radio" id="murad9" name="murad" value="9">
                                            <label for="murad9"> 9</label><br>

                                            <input type="radio" id="murad10" name="murad" value="10">
                                            <label for="murad10"> 10</label><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>How would you describe your skin type? (Optional)</label>
                                        <div class="form-group mb-6">

                                            <input type="radio" id="skintype1" name="skintype" value="Balanced">
                                            <label for="skintype1">Balanced </label><br>

                                            <input type="radio" id="skintype2" name="skintype" value="Dry">
                                            <label for="skintype2"> Dry</label><br>

                                            <input type="radio" id="skintype3" name="skintype" value="Oily">
                                            <label for="skintype3">Oily</label><br>

                                            <input type="radio" id="skintype4" name="skintype" value="combination">
                                            <label for="skintype4"> Combination</label><br>

                                            <input type="radio" id="skintype5" name="skintype" value="Sensitive">
                                            <label for="skintype5"> Sensitive </label><br>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Would you recommend this product?</label>
                                        <div class="form-group mb-6">

                                            <input type="radio" id="recommand1" name="recommand" value="Yes">
                                            <label for="recommand1">Yes</label><br>

                                            <input type="radio" id="recommand2" name="recommand" value="No">
                                            <label for="recommand2"> No</label><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-6">
                                            <input placeholder="Use your name:*" class="form-control" type="text"
                                                name="name" ng-model="review['R_10']">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-6">
                                            <input type="email" placeholder="Email*" name="email" class="form-control"
                                                ng-model="review['R_11']">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-primary" ng-click="postReview();">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <section class=" pb-lg-13">
                        <div class="">
                            <div class="comment-product mw-900 mx-auto">
                                <h3 class="text-center mb-4">Reviews</h3>

                                <div class="">
                                    <div class="row border-bottom mb-2" ng-repeat="row in displayCollectionReviews">
                                        <div class="col-12 col-md-3 col-xl-3">
                                            <div class="border-right mbl-class">
                                                <div class="w-70px w-70-unset d-block mr-6">
                                                    <img class="img-round-50"
                                                        src="{{ url('/assets-web') }}/images/test-img.jpg"
                                                        alt="Dean. D">
                                                </div>

                                                <div class="media-body text-center-mbl">
                                                    <div
                                                        class="row no-gutters mb-2 align-items-center rating-result r-result">
                                                        <ul class="list-inline mb-0 mr-auto d-flex col-sm-12">

                                                            <li class="list-inline-item fs-12 text-primary"
                                                                ng-if="row.STAR_RATING == '5'" style="width:100%;">
                                                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item fs-12 text-primary"
                                                                ng-if="row.STAR_RATING == '4'" style="width:100%;">
                                                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item fs-12 text-primary"
                                                                ng-if="row.STAR_RATING == '3'" style="width:100%;">
                                                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item fs-12 text-primary"
                                                                ng-if="row.STAR_RATING == '2'" style="width:100%;">
                                                                <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item fs-12 text-primary"
                                                                ng-if="row.STAR_RATING == '1'" style="width:100%;">
                                                                <i class="fas fa-star"></i>
                                                            </li>

                                                        </ul>
                                                        <p class="text-primary mb-0">
                                                            <span class="font-weight-500 text-primary d-inline-block">
                                                                @{{ row.USERNAME }}</span><br>
                                                            <span class="fs-14 d-inline-block"><b>Skin
                                                                    Concern: </b>@{{ row.SKIN_TYPE1 }}</span><br>
                                                            <span class="fs-14 d-inline-block"><b>Climate:</b>
                                                                @{{ row.CLIMATE }}</span><br>
                                                            <span class="fs-14 d-inline-block"><b>Age:</b>
                                                                @{{ row.AGE_RANGE }}</span><br>
                                                            <span class="fs-14 d-inline-block"><b>JusOut Beauty
                                                                    Recommendation:</b>
                                                                @{{ row.RECOMMAND_MURAD }}</span>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 col-xl-9">
                                            <div class="media pb-3 mb-3 ">
                                                <div class="media-body text-center-mbl">
                                                    <div class="row no-gutters mb-2 align-items-center rating-result">
                                                        <div class="col-sm-6 text-sm-left">
                                                            <span
                                                                class="fs-12 text-primary font-italic">@{{ row.TITLE }}</span>
                                                        </div>
                                                        <div class="col-sm-6 text-sm-right">
                                                            <span
                                                                class="fs-12 text-primary font-italic">@{{ row.DATE }}</span>
                                                        </div>
                                                    </div>
                                                    <p class="mb-6 text-justify">@{{ row.REVIEW_DESCRIPTION }}</p>

                                                    <!-- <br><br>
                                                         <div>
               <i class="fa fa-thumbs-up"> </i> <span>0</span> | <i class="fa fa-thumbs-down"> </i> <span>0</span>
              </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"
                                        ng-if="displayCollectionReviews.length == 0 || displayCollectionReviews.length == undefined">
                                        <div class="col-sm-12 col-12">
                                            <p class="text-center">No reviews...</p>
                                        </div>
                                    </div> <br>

                                </div>

                            </div>
                        </div>
                    </section>

                </div>
                <br>
                <div class="" id="pillsQuestions_container" style="display: none">

                    <div class="card border-0 mt-9 form-question hide mw-900 mx-auto" id="writeQuestion_container"
                        style="display: none;">
                        <div class="card-body p-0">
                            <h2 class="text-center mb-9">Write Your Question</h2>
                            <form>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-6">
                                            <input placeholder="Use your name:*" class="form-control" type="text"
                                                ng-model="question['Q_1']">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-6">
                                            <input type="text" placeholder="Email: *" class="form-control"
                                                ng-model="question['Q_2']">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-8">
                                    <textarea class="form-control" placeholder="Question:" rows="5"
                                        ng-model="question['Q_3']"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary"
                                        ng-click="postQuestion();">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <section class="pb-lg-13">
                        <div class="">
                            <div class="comment-product mw-900 mx-auto">
                                <h3 class="text-center mb-4">Questions</h3>

                                <div class="media mbl-class border-bottom pb-7 mb-7 flex-sm-column-mbl"
                                    ng-repeat="row in displayCollectionQuestions">
                                    <div class="w-70px w-70-unset d-block mr-6">
                                        <img class="img-round-50" src="{{ url('/assets-web') }}/images/test-img.jpg"
                                            alt="Dean. D">
                                    </div>
                                    <div class="media-body ">
                                        <div class="row no-gutters mb-2 align-items-center rating-result">
                                            <div class="col-sm-6 text-sm-left">
                                                <span class="fs-16 text-primary"
                                                    style="color: #44B2F7 !important;">@{{ row.USERNAME }}
                                                </span><span class="fs-14 text-primary"> Verified User</span>
                                            </div>
                                        </div>
                                        <p class="text-justify"><strong>Q: @{{ row.QUESTION }}</strong></p><br>
                                        <a href="javascript:;"><i class="fa fa-comment"></i> Answers
                                            (@{{ row.ANSWER != '' ? '1' : '0' }})</a><br>
                                        <br>
                                        <div class="" ng-show="row.ANSWER != ''">
                                            <div class="row flex-sm-column-mbl">
                                                <div class="col-1 col-md-1"></div>
                                                <div class="col-3 col-md-1 border-left" style="border-color: #44B2F7;">
                                                    <div class="w-70px d-block mr-6">
                                                        <i class="fas fa-store"
                                                            style="min-width: 4rem; min-height: 4rem; max-width: 6rem; color: white !important; max-height: 4rem; background-color: rgb(68, 178, 247); display: flex; justify-content: center; align-items: center; border-radius: 50%; font-size: 22px;">
                                                        </i>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-9">

                                                    <div class="row no-gutters mb-2 align-items-center rating-result">
                                                        <div class="col-sm-6 text-sm-left">
                                                            <span class="fs-16 text-primary"
                                                                style="color: #44B2F7 !important;">JUSOUTBeauty
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <p class="text-justify">A: @{{ row.ANSWER }}</p>
                                                    {{-- <div class="text-sm-right" style="">
                                                                Was this hepfull? <i class="fa fa-thumbs-up"> </i>
                                                                <span>0</span>
                                                                | <i class="fa fa-thumbs-down"> </i> <span>0</span>
                                                            </div> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                </div>
                                <div class="row"
                                    ng-if="displayCollectionQuestions.length == 0 || displayCollectionQuestions.length == undefined">
                                    <div class="col-sm-12 col-12">
                                        <p class="text-center">No questions...</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-lg-13">
        <div class="container container-custom container-xxl">
            <ul class="nav nav-pills justify-content-center mb-lg-9 mb-6 last-section-pro-detail" role="tablist">

                <li class="nav-item px-5"><a
                        class="pointer nav-link active text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary font-weight-300 font-weight-active-400 recent_viewed"
                        id="pills-recommendations-tab" data-toggle="pill" href="#pills-recommendations" role="tab"
                        aria-controls="pills-recommendations" aria-selected="true">Complete Your JusOGlow</a>
                </li>
                <li class="nav-item px-5"><a
                        class="pointer nav-link  text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary font-weight-300 font-weight-active-400 recent_viewed"
                        id="pills-recently-viewed-tab" data-toggle="pill" href="#pills-hand-picked" role="tab"
                        aria-controls="pills-recently-viewed" aria-selected="true">
                        Your Daily HandPicked</a></li>
                <li class="nav-item px-5"><a
                        class="pointer nav-link  text-gray-02 rounded-0 px-0 py-1 lh-1 fs-36 bg-transparent text-active-primary font-weight-300 font-weight-active-400 recent_viewed"
                        id="pills-recently-viewed-tab" data-toggle="pill" href="#pills-recently-viewed" role="tab"
                        aria-controls="pills-recently-viewed" aria-selected="true">Recently
                        Viewed</a></li>
                <!--Border Active primary-->
            </ul>
            <div class="tab-content p-0 m-0 shadow-none" id="pills-tabContent">
                <div class="tab-pane fade show active" style="margin-bottom: 20px" id="pills-recommendations"
                    role="tabpanel" aria-labelledby="pills-recommendations-tab">
                    <div class="slick-slider "
                        data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>

                        <?php if(isset($recommandedProducts) && !empty($recommandedProducts)){?>

                        <?php foreach($recommandedProducts as $recommand){?>

                        <div class="box px-1" data-animate="fadeInUp">
                            <div class="card border-0 product px-2">
                                <div class="position-relative">
                                    <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                        data-id="<?= $recommand['PRODUCT_ID'] ?>"
                                        data-category="<?= $recommand['CATEGORY_SLUG'] ?>"
                                        data-subCategory="<?= $recommand['SUB_CATEGORY_SLUG'] ?>"
                                        data-name="<?= $recommand['SLUG'] ?>"
                                        data-type="<?= $recommand['CATEGORY_NAME'] ?>">
                                        <img src="<?= $recommand['primaryImage'] ?>" alt="Product 01"
                                            class="card-img-top all-products img-h60 img-h30-m image-active">
                                        <img src="<?= $recommand['secondaryImage'] ?>" alt="Product 01"
                                            class="card-img-top all-products img-h60 image-hover">
                                    </a>
                                    <div
                                        class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                        <div></div>
                                        <div class="content-change-vertical d-flex flex-column ml-auto">
                                            <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                                title="Add to wish list"
                                                class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                data-productId="<?= $recommand['PRODUCT_ID'] ?>" data-type='single'>
                                                <i
                                                    class="icon fal fa-star wish_<?= $recommand['PRODUCT_ID'] ?> <?= $recommand['wishlistFlag'] == '1' ? 'activeWish' : '' ?>"></i>
                                            </a>
                                            <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                                title="Quick view"
                                                ng-click="quickViewProductDetails({{ $recommand['PRODUCT_ID'] }})"
                                                class="preview d-flex align-items-center justify-content-center text-primary  bgiconcolor  w-45px h-45px rounded-circle">
                                                <span> <i class="icon fal fa-eye"></i> </span>
                                            </a>
                                            {{-- <a href="#" data-toggle="tooltip" data-placement="left"
                                                    title="Quick view"
                                                    class="preview d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle">
                                                    <span data-toggle="modal"
                                                    data-target="#product-recommendations-1"> <i
                                                        class="fal fa-eye"></i>
                                                    </span>
                                                </a> --}}
                                        </div>
                                    </div>
                                    <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                        {{-- <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                data-type="single" data-id="<?= $recommand['PRODUCT_ID'] ?>"
                                                data-quantity='1'>+ Quick Add</a> --}}
                                        @if(isset($recommand['productShades']))
                                        <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white @if(isset($userId)) productdetail @else addto-cart1 @endif"
                                            id="qckad" data-id="<?= $recommand['PRODUCT_ID'];?>"
                                            data-category="<?= $recommand['CATEGORY_SLUG'] ?>"
                                            data-subCategory="<?= $recommand['SUB_CATEGORY_SLUG'] ?>"
                                            data-name="<?= $recommand['SLUG'] ?>" data-type="@{{catFlag}}">+ Add To Cart</a>
                                        @elseif($recommand['INV_QUANTITY_FLAG'] == 'inv' && $recommand['INV_QUANTITY'] >
                                        0)
                                        <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white addto-cart1"
                                            id="qckad" data-type="@{{productType}}"
                                            data-id="<?= $recommand['PRODUCT_ID'];?>" data-quantity='1'>+ Add To Cart</a>
                                        @elseif($recommand['INV_QUANTITY'] <= 0) <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white"
                                            id="qckad" disabled>+ Out of Stock</a>
                                            @endif
                                    </div>
                                </div>
                                <div class="card-body pt-4 px-0 pb-0">
                                    {{-- <ul class="list-inline fs-12 d-flex mb-1">
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
                                        </ul> --}}
                                    <a href="javascript:;"
                                        class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary"
                                        data-id="{{ $recommand['CATEGORY_ID'] }}" data-type="CATEGORY"
                                        data-categorySlug="{{ $recommand['CATEGORY_SLUG'] }}">
                                        {{ $recommand['CATEGORY_NAME'] }}</a>
                                    <div class="d-flex flex-column mb-2">
                                        <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                            <a href="javascript:;" class="productdetail text-capitalize"
                                                data-id="<?= $recommand['PRODUCT_ID'] ?>"
                                                data-category="<?= $recommand['CATEGORY_SLUG'] ?>"
                                                data-subCategory="<?= $recommand['SUB_CATEGORY_SLUG'] ?>"
                                                data-name="<?= $recommand['SLUG'] ?>"
                                                data-type="<?= $recommand['CATEGORY_NAME'] ?>"><?= $recommand['NAME'] ?></a>
                                        </h3>
                                        {{-- <h3 class="card-title fs-16 font-weight-500 mb-1 lh-14375 ellipsis-m">
                                                <a href="javascript:;" class="productdetail" data-id="{{ $for['PRODUCT_ID'] }}"
                                        data-category="{{ $for['CATEGORY_SLUG'] }}"
                                        data-subcategory="{{ $for['SUB_CATEGORY_SLUG'] }}"
                                        data-name="{{ $for['SLUG'] }}" data-type="">{{ $for['PRODUCT_NAME'] }}</a>
                                        </h3> --}}
                                        <p class="text-primary mb-0 shop-subtitle card-title lh-14375 d-block"
                                            style="height: 48px;">
                                            {{ $recommand['SUB_TITLE'] }}</p>
                                        {{-- <p class="fs-15 text-primary mb-0 ml-auto">
                                                <span
                                                    class="text-line-through text-body mr-1"></span>$<?= $recommand['UNIT_PRICE'] ?>
                                            </p> --}}
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
                                    <div class="mt-auto">
                                        <div class="d-flex flex-row justify-content-between">
                                            {{-- <div class="col-sm-6 col-6"> --}}
                                            <p class="text-primary mb-0 card-title lh-14375">
                                                ${{ $recommand['UNIT_PRICE'] }}</p>
                                            {{-- </div> --}}
                                            {{-- <div class="col-sm-6 col-5"> --}}
                                            <p
                                                class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis">
                                                {{ $recommand['UNIT'] }}</p>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
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

                <div class="tab-pane fade" style="margin-bottom: 20px" id="pills-recently-viewed" role="tabpanel"
                    aria-labelledby="pills-recommendations-tab">
                    <div class="slick-slider "
                        data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>

                        <?php if(isset($recentViewedProducts) && !empty($recentViewedProducts)){?>

                        <?php foreach($recentViewedProducts as $recent){?>

                        <div class="box px-1" data-animate="fadeInUp">
                            <div class="card border-0 product px-2">
                                <div class="position-relative">

                                    <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                        data-id="<?= $recent['PRODUCT_ID'] ?>"
                                        data-category="<?= $recent['CATEGORY_SLUG'] ?>"
                                        data-subCategory="<?= $recent['SUB_CATEGORY_SLUG'] ?>"
                                        data-name="<?= $recent['SLUG'] ?>" data-type="<?= $recent['CATEGORY_NAME'] ?>">
                                        <img src="<?= $recent['primaryImage'] ?>" alt="Product 01"
                                            class="card-img-top all-products img-h60 img-h30-m image-active">
                                        <img src="<?= $recent['secondaryImage'] ?>" alt="Product 01"
                                            class="card-img-top all-products img-h60 image-hover">
                                    </a>
                                    <div
                                        class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                        <div></div>
                                        <div class="content-change-vertical d-flex flex-column ml-auto">
                                            <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                                title="Add to wish list"
                                                class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                data-productId="<?= $recent['PRODUCT_ID'] ?>" data-type='single'>
                                                <i
                                                    class="icon fal fa-star wish_<?= $recent['PRODUCT_ID'] ?> <?= $recent['wishlistFlag'] == '1' ? 'activeWish' : '' ?>"></i>
                                            </a>
                                            <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                                title="Quick view"
                                                ng-click="quickViewProductDetails({{ $recent['PRODUCT_ID'] }})"
                                                class="preview d-flex align-items-center justify-content-center text-primary  bgiconcolor  w-45px h-45px rounded-circle">
                                                <span> <i class="icon fal fa-eye"></i> </span>
                                            </a>
                                            {{-- <a href="#" data-toggle="tooltip" data-placement="left"
                                                title="Quick view" ng-click="quickViewProductDetails(<?= $recent['PRODUCT_ID'] ?>)"
                                                class="preview d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle">
                                                <span data-toggle="modal"
                                                data-target="#product-recommendations-1"> <i
                                                    class="fal fa-eye"></i>
                                                </span>
                                                </a> --}}
                                        </div>
                                    </div>
                                    <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                        {{-- <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                data-type="single" data-id="<?= $recent['PRODUCT_ID'] ?>"
                                                data-quantity='1'>+ Quick Add</a> --}}
                                        @if(isset($recent['productShades']))
                                        <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white @if(isset($userId)) productdetail @else addto-cart1 @endif"
                                            id="qckad" data-id="<?= $recent['PRODUCT_ID'];?>"
                                            data-category="<?= $recent['CATEGORY_SLUG'] ?>"
                                            data-subCategory="<?= $recent['SUB_CATEGORY_SLUG'] ?>"
                                            data-name="<?= $recent['SLUG'] ?>" data-type="@{{catFlag}}">+ Add To Cart</a>
                                        @elseif($recent['INV_QUANTITY_FLAG'] == 'inv' && $recent['INV_QUANTITY'] > 0)
                                        <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white addto-cart1"
                                            id="qckad" data-type="@{{productType}}"
                                            data-id="<?= $recent['PRODUCT_ID'];?>" data-quantity='1'>+ Add To Cart</a>
                                        @elseif($recent['INV_QUANTITY'] <= 0) <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white"
                                            id="qckad" disabled>+ Out of Stock</a>
                                            @endif
                                    </div>
                                </div>
                                <div class="card-body pt-4 px-0 pb-0">
                                    {{-- <ul class="list-inline fs-12 d-flex mb-1">
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] >= '1' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] >= '2' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] >= '3' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] >= '4' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] == '5' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                        </ul> --}}
                                    <a href="javascript:;"
                                        class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary"
                                        data-id="{{ $recent['CATEGORY_ID'] }}" data-type="CATEGORY"
                                        data-categorySlug="{{ $recent['CATEGORY_SLUG'] }}">
                                        {{ $recent['CATEGORY_NAME'] }}</a>
                                    <div class="d-flex flex-column mb-2">
                                        <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                            <a href="javascript:;" class="productdetail"
                                                data-id="<?= $recent['PRODUCT_ID'] ?>"
                                                data-category="<?= $recent['CATEGORY_SLUG'] ?>"
                                                data-subCategory="<?= $recent['SUB_CATEGORY_SLUG'] ?>"
                                                data-name="<?= $recent['SLUG'] ?>"
                                                data-type="<?= $recent['CATEGORY_NAME'] ?>"><?= $recent['NAME'] ?></a>
                                        </h3>
                                        <p class="text-primary mb-0 shop-subtitle card-title lh-14375 d-block"
                                            style="height: 48px;">
                                            {{ $recent['SUB_TITLE'] }}</p>

                                    </div>
                                    <ul class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                        <?php
                                                        $shades1 = $recent['productShades'];
                                                        if(isset($shades1) && !empty($shades1)){
                                                        foreach ($shades1 as $shade){

                                                    ?>
                                        <li class="list-inline-item" title="<?= $shade['SHADE_NAME'] ?>">
                                            <a href="javascript:;" class="d-block swatches-item"
                                                style="background-image: url('<?= $shade['shadeprimaryImage'] ?>'); background-repeat:no-repeat;background-position: center;">
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php }?>
                                    </ul>
                                    <div class="mt-auto">
                                        <div class="d-flex flex-row justify-content-between">
                                            {{-- <div class="col-sm-6 col-6"> --}}
                                            <p class="text-primary mb-0 card-title lh-14375">${{ $recent['UNIT_PRICE'] }}
                                            </p>
                                            {{-- </div> --}}
                                            {{-- <div class="col-sm-6 col-5"> --}}
                                            <p
                                                class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis">
                                                {{ $recent['UNIT'] }}</p>
                                            {{-- </div> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php }?>

                        <?php }?>

                                                    <!-- <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                    <div class="position-relative">
                                    <a href="product-detail-01.html" class="d-block"> <img
                                    src="{{ url('assets-web') }}/images/product.jpg" alt="Product 01" class="card-img-top">
                                    </a>
                                    <div
                                    class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                    <div></div>
                                    <div class="content-change-vertical d-flex flex-column ml-auto">
                                        <a href="wishlist.html" data-toggle="tooltip"
                                        data-placement="left" title="Add to wish list"
                                        class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                        <i class="icon fal fa-star"></i>
                                        </a> <a href="#" data-toggle="tooltip" data-placement="left"
                                        title="Quick view"
                                        class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                        <span data-toggle="modal"
                                        data-target="#product-recommendations-1"> <i
                                        class="fal fa-eye"></i>
                                        </span>
                                        </a>
                                    </div>
                                    </div>
                                    <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                    <a href="#" class="btn btn-white btn-block" data-toggle="modal"
                                        data-target="#product-1">+ Quick Add</a>
                                    </div>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0">
                                    <ul class="list-inline fs-12 d-flex mb-1">
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    </ul>
                                    <div class="d-flex align-items-center mb-2">
                                    <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375">
                                        <a href="#">Hoodie with pouch pocket</a>
                                    </h3>
                                    <p class="fs-15 text-primary mb-0 ml-auto">
                                        <span class="text-line-through text-body mr-1"></span>$79.00
                                    </p>
                                    </div>
                                    <ul
                                    class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                    <li class="list-inline-item"><a href="#"
                                        class="d-block swatches-item" data-var="green-revitalizing"
                                        data-toggle="tooltip" data-placement="top"
                                        title="green-revitalizing" style="background-color: #903711;">
                                    </a></li>
                                    <li class="list-inline-item"><a href="#"
                                        class="d-block swatches-item" data-var="black"
                                        data-toggle="tooltip" data-placement="top" title="black"
                                        style="background-color: #000;"> </a></li>
                                    <li class="list-inline-item"><a href="#"
                                        class="d-block swatches-item" data-var="green-revitalizing"
                                        data-toggle="tooltip" data-placement="top"
                                        title="green-revitalizing" style="background-color: #D8D8D8;">
                                    </a></li>
                                    </ul>
                                    </div>
                                    </div>
                                </div>
                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                    <div class="position-relative">
                                    <a href="product-detail.html" class="d-block"> <img
                                    src="{{ url('assets-web') }}/images/product.jpg" alt="Product 01" class="card-img-top">
                                    </a>
                                    <div
                                    class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                    <div>
                                        <span class="badge badge-pink rounded-pill">Hot</span>
                                    </div>
                                    <div class="content-change-vertical d-flex flex-column ml-auto">
                                        <a href="wishlist.html" data-toggle="tooltip"
                                        data-placement="left" title="Add to wish list"
                                        class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                        <i class="icon fal fa-star"></i>
                                        </a> <a href="#" data-toggle="tooltip" data-placement="left"
                                        title="Quick view"
                                        class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                        <span data-toggle="modal"
                                        data-target="#product-recommendations-2"> <i
                                        class="fal fa-eye"></i>
                                        </span>
                                        </a>
                                    </div>
                                    </div>
                                    <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                    <a href="#" class="btn btn-white btn-block" data-toggle="modal"
                                        data-target="#product-2">+ Quick Add</a>
                                    </div>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0">
                                    <ul class="list-inline fs-12 d-flex mb-1">
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fas fa-star"></i></li>
                                    </ul>
                                    <div class="d-flex align-items-center mb-2">
                                    <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375">
                                        <a href="#">Ladder-Lace Linen Tank Top</a>
                                    </h3>
                                    <p class="fs-15 text-primary mb-0 ml-auto">
                                        <span class="text-line-through text-body mr-1"></span>$79.00
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
                                    <a href="product-detail.html" class="d-block"> <img
                                    src="{{ url('assets-web') }}/images/product.jpg" alt="Product 01" class="card-img-top">
                                    </a>
                                    <div
                                    class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                    <div>
                                        <span class="badge badge-green rounded-pill">Sale</span>
                                    </div>
                                    <div class="content-change-vertical d-flex flex-column ml-auto">
                                        <a href="wishlist.html" data-toggle="tooltip"
                                        data-placement="left" title="Add to wish list"
                                        class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                        <i class="icon fal fa-star"></i>
                                        </a> <a href="#" data-toggle="tooltip" data-placement="left"
                                        title="Quick view"
                                        class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                        <span data-toggle="modal"
                                        data-target="#product-recommendations-3"> <i
                                        class="fal fa-eye"></i>
                                        </span>
                                        </a>
                                    </div>
                                    </div>
                                    <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                    <a href="#" class="btn btn-white btn-block" data-toggle="modal"
                                        data-target="#product-3">+ Quick Add</a>
                                    </div>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0">
                                    <ul class="list-inline fs-12 d-flex mb-1">
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    </ul>
                                    <div class="d-flex align-items-center mb-2">
                                    <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375">
                                        <a href="#">Scoop-Back Cotton Cardigan</a>
                                    </h3>
                                    <p class="fs-15 text-primary mb-0 ml-auto">
                                        <span class="text-line-through text-body mr-1">$39.00</span>$79.00
                                    </p>
                                    </div>
                                    <ul
                                    class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                    <li class="list-inline-item"><a href="#"
                                        class="d-block swatches-item" data-var="green-revitalizing"
                                        data-toggle="tooltip" data-placement="top"
                                        title="green-revitalizing" style="background-color: #8C928F;">
                                    </a></li>
                                    <li class="list-inline-item"><a href="#"
                                        class="d-block swatches-item" data-var="black"
                                        data-toggle="tooltip" data-placement="top" title="black"
                                        style="background-color: #000;"> </a></li>
                                    </ul>
                                    </div>
                                    </div>
                                </div>

                                <div class="box px-1" data-animate="fadeInUp">
                                    <div class="card border-0 product px-2">
                                    <div class="position-relative">
                                    <a href="product-detail.html" class="d-block"> <img
                                    src="{{ url('assets-web') }}/images/product.jpg" alt="Product 01" class="card-img-top">
                                    </a>
                                    <div
                                    class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                    <div></div>
                                    <div class="content-change-vertical d-flex flex-column ml-auto">
                                        <a href="wishlist.html" data-toggle="tooltip"
                                        data-placement="left" title="Add to wish list"
                                        class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                        <i class="icon fal fa-star"></i>
                                        </a> <a href="#" data-toggle="tooltip" data-placement="left"
                                        title="Quick view"
                                        class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                        <span data-toggle="modal"
                                        data-target="#product-recommendations-4"> <i
                                        class="fal fa-eye"></i>
                                        </span>
                                        </a>
                                    </div>
                                    </div>
                                    <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                    <a href="#" class="btn btn-white btn-block" data-toggle="modal"
                                        data-target="#product-4">+ Quick Add</a>
                                    </div>
                                    </div>
                                    <div class="card-body pt-4 px-0 pb-0">
                                    <ul class="list-inline fs-12 d-flex mb-1">
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    <li class="list-inline-item text-primary mr-0"><i
                                        class="fal fa-star"></i></li>
                                    </ul>
                                    <div class="d-flex align-items-center mb-2">
                                    <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375">
                                        <a href="#">Oversize Wool Coat</a>
                                    </h3>
                                    <p class="fs-15 text-primary mb-0 ml-auto">
                                        <span class="text-line-through text-body mr-1"></span>$79.00
                                    </p>
                                    </div>
                                    <ul
                                    class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                    <li class="list-inline-item"><a href="#"
                                        class="d-block swatches-item" data-var="green-revitalizing"
                                        data-toggle="tooltip" data-placement="top"
                                        title="green-revitalizing" style="background-color: #D7C09F;">
                                    </a></li>
                                    <li class="list-inline-item"><a href="#"
                                        class="d-block swatches-item" data-var="black"
                                        data-toggle="tooltip" data-placement="top" title="black"
                                        style="background-color: #000;"> </a></li>
                                    <li class="list-inline-item"><a href="#"
                                        class="d-block swatches-item" data-var="green-revitalizing"
                                        data-toggle="tooltip" data-placement="top"
                                        title="green-revitalizing" style="background-color: #B66262;">
                                    </a></li>
                                    </ul>
                                    </div>
                                    </div>
                                </div> -->



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
                <div class="tab-pane fade" style="margin-bottom: 20px" id="pills-hand-picked" role="tabpanel"
                    aria-labelledby="pills-recommendations-tab">
                    <div class="slick-slider "
                        data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":true,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>

                        <?php if(isset($handpicked) && !empty($handpicked)){?>

                        <?php foreach($handpicked as $recent){?>

                        <div class="box px-1" data-animate="fadeInUp">
                            <div class="card border-0 product px-2">
                                <div class="position-relative">
                                    <a href="javascript:;" class="d-block overflow-hidden productdetail"
                                        data-id="<?= $recent['PRODUCT_ID'] ?>"
                                        data-category="<?= $recent['CATEGORY_SLUG'] ?>"
                                        data-subCategory="<?= $recent['SUB_CATEGORY_SLUG'] ?>"
                                        data-name="<?= $recent['SLUG'] ?>" data-type="<?= $recent['CATEGORY_NAME'] ?>"
                                        data-type="@{{catFlag}}">
                                        <img src="<?= $recent['primaryImage'] ?>" alt="Product 01"
                                            class="card-img-top all-products img-h60 img-h30-m image-active">
                                        <img src="<?= $recent['secondaryImage'] ?>" alt="Product 01"
                                            class="card-img-top all-products img-h60 image-hover">
                                    </a>
                                    <div
                                        class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                        <div></div>
                                        <div class="content-change-vertical d-flex flex-column ml-auto">
                                            <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                                title="Add to wish list"
                                                class="add-to-wishlist d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle mb-2 addto-wishlist"
                                                data-productId="<?= $recent['PRODUCT_ID'] ?>" data-type='single'>
                                                <i
                                                    class="icon fal fa-star wish_<?= $recent['PRODUCT_ID'] ?> <?= $recent['wishlistFlag'] == '1' ? 'activeWish' : '' ?>"></i>
                                            </a>
                                            <a href="javascript:;" data-toggle="tooltip" data-placement="left"
                                                title="Quick view"
                                                ng-click="quickViewProductDetails({{ $recent['PRODUCT_ID'] }})"
                                                class="preview d-flex align-items-center justify-content-center text-primary  bgiconcolor  w-45px h-45px rounded-circle">
                                                <span> <i class="icon fal fa-eye"></i> </span>
                                            </a>
                                            {{-- <a href="#" data-toggle="tooltip" data-placement="left"
                                                title="Quick view" ng-click="quickViewProductDetails(<?= $recent['PRODUCT_ID'] ?>)"
                                                class="preview d-flex align-items-center justify-content-center bgiconcolor w-45px h-45px rounded-circle">
                                                <span data-toggle="modal"
                                                data-target="#product-recommendations-1"> <i
                                                    class="fal fa-eye"></i>
                                                </span>
                                                </a> --}}
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
                                        {{-- <a href="javascript:;" class="btn btn-white btn-block addto-cart1"
                                                data-type="single" data-id="<?= $recent['PRODUCT_ID'] ?>"
                                                data-quantity='1'>+ Quick Add</a> --}}
                                        @if(isset($recent['productShades']))
                                        <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white @if(isset($userId)) productdetail @else addto-cart1 @endif"
                                            id="qckad" data-id="<?= $recent['PRODUCT_ID'];?>"
                                            data-category="<?= $recent['CATEGORY_SLUG'] ?>"
                                            data-subCategory="<?= $recent['SUB_CATEGORY_SLUG'] ?>"
                                            data-name="<?= $recent['SLUG'] ?>" data-type="@{{catFlag}}">+ Add To Cart</a>
                                        @elseif($recent['INV_QUANTITY_FLAG'] == 'inv' && $recent['INV_QUANTITY'] > 0)
                                        <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white addto-cart1"
                                            id="qckad" data-type="@{{productType}}"
                                            data-id="<?= $recent['PRODUCT_ID'];?>" data-quantity='1'>+ Add To Cart</a>
                                        @elseif($recent['INV_QUANTITY'] <= 0) <a href="javascript:;"
                                            class="btn btn-white btn-block bg-hover-primary border-hover-primary hover-white"
                                            id="qckad" disabled>+ Out of Stock</a>
                                            @endif
                                    </div>
                                </div>
                                <div class="card-body pt-4 px-0 pb-0">
                                    {{-- <ul class="list-inline fs-12 d-flex mb-1">
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] >= '1' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] >= '2' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] >= '3' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] >= '4' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                            <li class="list-inline-item text-primary mr-0">
                                                <i class="fas fa-star"
                                                    style="<?= $recent['averageRating'] == '5' ? 'color:black;' : 'color:gray;' ?>"></i>
                                            </li>
                                        </ul> --}}
                                    <a href="javascript:;"
                                        class="text-muted fs-12 font-weight-500 text-uppercase mb-1 card-title lh-14 hover-primary"
                                        data-id="{{ $recent['CATEGORY_ID'] }}" data-type="CATEGORY"
                                        data-categorySlug="{{ $recent['CATEGORY_SLUG'] }}">
                                        {{ $recent['CATEGORY_NAME'] }}</a>
                                    <div class="d-flex flex-column mb-2" data-id="<?= $recent['PRODUCT_ID'] ?>">
                                        <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375 ellipsis">
                                            <a href="javascript:;" class="productdetail"
                                                data-id="<?= $recent['PRODUCT_ID'] ?>"
                                                data-category="<?= $recent['CATEGORY_SLUG'] ?>"
                                                data-subCategory="<?= $recent['SUB_CATEGORY_SLUG'] ?>"
                                                data-name="<?= $recent['SLUG'] ?>"
                                                data-type="<?= $recent['CATEGORY_NAME'] ?>"><?= $recent['NAME'] ?></a>
                                        </h3>
                                        <p class="text-primary mb-0 shop-subtitle card-title lh-14375 d-block"
                                            style="height: 48px;">
                                            {{ $recent['SUB_TITLE'] }}</p>
                                        {{-- <p class="fs-15 text-primary mb-0 ml-auto">
                                                <span
                                                    class="text-line-through text-body mr-1"></span>$<?= $recent['UNIT_PRICE'] ?>
                                            </p> --}}
                                    </div>
                                    <ul class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                        <?php
                                                        $shades1 = $recent['productShades'];
                                                        if(isset($shades1) && !empty($shades1)){
                                                        foreach ($shades1 as $shade){

                                                    ?>
                                        <li class="list-inline-item" title="<?= $shade['SHADE_NAME'] ?>">
                                            <a href="javascript:;" class="d-block swatches-item"
                                                style="background-image: url('<?= $shade['shadeprimaryImage'] ?>'); background-repeat:no-repeat;background-position: center;">
                                            </a>
                                        </li>
                                        <?php }?>
                                        <?php }?>
                                    </ul>
                                    <div class="mt-auto">
                                        <div class="d-flex flex-row justify-content-between">
                                            {{-- <div class="col-sm-6 col-6"> --}}
                                            <p class="text-primary mb-0 card-title lh-14375">${{ $recent['UNIT_PRICE'] }}
                                            </p>
                                            {{-- </div> --}}
                                            {{-- <div class="col-sm-6 col-5"> --}}
                                            <p
                                                class="text-primary mb-0 card-title lh-14375 text-right text-right-sm ellipsis">
                                                {{ $recent['UNIT'] }}</p>
                                            {{-- </div> --}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php }?>

                        <?php }?>

                        <!-- <div class="box px-1" data-animate="fadeInUp">
                                        <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                        <a href="product-detail-01.html" class="d-block"> <img
                                        src="{{ url('assets-web') }}/images/product.jpg" alt="Product 01" class="card-img-top">
                                        </a>
                                        <div
                                        class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                        <div></div>
                                        <div class="content-change-vertical d-flex flex-column ml-auto">
                                            <a href="wishlist.html" data-toggle="tooltip"
                                            data-placement="left" title="Add to wish list"
                                            class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                            <i class="icon fal fa-star"></i>
                                            </a> <a href="#" data-toggle="tooltip" data-placement="left"
                                            title="Quick view"
                                            class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                            <span data-toggle="modal"
                                            data-target="#product-recommendations-1"> <i
                                            class="fal fa-eye"></i>
                                            </span>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                        <a href="#" class="btn btn-white btn-block" data-toggle="modal"
                                            data-target="#product-1">+ Quick Add</a>
                                        </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                        <ul class="list-inline fs-12 d-flex mb-1">
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        </ul>
                                        <div class="d-flex align-items-center mb-2">
                                        <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375">
                                            <a href="#">Hoodie with pouch pocket</a>
                                        </h3>
                                        <p class="fs-15 text-primary mb-0 ml-auto">
                                            <span class="text-line-through text-body mr-1"></span>$79.00
                                        </p>
                                        </div>
                                        <ul
                                        class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                        <li class="list-inline-item"><a href="#"
                                            class="d-block swatches-item" data-var="green-revitalizing"
                                            data-toggle="tooltip" data-placement="top"
                                            title="green-revitalizing" style="background-color: #903711;">
                                        </a></li>
                                        <li class="list-inline-item"><a href="#"
                                            class="d-block swatches-item" data-var="black"
                                            data-toggle="tooltip" data-placement="top" title="black"
                                            style="background-color: #000;"> </a></li>
                                        <li class="list-inline-item"><a href="#"
                                            class="d-block swatches-item" data-var="green-revitalizing"
                                            data-toggle="tooltip" data-placement="top"
                                            title="green-revitalizing" style="background-color: #D8D8D8;">
                                        </a></li>
                                        </ul>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="box px-1" data-animate="fadeInUp">
                                        <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                        <a href="product-detail.html" class="d-block"> <img
                                        src="{{ url('assets-web') }}/images/product.jpg" alt="Product 01" class="card-img-top">
                                        </a>
                                        <div
                                        class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                        <div>
                                            <span class="badge badge-pink rounded-pill">Hot</span>
                                        </div>
                                        <div class="content-change-vertical d-flex flex-column ml-auto">
                                            <a href="wishlist.html" data-toggle="tooltip"
                                            data-placement="left" title="Add to wish list"
                                            class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                            <i class="icon fal fa-star"></i>
                                            </a> <a href="#" data-toggle="tooltip" data-placement="left"
                                            title="Quick view"
                                            class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                            <span data-toggle="modal"
                                            data-target="#product-recommendations-2"> <i
                                            class="fal fa-eye"></i>
                                            </span>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                        <a href="#" class="btn btn-white btn-block" data-toggle="modal"
                                            data-target="#product-2">+ Quick Add</a>
                                        </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                        <ul class="list-inline fs-12 d-flex mb-1">
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fas fa-star"></i></li>
                                        </ul>
                                        <div class="d-flex align-items-center mb-2">
                                        <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375">
                                            <a href="#">Ladder-Lace Linen Tank Top</a>
                                        </h3>
                                        <p class="fs-15 text-primary mb-0 ml-auto">
                                            <span class="text-line-through text-body mr-1"></span>$79.00
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
                                        <a href="product-detail.html" class="d-block"> <img
                                        src="{{ url('assets-web') }}/images/product.jpg" alt="Product 01" class="card-img-top">
                                        </a>
                                        <div
                                        class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                        <div>
                                            <span class="badge badge-green rounded-pill">Sale</span>
                                        </div>
                                        <div class="content-change-vertical d-flex flex-column ml-auto">
                                            <a href="wishlist.html" data-toggle="tooltip"
                                            data-placement="left" title="Add to wish list"
                                            class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                            <i class="icon fal fa-star"></i>
                                            </a> <a href="#" data-toggle="tooltip" data-placement="left"
                                            title="Quick view"
                                            class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                            <span data-toggle="modal"
                                            data-target="#product-recommendations-3"> <i
                                            class="fal fa-eye"></i>
                                            </span>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                        <a href="#" class="btn btn-white btn-block" data-toggle="modal"
                                            data-target="#product-3">+ Quick Add</a>
                                        </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                        <ul class="list-inline fs-12 d-flex mb-1">
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        </ul>
                                        <div class="d-flex align-items-center mb-2">
                                        <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375">
                                            <a href="#">Scoop-Back Cotton Cardigan</a>
                                        </h3>
                                        <p class="fs-15 text-primary mb-0 ml-auto">
                                            <span class="text-line-through text-body mr-1">$39.00</span>$79.00
                                        </p>
                                        </div>
                                        <ul
                                        class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                        <li class="list-inline-item"><a href="#"
                                            class="d-block swatches-item" data-var="green-revitalizing"
                                            data-toggle="tooltip" data-placement="top"
                                            title="green-revitalizing" style="background-color: #8C928F;">
                                        </a></li>
                                        <li class="list-inline-item"><a href="#"
                                            class="d-block swatches-item" data-var="black"
                                            data-toggle="tooltip" data-placement="top" title="black"
                                            style="background-color: #000;"> </a></li>
                                        </ul>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="box px-1" data-animate="fadeInUp">
                                        <div class="card border-0 product px-2">
                                        <div class="position-relative">
                                        <a href="product-detail.html" class="d-block"> <img
                                        src="{{ url('assets-web') }}/images/product.jpg" alt="Product 01" class="card-img-top">
                                        </a>
                                        <div
                                        class="position-absolute pos-fixed-top-right d-inline-flex p-4 flex-column z-index-10">
                                        <div></div>
                                        <div class="content-change-vertical d-flex flex-column ml-auto">
                                            <a href="wishlist.html" data-toggle="tooltip"
                                            data-placement="left" title="Add to wish list"
                                            class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2">
                                            <i class="icon fal fa-star"></i>
                                            </a> <a href="#" data-toggle="tooltip" data-placement="left"
                                            title="Quick view"
                                            class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle">
                                            <span data-toggle="modal"
                                            data-target="#product-recommendations-4"> <i
                                            class="fal fa-eye"></i>
                                            </span>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="position-absolute pos-fixed-bottom pb-4 px-4 w-100">
                                        <a href="#" class="btn btn-white btn-block" data-toggle="modal"
                                            data-target="#product-4">+ Quick Add</a>
                                        </div>
                                        </div>
                                        <div class="card-body pt-4 px-0 pb-0">
                                        <ul class="list-inline fs-12 d-flex mb-1">
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        <li class="list-inline-item text-primary mr-0"><i
                                            class="fal fa-star"></i></li>
                                        </ul>
                                        <div class="d-flex align-items-center mb-2">
                                        <h3 class="card-title fs-16 font-weight-500 mb-0 lh-14375">
                                            <a href="#">Oversize Wool Coat</a>
                                        </h3>
                                        <p class="fs-15 text-primary mb-0 ml-auto">
                                            <span class="text-line-through text-body mr-1"></span>$79.00
                                        </p>
                                        </div>
                                        <ul
                                        class="list-inline mb-0 shop-swatch-color-03 d-flex align-items-center">
                                        <li class="list-inline-item"><a href="#"
                                            class="d-block swatches-item" data-var="green-revitalizing"
                                            data-toggle="tooltip" data-placement="top"
                                            title="green-revitalizing" style="background-color: #D7C09F;">
                                        </a></li>
                                        <li class="list-inline-item"><a href="#"
                                            class="d-block swatches-item" data-var="black"
                                            data-toggle="tooltip" data-placement="top" title="black"
                                            style="background-color: #000;"> </a></li>
                                        <li class="list-inline-item"><a href="#"
                                            class="d-block swatches-item" data-var="green-revitalizing"
                                            data-toggle="tooltip" data-placement="top"
                                            title="green-revitalizing" style="background-color: #B66262;">
                                        </a></li>
                                        </ul>
                                        </div>
                                        </div>
                                    </div> -->



                    </div>
                    {{-- <div class="modal fade quick-view" id="product-recommendations-1" tabindex="-1"
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
                                                        <div
                                                            class="form-group shop-swatch-color shop-swatch-color-02 mb-6">
                                                            <label class="mb-2"><span
                                                                    class="font-weight-500 text-primary mr-2">Color:</span>
                                                                <span class="var text-capitalize"></span></label>
                                                            <ul class="list-inline d-flex justify-content-start mb-0">
                                                                <li class="list-inline-item"><a href="#"
                                                                        class="d-block swatches-item"
                                                                        data-var="green-revitalizing"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Korma"
                                                                        style="background-color: #903711;"> </a></li>
                                                                <li class="list-inline-item"><a href="#"
                                                                        class="d-block swatches-item"
                                                                        data-var="black"
                                                                        style="background-color: #000;"> </a></li>
                                                                <li class="list-inline-item"><a href="#"
                                                                        class="d-block swatches-item"
                                                                        data-var="green-revitalizing"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Alto"
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
                                                                <li class="list-inline-item mr-2 selected"><a
                                                                        href="#"
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
                        </div> --}}
                </div>
                <!-- Handpicked End -->
            </div>
            <div class="modal fade quick-view " id="productQuickView" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog quick_view_mbl modal-dialog-scrollable">
                    <div class="modal-content p-0 quick_view_mbl_carousel_modal">
                        <div class="modal-body p-0">
                            <button type="button"
                                class="close fs-32 position-absolute pos-fixed-top-right z-index-10"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="fs-20"> <i class="fal fa-times"></i>
                                </span>
                            </button>
                            <div class="row no-gutters" id="quick_view_product_details">
                                <div class="col-sm-6">

                                    <div id="carouselExampleControls" class="carousel slide quick_view_mbl_carousel" data-ride="carousel"
                                        data-interval="2000">
                                        <div class="carousel-inner">
                                            <div class="carousel-item @{{ $first == '1' ? 'active' : '' }}"
                                                ng-repeat="row in productImagesLoop">
                                                <img class="d-block w-100 quick_view_mbl_carousel_img" style="height: 35rem"
                                                    src="@{{ row.downPath }}" alt="First slide">
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
                                    <div class="primary-summary-inner" >
                                        <p
                                            class="text-muted fs-11 font-weight-500 letter-spacing-05px text-uppercase mb-0 pt-1 pb-1">
                                            Petit
                                            @{{ category_name }}, @{{ subCategory_name }}</p>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <p class="mb-0 fs">$@{{ unit_price }}</p>
                                            </div>
                                        </div>
                                        <p class="mb-3" style="max-height: 150px; overflow: auto">@{{ short_description }}
                                        </p>

                                        <div style="margin-bottom: 0px;" ng-if="displayCollectionProductShadesQuickView.length != null || displayCollectionProductShadesQuickView.length != undefined">
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
        </div>
    </section>

    <?php }?>


    {{-- learn more popup --}}
    <div class="modal fade quick-view" id="learnmore_pop" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 631px !important;">
            <div class="modal-content p-0">
                <div class="modal-body p-0">
                    <button type="button" class="close fs-32 position-absolute pos-fixed-top-right pr-3 pt-2 z-index-10"
                        ng-click="hideSubscrptionDetailModal();">
                        <span aria-hidden="true" class="fs-20"><i class="fal fa-times"></i></span>
                    </button>
                    <div class="pop_content_prod_detail">

                        <div class="row">

                            <p class="col-lg-12" style="max-height: 500px;
                            overflow: auto;">
                                @{{ subscriptionDetails }}</p>

                        </div>
                        <div class="row">

                            <div class="col-lg-12 text-right">
                                <a style="text-decoration-line: underline;font"
                                    href="{{ url('subscription') }}"><em>Read More
                                        >></em></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- learnmore popup end --}}
    </div>



</main>

@include('web.web-footer')

<script src="{{ url('/assets-web') }}/customjs/script_userproductdetail.js?v={{ time() }}"></script>

<script>
    function form2() {
        $("#uploadatt6").click();
    }
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

    });
    $(document).on('click', '.list-inline-item', function () {

        $(".list-inline-item").removeClass('selected');
        $(this).addClass('selected');
    });

    function close_topbar() {
        $("#topbar").removeClass('d-xl-flex');
        // $("#content").removeClass('mt-14');
        $("#content").css("padding-top", "60px");
        // $("#details-header").addClass('mt-10');

    }
    $('.down').on('click', function (e) {
        e.preventDefault();
        var $parent = $(this).parent('.input-group');
        var $input = $parent.find('input');
        var $value = parseInt($input.val());
        var maxQuantity = parseInt($input.attr('max'));

        if ($value > 1) {
            $value -= 1;
        } else {
            $value = 1;
        }

        $input.val($value);
    });

    $('.up').on('click', function (e) {
        e.preventDefault();
        var $parent = $(this).parent('.input-group');
        var $input = $parent.find('input');
        var $value = $input.val();
        var maxQuantity = parseInt($input.attr('max'));

        if ($value != '') {
            $value = parseInt($value);
            if ($value < maxQuantity) {
                $value += 1;
            } else {
                $value = maxQuantity;
            }
        } else {
            $value = 1;
        }

        $input.val($value);
    });
    $('.subscrReadMoreLink').on('click', function (e) {
        var link = $(this).attr('data-link');
        if(link != ''){
        	window.location.href = link;
       	}
    });




    function showfileload() {
        $('#selfie_img').click();
    }

    function loadFile(event) {

        var output = document.getElementById('hung22');

        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {

            var height = this.naturalHeight;
            var width = this.naturalWidth;

            if (height < 400 || width < 400) {

                toastr.error('Height and Width must be greater than 400px.', '', {
                    timeOut: 3000
                });

                $('#hung221').show();
                $("#hung22").hide();
                $('#saveProductSelfie')[0].reset();
                return false;
            } else {

                URL.revokeObjectURL(output.src) // free memory
                $('#hung221').hide();
                $("#hung22").show();

            }

        }
    }

    $("#saveProductSelfie").submit(function (e) {
        e.preventDefault();

        var name_of_user = $('#name').val();
        var email_of_user = $('#email').val();
        var img_of_user = $('#selfie_img').val();

        if (name_of_user == '' || email_of_user == '' || img_of_user == '') {
            toastr.error('Fill all fields', '', {
                timeOut: 3000
            });
            return false;
        }

        var formData = new FormData($(this)[0]);
        var productid = productId;
        formData.append('productid', productid);
        formData.append('flag', 'single');

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            async: true,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (data) {
                $('.loaderbtn').show();
                $('.savebtn').hide();
                $.LoadingOverlay("show");
            },
            success: function (data) {
                console.log(data);
                if (data.done == true || data.done == 'true') {

                    toastr.success(data.msg, '', {
                        timeOut: 3000
                    })

                    $('#productselfi').modal('hide');
                    $('#saveProductSelfie')[0].reset();
                    $('#hung221').show();
                    $("#hung22").hide();
                }
            },
            complete: function (data) {
                $('.loaderbtn').hide();
                $('.savebtn').show();
                $.LoadingOverlay("hide");
            },
            error: function (e) {
                $('.loaderbtn').hide();
                $('.savebtn').show();
                console.log(e);
            }
        });



    });

</script>
