<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CloverController;
use App\Http\Middleware\AdminAuth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

// Route::get('/', function () {
//     return view('welcome');
// });
session()->put('site', '/site');



Route::post('/cookies/accept',[AdminController::class,'acceptCookies']);
// Cookie::forever('site_name', 'JusOutBeauty');
// Cookie::forever('site_url', url('/home'));
// Cookie::forever('site_description', 'Welcome to JusOut Beauty, all inclusive, high performance, natural skincare, and makeup - Yur Jus Enough beauty products to glow from within.');

// print_r(request()->cookie('site_description'));
// exit();

Route::get('/login', [HomeController::class, 'userLogin']);
Route::post('/userLoginAuth', [LoginController::class, 'userlogin']);
Route::post('/UserResetPass', [LoginController::class, 'userResetPass']);
Route::post('/UserValidateOTP', [LoginController::class, 'userValidateOTP']);
Route::post('/UserValidatePass', [LoginController::class, 'userValidatePass']);

Route::post('/UserReg', [LoginController::class, 'UserReg1']);
Route::get('/userlogout', [HomeController::class, 'logout']);
//web routs

Route::get('/subscription-crone-job',[AdminController::class,'subscriptionCroneJob']);

Route::get('/testing/{id}', function($id){
    $result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*',  'a.UNIT_PRICE','prd.NAME as productName','bprd.NAME as bundleName','ctbl.CATEGORY_NAME as productCName','bprd.NAME as bundleCName','sctbl.USER_ID as userId')
    ->leftJoin('jb_product_tbl as prd','a.PRODUCT_ID','=','prd.PRODUCT_ID')
    ->leftJoin('jb_bundle_product_tbl as bprd','a.BUNDLE_ID','=','bprd.BUNDLE_ID')
    ->leftJoin('jb_category_tbl as ctbl','prd.CATEGORY_ID','=','ctbl.CATEGORY_ID')
    ->leftJoin('jb_category_tbl as bctbl','bprd.CATEGORY_ID','=','bctbl.CATEGORY_ID')
    ->leftJoin('jb_shopping_cart_tbl as sctbl','a.CART_ID','=','sctbl.CART_ID')
    ->where('a.CART_ID', $id)
    ->orderBy('a.CART_LINE_ID', 'desc')
    ->get();

    $userDetails = User::where('USER_ID',$result[0]->userId)->first();
    dd($result,$userDetails);
});

Route::middleware(['CheckLoggedInStatus'])->group(function () {
    // Define your routes here
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/Shop-All', [HomeController::class, 'store']);

    Route::get('/blog-page', [HomeController::class, 'blogPage']);
    Route::get('/blog-detail/{slug}', [HomeController::class, 'blogDetails']);
    // Route::get('/product-detail', [HomeController::class, 'productDetail']);
    Route::get('/discover', [HomeController::class, 'discover']);

    Route::get('/who-we-are', [HomeController::class, 'whoWeAre']);
    Route::get('/ingredients', [HomeController::class, 'ingredients']);

    Route::get('/eco-vibes', [HomeController::class, 'ecoVibes']);
    Route::get('/lusty-looks', [HomeController::class, 'lustyLooks']);
    Route::get('/routine', [HomeController::class, 'routine']);

    Route::get('/giving', [HomeController::class, 'giving']);
    Route::get('/makeup', [HomeController::class, 'makeup']);
    Route::get('/nutrition', [HomeController::class, 'nutrition']);
    Route::get('/user-shade-finder', [HomeController::class, 'UsershadeFinder']);
    Route::get('/skincare', [HomeController::class, 'skincare']);
    Route::get('/user-login', [HomeController::class, 'userLogin']);
    Route::get('/blog-detail-page', [HomeController::class, 'blogDetailPage']);
    Route::get('/checkout', [HomeController::class, 'checkout']);
    Route::get('/information-step', [HomeController::class, 'informationStep']);
    Route::get('/payment_step', [HomeController::class, 'payment_step']);
    // Route::get('/reward', [HomeController::class, 'reward']);
    Route::get('/usershadefinderquiz', [HomeController::class, 'UserShadeFinderQuiz']);
    Route::get('/subscription', [HomeController::class, 'subscription']);
    Route::get('/user-registration', [HomeController::class, 'userRegistration']);
    Route::get('/shopping-cart', [HomeController::class, 'shoppingCart']);
    Route::get('/shipping-step', [HomeController::class, 'shippingStep']);

    Route::match(['get', 'post'],'/Store/{category}/{subcategory?}', [HomeController::class, 'storeListing']);

    Route::get('/storeListing', function () {
        return redirect('/home');
    });

    Route::get('/term-conditions', [HomeController::class, 'termCondition']);
    Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy']);
    Route::get('/accessibility', [HomeController::class, 'accessibility']);
    Route::get('/cookie', [HomeController::class, 'cookie']);

    Route::match(['get', 'post'], '/Products/{category}/{subCategory?}/{slug?}', [HomeController::class, 'productDetail']);

    // Route::post('/productDetail/{slug}', [HomeController::class, 'productDetail']);
    Route::get('/productDetail', function () {
        return redirect('home');
    });
    // ...
});



Route::get('/success-message-giving', [HomeController::class, 'successPageGiving']);

// Route::get('/become_a_partner', [HomeController::class, 'becomePartner']);


Route::get('/getAllNavLinksLov',[AdminController::class,'getAllNavLinksLov']);





