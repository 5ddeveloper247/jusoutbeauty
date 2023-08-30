<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategoryModel extends Model
{
    use HasFactory;

    public function getCategoryLov(){

    	$result = DB::table('jb_category_tbl as a')->select('a.*')
    	->where('a.STATUS','active')
    	->orderBy('a.CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->CATEGORY_ID;
    		$arrRes[$i]['name'] = $row->CATEGORY_NAME;
    		$i++;
    	}
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getCategoryBundleLov(){

    	$result = DB::table('jb_category_tbl as a')->select('a.*')
    	->where('a.STATUS','active')
    	->whereIn('a.CATEGORY_NAME',array('Shop','Shops')) //array('Bundles','Bundle')
    	->orderBy('a.CATEGORY_ID','desc')
    	->get();
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->CATEGORY_ID;
    		$arrRes[$i]['name'] = $row->CATEGORY_NAME;
    		$i++;
    	}


    	return isset($arrRes) ? $arrRes : null;
    }
    public function getCategoryWithoutBundleLov(){

    	$result = DB::table('jb_category_tbl as a')->select('a.*')
    	->where('a.STATUS','active')
    	->whereNotIn('a.CATEGORY_NAME',array('Bundles','Bundle'))
    	->orderBy('a.CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->CATEGORY_ID;
    		$arrRes[$i]['name'] = $row->CATEGORY_NAME;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getCategoryData(){

    	$result = DB::table('jb_category_tbl as a')->select('a.*')
    	->orderBy('a.SEQ_NUM','asc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->CATEGORY_ID;//$i+1;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
            $arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['NAME'] = $row->CATEGORY_NAME;
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
    public function getSpecificCategoryData($id){
        // dd($id);

    	$result = DB::table('jb_category_tbl as a')->select('a.*')
    	->where('a.CATEGORY_ID',$id)
    	->orderBy('a.CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->CATEGORY_ID;
    		$arrRes['NAME'] = $row->CATEGORY_NAME;
    		$arrRes['USER_ID'] = $row->USER_ID;
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

    public function getSubCategoryLov(){

    	$result = DB::table('jb_sub_category_tbl as a')->select('a.*')
		->where('a.STATUS','active')
    	->orderBy('a.SUB_CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['name'] = $row->NAME;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSubCategoryLovWrtCategory($id){

    	$result = DB::table('jb_sub_category_tbl as a')->select('a.*')
    	->where('a.CATEGORY_ID', $id)
    	->where('a.STATUS', 'active')
    	->orderBy('a.SUB_CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['name'] = $row->NAME;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSubCategoryBundleLovWrtCategory($id){

    	$result = DB::table('jb_sub_category_tbl as a')->select('a.*')
    	->where('a.CATEGORY_ID', $id)
    	->whereIn('a.NAME', array('Bundles', 'Bundle'))
    	->orderBy('a.SUB_CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['name'] = $row->NAME;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSubSubCategoryLovWrtSubCategory($id){

    	$result = DB::table('jb_sub_sub_category_tbl as a')->select('a.*')
    	->where('a.SUB_CATEGORY_ID', $id)
    	->where('a.STATUS','active')
    	->orderBy('a.SUB_SUB_CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->SUB_SUB_CATEGORY_ID;
    		$arrRes[$i]['name'] = $row->NAME;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }


    public function getSubCategoryData(){

    	$result = DB::table('jb_sub_category_tbl as jsct')->select('jsct.*', 'jct.CATEGORY_NAME as catName')
    	->join ( 'jb_category_tbl as jct', 'jsct.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->orderBy('jsct.SEQ_NUM','asc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->SUB_CATEGORY_ID;//$i+1;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
            $arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_NAME'] = $row->catName;
    		$arrRes[$i]['NAME'] = $row->DISPLAY_NAME;
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
    public function getSpecificSubCategoryData($id){

    	$result = DB::table('jb_sub_category_tbl as a')->select('a.*')
    	->where('a.SUB_CATEGORY_ID',$id)
    	->orderBy('a.SUB_CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes['NAME'] = $row->NAME;
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

    public function getSubSubCategoryData(){

    	$result = DB::table('jb_sub_sub_category_tbl as jssct')->select('jssct.*', 'jsct.NAME as subCatName')
    	->join ( 'jb_sub_category_tbl as jsct', 'jssct.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->orderBy('jssct.SEQ_NUM','asc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->SUB_SUB_CATEGORY_ID;//$i+1;
    		$arrRes[$i]['SUB_SUB_CATEGORY_ID'] = $row->SUB_SUB_CATEGORY_ID;
            $arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subCatName;
    		$arrRes[$i]['NAME'] = $row->NAME;
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
    public function getSpecificSubSubCategoryData($id){

    	$result = DB::table('jb_sub_sub_category_tbl as a')->select('a.*')
    	->where('a.SUB_SUB_CATEGORY_ID',$id)
    	->orderBy('a.SUB_SUB_CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->SUB_SUB_CATEGORY_ID;
    		$arrRes['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes['NAME'] = $row->NAME;
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

    public function getAllSubCategoryIdsWrtCategoryId($categoryId){

    	$result = DB::table('jb_sub_category_tbl as jsct')->select('jsct.*')
    	->where('jsct.STATUS','active')
    	->where('jsct.CATEGORY_ID',$categoryId)
    	->get();

    	$arrRes = array();
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i] = $row->SUB_CATEGORY_ID;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllSubSubCategoryIdsWrtSubCategoryId($ids){

    	$result = DB::table('jb_sub_sub_category_tbl as jsct')->select('jsct.*')
    	->where('jsct.STATUS','active')
    	->whereIn('jsct.SUB_CATEGORY_ID',$ids)
    	->get();

    	$arrRes = array();
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i] = $row->SUB_SUB_CATEGORY_ID;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllSubCategoryDetailsWrtSubCategoryId($subCatIds){

    	$result = DB::table('jb_sub_sub_category_tbl as jssct')->select('jssct.*', 'jsct.NAME as subCatName')
    	->join ( 'jb_sub_category_tbl as jsct', 'jssct.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->where ('jssct.STATUS','active')
    	->whereIn('jssct.SUB_CATEGORY_ID', $subCatIds)
    	->orderBy('jssct.SUB_SUB_CATEGORY_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SUB_SUB_CATEGORY_ID'] = $row->SUB_SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subCatName;
    		$arrRes[$i]['NAME'] = $row->NAME;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;
//     		$arrRes[$i]['image'] = $this->getSubCategoryImageFromProduct();
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllSubCategoryDetailsWrtSubCategoryId1($subCatId){
    	DB::enableQueryLog();

    	$result = DB::table('jb_sub_sub_category_tbl as jssct')->select('jssct.*', 'jsct.NAME as subCatName')
    	->join ( 'jb_sub_category_tbl as jsct', 'jssct.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->where ('jssct.STATUS','active')
    	->where('jssct.SUB_CATEGORY_ID', $subCatId)
    	->orderBy('jssct.SUB_SUB_CATEGORY_ID','desc')
    	->get();

//     	$query = DB::getQueryLog(); dd($query);

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SUB_SUB_CATEGORY_ID'] = $row->SUB_SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subCatName;
    		$arrRes[$i]['NAME'] = $row->NAME;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		//     		$arrRes[$i]['image'] = $this->getSubCategoryImageFromProduct();
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getAllSubCategoriesWrtCategory($id){

    	$result = DB::table('jb_sub_category_tbl as a')->select('a.*','jct.CATEGORY_NAME')
    	->join ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->where('a.CATEGORY_ID', $id)
    	->orderBy('a.SUB_CATEGORY_ID','asc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
    		$arrRes[$i]['NAME'] = $row->NAME;

    		$cname = $row->CATEGORY_NAME;
            $words = explode(' ', $cname);
            if (count($words) > 1 || strpos($cname, ' ') !== false) {
                $cname = implode('-', $words);
            } else {
                $cname = $row->CATEGORY_NAME;
            }
            $arrRes[$i]['CATEGORY_SLUG'] = $cname;

            $name = $row->NAME;
            $words = explode(' ', $name);
            if (count($words) > 1 || strpos($name, ' ') !== false) {
            	$name = implode('-', $words);
            } else {
            	$name = $row->NAME;
            }
            $arrRes[$i]['SUB_CATEGORY_SLUG'] = $name;

    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;

//     		$subCatProductImage = $this->getSpecificProductImageSubCategoryWise($row->SUB_CATEGORY_ID);

//     		if(isset($subCatProductImage['downPath']) && $subCatProductImage['downPath'] != ''){
//     			$arrRes[$i]['image'] = $subCatProductImage['downPath'];
//     		}else{
//     			if(strtoupper($row->NAME) == 'SKIN HEALTH'){
//     				$arrRes[$i]['image'] = url('/assets-web')."/images/skin4.jpg";
//     			}else if(strtoupper($row->NAME) == 'GUT HEALTH'){
//     				$arrRes[$i]['image'] = url('/assets-web')."/images/skin3.jpg";
//     			}else if(strtoupper($row->NAME) == 'MOOD'){
//     				$arrRes[$i]['image'] = url('/assets-web')."/images/skin2.jpg";
//     			}else if(strtoupper($row->NAME) == 'POWDERS'){
//     				$arrRes[$i]['image'] = url('/assets-web')."/images/skin1.jpg";
//     			}else{
// 	    			$arrRes[$i]['image'] = url('/assets-web')."/images/skin-makeup.jpg";
// 	    		}
//     		}

    		$subCatProductImage = $this->getSpecificProductImageSubCategoryWise($row->SUB_CATEGORY_ID);

    		if(isset($subCatProductImage['downPath']) && $subCatProductImage['downPath'] != ''){
    			$arrRes[$i]['image'] = $subCatProductImage['downPath'];
    		}else{
    			$arrRes[$i]['image'] = url('/assets-web')."/images/skin-makeup.jpg";
    		}

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificProductImageSubCategoryWise($id){

    	$result = DB::table('jb_product_images_tbl as a')->select('a.*')
    	->leftJoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->where('jpt.SUB_CATEGORY_ID', $id)
    	->where('a.PRIMARY_FLAG', '1')
    	->where('jpt.STATUS','active')
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

    public function checkSubCategoryExistWrtCategory($categoryId){

    	$result = DB::table('jb_sub_category_tbl as a')->select('a.*')
    	->where('a.CATEGORY_ID', $categoryId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }

    public function checkSubSubCategoryExistWrtCategory($subCategoryId){

    	$result = DB::table('jb_sub_sub_category_tbl as a')->select('a.*')
    	->where('a.SUB_CATEGORY_ID', $subCategoryId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }



    public function getAllSubSubCategoryDetailsForFilter($skip=0){
    	DB::enableQueryLog();

    	$result = DB::table('jb_sub_sub_category_tbl as jssct')->select('jssct.*', 'jsct.NAME as subCatName', 'jct.CATEGORY_NAME as catName')
    	->join ( 'jb_sub_category_tbl as jsct', 'jssct.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	->join ( 'jb_category_tbl as jct', 'jsct.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	->where ('jct.STATUS','active')
    	->where ('jsct.STATUS','active')
    	->where ('jssct.STATUS','active')
    	->where ('jct.CATEGORY_NAME', '!=', 'Nutrition')
    	->where ('jct.CATEGORY_NAME', '!=', 'Nutritions')
//     	->where('jssct.SUB_CATEGORY_ID', $subCatId)
    	->orderBy('jssct.SUB_SUB_CATEGORY_ID','desc')
    	->skip($skip)->take(10)
    	->get();

    	//     	$query = DB::getQueryLog(); dd($query);

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SUB_SUB_CATEGORY_ID'] = $row->SUB_SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
    		$arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subCatName;
    		$arrRes[$i]['CATEGORY_NAME'] = $row->catName;
    		$arrRes[$i]['NAME'] = $row->NAME;
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
	//DELETE CASE


	public function getAllSubCategoryIdsWrtCategoryIdCaseDelete($ids){

    	$result = DB::table('jb_sub_category_tbl as jsct')->select('jsct.*')
    	->where('jsct.CATEGORY_ID',$ids)
    	->get();

    	$arrRes = array();
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i] = $row->SUB_CATEGORY_ID;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }


	public function getAllSubSubCategoryIdsWrtCategoryIdCaseDelete($subCatIds){

    	$result = DB::table('jb_sub_sub_category_tbl as jssct')->select('jssct.*')
    	->whereIn('jssct.SUB_CATEGORY_ID', $subCatIds)
    	->get();

    	$i=0;
    	foreach ($result as $row){

    		$arrRes[$i]['SUB_SUB_CATEGORY_ID'] = $row->SUB_SUB_CATEGORY_ID;
    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

}
