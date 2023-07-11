<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class TypeName extends model
{

    protected $table="jb_routine_type_tbl";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
      protected $fillable = [
          'ROUTINETYPE_ID',
        //   'TYPE_ID',
          'TYPE_NAME',
          'DATE',
           'CREATED_BY',
          'CREATED_ON',
          'UPDATED_BY',
          'UPDATED_ON',
     ];

     public function getallnamedata($id){

       $typeid= $id;

		$result = DB::table('jb_routine_type_tbl as a')->select('a.*')
		->where('a.STATUS','active')
		// ->where('a.TYPE_ID', $typeid)
		->orderBy('a.ROUTINETYPE_ID','desc')
		->get();

		$i=0;
		foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->ROUTINETYPE_ID;
		   $arrRes[$i]['name'] = $row->TYPE_NAME;
         $arrRes[$i]['created_at'] = $row->CREATED_ON;
		   $i++;
		}

		return isset($arrRes) ? $arrRes : null;


     }

     public function getTypeNameLov($typeid){

		// $details = $_REQUEST ['details'];
		$typeid= $typeid;

		$result = DB::table('jb_routine_type_tbl as a')->select('a.*')
		->where('a.STATUS','active')
		// ->where('a.TYPE_ID', $typeid)
		->orderBy('a.ROUTINETYPE_ID','desc')
		->get();

		$i=0;
		foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->ROUTINETYPE_ID;
		   $arrRes[$i]['name'] = $row->TYPE_NAME;
		   $i++;
		}

		return isset($arrRes) ? $arrRes : null;
	 }

	 public function getTypeNameLovWithSteps($Routineid){


		$result = DB::table('jb_routine_type_tbl as a')->select('a.ROUTINETYPE_ID','a.TYPE_NAME')
		->join('jb_routine_type_steps_tbl as d','a.ROUTINETYPE_ID','=','d.ROUTINETYPE_ID')
		->join('jb_routine_tbl as b','d.ROUTINE_ID','=','b.ROUTINE_ID')
		->where('b.ROUTINE_ID' ,$Routineid)
		->where('a.STATUS','active')
		->groupBy('a.ROUTINETYPE_ID')
		// ->where('a.ROUTINE_ID', $Routineid)
		->orderBy('a.ROUTINETYPE_ID','asc')
		->get();

		foreach ($result as $row){

			$row->steps = $this->getStepsWithResToNameId($row->ROUTINETYPE_ID,$Routineid);

		}

		return isset($result) ? $result : null;
	 }
	public function getStepsWithResToNameId($ROUTINETYPE_ID,$Routineid){
		$product=new ProductModel();

		$result = DB::table('jb_routine_tbl as a')
		->select('a.ROUTINE_ID','b.DESCRIPTION','d.PRODUCT_ID','d.STEP_NO','b.NAME','b.SLUG','ctbl.CATEGORY_NAME as categoryname','sctbl.NAME as subcategoryname','ctbl.CATEGORY_ID','sctbl.SUB_CATEGORY_ID')
		->join('jb_routine_type_steps_tbl as d','a.ROUTINE_ID','=','d.ROUTINE_ID')
		->join('jb_product_tbl as b','d.PRODUCT_ID','=','b.PRODUCT_ID')
        ->join('jb_category_tbl as ctbl','b.CATEGORY_ID','=','ctbl.CATEGORY_ID')
        ->join('jb_sub_category_tbl as sctbl','b.SUB_CATEGORY_ID','=','sctbl.SUB_CATEGORY_ID')
		// ->join('jb_product_images_tbl as c','b.PRODUCT_ID','=','c.PRODUCT_ID')
		->where('d.ROUTINETYPE_ID',$ROUTINETYPE_ID)
		->where('a.ROUTINE_ID',$Routineid)
		->where('b.IS_DELETED',0)
		->groupBy('d.PRODUCT_ID')
		->orderBy('d.STEP_NO','asc')
		->get();

		// $result = DB::table('jb_routine_type_steps_tbl as a')->select('a.DESCRIPTION','a.PRODUCT_ID','a.STEP_NO','b.NAME','c.DOWN_PATH')
		// // ->where('a.ROUTINETYPE_ID', $id)
		// ->where('a.ROUTINE_ID', $routineId)
		// ->join('jb_product_tbl as b','a.PRODUCT_ID','=','b.PRODUCT_ID')
		// ->join('jb_product_images_tbl as c','a.PRODUCT_ID','=','c.PRODUCT_ID')
		// ->groupBy('a.PRODUCT_ID')
		// ->orderBy('a.STEP_NO','asc')
		// ->get();

		$i=0;
		foreach ($result as $row){
			$descText = strip_tags(base64_decode($row->DESCRIPTION));
			$change_string = str_replace("&nbsp;"," ",$descText);
			$arrRes[$i]['DESCRIPTION']= $change_string;
			$arrRes[$i]['PRODUCT_ID']= $row->PRODUCT_ID;
			$arrRes[$i]['NAME']= $row->NAME;
			$arrRes[$i]['STEP_NO']= $row->STEP_NO;
            $arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
            $arrRes[$i]['SLUG'] = $row->SLUG;
            $name = $row->categoryname;
            $words = explode(' ', $name);
            if (count($words) > 1 || strpos($name, ' ') !== false) {
                $name = implode('-', $words);
            }
            $arrRes[$i]['CATEGORY_SLUG'] = $name;
            $arrRes[$i]['CATEGORY_NAME'] = $row->categoryname;

            $arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
            $name = $row->subcategoryname;
            $words = explode(' ', $name);
            if (count($words) > 1 || strpos($name, ' ') !== false) {
                $name = implode('-', $words);
            }
            $arrRes[$i]['SUB_CATEGORY_SLUG'] = $name;
            $arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subcategoryname;

			$productImage = $product->getSpecificProductPrimaryImage($row->PRODUCT_ID);
			$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

			$productSecImage = $product->getSpecificProductSecondaryImage($row->PRODUCT_ID);
			$arrRes[$i]['secondaryImage'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

			$i++;
		}
		// dd($result);
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

      $result = DB::table('jb_routine_type_tbl as a')->select('a.*')
		->where('a.ROUTINETYPE_ID', $nameid)
		->orderBy('a.ROUTINETYPE_ID','desc')
		->first();
		$i=0;
		   $arrRes['ID'] = $result->ROUTINETYPE_ID;
		   $arrRes['name'] = $result->TYPE_NAME;
		   $i++;

		return isset($arrRes) ? $arrRes : null;

    }

	public function getAllRoutineTypes(){

		$result=DB::table('jb_routine_type_tbl')->select('ROUTINETYPE_ID','TYPE_NAME','STATUS','CREATED_ON')
		->orderBy('UPDATED_ON','desc')
    	->get();

		$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ROUTINETYPE_ID'] = $row->ROUTINETYPE_ID;
			$arrRes[$i]['TYPE_NAME'] = $row->TYPE_NAME;
			$arrRes[$i]['STATUS'] = $row->STATUS;
			$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
			$i++;
		}

		return  isset($arrRes) ? $arrRes : null;;
	}

	public function getallroutinetypelov(){

		$result = DB::table('jb_routine_type_tbl as a')->select('a.*')
		->where('a.STATUS','active')
		->orderBy('a.ROUTINETYPE_ID','desc')
		->get();

		$i=0;
		foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->ROUTINETYPE_ID;
		   $arrRes[$i]['name'] = $row->TYPE_NAME;
		   $i++;
		}

		return isset($arrRes) ? $arrRes : null;
	}




}
