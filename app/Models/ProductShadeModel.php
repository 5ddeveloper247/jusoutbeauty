<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProductShadeModel extends Model
{
    use HasFactory;

	public function getAllProductShadesByProduct($productId){

    	$result = DB::table('jb_product_shades_tbl as a')->select('a.*', 'jst.TITLE as shadeName')
    	->join ( 'jb_shades_tbl as jst', 'a.SHADE_ID', '=', 'jst.SHADE_ID' )
    	->where('a.PRODUCT_ID', $productId)
		->where('jst.IS_DELETED',0)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_SHADE_ID'] = $row->PRODUCT_SHADE_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['SHADE_ID'] = $row->SHADE_ID;
    		$arrRes[$i]['SHADE_NAME'] = $row->shadeName;
			$shadeImage = $this->shadeImageWrtProductId($row->PRODUCT_SHADE_ID);
    		$arrRes[$i]['SHADE_IMAGE'] = isset($shadeImage['DOWN_PATH']) != null ? $shadeImage['DOWN_PATH'] : url('assets-web')."/images/product_placeholder.png";

    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

	public function shadeImageWrtProductId($shade_id){

		$result = DB::table('jb_product_shade_images_tbl as a')->select('a.DOWN_PATH')
    	->where('a.PRODUCT_SHADE_ID', $shade_id)
    	->where('a.PRIMARY_FLAG', 1)
    	->first();

		$arrRes['DOWN_PATH'] = isset($result->DOWN_PATH) != null ? $result->DOWN_PATH: url('assets-web')."/images/product_placeholder.png";
		return isset($arrRes) ? $arrRes : null;

	}

    public function getSpecificProductShade($id){

    	$result = DB::table('jb_product_shades_tbl as a')->select('a.*')
    	->where('a.PRODUCT_SHADE_ID',$id)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->PRODUCT_SHADE_ID;
    		$arrRes['S_1'] = $row->SHADE_ID;
    		$arrRes['S_2'] = $row->QUANTITY;

    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificProductShadeDetails($id){

    	$result = DB::table('jb_product_shades_tbl as a')->select('a.*','jpt.NAME as prodName')
    	->join ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	->where('a.PRODUCT_SHADE_ID',$id)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->PRODUCT_SHADE_ID;
    		$arrRes['SHADE_ID'] = $row->SHADE_ID;
    		$arrRes['QUANTITY'] = $row->QUANTITY;
    		$arrRes['productName'] = $row->prodName;

    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getProductShadeImages($id){

    	$result = DB::table('jb_product_shade_images_tbl as a')->select('a.*')
    	->where('a.PRODUCT_SHADE_ID', $id)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ID'] = $row->IMAGE_ID;
    		$arrRes[$i]['userId'] = $row->USER_ID;
    		$arrRes[$i]['productShadeId'] = $row->PRODUCT_SHADE_ID;
    		$arrRes[$i]['code'] = $row->SOURCE_CODE;
    		$arrRes[$i]['fileType'] = $row->FILE_TYPE;
    		$arrRes[$i]['fileName'] = $row->FILE_NAME;
    		$arrRes[$i]['fullName'] = $row->FULL_NAME;
    		$arrRes[$i]['path'] = $row->PATH;
    		$arrRes[$i]['downPath'] = $row->DOWN_PATH;
    		$arrRes[$i]['primFlag'] = $row->PRIMARY_FLAG;
    		$arrRes[$i]['secFlag'] = $row->SECONDARY_FLAG;

    		if($row->PRIMARY_FLAG == '1'){
    			$arrRes[$i]['titleText'] = 'Primary Image';
    		}else if($row->SECONDARY_FLAG == '1'){
    			$arrRes[$i]['titleText'] = 'Secondary Image';
    		}else{
    			$arrRes[$i]['titleText'] = '';
    		}

    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificProductShadeImage($id){

    	$result = DB::table('jb_product_shade_images_tbl as a')->select('a.*')
    	->where('a.IMAGE_ID', $id)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->IMAGE_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['productShadeId'] = $row->PRODUCT_SHADE_ID;
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


    public function getAllProductShadesWithImagByProduct($productId){

    	$result = DB::table('jb_product_shades_tbl as a')->select('a.*', 'jst.TITLE as shadeName',
    				DB::raw("(SELECT DOWN_PATH FROM jb_shades_attachment_tbl as jsat
								WHERE jsat.SHADE_ID = a.SHADE_ID and jsat.PRIMARY_FLAG = '1') as shadeprimaryImage"))
    	->join ( 'jb_shades_tbl as jst', 'a.SHADE_ID', '=', 'jst.SHADE_ID' )
		->where('jst.IS_DELETED', 0)
    	->where('a.PRODUCT_ID', $productId)
    	->get();
        // $arrRes['totalShades'] = $result->count();
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_SHADE_ID'] = $row->PRODUCT_SHADE_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['SHADE_ID'] = $row->SHADE_ID;
    		$arrRes[$i]['SHADE_NAME'] = $row->shadeName;

    		$arrRes[$i]['DATE'] = $row->DATE;

    		$primary = $this->getProductShadeImagesPrimarySec($row->PRODUCT_SHADE_ID, 1);
    		$secondary = $this->getProductShadeImagesPrimarySec($row->PRODUCT_SHADE_ID, 2);

    		$arrRes[$i]['prodShadeImag_p'] = isset($primary['downPath'])  ? $primary['downPath'] : url('assets-web')."/images/product_placeholder.png";
    		$arrRes[$i]['prodShadeImag_s'] = isset($secondary['downPath']) ? $secondary['downPath'] : url('assets-web')."/images/product_placeholder.png";
    		$arrRes[$i]['shadeprimaryImage'] = $row->shadeprimaryImage != '' ? $row->shadeprimaryImage : url('assets-web')."/images/product_placeholder.png";

    		$i++;
    	}
    	return isset($arrRes) ? $arrRes : null;
    }

    public function getProductShadeImagesPrimarySec($id, $flag=''){// flag=1 for primary , flag=2 for secondary

    	if($flag == '1'){
    		$result = DB::table('jb_product_shade_images_tbl as a')->select('a.*')
    		->where('a.PRIMARY_FLAG', '1')
    		->where('a.PRODUCT_SHADE_ID', $id)
    		->get();
    	}else  if($flag == '2'){
    		$result = DB::table('jb_product_shade_images_tbl as a')->select('a.*')
    		->where('a.SECONDARY_FLAG', '1')
    		->where('a.PRODUCT_SHADE_ID', $id)
    		->get();
    	}

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->IMAGE_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['productShadeId'] = $row->PRODUCT_SHADE_ID;
    		$arrRes['code'] = $row->SOURCE_CODE;
    		$arrRes['fileType'] = $row->FILE_TYPE;
    		$arrRes['fileName'] = $row->FILE_NAME;
    		$arrRes['fullName'] = $row->FULL_NAME;
    		$arrRes['path'] = $row->PATH;
    		$arrRes['downPath'] = $row->DOWN_PATH;
    		$arrRes['primFlag'] = $row->PRIMARY_FLAG;
    		$arrRes['secFlag'] = $row->SECONDARY_FLAG;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function checkShadeExistWrtShadeId($shadeId){

    	$result = DB::table('jb_product_shades_tbl as a')->select('a.*')
    	->where('a.SHADE_ID', $shadeId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }
    public function checkShadeExistCheckWrtProductId($shadeId, $productId, $proShadeId=''){

    	if($proShadeId != ''){
    		$result = DB::table('jb_product_shades_tbl as a')->select('a.*')
    		->where('a.PRODUCT_SHADE_ID','!=', $proShadeId)
    		->where('a.SHADE_ID', $shadeId)
    		->where('a.PRODUCT_ID', $productId)
    		->get();
    	}else{
    		$result = DB::table('jb_product_shades_tbl as a')->select('a.*')
    		->where('a.SHADE_ID', $shadeId)
    		->where('a.PRODUCT_ID', $productId)
    		->get();
    	}


    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}

    	return isset($check) ? $check : false;
    }

    public function getAllProductShadesProduct($productId){

    	$result = DB::table('jb_product_shades_tbl as a')->select('a.*', 'jst.TITLE as shadeName')
    	->join ( 'jb_shades_tbl as jst', 'a.SHADE_ID', '=', 'jst.SHADE_ID' )
    	->where('jst.IS_DELETED', 0)
    	->where('a.PRODUCT_ID', $productId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_SHADE_ID'] = $row->PRODUCT_SHADE_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['SHADE_ID'] = $row->SHADE_ID;
    		$arrRes[$i]['SHADE_NAME'] = $row->shadeName;
    		$arrRes[$i]['QUANTITY'] = $this->getTotalQuantity($row->PRODUCT_ID);

    		$arrRes[$i]['DATE'] = $row->DATE;

    		$i++;
    	}
    	return isset($arrRes) ? $arrRes : null;
    }

	public function getTotalQuantity($PRODUCT_ID){
		$result = DB::table('jb_product_shades_tbl as a')->where('a.PRODUCT_ID', $PRODUCT_ID)->sum('a.QUANTITY');

		if ($result) {
			return isset($result) ? $result : null;
		}
	}
}
