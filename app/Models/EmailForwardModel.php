<?php

namespace App\Models;

use Log;
use DateTime;
use Illuminate\View\View;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Mime\Part\HtmlPart;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailForwardModel extends Mailable
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
    public function sendEmail($email_details){
        $email_html = '';
        try {
            $email_html = view('admin.emails.emailTemplate', $email_details)->render();

            Mail::send('admin.emails.emailTemplate', $email_details, function ($message) use ($email_details) {
               if (array_key_exists('from_email', $email_details)) {
                   $message->from($email_details['from_email'], 'Jusoutbeauty');
               } else {
                    $message->from('noreply@jusoutbeauty.com', 'Jusoutbeauty');
               }
                if (array_key_exists('subject', $email_details)) {
                    $message->subject($email_details['subject']);
                } else {
                    $message->subject("Welcome");
                }
                $message->to($email_details['to_email']);
            });

            $this->saveEmail($email_details['pageTitle'],$email_html,$email_details);
            return true;

        }
        catch (\Throwable $e) {
            return false;
        }
    	//email
    	// $url = 'https://api.sendgrid.com/';
    	// $sendgrid_apikey = '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';
    	// $params = array(
    	// 		'to'        => $to_email,
    	// 		'from'      => $from_email,
    	// 		'fromname'  => $from_email,
    	// 		'subject'   => $subject,
    	// 		'text'      => "",
    	// 		'html'      => $email_html,
    	// 		// 'files['.$file_name.']'      => $file,
    	// );
    	// $request =  $url.'api/mail.send.json';
    	// // Generate curl request
    	// $session = curl_init($request);
    	// // Tell PHP not to use SSLv3 (instead opting for TLS)
    	// curl_setopt($session, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1_2');
    	// curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
    	// // Tell curl to use HTTP POST
    	// curl_setopt ($session, CURLOPT_POST, true);
    	// // Tell curl that this is the body of the POST
    	// curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
    	// // Tell curl not to return headers, but do return the response
    	// curl_setopt($session, CURLOPT_HEADER, false);
    	// curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    	// // obtain response
    	// $response = curl_exec($session);
    	// curl_close($session);
    	// json_decode($response);
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
