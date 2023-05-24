<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class OrderModel extends Model
{
    use HasFactory;
    public function getOrdersLov($userid){
    
    	$result = DB::table('jb_order_tbl as a')->select('a.*')
		->where('a.USER_ID',$userid)
    	->orderBy('a.USER_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['id'] = $row->ORDER_ID;
    		$arrRes[$i]['name'] = 'Order#'.$row->ORDER_ID;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
	public function getAllPlacedOrderData(){
    	
    	$result = DB::table('jb_order_tbl as a')->select('a.*','jopt.PAYMENT_STATUS', 'fut.FIRST_NAME','fut.LAST_NAME')
    	->join ( 'jb_order_payment_tbl as jopt', 'a.ORDER_ID', '=', 'jopt.ORDER_ID' )
    	->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
//     	->where('a.ORDER_STATUS','placed')
    	->whereIn('a.ORDER_STATUS', array('placed','payment in process'))
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    	
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['ORDER_NUM'] = 'Order#'.$row->ORDER_ID;
    		$arrRes[$i]['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['ORDER_DATE'] = $row->ORDER_DATE;
    		$arrRes[$i]['ORDER_STATUS'] = strtoupper($row->ORDER_STATUS);
    		$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    		$arrRes[$i]['userFirstName'] = $row->FIRST_NAME;
    		$arrRes[$i]['userLastName'] = $row->LAST_NAME;
    		$arrRes[$i]['totalOrderLines'] = $this->getOrderLinesCount($row->ORDER_ID);
//     		$arrRes[$i]['totalOrderAmount'] = number_format($this->getOrderTotalAmount($row->ORDER_ID),2);
    		
    		$totalIncVat = $this->getOrderGrandTotalAmountIncVat($row->ORDER_ID);
    		$totalDisc = $this->getOrderTotalDiscountAmount($row->ORDER_ID);
    		
    		$arrRes[$i]['totalOrderAmount'] = number_format($totalIncVat - $totalDisc,2);
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllShippedOrderData(){
    	 
    	$result = DB::table('jb_order_tbl as a')->select('a.*','jopt.PAYMENT_STATUS', 'fut.FIRST_NAME','fut.LAST_NAME')
    	->join ( 'jb_order_payment_tbl as jopt', 'a.ORDER_ID', '=', 'jopt.ORDER_ID' )
    	->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->whereIn('a.ORDER_STATUS', array('shipped','delivered'))
    	->orderBy('a.UPDATED_ON','desc')
    	->limit('100')
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['ORDER_NUM'] = 'Order#'.$row->ORDER_ID;
    		$arrRes[$i]['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['ORDER_DATE'] = $row->ORDER_DATE;
    		$arrRes[$i]['ORDER_STATUS'] = strtoupper($row->ORDER_STATUS);
    		$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    		$arrRes[$i]['userFirstName'] = $row->FIRST_NAME;
    		$arrRes[$i]['userLastName'] = $row->LAST_NAME;
    		$arrRes[$i]['totalOrderLines'] = $this->getOrderLinesCount($row->ORDER_ID);
//     		$arrRes[$i]['totalOrderAmount'] = number_format($this->getOrderTotalAmount($row->ORDER_ID),2);

    		$totalIncVat = $this->getOrderGrandTotalAmountIncVat($row->ORDER_ID);
    		$totalDisc = $this->getOrderTotalDiscountAmount($row->ORDER_ID);
    		
    		$arrRes[$i]['totalOrderAmount'] = number_format($totalIncVat - $totalDisc,2);
    
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllUserOrderData($userId){
    
    	DB::enableQueryLog();
    	
    	$result = DB::table('jb_order_tbl as a')->select('a.*','jopt.PAYMENT_STATUS', 'fut.FIRST_NAME','fut.LAST_NAME')
    	->join ( 'jb_order_payment_tbl as jopt', 'a.ORDER_ID', '=', 'jopt.ORDER_ID' )
    	->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->where('a.USER_ID', $userId)
//     	->whereIn('a.ORDER_STATUS', array('shipped','delivered'))
    	->orderBy('a.ORDER_ID','desc')
    	->limit('100')
    	->get();
    
//     	$query = DB::getQueryLog(); dd($query);
    	
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['ORDER_NUM'] = 'Order#'.$row->ORDER_ID;
    		$arrRes[$i]['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['ORDER_DATE'] = $row->ORDER_DATE;
    		$arrRes[$i]['ORDER_STATUS'] = strtoupper($row->ORDER_STATUS);
    		$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    		$arrRes[$i]['userFirstName'] = $row->FIRST_NAME;
    		$arrRes[$i]['userLastName'] = $row->LAST_NAME;
    		$arrRes[$i]['totalOrderLines'] = $this->getOrderLinesCount($row->ORDER_ID);
    		//     		$arrRes[$i]['totalOrderAmount'] = number_format($this->getOrderTotalAmount($row->ORDER_ID),2);
    
    		$totalIncVat = $this->getOrderGrandTotalAmountIncVat($row->ORDER_ID);
    		$totalDisc = $this->getOrderTotalDiscountAmount($row->ORDER_ID);
    
    		$arrRes[$i]['totalOrderAmount'] = number_format($totalIncVat - $totalDisc,2);
    
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getOrderTotalAmount($orderId){
    
    	$result = DB::table('jb_order_detail_tbl as a')->select('a.*')
    	->where('a.ORDER_ID', $orderId)
    	->get();
    
    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->TOTAL_AMOUNT;
    	}
    	return $sum;
    }
    public function getOrderLinesCount($orderId){
    
    	$result = DB::table('jb_order_detail_tbl as a')->select('a.*')
    	->where('a.ORDER_ID', $orderId)
    	->get();
    
    	$count=0;
    	foreach ($result as $row){
    		$count = $count + 1;
    
    	}
    	return $count;
    }
    
    public function fetchSpecificOrderDetails($orderId){
    	 
    	$result = DB::table('jb_order_tbl as a')->select('a.*', 'fut.FIRST_NAME','fut.LAST_NAME')
    	->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->where('a.ORDER_ID', $orderId)
    	->orderBy('a.ORDER_ID','desc')
    	->get();
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['seqNo'] = $i+1;
    		$arrRes['ORDER_NUM'] = 'Order#'.$row->ORDER_ID;
    		$arrRes['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['ORDER_DATE'] = date ( 'd-M-Y h:i A', strtotime ( $row->ORDER_DATE ) );
    		$arrRes['ORDER_STATUS'] = strtoupper($row->ORDER_STATUS);
    		$arrRes['userFirstName'] = $row->FIRST_NAME;
    		$arrRes['userLastName'] = $row->LAST_NAME;
    		$arrRes['totalOrderLines'] = $this->getOrderLinesCount($row->ORDER_ID);
//     		$arrRes['totalOrderAmount'] = number_format($this->getOrderTotalAmount($row->ORDER_ID),2);
    
    		
    		$subtotal = $this->getOrderSubTotalAmount($row->ORDER_ID);
    		$totalIncVat = $this->getOrderGrandTotalAmountIncVat($row->ORDER_ID);
    		$totalDisc = $this->getOrderTotalDiscountAmount($row->ORDER_ID);
    		$totalVat = $this->getOrderTotalVatAmount($row->ORDER_ID);
    		
    		$grandTotal = $totalIncVat - $totalDisc;
    		
    		$arrRes['ExtVatTotalAmount'] = number_format($subtotal,2);
    		$arrRes['IncVatTotalAmount'] = number_format($totalIncVat,2);
    		$arrRes['totalVatAmount'] = number_format($totalVat,2);
    		$arrRes['totalDiscountAmount'] = number_format($totalDisc,2);
    		$arrRes['grandTotal'] = number_format($grandTotal,2);
    		
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllSearchOrderData($flag='',$customerName='',$orderStatus='',$shippmentStatus='',$startDate='',$endDate=''){
    
    	if($flag == 1){		
    		$where =array(['a.ORDER_STATUS','=','placed']);		// for placed order listing
    	}else{	
    		$where =array(['a.ORDER_STATUS','!=','placed']);	// for shipped & delivered order listing
    	}
    	
    	if($customerName != ''){
    		$where = array_merge($where, array(['fut.FIRST_NAME','like',"%$customerName%"]));
    		$where = array_merge($where, array(['fut.LAST_NAME','like',"%$customerName%"]));
    	}
    	if($orderStatus != ''){
    		$where = array_merge($where, array(['a.ORDER_STATUS','=',"$orderStatus"]));
    	}
    	if($shippmentStatus != ''){
    		$where = array_merge($where, array(['josd.STATUS','=',"$shippmentStatus"]));
    	}
    	
    	if($startDate != '' && $endDate == ''){
    		
    		$where = array_merge($where, array(['a.ORDER_DATE','>=',"$startDate"]));
    		
    	}else if($startDate == '' && $endDate != ''){
    		
    		$where = array_merge($where, array(['a.ORDER_DATE','<=',"$endDate"]));
    		
    	}else if($startDate != '' && $endDate != ''){
    		
    		$where = array_merge($where, array(['a.ORDER_DATE','>=',"$startDate"]));
    		$where = array_merge($where, array(['a.ORDER_DATE','<=',"$endDate"]));
    	}
    	
//     	print_r('<pre>');
//     	print_r($where);
//     	exit();
    	
    	
    	$result = DB::table('jb_order_tbl as a')->select('a.*','jopt.PAYMENT_STATUS', 'fut.FIRST_NAME','fut.LAST_NAME')
    	->join ( 'jb_order_payment_tbl as jopt', 'a.ORDER_ID', '=', 'jopt.ORDER_ID' )
    	->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->join ( 'jb_order_shippment_detail_tbl as josd', 'a.ORDER_ID', '=', 'josd.ORDER_ID' )
    	->where($where)
    	->orderBy('a.ORDER_ID','desc')
    	->limit('100')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['ORDER_NUM'] = 'Order#'.$row->ORDER_ID;
    		$arrRes[$i]['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['ORDER_DATE'] = $row->ORDER_DATE;
    		$arrRes[$i]['ORDER_STATUS'] = strtoupper($row->ORDER_STATUS);
    		$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    		$arrRes[$i]['userFirstName'] = $row->FIRST_NAME;
    		$arrRes[$i]['userLastName'] = $row->LAST_NAME;
    		$arrRes[$i]['totalOrderLines'] = $this->getOrderLinesCount($row->ORDER_ID);
//     		$arrRes[$i]['totalOrderAmount'] = number_format($this->getOrderTotalAmount($row->ORDER_ID),2);

    		$totalIncVat = $this->getOrderGrandTotalAmountIncVat($row->ORDER_ID);
    		$totalDisc = $this->getOrderTotalDiscountAmount($row->ORDER_ID);
    		
    		$arrRes[$i]['totalOrderAmount'] = number_format($totalIncVat - $totalDisc,2);
    
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getOrderSubTotalAmount($orderId){
    
    	$result = DB::table('jb_order_detail_tbl as a')->select('a.*')
    	->where('a.ORDER_ID', $orderId)
    	->get();
    
    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->TOTAL_AMOUNT;
    	}
    	return $sum;
    }
    public function getOrderTotalVatAmount($orderId){
    
    	$result = DB::table('jb_order_detail_tbl as a')->select('a.*')
    	->where('a.ORDER_ID', $orderId)
    	->get();
    
    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->VAT_AMOUNT;
    	}
    	return $sum;
    }
    public function getOrderTotalDiscountAmount($orderId){
    
    	$result = DB::table('jb_order_detail_tbl as a')->select('a.*')
    	->where('a.ORDER_ID', $orderId)
    	->get();
    
    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->DISCOUNT_AMOUNT;
    	}
    	return $sum;
    }
    public function getOrderGrandTotalAmountIncVat($orderId){
    
    	$result = DB::table('jb_order_detail_tbl as a')->select('a.*')
    	->where('a.ORDER_ID', $orderId)
    	->get();
    
    	$i=0;$sum=0;
    	foreach ($result as $row){
    		$sum = $sum + $row->TOTAL_AMOUNT_INC_VAT;
    	}
    	return $sum;
    }
    
    public function getAllSearchUserOrderData($flag='',$userId='',$customerName='',$orderStatus='',$shippmentStatus='',$startDate='',$endDate=''){
    
    	DB::enableQueryLog();
    	
    	if($flag == 1){
    		$where =array(['a.ORDER_STATUS','=','placed']);		// for placed order listing
    	}else{
    		$where =array(['a.ORDER_STATUS','!=','placed']);	// for shipped & delivered order listing
    	}
    	 
    	if($userId != ''){
    		$where = array_merge($where, array(['a.USER_ID','=',"$userId"]));
    	}
    	if($customerName != ''){
    		$where = array_merge($where, array(['fut.FIRST_NAME','like',"%$customerName%"]));
    		$where = array_merge($where, array(['fut.LAST_NAME','like',"%$customerName%"]));
    	}
    	if($orderStatus != ''){
    		$where = array_merge($where, array(['a.ORDER_STATUS','=',"$orderStatus"]));
    	}
    	if($shippmentStatus != ''){
    		$where = array_merge($where, array(['josd.STATUS','=',"$shippmentStatus"]));
    	}
    	 
    	if($startDate != '' && $endDate == ''){
    
    		$where = array_merge($where, array(['a.ORDER_DATE','>=',"$startDate"]));
    
    	}else if($startDate == '' && $endDate != ''){
    
    		$where = array_merge($where, array(['a.ORDER_DATE','<=',"$endDate"]));
    
    	}else if($startDate != '' && $endDate != ''){
    
    		$where = array_merge($where, array(['a.ORDER_DATE','>=',"$startDate"]));
    		$where = array_merge($where, array(['a.ORDER_DATE','<=',"$endDate"]));
    	}
    	 
    	//     	print_r('<pre>');
    	//     	print_r($where);
    	//     	exit();
    	 
    	 
    	$result = DB::table('jb_order_tbl as a')->select('a.*','jopt.PAYMENT_STATUS', 'fut.FIRST_NAME','fut.LAST_NAME')
    	->join ( 'jb_order_payment_tbl as jopt', 'a.ORDER_ID', '=', 'jopt.ORDER_ID' )
    	->join ( 'fnd_user_tbl as fut', 'a.USER_ID', '=', 'fut.USER_ID' )
    	->Join ( 'jb_order_shippment_detail_tbl as josd', 'a.ORDER_ID', '=', 'josd.ORDER_ID' )
    	->where($where)
    	->orderBy('a.ORDER_ID','desc')
    	->limit('100')
    	->get();
    
//     	$query = DB::getQueryLog(); dd($query);
    	
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['ORDER_NUM'] = 'Order#'.$row->ORDER_ID;
    		$arrRes[$i]['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['ORDER_DATE'] = $row->ORDER_DATE;
    		$arrRes[$i]['ORDER_STATUS'] = strtoupper($row->ORDER_STATUS);
    		$arrRes[$i]['PAYMENT_STATUS'] = strtoupper($row->PAYMENT_STATUS);
    		$arrRes[$i]['userFirstName'] = $row->FIRST_NAME;
    		$arrRes[$i]['userLastName'] = $row->LAST_NAME;
    		$arrRes[$i]['totalOrderLines'] = $this->getOrderLinesCount($row->ORDER_ID);
    		//     		$arrRes[$i]['totalOrderAmount'] = number_format($this->getOrderTotalAmount($row->ORDER_ID),2);
    
    		$totalIncVat = $this->getOrderGrandTotalAmountIncVat($row->ORDER_ID);
    		$totalDisc = $this->getOrderTotalDiscountAmount($row->ORDER_ID);
    
    		$arrRes[$i]['totalOrderAmount'] = number_format($totalIncVat - $totalDisc,2);
    
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function validateOrderById($orderId=''){
    
    	$result = DB::table('jb_order_tbl as a')->select('a.*')
    	->where('a.ORDER_ID', $orderId)
    	->orderBy('a.ORDER_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ORDER_NUM'] = 'Order#'.$row->ORDER_ID;
    		$arrRes['ORDER_ID'] = $row->ORDER_ID;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function checkOrderProductExistWrtProductId($productId){
    	DB::enableQueryLog();
    	
    	$result = DB::table('jb_order_tbl as a')->select('a.*')
    	->join ( 'jb_order_detail_tbl as jodt', 'a.ORDER_ID', '=', 'jodt.ORDER_ID' )
    	->where('jodt.PRODUCT_ID', $productId)
    	->get();
    	
//     	$query = DB::getQueryLog(); dd($query);
    	
    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}
    
    	return isset($check) ? $check : false;
    }
    public function checkOrderBundleExistWrtBundleId($bundleId){
    	DB::enableQueryLog();
    	 
    	$result = DB::table('jb_order_tbl as a')->select('a.*')
    	->join ( 'jb_order_detail_tbl as jodt', 'a.ORDER_ID', '=', 'jodt.ORDER_ID' )
    	->where('jodt.BUNDLE_ID', $bundleId)
    	->get();
    	 
    	//     	$query = DB::getQueryLog(); dd($query);
    	 
    	$i=0;
    	foreach ($result as $row){
    		$check = true;
    	}
    
    	return isset($check) ? $check : false;
    }
}
