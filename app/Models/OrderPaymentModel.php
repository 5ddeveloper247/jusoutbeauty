<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class OrderPaymentModel extends Model
{
    use HasFactory;
    
	public function getAllSpecificOrderPaymentData($orderId){
    	
    	$result = DB::table('jb_order_payment_tbl as a')->select('a.*')
    	->where('a.ORDER_ID',$orderId)
    	->get();
    	
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['PAYMENT_ID'] = $row->PAYMENT_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes['PAYMENT_TYPE'] = $row->PAYMENT_TYPE;
    		$arrRes['CARD_NUMBER'] = $row->CARD_NUMBER;
    		$arrRes['EXPIRY_MONTH'] = $row->EXPIRY_MONTH;
    		$arrRes['EXPIRY_YEAR'] = $row->EXPIRY_YEAR;
    		$arrRes['SECURITY_CODE'] = $row->SECURITY_CODE;
    		$arrRes['PAYMENT_STATUS'] = $row->PAYMENT_STATUS;
    		$arrRes['PAYMENT_DATE'] = date('d-M-Y', strtotime($row->DATE));
    	
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllOrderPaymentData(){
    	
    	$OrderModel = new OrderModel();
    	
    	$result = DB::table('jb_order_payment_tbl as a')->select('a.*','fut.FIRST_NAME','fut.LAST_NAME')
    	->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->PAYMENT_ID;//$i+1;
    		$arrRes[$i]['PAYMENT_ID'] = $row->PAYMENT_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['USERNAME'] = $row->FIRST_NAME.' '.$row->LAST_NAME;
    		$arrRes[$i]['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes[$i]['ORDER_NUMBER'] = 'ORDER#'.$row->ORDER_ID;
    		$arrRes[$i]['PAYMENT_TYPE'] = $row->PAYMENT_TYPE;
    		$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    		$arrRes[$i]['PAYMENT_DATE'] = date('d-M-Y', strtotime($row->DATE));
    		$arrRes[$i]['TRANSACTION_ID'] = $row->TRANSACTION_ID != null ? $row->TRANSACTION_ID : '';
    		$arrRes[$i]['TRANSACTION_STATUS'] = $row->TRANSACTION_STATUS;
    		
    		$totalIncVat = $OrderModel->getOrderGrandTotalAmountIncVat($row->ORDER_ID);
    		$totalDisc = $OrderModel->getOrderTotalDiscountAmount($row->ORDER_ID);
    		$totalVat = $OrderModel->getOrderTotalVatAmount($row->ORDER_ID);
    		
    		$arrRes[$i]['totalOrderAmount'] = number_format($totalIncVat - $totalDisc,2);
    		$arrRes[$i]['totalVatAmount'] = number_format($totalVat,2);
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecficOrderPaymentData($paymentId){
    	 
    	$OrderModel = new OrderModel();
    	 
    	$result = DB::table('jb_order_payment_tbl as a')->select('a.*','fut.FIRST_NAME','fut.LAST_NAME')
    	->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->where('a.PAYMENT_ID',$paymentId)
    	->orderBy('a.PAYMENT_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['PAYMENT_ID'] = $row->PAYMENT_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['USERNAME'] = $row->FIRST_NAME.' '.$row->LAST_NAME;
    		$arrRes['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes['ORDER_NUMBER'] = 'ORDER#'.$row->ORDER_ID;
    		$arrRes['PAYMENT_TYPE'] = $row->PAYMENT_TYPE;
    		$arrRes['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    		$arrRes['PAYMENT_DATE'] = date('d-M-Y', strtotime($row->DATE));
    		$arrRes['TRANSACTION_ID'] = $row->TRANSACTION_ID != null ? $row->TRANSACTION_ID : '';
    		$arrRes['TRANSACTION_STATUS'] = $row->TRANSACTION_STATUS;
    
    		$totalIncVat = $OrderModel->getOrderGrandTotalAmountIncVat($row->ORDER_ID);
    		$totalDisc = $OrderModel->getOrderTotalDiscountAmount($row->ORDER_ID);
    		$totalVat = $OrderModel->getOrderTotalVatAmount($row->ORDER_ID);
    
    		$arrRes['totalOrderAmount'] = number_format($totalIncVat - $totalDisc,2);
    		$arrRes['totalVatAmount'] = number_format($totalVat,2);
    
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
}
