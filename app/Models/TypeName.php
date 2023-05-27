<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class TypeName extends model
{
      
    protected $table="jb_type_name_tbl";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
      protected $fillable = [
          'NAME_ID',
          'TYPE_ID',
          'TYPE_NAME',
          'DATE',
           'CREATED_BY',
          'CREATED_ON',
          'UPDATED_BY',
          'UPDATED_ON',
     ];

     public function getallnamedata($id){
      
       $typeid= $id;

		$result = DB::table('jb_type_name_tbl as a')->select('a.*')
		->where('a.STATUS','active')
		->where('a.TYPE_ID', $typeid)
		->orderBy('a.NAME_ID','desc')
		->get();
		 
		$i=0;
		foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->NAME_ID;
		   $arrRes[$i]['name'] = $row->TYPE_NAME;
         $arrRes[$i]['created_at'] = $row->CREATED_ON;
		   $i++;
		}
	 
		return isset($arrRes) ? $arrRes : null;


     }

     public function getTypeNameLov($typeid){
    	 
		// $details = $_REQUEST ['details'];
		$typeid= $typeid;

		$result = DB::table('jb_type_name_tbl as a')->select('a.*')
		->where('a.STATUS','active')
		->where('a.TYPE_ID', $typeid)
		->orderBy('a.NAME_ID','desc')
		->get();
		 
		$i=0;
		foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->NAME_ID;
		   $arrRes[$i]['name'] = $row->TYPE_NAME;
		   $i++;
		}
	 
		return isset($arrRes) ? $arrRes : null;
	 }

	 public function getTypeNameLovWithSteps($typeid){
    	 
		// $details = $_REQUEST ['details'];
		$typeid= $typeid;

		$result = DB::table('jb_type_name_tbl as a')->select('a.NAME_ID','a.TYPE_NAME',)
		->where('a.STATUS','active')
		->where('a.TYPE_ID', $typeid)
		->orderBy('a.TYPE_ID','asc')
		->get();
		 
		
		foreach ($result as $row){
		
			$row->steps = $this->getStepsWithResToNameId($row->NAME_ID);
		
		}
	 
		return isset($result) ? $result : null;
	 }
	public function getStepsWithResToNameId($id){
		$product=new ProductModel();

		$result = DB::table('jb_routine_steps_tbl as a')->select('a.DESCRIPTION','a.PRODUCT_ID','a.STEP_NO','b.NAME','c.DOWN_PATH')
		->where('a.NAME_ID', $id)
		->join('jb_product_tbl as b','a.PRODUCT_ID','=','b.PRODUCT_ID')
		->join('jb_product_images_tbl as c','a.PRODUCT_ID','=','c.PRODUCT_ID')
		->groupBy('a.PRODUCT_ID')
		->orderBy('a.STEP_NO','asc')
		->get();
		 
		$i=0;
		foreach ($result as $row){
		   
			$arrRes[$i]['DESCRIPTION']= $row->DESCRIPTION;
			$arrRes[$i]['PRODUCT_ID']= $row->PRODUCT_ID;
			$arrRes[$i]['NAME']= $row->NAME;
			$arrRes[$i]['STEP_NO']= $row->STEP_NO;

			$productImage = $product->getSpecificProductPrimaryImage($row->PRODUCT_ID);
			$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";
		
			$productSecImage = $product->getSpecificProductSecondaryImage($row->PRODUCT_ID);
			$arrRes[$i]['secondaryImage'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";
		   
			$i++;
		}
	 
		return isset($arrRes) ? $arrRes : null;
	}


	// public function getProductDataOfSteps($product_id){
	// 	$result = DB::table('jb_product_tbl as a')->select('a.*')
	// 	->where('a.PRODUCT_ID', $product_id)
	// 	->orderBy('a.PRODUCT_ID','desc')
	// 	->first();
		 
		
	// 	//    $arrRes['PRODUCT_ID'] = $result->PRODUCT_ID;
	// 	//    $arrRes['NAME'] = $result->NAME;
		  
	// 	   $result->steps_product_image = $this->getProductImageDataOfSteps($result->PRODUCT_ID);
		 
	 
	// 	return isset($result) ? $result : null;
	// }

	public function getProductImageDataOfSteps($product_id){
		$result = DB::table('jb_product_images_tbl as a')->select('a.DOWN_PATH')
		->where('a.PRODUCT_ID', $product_id)
		->orderBy('a.PRODUCT_ID','desc')
		->first();
		 
		return isset($result) ? $result->DOWN_PATH : null;
	}

    public function getspecifictypename($nameid){
           
      $result = DB::table('jb_type_name_tbl as a')->select('a.*')
		->where('a.NAME_ID', $nameid)
		->orderBy('a.NAME_ID','desc')
		->first();
		$i=0;
		   $arrRes['ID'] = $result->NAME_ID;
		   $arrRes['name'] = $result->TYPE_NAME;
		   $i++;
	 
		return isset($arrRes) ? $arrRes : null;

    }

	public function getAllRoutineTypes(){
	
		$result=DB::table('jb_type_name_tbl')->select('NAME_ID','TYPE_NAME','STATUS','CREATED_ON')
		->orderBy('UPDATED_ON','desc')
    	->get();

		$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['NAME_ID'] = $row->NAME_ID;
			$arrRes[$i]['TYPE_NAME'] = $row->TYPE_NAME;
			$arrRes[$i]['STATUS'] = $row->STATUS;
			$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
			$i++;
		}

		return  isset($arrRes) ? $arrRes : null;;
	}

	public function getallroutinetypelov(){

		$result = DB::table('jb_type_name_tbl as a')->select('a.*')
		->where('a.STATUS','active')
		->orderBy('a.NAME_ID','desc')
		->get();
		 
		$i=0;
		foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->NAME_ID;
		   $arrRes[$i]['name'] = $row->TYPE_NAME;
		   $i++;
		}
	 
		return isset($arrRes) ? $arrRes : null;
	}



   
}
