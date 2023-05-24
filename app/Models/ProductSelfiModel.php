<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSelfiModel extends Model
{
    use HasFactory;
    

	public function getSpecificSelfiAttachments($selfiId){

		$result = DB::table('jb_product_selfi_images_tbl as a')->select('a.*')
    	->where('a.SELFIE_ID', $selfiId)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
			// $arrRes[$i]['seqNo'] = $row->SELFIE_ID;
    		$arrRes[$i]['path'] = $row->PATH;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
	}
    public function getAllProductsSelfie($productid=''){
    
    	 $result = DB::table('jb_product_selfi_tbl as a')->select('a.*')
         ->where('a.PRODUCT_ID',$productid)
         ->where('a.STATUS',1)
		 ->orderBy('a.CREATED_ON', 'desc')
    	 ->orderBy('a.UPDATED_ON','desc')
    	 ->get();
    
    	 $i=0;
     	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->SELFIE_ID;//$i+1;
    		$arrRes[$i]['SELFIE_ID'] = $row->SELFIE_ID;
			$arrRes[$i]['SElFIBYID'] = $this->getAllProductsSelfieBYID($row->SELFIE_ID);

			$i++;
    	 }

    
    	return isset($arrRes) ? $arrRes : null;
    }

	public function getProductName($id){

		 $result = DB::table('jb_product_tbl as a')->select('a.*')
		 ->where('a.PRODUCT_ID', $id)
    	 ->orderBy('a.PRODUCT_ID','desc')
    	 ->first();

		 return isset($result->NAME) ? $result->NAME : 'N/A';
	}

	public function getAllProductsSelfieBYID($selfiid=''){
    
    	$result = DB::table('jb_product_selfi_images_tbl as a')->select('a.*')
         ->where('a.SELFIE_ID',$selfiid)
		//  ->join('jb_product_tbl', 'jb_product_tbl.id', '=', 'a.PRODUCT_ID')
		//  ->pluck('jb_product_tbl.NAME')
    	 ->orderBy('a.UPDATED_ON','desc')
    	 ->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->SELFIE_ID;//$i+1;
    		$arrRes[$i]['SELFIE_ID'] = $row->SELFIE_ID;
    		$arrRes[$i]['DOWN_PATH'] = $row->DOWN_PATH;
    		$arrRes[$i]['FILE_TYPE'] = $row->FILE_TYPE;                
               
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }

	public function countadminSelfie($selfiid){
        
		$row=DB::table('jb_product_selfi_images_tbl as a')->select('a.*')
        ->where('a.SELFIE_ID',$selfiid)
    	// ->orderBy('a.UPDATED_ON','desc')
    	->get();

		$count= $row->count();

		return $count;

	}

	public function getAllAdminSelfie(){
		
		 $result = DB::table('jb_product_selfi_tbl as a')->select('a.*')
		 ->orderBy('a.CREATED_ON', 'desc')
    	 ->orderBy('a.UPDATED_ON','desc')
    	 ->get();

    
    	$i=0;
    	foreach ($result as $row){
    		 
			 $arrRes[$i]['seqNo'] = $row->SELFIE_ID;//$i+1;
    		 $arrRes[$i]['SELFIE_ID'] = $row->SELFIE_ID;
    		 $arrRes[$i]['EMAIL'] = $row->EMAIL;
             $count= $this->countadminSelfie($row->SELFIE_ID);
			 $arrRes[$i]['PRODUCT_NAME'] = $this->getProductName($row->PRODUCT_ID);
             $arrRes[$i]['NUMBER_OF_SELFIES']= $count;
    		 $arrRes[$i]['NAME'] = $row->NAME;
    		 $arrRes[$i]['STATUS'] = $row->STATUS;
    		 $arrRes[$i]['PRIMARY_FLAG'] = $row->PRIMARY_FLAG;
    		 $arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		 $arrRes[$i]['DOWN_PATH'] = $row->DOWN_PATH;
    		 
			 $i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
	}
	public function ChangeAdminProductSnapSelfieStatus($productSelfiID){

		$result = DB::table('jb_product_selfi_tbl as a')->select('a.*')
    	->where('a.SELFIE_ID',$productSelfiID)
    	->orderBy('a.SELFIE_ID','desc')
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['STATUS'] = $row->STATUS;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
	}
	public function getSpecificImage($id){
    
    	$result = DB::table('jb_product_selfi_images_tbl as a')->select('a.*')
    	->where('a.IMAGE_ID', $id)
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
    		// $arrRes['secFlag'] = $row->SECONDARY_FLAG;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
}
