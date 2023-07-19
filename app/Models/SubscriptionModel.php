<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class SubscriptionModel extends Model
{
    use HasFactory;


    public function getAllSubscriptionsForAdmin(){

    	$result = DB::table('jb_subscription_tbl as a')->select('a.*')
		->where('a.IS_DELETED', 1)
    	->orderBy('a.UPDATED_ON','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->SUBSCRIPTION_ID;//$i+1;
    		$arrRes[$i]['SUBSCRIPTION_ID'] = $row->SUBSCRIPTION_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['PRICE'] = number_format($row->PRICE,2);
    		$arrRes[$i]['EFF_START_DATE'] = date ( 'd M Y', strtotime ( $row->EFF_START_DATE ) );
    		$arrRes[$i]['EFF_END_DATE'] = date ( 'd M Y', strtotime ( $row->EFF_END_DATE ) );
    		$arrRes[$i]['SUB_NOTE_1'] = $row->SUB_NOTE_1;
    		$arrRes[$i]['SUB_NOTE_2'] = $row->SUB_NOTE_2;
    		$arrRes[$i]['SUBSCRIPTIONS_ALLOWED'] = $row->SUBSCRIPTIONS_ALLOWED;
    		$arrRes[$i]['DISCOUNT'] = number_format($row->DISCOUNT,2);;
    		$arrRes[$i]['VALIDITY_DAYS'] = $row->VALIDITY_DAYS;
    		$arrRes[$i]['DESCRIPTION'] = $row->DESCRIPTION;

    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificSubscriptionData($id){

    	$result = DB::table('jb_subscription_tbl as a')->select('a.*')
    	->where('a.SUBSCRIPTION_ID',$id)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->SUBSCRIPTION_ID;
    		$arrRes['S_1'] = $row->TITLE;
//     		$arrRes['S_2'] = $row->PRICE;
    		$arrRes['S_3'] = $row->EFF_START_DATE;
    		$arrRes['S_4'] = $row->EFF_END_DATE;
    		$arrRes['S_5'] = $row->SUB_NOTE_1;
    		$arrRes['S_6'] = $row->SUB_NOTE_2;
    		$arrRes['S_7'] = $row->DURATION_MONTHS;//SUBSCRIPTIONS_ALLOWED;
    		$arrRes['S_8'] = $row->DISCOUNT;
//     		$arrRes['S_9'] = $row->VALIDITY_DAYS;
    		$arrRes['S_10'] = $row->DESCRIPTION;

    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getSpecificSubscriptionStatus($id){

    	$result = DB::table('jb_subscription_tbl as a')->select('a.*')
    	->where('a.SUBSCRIPTION_ID',$id)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['SUBSCRIPTION_ID'] = $row->SUBSCRIPTION_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['STATUS'] = $row->STATUS;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getAllActiveSubscriptionsLov(){

    	$currentDate = date('Y-m-d');

    	$result = DB::table('jb_subscription_tbl as a')->select('a.*')
    	->where('a.STATUS','active')
    	->where('a.EFF_END_DATE', '>=', "$currentDate")
    	->orderBy('a.SUBSCRIPTION_ID','asc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ID'] = $row->SUBSCRIPTION_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['PRICE'] = number_format($row->PRICE,2);
    		$arrRes[$i]['SUB_NOTE_1'] = $row->SUB_NOTE_1;
    		$arrRes[$i]['SUB_NOTE_2'] = $row->SUB_NOTE_2;
    		$arrRes[$i]['DESCRIPTION'] = $row->DESCRIPTION;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }


	public function getAllUserSubscriptionsWrtUser($userId){
		$ProductModel = new ProductModel();

    	$result = DB::table('jb_user_subscription_tbl as a')->select('a.*','jodt.QUANTITY','jodt.UNIT_PRICE','jodt.TOTAL_AMOUNT', 'jpt.NAME as productName','jpt.SHORT_DESCRIPTION',
    															'jbpt.NAME as bundleName','jbpt.SHORT_DESCRIPTION as bundleShortDesc',
    															'jbpt.IMAGE_DOWN_PATH as bundleImage', 'jst.TITLE as subsName')
    	->leftJoin ( 'jb_subscription_tbl as jst', 'a.SUBSCRIPTION_ID', '=', 'jst.SUBSCRIPTION_ID' )
    	->leftJoin ( 'jb_order_detail_tbl as jodt', 'a.ORDER_LINE_ID', '=', 'jodt.ORDER_LINE_ID' )
    	->leftJoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->leftjoin ( 'jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID' )
    	->where('a.USER_ID',$userId)
    	->orderBy('a.USER_SUBSCRIPTION_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['USER_SUBSCRIPTION_ID'] = $row->USER_SUBSCRIPTION_ID;
    		$arrRes[$i]['subscriptionNum'] = 'SUBS-'.$row->USER_SUBSCRIPTION_ID;
    		$arrRes[$i]['subsName'] = $row->subsName;
    		$arrRes[$i]['QUANTITY'] = $row->QUANTITY;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['TOTAL_AMOUNT'] = number_format($row->TOTAL_AMOUNT,2);

    		if($row->PRODUCT_TYPE == 'product'){

    			$arrRes[$i]['productName'] = $row->productName;
    			$arrRes[$i]['productDesc'] = strlen ( $row->SHORT_DESCRIPTION ) > 30?substr ( $row->SHORT_DESCRIPTION, 0, 30 )."..." :$row->SHORT_DESCRIPTION;

    			$productImage = $ProductModel->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    			$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    		}else{

    			$arrRes[$i]['productName'] = $row->bundleName;
    			$arrRes[$i]['productDesc'] = strlen ( $row->bundleShortDesc ) > 30?substr ( $row->bundleShortDesc, 0, 30 )."..." :$row->bundleShortDesc;

    			$arrRes[$i]['primaryImage'] = isset($row->bundleImage) != null ? $row->bundleImage : url('assets-web')."/images/product_placeholder.png";

    		}

    		$arrRes[$i]['DURATION_MONTHS'] = $row->DURATION_MONTHS;
    		$arrRes[$i]['SUBSCRIPTION_DATE'] = date('d M,Y', strtotime($row->SUBSCRIPTION_DATE));
    		$arrRes[$i]['NEXT_PAYMENT_DATE'] = date('d M,Y', strtotime($row->NEXT_PAYMENT_DATE));
    		$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    		$arrRes[$i]['SUBSCRIPTION_STATUS'] = strtoupper($row->SUBSCRIPTION_STATUS);

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getSpecificUserSubscriptionDetails($id){
    	$ProductModel = new ProductModel();
    	$OrderModel = new OrderModel();

    	$result = DB::table('jb_user_subscription_tbl as a')->select('a.*','jodt.QUANTITY','jodt.UNIT_PRICE','jodt.TOTAL_AMOUNT','jpt.NAME as productName',
                'jpt.SHORT_DESCRIPTION','jbpt.NAME as bundleName','jbpt.SHORT_DESCRIPTION as bundleShortDesc',
                'jbpt.IMAGE_DOWN_PATH as bundleImage','jst.TITLE as subsName','jodt.ORDER_ID',
                'jodt.VAT_PERCENT','jodt.VAT_AMOUNT','jst.DISCOUNT as subsDiscount',
                'fut.FIRST_NAME','fut.LAST_NAME')
    			->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    			->leftJoin ( 'jb_subscription_tbl as jst', 'a.SUBSCRIPTION_ID', '=', 'jst.SUBSCRIPTION_ID' )
    			->leftJoin ( 'jb_order_detail_tbl as jodt', 'a.ORDER_LINE_ID', '=', 'jodt.ORDER_LINE_ID' )
    			->leftJoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    			->leftjoin ( 'jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID' )
    			->where('a.USER_SUBSCRIPTION_ID',$id)
    			->orderBy('a.USER_SUBSCRIPTION_ID','desc')
    			->get();

    			$i=0;
    			foreach ($result as $row){
    				$arrRes['USER_SUBSCRIPTION_ID'] = $row->USER_SUBSCRIPTION_ID;
    				$arrRes['subscriptionNum'] = 'SUBS-'.$row->USER_SUBSCRIPTION_ID;
    				$arrRes['subsName'] = $row->subsName;
    				$arrRes['userFirstName'] = $row->FIRST_NAME;
    				$arrRes['userLastName'] = $row->LAST_NAME;

    				$arrRes['SUBSCRIPTION_ID'] = $row->SUBSCRIPTION_ID;
    				$arrRes['ORDER_ID'] = $row->ORDER_ID;
    				$arrRes['ORDER_LINE_ID'] = $row->ORDER_LINE_ID;

    				$arrRes['PRODUCT_TYPE'] = $row->PRODUCT_TYPE;
    				$arrRes['PRODUCT_ID'] = $row->PRODUCT_ID;
    				$arrRes['BUNDLE_ID'] = $row->BUNDLE_ID;

    				$arrRes['QUANTITY'] = $row->QUANTITY;
    				$arrRes['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    				$arrRes['UNIT_PRICE1'] = $row->UNIT_PRICE;
    				$arrRes['TOTAL_AMOUNT'] = number_format($row->TOTAL_AMOUNT,2);
    				$arrRes['TOTAL_AMOUNT1'] = $row->TOTAL_AMOUNT;
    				$arrRes['VAT_PERCENT'] = $row->VAT_PERCENT;
    				$arrRes['VAT_AMOUNT'] = $row->VAT_AMOUNT;


    				$subsDiscount = $row->subsDiscount;

    				$subtotal = $row->TOTAL_AMOUNT;
		    		$totalVat = $OrderModel->getOrderTotalVatAmount($row->ORDER_ID);
		    		$totalIncVat = $subtotal + $totalVat;
		    		$subsDisAmount = ($subsDiscount * $subtotal) / 100;
		    		$grandTotal = $totalIncVat - $subsDisAmount;

		    		$arrRes['ExtVatTotalAmount'] = number_format($subtotal,2);
		    		$arrRes['IncVatTotalAmount'] = number_format($totalIncVat,2);
		    		$arrRes['totalVatAmount'] = number_format($totalVat,2);
		    		$arrRes['subsDiscount'] = number_format($subsDisAmount,2);
		    		$arrRes['grandTotal'] = number_format($grandTotal,2);
		    		$arrRes['cloverGrandTotal'] = $grandTotal * 100;

		    		$arrRes['ExtVatTotalAmount1'] = $subtotal;
		    		$arrRes['IncVatTotalAmount1'] = $totalIncVat;
		    		$arrRes['totalVatAmount1'] = $totalVat;
		    		$arrRes['subsDiscount1'] = $subsDisAmount;
		    		$arrRes['grandTotal1'] = $grandTotal;

    				if($row->PRODUCT_TYPE == 'product'){

    					$arrRes['productName'] = $row->productName;
    					$arrRes['productDesc'] = strlen ( $row->SHORT_DESCRIPTION ) > 30?substr ( $row->SHORT_DESCRIPTION, 0, 30 )."..." :$row->SHORT_DESCRIPTION;

    					$productImage = $ProductModel->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    					$arrRes['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    				}else{

    					$arrRes['productName'] = $row->bundleName;
    					$arrRes['productDesc'] = strlen ( $row->bundleShortDesc ) > 30?substr ( $row->bundleShortDesc, 0, 30 )."..." :$row->bundleShortDesc;

    					$arrRes['primaryImage'] = isset($row->bundleImage) != null ? $row->bundleImage : url('assets-web')."/images/product_placeholder.png";

    				}

    				$arrRes['DURATION_MONTHS'] = $row->DURATION_MONTHS;
    				$arrRes['SUBSCRIPTION_DATE'] = date('d M,Y', strtotime($row->SUBSCRIPTION_DATE));
    				$arrRes['SUBSCRIPTION_DATE1'] = $row->SUBSCRIPTION_DATE;
    				$arrRes['NEXT_PAYMENT_DATE'] = date('d M,Y', strtotime($row->NEXT_PAYMENT_DATE));
    				$arrRes['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    				$arrRes['SUBSCRIPTION_STATUS'] = strtoupper($row->SUBSCRIPTION_STATUS);

    				$arrRes['CREATED_BY'] = $row->CREATED_BY;
    				$arrRes['CREATED_ON'] = $row->CREATED_ON;
    				$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    				$arrRes['UPDATED_ON'] = $row->UPDATED_ON;


    			}

    			return isset($arrRes) ? $arrRes : null;
    }


    public function getAllAdminUserSubscriptionsForAdmin(){
    	$ProductModel = new ProductModel();

    	$result = DB::table('jb_user_subscription_tbl as a')->select('a.*','jodt.QUANTITY','jodt.UNIT_PRICE','jodt.TOTAL_AMOUNT', 'jpt.NAME as productName','jpt.SHORT_DESCRIPTION',
    			'jbpt.NAME as bundleName','jbpt.SHORT_DESCRIPTION as bundleShortDesc',
    			'jbpt.IMAGE_DOWN_PATH as bundleImage', 'jst.TITLE as subsName', 'fut.FIRST_NAME','fut.LAST_NAME')
    			->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    			->leftJoin ( 'jb_subscription_tbl as jst', 'a.SUBSCRIPTION_ID', '=', 'jst.SUBSCRIPTION_ID' )
    			->leftJoin ( 'jb_order_detail_tbl as jodt', 'a.ORDER_LINE_ID', '=', 'jodt.ORDER_LINE_ID' )
    			->leftJoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    			->leftjoin ( 'jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID' )
    			->orderBy('a.UPDATED_ON','desc')
    			->get();

    			$i=0;
    			foreach ($result as $row){
    				$arrRes[$i]['seqNo'] = $row->USER_SUBSCRIPTION_ID;//$i+1;
    				$arrRes[$i]['USER_SUBSCRIPTION_ID'] = $row->USER_SUBSCRIPTION_ID;
    				$arrRes[$i]['subscriptionNum'] = 'SUBS-'.$row->USER_SUBSCRIPTION_ID;
    				$arrRes[$i]['userFirstName'] = $row->FIRST_NAME;
    				$arrRes[$i]['userLastName'] = $row->LAST_NAME;
    				$arrRes[$i]['subsName'] = $row->subsName;
    				$arrRes[$i]['QUANTITY'] = $row->QUANTITY;
    				$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    				$arrRes[$i]['TOTAL_AMOUNT'] = number_format($row->TOTAL_AMOUNT,2);

    				if($row->PRODUCT_TYPE == 'product'){

    					$arrRes[$i]['productName'] = $row->productName;
    					$arrRes[$i]['productDesc'] = strlen ( $row->SHORT_DESCRIPTION ) > 30?substr ( $row->SHORT_DESCRIPTION, 0, 30 )."..." :$row->SHORT_DESCRIPTION;

    					$productImage = $ProductModel->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    					$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    				}else{

    					$arrRes[$i]['productName'] = $row->bundleName;
    					$arrRes[$i]['productDesc'] = strlen ( $row->bundleShortDesc ) > 30?substr ( $row->bundleShortDesc, 0, 30 )."..." :$row->bundleShortDesc;

    					$arrRes[$i]['primaryImage'] = isset($row->bundleImage) != null ? $row->bundleImage : url('assets-web')."/images/product_placeholder.png";

    				}

    				$arrRes[$i]['DURATION_MONTHS'] = $row->DURATION_MONTHS;
    				$arrRes[$i]['SUBSCRIPTION_DATE'] = date('d M,Y', strtotime($row->SUBSCRIPTION_DATE));
    				$arrRes[$i]['NEXT_PAYMENT_DATE'] = date('d M,Y', strtotime($row->NEXT_PAYMENT_DATE));
    				$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    				$arrRes[$i]['SUBSCRIPTION_STATUS'] = strtoupper($row->SUBSCRIPTION_STATUS);

    				$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    				$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    				$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    				$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    				$i++;
    			}

    			return isset($arrRes) ? $arrRes : null;
    }

    public function checkSubscribedProductExistWrtProductId($productId){
    	DB::enableQueryLog();

    	$result = DB::table('jb_user_subscription_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $productId)
    	->get();

    	//     	$query = DB::getQueryLog(); dd($query);

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }
    public function checkSubscribedBundleExistWrtBundleId($bundleId){
    	DB::enableQueryLog();

    	$result = DB::table('jb_user_subscription_tbl as a')->select('a.*')
    	->where('a.BUNDLE_ID', $bundleId)
    	->get();

    	//     	$query = DB::getQueryLog(); dd($query);

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }
}
