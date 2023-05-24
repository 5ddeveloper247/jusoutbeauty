<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class FooterSubscriptionModel extends Model
{
    use HasFactory;
    
    public function getSubscriptionByEmail($email){
    
    	$result = DB::table('jb_footer_subscription_tbl as a')->select('a.*')
    	->where('a.EMAIL',$email)
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['FOOTER_SUBSCRIPTION_ID'] = $row->FOOTER_SUBSCRIPTION_ID;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['PHONE_NUMBER'] = $row->PHONE_NUMBER;
    		$arrRes[$i]['DATE'] = date('d M,Y H:i A', strtotime($row->DATE));
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : '';
    }
    
    public function getAllSubscriptionForAdmin(){
    
    	$result = DB::table('jb_footer_subscription_tbl as a')->select('a.*')
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->FOOTER_SUBSCRIPTION_ID;//$i+1;
    		$arrRes[$i]['FOOTER_SUBSCRIPTION_ID'] = $row->FOOTER_SUBSCRIPTION_ID;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['PHONE_NUMBER'] = $row->PHONE_NUMBER;
    		$arrRes[$i]['DATE'] = date('d M,Y H:i A', strtotime($row->DATE));
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : '';
    }
    
    
    
}
