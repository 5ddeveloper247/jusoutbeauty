<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class IngredientModel extends Model
{
    use HasFactory;
    
    public function getIngredientslovWrtCategory($category){
    
    	$result = DB::table('jb_ingredient_tbl as a')->select('a.*')
    	->where('a.CATEGORY', $category)
    	->where('a.STATUS', 'active')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->INGREDIENT_ID;
    		$arrRes[$i]['name'] = $row->TITLE;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getIngredientsData(){
    	 
    	$result = DB::table('jb_ingredient_tbl as a')->select('a.*')
    	->orderBy('a.SEQ_NUM','asc')
    	// ->orderBy('a.CREATED_ON','desc')
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->INGREDIENT_ID;//$i+1;
    		$arrRes[$i]['INGREDIENT_ID'] = $row->INGREDIENT_ID;
    		$arrRes[$i]['SEQ_NUM'] = $row->SEQ_NUM;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['CATEGORY'] = $row->CATEGORY;
    		$arrRes[$i]['DESCRIPTION'] = strip_tags(base64_decode($row->DESCRIPTION));
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
			$descText = str_replace('&nbsp;',' ',$descText);
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
    public function getSpecificIngredientData($id){
    
    	$result = DB::table('jb_ingredient_tbl as a')->select('a.*')
    	->where('a.INGREDIENT_ID',$id)
    	->orderBy('a.UPDATED_ON','desc')
    	->orderBy('a.CREATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->INGREDIENT_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['QUANTITY'] = $row->QUANTITY;
    		$arrRes['CATEGORY'] = $row->CATEGORY;
    		$arrRes['DESCRIPTION'] = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes['STATUS'] = $row->STATUS;
    		$arrRes['DATE'] = $row->DATE;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getIngredientAttachments($id){
    
    	$result = DB::table('jb_ingredient_attachment_tbl as a')->select('a.*')
    	->where('a.INGREDIENT_ID', $id)
    	->orderBy('a.INGREDIENT_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ID'] = $row->ATTACHMENT_ID;
    		$arrRes[$i]['userId'] = $row->USER_ID;
    		$arrRes[$i]['ingredientId'] = $row->INGREDIENT_ID;
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
    
    public function getSpecificIngredientPrimaryImage($ingredientId){
    
    	$result = DB::table('jb_ingredient_attachment_tbl as a')->select('a.*')
    	->where('a.INGREDIENT_ID', $ingredientId)
    	->where('a.PRIMARY_FLAG', '1')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->ATTACHMENT_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['ingredientId'] = $row->INGREDIENT_ID;
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
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificIngredientAttachments($ingredientId){
    
    	$result = DB::table('jb_ingredient_attachment_tbl as a')->select('a.*')
    	->where('a.INGREDIENT_ID', $ingredientId)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->ATTACHMENT_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['ingredientId'] = $row->INGREDIENT_ID;
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
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    
}
