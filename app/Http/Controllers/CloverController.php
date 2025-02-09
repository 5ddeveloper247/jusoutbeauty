<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ShadeFinderModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ShadesModel;
use App\Models\ProductIngredientModel;
use App\Models\ProductUsesModel;
use App\Models\ReviewsModel;
use App\Models\QuestionModel;
use App\Models\ShoppingcartModel;
use App\Models\CountryModel;
use App\Models\BundleProductModel;
use App\Models\BundleProductLineModel;
use App\Models\ProductShadeModel;
use App\Models\SubscriptionModel;
use App\Models\WishlistModel;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\OrderShippingModel;
use App\Models\OrderPaymentModel;
use App\Models\OrderShipmentModel;
use App\Models\OrderShadeDetailModel;
use App\Models\TicketsModel;
use App\Models\UserdashboardModel;
use App\Models\PaymentMethodCredentialModel;
use App\Models\EmailForwardModel;
use App\Models\EmailConfigModel;
use DateTime;
use Session;

class CloverController extends Controller
{

    public function makePayment(Request $request, $type = '',$response = false)
    {
        // dd('hello');
        $post=$request->all();
        // dd($post);
        $post['currency'] = 'USD';
        $post['source'] = $_POST['cloverToken'];
        $post['type'] = isset($_POST['paymentType']) ? $_POST['paymentType'] : '';

        if($post['type'] == 'checkout'){

        	$checkoutDetails['cloverToken'] = isset($_POST['cloverToken']) ? $_POST['cloverToken'] : '';
        	$checkoutDetails['paymentType'] = isset($_POST['paymentType']) ? $_POST['paymentType'] : '';
        	$checkoutDetails['userId'] = isset($_POST['userId']) ? $_POST['userId'] : '';
        	$checkoutDetails['cartId'] = isset($_POST['cartId']) ? $_POST['cartId'] : '';
        	$checkoutDetails['S_1'] = isset($_POST['S_1']) ? $_POST['S_1'] : '';
        	$checkoutDetails['S_2'] = isset($_POST['S_2']) ? $_POST['S_2'] : '';
        	$checkoutDetails['S_3'] = isset($_POST['S_3']) ? $_POST['S_3'] : '';
        	$checkoutDetails['S_4'] = isset($_POST['S_4']) ? $_POST['S_4'] : '';
        	$checkoutDetails['S_5'] = isset($_POST['S_5']) ? $_POST['S_5'] : '';
        	$checkoutDetails['S_6'] = isset($_POST['S_6']) ? $_POST['S_6'] : '';
        	$checkoutDetails['S_7'] = isset($_POST['S_7']) ? $_POST['S_7'] : '';
        	$checkoutDetails['S_8'] = isset($_POST['S_8']) ? $_POST['S_8'] : '';
        	$checkoutDetails['S_9'] = isset($_POST['S_9']) ? $_POST['S_9'] : '';
        	$checkoutDetails['S_10'] = isset($_POST['S_10']) ? $_POST['S_10'] : '';
        	$checkoutDetails['S_11'] = isset($_POST['S_11']) ? $_POST['S_11'] : '';

        }else if($post['type'] == 'subscription'){

        	$subsDetails['paymentType'] = isset($_POST['paymentType']) ? $_POST['paymentType'] : '';
        	$subsDetails['userId'] = isset($_POST['userId']) ? $_POST['userId'] : '';
        	$subsDetails['subsId'] = isset($_POST['subsId']) ? $_POST['subsId'] : '';

        }else if($post['type'] == 'giving'){

        	$givingDetails['cloverToken'] = isset($_POST['cloverToken']) ? $_POST['cloverToken'] : '';
        	$givingDetails['paymentType'] = isset($_POST['paymentType']) ? $_POST['paymentType'] : '';
        	$givingDetails['userId'] = isset($_POST['userId']) ? $_POST['userId'] : '';
        	$givingDetails['G_1'] = isset($_POST['G_1']) ? $_POST['G_1'] : '';
        	$givingDetails['G_2'] = isset($_POST['G_2']) ? $_POST['G_2'] : '';
        	$givingDetails['G_3'] = isset($_POST['G_3']) ? $_POST['G_3'] : '';
        	$givingDetails['G_4'] = isset($_POST['G_4']) ? $_POST['G_4'] : '';

        }


        $clover_details = $this->getCloverConfig();

        $url= env('CLOVER_CHARGE_END_POINT');
        if($clover_details->is_test == 'true'){
            $url= env('CLOVER_CHARGE_END_POINT_TEST');
        }

            $post = json_encode($post);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $headers = [
                'accept: application/json',
                'authorization: Bearer '.$clover_details->access_token,
                'content-type: application/json',
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // execute!
            $getresponse = curl_exec($ch);

            // close the connection, release resources used
            curl_close($ch);

            // do anything you want with your response
            $response1=json_decode($getresponse);

            if(isset($response1->paid)){
//             	print_r('<pre>');
//             	print_r($response1);
//             	print_r('<pre>');
//             	print_r($checkoutDetails);
//             	exit();

            	if($_POST['paymentType'] == 'checkout'){
                    // dd('hello');
            		$this->saveCheckout($request,$checkoutDetails,$response1);
            		//return redirect('home');// for success case
					return redirect('success-message');
            	}else if($_POST['paymentType'] == 'subscription'){

            		$this->saveSubscription($request,$subsDetails,$response1);
            		return redirect('success-message-sub');// for success case
            	}else if($_POST['paymentType'] == 'giving'){

            		$this->saveGivings($request,$givingDetails,$response1);
            		return redirect('success-message-giving');// for success case
            	}
            }
            else
            {
                // dd('failed');
                return redirect('error-message');
            }
    }

    public function saveGivings(Request $request,$givingDetails,$response1){

    	$EmailForwardModel = new EmailForwardModel();
    	$EmailConfigModel = new EmailConfigModel;

    	$userId = $givingDetails['userId'];
    	$amount = $response1->amount/100;

    	$givingId = DB::table ( 'jb_giving_tbl' )->insertGetId (
    			array ( 'USER_ID' => $userId,
    					'USER_NAME' => $givingDetails['G_1'].' '.$givingDetails['G_2'],
    					'USER_EMAIL' => $givingDetails['G_3'],
    					'USER_PHONE' => $givingDetails['G_4'],
    					'AMOUNT' => $amount,
    					'PAYMENT_DATE' => date ( 'Y-m-d H:i:s' ),
    					'PAYMENT_TYPE' => 'clover',
    					'PAYMENT_STATUS' => 'paid',

    					'TRANSACTION_ID' => $response1->id,
    					'TRANSACTION_STATUS' => $response1->status,
    					'TRANSACTION_RESPONSE' => json_encode($response1),

    					'CREATED_BY' => $userId,
    					'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
    					'UPDATED_BY' => $userId,
    					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    			)
    		);

    	// to user email push
    	$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('GIVING REGARDS');

    	$htmlbody=	'<tr>
						<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
							<p>Dear '.$givingDetails['G_1'].',</p><br>
							'.$emailConfigDetails['message'].'
							<p>JusOut Beauty</p><br>
						</td>
	        		</tr>';


    	$email_details['to_id'] = session('userId');
    	$email_details['to_email'] = $givingDetails['G_3'];
    	$email_details['from_id'] = 1;
    	$email_details['from_email'] = $emailConfigDetails['fromEmail'];
    	$email_details['subject'] = $emailConfigDetails['subject'];
    	$email_details['message'] = "";
    	$email_details['logo'] = $emailConfigDetails['logo'];
    	$email_details['module_code'] = "GIVING REGARDS";
        $email_details['template'] = 'admin.emails.emailTemplate';
        $email_details['htmlbody'] = $htmlbody;
        $email_details['pageTitle'] = $emailConfigDetails['title'];

    	$EmailForwardModel->sendEmail($email_details);

    	// to admin email push
    	$emailConfigDetails1 = $EmailConfigModel->getSpecificEmailConfigByCode('GIVING ALERT');

    	$htmlbody1=	'<tr>
						<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
							<p>Hello admin,</p><br>
    						<p><b>'.$givingDetails['G_3'].'</b></p><br>
    						<p>you have received an ammount of '.$amount.' from '.$givingDetails['G_1'].'. For more information check your admin panel below</p>
							<br>
    						<p><a href="'.url('/admin').'">jusoutbeauty.com/</a></p>
    						<br>
							<p>Kind Regards, JusOut Beauty</p>
						</td>
	        		</tr>';

    	$email_details['to_id'] = 1;
    	$email_details['to_email'] = 'admin@jusoutbeauty.com';
    	$email_details['from_id'] = 1;
    	$email_details['from_email'] = "admin@jusoutbeauty.com";
    	$email_details['subject'] = 'Received Donation';
    	$email_details['message'] = "";
    	$email_details['logo'] = $emailConfigDetails['logo'];
    	$email_details['module_code'] = "GIVING ALERT";
        $email_details['template'] = 'admin.emails.emailTemplate';
        $email_details['htmlbody'] = $htmlbody1;
        $email_details['pageTitle'] = 'Received Donation';

    	$EmailForwardModel->sendEmail($email_details);

    	return true;
    }
    public function saveSubscription(Request $request,$subsDetails,$response1){

//     	$OrderModel = new OrderModel();
   		$OrderDetailModel = new OrderDetailModel();
   		$OrderShippingModel = new OrderShippingModel();
   		$OrderPaymentModel = new OrderPaymentModel();
   		$OrderShipmentModel = new OrderShipmentModel();
   		$SubscriptionModel = new SubscriptionModel();
   		$EmailForwardModel = new EmailForwardModel();
   		$EmailConfigModel = new EmailConfigModel;

    	$userId = $subsDetails['userId'];
    	$subsId = $subsDetails ['subsId'];

    	$subsDetail = $SubscriptionModel->getSpecificUserSubscriptionDetails($subsId);
    	$orderlineShades = $OrderDetailModel->getOrderLineProductShadesDetail($subsDetail['ORDER_LINE_ID']);
    	$shippingAddr = $OrderShippingModel->getAllSpecificOrderShippingData($subsDetail['ORDER_ID']);

    	$orderStatus = 'placed';

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

    	if(isset($subsDetail) && !empty($subsDetail)){

    		$orderLineId = DB::table ( 'jb_order_detail_tbl' )->insertGetId (
    				array ( 'ORDER_ID' => $orderId,
    						'PRODUCT_TYPE' => $subsDetail['PRODUCT_TYPE'],
    						'PRODUCT_ID' => $subsDetail['PRODUCT_ID'],
    						'BUNDLE_ID' => $subsDetail['BUNDLE_ID'],
    						'QUANTITY' => $subsDetail['QUANTITY'],
    						'UNIT_PRICE' => $subsDetail['UNIT_PRICE1'],
    						'TOTAL_AMOUNT' => $subsDetail['TOTAL_AMOUNT1'],

    						'VAT_PERCENT' => $subsDetail['VAT_PERCENT'],
    						'VAT_AMOUNT' => $subsDetail['VAT_AMOUNT'],
    						'DISCOUNT_AMOUNT' => $subsDetail['subsDiscount1'],
    						'TOTAL_AMOUNT_INC_VAT' => $subsDetail['IncVatTotalAmount1'],

    						'SUBSCRIPTION_CHECK' => 'One-Time Purchase',
    						'SUBSCRIPTION_ID' => '',

    						'CREATED_BY' => $userId,
    						'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
    						'UPDATED_BY' => $userId,
    						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    				)
    			);

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
    	}

    	$shippingAddrId = DB::table ( 'jb_order_shipping_address_tbl' )->insertGetId (
    			array ( 'USER_ID' => $userId,
    					'ORDER_ID' => $orderId,
    					'FIRST_NAME' => isset($shippingAddr ['FIRST_NAME']) ? $shippingAddr ['FIRST_NAME'] : '',
    					'LAST_NAME' => isset($shippingAddr ['LAST_NAME']) ? $shippingAddr ['LAST_NAME'] : '',
    					'ADDRESS' => isset($shippingAddr ['ADDRESS']) ? $shippingAddr ['ADDRESS'] : '',
    					'APT_SUITE' => isset($shippingAddr ['APT_SUITE']) ? $shippingAddr ['APT_SUITE'] : '',
    					'CITY' => isset($shippingAddr ['CITY']) ? $shippingAddr ['CITY'] : '',
    					'STATE' => isset($shippingAddr ['STATE']) ? $shippingAddr ['STATE'] : '',
    					'ZIP_CODE' => isset($shippingAddr ['ZIP_CODE']) ? $shippingAddr ['ZIP_CODE'] : '',
    					'COUNTRY_ID' => isset($shippingAddr ['COUNTRY_ID']) ? $shippingAddr ['COUNTRY_ID'] : '',
    					'EMAIL' => isset($shippingAddr ['EMAIL']) ? $shippingAddr ['EMAIL'] : '',
    					'PHONE_NUMBER' => isset($shippingAddr ['PHONE_NUMBER']) ? $shippingAddr ['PHONE_NUMBER'] : '',
    					'BILLING_ADDRESS_FLAG' => isset($shippingAddr ['BILLING_ADDRESS_FLAG']) ? $shippingAddr ['BILLING_ADDRESS_FLAG'] : '',

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
    					'PAYMENT_TYPE' => 'clover',
    					'CARD_NUMBER' => '',
    					'EXPIRY_MONTH' => '',
    					'EXPIRY_YEAR' => '',
    					'SECURITY_CODE' => '',
    					'PAYMENT_STATUS' => 'paid',
    					'TRANSACTION_ID' => $response1->id,
    					'TRANSACTION_STATUS' => $response1->status,
    					'TRANSACTION_RESPONSE' => json_encode($response1),

    					'DATE' => date ( 'Y-m-d H:i:s' ),
    					'CREATED_BY' => $userId,
    					'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
    					'UPDATED_BY' => $userId,
    					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    			)
    		);

    	// next subscription table

    	$subscrptionDetails = $SubscriptionModel->getSpecificSubscriptionData($subsDetail['SUBSCRIPTION_ID']);
        $htmlbody = '';
    	if(isset($subscrptionDetails) && !empty($subscrptionDetails)){

    		$subsMonths = $subscrptionDetails['S_7']; // duration months
    		$subscriptionDate = $subsDetail['SUBSCRIPTION_DATE1'];
    		$currentDate = date('Y-m-d');
    		$nextSubsDate = date ( "Y-m-d", strtotime ( "$currentDate +$subsMonths month" ) );

    		$result = DB::table ( 'jb_user_subscription_tbl' )->insertGetId (
    				array ( 'USER_ID' => $userId,
    						'SUBSCRIPTION_ID' => $subscrptionDetails['ID'],
    						'ORDER_LINE_ID' => $subsDetail['ORDER_LINE_ID'],//$orderLineId,
    						'PRODUCT_TYPE' => $subsDetail['PRODUCT_TYPE'],
    						'PRODUCT_ID' => $subsDetail['PRODUCT_ID'],
    						'BUNDLE_ID' => $subsDetail['BUNDLE_ID'],
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

    	$trackingId = DB::table ( 'jb_order_shippment_tracking_tbl' )->insertGetId (
    			array ( 'ORDER_ID' => $orderId,
    					'STATUS' => $orderStatus,
    					'DATE' => date ( 'Y-m-d H:i:s' ),
    					'CREATED_BY' => $userId,
    					'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
    					'UPDATED_BY' => $userId,
    					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    			)
    		);

    	$result = DB::table ( 'jb_user_subscription_tbl' ) ->where ( 'USER_SUBSCRIPTION_ID', $subsDetail['USER_SUBSCRIPTION_ID'] ) ->update (
    			array ( 'PAYMENT_STATUS' => 'paid',
    					'UPDATED_BY' => $userId,
    					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    			)
    		);

    	$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('SUBSCRIPTION');

    	$htmlbody=	'<tr>
						<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
							<p>Hello '.session("email").',</p><br>
							'.$emailConfigDetails['message'].'
						</td>
	        		</tr>';



                // if(!empty($subsDetail) ){
                // $sequence = 1;
                // foreach ($subsDetail as $value){

                // $productName = $value['NAME'];
                // $quantity = 2;

                // $htmlbody .='<tr style="min-height:22.5pt">
                //                         <td style="border:solid #dfe0e2 1.0pt;border-top:none;padding:2.25pt 1.5pt 2.25pt 15.0pt;min-height:22.5pt">
                //                             <p style="margin-bottom:6.0pt">
                //                                 <span style="font-size:8.5pt">'.$sequence.'</span>
                //                             </p>
                //                         </td>
                //                         <td style="border-top:none;border-left:none;border-bottom:solid #dfe0e2 1.0pt;border-right:solid #dfe0e2 1.0pt;padding:2.25pt 1.5pt 2.25pt 15.0pt;min-height:22.5pt">
                //                             <p style="margin-bottom:6.0pt">
                //                                 <span style="font-size:8.5pt">'.$productName.'</span>
                //                             </p>
                //                         </td>
                //                         <td style="border-top:none;border-left:none;border-bottom:solid #dfe0e2 1.0pt;border-right:solid #dfe0e2 1.0pt;padding:2.25pt 1.5pt 2.25pt 15.0pt;min-height:22.5pt">
                //                             <p style="margin-bottom:6.0pt">
                //                                 <span style="font-size:8.5pt">'.$quantity.'</span>
                //                             </p>
                //                         </td>
                //                     </tr>';
                // $sequence++;

                // }
// }

                      $htmlbody .='<tr>

                                  </tr>
                                  <tr>
                                         <td style="width:445.5pt;background:#f2f2f2;padding:0in 5.4pt 0in 5.4pt" colspan="8" valign="top" width="743">
                                      <p align="center">Copyright (c) 2020, VOKA USA. All rights reserved.</p>
                                  </td>
                              </tr>

                  </tbody>
              </table><div class="yj6qo"></div><div class="adL">
        </div></div></div> ';

    	$email_details['to_id'] = session('userId');
    	$email_details['to_email'] = session('email');
    	$email_details['from_id'] = 1;
    	$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
		$email_details['subject'] = $emailConfigDetails['subject'];
		$email_details['message'] = "";
		$email_details['logo'] = $emailConfigDetails['logo'];
    	$email_details['module_code'] = "SUBSCRIPTION_ORDER";
        $email_details['template'] = 'admin.emails.emailTemplate';
        $email_details['htmlbody'] = $htmlbody;
        $email_details['pageTitle'] = $emailConfigDetails['title'];

    	$EmailForwardModel->sendEmail($email_details);


        $email_details['to_id'] = 1;
    	$email_details['to_email'] = $emailConfigDetails['fromEmail'];
    	$email_details['from_id'] = 1;
    	$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
		$email_details['subject'] = $emailConfigDetails['subject'];
		$email_details['message'] = "";
		$email_details['logo'] = $emailConfigDetails['logo'];
    	$email_details['module_code'] = "SUBSCRIPTION_ORDER";
        $email_details['template'] = 'admin.emails.emailTemplate';
        $email_details['htmlbody'] = $htmlbody;
        $email_details['pageTitle'] = $emailConfigDetails['title'];

    	$EmailForwardModel->sendEmail($email_details);

    	return;
    }






















    public function saveCheckout(Request $request,$checkoutDetails,$response1){

    	$ShoppingcartModel = new ShoppingcartModel();
    	$SubscriptionModel = new SubscriptionModel();
    	$EmailForwardModel = new EmailForwardModel();
    	$EmailConfigModel = new EmailConfigModel;
    	$ProductModel = new ProductModel();
    	$BundleProductLineModel = new BundleProductLineModel();
    	$userId = $checkoutDetails['userId'];
    	$cartId = $checkoutDetails ['cartId'];
    	$shipping = $checkoutDetails;

    	$cart = $ShoppingcartModel->getSpecificCartDetails($cartId);
    	$cartDetails = $ShoppingcartModel->getSpecificCartLineForOrder($cartId);
	 

    	$orderStatus = 'placed';

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

    	if(isset($cartDetails) && !empty($cartDetails)){
    		foreach ($cartDetails as $line){

    			if($line['PRODUCT_TYPE'] == 'bundle'){

    				$bundleLines = $BundleProductLineModel->getAllBundleProductLinesForInvChk($line['BUNDLE_ID']);

    				if(!empty($bundleLines)){

    					foreach($bundleLines as $bundleLine){

    						$itemDetail = $ProductModel->getSpecificProductDetails($bundleLine['PRODUCT_ID']);

    						if($itemDetail['INV_QUANTITY_FLAG'] == 'shade'){

    							$cartLineShades = $ShoppingcartModel->getCartLineProductShadesDetailForInvChk($line['CART_LINE_ID']);

    							$newSlectShadeInvQty = $cartLineShades['shadeQuantity'] - $line['QUANTITY'];

    							$result = DB::table ( 'jb_product_shades_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $cartLineShades['PRODUCT_SHADE_ID'] ) ->update (
    									array ( 'QUANTITY' => $newSlectShadeInvQty,
    											'UPDATED_BY' => $userId,
    											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    									)
    								);

    						}else{

    							$newProdInvQty = $itemDetail['INV_QUANTITY'] - $line['QUANTITY'];

    							$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $bundleLine['PRODUCT_ID'] ) ->update (
    									array ( 'QUANTITY' => $newProdInvQty,
    											'UPDATED_BY' => $userId,
    											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    									)
    								);
    						}
    					}
    				}
    			}else{

    				$itemDetail = $ProductModel->getSpecificProductDetails($line['PRODUCT_ID']);

    				if($itemDetail['INV_QUANTITY_FLAG'] == 'shade'){

    					$cartLineShades = $ShoppingcartModel->getCartLineProductShadesDetailForInvChk($line['CART_LINE_ID']);

    					$newSlctShadeInvQty = $cartLineShades['shadeQuantity'] - $line['QUANTITY'];

    					$result = DB::table ( 'jb_product_shades_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $cartLineShades['PRODUCT_SHADE_ID'] ) ->update (
    									array ( 'QUANTITY' => $newSlctShadeInvQty,
    											'UPDATED_BY' => $userId,
    											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    									)
    								);
    				}else{
    					$newProdInvQty = $itemDetail['INV_QUANTITY'] - $line['QUANTITY'];

    					$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $line['PRODUCT_ID'] ) ->update (
    									array ( 'QUANTITY' => $newProdInvQty,
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
    					'FIRST_NAME' => isset($checkoutDetails ['S_1']) ? $checkoutDetails ['S_1'] : '',
    					'LAST_NAME' => isset($checkoutDetails ['S_2']) ? $checkoutDetails ['S_2'] : '',
    					'ADDRESS' => isset($checkoutDetails ['S_3']) ? $checkoutDetails ['S_3'] : '',
    					'APT_SUITE' => isset($checkoutDetails ['S_4']) ? $checkoutDetails ['S_4'] : '',
    					'CITY' => isset($checkoutDetails ['S_5']) ? $checkoutDetails ['S_5'] : '',
    					'STATE' => isset($checkoutDetails ['S_6']) ? $checkoutDetails ['S_6'] : '',
    					'ZIP_CODE' => isset($checkoutDetails ['S_7']) ? $checkoutDetails ['S_7'] : '',
    					'COUNTRY_ID' => isset($checkoutDetails ['S_8']) ? $checkoutDetails ['S_8'] : '',
    					'EMAIL' => isset($checkoutDetails ['S_9']) ? $checkoutDetails ['S_9'] : '',
    					'PHONE_NUMBER' => isset($checkoutDetails ['S_10']) ? $checkoutDetails ['S_10'] : '',
    					'BILLING_ADDRESS_FLAG' => isset($checkoutDetails ['S_11']) ? $checkoutDetails ['S_11'] : '',

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
    					'PAYMENT_TYPE' => 'clover',
    					'CARD_NUMBER' => '',
    					'EXPIRY_MONTH' => '',
    					'EXPIRY_YEAR' => '',
    					'SECURITY_CODE' => '',
    					'PAYMENT_STATUS' => 'paid',
    					'TRANSACTION_ID' => $response1->id,
    					'TRANSACTION_STATUS' => $response1->status,
    					'TRANSACTION_RESPONSE' => json_encode($response1),

    					'DATE' => date ( 'Y-m-d H:i:s' ),
    					'CREATED_BY' => $userId,
    					'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
    					'UPDATED_BY' => $userId,
    					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    			)
    		);

    	$trackingId = DB::table ( 'jb_order_shippment_tracking_tbl' )->insertGetId (
    			array ( 'ORDER_ID' => $orderId,
    					'STATUS' => $orderStatus,
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



    	$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('ORDER');
		

        $emailConfigDetailsForSubs = $EmailConfigModel->getSpecificEmailConfigByCode('SUBSCRIPTION');
		//dd($emailConfigDetailsForSubs);


        $htmlbody = null;
        $htmlbodyForSubs = null;
        $htmlbodyForSubsRow = null;
        $htmlbodyRow = null;
        $subscriptionTotalAmount = 0;
        $orderTotalAmount = 0;
       
        if (isset($cartDetails) && !empty($cartDetails)) {
		

            $sequence = 0;
            $sequenceForSubs = 0;
            foreach ($cartDetails as $row) {
                // Retrieve the data fields
                $cartLineId = $row['CART_LINE_ID'];
                $cartId = $row['CART_ID'];
                // $addedEffectiveDate = $row['ADDED_EFFECTIVE_DATE'];
                $productType = $row['PRODUCT_TYPE'];
                // $productId = $row['PRODUCT_ID'];
                $productName = $row['PRODUCT_NAME'];
                $productCategoryName = $row['PRODUCT_CATEGORY_NAME'];

                // $bundleId = $row['BUNDLE_ID'];
                $bundleName = $row['BUNDLE_NAME'];
                $bundleCategoryName = $row['BUNDLE_CATEGORY_NAME'];

                $quantity = $row['QUANTITY'];
                $unitPrice = $row['UNIT_PRICE'];
                $totalAmount = $row['TOTAL_AMOUNT'];
                // $vatPercent = $row['VAT_PERCENT'];
                // $vatAmount = $row['VAT_AMOUNT'];
                // $discountAmount = $row['DISCOUNT_AMOUNT'];
                $totalAmountIncVat = $row['TOTAL_AMOUNT_INC_VAT'];
                // $subscriptionCheck = $row['SUBSCRIPTION_CHECK'];
                $subscriptionId = $row['SUBSCRIPTION_ID'];
                $subscriptionCheck = $row['SUBSCRIPTION_CHECK'];
                $subscriptionName = $row['SUBSCRIPTION_NAME'];
                $subscriptionStartDate = $row['SUBSCRIPTION_DATE'];
                $nextPaymentDate = $row['NEXT_PAYMENT_DATE'];
                // $createdBy = $row['CREATED_BY'];
                // $createdOn = $row['CREATED_ON'];
                // $updatedBy = $row['UPDATED_BY'];
                // $updatedOn = $row['UPDATED_ON'];

                // Add the data to the HTML body
                if($subscriptionCheck == 'subscription' || $subscriptionCheck == 'Subscription' || $subscriptionCheck == 'SUBSCRIPTION'){
                    $sequenceForSubs = $sequenceForSubs+1;
                    $subscriptionTotalAmount += $totalAmount ?: ($totalAmountIncVat ?: 0);
                    $htmlbodyForSubsRow .= '
                    <tr>
                        <td style="padding: 10px; text-align: left;">'.$sequenceForSubs.'</td>
                        <td style="padding: 10px; text-align: left;">'.($productName ?: ($bundleName ?: '')).'</td>
                        <td style="padding: 10px; text-align: left;">'.($productCategoryName ?: ($bundleCategoryName ?: '')).'</td>
                        <td style="padding: 10px; text-align: left;">'.$subscriptionName.'</td>
                        <td style="padding: 10px; text-align: left;">'.$subscriptionStartDate.'</td>
                        <td style="padding: 10px; text-align: left;">'.$nextPaymentDate.'</td>
                        <td style="padding: 10px; text-align: left;">'.$unitPrice.'</td>
                        <td style="padding: 10px; text-align: left;">'.$quantity.'</td>
                        <td style="padding: 10px; text-align: left;">'.($totalAmount ?: ($totalAmountIncVat ?: '')).'</td>
                    </tr>';
                    // dd($htmlbodyForSubsRow);
                }else if($subscriptionCheck == 'One-Time Purchase'){
				
                    $sequence = $sequence+1;
                    $orderTotalAmount += $totalAmount ?: ($totalAmountIncVat ?: 0);
					
					
                    $htmlbodyRow .= '
                    <tr>
                        <td style="padding: 10px; text-align: left;">'.$sequence.'</td>
                        <td style="padding: 10px; text-align: left;">'.($productName ?: ($bundleName ?: '')).'</td>
                        <td style="padding: 10px; text-align: left;">'.($productCategoryName ?: ($bundleCategoryName ?: '')).'</td>
                        <td style="padding: 10px; text-align: left;">'.$unitPrice.'</td>
                        <td style="padding: 10px; text-align: left;">'.$quantity.'</td>
                        <td style="padding: 10px; text-align: left;">'.($totalAmount ?: ($totalAmountIncVat ?: '')).'</td>
                    </tr>';

                     
                }

				

            }


		

            $htmlbodyForSubsRow .= '
            <tr>
                <td colspan="8" style="text-align: right;"><strong>Net Total:</strong></td>
                <td style="padding: 10px; text-align: left;">' . $subscriptionTotalAmount . '</td>
            </tr>';

            $htmlbodyRow .= '
            <tr>
                <td colspan="5" style="text-align: right;"><strong>Net Total:</strong></td>
                <td style="padding: 10px; text-align: left;">' . $orderTotalAmount . '</td>
            </tr>';

            // Complete the HTML body
            $htmlbody = '
                    <div bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
                        <p>Hello '.$cartDetails[0]['UserName'].',</p><br>
                        '.$emailConfigDetails['message'].'
                    </div>
                    <html>
                    <head></head>
                    <body>
                        <div style="width: 100%; display: flex; justify-content: center;">
                            <div style="overflow-x: auto; max-width: 100%;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead style="background-color: #f4f4f4;">
                                        <tr>
                                            <th style="padding: 10px; text-align: left;">S.No</th>
                                            <th style="padding: 10px; text-align: left;">Product/Bundle Name</th>
                                            <th style="padding: 10px; text-align: left;">Category</th>
                                            <th style="padding: 10px; text-align: left;">Unit Cost</th>
                                            <th style="padding: 10px; text-align: left;">Quantity</th>
                                            <th style="padding: 10px; text-align: left;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>'.$htmlbodyRow.'</tbody>
                                </table>
                            </div>
                        </div>
                    </body>
                    </html>';
				// clear data receiving in htmlbody	
               // dd( $htmlbody);



                $htmlbodyForSubs = '
                    <div bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
                        <p>Hello '.$cartDetails[0]['UserName'].',</p><br>
                        '.$emailConfigDetailsForSubs['message'].'
                    </div>
                    <html>
                    <head></head>
                    <body>
                        <div style="width: 100%; display: flex; justify-content: center;">
                            <div style="overflow-x: auto; max-width: 100%;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead style="background-color: #f4f4f4;">
                                        <tr>
                                            <th style="padding: 10px; text-align: left;">S.No</th>
                                            <th style="padding: 10px; text-align: left;">Product/Bundle Name</th>
                                            <th style="padding: 10px; text-align: left;">Category</th>
                                            <th style="padding: 10px; text-align: left;">Subscription Name</th>
                                            <th style="padding: 10px; text-align: left;">Subscription Start Date</th>
                                            <th style="padding: 10px; text-align: left;">Next Payment Date</th>
                                            <th style="padding: 10px; text-align: left;">Unit Cost</th>
                                            <th style="padding: 10px; text-align: left;">Quantity</th>
                                            <th style="padding: 10px; text-align: left;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>'.$htmlbodyForSubsRow.'</tbody>
                                </table>
                            </div>
                        </div>
                    </body>
                    </html>';
            // dd($htmlbody);

            if($htmlbodyForSubsRow != null){
                // dd($htmlbodyForSubs);
                // dd($htmlbodyForSubs);
                 // Set the email details
                $email_details['to_id'] = $cartDetails[0]['UserId'];
                $email_details['to_email'] = $cartDetails[0]['UserEmail'];
                $email_details['from_id'] = 1;
                $email_details['from_email'] = $emailConfigDetailsForSubs['fromEmail'];
                $email_details['subject'] = $emailConfigDetailsForSubs['subject'];
                $email_details['message'] = $htmlbodyForSubs;
                $email_details['logo'] = $emailConfigDetailsForSubs['logo'];
                $email_details['module_code'] = 'SUBSCRIPTION';
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbodyForSubs;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

                // Send the email
                $EmailForwardModel->sendEmail($email_details);

                // $email_details['to_id'] = 1;
                // $email_details['to_email'] = $emailConfigDetailsForSubs['fromEmail'];
                // $email_details['from_id'] = 1;
                // $email_details['from_email'] = $cartDetails[0]['UserEmail'];
                // $email_details['subject'] = $emailConfigDetailsForSubs['subject'];
                // $email_details['message'] = $htmlbodyForSubs;
                // $email_details['logo'] = $emailConfigDetailsForSubs['logo'];
                // $email_details['module_code'] = 'SUBSCRIPTION';
                // $email_details['template'] = 'admin.emails.emailTemplate';
                // $email_details['htmlbody'] = $htmlbodyForSubs;
                // $email_details['pageTitle'] = $emailConfigDetails['title'];

                // // Send the email
                // $EmailForwardModel->sendEmail($email_details);

                // dd('mails sent');

            }
            if($htmlbodyRow != null ){
                // dd($htmlbody);
                            // Set the email details
                $email_details['to_id'] = $cartDetails[0]['UserId'];
                $email_details['to_email'] = $cartDetails[0]['UserEmail'];
                $email_details['from_id'] = 1;
                $email_details['from_email'] = $emailConfigDetails['fromEmail'];
                $email_details['subject'] = $emailConfigDetails['subject'];
                $email_details['message'] = $htmlbody;
                $email_details['logo'] = $emailConfigDetails['logo'];
                $email_details['module_code'] = 'ORDER';
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];
				

                // Send the email
				//dd($email_details);
               $emaildata= $EmailForwardModel->sendEmail($email_details);
			  // dd($emaildata);

                $email_details['to_id'] = 1;
                $email_details['to_email'] = $emailConfigDetails['fromEmail'];
                $email_details['from_id'] = 1;
                $email_details['from_email'] = $cartDetails[0]['UserEmail'];
                $email_details['subject'] = $emailConfigDetails['subject'];
                $email_details['message'] = $htmlbody;
                $email_details['logo'] = $emailConfigDetails['logo'];
                $email_details['module_code'] = 'ORDER';
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

                // Send the email
                $EmailForwardModel->sendEmail($email_details);

             //dd('mails sent');
            }
        }
    	// $EmailForwardModel->sendEmail($emailConfigDetails['title'],$htmlbody,$email_details);

//         $checkout_info = new Checkout();
//         $checkout_info->tracking = $response1->id;
//         $checkout_info->user_id = (int)$request->user_id;
//         $checkout_info->purchase_price = $response1->amount/100;
//         $checkout_info->price = $response1->amount/100;
//         $checkout_info->status = $response1->status;
//         $checkout_info->payment_method = 'clover';
//         $checkout_info->response = json_encode($response1);
//         $checkout_info->save();
        return;
    }





















    public function saveCloverResponce($user_id,$response,$type){

        $pay = new CloverPayment;
        $pay->response = $response;
        $pay->user_id = $user_id;
        $pay->type = $type;
        $pay->save();

        return $pay;
    }

    public function getCloverConfig(){
        $clover = (object)[];
//      $method = PaymentMethod::find(15);
        $method_setup = PaymentMethodCredentialModel::first();
        $clover->client_id = $method_setup->CLOVER_CLIENT_ID;
        $clover->code = $method_setup->CLOVER_CODE;
        $clover->client_secret =  $method_setup->CLOVER_CLIENT_SECRET;
        $clover->merchant_id = $method_setup->CLOVER_MERCHANT_ID;
        $clover->employee_id = $method_setup->CLOVER_EMPLOYEE_ID;
        $clover->is_test = $method_setup->IS_CLOVER_LOCALHOST;
        $clover->access_token = !empty($method_setup->CLOVER_ACCESS_TOKEN) ? $method_setup->CLOVER_ACCESS_TOKEN : getPaymentEnv('CLOVER_ACCESS_TOKEN');
        return $clover;
    }

    public function getAccessToken($client_id,$client_secret,$code,$is_test){


        $url= env('CLOVER_TOKEN_END_POINT');
        if($is_test == 'true'){
            $url= env('CLOVER_TOKEN_END_POINT_TEST');
        }

        $data = array('client_id' =>$client_id,
            'client_secret' => $client_secret,
            'code' => $code
        );

        $msg = http_build_query($data);

        $url .= $msg;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result1=json_decode($result);
        if(isset($result1->access_token)){
            return $result1->access_token;
        }else {
            return $result1;
        }

    }
    public function getCloverPakmsKey($access_token,$is_test){

        $url= env('CLOVER_PAKMS_END_POINT');
        if($is_test == 'true'){
            $url = env('CLOVER_PAKMS_END_POINT_TEST');
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer ".$access_token
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $response1 = json_decode($response);
        if(isset($response1->apiAccessKey)){
            return $response1->apiAccessKey;
        }else {
            return $response1;
        }

    }
    public function getPakmsKey(){

        $clover_details = $this->getCloverConfig();
        $access_token = $clover_details->access_token;

        if(isset($access_token->message)){
            return $access_token;
        }else {
            $clover_details = $this->getCloverPakmsKey($access_token,$clover_details->is_test);
            return $clover_details;
        }
    }

    public function getclovercode(Request $request)
    {
        // dd($request->all());
//     	$method = PaymentMethod::find(15);
        try {
            $method_setup = PaymentMethodCredentialModel::first();
            // dd($method_setup);
            $method_setup->CLOVER_CLIENT_ID = trim($request->client_id);
            $method_setup->CLOVER_CODE = trim($request->code);
            $method_setup->CLOVER_MERCHANT_ID = trim($request->merchant_id);
            $method_setup->CLOVER_EMPLOYEE_ID = trim($request->employee_id);
            $access_token = $this->getAccessToken($request->client_id,$method_setup->CLOVER_CLIENT_SECRET,$request->code,$method_setup->IS_CLOVER_LOCALHOST);
            if(isset($access_token->message)){
                return  "Something went wrong Try Again:" .$access_token->message;
            }
            $method_setup->CLOVER_ACCESS_TOKEN = $access_token;
//             dd($method_setup);
            $method_setup->save();

            return "Successfully Save Into Your Database: " . json_encode([
                'client_id'=>$method_setup->CLOVER_CLIENT_ID,
                    'client_secret'=>$method_setup->CLOVER_CLIENT_SECRET,
                    'code'=>$method_setup->CLOVER_CODE,
                    'merchant_id'=>$method_setup->CLOVER_MERCHANT_ID,
                    'employee_id'=>$method_setup->CLOVER_EMPLOYEE_ID,
                    'access_token'=>$method_setup->CLOVER_ACCESS_TOKEN,
                    'is_test'=>$method_setup->IS_CLOVER_LOCALHOST]);
        } catch (\Throwable $th) {
         return  "Something went wrong : \n" . $th;

        }

    }
}
