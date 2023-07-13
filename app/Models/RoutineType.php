<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class RoutineType extends model
{

    protected $table="jb_routine_tbl";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
      protected $fillable = [
          'ROUTINE_ID',
          'NAME',
          'STATUS',
		  'DESCRIPTION',
		  'IMAGE_PATH',
		  'IMAGE_DOWNPATH',
          'DATE',
          'CREATED_BY',
          'CREATED_ON',
          'UPDATED_BY',
          'UPDATED_ON',
     ];

     public function getRoutineTypeData(){

    	$result = DB::table('jb_routine_tbl as a')->select('a.*')
		->where('a.status','active')
    	->orderBy('a.UPDATED_ON','desc')
    	->get()->toArray();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->ROUTINE_ID;//$i+1;
    		$arrRes[$i]['IDENTIFY'] = $row->IDENTIFY;
			$arrRes[$i]['DESCRIPTION'] = strip_tags($row->DESCRIPTION);
    		$arrRes[$i]['IMAGE'] = $row->IMAGE_PATH;
			$arrRes[$i]['IMAGE_DOWNPATH'] = $row->IMAGE_DOWN_PATH;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['NAME'] = $row->NAME;
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

	public function getRoutineTypeDataAdmin(){

    	$result = DB::table('jb_routine_tbl as a')->select('a.*')
    	->orderBy('a.UPDATED_ON','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->ROUTINE_ID;//$i+1;
    		$arrRes[$i]['IDENTIFY'] = $row->IDENTIFY;
			$arrRes[$i]['DESCRIPTION'] = strip_tags($row->DESCRIPTION);
    		$arrRes[$i]['IMAGE'] = $row->IMAGE_PATH;
			$arrRes[$i]['IMAGE_DOWNPATH'] = $row->IMAGE_DOWN_PATH;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['NAME'] = $row->NAME;
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

	public function getAllRouteByIdForWebiste($id){
		$result = DB::table('jb_routine_tbl as a')->select('a.*')
		->where('ROUTINE_ID', $id)
    	->orderBy('a.UPDATED_ON','desc')
    	->get();

        if($result->isEmpty()){
            abort(404);
        }else{
            $i=0;
            foreach ($result as $row){
                $arrRes[$i]['seqNo'] = $row->ROUTINE_ID;//$i+1;
                $arrRes[$i]['IDENTIFY'] = $row->IDENTIFY;
                $arrRes[$i]['DESCRIPTION'] = strip_tags($row->DESCRIPTION);
                $arrRes[$i]['IMAGE'] = $row->IMAGE_PATH;
                $arrRes[$i]['IMAGE_DOWNPATH'] = $row->IMAGE_DOWN_PATH;
                $arrRes[$i]['USER_ID'] = $row->USER_ID;
                $arrRes[$i]['NAME'] = $row->NAME;
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


	}

    public function getSpecificRotineTypeData($id){

    	$result = DB::table('jb_routine_tbl as a')->select('a.*')
    	->where('a.ROUTINE_ID',$id)
    	->orderBy('a.ROUTINE_ID','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){

    		$arrRes['ID'] = $row->ROUTINE_ID;
    		$arrRes['NAME'] = $row->NAME;
			$arrRes['DESCRIPTION'] = strip_tags($row->DESCRIPTION);
    		$arrRes['IMAGE'] = $row->IMAGE_PATH;
			$arrRes['IMAGE_DOWNPATH'] = $row->IMAGE_DOWN_PATH;
            $arrRes['IDENTIFY'] = $row->IDENTIFY;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['STATUS'] = $row->STATUS;
    		$arrRes['DATE'] = $row->DATE;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }

	public function getSpecificRoutineTypeAttachments($TYPEID){

    	$result = DB::table('jb_routine_tbl as a')->select('a.*')
    	->where('a.ROUTINE_ID', $TYPEID)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		// $arrRes['ID'] = $row->ATTACHMENT_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['ingredientId'] = $row->ROUTINE_ID;
    		// $arrRes['code'] = $row->SOURCE_CODE;
    		// $arrRes['fileType'] = $row->FILE_TYPE;
    		// $arrRes['fileName'] = $row->FILE_NAME;
    		// $arrRes['fullName'] = $row->FULL_NAME;
    		$arrRes['path'] = $row->IMAGE_PATH;
    		$arrRes['downPath'] = $row->IMAGE_DOWN_PATH;
    		// $arrRes['primFlag'] = $row->PRIMARY_FLAG;
    		// $arrRes['secFlag'] = $row->SECONDARY_FLAG;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    	}

    	return isset($arrRes) ? $arrRes : null;
    }


}
