<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserModel extends Model
{
    use HasFactory;
    
	public function getspecificUserByEmail($email){
		 
		$result = DB::table('fnd_user_tbl')->select('*')->where('EMAIL',$email)->get();
		 
		$i=0;
		foreach ($result as $row){
			$arrRes[$i]['USER_ID'] = $row->USER_ID;
			$arrRes[$i]['EMAIL'] = $row->EMAIL;
			$arrRes[$i]['PHONE_NUMBER'] = $row->PHONE_NUMBER;
			$i++;
		}
	
		return isset($arrRes) ? $arrRes : null;
	}

	public function getspecificUserByPhone($phone){
		$result = DB::table('fnd_user_tbl')->select('*')->where('PHONE_NUMBER',$phone)->get();
		$i=0;
		foreach ($result as $row){
			$arrRes[$i]['PHONE_NUMBER'] = $row->PHONE_NUMBER;
			$i++;
		}
		return isset($arrRes) ? $arrRes : null;
	}
	
	public function getSpecificUserDetailsById($userId){
			
		$result = DB::table('fnd_user_tbl')->select('*')->where('USER_ID',$userId)->get();
			
		$i=0;
		foreach ($result as $row){
			$arrRes['ID'] = $row->USER_ID;
			$arrRes['A_1'] = $row->FIRST_NAME;
			$arrRes['A_2'] = $row->LAST_NAME;
			$arrRes['A_3'] = $row->EMAIL;
			$arrRes['A_4'] = $row->PHONE_NUMBER;
			$i++;
		}
	
		return isset($arrRes) ? $arrRes : null;
	}
	
	public function getspecificUserByEmail1($email,$userId = ''){
			
		if($userId != ''){
			$result = DB::table('fnd_user_tbl')->select('*')->where('EMAIL',$email)->whereNotIn("USER_ID",[$userId])->get();
		}else{
			$result = DB::table('fnd_user_tbl')->select('*')->where('EMAIL',$email)->get();
		}
		
			
		$i=0;
		foreach ($result as $row){
			$arrRes[$i]['USER_ID'] = $row->USER_ID;
			$arrRes[$i]['EMAIL'] = $row->EMAIL;
			$arrRes[$i]['PHONE_NUMBER'] = $row->PHONE_NUMBER;
			$i++;
		}
	
		return isset($arrRes) ? $arrRes : null;
	}
	public function getspecificUserByPhone1($phone, $userId=''){
		
		if($userId != ''){
			$result = DB::table('fnd_user_tbl')->select('*')->where('PHONE_NUMBER',$phone)->whereNotIn("USER_ID",[$userId])->get();
		}else{
			$result = DB::table('fnd_user_tbl')->select('*')->where('PHONE_NUMBER',$phone)->get();
		}
		
		$i=0;
		foreach ($result as $row){
			$arrRes[$i]['USER_ID'] = $row->USER_ID;
			$arrRes[$i]['EMAIL'] = $row->EMAIL;
			$arrRes[$i]['PHONE_NUMBER'] = $row->PHONE_NUMBER;
			$i++;
		}
		return isset($arrRes) ? $arrRes : null;
	}
	public function getspecificUserPasswordByUserId($userId){
	
		$result = DB::table('fnd_user_tbl')->select('*')->where("USER_ID", $userId)->get();
		
		$i=0;
		foreach ($result as $row){
			$arrRes['USER_ID'] = $row->USER_ID;
			$arrRes['EMAIL'] = $row->EMAIL;
			$arrRes['PHONE_NUMBER'] = $row->PHONE_NUMBER;
			$arrRes['ENCRYPTED_PASSWORD'] = $row->ENCRYPTED_PASSWORD;
			$i++;
		}
		return isset($arrRes) ? $arrRes : null;
	}
	
	public function getAllWebsiteUserData(){
	
		$result = DB::table('fnd_user_tbl')->select('*')
		->where('USER_TYPE', 'user')
		->orderBy('UPDATED_ON','desc')
		->get();
		
		$i=0;
		foreach ($result as $row){
			$arrRes[$i]['seqNo'] = $i+1;
			$arrRes[$i]['userId'] = $row->USER_ID;
			$arrRes[$i]['email'] = $row->EMAIL;
			$arrRes[$i]['phoneNumber'] = $row->PHONE_NUMBER;
			$arrRes[$i]['username'] = $row->USER_NAME;
			$arrRes[$i]['userType'] = $row->USER_TYPE;
			$arrRes[$i]['firstName'] = $row->FIRST_NAME;
			$arrRes[$i]['lastName'] = $row->LAST_NAME;
			$arrRes[$i]['description'] = $row->DESCRIPTION;
			$arrRes[$i]['status'] = $row->USER_STATUS;
			
			$arrRes[$i]['date'] = date('d M,Y H:i A', strtotime($row->START_DATE));
			$i++;
		}

		return isset($arrRes) ? $arrRes : null;
	}

	
	public function getSpecificUserDetail($userId){
	
		$result = DB::table('fnd_user_tbl')->select('*')
		->where('USER_ID', $userId)
		->get();
	
		$i=0;
		foreach ($result as $row){
			$arrRes['seqNo'] = $i+1;
			$arrRes['userId'] = $row->USER_ID;
			$arrRes['email'] = $row->EMAIL;
			$arrRes['phoneNumber'] = $row->PHONE_NUMBER;
			$arrRes['username'] = $row->USER_NAME;
			$arrRes['userType'] = $row->USER_TYPE;
			$arrRes['firstName'] = $row->FIRST_NAME;
			$arrRes['lastName'] = $row->LAST_NAME;
			$arrRes['description'] = $row->DESCRIPTION;
			$arrRes['status'] = $row->USER_STATUS;
			$arrRes['status1'] = strtoupper($row->USER_STATUS);
			$arrRes['date'] = date('d M,Y H:i A', strtotime($row->START_DATE));
			$i++;
		}
		return isset($arrRes) ? $arrRes : null;
	}

	public function getUserData(){
		
	}

}

