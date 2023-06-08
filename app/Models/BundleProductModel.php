<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\WishlistModel;
use DateTime;

class BundleProductModel extends Model
{
    use HasFactory;
    
    
    public function getAllBundleProductsData(){
    
    	$result = DB::table('jb_bundle_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName')
    	->join ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
		->where('a.IS_DELETED',0)
    	->orderBy('a.SEQ_NUM','asc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->BUNDLE_ID;//$i+1;
    		$arrRes[$i]['BUNDLE_ID'] = $row->BUNDLE_ID;
    		$arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['SLUG'] = $row->SLUG;
    		$arrRes[$i]['NAME'] = $row->NAME;
    		$arrRes[$i]['SUB_TITLE'] = $row->SUB_TITLE;
    		$arrRes[$i]['UNIT'] = $row->UNIT;
    		$arrRes[$i]['MINIMUM_PURCHASE_QUANTITY'] = $row->MINIMUM_PURCHASE_QUANTITY;
    		$arrRes[$i]['TAGS'] = $row->TAGS;
    		$arrRes[$i]['BARCODE'] = $row->BARCODE;
    		$arrRes[$i]['REFUNDABLE_FLAG'] = $row->REFUNDABLE_FLAG;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_NAME'] = $row->categoryName;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['SHORT_DESCRIPTION'] = $row->SHORT_DESCRIPTION;
    		
    		$arrRes[$i]['TOTAL_AMOUNT'] = number_format($row->TOTAL_AMOUNT,2);
    		$arrRes[$i]['DISCOUNTED_AMOUNT'] = number_format($row->DISCOUNTED_AMOUNT,2);
    		$arrRes[$i]['VAT_RATE'] = $row->VAT_RATE;
    		
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
    public function getSpecificBundleProductData($id){
    
    	$result = DB::table('jb_bundle_product_tbl as a')->select('a.*')
    	->where('a.BUNDLE_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->BUNDLE_ID;
    		$arrRes['P_1'] = $row->NAME;
    		$arrRes['P_2'] = $row->SUB_TITLE;
    		$arrRes['P_3'] = $row->UNIT;
    		$arrRes['P_4'] = $row->MINIMUM_PURCHASE_QUANTITY;
    		$arrRes['P_5'] = $row->TAGS;
    		$arrRes['P_6'] = $row->BARCODE;
    		$arrRes['P_7'] = $row->REFUNDABLE_FLAG == '1' ? true : false;
    		$arrRes['P_8'] = $row->CATEGORY_ID;
    		$arrRes['P_9'] = $row->SUB_CATEGORY_ID;
    		$arrRes['P_10'] = $row->SLUG;
    		$arrRes['P_11'] = $row->SUB_CATEGORY_ID;
    		$arrRes['P_12'] = $row->VAT_RATE;
    		$arrRes['P_13'] = $row->TOTAL_AMOUNT != null ? $row->TOTAL_AMOUNT : 0;
    		$arrRes['P_14'] = $row->SHORT_DESCRIPTION != null ? $row->SHORT_DESCRIPTION : '';
    		$arrRes['P_15'] = $row->DISCOUNTED_AMOUNT != null ? $row->DISCOUNTED_AMOUNT : 0;
    		$arrRes['P_16'] = $row->QUANTITY != null ? $row->QUANTITY : 0;
    		$arrRes['image'] = $row->IMAGE_DOWN_PATH != null ? $row->IMAGE_DOWN_PATH : '';
    		$arrRes['path'] = $row->IMAGE_PATH != null ? $row->IMAGE_PATH : '';
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getAllRecommandedBundleProductsWrtCategoryIdForSite($categoryId){
    
    	$result = DB::table('jb_bundle_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->join ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
    	->where('a.STATUS','active')
    	->where('jct.STATUS','active')
    	->where('jsct.STATUS','active')
    	->where('jssct.STATUS','active')
    	->orderBy('a.BUNDLE_ID','desc')
    	->limit('3')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->BUNDLE_ID;
    		$arrRes[$i]['BUNDLE_ID'] = $row->BUNDLE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['SLUG'] = $row->SLUG;
    		$arrRes[$i]['NAME'] = $row->NAME;
    		$arrRes[$i]['SUB_TITLE'] = $row->SUB_TITLE;
    		$arrRes[$i]['UNIT'] = $row->UNIT;
    		$arrRes[$i]['MINIMUM_PURCHASE_QUANTITY'] = $row->MINIMUM_PURCHASE_QUANTITY;
    		$arrRes[$i]['TAGS'] = $row->TAGS;
    		$arrRes[$i]['BARCODE'] = $row->BARCODE;
    		$arrRes[$i]['REFUNDABLE_FLAG'] = $row->REFUNDABLE_FLAG;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_NAME'] = $row->categoryName;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subCategoryName;
    		$arrRes[$i]['SHORT_DESCRIPTION'] = $row->SHORT_DESCRIPTION;
    
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->TOTAL_AMOUNT,2);
    		$arrRes[$i]['DISCOUNTED_AMOUNT'] = number_format($row->DISCOUNTED_AMOUNT,2);
    		$arrRes[$i]['VAT_RATE'] = $row->VAT_RATE;
    
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['primaryImage'] = isset($row->IMAGE_DOWN_PATH) != null ? $row->IMAGE_DOWN_PATH : url('assets-web')."/images/product_placeholder.png";
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    
    public function getAllBundleProductDetailsWrtCatSubCatIdForShopListing($catId, $flag, $subSubCategoryIds=array(), $shadeId='', $minRange='', $maxRange='',$sortingType=''){
    	$WishlistModel = new WishlistModel();
    	DB::enableQueryLog();
    	$userId = session('userId');
    	 
    	if($flag == 'SUB_CATEGORY'){
    		$where =array(['a.SUB_CATEGORY_ID','=',"$catId"]);
    	}else{
    		$where =array(['a.CATEGORY_ID','=', "$catId"]);
    	}
    	 
    	$where = array_merge($where, array(['a.STATUS','=','active']));
    	$where = array_merge($where, array(['jct.STATUS','=','active']));
    	// $where = array_merge($where, array(['jsct.STATUS','=','active']));
//     	$where = array_merge($where, array(['jssct.STATUS','=','active']));
    	
//     	if($shadeId != ''){
//     		$where = array_merge($where, array(['jpst.SHADE_ID','=',$shadeId]));
//     	}
    	 
    	if($minRange != '' && $maxRange != ''){
    		$where = array_merge($where, array(['a.DISCOUNTED_AMOUNT','>=',$minRange]));
    		$where = array_merge($where, array(['a.DISCOUNTED_AMOUNT','<=',$maxRange]));
    	}
    	 
    	if($sortingType == 1){
    		$orderByCol = "a.DISCOUNTED_AMOUNT";
    		$orderBy = "desc";
    	}else if($sortingType == 2){
    		$orderByCol = "a.DISCOUNTED_AMOUNT";
    		$orderBy = "asc";
    	}else if($sortingType == 3){
    		$orderByCol = "a.BUNDLE_ID";
    		$orderBy = "desc";
    	}else{
    		$orderByCol = "a.SEQ_NUM";
    		$orderBy = "asc";
    	}
    	
    	if(count($subSubCategoryIds) > 0){
    
    		$result = DB::table('jb_bundle_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    		->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
//     		->leftJoin ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_ID', '=', 'jpst.PRODUCT_ID' )
    		->where($where)
    		->whereIn('a.SUB_SUB_CATEGORY_ID',$subSubCategoryIds)
    		->orderBy("$orderByCol", "$orderBy")->groupBy('a.BUNDLE_ID')->get();
    
    	}else{
    		$result = DB::table('jb_bundle_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    		->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
//     		->leftJoin ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_ID', '=', 'jpst.PRODUCT_ID' )
    		->where($where)
    		->orderBy("$orderByCol", "$orderBy")->groupBy('a.BUNDLE_ID')->get();
    	}
    	 
//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->BUNDLE_ID;
    		$arrRes[$i]['BUNDLE_ID'] = $row->BUNDLE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['SLUG'] = $row->SLUG;
    		$arrRes[$i]['NAME'] = $row->NAME;
    		$arrRes[$i]['SUB_TITLE'] = $row->SUB_TITLE;
    		$arrRes[$i]['SUB_TITLE_TXT'] = strlen ( $row->SUB_TITLE ) > 60?substr ( $row->SUB_TITLE, 0, 60 )."..." :$row->SUB_TITLE;
    		$arrRes[$i]['UNIT'] = $row->UNIT;
    		$arrRes[$i]['MINIMUM_PURCHASE_QUANTITY'] = $row->MINIMUM_PURCHASE_QUANTITY;
    		$arrRes[$i]['TAGS'] = $row->TAGS;
    		$arrRes[$i]['BARCODE'] = $row->BARCODE;
    		$arrRes[$i]['REFUNDABLE_FLAG'] = $row->REFUNDABLE_FLAG;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_NAME'] = $row->categoryName;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subCategoryName;
    		$arrRes[$i]['SHORT_DESCRIPTION'] = $row->SHORT_DESCRIPTION;
    		$arrRes[$i]['INV_QUANTITY_FLAG'] = 'bundle';
    		$arrRes[$i]['INV_QUANTITY'] = $row->QUANTITY;
    
//     		$arrRes[$i]['UNIT_PRICE'] = number_format($row->TOTAL_AMOUNT,2);
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->DISCOUNTED_AMOUNT,2);
    		$arrRes[$i]['DISCOUNTED_AMOUNT'] = number_format($row->DISCOUNTED_AMOUNT,2);
    		$arrRes[$i]['VAT_RATE'] = $row->VAT_RATE;
    
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['primaryImage'] = isset($row->IMAGE_DOWN_PATH) != null ? $row->IMAGE_DOWN_PATH : url('assets-web')."/images/product_placeholder.png";
    
			// $productImage = $this->getSpecificProductPrimaryImage($row->BUNDLE_ID);
    		// $arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

			// $productSecImage = $this->getSpecificProductSecondaryImage($row->BUNDLE_ID);
    		// $arrRes[$i]['secondaryImage'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    		$arrRes[$i]['wishlistFlag'] = $WishlistModel->getSpecificProductExistByUser1($userId, $row->BUNDLE_ID, 2);
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificProductSecondaryImage($id){
    
    	$result = DB::table('jb_product_images_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $id)
    	->where('a.SOURCE_CODE', 'PRODUCT_IMG')
    	->where('a.SECONDARY_FLAG', '1')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->IMAGE_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['productId'] = $row->PRODUCT_ID;
    		$arrRes['code'] = $row->SOURCE_CODE;
    		$arrRes['fileType'] = $row->FILE_TYPE;
    		$arrRes['fileName'] = $row->FILE_NAME;
    		$arrRes['fullName'] = $row->FULL_NAME;
    		$arrRes['path'] = $row->PATH;
    		$arrRes['downPath'] = $row->DOWN_PATH;
    		$arrRes['primFlag'] = $row->PRIMARY_FLAG;
    		$arrRes['secFlag'] = $row->SECONDARY_FLAG;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }

	public function getSpecificProductPrimaryImage($id){
    
    	$result = DB::table('jb_product_images_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $id)
    	->where('a.SOURCE_CODE', 'PRODUCT_IMG')
    	->where('a.PRIMARY_FLAG', '1')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->IMAGE_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['productId'] = $row->PRODUCT_ID;
    		$arrRes['code'] = $row->SOURCE_CODE;
    		$arrRes['fileType'] = $row->FILE_TYPE;
    		$arrRes['fileName'] = $row->FILE_NAME;
    		$arrRes['fullName'] = $row->FULL_NAME;
    		$arrRes['path'] = $row->PATH;
    		$arrRes['downPath'] = $row->DOWN_PATH;
    		$arrRes['primFlag'] = $row->PRIMARY_FLAG;
    		$arrRes['secFlag'] = $row->SECONDARY_FLAG;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificBundleProductDetails($bundleId){
    	DB::enableQueryLog();
    	 
    	$where =array(['a.BUNDLE_ID','=',$bundleId]);
    
    	$result = DB::table('jb_bundle_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->where($where)->groupBy('a.BUNDLE_ID')->get();
    
    	//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['seqNo'] = $i+1;
    		$arrRes['BUNDLE_ID'] = $row->BUNDLE_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['SLUG'] = $row->SLUG;
    		$arrRes['NAME'] = $row->NAME;
    		$arrRes['SUB_TITLE'] = $row->SUB_TITLE;
    		$arrRes['UNIT'] = $row->UNIT;
    		$arrRes['MINIMUM_PURCHASE_QUANTITY'] = $row->MINIMUM_PURCHASE_QUANTITY;
    		$arrRes['TAGS'] = $row->TAGS;
    		$arrRes['BARCODE'] = $row->BARCODE;
    		$arrRes['REFUNDABLE_FLAG'] = $row->REFUNDABLE_FLAG;
    		$arrRes['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes['CATEGORY_NAME'] = $row->categoryName;
    		$arrRes['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes['SUB_CATEGORY_NAME'] = $row->subCategoryName;
    		$arrRes['SHORT_DESCRIPTION'] = $row->SHORT_DESCRIPTION;
    		$arrRes['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;
    		$arrRes['TOTAL_AMOUNT'] = number_format($row->TOTAL_AMOUNT,2);
    		$arrRes['TOTAL_AMOUNT1'] = $row->TOTAL_AMOUNT;
    		$arrRes['DISCOUNTED_AMOUNT'] = number_format($row->DISCOUNTED_AMOUNT,2);
    		$arrRes['DISCOUNTED_AMOUNT1'] = $row->DISCOUNTED_AMOUNT;
    		$arrRes['VAT_RATE'] = $row->VAT_RATE;
    		$arrRes['INV_QUANTITY'] = $row->QUANTITY;
    		
    		$arrRes['primaryImage'] = isset($row->IMAGE_DOWN_PATH) != null ? $row->IMAGE_DOWN_PATH : url('assets-web')."/images/product_placeholder.png";
    		
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificBundleStatus($bundleId){
    	DB::enableQueryLog();
    
    	$result = DB::table('jb_bundle_product_tbl as a')->select('a.*') ->where('a.BUNDLE_ID', $bundleId)->get();
    
    	//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;$k=1;
    	foreach ($result as $row){
    		$arrRes['STATUS'] = $row->STATUS;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
}
