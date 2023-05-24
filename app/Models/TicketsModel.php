<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class TicketsModel extends Model
{
    use HasFactory;
    
    
    public function getAllTicketsByUserId($userId){
    
    	$result = DB::table('jb_user_tickets_tbl as a')->select('a.*')
    	->where('a.USER_ID',$userId)
		->orderBy('a.UPDATED_ON', 'desc')
    	->orderBy('a.TICKET_ID','asc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['TICKET_ID'] = $row->TICKET_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TICKET_NUMBER'] = $row->TICKET_NUMBER;
    		$arrRes[$i]['TICKET_TYPE'] = $row->TICKET_TYPE;
    		$arrRes[$i]['DOCUMENT_NUMBER'] = $row->DOCUMENT_NUMBER;
    		$arrRes[$i]['USER_NAME'] = $row->USER_NAME;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['PHONE_NUMBER'] = $row->PHONE_NUMBER;
    		$arrRes[$i]['SUBJECT'] = $row->SUBJECT;
    		$arrRes[$i]['DESCRIPTION'] = $row->DESCRIPTION;
    		$arrRes[$i]['PRIORITY'] = strtoupper($row->PRIORITY);
    		$arrRes[$i]['STATUS'] = strtoupper($row->STATUS);
    		$arrRes[$i]['DATE'] = date ( 'd-M-Y', strtotime ( $row->DATE ) );
    		
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function getAllTicketsForAdmin(){
    
    	$result = DB::table('jb_user_tickets_tbl as a')->select('a.*')
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['TICKET_ID'] = $row->TICKET_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['TICKET_NUMBER'] = $row->TICKET_NUMBER;
    		$arrRes[$i]['TICKET_TYPE'] = $row->TICKET_TYPE;
    		$arrRes[$i]['DOCUMENT_NUMBER'] = $row->DOCUMENT_NUMBER;
    		$arrRes[$i]['USER_NAME'] = $row->USER_NAME;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['PHONE_NUMBER'] = $row->PHONE_NUMBER;
    		$arrRes[$i]['SUBJECT'] = $row->SUBJECT;
    		$arrRes[$i]['DESCRIPTION'] = $row->DESCRIPTION;
    		$arrRes[$i]['PRIORITY'] = strtoupper($row->PRIORITY);
    		$arrRes[$i]['STATUS'] = strtoupper($row->STATUS);
    		$arrRes[$i]['DATE'] = date ( 'd-M-Y', strtotime ( $row->DATE ) );
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificTicketDetail($ticketId){
    
    	$result = DB::table('jb_user_tickets_tbl as a')->select('a.*')
    	->where('a.TICKET_ID',$ticketId)
    	->orderBy('a.TICKET_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['TICKET_ID'] = $row->TICKET_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['TICKET_NUMBER'] = $row->TICKET_NUMBER;
    		$arrRes['TICKET_TYPE'] = $row->TICKET_TYPE;
    		$arrRes['DOCUMENT_NUMBER'] = $row->DOCUMENT_NUMBER;
    		$arrRes['USER_NAME'] = $row->USER_NAME;
    		$arrRes['EMAIL'] = $row->EMAIL;
    		$arrRes['PHONE_NUMBER'] = $row->PHONE_NUMBER;
    		$arrRes['SUBJECT'] = $row->SUBJECT;
    		$arrRes['DESCRIPTION'] = $row->DESCRIPTION;
    		$arrRes['PRIORITY'] = strtoupper($row->PRIORITY);
    		$arrRes['STATUS'] = strtoupper($row->STATUS);
    		$arrRes['DATE'] = date ( 'd-M-Y', strtotime ( $row->DATE ) );
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    
    
    public function getSpecificTicketReplies($ticketId){
    
    	$result = DB::table('jb_user_ticket_reply_tbl as a')->select('a.*')
    	->where('a.TICKET_ID',$ticketId)
		// ->orderBy('a.UPDATED_ON','desc')
    	->orderBy('a.TICKET_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['REPLY_ID'] = $row->REPLY_ID;
    		$arrRes[$i]['TICKET_ID'] = $row->TICKET_ID;
    		$arrRes[$i]['REPLY_DESCRIPTION'] = $row->REPLY_DESCRIPTION;
    		$arrRes[$i]['USER_TYPE'] = $row->USER_TYPE;
    		
    		$arrRes[$i]['DATE'] = date ( 'd-M-Y', strtotime ( $row->DATE ) );
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getTicketAttachments($id){
    
    	$result = DB::table('jb_user_tickets_attachment_tbl as a')->select('a.*')
    	->where('a.TICKET_ID', $id)
    	->orderBy('a.TICKET_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['ID'] = $row->ATTACHMENT_ID;
    		$arrRes[$i]['userId'] = $row->USER_ID;
    		$arrRes[$i]['ticketId'] = $row->TICKET_ID;
    		$arrRes[$i]['code'] = $row->SOURCE_CODE;
    		$arrRes[$i]['fileType'] = $row->FILE_TYPE;
    		$arrRes[$i]['fileName'] = $row->FILE_NAME;
    		$arrRes[$i]['fullName'] = $row->FULL_NAME;
    		$arrRes[$i]['path'] = $row->PATH;
    		$arrRes[$i]['downPath'] = $row->DOWN_PATH;
    		$arrRes[$i]['primFlag'] = $row->PRIMARY_FLAG;
    		$arrRes[$i]['secFlag'] = $row->SECONDARY_FLAG;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificTicketAttachment($id){
    
    	$result = DB::table('jb_user_tickets_attachment_tbl as a')->select('a.*')
    	->where('a.ATTACHMENT_ID', $id)
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['ID'] = $row->ATTACHMENT_ID;
    		$arrRes['userId'] = $row->USER_ID;
    		$arrRes['ticketId'] = $row->TICKET_ID;
    		$arrRes['code'] = $row->SOURCE_CODE;
    		$arrRes['fileType'] = $row->FILE_TYPE;
    		$arrRes['fileName'] = $row->FILE_NAME;
    		$arrRes['fullName'] = $row->FULL_NAME;
    		$arrRes['path'] = $row->PATH;
    		$arrRes['downPath'] = $row->DOWN_PATH;
    		$arrRes['primFlag'] = $row->PRIMARY_FLAG;
    		$arrRes['secFlag'] = $row->SECONDARY_FLAG;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    
}
