<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\User;
use App\Models\Feature;
use App\Models\TypeName;
use App\Models\UserModel;
use App\Models\BlogsModel;
use App\Models\Handpicked;
use App\Models\OrderModel;
use App\Models\Recomended;
use App\Models\GivingModel;
use App\Models\RoutineType;
use App\Models\ShadesModel;
use App\Models\ProductModel;
use App\Models\ReviewsModel;
use App\Models\RoutineSteps;
use App\Models\TicketsModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\QuestionModel;
use App\Models\IngredientModel;
use App\Models\EmailConfigModel;
use App\Models\OrderDetailModel;
use App\Models\ProductUsesModel;
use App\Models\ShadeFinderModel;
use App\Models\EmailForwardModel;
use App\Models\OrderPaymentModel;
use App\Models\ProductSelfiModel;
use App\Models\ProductShadeModel;
use App\Models\SubscriptionModel;
use App\Models\BundleProductModel;
use App\Models\OrderShipmentModel;
use App\Models\OrderShippingModel;
use App\Models\UserdashboardModel;
use Illuminate\Support\Facades\DB;
use App\Models\AddSocialIconsModel;
use App\Models\UserMenuControlModel;
use App\Models\BundleProductLineModel;
use App\Models\ProductIngredientModel;

use App\Models\ShadeFinderSelfieModel;
use App\Models\FooterSubscriptionModel;
use App\Models\OrderShippingTrackingModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Cookie;
use Nette\Utils\Json;

class AdminController extends Controller
{

    public function subscriptionCroneJob(){

        $EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;
        $emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('SUBSCRIPTION NOTIFICATION');

        $twoDaysAhead = date('Y-m-d', strtotime('+2 days'));
        $sameDay = date('Y-m-d');

        $results = DB::table('jb_user_subscription_tbl as stbl')
            ->select('stbl.*','prd.*','utbl.*','ctbl.CATEGORY_NAME','subtbl.TITLE','ordtbl.QUANTITY as qantity','ordtbl.UNIT_PRICE','ordtbl.TOTAL_AMOUNT','bprd.NAME as bName','bprd.TOTAL_AMOUNT as bTotalAmount','bprd.QUANTITY as bQuantity','bctbl.CATEGORY_NAME as bCategoryName')
            ->leftJoin('jb_product_tbl as prd', 'stbl.PRODUCT_ID', '=', 'prd.PRODUCT_ID')
            ->leftJoin('jb_category_tbl as ctbl','prd.CATEGORY_ID','=','ctbl.CATEGORY_ID')
            ->leftJoin('fnd_user_tbl as utbl','stbl.USER_ID','=','utbl.USER_ID')
            ->leftJoin('jb_subscription_tbl as subtbl','stbl.SUBSCRIPTION_ID','=','subtbl.SUBSCRIPTION_ID')
            ->leftJoin('jb_order_detail_tbl as ordtbl','stbl.ORDER_LINE_ID','=','ordtbl.ORDER_LINE_ID')
			->leftJoin('jb_bundle_product_tbl as bprd','stbl.BUNDLE_ID','=','bprd.BUNDLE_ID')
			->leftJoin('jb_category_tbl as bctbl','bprd.CATEGORY_ID','=','bctbl.CATEGORY_ID')
            ->where('NEXT_PAYMENT_DATE', $twoDaysAhead)->orWhere('NEXT_PAYMENT_DATE',$sameDay)
            ->where('SUBSCRIPTION_STATUS','active')
            ->get();

        // dd($results);
        if(isset($results))
		{
            $i = 1;
            foreach($results as $result){
                $rslt = DB::table('sys_notification_tbl')->insert(
                    array(
                    'N_TYPE' => 'product subscription',
                    'N_NAME' =>  'notification',
                    'DATE' => date ( 'Y-m-d H:i:s' ),
                    'TO_USER_ID' => $result->USER_ID,
                    'TO_USER_EMAIL' => $result->EMAIL,
                    'SOURCE_ID' =>  $result->USER_SUBSCRIPTION_ID,
                    'FROM_USER_ID' => 1,
                    'FROM_USER_EMAIL' => $emailConfigDetails['fromEmail'],
                    'MODULE_CODE'=> 'subscription',
                    'STATUS' => 'active',
                    'PRIORITY' => 'hight',
                    'MESSAGE' => 'Kindly pay your subscription fee on time to continue using our services',
                    'N_HTML' => $emailConfigDetails['message'],
                    'CREATED_BY' => 1,
                    'CREATED_AT' => date ( 'Y-m-d H:i:s' ),
                    'UPDATED_BY' => 1,
                    'UPDATED_AT' => date ( 'Y-m-d H:i:s' ),
                ));
                $ToName = $result->FIRST_NAME;
                $message_username = str_replace("{User_Name}",$ToName,$emailConfigDetails['message']);

							$htmlbody = '<div bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
											<p>Hello '.$ToName.',</p><br>
										'.$message_username.'
										</div>
										<html>
										<head>
										</head>
										<body>
											<div style="width: 100%; display: flex; justify-content: center;">
												<div style="overflow-x: auto; max-width: 100%;">
													<table style="width: 100%; border-collapse: collapse;">
														<thead style="background-color: #f4f4f4;">
															<tr>
																<th style="padding: 10px; text-align: left;">S.No</th>
																<th style="padding: 10px; text-align: left;">'.(isset($result->NAME) ? 'Product Name' : (isset($result->bName) ? 'Bundle Name' : '')).'</th>
																<th style="padding: 10px; text-align: left;">Category</th>
																<th style="padding: 10px; text-align: left;">Subscription Name</th>
																<th style="padding: 10px; text-align: left;">Unit Cost</th>
																<th style="padding: 10px; text-align: left;">Quantity</th>
																<th style="padding: 10px; text-align: left;">Total</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td style="padding: 10px; text-align: left;">'.$i.'</td>
																<td style="padding: 10px; text-align: left;">'.(isset($result->NAME) ? $result->NAME : (isset($result->bName) ? $result->bName : '')).'</td>
																<td style="padding: 10px; text-align: left;">'.(isset($result->CATEGORY_NAME) ? $result->CATEGORY_NAME : (isset($result->bCategoryName) ? $result->bCategoryName : '')).'</td>
																<td style="padding: 10px; text-align: left;">'.$result->TITLE.'</td>
																<td style="padding: 10px; text-align: left;">'.$result->UNIT_PRICE.'</td>
																<td style="padding: 10px; text-align: left;">'.$result->qantity.'</td>
																<td style="padding: 10px; text-align: left;">'.(isset($result->TOTAL_AMOUNT) ? $result->TOTAL_AMOUNT : (isset($result->bTotalAmount) ? $result->bTotalAmount : '')).'</td>
															</tr>
															<!-- Add more rows as needed -->
														</tbody>
													</table>
												</div>
											</div>
										</body>
										</html>
									';

                                // $i++;
                            // }



                $email_details['to_id'] = '';
                $email_details['to_email'] = $result->EMAIL;//useremail
                $email_details['from_id'] = 1;
                $email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
                $email_details['subject'] = $emailConfigDetails['subject'];
                $email_details['message'] = "";
                $email_details['logo'] = $emailConfigDetails['logo'];
                $email_details['module_code'] = "SELFIE REPLY";
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

                $EmailForwardModel->sendEmail($email_details);

                $email_details['to_id'] = '';
                $email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
                $email_details['from_id'] = 1;
                $email_details['from_email'] = $result->EMAIL;//useremail
                $email_details['subject'] = $emailConfigDetails['subject'];
                $email_details['message'] = "";
                $email_details['logo'] = $emailConfigDetails['logo'];
                $email_details['module_code'] = "SELFIE REPLY";
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

                $EmailForwardModel->sendEmail($email_details);
            }
			return true;
        }
        return true;
    }

    public function acceptCookies(Request $request)
    {

        cookie()->queue(cookie()->forever('site_name', 'JusOutBeauty'));
        cookie()->queue(cookie()->forever('site_url', url('/home')));
        cookie()->queue(cookie()->forever('site_description', 'Welcome to JusOut Beauty, all inclusive, high performance, natural skincare, and makeup - Yur Jus Enough beauty products to glow from within.'));
        // cookie()->queue(cookie('site_name', 'JusOutBeauty', 120));
        cookie()->queue(cookie()->forever('site_url', url('/home')));
        // Set the 'cookies_accepted' cookie with a value
        // $cookie = Cookie::make('cookies_accepted', true, 365 * 24 * 60); // Expires in 1 year

        // Return a response with the cookie set
        return response()->json(['message' => 'Cookies accepted']);
    }

