<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProductUsesModel extends Model
{
    use HasFactory;
    
    public function getAllProductUsesByProduct($productId){
    
    	$result = DB::table('jb_product_uses_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $productId)
    	->orderBy('a.SEQUENCE_NUM', 'asc')
		->limit('3')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_USES_ID'] = $row->PRODUCT_USES_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['SEQUENCE_NUM'] = $row->SEQUENCE_NUM;
    		$arrRes[$i]['USES_TITLE'] = $row->USES_TITLE;
    		$arrRes[$i]['USES_DESCRIPTION'] = $row->USES_DESCRIPTION;
    		$arrRes[$i]['DOWN_PATH'] = isset($row->DOWN_PATH) != null ? $row->DOWN_PATH : url('assets-web')."/images/product_placeholder.png";
    
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificProductUses($id){
    
    	$result = DB::table('jb_product_uses_tbl as a')->select('a.*')
    	->where('a.PRODUCT_USES_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->PRODUCT_USES_ID;
    		$arrRes['U_1'] = $row->SEQUENCE_NUM;
    		$arrRes['U_2'] = $row->USES_TITLE;
    		$arrRes['U_3'] = isset($row->DOWN_PATH) != null ? $row->DOWN_PATH : url('assets-web')."/images/product_placeholder.png";
    		$arrRes['U_4'] = $row->USES_DESCRIPTION;
    
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificProductUsesImage($id){
    
    	$result = DB::table('jb_product_uses_tbl as a')->select('a.*')
    	->where('a.PRODUCT_USES_ID', $id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->PRODUCT_USES_ID;
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
    
    public function getAllProductUsesLimitedByProductId($productId){
    
    	$result = DB::table('jb_product_uses_tbl as a')->select('a.*')
    	->where('a.PRODUCT_ID', $productId)
    	->orderBy('a.SEQUENCE_NUM', 'asc')
    	->limit('3')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_USES_ID'] = $row->PRODUCT_USES_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['SEQUENCE_NUM'] = $row->SEQUENCE_NUM;
    		$arrRes[$i]['USES_TITLE'] = $row->USES_TITLE;
    		$arrRes[$i]['USES_DESCRIPTION'] = $row->USES_DESCRIPTION;
    		$arrRes[$i]['DOWN_PATH'] = $row->DOWN_PATH != null ? $row->DOWN_PATH : '';
    
    
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
}
