<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class OrderShipmentModel extends Model
{
    use HasFactory;
    
	public function getAllSpecificOrderShipmentData($orderId){
    	
    	$result = DB::table('jb_order_shippment_detail_tbl as a')->select('a.*')
    	->where('a.ORDER_ID',$orderId)
    	->orderBy('a.ORDER_ID','desc')
    	->get();
    	
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['SHIPPING_ID'] = $row->SHIPPING_ID;
    		$arrRes['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes['SHIPPING_COMPANY_NAME'] = $row->SHIPPING_COMPANY_NAME;
    		$arrRes['TRACKING_NUMBER'] = $row->TRACKING_NUMBER;
    		$arrRes['EXPECTED_DELIVERY_DATE'] = date('d-M-Y', strtotime($row->EXPECTED_DELIVERY_DATE));
    		$arrRes['STATUS'] = $row->STATUS;
    		$arrRes['DATE'] = date('d-M-Y', strtotime($row->DATE));
    	
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
}
