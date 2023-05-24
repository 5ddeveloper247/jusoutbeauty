<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class GivingModel extends Model
{
    use HasFactory;
    
	// public function getAllSpecificOrderPaymentData($orderId){
    	
    // 	$result = DB::table('jb_giving_tbl as a')->select('a.*')
    // 	->where('a.ORDER_ID',$orderId)
    // 	->get();
    	
    // 	$i=0;
    // 	foreach ($result as $row){
    // 		$arrRes['PAYMENT_ID'] = $row->PAYMENT_ID;
    // 		$arrRes['USER_ID'] = $row->USER_ID;
    // 		$arrRes['ORDER_ID'] = $row->ORDER_ID;
    // 		$arrRes['PAYMENT_TYPE'] = $row->PAYMENT_TYPE;
    // 		$arrRes['CARD_NUMBER'] = $row->CARD_NUMBER;
    // 		$arrRes['EXPIRY_MONTH'] = $row->EXPIRY_MONTH;
    // 		$arrRes['EXPIRY_YEAR'] = $row->EXPIRY_YEAR;
    // 		$arrRes['SECURITY_CODE'] = $row->SECURITY_CODE;
    // 		$arrRes['PAYMENT_STATUS'] = $row->PAYMENT_STATUS;
    // 		$arrRes['PAYMENT_DATE'] = date('d-M-Y', strtotime($row->DATE));
    	
    // 		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    // 		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    // 		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    // 		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    		
    // 		$i++;
    // 	}
    
    // 	return isset($arrRes) ? $arrRes : null;
    // }
    public function getAllAdminGivingsData(){
    	
    	// $OrderModel = new OrderModel();
    	
    	$result = DB::table('jb_giving_tbl as a')->select('a.*','a.USER_NAME','fut.FIRST_NAME','fut.LAST_NAME')
    	->leftJoin ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->GIVING_ID;//$i+1;
    		$arrRes[$i]['GIVING_ID'] = $row->GIVING_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['USERNAME'] = $row->USER_NAME;//$row->FIRST_NAME.' '.$row->LAST_NAME;
    		$arrRes[$i]['USER_EMAIL'] = $row->USER_EMAIL;
    		$arrRes[$i]['USER_PHONE'] = $row->USER_PHONE;
    		$arrRes[$i]['AMOUNT'] = number_format($row->AMOUNT, 2);
    		$arrRes[$i]['PAYMENT_DATE'] = date('d-M-Y H:i a', strtotime($row->PAYMENT_DATE));
    		$arrRes[$i]['PAYMENT_TYPE'] = $row->PAYMENT_TYPE;
    		$arrRes[$i]['TRANSACTION_ID'] = $row->TRANSACTION_ID != null ? $row->TRANSACTION_ID : '';
    		$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
  
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificAdminGivingDetailData($givingId){
    	 
    	// $OrderModel = new OrderModel();
    	 
    	$result = DB::table('jb_giving_tbl as a')->select('a.*','a.USER_NAME','fut.FIRST_NAME','fut.LAST_NAME')
    	->leftJoin ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->where('a.GIVING_ID',$givingId)
    	// ->orderBy('a.GIVING_ID','desc')
    	->get();
    	$i=0;
    	foreach ($result as $row){
			$arrRes['seqNo'] = $i+1;//$i+1;
    		$arrRes['GIVING_ID'] = $row->GIVING_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['USERNAME'] = $row->USER_NAME;//$row->FIRST_NAME.' '.$row->LAST_NAME;
    		$arrRes['USER_EMAIL'] = $row->USER_EMAIL;
    		$arrRes['USER_PHONE'] = $row->USER_PHONE;
    		$arrRes['AMOUNT'] = number_format($row->AMOUNT, 2);
    		$arrRes['PAYMENT_DATE'] = date('d-M-Y H:i a', strtotime($row->PAYMENT_DATE));
    		$arrRes['PAYMENT_TYPE'] = $row->PAYMENT_TYPE;
    		$arrRes['TRANSACTION_ID'] = $row->TRANSACTION_ID != null ? $row->TRANSACTION_ID : '';
    		$arrRes['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
			
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
			
    		$i++;
    	}
		// dd($arrRes);
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
}
