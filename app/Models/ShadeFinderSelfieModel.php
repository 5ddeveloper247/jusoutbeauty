<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class ShadeFinderSelfieModel extends Model
{
    use HasFactory;

    protected $fillable = ['USER_ID','USERNAME','USER_EMAIL','PATH','DOWNPATH','DATE'];


    public function getAllShadeFinderSelfieForAdmin(){

    	$result = DB::table('jb_shade_finder_selfie_tbl as a')->select('a.*')
    	->orderBy('a.UPDATED_ON','desc')
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->SELFIE_ID;//$i+1;
    		$arrRes[$i]['SELFIE_ID'] = $row->SELFIE_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['USERNAME'] = $row->USERNAME;
    		$arrRes[$i]['USER_EMAIL'] = $row->USER_EMAIL;
    		$arrRes[$i]['PATH'] = $row->PATH;
    		$arrRes[$i]['DOWNPATH'] = $row->DOWNPATH;
    		$arrRes[$i]['TYPE'] = 'selfi';

    		$arrRes[$i]['DATE'] = date('d M,Y H:i A', strtotime($row->DATE));
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
            $dateTime = new DateTime($row->CREATED_ON);
            $formattedDate = $dateTime->format('d-M-Y g:i A');

            // Update the 'CREATED_ON' field in the $arrRes array
            $arrRes[$i]['CREATED_ON'] = $formattedDate;
    		// $arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    		$i++;
    	}

    	return isset($arrRes) ? $arrRes : '';
    }

}
