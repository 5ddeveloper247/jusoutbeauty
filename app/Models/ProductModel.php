<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\WishlistModel;
use App\Models\Handpicked;
use App\Models\Recomended;
use DateTime;

class ProductModel extends Model
{
    use HasFactory;
	public function getRecomendedProductsWrtProductID($productId){
		$result =DB::table('jb_product_recommend_tbl')->where('PRODUCT_ID',$productId)->get();

            $i=0;
             foreach($result as $s){
                $arrRes[$i] = $s->RECOMEDEDPRODUCT_ID;
                $i++;
             }

             return isset($arrRes) ? $arrRes : null;
	}
		public function gethandPickProductsWrtProductID($product_id){

			$result =DB::table('jb_product_handpicked_tbl')->where('PRODUCT_ID',$product_id)->get();

			$i=0;
			foreach($result as $s){
				$arrRes[$i] = $s->HANDPICKEDPRODUCT_ID;
				$i++;
			}
			return isset($arrRes) ? $arrRes : null;

		}

    public function getAllProductClinicalNoteByProduct($productID){
		$result = DB::table('jb_product_tbl as a')->select('a.CLINICAL_NOTE_DESCRIPTION')
		// ->join(' as b','a.PRODUCT_ID','=','b.PRODUCT_ID')
		// ->where('b.SOURCE_CODE','CLINICAL_NOTE')
		->where('a.PRODUCT_ID',$productID)
    	->first();

		// $arrRes['ID'] = isset($result->PRODUCT_ID) != null ? $result->PRODUCT_ID : '';
		$clinicalData = strip_tags(base64_decode($result->CLINICAL_NOTE_DESCRIPTION));
		$arrRes['P_19'] = isset($clinicalData) != null ?  $clinicalData: '';
		$arrRes['P_20'] = $this->getClinicalNoteImage($productID);

		return isset($arrRes) ? $arrRes : null;

	}
	public function getClinicalNoteImage($productID){
		$result = DB::table('jb_product_images_tbl as a')->select('a.DOWN_PATH')
		->where('a.PRODUCT_ID',$productID)
    	->first();

		return isset($result->DOWN_PATH) != null ? $result->DOWN_PATH: url('assets-web')."/images/product_placeholder.png";
	}

	public function getVideodata($productID){
		$result = DB::table('jb_product_video_tbl as a')->select('a.DOWN_PATH','a.VIDEO_TITLE','a.VIDEO_DESCRIPTION','a.VIDEO_ID')
				->where('a.PRODUCT_ID',$productID)
				->orderBy('VIDEO_ID', 'DESC')->first();

		$arrRes['ID'] = isset($result->VIDEO_ID) != null ? $result->VIDEO_ID : '';
		$arrRes['V_4'] = isset($result->DOWN_PATH) != null ? $result->DOWN_PATH : '';
		$arrRes['V_1'] = isset($result->VIDEO_TITLE) != null ? $result->VIDEO_TITLE : '';
		$arrRes['V_2'] = isset($result->VIDEO_DESCRIPTION) != null ? strip_tags(base64_decode($result->VIDEO_DESCRIPTION)) : '';

		return isset($arrRes) ? $arrRes : null;
	}
    public function getSubscriptionDetailsOfSingleProduct($id){
		// dd($id);
        $result = DB::table('jb_product_tbl as a')
        ->select(
            'a.PRODUCT_ID',
            'a.SUBSCRIPTION_NOTE_DESCRIPTION',
            'a.SUBSCRIPTION_NOTE_LINK',
            'a.SUBSCRIPTION_NOTE_TITLE',
            // 'imgTbl.DOWN_PATH',
            // 'imgTbl.IMAGE_ID'
        )
        // ->join('jb_product_images_tbl as imgTbl', 'a.PRODUCT_ID', '=', 'imgTbl.PRODUCT_ID')
        ->where('a.PRODUCT_ID', $id)
        ->where('a.IS_DELETED', 0)
        // ->orderBy('imgTbl.CREATED_ON','desc')
        // ->limit(1)
        ->get();


        // dd($result);
        // $arrRes['S_1'] = base64_decode($result->SUBSCRIPTION_NOTE_DESCRIPTION);
        foreach($result as $row){
            $arrRes['S_1'] = isset($row->SUBSCRIPTION_NOTE_TITLE ) ? $row->SUBSCRIPTION_NOTE_TITLE : 'Subscription';
            $arrRes['S_2'] = isset($row->SUBSCRIPTION_NOTE_LINK) ? $row->SUBSCRIPTION_NOTE_LINK : 'www.google.com';
            $arrRes['S_3'] = isset($row->SUBSCRIPTION_NOTE_DESCRIPTION) ? strip_tags(base64_decode($row->SUBSCRIPTION_NOTE_DESCRIPTION)) : 'Detailed Description';
            // $arrRes['S_4'] = $row->DOWN_PATH;
            // $arrRes['S_5'] = $row->IMAGE_ID;
        }


        // dd($arrRes);
        return isset($arrRes) ? $arrRes : null ;
    }

