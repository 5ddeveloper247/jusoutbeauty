<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserdashboardModel extends Model
{
    use HasFactory;


    public function getAllUserBanners(){

    	$result = DB::table('jb_user_home_banner_tbl as a')->select('a.*')
    	->orderBy('a.BANNER_ID')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['BANNER_ID'] = $row->BANNER_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['BUTTON_TEXT'] = $row->BUTTON_TEXT;
    		$arrRes[$i]['BUTTON_LINK'] = $row->BUTTON_LINK;
    		$arrRes[$i]['DESCRIPTION'] = $row->DESCRIPTION;
    		$arrRes[$i]['IMAGE_PATH'] = $row->IMAGE_PATH;
    		$arrRes[$i]['IMAGE_DOWNPATH'] = $row->IMAGE_DOWNPATH;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificUserBannerById($bannerId){

    	$result = DB::table('jb_user_home_banner_tbl as a')->select('a.*')
    	->where('a.BANNER_ID',$bannerId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['BANNER_ID'] = $row->BANNER_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['BUTTON_TEXT'] = $row->BUTTON_TEXT;
    		$arrRes['BUTTON_LINK'] = $row->BUTTON_LINK;
    		$arrRes['DESCRIPTION'] = $row->DESCRIPTION;
    		$arrRes['IMAGE_PATH'] = $row->IMAGE_PATH;
    		$arrRes['IMAGE_DOWNPATH'] = $row->IMAGE_DOWNPATH;
    		$arrRes['DATE'] = $row->DATE;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }




    public function getAllUserBestExcData(){

    	$result = DB::table('jb_user_home_bestexclusive_tbl as a')->select('a.*','jpt.SLUG as slug','ctbl.CATEGORY_NAME as categoryName','sctbl.NAME as subCategoryName')
            ->join('jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
            ->leftjoin('jb_category_tbl as ctbl','jpt.CATEGORY_ID','=','ctbl.CATEGORY_ID')
            ->leftjoin('jb_sub_category_tbl as sctbl','jpt.SUB_CATEGORY_ID','=','sctbl.SUB_CATEGORY_ID')
    	    ->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['BESTEXC_ID'] = $row->BESTEXC_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['HEADING'] = $row->HEADING;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
            $arrRes[$i]['SLUG'] = $row->slug;
            $name = $row->categoryName;
            $words = explode(' ', $name);
            if (count($words) > 1 || strpos($name, ' ') !== false) {
                $name = implode('-', $words);
            } else {
                $name = $row->categoryName;
            }
            $arrRes[$i]['CATEGORY_SLUG'] = $name;

            $name = $row->subCategoryName;
            $words = explode(' ', $name);
            if (count($words) > 1 || strpos($name, ' ') !== false) {
                $name = implode('-', $words);
            } else {
                $name = $row->subCategoryName;
            }
            $arrRes[$i]['SUB_CATEGORY_SLUG'] = $name;
    		$arrRes[$i]['IMAGE_PATH'] = $row->IMAGE_PATH;
    		$arrRes[$i]['IMAGE_DOWNPATH'] = $row->IMAGE_DOWNPATH;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificUserBestExcById($bestexcId){

    	$result = DB::table('jb_user_home_bestexclusive_tbl as a')->select('a.*')
    	->where('a.BESTEXC_ID',$bestexcId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['BESTEXC_ID'] = $row->BESTEXC_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['HEADING'] = $row->HEADING;
    		$arrRes['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes['IMAGE_PATH'] = $row->IMAGE_PATH;
    		$arrRes['IMAGE_DOWNPATH'] = $row->IMAGE_DOWNPATH;
    		$arrRes['DATE'] = $row->DATE;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }



    public function getAllUserHomeProductSectionData($code){

    	$result = DB::table('jb_user_home_product_section_tbl as a')->select('a.*','jct.CATEGORY_NAME as categoryName','jpt.NAME as productName','jpt.UNIT_PRICE as productPrice')
    	->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->join ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->where('a.BATCH_CODE', $code)
    	->orderBy('a.SECTION_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SECTION_ID'] = $row->SECTION_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['BATCH_CODE'] = $row->BATCH_CODE;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_NAME'] = $row->categoryName;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['PRODUCT_NAME'] = $row->productName;
    		$arrRes[$i]['PRODUCT_PRICE'] = number_format($row->productPrice,2);

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

    public function getAllUserHomeProductSectionData1($code){
    	$WishlistModel = new WishlistModel();
    	$ProductShade = new ProductShadeModel();
    	$userId = session('userId');

    	$result = DB::table('jb_user_home_product_section_tbl as a')->select('a.*','jct.CATEGORY_NAME as categoryName','jpt.UNIT','jpt.NAME as productName','jpt.SLUG as slug','jpt.SUB_CATEGORY_ID as subcategoryid','sbcat.NAME as subcategoryname','jpt.SUB_TITLE','jpt.SHORT_DESCRIPTION as productDescription','jpt.UNIT_PRICE as productPrice','jpt.QUANTITY','jpt.SEQ_NUM')
    	->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->leftjoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
        ->leftjoin ('jb_sub_category_tbl as sbcat','jpt.SUB_CATEGORY_ID','=','sbcat.SUB_CATEGORY_ID')
		->where('jpt.STATUS','active')
    	->where('a.BATCH_CODE', $code)
    	->orderBy('jpt.SEQ_NUM','asc')
    	->get();
        // dd($result);
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SECTION_ID'] = $row->SECTION_ID;
    		$arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['BATCH_CODE'] = $row->BATCH_CODE;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_NAME'] = $row->categoryName;
            $arrRes[$i]['SLUG'] = $row->slug;
            $arrRes[$i]['SUB_CATEGORY_ID'] = $row->subcategoryid;
            $arrRes[$i]['UNIT'] = $row->UNIT;
            $name = $row->categoryName;
            $words = explode(' ', $name);
            if (count($words) > 1 || strpos($name, ' ') !== false) {
                $name = implode('-', $words);
            } else {
                $name = $row->categoryName;
            }
            $arrRes[$i]['CATEGORY_SLUG'] = $name;

            $name = $row->subcategoryname;
            $words = explode(' ', $name);
            if (count($words) > 1 || strpos($name, ' ') !== false) {
                $name = implode('-', $words);
            } else {
                $name = $row->subcategoryname;
            }
            $arrRes[$i]['SUB_CATEGORY_SLUG'] = $name;

    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['PRODUCT_NAME'] = $row->productName;
    		$arrRes[$i]['SUB_TITLE'] = $row->SUB_TITLE;
    		$arrRes[$i]['SUB_TITLE_TXT'] = strlen ( $row->SUB_TITLE ) > 65 ? substr ( $row->SUB_TITLE, 0, 65 )."..." :$row->SUB_TITLE;
    		$arrRes[$i]['PRODUCT_PRICE'] = number_format($row->productPrice,2);
    		$arrRes[$i]['productDescTxt'] = strlen ( $row->productDescription ) > 40?substr ( $row->productDescription, 0, 40 )."..." :$row->productDescription;
    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['productPrimaryImg'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";
			$productImage = $this->getSpecificProductSecondaryImage($row->PRODUCT_ID);
    		$arrRes[$i]['productSecondaryImg'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";
    		$arrRes[$i]['wishlistFlag'] = $WishlistModel->getSpecificProductExistByUser1($userId, $row->PRODUCT_ID, 1);

            $arrRes[$i]['shades'] = $ProductShade->getAllProductShadesWithImagByProduct($row->PRODUCT_ID);

            // if(!empty($shades)){

    		// 	$arrRes[$i]['shadesforProduct'] = 'shade';
    		// 	$arrRes[$i]['INV_QUANTITY'] = '';
    		// }
            // else{
    		// 	$arrRes[$i]['INV_QUANTITY_FLAG'] = 'inv';
    		// 	$arrRes[$i]['INV_QUANTITY'] = $row->QUANTITY != null ? $row->QUANTITY : '0';
    		// }

    		$productShades = $ProductShade->getAllProductShadesProduct($row->PRODUCT_ID);

    		if(!empty($productShades)){

    			$arrRes[$i]['INV_QUANTITY_FLAG'] = 'shade';
    			$arrRes[$i]['INV_QUANTITY'] = '';
    		}else{
    			$arrRes[$i]['INV_QUANTITY_FLAG'] = 'inv';
    			$arrRes[$i]['INV_QUANTITY'] = $row->QUANTITY != null ? $row->QUANTITY : '0';
    		}

    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}
        // dd($arrRes);
    	return isset($arrRes) ? $arrRes : null;
    }

    public function getAllUserHomeOfferSectionData(){

    	$result = DB::table('jb_user_home_offer_section_tbl as a')->select('a.*','jct.CATEGORY_NAME as categoryName','jpt.NAME as productName')
    	->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->join ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->orderBy('a.OFFER_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['OFFER_ID'] = $row->OFFER_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['OFFER_TITLE'] = $row->OFFER_TITLE;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_NAME'] = $row->categoryName;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['PRODUCT_NAME'] = $row->productName;
    		$arrRes[$i]['OFFER_START_DATE'] = date('d M,Y h:i a', strtotime($row->OFFER_START_DATE));
    		$arrRes[$i]['OFFER_END_DATE'] = date('d M,Y h:i a', strtotime($row->OFFER_END_DATE));
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

    public function getActiveTodayOfferRecordForWebsite(){
    	DB::enableQueryLog();
    	$currentDate = date('Y-m-d H:i:s');


    	$result = DB::table('jb_user_home_offer_section_tbl as a')->select('a.*','jct.CATEGORY_NAME as categoryName','jpt.NAME as productName','jpt.SLUG as slug','jpt.SUB_CATEGORY_ID as subcategoryid','sbcat.NAME as subcategoryname')
    	->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->join ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->leftJoin ('jb_sub_category_tbl as sbcat','jpt.SUB_CATEGORY_ID','=','sbcat.SUB_CATEGORY_ID')
    	->where('a.OFFER_END_DATE', '>=', $currentDate)
//     	->where('a.OFFER_END_DATE', '>=', today())
    	->get();
//     	$query = DB::getQueryLog(); dd($query);
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->OFFER_ID;
    		$arrRes['title'] = $row->OFFER_TITLE;
    		$arrRes['category'] = $row->CATEGORY_ID;
    		$arrRes['productId'] = $row->PRODUCT_ID;
    		$arrRes['offerEndTime'] = date ( "Y-m-d H:i:s", strtotime ( "$row->OFFER_END_DATE" ) );
    		$arrRes['description'] = $row->DESCRIPTION;

    		$arrRes['SLUG'] = $row->slug;
    		$arrRes['SUB_CATEGORY_ID'] = $row->subcategoryid;
    		$name = $row->categoryName;
    		$words = explode(' ', $name);
    		if (count($words) > 1 || strpos($name, ' ') !== false) {
    			$name = implode('-', $words);
    		} else {
    			$name = $row->categoryName;
    		}
    		$arrRes['CATEGORY_SLUG'] = $name;

    		$name = $row->subcategoryname;
    		$words = explode(' ', $name);
    		if (count($words) > 1 || strpos($name, ' ') !== false) {
    			$name = implode('-', $words);
    		} else {
    			$name = $row->subcategoryname;
    		}
    		$arrRes['SUB_CATEGORY_SLUG'] = $name;

    		$productImage = $this->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    		$arrRes['productPrimaryImg'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

		}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getSpecificTodayOfferRecordById($offerId){

    	$result = DB::table('jb_user_home_offer_section_tbl as a')->select('a.*')
    	->where('a.OFFER_ID', $offerId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->OFFER_ID;
    		$arrRes['T_1'] = $row->OFFER_TITLE;
    		$arrRes['T_2'] = array('id'=>$row->CATEGORY_ID);
    		$arrRes['T_3'] = array('id'=>$row->PRODUCT_ID);
    		$arrRes['T_4'] = $row->OFFER_END_DATE;
    		$arrRes['T_5'] = $row->DESCRIPTION;
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

    public function checkTrendingForyouExistWrtProductId($productId){
    	DB::enableQueryLog();

    	$result = DB::table('jb_user_home_product_section_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $productId)
    	->get();

    	//     	$query = DB::getQueryLog(); dd($query);

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }
    public function checkTodayOfferExistWrtProductId($productId){
    	DB::enableQueryLog();

    	$result = DB::table('jb_user_home_offer_section_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $productId)
    	->get();

    	//     	$query = DB::getQueryLog(); dd($query);

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }

    public function checkOnlineExcExistWrtProductId($productId){
    	DB::enableQueryLog();

    	$result = DB::table('jb_user_home_bestexclusive_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $productId)
    	->get();

    	//     	$query = DB::getQueryLog(); dd($query);

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }

	public function checkUserAccessStatus($user_id,$path){

		$status = '';

		if($user_id == 1) {
			$status = true;
		}
		// This is check where the path is acccess for main Links
		$result['MainMenu']  = 	DB::table('fnd_user_menu_control_tbl')
								->where('USER_ID',$user_id)
								->where('SYSTEM_CALL',$path)
								->where('MENU_TYPE','main')
								->get();

		if(count($result['MainMenu']) > 0) {
			$status = true;
		}

		// Pick the Menu ID against the user
		$result['MainMenuID'] = DB::table('fnd_user_menu_control_tbl')
								->where('USER_ID',$user_id)
								->where('MENU_TYPE','sub')
								->select('MENU_ID')
								->get();


		for($i =0 ;$i<count($result['MainMenuID']);$i++){

			// This is check where the path is acccess for sub Links
			$result['SubMenu'] = DB::table('fnd_user_submenu_tbl')
								->where('MENU_ID',$result['MainMenuID'][$i]->MENU_ID)
								->where('SYSTEM_CALL',$path)
								->get();

			if(count($result['SubMenu']) > 0) {
					$status = true;
			}

		}

		return $status == "" ? true : false;

	}


}
