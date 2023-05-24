<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class ReviewsModel extends Model
{
    use HasFactory;
    
    public function getAllPublishedReviewsByProductId($productId='', $bundleId=''){
    
    	if($productId != ''){
    		$where =array(['a.PRODUCT_ID','=',$productId]);
    	}else if($bundleId != ''){
    		$where =array(['a.BUNDLE_ID','=',$bundleId]);
    	}    	
    	
    	$result = DB::table('jb_reviews_tbl as a')->select('a.*')
    	->where($where)
    	->where('a.STATUS', 'published')
    	->orderBy('a.REVIEW_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['REVIEW_ID'] = $row->REVIEW_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['REVIEW_DESCRIPTION'] = $row->REVIEW_DESCRIPTION;
    		$arrRes[$i]['USERNAME'] = $row->USERNAME;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['STAR_RATING'] = $row->STAR_RATING != null ? $row->STAR_RATING : 0;
    		$arrRes[$i]['SKIN_TYPE'] = $row->SKIN_TYPE;
    		$arrRes[$i]['CLIMATE'] = $row->CLIMATE;
    		$arrRes[$i]['AGE_RANGE'] = $row->AGE_RANGE;
    		$arrRes[$i]['RECOMMAND_MURAD'] = $row->RECOMMAND_MURAD;
    		$arrRes[$i]['SKIN_TYPE1'] = $row->SKIN_TYPE1;
    		$arrRes[$i]['RECOMMAND_PRODUCT'] = $row->RECOMMAND_PRODUCT;
    		$arrRes[$i]['DATE'] = date("M d, Y", strtotime($row->DATE));
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getAllReviewsForAdmin(){
    
    	$result = DB::table('jb_reviews_tbl as a')->select('a.*')
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->REVIEW_ID;//$i+1;
    		$arrRes[$i]['REVIEW_ID'] = $row->REVIEW_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['REVIEW_DESCRIPTION'] = $row->REVIEW_DESCRIPTION;
    		$arrRes[$i]['USERNAME'] = $row->USERNAME;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['STAR_RATING'] = $row->STAR_RATING != null ? $row->STAR_RATING : 0;
    		$arrRes[$i]['SKIN_TYPE'] = $row->SKIN_TYPE;
    		$arrRes[$i]['CLIMATE'] = $row->CLIMATE;
    		$arrRes[$i]['AGE_RANGE'] = $row->AGE_RANGE;
    		$arrRes[$i]['RECOMMAND_MURAD'] = $row->RECOMMAND_MURAD;
    		$arrRes[$i]['SKIN_TYPE1'] = $row->SKIN_TYPE1;
    		$arrRes[$i]['RECOMMAND_PRODUCT'] = $row->RECOMMAND_PRODUCT;
    		$arrRes[$i]['DATE'] = date("M d, Y", strtotime($row->DATE));
    		$arrRes[$i]['STATUS'] = $row->STATUS == 'published' ? '1' : '0';
    		$arrRes[$i]['ON_SITE_ENABLE'] = $row->ON_SITE_ENABLE == '1' ? '1' : '0';
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getAllEnableReviewsForWebsite(){
    
    	$result = DB::table('jb_reviews_tbl as a')->select('a.*')
    	->where('a.ON_SITE_ENABLE','1')
    	->orderBy('a.REVIEW_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->REVIEW_ID;//$i+1;
    		$arrRes[$i]['REVIEW_ID'] = $row->REVIEW_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['REVIEW_DESCRIPTION'] = $row->REVIEW_DESCRIPTION;
    		$arrRes[$i]['REVIEW_DESCRIPTION_TRIM'] = strlen ( $row->REVIEW_DESCRIPTION ) > 90?substr ( $row->REVIEW_DESCRIPTION, 0, 90 )."..." :$row->REVIEW_DESCRIPTION;
    		$arrRes[$i]['USERNAME'] = $row->USERNAME;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['STAR_RATING'] = $row->STAR_RATING != null ? $row->STAR_RATING : 0;
    		$arrRes[$i]['SKIN_TYPE'] = $row->SKIN_TYPE;
    		$arrRes[$i]['CLIMATE'] = $row->CLIMATE;
    		$arrRes[$i]['AGE_RANGE'] = $row->AGE_RANGE;
    		$arrRes[$i]['RECOMMAND_MURAD'] = $row->RECOMMAND_MURAD;
    		$arrRes[$i]['SKIN_TYPE1'] = $row->SKIN_TYPE1;
    		$arrRes[$i]['RECOMMAND_PRODUCT'] = $row->RECOMMAND_PRODUCT;
    		$arrRes[$i]['DATE'] = date("M d, Y", strtotime($row->DATE));
    		$arrRes[$i]['STATUS'] = $row->STATUS == 'published' ? '1' : '0';
    		$arrRes[$i]['ON_SITE_ENABLE'] = $row->ON_SITE_ENABLE == '1' ? '1' : '0';
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificReviewDetailAdmin($reviewId){
    
    	$result = DB::table('jb_reviews_tbl as a')->select('a.*')
    	->where('a.REVIEW_ID', $reviewId)
    	->orderBy('a.REVIEW_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['REVIEW_ID'] = $row->REVIEW_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['REVIEW_DESCRIPTION'] = $row->REVIEW_DESCRIPTION;
    		$arrRes['USERNAME'] = $row->USERNAME;
    		$arrRes['EMAIL'] = $row->EMAIL;
    		$arrRes['STAR_RATING'] = $row->STAR_RATING != null ? $row->STAR_RATING : 0;
    		$arrRes['SKIN_TYPE'] = $row->SKIN_TYPE;
    		$arrRes['CLIMATE'] = $row->CLIMATE;
    		$arrRes['AGE_RANGE'] = $row->AGE_RANGE;
    		$arrRes['RECOMMAND_MURAD'] = $row->RECOMMAND_MURAD;
    		$arrRes['SKIN_TYPE1'] = $row->SKIN_TYPE1;
    		$arrRes['RECOMMAND_PRODUCT'] = $row->RECOMMAND_PRODUCT;
    		$arrRes['DATE'] = date("M d, Y", strtotime($row->DATE));
    		$arrRes['STATUS'] = strtoupper($row->STATUS);
    		$arrRes['STATUS_FLAG'] = $row->STATUS == 'published' ? '1' : '0';
    		$arrRes['ON_SITE_ENABLE'] = $row->ON_SITE_ENABLE == '1' ? '1' : '0';
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    	}
    	return isset($arrRes) ? $arrRes : null;
    }
}
