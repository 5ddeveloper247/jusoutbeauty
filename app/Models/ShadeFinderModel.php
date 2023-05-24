<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class ShadeFinderModel extends Model
{
    use HasFactory;
    
    public function getAllShadeFinderOptionsData(){
    
    	$result = DB::table('jb_shade_finder_options_tbl as a')->select('a.*')
    	->orderBy('a.OPTION_ID','asc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['OPTION_ID'] = $row->OPTION_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['CAPTION'] = $row->CAPTION;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderOptionData($id){
    
    	$result = DB::table('jb_shade_finder_options_tbl as a')->select('a.*')
    	->where('a.OPTION_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->OPTION_ID;
    		$arrRes['P_1'] = $row->TITLE;
    		$arrRes['P_2'] = $row->CAPTION;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificShadeFinderLevel1Data($id){
    
    	$result = DB::table('jb_shade_finder_level_one_tbl as a')->select('a.*')
    	->where('a.OPTION_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->LEVEL_ONE_ID;
    		$arrRes['L_1'] = $row->TITLE;
    		$arrRes['L_2'] = $row->DESCRITION;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevelOneWrtOption($id){
    
    	$result = DB::table('jb_shade_finder_level_one_tbl as a')->select('a.*')
    	->where('a.OPTION_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['LEVEL_ONE_ID'] = $row->LEVEL_ONE_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['DESCRITION'] = $row->DESCRITION;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevel1TypesByLevel1Id($id){
    
    	$result = DB::table('jb_shade_finder_level_one_type_tbl as a')->select('a.*')
    	->where('a.LEVEL_ONE_ID',$id)
		->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['LEVEL_ONE_TYPE_ID'] = $row->LEVEL_ONE_TYPE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['LEVEL_ONE_ID'] = $row->LEVEL_ONE_ID;
    		$arrRes[$i]['TITLE'] = strlen ( $row->TITLE ) > 30?substr ( $row->TITLE, 0, 30 )."..." :$row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['PRIMARY_PRODUCT_IDS'] = $row->PRIMARY_PRODUCT_IDS;
    		$arrRes[$i]['RECOMMANDED_PRODUCT_IDS'] = $row->RECOMMANDED_PRODUCT_IDS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevelOneTypesByLevelOneIdForWebsite($id){
    
    	$result = DB::table('jb_shade_finder_level_one_type_tbl as a')->select('a.*')
    	->where('a.LEVEL_ONE_ID',$id)
    	->orderBy('a.LEVEL_ONE_TYPE_ID','asc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['LEVEL_ONE_TYPE_ID'] = $row->LEVEL_ONE_TYPE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['LEVEL_ONE_ID'] = $row->LEVEL_ONE_ID;
    		$arrRes[$i]['TITLE'] = strlen ( $row->TITLE ) > 30?substr ( $row->TITLE, 0, 30 )."..." :$row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = strip_tags(base64_decode($row->DESCRIPTION));
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['PRIMARY_PRODUCT_IDS'] = $row->PRIMARY_PRODUCT_IDS;
    		$arrRes[$i]['RECOMMANDED_PRODUCT_IDS'] = $row->RECOMMANDED_PRODUCT_IDS;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['images'] = $this->getSpecificShadeFinderLevel1TypeImages($row->LEVEL_ONE_TYPE_ID);
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getShadeFinderLevel1TypesLov($id){
    
    	$result = DB::table('jb_shade_finder_level_one_type_tbl as a')->select('a.*')
    	->where('a.LEVEL_ONE_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->LEVEL_ONE_TYPE_ID;
    		$arrRes[$i]['name'] = strlen ( $row->TITLE ) > 30?substr ( $row->TITLE, 0, 30 )."..." :$row->TITLE;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevel1TypeDetails($id){
    
    	$result = DB::table('jb_shade_finder_level_one_type_tbl as a')->select('a.*')
    	->where('a.LEVEL_ONE_TYPE_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->LEVEL_ONE_TYPE_ID;
    		$arrRes['LT_1'] = $row->TITLE;
    		$arrRes['LT_2'] = $row->PRIMARY_PRODUCT_IDS != '' ? explode(',',$row->PRIMARY_PRODUCT_IDS) : '';
    		$arrRes['LT_3'] = $row->RECOMMANDED_PRODUCT_IDS != '' ? explode(',',$row->RECOMMANDED_PRODUCT_IDS) : '';
    		$arrRes['LT_4'] = base64_decode($row->DESCRIPTION);
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevel1TypeImages($id){
    
    	$result = DB::table('jb_shade_finder_images_tbl as a')->select('a.*')
    	->where('a.LEVEL_ONE_TYPE_ID', $id)
    	->orderBy('a.LEVEL_ONE_TYPE_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ID'] = $row->IMAGE_ID;
    		$arrRes[$i]['userId'] = $row->USER_ID;
    		$arrRes[$i]['levelOneTypeId'] = $row->LEVEL_ONE_TYPE_ID;
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
    public function getSpecificLevel1TypeImage($id){
    
    	$result = DB::table('jb_shade_finder_images_tbl as a')->select('a.*')
    	->where('a.IMAGE_ID', $id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->IMAGE_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['levelOneTypeId'] = $row->LEVEL_ONE_TYPE_ID;
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
    public function getLatestLevel1TypeImageByLevel1Id($id){
    
    	$result = DB::table('jb_shade_finder_images_tbl as a')->select('a.*')
    	->where('a.LEVEL_ONE_TYPE_ID', $id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->IMAGE_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['levelOneTypeId'] = $row->LEVEL_ONE_TYPE_ID;
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
    public function getSpecificShadeFinderLevelTypeImagesCount($typeId){
    
    	$result = DB::table('jb_shade_finder_images_tbl as a')->select('a.*')
    	->where('a.LEVEL_ONE_TYPE_ID',$typeId)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes = $i+1;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function checkDuplicatelevelTypeWrtlevelID($title,$levelId, $id=''){
    	if($id != ''){
    		$result = DB::table('jb_shade_finder_level_one_type_tbl')->select('LEVEL_ONE_TYPE_ID')
    		->where('LEVEL_ONE_TYPE_ID', '!=', $id)
    		->where('LEVEL_ONE_ID', $levelId)
    		->where('TITLE', "$title")
    		->get();
    	}else{
    		$result = DB::table('jb_shade_finder_level_one_type_tbl')->select('LEVEL_ONE_TYPE_ID')
    		->where('LEVEL_ONE_ID', $levelId)
    		->where('TITLE', "$title")
    		->get();
    	}
//     	print_r($levelId);exit();
    	$i=0;
    	foreach ($result as $row){
    		$typeId = $row->LEVEL_ONE_TYPE_ID;
    	}
    
    	return isset($typeId) ? $typeId : '';
    }
    
    public function getSpecificShadeFinderLevel2Data($id){
    
    	$result = DB::table('jb_shade_finder_level_two_tbl as a')->select('a.*')
    	->where('a.OPTION_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->LEVEL_TWO_ID;
    		$arrRes['L_1'] = $row->TITLE;
    		$arrRes['L_2'] = $row->DESCRIPTION;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevelTwoWrtOption($id){
    
    	$result = DB::table('jb_shade_finder_level_two_tbl as a')->select('a.*')
    	->where('a.OPTION_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['LEVEL_TWO_ID'] = $row->LEVEL_TWO_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['DESCRIPTION'] = $row->DESCRIPTION;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevel2TypesByLevel2Id($id){
    
    	$result = DB::table('jb_shade_finder_level_two_type_tbl as a')->select('a.*', 'jsflot.TITLE as level1TypeTitle')
    	->join ( 'jb_shade_finder_level_one_type_tbl as jsflot', 'a.LEVEL_ONE_TYPE_ID', '=', 'jsflot.LEVEL_ONE_TYPE_ID' )
    	->where('a.LEVEL_TWO_ID',$id)
		->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['LEVEL_TWO_TYPE_ID'] = $row->LEVEL_TWO_TYPE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['LEVEL_TWO_ID'] = $row->LEVEL_TWO_ID;
    		$arrRes[$i]['LEVEL_ONE_TYPE_ID'] = $row->LEVEL_ONE_TYPE_ID;
    		$arrRes[$i]['LEVEL_ONE_TYPE_TITLE'] = strlen ( $row->level1TypeTitle ) > 30?substr ( $row->level1TypeTitle, 0, 30 )."..." :$row->level1TypeTitle;
    		$arrRes[$i]['TITLE'] = strlen ( $row->TITLE ) > 30?substr ( $row->TITLE, 0, 30 )."..." :$row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = strip_tags(base64_decode($row->DESCRIPTION));
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevelTwoTypesForWebsite($id){
    
    	$result = DB::table('jb_shade_finder_level_two_type_tbl as a')->select('a.*')
    	->where('a.LEVEL_ONE_TYPE_ID',$id)
    	->orderBy('a.LEVEL_TWO_TYPE_ID','asc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['LEVEL_TWO_TYPE_ID'] = $row->LEVEL_TWO_TYPE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['LEVEL_TWO_ID'] = $row->LEVEL_TWO_ID;
    		$arrRes[$i]['LEVEL_ONE_TYPE_ID'] = $row->LEVEL_ONE_TYPE_ID;
    		$arrRes[$i]['TITLE'] = strlen ( $row->TITLE ) > 30?substr ( $row->TITLE, 0, 30 )."..." :$row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = strip_tags(base64_decode($row->DESCRIPTION));
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function checkDuplicatelevel2TypeWrtlevel2ID($title,$level2Id,$level1TypeId, $id=''){
    	if($id != ''){
    		$result = DB::table('jb_shade_finder_level_two_type_tbl')->select('LEVEL_TWO_TYPE_ID')
    		->where('LEVEL_TWO_TYPE_ID', '!=', $id)
    		->where('LEVEL_TWO_ID', $level2Id)
    		->where('LEVEL_ONE_TYPE_ID', $level1TypeId)
    		->where('TITLE', "$title")
    		->get();
    	}else{
    		$result = DB::table('jb_shade_finder_level_two_type_tbl')->select('LEVEL_TWO_TYPE_ID')
    		->where('LEVEL_TWO_ID', $level2Id)
    		->where('LEVEL_ONE_TYPE_ID', $level1TypeId)
    		->where('TITLE', "$title")
    		->get();
    	}
    	//     	print_r($levelId);exit();
    	$i=0;
    	foreach ($result as $row){
    		$typeId = $row->LEVEL_TWO_TYPE_ID;
    	}
    
    	return isset($typeId) ? $typeId : '';
    }
    
    public function getSpecificShadeFinderLevel2TypeDetails($id){
    
    	$result = DB::table('jb_shade_finder_level_two_type_tbl as a')->select('a.*')
    	->where('a.LEVEL_TWO_TYPE_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->LEVEL_TWO_TYPE_ID;
    		$arrRes['LT_1'] = $row->TITLE;
    		$arrRes['LT_2'] = $row->LEVEL_ONE_TYPE_ID;
    		$arrRes['LT_3'] = base64_decode($row->DESCRIPTION);
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevel3Data($id){
    
    	$result = DB::table('jb_shade_finder_level_three_tbl as a')->select('a.*')
    	->where('a.OPTION_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->LEVEL_THREE_ID;
    		$arrRes['L_1'] = $row->TITLE;
    		$arrRes['L_2'] = $row->DESCRIPTION;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevelThreeWrtOption($id){
    
    	$result = DB::table('jb_shade_finder_level_three_tbl as a')->select('a.*')
    	->where('a.OPTION_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['LEVEL_THREE_ID'] = $row->LEVEL_THREE_ID;
    		$arrRes['TITLE'] = $row->TITLE;
    		$arrRes['DESCRIPTION'] = $row->DESCRIPTION;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getShadeFinderLevel2TypesLov($id){
    
    	$result = DB::table('jb_shade_finder_level_two_type_tbl as a')->select('a.*', 'jsflot.TITLE as level1TypeTitle')
    	->join ( 'jb_shade_finder_level_one_type_tbl as jsflot', 'a.LEVEL_ONE_TYPE_ID', '=', 'jsflot.LEVEL_ONE_TYPE_ID' )
    	->where('a.LEVEL_TWO_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->LEVEL_TWO_TYPE_ID;
    		$level1TypeTitle = strlen ( $row->level1TypeTitle ) > 30?substr ( $row->level1TypeTitle, 0, 30 )."..." :$row->level1TypeTitle;
    		$level2TypeTitle = strlen ( $row->TITLE ) > 30?substr ( $row->TITLE, 0, 30 )."..." :$row->TITLE;
    		$arrRes[$i]['name'] = $level1TypeTitle.'/'.$level2TypeTitle;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function checkDuplicatelevel3TypeWrtlevel3ID($title,$level3Id,$level2TypeId, $id=''){
    	if($id != ''){
    		$result = DB::table('jb_shade_finder_level_three_type_tbl')->select('LEVEL_THREE_TYPE_ID')
    		->where('LEVEL_THREE_TYPE_ID', '!=', $id)
    		->where('LEVEL_THREE_ID', $level3Id)
    		->where('LEVEL_TWO_TYPE_ID', $level2TypeId)
    		->where('TITLE', "$title")
    		->get();
    	}else{
    		$result = DB::table('jb_shade_finder_level_three_type_tbl')->select('LEVEL_THREE_TYPE_ID')
    		->where('LEVEL_THREE_ID', $level3Id)
    		->where('LEVEL_TWO_TYPE_ID', $level2TypeId)
    		->where('TITLE', "$title")
    		->get();
    	}
    	//     	print_r($levelId);exit();
    	$i=0;
    	foreach ($result as $row){
    		$typeId = $row->LEVEL_THREE_TYPE_ID;
    	}
    
    	return isset($typeId) ? $typeId : '';
    }
    
    public function getSpecificShadeFinderLevel3TypesByLevel3Id($id){
    
    	$result = DB::table('jb_shade_finder_level_three_type_tbl as a')->select('a.*', 'jsflot.TITLE as level2TypeTitle', 'jsflot1.TITLE as level1TypeTitle')
    	->join ( 'jb_shade_finder_level_two_type_tbl as jsflot', 'a.LEVEL_TWO_TYPE_ID', '=', 'jsflot.LEVEL_TWO_TYPE_ID' )
    	->join ( 'jb_shade_finder_level_one_type_tbl as jsflot1', 'jsflot.LEVEL_ONE_TYPE_ID', '=', 'jsflot1.LEVEL_ONE_TYPE_ID' )
    	->where('a.LEVEL_THREE_ID',$id)
		->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['LEVEL_THREE_TYPE_ID'] = $row->LEVEL_THREE_TYPE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['LEVEL_THREE_ID'] = $row->LEVEL_THREE_ID;
    		$arrRes[$i]['LEVEL_TWO_TYPE_ID'] = $row->LEVEL_TWO_TYPE_ID;
    		$level1TypeTitle = strlen ( $row->level1TypeTitle ) > 20?substr ( $row->level1TypeTitle, 0, 20 )."..." :$row->level1TypeTitle;
    		$level2TypeTitle = strlen ( $row->level2TypeTitle ) > 20?substr ( $row->level2TypeTitle, 0, 20 )."..." :$row->level2TypeTitle;
    		$arrRes[$i]['LEVEL_TWO_TYPE_TITLE'] = $level1TypeTitle.'/'.$level2TypeTitle;
    		$arrRes[$i]['TITLE'] = strlen ( $row->TITLE ) > 30?substr ( $row->TITLE, 0, 30 )."..." :$row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$arrRes[$i]['PRIMARY_PRODUCT_IDS'] = $row->PRIMARY_PRODUCT_IDS;
    		$arrRes[$i]['RECOMMANDED_PRODUCT_IDS'] = $row->RECOMMANDED_PRODUCT_IDS;
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificShadeFinderLevelThreeTypesForWebsite($id){
    
    	$result = DB::table('jb_shade_finder_level_three_type_tbl as a')->select('a.*')
    	
    	->where('a.LEVEL_TWO_TYPE_ID',$id)
    	->orderBy('a.LEVEL_THREE_TYPE_ID','asc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['LEVEL_THREE_TYPE_ID'] = $row->LEVEL_THREE_TYPE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['LEVEL_THREE_ID'] = $row->LEVEL_THREE_ID;
    		$arrRes[$i]['LEVEL_TWO_TYPE_ID'] = $row->LEVEL_TWO_TYPE_ID;
    		
    		$arrRes[$i]['TITLE'] = strlen ( $row->TITLE ) > 30?substr ( $row->TITLE, 0, 30 )."..." :$row->TITLE;
    		$arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
    		$arrRes[$i]['PRIMARY_PRODUCT_IDS'] = $row->PRIMARY_PRODUCT_IDS;
    		$arrRes[$i]['RECOMMANDED_PRODUCT_IDS'] = $row->RECOMMANDED_PRODUCT_IDS;
    		$descText = strip_tags(base64_decode($row->DESCRIPTION));
    		$arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
    		$arrRes[$i]['DATE'] = $row->DATE;
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificShadeFinderLevel3TypeDetails($id){
    
    	$result = DB::table('jb_shade_finder_level_three_type_tbl as a')->select('a.*')
    	->where('a.LEVEL_THREE_TYPE_ID',$id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->LEVEL_THREE_TYPE_ID;
    		$arrRes['LT_1'] = $row->TITLE;
    		$arrRes['LT_2'] = $row->LEVEL_TWO_TYPE_ID;
    		$arrRes['LT_3'] = $row->PRIMARY_PRODUCT_IDS != '' ? explode(',',$row->PRIMARY_PRODUCT_IDS) : '';
    		$arrRes['LT_4'] = $row->RECOMMANDED_PRODUCT_IDS != '' ? explode(',',$row->RECOMMANDED_PRODUCT_IDS) : '';
    		$arrRes['LT_5'] = base64_decode($row->DESCRIPTION);
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function checklevel1TypeUsed($level1TypeId=''){
    		
    	$result = DB::table('jb_shade_finder_level_two_type_tbl')->select('LEVEL_TWO_TYPE_ID')
    		->where('LEVEL_ONE_TYPE_ID', $level1TypeId)
    		->get();
    	
    	$i=0;
    	foreach ($result as $row){
    		$typeId = $row->LEVEL_TWO_TYPE_ID;
    	}
    
    	return isset($typeId) ? $typeId : '';
    }
    public function checklevel2TypeUsed($level2TypeId=''){
    
    	$result = DB::table('jb_shade_finder_level_three_type_tbl')->select('LEVEL_THREE_TYPE_ID')
    	->where('LEVEL_TWO_TYPE_ID', $level2TypeId)
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$typeId = $row->LEVEL_THREE_TYPE_ID;
    	}
    
    	return isset($typeId) ? $typeId : '';
    }
}
