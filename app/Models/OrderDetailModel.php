<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class OrderDetailModel extends Model
{
    use HasFactory;
    
	public function getAllSpecificOrderData($orderId){
		$ProductModel = new ProductModel();
		
    	$result = DB::table('jb_order_detail_tbl as a')->select('a.*', 'jpt.NAME as productName','jpt.SHORT_DESCRIPTION', 
    															'jbpt.NAME as bundleName','jbpt.SHORT_DESCRIPTION as bundleShortDesc',
    															'jbpt.IMAGE_DOWN_PATH as bundleImage')
    	->leftJoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->leftjoin ( 'jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID' )
    	->where('a.ORDER_ID',$orderId)
    	->orderBy('a.ORDER_ID','desc')
    	->get();
    	
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['ORDER_LINE_ID'] = $row->ORDER_LINE_ID;
    		$arrRes[$i]['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
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
    		
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
	public function getOrderLineProductShadesNameDetail($orderLineId){
    	 
    	$result = DB::table('jb_order_shade_detail_tbl as a')->select('a.*','jopt.NAME as PRODUCT_NAME')
		->leftjoin ( 'jb_product_tbl as jopt', 'a.PRODUCT_ID', '=', 'jopt.PRODUCT_ID' )
    	->where('a.ORDER_LINE_ID', $orderLineId)
    	->orderBy('a.ORDER_LINE_ID', 'desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		
    		$arrRes[$i]['SHADE_NAME'] = ($row->SHADE_NAME == '' || $row->SHADE_NAME == null) ? 'N/A' : $row->SHADE_NAME;
			$arrRes[$i]['PRODUCT_NAME'] =  ($row->PRODUCT_NAME == '' || $row->PRODUCT_NAME == null) ? 'N/A' : $row->PRODUCT_NAME;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getOrderLineProductShadesDetail($orderLineId){
    	 
    	$result = DB::table('jb_order_shade_detail_tbl as a')->select('a.*')
    	->where('a.ORDER_LINE_ID', $orderLineId)
    	->orderBy('a.ORDER_LINE_ID', 'desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ORDER_SHADE_LINE_ID'] = $row->ORDER_SHADE_LINE_ID;
    		$arrRes[$i]['ORDER_LINE_ID'] = $row->ORDER_LINE_ID;
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
}
