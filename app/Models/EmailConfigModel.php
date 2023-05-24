<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class EmailConfigModel extends Model
{
    use HasFactory;
    
    
    public function getAllEmailConfigData(){
    	 
    	DB::enableQueryLog();
    	$result = DB::table('sys_email_config_tbl as a')->select('a.*')
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    	
//     	$query = DB::getQueryLog(); dd($query);
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->EMAIL_CONFIG_ID;
    		$arrRes[$i]['EMAIL_CONFIG_ID'] = $row->EMAIL_CONFIG_ID;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['SUBJECT'] = $row->SUBJECT;
    		$arrRes[$i]['FROM_EMAIL'] = $row->FROM_EMAIL;
    		$arrRes[$i]['MESSAGE'] = base64_decode($row->MESSAGE);
    		
    		$descText = strip_tags(base64_decode($row->MESSAGE));
    		$arrRes[$i]['MESSAGE_TRIM'] = strlen ( $descText ) > 40?substr ( $descText, 0, 40 )."..." :$descText;
    		
    		$arrRes[$i]['LOGO_PATH'] = $row->LOGO_PATH;
    		$arrRes[$i]['LOGO_DOWNPATH'] = $row->LOGO_DOWNPATH;
    		$arrRes[$i]['MODULE_CODE'] = $row->MODULE_CODE;
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = date('d-m-Y H:i a', strtotime($row->CREATED_ON));
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getSpecificEmailConfigDetail($id){
    	 
    	$result = DB::table('sys_email_config_tbl as a')->select('a.*')
    	->where('a.EMAIL_CONFIG_ID', $id)
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    	 
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->EMAIL_CONFIG_ID;
    		$arrRes['A_1'] = $row->TITLE;
    		$arrRes['A_2'] = $row->SUBJECT;
    		$arrRes['A_3'] = $row->FROM_EMAIL;
    		$arrRes['A_4'] = base64_decode($row->MESSAGE);
    		$arrRes['A_5'] = $row->MODULE_CODE;
    		$arrRes['path'] = $row->LOGO_PATH;
    		$arrRes['downpath'] = $row->LOGO_DOWNPATH != null ? $row->LOGO_DOWNPATH : url('assets-admin')."/images/admin/Logo-01.png";
    
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificEmailConfigByCode($code){
    
    	$result = DB::table('sys_email_config_tbl as a')->select('a.*')
    	->where('a.MODULE_CODE', $code)
    	->get();
    
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->EMAIL_CONFIG_ID;
    		$arrRes['title'] = $row->TITLE;
    		$arrRes['subject'] = $row->SUBJECT;
    		$arrRes['fromEmail'] = $row->FROM_EMAIL;
    		$arrRes['message'] = base64_decode($row->MESSAGE);
    		$arrRes['code'] = $row->MODULE_CODE;
    		$arrRes['path'] = $row->LOGO_PATH;
    		$arrRes['logo'] = $row->LOGO_DOWNPATH != null ? $row->LOGO_DOWNPATH : url('assets-admin')."/images/admin/Logo-01.png";
    
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
   
    
    
    
}
