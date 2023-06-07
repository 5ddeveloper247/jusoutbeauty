<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Feature extends Model
{
    use HasFactory;
    protected $table="jb_product_features_tbl";

    protected $fillable = [
        'FEATURE_ID',
        'USER_ID',
        'FEATURE_NAME',
        'FEATURE_DESCRIPTION',
        'IMAGE_PATH',
        'IMAGE_DOWN_PATH',
        'STATUS',
        'CREATED_BY',
    ];

    public function getactivefeaturesdata(){

        $result=DB::table('jb_product_features_tbl as a')->select('a.*')->where('a.STATUS','active')->orderBy('a.UPDATED_ON','desc')->get();
        $i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->FEATURE_ID;//$i+1;
            $arrRes[$i]['name'] = $row->FEATURE_NAME;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;

    }

    public function getFeaturesData(){
    	 
    	$result = DB::table('jb_product_features_tbl as a')->select('a.*')
    	->orderBy('a.SEQ_NUM','asc')
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->FEATURE_ID;//$i+1;
    		$arrRes[$i]['FEATURE_ID'] = $row->FEATURE_ID;
    		$arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
            $arrRes[$i]['TITLE'] = $row->FEATURE_NAME;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->FEATURE_DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->FEATURE_DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
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

    public function getSpecificFeaturetData($id){
    
        	$result = DB::table('jb_product_features_tbl as a')->select('a.*')
        	->where('a.FEATURE_ID',$id)
         	->get();

         	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->FEATURE_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['TITLE'] = $row->FEATURE_NAME;
    		$arrRes['DESCRIPTION'] = base64_decode($row->FEATURE_DESCRIPTION);
			$arrRes['IMAGE_DOWN_PATH'] = $row->IMAGE_DOWN_PATH;
    		$arrRes['STATUS'] = $row->STATUS;
    		$arrRes['DATE'] = $row->DATE;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }

	public function getspecificproductdata($id){
		 
          $result=DB::table('jb_product_tbl as a')->select('a.*')->where('a.PRODUCT_ID',$id)->get();
		  $feaures_id = isset($result[0]->FEATURE_ID) ? $result[0]->FEATURE_ID :'';
           
		  if($feaures_id != null){
		
			$features= explode(',',$feaures_id);
		
		  $i=0;

		  foreach($features as $v){
		     
			$row=DB::table('jb_product_features_tbl as a')->select('a.*')->where('a.FEATURE_ID',$v)->first();
			 
			$arrRes[$i]['ID'] = $row->FEATURE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
    		$arrRes[$i]['TITLE'] = $row->FEATURE_NAME;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->FEATURE_DESCRIPTION);
			$arrRes[$i]['IMAGE_DOWN_PATH'] = $row->IMAGE_DOWN_PATH;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
              
			$i++;
		 }
		}
		$arrSort = collect($arrRes)->sortBy('SEQ_NUM')->toArray();
		
        // dd($arrSort);
		return isset($arrSort) ? $arrSort : null;

	}

    public function getFeatureAttachments($id){
    
    	$result = DB::table('jb_product_features_tbl as a')->select('a.*')
    	->where('a.FEATURE_ID', $id)
    	->orderBy('a.FEATURE_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ID'] = $row->FEATURE_ID;
    		$arrRes[$i]['userId'] = $row->USER_ID;
    		$arrRes[$i]['FEATURE_Id'] = $row->FEATURE_ID;
    		$arrRes[$i]['path'] = $row->IMAGE_PATH;
    		$arrRes[$i]['downPath'] = $row->IMAGE_DOWN_PATH;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }


    
  
    
}
