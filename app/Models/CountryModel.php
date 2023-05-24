<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class CountryModel extends Model
{
    use HasFactory;
    
    public function getCountryLov(){
    	 
    	$result = DB::table('jb_country_tbl as a')->select('a.*') ->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->COUNTRY_ID;
    		$arrRes[$i]['name'] = $row->NAME;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
   
}