Route::get('/making-slug',[HomeController::class,'makingSlug']);




Route::post('/uploadProductImageVideoSelfi', [AttachmentController::class, 'uploadProductImageVideoSelfi']);
Route::post('/deleteProductSelfiImage', [HomeController::class, 'deleteProductSelfiImage']);
Route::get('/routine-detail/{id}', [HomeController::class, 'showRoutineDetailPage']);
Route::get('/customer-help', [HomeController::class, 'informationPage']);

Route::post('/getQuickViewProductDetails', [HomeController::class, 'getQuickViewProductDetails']);

Route::group(['middleware' => ['UserAuth']], function(){

	Route::get('/wishlist', [HomeController::class, 'wishlist']);
	Route::get('/userDashboard', [HomeController::class, 'userDashboard']);
	Route::get('/userProfile', [HomeController::class, 'userProfile']);
	Route::get('/userChangePass', [HomeController::class, 'userChangePass']);
	Route::get('/userOrders', [HomeController::class, 'userOrders']);
	Route::get('/userTickets', [HomeController::class, 'userTickets']);
	Route::get('/userSubscriptions', [HomeController::class, 'userSubscriptions']);



	Route::post('/getAllWishlistLov', [HomeController::class, 'getAllWishlistLov']);

	Route::post('/deleteWishlistRecord', [HomeController::class, 'deleteWishlistRecord']);

	Route::post('/getAllUserProfileLov', [HomeController::class, 'getAllUserProfileLov']);
	Route::post('/updateUserProfile', [HomeController::class, 'updateUserProfile']);
	Route::post('/updateUserPassword', [HomeController::class, 'updateUserPassword']);
	Route::post('/getAllUserOrderslov', [HomeController::class, 'getAllUserOrderslov']);
	Route::post('/getSpecificUserOrderDetails', [HomeController::class, 'getSpecificUserOrderDetails']);
	Route::post('/getSpecificUserShadeNameDetails', [HomeController::class, 'getSpecificUserShadeNameDetails']);
	Route::post('/getSpecificUserShadeNameDetailsUserCheckout', [HomeController::class, 'getSpecificUserShadeNameDetailsUserCheckout']);
	Route::post('/getProductShadesRightSideBar', [HomeController::class, 'getProductShadesRightSideBar']);

	Route::post('/searchShipmentUserOrders', [HomeController::class, 'searchShipmentUserOrders']);
	Route::post('/getAllUserTicketslov', [HomeController::class, 'getAllUserTicketslov']);
	Route::post('/saveTicketDetails', [HomeController::class, 'saveTicketDetails']);
	Route::post('/getSpecificTicketDetails', [HomeController::class, 'getSpecificTicketDetails']);
	Route::post('/saveTicketReplyDetail', [HomeController::class, 'saveTicketReplyDetail']);
	Route::post('/getAllUserSubscriptionslov', [HomeController::class, 'getAllUserSubscriptionslov']);
	Route::post('/getSpecificUserSubscriptionDetail', [HomeController::class, 'getSpecificUserSubscriptionDetail']);
	Route::post('/updateSpecificUserSubscriptionStatus', [HomeController::class, 'updateSpecificUserSubscriptionStatus']);

	Route::post('/changeTicketStatus', [HomeController::class, 'changeTicketStatus']);
	Route::get('/success-message', [HomeController::class, 'successPage']);
	Route::get('/success-message-sub', [HomeController::class, 'successPageSub']);
	Route::get('/error-message', [HomeController::class, 'errorPage']);



});

// =============== User ajax routes =================
Route::post('/getAllSelfies', [HomeController::class, 'getAllSelfies']);
Route::post('/getAllUserShadeFinderQuizLov', [HomeController::class, 'getAllUserShadeFinderQuizLov']);
Route::post('/getLevelOneDetailsWrtOption', [HomeController::class, 'getLevelOneDetailsWrtOption']);
Route::post('/getshadeFinderQuizLevelTwoDetails', [HomeController::class, 'getshadeFinderQuizLevelTwoDetails']);
Route::post('/getshadeFinderQuizLevelThreeDetails', [HomeController::class, 'getshadeFinderQuizLevelThreeDetails']);
Route::post('/getshadeFinderQuizLevelFourDetails', [HomeController::class, 'getshadeFinderQuizLevelFourDetails']);

Route::post('/getAllUserStoreListingLov', [HomeController::class, 'getAllUserStoreListingLov']);


Route::post('/getUserSearchStoreListing', [HomeController::class, 'getUserSearchStoreListing']);
Route::post('/getAllUserStoreListingAllLov', [HomeController::class, 'getAllUserStoreListingAllLov']);
Route::post('/getUserSearchStoreListingAll', [HomeController::class, 'getUserSearchStoreListingAll']);
Route::post('/loadMoreSubCategoriesFilter', [HomeController::class, 'loadMoreSubCategoriesFilter']);


Route::post('/getAllUserStoreListingNutritionLov', [HomeController::class, 'getAllUserStoreListingNutritionLov']);
Route::post('/getAllUserStoreNutritionFilter', [HomeController::class, 'getAllUserStoreNutritionFilter']);

Route::post('/saveUserReview', [HomeController::class, 'saveUserReview']);
Route::post('/getAllProductDetailLov', [HomeController::class, 'getAllProductDetailLov']);
Route::post('/saveUserQuestion', [HomeController::class, 'saveUserQuestion']);

