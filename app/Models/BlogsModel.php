<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class BlogsModel extends Model
{
    use HasFactory;

    public function getBlogsLov(){

    	$result = DB::table('jb_blogs_tbl as a')->select('a.*')
    	->orderBy('a.BLOG_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->SHADE_ID;
    		$arrRes[$i]['name'] = $row->TITLE;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getBlogsData($limit=''){

    	if($limit != ''){
    		$result = DB::table('jb_blogs_tbl as a')->select('a.*')
    		->orderBy('a.UPDATED_ON','desc')
    		->limit($limit)
    		->get();
    	}else{
    		$result = DB::table('jb_blogs_tbl as a')->select('a.*')
    		->orderBy('a.UPDATED_ON','desc')
    		->get();
    	}

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->BLOG_ID; //$i+1;
    		$arrRes[$i]['BLOG_ID'] = $row->BLOG_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
			$descText = strip_tags(base64_decode($row->DESCRIPTION));
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
    public function getAllActiveBlogsData($limit=''){

    	if($limit != ''){
    		$result = DB::table('jb_blogs_tbl as a')->select('a.*')
    		->where('a.STATUS','active')
    		->orderBy('a.BLOG_ID','desc')
    		->limit($limit)
    		->get();
    	}else{
    		$result = DB::table('jb_blogs_tbl as a')->select('a.*')
    		->where('a.STATUS','active')
    		->orderBy('a.BLOG_ID','desc')
    		->get();
    	}

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['BLOG_ID'] = $row->BLOG_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
            $arrRes[$i]['SLUG'] = $row->SLUG;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 200?substr ( $descText, 0, 200 )."..." :$descText;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['path'] = $row->IMAGE_PATH != null ? $row->IMAGE_PATH : '';
    		$arrRes[$i]['image'] = $row->IMAGE_DOWN_PATH != null ? $row->IMAGE_DOWN_PATH : '';
    		$arrRes[$i]['detailPath'] = $row->IMAGE_DETAIL_PATH != null ? $row->IMAGE_DETAIL_PATH : '';
    		$arrRes[$i]['detailImage'] = $row->IMAGE_DETAIL_DOWN_PATH != null ? $row->IMAGE_DETAIL_DOWN_PATH : '';
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificBlogsData($slug){

    	$result = DB::table('jb_blogs_tbl as a')->select('a.*')
    	->where('a.SLUG',$slug)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['BLOG_ID'] = $row->BLOG_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['TITLE'] = $row->TITLE;
            $arrRes['SLUG'] = $row->SLUG;
    		$arrRes['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$arrRes['STATUS'] = $row->STATUS;
    		$arrRes['path'] = $row->IMAGE_PATH != null ? $row->IMAGE_PATH : '';
    		$arrRes['image'] = $row->IMAGE_DOWN_PATH != null ? $row->IMAGE_DOWN_PATH : '';
    		$arrRes['detailPath'] = $row->IMAGE_DETAIL_PATH != null ? $row->IMAGE_DETAIL_PATH : '';
    		$arrRes['detailImage'] = $row->IMAGE_DETAIL_DOWN_PATH != null ? $row->IMAGE_DETAIL_DOWN_PATH : '';
    		$arrRes['DATE'] = date('M d,Y', strtotime($row->DATE));
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;

    	}

    	return isset($arrRes) ? $arrRes : null;
    }

    public function getSpecificOurBlogsData($id='1'){

    	$result = DB::table('jb_our_blog_tbl as a')->select('a.*')
    	->where('a.ID',$id)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->ID;
    		$arrRes['NAME'] = $row->NAME;
    		$arrRes['path'] = $row->IMAGE_PATH != null ? $row->IMAGE_PATH : '';
    		$arrRes['image'] = $row->IMAGE_DOWN_PATH != null ? $row->IMAGE_DOWN_PATH : '';
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }


}
