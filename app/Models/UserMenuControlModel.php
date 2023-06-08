<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Psr7\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use LDAP\Result;
use PhpParser\Node\Stmt\Return_;

class UserMenuControlModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllNavLinks(){

       $result = DB :: table('fnd_user_menu_tbl')
                ->select('MENU_NAME','MENU_ID')
                ->get(); 

        return isset($result) ? $result :null;
    }

    public function getSpecificAdminStatus($recordId){

        $user_id = $recordId;
    
        $result = DB::table('fnd_user_tbl')
                  ->where('USER_ID','=', $user_id)
                  ->first();
    
        return isset( $result) ?  $result :null;
    }

    public function saveAdminUser($details){

        $updateduserId = $details['updateduserId'];

		//Updating the Record
		if($updateduserId != null){

			$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $updateduserId ) ->update (
				array (  'FIRST_NAME' => $details['user']['FirstName'] ,
                         'LAST_NAME' => $details['user']['LastName'] ,
                         'USER_ROLE' => $details['user']['UserRole'],
                         'PHONE_NUMBER' => $details['user']['PhoneNumber'],
                         'EMAIL' => $details['user']['EmailAddress'],
                         'ENCRYPTED_PASSWORD' => $details['user']['Password'],
                         'USER_ROLE'=> $details['user']['UserRole']
			           ));

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Admin User Updated Successfully';
			$arrRes ['id'] = $updateduserId;
			return $arrRes ;
			die();

		}else{

        $arrRes = array();
        $UserName = $details['user']['FirstName'] . $details['user']['LastName'] . rand(10,10000) ;
        $enable = '';

        if($details['user']['Enable'] == true) {
            $enable = 'active';
        }else{
            $enable = 'inactive';
        }

        $record = array ( 
            'FIRST_NAME' => $details['user']['FirstName'] ,
            'LAST_NAME' => $details['user']['LastName'] ,
            'USER_ROLE' => $details['user']['UserRole'],
            'PHONE_NUMBER' => $details['user']['PhoneNumber'],
            'EMAIL' => $details['user']['EmailAddress'],
            'USER_NAME' => $UserName,
            'ENCRYPTED_PASSWORD' => $details['user']['Password'],
            'USER_TYPE' => 'admin',
            'USER_SUBTYPE' => 'subadmin',
            'USER_ROLE'=> $details['user']['UserRole'],
            'USER_STATUS' => $enable ,
            'CREATED_ON' => date ( 'Y-m-d H:i:s' )
        );

		//Inserting the Record 
	    $result = DB::table ( 'fnd_user_tbl' )->insertGetId( $record );
        $arrRes ['id'] = $result;
		$arrRes['done'] = true;
		$arrRes['msg'] = 'Admin User Created Successfully';

		return isset($arrRes) ? $arrRes :null;
       }
    }

    public function checkEmailAddressExists($emailaddress,$userid = ''){

        if($userid == '') {
            
            $result = DB :: table('fnd_user_tbl')
                     ->where('EMAIL',$emailaddress)
                     ->get();

        }else {

            $result = DB :: table('fnd_user_tbl')
                    ->where('EMAIL',$emailaddress)
                    ->whereNot('USER_ID',$userid)
                    ->get();
        }
        
        return count($result) == 0 ? true : false;

    }

    public function checkPhoneNumberExists($phoneNumber,$userid = ''){
        
        if($userid == '') {

            $result = DB :: table('fnd_user_tbl')
                     ->where('PHONE_NUMBER',$phoneNumber)
                     ->get();

        }else {

            $result = DB :: table('fnd_user_tbl')
                    ->where('PHONE_NUMBER',$phoneNumber)
                    ->whereNot('USER_ID',$userid)
                    ->get();

        }

        return count($result) == 0 ? true : false;
    }

    public function deleteSpecificAdmin($recordId){
        
		// $result_fnd_user_tbl_tbl = DB::table('fnd_user_tbl as a')->where('a.USER_ID', $recordId )->get();
		
		// if(sizeof($result_fnd_user_tbl_tbl) != null){
			$result = DB::table('fnd_user_tbl')->where('USER_ID', $recordId )->delete();
			return isset( $result ) ? $result :null;
		// }else{
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Admin failed to delete';
	
		// 	return isset( $arrRes )  ? $arrRes :null;
		// }
    }
   
    public function getAdminUserDetails($id){

        $user_id = $id;

        $result = DB::table('fnd_user_tbl')
                             ->where('USER_ID','=', $user_id)
                             ->first();

        return isset( $result ) ?  $result :null;
    }

    public function deleteControlledUser($userid){

        $result = DB::table('fnd_user_menu_control_tbl')
                  ->where('USER_ID','=',$userid)
                  ->delete();
        
       return isset( $result) ? $result : null; 
    }

    public function grantUserControl($optionsSelected){
  
        $result = DB::table('fnd_user_menu_tbl as a')
                  ->whereIn('MENU_ID',$optionsSelected)
                  ->select('a.*')
                  ->get();
    

        return isset($result) ? $result : null;

    }

    public function getAllMenuWrtAdmin(){

        $result = DB::table('fnd_user_menu_tbl')
                  ->select('MENU_ID','MENU_NAME','MENU_DESCRIPTION','MENU_TYPE','SYSTEM_CALL','MENU_ICON')
                  ->get();

        for($i=0 ;$i<count($result);$i++){
                $arrRes[$i]['MENU_NAME'] = $result[$i]->MENU_NAME;
                $arrRes[$i]['MENU_DESCRIPTION'] = $result[$i]->MENU_DESCRIPTION;
                $arrRes[$i]['MENU_TYPE'] = $result[$i]->MENU_TYPE;
                $arrRes[$i]['SYSTEM_CALL'] = $result[$i]->SYSTEM_CALL;
                $arrRes[$i]['MENU_ICON'] = $result[$i]->MENU_ICON;
                $arrRes[$i]['SUB_MENU'] = $this->getAllSubMenuWrtAdmin($result[$i]->MENU_ID);
        }

        return isset($arrRes) ? $arrRes : '';
    }

    public function getAllSubMenuWrtAdmin($menu_id){
        
        $result = DB::table('fnd_user_submenu_tbl')
                  ->where('MENU_ID',$menu_id)
                  ->select('SUB_MENU_ID','MENU_NAME','MENU_DESCRIPTION','SYSTEM_CALL','MENU_ICON')
                  ->get();
        
        for($i=0 ;$i<count($result);$i++){
                $arrRes[$i]['SUB_MENU_ID'] = $result[$i]->SUB_MENU_ID;
                $arrRes[$i]['MENU_NAME'] = $result[$i]->MENU_NAME;
                $arrRes[$i]['MENU_DESCRIPTION'] = $result[$i]->MENU_DESCRIPTION;
                $arrRes[$i]['SYSTEM_CALL'] = $result[$i]->SYSTEM_CALL;
                $arrRes[$i]['MENU_ICON'] = $result[$i]->MENU_ICON;
        }
        
        return isset($arrRes) ? $arrRes : '';

    }

    public function getAdminControlOptions($id){
        $result = DB::table('fnd_user_menu_control_tbl')
                  ->where('USER_ID',$id)
                  ->select('MENU_ID','MENU_NAME')
                  ->get();

        for($i=0 ;$i<count($result );$i++){
            $arrRes[$i]['MENU_ID'] = $result[$i]->MENU_ID;
            $arrRes[$i]['MENU_NAME'] = $result[$i]->MENU_NAME;
        }

        return isset($arrRes) ? $arrRes : '';
    }

    public function getMenuLinksWRTUserId($id){

        $result = DB::table('fnd_user_menu_control_tbl')
        ->where('USER_ID',$id)
        ->select('MENU_ID','MENU_NAME','MENU_DESCRIPTION','MENU_TYPE','SYSTEM_CALL','MENU_ICON')
        ->get();

        for($i=0 ;$i<count($result);$i++){
            $arrRes[$i]['MENU_NAME'] = $result[$i]->MENU_NAME;
            $arrRes[$i]['MENU_DESCRIPTION'] = $result[$i]->MENU_DESCRIPTION;
            $arrRes[$i]['MENU_TYPE'] = $result[$i]->MENU_TYPE;
            $arrRes[$i]['SYSTEM_CALL'] = $result[$i]->SYSTEM_CALL;
            $arrRes[$i]['MENU_ICON'] = $result[$i]->MENU_ICON;
            $arrRes[$i]['SUB_MENU'] = $this->getAllSubMenuWrtAdmin($result[$i]->MENU_ID);
        }

        return isset($arrRes) ? $arrRes : '';
    }

    
   
}