Route::post('/addToCart', [HomeController::class, 'addToCart']);
Route::post('/loadCart', [HomeController::class, 'loadCart']);
Route::post('/removeCartItem', [HomeController::class, 'removeCartItem']);

Route::post('/getAllCheckoutPageLov', [HomeController::class, 'getAllCheckoutPageLov']);
Route::post('/postOrderCheckout', [HomeController::class, 'postOrderCheckout']);
Route::post('/getSpecificSubscriptionDetail', [HomeController::class, 'getSpecificSubscriptionDetail']);
Route::post('/addProductToWishlist', [HomeController::class, 'addProductToWishlist']);
Route::post('/saveShippingInfo', [HomeController::class, 'saveShippingInfo']);
Route::post('/save_selfie',[HomeController::class, 'saveSelfie'])->name('saveSelfie');
Route::post('/saveProductSelfie', [HomeController::class, 'saveProductSelfie'])->name('saveProductSelfie');

Route::post('/addFooterEmailSubscription', [HomeController::class, 'addFooterEmailSubscription']);
Route::post('/deleteTicketAttachment', [HomeController::class, 'deleteTicketAttachment']);



Route::post('/uploadTicketAttachment', [AttachmentController::class, 'uploadTicketAttachment']);



//admin routs

Route::post('/get-Admin-Footer-Details', [AdminController::class, 'displaySocialData']);
Route::post('/add-social-icons', [AdminController::class, 'addSocialIcons']);
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/loginAuth', [LoginController::class, 'adminlogin']);
Route::get('/admin-login', [AdminController::class, 'login']);
Route::get('/adminlogout', [AdminController::class, 'logout']);
Route::get('/showAllRoutineTypes',[AdminController::class,'getAllRoutineTypes']);

