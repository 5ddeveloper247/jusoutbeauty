<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class OrderShippingTrackingModel extends Model
{
    use HasFactory;
    
    public function getAllTrackingByOrder($orderId){
    
    	$result = DB::table('jb_order_shippment_tracking_tbl as a')->select('a.*')
    	->where('a.ORDER_ID', $orderId)
    	->orderBy('a.TRACKING_ID','asc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $i+1;
    		$arrRes[$i]['TRACKING_ID'] = $row->TRACKING_ID;
    		$arrRes[$i]['ORDER_ID'] = $row->ORDER_ID;
    		$arrRes[$i]['STATUS'] = strtoupper($row->STATUS);
    		$arrRes[$i]['DATE'] = date('d M,Y H:i A', strtotime($row->DATE));
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    
    
}
