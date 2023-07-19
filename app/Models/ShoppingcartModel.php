<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
//use App\Models\ProductModel;
use DateTime;

class ShoppingcartModel extends Model
{
    use HasFactory;


    public function getSpecificCartDetails($cartId){

    	$result = DB::table('jb_shopping_cart_tbl as a')->select('a.*')
    	->where('a.CART_ID', $cartId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['seqNo'] = $i+1;
    		$arrRes['CART_ID'] = $row->CART_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['CART_EFFECTIVE_START_DATE'] = $row->CART_EFFECTIVE_START_DATE;
    		$arrRes['STATUS'] = $row->STATUS;

    		$subtotal = $this->getCartSubTotalAmount($row->CART_ID);
    		$totalIncVat = $this->getCartGrandTotalAmountIncVat($row->CART_ID);
    		$totalDisc = $this->getCartTotalDiscountAmount($row->CART_ID);
    		$totalVat = $this->getCartTotalVatAmount($row->CART_ID);

    		$grandTotal = $totalIncVat - $totalDisc;

    		$arrRes['ExtVatTotalAmount'] = number_format($subtotal,2);
    		$arrRes['IncVatTotalAmount'] = number_format($totalIncVat,2);
    		$arrRes['totalVatAmount'] = number_format($totalVat,2);
    		$arrRes['totalDiscountAmount'] = number_format($totalDisc,2);
    		$arrRes['grandTotal'] = number_format($grandTotal,2);
    		$arrRes['cloverPaymentgrandTotal1'] = $grandTotal * 100;

    		$arrRes['cartCount'] = $this->getCartLinesCount($row->CART_ID);
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;

    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getActiveCartWrtUserId($userId){
    	DB::enableQueryLog();
    	$result = DB::table('jb_shopping_cart_tbl as a')->select('a.*')
    	->where('a.USER_ID', $userId)
    	->where('a.CHECKOUT_FLAG', '0')
    	->get();

//     	$query = DB::getQueryLog(); dd($query);
    	$i=0;
    	foreach ($result as $row){

    		$arrRes['CART_ID'] = $row->CART_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificCartLineDetails($cartId){
    	$ProductModel = new ProductModel();

    	$result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*','a.PRODUCT_TYPE','a.UNIT_PRICE','a.VAT_PERCENT','a.VAT_AMOUNT',
    																	'a.DISCOUNT_AMOUNT','a.TOTAL_AMOUNT_INC_VAT','jpt.NAME as productName',
    																	'jpt.UNIT_PRICE as productPrice', 'jpt.UNIT as productUnit',
    																	'jbpt.NAME as bundleName', 'jbpt.DISCOUNTED_AMOUNT as bundlePrice',
    																	'jbpt.UNIT as bundleUnit','jbpt.IMAGE_DOWN_PATH as bundleImage')
    	->leftjoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->leftjoin ( 'jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID' )
    	->where('a.CART_ID', $cartId)
    	->orderBy('a.CART_LINE_ID', 'desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['CART_LINE_ID'] = $row->CART_LINE_ID;
    		$arrRes[$i]['CART_ID'] = $row->CART_ID;
    		$arrRes[$i]['ADDED_EFFECTIVE_DATE'] = $row->ADDED_EFFECTIVE_DATE;
    		$arrRes[$i]['QUANTITY'] = $row->QUANTITY;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['lineTotalAmount'] = number_format($row->TOTAL_AMOUNT,2);

    		$arrRes[$i]['vatPercent'] = $row->VAT_PERCENT;
    		$arrRes[$i]['vatAmount'] = number_format($row->VAT_AMOUNT,2);
    		$arrRes[$i]['discountAmount'] = number_format($row->DISCOUNT_AMOUNT,2);
    		$arrRes[$i]['totalInvVat'] = number_format($row->TOTAL_AMOUNT_INC_VAT,2);
//     		$arrRes[$i]['grandTotal'] = number_format($row->TOTAL_AMOUNT_INC_VAT - $row->DISCOUNT_AMOUNT,2);

    		$arrRes[$i]['flag'] = $row->PRODUCT_TYPE;

    		if($row->PRODUCT_TYPE == 'product'){
    			$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    			$arrRes[$i]['productName'] = $row->productName;
    			$arrRes[$i]['productUnit'] = $row->productUnit;
    			$arrRes[$i]['grandTotal'] = number_format($row->TOTAL_AMOUNT_INC_VAT - $row->DISCOUNT_AMOUNT,2);

    			$productImage = $ProductModel->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    			$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    		}else{

    			$arrRes[$i]['BUNDLE_ID'] = $row->BUNDLE_ID;
    			$arrRes[$i]['productName'] = $row->bundleName;
    			$arrRes[$i]['productUnit'] = $row->bundleUnit;
    			$arrRes[$i]['grandTotal'] = number_format($row->TOTAL_AMOUNT_INC_VAT, 2);

    			$arrRes[$i]['primaryImage'] = isset($row->bundleImage) != null ? $row->bundleImage : url('assets-web')."/images/product_placeholder.png";
    		}

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificCartLineForOrder($cartId){
    	$ProductModel = new ProductModel();

    	$result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*',  'a.UNIT_PRICE','prd.NAME as productName','bprd.NAME as bundleName','ctbl.CATEGORY_NAME as productCName','bctbl.CATEGORY_NAME as bundleCName','sctbl.USER_ID as UserID')
        ->leftJoin('jb_product_tbl as prd','a.PRODUCT_ID','=','prd.PRODUCT_ID')
        ->leftJoin('jb_bundle_product_tbl as bprd','a.BUNDLE_ID','=','bprd.BUNDLE_ID')
        ->leftJoin('jb_category_tbl as ctbl','prd.CATEGORY_ID','=','ctbl.CATEGORY_ID')
        ->leftJoin('jb_category_tbl as bctbl','bprd.CATEGORY_ID','=','bctbl.CATEGORY_ID')
        ->leftJoin('jb_shopping_cart_tbl as sctbl','a.CART_ID','=','sctbl.CART_ID')
    	->where('a.CART_ID', $cartId)
    	->orderBy('a.CART_LINE_ID', 'desc')
    	->get();
        // dd($result[0]->UserID);
        $userDetails = User::where('USER_ID',$result[0]->UserID)->first();
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['CART_LINE_ID'] = $row->CART_LINE_ID;
    		$arrRes[$i]['CART_ID'] = $row->CART_ID;
    		$arrRes[$i]['ADDED_EFFECTIVE_DATE'] = $row->ADDED_EFFECTIVE_DATE;
    		$arrRes[$i]['PRODUCT_TYPE'] = $row->PRODUCT_TYPE;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
            $arrRes[$i]['PRODUCT_NAME'] = $row->productName;
    		$arrRes[$i]['BUNDLE_ID'] = $row->BUNDLE_ID;
            $arrRes[$i]['BUNDLE_NAME'] = $row->bundleName;
            $arrRes[$i]['BUNDLE_CATEGORY_NAME'] = $row->bundleCName;
            $arrRes[$i]['PRODUCT_CATEGORY_NAME'] = $row->productCName;
    		$arrRes[$i]['QUANTITY'] = $row->QUANTITY;
    		$arrRes[$i]['UNIT_PRICE'] = $row->UNIT_PRICE;

    		$arrRes[$i]['TOTAL_AMOUNT'] = $row->TOTAL_AMOUNT;
    		$arrRes[$i]['VAT_PERCENT'] = $row->VAT_PERCENT;
    		$arrRes[$i]['VAT_AMOUNT'] = $row->VAT_AMOUNT;
    		$arrRes[$i]['DISCOUNT_AMOUNT'] = $row->DISCOUNT_AMOUNT;
    		$arrRes[$i]['TOTAL_AMOUNT_INC_VAT'] = $row->TOTAL_AMOUNT_INC_VAT;

    		$arrRes[$i]['SUBSCRIPTION_CHECK'] = $row->SUBSCRIPTION_CHECK != null ? $row->SUBSCRIPTION_CHECK : '';
    		$arrRes[$i]['SUBSCRIPTION_ID'] = $row->SUBSCRIPTION_ID  != null ? $row->SUBSCRIPTION_ID : '';

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;


            $arrRes[$i]['UserName'] = $userDetails->USER_NAME;
            $arrRes[$i]['UserEmail'] = $userDetails->EMAIL;
            $arrRes[$i]['UserId'] = $userDetails->USER_ID;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

	public function getOrderLineProductShadesNameDetailCheckout($orderLineId){

    	$result = DB::table('jb_shopping_cart_shade_detail_tbl as a')->select('a.*','jopt.NAME as PRODUCT_NAME')
		->leftjoin ( 'jb_product_tbl as jopt', 'a.PRODUCT_ID', '=', 'jopt.PRODUCT_ID' )
    	->where('a.CART_LINE_ID', $orderLineId)
    	->orderBy('a.CART_LINE_ID', 'desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){

    		$arrRes[$i]['SHADE_NAME'] = ($row->SHADE_NAME == '' || $row->SHADE_NAME == null) ? 'N/A' : $row->SHADE_NAME;
    		$arrRes[$i]['PRODUCT_NAME'] = ($row->PRODUCT_NAME == '' || $row->PRODUCT_NAME == null) ? 'N/A' : $row->PRODUCT_NAME;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getCartSubTotalAmount($cartId){

    	$result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*')
    	->where('a.CART_ID', $cartId)
    	->get();

    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->TOTAL_AMOUNT;
    	}
    	return $sum;
    }
    public function getCartTotalVatAmount($cartId){

    	$result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*')
    	->where('a.CART_ID', $cartId)
    	->get();

    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->VAT_AMOUNT;
    	}
    	return $sum;
    }
    public function getCartTotalDiscountAmount($cartId){

    	$result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*')
    	->where('a.CART_ID', $cartId)
    	->get();

    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->DISCOUNT_AMOUNT;
    	}
    	return $sum;
    }
    public function getCartGrandTotalAmountIncVat($cartId){

    	$result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*')
    	->where('a.CART_ID', $cartId)
    	->get();

    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->TOTAL_AMOUNT_INC_VAT;
    	}
    	return $sum;
    }
    public function getCartLinesCount($cartId){

    	$result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*')
    	->where('a.CART_ID', $cartId)
    	->get();

    	$count=0;
    	foreach ($result as $row){
    		$count = $count + 1;

    	}
    	return $count;
    }

    public function getCartLineProductShadesDetail($cartLineId){

    	$result = DB::table('jb_shopping_cart_shade_detail_tbl as a')->select('a.*')
    	->where('a.CART_LINE_ID', $cartLineId)
    	->orderBy('a.CART_LINE_ID', 'desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['CART_SHADE_LINE_ID'] = $row->CART_SHADE_LINE_ID;
    		$arrRes[$i]['CART_LINE_ID'] = $row->CART_LINE_ID;
    		$arrRes[$i]['ADDED_EFFECTIVE_DATE'] = $row->ADDED_EFFECTIVE_DATE;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['PRODUCT_SHADE_ID'] = $row->PRODUCT_SHADE_ID;
    		$arrRes[$i]['SHADE_ID'] = $row->SHADE_ID;
    		$arrRes[$i]['SHADE_NAME'] = $row->SHADE_NAME;

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getSpecificCartLineDetailsForInvChk($cartId){
    	$ProductModel = new ProductModel();

    	$result = DB::table('jb_shopping_cart_detail_tbl as a')->select('a.*','a.PRODUCT_TYPE','a.UNIT_PRICE','a.VAT_PERCENT','a.VAT_AMOUNT',
    			'jpt.NAME as productName', 'jbpt.NAME as bundleName')
    			->leftjoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    			->leftjoin ( 'jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID' )
    			->where('a.CART_ID', $cartId)
    			->orderBy('a.CART_LINE_ID', 'desc')
    			->get();

    			$i=0;
    			foreach ($result as $row){
    				$arrRes[$i]['seqNo'] = $i+1;
    				$arrRes[$i]['CART_LINE_ID'] = $row->CART_LINE_ID;
    				$arrRes[$i]['CART_ID'] = $row->CART_ID;
    				$arrRes[$i]['QUANTITY'] = $row->QUANTITY;

    				$arrRes[$i]['flag'] = $row->PRODUCT_TYPE;

    				if($row->PRODUCT_TYPE == 'product'){
    					$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    					$arrRes[$i]['productName'] = $row->productName;

    				}else{

    					$arrRes[$i]['BUNDLE_ID'] = $row->BUNDLE_ID;
    					$arrRes[$i]['productName'] = $row->bundleName;
    				}

    				$i++;
    			}

    			return isset($arrRes) ? $arrRes : null;
    }

    public function getCartLineProductShadesDetailForInvChk($cartLineId){

    	$result = DB::table('jb_shopping_cart_shade_detail_tbl as a')->select('a.*', 'jpst.QUANTITY as shadeQuantity')
    	->join ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_SHADE_ID', '=', 'jpst.PRODUCT_SHADE_ID' )
    	->where('a.CART_LINE_ID', $cartLineId)
    	->orderBy('a.CART_LINE_ID', 'desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['CART_SHADE_LINE_ID'] = $row->CART_SHADE_LINE_ID;
    		$arrRes['CART_LINE_ID'] = $row->CART_LINE_ID;
    		$arrRes['ADDED_EFFECTIVE_DATE'] = $row->ADDED_EFFECTIVE_DATE;
    		$arrRes['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes['PRODUCT_SHADE_ID'] = $row->PRODUCT_SHADE_ID;
    		$arrRes['SHADE_ID'] = $row->SHADE_ID;
    		$arrRes['SHADE_NAME'] = $row->SHADE_NAME;
    		$arrRes['shadeQuantity'] = $row->shadeQuantity;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
}