Route::group(['middleware' => ['AdminAuth']], function(){

	//for admin User Page
	Route::get('/adminUsers',[AdminController::class,'adminUsers']);
	Route::post('/getAllAdminUserslov', [AdminController::class, 'getAllAdminUserslov']);
	Route::post('/saveAdminUser',[AdminController::class, 'saveAdminUser']);
	Route::post('/editAdminUser',[AdminController::class, 'editAdminUser']);
	Route::post('/deleteSpecificAdmin',[AdminController::class,'deleteSpecificAdmin']);
	Route::post('/changeStatusAdmin',[AdminController::class,'changeStatusAdmin']);
	Route::post('/menuControlOptions',[AdminController::class,'menuControlOptions']);

	//for quick add product start
	Route::post('/updateClinicalInfo', [AdminController::class, 'updateClinicalInfo']);
	Route::post('/UpdateCategories',[AdminController::class,'updateCategory']);
	Route::post('/getAllProductsOfCategory',[AdminController::class,'getAllProductsOfCategory']);
	Route::get('/quick-add-product', [AdminController::class, 'quickAddProduct']);
	Route::post('/updateAdminQuickProductBasicInfo', [AdminController::class, 'updateAdminQuickProductBasicInfo']);
	Route::post('/getQuickAddAdminProduct', [AdminController::class, 'getQuickAddAdminProduct']);
	Route::post('/updateFeatures', [AdminController::class, 'updateFeatures']);
	Route::post('/updateVideoInfo', [AdminController::class, 'updateVideoInfo']);
	Route::post('/UpdateSecondSection', [AdminController::class, 'UpdateSecondSection']);
	Route::post('/saveAdminQuickProductIngredient', [AdminController::class, 'saveAdminQuickProductIngredient']);
	Route::post('/deleteIngredientQuickAdd', [AdminController::class, 'deleteIngredientQuickAdd']);
	Route::post('/saveAdminQuickProductUses', [AdminController::class, 'saveAdminQuickProductUses']);
	Route::post('/saveAdminQuickProductShade', [AdminController::class, 'saveAdminQuickProductShade']);
	Route::post('/saveAdminProductsaveJusOFlow',[AdminController::class,'saveAdminProductsaveJusOFlow']);
	Route::post('/saveDailyhandPickProduct',[AdminController::class,'saveDailyhandPickProduct']);
	Route::post('/getSubSubCategoriesWrtSubCategoryQuickAdd',[AdminController::class,'getSubSubCategoriesWrtSubCategoryQuickAdd']);
	Route::post('/updateSubSubCategoriesWrtSubCategoryQuickAdd',[AdminController::class,'updateSubSubCategoriesWrtSubCategoryQuickAdd']);
	Route::post('/updateProductOrder',[AdminController::class,'updateProductOrder']);
	Route::post('/updateBundleOrder',[AdminController::class,'updateBundleOrder']);
	Route::post('/updateShadeOrder',[AdminController::class,'updateShadeOrder']);
	Route::post('/updateIngredientOrder',[AdminController::class,'updateIngredientOrder']);
	Route::post('/updateFeaturesOrder',[AdminController::class,'updateFeaturesOrder']);

    Route::post('/updateSubscriptionInfo', [AdminController::class, 'updateSubscriptionInfo']);

    Route::post('/updateCategoryOrder',[AdminController::class,'updateCategoryOrder']);
    Route::post('/updateSubCategoryOrder',[AdminController::class,'updateSubCategoryOrder']);
    Route::post('/updateSubSubCategoryOrder',[AdminController::class,'updateSubSubCategoryOrder']);

	//for quick add product end
	Route::post('/getAllAdminProductSnapSelfielov', [AdminController::class, 'getAllAdminProductSnapSelfielov']);
	Route::post('/ChangeAdminProductSnapSelfieStatus', [AdminController::class, 'ChangeAdminProductSnapSelfieStatus']);

	Route::get('/dashboard', [AdminController::class, 'dashboard']);
	Route::get('/partners', [AdminController::class, 'partners']);
	Route::get('/givings', [AdminController::class, 'givings']);
	Route::get('/admin-users', [AdminController::class, 'adminUsers']);
	Route::get('/admin-profile', [AdminController::class, 'adminProfile']);
	Route::get('/add-admin-user', [AdminController::class, 'addAdminUser']);
	Route::get('/website-users', [AdminController::class, 'websiteUsers']);
	Route::get('/add-website-user', [AdminController::class, 'addWebsiteUser']);
	Route::get('/view-categories', [AdminController::class, 'viewCategories']);
	Route::get('/view-products', [AdminController::class, 'viewProducts']);
	Route::get('/add-product', [AdminController::class, 'addProduct']);
	Route::get('/view-ingredients', [AdminController::class, 'viewAllIngredients']);
	Route::get('/view-features', [AdminController::class, 'viewAllFeatures']);

	Route::get('/add-ingredient', [AdminController::class, 'addNewIngredient']);
	Route::get('/edit-ingredient/{id}', [AdminController::class, 'addNewIngredient']);
	Route::get('/view-all-shades', [AdminController::class, 'viewAllShades']);
	Route::get('/view-all-selfi', [AdminController::class, 'viewAllSelfi']);
       /* new selfie route */
	Route::post('/get_selfies', [AdminController::class, 'get_selfies']);
	Route::post('/deletespecificselfie', [AdminController::class, 'deletespecificselfie']);
	Route::post('/deletSelectedSelfie', [AdminController::class, 'deletSelectedSelfie']);


	Route::get('/add-shade', [AdminController::class, 'addShade']);
	Route::get('/blogs', [AdminController::class, 'blogs']);
	Route::get('/add-blog', [AdminController::class, 'addBlog']);
	Route::get('/edit-blog', [AdminController::class, 'editBlog']);
	Route::get('/shade-finder-quiz', [AdminController::class, 'shadeFinderQuiz']);
	Route::get('/shade-finder-quiz-yes', [AdminController::class, 'shadeFinderQuizYes']);
	Route::get('/shade-finder-quiz-no', [AdminController::class, 'shadeFinderQuizNo']);
	Route::get('/add-shade-finder-quiz', [AdminController::class, 'addShadeFinderQuiz']);
	Route::get('/orders', [AdminController::class, 'orders']);
	Route::get('/shippedorders', [AdminController::class, 'shippedorders']);
	Route::get('/newsLatters', [AdminController::class, 'newsLatters']);
	Route::get('/snapSelfie', [AdminController::class, 'snapSelfie']);
    Route::post('/getSnapDetail/{id}',[AdminController::class,'getSnapDetail']);
    Route::post('/sendSelfieReply',[AdminController::class,'sendSelfieReply']);



	Route::get('/order-detail', [AdminController::class, 'orderDetail']);
	Route::get('/apis', [AdminController::class, 'apis']);
	Route::get('/add-api', [AdminController::class, 'addApi']);
	Route::get('/edit-api', [AdminController::class, 'editApi']);
	Route::get('/view-api', [AdminController::class, 'viewApi']);
	Route::get('/sms-apis', [AdminController::class, 'smsApis']);
	Route::get('/add-sms-api', [AdminController::class, 'addSmsApi']);
	Route::get('/edit-sms-api', [AdminController::class, 'editSmsApi']);
	Route::get('/sms-templates', [AdminController::class, 'smsTemplates']);
	Route::get('/add-sms-template', [AdminController::class, 'addSmsTemplate']);
	Route::get('/edit-sms-template', [AdminController::class, 'editSmsTemplate']);
	Route::get('/header', [AdminController::class, 'header']);
	Route::get('/footer', [AdminController::class, 'footer']);
	Route::get('/home-page', [AdminController::class, 'homePage']);
    Route::get('/home-page-popup',[AdminController::class,'popup']);
    Route::post('/getPopupData',[AdminController::class,'getPopupData']);
    Route::post('/savePopupData',[AdminController::class,'savePopupData']);
    Route::post('/uploadPopupImage',[AttachmentController::class,'uploadPopupImage']);
	Route::get('/payments', [AdminController::class, 'payments']);
	Route::get('/view-payment', [AdminController::class, 'viewPayment']);
	Route::get('/delivery', [AdminController::class, 'Delivery']);
	Route::get('/view-delivery', [AdminController::class, 'vieDelivery']);
	Route::get('/questions', [AdminController::class, 'Questions']);
	Route::get('/reviews', [AdminController::class, 'Reviews']);
	Route::get('/view-review', [AdminController::class, 'viewReview']);
	Route::get('/shade-finder', [AdminController::class, 'shadeFinder']);
	Route::get('/view-shade-finder', [AdminController::class, 'viewShadeFinder']);
	Route::get('/emails-settings', [AdminController::class, 'emailsSettings']);
	Route::get('/emails-sent', [AdminController::class, 'emailsSent']);
	Route::get('/allsub', [AdminController::class, 'allsub']);
	Route::get('/edit-allsub', [AdminController::class, 'editAllsub']);
	Route::get('/add-allsub', [AdminController::class, 'addAllsub']);
	Route::get('/user-subscriptions', [AdminController::class, 'userSubscriptions']);
	Route::get('/view-bundles', [AdminController::class, 'viewBundles']);

	Route::get('/user-Tickets', [AdminController::class, 'adminUserTickets']);

	// =============== admin ajax routes =================
	Route::post('/getAllAdminCategorylov', [AdminController::class, 'getAllAdminCategorylov']);
	Route::post('/saveAdminCategory', [AdminController::class, 'saveAdminCategory']);
	Route::post('/editAdminCategory', [AdminController::class, 'editAdminCategory']);
	Route::post('/changeStatusCategory', [AdminController::class, 'changeStatusCategory']);

	Route::post('/saveAdminSubCategory', [AdminController::class, 'saveAdminSubCategory']);
	Route::post('/editAdminSubCategory', [AdminController::class, 'editAdminSubCategory']);
	Route::post('/changeStatusSubCategory', [AdminController::class, 'changeStatusSubCategory']);

	Route::post('/saveAdminSubSubCategory', [AdminController::class, 'saveAdminSubSubCategory']);
	Route::post('/editAdminSubSubCategory', [AdminController::class, 'editAdminSubSubCategory']);
	Route::post('/changeStatusSubSubCategory', [AdminController::class, 'changeStatusSubSubCategory']);

	Route::post('/getAllAdminIngredientlov', [AdminController::class, 'getAllAdminIngredientlov']);
	Route::post('/getAllAdminFeatureslov', [AdminController::class, 'getAllAdminFeatureslov']);

	Route::post('/saveAdminIngredient', [AdminController::class, 'saveAdminIngredient']);
	Route::post('/saveAdminFeature', [AdminController::class, 'saveAdminFeature']);

	Route::post('/editAdminIngredient', [AdminController::class, 'editAdminIngredient']);
	Route::post('/editAdminFeature', [AdminController::class, 'editAdminFeature']);

	Route::post('/changeStatusIngredient', [AdminController::class, 'changeStatusIngredient']);
	Route::post('/changeStatusFeature', [AdminController::class, 'changeStatusFeature']);

	Route::post('/deleteIngredient', [AdminController::class, 'deleteIngredient']);
	Route::post('/deleteFeature', [AdminController::class, 'deleteFeature']);

	Route::post('/deleteIngredientAttachment', [AdminController::class, 'deleteIngredientAttachment']);


	Route::post('/markPrimaryIngredientAttachment', [AdminController::class, 'markPrimaryIngredientAttachment']);
	Route::post('/uploadIngredientAttachment', [AttachmentController::class, 'uploadIngredientAttachment']);
	Route::post('/uploadFeatureAttachment', [AttachmentController::class, 'uploadFeatureAttachment']);
	Route::post('/uploadRoutineAttachment', [AttachmentController::class, 'uploadRoutineAttachment']);
    Route::post('/deleteRoutineAttachment',[AdminController::class,'deleteRoutineAttachment']);

	// Blogs Section
	Route::post('/getAllAdminBloglov', [AdminController::class, 'getAllAdminBloglov']);
	Route::post('/saveAdminBlogs', [AdminController::class, 'saveAdminBlogs']);
	Route::post('/editAdminBlog', [AdminController::class, 'editAdminBlog']);
	Route::post('/deleteBlog', [AdminController::class, 'deleteBlog']);
	Route::post('/uploadBlogAttachment', [AttachmentController::class, 'uploadBlogAttachment']);
	Route::post('/uploadBlogDetailAttachment', [AttachmentController::class, 'uploadBlogDetailAttachment']);
	Route::post('/uploadBlogAttachmentSingle', [AttachmentController::class, 'uploadBlogAttachmentSingle']);
	Route::post('/deletePicOurBlog', [AdminController::class, 'deletePicOurBlog']);
	Route::post('/deletePicBlogDetail', [AdminController::class, 'deletePicBlogDetail']);

	//Rooutines Routes
	Route::post('/add_routine_type_name', [AdminController::class, 'add_routine_type_name']);
	Route::post('/routine_type_name_edit', [AdminController::class, 'routine_type_name_edit']);

	Route::post('/addstep_routine', [AdminController::class, 'addstep_routine']);
	Route::post('/checksteps', [AdminController::class, 'checksteps']);
	Route::post('/getsteps', [AdminController::class, 'getsteps']);
	Route::post('/removesteps', [AdminController::class, 'removesteps']);

	Route::post('/remove_routine_type_name', [AdminController::class, 'remove_routine_type_name']);
	Route::post('/remove_routine', [AdminController::class, 'remove_routine']);






	Route::get('/getTypeNameLov', [AdminController::class, 'getTypeNameLov']);
	Route::post('/getAllAdminGivings', [AdminController::class, 'getAllAdminGivings']);

	Route::get('/add_routine', [AdminController::class, 'add_routine']);
	Route::get('/routine', [AdminController::class, 'routine']);
	Route::get('/routine_type', [AdminController::class, 'routine_type']);
	Route::post('/getAllAdminroutinetype', [AdminController::class, 'getAllAdminroutinetype']);

	Route::post('/routine_type_add', [AdminController::class, 'routine_type_add']);
	Route::post('/routine_type_edit', [AdminController::class, 'routine_type_edit']);
	Route::post('/deleteRoutineTypeRecord', [AdminController::class, 'deleteRoutineTypeRecord']);
	Route::post('/changeStatusRoutineType', [AdminController::class, 'changeStatusRoutineType']);


	// Route::post('/r', [AdminController::class, 'deleteRoutineTypeRecord']);


	Route::post('/getAllAdminShadeslov', [AdminController::class, 'getAllAdminShadeslov']);
	Route::post('/saveAdminShades', [AdminController::class, 'saveAdminShades']);
	Route::post('/editAdminShade', [AdminController::class, 'editAdminShade']);
	Route::post('/changeStatusBlogs', [AdminController::class, 'changeStatusBlogs']);
	Route::post('/saveSingleAdminBlog', [AdminController::class, 'saveSingleAdminBlog']);
	Route::post('/deleteBlogAttachment', [AdminController::class, 'deleteBlogAttachment']);


	Route::post('/changeStatusShade', [AdminController::class, 'changeStatusShade']);
	Route::post('/markPrimaryShadeAttachment', [AdminController::class, 'markPrimaryShadeAttachment']);
	Route::post('/deleteShadeAttachment', [AdminController::class, 'deleteShadeAttachment']);
	Route::post('/deleteShade', [AdminController::class, 'deleteShade']);
	Route::post('/uploadShadesAttachment', [AttachmentController::class, 'uploadShadesAttachment']);


	Route::post('/getAllAdminProductlov', [AdminController::class, 'getAllAdminProductlov']);
	Route::post('/getSubCategoriesWrtCategory', [AdminController::class, 'getSubCategoriesWrtCategory']);
	Route::post('/getSubCategoriesWrtCategory1', [AdminController::class, 'getSubCategoriesWrtCategory1']);
	Route::post('/getproductswrtsubcategory', [AdminController::class, 'getproductswrtsubcategory']);
	Route::post('/getSubSubCategoriesWrtSubCategory', [AdminController::class, 'getSubSubCategoriesWrtSubCategory']);
	Route::post('/saveAdminProductBasicInfo', [AdminController::class, 'saveAdminProductBasicInfo']);
	Route::post('/saveAdminQuickProductBasicInfo', [AdminController::class, 'saveAdminQuickProductBasicInfo']);
	Route::post('/productQuickAdd', [AdminController::class, 'productQuickAdd']);
	Route::get('/productQuickAdd', [AdminController::class, 'viewProducts']);
	Route::post('/editAdminProduct', [AdminController::class, 'editAdminProduct']);
	Route::post('/saveAdminProductVideoDetails', [AdminController::class, 'saveAdminProductVideoDetails']);
	Route::post('/markPrimaryProdImage', [AdminController::class, 'markPrimaryProdImage']);
	Route::post('/deleteProductImage', [AdminController::class, 'deleteProductImage']);
	Route::post('/saveAdminProductPricingVat', [AdminController::class, 'saveAdminProductPricingVat']);
	Route::post('/getIngredientsWrtCategory', [AdminController::class, 'getIngredientsWrtCategory']);
	Route::post('/saveAdminProductIngredient', [AdminController::class, 'saveAdminProductIngredient']);
	Route::post('/deleteProductingredient', [AdminController::class, 'deleteProductingredient']);
	Route::post('/saveAdminProductShade', [AdminController::class, 'saveAdminProductShade']);
	Route::post('/editProductShade', [AdminController::class, 'editProductShade']);
	Route::post('/markProductShadeImage', [AdminController::class, 'markProductShadeImage']);
	Route::post('/deleteProductShade', [AdminController::class, 'deleteProductShade']);
	Route::post('/deleteProductShadeImage', [AdminController::class, 'deleteProductShadeImage']);
	Route::post('/saveAdminProductUses', [AdminController::class, 'saveAdminProductUses']);
	Route::post('/editProductUses', [AdminController::class, 'editProductUses']);
	Route::post('/deleteProductUses', [AdminController::class, 'deleteProductUses']);
	Route::post('/deleteProductUsesImage', [AdminController::class, 'deleteProductUsesImage']);
	Route::post('/saveAdminProductOtherInfo', [AdminController::class, 'saveAdminProductOtherInfo']);
	Route::post('/deleteClinicalNoteImage', [AdminController::class, 'deleteClinicalNoteImage']);
	Route::post('/markPrimaryClinicalNoteImage', [AdminController::class, 'markPrimaryClinicalNoteImage']);

	Route::post('/getAllAdminShadeFinderlov', [AdminController::class, 'getAllAdminShadeFinderlov']);
	Route::post('/saveAdminShadeFinderOptionInfo', [AdminController::class, 'saveAdminShadeFinderOptionInfo']);
	Route::post('/saveAdminShadeFinderLevel1Info', [AdminController::class, 'saveAdminShadeFinderLevel1Info']);
	Route::post('/saveAdminShadeFinderLevel1TypeInfo', [AdminController::class, 'saveAdminShadeFinderLevel1TypeInfo']);
	Route::post('/editAdminShadeFinderLevel1Type', [AdminController::class, 'editAdminShadeFinderLevel1Type']);
	Route::post('/deleteShadeFinderLevel1Type', [AdminController::class, 'deleteShadeFinderLevel1Type']);
	Route::post('/deleteLevel1TypeImage', [AdminController::class, 'deleteLevel1TypeImage']);
	Route::post('/saveAdminShadeFinderLevel2Info', [AdminController::class, 'saveAdminShadeFinderLevel2Info']);
	Route::post('/getLevel1TypeLovForLevel2Type', [AdminController::class, 'getLevel1TypeLovForLevel2Type']);
	Route::post('/saveAdminShadeFinderLevel2TypeInfo', [AdminController::class, 'saveAdminShadeFinderLevel2TypeInfo']);
	Route::post('/editAdminShadeFinderLevel2Type', [AdminController::class, 'editAdminShadeFinderLevel2Type']);
	Route::post('/deleteShadeFinderLevel2Type', [AdminController::class, 'deleteShadeFinderLevel2Type']);
	Route::post('/saveAdminShadeFinderLevel3Info', [AdminController::class, 'saveAdminShadeFinderLevel3Info']);
	Route::post('/getLevel2TypeLovForLevel3Type', [AdminController::class, 'getLevel2TypeLovForLevel3Type']);
	Route::post('/saveAdminShadeFinderLevel3TypeInfo', [AdminController::class, 'saveAdminShadeFinderLevel3TypeInfo']);
	Route::post('/editAdminShadeFinderLevel3Type', [AdminController::class, 'editAdminShadeFinderLevel3Type']);
	Route::post('/deleteShadeFinderLevel3Type', [AdminController::class, 'deleteShadeFinderLevel3Type']);

	Route::post('/getAllAdminOrderslov', [AdminController::class, 'getAllAdminOrderslov']);
	Route::post('/getSpecificOrderDetails', [AdminController::class, 'getSpecificOrderDetails']);
	Route::post('/orderStatusShipmentConfirm', [AdminController::class, 'orderStatusShipmentConfirm']);
	Route::post('/getAllAdminShippedOrderslov', [AdminController::class, 'getAllAdminShippedOrderslov']);
	Route::post('/addOrderShipmentDetail', [AdminController::class, 'addOrderShipmentDetail']);
	Route::post('/shipmentStatusUpdate', [AdminController::class, 'shipmentStatusUpdate']);
	Route::post('/searchShipmentOrders', [AdminController::class, 'searchShipmentOrders']);


	Route::post('/getAllAdminProductBundlelov', [AdminController::class, 'getAllAdminProductBundlelov']);
	Route::post('/saveAdminBundleProductBasicInfo', [AdminController::class, 'saveAdminBundleProductBasicInfo']);
	Route::post('/editAdminBundleProduct', [AdminController::class, 'editAdminBundleProduct']);
	Route::post('/deleteBundleProductImage', [AdminController::class, 'deleteBundleProductImage']);
	Route::post('/saveAdminBundleProductLine', [AdminController::class, 'saveAdminBundleProductLine']);
	Route::post('/deleteBundleProductLine', [AdminController::class, 'deleteBundleProductLine']);


	Route::post('/getAllAdminReviewslov', [AdminController::class, 'getAllAdminReviewslov']);
	Route::post('/deleteReviewDetails', [AdminController::class, 'deleteReviewDetails']);
	Route::post('/updateReviewStatus', [AdminController::class, 'updateReviewStatus']);
	Route::post('/updateReviewOnSiteStatus', [AdminController::class, 'updateReviewOnSiteStatus']);
	Route::post('/getSpecificReviewDetails', [AdminController::class, 'getSpecificReviewDetails']);

	Route::post('/getAllAdminQuestionslov', [AdminController::class, 'getAllAdminQuestionslov']);
	Route::post('/updateQuestionStatus', [AdminController::class, 'updateQuestionStatus']);
	Route::post('/saveQuestionAnswer', [AdminController::class, 'saveQuestionAnswer']);
	Route::post('/deleteQuestionReply', [AdminController::class, 'deleteQuestionReply']);


	Route::post('/getAllAdminSubscriptionlov', [AdminController::class, 'getAllAdminSubscriptionlov']);
	Route::post('/saveAdminSubscription', [AdminController::class, 'saveAdminSubscription']);
	Route::post('/editAdminSubscription', [AdminController::class, 'editAdminSubscription']);
	Route::post('/deleteAdminSubscription', [AdminController::class, 'deleteAdminSubscription']);
	Route::post('/changeStatusSubscription', [AdminController::class, 'changeStatusSubscription']);


	Route::post('/getAllAdminHomeUserlov', [AdminController::class, 'getAllAdminHomeUserlov']);
	Route::post('/saveAdminHomeUserPageBanner', [AdminController::class, 'saveAdminHomeUserPageBanner']);
	Route::post('/saveAdminHomeUserBestExc', [AdminController::class, 'saveAdminHomeUserBestExc']);
	Route::post('/deleteHomeBannerImage', [AdminController::class, 'deleteHomeBannerImage']);
	Route::post('/deleteHomeBestExcImage', [AdminController::class, 'deleteHomeBestExcImage']);
	Route::post('/getproductlovfromcategory', [AdminController::class, 'getproductlovfromcategory']);
	Route::post('/saveTrendingProductDetails', [AdminController::class, 'saveTrendingProductDetails']);
	Route::post('/deleteSectionRecord', [AdminController::class, 'deleteSectionRecord']);
	Route::post('/saveTodayofferDetails', [AdminController::class, 'saveTodayofferDetails']);
	Route::post('/editOfferRecord', [AdminController::class, 'editOfferRecord']);
	Route::post('/deleteOfferRecord', [AdminController::class, 'deleteOfferRecord']);


	Route::post('/getAllAdminUserSubscriptionslov', [AdminController::class, 'getAllAdminUserSubscriptionslov']);
	Route::post('/getSpecificAdminUserSubscriptionDetail', [AdminController::class, 'getSpecificAdminUserSubscriptionDetail']);

	Route::post('/getAllAdminUserTicketslov', [AdminController::class, 'getAllAdminUserTicketslov']);
	Route::post('/saveAdminTicketDetails', [AdminController::class, 'saveAdminTicketDetails']);
	Route::post('/changeAdminTicketStatus', [AdminController::class, 'changeAdminTicketStatus']);
	Route::post('/getSpecificAdminTicketDetails', [AdminController::class, 'getSpecificAdminTicketDetails']);
	Route::post('/deleteTicketDetails', [AdminController::class, 'deleteTicketDetails']);
	Route::post('/saveAdminTicketReplyDetail', [AdminController::class, 'saveAdminTicketReplyDetail']);


	Route::post('/getAllAdminPaymentslov', [AdminController::class, 'getAllAdminPaymentslov']);
	Route::post('/getSpecificAdminPaymentDetail', [AdminController::class, 'getSpecificAdminPaymentDetail']);
	Route::post('/getAllAdminNewslatterlov', [AdminController::class, 'getAllAdminNewslatterlov']);
	Route::post('/getAllAdminSnapSelfielov', [AdminController::class, 'getAllAdminSnapSelfielov']);
	Route::post('/deleteSelfieDetails', [AdminController::class, 'deleteSelfieDetails']);
	Route::post('/getAllAdminEmaillov', [AdminController::class, 'getAllAdminEmaillov']);
	Route::post('/deleteAdminSentEmail', [AdminController::class, 'deleteAdminSentEmail']);

	Route::post('/deleteCategoryRecord', [AdminController::class, 'deleteCategoryRecord']);
	Route::post('/deleteSubCategoryRecord', [AdminController::class, 'deleteSubCategoryRecord']);
	Route::post('/deleteSubSubCategoryRecord', [AdminController::class, 'deleteSubSubCategoryRecord']);
	Route::post('/changeStatusProduct', [AdminController::class, 'changeStatusProduct']);
	Route::post('/deleteSpecificProduct', [AdminController::class, 'deleteSpecificProduct']);
	Route::post('/changeStatusBundle', [AdminController::class, 'changeStatusBundle']);
	Route::post('/deleteSpecificBundle', [AdminController::class, 'deleteSpecificBundle']);
	Route::post('/getAllAdminEmailConfiglov', [AdminController::class, 'getAllAdminEmailConfiglov']);
	Route::post('/editEmailConfigDetails', [AdminController::class, 'editEmailConfigDetails']);
	Route::post('/saveEmailConfigDetails', [AdminController::class, 'saveEmailConfigDetails']);
	Route::post('/getAllAdminWebsiteUserslov', [AdminController::class, 'getAllAdminWebsiteUserslov']);
	Route::post('/changeStatusWebsiteUser', [AdminController::class, 'changeStatusWebsiteUser']);
	Route::post('/getAllAdminProfilelov', [AdminController::class, 'getAllAdminProfilelov']);
	Route::post('/updateAdminProfile', [AdminController::class, 'updateAdminProfile']);
	Route::post('/updateAdminPassword', [AdminController::class, 'updateAdminPassword']);
	Route::post('/getSpecificWebsiteUserDetails', [AdminController::class, 'getSpecificWebsiteUserDetails']);

	Route::post('/getSpecificUserShadeNameDetailsAdmin', [AdminController::class, 'getSpecificUserShadeNameDetailsAdmin']);

    Route::post('/uploadProductSubscriptionImage',[AttachmentController::class, 'uploadProductSubscriptionImage']);


















	Route::post('/uploadProductImageAttachment', [AttachmentController::class, 'uploadProductImageAttachment']);
	Route::post('/uploadProductVideoAttachment', [AttachmentController::class, 'uploadProductVideoAttachment']);
	Route::post('/uploadProductShadeImage', [AttachmentController::class, 'uploadProductShadeImage']);
	Route::post('/uploadProductUsesImage', [AttachmentController::class, 'uploadProductUsesImage']);
	Route::post('/uploadshadeFinderTypeImage', [AttachmentController::class, 'uploadshadeFinderTypeImage']);

	Route::post('/uploadBundleProductImage', [AttachmentController::class, 'uploadBundleProductImage']);
	Route::post('/uploadBannerImage', [AttachmentController::class, 'uploadBannerImage']);
	Route::post('/uploadBestSellerImage', [AttachmentController::class, 'uploadBestSellerImage']);
	Route::post('/uploadEmailConfigLogo', [AttachmentController::class, 'uploadEmailConfigLogo']);

	Route::post('/updateSpecificUserSubscriptionStatusAdmin', [AdminController::class, 'updateSpecificUserSubscriptionStatusAdmin']);

	Route::get('/getTotalUsers',[AdminController::class,'getTotalUsers']);


});


	Route::get('/payment/clover', [CloverController::class, 'getclovercode']);
	Route::post('/makePayment', [CloverController::class, 'makePayment']);

	Route::get('/updateSlug', [HomeController::class, 'makingSlug']);

Route::get('runCommand', function () {

// 	echo 'hello';
// 	\Artisan::call('cache:clear');//route:cache
//  $exitCode =Artisan ::call('key:generate');
});

