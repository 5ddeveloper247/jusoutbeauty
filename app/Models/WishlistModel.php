<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class WishlistModel extends Model
{
    use HasFactory;
    
    public function getSpecificProductExistByUser($userId, $productId){
    	 
    	$result = DB::table('jb_user_wishlist_tbl as a')->select('a.*')
    	->where('a.USER_ID',$userId)
    	->where('a.PRODUCT_ID',$productId)
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes = '1';
    	}
    
    	return isset($arrRes) ? $arrRes : '0';
    }
    public function getSpecificProductExistByUser1($userId, $productId, $flag){  // flag = 1 for product and 2 for bundle
    	
    	if($flag == '1'){
    		$result = DB::table('jb_user_wishlist_tbl as a')->select('a.*')
    		->where('a.USER_ID',$userId)
    		->where('a.PRODUCT_ID',$productId)
    		->get();
    	}else if($flag == '2'){
    		$result = DB::table('jb_user_wishlist_tbl as a')->select('a.*')
    		->where('a.USER_ID',$userId)
    		->where('a.BUNDLE_ID',$productId)
    		->get();
    	}
    	
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes = '1';
    	}
    
    	return isset($arrRes) ? $arrRes : '0';
    }
   
	public function getWishlistCountByUserId( $userId ){
    	 
    	$result = DB::table('jb_user_wishlist_tbl')->where('USER_ID', $userId)->count();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes = $row;
    	}
    
    	return isset($arrRes) ? $arrRes : '0';
    }
    
    public function getAllWishlistDataByUser($userId){
    	$ProductModel = new ProductModel();
    	 
    	$result = DB::table('jb_user_wishlist_tbl as a')->select('a.*','a.PRODUCT_TYPE','jpt.NAME as productName',
		    			'jpt.UNIT_PRICE as productPrice', 'jpt.UNIT as productUnit',
		    			'jbpt.NAME as bundleName', 'jbpt.DISCOUNTED_AMOUNT as bundlePrice',
		    			'jbpt.UNIT as bundleUnit','jbpt.IMAGE_DOWN_PATH as bundleImage')
    			->leftjoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    			->leftjoin ( 'jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID' )
    			->where('a.USER_ID', $userId)
    			->orderBy('a.WISHLIST_ID', 'desc')
    			->get();
    
    			$i=0;
    			foreach ($result as $row){
    				$arrRes[$i]['seqNo'] = $i+1;
    				$arrRes[$i]['WISHLIST_ID'] = $row->WISHLIST_ID;
    				$arrRes[$i]['USER_ID'] = $row->USER_ID;
    				$arrRes[$i]['DATE'] = date ( 'M d, Y', strtotime ( $row->DATE ) );
    				
    				$arrRes[$i]['flag'] = $row->PRODUCT_TYPE;
    				 
    				if($row->PRODUCT_TYPE == 'product'){
    					$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    					$arrRes[$i]['productName'] = $row->productName;
    					$arrRes[$i]['productUnit'] = $row->productUnit;
    					$arrRes[$i]['unitPrice'] = number_format($row->productPrice,2);
    					 
    					$productImage = $ProductModel->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    					$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";
    					 
    				}else{
    					 
    					$arrRes[$i]['PRODUCT_ID'] = $row->BUNDLE_ID;
    					$arrRes[$i]['productName'] = $row->bundleName;
    					$arrRes[$i]['productUnit'] = $row->bundleUnit;
    					$arrRes[$i]['unitPrice'] = number_format($row->bundlePrice, 2);
    					 
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
//     public function getSpecificCategoryData($id){
    	 
//     	$result = DB::table('jb_category_tbl as a')->select('a.*')
//     	->where('a.CATEGORY_ID',$id)
//     	->orderBy('a.CATEGORY_ID','desc')
//     	->get();
    	 
//     	$i=0;
//     	foreach ($result as $row){
//     		$arrRes['ID'] = $row->CATEGORY_ID;
//     		$arrRes['NAME'] = $row->CATEGORY_NAME;
//     		$arrRes['USER_ID'] = $row->USER_ID;
//     		$arrRes['STATUS'] = $row->STATUS;
//     		$arrRes['DATE'] = $row->DATE;
//     		$arrRes['CREATED_BY'] = $row->CREATED_BY;
//     		$arrRes['CREATED_ON'] = $row->CREATED_ON;
//     		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
//     		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
//     		$i++;
//     	}
    
//     	return isset($arrRes) ? $arrRes : null;
//     }
    
    
}
