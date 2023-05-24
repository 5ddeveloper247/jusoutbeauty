<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class EmailForwardModel extends Model
{
    use HasFactory;
    
    
    public function getAllEmailsData(){
    	 
    	
    	$result = DB::table('sys_email_tbl as a')->select('a.*')
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    	
    	 
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->EMAIL_ID;
    		$arrRes[$i]['EMAIL_ID'] = $row->EMAIL_ID;
    		$arrRes[$i]['FROM_USER_ID'] = $row->FROM_USER_ID;
    		$arrRes[$i]['TO_USER_ID'] = $row->TO_USER_ID;
    		$arrRes[$i]['FROM_USER_EMAIL'] = $row->FROM_USER_EMAIL;
    		$arrRes[$i]['TO_USER_EMAIL'] = $row->TO_USER_EMAIL;
    		$arrRes[$i]['TITLE'] = $row->TITLE;
    		$arrRes[$i]['SUBJECT'] = $row->SUBJECT;
    		$arrRes[$i]['MESSAGE'] = $row->MESSAGE;
    		$arrRes[$i]['SENT_EMAIL'] = $row->SENT_EMAIL;
    		$arrRes[$i]['EMAIL_STATUS'] = strtoupper($row->EMAIL_STATUS);
    		$arrRes[$i]['MODULE_CODE'] = $row->MODULE_CODE;
    		
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['CREATED_ON'] = date('d-m-Y H:i a', strtotime($row->CREATED_ON));
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    public function sendEmail($page_title,$email_html_body,$email_details){
    
    	
    	$to_id = $email_details['to_id'] != '' ? $email_details['to_id'] : '';
    	$to_email = $email_details['to_email'] != '' ? $email_details['to_email'] : '';
    	$from_id = $email_details['from_id'] != '' ? $email_details['from_id'] : '';
    	$from_email = $email_details['from_email'] != '' ? $email_details['from_email'] : '';
    	$subject = $email_details['subject'] != '' ? $email_details['subject'] : '';
    	$message = $email_details['message'] != '' ? $email_details['message'] : '';
    	$logo = $email_details['logo'] != '' ? $email_details['logo'] : url('assets-web').'/images/logo-black.png';
    	$module_code = $email_details['module_code'] != '' ? $email_details['module_code'] : '';
    	
    	$email_html =
    	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
					<title>Lead</title>
					<style type="text/css">
				        body {
				            font-family: Arial, Verdana, Helvetica, sans-serif;
				            font-size: 16px;
				        }
					</style>
				</head>
				<body>
					
    				<div style="background-color:rgb(244,244,244);margin:0px!important;padding:0px!important">
          				<table border="0" cellpadding="0" cellspacing="0" width="100%">
   
        					<tbody>
          						<tr>
						            <td bgcolor="#FFA73B" align="center" style="background:#05568c">
						                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
						                    <tbody><tr>
						                        <td align="center" valign="top" style="padding:40px 10px 40px 10px"> </td>
						                    </tr>
						                </tbody></table>
						            </td>
        						</tr>
        						<tr>
						            <td bgcolor="#FFA73B" align="center" style="padding:0px 10px 0px 10px;background:#05568c">
						                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
						                    <tbody><tr>
						                        <td style="background: transparent;color: white;" align="center" valign="top">
						                            <h1 style="font-size:48px;font-weight:400;margin:2">'.$page_title.'</h1>
						                            <img src="'.$logo.'" width="200" height="190" style="display:block;border:0px;" class="CToWUd" jslog="138226; u014N:xr6bB; 53:W2ZhbHNlXQ..">
						                        </td>
						                    </tr>
						                </tbody></table>
						            </td>
        						</tr>
    			
        						'.$email_html_body.'
        		
        						<tr>
						            <td bgcolor="#f4f4f4" align="center" style="padding:30px 10px 0px 10px">
						                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px">
						                    <tbody>
							                	<tr>
						                        	<td bgcolor="#05568c" align="center">
						                            	<h2 style="font-size:20px;font-weight:400;color:white;margin:0;display:none">Need more help?</h2>
						                           	 	<p style="margin:0"><a style="color:white">admin@jusoutbeauty.com</a></p>
						                        	</td>
						                    	</tr>
						                	</tbody>
							          	</table>
						            </td>
        						</tr>
						        
    						</tbody>
						</table>
   
					</div>
    				
  
				</body>
			</html>';
    	
    	//email
    	$url = 'https://api.sendgrid.com/';
    	$sendgrid_apikey = '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';
    	$params = array(
    			'to'        => $to_email,
    			'from'      => $from_email,
    			'fromname'  => $from_email,
    			'subject'   => $subject,
    			'text'      => "",
    			'html'      => $email_html,
    			// 'files['.$file_name.']'      => $file,
    	);
    	$request =  $url.'api/mail.send.json';
    	// Generate curl request
    	$session = curl_init($request);
    	// Tell PHP not to use SSLv3 (instead opting for TLS)
    	curl_setopt($session, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1_2');
    	curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
    	// Tell curl to use HTTP POST
    	curl_setopt ($session, CURLOPT_POST, true);
    	// Tell curl that this is the body of the POST
    	curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    	// Tell curl not to return headers, but do return the response
    	curl_setopt($session, CURLOPT_HEADER, false);
    	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    	// obtain response
    	$response = curl_exec($session);
    	curl_close($session);
    	json_decode($response);
    	
    	$this->saveEmail($page_title,$email_html,$email_details);
    	
    	return true;
    }
    
    public function saveEmail($page_title,$email_html,$email_details){
    	
    	$to_id = $email_details['to_id'] != '' ? $email_details['to_id'] : '';
    	$to_email = $email_details['to_email'] != '' ? $email_details['to_email'] : '';
    	$from_id = $email_details['from_id'] != '' ? $email_details['from_id'] : '';
    	$from_email = $email_details['from_email'] != '' ? $email_details['from_email'] : '';
    	$subject = $email_details['subject'] != '' ? $email_details['subject'] : '';
    	$message = $email_details['message'] != '' ? $email_details['message'] : '';
    	$module_code = $email_details['module_code'] != '' ? $email_details['module_code'] : '';
    	 
    	$result = DB::table ( 'sys_email_tbl' )->insertGetId (
    			array ( 'FROM_USER_ID' => $from_id,
    					'TO_USER_ID' => $to_id,
    					'FROM_USER_EMAIL' => $from_email,
    					'TO_USER_EMAIL' => $to_email,
    					'TITLE' => $page_title,
    					'SUBJECT' => $subject,
    					'CC' => '',
    					'MESSAGE' => $message,
    					'SENT_EMAIL' => $email_html,
    					'EMAIL_STATUS' => 'sent',
    					'MODULE_CODE' => $module_code,
    					
    					'CREATED_BY' => session('userId'),
    					'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
    					'UPDATED_BY' => session('userId'),
    					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
    			)
    			);
    	
    	return true;
    	 
    }
    
    
    
}
