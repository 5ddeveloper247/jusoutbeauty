<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class ShadesModel extends Model
{
    use HasFactory;
    
    public function getShadesLov(){
    
    	$result = DB::table('jb_shades_tbl as a')->select('a.*')
    	->where('a.STATUS','active')
    	->orderBy('a.SHADE_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->SHADE_ID;
    		$arrRes[$i]['name'] = $row->TITLE;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getShadesData(){
    
    	$result = DB::table('jb_shades_tbl as a')->select('a.*')
		->where('IS_DELETED',0)
    	->orderBy('a.UPDATED_ON','desc')
    	->orderBy('a.CREATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->SHADE_ID;//$i+1;
    		$arrRes[$i]['SHADE_ID'] = $row->SHADE_ID;
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
    public function getSpecificShadesData($id){
    
    	$result = DB::table('jb_shades_tbl as a')->select('a.*')
    	->where('a.SHADE_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->SHADE_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$arrRes['STATUS'] = $row->STATUS;
    		$arrRes['DATE'] = $row->DATE;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getShadeAttachments($id){
    
    	$result = DB::table('jb_shades_attachment_tbl as a')->select('a.*')
    	->where('a.SHADE_ID', $id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ID'] = $row->ATTACHMENT_ID;
    		$arrRes[$i]['userId'] = $row->USER_ID;
    		$arrRes[$i]['shadeId'] = $row->SHADE_ID;
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
    public function getSpecificShadeAttachments($id){
    
    	$result = DB::table('jb_shades_attachment_tbl as a')->select('a.*')
    	->where('a.ATTACHMENT_ID', $id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->ATTACHMENT_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['shadeId'] = $row->SHADE_ID;
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
    
    public function getAllShadesListing(){
    
    	$result = DB::table('jb_shades_tbl as a')->select('a.*',
    				DB::raw("(SELECT DOWN_PATH FROM jb_shades_attachment_tbl as jsat
								WHERE jsat.SHADE_ID = a.SHADE_ID and jsat.PRIMARY_FLAG = '1') as primaryImage"))
    	->orderBy('a.SHADE_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SHADE_ID'] = $row->SHADE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$arrRes[$i]['primaryImage'] = $row->primaryImage;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllActiveShadesListing(){
    
    	$result = DB::table('jb_shades_tbl as a')->select('a.*',
    			DB::raw("(SELECT DOWN_PATH FROM jb_shades_attachment_tbl as jsat
						WHERE jsat.SHADE_ID = a.SHADE_ID and jsat.PRIMARY_FLAG = '1') as primaryImage"))
    			->where('a.STATUS','active')
    			->orderBy('a.SHADE_ID','desc')
    			->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['SHADE_ID'] = $row->SHADE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$arrRes[$i]['primaryImage'] = $row->primaryImage;
    		$arrRes[$i]['DATE'] = $row->DATE;
    
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
}