	public function getQuickAddProductDataWrtProductID($productID){
		$result = DB::table('jb_product_tbl as a')->select('a.*')
		// ->join('jb_product_images_tbl as b','a.PRODUCT_ID','=','b.PRODUCT_ID')
		// ->where('b.SOURCE_CODE','CLINICAL_NOTE')
		->where('a.PRODUCT_ID',$productID)
		->orderBy('a.PRODUCT_ID','desc')

    	->get();

    	$i=0;
    	foreach ($result as $row){
			$arrRes['P_1'] = $row->NAME;
    		$arrRes['P_2'] = $row->SUB_TITLE;
    		$arrRes['P_3'] = number_format($row->UNIT_PRICE,2);

    		$arrRes['P_4'] = $row->UNIT;
			$arrRes['P_5'] = $row->SHORT_DESCRIPTION;
    		$arrRes['P_6'] = $row->QUANTITY;
			$arrRes['P_13'] = explode(',',$row->FEATURE_ID);

			$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes['P_15'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

			$productSecImage = $this->getSpecificProductSecondaryImage($row->PRODUCT_ID);
    		$arrRes['P_16'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

			$arrRes['P_17'] = $row->DESCRIPTION_TITLE;
    		$arrRes['P_18'] = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes['P_19'] = strip_tags(base64_decode($row->CLINICAL_NOTE_DESCRIPTION));

			$getClinicalNote = $this->getAllProductClinicalNoteByProduct($row->PRODUCT_ID);
			$arrRes['P_20'] = $getClinicalNote['P_20'];
			$arrRes['P_31'] = $row->CATEGORY_ID;
			$arrRes['P_32'] = $row->SUB_CATEGORY_ID;
			$arrRes['P_33'] = $row->SUB_SUB_CATEGORY_ID;

			$arrRes['QUICK_ADD_FEATURES'] = $this->getQuickfeaturesdata($row->FEATURE_ID);

    		$arrRes['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['SLUG'] = $row->SLUG;
    		$arrRes['DOWN_PATH'] = $this->getProductImagesWrtProductID($row->PRODUCT_ID);

    		$arrRes['MINIMUM_PURCHASE_QUANTITY'] = $row->MINIMUM_PURCHASE_QUANTITY;
    		$arrRes['TAGS'] = $row->TAGS;
    		$arrRes['BARCODE'] = $row->BARCODE;
    		$arrRes['REFUNDABLE_FLAG'] = $row->REFUNDABLE_FLAG;
    		// $arrRes['P_31'] = $row->CATEGORY_ID;
    		// $arrRes['CATEGORY_NAME'] = $row->categoryName;
    		// $arrRes['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		// $arrRes['SUB_CATEGORY_NAME'] = $row->subCategoryName;
    		$arrRes['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

    		$arrRes['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes['STATUS'] = $row->STATUS;
    		$arrRes['DATE'] = $row->DATE;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
	}
		public function getProductImagesWrtProductID($PRODUCT_ID){
			$result = DB::table('jb_product_images_tbl as a')->select('a.DOWN_PATH','a.IMAGE_ID','a.PRIMARY_FLAG','a.SECONDARY_FLAG')
			->where('a.PRODUCT_ID',$PRODUCT_ID)
			->where('a.SOURCE_CODE','PRODUCT_IMG')
			->orderByDesc('a.IMAGE_ID')
			->get();
			return isset($result) ? $result : null;
		}

		public function getQuickfeaturesdata($FEATURES_ID){

			$featuresArrExplode = explode(',',$FEATURES_ID);

			$result=DB::table('jb_product_features_tbl as a')
					->select('a.*')
					->whereIn('a.FEATURE_ID',$featuresArrExplode)
					->where('a.STATUS','active')
					->orderBy('a.UPDATED_ON','desc')
					->get();

			$i=0;
			foreach ($result as $row){
				$arrRes[$i]['id'] = $row->FEATURE_ID;//$i+1;
				$arrRes[$i]['FEATURE_NAME'] = $row->FEATURE_NAME;
				$arrRes[$i]['IMAGE_DOWN_PATH'] = $row->IMAGE_DOWN_PATH;
				$i++;
			}

			return isset($arrRes) ? $arrRes : null;

		}

    public function getProductsLov(){
		$ProductShade = new ProductShadeModel();

    	$result = DB::table('jb_product_tbl as a')->select('a.*')

    	->orderBy('a.PRODUCT_ID','desc')
		->where('a.STATUS','active')
		->where('IS_DELETED',0)
    	->get();

    	$i=0;
    	foreach ($result as $row){
			$productShades = $ProductShade->getTotalQuantity($row->PRODUCT_ID);
			// dd($productShades);

			if($productShades != null){

				$arrRes[$i]['INV_QUANTITY_FLAG'] = 'shade';
				$arrRes[$i]['INV_QUANTITY'] = $productShades;
				$arrRes[$i]['id'] = $row->PRODUCT_ID;
    			$arrRes[$i]['name'] = $row->NAME;
				$i++;
			}else if($row->QUANTITY != null){
				$arrRes[$i]['INV_QUANTITY_FLAG'] = 'inv';
				$arrRes[$i]['INV_QUANTITY'] = $row->QUANTITY;
				$arrRes[$i]['id'] = $row->PRODUCT_ID;
    			$arrRes[$i]['name'] = $row->NAME;
				$i++;
			}


    	}
		// $arr = array_values($arrRes);

    	return isset($arrRes) ? $arrRes : null;
    }
	public function getTotalQuantity($PRODUCT_ID){
		$result = DB::table('jb_product_shades_tbl as a')->where('a.PRODUCT_ID', $PRODUCT_ID)->sum('a.QUANTITY');

		if ($result) {
			return isset($result) ? $result : null;
		}
	}
    public function getActiveProductsLov(){

    	$result = DB::table('jb_product_tbl as a')->select('a.*')
    	->where('a.STATUS','active')
		->where('a.IS_DELETED', 0)
    	->orderBy('a.PRODUCT_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->PRODUCT_ID;
    		$arrRes[$i]['name'] = $row->NAME;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getProductsLovWrtCatSubCatSubSubCatIds($catId='', $subCatIds=array(), $subSubCatIds=array()){
    	DB::enableQueryLog();
    	$result = DB::table('jb_product_tbl as a')->select('a.*')
    	->where('a.STATUS','active')
    	->where('a.CATEGORY_ID',$catId)
    	->where('a.IS_DELETED', 0)
    	->orWhereIn('a.SUB_CATEGORY_ID',$subCatIds)
    	->orWhereIn('a.SUB_CATEGORY_ID',$subSubCatIds)
    	->orderBy('a.PRODUCT_ID','desc')
    	->get();
//     	$query = DB::getQueryLog(); dd($query);
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->PRODUCT_ID;
    		$arrRes[$i]['name'] = $row->NAME;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }


    public function getAllProductsData(){
		$ProductShade = new ProductShadeModel();

    	$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName')
    	// $result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->join ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	// ->join ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
//     	->join ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
		->where('a.IS_DELETED',0)
    	->orderBy('a.SEQ_NUM','asc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->PRODUCT_ID;//$i+1;
    		$arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;//$i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
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
    		// $arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subCategoryName;
    		$arrRes[$i]['SHORT_DESCRIPTION'] = $row->SHORT_DESCRIPTION;
    		$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

			$productShades = $ProductShade->getAllProductShadesProduct($row->PRODUCT_ID);

			if(!empty($productShades)){

				$arrRes[$i]['INV_QUANTITY_FLAG'] = 'shade';
				$arrRes[$i]['INV_QUANTITY'] = $productShades;
			}else{
				$arrRes[$i]['INV_QUANTITY_FLAG'] = 'inv';
				$arrRes[$i]['INV_QUANTITY'] = $row->QUANTITY != null ? $row->QUANTITY : '0';
			}

    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
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
    public function checkDuplicateSlug($slug, $id=''){
    	if($id != ''){
	    	$result = DB::table('jb_product_tbl')->select('PRODUCT_ID')
	    	->where('PRODUCT_ID', '!=', $id)
	    	->where('SLUG', "$slug")
	    	->get();
    	}else{
    		$result = DB::table('jb_product_tbl')->select('PRODUCT_ID')
    		->where('SLUG', "$slug")
    		->get();
    	}
    	$i=0;
    	foreach ($result as $row){
    		$productId = $row->PRODUCT_ID;
    	}

    	return isset($productId) ? $productId : '';
    }
    public function getSpecificProductData($id){

    	$result = DB::table('jb_product_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID',$id)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->PRODUCT_ID;
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
    		$arrRes['P_11'] = $row->SHORT_DESCRIPTION != null ? $row->SHORT_DESCRIPTION : '';
    		$arrRes['P_12'] = $row->DESCRIPTION_TITLE != null ? $row->DESCRIPTION_TITLE : '';
    		$arrRes['P_13'] = $row->DESCRIPTION != null ? base64_decode($row->DESCRIPTION) : '';

    		$arrRes['P_14'] = $row->UNIT_PRICE != null ? $row->UNIT_PRICE : '';
    		$arrRes['P_15'] = $row->DISCOUNT_START_DATE != '0000-00-00' ? $row->DISCOUNT_START_DATE : '';
    		$arrRes['P_16'] = $row->DISCOUNT_END_DATE != '0000-00-00' ? $row->DISCOUNT_END_DATE : '';
    		$arrRes['P_17'] = $row->DISCOUNT != null ? $row->DISCOUNT : '';
    		$arrRes['P_18'] = $row->DISCOUNT_TYPE != null ? $row->DISCOUNT_TYPE : '';
    		$arrRes['P_19'] = $row->SET_POINT != null ? $row->SET_POINT : '0';
    		$arrRes['P_20'] = $row->QUANTITY != null ? $row->QUANTITY : '';
    		$arrRes['P_21'] = $row->SKU != null ? $row->SKU : '';
    		$arrRes['P_22'] = $row->EXTERNAL_LINK != null ? $row->EXTERNAL_LINK : '';
    		$arrRes['P_23'] = $row->EXTERNAL_LINK_TEXT != null ? $row->EXTERNAL_LINK_TEXT : '';
    		$arrRes['P_24'] = $row->TAX != null ? $row->TAX : '';
    		$arrRes['P_25'] = $row->TAX_TYPE != null ? $row->TAX_TYPE : '';
    		$arrRes['P_26'] = $row->VAT != null ? $row->VAT : '';
    		$arrRes['P_27'] = $row->VAT_TYPE != null ? $row->VAT_TYPE : '';

    		$arrRes['P_28'] = $row->FREE_SHIPPING_FLAG == '1' ? true : false;
    		$arrRes['P_29'] = $row->PRODUCT_QUANTITY_MULTIPLY_FLAG == '1' ? true : false;
    		$arrRes['P_30'] = $row->FLAT_RATE_FLAG == '1' ? true : false;
    		$arrRes['P_31'] = $row->SHOW_STOCK_QUANTITY_FLAG == '1' ? true : false;
    		$arrRes['P_32'] = $row->SHOW_STOCK_TEXT_FLAG == '1' ? true : false;
    		$arrRes['P_33'] = $row->HIDE_STOCK_FLAG == '1' ? true : false;
    		$arrRes['P_34'] = $row->SHIPPING_DAYS;
    		$arrRes['P_35'] = $row->TODAY_DEAL_FLAG == '1' ? true : false;

    		$arrRes['P_36'] = $row->ADD_TO_FLASH;
    		$arrRes['P_37'] = $row->OTHER_DISCOUNT;
    		$arrRes['P_38'] = $row->OTHER_DISCOUNT_TYPE;

    		$arrRes['P_39'] = $row->CASH_ON_DELIVER_FLAG == '1' ? true : false;
    		$arrRes['P_40'] = $row->FEATURED_FLAG == '1' ? true : false;
    		$arrRes['P_41'] = $row->TODAY_DEAL_FLAG2 == '1' ? true : false;
    		$arrRes['P_42'] = $row->LOW_QUANTITY_WARNING;

    		$arrRes['P_43'] = base64_decode($row->CLINICAL_NOTE_DESCRIPTION);
    		$arrRes['P_44'] = $row->SUB_SUB_CATEGORY_ID;

			$arrRes['P_45'] = explode(',',$row->FEATURE_ID);
			$handpicked= new Handpicked;
			$recommend= new Recomended;
			$arrRes['P_46'] = $recommend->getspecificrecomendedlov($id);
			$arrRes['P_47'] = $handpicked->getspecifichandpickedlov($id);

             //        		$arrRes['USER_ID'] = $row->USER_ID;
             //     		$arrRes['STATUS'] = $row->STATUS;
             //     		$arrRes['DATE'] = $row->DATE;
             //     		$arrRes['CREATED_BY'] = $row->CREATED_BY;
             //     		$arrRes['CREATED_ON'] = $row->CREATED_ON;
             //     		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
             //     		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getSpecificProductImages($id){

    	$result = DB::table('jb_product_images_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $id)
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
    public function getSpecificImage($id){

    	$result = DB::table('jb_product_images_tbl as a')->select('a.*')
    	->where('a.IMAGE_ID', $id)
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


    public function getAllProductsDataForShadeQuiz($ids){
    	$WishlistModel = new WishlistModel();
    	$userId = session('userId');

    	$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->whereIn('a.PRODUCT_ID',$ids)
    	->orderBy('a.PRODUCT_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['SLUG'] = $row->SLUG;
    		$arrRes[$i]['NAME'] = $row->NAME;
    		$arrRes[$i]['SUB_TITLE'] = $row->SUB_TITLE;
    		$arrRes[$i]['SUB_TITLE_TXT'] = strlen ( $row->SUB_TITLE ) > 30?substr ( $row->SUB_TITLE, 0, 30 )."..." :$row->SUB_TITLE;
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
    		$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;

    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : '';

			$productSecImage = $this->getSpecificProductSecondaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['secondaryImage'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    		$arrRes[$i]['wishlistFlag'] = $WishlistModel->getSpecificProductExistByUser1($userId, $row->PRODUCT_ID, 1);

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

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


    public function getProductsCategoryWiseForSite(){
    	$Bundle = new BundleProductModel();

    	$result = DB::table('jb_category_tbl as a')->select('a.*')
    	->where('a.STATUS','active')
    	->orderBy('a.SEQ_NUM','asc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['NAME'] = $row->CATEGORY_NAME;
    		$arrRes[$i]['subCategories'] = $this->getSubCategoryWrtCategoryId($row->CATEGORY_ID);

    		if($row->CATEGORY_NAME == 'Bundles' || $row->CATEGORY_NAME == 'Bundle'){
    			$arrRes[$i]['recommandedProducts'] = $Bundle->getAllRecommandedBundleProductsWrtCategoryIdForSite($row->CATEGORY_ID);
    		}else{
    			$arrRes[$i]['recommandedProducts'] = $this->getAllRecommandedProductsWrtCategoryIdForSite($row->CATEGORY_ID);
    		}

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getSubCategoryWrtCategoryId($categoryId){

    	$result = DB::table('jb_sub_category_tbl as jsct')->select('jsct.*')
    	->where('jsct.CATEGORY_ID', $categoryId)
    	->where('jsct.STATUS','active')
    	->orderBy('jsct.SEQ_NUM','asc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['NAME'] = $row->NAME;

    		$subCatProductImage = $this->getSpecificProductImageSubCategoryWise($row->SUB_CATEGORY_ID);

    		if(isset($subCatProductImage['downPath']) && $subCatProductImage['downPath'] != ''){
    			$arrRes[$i]['prodImg'] = $subCatProductImage['downPath'];
    		}else{
    			$arrRes[$i]['prodImg'] = url('/assets-web')."/images/skin-makeup.jpg";
    		}

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificProductImageSubCategoryWise($id){

    	$result = DB::table('jb_product_images_tbl as a')->select('a.*')
    	->leftJoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->where('jpt.SUB_CATEGORY_ID', $id)
    	->where('a.PRIMARY_FLAG', '1')
    	->where('jpt.STATUS', 'active')
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
    public function getAllRecommandedProductsWrtCategoryIdForSite($categoryId){

    	$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
    	->where('a.CATEGORY_ID',$categoryId)
    	->where('a.STATUS','active')
    	->where('jct.STATUS','active')
    	->where('jsct.STATUS','active')
    	->where('jssct.STATUS','active')
    	->orderBy('a.PRODUCT_ID','desc')
    	->limit('3')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
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
    		$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;

    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllProductDetailsWrtCatSubCatIdForShopListing($catId, $flag, $subSubCategoryIds=array(), $shadeId='', $minRange='', $maxRange='',$sortingType=''){
    	$WishlistModel = new WishlistModel();
    	$ProductShade = new ProductShadeModel();

    	DB::enableQueryLog();
    	$userId = session('userId');

    	if($flag == 'SUB_CATEGORY'){
    		$where =array(['a.SUB_CATEGORY_ID','=',$catId]);
    	}else{
    		$where =array(['a.CATEGORY_ID','=',$catId]);
    	}

    	$where = array_merge($where, array(['a.STATUS','=','active']));
    	$where = array_merge($where, array(['jct.STATUS','=','active']));
    	// $where = array_merge($where, array(['jsct.STATUS','=','active']));
    	// $where = array_merge($where, array(['jssct.STATUS','=','active']));

    	if($shadeId != ''){
    		$where = array_merge($where, array(['jpst.SHADE_ID','=',$shadeId]));
    	}

    	if($minRange != '' && $maxRange != ''){
    		$where = array_merge($where, array(['a.UNIT_PRICE','>=',$minRange]));
    		$where = array_merge($where, array(['a.UNIT_PRICE','<=',$maxRange]));
    	}

    	if($sortingType == 1){
    		$orderByCol = "a.UNIT_PRICE";
    		$orderBy = "desc";
    	}else if($sortingType == 2){
    		$orderByCol = "a.UNIT_PRICE";
    		$orderBy = "asc";
    	}else if($sortingType == 3){
    		$orderByCol = "a.PRODUCT_ID";
    		$orderBy = "desc";
    	}else{
    		$orderByCol = "a.SEQ_NUM";
    		$orderBy = "asc";
    	}

    	if(count($subSubCategoryIds) > 0){

    		$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    		->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_ID', '=', 'jpst.PRODUCT_ID' )
    		->where($where)
			// ->orWhere('jsct.STATUS','active')
			// ->orWhere('jssct.STATUS','active')
			->where('a.IS_DELETED',0)
    		->whereIn('a.SUB_SUB_CATEGORY_ID',$subSubCategoryIds)
    		->orderBy("$orderByCol", "$orderBy")
    		->groupBy('a.PRODUCT_ID')->get();

    	}else{
    		$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName','jsct.STATUS as subCateStatus','jssct.STATUS as subSubCateStatus' )
    		->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_ID', '=', 'jpst.PRODUCT_ID' )
    		->where($where)
			// ->Where('jsct.STATUS','active')
			// ->Where('jssct.STATUS','active')
			->where('a.IS_DELETED',0)
    		->orderBy("$orderByCol", "$orderBy")->groupBy('a.PRODUCT_ID')->get();
    	}

     	//  $query = DB::getQueryLog(); dd($query);



    	$i=0;
    	foreach ($result as $row){

			//  if(($row->subCateStatus == null ||  $row->subCateStatus == 'active') && ($row->subSubCateStatus == null ||  $row->subSubCateStatus == 'active')){
				$arrRes[$i]['seqNo'] = $i+1;
				$arrRes[$i]['subCateStatus'] = $row->subCateStatus;
				$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
				$arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
				$arrRes[$i]['subSubCateStatus'] = $row->subSubCateStatus;
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
				$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

				$productShades = $ProductShade->getAllProductShadesProduct($row->PRODUCT_ID);

				if(!empty($productShades)){

					$arrRes[$i]['INV_QUANTITY_FLAG'] = 'shade';
					$arrRes[$i]['INV_QUANTITY'] = '';
				}else{
					$arrRes[$i]['INV_QUANTITY_FLAG'] = 'inv';
					$arrRes[$i]['INV_QUANTITY'] = $row->QUANTITY != null ? $row->QUANTITY : '0';
				}

				$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
				$descText = strip_tags(base64_decode($row->DESCRIPTION));
				$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
				$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
				$arrRes[$i]['STATUS'] = $row->STATUS;
				$arrRes[$i]['DATE'] = $row->DATE;

				$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
				$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

				$productSecImage = $this->getSpecificProductSecondaryImage($row->PRODUCT_ID);
				$arrRes[$i]['secondaryImage'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";


				$arrRes[$i]['images'] = $this->getSpecificProductImagesByCode($row->PRODUCT_ID, "PRODUCT_IMG");

				$arrRes[$i]['wishlistFlag'] = $WishlistModel->getSpecificProductExistByUser1($userId, $row->PRODUCT_ID, 1);

				$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
				$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
				$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
				$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

				$i++;
			//  }

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
    		// $arrRes['productId'] = $row->PRODUCT_ID;
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
    public function getAllProductDetailsWrtSubCatIdForNutritionShopListing($catId, $flag){
    	DB::enableQueryLog();

    	if($flag == 'SUB_CATEGORY'){
    		$where =array(['a.SUB_CATEGORY_ID','=',$catId]);
    	}else{
    		$where =array(['a.CATEGORY_ID','=',$catId]);
    	}

    	$where = array_merge($where, array(['jct.STATUS','=','active']));
    	$where = array_merge($where, array(['jsct.STATUS','=','active']));
//     	$where = array_merge($where, array(['jssct.STATUS','=','active']));

    	$result = DB::table('jb_product_tbl as a')->where('a.IS_DELETED', 0)->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->leftJoin ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_ID', '=', 'jpst.PRODUCT_ID' )
    	->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
    	->where($where)
    	->orderBy('a.PRODUCT_ID','asc')->groupBy('a.PRODUCT_ID')->get();

//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;$k=1;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
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
    		$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;

    		if($k == 1){
    			$arrRes[$i]['styleBgColor'] = 'background-color: #C0DAB8 !important;';
    		}else if($k == 2){
    			$arrRes[$i]['styleBgColor'] = 'background-color: #0FA353 !important;';
    		}else if($k == 3){
    			$arrRes[$i]['styleBgColor'] = 'background-color: #AFCFDF !important;';
    		}else if($k == 4){
    			$arrRes[$i]['styleBgColor'] = 'background-color: #013062 !important;';
    			$k = 1;
    		}
    		$k++;

    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";
    		$arrRes[$i]['images'] = $this->getSpecificProductImagesByCode($row->PRODUCT_ID, "PRODUCT_IMG");

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }


    public function getSpecificProductDetails($productId){
    	$ProductShade = new ProductShadeModel();
    	DB::enableQueryLog();

    	$where =array(['a.PRODUCT_ID','=',$productId]);

    	$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->leftJoin ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_ID', '=', 'jpst.PRODUCT_ID' )
    	->where($where)
    	->orderBy('a.PRODUCT_ID','asc')->groupBy('a.PRODUCT_ID')->get();

    	//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;$k=1;
    	foreach ($result as $row){
    		$arrRes['seqNo'] = $i+1;
    		$arrRes['PRODUCT_ID'] = $row->PRODUCT_ID;
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
            $arrRes['SUBSCRIPTION_NOTE_TITLE'] = $row->SUBSCRIPTION_NOTE_TITLE;
    		$arrRes['SUBSCRIPTION_NOTE_DESCRIPTION'] = strip_tags(base64_decode($row->SUBSCRIPTION_NOTE_DESCRIPTION));
    		$arrRes['SUBSCRIPTION_NOTE_LINK'] = $row->SUBSCRIPTION_NOTE_LINK;
            $arrRes['SUBSCRIPTION_NOTE_IMAGE'] = $this->getSusbcriptionImage($row->PRODUCT_ID);

            // dd($arrRes['SUBSCRIPTION_NOTE_IMAGE']);

    		$productShades = $ProductShade->getAllProductShadesProduct($row->PRODUCT_ID);

    		if(!empty($productShades)){

    			$arrRes['INV_QUANTITY_FLAG'] = 'shade';
    			$arrRes['INV_QUANTITY'] = '';
    		}else{
    			$arrRes['INV_QUANTITY_FLAG'] = 'inv';
    			$arrRes['INV_QUANTITY'] = $row->QUANTITY != null ? $row->QUANTITY : '0';
    		}

    		$arrRes['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes['unitPrice'] = $row->UNIT_PRICE != null ? $row->UNIT_PRICE : '0';
    		$arrRes['STATUS'] = $row->STATUS;
    		$arrRes['DISCOUNT'] = $row->DISCOUNT;
    		$arrRes['DISCOUNT_TYPE'] = $row->DISCOUNT_TYPE;
    		$arrRes['TAX'] = $row->TAX;
    		$arrRes['TAX_TYPE'] = $row->TAX_TYPE;
    		$arrRes['CLINICAL_NOTE'] = base64_decode($row->CLINICAL_NOTE_DESCRIPTION);

    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";
    		$arrRes['images'] = $this->getSpecificProductImagesByCode($row->PRODUCT_ID, "PRODUCT_IMG");
    		$arrRes['clinicalImage'] = $this->getSpecificProductImagesByCode($row->PRODUCT_ID, "CLINICAL_NOTE");

    		$arrRes['videoDetails'] = $this->getSpecificProductVideo($row->PRODUCT_ID);

    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getSusbcriptionImage($id){
        $result = DB::table('jb_product_images_tbl')->select('DOWN_PATH')
        ->where('PRODUCT_ID',$id)
        ->where('SOURCE_CODE','SUBSCRIPTION_IMAGE')
        ->first();
        return $result;
    }
    public function getSpecificProductUnitPrice($productId){
    	DB::enableQueryLog();

    	$result = DB::table('jb_product_tbl as a')->select('a.*') ->where('a.PRODUCT_ID', $productId)->get();

    	//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;$k=1;
    	foreach ($result as $row){
    		$arrRes['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes['unitPrice'] = $row->UNIT_PRICE != null ? $row->UNIT_PRICE : '0';

    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificProductStatus($productId){
    	DB::enableQueryLog();

    	$result = DB::table('jb_product_tbl as a')->select('a.*') ->where('a.PRODUCT_ID', $productId)->get();

    	//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;$k=1;
    	foreach ($result as $row){
    		$arrRes['STATUS'] = $row->STATUS;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }



    public function getRecommandedProductDetailsForSite($limit=4){
    	$ProductShadeModel = new ProductShadeModel();
    	$WishlistModel = new WishlistModel();
    	$ReviewsModel = new ReviewsModel();
    	DB::enableQueryLog();

    	$userId = session('userId');

    	$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->where('a.RECOMMANDED_FLAG', '1')
    	->where('a.STATUS', 'active')
    	->orderBy('a.CREATED_BY','asc')->groupBy('a.PRODUCT_ID')->limit($limit)->get();

    	//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;$k=1;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
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
    		$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['unitPrice'] = $row->UNIT_PRICE != null ? $row->UNIT_PRICE : '0';
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DISCOUNT'] = $row->DISCOUNT;
    		$arrRes[$i]['DISCOUNT_TYPE'] = $row->DISCOUNT_TYPE;
    		$arrRes[$i]['TAX'] = $row->TAX;
    		$arrRes[$i]['TAX_TYPE'] = $row->TAX_TYPE;
    		$arrRes[$i]['CLINICAL_NOTE'] = base64_decode($row->CLINICAL_NOTE_DESCRIPTION);

    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    		$arrRes[$i]['productShades'] = $ProductShadeModel->getAllProductShadesWithImagByProduct($row->PRODUCT_ID);
    		$arrRes[$i]['wishlistFlag'] = $WishlistModel->getSpecificProductExistByUser1($userId, $row->PRODUCT_ID, 1);

    		$reviews = $ReviewsModel->getAllPublishedReviewsByProductId($row->PRODUCT_ID,'');
    		$totalReviews=0;$allRatingSum=0;
    		if(isset($reviews) && !empty($reviews)){
    			$totalReviews = count($reviews);
    			foreach($reviews as $value){

    				$allRatingSum = $allRatingSum+$value['STAR_RATING'];
    			}
    		}

    		if($totalReviews > 0){
    			$averageRating = $allRatingSum/$totalReviews;
    			$averageRating = round($averageRating);
    		}else{
    			$averageRating = 0;
    		}

    		$arrRes[$i]['averageRating'] = $averageRating;

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getRecentlyViewedProductDetailsForSite($limit=4){
    	$ProductShadeModel = new ProductShadeModel();
    	$WishlistModel = new WishlistModel();
    	$ReviewsModel = new ReviewsModel();
    	DB::enableQueryLog();

    	$userId = session('userId');

    	$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    	->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->where('a.STATUS', 'active')
    	->orderBy('a.CREATED_BY','asc')->groupBy('a.PRODUCT_ID')->limit($limit)->get();

    	//     	    	$query = DB::getQueryLog(); dd($query);
    	$i=0;$k=1;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
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
    		$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['unitPrice'] = $row->UNIT_PRICE != null ? $row->UNIT_PRICE : '0';
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DISCOUNT'] = $row->DISCOUNT;
    		$arrRes[$i]['DISCOUNT_TYPE'] = $row->DISCOUNT_TYPE;
    		$arrRes[$i]['TAX'] = $row->TAX;
    		$arrRes[$i]['TAX_TYPE'] = $row->TAX_TYPE;
    		$arrRes[$i]['CLINICAL_NOTE'] = base64_decode($row->CLINICAL_NOTE_DESCRIPTION);

    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

			$productSecImage = $this->getSpecificProductSecondaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['secondaryImage'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    		$arrRes[$i]['productShades'] = $ProductShadeModel->getAllProductShadesWithImagByProduct($row->PRODUCT_ID);
    		$arrRes[$i]['wishlistFlag'] = $WishlistModel->getSpecificProductExistByUser1($userId, $row->PRODUCT_ID, 1);

    		$reviews = $ReviewsModel->getAllPublishedReviewsByProductId($row->PRODUCT_ID,'');
    		$totalReviews=0;$allRatingSum=0;
    		if(isset($reviews) && !empty($reviews)){
    			$totalReviews = count($reviews);
    			foreach($reviews as $value){

    				$allRatingSum = $allRatingSum+$value['STAR_RATING'];
    			}
    		}

    		if($totalReviews > 0){
    			$averageRating = $allRatingSum/$totalReviews;
    			$averageRating = round($averageRating);
    		}else{
    			$averageRating = 0;
    		}

    		$arrRes[$i]['averageRating'] = $averageRating;

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function checkProductExistWrtCategoryId($categoryId,$flag='1'){

    	if($flag == '1'){
    		$result = DB::table('jb_product_tbl as a')->select('a.*') ->where('a.CATEGORY_ID', $categoryId) ->get();
    	} else if($flag == '2'){
    		$result = DB::table('jb_product_tbl as a')->select('a.*') ->where('a.SUB_CATEGORY_ID', $categoryId) ->get();
    	}else if($flag == '3'){
    		$result = DB::table('jb_product_tbl as a')->select('a.*') ->where('a.SUB_SUB_CATEGORY_ID', $categoryId) ->get();
    	}

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }





    public function getAllProductDetailsForAllShopListing($subSubCategoryIds=array(), $shadeId='', $minRange='', $maxRange='',$sortingType=''){
    	$WishlistModel = new WishlistModel();
		$ProductShade = new ProductShadeModel();
    	DB::enableQueryLog();
    	$userId = session('userId');

		$where =array(['a.CATEGORY_ID','!=', '8']); // for nutrition check

    	$where = array_merge($where, array(['a.STATUS','=','active']));
    	$where = array_merge($where, array(['jct.STATUS','=','active']));

    	// $where = array_merge($where, array(['jsct.STATUS','=','active']));
    	// $where = array_merge($where, array(['jssct.STATUS','=','active']));


    	if($shadeId != ''){
    		$where = array_merge($where, array(['jpst.SHADE_ID','=',$shadeId]));
    	}

    	if($minRange != '' && $maxRange != ''){
    		$where = array_merge($where, array(['a.UNIT_PRICE','>=',$minRange]));
    		$where = array_merge($where, array(['a.UNIT_PRICE','<=',$maxRange]));
    	}

    	if($sortingType == 1){
    		$orderByCol = "a.UNIT_PRICE";
    		$orderBy = "desc";
    	}else if($sortingType == 2){
    		$orderByCol = "a.UNIT_PRICE";
    		$orderBy = "asc";
    	}else if($sortingType == 3){
    		$orderByCol = "a.PRODUCT_ID";
    		$orderBy = "desc";
    	}else{
    		$orderByCol = "a.SEQ_NUM";
    		$orderBy = "asc";
    	}

    	if(count($subSubCategoryIds) > 0){

    		$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    		->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_ID', '=', 'jpst.PRODUCT_ID' )
    		->where($where)
    		->whereIn('a.SUB_SUB_CATEGORY_ID',$subSubCategoryIds)
    		->orderBy("$orderByCol", "$orderBy")
    		->groupBy('a.PRODUCT_ID')->get();

    	}else{
    		$result = DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
    		->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_sub_sub_category_tbl as jssct', 'a.SUB_SUB_CATEGORY_ID', '=', 'jssct.SUB_SUB_CATEGORY_ID' )
    		->leftJoin ( 'jb_product_shades_tbl as jpst', 'a.PRODUCT_ID', '=', 'jpst.PRODUCT_ID' )
    		->where($where)
    		->orderBy("$orderByCol", "$orderBy")->groupBy('a.PRODUCT_ID')->get();
    	}

    	//     	$query = DB::getQueryLog(); dd($query);
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
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
    		$arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;
			$productShades = $ProductShade->getAllProductShadesProduct($row->PRODUCT_ID);

				if(!empty($productShades)){

					$arrRes[$i]['INV_QUANTITY_FLAG'] = 'shade';
					$arrRes[$i]['INV_QUANTITY'] = '';
				}else{
					$arrRes[$i]['INV_QUANTITY_FLAG'] = 'inv';
					$arrRes[$i]['INV_QUANTITY'] = $row->QUANTITY != null ? $row->QUANTITY : '0';
				}

    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;

    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

			$productSecImage = $this->getSpecificProductSecondaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['secondaryImage'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    		$arrRes[$i]['images'] = $this->getSpecificProductImagesByCode($row->PRODUCT_ID, "PRODUCT_IMG");


    		$arrRes[$i]['wishlistFlag'] = $WishlistModel->getSpecificProductExistByUser1($userId, $row->PRODUCT_ID, 1);

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
}
