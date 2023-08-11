<?php

namespace App\Http\Controllers;
use Session;
use DateTime;
use App\Models\Feature;
use App\Models\TypeName;
use App\Models\UserModel;
use App\Models\BlogsModel;
use App\Models\Handpicked;
use App\Models\OrderModel;
use App\Models\Recomended;
use App\Models\RoutineType;
use App\Models\ShadesModel;
use App\Models\CountryModel;
use App\Models\ProductModel;
use App\Models\ReviewsModel;
use App\Models\TicketsModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\QuestionModel;
use App\Models\WishlistModel;
use App\Models\EmailConfigModel;
use App\Models\OrderDetailModel;
use App\Models\ProductUsesModel;
use App\Models\ShadeFinderModel;
use App\Models\EmailForwardModel;
use App\Models\OrderPaymentModel;
use App\Models\ProductSelfiModel;
use App\Models\ProductShadeModel;
use App\Models\ShoppingcartModel;
use App\Models\SubscriptionModel;
use App\Models\BundleProductModel;
use App\Models\OrderShipmentModel;
use App\Models\OrderShippingModel;
use App\Models\UserdashboardModel;
use Illuminate\Support\Facades\DB;
use App\Models\AddSocialIconsModel;
use App\Models\BundleProductLineModel;
use App\Models\ProductIngredientModel;
use App\Models\ShadeFinderSelfieModel;
use App\Models\FooterSubscriptionModel;
use App\Http\Controllers\CloverController;
use App\Models\OrderShippingTrackingModel;
use App\Models\ProductImageModel;
use Mockery\Undefined;
use PhpParser\Node\Stmt\Return_;

// use Illuminate\Http\Request;
class HomeController extends Controller
{

    public function makingSlug()
    {
        $result = DB::table('jb_product_tbl')->select('*')->get();
        foreach($result as $product){
            $name = $product->NAME;
            $words = explode(' ', $name);
            if (count($words) > 1 || strpos($name, ' ') !== false) {
                $name = implode('-', $words);
            }
            $slug = $name;
            $update = DB::table('jb_product_tbl')->where('PRODUCT_ID', $product->PRODUCT_ID)->update(['SLUG' => $slug]);
        }
        return $update;
    }
    public function makingSlug1()
    {
    	$result = DB::table('jb_bundle_product_tbl')->select('*')->get();
    	foreach($result as $product){
    		$name = $product->NAME;
    		$words = explode(' ', $name);
    		if (count($words) > 1 || strpos($name, ' ') !== false) {
    			$name = implode('-', $words);
    		}
    		$slug = $name;
    		$update = DB::table('jb_bundle_product_tbl')->where('BUNDLE_ID', $product->BUNDLE_ID)->update(['SLUG' => $slug]);
    	}
    	return $update;
    }


   	public function index() {
   		$UserdashboardModel = new UserdashboardModel();
   		$ReviewsModel = new ReviewsModel();
   		$BlogsModel = new BlogsModel();


   		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
        // dd($data['categoryProducts']);
   		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
   		$data ['homeBanner'] = $UserdashboardModel->getAllUserBanners();
   		$data ['trending'] = $UserdashboardModel->getAllUserHomeProductSectionData1('trending');
   		$data ['forYou'] = $UserdashboardModel->getAllUserHomeProductSectionData1('foryou');
   		$data ['reviews'] = $ReviewsModel->getAllEnableReviewsForWebsite();
   		$data ['todayOffer'] = $UserdashboardModel->getActiveTodayOfferRecordForWebsite();
   		$bestExc = $UserdashboardModel->getAllUserBestExcData();
   		$data ['bestSeller'] = isset($bestExc[0]) ? $bestExc[0] : '';
   		$data ['onlineExclusive'] = isset($bestExc[1]) ? $bestExc[1] : '';
   		$data ['ourblog'] = $BlogsModel ->getSpecificOurBlogsData(1);
   		$data ['blogs'] = $BlogsModel ->getAllActiveBlogsData(3);
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
        $data['popupData'] = $this->getPopupData();
   		$data ['page'] = 'Dashboard';
//    		print_r('<pre>');
//    		print_r($data ['todayOffer']);
//    		exit();
		return view ( 'web.index' )->with ( $data );
	}

    public function getPopupData(){
        $result = DB::table('jb_popup_tbl as a')->select('a.*')->where('ID','1')->first();
        return $result;
    }
	public function getAllSelfies(){
		$ShadeFinderSelfieModel = new ShadeFinderSelfieModel();

		$arrRes ['list'] = $ShadeFinderSelfieModel->getAllShadeFinderSelfieForAdmin();

		echo json_encode ( $arrRes );
	}

	public function updateSpecificUserSubscriptionStatus(Request $request){
		$SubscriptionModel = new SubscriptionModel();

   		$details = $_REQUEST ['details'];


   		$userId = $details ['userId'];
   		$subsId = $details ['subsId'];
		$flag = $details ['flag'];

		if($flag == "0"){
			$flag_active = 'inactive';
		}else{
			$flag_active = 'active';
		}

		   $result = DB::table ( 'jb_user_subscription_tbl' ) ->where ( 'USER_SUBSCRIPTION_ID', $subsId ) ->update (
			array ( 'SUBSCRIPTION_STATUS' => $flag_active,
					'UPDATED_BY' => $userId,
					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			)
		);
			$arrRes ['done'] = true;

			echo json_encode ( $arrRes );

	}
	public function logout(Request $request) {
		$request->session()->forget('userId');
		$request->session()->forget('userName');
		$request->session()->forget('firstName');
		$request->session()->forget('lastName');
		$request->session()->forget('email');
		$request->session()->forget('userType');
		$request->session()->forget('userSubType');
        cookie()->queue(cookie()->forget('loggedIn'));
		return redirect('login');
	}
	public function whoWeAre() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Who We Are';
		return view('web.who-we-are')->with ( $data );
	}
	public function ingredients() {
		$ProductIngredient = new ProductIngredientModel();

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
        $data['ingredients'] = $ProductIngredient->getIngredientsWithImags();

		$data['page'] = 'Ingredients';
		return view('web.ingredients')->with ( $data );
	}
	public function routine() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();

		$data['page'] = 'Routine';
		return view('web.routine')->with ( $data );
	}
	public function termCondition(){

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		// dd($data['getTypeNameLov']);
		$data['page'] = 'Term & Condition';
		return view('web.t&c')->with ( $data );
	}

	public function privacyPolicy(){

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		// dd($data['getTypeNameLov']);
		$data['page'] = 'Privacy Policy';
		return view('web.policy')->with ( $data );
	}

	public function accessibility(){

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		// dd($data['getTypeNameLov']);
		$data['page'] = 'Accessibility';
		return view('web.accessibility')->with ( $data );
	}

	public function informationPage(){

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		// dd($data['getTypeNameLov']);
		$data['page'] = 'Customer Help';
		return view('web.information')->with ( $data );
	}

	public function cookie(){

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		// dd($data['getTypeNameLov']);
		$data['page'] = 'Cookie';
		return view('web.cookie')->with ( $data );
	}

	public function showRoutineDetailPage($id){

		$RoutineName = new RoutineType();
		$getTypeNameLov = new TypeName();

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['routineById'] = $RoutineName->getAllRouteByIdForWebiste($id);
		$data['getTypeNameLov'] = $getTypeNameLov->getTypeNameLovWithSteps($id);

// 		 dd($data['routine']);
		$data['page'] = 'Routine';
		return view('web.routine-details')->with ( $data );
	}
	public function getAllRouteByNameForWebiste(){

		$RoutineName = new RoutineType();

		$dataArray = $RoutineName->getRoutineTypeData();

		return $dataArray;

	}


	public function ecoVibes() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Eco Vibes';
		return view('web.eco-vibes')->with ( $data );
	}
	public function lustyLooks() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Lusty Looks';
		return view('web.lusty-looks')->with ( $data );
	}

	public function successPage() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		// $data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Success';
		return view('web.success_message')->with ( $data );
	}
	public function successPageGiving() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Success';
		return view('web.success_message_giving')->with ( $data );
	}

	public function errorPage() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Error';
		return view('web.error_message')->with ( $data );
	}

	public function successPageSub() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'store';
		return view('web.success_message_sub')->with ( $data );
	}

   	public function store() {

   		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();

   		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();

		$data['routine'] = $this->getAllRouteByNameForWebiste();

		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();

        // dd($data);

    	$data['page'] = 'store';
        // dd('ehllo');
       return view('web.store-all')->with ( $data );
   	}



   	public function storeListing($category,$subcategory=null)
    {

      $Category = new CategoryModel();

        if(!isset($_REQUEST['sourceId']) && !isset($_REQUEST['sourceType'])) {

            if(isset($category) && isset($subcategory) ) {

                $name = $category;
                $reversedName = str_replace('-', ' ', $name);
                $categoryNameFromSlug = $reversedName;

                $result = DB::table('jb_category_tbl')->select('*')->where('CATEGORY_NAME',$categoryNameFromSlug)->first();
                if(isset($result)){
                    $_REQUEST['sourceId'] = $result->CATEGORY_ID;
                    $_REQUEST['sourceType'] = 'CATEGORY';
                } else {
                   abort(404);
                }

                $name = $subcategory;
                $reversedName = str_replace('-', ' ', $name);
                $subCategoryNameFromSlug = $reversedName;

                $result = DB::table('jb_sub_category_tbl')->select('*')->where('NAME',$subCategoryNameFromSlug)->first();
                    if(isset($result)){
                        $_REQUEST['sourceId'] = $result->SUB_CATEGORY_ID;
                        $_REQUEST['sourceType'] = 'SUB_CATEGORY';
                    }
                    else{
                       abort(404);
                    }
            }
            elseif(empty($subcategory) && !empty($category))
            {
                $name = $category;
                $reversedName = str_replace('-', ' ', $name);
                $categoryNameFromSlug = $reversedName;
                $result = DB::table('jb_category_tbl')->select('*')->where('CATEGORY_NAME',$categoryNameFromSlug)->first();
                if(isset($result->CATEGORY_ID)){
                    $_REQUEST['sourceId'] = $result->CATEGORY_ID;
                    $_REQUEST['sourceType'] = 'CATEGORY';
                    // $validated =  $this->validateSubCategory($category,$subcategory);
                }else
                {
                    abort(404);
                }
            }
        }
   		$sourceId = isset($_REQUEST['sourceId']) ? $_REQUEST['sourceId'] : "";
   		$sourceType = isset($_REQUEST['sourceType']) ? $_REQUEST['sourceType'] : "";

   		if($sourceType == 'CATEGORY'){
            $subCatArray = $Category->getAllSubCategoryIdsWrtCategoryId($sourceId);

   			$subSubCatArray = $Category->getAllSubCategoryDetailsWrtSubCategoryId($subCatArray != null ? $subCatArray : array());

   			$data ['categoryFilter'] = $subSubCatArray;
            $data ['categoryName'] = $Category->getSpecificCategoryData($sourceId);

   			$data['routine'] = $this->getAllRouteByNameForWebiste();
			$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
   			$data ['subCategoryName'] = '';
   			$data ['sourceId'] = $sourceId;
   			$data ['flag'] = 'CATEGORY';
   		}
        elseif($sourceType == 'SUB_CATEGORY')
        {
			$subSubCatArray = $Category->getAllSubCategoryDetailsWrtSubCategoryId1($sourceId);

   			$data ['categoryFilter'] = $subSubCatArray;
   			$data ['subCategoryName'] = $Category->getSpecificSubCategoryData($sourceId);
   			$data ['categoryName'] = $Category->getSpecificCategoryData($data ['subCategoryName']['CATEGORY_ID']);
   			$data ['routine'] = $this->getAllRouteByNameForWebiste();
			$data ['routineformbl'] = $this->getAllRouteByNameForWebiste();
			$data ['sourceId'] = $sourceId;
   			$data ['flag'] = 'SUB_CATEGORY';
   		}

   		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
   		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();

        if(isset($data ['categoryName']) && $data ['categoryName'] != '')
        {
            $CategoryNameNutrition = $data ['categoryName']['NAME'];
            $CategoryNameNutritionLower = strtolower($CategoryNameNutrition);
            $CategoryNameNutritionFirstCap = ucfirst($CategoryNameNutritionLower);

            if($CategoryNameNutritionFirstCap == 'Nutrition')
            {		// if neutrition category then load nutrition sub category page
                $data ['subCategoriesList'] = $Category->getAllSubCategoriesWrtCategory($data ['categoryName']['ID']);
                $data ['page'] = 'nutrition';
                return view ( 'web.nutrition' )->with ( $data );
            }
            else
            {
            $data['page'] = 'store';
            return view('web.store')->with ( $data );
            }
        }
        else
        {
            return redirect('/home');
        }
   	}



  	public function blogPage() {
  		$BlogsModel = new BlogsModel();

  		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
  		$data ['ourblog'] = $BlogsModel ->getSpecificOurBlogsData(1);
  		$data ['blogs'] = $BlogsModel ->getAllActiveBlogsData();
  		$data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'Blog Page';
		return view ( 'web.blog-page' )->with ( $data );
	}
	public function blogDetails($slug='') {
		$BlogsModel = new BlogsModel();

		if($slug != ''){
			$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  			$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
			$data ['blogDetail'] = $BlogsModel ->getSpecificBlogsData($slug);
			$data['routine'] = $this->getAllRouteByNameForWebiste();
			$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
			$data ['page'] = 'Blog Detail';
			return view ( 'web.blog-detail-page' )->with ( $data );
		}else{
			redirect('home');
		}

	}

	public function subscription() {
		$Products = new ProductModel();
		$UserdashboardModel = new UserdashboardModel();

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['recommandedProducts'] = $Products->getRecommandedProductDetailsForSite();
		$data ['trending'] = $UserdashboardModel->getAllUserHomeProductSectionData1('trending');
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();

		$data ['page'] = 'subscription';
		return view ( 'web.subscription' )->with ( $data );
	}
	public function userSubscriptions() {
		$CloverController = new CloverController();

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['pakmskey'] = $CloverController->getPakmsKey();
		$data ['page'] = 'User Subscriptions';
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.userSubscriptions' )->with ( $data );
	}

//    	public function productDetail() {

