<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class OrderShippingModel extends Model
{
    use HasFactory;
    
	public function getAllSpecificOrderShippingData($orderId){
    	
		DB::enableQueryLog();
		
    	$result = DB::table('jb_order_shipping_address_tbl as a')->select('a.*','jct.NAME as countryName')
    	->leftJoin ( 'jb_country_tbl as jct', 'a.COUNTRY_ID', '=', 'jct.COUNTRY_ID' )
    	->where('a.ORDER_ID',$orderId)
    	->orderBy('a.ORDER_ID','desc')
    	->get();
//     	$query = DB::getQueryLog(); dd($query);
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ADDRESS_ID'] = $row->ADDRESS_ID;
    		$arrRes['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['FIRST_NAME'] = $row->FIRST_NAME;
    		$arrRes['LAST_NAME'] = $row->LAST_NAME;
    		$arrRes['ADDRESS'] = $row->ADDRESS;
    		$arrRes['APT_SUITE'] = $row->APT_SUITE;
    		$arrRes['CITY'] = $row->CITY;
    		$arrRes['STATE'] = $row->STATE;
    		$arrRes['ZIP_CODE'] = $row->ZIP_CODE;
    		$arrRes['COUNTRY_ID'] = $row->COUNTRY_ID;
    		$arrRes['COUNTRY_NAME'] = $row->countryName;
    		$arrRes['EMAIL'] = $row->EMAIL;
    		$arrRes['PHONE_NUMBER'] = $row->PHONE_NUMBER;
    		$arrRes['BILLING_ADDRESS_FLAG'] = $row->BILLING_ADDRESS_FLAG;
    		$arrRes['SHIPPING_DATE'] = date('d-M-Y', strtotime($row->DATE));
    	
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
}
