<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use App\Models\EmailForwardModel;
use App\Models\EmailConfigModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
	public function adminlogin(Request $r){

		$r->validate([
				'email'=>'required|email',
				'password'=>'required'

		]);

		$email = $r->input('email');
		$password = $r->input('password');

		$result = DB::table('fnd_user_tbl as a')->select('a.*')
						->where([
								['EMAIL', "$email"],
								['USER_TYPE', "admin"],
							    ])
						->orderBy('USER_ID','desc')
						->limit('1')
						->first();

		if(isset($result->EMAIL) && $email == $result->EMAIL){

			if($password == $result->ENCRYPTED_PASSWORD){

                if($result->USER_STATUS == 'active'){

                    $r->session()->put('userId', $result->USER_ID);
                    $r->session()->put('userName', $result->USER_NAME);
                    $r->session()->put('firstName', $result->FIRST_NAME);
                    $r->session()->put('lastName', $result->LAST_NAME);
                    $r->session()->put('userType', $result->USER_TYPE);
                    $r->session()->put('email', $result->EMAIL);
                    $r->session()->put('userSubType', $result->USER_SUBTYPE);

                    // $r->session()->put([
                    //     'userId' => $result->USER_ID,
                    //     'userName'=> $result->USER_NAME,
                    //     'firstName'=> $result->FIRST_NAME,
                    //     'lastName'=> $result->LAST_NAME,
                    //     'userType'=> $result->USER_TYPE,
                    //     'email'=> $result->EMAIL,
                    //     'userSubType'=> $result->USER_SUBTYPE
                    // ]);

                    return redirect('dashboard');
                }else{
                    $r->session()->flash('error', 'Account Inative! Contact Administrator');
				    return redirect('admin-login');
                }



			}else{

				$r->session()->flash('error', 'Please enter valid Password');
				return redirect('admin-login');
			}
		}else{
			$r->session()->flash('error', 'Please enter valid Email Address');
			return redirect('admin-login');
		}
	}

	public function userResetPass(Request $request){
		$EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;

		$detail = $_REQUEST['details'];
		$data = $detail['res'];

		$result = DB::table('fnd_user_tbl as a')->select('a.*')
		->where([
				['EMAIL', $data['R_3']],
				])
				->limit('1')
				->first();

		if(!$result){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Email Address Not Registered In the System';
			echo json_encode ( $arrRes );
			die ();
		}

		$otp_random_number = rand(100000, 999999);
		$user_id_otp = $result->USER_ID;

		$d=array();
		$d['ONE_TIME_PASSWORD'] = $otp_random_number;

		$qry = DB::table('fnd_user_tbl')->where('EMAIL',$result->EMAIL)->update($d);

		// To send HTML mail, the Content-type header must be set

		$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('OTP');

		$htmlbody=	'<tr>
						<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
							<p>Hello!!!  '.$result->FIRST_NAME .' '. $result->LAST_NAME.'</p>
							<p>Your one-time Password is: '.$otp_random_number.'.</p>
							'.$emailConfigDetails['message'].'
						</td>
	        		</tr>';


		$email_details['to_id'] = '';
		$email_details['to_email'] = $result->EMAIL;
		$email_details['from_id'] = 1;
		$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
		$email_details['subject'] = $emailConfigDetails['subject'];
		$email_details['message'] = "";
		$email_details['logo'] = $emailConfigDetails['logo'];
		$email_details['module_code'] = "RESET_PASS_OTP";
        $email_details['template'] = 'admin.emails.emailTemplate';
        $email_details['htmlbody'] = $htmlbody;
        $email_details['pageTitle'] = $emailConfigDetails['title'];

		$check = $EmailForwardModel->sendEmail($email_details);
        if($check === 'true' || $check === true){
            $arrRes ['done'] = true;
            $arrRes ['user_id_otp'] = $user_id_otp;
            $arrRes ['msg'] = 'OTP Sent Successfully. Please check your E-mail!';
            echo json_encode ( $arrRes );
        }else{
            $arrRes ['done'] = false;
            $arrRes ['msg'] = 'Something went wrong please try again later!!!';
            echo json_encode ( $arrRes );
        }

        // $this->sendMail($data, 'admin.emails.emailTemplate');

		// $arrRes ['done'] = true;
		// $arrRes ['user_id_otp'] = $user_id_otp;
		// $arrRes ['msg'] = 'OTP Sent Successfully. Please check your E-mail!';
		// echo json_encode ( $arrRes );

	}

	public function UserValidatePass(Request $request){

		$detail = $_REQUEST['details'];
		$data = $detail['vpass'];

		$user_id = $data['C_1'];
		$pass = $data['C_2'];
		$c_pass = $data['C_3'];

		$result = DB::table('fnd_user_tbl as a')->select('a.*')
		->where([
				['USER_ID', "$user_id"],
				])
				->orderBy('USER_ID','desc')
				->limit('1')
				->first();

		$d=array();
		$d['ONE_TIME_PASSWORD'] = NULL;
		$d['ENCRYPTED_PASSWORD'] = $pass;

		$qry = DB::table('fnd_user_tbl')->where('USER_ID',$result->USER_ID)->update($d);

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Password changed Successfully!';
		echo json_encode ( $arrRes );

	}
	public function userValidateOTP(Request $request){

		$detail = $_REQUEST['details'];

		$data = $detail['otp'];

		$otp_1 = $data['V_1'];
		$otp_2 = $data['V_2'];
		$otp_3 = $data['V_3'];
		$otp_4 = $data['V_4'];
		$otp_5 = $data['V_5'];
		$otp_6 = $data['V_6'];
		$user_id = $data['V_7'];

		$combine_otp = $data['V_1'].$data['V_2'].$data['V_3'].$data['V_4'].$data['V_5'].$data['V_6'];

		$result = DB::table('fnd_user_tbl as a')->select('a.*')
		->where([
				['USER_ID', "$user_id"],
				])
				->orderBy('USER_ID','desc')
				->limit('1')
				->first();


		if($result->ONE_TIME_PASSWORD != $combine_otp){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Enter Valid OTP!';
			echo json_encode ( $arrRes );
			die ();
		}

		$user_id_otp = $result->USER_ID;

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'OTP Matched!';
		$arrRes ['user_id_otp'] = $user_id_otp;

		echo json_encode ( $arrRes );
		die ();

	}

	public function userlogin(Request $r){

		$r->validate([
				'email'=>'required|email',
				'password'=>'required'

		]);

		$email = $r->input('email');
		$password = $r->input('password');

		$result = DB::table('fnd_user_tbl as a')->select('a.*')
		->where([
				['EMAIL', "$email"],
				['USER_TYPE', "user"],
				])
				->orderBy('USER_ID','desc')
				->limit('1')
				->first();

		if(isset($result->EMAIL) && $email == $result->EMAIL){

			if($result->USER_STATUS == 'active'){
				if($password == $result->ENCRYPTED_PASSWORD){
                    $r->session()->put([
                        'userId' => $result->USER_ID,
                        'userName'=> $result->USER_NAME,
                        'firstName'=> $result->FIRST_NAME,
                        'lastName'=> $result->LAST_NAME,
                        'userType'=> $result->USER_TYPE,
                        'email'=> $result->EMAIL,
                        'userSubType'=> $result->USER_SUBTYPE

                    ]);
                    // Set the logged-in status cookie
                    $userKey = Str::random(40);

                    DB::table('fnd_user_tbl')
                    ->where('EMAIL', $email)
                    ->update([
                        'LOGGED_IN_STATUS' => $userKey,
                    ]);
                    cookie()->queue(cookie()->make('loggedIn', $userKey,30 * 24 * 60));
                    cookie()->queue(cookie()->make('test', $userKey,30 * 24 * 60));
					return redirect('/');

				}else{

					$r->session()->flash('error', 'Please enter valid Password');
					return redirect('user-login');
				}
			}else{
				$r->session()->flash('error', 'User is not active, kindly contact admin. Thanks');
				return redirect('user-login');
			}

		}else{
				$r->session()->flash('error', 'Please enter valid Email Address');
				return redirect('user-login');
		}
	}
	// DDDDD
	public function UserReg1(Request $r){
		$EmailForwardModel = new EmailForwardModel();
		$EmailConfigModel = new EmailConfigModel;
		$UserModel=new UserModel();
				$detail=$_REQUEST['details'];
				$data=$detail['reg'];
		if (isset ( $data ) && ! empty ( $data )) {
			if ($data['A_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'First Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['A_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Last Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['A_3'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Email is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['A_3'] != "") {
    			if (!filter_var( $data ['A_3'], FILTER_VALIDATE_EMAIL)) {
    				$arrRes['done'] = false;
    				$arrRes['check'] = '';
    				$arrRes['msg'] = 'Please enter valid Email Address';
    				echo json_encode ( $arrRes );
    				die ();
    			}
    		}

    		$userdetails = $UserModel->getspecificUserByEmail($data ['A_3']);
    		if(!empty($userdetails)){
    			$arrRes['done'] = false;
    			$arrRes['check'] = '';
    			$arrRes['msg'] = 'Email Address already registered';
    			echo json_encode ( $arrRes );
    			die ();
    		}
			if ($data['A_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Phone Number is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			$userphone = $UserModel->getspecificUserByPhone($data ['A_4']);
    		if(!empty($userphone)){
    			$arrRes['done'] = false;
    			$arrRes['check'] = '';
    			$arrRes['msg'] = 'Phone Number already registered';
    			echo json_encode ( $arrRes );
    			die ();
    		}
			if ($data['A_5'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['A_6'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['A_5'] != $data['A_6'] ) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Confirm Password is incorrect.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['A_7'] =='0' ) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'first agree to terms and conditions';
				echo json_encode ( $arrRes );
				die ();
			}
				$username=$data['A_1']."_".$data['A_2'].rand(100,999);
				$d=array();
				$d['EMAIL']=$data['A_3'];
				$d['PHONE_NUMBER']=$data['A_4'];
				$d['USER_NAME']=$username;
				$d['FIRST_NAME']=$data['A_1'];
				$d['LAST_NAME']=$data['A_2'];
				$d['ENCRYPTED_PASSWORD']=$data['A_5'];
				$d['USER_STATUS']='active';
				$d['USER_TYPE']='user';
				// $d['DESCRIPTION']=$data['A_7'];
				$lastId=DB::table('fnd_user_tbl')->insertGetId($d);

				$emailConfigDetails = $EmailConfigModel->getSpecificEmailConfigByCode('REGISTER');
				$email = $data['A_3'];

				$htmlbody=	'<tr>
								<td bgcolor="#f4f4f4" style="padding:0px 10px 0px 10px">
									<p>Hello '.$data['A_1'] .' '.$data['A_2'].',</p>
									'.$emailConfigDetails['message'].'
								</td>
			        		</tr>';


				$email_details['to_id'] = $lastId;
				$email_details['to_email'] = $data['A_3'];
				$email_details['from_id'] = 1;
				$email_details['from_email'] = $emailConfigDetails['fromEmail'];//"admin@jusoutbeauty.com";
				$email_details['subject'] = $emailConfigDetails['subject'];
				$email_details['message'] = "";
				$email_details['logo'] = $emailConfigDetails['logo'];
				$email_details['module_code'] = "REGISTRATION";
                $email_details['template'] = 'admin.emails.emailTemplate';
                $email_details['htmlbody'] = $htmlbody;
                $email_details['pageTitle'] = $emailConfigDetails['title'];

			    $check = $EmailForwardModel->sendEmail($email_details);

                if($check === 'true' || $check === true){
                    $arrRes ['done'] = true;
                    $arrRes ['msg'] = 'Account created successfully, kindly login with your email and password.';
                    echo json_encode ( $arrRes );
                    die ();
                }else{
                    $arrRes ['done'] = false;
                    $arrRes ['msg'] = 'Something Went Wrong. Please Try Again Later!!!';
                    echo json_encode ( $arrRes );
                    die ();
                }


// 				return response()->json(['message' => $lastId], 200);

	}
}
}