//    		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
// 		$data ['page'] = 'product Detail';
// 		return view ( 'web.product-detail' )->with ( $data );
// 	}
	public function getQuickViewProductDetails(Request $r){
		$Products = new ProductModel();
		$ProductShade = new ProductShadeModel();
		$Bundle = new BundleProductModel();
		$BundleLine = new BundleProductLineModel ();
		$SubscriptionModel = new SubscriptionModel();
		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$productType = $details ['productType'];
		$arrRes ['subscriptions'] = $SubscriptionModel->getAllActiveSubscriptionsLov($productId);

		if(strtoupper($productType) == 'BUNDLE' || strtoupper($productType) == 'BUNDLES'){

			$arrRes ['productDetails'] = $Bundle->getSpecificBundleProductDetails($productId);
			$arrRes ['productBundleLines'] = $BundleLine->getAllBundleProductLinesForWebsite($productId);
			$arrRes ['shades'] = $BundleLine->getAllBundleProductLineIdsWrtBundleId($productId);

			$arrRes ['done'] = true;
			$arrRes ['msg'] = '';
			echo json_encode ( $arrRes );
			die ();

		}else{
			if($productId != ''){
				$arrRes ['shades'] = $ProductShade->getAllProductShadesWithImagByProduct($productId);
			}
			$arrRes ['productDetails'] = $Products->getSpecificProductDetails($productId);

			$arrRes ['done'] = true;
			$arrRes ['msg'] = '';
			echo json_encode ( $arrRes );
			die ();
		}
	}


	public function productDetail($category,$subCategory=null,$slug=null) {
        // dd($subCategory);

        // if($slug == null){
        //     // dd($subCategory);
        //     $slug = $subCategory;
        // }

        $ProductShade = new ProductShadeModel();
		$Products = new ProductModel();
		$ProductIngredient = new ProductIngredientModel();
		$ProductUses = new ProductUsesModel();
		$Bundle = new BundleProductModel();
		$BundleLine = new BundleProductLineModel ();
        $features= new Feature();
		$handpicked= new Handpicked();
		$recomended= new Recomended();
		$ProductSelfiModel = new ProductSelfiModel();



        if(!isset($_REQUEST['sourceId']))
		{
            if($slug == null){
                $slugByName = $subCategory;
				$subCategory = null;
            }else if($slug != null){
                $slugByName = $slug;
            }
			if ($subCategory != null && ($subCategory == 'Bundles' || $subCategory == 'bundles')) {
				$result = DB::table('jb_bundle_product_tbl')->select('BUNDLE_ID')->where('SLUG', $slugByName)->first();
				if (isset($result)) {
					$_REQUEST['sourceId'] = $result->BUNDLE_ID;
					$validated = $this->validateParameters($category, $subCategory, $slug);
					if ($validated == false) {
						dd('invalid parameters');
						abort(404);
					}
				} else {
					abort(404);
				}
			} else if ($subCategory != null && ($subCategory != 'Bundles' && $subCategory != 'bundles')) {
				$result = DB::table('jb_product_tbl')->select('PRODUCT_ID')->where('SLUG', $slugByName)->first();
				if (isset($result)) {
					$_REQUEST['sourceId'] = $result->PRODUCT_ID;
					$validated = $this->validateParameters($category, $subCategory, $slugByName);
					if ($validated == false) {
						abort(404);
					}
				} else {
					abort(404);
				}
			} else if($subCategory == null){
                $result = DB::table('jb_product_tbl')->select('PRODUCT_ID')->where('SLUG', $slugByName)->first();
				if (isset($result)) {
					$_REQUEST['sourceId'] = $result->PRODUCT_ID;
					$validated = $this->validateParameters($category, $subCategory, $slugByName);
					if ($validated == false) {
						// dd('invalid parameters');
						abort(404);
					}
				} else {
					// dd('invalid slug');
					abort(404);
				}
            }
		}

        $sourceId = isset($_REQUEST['sourceId']) ? $_REQUEST['sourceId'] : "";
		$sourceType = isset($_REQUEST['sourceType']) ? $_REQUEST['sourceType'] : "";
		$sourceCode = isset($_REQUEST['sourceCode']) ? $_REQUEST['sourceCode'] : "";

		if(strtoupper($sourceCode) == 'BUNDLE' || strtoupper($sourceCode) == 'BUNDLES'){

			$data['features'] = $features->getspecificproductdata($sourceId);
			$data ['bundleDetails'] = $Bundle->getSpecificBundleProductDetails($sourceId);

			$data ['bundleLines'] = $BundleLine->getAllBundleProductLinesForWebsite($sourceId);
			// dd($data ['bundleLines']);
			$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  			$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();

  			// $data ['recommandedProducts'] = $Products->getRecommandedProductDetailsForSite();
  			$data ['recommandedProducts'] = $recomended->getrecomendedproducts($sourceId);
            // dd($data['recommandedProducts']);
			$data ['productselfi'] = $ProductSelfiModel->getAllProductsSelfie($sourceId);
			// $data ['productDetails'] = $Products->getSpecificProductDetails($sourceId);

     		$data ['handpicked'] = $handpicked->gethanpickedproducts($sourceId);

  			$data ['recentViewedProducts'] = $Products->getRecentlyViewedProductDetailsForSite();
            //   dd($data['recentViewedProducts']);

  			$data['routine'] = $this->getAllRouteByNameForWebiste();
			$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
			$data ['page'] = 'product Detail';

			return view ( 'web.bundle-detail' )->with ( $data );

		}
        else
        {


			$data ['features'] = $features->getspecificproductdata($sourceId);
			$data ['productDetails'] = $Products->getSpecificProductDetails($sourceId);
            // dd($data['productSubscriptionImage']);
			// dd($data ['features']);

// 			print_r('<pre>');
// 			print_r($data);
// 			exit();
			$data ['spotlightIngredients'] = $ProductIngredient->getAllProductIngredientWrtType($sourceId, 'Spotlight');
			$data ['formulatedIngredients'] = $ProductIngredient->getAllProductIngredientWrtType($sourceId, 'Formulated');
			$data ['allIngredients'] = $ProductIngredient->getAllProductIngredientByProduct($sourceId);
			$data ['productUses'] = $ProductUses->getAllProductUsesLimitedByProductId($sourceId);

			$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  			$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();

  		    	// $data ['recommandedProducts'] = $Products->getRecommandedProductDetailsForSite();
			$data ['recommandedProducts'] = $recomended->getrecomendedproducts($sourceId);
			$data ['handpicked'] = $handpicked->gethanpickedproducts($sourceId);

			$data ['productselfi'] = $ProductSelfiModel->getAllProductsSelfie($sourceId);

  			$data ['recentViewedProducts'] = $Products->getRecentlyViewedProductDetailsForSite();

			$data['routine'] = $this->getAllRouteByNameForWebiste();
			$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
			$data ['page'] = 'product Detail';
			return view ( 'web.product-detail' )->with ( $data );
		}
    }


    public function validateParameters($category,$subCategory,$slug){


        // if ($subCategory != null && $slug != null) {
        //     dd('sb not null');
        //     $subCategorySlugByName = $subCategory;
        // } else {
        //     dd('sb null');
        //     $subCategorySlugByName = $slug;
        // }

        // if($slug != null && $subCategory != null){
        //     $slug = $slug;
        // }else

        // dd($subCategory);
        // if($category != null  && $subCategory != null && $slug != null){

        // }
        if($slug == null ){
            $slug = $subCategory;
            $subCategory = null;
        }


        // dd($slug);



            $checkingSubCategory = $subCategory;
            $reversedSubCategoryName = str_replace('-', ' ', $checkingSubCategory);
            $SubCategorySlugByName = $reversedSubCategoryName;


            $checkingCategory = $category;
            $reversedCategoryName = str_replace('-', ' ', $checkingCategory);
            $CategorySlugByName = $reversedCategoryName;



            if ($subCategory != null && (strtolower($subCategory) == 'bundles')) {
                // dd('bundle');
                if (isset($slug)) {
                    // dd('slug found');
                    $productIdFromSlug = DB::table('jb_bundle_product_tbl')->select('BUNDLE_ID')->where('SLUG', $slug)->first();
                    if (isset($productIdFromSlug)) {
                        // echo 'Product Id Found through Slug';
                        // dd('sub category is missing');
                        if (isset($subCategory)) {
                            // echo 'subcategory is here';
                            $subCategoryIdFromSlug = DB::table('jb_bundle_product_tbl as prd')
                                ->select('prd.BUNDLE_ID', 'cat.CATEGORY_ID', 'cat.SUB_CATEGORY_ID')
                                ->join('jb_sub_category_tbl as cat', 'prd.CATEGORY_ID', '=', 'cat.CATEGORY_ID')
                                ->where(function ($query) use ($SubCategorySlugByName) {
                                    $query->where('cat.NAME', $SubCategorySlugByName);
                                })
                                ->first();

                            if (isset($subCategoryIdFromSlug)) {
                                // echo 'Sub category matched';
                                if (isset($category)) {
                                    // echo 'category is here';
                                    $CategoryIdFromSlug = DB::table('jb_bundle_product_tbl as prd')
                                        ->select('prd.BUNDLE_ID', 'cat.CATEGORY_ID')
                                        ->join('jb_category_tbl as cat', 'prd.CATEGORY_ID', '=', 'cat.CATEGORY_ID')
                                        ->where(function ($query) use ($CategorySlugByName) {
                                            $query->where('cat.CATEGORY_NAME', $CategorySlugByName);
                                        })
                                        ->first();

                                    if (isset($CategoryIdFromSlug)) {
                                        // echo 'category matched';
                                        if (strtolower($subCategory) == 'bundle' || strtolower($subCategory) == 'bundles') {
                                            // dd('Bundle will load');
                                            $_REQUEST['sourceId'] = $productIdFromSlug->BUNDLE_ID;
                                            $_REQUEST['sourceType'] = '';
                                            $_REQUEST['sourceCode'] = 'bundle';
                                            // dd($_REQUEST['sourceId']);
                                            return $_REQUEST;
                                        } else {
                                            // dd('Listing will load');
                                            $_REQUEST['sourceId'] = $productIdFromSlug->BUNDLE_ID;
                                            $_REQUEST['sourceType'] = '';
                                            $_REQUEST['sourceCode'] = '';
                                            // dd($_REQUEST['sourceId']);
                                            return $_REQUEST;
                                        }
                                    } else {
                                        // echo 'category did not match';
                                        // abort(404);
                                        return false;
                                    }
                                } else {
                                    // echo 'category is not here';
                                    // abort(404);
                                    return false;
                                }
                            } else {
                                // echo 'Sub category did not match';
                                // abort(404);
                                return false;
                            }
                        } else {
                            // echo 'subcategory is not here';
                            // dd('sub category is missing');
                            // $productIdFromSlug = DB::table('jb_product_tbl')->select('PRODUCT_ID')->where('SLUG',$slug)->orWhere('NAME',$slugByName)->first();
                            if (isset($productIdFromSlug)) {
                                if (isset($category)) {
                                    // dd('slug and category');
                                    $CategoryIdFromSlug = DB::table('jb_bundle_product_tbl as prd')
                                        ->select('prd.BUNDLE_ID', 'cat.CATEGORY_ID')
                                        ->join('jb_category_tbl as cat', 'prd.CATEGORY_ID', '=', 'cat.CATEGORY_ID')
                                        ->where(function ($query) use ($CategorySlugByName) {
                                            $query->where('cat.CATEGORY_NAME', $CategorySlugByName);
                                        })
                                        ->first();

                                    if (isset($CategoryIdFromSlug)) {
                                        if (strtolower($subCategory) == 'bundle' || strtolower($subCategory) == 'bundles') {
                                            $_REQUEST['sourceId'] = $productIdFromSlug->BUNDLE_ID;
                                            $_REQUEST['sourceType'] = '';
                                            $_REQUEST['sourceCode'] = 'bundle';
                                            return $_REQUEST;
                                        } else {
                                            $_REQUEST['sourceId'] = $productIdFromSlug->BUNDLE_ID;
                                            $_REQUEST['sourceType'] = '';
                                            $_REQUEST['sourceCode'] = '';
                                            return $_REQUEST;
                                        }
                                    } else {
                                        // abort(404);
                                        return false;
                                    }
                                } else {
                                    // abort(404);
                                    return false;
                                }
                            } else {
                                // abort(404);
                                return false;
                            }
                        }
                    } else {
                        dd('Product Id was not Found through Slug');
                        // abort(404);
                        return false;
                    }
                } else {
                    // echo 'Slug is here';
                    // abort(404);
                    return false;
                }
            } elseif ($subCategory != null && (strtolower($subCategory) != 'bundles')) {
                // dd($subCategory);
                if (isset($slug)) {
                    $productIdFromSlug = DB::table('jb_product_tbl')->select('PRODUCT_ID')->where('SLUG', $slug)->first();
                    // dd($productIdFromSlug);
                    if (isset($productIdFromSlug)) {
                        // echo 'Product Id Found through Slug';
                        // dd('sub category is missing');
                        // dd($subCategory);
                        if (isset($subCategory)) {
                            // echo 'subcategory is here';
                            $subCategoryIdFromSlug = DB::table('jb_product_tbl as prd')
                                ->select('prd.PRODUCT_ID', 'cat.CATEGORY_ID', 'cat.SUB_CATEGORY_ID')
                                ->join('jb_sub_category_tbl as cat', 'prd.CATEGORY_ID', '=', 'cat.CATEGORY_ID')
                                ->where(function ($query) use ($SubCategorySlugByName) {
                                    $query->where('cat.NAME', $SubCategorySlugByName);
                                })
                                ->first();

                            if (isset($subCategoryIdFromSlug)) {
                                // echo 'Sub category matched';
                                if (isset($category)) {
                                    // echo 'category is here';
                                    $CategoryIdFromSlug = DB::table('jb_product_tbl as prd')
                                        ->select('prd.PRODUCT_ID', 'cat.CATEGORY_ID')
                                        ->join('jb_category_tbl as cat', 'prd.CATEGORY_ID', '=', 'cat.CATEGORY_ID')
                                        ->where(function ($query) use ($CategorySlugByName) {
                                            $query->where('cat.CATEGORY_NAME', $CategorySlugByName);
                                        })
                                        ->first();

                                    if (isset($CategoryIdFromSlug)) {
                                        // echo 'category matched';
                                        if (strtolower($subCategory) == 'bundle' || strtolower($subCategory) == 'bundles') {
                                            // dd('Bundle will load');
                                            $_REQUEST['sourceId'] = $productIdFromSlug->PRODUCT_ID;
                                            $_REQUEST['sourceType'] = '';
                                            $_REQUEST['sourceCode'] = 'bundle';
                                            // dd($_REQUEST['sourceId']);
                                            return $_REQUEST;
                                        } else {
                                            // dd('Listing will load');
                                            $_REQUEST['sourceId'] = $productIdFromSlug->PRODUCT_ID;
                                            $_REQUEST['sourceType'] = '';
                                            $_REQUEST['sourceCode'] = '';
                                            // dd($_REQUEST['sourceId']);
                                            return $_REQUEST;
                                        }
                                    } else {
                                        // echo 'category did not match';
                                        // abort(404);
                                        return false;
                                    }
                                } else {
                                    // echo 'category is not here';
                                    // abort(404);
                                    return false;
                                }
                            } else {
                                // echo 'Sub category did not match';
                                // abort(404);
                                return false;
                            }
                        } else {
                            // echo 'subcategory is not here';
                            // dd('sub category is missing');
                            // $productIdFromSlug = DB::table('jb_product_tbl')->select('PRODUCT_ID')->where('SLUG',$slug)->orWhere('NAME',$slugByName)->first();
                            if (isset($productIdFromSlug)) {
                                dd($category);
                                if (isset($category)) {
                                    // dd('slug and category');
                                    $CategoryIdFromSlug = DB::table('jb_product_tbl as prd')
                                        ->select('prd.PRODUCT_ID', 'cat.CATEGORY_ID')
                                        ->join('jb_category_tbl as cat', 'prd.CATEGORY_ID', '=', 'cat.CATEGORY_ID')
                                        ->where(function ($query) use ($CategorySlugByName) {
                                            $query->where('cat.CATEGORY_NAME', $CategorySlugByName);
                                        })
                                        ->first();

                                    if (isset($CategoryIdFromSlug)) {
                                        if (strtolower($subCategory) == 'bundle' || strtolower($subCategory) == 'bundles') {
                                            $_REQUEST['sourceId'] = $productIdFromSlug->PRODUCT_ID;
                                            $_REQUEST['sourceType'] = '';
                                            $_REQUEST['sourceCode'] = 'bundle';
                                            return $_REQUEST;
                                        } else {
                                            $_REQUEST['sourceId'] = $productIdFromSlug->PRODUCT_ID;
                                            $_REQUEST['sourceType'] = '';
                                            $_REQUEST['sourceCode'] = '';
                                            return $_REQUEST;
                                        }
                                    } else {
                                        // abort(404);
                                        return false;
                                    }
                                } else {
                                    // abort(404);
                                    return false;
                                }
                            } else {
                                // abort(404);
                                return false;
                            }
                        }
                    } else {
                        // dd('Product Id was not Found through Slug');
                        // abort(404);
                        return false;
                    }
                } else {
                    // echo 'Slug is here';
                    // abort(404);
                    return false;
                }
            }

            else if($subCategory == null)
            {
                // if ($subCategory != null) {
                //     // dd('sb not null');
                //     $subCategorySlugByName = $subCategory;
                // } else {
                //     // dd('sb null');
                //     $subCategorySlugByName = $slug;
                // }
                    // dd($slug);
                    // $productIdFromSlug = DB::table('jb_product_tbl')->select('PRODUCT_ID')->where('SLUG',$slugByName)->first();
                    if (isset($slug)) {
                        $productIdFromSlug = DB::table('jb_product_tbl')->select('PRODUCT_ID')->where('SLUG', $slug)->first();

                        if (isset($productIdFromSlug)) {
                            // echo 'Product Id Found through Slug';
                            // dd('sub category is missing');

                            if (isset($category)) {
                                // echo 'subcategory is here';
                                // dd()
                                $CategoryIdFromSlug = DB::table('jb_product_tbl as prd')
                                    ->select('prd.PRODUCT_ID', 'cat.CATEGORY_ID', 'cat.CATEGORY_NAME')
                                    ->join('jb_category_tbl as cat', 'prd.CATEGORY_ID', '=', 'cat.CATEGORY_ID')
                                    ->where(function ($query) use ($CategorySlugByName) {
                                        $query->where('cat.CATEGORY_NAME', $CategorySlugByName);
                                    })
                                    ->first();
                                    // dd($CategoryIdFromSlug);
                                if (isset($CategoryIdFromSlug)) {
                                    // dd('Listing will load');
                                    $_REQUEST['sourceId'] = $productIdFromSlug->PRODUCT_ID;
                                    $_REQUEST['sourceType'] = '';
                                    $_REQUEST['sourceCode'] = '';
                                    // dd($_REQUEST['sourceId']);
                                    return $_REQUEST;
                                } else {
                                    // echo 'category is not here';
                                    // abort(404);
                                    return false;
                                }
                            }
                        } else {
                            // dd('Product Id was not Found through Slug');
                            // abort(404);
                            return false;
                        }
                    } else {
                        // echo 'Slug is here';
                        // abort(404);
                        return false;
                    }

            }



        // }
    }

	public function orderDetail() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.order-detail' )->with ( $data );
	}

	public function becomePartner() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['page'] = 'becomePartner';
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.become_a_partner' )->with ( $data );
	}

	public function checkout() {

		$CloverController = new CloverController();

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['pakmskey'] = $CloverController->getPakmsKey();
// 		print_r($data ['pakmskey']);exit();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();

		$data ['page'] = 'checkout';
		return view ( 'web.checkout' )->with ( $data );
	}

	public function blogDetailPage() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['page'] = 'blogDetailPage';
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.blog-detail-page' )->with ( $data );
	}

	public function discover() {
		$ReviewsModel = new ReviewsModel();

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['page'] = 'discover';
		$data ['reviews'] = $ReviewsModel->getAllEnableReviewsForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.discover' )->with ( $data );
	}

	public function giving() {
		$CloverController = new CloverController();

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
  		$data ['pakmskey'] = $CloverController->getPakmsKey();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
  		$data ['page'] = 'giving';
		return view ( 'web.giving' )->with ( $data );
	}

	public function informationStep() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['page'] = 'informationStep';
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.information-step' )->with ( $data );
	}

	public function makeup() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['page'] = 'makeup';
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.makeup' )->with ( $data );
	}

	public function nutrition() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['page'] = 'nutrition';
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.nutrition' )->with ( $data );
	}

	public function payment() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'payment';
		return view ( 'web.payment' )->with ( $data );
	}

	public function reward() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'reward';
		return view ( 'web.reward' )->with ( $data );
	}

	public function UsershadeFinder() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'UsershadeFinder';
		return view ( 'web.user-shade-finder' )->with ( $data );
	}

	public function UserShadeFinderQuiz() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'UserShadeFinderQuiz';
		return view ( 'web.usershadefinderquiz' )->with ( $data );
	}

	public function shippingStep() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'shippingStep';
		return view ( 'web.shipping-step' )->with ( $data );
	}

	public function shoppingCart() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'shoppingCart';
		return view ( 'web.shopping-cart' )->with ( $data );
	}

	public function skincare() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'skincare';
		return view ( 'web.skincare' )->with ( $data );
	}

	public function userLogin(Request $r) {

		if(!$r->session()->has('userId')){

			$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  			$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
			  $data['routine'] = $this->getAllRouteByNameForWebiste();
			  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
			$data ['page'] = 'userLogin';
			return view ( 'web.user-login' )->with ( $data );

		}else{
			return redirect('userDashboard');
		}

	}

	public function userRegistration() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data ['page'] = 'userRegistration';
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		return view ( 'web.user-registration' )->with ( $data );
	}

	public function wishlist() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data ['page'] = 'wishlist';
		return view ( 'web.wishlist' )->with ( $data );
	}

	public function userDashboard() {
        $data['orders'] = $this->getTotalNumberOfOrders();
        $data['tickets'] = $this->getTotalNumberOfTickets();
        $data['subscriptions'] = $this->getTotalNumberOfSubscriptions();
		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		$data['routine'] = $this->getAllRouteByNameForWebiste();
		$data['routineformbl'] = $this->getAllRouteByNameForWebiste();
        // dd($data);
		$data['page'] = 'Dashboard';
		return view ('web.user-dashboard')->with($data);
	}

    public function getTotalNumberOfOrders(){
        $result = DB::table('jb_order_tbl')->where('USER_ID',session('userId'))->count();
        return $result;
    }
    public function getTotalNumberOfTickets(){
        $result = DB::table('jb_user_tickets_tbl')->where('USER_ID',session('userId'))->count();
        return $result;
    }
    public function getTotalNumberOfSubscriptions(){
        $result = DB::table('jb_user_subscription_tbl')->where('USER_ID',session('userId'))->count();
        return $result;
    }
	public function userProfile() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Profile';
		return view ( 'web.userProfile' )->with ( $data );
	}
	public function userChangePass() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Change Password';
		return view ( 'web.userChangePassword' )->with ( $data );
	}
	public function userOrders() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Orders';
		return view ( 'web.userOrders' )->with ( $data );
	}
	public function userTickets() {

		$data ['categoryProducts'] = $this->getProductsCategoriesWiseForWebiste();
  		$data ['footerSocialIcons'] = $this->getFooterSocialIconsDataForWebsite();
		  $data['routine'] = $this->getAllRouteByNameForWebiste();
		  $data['routineformbl'] = $this->getAllRouteByNameForWebiste();
		$data['page'] = 'Tickets';
		return view ( 'web.userTickets' )->with ( $data );
	}
	public function getProductsCategoriesWiseForWebiste() {
		$Products = new ProductModel();

		$productsArray = $Products->getProductsCategoryWiseForSite();
        // dd($productsArray);

		return $productsArray;
	}
	public function getFooterSocialIconsDataForWebsite() {
		$AddSocialIconsModel = new AddSocialIconsModel();

		$dataArray = $AddSocialIconsModel->getAllFooterSpcialIcons();

		return $dataArray;
	}


   /*================================= User Shade Finder Quiz code start ===============================*/

   	public function getAllUserShadeFinderQuizLov(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['options'] = $ShadeFinder->getAllShadeFinderOptionsData();

		echo json_encode ( $arrRes );
   	}

   	public function getLevelOneDetailsWrtOption(Request $request) {
   		$ShadeFinder = new ShadeFinderModel();

   		$details = $_REQUEST ['details'];
   		$optionId = isset($details ['optionId']) ? $details ['optionId'] : '';
   		$userId = $details ['userId'];

   		if($optionId != ''){
   			$optionDetails = $ShadeFinder->getSpecificShadeFinderLevelOneWrtOption($optionId);

   			if($optionDetails != null){
   				$arrRes ['levelOne'] = $optionDetails;
   				$arrRes ['levelOneType'] = $ShadeFinder->getSpecificShadeFinderLevelOneTypesByLevelOneIdForWebsite($optionDetails['LEVEL_ONE_ID']);
   			}else{
   				$arrRes ['levelOne'] = '';
   				$arrRes ['levelOneType'] = '';
   			}
   		}

   		echo json_encode ( $arrRes );
   	}
   	public function getshadeFinderQuizLevelTwoDetails(Request $request) {
   		$ShadeFinder = new ShadeFinderModel();
   		$ProductModel = new ProductModel();

   		$details = $_REQUEST ['details'];
   		$level1TypeId = isset($details ['recordId']) ? $details ['recordId'] : '';
   		$optionId = isset($details ['optionId']) ? $details ['optionId'] : '';
   		$optionTitle = isset($details ['optionTitle']) ? $details ['optionTitle'] : '';
   		$userId = $details ['userId'];

   		if($optionTitle == 'Yes'){

   			$leveldetails = $ShadeFinder->getSpecificShadeFinderLevel1TypeDetails($level1TypeId);

   			$primaryids = $leveldetails['LT_2'];

   			$recomids = $leveldetails['LT_3'];

   			$arrRes ['primaryProducts'] = $ProductModel->getAllProductsDataForShadeQuiz($primaryids);
   			$arrRes ['recommandedProducts'] = $ProductModel->getAllProductsDataForShadeQuiz($recomids);

   			$arrRes ['levelTypeImage'] = $ShadeFinder->getLatestLevel1TypeImageByLevel1Id($level1TypeId);

   		}else{

   			if($optionId != ''){
   				$leveldetails = $ShadeFinder->getSpecificShadeFinderLevelTwoWrtOption($optionId);

   				if($details != null){
   					$arrRes ['levelTwo'] = $leveldetails;
   					$arrRes ['levelTwoType'] = $ShadeFinder->getSpecificShadeFinderLevelTwoTypesForWebsite($level1TypeId);
   					$arrRes ['levelTypeImage'] = $ShadeFinder->getLatestLevel1TypeImageByLevel1Id($level1TypeId);
   				}else{
   					$arrRes ['levelTwo'] = '';
   					$arrRes ['levelTwoType'] = '';
   					$arrRes ['levelTypeImage'] = '';
   				}
   			}
   		}

   		echo json_encode ( $arrRes );
   	}

   	public function getshadeFinderQuizLevelThreeDetails(Request $request) {
   		$ShadeFinder = new ShadeFinderModel();
   		$ProductModel = new ProductModel();

   		$details = $_REQUEST ['details'];
   		$level2TypeId = isset($details ['recordId']) ? $details ['recordId'] : '';
   		$optionId = isset($details ['optionId']) ? $details ['optionId'] : '';
   		$userId = $details ['userId'];


   		if($optionId != ''){
   			$leveldetails = $ShadeFinder->getSpecificShadeFinderLevelThreeWrtOption($optionId);

   	   		if($details != null){
   				$arrRes ['levelThree'] = $leveldetails;
   				$arrRes ['levelThreeType'] = $ShadeFinder->getSpecificShadeFinderLevelThreeTypesForWebsite($level2TypeId);
   			}else{
   				$arrRes ['levelThree'] = '';
   				$arrRes ['levelThreeType'] = '';
   			}
   		}

   		echo json_encode ( $arrRes );
   	}

   	public function getshadeFinderQuizLevelFourDetails(Request $request) {
   		$ShadeFinder = new ShadeFinderModel();
   		$ProductModel = new ProductModel();

   		$details = $_REQUEST ['details'];
   		$level3TypeId = isset($details ['recordId']) ? $details ['recordId'] : '';
   		$optionId = isset($details ['optionId']) ? $details ['optionId'] : '';
   		$userId = $details ['userId'];


   		$leveldetails = $ShadeFinder->getSpecificShadeFinderLevel3TypeDetails($level3TypeId);

   		$primaryids = $leveldetails['LT_3'];

   		$recomids = $leveldetails['LT_4'];

   		$arrRes ['primaryProducts'] = $ProductModel->getAllProductsDataForShadeQuiz($primaryids);
   		$arrRes ['recommandedProducts'] = $ProductModel->getAllProductsDataForShadeQuiz($recomids);



   		echo json_encode ( $arrRes );
   	}
   /*================================= User Shade Finder Quiz code end ===============================*/


	public function getAllUserStoreListingLov(Request $request) {
        // dd('coming');
   		$ShadeModel = new ShadesModel();
   		$ProductModel = new ProductModel();
   		$BundleModel = new BundleProductModel();
   		$CategoryModel = new CategoryModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$sourceId = $details ['sourceId'];
   		$flag = $details ['flag'];
   		$catFlag = $details ['catFlag'];


   		$arrRes ['list1'] = $ShadeModel->getAllActiveShadesListing();

   		if($sourceId != ''){
   			if($flag == 'SUB_CATEGORY'){
   				$detail = $CategoryModel->getSpecificSubCategoryData($sourceId);
//    				$catFlag = 'Bundle';
   			}

   		}

   		if($catFlag == 'Bundle'){
   			$arrRes ['products'] = $BundleModel->getAllBundleProductDetailsWrtCatSubCatIdForShopListing($sourceId, $flag);
   		}else{

   			$arrRes ['products'] = $ProductModel->getAllProductDetailsWrtCatSubCatIdForShopListing($sourceId, $flag);

   		}

   		echo json_encode ( $arrRes );
   	}
   	public function getUserSearchStoreListing(Request $request) {
   		$ProductModel = new ProductModel();
   		$BundleModel = new BundleProductModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$sourceId = $details ['sourceId'];
   		$flag = $details ['flag'];
   		$catFlag = $details ['catFlag'];
   		$search = $details ['search'];

   		$subSubCategoryIds = isset($search['subsubcategory']) ? $search['subsubcategory'] : array();
   		$shadeId = isset($search['shadeId']) ? $search['shadeId'] : '';
   		$priceRange = isset($search['price']) ? $search['price'] : '';
   		$sortingType = isset($search['sortingType']) ? $search['sortingType'] : '';


   		if(count($subSubCategoryIds) <= 0 &&  $shadeId == '' && $priceRange == 'all' && $sortingType == ''){

   			if($catFlag == 'Bundle'){
   				$arrRes ['products'] = $BundleModel->getAllBundleProductDetailsWrtCatSubCatIdForShopListing($sourceId, $flag);
   			}else{
   				$arrRes ['products'] = $ProductModel->getAllProductDetailsWrtCatSubCatIdForShopListing($sourceId, $flag);
   			}

   		}else{

   			//    			if($subSubCategoryIds != '' && count($subSubCategoryIds) > 0){
   			//    				$subSubCategoryIdsStr = join("','",$subSubCategoryIds);
   			//    			}
   			//    			$subSubCategoryIdsStr = !empty($subSubCategoryIdsStr) ? $subSubCategoryIdsStr : '';

   			$minRange = '';
   			$maxRange = '';

   			if($priceRange != 'all'){
   				$pricing = explode('-', $priceRange);
   				$minRange = isset($pricing[0]) ? $pricing[0] : '';
   				$maxRange = isset($pricing[1]) ? $pricing[1] : '';
   			}

   			if($catFlag == 'Bundle'){
   				$arrRes ['products'] = $BundleModel->getAllBundleProductDetailsWrtCatSubCatIdForShopListing($sourceId, $flag, $subSubCategoryIds, $shadeId, $minRange, $maxRange,$sortingType);
   			}else{
   				$arrRes ['products'] = $ProductModel->getAllProductDetailsWrtCatSubCatIdForShopListing($sourceId, $flag, $subSubCategoryIds, $shadeId, $minRange, $maxRange,$sortingType);
   			}

   		}
   		echo json_encode ( $arrRes );
   	}

	public function getAllUserStoreListingAllLov(Request $request) {
   		$ShadeModel = new ShadesModel();
   		$ProductModel = new ProductModel();
   		$BundleModel = new BundleProductModel();
   		$CategoryModel = new CategoryModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$lowerlimit = $details ['lowerlimit'];

   		$arrRes ['products'] = $ProductModel->getAllProductDetailsForAllShopListing();
   		$arrRes ['list1'] = $ShadeModel->getAllActiveShadesListing();
   		$arrRes ['list2'] = $CategoryModel->getAllSubSubCategoryDetailsForFilter($lowerlimit);
        // dd($arrRes['products']);
   		echo json_encode ( $arrRes );
   	}
   	public function getUserSearchStoreListingAll(Request $request) {
   		$ProductModel = new ProductModel();
   		$BundleModel = new BundleProductModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$search = $details ['search'];

   		$subSubCategoryIds = isset($search['subsubcategory']) ? $search['subsubcategory'] : array();
   		$shadeId = isset($search['shadeId']) ? $search['shadeId'] : '';
   		$priceRange = isset($search['price']) ? $search['price'] : '';
   		$sortingType = isset($search['sortingType']) ? $search['sortingType'] : '';


   		if(count($subSubCategoryIds) <= 0 &&  $shadeId == '' && $priceRange == 'all' && $sortingType == ''){

   			$arrRes ['products'] = $ProductModel->getAllProductDetailsForAllShopListing();

   		}else{

   			$minRange = '';
   			$maxRange = '';

   			if($priceRange != 'all'){
   				$pricing = explode('-', $priceRange);
   				$minRange = isset($pricing[0]) ? $pricing[0] : '';
   				$maxRange = isset($pricing[1]) ? $pricing[1] : '';
   			}

   			$arrRes ['products'] = $ProductModel->getAllProductDetailsForAllShopListing( $subSubCategoryIds, $shadeId, $minRange, $maxRange,$sortingType);

   		}
   		echo json_encode ( $arrRes );
   	}
   	public function loadMoreSubCategoriesFilter(Request $request) {
   		$CategoryModel = new CategoryModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$lowerlimit = $details ['lowerlimit'];

   		$arrRes ['list2'] = $CategoryModel->getAllSubSubCategoryDetailsForFilter($lowerlimit);

   		echo json_encode ( $arrRes );
   	}


   	public function getAllUserStoreListingNutritionLov(Request $request) {
   		$ProductModel = new ProductModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$sourceId = $details ['sourceId'];
   		$flag = $details ['flag'];

   		$arrRes ['products'] = $ProductModel->getAllProductDetailsWrtSubCatIdForNutritionShopListing($sourceId, $flag);

   		echo json_encode ( $arrRes );
   	}
   	public function getAllUserStoreNutritionFilter(Request $request) {
   		$ProductModel = new ProductModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$sourceId = $details ['sourceId'];
   		$flag = $details ['flag'];

   		$arrRes ['products'] = $ProductModel->getAllProductDetailsWrtSubCatIdForNutritionShopListing($sourceId, $flag);

   		echo json_encode ( $arrRes );
   	}

   	public function saveUserReview(Request $request) {
   		$ReviewsModel = new ReviewsModel();
		$EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;

   		$details = $_REQUEST ['details'];
   		$data = $details ['review'];
   		$userId = $details ['userId'];

   		$arrRes = array ();
   		$arrRes ['done'] = false;
   		$arrRes ['msg'] = '';


   		if (isset ( $data ) && ! empty ( $data )) {

   			if ($data ['R_1'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Rate start score first.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['R_2'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Title is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['R_3'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Review is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['R_10'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Name is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data ['R_10']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Name must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['R_11'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Email is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['R_11'] != '') {
				if (! filter_var ( $data ['R_11'], FILTER_VALIDATE_EMAIL )) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Please enter valid Email Address.';
					echo json_encode ( $arrRes );
					die ();
				}
			}

//    			if ($data ['ID'] == '') {

   				$result = DB::table ( 'jb_reviews_tbl' )->insertGetId (
   						array ( 'USER_ID' => $userId,
   								'PRODUCT_ID' => isset($data['productId']) ? $data['productId'] : '',
   								'BUNDLE_ID' => isset($data['bundleId']) ? $data['bundleId'] : '',
   								'STAR_RATING' => $data ['R_1'],
   								'TITLE' => $data ['R_2'],
   								'REVIEW_DESCRIPTION' => $data ['R_3'],
   								'SKIN_TYPE' => $data ['R_4'],
   								'CLIMATE' => $data ['R_5'],
   								'AGE_RANGE' => $data ['R_6'],
   								'RECOMMAND_MURAD' => $data ['R_7'],
   								'SKIN_TYPE1' => $data ['R_8'],
   								'RECOMMAND_PRODUCT' => $data ['R_9'],
   								'USERNAME' => $data ['R_10'],
   								'EMAIL' => $data ['R_11'],
   								'STATUS' => 'inapproval',//in approval  published
   								'DATE' => date ( 'Y-m-d H:i:s' ),
   								'CREATED_BY' => $userId,
   								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   								'UPDATED_BY' => $userId,
   								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   						)
   						);

						// Getting data WRT MODULE_CODE
				$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('REVIEW');

				$message_username = str_replace("{User_Name}",$data ['R_10'],$emailConfigDetails['message']);

				$htmlbody=	'<tr>
								<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
									<p>Hello '.$data ['R_10'].',</p><br>
									'.$message_username.'
								</td>
							</tr>';


				$email_details['to_id'] = '';
				$email_details['to_email'] = $data ['R_11'];//useremail
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "REVIEW";

				$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

				$email_details['to_id'] = '';
				$email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $data ['R_11'];//useremail
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "REVIEW";

				$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

   				$arrRes ['done'] = true;
   				$arrRes ['msg'] = 'Review Posted Successfully...';
   				$arrRes ['ID'] = $result;
   				$arrRes ['reviews'] = $ReviewsModel->getAllPublishedReviewsByProductId($data['productId'],$data['bundleId']);
   				echo json_encode ( $arrRes );
   				die ();

//    			}
   		}
   	}
   	public function getAllProductDetailLov(Request $request) {

   		$ReviewsModel = new ReviewsModel();
   		$QuestionModel = new QuestionModel();
   		$ProductShade = new ProductShadeModel();
   		$Bundle = new BundleProductModel();
   		$BundleLine = new BundleProductLineModel();
   		$SubscriptionModel = new SubscriptionModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$productId = isset($details ['productId']) ? $details ['productId'] : '';
   		$bundleId = isset($details ['bundleId']) ? $details ['bundleId'] : '';
		// dd($bundleId);
   		$reviews = $ReviewsModel->getAllPublishedReviewsByProductId($productId,$bundleId);
   		$arrRes ['reviews'] = $reviews;
   		$arrRes ['questions'] = $QuestionModel->getAllPublishedQuestionsByProductId($productId,$bundleId);
   		$arrRes ['subscriptions'] = $SubscriptionModel->getAllActiveSubscriptionsLov($productId);
   		if($productId != ''){
   			$arrRes ['shades'] = $ProductShade->getAllProductShadesWithImagByProduct($productId);

   		}
   		if($bundleId != ''){
   			$arrRes ['shades'] = $BundleLine->getAllBundleProductLineIdsWrtBundleId($bundleId);

   		}
        // dd($arrRes['shades']);

   		$totalReviews = 0;
   		if(isset($reviews) && !empty($reviews)){
   			$totalReviews = count($reviews);
   			$allRatingSum=0;$one=0;$two=0;$three=0;$four=0;$five=0;
   			foreach($reviews as $value){
   				if($value['STAR_RATING'] == '1'){
   					$one = $one+1;
   				}else if($value['STAR_RATING'] == '2'){
   					$two = $two+1;
   				}else if($value['STAR_RATING'] == '3'){
   					$three = $three+1;
   				}else if($value['STAR_RATING'] == '4'){
   					$four = $four+1;
   				}else if($value['STAR_RATING'] == '5'){
   					$five = $five+1;
   				}
   				$allRatingSum = $allRatingSum+$value['STAR_RATING'];
   			}

   		}
   		if($totalReviews > 0){
   			$averageRating = $allRatingSum/$totalReviews;

   			$ratings['one'] = $one;
   			$ratings['two'] = $two;
   			$ratings['three'] = $three;
   			$ratings['four'] = $four;
   			$ratings['five'] = $five;
   			$ratings['oneRatingPercent'] = round(($one / $totalReviews) * 100, 2);
   			$ratings['twoRatingPercent'] = round(($two / $totalReviews) * 100, 2);
   			$ratings['threeRatingPercent'] = round(($three / $totalReviews) * 100, 2);
   			$ratings['fourRatingPercent'] = round(($four / $totalReviews) * 100, 2);
   			$ratings['fiveRatingPercent'] = round(($five / $totalReviews) * 100, 2);
   			$ratings['totalReviews'] = $totalReviews;
   			$ratings['allRatingSum'] = $allRatingSum;
   			$ratings['averageRating'] = round($averageRating,1);
   			$ratings['averageRatingRound'] = round($averageRating);
   		}else{
   			$ratings['one'] = 0;
	   		$ratings['two'] = 0;
	   		$ratings['three'] = 0;
	   		$ratings['four'] = 0;
	   		$ratings['five'] = 0;
	   		$ratings['oneRatingPercent'] = 0;
	   		$ratings['twoRatingPercent'] = 0;
	   		$ratings['threeRatingPercent'] = 0;
	   		$ratings['fourRatingPercent'] = 0;
	   		$ratings['fiveRatingPercent'] = 0;
	   		$ratings['totalReviews'] = 0;
	   		$ratings['allRatingSum'] = 0;
	   		$ratings['averageRating'] = '0.0';
	   		$ratings['averageRatingRound'] = 0;
   		}

   		$arrRes ['ratings'] = $ratings;

   		echo json_encode ( $arrRes );
   	}

	public function saveUserQuestion(Request $request) {
   		$QuestionModel = new QuestionModel();
		$EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;

   		$details = $_REQUEST ['details'];
   		$data = $details ['question'];
   		$userId = $details ['userId'];

   		$arrRes = array ();
   		$arrRes ['done'] = false;
   		$arrRes ['msg'] = '';


   		if (isset ( $data ) && ! empty ( $data )) {

   			if ($data ['Q_1'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Username is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data ['Q_1']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Username must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			if ($data ['Q_2'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Email is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data ['Q_2']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Email must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['Q_2'] != '') {
				if (! filter_var ( $data ['Q_2'], FILTER_VALIDATE_EMAIL )) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Please enter valid Email Address.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data ['Q_3'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = "Can't post empty question.";
				echo json_encode ( $arrRes );
				die ();
			}
   			if (strlen($data ['Q_3']) > 500) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Question must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
//    			if ($data ['ID'] == '') {

   				$result = DB::table ( 'jb_questions_tbl' )->insertGetId (
   						array ( 'USER_ID' => $userId,
   								'PRODUCT_ID' => isset($data['productId']) ? $data['productId'] : '',
   								'BUNDLE_ID' => isset($data['bundleId']) ? $data['bundleId'] : '',
   								'USERNAME' => $data ['Q_1'],
   								'EMAIL' => $data ['Q_2'],
   								'QUESTION' => $data ['Q_3'],

   								'STATUS' => 'inapproval',//in approval   published
   								'DATE' => date ( 'Y-m-d H:i:s' ),
   								'CREATED_BY' => $userId,
   								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   								'UPDATED_BY' => $userId,
   								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   						)
   						);
				// Getting data WRT MODULE_CODE
				$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('QUESTION');

				$message_username = str_replace("{User_Name}",$data ['Q_1'],$emailConfigDetails['message']);

				$htmlbody=	'<tr>
								<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
									<p>Hello '.$data ['Q_2'].',</p><br>
									'.$message_username.'
								</td>
							</tr>';


				$email_details['to_id'] = '';
				$email_details['to_email'] = $data ['Q_2'];//useremail
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "QUESTION";

				$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

				$email_details['to_id'] = '';
				$email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $data ['Q_2'];//useremail
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "QUESTION";

				$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

   				$arrRes ['done'] = true;
   				$arrRes ['msg'] = 'Question Posted Successfully...';
   				$arrRes ['ID'] = $result;
   				$arrRes ['questions'] = $QuestionModel->getAllPublishedQuestionsByProductId($data['productId'],$data['bundleId']);
   				echo json_encode ( $arrRes );
   				die ();

//    			}
   		}
   	}

   	public function addToCart(Request $r) {
   		$ShoppingcartModel = new ShoppingcartModel();
   		$ProductModel = new ProductModel();
   		$ProductShadeModel = new ProductShadeModel();
   		$BundleModel = new BundleProductModel();
   		$SubscriptionModel = new SubscriptionModel();

   		$userId = $r->input('userId');
   		$sourceId = $r->input('productId');
   		$quantity = $r->input('quantity');
   		$type = $r->input('type');
   		$subscheck = $r->input('subscheck');
   		$subsOptionId = $r->input('subsOptionId');

   		if($type == 'bundle'){
   			$prodshadeIds = $r->input('prodshadeIds');
   			$shadeIds = $r->input('shadeIds');
   			$shadeNames = $r->input('shadeNames');
   			$bundleProdIds = $r->input('productIds');

   		}else{
   			$prodshadeId = $r->input('prodshadeId');
   			$shadeId = $r->input('shadeId');
   			$shadeName = $r->input('shadeName');
   			$singleProdId = $r->input('productId');
   		}


   		if(session('userId') == ''){

   			$arrRes['done'] = false;
			$arrRes['flag'] = 0;
			$arrRes['redirectURL'] = url('/user-login');
   			$arrRes['msg'] = 'Kindly Login First.';
   			echo json_encode ( $arrRes );
   			die ();

   		}else{
//    			if(session()->has('cartid')){

//    				$cartId = session('cartid');

//    			}else{


   				if($userId != ''){

   					$cartDet = $ShoppingcartModel->getActiveCartWrtUserId($userId);

   					if(isset($cartDet['CART_ID'])){
   						$cartId = $cartDet['CART_ID'];
   					}else{
   						$cartId = DB::table ( 'jb_shopping_cart_tbl' )->insertGetId (
   								array ( 'USER_ID' => $userId,
   										'CART_EFFECTIVE_START_DATE' => date ( 'Y-m-d H:i:s' ),
   										'CHECKOUT_FLAG' => '0',
   										'STATUS' => '',
   										'CREATED_BY' => $userId,
   										'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   										'UPDATED_BY' => $userId,
   										'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   								)
   								);
   					}
   				}else{

   					$cartId = DB::table ( 'jb_shopping_cart_tbl' )->insertGetId (
   							array ( 'USER_ID' => $userId,
   									'CART_EFFECTIVE_START_DATE' => date ( 'Y-m-d H:i:s' ),
   									'CHECKOUT_FLAG' => '0',
   									'STATUS' => '',
   									'CREATED_BY' => $userId,
   									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   									'UPDATED_BY' => $userId,
   									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   							)
   							);
   				}
//    				session()->put('cartid', $cartId);
//    			}

   			if($type == 'bundle'){

   				$itemDetail = $BundleModel->getSpecificBundleProductDetails($sourceId);

   				if($prodshadeIds != '' && $shadeIds != '' && $shadeNames != '' && $bundleProdIds != ''){

   					$prodshadeIds1 = explode(',', $prodshadeIds);
   					$bundleProdIds1 = explode(',', $bundleProdIds);

   					if(count($prodshadeIds1) > 0){
   						for ($j=0; $j<count($prodshadeIds1); $j++){

   							$prodShadeDetail = $ProductShadeModel->getSpecificProductShadeDetails($prodshadeIds1[$j]);

   							if(isset($prodShadeDetail['QUANTITY']) && $prodShadeDetail['QUANTITY'] <= '0'){

   								$arrRes['done'] = false;
   								$arrRes['flag'] = 1;
   								$arrRes['msg'] = 'Unable to add this product in cart. Product "'.$prodShadeDetail['productName'].'" with your selected shade is not available in stock.';
   								echo json_encode ( $arrRes );
   								die ();
   							}

   						}
   					}
   				}else{
   					// check for product inventory quantity product wise
   					if($itemDetail['INV_QUANTITY'] <= '0'){

   						$arrRes['done'] = false;
   						$arrRes['flag'] = 1;
   						$arrRes['msg'] = 'Unable to add this product in cart. Product is not available in stock.';
   						echo json_encode ( $arrRes );
   						die ();
   					}
   				}

   				$bundleId = $sourceId;
   				$productId = '';
   				$unitPrice = $itemDetail['DISCOUNTED_AMOUNT1'];
   				$actualPrice = $itemDetail['TOTAL_AMOUNT1'] * $quantity;
   				$totalAmount = $itemDetail['DISCOUNTED_AMOUNT1'] * $quantity;

   				$vatPercent = $itemDetail['VAT_RATE'];
   				$vatAmount = ($vatPercent * $totalAmount) / 100;
   				$totalIncVat = $totalAmount + $vatAmount;
   				$discountAmount = 0;//$actualPrice - $totalAmount;
   				$productType = 'bundle';
   			}else{

   				$itemDetail = $ProductModel->getSpecificProductDetails($sourceId);

   				if($prodshadeId != '' && $prodshadeId != 'undefined'){
   					// check for product inventory quantity shade wise
   					$prodShadeDetail = $ProductShadeModel->getSpecificProductShadeDetails($prodshadeId);

   					if(isset($prodShadeDetail['QUANTITY']) && $prodShadeDetail['QUANTITY'] <= '0'){

   						$arrRes['done'] = false;
   						$arrRes['flag'] = 1;
   						$arrRes['msg'] = 'Unable to add this product in cart. Product is not available in stock.';
   						echo json_encode ( $arrRes );
   						die ();
   					}
   				}else{
   					// check for product inventory quantity product wise
   					if($itemDetail['INV_QUANTITY'] <= '0'){

   						$arrRes['done'] = false;
   						$arrRes['flag'] = 1;
   						$arrRes['msg'] = 'Unable to add this product in cart. Product is not available in stock.';
   						echo json_encode ( $arrRes );
   						die ();
   					}
   				}

   				$bundleId = '';
   				$productId = $sourceId;
   				$unitPrice = $itemDetail['unitPrice'];
   				$totalAmount = $itemDetail['unitPrice'] * $quantity;

   				$vatPercent = $itemDetail['TAX'];
   				$discount = $itemDetail['DISCOUNT'];
   				$discountType = $itemDetail['DISCOUNT_TYPE'];

   				$vatAmount = ($vatPercent * $totalAmount) / 100;
   				$totalIncVat = $totalAmount + $vatAmount;

   				if($discountType == 'Percent'){

   					$discountAmount = ($discount * $totalAmount) / 100;
   				}else{
   					$discountAmount = $discount;

   				}

   				$productType = 'product';
   			}


   			if(isset($itemDetail) && !empty($itemDetail)){

   				$cartLineId = DB::table ( 'jb_shopping_cart_detail_tbl' )->insertGetId (
   						array ( 'CART_ID' => $cartId,
   								'ADDED_EFFECTIVE_DATE' => date ( 'Y-m-d H:i:s' ),
   								'PRODUCT_ID' => $productId,
   								'BUNDLE_ID' => $bundleId,
   								'PRODUCT_TYPE' => $productType,
   								'QUANTITY' => $quantity,
   								'UNIT_PRICE' => round($unitPrice, 2),
   								'TOTAL_AMOUNT' => round($totalAmount, 2),

   								'VAT_PERCENT' => $vatPercent,
   								'VAT_AMOUNT' => round($vatAmount, 2),
   								'DISCOUNT_AMOUNT' => round($discountAmount, 2),
   								'TOTAL_AMOUNT_INC_VAT' => round($totalIncVat, 2),

   								'SUBSCRIPTION_CHECK' => $subscheck,
   								'SUBSCRIPTION_ID' => $subsOptionId,

   								'CREATED_BY' => $userId,
   								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   								'UPDATED_BY' => $userId,
   								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   						)
   					);


   				if($productType == 'bundle'){

   					if($prodshadeIds != '' && $shadeIds != '' && $shadeNames != '' && $bundleProdIds != ''){

   						$prodshadeIds1 = explode(',', $prodshadeIds);
   						$shadeIds1 = explode(',', $shadeIds);
   						$shadeNames1 = explode(',', $shadeNames);
   						$bundleProdIds1 = explode(',', $bundleProdIds);

   						if(count($prodshadeIds1) > 0){
   							for ($i=0; $i<count($prodshadeIds1); $i++){

   								$cartShadeLineId = DB::table ( 'jb_shopping_cart_shade_detail_tbl' )->insertGetId (
   										array ( 'CART_LINE_ID' => $cartLineId,
   												'ADDED_EFFECTIVE_DATE' => date ( 'Y-m-d H:i:s' ),
   												'PRODUCT_ID' => $bundleProdIds1[$i],
   												'PRODUCT_SHADE_ID' => $prodshadeIds1[$i],
   												'SHADE_ID' => $shadeIds1[$i],
   												'SHADE_NAME' => $shadeNames1[$i],
   												'CREATED_BY' => $userId,
   												'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   												'UPDATED_BY' => $userId,
   												'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   										)
   									);

   							}
   						}

   					}
   				}else{

   					if($prodshadeId != '' && $prodshadeId != 'undefined'){
   						$cartShadeLineId = DB::table ( 'jb_shopping_cart_shade_detail_tbl' )->insertGetId (
   								array ( 'CART_LINE_ID' => $cartLineId,
   										'ADDED_EFFECTIVE_DATE' => date ( 'Y-m-d H:i:s' ),
   										'PRODUCT_ID' => $productId,
   										'PRODUCT_SHADE_ID' => $prodshadeId,
   										'SHADE_ID' => $shadeId,
   										'SHADE_NAME' => $shadeName,
   										'CREATED_BY' => $userId,
   										'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   										'UPDATED_BY' => $userId,
   										'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   								)
   							);
   					}
   				}
   			}

   			$arrRes['done'] = true;
   			$arrRes['msg'] = 'Product added successfully.';
   			$arrRes['cartId'] = $cartId; //session('cartid');
   			$arrRes['cart'] = $ShoppingcartModel->getSpecificCartDetails($cartId);
   			$arrRes['cartDetails'] = $ShoppingcartModel->getSpecificCartLineDetails($cartId);

   			echo json_encode ( $arrRes );
   			die ();
   		}


   	}

   	public function loadCart(Request $r) {
   		$ShoppingcartModel = new ShoppingcartModel();
   		$ProductModel = new ProductModel();

   		$userId = $r->input('userId');
//    		$cartId = $r->input('cartId');

//    		if(session()->has('cartid')){

//    			$cartId = session('cartid');

//    		}else{
   			if($userId != ''){

   				$cartDet = $ShoppingcartModel->getActiveCartWrtUserId($userId);

   				if(isset($cartDet['CART_ID'])){
   					$cartId = $cartDet['CART_ID'];
   				}else{
   					$cartId = '';
   				}
   			}else{

   				$cartId = '';
   			}
//    		}

   		$arrRes['cartId'] = $cartId; //session('cartid');
   		$arrRes['cart'] = $ShoppingcartModel->getSpecificCartDetails($cartId);
   		$arrRes['cartDetails'] = $ShoppingcartModel->getSpecificCartLineDetails($cartId);
   		$wishlistCount = DB::table('jb_user_wishlist_tbl')->where('USER_ID', $userId)->count();
   		$arrRes['wishlistCount'] = "$wishlistCount";

   		echo json_encode ( $arrRes );
   		die ();

   	}

	   public function getProductShadesRightSideBar(Request $r) {
		$ShoppingcartModel = new ShoppingcartModel();

		$orderLineId = $r->cartLineId;

		$arrRes ['shadename'] = $ShoppingcartModel->getOrderLineProductShadesNameDetailCheckout($orderLineId);

		echo json_encode ( $arrRes );
		die ();

	}
   	public function removeCartItem(Request $r) {
   		$ShoppingcartModel = new ShoppingcartModel();
   		$ProductModel = new ProductModel();

   		$userId = $r->input('userId');
   		$cartId = $r->input('cartId');
   		$cartLineId = $r->input('cartLineId');

   		$delete = DB::table ( 'jb_shopping_cart_detail_tbl' )->where ( 'CART_LINE_ID', $cartLineId )->delete ();
   		$delete = DB::table ( 'jb_shopping_cart_shade_detail_tbl' )->where ( 'CART_LINE_ID', $cartLineId )->delete ();

   		$arrRes['cartId'] = $cartId; //session('cartid');
   		$arrRes['cart'] = $ShoppingcartModel->getSpecificCartDetails($cartId);
   		$arrRes['cartDetails'] = $ShoppingcartModel->getSpecificCartLineDetails($cartId);

   		echo json_encode ( $arrRes );
   		die ();

   	}

   	public function getAllCheckoutPageLov(Request $r) {
   		$ShoppingcartModel = new ShoppingcartModel();
   		$CountryModel = new CountryModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details['userId'];

//    		if(session()->has('cartid')){

//    			$cartId = session('cartid');

//    		}else{
   			if($userId != ''){

   				$cartDet = $ShoppingcartModel->getActiveCartWrtUserId($userId);

   				if(isset($cartDet['CART_ID'])){
   					$cartId = $cartDet['CART_ID'];
   				}else{
   					$cartId = '';
   				}
   			}else{

   				$cartId = '';
   			}
//    		}

   		$arrRes['list1'] = $CountryModel->getCountryLov();

   		$arrRes['cart'] = $ShoppingcartModel->getSpecificCartDetails($cartId);
   		$arrRes['cartDetails'] = $ShoppingcartModel->getSpecificCartLineDetails($cartId);

   		echo json_encode ( $arrRes );
   		die ();

   	}

   	public function postOrderCheckout(Request $request) {
   		$ShoppingcartModel = new ShoppingcartModel();
   		$SubscriptionModel = new SubscriptionModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$cartId = $details ['cartId'];
   		$shipping = $details ['shipping'];
   		$payment = $details ['payment'];

   		$arrRes = array ();
   		$arrRes ['done'] = false;
   		$arrRes ['msg'] = '';

   		if (isset ( $shipping ) && ! empty ( $shipping )) {

   			if ($shipping ['S_1'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Shipping First Name is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_1']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Shipping First Name must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			if ($shipping ['S_2'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Shipping Last Name is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_2']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Shipping Last Name must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			if ($shipping ['S_3'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Address is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_3']) > 500) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Address must be less then 500 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_4'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'APT/SUITE is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_4']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'APT/SUITE must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_5'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'City is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_5']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'City must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_6'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'State is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_6']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'State must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_7'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Zip Code is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_7']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Zip Code must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (!isset($shipping ['S_8']['id'])) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Country is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_9'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Email is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_9'] != '') {
   				if (! filter_var ( $shipping ['S_9'], FILTER_VALIDATE_EMAIL )) {
   					$arrRes ['done'] = false;
   					$arrRes ['msg'] = 'Please enter valid Email Address.';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   			}
   			if ($shipping ['S_10'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Phone Number is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_10']) > 15) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Please enter valid Phone Number.';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			if($payment['payType'] == 'credit'){

   				$temp = str_replace("-","",$payment ['P_1']);
   				$cardNumber = str_replace(" ","",$temp);

   				if ($cardNumber == '') {

   					$arrRes ['done'] = false;
   					$arrRes ['msg'] = 'Credit Card Number is required.';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   				if (strlen($cardNumber) != 16) {

   					$arrRes ['done'] = false;
   					$arrRes ['msg'] = 'Card Number is not valid.';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   				if ($payment ['P_2'] == '') {

   					$arrRes ['done'] = false;
   					$arrRes ['msg'] = 'Choose Expiry Month first.';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   				if ($payment ['P_3'] == '') {

   					$arrRes ['done'] = false;
   					$arrRes ['msg'] = 'Choose Expiry Year first.';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   				if ($payment ['P_4'] == '') {

   					$arrRes ['done'] = false;
   					$arrRes ['msg'] = 'Security Code is required.';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   			}

   			$cart = $ShoppingcartModel->getSpecificCartDetails($cartId);
   			$cartDetails = $ShoppingcartModel->getSpecificCartLineForOrder($cartId);

   			if($payment['payType'] == 'credit'){
   				$orderStatus = 'placed';
   			}else{
   				$orderStatus = 'payment in process';
   			}

   			$orderId = DB::table ( 'jb_order_tbl' )->insertGetId (
   					array ( 'USER_ID' => $userId,
   							'ORDER_DATE' => date ( 'Y-m-d H:i:s' ),
   							'ORDER_STATUS' => $orderStatus,

   							'CREATED_BY' => $userId,
   							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   							'UPDATED_BY' => $userId,
   							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   					)
   				);

   			if(isset($cartDetails) && !empty($cartDetails)){
   				foreach ($cartDetails as $line){

   					$orderLineId = DB::table ( 'jb_order_detail_tbl' )->insertGetId (
   							array ( 'ORDER_ID' => $orderId,
   									'PRODUCT_TYPE' => $line['PRODUCT_TYPE'],
   									'PRODUCT_ID' => $line['PRODUCT_ID'],
   									'BUNDLE_ID' => $line['BUNDLE_ID'],
   									'QUANTITY' => $line['QUANTITY'],
   									'UNIT_PRICE' => $line['UNIT_PRICE'],
   									'TOTAL_AMOUNT' => $line['TOTAL_AMOUNT'],

   									'VAT_PERCENT' => $line['VAT_PERCENT'],
   									'VAT_AMOUNT' => $line['VAT_AMOUNT'],
   									'DISCOUNT_AMOUNT' => $line['DISCOUNT_AMOUNT'],
   									'TOTAL_AMOUNT_INC_VAT' => $line['TOTAL_AMOUNT_INC_VAT'],

   									'SUBSCRIPTION_CHECK' => $line['SUBSCRIPTION_CHECK'],
   									'SUBSCRIPTION_ID' => $line['SUBSCRIPTION_ID'],

   									'CREATED_BY' => $userId,
   									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   									'UPDATED_BY' => $userId,
   									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   							)
   						);

   					$orderlineShades = $ShoppingcartModel->getCartLineProductShadesDetail($line['CART_LINE_ID']);

   					if(isset($orderlineShades) && !empty($orderlineShades)){

   						foreach($orderlineShades as $list){

   							$orderShadeLineId = DB::table ( 'jb_order_shade_detail_tbl' )->insertGetId (
   									array ( 'ORDER_LINE_ID' => $orderLineId,
   											'ADDED_EFFECTIVE_DATE' => date ( 'Y-m-d H:i:s' ),
   											'PRODUCT_ID' => $list['PRODUCT_ID'],
   											'PRODUCT_SHADE_ID' => $list['PRODUCT_SHADE_ID'],
   											'SHADE_ID' => $list['SHADE_ID'],
   											'SHADE_NAME' => $list['SHADE_NAME'],
   											'CREATED_BY' => $userId,
   											'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   											'UPDATED_BY' => $userId,
   											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   									)
   								);
   						}
   					}
   					// push data in subscription table in case product is subscribed
   					if($line['SUBSCRIPTION_CHECK'] == 'subscription'){

   						$subscrptionDetails = $SubscriptionModel->getSpecificSubscriptionData($line['SUBSCRIPTION_ID']);

   						if(isset($subscrptionDetails) && !empty($subscrptionDetails)){

   							$subsMonths = $subscrptionDetails['S_7']; // duration months
   							$subscriptionDate = date('Y-m-d');
   							$nextSubsDate = date ( "Y-m-d", strtotime ( "$subscriptionDate +$subsMonths month" ) );

   							$result = DB::table ( 'jb_user_subscription_tbl' )->insertGetId (
   									array ( 'USER_ID' => $userId,
   											'SUBSCRIPTION_ID' => $subscrptionDetails['ID'],
   											'ORDER_LINE_ID' => $orderLineId,
   											'PRODUCT_TYPE' => $line['PRODUCT_TYPE'],
		   									'PRODUCT_ID' => $line['PRODUCT_ID'],
		   									'BUNDLE_ID' => $line['BUNDLE_ID'],
   											'DURATION_MONTHS' => $subsMonths,
   											'SUBSCRIPTION_DATE' => $subscriptionDate,
   											'NEXT_PAYMENT_DATE' => $nextSubsDate,
   											'PAYMENT_STATUS' => 'pending',
   											'SUBSCRIPTION_STATUS' => 'active',

   											'DATE' => date ( 'Y-m-d H:i:s' ),
   											'CREATED_BY' => $userId,
   											'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   											'UPDATED_BY' => $userId,
   											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   									)
   								);
   						}
   					}
   				}
   			}

   			$shippingAddrId = DB::table ( 'jb_order_shipping_address_tbl' )->insertGetId (
   					array ( 'USER_ID' => $userId,
   							'ORDER_ID' => $orderId,
   							'FIRST_NAME' => isset($shipping ['S_1']) ? $shipping ['S_1'] : '',
   							'LAST_NAME' => isset($shipping ['S_2']) ? $shipping ['S_2'] : '',
   							'ADDRESS' => isset($shipping ['S_3']) ? $shipping ['S_3'] : '',
   							'APT_SUITE' => isset($shipping ['S_4']) ? $shipping ['S_4'] : '',
   							'CITY' => isset($shipping ['S_5']) ? $shipping ['S_5'] : '',
   							'STATE' => isset($shippinupdateg ['S_6']) ? $shipping ['S_6'] : '',
   							'ZIP_CODE' => isset($shipping ['S_7']) ? $shipping ['S_7'] : '',
   							'COUNTRY_ID' => isset($shipping ['S_8']['id']) ? $shipping ['S_8']['id'] : '',
   							'EMAIL' => isset($shipping ['S_9']) ? $shipping ['S_9'] : '',
   							'PHONE_NUMBER' => isset($shipping ['S_10']) ? $shipping ['S_10'] : '',
   							'BILLING_ADDRESS_FLAG' => isset($shipping ['S_11']) ? $shipping ['S_11'] : '',

   							'DATE' => date ( 'Y-m-d H:i:s' ),
   							'CREATED_BY' => $userId,
   							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   							'UPDATED_BY' => $userId,
   							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   					)
   				);

   			$paymentId = DB::table ( 'jb_order_payment_tbl' )->insertGetId (
   					array ( 'USER_ID' => $userId,
   							'ORDER_ID' => $orderId,
   							'PAYMENT_TYPE' => isset($payment['payType']) ? $payment['payType'] : '',
   							'CARD_NUMBER' => isset($payment['P_1']) ? $payment['P_1'] : '',
   							'EXPIRY_MONTH' => isset($payment ['P_2']) ? $payment ['P_2'] : '',
   							'EXPIRY_YEAR' => isset($payment ['P_3']) ? $payment ['P_3'] : '',
   							'SECURITY_CODE' => isset($payment ['P_4']) ? $payment ['P_4'] : '',
   							'PAYMENT_STATUS' => 'paid',

   							'DATE' => date ( 'Y-m-d H:i:s' ),
   							'CREATED_BY' => $userId,
   							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   							'UPDATED_BY' => $userId,
   							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   					)
   				);

   			$result = DB::table ( 'jb_shopping_cart_tbl' ) ->where ( 'CART_ID', $cartId ) ->update (
   					array ( 'CHECKOUT_FLAG' => '1',
   							'UPDATED_BY' => $userId,
   							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   					)
   				);
//    			session()->forget('cartid');
   			$arrRes ['done'] = true;
   			$arrRes ['msg'] = 'Order Placed Successfully...';
   			$arrRes ['redirect_url'] = url('/home');
   			echo json_encode ( $arrRes );
   			die ();


   		}
   	}

   	public function saveShippingInfo(Request $request) {
   		$ShoppingcartModel = new ShoppingcartModel();
   		$SubscriptionModel = new SubscriptionModel();
   		$ProductModel = new ProductModel();
   		$BundleProductLineModel = new BundleProductLineModel();
   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$cartId = $details ['cartId'];
   		$shipping = $details ['shipping'];
//    		$payment = $details ['payment'];

   		$arrRes = array ();
   		$arrRes ['done'] = false;
   		$arrRes ['msg'] = '';



   		if (isset ( $shipping ) && ! empty ( $shipping )) {

   			if($cartId != ''){

   				$carLines = $ShoppingcartModel->getSpecificCartLineDetailsForInvChk($cartId);

   				if(!empty($carLines)){

   					foreach ($carLines as $value){
   						if($value['flag'] == 'bundle'){

   							$bundleLines = $BundleProductLineModel->getAllBundleProductLinesForInvChk($value['BUNDLE_ID']);

   							if(!empty($bundleLines)){

   								foreach($bundleLines as $bundleLine){

   									$itemDetail = $ProductModel->getSpecificProductDetails($bundleLine['PRODUCT_ID']);

   									if($itemDetail['INV_QUANTITY_FLAG'] == 'shade'){

   										$cartLineShades = $ShoppingcartModel->getCartLineProductShadesDetailForInvChk($value['CART_LINE_ID']);

   										$slctShadeInvQty = $cartLineShades['shadeQuantity'];

   										if($slctShadeInvQty < $value['QUANTITY']){
   											$arrRes['done'] = false;
   											$arrRes['flag'] = 1;
   											$arrRes['msg'] = 'Bundle Product "'.$itemDetail['NAME'] ?? ''.'" with your selected shade is out of stock. kindly remove product then proceed to checkout. Thanks';
   											echo json_encode ( $arrRes );
   											die ();
   										}
   									}else{
   										if($itemDetail['INV_QUANTITY'] < $value['QUANTITY']){

   											$arrRes['done'] = false;
   											$arrRes['flag'] = 1;
   											$arrRes['msg'] = 'Bundle Product "'.$itemDetail['NAME'] ?? ''.'" with your selected shade is out of stock. kindly remove product then proceed to checkout. Thanks';
   											echo json_encode ( $arrRes );
   											die ();
   										}
   									}
   								}
   							}

   						}else{

   							$itemDetail = $ProductModel->getSpecificProductDetails($value['PRODUCT_ID']);

   							if($itemDetail['INV_QUANTITY_FLAG'] == 'shade'){

   								$cartLineShades = $ShoppingcartModel->getCartLineProductShadesDetailForInvChk($value['CART_LINE_ID']);

   								$slctShadeInvQty = $cartLineShades['shadeQuantity'] ?? '';

   								if($slctShadeInvQty < $value['QUANTITY']){
   									$arrRes['done'] = false;
			   						$arrRes['flag'] = 1;
			   						$arrRes['msg'] = 'Product "'.$itemDetail['NAME'].'" with your selected shade is out of stock. kindly remove product then proceed to checkout. Thanks';
			   						echo json_encode ( $arrRes );
			   						die ();
   								}
   							}else{
   								if($itemDetail['INV_QUANTITY'] < $value['QUANTITY']){

   									$arrRes['done'] = false;
			   						$arrRes['flag'] = 1;
			   						$arrRes['msg'] = 'Product "'.$itemDetail['NAME'].'" with your selected shade is out of stock. kindly remove product then proceed to checkout. Thanks';
			   						echo json_encode ( $arrRes );
			   						die ();
   								}
   							}
   						}
   					}
   				}
   			}
   			if ($shipping ['S_1'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Shipping First Name is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_1']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Shipping First Name must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			if ($shipping ['S_2'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Shipping Last Name is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_2']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Shipping Last Name must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			if ($shipping ['S_3'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Address is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_3']) > 500) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Address must be less then 500 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_4'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'APT/SUITE is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_4']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'APT/SUITE must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_5'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'City is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_5']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'City must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_6'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'State is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_6']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'State must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_7'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Zip Code is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_7']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Zip Code must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (!isset($shipping ['S_8']['id'])) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Country is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_9'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Email is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($shipping ['S_9'] != '') {
   				if (! filter_var ( $shipping ['S_9'], FILTER_VALIDATE_EMAIL )) {
   					$arrRes ['done'] = false;
   					$arrRes ['msg'] = 'Please enter valid Email Address.';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   			}
   			if ($shipping ['S_10'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Phone Number is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($shipping ['S_10']) > 15) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Please enter valid Phone Number.';
   				echo json_encode ( $arrRes );
   				die ();
   			}



   			$arrRes ['done'] = true;
   			$arrRes ['msg'] = 'Shipping details successfully validated...';
   			$arrRes ['shipping'] = $shipping;

   			echo json_encode ( $arrRes );
   			die ();


   		}
   	}

   	public function getSpecificSubscriptionDetail() {
   		$SubscriptionModel = new SubscriptionModel();

   		$details = $_REQUEST ['details'];
   		$subscriptionId = $details ['subscriptionId'];
   		$userId = $details ['userId'];

   		$arrRes ['details'] = $SubscriptionModel->getSpecificSubscriptionData($subscriptionId);

   		echo json_encode ( $arrRes );
   	}


   	public function addProductToWishlist(Request $r) {
   		$WishlistModel = new WishlistModel();

   		$userId = $r->input('userId');
   		$productId = $r->input('productId');
   		$productType = $r->input('productType');
   		$check_flag_wishlist = $r->input('check_flag_wishlist');


   		if(session('userId') == ''){

   			$arrRes['done'] = false;
   			$arrRes['flag'] = 0; //for redirect to login
   			$arrRes['msg'] = 'Kindly Login First.';
			$arrRes['redirectURL'] = url('/user-login');
   			echo json_encode ( $arrRes );
   			die ();

   		}else{

   			if($userId != ''){

   				$checkExist = $WishlistModel->getSpecificProductExistByUser( $userId, $productId );
   				if($check_flag_wishlist == $checkExist){

					$arrRes['done'] = true;
					$arrRes['msg'] = 'Product already added in wishlist...';
				}else{

					if($checkExist == '0'){

						if($productType == 'single'){
							$prodId = $productId;
							$bundleId = '';
							$type = 'product';
						}else{
							$prodId = '';
							$bundleId = $productId;
							$type = 'bundle';
						}
						$wishlistId = DB::table ( 'jb_user_wishlist_tbl' )->insertGetId (
								array ( 'USER_ID' => $userId,
										'PRODUCT_TYPE' => $type,
										'PRODUCT_ID' => $productId,
										'BUNDLE_ID' => $bundleId,
										'STATUS' => 'active',
										'DATE' => date ( 'Y-m-d H:i:s' ),
										'CREATED_BY' => $userId,
										'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
										'UPDATED_BY' => $userId,
										'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
								)
							);

						$arrRes['done'] = true;
						$arrRes['flag'] = 'add';
						$arrRes['msg'] = 'Product added to wishlist...';

					}else{

						$delete = DB::table ( 'jb_user_wishlist_tbl' )->where( 'USER_ID', $userId )->where( 'PRODUCT_ID', $productId )->delete ();

						$arrRes['done'] = true;
						$arrRes['flag'] = 'remove';
						$arrRes['msg'] = 'Product removed from wishlist...';

					}
				}

   			}

   			$arrRes['wishlistCount'] = DB::table('jb_user_wishlist_tbl')->where('USER_ID', $userId)->count();

   			echo json_encode ( $arrRes );
   			die ();
   		}
   	}

   	public function getAllWishlistLov() {
   		$WishlistModel = new WishlistModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];

   		$arrRes ['list'] = $WishlistModel->getAllWishlistDataByUser($userId);

   		echo json_encode ( $arrRes );
   	}
   	public function deleteWishlistRecord() {
   		$WishlistModel = new WishlistModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$wishlistId = $details ['wishlistId'];

   		$delete = DB::table ( 'jb_user_wishlist_tbl' )->where( 'WISHLIST_ID', $wishlistId )->delete ();

   		$arrRes['done'] = true;
   		$arrRes['msg'] = 'Product removed from wishlist...';
   		$arrRes['list'] = $WishlistModel->getAllWishlistDataByUser($userId);

   		echo json_encode ( $arrRes );
   	}

   	public function getAllUserProfileLov() {
   		$UserModel = new UserModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];

   		$arrRes ['details'] = $UserModel->getSpecificUserDetailsById($userId);

   		echo json_encode ( $arrRes );
   	}

   	public function updateUserProfile(Request $r){
   		$UserModel=new UserModel();

   		$detail=$_REQUEST['details'];
   		$userId=$detail['userId'];
   		$data=$detail['user'];

   		if (isset ( $data ) && ! empty ( $data )) {
   			if ($data['A_1'] == '') {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'First Name is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data['A_2'] == '') {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Last Name is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
            if (ctype_digit($data['A_1'])) {
                $arrRes ['done'] = false;
                $arrRes ['msg'] = 'First Name must be alphabetic or alphanumeric';
                echo json_encode ( $arrRes );
                die ();
            }
            if (ctype_digit($data['A_2'])) {
                $arrRes ['done'] = false;
                $arrRes ['msg'] = 'Last Name must be alphabetic or alphanumeric';
                echo json_encode ( $arrRes );
                die ();
            }
   			if ($data['A_3'] == '') {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Email is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['A_3'] != "") {
   				if (!filter_var( $data ['A_3'], FILTER_VALIDATE_EMAIL)) {
   					$arrRes['done'] = false;
   					$arrRes['msg'] = 'Please enter valid Email Address';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   			}

   			$userdetails = $UserModel->getspecificUserByEmail1($data ['A_3'],$userId);
   			if(!empty($userdetails)){
   				$arrRes['done'] = false;
   				$arrRes['msg'] = 'Email Address already registered';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data['A_4']) <= 0) {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Phone Number is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
            if (strlen($data['A_4']) < 11 || strlen($data['A_4']) > 14 ) {
                $arrRes ['done'] = false;
                $arrRes ['msg'] = 'Phone Number must be between 11 to 14 digits';
                echo json_encode ( $arrRes );
                die ();
            }
   			$userphone = $UserModel->getspecificUserByPhone1($data ['A_4'],$userId);
   			if(!empty($userphone)){
   				$arrRes['done'] = false;
   				$arrRes['msg'] = 'Phone Number already registered';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $data ['ID'] ) ->update (
   					array ( 'FIRST_NAME' => $data ['A_1'],
   							'LAST_NAME' => $data ['A_2'],
   							'EMAIL' => $data ['A_3'],
   							'PHONE_NUMBER' => $data ['A_4'],

   							'UPDATED_BY' => $userId,
   							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   					)
   				);

   			$arrRes['done'] = true;
   			$arrRes['msg'] = 'User profile updated successfully...';
   			echo json_encode ( $arrRes );
   			die ();

   		}
   	}

   	public function updateUserPassword(Request $r){
   		$UserModel=new UserModel();

   		$detail=$_REQUEST['details'];
   		$userId=$detail['userId'];
   		$data=$detail['user'];

   		if (isset ( $data ) && ! empty ( $data )) {
   			if ($data['A_1'] == '') {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Current Password is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			$userdetails = $UserModel->getspecificUserPasswordByUserId($userId);

   			if($userdetails['ENCRYPTED_PASSWORD'] != $data['A_1']){
   				$arrRes['done'] = false;
   				$arrRes['msg'] = 'Current Password is incorrect.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data['A_2'] == '') {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'New Password is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data['A_2']) < 8) {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'New Password must be minimum 8 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data['A_3'] == '') {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Confirm New Password is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data['A_2'] != $data['A_3']) {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Confirm Password does not match with New Password.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
            if($data['A_1'] == $data['A_2'] && $data['A_1'] == $data['A_3']){
                $arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Your New Password must not match the current password. Try Different.';
   				echo json_encode ( $arrRes );
   				die ();
            }


   			$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $data ['ID'] ) ->update (
   					array ( 'ENCRYPTED_PASSWORD' => $data ['A_2'],

   							'UPDATED_BY' => $userId,
   							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   					)
   					);

   			$arrRes['done'] = true;
   			$arrRes['msg'] = 'User Password is updated...';
   			echo json_encode ( $arrRes );
   			die ();

   		}
   	}



   	public function getAllUserOrderslov() {
   		$OrderModel = new OrderModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];

   		$arrRes ['list'] = $OrderModel->getAllUserOrderData($userId);

   		echo json_encode ( $arrRes );
   	}

	public function getSpecificUserShadeNameDetails()  {
		$OrderDetailModel = new OrderDetailModel();

		$details = $_REQUEST ['details'];
   		$orderLineId = $details ['orderLineId'];

		$arrRes ['shadename'] = $OrderDetailModel->getOrderLineProductShadesNameDetail($orderLineId);

		echo json_encode ( $arrRes );

	}
	public function getSpecificUserShadeNameDetailsUserCheckout(){
		$ShoppingcartModel = new ShoppingcartModel();

		$details = $_REQUEST ['details'];
   		$orderLineId = $details ['orderLineId'];

		$arrRes ['shadename'] = $ShoppingcartModel->getOrderLineProductShadesNameDetailCheckout($orderLineId);

		echo json_encode ( $arrRes );
	}


   	public function getSpecificUserOrderDetails() {
   		$OrderModel = new OrderModel();
   		$OrderDetailModel = new OrderDetailModel();
   		$OrderShippingModel = new OrderShippingModel();
   		$OrderPaymentModel = new OrderPaymentModel();
   		$OrderShipmentModel = new OrderShipmentModel();
   		$OrderShipmentTrackingModel = new OrderShippingTrackingModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$orderId = $details ['orderId'];

   		$arrRes ['order'] = $OrderModel->fetchSpecificOrderDetails($orderId);
   		$arrRes ['details'] = $OrderDetailModel->getAllSpecificOrderData($orderId);
   		$arrRes ['shipping'] = $OrderShippingModel->getAllSpecificOrderShippingData($orderId);
   		$arrRes ['payment'] = $OrderPaymentModel->getAllSpecificOrderPaymentData($orderId);
   		$arrRes ['shipment'] = $OrderShipmentModel->getAllSpecificOrderShipmentData($orderId);
   		$arrRes ['tracking'] = $OrderShipmentTrackingModel->getAllTrackingByOrder($orderId);

   		echo json_encode ( $arrRes );
   	}
   	public function searchShipmentUserOrders(Request $request) {
   		$OrderModel = new OrderModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$search = $details ['search'];

   		$customerName = isset($search['S_1']) ? $search['S_1'] : '';
   		$orderStatus = isset($search['S_2']) ? $search['S_2'] : '';
   		$shippmentStatus = isset($search['S_3']) ? $search['S_3'] : '';
   		$startDate = isset($search['S_4']) ? $search['S_4'] : '';
   		$endDate = isset($search['S_5']) ? $search['S_5'] : '';

   		if($customerName == '' && $orderStatus == '' && $shippmentStatus == '' && $startDate == '' && $endDate == ''){

   			$arrRes['done'] = false;
   			$arrRes['msg'] = 'Choose atleast one filter.';

   		}else{

   			$arrRes['done'] = true;
   			$arrRes['msg'] = '';
   			// 1 for placed order listing & 2 for shipped/delivered order listing
   			$arrRes['order'] = $OrderModel->getAllSearchUserOrderData(2,$userId,$customerName,$orderStatus,$shippmentStatus,$startDate,$endDate);

   		}

   		echo json_encode ( $arrRes );
   	}

   	public function getAllUserTicketslov() {
   		$TicketsModel = new TicketsModel();
		   $OrderModel = new OrderModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];

		$arrRes ['orders'] = $OrderModel->getOrdersLov($userId);
   		$arrRes ['list'] = $TicketsModel->getAllTicketsByUserId($userId);

   		echo json_encode ( $arrRes );
   	}
   	public function saveTicketDetails(Request $request) {
   		$TicketsModel = new TicketsModel();
   		$OrderModel = new OrderModel();
		$EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;

   		$details = $_REQUEST ['details'];
   		$data = $details ['ticket'];
   		$userId = $details ['userId'];

   		$arrRes = array ();
   		$arrRes ['done'] = false;
   		$arrRes ['msg'] = '';


   		if (isset ( $data ) && ! empty ( $data )) {

   			if ($data ['T_1'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Choose Ticket Type first.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['T_1'] == 'order' && !isset($data ['T_2']['name'])) {
   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Choose Order Number First.';
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			// if ($data ['T_1'] == 'order' && $data ['T_2'] != '') {

   			// 	// $temp = explode('#', $data ['T_2']);

   			// 	// $orderDetail = $OrderModel->validateOrderById(isset($temp[1])?$temp[1]:'');

   			// 	if(empty($orderDetail)){
   			// 		$arrRes ['done'] = false;
   			// 		$arrRes ['msg'] = 'Document Number is not valid.';
   			// 		echo json_encode ( $arrRes );
   			// 		die ();
   			// 	}
   			// }
   			if ($data ['T_3'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Username is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data ['T_3']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Username must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['T_4'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Email is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data ['T_4']) > 100) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Email must be less then 100 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['T_4'] != "") {
   				if (!filter_var( $data ['T_4'], FILTER_VALIDATE_EMAIL)) {
   					$arrRes['done'] = false;
   					$arrRes['msg'] = 'Please enter valid Email Address';
   					echo json_encode ( $arrRes );
   					die ();
   				}
   			}
   			if ($data ['T_5'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Phone number is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data ['T_5']) < 11 || strlen($data ['T_5']) > 14) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Phone number must be between 11 to 14 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['T_8'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Choose Priority first.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['T_6'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Subject is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if (strlen($data ['T_6']) > 200) {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Subject must be less then 200 characters.';
   				echo json_encode ( $arrRes );
   				die ();
   			}
   			if ($data ['T_7'] == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = 'Details is required.';
   				echo json_encode ( $arrRes );
   				die ();
   			}



   			if ($data ['ID'] == '') {

   				$result = DB::table ( 'jb_user_tickets_tbl' )->insertGetId (
   						array ( 'USER_ID' => $userId,
   								'TICKET_NUMBER' => 'TKT#'.date('YmdHis'),
   								'TICKET_TYPE' => $data['T_1'],
   								'DOCUMENT_NUMBER' => isset($data['T_2']['name']) ? $data['T_2']['name'] : '',
   								'USER_NAME' => $data['T_3'],
   								'EMAIL' => $data['T_4'],
   								'PHONE_NUMBER' => $data['T_5'],
   								'SUBJECT' => $data['T_6'],
   								'DESCRIPTION' => $data['T_7'],
   								'PRIORITY' => $data['T_8'],
   								'STATUS' => 'open',
   								'CREATED_BY' => $userId,
   								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   								'UPDATED_BY' => $userId,
   								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   						)
   						);

				// Getting data WRT MODULE_CODE
				$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('TICKET');

				$message_username = str_replace("{User_Name}",$data ['T_3'],$emailConfigDetails['message']);

				$htmlbody=	'<tr>
								<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
									<p>Hello '.$data ['T_3'].',</p><br>
									'.$message_username.'
								</td>
							</tr>';


				$email_details['to_id'] = '';
				$email_details['to_email'] = $data ['T_4'];//useremail
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "TICKET";

				$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

				$email_details['to_id'] = '';
				$email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $data ['T_4'];//useremail
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "TICKET";

				$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

   				$arrRes ['done'] = true;
   				$arrRes ['msg'] = 'Ticket Created Successfully';
   				$arrRes ['ID'] = $result;
   				$arrRes ['list'] = $TicketsModel->getAllTicketsByUserId($userId);
   				echo json_encode ( $arrRes );
   				die ();

   			} else {

   				$result = DB::table ( 'jb_user_tickets_tbl' ) ->where ( 'TICKET_ID', $data ['ID'] ) ->update (
   						array ( 'TICKET_TYPE' => $data['T_1'],
   								'DOCUMENT_NUMBER' => isset($data['T_2']['name']) ? $data['T_2']['name'] : '',
   								'USER_NAME' => $data['T_3'],
   								'EMAIL' => $data['T_4'],
   								'PHONE_NUMBER' => $data['T_5'],
   								'SUBJECT' => $data['T_6'],
   								'DESCRIPTION' => $data['T_7'],
   								'PRIORITY' => $data['T_8'],
   								'UPDATED_BY' => $userId,
   								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   						)
   						);

   				$arrRes ['done'] = true;
   				$arrRes ['msg'] = 'Ticket Updated Successfully';
   				$arrRes ['ID'] = $data ['ID'];
   				$arrRes ['list'] = $TicketsModel->getAllTicketsByUserId($userId);
   				echo json_encode ( $arrRes );
   				die ();
   			}
   		}
   	}
   	public function getSpecificTicketDetails() {
   		$TicketsModel = new TicketsModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$ticketId = $details ['ticketId'];

   		$arrRes ['details'] = $TicketsModel->getSpecificTicketDetail($ticketId);
   		$arrRes ['replies'] = $TicketsModel->getSpecificTicketReplies($ticketId);
   		$arrRes ['images'] = $TicketsModel->getTicketAttachments($ticketId);

   		echo json_encode ( $arrRes );
   	}

   	public function saveTicketReplyDetail(Request $request) {
   		$TicketsModel = new TicketsModel();
   		$OrderModel = new OrderModel();

   		$details = $_REQUEST ['details'];
   		$ticketId = $details ['ticketId'];
   		$ticketReply = $details ['ticketReply'];
   		$userId = $details ['userId'];

   		$arrRes = array ();
   		$arrRes ['done'] = false;
   		$arrRes ['msg'] = '';


   		if (isset ( $ticketId ) && $ticketId != '') {

   			if ($ticketReply == '') {

   				$arrRes ['done'] = false;
   				$arrRes ['msg'] = "Can't post empty reply.";
   				echo json_encode ( $arrRes );
   				die ();
   			}

   			$result = DB::table ( 'jb_user_ticket_reply_tbl' )->insertGetId (
   					array ( 'TICKET_ID' => $ticketId,
   							'REPLY_DESCRIPTION' => $ticketReply,
   							'USER_TYPE' => 'user',
   							'DATE' => date ( 'Y-m-d H:i:s' ),
   							'CREATED_BY' => $userId,
   							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   							'UPDATED_BY' => $userId,
   							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   					)
   					);

			DB::table ( 'jb_user_tickets_tbl' ) ->where ( 'TICKET_ID', $ticketId ) ->update (
			array (
				'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			)
			);


   			$arrRes ['done'] = true;
   			$arrRes ['msg'] = 'Ticket Reply added successfully.';
   			$arrRes ['ID'] = $result;
   			$arrRes ['replies'] = $TicketsModel->getSpecificTicketReplies($ticketId);
   			echo json_encode ( $arrRes );
   			die ();


   		}else{
   			$arrRes ['done'] = false;
   			$arrRes ['msg'] = "Something went wrong...";
   			echo json_encode ( $arrRes );
   			die ();
   		}
   	}
   	public function getAllUserSubscriptionslov() {
   		$SubscriptionModel = new SubscriptionModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];

   		$arrRes ['list'] = $SubscriptionModel->getAllUserSubscriptionsWrtUser($userId);

   		echo json_encode ( $arrRes );
   	}
   	public function getSpecificUserSubscriptionDetail() {
   		$SubscriptionModel = new SubscriptionModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$subsId = $details ['subsId'];

   		$arrRes ['detail'] = $SubscriptionModel->getSpecificUserSubscriptionDetails($subsId);

   		echo json_encode ( $arrRes );
   	}


   	public function changeTicketStatus(Request $request) {
   		$TicketsModel = new TicketsModel();

   		$details = $_REQUEST ['details'];
   		$userId = $details ['userId'];
   		$ticketId = $details ['ticketId'];
   		$flag = $details ['flag'];



   		if(isset($flag) && $flag == '1'){
   			$status = 'open';
   			$arrRes ['msg'] = 'Ticket open successfully...';
   		}else{
   			$status = 'close';
   			$arrRes ['msg'] = 'Ticket close successfully...';
   		}

   		$result = DB::table ( 'jb_user_tickets_tbl' ) ->where ( 'TICKET_ID', $ticketId ) ->update (
   				array ( 'STATUS' => $status,
   						'UPDATED_BY' => $userId,
   						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   				)
   				);

   		$arrRes ['done'] = true;
   		$arrRes ['list'] = $TicketsModel->getAllTicketsByUserId($userId);

   		echo json_encode ( $arrRes );
   	}
	public function saveSelfie(Request $request){
		$EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;

		$username= $request->name;
		$username_email= $request->email;

		// $namefile = DB::table ( 'jb_shade_finder_selfie_tbl' )->insertGetId (
		// 	array ( 'USER_ID' => session('userId'),
		// 			'USERNAME' => $username,
		// 			'USER_EMAIL' => $username_email,
		// 	)
		// );

        $namefile = $username . "'s_Selfie_" . date('Ymd_His');
        // dd($namefile);
        if ($request->file('file')) {
            $path = public_path() . "/uploads/beautyselfie";
            $downpath = url('public') . "/uploads/beautyselfie";

            $file = $request->file('file');
            $file_ext = $file->getClientOriginalExtension();
            // $namefile = 'example';

            $fullpath = $path . "/" . $namefile . "." . $file_ext;
            $downpath = $downpath . "/" . $namefile . "." . $file_ext;

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $imageSize = getimagesize($file);
            $width = $imageSize[0];
            $height = $imageSize[1];

            // if ($width >= 1000 && $height >= 600) {
                if (move_uploaded_file($file, $fullpath)) {
                    $result = DB::table('jb_shade_finder_selfie_tbl')->where('SELFIE_ID', $namefile)->update(
                        array(
                            'PATH' => $fullpath,
                            'DOWNPATH' => $downpath,
                            'UPDATED_ON' => date('Y-m-d H:i:s')
                        )
                    );
                    // dd($result);
                }
                $emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('SHADEFINDERSELFI');
                $message_username = str_replace("{User_Name}",$username,$emailConfigDetails['message']);
                $htmlbody=	'<tr>
                                <td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
                                    <p>Hello '.$username.',</p><br>
                                    '.$message_username.'
                                </td>
                            </tr>';


                $email_details['to_id'] = '';
                $email_details['to_email'] = $username_email;
                $email_details['from_id'] = 1;
                $email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
                $email_details['subject'] = $emailConfigDetails['subject'];
                $email_details['message'] = "";
                $email_details['logo'] = $emailConfigDetails['logo'];
                $email_details['module_code'] = "SHADEFINDERSELFI";

                $EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

                $email_details['to_id'] = '';
                $email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
                $email_details['from_id'] = 1;
                $email_details['from_email'] = $username_email;
                $email_details['subject'] = $emailConfigDetails['subject'];
                $email_details['message'] = "";
                $email_details['logo'] = $emailConfigDetails['logo'];
                $email_details['module_code'] = "SHADEFINDERSELFI";

                $EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);
                $arrRes ['done'] = true;
                   $arrRes ['msg'] = 'Selfie Data added successfully.';
                   echo json_encode ( $arrRes );
                   die ();
            // } else {
            //     $arrRes ['done'] = false;
            //     $arrRes ['msg'] = 'Selfie Image must be atleast 1000 by 600 pixels.';
            //     echo json_encode ( $arrRes );
            //     die ();
            // }
        }
	}

	public function saveProductSelfie(Request $request){

		$EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;

		$details = $_REQUEST ['details'];
		$data = $details['selfi'];
		$productId = $data ['productId'];
		$name = $data ['name'];
		$email = $data ['email'];
		$primaryflag = $data ['primaryflag'];

		// $username = $request->name;
		// $username_email = $request->email;
		// $product_id = $request->productid;
		// $flag = $request->flag;
		if($data['ID'] == ''){
			$selfielastID = DB::table ( 'jb_product_selfi_tbl' )->insertGetId (
				array ( 'PRODUCT_ID' => $productId,
						'NAME' => $name,
						'EMAIL' => $email,
						'PRIMARY_FLAG' =>$primaryflag,
				)
			);

			// if($request->file('file')){

			// 	$path = public_path()."/uploads/productselfie";
			// 	$downpath = url('public')."/uploads/productselfie";

			// 	$file=$request->file('file');
			// 	$file_ext= $file->getClientOriginalExtension();

			// 	$fullpath = $path."/".$namefile.".".$file_ext;
			// 	$downpath = $downpath."/".$namefile.".".$file_ext;

			// 	if (!file_exists($path)) {
			// 		mkdir($path, 0777, true);

			// 		if(move_uploaded_file($file, $fullpath)){

			// 			$result = DB::table ( 'jb_product_selfi_tbl' ) ->where ( 'SELFIE_ID', $namefile ) ->update (
			// 			array ( 'PATH' => $fullpath,
			// 					'DOWN_PATH' => $downpath,
			// 					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			// 				)
			// 			);
			// 		}
			// 	}else{

			// 		if(move_uploaded_file($file, $fullpath)){

			// 			$result = DB::table ( 'jb_product_selfi_tbl' ) ->where ( 'SELFIE_ID', $namefile ) ->update (
			// 				array ( 'PATH' => $fullpath,
			// 						'DOWN_PATH' => $downpath,
			// 						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			// 				)
			// 				);
			// 		}
			// 	}
			// }
			$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('SELFIPRODUCT');

			$message_username = str_replace("{User_Name}",$name,$emailConfigDetails['message']);

			$htmlbody=	'<tr>
							<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
								<p>Hello '.$name.',</p><br>
								'.$emailConfigDetails['message'].'
							</td>
						</tr>';


			$email_details['to_id'] = '';
			$email_details['to_email'] = $email;
			$email_details['from_id'] = 1;
			$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
			$email_details['subject'] = $emailConfigDetails['subject'];
			$email_details['message'] = "";
			$email_details['logo'] = $emailConfigDetails['logo'];
			$email_details['module_code'] = "SELFIPRODUCT";

			$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

			$email_details['to_id'] = '';
			$email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
			$email_details['from_id'] = 1;
			$email_details['from_email'] = $email;
			$email_details['subject'] = $emailConfigDetails['subject'];
			$email_details['message'] = "";
			$email_details['logo'] = $emailConfigDetails['logo'];
			$email_details['module_code'] = "SELFIPRODUCT";

			$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

			$arrRes ['done'] = true;
			$arrRes ['ID'] = $selfielastID;

			$arrRes ['msg'] = 'Product Selfie Data Added Successfully. Wait For Admin Approval';
			echo json_encode ( $arrRes );
			die ();
		}


	}

	public function addFooterEmailSubscription(Request $r) {
		$FooterSubscriptionModel = new FooterSubscriptionModel();
		$EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;

		$userId = $r->input('userId');
		$email = $r->input('email');
		$phone = $r->input('phone');

		if($email == ''){
			$arrRes['done'] = false;
			$arrRes['msg'] = 'Email is required.';
			echo json_encode ( $arrRes );
			die ();
		}
		if ($email != "") {
			if (!filter_var( $email, FILTER_VALIDATE_EMAIL)) {

				$arrRes['done'] = false;
				$arrRes['msg'] = 'Email is not valid.';
				echo json_encode ( $arrRes );
				die ();
			}
		}

		$detail = $FooterSubscriptionModel->getSubscriptionByEmail($email);
		if($detail != ''){
			$arrRes['done'] = false;
			$arrRes['msg'] = 'Email already subscribed.';
			echo json_encode ( $arrRes );
			die ();
		}

		if($phone == ''){
			$arrRes['done'] = false;
			$arrRes['msg'] = 'Phone number is required.';
			echo json_encode ( $arrRes );
			die ();
		}

		if(strlen($phone) > '15'){
			$arrRes['done'] = false;
			$arrRes['msg'] = 'Phone number is not valid.';
			echo json_encode ( $arrRes );
			die ();
		}


		$result = DB::table ( 'jb_footer_subscription_tbl' )->insertGetId (
   				array ( 'USER_ID' => $userId,
   					'EMAIL' => $email,
   					'PHONE_NUMBER' => $phone,
   					'DATE' => date ( 'Y-m-d H:i:s' ),
   					'CREATED_BY' => $userId,
   					'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
   					'UPDATED_BY' => $userId,
   					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
   				)
   			);

		$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('NEWS LATTER');

		$htmlbody=	'<tr>
						<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
							<p>Hello '.$email.',</p><br>
							'.$emailConfigDetails['message'].'
						</td>
	        		</tr>';


		$email_details['to_id'] = '';
		$email_details['to_email'] = $email;
		$email_details['from_id'] = 1;
		$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
		$email_details['subject'] = $emailConfigDetails['subject'];
		$email_details['message'] = "";
		$email_details['logo'] = $emailConfigDetails['logo'];
		$email_details['module_code'] = "SUBSCRIPTION";

		$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

		$email_details['to_id'] = '';
		$email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
		$email_details['from_id'] = 1;
		$email_details['from_email'] = $email;
		$email_details['subject'] = $emailConfigDetails['subject'];
		$email_details['message'] = "";
		$email_details['logo'] = $emailConfigDetails['logo'];
		$email_details['module_code'] = "SUBSCRIPTION";

		$EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

		$arrRes['done'] = true;
		$arrRes['msg'] = 'Subscribed successfully.';
		echo json_encode ( $arrRes );
		die ();
	}


	public function deleteTicketAttachment(Request $request) {
		$TicketsModel = new TicketsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$ticketId = $details ['ticketId'];
		$userId = $details ['userId'];

		$attDetail = $TicketsModel->getSpecificTicketAttachment($recordId);

		$delete = DB::table ( 'jb_user_tickets_attachment_tbl' )->where ( 'ATTACHMENT_ID', $recordId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ticket image deleted successfully...';
		$arrRes ['images'] = $TicketsModel->getTicketAttachments($ticketId);

		echo json_encode ( $arrRes );
	}
	public function deleteProductSelfiImage(Request $request) {

		$Product = new ProductSelfiModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];

		$attDetail = $Product->getSpecificImage($imageId);

		$delete = DB::table ( 'jb_product_selfi_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['images_id'] = $imageId;
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Selfi image deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function updateSlug(){
		$Products = new ProductModel();

		$allProd = $Products->getAllForSlugUpdate();

		foreach ($allProd as $product){



		}
		print_r('<pre>');
		print_r($allProd);
	}
}
?>
