<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\IngredientModel;
use DateTime;

class ProductIngredientModel extends Model
{
    use HasFactory;
    
    public function getAllProductIngredientByProduct($productId){
    
    	$result = DB::table('jb_product_ingredient_tbl as a')->select('a.*', 'jit.TITLE as ingredientName','jit.DESCRIPTION as ingredientDescription')
    	->join ( 'jb_ingredient_tbl as jit', 'a.INGREDIENT_ID', '=', 'jit.INGREDIENT_ID' )
    	->where('a.PRODUCT_ID', $productId)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_INGREDIENT_ID'] = $row->PRODUCT_INGREDIENT_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['INGREDIENT_CATEGORY'] = $row->INGREDIENT_CATEGORY;
    		$arrRes[$i]['INGREDIENT_ID'] = $row->INGREDIENT_ID;
    		$arrRes[$i]['INGREDIENT_NAME'] = $row->ingredientName;

			$descText = strip_tags(base64_decode($row->ingredientDescription));
    		$arrRes[$i]['INGREDIENT_DESCRIPTION'] = strlen ( $descText ) > 120?substr ( $descText, 0, 120 )."..." :$descText;
    		// $arrRes[$i]['INGREDIENT_DESCRIPTION'] = strip_tags(base64_decode($row->ingredientDescription));
    		
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getAllProductIngredientWrtType($productId, $category){
    	$Ingredient = new IngredientModel();
    	
    	$result = DB::table('jb_product_ingredient_tbl as a')->select('a.*', 'jit.TITLE as ingredientName', 'jit.DESCRIPTION as description')
    	->join ( 'jb_ingredient_tbl as jit', 'a.INGREDIENT_ID', '=', 'jit.INGREDIENT_ID' )
    	->where('a.PRODUCT_ID', $productId)
    	->where('jit.CATEGORY', $category)
    	->limit('4')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['PRODUCT_INGREDIENT_ID'] = $row->PRODUCT_INGREDIENT_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['INGREDIENT_CATEGORY'] = $row->INGREDIENT_CATEGORY;
    		$arrRes[$i]['INGREDIENT_ID'] = $row->INGREDIENT_ID;
    		$arrRes[$i]['INGREDIENT_NAME'] = $row->ingredientName;
    		$descText = strip_tags(base64_decode($row->description));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 120?substr ( $descText, 0, 120 )."..." :$descText;
    		$arrRes[$i]['image'] = $Ingredient->getSpecificIngredientPrimaryImage($row->INGREDIENT_ID);
    		
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function checkIngredientExistWrtIngredientId($ingredientId){
    
    	$result = DB::table('jb_product_ingredient_tbl as a')->select('a.*')
    	->where('a.INGREDIENT_ID', $ingredientId)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}
    
    	return isset($check) ? $check : false;
    }
    public function checkIngredientExistingCheckWrtproductId($ingredientId, $productId){
    
    	$result = DB::table('jb_product_ingredient_tbl as a')->select('a.*')
    	->where('a.INGREDIENT_ID', $ingredientId)
    	->where('a.PRODUCT_ID', $productId)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}
    
    	return isset($check) ? $check : false;
    }
}
