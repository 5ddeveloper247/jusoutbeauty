<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ProductShadeModel;
use DateTime;

class BundleProductLineModel extends Model
{
    use HasFactory;
    
    
    public function getAllBundleProductLines($bundleId){
    
    	$result = DB::table('jb_bundle_product_line_tbl as a')->select('a.*', 'jpt.*','a.STATUS as lineStatus','a.DATE as lineDate', 'jct.CATEGORY_NAME as categoryName')
    	->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->join ( 'jb_category_tbl as jct', 'jpt.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->where('a.BUNDLE_ID',$bundleId)
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->BUNDLE_LINE_ID;//$i+1;
    		$arrRes[$i]['BUNDLE_LINE_ID'] = $row->BUNDLE_LINE_ID;
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
    		$arrRes[$i]['SHORT_DESCRIPTION'] = $row->SHORT_DESCRIPTION;
    		$arrRes[$i]['LINE_STATUS'] = $row->lineStatus;
    		$arrRes[$i]['PRODUCT_PRICE'] = number_format($row->PRODUCT_PRICE,2);
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['LINE_DATE'] = date ( 'd-M-Y', strtotime ( $row->lineDate ) );
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function checkDuplicateProductWrtBundleId($productId, $bundleId='', $bundleLineId=''){
    	if($bundleLineId != ''){
	    	$result = DB::table('jb_bundle_product_line_tbl')->select('BUNDLE_LINE_ID')
	    	->where('BUNDLE_LINE_ID', '!=', $bundleLineId)
	    	->where('BUNDLE_ID', "$bundleId")
	    	->where('PRODUCT_ID', "$productId")
	    	->get();
    	}else{
    		$result = DB::table('jb_bundle_product_line_tbl')->select('BUNDLE_LINE_ID')
    		->where('BUNDLE_ID', "$bundleId")
    		->where('PRODUCT_ID', "$productId")
    		->get();
    	}
    	$i=0;
    	foreach ($result as $row){
    		$bundleLineId = $row->BUNDLE_LINE_ID;
    	}
    
    	return isset($bundleLineId) ? $bundleLineId : '';
    }
    
    
    public function getBundleLineAmountsSum($bundleId){
    
    	$result = DB::table('jb_bundle_product_line_tbl as a')->select('a.*')
    	->where('a.BUNDLE_ID',$bundleId)
    	->get();
    
    	$i=0;$totalPrice = 0;
    	foreach ($result as $row){
    		$totalPrice = $totalPrice + $row->PRODUCT_PRICE;
    	
    	}
    
    	return isset($totalPrice) ? $totalPrice : 0;
    }
    
    
    public function getAllBundleProductLinesForWebsite($bundleId){
    	$ProductIngredient = new ProductIngredientModel();
    	$ProductUses = new ProductUsesModel();
		$ProductSelfiModel = new ProductSelfiModel();
    	
    	$result = DB::table('jb_bundle_product_line_tbl as a')->select('a.*','jpt.PRODUCT_ID' , 'jpt.*','a.STATUS as lineStatus','a.DATE as lineDate', 'jct.CATEGORY_NAME as categoryName')
    	->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->join ( 'jb_category_tbl as jct', 'jpt.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->where('a.BUNDLE_ID',$bundleId)
    	->orderBy('a.BUNDLE_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['BUNDLE_LINE_ID'] = $row->BUNDLE_LINE_ID;
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
    		$arrRes[$i]['SHORT_DESCRIPTION'] = $row->SHORT_DESCRIPTION;
    		$arrRes[$i]['LINE_STATUS'] = $row->lineStatus;
    		$arrRes[$i]['PRODUCT_PRICE'] = number_format($row->PRODUCT_PRICE,2);
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['LINE_DATE'] = date ( 'd-M-Y', strtotime ( $row->lineDate ) );
    
    		
    		
    		$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;
    		
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['unitPrice'] = $row->UNIT_PRICE != null ? $row->UNIT_PRICE : '0';
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CLINICAL_NOTE'] = base64_decode($row->CLINICAL_NOTE_DESCRIPTION);
    		
    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";
    		$arrRes[$i]['images'] = $this->getSpecificProductImagesByCode($row->PRODUCT_ID, "PRODUCT_IMG");
    		$arrRes[$i]['clinicalImage'] = $this->getSpecificProductImagesByCode($row->PRODUCT_ID, "CLINICAL_NOTE");
    		$arrRes[$i]['productselfi'] = $ProductSelfiModel->getAllProductsSelfie($row->PRODUCT_ID);
    		$arrRes[$i]['productSelfi_id'] = $row->PRODUCT_ID;
    		
    		$arrRes[$i]['spotlightIngredients'] = $ProductIngredient->getAllProductIngredientWrtType($row->PRODUCT_ID, 'Spotlight');
    		$arrRes[$i]['formulatedIngredients'] = $ProductIngredient->getAllProductIngredientWrtType($row->PRODUCT_ID, 'Formulated');
    		$arrRes[$i]['allIngredients'] = $ProductIngredient->getAllProductIngredientByProduct($row->PRODUCT_ID);
    		$arrRes[$i]['productUses'] = $ProductUses->getAllProductUsesLimitedByProductId($row->PRODUCT_ID);
    		$arrRes[$i]['videoDetails'] = $this->getSpecificProductVideo($row->PRODUCT_ID);
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }

	public function getSpecificProductVideo($id){
    
    	$result = DB::table('jb_product_video_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->VIDEO_ID;
    		$arrRes['V_1'] = $row->VIDEO_TITLE;
    		$arrRes['V_2'] = base64_decode($row->VIDEO_DESCRIPTION);
    		$arrRes['V_3'] = $row->DOWN_PATH;
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
    public function getSpecificProductImagesByCode($id, $code){
    
    	$result = DB::table('jb_product_images_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $id)
    	->where('a.SOURCE_CODE', $code)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ID'] = $row->IMAGE_ID;
    		$arrRes[$i]['userId'] = $row->USER_ID;
    		$arrRes[$i]['productId'] = $row->PRODUCT_ID;
    		$arrRes[$i]['code'] = $row->SOURCE_CODE;
    		$arrRes[$i]['fileType'] = $row->FILE_TYPE;
    		$arrRes[$i]['fileName'] = $row->FILE_NAME;
    		$arrRes[$i]['fullName'] = $row->FULL_NAME;
    		$arrRes[$i]['path'] = $row->PATH;
    		$arrRes[$i]['downPath'] = $row->DOWN_PATH;
    		$arrRes[$i]['primFlag'] = $row->PRIMARY_FLAG;
    		$arrRes[$i]['secFlag'] = $row->SECONDARY_FLAG;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getAllBundleProductLineIdsWrtBundleId($bundleId){
    	$ProductShade = new ProductShadeModel();
    	
    	$result = DB::table('jb_bundle_product_line_tbl as a')->select('a.*','jpt.NAME as productName')
		->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->where('a.BUNDLE_ID',$bundleId)
    	->orderBy('a.BUNDLE_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['BUNDLE_LINE_ID'] = $row->BUNDLE_LINE_ID;
    		$arrRes[$i]['BUNDLE_ID'] = $row->BUNDLE_ID;
			$arrRes[$i]['productName'] = $row->productName;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['PRODUCT_PRICE'] = $row->PRODUCT_PRICE;
    		$arrRes[$i]['productShades'] = $ProductShade->getAllProductShadesWithImagByProduct($row->PRODUCT_ID);
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : array();
    }
    
    public function checkProductBundleWrtProductId($productId){
    
    	$result = DB::table('jb_bundle_product_line_tbl as a')->select('a.*') ->where('a.PRODUCT_ID', $productId) ->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}
    
    	return isset($check) ? $check : false;
    }
    
    public function getAllBundleProductLinesForInvChk($bundleId){
    
    	$result = DB::table('jb_bundle_product_line_tbl as a')->select('a.*', 'jpt.*', 'jpt.QUANTITY as prodQty')
    	->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->where('a.BUNDLE_ID',$bundleId)
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->BUNDLE_LINE_ID;//$i+1;
    		$arrRes[$i]['BUNDLE_LINE_ID'] = $row->BUNDLE_LINE_ID;
    		$arrRes[$i]['BUNDLE_ID'] = $row->BUNDLE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['NAME'] = $row->NAME;
    		$arrRes[$i]['prodQty'] = $row->prodQty;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
}