    public function popup(){
        $data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Home Page Popup';
		$result=$this->checkUserControlAccess(session('userId'),"/home-page-popup");
		if( $result != true) {
			return view ( 'admin.popup' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.home-page' )->with ( $data );
    }

    public function getPopupData(){
        $result = DB::table('jb_popup_tbl as a')->select('a.*')->where('ID','1')->first();
        return json_encode($result);
    }

    public function savePopupData(){
        $details = $_REQUEST['details'];
        $popup = $details['popup'];
        $id = $popup['ID'];
        $firstTitle = $popup['FIRST_TITLE'];
        $mainTitle = $popup['MAIN_TITLE'];
        $secondTitle = $popup['SECOND_TITLE'];
        $backgroundColor = $popup['BACKGROUND_COLOR'];
        $buttonText = $popup['BUTTON_TEXT'];
        $buttonLink = $popup['BUTTON_LINK'];

        if($firstTitle == '' || $firstTitle == null){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'First Text is Required';
            echo json_encode ( $arrRes );
			die ();
        }
        if(strlen($firstTitle) > 50 ){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'First Text cant be greater than 50 chars';
            echo json_encode ( $arrRes );
			die ();
        }
        if($mainTitle == '' || $mainTitle == null){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'Mian Title is  Required';
            echo json_encode ( $arrRes );
				die ();
        }
        if(strlen($mainTitle) > 35 ){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'Main Title can not be more than 10 chars';
            echo json_encode ( $arrRes );
				die ();
        }
        if($secondTitle == '' || $secondTitle == null){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'Second Text is Required';
            echo json_encode ( $arrRes );
				die ();
        }
        if(strlen($secondTitle) > 70){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'Second Text cant be greater than 60 chars';
            echo json_encode ( $arrRes );
				die ();
        }
        if($backgroundColor == '' || $backgroundColor == null){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'Background Color is Required';
            echo json_encode ( $arrRes );
				die ();
        }
        if($buttonText == '' || $buttonText == null){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'Button Text is Required';
            echo json_encode ( $arrRes );
				die ();
        }
        if(strlen($buttonText) > 15 ){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'Button Text can not be more than 15 chars';
            echo json_encode ( $arrRes );
				die ();
        }
        if($buttonLink == '' || $buttonLink == null){
            $arrRes ['done'] = false;
		    $arrRes ['msg'] = 'Button Link is Required';
            echo json_encode ( $arrRes );
				die ();
        }


        DB::table ('jb_popup_tbl' )
				->where('ID',$id)
				->update($popup);

                $arrRes ['done'] = true;
                $arrRes ['msg'] = 'Popup Updated Successfully';

                echo json_encode ( $arrRes );

    }




	public function updateProductOrder(){
		$details = $_REQUEST ['details'];
		$request = $details['order'];

		foreach ($request as $product) {
			DB::table ('jb_product_tbl' )
				->where('PRODUCT_ID',$product['id'])
				->update([
					'SEQ_NUM' => $product['position_new'],
				]);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Products Position Updated Successfully';

		echo json_encode ( $arrRes );

	}

    public function updateCategoryOrder(){
		$details = $_REQUEST ['details'];
		$request = $details['order'];

		foreach ($request as $category) {
			DB::table ('jb_category_tbl' )
				->where('CATEGORY_ID',$category['id'])
				->update([
					'SEQ_NUM' => $category['position_new'],
				]);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Category Position Updated Successfully';

		echo json_encode ( $arrRes );

	}

    public function updateSubCategoryOrder(){
		$details = $_REQUEST ['details'];
		$request = $details['order'];

		foreach ($request as $subCategory) {
			DB::table ('jb_sub_category_tbl' )
				->where('SUB_CATEGORY_ID',$subCategory['id'])
				->update([
					'SEQ_NUM' => $subCategory['position_new'],
				]);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Sub Category Position Updated Successfully';

		echo json_encode ( $arrRes );

	}

    public function updateSubSubCategoryOrder(){
		$details = $_REQUEST ['details'];
		$request = $details['order'];

		foreach ($request as $subSubCategory) {
			DB::table ('jb_sub_sub_category_tbl' )
				->where('SUB_SUB_CATEGORY_ID',$subSubCategory['id'])
				->update([
					'SEQ_NUM' => $subSubCategory['position_new'],
				]);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Sub Sub Category Position Updated Successfully';

		echo json_encode ( $arrRes );

	}
	public function updateBundleOrder(){
		$details = $_REQUEST ['details'];
		$request = $details['order'];

		foreach ($request as $product) {
			DB::table ('jb_bundle_product_tbl' )
				->where('BUNDLE_ID',$product['id'])
				->update([
					'SEQ_NUM' => $product['position_new'],
				]);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Bundle Position Updated Successfully';

		echo json_encode ( $arrRes );

	}

	public function updateShadeOrder(){
		$details = $_REQUEST ['details'];
		$request = $details['order'];

		foreach ($request as $product) {
			DB::table ('jb_shades_tbl' )
				->where('SHADE_ID',$product['id'])
				->update([
					'SEQ_NUM' => $product['position_new'],
				]);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Shades Position Updated Successfully';

		echo json_encode ( $arrRes );

	}

	public function updateIngredientOrder(){
		$details = $_REQUEST ['details'];
		$request = $details['order'];

		foreach ($request as $product) {
			DB::table ('jb_ingredient_tbl' )
				->where('INGREDIENT_ID',$product['id'])
				->update([
					'SEQ_NUM' => $product['position_new'],
				]);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient Position Updated Successfully';

		echo json_encode ( $arrRes );

	}

	public function updateFeaturesOrder(){
		$details = $_REQUEST ['details'];
		$request = $details['order'];

		foreach ($request as $product) {
			DB::table ('jb_product_features_tbl' )
				->where('FEATURE_ID',$product['id'])
				->update([
					'SEQ_NUM' => $product['position_new'],
				]);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Features Position Updated Successfully';

		echo json_encode ( $arrRes );

	}

	public function saveAdminProductsaveJusOFlow(Request $request){

		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$recomendedArray = $details ['recomended'];
		$userId = $details ['userId'];
		$recomendedModel = new Recomended();

		DB::table ('jb_product_recommend_tbl' )->where('PRODUCT_ID',$productId)->delete();
		if(count($recomendedArray) != ''){
			foreach ($recomendedArray as $recomended) {
				DB::table ('jb_product_recommend_tbl' )->insert (
					array ( 'USER_ID' => $userId,
							'RECOMEDEDPRODUCT_ID' => $recomended['id'],
							'PRODUCT_ID' => $productId,
							'DATE' => date ( 'Y-m-d H:i:s' ),
							'CREATED_BY' => $userId,
							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )));
			}
		}


		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Complete your JusOGlow Updated Successfully';

		$arrRes ['recommandedProducts'] = $recomendedModel->getrecomendedproducts($productId);

		echo json_encode ( $arrRes );
	}

	public function saveDailyhandPickProduct(Request $request){

		$details = $_REQUEST ['details'];
		// dd($details);
		$productId = $details ['productId'];
		$handPickArray = $details ['handPick'];
		$userId = $details ['userId'];

		$handpicked= new Handpicked();
		DB::table ('jb_product_handpicked_tbl' )->where('PRODUCT_ID',$productId)->delete();

		foreach ($handPickArray as $handpick) {
			DB::table ('jb_product_handpicked_tbl' )->insert (
				array ( 'USER_ID' => $userId,
						'HANDPICKEDPRODUCT_ID' => $handpick['id'],
						'PRODUCT_ID' => $productId,
						'DATE' => date ( 'Y-m-d H:i:s' ),
						'CREATED_BY' => $userId,
						'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )));
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Complete your JusOGlow Updated Successfully';

		$arrRes ['handpickProducts'] = $handpicked->gethanpickedproducts($productId);

		echo json_encode ( $arrRes );
	}

	public function saveAdminQuickProductShade(Request $request) {
		$ProductShade = new ProductShadeModel();

		$details = $_REQUEST ['details'];
		$data = $details ['shade'];
		$prod = $details ['product'];
		$userId = $details ['userId'];
	// dd($details);
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if (!isset($data['S_1']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Shade first.';
				echo json_encode ( $arrRes );
				die ();
			}

			if($data['S_2'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Inv. Quantity is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($data['S_2'] <= 0){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Inv. Quantity must be greater then Zero.';
				echo json_encode ( $arrRes );
				die ();
			}



			if ($data ['ID'] == '') {

				$existCheck = $ProductShade->checkShadeExistCheckWrtProductId(isset($data['S_1']['id']) ? $data['S_1']['id'] : '',$prod);

				if ($existCheck == true) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Shade already added in product.';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_product_shades_tbl' )->insertGetId (
						array ( 'PRODUCT_ID' => $prod,
								'SHADE_ID' => isset($data['S_1']['id']) ? $data['S_1']['id'] : '',
								'QUANTITY' => isset($data['S_2']) ? $data['S_2'] : '',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shade Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($prod);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$existCheck = $ProductShade->checkShadeExistCheckWrtProductId(isset($data['S_1']['id']) ? $data['S_1']['id'] : '',$prod,$data ['ID']);

				if ($existCheck == true) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Shade already added in product.';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_product_shades_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $data ['ID'] ) ->update (
						array ( 'SHADE_ID' => isset($data['S_1']['id']) ? $data['S_1']['id'] : '',
								'QUANTITY' => isset($data['S_2']) ? $data['S_2'] : '',

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shade Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($prod);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function updateCategory(Request $request){
		$result = $_REQUEST['details'];
		$Categorymodel = new CategoryModel();
		// $id = $result['userID'];
		$category = $result ['category'];
		$product_ID = $result['productId'];

		DB::table('jb_product_tbl')->where('PRODUCT_ID',$product_ID)->update([
			'CATEGORY_ID' =>  $result['category']['id'],
		]);

		$arrRes ['msg'] = 'Category ID Updated Successfully!';
		$arrRes ['done'] = true;
		$arrRes ['subCategory'] = $Categorymodel->getSubCategoryLovWrtCategory($category['id']);
		echo json_encode ( $arrRes );



	}

	public function getAllProductsOfCategory(){

		$details = $_REQUEST ['details'];
		$category = $details ['categoryid'];
		$productId = $details ['productId'];
		$ProductModel = new ProductModel();
	  	 $product_lov = DB::table('jb_product_tbl')->where('CATEGORY_ID',$category)->orderby('PRODUCT_ID', 'desc')
	   ->where('STATUS','active')->get();

	   if(count($product_lov) > 0){

	   $i=0;
	   foreach ($product_lov as $row){
		   $arrRes['product'][$i]['id'] = $row->PRODUCT_ID;
		   $arrRes['product'][$i]['name'] = $row->NAME;

		   $i++;
	   }

	   $arrRes['selectRecomended_lov'] =  $ProductModel->getRecomendedProductsWrtProductID($productId);
	   $arrRes['selectHandPick_lov'] =  $ProductModel->gethandPickProductsWrtProductID($productId);

	   echo json_encode ( $arrRes );

	}

		// $result = $_REQUEST['details'];
		// $categoryId = $result['categoryid'];
		// $products = [];

		// $Product = new ProductModel();

		// $arrRes ['getAllProductsOfCategory'] = $Product->getProductsOfCategory($categoryId);

		// echo json_encode( $arrRes );
	}

	public function deleteIngredientQuickAdd(){
		$details = $_REQUEST ['details'];
		$ingredientId = $details ['ingredientId'];

		DB::table('jb_product_ingredient_tbl')->where('PRODUCT_INGREDIENT_ID',$ingredientId)->delete();

		$arrRes ['msg'] = 'Ingredient Deleted Successfully!';
		$arrRes ['id'] = $ingredientId;
		$arrRes ['done'] = true;
		echo json_encode ( $arrRes );

	}
	public function UpdateSecondSection(){
		$details = $_REQUEST ['details'];
		$productID = $details ['productId'];
		$quickSection = $details ['quickSection'];

		DB::table('jb_product_tbl')->where('PRODUCT_ID',$productID)->update([
			'DESCRIPTION_TITLE' =>  $quickSection['P_17'],
			'DESCRIPTION' => base64_encode($quickSection['P_18']),

		]);

		$arrRes ['msg'] = 'Second Section Updated Successfully!';
		$arrRes ['done'] = true;
		echo json_encode ( $arrRes );


	}
    public function updateSubscriptionInfo(){


		$details = $_REQUEST ['details'];
        $productId = $details['productId'];
        $userId = $details['userId'];
        // dd($details);

		$subscriptionDetails = $details['subcriptionDetails'];
		$subscriptionTitle = $subscriptionDetails ['S_1'];
		$subscriptionLink = $subscriptionDetails ['S_2'];
        $subscriptionNote= $subscriptionDetails ['S_3'];

        if($subscriptionTitle == '' || $subscriptionTitle == null){
            $arrRes ['done'] = false;
            $arrRes ['msg'] = 'Title can not be empty.';
            echo json_encode ( $arrRes );
            die ();
        }else if($subscriptionLink == '' || $subscriptionLink == null){
            $arrRes ['done'] = false;
            $arrRes ['msg'] = 'Link can not be empty.';
            echo json_encode ( $arrRes );
            die ();
        }else if($subscriptionNote == '' || $subscriptionNote == null){
            $arrRes ['done'] = false;
            $arrRes ['msg'] = 'Description can not be empty.';
            echo json_encode ( $arrRes );
            die ();
        }else{
            $basic = [];
            $basic['SUBSCRIPTION_NOTE_TITLE'] = $subscriptionTitle;
            $basic['SUBSCRIPTION_NOTE_DESCRIPTION'] = base64_encode($subscriptionNote);
            $basic['SUBSCRIPTION_NOTE_LINK'] = $subscriptionLink;

            DB::table('jb_product_tbl')->where('PRODUCT_ID',$productId)->update($basic);

            $arrRes ['msg'] = 'Subscription Title/Description updated successfully!';
            $arrRes ['done'] = true;

            echo json_encode ( $arrRes );
        }



	}
	public function updateVideoInfo(){


		$details = $_REQUEST ['details'];
		$videoDetails = $details['videoDetails'];
		$videoId = $videoDetails ['ID'];
		$videoHeading = $videoDetails ['V_1'];
		$videoNote = $videoDetails ['V_2'];

		$basic = [];
		$basic['VIDEO_TITLE'] = $videoHeading;
		$basic['VIDEO_DESCRIPTION'] = base64_encode($videoNote);

		DB::table('jb_product_video_tbl')->where('VIDEO_ID',$videoId)->update($basic);

		$arrRes ['msg'] = 'Video Title/Description updated successfully!';
		$arrRes ['done'] = true;
		echo json_encode ( $arrRes );

	}
	public function productQuickAdd(){
		$ProductModel = new ProductModel();

		$productID = isset($_REQUEST['productID']) ? $_REQUEST['productID'] : "";

		$data['productDetails'] = $ProductModel->getQuickAddProductDataWrtProductID($productID);
		$data['adminMenu'] = $this->getAdminUserMenu();
		$data['page'] = 'Quick Add Product';

		return view('admin.quick-addproduct')->with($data);
	}
	/* quickAddProduct start */
	public function quickAddProduct(){

		$data['adminMenu'] = $this->getAdminUserMenu();
    	$data['page'] = 'Quick Add Product';
		return view('admin.quick-addproduct')->with($data);
	}
	public function getQuickAddAdminProduct(){

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$productID = $details ['productId'];
        // dd($productID);
		$ProductModel = new ProductModel();
		$features = new Feature();
		$Ingredient = new ProductIngredientModel();
		$ProductUses = new ProductUsesModel();
		$Shades = new ShadesModel();
		$Category = new CategoryModel();
		$ProductShade = new ProductShadeModel();
		$recomended= new Recomended();
		$handpicked= new Handpicked();


		$arrRes ['list1'] = $Category->getCategoryLov();
		$arrRes['features'] = $features->getactivefeaturesdata();
		$arrRes['videoPro'] = $ProductModel->getVideodata($productID);
		$arrRes ['ingredients'] = $Ingredient->getAllProductIngredientByProduct($productID);
		$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($productID);
		$arrRes ['list2'] = $Shades->getShadesLov();
		// $arrRes['activeFeatures']= $ProductModel->getQuickfeaturesdata();
		$arrRes ['recommandedProducts'] = $recomended->getrecomendedproducts($productID);
		$arrRes ['handpickProducts'] = $handpicked->gethanpickedproducts($productID);
		$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($productID);
		$arrRes['productDetails'] = $ProductModel->getQuickAddProductDataWrtProductID($productID);
		$arrRes ['subCategory'] = $Category->getSubCategoryLovWrtCategory(isset($arrRes['productDetails']['P_31']) ? $arrRes['productDetails']['P_31'] : '');
		$arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory(isset($arrRes['productDetails']['P_32']) ? $arrRes['productDetails']['P_32'] : '');
        $arrRes ['subscriptionDetails'] = $ProductModel->getSubscriptionDetailsOfSingleProduct($productID);

		// $arrRes ['clinicalNote'] = $ProductModel->getAllProductClinicalNoteByProduct($productID);
		// dd($arrRes['productDetails']);
		// dd($arrRes['productDetails']);
		echo json_encode ( $arrRes );

	}
	public function updateFeatures(){
		$ProductModel = new ProductModel();

		$details = $_REQUEST ['details'];
		$data = $details['featuresArr'];
		$productId = $details['productId'];

		$featuresArray = implode(',', array_column($data, 'id'));

		DB::table('jb_product_tbl')->where('PRODUCT_ID',$productId)->update([
			'FEATURE_ID' => $featuresArray
		]);

		$arrRes['getSelectedFeatures'] = $ProductModel->getQuickfeaturesdata($featuresArray);
		// dd($arrRes['getSelectedFeatures']);
		$arrRes ['msg'] = 'Features updated successfully!';
		$arrRes ['done'] = true;
		echo json_encode ( $arrRes );
	}
	public function updateAdminQuickProductBasicInfo(){
		$details = $_REQUEST ['details'];

		$data = $details['record'];

		$basic = [];

		$basic['NAME'] = $data['P_1'];
		$basic['SUB_TITLE'] = $data['P_2'];
		$basic['UNIT_PRICE'] = $data['P_3'];
		$basic['UNIT'] = $data['P_4'];
		$basic['SHORT_DESCRIPTION'] = $data['P_5'];
		$basic['QUANTITY'] = $data['P_6'];

		DB::table('jb_product_tbl')->where('PRODUCT_ID',$data['PRODUCT_ID'])->update($basic);


		$arrRes ['msg'] = 'Data updated successfully!';
		$arrRes ['done'] = true;
		echo json_encode ( $arrRes );

	}
	/* quickAddProduct end */
	public function saveAdminQuickProductBasicInfo(){
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$getLastSeq = DB::table ( 'jb_product_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

		if($getLastSeq != null){

			$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

		}else{

			$getLastSeq=1;
		}

		$result = DB::table ( 'jb_product_tbl' )
				->insertGetId (
					array ( 'USER_ID' => $userId,
							'NAME' => 'Product Name',
							'SUB_TITLE' => 'Sub Title',
							'SHORT_DESCRIPTION' => 'Nunc interdum, turpis id aliquam luctus,leo quam condimentum orci, ac pellentesque leo dui accumsan magna.Ut vel arcu congue, quis cursus arcu cursus at.turpis lacus pretium eros, vitae sagittis lorem metus non ante.Pellentesque ut diam eget ex scelerisque finibus hendrerit ac urna.Vestibulum pulvinar vestibulum interdum. Cras feugiat pharetrasem quis luctus. Donec feugiat pellentesque facilisis.',
							'UNIT' => '200',
							'UNIT_PRICE' => '4000',
							'QUANTITY' => '200',
							'SEQ_NUM' => $getLastSeq,
							'SUBSCRIPTION_NOTE_TITLE' => 'Sub title',
							'SUBSCRIPTION_NOTE_DESCRIPTION' => base64_encode('Sub desc'),
							'SUBSCRIPTION_NOTE_LINK' => 'Sub-link.com',
							// 'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
							// 'TAGS' => $data ['P_5'],
							// 'BARCODE' => $data ['P_6'],
							// 'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
							 'CATEGORY_ID' => '5',
							// 'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
							// 'SUB_SUB_CATEGORY_ID' => isset($data ['P_44']['id']) ? $data ['P_44']['id'] : '',
							// 'SLUG' => $data ['P_10'],

							'DESCRIPTION_TITLE' => 'Second section',
							'DESCRIPTION' => base64_encode('leo quam condimentum orci, ac pellentesque leo dui accumsan magna.Ut vel arcu congue, quis cursus arcu cursus at.turpis lacus pretium eros, vitae sagittis lorem metus non ante.Pellentesque ut diam eget ex scelerisque finibus hendrerit ac urna.Vestibulum pulvinar vestibulum interdum.'),
							'CLINICAL_NOTE_DESCRIPTION' => base64_encode('leo quam condimentum orci, ac pellentesque leo dui accumsan magna.Ut vel arcu congue, quis cursus arcu cursus at.turpis lacus pretium eros, vitae sagittis lorem metus non ante.Pellentesque ut diam eget ex scelerisque finibus hendrerit ac urna.Vestibulum pulvinar vestibulum interdum.'),
							'STATUS' => 'inactive',
							// 'FEATURE_ID' => isset($feature_id) ? rtrim($feature_id,',') : '',
							'DATE' => date ( 'Y-m-d H:i:s' ),
							'CREATED_BY' => $userId,
							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
							// 'UPDATED_BY' => $userId,
							// 'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);

				DB::table ( 'jb_product_video_tbl' )->insert([
					'USER_ID' => $userId,
					'PRODUCT_ID' => $result,
					'VIDEO_TITLE' => 'Video Title',
					'VIDEO_DESCRIPTION' => base64_encode('Video Description'),

				]);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Created Successfully';
				$arrRes ['id'] = $result;
				echo json_encode ( $arrRes );

	}

	/* Selfie code */
	public function ChangeAdminProductSnapSelfieStatus(){
		$ProductSelfiModel = new ProductSelfiModel();

		$details = $_REQUEST ['details'];
		$productSelfiID = $details ['productSelfiID'];

		$productselfistatus = $ProductSelfiModel->ChangeAdminProductSnapSelfieStatus($productSelfiID);

		if(isset($productselfistatus['STATUS']) && $productselfistatus['STATUS'] != '1'){
			$status = '1';
			$arrRes ['msg'] = 'Selfie active successfully...';
		}else{
			$status = '0';
			$arrRes ['msg'] = 'Selfie Inactive successfully...';
		}

		$result = DB::table ( 'jb_product_selfi_tbl' ) ->where ( 'SELFIE_ID', $productSelfiID ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}



		/* Selfie code end */

	public function addSocialIcons(Request $request) {
		$detail=$_REQUEST['details'];
				$data=$detail['social'];

		$social=[];
		$social['FACEBOOK_ICON_LINK']=$data['S_1'];
		$social['FACEBOOK_ICON_ENABLE']=$data['S_2'] == 'true' ? '1' : '0';
		$social['INSTAGRAM_ICON_LINK']=$data['S_3'];
		$social['INSTAGRAM_ICON_ENABLE']=$data['S_4'] == 'true' ? '1' : '0';
		$social['TWITTER_ICON_LINK']=$data['S_5'];
		$social['TWITTER_ICON_ENABLE']=$data['S_6'] == 'true' ? '1' : '0';
		$social['LINKEDIN_ICON_LINK']=$data['S_7'];
		$social['LINKEDIN_ICON_ENABLE']=$data['S_8'] == 'true' ? '1' : '0';
		$social['YOUTUBE_ICON_LINK']=$data['S_9'];
		$social['YOUTUBE_ICON_ENABLE']=$data['S_10'] == 'true' ? '1' : '0';


		$arrRes = array();
		if($data['ID'] == ''){
			$social['CONTROL_ID']=1;
			DB::table('jb_footer_control_tbl')->insert($social);
			$arrRes ['msg'] = 'Data Added successfully!';

		}else{

			DB::table('jb_footer_control_tbl')->where('CONTROL_ID',1)->update($social);
			$arrRes ['msg'] = 'Data updated successfully!';

		}

		return response()->json($arrRes, 200);

   	}
	public function displaySocialData() {
		$AddSocialIconsModel=new AddSocialIconsModel();
		$footerdetails = $AddSocialIconsModel->getFooterdata();
		return response()->json(['footerdetails' => $footerdetails], 200);
   	}


	public function index() {

    	$data['page'] = 'login';
       	return view('admin.login')->with($data);
   	}
   	public function login(Request $request){

   		if($request->session()->has('userId')){
   			return redirect('dashboard');
   		}else{
   			return view('admin.login');
   		}
   	}

   	public function logout(Request $request) {
	   	$request->session()->forget('userId');
	   	$request->session()->forget('userName');
	   	$request->session()->forget('firstName');
	   	$request->session()->forget('lastName');
	   	$request->session()->forget('email');
		$request->session()->forget('userSubType');
	   	return redirect('admin');
   	}

   	public function dashboard() {
		$User=new User();
		$data['getTotalUsers']= $User->getTotalUsers();
		$data['getAdminUsers'] = $User->getAdminUsers();
		$data['getTotalTickets']= $User->getTotalTickets();
		$data['getTotalProducts']= $User->getTotalProducts();
		$data['getTotalPayments']= $User->getTotalPayments();
		$data['getTotalBundles']= $User->getTotalBundles();
		$data['getTotalBlogs']= $User->getTotalBlogs();
		$data['getTotalOrders']= $User->getTotalOrders();
		$data['getShippedOrders']= $User->getTotalShippedOrders();
		$data['getTotalInTransitOrders']= $User->getTotalInTransitOrders();
		$data['getTotalSubscriptions']= $User->getTotalSubscriptions();
		$data['getTotalReviews']= $User->getTotalReviews();
		$data['getTotalGivings']= $User->getTotalGivings();
		$data['mostSaledItems']= $User->mostSaleItems();
		$data['lineChartData']= $User->getLineChartDetails();
   		$data['page'] = 'Dashboard';
		$data['adminMenu'] = $this->getAdminUserMenu();

		// $UserMenuControl = new UserMenuControlModel();
		// print_r('<pre>');
        // print_r($data['adminMenu']);
        // exit();
   		return view('admin.dashboard')->with($data);
   	}

	public function getAdminUserMenu(){
		$UserMenuControl = new UserMenuControlModel();

		$user_id = session('userId');
		if(session('userSubType') == 'admin'){

			$Menus = $UserMenuControl->getAllMenuWrtAdmin();

		}else if(session('userSubType') == 'subadmin' ){

			$Menus = $UserMenuControl->getMenuLinksWRTUserId($user_id);

		}

		return $Menus ;
	}

	public function viewAllSelfi() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data['page'] = 'Snap Product Selfi';
		$result=$this->checkUserControlAccess(session('userId'),"/view-all-selfi");
		if( $result != true) {
			return view('admin.view-productselfi')->with($data);
		}else{
			return redirect('/dashboard');
		}
		// return view('admin.view-productselfi')->with($data);
	}
       /* Selfie  get and delete admin side start*/
	   public function deletSelectedSelfie(Request $request){

		// $ProductSelfiModel = new ProductSelfiModel();

		$details = $_REQUEST ['details'];
		$id = $details['productSelectedSelfiID'];

		// $selfieDetail = $ProductSelfiModel->getSpecificSelfiAttachments($id);

		$result = DB::table('jb_product_selfi_images_tbl as a')
    	->where('a.IMAGE_ID', $id)
    	->get();

		if(isset($result) && !empty($result)){
			foreach ($result as $value){
				unlink($value->PATH);
			}

		}
		DB::table('jb_product_selfi_images_tbl')->where('IMAGE_ID', $id)->delete();


		$arrRes['done']=true;
		$arrRes['id'] = $id;
		$arrRes['message']="Selfie deleted Successfully";
		return isset($arrRes) ? $arrRes : null;

     }

	 public function deletespecificselfie(Request $request){

		$ProductSelfiModel = new ProductSelfiModel();

		$details = $_REQUEST ['details'];
		$id = $details['productSelfiID'];

		$selfieDetail = $ProductSelfiModel->getSpecificSelfiAttachments($id);

		DB::table('jb_product_selfi_images_tbl')->where('SELFIE_ID', $id)->delete();
		DB::table('jb_product_selfi_tbl')->where('SELFIE_ID', $id)->delete();

		if(isset($selfieDetail) && !empty($selfieDetail)){
			foreach ($selfieDetail as $value){
				unlink($value['path']);
			}
		}



		$arrRes['done']=true;
		$arrRes['message']="Selfie deleted Successfully";
		return isset($arrRes) ? $arrRes : null;

     }

	public function get_selfies(Request $request){

		 $details = $_REQUEST ['details'];
		 $id= $details['productSelfiID'];

		 $result = DB::table('jb_product_selfi_images_tbl as a')->select('a.*')
		 ->where('a.SELFIE_ID', $id)
		 ->orderBy('a.SELFIE_ID','desc')
		 ->get();

		//  dd($result);
         $i=0;
		 if($result != null){
		 foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->IMAGE_ID;
		   $arrRes[$i]['DOWNPATH'] = $row->DOWN_PATH;
		   $arrRes[$i]['FILE_TYPE'] = $row->FILE_TYPE;
		   $i++;
		 }
	 }

		return isset($arrRes) ? $arrRes : null;

	}

	       /* Selfie  get and delete admin side End */


   	public function partners() {

		$data['adminMenu'] = $this->getAdminUserMenu();
       	$data['page'] = 'Partners';

		$result=$this->checkUserControlAccess(session('userId'),"/partners");
		if( $result != true) {
			return view('admin.partners')->with($data);
		}else{
			return redirect('/dashboard');
		}

       	// return view('admin.partners')->with($data);
   	}

//    	public function adminUsers() {

//        	$data['page'] = 'Admin Users';
//        	return view('admin.admin-users')->with($data);
//    	}



   	public function adminProfile() {

		$data['getLoggedUser'] = $this->getLoggedUser(session('userId'));
		$data['adminMenu'] = $this->getAdminUserMenu();
   		$data['page'] = 'Admin Profile';
		$result=$this->checkUserControlAccess(session('userId'),"/admin-profile");
		if( $result != true) {
			return view('admin.admin-profile')->with($data);
		}else{
			return redirect('/dashboard');
		}
   		// return view('admin.admin-profile')->with($data);
   	}

	public function getLoggedUser($id){

		$result = DB::table('fnd_user_tbl')
				->where('USER_ID',$id)
				->get()
				->toArray()[0];

		return isset($result) ? $result : null;
	}


   	public function addAdminUser() {

		$data['adminMenu'] = $this->getAdminUserMenu();
       	$data['page'] = 'add Admin User';
		$result=$this->checkUserControlAccess(session('userId'),"/add-admin-user");
		if( $result != true) {
			return view ( 'admin.add-admin-user' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
       	// return view('admin.add-admin-user')->with($data);
   	}

   	public function websiteUsers() {

		$data['adminMenu'] = $this->getAdminUserMenu();
       	$data['page'] = 'Website Users';
		$result=$this->checkUserControlAccess(session('userId'),"/website-users");
		   if( $result != true) {
			  return view ( 'admin.website-users' )->with ( $data );
		   }else{
			return redirect('/dashboard');
		   }
       	// return view('admin.website-users')->with($data);
   	}

   	public function addWebsiteUser() {

		$data['adminMenu'] = $this->getAdminUserMenu();
       	$data['page'] = 'Add Website User';
		$result=$this->checkUserControlAccess(session('userId'),"/add-website-user");
		   if( $result != true) {
			   view ( 'admin.add-website-user')->with ( $data );
		   }else{
			return redirect('/dashboard');
		   }
       	// return view('admin.add-website-user')->with($data);
   	}

   	public function viewCategories() {

		$data['adminMenu'] = $this->getAdminUserMenu();
       	$data['page'] = 'View Categories';
		$result=$this->checkUserControlAccess(session('userId'),"/view-categories");

		if( $result != true) {
			return view('admin.view-categories')->with($data);
		}else{
			return redirect('/dashboard');
		}
       	// return view('admin.view-categories')->with($data);
   	}

   	public function viewProducts() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View Products';
		$result=$this->checkUserControlAccess(session('userId'),"/view-products");

		if( $result != true) {
			return view ( 'admin.view-products')->with( $data );
		}else{
			return redirect('/dashboard');
		}
	}

	public function getAllAdminProductSnapSelfielov() {
		$ProductSelfiModel = new ProductSelfiModel();

		$arrRes ['productselfi'] = $ProductSelfiModel->getAllAdminSelfie();

		// dd($arrRes);
		echo json_encode ( $arrRes );
	}

	public function viewBundles() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View Bundles';

		$result=$this->checkUserControlAccess(session('userId'),"/view-bundles");
		   if( $result != true) {
			return view ( 'admin.view-productbundles' )->with ( $data );
		   }else{
			return  redirect('/dashboard');
		   }

		// return view ( 'admin.view-productbundles' )->with ( $data );
	}

      public function addProduct() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add Product';

		   $result=$this->checkUserControlAccess(session('userId'),"/add-product");
		   if( $result != true) {
			return view ( 'admin.add-product' )->with ( $data );
		   }else{
			return redirect('/dashboard');
		   }
		// return view ( 'admin.add-product' )->with ( $data );
	 }

	   //===============Routine ========================>

	   public function add_routine(){
		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add Routine';
		$result=$this->checkUserControlAccess(session('userId'),"/addroutine");
		if( $result != true) {
			return view('admin.Routines.addroutine')->with( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view('admin.Routines.addroutine')->with( $data );
	   }

	   public function routine(){
			$data['adminMenu'] = $this->getAdminUserMenu();
		    $data ['page'] = 'Add Routine';
			$result=$this->checkUserControlAccess(session('userId'),"/routine");
			if( $result != true) {
				return view('admin.Routines.routine')->with( $data );
			}else{
				return redirect('/dashboard');
			}
		    // return view('admin.Routines.routine_type_new')->with( $data );
	   }
	   public function routine_type(){
			$data['adminMenu'] = $this->getAdminUserMenu();
			$data ['page'] = 'Routine Type';
			$result=$this->checkUserControlAccess(session('userId'),"/routine_type");
			if( $result != true) {
				return view('admin.Routines.routine_type')->with( $data );
			}else{
				return redirect('/dashboard');
			}
			// return view('admin.Routines.routine_type_new')->with( $data );
		}


	   public function getTypeNameLov(Request $request){

		$details = $_REQUEST ['details'];
		$typeid= $details['typeid'];

		$result = DB::table('jb_routine_type_tbl as a')->select('a.*')
		->where('a.STATUS','active')
		// ->where('a.TYPE_ID', $typeid)
		->orderBy('a.ROUTINETYPE_ID','desc')
		->get();

		$i=0;
		foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->CATEGORY_ID;
		   $arrRes[$i]['name'] = $row->CATEGORY_NAME;
		   $i++;
		}

		return isset($arrRes) ? $arrRes : null;
	 }

	 public function remove_routine(Request $request){

		$details = $_REQUEST ['details'];
		$routineid = $details ['routineid'];

		$typename= TypeName::where('ROUTINETYPE_ID',$routineid)->first();

		if($typename){
			$nameid=$typename->ROUTINETYPE_ID;
			$step = RoutineSteps::where('ROUTINETYPE_ID', $nameid)->delete();
			$typename= TypeName::where('ROUTINETYPE_ID',$routineid)->delete();
			$routine= RoutineType::where('ROUTINE_ID',$routineid)->delete();

		}else{

			$routine= RoutineType::where('ROUTINE_ID',$routineid)->delete();

		}


		// $steps= new RoutineSteps();

		// $arrRes['typenamelov']= $typename->getTypeNameLov($typeid);
		// $arrRes['typedata']=$typename->getallnamedata($typeid);
		// $stepsarray=$steps->getstepsbasedonroutine($typenameid);

		// $arrRes['steps']=$stepsarray;

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Routine has been deleted with all of its contents.';
		echo json_encode ( $arrRes );
		  die ();


	 }

	 public function remove_routine_type_name(Request $request){


		 $details = $_REQUEST ['details'];
		 $typenameid = $details ['typenameid'];

		 //  $typename= TypeName::where('NAME_ID',$typenameid)->first();
		 $typename=TypeName::where('ROUTINETYPE_ID',$typenameid)->delete();

	    //  $typeid=$typename->TYPE_ID;
		$typeid=$typenameid;

		 $step = RoutineSteps::where('ROUTINETYPE_ID', $typenameid)->delete();

		 $typename= TypeName::where('ROUTINETYPE_ID',$typenameid)->delete();

	     $steps= new RoutineSteps();
		 $typename= new TypeName();

		 $arrRes['typenamelov']= $typename->getTypeNameLov($typeid);

		 $arrRes['typedata']=$typename->getallnamedata($typeid);

	     $stepsarray=$steps->getstepsbasedonroutine($typeid);

	     $arrRes['steps']=$stepsarray;

	     $arrRes ['done'] = true;
	     $arrRes ['msg'] = 'Routine type name and its Steps Deleted Successfully.';
	     echo json_encode ( $arrRes );
		   die ();

     }



	 public function removesteps(Request $request){

		     $details = $_REQUEST ['details'];
		     $stepid = $details ['stepid'];
		     $routineid = $details ['routineId'];

		     $step = RoutineSteps::where('STEP_ID', $stepid)->first();
		     $name_id = $step->ROUTINETYPE_ID;
             $step_no = $step->STEP_NO;

		     $getallsteps = RoutineSteps::where('ROUTINETYPE_ID', $name_id)->where('ROUTINE_ID',$routineid)->count();

			if( $getallsteps == $step_no){
				$step = RoutineSteps::where('STEP_ID', $stepid)->delete();
			}
			else{
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'You must delete the steps in descending order.';
				echo json_encode ( $arrRes );
				die ();
		  	}

		//   $step = RoutineSteps::where('STEP_ID', $stepid)->delete();

		//   $typename= TypeName::where('ROUTINETYPE_ID',$name_id)->first();
		//   $typeid=$typename->ROUTINE_ID;

			$steps = new RoutineSteps();
			$stepsarray = $steps->getRoutineSteps($routineid);

			$arrRes['steps'] = $stepsarray;

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Step Deleted Successfully.';
			echo json_encode ( $arrRes );
			die ();

	 }

	 public function addstep_routine(Request $request){

		 $details = $_REQUEST ['details'];
		 $data = $details ['routinetype'];
		 $userId = $details ['userId'];
		 $typeid = $details['typeid'];
		 $mainRoutine = $details['mainRoutine'];

         if(!isset($data['P_7']['id'])){
			$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Select routine Type.';
				echo json_encode ( $arrRes );
				die ();
		 }
		 if(!isset($data['P_8']['id'])){
			$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Select category to procced.';
				echo json_encode ( $arrRes );
				die ();
		 }
		 if(!isset($data['P_11']['id'])){
			$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Select Product to procced.';
				echo json_encode ( $arrRes );
				die ();
		 }
		 $typeid= $data['P_7']['id'];


		 $arrRes = array ();
		 $arrRes ['done'] = false;
		 $arrRes ['msg'] = '';



		if (isset ( $data ) && ! empty ( $data )) {

			 if ($data['P_12'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description  is required.';
				echo json_encode ( $arrRes );
				die ();
			 }

			 if($data['P_7']['id'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose routine to proceed.';
				echo json_encode ( $arrRes );
				die ();
			 }
			 if($data['P_11']['id'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose Product to proceed.';
				echo json_encode ( $arrRes );
				die ();

			 }
			 // if ($data ['P_2'] == '') {

			 // 	$arrRes ['done'] = false;
			 // 	$arrRes ['msg'] = 'Quantity is required.';
			 // 	echo json_encode ( $arrRes );
			 // 	die ();
			 // }

			 $ROUTINETYPE = new RoutineType();
			 $routinetypename= new TypeName();
			 $steps=new RoutineSteps();

			 $result = DB::table('jb_routine_type_tbl as a')->select('a.*')
    	     ->where('a.ROUTINETYPE_ID',$data['P_7']['id'])
    	     ->first();

		     $recordId=$result->ROUTINETYPE_ID;

			$result = DB::table ( 'jb_routine_type_steps_tbl' )->insertGetId (
				array (
						'USER_ID' => $userId,
						'ROUTINETYPE_ID' => $typeid,
						'ROUTINE_ID' => $mainRoutine,
						'STEP_NO' =>  $data['P_13'],
						'PRODUCT_ID' => $data['P_11']['id'],
						'DESCRIPTION' => $data['P_12'],
						'DATE' => date ( 'Y-m-d H:i:s' ),
						'CREATED_BY' => $userId,
						'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )));

					$stepsarray=$steps->getRoutineSteps($mainRoutine);

					$arrRes['steps']=$stepsarray;

				 $arrRes ['done'] = true;
				 $arrRes ['msg'] = 'Routine Type Step Created Successfully';
				 // $arrRes ['ID'] = $result;
				 // $arrRes ['redirect_url'] = url('routine_type_new');
				 echo json_encode ( $arrRes );
				 die ();
			}
		}


	   public function add_routine_type_name(Request $request){

		$details = $_REQUEST ['details'];
		$data = $details ['routinetype'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['C_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}


			// if($details['typeid'] == ''){
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Please Save the above section to proceed.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }


			// if ($data ['P_2'] == '') {

			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Quantity is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }

			if ($data ['ID'] == '') {

				$typename = TypeName::where('TYPE_NAME','=',$data['C_1'])->get();

				if($typename->count() > 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Routine Name Already Exists,Choose different Name.';
					echo json_encode ( $arrRes );
					die ();
				}

				 DB::table ( 'jb_routine_type_tbl' )->insertGetId (
						array (
								// 'TYPE_ID' => '',
								'TYPE_NAME' => $data['C_1'],
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						));

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Routine Type Name Created Successfully';
				echo json_encode ( $arrRes );
				die ();

			 } else {

				$result = DB::table ( 'jb_routine_type_tbl' ) ->where ( 'ROUTINETYPE_ID', $data ['ID'] ) ->update (
						array (
							    // 'TYPE_ID' => '',
								'TYPE_NAME' => $data['C_1'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				// $arrRes['typenamelov']= $typename->getTypeNameLov($typeid);
				// $arrRes['typedata']=$typename->getallnamedata($typeid);

				$arrRes ['msg'] = 'Routine Type Name Updated Successfully';
				// $arrRes ['ID'] = $data ['ID'];
				// $arrRes ['redirect_url'] = url('view-ingredients');
				echo json_encode ( $arrRes );
				die ();
			 }
		 }
	 }

	   public function checksteps(Request $request){

			$details= $_REQUEST['details'];
			$routineid= $details['routineid'];

			$routinetype_id= $details['routinetypeid']['id'];
			$arrRes = array();

			//  if($details['routinetypeid'] == '' && $type_id == ''){

			//  $arrRes ['done'] = false;
			//  $arrRes ['msg'] = 'Please Select routine and routine type is required.';
			//  echo json_encode ( $arrRes );
			//  die ();

			//  }


			$steps = DB::table('jb_routine_type_steps_tbl')
				->where('ROUTINETYPE_ID',$routinetype_id)
				->where('ROUTINE_ID', $routineid)->count();

			if($steps > 0){
				$count=$steps;
				$arrRes['count'] = $count+1;
			}else{
			$arrRes['count'] = 1;
			}
			$arrRes ['done'] = true;

			echo json_encode ( $arrRes );


	     }

	   public function routine_type_add(Request $request){

		$details = $_REQUEST ['details'];
		$data = $details ['Routinename'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}

            if(strlen($data['P_1']) < 3 || strlen($data['P_1']) > 100){
                $arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be between 3 and 100 chars.';
				echo json_encode ( $arrRes );
				die ();
            }
            if(ctype_digit($data['P_1'])){
                $arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be alphabetic or alphanumeric.';
				echo json_encode ( $arrRes );
				die ();
            }
			// if ($data ['P_2'] == '') {

			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Quantity is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if ($data ['P_3'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Select Routine Category is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_4'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}


			$typename= new TypeName();

			if ($data['ID'] == '') {

				$routine= RoutineType::where('NAME','=',$data['P_1'])->get();
				if($routine->count() > 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Routine Name already Exist,Choose different Name.';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_routine_tbl' )->insertGetId (
						array (
								'NAME' => $data['P_1'],
								'IDENTIFY' => $data['P_3'],
								'DESCRIPTION' => $data['P_4'],
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Routine Name Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes['typenamelov']=  $typename->getTypeNameLov($data ['ID']);

				$arrRes ['redirect_url'] = url('routine_type_new');
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_routine_tbl' ) ->where ( 'ROUTINE_ID', $data ['ID'] ) ->update (
						array (
							'NAME' => $data ['P_1'],
							'IDENTIFY' => $data['P_3'],
							'DESCRIPTION' => $data['P_4'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Routine Name Updated Successfully';
				$arrRes['typenamelov']= $typename->getTypeNameLov($data ['ID']);

				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['redirect_url'] = url('view-ingredients');
				echo json_encode ( $arrRes );
				die ();
			}
		}
	   }

	   public function changeStatusRoutineType(Request $request) {
		$RoutineType = new RoutineType();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$catDetail = $RoutineType->getSpecificRotineTypeData($recordId);

		if(isset($catDetail['STATUS']) && $catDetail['STATUS'] != 'active'){

			$status = 'active';
			$arrRes ['msg'] = 'Routine Name active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Routine Name Inactive successfully...';
		}

		$result = DB::table ( 'jb_routine_tbl' ) ->where ( 'ROUTINE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );

	}

    public function change_routine_type_status(){

        $RoutineType = new RoutineType();

		$details = $_REQUEST ['details'];
		$recordId = $details ['routineId'];
		$userId = $details ['userId'];

		$routineTypeDetail = $RoutineType->getSpecificRotineTypeDetail($recordId);
        // dd($routineTypeDetail->STATUS);
        // if(isset())
		if(isset($routineTypeDetail->STATUS) && $routineTypeDetail->STATUS != 'active'){

			$status = 'active';
			$arrRes ['msg'] = 'Routine Type Activated Successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Routine Type Deactivated Successfully...';
		}

		$result = DB::table ( 'jb_routine_type_tbl' ) ->where ( 'ROUTINETYPE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );

    }
	public function routine_type_name_edit(){

		$ROUTINETYPE = new RoutineType();
		$routinetypename= new TypeName();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$arrRes['typename']= $routinetypename->getspecifictypename($recordId);

		 echo json_encode ( $arrRes );
  }

	   public function routine_type_edit(){

			$ROUTINETYPE = new RoutineType();
			$routinetypename= new TypeName();
			$steps=new RoutineSteps();

			$details = $_REQUEST ['details'];
			$recordId = $details ['recordId'];
			$userId = $details ['userId'];

			$arrRes ['details'] = $ROUTINETYPE->getSpecificRotineTypeData($recordId);
			$arrRes ['images'] = $ROUTINETYPE->getSpecificRoutineTypeAttachments($recordId);

			$arrRes['typenamelov']= $routinetypename->getTypeNameLov($recordId);
		//   dd($arrRes);
			$type = $routinetypename->getallnamedata($recordId);
			$arrRes['alltypenamedata']= $type;
			$arrRes['getRoutineSteps'] = $steps->getRoutineSteps($recordId);


		//   $typeid=[];

		//   if($type){
		//   foreach($type as $data){
        //       $typeid[]= $data['id'];
		// 	  $typename[]=$data['name'];
		//    }
        //       $k=0;

		//    foreach($typeid as $v=>$id_type){
		//     foreach($typename as $b=>$name)
		// 	if($v== $b){
		// 	  $steps2=$steps->getsteps($id_type,$name);

		// 	   if($steps2){
		// 		$arr[$k]= $steps2 ;
		// 		$k++;
		// 	 }
		// 	}
		// 	}
		// 	$steps_array=[];
		// 	$j=0;
		// 	if(isset($arr)){
		// 	foreach($arr as $r){
		// 		foreach($r as $k){
		// 			$steps_array[$j] = $k;
		// 			$j++;
		// 		}
		// 	}
		// }

		// 	$arrRes['steps'] =	$steps_array;
		//  }

		   echo json_encode ( $arrRes );
	}
	public function getAllAdminroutinetype() {

		$RoutineType = new RoutineType();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];


		$arrRes ['list'] = $RoutineType->getRoutineTypeDataAdmin();

		$TypeName=new TypeName();

		$arrRes ['routinetypes']=$TypeName->getAllRoutineTypes();

		// $arr['routinetypessteps']=$TypeName->getallroutinetypelov();

		// $arrRes ['listSubCat'] = $Category->getSubCategoryData();
		// $arrRes ['listSubSubCat'] = $Category->getSubSubCategoryData();

		// $arrRes ['list1'] = $Category->getCategoryLov();
		// $arrRes ['list2'] = $Category->getSubCategoryLov();

		echo json_encode ( $arrRes );
	}

	public function deleteRoutineTypeRecord(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();

		$details = $_REQUEST ['details'];
		$categoryId = $details ['recordId'];
		$userId = $details ['userId'];

		$existCheckSubCategory = $CategoryModel->checkSubCategoryExistWrtCategory($categoryId);

		if($existCheckSubCategory == true){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Sub Categories exist against this category, kindly remove sub categories then proceed.';
			echo json_encode ( $arrRes );
			die();
		}

		$existCheckProduct = $ProductModel->checkProductExistWrtCategoryId($categoryId, '1');

		if($existCheckProduct == true){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Products exist against this category, kindly remove products then proceed.';
			echo json_encode ( $arrRes );
			die();
		}

		$delete = DB::table ( 'jb_category_tbl' )->where ( 'CATEGORY_ID', $categoryId )->delete ();

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Category deleted successfully...';

		echo json_encode ( $arrRes );
	}

	   //===============Routine End ===========================>

    	public function viewAllIngredients() {

			$data['adminMenu'] = $this->getAdminUserMenu();
		    $data ['page'] = 'View All Ingredients';
			$result=$this->checkUserControlAccess(session('userId'),"/view-ingredients");
			if( $result != true) {
				return view ( 'admin.view-all-ingredients' )->with ( $data );
			}else{
				return redirect('/dashboard');
			}
		    // return view ( 'admin.view-all-ingredients' )->with ( $data );
	 }

	 public function viewAllFeatures() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View All Features';
		$result=$this->checkUserControlAccess(session('userId'),"/view-features");
		if( $result != true) {
			return view ( 'admin.view-all-Features' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.view-all-Features' )->with ( $data );
}



	public function addNewIngredient($id='') {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add New Ingredient';
		$data ['ingredientId'] = $id;
		return view ( 'admin.add-new-ingredient' )->with ( $data );
	}

	public function viewAllShades() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View All Shades';
		$result=$this->checkUserControlAccess(session('userId'),"/view-all-shades");
		if( $result != true) {
			return view ( 'admin.view-all-shades' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
	}
	public function viewAllBlogs() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View All Shades';
		return view ( 'admin.view-all-bloges' )->with ( $data );
	}

	public function addShade() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add Shade';
		return view ( 'admin.add-shade' )->with ( $data );
	}

	public function blogs() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Blogs';
		return view ( 'admin.blogs' )->with ( $data );
	}

	public function addBlog() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add Blog';
		$result=$this->checkUserControlAccess(session('userId'),"/add-blog");
		if( $result != true) {
			return view ( 'admin.add-blog' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.add-blog' )->with ( $data );
	}

	public function editBlog() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Edit Blogs';
		return view ( 'admin.edit-blog' )->with ( $data );
	}

	public function shadeFinderQuiz() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Shade Finder Quiz';
		return view ( 'admin.shade-finder-quiz' )->with ( $data );
	}
	public function shadeFinderQuizYes() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Shade Finder Quiz';
		$result=$this->checkUserControlAccess(session('userId'),"/shade-finder-quiz-yes");
		if( $result != true) {
			return view ( 'admin.shade-finder-quiz-yes' )->with( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.shade-finder-quiz-yes' )->with ( $data );
	}
	public function shadeFinderQuizNo() {

		$data ['page'] = 'Shade Finder Quiz';
		$data['adminMenu'] = $this->getAdminUserMenu();
		$result=$this->checkUserControlAccess(session('userId'),"/shade-finder-quiz-no");
		if( $result != true) {
			return view ( 'admin.shade-finder-quiz-no' )->with ( $data );
		}else{
			redirect('/dashboard');
		}
		// return view ( 'admin.shade-finder-quiz-no' )->with ( $data );
	}

	public function addShadeFinderQuiz() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add Shade Finder Quiz';
		return view ( 'admin.add-shade-finder-quiz' )->with ( $data );
	}

	public function orders() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Orders';

		$result=$this->checkUserControlAccess(session('userId'),"/orders");
		if( $result != true) {
			return view ( 'admin.orders' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.orders' )->with ( $data );
	}
	public function shippedorders() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Shipped Orders';
		$result=$this->checkUserControlAccess(session('userId'),"/shippedorders");
		if( $result != true) {
			return view ( 'admin.shippedorders' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.shippedorders' )->with ( $data );
	}


	public function orderDetail() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Order Detail';
		return view ( 'admin.order-detail' )->with ( $data );
	}

	public function apis() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Apis';
		return view ( 'admin.apis' )->with ( $data );
	}

	public function addApi() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add Api';
		return view ( 'admin.add-api' )->with ( $data );
	}

	public function editApi() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Edit Api';
		return view ( 'admin.edit-api' )->with ( $data );
	}

	public function viewApi() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View Api';
		return view ( 'admin.view-api' )->with ( $data );
	}

	public function smsApis() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Sms Apis';
		return view ( 'admin.sms-apis' )->with ( $data );
	}

	public function addSmsApi() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add Sms Api';
		return view ( 'admin.add-sms-Api' )->with ( $data );
	}

	public function editSmsApi() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Edit Sms Api';
		return view ( 'admin.edit-sms-Api' )->with ( $data );
	}

	public function smsTemplates() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Sms Templates';
		return view ( 'admin.sms-templates' )->with ( $data );
	}

	public function addSmsTemplate() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add SmsTemplate';
		return view ( 'admin.add-sms-template' )->with ( $data );
	}

	public function editSmsTemplate() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Edit SmsTemplate';
		return view ( 'admin.edit-sms-template' )->with ( $data );
	}

	public function header() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Header';
		return view ( 'admin.header' )->with ( $data );
	}

	public function footer() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Footer';
		$result=$this->checkUserControlAccess(session('userId'),"/footer");
		if( $result != true) {
			return view ( 'admin.footer' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.footer' )->with ( $data );
	}

	public function homePage() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Home Page';
		$result=$this->checkUserControlAccess(session('userId'),"/home-page");
		if( $result != true) {
			return view ( 'admin.home-page' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.home-page' )->with ( $data );
	}

	public function payments() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Payments';
		$result=$this->checkUserControlAccess(session('userId'),"/payments");
		if( $result != true) {
			return view ( 'admin.payments' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.payments' )->with ( $data );
	}

	public function viewPayment() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View Payment';
		return view ( 'admin.view-payment' )->with ( $data );
	}

	public function givings() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Givings';
		$result=$this->checkUserControlAccess(session('userId'),"/givings");
		if( $result != true) {
			return view ( 'admin.givings' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.givings' )->with ( $data );
	}

	public function Delivery() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Delivery';
		return view ( 'admin.delivery' )->with ( $data );
	}

	public function vieDelivery() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View Delivery';
		return view ( 'admin.view-delivery' )->with ( $data );
	}

	public function Questions() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Questions';
		$result=$this->checkUserControlAccess(session('userId'),"/questions");
		if( $result != true) {
			return view ( 'admin.questions' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.questions' )->with ( $data );
	}

	public function viewReview() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View Review';

		return view ( 'admin.view-review' )->with ( $data );
	}

	public function Reviews() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Reviews';
		$result=$this->checkUserControlAccess(session('userId'),"/reviews");
		if( $result != true) {
			return view ( 'admin.reviews' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.reviews' )->with ( $data );
	}

	public function shadeFinder() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Shade Finder';
		return view ( 'admin.shade-finder' )->with ( $data );
	}

	public function viewShadeFinder() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'View Shade Finder';
		return view ( 'admin.view-shade-finder' )->with ( $data );
	}

	public function emailsSettings() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Emails Settings';
		$result=$this->checkUserControlAccess(session('userId'),"/emails-settings");
		if( $result != true) {
			return view ( 'admin.emails-settings' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.emails-settings' )->with ( $data );
	}

	public function emailsSent() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Emails Sent';
		$result=$this->checkUserControlAccess(session('userId'),"/emails-sent");
		if( $result != true) {
			return view ( 'admin.emails-sent' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.emails-sent' )->with ( $data );
	}

	public function allsub() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'All Sub';
		$result=$this->checkUserControlAccess(session('userId'),"/allsub");
		if( $result != true) {
			return view ( 'admin.allsub' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.allsub' )->with ( $data );
	}

	public function editAllsub() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Edit All Sub';
		return view ( 'admin.edit-allsub' )->with ( $data );
	}

	public function addAllsub() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Add All Sub';
		return view ( 'admin.add-allsub' )->with ( $data );
	}

	public function userSubscriptions() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'User Subscriptions';
		$result=$this->checkUserControlAccess(session('userId'),"/user-subscriptions");
		if( $result != true) {
			return view ( 'admin.user-subscriptions' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.user-subscriptions' )->with ( $data );
	}
	public function adminUserTickets() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Tickets';
		$result=$this->checkUserControlAccess(session('userId'),"/user-Tickets");
		if( $result != true) {
			return  view ( 'admin.view-tickets' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return  view ( 'admin.view-tickets' )->with ( $data );
	}
	public function newsLatters() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'News Latters';
		$result=$this->checkUserControlAccess(session('userId'),"/newslatters");
		if( $result != true) {
			return view ( 'admin.view-newslatters' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.view-newslatters' )->with ( $data );
	}
	public function snapSelfie() {

		$data['adminMenu'] = $this->getAdminUserMenu();
		$data ['page'] = 'Snap Selfi';
		$result=$this->checkUserControlAccess(session('userId'),"/snapSelfie");
		if( $result != true) {
			return view ( 'admin.view-snapSelfie' )->with ( $data );
		}else{
			return redirect('/dashboard');
		}
		// return view ( 'admin.view-snapSelfie' )->with ( $data );
	}
    public function getSnapDetail($id){
        $Product = new ProductModel();

        $arrRes['SelfieDetails'] = DB::table('jb_shade_finder_selfie_tbl as a')->select('a.*')
    	->where('SELFIE_ID',$id)->first();
        // dd($result);
        $arrRes ['Products'] = $Product->getAllProductsData();

         $result = DB::table('jb_selfie_reply_tbl')->select('ADMIN_REPLY','SUGGESTED_PRODUCTS_IDS')
        ->where('SNAP_ID',$id)->where('IS_DELETED','0')->first();

        if($result != null){
            // $nestedIds = explode(',', $result->SUGGESTED_PRODUCTS_IDS);
            // $arrRes ['Products'] = DB::table('jb_product_tbl')->select('*')->wherein('PRODUCT_ID',$nestedIds)->get();
            $arrRes ['SelfieReply'] = $result;
            // $nestedIds = explode(',', $result->SUGGESTED_PRODUCTS_IDS);
            $arrRes['Ids'] = explode(',', $result->SUGGESTED_PRODUCTS_IDS);
            // foreach ($nestedIds as $id) {
            //     $arrRes['Ids'][] = array('PRODUCT_ID' => $id);
            //     }
        }else{
            $arrRes ['SelfieReply'] = '';
            $arrRes['Ids'] = '';

        }


        // dd($arrRes);
        return isset($arrRes) ? $arrRes : '';
    }

    public function sendSelfieReply(Request $request){

        $EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;

        $suggestedProductLinks = [];
        $suggestedProductIds = [];
        $suggestedProductNames = [];
        $data = $request->details;
        $adminReply = $data['Reply']['R_1'];
        $snapDetails = $data['UserDetail'];
        $SnapId = $snapDetails['SELFIE_ID'];
        $ToId = $snapDetails['USER_ID'];
        $ToName = $snapDetails['USERNAME'];
        $ToEmail = $snapDetails['USER_EMAIL'];
        $fromUserId = $data['SenderId'];
        $baseUrl = url('');
        if(isset($data['Reply']['Products'])){
            $products = $data['Reply']['Products'];
        }else{
            $products = null;
        }


        if($adminReply == ''){
            $arrRes ['done'] = false;
			$arrRes ['msg'] = 'Comment can not be empty';
            echo json_encode ( $arrRes );
            die();
        }
        if(strlen($adminReply) < 20){
            $arrRes ['done'] = false;
			$arrRes ['msg'] = 'Comment can not be less than 20 chars';
            echo json_encode ( $arrRes );
            die();
        }
        if($products == null){
            $arrRes ['done'] = false;
			$arrRes ['msg'] = 'Select atleast one Product';
            echo json_encode ( $arrRes );
            die();
        }
        // dd($products);
        foreach($products as $product){
            if($product['CATEGORY_SLUG'] && $product['SUB_CATEGORY_SLUG'] && $product['SLUG'] ){
                $Url = $baseUrl.'/Products'.'/'.$product['CATEGORY_SLUG'].'/'.$product['SUB_CATEGORY_SLUG'].'/'.$product['SLUG'];

            }
            elseif(empty($product['SUB_CATEGORY_SLUG'])){
                $Url = $baseUrl.'/Products'.'/'.$product['CATEGORY_SLUG'].'/'.$product['SLUG'];
            }
            $suggestedProductIds[] = $product['PRODUCT_ID'];
            $suggestedProductNames[] = $product['NAME'];
            $suggestedProductLinks[] = $Url;
        }

        $commaSeparatedIds = implode(',', $suggestedProductIds);

        // dd($commaSeparatedIds);


        // dd($result);

        $emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('SELFIE REPLY');
        // dd($emailConfigDetails);

				$message_username = str_replace("{User_Name}",$ToName,$adminReply);

                $htmlbody = '<tr>
                                <td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
                                    <p>Hello '.$ToName.',</p><br>
                                    '.$message_username.'
                                </td>
                            </tr>';
                            $i = 0;
                            foreach ($suggestedProductLinks as $link) {

                                $htmlbody .= '<tr>
                                    <td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
                                        <a href="'.$link.'" _target="_blank">'.$suggestedProductNames[$i].',</a>
                                    </td>
                                </tr>';
                                $i++;
                            }



				$email_details['to_id'] = '';
				$email_details['to_email'] = $ToEmail;//useremail
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "SELFIE REPLY";
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

				$check1 = $EmailForwardModel->sendEmail($email_details);
                // dd($check);
				$email_details['to_id'] = '';
				$email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $ToEmail;//useremail
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "SELFIE REPLY";
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

				$check2 = $EmailForwardModel->sendEmail($email_details);
                if($check1 == true && $check2 == true){
                    $result = DB::table('jb_selfie_reply_tbl')->insertGetId(
                        array ( 'SNAP_ID' => $SnapId,
                            'TO_ID' => $ToId,
                            'TO_EMAIL' => $ToEmail,
                            'FROM_USER_ID' => $fromUserId,
                            'ADMIN_REPLY' => $adminReply,
                            'SUGGESTED_PRODUCTS_IDS' => $commaSeparatedIds,
                            'CREATED_BY' => $fromUserId,
                            'UPDATED_BY' => $fromUserId,
                            'CREATED_AT' => date ( 'Y-m-d H:i:s' ),
                            'UPDATED_AT' => date ( 'Y-m-d H:i:s' )
                    ));

                    $arrRes ['done'] = true;
                    $arrRes ['msg'] = 'Selfie Reply Sent Successfully';
                    $arrRes ['ID'] = $result;
                    $arrRes ['SelfieDetails'] = $this->getSnapDetail($SnapId);
                    // $arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
                    echo json_encode ( $arrRes );
                    die ();
                }else{
                    $arrRes ['done'] = false;
                    $arrRes ['msg'] = 'System Failed to Send Email';
                    $arrRes ['SelfieDetails'] = $this->getSnapDetail($SnapId);
                    // $arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
                    echo json_encode ( $arrRes );
                    die ();
                }


    }

	/*==================== admin categories code start ==========================*/

	public function getAllAdminCategorylov() {
		$Category = new CategoryModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['listCat'] = $Category->getCategoryData();
		$arrRes ['listSubCat'] = $Category->getSubCategoryData();
		$arrRes ['listSubSubCat'] = $Category->getSubSubCategoryData();

		$arrRes ['list1'] = $Category->getCategoryLov();
		$arrRes ['list2'] = $Category->getSubCategoryLov();

		echo json_encode ( $arrRes );
	}

	public function saveAdminCategory(Request $request) {

		$details = $_REQUEST ['details'];
		$data = $details ['category'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			// if ($data ['C_1'] == '') {

			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Name is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
            if (empty($data['C_1']) || ctype_digit($data['C_1'])) {
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Category Name must be alphabetic or alphanumeric.';
                echo json_encode($arrRes);
                die();
            }






			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_category_tbl' ) ->where ( 'CATEGORY_NAME',  $data ['C_1'])->first();

				if($result != ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}

                $getLastSeq = DB::table ( 'jb_category_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

				if($getLastSeq != null){

					$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

				}else{

				    $getLastSeq=1;
				}


				$result = DB::table ( 'jb_category_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
                                'SEQ_NUM' => $getLastSeq,
								'CATEGORY_NAME' => $data['C_1'],
								'STATUS' => 'inactive',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
				);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Category Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result_if_ext = DB::table('jb_category_tbl')
								->where('CATEGORY_ID', '!=' , $data ['ID'])
								->where('CATEGORY_NAME',  $data ['C_1'])
								->get();


				if(count($result_if_ext) != 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}


				$result = DB::table ( 'jb_category_tbl' ) ->where ( 'CATEGORY_ID', $data ['ID'] ) ->update (
						array ( 'CATEGORY_NAME' => $data['C_1'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
				);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Category Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function editAdminCategory(){
		$Category = new CategoryModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $Category->getSpecificCategoryData($recordId);

		echo json_encode ( $arrRes );
	}

	public function changeStatusCategory(Request $request) {
		$Category = new CategoryModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$result = DB::table('jb_category_tbl')->where( 'STATUS', 'active')->count();


		$catDetail = $Category->getSpecificCategoryData($recordId);

		if(isset($catDetail['STATUS']) && $catDetail['STATUS'] != 'active'){

			if($result >= 4){

				$arrRes ['msg'] = 'Can`t Activate More than Four(4) Categoriges At a Time...';
				$arrRes ['done'] = false;

				echo json_encode ( $arrRes );
				die ();
			}

			$status = 'active';
			$arrRes ['msg'] = 'Category active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Category Inactive successfully...';
		}

		$result = DB::table ( 'jb_category_tbl' ) ->where ( 'CATEGORY_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );

	}


	public function saveAdminSubCategory(Request $request) {

		$details = $_REQUEST ['details'];
		$data = $details ['subCategory'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if (!isset($data ['C_1']['id'])) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['C_2'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}

            if (empty($data['C_2']) || ctype_digit($data['C_2'])) {
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Sub Category Name must be alphabetic or alphanumeric.';
                echo json_encode($arrRes);
                die();
            }


			if ($data ['ID'] == '') {


				$result = DB::table ( 'jb_sub_category_tbl' ) ->where ( 'NAME',  $data ['C_2'])->first();

				if($result != ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}

                $getLastSeq = DB::table ( 'jb_sub_category_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

				if($getLastSeq != null){

					$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

				}else{

				    $getLastSeq=1;
				}

				$result = DB::table ( 'jb_sub_category_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
                                'SEQ_NUM' => $getLastSeq,
								'CATEGORY_ID' => isset($data ['C_1']['id']) ? $data ['C_1']['id'] : '',
								'NAME' => $data['C_2'],
                                'DISPLAY_NAME' => $data['C_2'],
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Sub Category Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result_if_ext = DB::table('jb_sub_category_tbl')
								->where('CATEGORY_ID', '!=' , $data ['ID'])
								->where('NAME', $data ['C_2'])
								->count();

				if($result_if_ext != 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_sub_category_tbl' ) ->where ( 'SUB_CATEGORY_ID', $data ['ID'] ) ->update (
					array ( 'CATEGORY_ID' => isset($data ['C_1']['id']) ? $data ['C_1']['id'] : '',
							'DISPLAY_NAME' => $data['C_2'],
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Sub Category Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminSubCategory(){
		$Category = new CategoryModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $Category->getSpecificSubCategoryData($recordId);

		echo json_encode ( $arrRes );
	}

	public function changeStatusSubCategory(Request $request) {
		$Category = new CategoryModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$catDetail = $Category->getSpecificSubCategoryData($recordId);

		if(isset($catDetail['STATUS']) && $catDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Sub Category active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Sub Category Inactive successfully...';
		}

		$result = DB::table ( 'jb_sub_category_tbl' ) ->where ( 'SUB_CATEGORY_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );

	}

	public function saveAdminSubSubCategory(Request $request) {

		$details = $_REQUEST ['details'];
		$data = $details ['subSubCategory'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if (!isset($data ['C_1']['id'])) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Sub Category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['C_2'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
            if (empty($data['C_2']) || ctype_digit($data['C_2'])) {
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Category Name must be alphabetic or alphanumeric.';
                echo json_encode($arrRes);
                die();
            }


			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_sub_sub_category_tbl' ) ->where ( 'NAME',  $data ['C_2'])->first();

				if($result != ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}
                $getLastSeq = DB::table ( 'jb_sub_sub_category_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

				if($getLastSeq != null){

					$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

				}else{

				    $getLastSeq=1;
				}

				$result = DB::table ( 'jb_sub_sub_category_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
                                'SEQ_NUM' => $getLastSeq,
								'SUB_CATEGORY_ID' => isset($data ['C_1']['id']) ? $data ['C_1']['id'] : '',
								'NAME' => $data['C_2'],
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Sub Sub Category Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result_if_ext = DB::table('jb_sub_sub_category_tbl')
								->where('SUB_SUB_CATEGORY_ID', '!=' , $data ['ID'])
								->where('NAME', $data ['C_2'])
								->count();

				if($result_if_ext != 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_sub_sub_category_tbl' ) ->where ( 'SUB_SUB_CATEGORY_ID', $data ['ID'] ) ->update (
						array ( 'SUB_CATEGORY_ID' => isset($data ['C_1']['id']) ? $data ['C_1']['id'] : '',
								'NAME' => $data['C_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Sub Sub Category Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminSubSubCategory(){
		$Category = new CategoryModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $Category->getSpecificSubSubCategoryData($recordId);

		echo json_encode ( $arrRes );
	}

	public function changeStatusSubSubCategory(Request $request) {
		$Category = new CategoryModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$catDetail = $Category->getSpecificSubSubCategoryData($recordId);

		if(isset($catDetail['STATUS']) && $catDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Sub Sub Category active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Sub Sub Category Inactive successfully...';
		}

		$result = DB::table ( 'jb_sub_sub_category_tbl' ) ->where ( 'SUB_SUB_CATEGORY_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}
	/*===================== admin categories code end ==========================*/

	/*======================admin feature Code start ===========================*/

	public function getAllAdminFeatureslov(Request $request) {
		$Feature = new Feature();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ingredientId = $details ['ingredientId'];


		$arrRes ['list'] = $Feature->getFeaturesData();
		    // $arrRes ['details'] = $ingredientDetails;
           // 		print_r('<pre>');
          // 		print_r($arrRes ['list']);
         // 		exit();
		echo json_encode ( $arrRes );
	}

	public function saveAdminFeature(Request $request) {

		$details = $_REQUEST ['details'];
		$data = $details ['feature'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_1']) > 100) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less than 100 charactere.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_4'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}

            if (empty($data['P_1']) || ctype_digit($data['P_1'])) {
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Title Name must be alphabetic or alphanumeric.';
                echo json_encode($arrRes);
                die();
            }




			if ($data ['ID'] == '') {

                $result = DB::table('jb_product_features_tbl')->where('FEATURE_NAME',$data['P_1'])->first();
                if(isset($result) || !empty($result)){
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'Title Name Already Exists. Try Different...';
                    echo json_encode($arrRes);
                    die();
                }
				$getLastSeq = DB::table ( 'jb_product_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

				if($getLastSeq != null){

					$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

				}else{

				    $getLastSeq=1;
				}

				$result = DB::table ( 'jb_product_features_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'FEATURE_NAME' => $data ['P_1'],
								'FEATURE_DESCRIPTION' => base64_encode($data['P_4']),
								'STATUS' => 'active',
								'SEQ_NUM' => $getLastSeq,
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Feature Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['redirect_url'] = url('view-features');

				echo json_encode ( $arrRes );
				die ();

			} else {
                $result = DB::table('jb_product_features_tbl')->where('FEATURE_NAME',$data['P_1'])->whereNot('FEATURE_ID',$data ['ID'])->first();
                if(isset($result) || !empty($result)){
                    $arrRes['done'] = false;
                    $arrRes['msg'] = 'Title Name Already Exists. Try Different...';
                    echo json_encode($arrRes);
                    die();
                }

				$result = DB::table ( 'jb_product_features_tbl' ) ->where ( 'FEATURE_ID', $data ['ID'] ) ->update (
						array ( 'FEATURE_NAME' => $data ['P_1'],
								'FEATURE_DESCRIPTION' => base64_encode($data['P_4']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Feature Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['redirect_url'] = url('view-features');

				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function editAdminFeature(Request $request) {
		$Ingredient = new Feature();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ingredientId = $details ['recordId'];

		$arrRes ['details'] = $Ingredient->getSpecificFeaturetData($ingredientId);
		$arrRes ['images'] = $Ingredient->getFeatureAttachments($ingredientId);
		echo json_encode ( $arrRes );

	 }


	 public function deleteFeature(Request $request) {

			$Feature = new Feature();

			//  $ProductModel = ProductModel::where('FEATURE_ID');

			$details = $_REQUEST ['details'];
			$recordId = $details ['recordId'];

			// $userId = $details ['userId'];

			$ProductModel = DB::table('jb_product_tbl as a')
			->select('a.FEATURE_ID','a.PRODUCT_ID')
			->whereNotNull('a.FEATURE_ID')
			->get();


			foreach ($ProductModel as $value) {
				$productlov = explode(",",$value->FEATURE_ID);

				foreach($productlov as $key => $val){
					if ($val == $recordId){
					 	unset($productlov[$key]);
					}

				}

				$featuresArrayAfterUnset = implode(",",$productlov);

				DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $value->PRODUCT_ID ) ->update (
					array ( 'FEATURE_ID' => $featuresArrayAfterUnset,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);

				DB::table ( 'jb_product_features_tbl' )->where ( 'FEATURE_ID', $recordId )->delete ();

			}

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Feature deleted successfully...';
				echo json_encode ( $arrRes );


		    //  if($ProductModel == null){

			//  $delete = DB::table ( 'jb_product_features_tbl' )->where ( 'FEATURE_ID', $recordId )->delete ();
		 	// 	 $arrRes ['done'] = true;
	        //     	  $arrRes ['msg'] = 'FEATURE deleted successfully...';
		    //              echo json_encode ( $arrRes );
			//  }else {
			// 	 $arrRes ['done'] = false;
		    // 	 $arrRes ['msg'] = 'Feature already linked with product, kindly remove from product then proceed.';
			//      echo json_encode ( $arrRes );
			//      die();
			//  }

	}

	public function changeStatusFeature(Request $request) {
		    $Feature = new Feature();

	        	$details = $_REQUEST ['details'];
	            	$recordId = $details ['recordId'];
		                 $userId = $details ['userId'];

	 	$ingDetail = $Feature->getSpecificFeaturetData($recordId);

		if(isset($ingDetail['STATUS']) && $ingDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Feature active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Feature Inactive successfully...';
		}

		$result = DB::table ( 'jb_product_features_tbl' ) ->where ( 'FEATURE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}


	/*===================== admin Ingredient code start ==========================*/

	public function getAllAdminIngredientlov(Request $request) {
		$Ingredient = new IngredientModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ingredientId = $details ['ingredientId'];

		if ($ingredientId != '') {

			$ingredientDetails = $Ingredient->getSpecificIngredientData($ingredientId);

		} else {
			$ingredientDetails = '';
		}

		$arrRes ['list'] = $Ingredient->getIngredientsData();
		$arrRes ['details'] = $ingredientDetails;
// 		print_r('<pre>');
// 		print_r($arrRes ['list']);
// 		exit();
		echo json_encode ( $arrRes );

	}
	public function saveAdminIngredient(Request $request) {

		$details = $_REQUEST ['details'];
		$data = $details ['ingredient'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			// if ($data ['P_2'] == '') {

			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Quantity is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if ($data ['P_3'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Category is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_4'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
            if (empty($data['P_1']) || ctype_digit($data['P_1'])) {
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Ingredient Title must be alphabetic or alphanumeric.';
                echo json_encode($arrRes);
                die();
            }
			if ($data ['ID'] == '') {
                $result = DB::table ( 'jb_ingredient_tbl' )->where('TITLE',$data['P_1'])->first();

                if(isset($result) || !empty($result)){
                    $arrRes ['done'] = false;
                    $arrRes ['msg'] = 'Ingredient Name Already Exists. Try Different...';
                    echo json_encode ( $arrRes );
                    die ();
                }

				$getLastSeq = DB::table ( 'jb_ingredient_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

                if($getLastSeq != null){

					$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

				}else{

				    $getLastSeq=1;
				}

				$result = DB::table ( 'jb_ingredient_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'TITLE' => $data ['P_1'],
								'QUANTITY' => $data['P_2'],
								'SEQ_NUM' => $getLastSeq,
								'CATEGORY' => $data['P_3'],
								'DESCRIPTION' => base64_encode($data['P_4']),
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ingredient Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['redirect_url'] = url('view-ingredients');
				echo json_encode ( $arrRes );
				die ();

			} else {
                $result = DB::table ( 'jb_ingredient_tbl' )->where('TITLE',$data['P_1'])->whereNot('INGREDIENT_ID',$data ['ID'])->first();

                if(isset($result) || !empty($result)){
                    $arrRes ['done'] = false;
                    $arrRes ['msg'] = 'Ingredient Name Already Exists. Try Different...';
                    echo json_encode ( $arrRes );
                    die ();
                }

				$result = DB::table ( 'jb_ingredient_tbl' ) ->where ( 'INGREDIENT_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data ['P_1'],
								'QUANTITY' => $data['P_2'],
								'CATEGORY' => $data['P_3'],
								'DESCRIPTION' => base64_encode($data['P_4']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ingredient Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['redirect_url'] = url('view-ingredients');
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}


	public function editAdminIngredient(Request $request) {
		$Ingredient = new IngredientModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ingredientId = $details ['recordId'];

		$arrRes ['details'] = $Ingredient->getSpecificIngredientData($ingredientId);
		$arrRes ['images'] = $Ingredient->getIngredientAttachments($ingredientId);
		echo json_encode ( $arrRes );

	}
	public function changeStatusIngredient(Request $request) {
		$Ingredient = new IngredientModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$ingDetail = $Ingredient->getSpecificIngredientData($recordId);

		if(isset($ingDetail['STATUS']) && $ingDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Ingredient active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Ingredient Inactive successfully...';
		}

		$result = DB::table ( 'jb_ingredient_tbl' ) ->where ( 'INGREDIENT_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}
	public function deleteIngredient(Request $request) {
		$Ingredient = new IngredientModel();
		$ProductIngredientModel = new ProductIngredientModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		// $existCheck = $ProductIngredientModel->checkIngredientExistWrtIngredientId($recordId);
		$result = DB::table('jb_product_ingredient_tbl as a')->select('a.*')
    	->where('a.INGREDIENT_ID', $recordId)
    	->get();

		foreach ($result as $value) {
			DB::table ( 'jb_product_ingredient_tbl' )->where ( 'INGREDIENT_ID', $value->INGREDIENT_ID )->delete ();
		}

		$attDetail = $Ingredient->getIngredientAttachments($recordId);

		if(isset($attDetail) && !empty($attDetail)){
			foreach ($attDetail as $value){

				DB::table ( 'jb_ingredient_attachment_tbl' )->where ( 'INGREDIENT_ID', $value['ingredientId'] )->delete ();
				unlink($value['path']);
			}
		}

		DB::table ( 'jb_ingredient_tbl' )->where ( 'INGREDIENT_ID', $recordId )->delete ();
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient deleted successfully...';

		echo json_encode ( $arrRes );
		// if($existCheck == true){


		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Ingredient already linked with product, kindly remove from product then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }



		// $delete = DB::table ( 'jb_ingredient_tbl' )->where ( 'INGREDIENT_ID', $recordId )->delete ();
		// $delete = DB::table ( 'jb_ingredient_attachment_tbl' )->where ( 'INGREDIENT_ID', $recordId )->delete ();

		// if(isset($attDetail) && !empty($attDetail)){
		// 	foreach ($attDetail as $value){
		// 		unlink($value['path']);
		// 	}
		// }

		// $arrRes ['done'] = true;
		// $arrRes ['msg'] = 'Ingredient deleted successfully...';

		// echo json_encode ( $arrRes );
	}
	public function deleteIngredientAttachment(Request $request) {
		$Ingredient = new IngredientModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$ingredientId = $details ['ingredientId'];
		$userId = $details ['userId'];

		$attDetail = $Ingredient->getSpecificIngredientAttachments($recordId);

		$delete = DB::table ( 'jb_ingredient_attachment_tbl' )->where ( 'ATTACHMENT_ID', $recordId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['images'] = $Ingredient->getIngredientAttachments($ingredientId);
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient image deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function markPrimaryIngredientAttachment(Request $request) {
		$Ingredient = new IngredientModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$ingredientId = $details ['ingredientId'];
		$userId = $details ['userId'];

		DB::table ( 'jb_ingredient_attachment_tbl' ) ->where ( 'INGREDIENT_ID', $ingredientId ) ->update (
				array ( 'PRIMARY_FLAG' => '0')
			);

		$result = DB::table ( 'jb_ingredient_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $recordId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['images'] = $Ingredient->getIngredientAttachments($ingredientId);
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient image marked primary successfully...';

		echo json_encode ( $arrRes );
	}


	/*===================== admin Ingredient code end ==========================*/


	/*===================== admin Shades code start ==========================*/

	public function getAllAdminBloglov(Request $request) {
		$Blogs = new BlogsModel();
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $Blogs ->getBlogsData();
		$arrRes ['ourBlog'] = $Blogs ->getSpecificOurBlogsData(1);

		echo json_encode ( $arrRes );
	}

	// add Blogs

	public function saveSingleAdminBlog(Request $request) {
		$details = $_REQUEST ['details'];
		$data = $details ['blogs'];

		if (isset ( $data ) && ! empty ( $data )) {
			if ($data['S_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(empty(DB::table('jb_our_blog_tbl')->count())){
				$result = DB::table ( 'jb_our_blog_tbl' )->insert (
					array ( 'NAME' => $data ['S_1'],
							'CREATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);
			 }
			 $result = DB::table ( 'jb_our_blog_tbl' ) ->where ( 'ID', '1' ) ->update (
				array ( 'NAME' => $data ['S_1'],
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Blog Updated Successfully';
			echo json_encode ( $arrRes );
			die ();
		}


	}
	public function saveAdminBlogs(Request $request) {

		$details = $_REQUEST ['details'];
		$data = $details ['blogs'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_2'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			$slug = $this->slugify($data['P_1']);

			if ($data ['ID'] == '') {



				$result = DB::table ( 'jb_blogs_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'TITLE' => $data ['P_1'],
								'SLUG' => $slug,
								'DESCRIPTION' => base64_encode($data['P_2']),
								'STATUS' => 'active',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Blogs Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BLOG_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data ['P_1'],
								'SLUG' => $slug,
								'DESCRIPTION' => base64_encode($data['P_2']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Blogs Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	function slugify($text) {
		$text = trim($text);
		$text = strtolower($text);
		$text = preg_replace('/[^a-z0-9-]+/', '-', $text);

		$text = preg_replace('/-+/', '-', $text);

		$text = trim($text, '-');

		return $text;
	}

	public function editAdminBlog(Request $request) {
		$Blogs = new BlogsModel();
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$blogId = $details ['recordId'];

		$arrRes ['details'] = $Blogs->getSpecificBlogsData($blogId);
		echo json_encode ( $arrRes );

	}


	public function getAllAdminShadeslov(Request $request) {
		$Shades = new ShadesModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $Shades->getShadesData();

		echo json_encode ( $arrRes );
	}
	public function saveAdminShades(Request $request) {

		$details = $_REQUEST ['details'];
		$data = $details ['shades'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_2'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {


				$getLastSeq = DB::table ( 'jb_shades_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

				if($getLastSeq != null){

					$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

				}else{

				    $getLastSeq=1;
				}

				$result = DB::table ( 'jb_shades_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'TITLE' => $data ['P_1'],
								'DESCRIPTION' => base64_encode($data['P_2']),
								'SEQ_NUM' => $getLastSeq,
								'STATUS' => 'active',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shades Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_shades_tbl' ) ->where ( 'SHADE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data ['P_1'],
								'DESCRIPTION' => base64_encode($data['P_2']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shades Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function editAdminShade(Request $request) {
		$Shades = new ShadesModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$shadeId = $details ['recordId'];

		$arrRes ['details'] = $Shades->getSpecificShadesData($shadeId);
		$arrRes ['images'] = $Shades->getShadeAttachments($shadeId);
		echo json_encode ( $arrRes );
	}

	public function changeStatusShade(Request $request) {
		$Shades = new ShadesModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$shadeDetail = $Shades->getSpecificShadesData($recordId);

		if(isset($shadeDetail['STATUS']) && $shadeDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Shade active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Shade Inactive successfully...';
		}

		$result = DB::table ( 'jb_shades_tbl' ) ->where ( 'SHADE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}
	public function changeStatusBlogs(Request $request) {
		$Shades = new BlogsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
        // dd($details);
		$shadeDetail = $Shades->getSpecificBlogsData($recordId);
        // dd($shadeDetail);

		if(isset($shadeDetail['STATUS']) && $shadeDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Blog active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Blog Inactive successfully...';
		}

		$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BLOG_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}
	public function updateSpecificUserSubscriptionStatusAdmin(Request $request){
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

	public function markPrimaryShadeAttachment(Request $request) {
		$Shades = new ShadesModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$shadeId = $details ['shadeId'];
		$userId = $details ['userId'];

		DB::table ( 'jb_shades_attachment_tbl' ) ->where ( 'SHADE_ID', $shadeId ) ->update (
				array ( 'PRIMARY_FLAG' => '0')
				);

		$result = DB::table ( 'jb_shades_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $recordId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		$arrRes ['images'] = $Shades->getShadeAttachments($shadeId);
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Shade image marked primary successfully...';

		echo json_encode ( $arrRes );
	}
	public function deleteShadeAttachment(Request $request) {
		$Shades = new ShadesModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$shadeId = $details ['shadeId'];
		$userId = $details ['userId'];

		$attDetail = $Shades->getSpecificShadeAttachments($recordId);

		$delete = DB::table ( 'jb_shades_attachment_tbl' )->where ( 'ATTACHMENT_ID', $recordId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Shade image deleted successfully...';
		$arrRes ['images'] = $Shades->getShadeAttachments($shadeId);

		echo json_encode ( $arrRes );
	}
	public function deleteBlogAttachment(Request $request) {
		$BlogsModel = new BlogsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$attDetail = $BlogsModel->getSpecificBlogsData($recordId);

		$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BLOG_ID', $recordId ) ->update (
						array ( 'IMAGE_PATH' => '',
								'IMAGE_DOWN_PATH' => '',

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Blog image deleted successfully...';

		echo json_encode ( $arrRes );
	}
	public function deletePicBlogDetail(Request $request) {
		$BlogsModel = new BlogsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$attDetail = $BlogsModel->getSpecificBlogsData($recordId);

		$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BLOG_ID', $recordId ) ->update (
				array ( 'IMAGE_DETAIL_PATH' => '',
						'IMAGE_DETAIL_DOWN_PATH' => '',

						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		if(isset($attDetail['detailPath']) && $attDetail['detailPath'] != ''){
			unlink($attDetail['detailPath']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Blog detail image deleted successfully...';

		echo json_encode ( $arrRes );
	}
	public function deletePicOurBlog(Request $request) {
		$BlogsModel = new BlogsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$attDetail = $BlogsModel->getSpecificOurBlogsData($recordId);

		$result = DB::table ( 'jb_our_blog_tbl' ) ->where ( 'ID', $recordId ) ->update (
				array ( 'IMAGE_PATH' => '',
						'IMAGE_DOWN_PATH' => '',

						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Our Blog image deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function deleteBlog(Request $request) {
		$Shades = new BlogsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$delete = DB::table ( 'jb_blogs_tbl' )->where ( 'BLOG_ID', $recordId )->delete ();
		$delete = DB::table ( 'jb_blogs_tbl' )->where ( 'BLOG_ID', $recordId )->delete ();

		if(isset($attDetail) && !empty($attDetail)){
			foreach($attDetail as $value){
				unlink($value['path']);
			}
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function deleteShade(Request $request) {
		$Shades = new ShadesModel();
		$ProductShadeModel = new ProductShadeModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		// $existCheck = $ProductShadeModel->checkShadeExistWrtShadeId($recordId);

		DB::table ( 'jb_shades_tbl' ) ->where ( 'SHADE_ID', $recordId ) ->update (
			array(
				'IS_DELETED' => 1,
				'STATUS' => 'inactive'
			)
			);
		// if($existCheck == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Shade already linked with product, kindly remove from product then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		// $attDetail = $Shades->getShadeAttachments($recordId);

		// $delete = DB::table ( 'jb_shades_tbl' )->where ( 'SHADE_ID', $recordId )->delete ();
		// $delete = DB::table ( 'jb_shades_attachment_tbl' )->where ( 'SHADE_ID', $recordId )->delete ();

		// if(isset($attDetail) && !empty($attDetail)){
		// 	foreach($attDetail as $value){
		// 		unlink($value['path']);
		// 	}
		// }

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient deleted successfully...';

		echo json_encode ( $arrRes );
	}

	/*===================== admin Shades code end ==========================*/

	/*===================== admin Product code start ==========================*/

	public function getAllAdminProductlov(Request $request) {
		$Category = new CategoryModel();
		$Product = new ProductModel();
		$Shades = new ShadesModel();
		$features=new Feature();
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes['features']= $features->getactivefeaturesdata();
		$arrRes ['list'] = $Product->getAllProductsData();
		$arrRes ['list1'] = $Category->getCategoryLov();
		$arrRes ['list2'] = $Shades->getShadesLov();

		echo json_encode ( $arrRes );
	}
	public function getSubCategoriesWrtCategory(Request $request) {

		 $Category = new CategoryModel();
		 $Product= new ProductModel();

		 $details = $_REQUEST ['details']; $Category = new CategoryModel();
		 $category = $details ['category'];
		 $userId = $details ['userId'];


		if(!isset($category['id'])){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'First choose category...';
			echo json_encode ( $arrRes );
			die();
		}
		$product_lov = DB::table('jb_product_tbl')->where('CATEGORY_ID',$category['id'])->where('IS_DELETED',0)->where('STATUS','active')->orderby('PRODUCT_ID', 'desc')->get();
        if($product_lov->isEmpty()){
            $arrRes ['done'] = false;
			$arrRes ['product'] = [];
			echo json_encode ( $arrRes );
			die();
        }else{
             // $arrRes['product']=$product_lov;
             $i=0;
             foreach ($product_lov as $row){
                 $arrRes['product'][$i]['id'] = $row->PRODUCT_ID;
                 $arrRes['product'][$i]['name'] = $row->NAME;
                 $i++;
             }
             $arrRes ['subCategory'] = $Category->getSubCategoryLovWrtCategory($category['id']);
             echo json_encode ( $arrRes );



        }

	}
	public function getSubCategoriesWrtCategory1(Request $request) {
		$Category = new CategoryModel();
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$category = $details ['category'];

		// dd($category);
		$userId = $details ['userId'];

		if(!isset($category['id'])){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'First choose category...';
			echo json_encode ( $arrRes );
			die();
		}

		$arrRes ['subCategory'] = $Category->getSubCategoryBundleLovWrtCategory($category['id']);
		echo json_encode ( $arrRes );
	}
        public function getproductswrtsubcategory(Request $request){


			$Product = new ProductModel();

			$details = $_REQUEST ['details'];
			$subsubcategory = $details ['subcategory'];
			$userId = $details ['userId'];
			$arrRes = array ();

			if(!isset($subsubcategory['id'])){
			   $arrRes ['done'] = false;
			   $arrRes ['msg'] = 'First choose sub category...';
			   echo json_encode ( $arrRes );
			   die();
			}

			$product_lov = DB::table('jb_product_tbl')->where('SUB_SUB_CATEGORY_ID',$subsubcategory['id'])->where('STATUS','active')->orderby('PRODUCT_ID', 'desc')->get();
            if($product_lov->isEmpty()){
                $arrRes ['done'] = false;
                $arrRes ['product'] = [];
                echo json_encode ( $arrRes );
                die();
            }else{
                // $arrRes['product']=$product_lov;
                $i=0;
                foreach ($product_lov as $row){
                    $arrRes['product'][$i]['id'] = $row->PRODUCT_ID;
                    $arrRes['product'][$i]['name'] = $row->NAME;

                    $i++;
                }

                echo json_encode ( $arrRes );

            }

		}

	public function getSubSubCategoriesWrtSubCategoryQuickAdd(Request $request) {
		 $Category = new CategoryModel();
		 $Product = new ProductModel();

		 $details = $_REQUEST ['details'];
		 $subcategory = $details ['subcategory'];
		 $product_ID = $details['productId'];
		 $userId = $details ['userId'];


		 DB::table('jb_product_tbl')->where('PRODUCT_ID',$product_ID)->update([
			'SUB_CATEGORY_ID' =>  $subcategory['id'],
		]);

		 $arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory($subcategory['id']);
		 $arrRes ['msg'] = 'Sub Category ID Updated Successfully!';
		 $arrRes ['done'] = true;
		 echo json_encode ( $arrRes );
	}
	public function getSubSubCategoriesWrtSubCategory(Request $request) {
		$Category = new CategoryModel();
		// $Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$subcategory = $details ['subcategory'];
		// $product_ID = $details['productId'];
		// $userId = $details ['userId'];
		$product_lov = DB::table('jb_product_tbl')->where('IS_DELETED',0)->where('SUB_CATEGORY_ID',$subcategory['id'])->where('STATUS','active')->orderby('PRODUCT_ID', 'desc')->get();


       if($product_lov->isEmpty()){
            $arrRes ['done'] = false;
			$arrRes ['product'] = [];
			echo json_encode ( $arrRes );
			die();
       }else{
        $i=0;
		foreach ($product_lov as $row){
    		$arrRes['product'][$i]['id'] = $row->PRODUCT_ID;
    		$arrRes['product'][$i]['name'] = $row->NAME;

    		$i++;
    	}
       }
		// $arrRes['product']=$product_lov;


		$arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory($subcategory['id']);
		// $arrRes ['msg'] = 'Sub Category ID Updated Successfully!';
		$arrRes ['done'] = true;
		echo json_encode ( $arrRes );
   }
	public function updateSubSubCategoriesWrtSubCategoryQuickAdd(Request $request) {
		$Category = new CategoryModel();
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$subsubcategory = $details ['subsubcategory'];
		$product_ID = $details['productId'];
		$userId = $details ['userId'];


		DB::table('jb_product_tbl')->where('PRODUCT_ID',$product_ID)->update([
		   'SUB_SUB_CATEGORY_ID' =>  $subsubcategory['id'],
	   ]);

		// $arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory($subcategory['id']);
		$arrRes ['msg'] = 'Sub Sub Category ID Updated Successfully!';
		$arrRes ['done'] = true;
		echo json_encode ( $arrRes );
   }



	public function getIngredientsWrtCategory(Request $request) {
		$Ingredient = new IngredientModel();

		$details = $_REQUEST ['details'];
		$category = $details ['category'];
		$userId = $details ['userId'];

		if(!isset($category) && $category == ''){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'First choose category...';
			echo json_encode ( $arrRes );
			die();
		}

		$arrRes ['ingredients'] = $Ingredient->getIngredientslovWrtCategory($category);

		echo json_encode ( $arrRes );
	}

	public function saveAdminProductBasicInfo(Request $request) {

		$Product = new ProductModel();
		$details = $_REQUEST ['details'];
		$data = $details ['product'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';




		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
            if ($data['P_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Sub Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_2']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Sub Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
            if ($data['P_3'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_3']) > 8) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit must be less then 8 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			// if ($data ['P_4'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Minimum Purchase Qty is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }

			// if ($data ['P_5'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Tags is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (strlen($data['P_5']) > 100) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Tags must be less then 100 characters.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (strlen($data['P_6']) > 100) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Barcode must be less then 100 characters.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if (!isset($data ['P_8']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose Category.';
				echo json_encode ( $arrRes );
				die ();
			}

			// if (!isset($data ['P_9']['id'])) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Please choose Sub Category.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (!isset($data ['P_44']['id'])) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Please choose Sub Sub Category.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if ($data['P_10'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Slug is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (strlen($data['P_10']) > 100) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Slug must be less then 100 characters.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if (strlen($data['P_11']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Short Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_12']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			   if(isset($data['P_45'])){
				$feature_id='';
				$total=count($data['P_45']);
				for($k=0; $k< $total; $k++){
					$feature_id.=$data['P_45'][$k]['id'].',';
			 }
		 }

		 $handpicked= new Handpicked;
		$recommend= new Recomended;

			if ($data ['ID'] == '') {

				$duplicate = $Product->checkDuplicateSlug($data['P_1']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Product Name Already exists, try different...';
					echo json_encode ( $arrRes );
					die ();
				}else{
                    $name = $data['P_1'];
                    $words = explode(' ', $name);
                    if (count($words) > 1 || strpos($name, ' ') !== false) {
                        $name = implode('-', $words);
                    } else {
                        $name = $data['P_1'];
                    }
                    $slug = $name;
                }

				$getLastSeq = DB::table ( 'jb_product_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

				if($getLastSeq != null){

					$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

				}else{

				    $getLastSeq=1;
				}


				$result = DB::table ( 'jb_product_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'NAME' => $data['P_1'],
								'SUB_TITLE' => $data['P_2'],
								'UNIT' => $data ['P_3'],
								// 'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
								'SEQ_NUM' => $getLastSeq,
								// 'TAGS' => $data ['P_5'],
								// 'BARCODE' => $data ['P_6'],
								// 'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
								'CATEGORY_ID' => isset($data ['P_8']['id']) ? $data ['P_8']['id'] : '',
								'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
								'SUB_SUB_CATEGORY_ID' => isset($data ['P_44']['id']) ? $data ['P_44']['id'] : '',
								'SLUG' => $slug,
								'SHORT_DESCRIPTION' => $data ['P_11'],
								'DESCRIPTION_TITLE' => $data ['P_12'],
								'DESCRIPTION' => base64_encode($data['P_13']),
								'STATUS' => 'inactive',
								'FEATURE_ID' => isset($feature_id) ? rtrim($feature_id,',') : '',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Created Successfully';
				$arrRes ['ID'] = $result;

                   	/*  Recommended products start */


		if(isset($data['P_46']) && $data['P_46'] != ''){

			$delete=$recommend->deleteRecomended($data['P_46'],$result);
				if($delete->original['status'] == false){
					$arrRes ['done'] = false;
					  $arrRes ['msg'] = $delete->original['message'];
				 echo json_encode ( $arrRes );
			  die ();
		  }

		$delete= $recommend->insertRecomended($data['P_46'],$userId,$result);
		if($delete->original['status'] == false){
		    	 $arrRes ['done'] = false;
					  $arrRes ['msg'] = $delete->original['message'];
				  echo json_encode ( $arrRes );
			  die ();
		  }
	  }
					  /*  Recommended products end */

			  /*  Hadnpicked products start */

		 if(isset($data['P_47']) && $data['P_47'] != ''){

		 $delete= $handpicked->deleteHandpicked($data['P_47'],$result);
		 if($delete->original['status'] == false){
			     $arrRes ['done'] = false;
				 $arrRes ['msg'] =  $delete->original['message'];
			    	echo json_encode ( $arrRes );
				die ();
	  }
		 $insert= $handpicked->insertHandpicked($data['P_47'],$userId,$result);
		 if($delete->original['status'] == false){
			     $arrRes ['done'] = false;
				 $arrRes ['msg'] =  $delete->original['message'];
				 echo json_encode ( $arrRes );
				 die ();
	   }

		 }
					  /*  Hadnpicked products end */

				echo json_encode ( $arrRes );
				die ();

			} else {

                $duplicate = $Product->checkDuplicateSlug($data['P_1'],$data ['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Product Name Already exists, try different...';
					echo json_encode ( $arrRes );
					die ();
				}else{
                    $name = $data['P_1'];
                    $words = explode(' ', $name);
                    if (count($words) > 1 || strpos($name, ' ') !== false) {
                        $name = implode('-', $words);
                    } else {
                        $name = $data['P_1'];
                    }
                    $slug = $name;
                }

				$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $data ['ID'] ) ->update (
						array ( 'NAME' => $data['P_1'],
								'SUB_TITLE' => $data['P_2'],
								'UNIT' => $data ['P_3'],
								'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
								// 'TAGS' => $data ['P_5'],
								'BARCODE' => $data ['P_6'],
								'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
								'CATEGORY_ID' => isset($data ['P_8']['id']) ? $data ['P_8']['id'] : '',
								'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
								'SUB_SUB_CATEGORY_ID' => isset($data ['P_44']['id']) ? $data ['P_44']['id'] : '',
								'SLUG' => $slug,
								'FEATURE_ID' =>  isset($feature_id) ? rtrim($feature_id,',') : '',
								'SHORT_DESCRIPTION' => $data ['P_11'],
								'DESCRIPTION_TITLE' => $data ['P_12'],
								'DESCRIPTION' => base64_encode($data['P_13']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];

				 	/*  Recommended products start */

		if( isset($data['P_46']) && $data['P_46'] != ''){


			$delete=$recommend->deleteRecomended($data['P_46'],$data ['ID']);
	  if($delete->original['status'] == false){
						 $arrRes ['done'] = false;
					  $arrRes ['msg'] = $delete->original['message'];
				 echo json_encode ( $arrRes );
			  die ();
		  }

		$delete=  $recommend->insertRecomended($data['P_46'],$userId,$data ['ID']);
			 if($delete->original['status'] == false){
						  $arrRes ['done'] = false;
					  $arrRes ['msg'] = $delete->original['message'];
				  echo json_encode ( $arrRes );
			  die ();
		  }
	  }
					  /*  Recommended products end */

			  /*  Hadnpicked products start */

		 if(isset($data['P_47']) && $data['P_47'] != ''){

		 $delete= $handpicked->deleteHandpicked($data['P_47'],$data ['ID']);
		 if($delete->original['status'] == false){
			$arrRes ['done'] = false;
				 $arrRes ['msg'] =  $delete->original['message'];
				echo json_encode ( $arrRes );
				die ();
	  }
		 $insert= $handpicked->insertHandpicked($data['P_47'],$userId,$data ['ID']);
		 if($delete->original['status'] == false){
			$arrRes ['done'] = false;
				 $arrRes ['msg'] =  $delete->original['message'];
				 echo json_encode ( $arrRes );
				 die ();
	   }

		 }
					  /*  Hadnpicked products end */


				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminProduct(Request $request) {

		$Category = new CategoryModel();
		$Product = new ProductModel();
		$ProductIngredient = new ProductIngredientModel();
		$ProductShade = new ProductShadeModel();
		$ProductUses = new ProductUsesModel();


		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $Product->getSpecificProductData($productId);
		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'PRODUCT_IMG');
		$arrRes ['clinicalNoteImages'] = $Product->getSpecificProductImagesByCode($productId, 'CLINICAL_NOTE');
		$arrRes ['video'] = $Product->getSpecificProductVideo($productId);
		$arrRes ['ingredients'] = $ProductIngredient->getAllProductIngredientByProduct($productId);
		$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($productId);
		$arrRes ['productUses'] = $ProductUses->getAllProductUsesByProduct($productId);
		$arrRes ['subCategory'] = $Category->getSubCategoryLovWrtCategory($arrRes ['details']['P_8']);
		$arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory($arrRes ['details']['P_9']);

		echo json_encode ( $arrRes );
	}

	public function saveAdminProductVideoDetails(Request $request) {
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$prod = $details ['product'];
		$data = $details ['video'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['V_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['V_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['V_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}


			if ($data ['ID'] == '') {

					$result = DB::table ( 'jb_product_video_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'PRODUCT_ID' => $prod['ID'],
								'VIDEO_TITLE' => $data['V_1'],
								'VIDEO_DESCRIPTION' => $data['V_2'] != '' ? base64_encode($data['V_2']) : '',

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Saved Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_product_video_tbl' ) ->where ( 'VIDEO_ID', $data ['ID'] ) ->update (
						array ( 'VIDEO_TITLE' => $data['V_1'],
								'VIDEO_DESCRIPTION' => $data['V_2'] != '' ? base64_encode($data['V_2']) : '',
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function markPrimaryProdImage(Request $request) {
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$flag = $details ['flag'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];


		if($flag == 1){

			DB::table('jb_product_images_tbl')
				->where ( 'PRODUCT_ID', $productId )
				->where ( 'SOURCE_CODE', 'PRODUCT_IMG' )
				->update (
					array ( 'PRIMARY_FLAG' => '0')
				);
			// dd($checkprimaryflag);
			// DB::table ( 'jb_product_images_tbl' )
			// ->where ( 'SOURCE_CODE', 'PRODUCT_IMG' )
			// ->update (array ( 'PRIMARY_FLAG' => '0'));

			$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'SECONDARY_FLAG' => '0',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

			$arrRes ['msg'] = 'Product image marked primary successfully...';

		}else{

			DB::table ( 'jb_product_images_tbl' )
			->where ( 'PRODUCT_ID', $productId )
			->where ( 'SOURCE_CODE', 'PRODUCT_IMG' )
			->update (
				array ( 'SECONDARY_FLAG' => '0')
				);

			$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
					array ( 'SECONDARY_FLAG' => '1',
							'PRIMARY_FLAG' => '0',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
			$arrRes ['msg'] = 'Product image marked Secondary successfully...';
		}


		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'PRODUCT_IMG');
		$arrRes ['done'] = true;


		echo json_encode ( $arrRes );
	}
    public function markPrimaryBundleProdImage(Request $request) {
        // dd('came here');
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
        // dd($details);
		$imageId = $details ['imageId'];
		$flag = $details ['flag'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];


		if($flag == 1){

			DB::table('jb_product_images_tbl')
				->where ( 'PRODUCT_ID', $productId )
				->where ( 'SOURCE_CODE', 'BUNDLE_IMG' )
				->update (
					array ( 'PRIMARY_FLAG' => '0')
				);
			// dd($checkprimaryflag);
			// DB::table ( 'jb_product_images_tbl' )
			// ->where ( 'SOURCE_CODE', 'PRODUCT_IMG' )
			// ->update (array ( 'PRIMARY_FLAG' => '0'));

			$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'SECONDARY_FLAG' => '0',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

			$arrRes ['msg'] = 'Bundle image marked primary successfully...';

		}else{

			DB::table ( 'jb_product_images_tbl' )
			->where ( 'PRODUCT_ID', $productId )
			->where ( 'SOURCE_CODE', 'BUNDLE_IMG' )
			->update (
				array ( 'SECONDARY_FLAG' => '0')
				);

			$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
					array ( 'SECONDARY_FLAG' => '1',
							'PRIMARY_FLAG' => '0',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
			$arrRes ['msg'] = 'Bundle image marked Secondary successfully...';
		}


		$arrRes ['images'] = $Product->getSpecificBundleProductImagesByCode($productId, 'BUNDLE_IMG');
		$arrRes ['done'] = true;
		echo json_encode ( $arrRes );
	}
	public function markPrimaryClinicalNoteImage(Request $request) {
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];

		DB::table ( 'jb_product_images_tbl' ) ->where ( 'PRODUCT_ID', $productId )->where ( 'SOURCE_CODE', 'CLINICAL_NOTE' ) ->update (
				array ( 'PRIMARY_FLAG' => '0')
				);

		$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'CLINICAL_NOTE');
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Image marked primary successfully...';

		echo json_encode ( $arrRes );
	}
	public function deleteProductImage(Request $request) {
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];

		$attDetail = $Product->getSpecificImage($imageId);

		$delete = DB::table ( 'jb_product_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'PRODUCT_IMG');
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product image deleted successfully...';

		echo json_encode ( $arrRes );
	}
    public function deleteBundleProductImage(Request $request) {
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];

		$attDetail = $Product->getSpecificImage($imageId);

		$delete = DB::table ( 'jb_product_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['images'] = $Product->getSpecificBundleProductImagesByCode($productId, 'BUNDLE_IMG');
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Bundle image deleted successfully...';

		echo json_encode ( $arrRes );
	}
	public function deleteClinicalNoteImage(Request $request) {
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];

		$attDetail = $Product->getSpecificImage($imageId);

		$delete = DB::table ( 'jb_product_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}

		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'CLINICAL_NOTE');
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Image deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function saveAdminProductPricingVat(Request $request) {
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$data = $details ['product'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_14'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit Price is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_14'] <= 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit Price must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_15'] != '' && $data['P_16'] != '') {

				if ($data['P_15'] > $data['P_16']) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Discount end date must be greater then Discount start date.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			// if ($data['P_17'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Discount is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if($data['P_17'] != ''){
				if ($data['P_17'] < 0) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Discount must be greater then zero.';
					echo json_encode ( $arrRes );
					die ();
				}
			}

			// if ($data['P_18'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Discount type is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if ($data['P_18'] != '' && $data['P_18'] == 'Percent') {
				if($data['P_17'] < 0 || $data['P_17'] > 100){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Discount must be in between 0 to 100.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data['P_20'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Quantity is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_20'] <= 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Quantity must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			// if (strlen($data['P_21']) > 100) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'SKU must be less then 100 characters.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if (strlen($data['P_22']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'External link must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_23']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'External link text must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data['P_24'] != '' && $data['P_24'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tax must be greater then or equal to zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_24'] > 0 && $data['P_25'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tax type is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_25'] != '' && $data['P_25'] == 'Percent') {
				if($data['P_24'] < 0 || $data['P_24'] > 100){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Tax must be in between 0 to 100.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data['P_26'] != '' && $data['P_26'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'VAT must be greater then or equal to zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_26'] > 0 && $data['P_27'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'VAT type is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_27'] != '' && $data['P_27'] == 'Percent') {
				if($data['P_26'] < 0 || $data['P_26'] > 100){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'VAT must be in between 0 to 100.';
					echo json_encode ( $arrRes );
					die ();
				}
			}

			if ($data ['ID'] == '') {


			} else {

				$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $data ['ID'] ) ->update (
						array ( 'UNIT_PRICE' => $data['P_14'],
								'DISCOUNT_START_DATE' => $data['P_15'],
								'DISCOUNT_END_DATE' => $data['P_16'],
								'DISCOUNT' => $data['P_17'],
								'DISCOUNT_TYPE' => $data['P_18'],
								'SET_POINT' => $data['P_19'],
								'QUANTITY' => $data['P_20'],
								// 'SKU' => $data['P_21'],
								'EXTERNAL_LINK' => $data['P_22'],
								'EXTERNAL_LINK_TEXT' => $data['P_23'],
								'TAX' => $data['P_24'],
								'TAX_TYPE' => $data['P_25'],
								'VAT' => $data['P_26'],
								'VAT_TYPE' => $data['P_27'],

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Pricing Added Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function saveAdminProductIngredient(Request $request) {
		$Ingredient = new ProductIngredientModel();

		$details = $_REQUEST ['details'];
		$data = $details ['ingredient'];
		$prod = $details ['product'];
		$userId = $details ['userId'];
		// dd($data);
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['I_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Ingredient Category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (!isset($data['I_2']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Ingredient first.';
				echo json_encode ( $arrRes );
				die ();
			}

			$existCheck = $Ingredient->checkIngredientExistingCheckWrtproductId(isset($data['I_2']['id']) ? $data['I_2']['id'] : '',$prod['ID']);

			if($existCheck == true){

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Ingredient already added in product.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_product_ingredient_tbl' )->insertGetId (
						array ( 'PRODUCT_ID' => $prod['ID'],
								'INGREDIENT_CATEGORY' => $data['I_1'],
								'INGREDIENT_ID' => isset($data['I_2']['id']) ? $data['I_2']['id'] : '',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ingredient Added Successfully';
				$arrRes ['ingredients'] = $Ingredient->getAllProductIngredientByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_product_ingredient_tbl' ) ->where ( 'PRODUCT_INGREDIENT_ID', $data ['ID'] ) ->update (
						array ( 'INGREDIENT_CATEGORY' => $data['I_1'],
								'INGREDIENT_ID' => isset($data['I_2']['id']) ? $data['I_2']['id'] : '',

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ingredient Updated Successfully';
				$arrRes ['ingredients'] = $Ingredient->getAllProductIngredientByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function saveAdminQuickProductIngredient(Request $request) {
		$Ingredient = new ProductIngredientModel();

		$details = $_REQUEST ['details'];
		$data = $details ['ingredient'];
		$prod = $details ['product'];
		$userId = $details ['userId'];
		// dd($data);
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['I_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Ingredient Category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (!isset($data['I_2']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Ingredient first.';
				echo json_encode ( $arrRes );
				die ();
			}

			$existCheck = $Ingredient->checkIngredientExistingCheckWrtproductId(isset($data['I_2']['id']) ? $data['I_2']['id'] : '',$prod['PRODUCT_ID']);

			if($existCheck == true){

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Ingredient already added in product.';
				echo json_encode ( $arrRes );
				die ();
			}

			$result = DB::table ( 'jb_product_ingredient_tbl' )->insertGetId (
					array ( 'PRODUCT_ID' => $prod['PRODUCT_ID'],
							'INGREDIENT_CATEGORY' => $data['I_1'],
							'INGREDIENT_ID' => isset($data['I_2']['id']) ? $data['I_2']['id'] : '',
							'DATE' => date ( 'Y-m-d H:i:s' ),
							'CREATED_BY' => $userId,
							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);
			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Ingredient Added Successfully';
			$arrRes ['ingredients'] = $Ingredient->getAllProductIngredientByProduct($prod['PRODUCT_ID']);
			echo json_encode ( $arrRes );
			die ();


		}
	}

	public function saveAdminQuickProductUses(Request $request) {
		$ProductUses = new ProductUsesModel();

		$details = $_REQUEST ['details'];
		// dd($details);
		$data = $details ['uses'];
		$prod = $details ['product'];
		$userId = $details ['userId'];
		// dd($details);

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			// if ($data['U_1'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Sequence Number is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if ($data['U_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['U_2']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['U_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['U_4']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_product_uses_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'PRODUCT_ID' => $prod,
								'SEQUENCE_NUM' => $data['U_1'],
								'USES_TITLE' => $data['U_2'],
								'USES_DESCRIPTION' => $data['U_4'],

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Uses Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($prod);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_product_uses_tbl' ) ->where ( 'PRODUCT_USES_ID', $data ['ID'] ) ->update (
						array ( 'SEQUENCE_NUM' => $data['U_1'],
								'USES_TITLE' => $data['U_2'],
								'USES_DESCRIPTION' => $data['U_4'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Uses Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($prod);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function updateClinicalInfo(){
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$productId = $details['productId'];
		$clinicInfo = $details['updateClinicalInfo'];
		// dd($details);

		DB::table ( 'jb_product_tbl' )->where ( 'PRODUCT_ID', $productId )->update([
			'CLINICAL_NOTE_DESCRIPTION' => base64_encode($clinicInfo),
		]);

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Clinical Note updated successfully...';
		$arrRes ['clinicalNote'] = $Product->getAllProductClinicalNoteByProduct($productId);
		// dd($arrRes ['clinicalNote']);

		echo json_encode ( $arrRes );
	}


	public function deleteProductingredient(Request $request) {
		$Ingredient = new ProductIngredientModel();

		$details = $_REQUEST ['details'];
		$ingredientId = $details ['ingredientId'];
		$productId = $details['productId'];
		$userId = $details ['userId'];

		$delete = DB::table ( 'jb_product_ingredient_tbl' )->where ( 'PRODUCT_INGREDIENT_ID', $ingredientId )->delete ();

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient deleted successfully...';
		$arrRes ['ingredients'] = $Ingredient->getAllProductIngredientByProduct($productId);

		echo json_encode ( $arrRes );
	}

	public function saveAdminProductShade(Request $request) {
		$ProductShade = new ProductShadeModel();

		$details = $_REQUEST ['details'];
		$data = $details ['shade'];
		$prod = $details ['product'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if (!isset($data['S_1']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Shade first.';
				echo json_encode ( $arrRes );
				die ();
			}

			if($data['S_2'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Inv. Quantity is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($data['S_2'] <= 0){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Inv. Quantity must be greater then Zero.';
				echo json_encode ( $arrRes );
				die ();
			}



			if ($data ['ID'] == '') {

				$existCheck = $ProductShade->checkShadeExistCheckWrtProductId(isset($data['S_1']['id']) ? $data['S_1']['id'] : '',$prod['ID']);

				if ($existCheck == true) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Shade already added in product.';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_product_shades_tbl' )->insertGetId (
						array ( 'PRODUCT_ID' => $prod['ID'],
								'SHADE_ID' => isset($data['S_1']['id']) ? $data['S_1']['id'] : '',
								'QUANTITY' => isset($data['S_2']) ? $data['S_2'] : '',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shade Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$existCheck = $ProductShade->checkShadeExistCheckWrtProductId(isset($data['S_1']['id']) ? $data['S_1']['id'] : '',$prod['ID'],$data ['ID']);

				if ($existCheck == true) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Shade already added in product.';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_product_shades_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $data ['ID'] ) ->update (
						array ( 'SHADE_ID' => isset($data['S_1']['id']) ? $data['S_1']['id'] : '',
								'QUANTITY' => isset($data['S_2']) ? $data['S_2'] : '',

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shade Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editProductShade(Request $request) {

		$ProductShade = new ProductShadeModel();

		$details = $_REQUEST ['details'];
		$productShadeId = $details ['shadeId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $ProductShade->getSpecificProductShade($productShadeId);
		$arrRes ['images'] = $ProductShade->getProductShadeImages($productShadeId);

		echo json_encode ( $arrRes );
	}

	public function markProductShadeImage(Request $request) {
		$ProductShade = new ProductShadeModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$productShadeId = $details ['shadeId'];
		$flag = $details ['flag'];
		$userId = $details ['userId'];

		if($flag == '1'){

			DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $productShadeId ) ->update (
					array ( 'PRIMARY_FLAG' => '0')
				);

			$result = DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
					array ( 'PRIMARY_FLAG' => '1',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Image marked primary successfully...';

		} else if($flag == '2'){

			DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $productShadeId ) ->update (
					array ( 'SECONDARY_FLAG' => '0')
					);

			$result = DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
					array ( 'SECONDARY_FLAG' => '1',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);


			$arrRes ['msg'] = 'Image marked Secondary successfully...';

		}

		$arrRes ['done'] = true;
		$arrRes ['images'] = $ProductShade->getProductShadeImages($productShadeId);


		echo json_encode ( $arrRes );
	}
	public function deleteProductShadeImage(Request $request) {
		$ProductShade = new ProductShadeModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$productShadeId = $details ['productShadeId'];
		$userId = $details ['userId'];

		$attDetail = $ProductShade->getSpecificProductShadeImage($imageId);

		$delete = DB::table ( 'jb_product_shade_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != '' ){

			unlink($attDetail['path']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product Shade Image deleted successfully...';
		$arrRes ['images'] = $ProductShade->getProductShadeImages($productShadeId);

		echo json_encode ( $arrRes );
	}

	public function deleteProductShade(Request $request) {
		$ProductShade = new ProductShadeModel();

		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$productShadeId = $details ['productShadeId'];
		$userId = $details ['userId'];

		$attDetail = $ProductShade->getProductShadeImages($productShadeId);

		$delete = DB::table ( 'jb_product_shades_tbl' )->where ( 'PRODUCT_SHADE_ID', $productShadeId )->delete ();
		$delete = DB::table ( 'jb_product_shade_images_tbl' )->where ( 'PRODUCT_SHADE_ID', $productShadeId )->delete ();

		if(isset($attDetail) && !empty($attDetail) ){
			foreach($attDetail as $value){
				unlink($value['path']);
			}
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product Shade deleted successfully...';
		$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($productId);

		echo json_encode ( $arrRes );
	}

	public function saveAdminProductUses(Request $request) {
		$ProductUses = new ProductUsesModel();

		$details = $_REQUEST ['details'];
		$data = $details ['uses'];
		$prod = $details ['product'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			// if ($data['U_1'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Sequence Number is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if ($data['U_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['U_2']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
            if (empty($data['U_2']) || ctype_digit($data['U_2'])) {
                $arrRes['done'] = false;
                $arrRes['msg'] = 'Usage Title must be alphabetic or alphanumeric.';
                echo json_encode($arrRes);
                die();
            }

			if ($data['U_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['U_4']) < 100 || strlen($data['U_4']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be between 100 and 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {
                $result = DB::table ( 'jb_product_uses_tbl' )->where('USES_TITLE',$data['U_2'])->first();
                if(isset($result) || !empty($result)){
                    $arrRes ['done'] = false;
                    $arrRes ['msg'] = 'Usage Name Already Exist , Try different...';
                    echo json_encode ( $arrRes );
                    die ();
                }

				$result = DB::table ( 'jb_product_uses_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'PRODUCT_ID' => $prod['ID'],
								'SEQUENCE_NUM' => $data['U_1'],
								'USES_TITLE' => $data['U_2'],
								'USES_DESCRIPTION' => $data['U_4'],

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Uses Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();

			} else {
                $result = DB::table ( 'jb_product_uses_tbl' )->where('USES_TITLE',$data['U_2'])->whereNot('PRODUCT_ID',$prod['ID'])->first();
                if(isset($result) || !empty($result)){
                    $arrRes ['done'] = false;
                    $arrRes ['msg'] = 'Usage Name Already Exist , Try different...';
                    echo json_encode ( $arrRes );
                    die ();
                }

				$result = DB::table ( 'jb_product_uses_tbl' ) ->where ( 'PRODUCT_USES_ID', $data ['ID'] ) ->update (
						array ( 'SEQUENCE_NUM' => $data['U_1'],
								'USES_TITLE' => $data['U_2'],
								'USES_DESCRIPTION' => $data['U_4'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Uses Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function editProductUses(Request $request) {

		$ProductUses = new ProductUsesModel();

		$details = $_REQUEST ['details'];
		$productUsesId = $details ['productUsesId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $ProductUses->getSpecificProductUses($productUsesId);

		echo json_encode ( $arrRes );
	}
	public function deleteProductUses(Request $request) {
		$ProductUses = new ProductUsesModel();

		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$productUsesId = $details ['productUsesId'];
		$userId = $details ['userId'];
		// dd($details);

		$attDetail = $ProductUses->getSpecificProductUsesImage($productUsesId);

		$delete = DB::table ( 'jb_product_uses_tbl' )->where ( 'PRODUCT_USES_ID', $productUsesId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != '' ){
			unlink($attDetail['path']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product Uses deleted successfully...';
		$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($productId);

		echo json_encode ( $arrRes );
	}
	public function deleteProductUsesImage(Request $request) {
		$ProductUses = new ProductUsesModel();

		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$productUsesId = $details ['productUsesId'];
		$userId = $details ['userId'];

		$attDetail = $ProductUses->getSpecificProductUsesImage($productUsesId);

		$result = DB::table ( 'jb_product_uses_tbl' ) ->where ( 'PRODUCT_USES_ID', $productUsesId ) ->update (
							array ( 'PATH' => '',
									'DOWN_PATH' => '',
									'FILE_TYPE' => '',
									'FILE_NAME' => '',
									'FULL_NAME' => ''
							)
						);

		if(isset($attDetail['path']) && $attDetail['path'] != '' ){
			unlink($attDetail['path']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product Uses Image deleted successfully...';
		$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($productId);

		echo json_encode ( $arrRes );
	}


	public function saveAdminProductOtherInfo(Request $request) {  
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$data = $details ['product'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_34'] != '' && $data['P_34'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Shipping Days must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_37'] != '' && $data['P_37'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_38'] != '' && $data['P_38'] == 'Percent') {
				if ($data['P_37'] < 0 || $data['P_37'] > 100) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Discount must be in between 0 to 100.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data['P_42'] != '' && $data['P_42'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Low Quantity Warning must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}


			if ($data ['ID'] == '') {

			} else {

				$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $data ['ID'] ) ->update (
						array ( 'FREE_SHIPPING_FLAG' => $data ['P_28'] == 'true' ? '1' : '0',
								'PRODUCT_QUANTITY_MULTIPLY_FLAG' => $data ['P_29'] == 'true' ? '1' : '0',
								'FLAT_RATE_FLAG' => $data ['P_30'] == 'true' ? '1' : '0',
								'SHOW_STOCK_QUANTITY_FLAG' => $data ['P_31'] == 'true' ? '1' : '0',
								'SHOW_STOCK_TEXT_FLAG' => $data ['P_32'] == 'true' ? '1' : '0',
								'HIDE_STOCK_FLAG' => $data ['P_33'] == 'true' ? '1' : '0',

								'SHIPPING_DAYS' => $data ['P_34'] != '' ? $data ['P_34'] : '0',
								'TODAY_DEAL_FLAG' => $data ['P_35'] == 'true' ? '1' : '0',

								'ADD_TO_FLASH' => $data ['P_36'],
								'OTHER_DISCOUNT' => $data ['P_37'] != '' ? $data ['P_37'] : '0',
								'OTHER_DISCOUNT_TYPE' => $data ['P_38'],

								'CASH_ON_DELIVER_FLAG' => $data ['P_39'] == 'true' ? '1' : '0',
								'FEATURED_FLAG' => $data ['P_40'] == 'true' ? '1' : '0',
								'TODAY_DEAL_FLAG2' => $data ['P_41'] == 'true' ? '1' : '0',
								'LOW_QUANTITY_WARNING' => $data ['P_42'] != '' ? $data ['P_42'] : '0',

								'CLINICAL_NOTE_DESCRIPTION' => $data['P_43'] != '' ? base64_encode($data['P_43']) : '',

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Other Information Added Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	/*===================== admin Product code end ==========================*/

	/*===================== admin Shade Finder code start ==========================*/

	public function getAllAdminShadeFinderlov(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
		$Product = new ProductModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$optionId = $details ['optionId'];

		$arrRes ['list1'] = $Product->getProductsLov();
		$arrRes ['optionDetail'] = $ShadeFinder->getSpecificShadeFinderOptionData($optionId);
		$level1Detail = $ShadeFinder->getSpecificShadeFinderLevel1Data($optionId);
		$arrRes ['level1Detail'] = $level1Detail;

		if(isset($level1Detail['ID'])){
			$arrRes ['level1TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel1TypesByLevel1Id($level1Detail['ID']);
		}else{
			$arrRes ['level1TypeListing'] = '';
		}

		$level2Detail = $ShadeFinder->getSpecificShadeFinderLevel2Data($optionId);
		$arrRes ['level2Detail'] = $level2Detail;

		if(isset($level2Detail['ID'])){
			$arrRes ['level2TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel2TypesByLevel2Id($level2Detail['ID']);
		}else{
			$arrRes ['level2TypeListing'] = '';
		}

		$level3Detail = $ShadeFinder->getSpecificShadeFinderLevel3Data($optionId);
		$arrRes ['level3Detail'] = $level3Detail;

		if(isset($level3Detail['ID'])){
			$arrRes ['level3TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel3TypesByLevel3Id($level3Detail['ID']);
		}else{
			$arrRes ['level3TypeListing'] = '';
		}
		echo json_encode ( $arrRes );
	}

	public function saveAdminShadeFinderOptionInfo(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$data = $details ['option'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_1']) > 50) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 50 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Caption is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_2']) > 50) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Caption must be less then 50 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {

			} else {

				$result = DB::table ( 'jb_shade_finder_options_tbl' ) ->where ( 'OPTION_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['P_1'],
								'CAPTION' => $data['P_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Option Detail Updated Successfully';
// 				$arrRes ['ID'] = $data ['ID'];
// 				$arrRes ['optionDetail'] = $ShadeFinder->getSpecificShadeFinderOptionData($data ['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function saveAdminShadeFinderLevel1Info(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$data = $details ['level1'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['L_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['L_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if (strlen($data['L_2']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_shade_finder_level_one_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'OPTION_ID' => $option['ID'],
								'TITLE' => $data['L_1'],
								'DESCRITION' => $data['L_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level One Info Added Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_shade_finder_level_one_tbl' ) ->where ( 'LEVEL_ONE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['L_1'],
								'DESCRITION' => $data['L_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level One Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function saveAdminShadeFinderLevel1TypeInfo(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$level1 = $details ['level1'];
		$data = $details ['level1Type'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			$primaryProdIds = '';
			if( isset($data['LT_2'][0]) && !empty($data['LT_2'])){
				$productIds  = $data['LT_2'];

				foreach ($productIds  as $value){
					if($primaryProdIds == ''){
						$primaryProdIds = $value['id'];
					}else{
						$primaryProdIds = $primaryProdIds.','.$value['id'];
					}
				}
			}

			$recommandedProdIds = '';
			if( isset($data['LT_3'][0]) && !empty($data['LT_3'])){
				$productIds1  = $data['LT_3'];

				foreach ($productIds1  as $value){
					if($recommandedProdIds == ''){
						$recommandedProdIds = $value['id'];
					}else{
						$recommandedProdIds = $recommandedProdIds.','.$value['id'];
					}
				}
			}

			if (strlen($data['LT_1']) < 3) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required must be 3 chars long.';
				echo json_encode ( $arrRes );
				die ();
			}
            if (ctype_digit($data['LT_1'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be alphabetic or alphanuemeric.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['LT_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if($option['P_1'] == 'Yes'){
				if($primaryProdIds == ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Kindly choose Primary Product first.';
					echo json_encode ( $arrRes );
					die ();
				}
				if($recommandedProdIds == ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Kindly choose Recommanded Product first.';
					echo json_encode ( $arrRes );
					die ();
				}
			}

			if ($data ['ID'] == '') {

				$duplicate = $ShadeFinder->checkDuplicatelevelTypeWrtlevelID($data['LT_1'],$level1['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type already exists, try different...';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_shade_finder_level_one_type_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'LEVEL_ONE_ID' => $level1['ID'],
								'TITLE' => $data['LT_1'],
								'DESCRIPTION' => base64_encode($data['LT_4']),
								'PRIMARY_PRODUCT_IDS' => $primaryProdIds,
								'RECOMMANDED_PRODUCT_IDS' => $recommandedProdIds,
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level One Type Info Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['level1TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel1TypesByLevel1Id($level1['ID']);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$duplicate = $ShadeFinder->checkDuplicatelevelTypeWrtlevelID($data['LT_1'],$level1['ID'], $data ['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type already exists, try different...';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_shade_finder_level_one_type_tbl' ) ->where ( 'LEVEL_ONE_TYPE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['LT_1'],
								'DESCRIPTION' => base64_encode($data['LT_4']),
								'PRIMARY_PRODUCT_IDS' => $primaryProdIds,
								'RECOMMANDED_PRODUCT_IDS' => $recommandedProdIds,
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level One Type Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['level1TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel1TypesByLevel1Id($level1['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function editAdminShadeFinderLevel1Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$level1TypeId = $details ['recordId'];

		$arrRes ['details'] = $ShadeFinder->getSpecificShadeFinderLevel1TypeDetails($level1TypeId);
		$arrRes ['images'] = $ShadeFinder->getSpecificShadeFinderLevel1TypeImages($level1TypeId);

		echo json_encode ( $arrRes );
	}


	
	public function deleteShadeFinderLevel1Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$level1ID = $details ['level1ID'];
		$userId = $details ['userId'];

		$check = $ShadeFinder->checklevel1TypeUsed($recordId);
		if($check == ''){

			$attDetail = $ShadeFinder->getSpecificShadeFinderLevel1TypeImages($recordId);

			$delete = DB::table ( 'jb_shade_finder_level_one_type_tbl' )->where ( 'LEVEL_ONE_TYPE_ID', $recordId )->delete ();
			$delete = DB::table ( 'jb_shade_finder_images_tbl' )->where ( 'LEVEL_ONE_TYPE_ID', $recordId )->delete ();

			if(isset($attDetail) && !empty($attDetail)){
				foreach ($attDetail as $value){
                    if(file_exists($value['path'])){
                        unlink($value['path']);
                    }
				}
			}

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Type deleted successfully...';
			$arrRes ['level1TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel1TypesByLevel1Id($level1ID);
		}else{
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Type is already used in level three, kindly remove this from level 3 then proceed.';
		}

		echo json_encode ( $arrRes );
	}







	public function deleteLevel1TypeImage(Request $request) {

		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$level1TypeId = $details ['level1TypeId'];
		$userId = $details ['userId'];

		$attDetail = $ShadeFinder->getSpecificLevel1TypeImage($imageId);

		$delete = DB::table ( 'jb_shade_finder_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();

		if(isset($attDetail['path']) && $attDetail['path'] != '' ){
			unlink($attDetail['path']);
			$arrRes ['done'] = true;
		    $arrRes ['msg'] = 'Type Image deleted successfully...';
		    $arrRes ['images'] = $ShadeFinder->getSpecificShadeFinderLevel1TypeImages($level1TypeId);
		}

		else{
			$arrRes ['msg']="An error has occured";
		}

		echo json_encode ( $arrRes );
	}

	


	public function saveAdminShadeFinderLevel2Info(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$data = $details ['level2'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['L_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['L_1']) < 3 || strlen($data['L_1'])  > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
            if (ctype_digit($data['L_1'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be alphabetic or alphanuemeric.';
				echo json_encode ( $arrRes );
				die ();
			}

			if (strlen($data['L_2']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_shade_finder_level_two_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'OPTION_ID' => $option['ID'],
								'TITLE' => $data['L_1'],
								'DESCRIPTION' => $data['L_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Two Info Added Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_shade_finder_level_two_tbl' ) ->where ( 'LEVEL_TWO_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['L_1'],
								'DESCRIPTION' => $data['L_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Two Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function getLevel1TypeLovForLevel2Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$level1Id = $details ['level1Id'];
		$userId = $details ['userId'];


		$arrRes ['level1TypeLov'] = $ShadeFinder->getShadeFinderLevel1TypesLov($level1Id);

		echo json_encode ( $arrRes );
	}

	public function saveAdminShadeFinderLevel2TypeInfo(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$level2 = $details ['level2'];
		$data = $details ['level2Type'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {



			if ($data['LT_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['LT_1']) < 3 || strlen($data['LT_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be between 3 and 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
            if(ctype_digit($data['LT_1'])){
                $arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be alphabetic or alphanumeric.';
				echo json_encode ( $arrRes );
				die ();
            }
			if (!isset($data['LT_2']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Level One Type first, then proceed.';
				echo json_encode ( $arrRes );
				die ();
			}



			if ($data ['ID'] == '') {

				$duplicate = $ShadeFinder->checkDuplicatelevel2TypeWrtlevel2ID($data['LT_1'],$level2['ID'],$data['LT_2']['id']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist against this level one type, try different...';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_shade_finder_level_two_type_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'LEVEL_TWO_ID' => $level2['ID'],
								'TITLE' => $data['LT_1'],
								'LEVEL_ONE_TYPE_ID' => isset($data['LT_2']['id']) ? $data['LT_2']['id'] : '',
								'DESCRIPTION' => base64_encode($data['LT_3']),
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Two Type Info Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['level2TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel2TypesByLevel2Id($level2['ID']);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$duplicate = $ShadeFinder->checkDuplicatelevel2TypeWrtlevel2ID($data['LT_1'],$level2['ID'],$data['LT_2']['id'],$data['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist against this level one type, try different...';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_shade_finder_level_two_type_tbl' ) ->where ( 'LEVEL_TWO_TYPE_ID', $data ['ID'] ) ->update (
						array ( 'LEVEL_TWO_ID' => $level2['ID'],
								'TITLE' => $data['LT_1'],
								'LEVEL_ONE_TYPE_ID' => isset($data['LT_2']['id']) ? $data['LT_2']['id'] : '',
								'DESCRIPTION' => base64_encode($data['LT_3']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Two Type Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['level2TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel2TypesByLevel2Id($level2['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function editAdminShadeFinderLevel2Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$level2TypeId = $details ['recordId'];
		$level1Id = $details ['level1Id'];

		$arrRes ['level1TypeLov'] = $ShadeFinder->getShadeFinderLevel1TypesLov($level1Id);
		$arrRes ['details'] = $ShadeFinder->getSpecificShadeFinderLevel2TypeDetails($level2TypeId);

		echo json_encode ( $arrRes );
	}
	public function deleteShadeFinderLevel2Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$level2ID = $details ['level2ID'];
		$userId = $details ['userId'];

		$check = $ShadeFinder->checklevel2TypeUsed($recordId);
		if($check == ''){

			$delete = DB::table ( 'jb_shade_finder_level_two_type_tbl' )->where ( 'LEVEL_TWO_TYPE_ID', $recordId )->delete ();

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Type deleted successfully...';
			$arrRes ['level2TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel2TypesByLevel2Id($level2ID);
		}else{
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Type is already used in level three, kindly remove this from level 3 then proceed.';
		}

		echo json_encode ( $arrRes );
	}



	public function saveAdminShadeFinderLevel3Info(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$data = $details ['level3'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['L_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['L_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if (strlen($data['L_2']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_shade_finder_level_three_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'OPTION_ID' => $option['ID'],
								'TITLE' => $data['L_1'],
								'DESCRIPTION' => $data['L_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Three Info Added Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_shade_finder_level_three_tbl' ) ->where ( 'LEVEL_THREE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['L_1'],
								'DESCRIPTION' => $data['L_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Three Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function getLevel2TypeLovForLevel3Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$level2Id = $details ['level2Id'];
		$userId = $details ['userId'];


		$arrRes ['level2TypeLov'] = $ShadeFinder->getShadeFinderLevel2TypesLov($level2Id);

		echo json_encode ( $arrRes );
	}

	public function saveAdminShadeFinderLevel3TypeInfo(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$level3 = $details ['level3'];
		$data = $details ['level3Type'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			$primaryProdIds = '';
			if( isset($data['LT_3'][0]) && !empty($data['LT_3'])){
				$productIds  = $data['LT_3'];

				foreach ($productIds  as $value){
					if($primaryProdIds == ''){
						$primaryProdIds = $value['id'];
					}else{
						$primaryProdIds = $primaryProdIds.','.$value['id'];
					}
				}
			}

			$recommandedProdIds = '';
			if( isset($data['LT_4'][0]) && !empty($data['LT_4'])){
				$productIds1  = $data['LT_4'];

				foreach ($productIds1  as $value){
					if($recommandedProdIds == ''){
						$recommandedProdIds = $value['id'];
					}else{
						$recommandedProdIds = $recommandedProdIds.','.$value['id'];
					}
				}
			}

			if ($data['LT_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['LT_1']) < 3 || strlen($data['LT_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be between 3 and 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

            if(ctype_digit($data['LT_1'])){
                $arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be alphabetic or alphanumeric.';
				echo json_encode ( $arrRes );
				die ();
            }
			if (!isset($data['LT_2']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Level Two Type first, then proceed.';
				echo json_encode ( $arrRes );
				die ();
			}


			if($primaryProdIds == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Kindly choose Primary Product first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($recommandedProdIds == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Kindly choose Recommanded Product first.';
				echo json_encode ( $arrRes );
				die ();
			}


			if ($data ['ID'] == '') {

				$duplicate = $ShadeFinder->checkDuplicatelevel3TypeWrtlevel3ID($data['LT_1'],$level3['ID'],$data['LT_2']['id']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist against this level Two type, try different...';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_shade_finder_level_three_type_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'LEVEL_THREE_ID' => $level3['ID'],
								'TITLE' => $data['LT_1'],
								'LEVEL_TWO_TYPE_ID' => isset($data['LT_2']['id']) ? $data['LT_2']['id'] : '',
								'PRIMARY_PRODUCT_IDS' => $primaryProdIds,
								'RECOMMANDED_PRODUCT_IDS' => $recommandedProdIds,
								'DESCRIPTION' => base64_encode($data['LT_5']),
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',

								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Three Type Info Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['level3TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel3TypesByLevel3Id($level3['ID']);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$duplicate = $ShadeFinder->checkDuplicatelevel3TypeWrtlevel3ID($data['LT_1'],$level3['ID'],$data['LT_2']['id'],$data['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist against this level one type, try different...';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_shade_finder_level_three_type_tbl' ) ->where ( 'LEVEL_THREE_TYPE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['LT_1'],
								'LEVEL_TWO_TYPE_ID' => isset($data['LT_2']['id']) ? $data['LT_2']['id'] : '',
								'PRIMARY_PRODUCT_IDS' => $primaryProdIds,
								'RECOMMANDED_PRODUCT_IDS' => $recommandedProdIds,
								'DESCRIPTION' => base64_encode($data['LT_5']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Three Type Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['level3TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel3TypesByLevel3Id($level3['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminShadeFinderLevel3Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$level3TypeId = $details ['recordId'];
		$level2Id = $details ['level2Id'];

		$arrRes ['level2TypeLov'] = $ShadeFinder->getShadeFinderLevel2TypesLov($level2Id);
		$arrRes ['details'] = $ShadeFinder->getSpecificShadeFinderLevel3TypeDetails($level3TypeId);

		echo json_encode ( $arrRes );
	}
	public function deleteShadeFinderLevel3Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$level3ID = $details ['level3ID'];
		$userId = $details ['userId'];

		$delete = DB::table ( 'jb_shade_finder_level_three_type_tbl' )->where ( 'LEVEL_THREE_TYPE_ID', $recordId )->delete ();

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Type deleted successfully...';
		$arrRes ['level3TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel3TypesByLevel3Id($level3ID);

		echo json_encode ( $arrRes );
	}
	/*===================== admin Shade Finder code end ==========================*/

	/*==================== admin Orders code start ==========================*/

	public function getAllAdminOrderslov() {
		$OrderModel = new OrderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $OrderModel->getAllPlacedOrderData();

		echo json_encode ( $arrRes );
	}

	public function getSpecificOrderDetails() {
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

	public function orderStatusShipmentConfirm(Request $request) {
		$OrderModel = new OrderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$orderId = $details ['orderId'];

		$result = DB::table ( 'jb_order_tbl' ) ->where ( 'ORDER_ID', $orderId ) ->update (
						array ( 'ORDER_STATUS' => 'shipped',
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

		$trackingId = DB::table ( 'jb_order_shippment_tracking_tbl' )->insertGetId (
				array ( 'ORDER_ID' => $orderId,
						'STATUS' => 'shipped',
						'DATE' => date ( 'Y-m-d H:i:s' ),
						'CREATED_BY' => $userId,
						'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		$arrRes['done'] = true;
		$arrRes['msg'] = 'Order shipped succesfully.';

		echo json_encode ( $arrRes );
	}
	public function getAllAdminShippedOrderslov() {
		$OrderModel = new OrderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $OrderModel->getAllShippedOrderData();

		echo json_encode ( $arrRes );
	}

	public function addOrderShipmentDetail(Request $request) {
		$OrderShipmentModel = new OrderShipmentModel();

		$details = $_REQUEST ['details'];
		$data = $details ['shipment'];
		$orderId = $details ['orderId'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');

		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['S_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Shipping Company Name first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['S_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Delivery Status first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['S_3'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tracking Number is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['S_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Expected delivery date is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_order_shippment_detail_tbl' )->insertGetId (
						array ( 'ORDER_ID' => $orderId,
								'SHIPPING_COMPANY_NAME' => $data['S_1'],
								'TRACKING_NUMBER' => $data['S_3'],
								'EXPECTED_DELIVERY_DATE' => $data['S_4'],
								'STATUS' => $data['S_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$trackingId = DB::table ( 'jb_order_shippment_tracking_tbl' )->insertGetId (
						array ( 'ORDER_ID' => $orderId,
								'STATUS' => $data['S_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shipment Details Added Successfully';
				$arrRes ['shipment'] = $OrderShipmentModel->getAllSpecificOrderShipmentData($orderId);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_order_shippment_detail_tbl' ) ->where ( 'SHIPPING_ID', $data ['ID'] ) ->update (
						array ( 'SHIPPING_COMPANY_NAME' => $data['S_1'],
								'TRACKING_NUMBER' => $data['S_3'],
								'EXPECTED_DELIVERY_DATE' => $data['S_4'],
								'STATUS' => $data['S_2'],

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shipment Details Updated Successfully';
				$arrRes ['shipment'] = $OrderShipmentModel->getAllSpecificOrderShipmentData($orderId);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function shipmentStatusUpdate(Request $request) {
		$OrderShipmentModel = new OrderShipmentModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$orderId = $details ['orderId'];
		$shippingId = $details ['shippingId'];
		$flag = $details ['flag'];

		if($flag == '1'){
			$status = 'Picked Up';
		}else if($flag == 2){
			$status = 'In-Transit';
		}else if($flag == 3){
			$status = 'Delivered';
		}

		$result = DB::table ( 'jb_order_shippment_detail_tbl' ) ->where ( 'SHIPPING_ID', $shippingId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		$trackingId = DB::table ( 'jb_order_shippment_tracking_tbl' )->insertGetId (
				array ( 'ORDER_ID' => $orderId,
						'STATUS' => $status,
						'DATE' => date ( 'Y-m-d H:i:s' ),
						'CREATED_BY' => $userId,
						'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		if($flag == 3){
			$result = DB::table ( 'jb_order_tbl' ) ->where ( 'ORDER_ID', $orderId ) ->update (
					array ( 'ORDER_STATUS' => 'delivered',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
		}

		$arrRes['done'] = true;
		$arrRes['msg'] = 'Order shipping status updated successfully.';
		$arrRes['shipment'] = $OrderShipmentModel->getAllSpecificOrderShipmentData($orderId);

		echo json_encode ( $arrRes );
	}

	public function searchShipmentOrders(Request $request) {
		$OrderModel = new OrderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$search = $details ['search'];

		$orderNumber = isset($search['S_1']) ? $search['S_1'] : '';
		$orderStatus = isset($search['S_2']) ? $search['S_2'] : '';
		$shippmentStatus = isset($search['S_3']) ? $search['S_3'] : '';
		$startDate = isset($search['S_4']) ? $search['S_4'] : '';
		$endDate = isset($search['S_5']) ? $search['S_5'] : '';

		if($orderNumber == '' && $orderStatus == '' && $shippmentStatus == '' && $startDate == '' && $endDate == ''){

			$arrRes['done'] = false;
			$arrRes['msg'] = 'Choose atleast one filter.';

		}else{

			$arrRes['done'] = true;
			$arrRes['msg'] = 'Record(s) Found';
			// 1 for placed order listing & 2 for shipped/delivered order listing
			$arrRes['order'] = $OrderModel->getAllSearchOrderData(2,$orderNumber,$orderStatus,$shippmentStatus,$startDate,$endDate);

		}

		echo json_encode ( $arrRes );
	}

	/*==================== admin Orders code end ==========================*/

	/*===================== admin Product Bundle code start ==========================*/

	public function getAllAdminProductBundlelov(Request $request) {
		$Category = new CategoryModel();
		$Bundle = new BundleProductModel();
		$Product = new ProductModel();
		$Shades = new ShadesModel();


		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $Bundle->getAllBundleProductsData();
		$arrRes ['list1'] = $Category->getCategoryBundleLov();
		$arrRes ['list2'] = $Product->getProductsLov();
		echo json_encode ( $arrRes );
	}

	public function saveAdminBundleProductBasicInfo(Request $request) {
		$Product = new BundleProductModel();

		$details = $_REQUEST ['details'];
		$data = $details ['bundle'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['P_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_2']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Sub Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_3']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			// if ($data ['P_4'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Minimum Purchase Qty is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if ($data ['P_4'] < 0) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Minimum Purchase Qty must be greater then zero.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }

			// if ($data ['P_5'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Tags is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (strlen($data['P_5']) > 100) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Tags must be less then 100 characters.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (strlen($data['P_6']) > 100) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Barcode must be less then 100 characters.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if (!isset($data ['P_8']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose Category.';
				echo json_encode ( $arrRes );
				die ();
			}

			// if (!isset($data ['P_9']['id'])) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Please choose Sub Category.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (!isset($data ['P_11']['id'])) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Please choose Sub Sub Category.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if ($data['P_10'] == '') {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Slug is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (strlen($data['P_10']) > 100) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Slug must be less then 100 characters.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
            if ($data['P_16'] <= 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = "Inv. Quantity must be greater then zero.";
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_12'] < 0 || $data['P_12'] > 100 ) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = "TAX Rate must be in between 0 to 100.";
				echo json_encode ( $arrRes );
				die ();
			}
// 			if ($data['P_13'] < 0) {
// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = "Total Amount must be greater then zero.";
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data['P_15'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = "Discounted Amount must be greater then zero.";
				echo json_encode ( $arrRes );
				die ();
			}

			if (strlen($data['P_14']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Short Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}


			if ($data ['ID'] == '') {


                $duplicateBundle = $this->checkDuplicateBundleName($data['P_1']);
                $duplicate = $this->checkBundleNameAgainstProducts($data['P_1']);
                if($duplicateBundle->isEmpty()){
                    // dd('No Duplicate Bundle Name');
                    if ($duplicate->isEmpty()) {
                        // dd('No same Name against products');
                        $name = $data['P_1'];
                        $words = explode(' ', $name);
                        if (count($words) > 1 || strpos($name, ' ') !== false) {
                            $name = implode('-', $words);
                        } else {
                            $name = $data['P_1'];
                        }
                        $slug = $name;

                    }else{
                        // dd('same Name against products');
                        $arrRes ['done'] = false;
                        $arrRes ['msg'] = 'Name Already Exists In Products, try different Name for Bundle...';
                        echo json_encode ( $arrRes );
                        die ();
                    }
                }else{
                    // dd('Duplicate Bundle Name');
                    $arrRes ['done'] = false;
                    $arrRes ['msg'] = 'Bundle Name Already Exists, try different Name for Bundle...';
                    echo json_encode ( $arrRes );
                    die ();
                }


				$getLastSeq = DB::table ( 'jb_bundle_product_tbl' )->select('SEQ_NUM')->latest('SEQ_NUM')->first();

				if($getLastSeq != null){

					$getLastSeq = ($getLastSeq->SEQ_NUM)+1;

				}else{

				    $getLastSeq=1;
				}

				$result = DB::table ( 'jb_bundle_product_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'NAME' => $data['P_1'],
								'SEQ_NUM' => $getLastSeq,
								'SUB_TITLE' => $data['P_2'],
								'UNIT' => $data ['P_3'],
								'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
								'TAGS' => $data ['P_5'],
								'BARCODE' => $data ['P_6'],
								'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
								'CATEGORY_ID' => isset($data ['P_8']['id']) ? $data ['P_8']['id'] : '',
								'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
								'SLUG' => $slug,
								'SUB_SUB_CATEGORY_ID' => isset($data ['P_11']['id']) ? $data ['P_11']['id'] : '',
								'VAT_RATE' => $data ['P_12'],
// 								'TOTAL_AMOUNT' => $data ['P_13'],
								'SHORT_DESCRIPTION' => $data ['P_14'],
								'DISCOUNTED_AMOUNT' => $data ['P_15'],
								'QUANTITY' => $data ['P_16'],

								'STATUS' => 'inactive',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Bundle Header Info Added Successfully.';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

// 				$duplicate = $Product->checkDuplicateSlug($data['P_10'], $data ['ID']);
// 				if ($duplicate != '') {
// 					$arrRes ['done'] = false;
// 					$arrRes ['msg'] = 'Slug is already exist, try different...';
// 					echo json_encode ( $arrRes );
// 					die ();
// 				}
                $duplicateBundle = $this->checkDuplicateBundleNameExceptItself($data['ID'],$data['P_1']);
                $duplicate = $this->checkBundleNameAgainstProducts($data['P_1']);
                $slug = '';
                if($duplicateBundle->isEmpty()){
                    // dd('No Duplicate Bundle Name');
                    if ($duplicate->isEmpty()) {
                        // dd('No same Name against products');
                        $name = $data['P_1'];
                        $words = explode(' ', $name);
                        if (count($words) > 1 || strpos($name, ' ') !== false) {
                            $name = implode('-', $words);
                        } else {
                            $name = $data['P_1'];
                        }
                        $slug = $name;

                    }else{
                        // dd('same Name against products');
                        $arrRes ['done'] = false;
                        $arrRes ['msg'] = 'Name Already Exists In Products, try different Name for Bundle...';
                        echo json_encode ( $arrRes );
                        die ();
                    }
                }else{
                    // dd('Duplicate Bundle Name');
                    $arrRes ['done'] = false;
                    $arrRes ['msg'] = 'Bundle Name Already Exists, try different Name for Bundle...';
                    echo json_encode ( $arrRes );
                    die ();
                }

				$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $data ['ID'] ) ->update (
						array ( 'NAME' => $data['P_1'],
								'SUB_TITLE' => $data['P_2'],
								'UNIT' => $data ['P_3'],
								'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
								'TAGS' => $data ['P_5'],
								'BARCODE' => $data ['P_6'],
								'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
								'CATEGORY_ID' => isset($data ['P_8']['id']) ? $data ['P_8']['id'] : '',
								'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
								'SLUG' => $slug,
								'SUB_SUB_CATEGORY_ID' => isset($data ['P_11']['id']) ? $data ['P_11']['id'] : '',
								'VAT_RATE' => $data ['P_12'],
// 								'TOTAL_AMOUNT' => $data ['P_13'],
								'SHORT_DESCRIPTION' => $data ['P_14'],
								'DISCOUNTED_AMOUNT' => $data ['P_15'],
								'QUANTITY' => $data ['P_16'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Bundle Header Info Updated Successfully.';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
    public function checkDuplicateBundleName($bundleName){
        $result = DB::table('jb_bundle_product_tbl')->select('NAME')->where('Name',$bundleName)->get();
        return $result;
    }
    public function checkDuplicateBundleNameExceptItself($id,$bundleName){
        $result = DB::table('jb_bundle_product_tbl')->select('NAME')->whereNot('BUNDLE_ID',$id)->where('NAME', $bundleName)->get();
        return $result;
    }
    public function checkBundleNameAgainstProducts($bundleName){
        $result = DB::table('jb_product_tbl')->select('NAME')->where('Name',$bundleName)->get();
        return $result;
    }

	public function editAdminBundleProduct(Request $request) {
		$Category = new CategoryModel();
		$Bundle = new BundleProductModel();
		$BundleLine = new BundleProductLineModel();

		$details = $_REQUEST ['details'];
		$bundleId = $details ['bundleId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $Bundle->getSpecificBundleProductData($bundleId);
		$arrRes ['bundleLines'] = $BundleLine->getAllBundleProductLines($bundleId);
		$arrRes ['subCategory'] = $Category->getSubCategoryLovWrtCategory($arrRes ['details']['P_8']);
		$arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory($arrRes ['details']['P_9']);

		echo json_encode ( $arrRes );
	}

	// public function deleteBundleProductImage(Request $request) {
	// 	$Bundle = new BundleProductModel();

	// 	$details = $_REQUEST ['details'];
	// 	$bundleId = $details ['bundleId'];
	// 	$userId = $details ['userId'];

	// 	$attDetail = $Bundle->getSpecificBundleProductData($bundleId);

	// 	$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update (
	// 					array ( 'IMAGE_DOWN_PATH' => '',
	// 							'IMAGE_PATH' => '',
	// 							'UPDATED_BY' => $userId,
	// 							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
	// 					)
	// 				);

	// 	if(isset($attDetail['path']) && $attDetail['path'] != ''){
	// 		unlink($attDetail['path']);
	// 	}

	// 	$arrRes ['done'] = true;
	// 	$arrRes ['msg'] = 'Bundle image deleted successfully...';

	// 	echo json_encode ( $arrRes );
	// }

	public function saveAdminBundleProductLine(Request $request) {
		$Product = new ProductModel();
		$Bundle = new BundleProductModel();
		$BundleLine = new BundleProductLineModel();


		$details = $_REQUEST ['details'];
		$data = $details ['product'];
		$bundleId = $details ['bundleId'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if (!isset($data['P_1']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Product first.';
				echo json_encode ( $arrRes );
				die ();
			}

			$productDetails = $Product->getSpecificProductUnitPrice($data['P_1']['id']);
// 			print_r('<pre>');
// 			print_r($productDetails);
// 			exit();
			$productPrice = isset($productDetails['unitPrice']) ? $productDetails['unitPrice'] : '0';

			if ($data ['ID'] == '') {

				$duplicate = $BundleLine->checkDuplicateProductWrtBundleId($data['P_1']['id'], $bundleId);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Product is already exist in bundle, try different product...';
					echo json_encode ( $arrRes );
					die ();
				}



				$result = DB::table ( 'jb_bundle_product_line_tbl' )->insertGetId (
						array ( 'BUNDLE_ID' => $bundleId,
								'PRODUCT_ID' => isset($data['P_1']['id']) ? $data['P_1']['id'] : '',
								'PRODUCT_PRICE'=> $productPrice,

								'STATUS' => 'active',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Bundle Line Info Added Successfully.';
				$arrRes ['ID'] = $result;
				$arrRes ['bundleLines'] = $BundleLine->getAllBundleProductLines($bundleId);

				$bundleDetails = $Bundle->getSpecificBundleProductData($bundleId);
				$totalBundleAmount = $bundleDetails['P_13'];

				$bundleAmount = $totalBundleAmount + $productPrice;

				$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update ( array ( 'TOTAL_AMOUNT' => $bundleAmount ) );

				echo json_encode ( $arrRes );
				die ();

			} else {

				$duplicate = $BundleLine->checkDuplicateProductWrtBundleId($data['P_1']['id'], $bundleId, $data['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Product is already exist in bundle, try different product...';
					echo json_encode ( $arrRes );
					die ();
				}

				$result = DB::table ( 'jb_bundle_product_line_tbl' ) ->where ( 'BUNDLE_LINE_ID', $data ['ID'] ) ->update (
						array ( 'PRODUCT_ID' => isset($data['P_1']['id']) ? $data['P_1']['id'] : '',
								'PRODUCT_PRICE'=> $productPrice,

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Bundle Line Info Updated Successfully.';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['lines'] = $BundleLine->getAllBundleProductLines($bundleId);

				$bundleDetails = $Bundle->getSpecificBundleProductData($bundleId);
				$totalBundleAmount = $bundleDetails['P_13'];

				$bundleAmount = $totalBundleAmount + $productPrice;

				$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update ( array ( 'TOTAL_AMOUNT' => $bundleAmount ) );

				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function deleteBundleProductLine(Request $request) {
		$Bundle = new BundleProductModel();
		$BundleLine = new BundleProductLineModel();
		$SubscriptionModel = new SubscriptionModel();

		$details = $_REQUEST ['details'];
		$bundleId = $details ['bundleId'];
		$bundleLineId = $details ['bundleLineId'];
		$userId = $details ['userId'];

		// $existCheckSubscription = $SubscriptionModel->checkSubscribedBundleExistWrtBundleId($bundleId);

		// if($existCheckSubscription == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Subscription exist against this Bundle, system will not able to delete this product, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }


		$detail = $Bundle->getSpecificBundleProductData($bundleId);

		$delete = DB::table ( 'jb_bundle_product_line_tbl' )->where ( 'BUNDLE_LINE_ID', $bundleLineId )->delete ();

		$linesTotalPrice = $BundleLine->getBundleLineAmountsSum($bundleId);

		$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update ( array ( 'TOTAL_AMOUNT' => $linesTotalPrice ) );

		$checkSingleBundleProducts = $BundleLine->getAllBundleProductLines($bundleId);

		if($checkSingleBundleProducts == null){

			$status = 'inactive';

			DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Bundle Line deleted successfully...';

		echo json_encode ( $arrRes );
	}

	/*===================== admin Product Bundle code end ==========================*/

	/*===================== admin Reviews code start ==========================*/

	public function getAllAdminReviewslov() {
		$ReviewsModel = new ReviewsModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['reviews'] = $ReviewsModel->getAllReviewsForAdmin();

		echo json_encode ( $arrRes );
	}

	public function deleteReviewDetails(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_reviews_tbl' )->where( 'REVIEW_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'Review delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}

	public function updateReviewStatus() {
		$ReviewsModel = new ReviewsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$details = $ReviewsModel->getSpecificReviewDetailAdmin($recordId);

		if(isset($details['STATUS_FLAG']) && $details['STATUS_FLAG'] == '0'){
			$status = 'published';
			$arrRes ['msg'] = 'Review posted successfully...';
		}else{
			$status = 'inapproval';
			$arrRes ['msg'] = 'Review hide from site...';
			$result = DB::table ( 'jb_reviews_tbl' )->where ( 'REVIEW_ID', $recordId )->update
				( array (
					'ON_SITE_ENABLE' => '0',
					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					) );
		}

		$result = DB::table ( 'jb_reviews_tbl' )->where ( 'REVIEW_ID', $recordId )->update ( array ( 'STATUS' => $status ) );


		$arrRes ['done'] = true;
		$arrRes ['reviews'] = $ReviewsModel->getAllReviewsForAdmin();

		echo json_encode ( $arrRes );
	}
	public function updateReviewOnSiteStatus() {
		$ReviewsModel = new ReviewsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$details = $ReviewsModel->getSpecificReviewDetailAdmin($recordId);

		if(isset($details['ON_SITE_ENABLE']) && $details['ON_SITE_ENABLE'] == '0'){
			$status = '1';
			$arrRes ['msg'] = 'Review enabled successfully...';
		}else{
			$status = '0';
			$arrRes ['msg'] = 'Review disabled from site...';
		}

		$result = DB::table ( 'jb_reviews_tbl' )->where ( 'REVIEW_ID', $recordId )->update ( array (
			'ON_SITE_ENABLE' => $status,
			'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			) );

		$arrRes ['done'] = true;
		$arrRes ['reviews'] = $ReviewsModel->getAllReviewsForAdmin();

		echo json_encode ( $arrRes );
	}
	public function getSpecificReviewDetails() {
		$ReviewsModel = new ReviewsModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $ReviewsModel->getSpecificReviewDetailAdmin($recordId);

		echo json_encode ( $arrRes );
	}
	/*===================== admin Reviews code End ==========================*/

	/*===================== admin Questions code start ==========================*/

	public function getAllAdminQuestionslov() {
		$QuestionModel = new QuestionModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['questions'] = $QuestionModel->getAllPublishedQuestionsForAdmin();

		echo json_encode ( $arrRes );
	}

	public function deleteQuestionReply(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_questions_tbl' )->where( 'QUESTION_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'Question delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}

	public function updateQuestionStatus() {
		$QuestionModel = new QuestionModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$details = $QuestionModel->getSpecificQuestionDetails($recordId);

		if(isset($details['STATUS_FLAG']) && $details['STATUS_FLAG'] == '0'){
			$status = 'published';
			$arrRes ['msg'] = 'Question posted successfully...';
		}else{
			$status = 'inapproval';
			$arrRes ['msg'] = 'Question hide from site...';
		}

		$result = DB::table ( 'jb_questions_tbl' )->where ( 'QUESTION_ID', $recordId )->update ( array (
			'STATUS' => $status,
			'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			) );

		$arrRes ['done'] = true;
		$arrRes ['questions'] = $QuestionModel->getAllPublishedQuestionsForAdmin();

		echo json_encode ( $arrRes );
	}

	public function saveQuestionAnswer() {
		$QuestionModel = new QuestionModel();

		$details = $_REQUEST ['details'];
		$data = $details ['record'];
		$userId = $details ['userId'];

		if($data['answer'] == ''){

			$arrRes ['done'] = true;
			$arrRes ['msg'] = "Can't post empty answer...";
			echo json_encode ( $arrRes );
			die();
		}


		$result = DB::table ( 'jb_questions_tbl' )->where ( 'QUESTION_ID', $data['questionId'] )->update (
				array ( 'ANSWER' => $data['answer'],
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' ),
						'UPDATED_BY' => $userId
				) );

		$arrRes ['done'] = true;
		$arrRes ['msg'] = "Answer posted successfully.";
		$arrRes ['questions'] = $QuestionModel->getAllPublishedQuestionsForAdmin();

		echo json_encode ( $arrRes );
	}


	/*===================== admin Subscriptions code start ==========================*/

	public function getAllAdminSubscriptionlov() {
		$SubscriptionModel = new SubscriptionModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $SubscriptionModel->getAllSubscriptionsForAdmin();

		echo json_encode ( $arrRes );
	}

	public function saveAdminSubscription(Request $request) {
		$SubscriptionModel = new SubscriptionModel();

		$details = $_REQUEST ['details'];
		$data = $details ['subscription'];
		$userId = $details ['userId'];
		$currentdate = date('Y-m-d');

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data ['S_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['S_1']) < 3 || strlen($data ['S_1']) > 100) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be between 3 and 100 charactres.';
				echo json_encode ( $arrRes );
				die ();
			}
            if(ctype_digit($data ['S_1'])){
                $arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be alphabetic or alphanumeric.';
				echo json_encode ( $arrRes );
				die ();
            }
// 			if ($data ['S_2'] == '') {

// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Price is required.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
// 			if ($data ['S_2'] <= 0) {

// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Price must be greater then zero.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data ['S_3'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Effective Start Date is required.';
				echo json_encode ( $arrRes );
				die ();
			}

// 			if ($data ['S_3'] < $currentdate) {

// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Effective Start Date must be equal to or greater then Current Date.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data ['S_4'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Effective End Date is required.';
				echo json_encode ( $arrRes );
				die ();
			}
// 			if ($data ['S_4'] < $currentdate) {

// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Effective End Date must be equal to or greater then Current Date.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data ['S_4'] < $data ['S_3']) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Effective End Date must be greater then Effective Start Date.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_5'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subscription Note 1 is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['S_5']) > 200) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subscription Note 1 must be less then 200 charactres long.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_6'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subscription Note 2 is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['S_6']) > 200) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subscription Note 2 must be less then 200 charactres long.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_7'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Duration (Months) is required.';
				echo json_encode ( $arrRes );
				die ();
			}
            if ($data ['S_7'] < 1 || $data ['S_7'] > 12) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Duration (Months) must be between 1 and 12.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_8'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_8'] <= 0) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
// 			if ($data ['S_9'] == '') {

// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Validity Days is required.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
// 			if ($data ['S_9'] <= 0) {

// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Validity Days must be greater then zero.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data ['S_10'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Detail is required.';
				echo json_encode ( $arrRes );
				die ();
			}


			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_subscription_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,

								'TITLE' => $data['S_1'],
// 								'PRICE' => $data['S_2'],
								'EFF_START_DATE' => $data['S_3'],
								'EFF_END_DATE' => $data['S_4'],
								'SUB_NOTE_1' => $data['S_5'],
								'SUB_NOTE_2' => $data['S_6'],
								'DURATION_MONTHS' => $data['S_7'],
								'DISCOUNT' => $data['S_8'],
// 								'VALIDITY_DAYS' => $data['S_9'],
								'DESCRIPTION' => $data['S_10'],
								'STATUS' => 'active',

								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Subscription Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['list'] = $SubscriptionModel->getAllSubscriptionsForAdmin();
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_subscription_tbl' ) ->where ( 'SUBSCRIPTION_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['S_1'],
// 								'PRICE' => $data['S_2'],
								'EFF_START_DATE' => $data['S_3'],
								'EFF_END_DATE' => $data['S_4'],
								'SUB_NOTE_1' => $data['S_5'],
								'SUB_NOTE_2' => $data['S_6'],
								'DURATION_MONTHS' => $data['S_7'],
								'DISCOUNT' => $data['S_8'],
// 								'VALIDITY_DAYS' => $data['S_9'],
								'DESCRIPTION' => $data['S_10'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Subscription Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['list'] = $SubscriptionModel->getAllSubscriptionsForAdmin();
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminSubscription() {
		$SubscriptionModel = new SubscriptionModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $SubscriptionModel->getSpecificSubscriptionData($recordId);

		echo json_encode ( $arrRes );
	}

	public function deleteAdminSubscription(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_subscription_tbl' )->where( 'SUBSCRIPTION_ID', $recordId ) ->update(
			array ( 'IS_DELETED' => 0,
					'STATUS' => 'inactive',
					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			)
		);

		$arrRes ['msg'] = 'Subscription delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}

	public function changeStatusSubscription(Request $request) {
		$SubscriptionModel = new SubscriptionModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$subDetail = $SubscriptionModel->getSpecificSubscriptionStatus($recordId);

		if(isset($subDetail['STATUS']) && $subDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Subscription active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Subscription Inactive successfully...';
		}

		$result = DB::table ( 'jb_subscription_tbl' ) ->where ( 'SUBSCRIPTION_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		$arrRes ['done'] = true;
		$arrRes ['list'] = $SubscriptionModel->getAllSubscriptionsForAdmin();

		echo json_encode ( $arrRes );

	}


	/*===================== admin Subscriptions code end ==========================*/

	/*===================== admin home user page crud code start =========================*/

	public function getAllAdminHomeUserlov() {
		$UserdashboardModel = new UserdashboardModel();
		$ProductModel = new ProductModel();
		$CategoryModel = new CategoryModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['banners'] = $UserdashboardModel->getAllUserBanners();
		$arrRes ['bestExc'] = $UserdashboardModel->getAllUserBestExcData();
		$arrRes ['products'] = $ProductModel->getActiveProductsLov();
		$arrRes ['categories'] = $CategoryModel->getCategoryWithoutBundleLov();
		$arrRes ['trending'] = $UserdashboardModel->getAllUserHomeProductSectionData('trending');
		$arrRes ['foryou'] = $UserdashboardModel->getAllUserHomeProductSectionData('foryou');
		$arrRes ['offers'] = $UserdashboardModel->getAllUserHomeOfferSectionData();

		echo json_encode ( $arrRes );
	}

	public function saveAdminHomeUserPageBanner(Request $request) {
		$UserdashboardModel = new UserdashboardModel();

		$details = $_REQUEST ['details'];
		$data = $details ['banner'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data['B_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['B_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['B_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Button Text is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['B_2']) > 50) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Button Text must be less then 50 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['B_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Short Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['B_4']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Short Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['B_6'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Upload Banner image first then proceed.';
				echo json_encode ( $arrRes );
				die ();
			}

			$detail = $UserdashboardModel->getSpecificUserBannerById($data ['ID']);

			if (empty($detail)) {

				$result = DB::table ( 'jb_user_home_banner_tbl' )->insertGetId (
						array ( 'BANNER_ID' => $data ['ID'],
								'USER_ID' => $userId,
								'TITLE' => $data['B_1'],
								'BUTTON_TEXT' => $data['B_2'],
								'BUTTON_LINK' => $data ['B_3'],
								'DESCRIPTION' => $data ['B_4'],
								'IMAGE_DOWNPATH' => $data ['B_5'],
								'IMAGE_PATH' => $data ['B_6'],

								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Banner Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_user_home_banner_tbl' ) ->where ( 'BANNER_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['B_1'],
								'BUTTON_TEXT' => $data['B_2'],
								'BUTTON_LINK' => $data ['B_3'],
								'DESCRIPTION' => $data ['B_4'],
								'IMAGE_DOWNPATH' => $data ['B_5'],
								'IMAGE_PATH' => $data ['B_6'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Banner Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function saveAdminHomeUserBestExc(Request $request) {
		$UserdashboardModel = new UserdashboardModel();

		$details = $_REQUEST ['details'];
		$data = $details ['bestexc'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			$detail = $UserdashboardModel->getSpecificUserBestExcById($data ['ID']);

			if (empty($detail)) {

				$result = DB::table ( 'jb_user_home_bestexclusive_tbl' )->insertGetId (
						array ( 'BESTEXC_ID' => $data ['ID'],
								'USER_ID' => $userId,
								'TITLE' => $data['B_1'],
								'HEADING' => $data['B_2'],
								'PRODUCT_ID' => $data ['B_3'],
								'IMAGE_DOWNPATH' => $data ['B_4'],
								'IMAGE_PATH' => $data ['B_5'],

								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Saved Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_user_home_bestexclusive_tbl' ) ->where ( 'BESTEXC_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['B_1'],
								'HEADING' => $data['B_2'],
								'PRODUCT_ID' => $data ['B_3'],
								'IMAGE_DOWNPATH' => $data ['B_4'],
								'IMAGE_PATH' => $data ['B_5'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function deleteHomeBannerImage(Request $request) {
		$UserdashboardModel = new UserdashboardModel();

		$details = $_REQUEST ['details'];
		$bannerId = $details ['bannerId'];
		$userId = $details ['userId'];

		$attDetail = $UserdashboardModel->getSpecificUserBannerById($bannerId);

		$result = DB::table ( 'jb_user_home_banner_tbl' ) ->where ( 'BANNER_ID', $bannerId ) ->update (
				array (
						'IMAGE_DOWNPATH' => '',
						'IMAGE_PATH' => '',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		if(isset($attDetail['IMAGE_PATH']) && $attDetail['IMAGE_PATH'] != ''){
			unlink($attDetail['IMAGE_PATH']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Banner image deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function deleteHomeBestExcImage(Request $request) {
		$UserdashboardModel = new UserdashboardModel();

		$details = $_REQUEST ['details'];
		$bestexcId = $details ['bestexcId'];
		$userId = $details ['userId'];

		$attDetail = $UserdashboardModel->getSpecificUserBestExcById($bestexcId);

		$result = DB::table ( 'jb_user_home_bestexclusive_tbl' ) ->where ( 'BESTEXC_ID', $bestexcId ) ->update (
				array (
						'IMAGE_DOWNPATH' => '',
						'IMAGE_PATH' => '',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);

		if(isset($attDetail['IMAGE_PATH']) && $attDetail['IMAGE_PATH'] != ''){
			unlink($attDetail['IMAGE_PATH']);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Image deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function getproductlovfromcategory(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();
		$BundleProductModel = new BundleProductModel();

		$details = $_REQUEST ['details'];
		$categoryId = $details ['categoryId'];
		$userId = $details ['userId'];

		$subCatIds = $CategoryModel->getAllSubCategoryIdsWrtCategoryId($categoryId);

		$subSubCatIds = $CategoryModel->getAllSubSubCategoryIdsWrtSubCategoryId($subCatIds);

		$arrRes ['productLov'] = $ProductModel->getProductsLovWrtCatSubCatSubSubCatIds($categoryId,$subCatIds,$subSubCatIds);
        // dd($arrRes);
		echo json_encode ( $arrRes );
	}


	public function saveTrendingProductDetails(Request $request) {
		$UserdashboardModel = new UserdashboardModel();

		$details = $_REQUEST ['details'];
		$data = $details ['trending'];
		$userId = $details ['userId'];
		$code = $details ['code'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if(!isset($data['T_1']['id'])){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose product category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(!isset($data['T_2']['id'])){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose product first.';
				echo json_encode ( $arrRes );
				die ();
			}
            // dd('working');
            // if($data['ID'] == ''){
                $duplicate = DB::table ( 'jb_user_home_product_section_tbl')
                    ->where('BATCH_CODE',$code)
                    ->where('PRODUCT_ID',$data['T_2']['id'])->first();
            // }
            // dd($duplicate);
            if(!empty($duplicate)){
                $arrRes ['done'] = false;
				$arrRes ['msg'] = 'Product Already Added, Try Another One';
				// $arrRes ['ID'] = $result;
				// $arrRes ['list'] = $UserdashboardModel->getAllUserHomeProductSectionData($code);
				echo json_encode ( $arrRes );
				die ();
            }


			if ($data['ID'] == '') {

				$result = DB::table ( 'jb_user_home_product_section_tbl' )->insertGetId (
						array (	'USER_ID' => $userId,
								'BATCH_CODE' => $code,
								'CATEGORY_ID' => isset($data['T_1']['id']) ? $data['T_1']['id'] : '',
								'PRODUCT_ID' => isset($data['T_2']['id']) ? $data['T_2']['id'] : '',
								'STATUS' => 'active',

								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Saved Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['list'] = $UserdashboardModel->getAllUserHomeProductSectionData($code);
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_user_home_product_section_tbl' ) ->where ( 'SECTION_ID', $data ['ID'] ) ->update (
						array ( 'CATEGORY_ID' => isset($data['T_1']['id']) ? $data['T_1']['id'] : '',
								'PRODUCT_ID' => isset($data['T_2']['id']) ? $data['T_2']['id'] : '',
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['list'] = $UserdashboardModel->getAllUserHomeProductSectionData($code);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function deleteSectionRecord(Request $request) {
		$UserdashboardModel = new UserdashboardModel();

		$details = $_REQUEST ['details'];
		$sectionId = $details ['sectionId'];
		$userId = $details ['userId'];

		$delete = DB::table ( 'jb_user_home_product_section_tbl' )->where ( 'SECTION_ID', $sectionId )->delete ();

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Record deleted successfully...';
		$arrRes ['trending'] = $UserdashboardModel->getAllUserHomeProductSectionData('trending');
		$arrRes ['foryou'] = $UserdashboardModel->getAllUserHomeProductSectionData('foryou');

		echo json_encode ( $arrRes );
	}

	public function saveTodayofferDetails(Request $request) {
		$UserdashboardModel = new UserdashboardModel();

		$details = $_REQUEST ['details'];
		$data = $details ['offer'];
		$userId = $details ['userId'];

		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


		if (isset ( $data ) && ! empty ( $data )) {

			if($data['T_1'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(strlen($data['T_1']) > 100){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(!isset($data['T_2']['id'])){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose product category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(!isset($data['T_3']['id'])){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose product first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($data['T_4'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Offer End Time is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			$currentDate = date('Y-m-d H:i:s');
			$endDate = date('Y-m-d H:i:s', strtotime($data['T_4']));

			if($endDate < $currentDate){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Offer End Time must be greater then current time.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($data['T_5'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(strlen($data['T_5']) > 500){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}


			if ($data['ID'] == '') {

				$result = DB::table ( 'jb_user_home_offer_section_tbl' )->insertGetId (
						array (	'USER_ID' => $userId,
								'OFFER_TITLE' => $data['T_1'],
								'CATEGORY_ID' => isset($data['T_2']['id']) ? $data['T_2']['id'] : '',
								'PRODUCT_ID' => isset($data['T_3']['id']) ? $data['T_3']['id'] : '',
								'OFFER_START_DATE' => date ( 'Y-m-d H:i:s' ),
								'OFFER_END_DATE' => $endDate,
								'DESCRIPTION' => $data['T_5'],
								'STATUS' => 'active',

								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Saved Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['list'] = $UserdashboardModel->getAllUserHomeOfferSectionData();
				echo json_encode ( $arrRes );
				die ();

			} else {

				$result = DB::table ( 'jb_user_home_offer_section_tbl' ) ->where ( 'OFFER_ID', $data ['ID'] ) ->update (
						array ( 'OFFER_TITLE' => $data['T_1'],
								'CATEGORY_ID' => isset($data['T_2']['id']) ? $data['T_2']['id'] : '',
								'PRODUCT_ID' => isset($data['T_3']['id']) ? $data['T_3']['id'] : '',
								'OFFER_START_DATE' => date ( 'Y-m-d H:i:s' ),
								'OFFER_END_DATE' => $endDate,
								'DESCRIPTION' => $data['T_5'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['list'] = $UserdashboardModel->getAllUserHomeOfferSectionData();
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editOfferRecord() {
		$UserdashboardModel = new UserdashboardModel();
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();

		$details = $_REQUEST ['details'];
		$offerId = $details ['offerId'];
		$userId = $details ['userId'];

		$arrRes ['details'] = $UserdashboardModel->getSpecificTodayOfferRecordById($offerId);

		$categoryId = isset($arrRes ['details']['T_2']) ? $arrRes ['details']['T_2'] : '';

		$subCatIds = $CategoryModel->getAllSubCategoryIdsWrtCategoryId($categoryId);

		$subSubCatIds = $CategoryModel->getAllSubSubCategoryIdsWrtSubCategoryId($subCatIds);

		$arrRes ['productLov'] = $ProductModel->getProductsLovWrtCatSubCatSubSubCatIds($categoryId,$subCatIds,$subSubCatIds);


		echo json_encode ( $arrRes );
	}

	public function deleteOfferRecord(Request $request) {
		$UserdashboardModel = new UserdashboardModel();

		$details = $_REQUEST ['details'];
		$offerId = $details ['offerId'];
		$userId = $details ['userId'];

		$delete = DB::table ( 'jb_user_home_offer_section_tbl' )->where ( 'OFFER_ID', $offerId )->delete ();

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Record deleted successfully...';
		$arrRes ['list'] = $UserdashboardModel->getAllUserHomeOfferSectionData();

		echo json_encode ( $arrRes );
	}
	/*===================== admin home user page crud code end =========================*/


	public function getAllAdminUserSubscriptionslov() {
		$SubscriptionModel = new SubscriptionModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $SubscriptionModel->getAllAdminUserSubscriptionsForAdmin($userId);

		echo json_encode ( $arrRes );
	}
	public function getSpecificAdminUserSubscriptionDetail() {
		$SubscriptionModel = new SubscriptionModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$subsId = $details ['subsId'];

		$arrRes ['detail'] = $SubscriptionModel->getSpecificUserSubscriptionDetails($subsId);

		echo json_encode ( $arrRes );
	}

	public function getAllAdminUserTicketslov() {
		$TicketsModel = new TicketsModel();
		$OrderModel = new OrderModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
		$arrRes ['orders'] = $OrderModel->getOrdersLov($userId);

		echo json_encode ( $arrRes );
	}

	public function saveAdminTicketDetails(Request $request) {
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

			// 	$temp = explode('#', $data ['T_2']);

			// 	$orderDetail = $OrderModel->validateOrderById(isset($temp[1])?$temp[1]:'');

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
				$arrRes ['msg'] = 'Phone number must be between 11 to 14 digits.';
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
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

				$EmailForwardModel->sendEmail($email_details);

				$email_details['to_id'] = '';
				$email_details['to_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $data ['T_4'];//useremail
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "TICKET";
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

				$EmailForwardModel->sendEmail($email_details);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ticket Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
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
				$arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function changeAdminTicketStatus(Request $request) {
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
		$arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();

		echo json_encode ( $arrRes );

	}
	public function getSpecificAdminTicketDetails() {
		$TicketsModel = new TicketsModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ticketId = $details ['ticketId'];

		$arrRes ['details'] = $TicketsModel->getSpecificTicketDetail($ticketId);
		$arrRes ['replies'] = $TicketsModel->getSpecificTicketReplies($ticketId);
		$arrRes ['images'] = $TicketsModel->getTicketAttachments($ticketId);

		echo json_encode ( $arrRes );
	}
	public function deleteTicketDetails(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_user_tickets_tbl' )->where( 'TICKET_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'Ticket delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}
	public function saveAdminTicketReplyDetail(Request $request) {
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
							'USER_TYPE' => 'admin',
							'DATE' => date ( 'Y-m-d H:i:s' ),
							'CREATED_BY' => $userId,
							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					     ));

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

	public function getAllAdminPaymentslov() {
		$OrderPaymentModel = new OrderPaymentModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['payments'] = $OrderPaymentModel->getAllOrderPaymentData();

		echo json_encode ( $arrRes );
	}
	public function getSpecificAdminPaymentDetail() {
		$OrderPaymentModel = new OrderPaymentModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$paymentId = $details ['paymentId'];

		$arrRes ['details'] = $OrderPaymentModel->getSpecficOrderPaymentData($paymentId);

		echo json_encode ( $arrRes );
	}

	public function getAllAdminGivings() {
		$givingsModel = new GivingModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['givings'] = $givingsModel->getAllAdminGivingsData();

		echo json_encode ( $arrRes );
	}
	public function getSpecificAdminGivingDetail() {
		$givingsModel = new GivingModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$givingId = $details ['givingId'];

		$arrRes ['details'] = $givingsModel->getSpecificAdminGivingDetailData($givingId);

		echo json_encode ( $arrRes );
	}
	public function getAllAdminNewslatterlov() {
		$FooterSubscriptionModel = new FooterSubscriptionModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $FooterSubscriptionModel->getAllSubscriptionForAdmin();

		echo json_encode ( $arrRes );
	}
	public function getAllAdminSnapSelfielov() {
		$ShadeFinderSelfieModel = new ShadeFinderSelfieModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $ShadeFinderSelfieModel->getAllShadeFinderSelfieForAdmin();

		echo json_encode ( $arrRes );
	}

	public function deleteSelfieDetails(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_shade_finder_selfie_tbl' )->where( 'SELFIE_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'Selfi delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}

	public function getAllAdminEmaillov() {
		$EmailForwardModel = new EmailForwardModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $EmailForwardModel->getAllEmailsData();

		echo json_encode ( $arrRes );
	}

	public function deleteAdminSentEmail(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'sys_email_tbl' )->where( 'EMAIL_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'E-mail delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}


	public function deleteCategoryRecord(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();

		$details = $_REQUEST ['details'];
		$categoryId = $details ['recordId'];
		$userId = $details ['userId'];


		$result = DB::table('jb_product_tbl')->where('IS_DELETED',0 )->where('CATEGORY_ID', $categoryId)->pluck('NAME');

		if(count($result) > 0){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'This Category is added in Products';
			$arrRes ['product_data'] = $result;

			echo json_encode ( $arrRes );
			die();

		}

		$subCatArray = $CategoryModel->getAllSubCategoryIdsWrtCategoryIdCaseDelete($categoryId);
		$subSubCatArray = $CategoryModel->getAllSubSubCategoryIdsWrtCategoryIdCaseDelete($subCatArray != null ? $subCatArray : array());

		if(isset($subSubCatArray) && count($subSubCatArray) > 0){
			foreach ($subSubCatArray as $subSubCatArrayList) {
				DB::table ( 'jb_sub_sub_category_tbl' )->where('SUB_SUB_CATEGORY_ID', $subSubCatArrayList)->delete();
			}
		}

		if(isset($subCatArray) && count($subCatArray) > 0){
			foreach ($subCatArray as $subCatArrayList) {
				DB::table('jb_sub_category_tbl')->where('SUB_CATEGORY_ID', $subCatArrayList)->delete();
			}
		}

		DB::table ( 'jb_category_tbl' )->where( 'CATEGORY_ID', $categoryId )->delete();

		//  $existCheckSubCategory = $CategoryModel->checkSubCategoryExistWrtCategory($categoryId);


		// if($existCheckSubCategory == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Sub Categories exist against this category, kindly remove sub categories then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		// $existCheckProduct = $ProductModel->checkProductExistWrtCategoryId($categoryId, '1');

		// if($existCheckProduct == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Products exist against this category, kindly remove products then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		// $delete = DB::table ( 'jb_category_tbl' )->where ( 'CATEGORY_ID', $categoryId )->delete ();

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Category deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function deleteSubCategoryRecord(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();

		$details = $_REQUEST ['details'];
		$categoryId = $details ['recordId'];
		$userId = $details ['userId'];

		$existCheckSubCategory = $CategoryModel->checkSubSubCategoryExistWrtCategory($categoryId);

		if($existCheckSubCategory == true){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Sub Sub Categories exist against this sub category, kindly remove sub sub categories then proceed.';
			echo json_encode ( $arrRes );
			die();
		}

		$existCheckProduct = $ProductModel->checkProductExistWrtCategoryId($categoryId, '2');

		if($existCheckProduct == true){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Products exist against this sub category, kindly remove products then proceed.';
			echo json_encode ( $arrRes );
			die();
		}

		$delete = DB::table ( 'jb_sub_category_tbl' )->where ( 'SUB_CATEGORY_ID', $categoryId )->delete ();

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Sub Category deleted successfully...';

		echo json_encode ( $arrRes );
	}
	public function deleteSubSubCategoryRecord(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();

		$details = $_REQUEST ['details'];


		$categoryId = $details ['recordId'];
		$userId = $details ['userId'];
		$proCatepara = $details ['proCatepara'];

		if($proCatepara == '3'){

			DB::table('jb_product_tbl')->where( 'SUB_SUB_CATEGORY_ID', $categoryId )->update(
				array(
					'SUB_SUB_CATEGORY_ID' => NULL,
				)
			);

			DB::table('jb_sub_sub_category_tbl')->where( 'SUB_SUB_CATEGORY_ID', $categoryId )->delete();


			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Sub Sub Category deleted successfully...';

			echo json_encode ( $arrRes );
			die();


		}else {
			// dd('no');

			// $result = DB::table('jb_product_tbl')->where('SUB_CATEGORY_ID', $categoryId)->get();

			// dd($result);



			DB::table ( 'jb_product_tbl' )->where( 'SUB_CATEGORY_ID', $categoryId )->update(
				array(
					'SUB_CATEGORY_ID' => NULL,
					'SUB_SUB_CATEGORY_ID' => NULL
				)
			);

			DB::table('jb_sub_sub_category_tbl')->where('SUB_CATEGORY_ID', $categoryId)->delete();

			DB::table('jb_sub_category_tbl')->where('SUB_CATEGORY_ID', $categoryId )->delete();

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Sub Category deleted successfully...';

			echo json_encode ( $arrRes );
			die();


		}

// 		$result = DB::table ( 'jb_product_tbl' )->where( 'SUB_SUB_CATEGORY_ID', $categoryId )->get();
// 		dd($result);


		// $existCheckProduct = $ProductModel->checkProductExistWrtCategoryId($categoryId, '3');



		// if($existCheckProduct == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Products exist against this sub sub category, kindly remove products then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		// $delete =

		// $arrRes ['done'] = true;
		// $arrRes ['msg'] = 'Sub Sub Category deleted successfully...';

		// echo json_encode ( $arrRes );
	}

	public function changeStatusProduct(Request $request) {
		$ProductModel = new ProductModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$productDetail = $ProductModel->getSpecificProductStatus($recordId);

		if(isset($productDetail['STATUS']) && $productDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Product active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Product Inactive successfully...';
		}

		$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );

	}

	public function deleteSpecificProduct(Request $request) {
		// $ProductModel = new ProductModel();
		// $OrderModel = new OrderModel();
		// $SubscriptionModel = new SubscriptionModel();
		// $UserdashboardModel = new UserdashboardModel();
		// $BundleProductLineModel = new BundleProductLineModel();

		$details = $_REQUEST ['details'];
		$productId = $details ['recordId'];
		$userId = $details ['userId'];

		// $existCheckBundle = $BundleProductLineModel->checkProductBundleWrtProductId($productId);
		$result_jb_bundle_product_line_tbl = DB::table('jb_bundle_product_line_tbl as a')->select('a.*') ->where('a.PRODUCT_ID', $productId) ->get();

		if(sizeof($result_jb_bundle_product_line_tbl) != null){
			DB::table('jb_bundle_product_line_tbl')->where('PRODUCT_ID', $productId) ->delete();
		}

		// if($existCheckBundle == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'This product is link with  Bundle, kindly unlink product then proceed, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		//$existCheckOrder = $OrderModel->checkOrderProductExistWrtProductId($productId);

		// if($existCheckOrder == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Order exist against this product, system will not able to delete this product, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		// $existCheckSubscription = $SubscriptionModel->checkSubscribedProductExistWrtProductId($productId);

		// if($existCheckSubscription == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Subscription exist against this product, system will not able to delete this product, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		//  $existCheckTrendForyou = $UserdashboardModel->checkTrendingForyouExistWrtProductId($productId);

		// if($existCheckTrendForyou == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = "This product is link with Trending / For You section, kindly unlink product then proceed, Thanks.";
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		$result_jb_user_home_product_section_tbl = DB::table('jb_user_home_product_section_tbl as a')
													->where('a.PRODUCT_ID', $productId)
													->get();

		if(sizeof($result_jb_user_home_product_section_tbl) != null){
			DB::table('jb_user_home_product_section_tbl')
				->where('PRODUCT_ID', $productId)
				->delete();
		}
		// dd($result_jb_user_home_product_section_tbl);


		// $existCheckTodayOffer = $UserdashboardModel->checkTodayOfferExistWrtProductId($productId);

		// if($existCheckTodayOffer == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'This product is link with  Today Offer section, kindly unlink product then proceed, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		// $existCheckOnlineExc = $UserdashboardModel->checkOnlineExcExistWrtProductId($productId);

		// if($existCheckOnlineExc == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'This product is link with  Best Seller / Online Exclusive section, kindly unlink product then proceed, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		$result_jb_user_home_bestexclusive_tbl = DB::table('jb_user_home_bestexclusive_tbl as a')->select('a.*')
												->where('a.PRODUCT_ID', $productId)
												->get();

		if(sizeof($result_jb_user_home_bestexclusive_tbl) != null){

			DB::table('jb_user_home_bestexclusive_tbl')->where('PRODUCT_ID', $productId)->delete();
		}

		// $productAtt = $ProductModel->getSpecificProductImages($productId);

		DB::table ( 'jb_product_tbl' )->where ( 'PRODUCT_ID', $productId )->update (
			array ( 'IS_DELETED' => 1,
					'STATUS' => 'inactive',
					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			)
		);
		DB::table ( 'jb_user_wishlist_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productImageDelete = DB::table ( 'jb_product_images_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();

		// if(isset($productAtt) && !empty($productAtt)){
		// 	foreach ($productAtt as $value){
		// 		unlink($value['path']);
		// 	}
		// }

		// $productVideoDelete = DB::table ( 'jb_product_video_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productUsesDelete = DB::table ( 'jb_product_video_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productIngredientDelete = DB::table ( 'jb_product_ingredient_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productShadesDelete = DB::table ( 'jb_product_shades_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productShopingCartDelete = DB::table ( 'jb_shopping_cart_detail_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productReviewsDelete = DB::table ( 'jb_reviews_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productQuestionDelete = DB::table ( 'jb_questions_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();


		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product deleted successfully...';

		echo json_encode ( $arrRes );
	}


	public function changeStatusBundle(Request $request) {
		$BundleProductModel = new BundleProductModel();
		$BundleLine = new BundleProductLineModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$bundleDetail = $BundleProductModel->getSpecificBundleStatus($recordId);
		$checkSingleBundleProducts = $BundleLine->getAllBundleProductLines($recordId);

		if(isset($bundleDetail['STATUS']) && $bundleDetail['STATUS'] != 'active'){


			if($checkSingleBundleProducts != null){

				$status = 'active';
				$arrRes ['msg'] = 'Bundle active successfully...';

				DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $recordId ) ->update (
					array ( 'STATUS' => $status,
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
					$arrRes ['done'] = true;
			}else{

				$arrRes ['msg'] = 'Please Add one or more products';
				$arrRes ['done'] = false;
			}


		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Bundle Inactive successfully...';

			DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
				$arrRes ['done'] = true;
		}

		echo json_encode ( $arrRes );

	}

	public function deleteSpecificBundle(Request $request) {
		// $ProductModel = new ProductModel();
		// $OrderModel = new OrderModel();
		// $SubscriptionModel = new SubscriptionModel();
		// $UserdashboardModel = new UserdashboardModel();
		// $BundleProductModel = new BundleProductModel();
		// $BundleProductLineModel = new BundleProductLineModel();

		$details = $_REQUEST ['details'];

		$bundleId = $details ['recordId'];
		$userId = $details ['userId'];



		// $existCheckOrder = $OrderModel->checkOrderBundleExistWrtBundleId($bundleId);

		// if($existCheckOrder == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Order exist against this bundle, system will not able to delete this bundle, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		// $existCheckSubscription = $SubscriptionModel->checkSubscribedBundleExistWrtBundleId($bundleId);

		// if($existCheckSubscription == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Subscription exist against this bundle, system will not able to delete this bundle, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }



		// $bundleDetail = $BundleProductModel->getSpecificBundleProductData($bundleId);

		// $productDelete =
		DB::table ( 'jb_bundle_product_tbl' )->where ( 'BUNDLE_ID', $bundleId )->update (
			array(
				'IS_DELETED' => 1,
				'STATUS' => 'inactive'

			)
		);
		// $productVideoDelete = DB::table ( 'jb_bundle_product_line_tbl' )->where ( 'BUNDLE_ID', $bundleId )->delete ();

		// if(isset($bundleDetail['path']) && !empty($bundleDetail['path'])){
		// 	unlink($bundleDetail['path']);
		// }


		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Bundle deleted successfully...';

		echo json_encode ( $arrRes );
	}

	public function getAllAdminEmailConfiglov() {
		$EmailConfigModel = new EmailConfigModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['list'] = $EmailConfigModel->getAllEmailConfigData();

		echo json_encode ( $arrRes );
	}
	public function editEmailConfigDetails() {
		$EmailConfigModel = new EmailConfigModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$emailConfigId = $details ['recordId'];

		$arrRes ['detail'] = $EmailConfigModel->getSpecificEmailConfigDetail($emailConfigId);

		echo json_encode ( $arrRes );
	}

	public function saveEmailConfigDetails() {
		$EmailConfigModel = new EmailConfigModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$data = $details ['email'];


		if (isset ( $data ) && ! empty ( $data )) {

			if ($data ['A_1'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['A_1']) > 100) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['A_2'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subject is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['A_2']) > 100) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subject must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['A_3'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'From Email is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['A_3'] != '') {
				if (! filter_var ( $data ['A_3'], FILTER_VALIDATE_EMAIL )) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Please enter valid Email Address.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if (strlen($data ['A_3']) > 100) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'From Email must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}



			if ($data ['ID'] == '') {

			} else {

				$result = DB::table ( 'sys_email_config_tbl' ) ->where ( 'EMAIL_CONFIG_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['A_1'],
								'SUBJECT' => $data['A_2'],
								'FROM_EMAIL' => $data['A_3'],
								'MESSAGE' => base64_encode($data['A_4']),

								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);

				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Email Settings Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}else{
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Something went wrong';

			echo json_encode ( $arrRes );
		}

	}

	public function getAllAdminWebsiteUserslov() {
		$UserModel = new UserModel();

		// $details = $_REQUEST ['details'];
		// $userId = $details ['userId'];

		$arrRes ['list'] = $UserModel->getAllWebsiteUserData();

		echo json_encode ( $arrRes );
	}

	public function changeStatusWebsiteUser(Request $request) {
		$UserModel = new UserModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$userDetail = $UserModel->getSpecificUserDetail($recordId);

		if(isset($userDetail['status']) && $userDetail['status'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'User Active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'User Inactive successfully...';
		}

		$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $recordId ) ->update (
				array ( 'USER_STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );

	}


	public function getAllAdminProfilelov() {

		$UserModel = new UserModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];

		$arrRes ['detail'] = $UserModel->getSpecificUserDetail($userId);

		echo json_encode ( $arrRes );
	}

	public function getSpecificUserShadeNameDetailsAdmin()  {
		$OrderDetailModel = new OrderDetailModel();

		$details = $_REQUEST ['details'];
   		$orderLineId = $details ['orderLineId'];

		$arrRes ['shadename'] = $OrderDetailModel->getOrderLineProductShadesNameDetail($orderLineId);

		echo json_encode ( $arrRes );

	}

	public function updateAdminProfile(Request $r){
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
			if ($data['A_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Phone Number is required.';
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
            $result = User::where('USER_ID',$data ['ID'])->first();
            // dd($result);
            // session()->put('userId', $result->USER_ID);
            // session()->put('userName', $result->USER_NAME);
            // session()->put('firstName', $result->FIRST_NAME);
            // session()->put('lastName', $result->LAST_NAME);
            // session()->put('userType', $result->USER_TYPE);
            // session()->put('email', $result->EMAIL);
            // session()->put('userSubType', $result->USER_SUBTYPE);
            $_SESSION['userId'] = $result->USER_ID;
            // $_SESSION['userName'] = $result->USER_NAME;
            $_SESSION['firstName'] = $result->FIRST_NAME;
            $_SESSION['lastName'] = $result->LAST_NAME;
            $_SESSION['email'] = $result->EMAIL;

            // $_SESSION['lastName'] = $data ['A_2'];
            // dd($_SESSION['lastName']);
            // Session::put('firstName', $data ['A_1']);
			$arrRes['done'] = true;
			$arrRes['msg'] = 'Admin profile updated successfully...';
			echo json_encode ( $arrRes );
			die ();

		}
	}

	public function updateAdminPassword(Request $r){
		$UserModel=new UserModel();

		$detail=$_REQUEST['details'];
		$userId=$detail['userId'];
		$data=$detail['password'];

		if (isset ( $data ) && ! empty ( $data )) {
			if ($data['C_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Current Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			$userdetails = $UserModel->getspecificUserPasswordByUserId($userId);

			if($userdetails['ENCRYPTED_PASSWORD'] != $data['C_1']){
				$arrRes['done'] = false;
				$arrRes['msg'] = 'Current Password is incorrect.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['C_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'New Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['C_2']) < 8) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'New Password must be minimum 8 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['C_3'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Confirm New Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['C_2'] != $data['C_3']) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Confirm Password is not match with New Password.';
				echo json_encode ( $arrRes );
				die ();
			}
            if ($userdetails['ENCRYPTED_PASSWORD'] == $data['C_2'] || $userdetails['ENCRYPTED_PASSWORD'] == $data['C_3']) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Your New Password Must be Different from Current Password. Try Different.';
				echo json_encode ( $arrRes );
				die ();
			}


			$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $userId ) ->update (
					array ( 'ENCRYPTED_PASSWORD' => $data ['C_2'],

							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);

			$arrRes['done'] = true;
			$arrRes['msg'] = 'Admin Password is updated...';
			echo json_encode ( $arrRes );
			die ();

		}
	}
	public function getSpecificWebsiteUserDetails() {
		$UserModel = new UserModel();

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$arrRes ['detail'] = $UserModel->getSpecificUserDetail($recordId);

		echo json_encode ( $arrRes );
	}

	public function getAllRoutineTypes(){

		$TypeName =new TypeName();

		$results['getAllRoutineType']=$TypeName->getAllRoutineTypes();
		$results['routinetypenamelov']=$TypeName->getallroutinetypelov();

		echo json_encode ( $results );

	}

	public function getMostSaledItems(){

			$OrderDetailModel = new OrderDetailModel();
			$result [ 'mostSaleItems' ] = $OrderDetailModel->mostSaleItems();

			echo json_encode($result);
	}

	public function adminUsers(){
		$User = new User();
		$data['page'] = 'Admin Users';
		$data['adminMenu'] = $this->getAdminUserMenu();
		// $result=$this->checkUserControlAccess(session('userId'),"/admin-users");
		// if( $result != true) {
		// 	return view('admin.admin-users')->with($data);
		// }else{
		// 	redirect('/dashboard');
		// }
		return view('admin.admin-users')->with($data);
	}

	public function getAllAdminUserslov(Request $request){

		$User = new User();

		$arrRes['allAdminUsers'] = $User->getAllAdminUsersWRTSubUsers(session('userId'));

		echo json_encode($arrRes);
	}

	public function saveAdminUser( Request $request){

			$details = $_REQUEST ['details'];
			$userid = $details['updateduserId'];
			$UserMenuControl = new UserMenuControlModel();
            //validating the Input Fields

            if ($details['user']['FirstName'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'First Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($details['user']['LastName'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Last Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($details['user']['UserRole'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'User Role is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($details['user']['PhoneNumber'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Phone Number is required.';
				echo json_encode ( $arrRes );
				die ();
			}
            // Phone number validation
			if (!preg_match('/^[+]?[1-9][0-9]{11,14}$/',$details['user']['PhoneNumber'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Phone Number Must Be Between 11 to 14';
				echo json_encode ( $arrRes );
				die ();
			}
            $checkduplicatephone = $UserMenuControl->checkPhoneNumberExists($details['user']['PhoneNumber'],$userid);

            if($checkduplicatephone == false){

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Phone Number must be unique';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($details['user']['EmailAddress'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Email Address is required.';
				echo json_encode ( $arrRes );
				die ();
			}

            // Email validation
			if (!filter_var($details['user']['EmailAddress'], FILTER_VALIDATE_EMAIL)) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Invalid Email Format';
				echo json_encode ( $arrRes );
				die ();
			}
			$checkduplicateemail = $UserMenuControl->checkEmailAddressExists($details['user']['EmailAddress'],$userid);

			if($checkduplicateemail == false){

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Email Address must be unique';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($details['user']['Password'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			if (strlen($details['user']['Password']) < 8) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Password must be equal to or greater then 8 characters';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($details['user']['ConfirmPassword'] == '') {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Confirm Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			if ($details['user']['ConfirmPassword'] != $details['user']['Password']) {

				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Passwords do not match.';
				echo json_encode ( $arrRes );
				die ();
			}









		// $arrRes = $UserMenuControl->saveAdminUser($details);

		$details = $_REQUEST['details'];
		$updateduserId = $details['updateduserId'];

		$enable = '';

        if($details['user']['Enable'] == "true") {
            $enable = 'active';
        }else{
            $enable = 'inactive';
        }

		//Updating the Record
		if($updateduserId != null){

			$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $updateduserId ) ->update (
				array (  'FIRST_NAME' => $details['user']['FirstName'] ,
                         'LAST_NAME' => $details['user']['LastName'] ,
                         'USER_ROLE' => $details['user']['UserRole'],
                         'PHONE_NUMBER' => $details['user']['PhoneNumber'],
                         'EMAIL' => $details['user']['EmailAddress'],
                         'ENCRYPTED_PASSWORD' => $details['user']['Password'],
                         'USER_ROLE'=> $details['user']['UserRole'],
						 'USER_STATUS' => $enable ,
			           ));

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Admin User Updated Successfully';
			$arrRes ['id'] = $updateduserId;
			echo json_encode($arrRes) ;
			die();

		}else{

        $arrRes = array();
        $UserName = $details['user']['FirstName'] . $details['user']['LastName'] . rand(10,10000) ;
        $enable = '';

        if($details['user']['Enable'] == true) {
            $enable = 'active';
        }else{
            $enable = 'inactive';
        }

        $record = array (
            'FIRST_NAME' => $details['user']['FirstName'] ,
            'LAST_NAME' => $details['user']['LastName'] ,
            'USER_ROLE' => $details['user']['UserRole'],
            'PHONE_NUMBER' => $details['user']['PhoneNumber'],
            'EMAIL' => $details['user']['EmailAddress'],
            'USER_NAME' => $UserName,
            'ENCRYPTED_PASSWORD' => $details['user']['Password'],
            'USER_TYPE' => 'admin',
            'USER_SUBTYPE' => 'subadmin',
            'USER_ROLE'=> $details['user']['UserRole'],
            'USER_STATUS' => $enable ,
            'CREATED_ON' => date ( 'Y-m-d H:i:s' )
        );

		//Inserting the Record
	    $result = DB::table ( 'fnd_user_tbl' )->insertGetId( $record );
        $arrRes ['id'] = $result;
		$arrRes['done'] = true;
		$arrRes['msg'] = 'Admin User Created Successfully';

		echo json_encode($arrRes);

	}
	}

	public function deleteSpecificAdmin(Request $request){

		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];

		$UserMenuControl = new UserMenuControlModel();
		$status = $UserMenuControl->deleteSpecificAdmin($recordId);
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Admin deleted successfully...';

		echo json_encode($arrRes);

	}

	public function changeStatusAdmin(Request $request){

		$UserMenuControl = new UserMenuControlModel();
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];

		$AdminDetail = $UserMenuControl->getSpecificAdminStatus($recordId);

		if($AdminDetail->USER_STATUS != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Admin active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Admin Inactive successfully...';
		}

		$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $recordId ) ->update (
				array ( 'USER_STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );

	}

	public function editAdminUser(Request $request){

		$UserMenuControl = new UserMenuControlModel();
		$userId = $_REQUEST ['details'];

		$arrRes['AdminDetail'] = $UserMenuControl->getAdminUserDetails($userId);

		$arrRes['getAdminControlOptions'] = $UserMenuControl->getAdminControlOptions($userId);

		echo json_encode ($arrRes);

	}

	// public function saveEditAdminUser(Request $request){

	// 	$User=new User();
	// 	$details = $_REQUEST ['details'];

	// 	$userId = $_REQUEST ['details'];
	// 	$name = $details['name'];
	// 	$email = $details['name'];
	// 	$password = $details['name'];

	// 	$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $userId ) ->update (
	// 			array ( 'USER_NAME' => $name,
	// 					'EMAIL' => $email,
	// 					'ENCRYPTED_PASSWORD' => $password,
	// 					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
	// 			)
	// 			);

	// 	$arrRes ['done'] = true;

	// 	echo json_encode ( $result );
	// }

	public function getAllNavLinksLov(Request $request){

		$UserMenuControl = new UserMenuControlModel();

		$arrRes['allNavLinks'] = $UserMenuControl->getAllNavLinks();

		echo json_encode($arrRes);
	}

	public function menuControlOptions(){

		$details = $_REQUEST['details'];
		$optionsSelected = $details['selected_options'];
		$userId = $details['userId'];

		$UserMenuControl =new UserMenuControlModel();

		//Delete if the user exists in fnd_user_control_tbl
		$status = $UserMenuControl->deleteControlledUser($userId);

		//Granting Access to User
		// print_r('<pre>');

		// print_r($optionsSelected);
		// exit();
		$grantAccessPermission = $UserMenuControl->grantUserControl($optionsSelected);

		for($i=0 ;$i<count($grantAccessPermission); $i++){

			$result = DB::table('fnd_user_menu_control_tbl')
					->insert (
					array (
						 'USER_ID' => $userId,
						 'MENU_ID' => $grantAccessPermission[$i]->MENU_ID,
						 'SEQUENCE_NUMBER' => $grantAccessPermission[$i]->SEQUENCE_NUMBER ,
                         'MENU_NAME' => $grantAccessPermission[$i]->MENU_NAME ,
                         'MENU_DESCRIPTION' => $grantAccessPermission[$i]->MENU_DESCRIPTION,
                         'MENU_TYPE' => $grantAccessPermission[$i]->MENU_TYPE,
                         'SYSTEM_CALL' => $grantAccessPermission[$i]->SYSTEM_CALL,
                         'MENU_ICON' => $grantAccessPermission[$i]->MENU_ICON,
                         'ENABLE_FLAG'=> $grantAccessPermission[$i]->ENABLE_FLAG,
						 'CREATED_ON'=> date ( 'Y-m-d H:i:s' )
			           ));
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Menu Control Assigned successfully...';

		echo json_encode ( $arrRes );
	}

	public function checkUserControlAccess($user_id,$path){

		$UserMenuControl = new UserdashboardModel();
		$res=$UserMenuControl->checkUserAccessStatus($user_id,$path);
		return $res;

	}


}
