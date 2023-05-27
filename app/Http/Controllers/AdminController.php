<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\User;
use App\Models\Feature;
use App\Models\TypeName;
use App\Models\UserModel;
use App\Models\BlogsModel;
use App\Models\Handpicked;
use App\Models\OrderModel;
use App\Models\Recomended;
use App\Models\GivingModel;
use App\Models\RoutineType;
use App\Models\ShadesModel;
use App\Models\ProductModel;
use App\Models\ReviewsModel;
use App\Models\RoutineSteps;
use App\Models\TicketsModel;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\QuestionModel;
use App\Models\IngredientModel;
use App\Models\EmailConfigModel;
use App\Models\OrderDetailModel;
use App\Models\ProductUsesModel;
use App\Models\ShadeFinderModel;
use App\Models\EmailForwardModel;
use App\Models\OrderPaymentModel;
use App\Models\ProductSelfiModel;
use App\Models\ProductShadeModel;
use App\Models\SubscriptionModel;
use App\Models\BundleProductModel;
use App\Models\OrderShipmentModel;
use App\Models\OrderShippingModel;
use App\Models\UserdashboardModel;
use Illuminate\Support\Facades\DB;
use App\Models\AddSocialIconsModel;
use App\Models\BundleProductLineModel;
use App\Models\ProductIngredientModel;
use App\Models\ShadeFinderSelfieModel;

use App\Models\FooterSubscriptionModel;
use App\Models\OrderShippingTrackingModel;

class AdminController extends Controller
{
	/* Selfie code */  
	public function ChangeAdminProductSnapSelfieStatus(){
		$ProductSelfiModel = new ProductSelfiModel();

		$details = $_REQUEST ['details'];
		$productSelfiID = $details ['productSelfiID'];

		$productselfistatus = $ProductSelfiModel->ChangeAdminProductSnapSelfieStatus($productSelfiID);

		if(isset($productselfistatus['STATUS']) && $productselfistatus['STATUS'] != '1'){
			$status = '1';
			$arrRes ['msg'] = 'Selfie active successfully...';
		}else{
			$status = '0';
			$arrRes ['msg'] = 'Selfie Inactive successfully...';
		}
		
		$result = DB::table ( 'jb_product_selfi_tbl' ) ->where ( 'SELFIE_ID', $productSelfiID ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
		
		$arrRes ['done'] = true;
		
		echo json_encode ( $arrRes );
	}



		/* Selfie code end */  

	public function addSocialIcons(Request $request) {
		$detail=$_REQUEST['details'];
				$data=$detail['social'];
				
		$social=[];	
		$social['FACEBOOK_ICON_LINK']=$data['S_1'];
		$social['FACEBOOK_ICON_ENABLE']=$data['S_2'] == 'true' ? '1' : '0';		
		$social['INSTAGRAM_ICON_LINK']=$data['S_3'];
		$social['INSTAGRAM_ICON_ENABLE']=$data['S_4'] == 'true' ? '1' : '0';		
		$social['TWITTER_ICON_LINK']=$data['S_5'];
		$social['TWITTER_ICON_ENABLE']=$data['S_6'] == 'true' ? '1' : '0';	
		$social['LINKEDIN_ICON_LINK']=$data['S_7'];
		$social['LINKEDIN_ICON_ENABLE']=$data['S_8'] == 'true' ? '1' : '0';
		$social['YOUTUBE_ICON_LINK']=$data['S_9'];
		$social['YOUTUBE_ICON_ENABLE']=$data['S_10'] == 'true' ? '1' : '0';


		$arrRes = array();
		if($data['ID'] == ''){
			$social['CONTROL_ID']=1;
			DB::table('jb_footer_control_tbl')->insert($social);
			$arrRes ['msg'] = 'Data Added successfully!';
			
		}else{
		
			DB::table('jb_footer_control_tbl')->where('CONTROL_ID',1)->update($social);
			$arrRes ['msg'] = 'Data updated successfully!';
			
		}
		
		return response()->json($arrRes, 200);

   	}
	public function displaySocialData() {
		$AddSocialIconsModel=new AddSocialIconsModel();
		$footerdetails = $AddSocialIconsModel->getFooterdata();
		return response()->json(['footerdetails' => $footerdetails], 200);
   	}


	public function index() {
		
    	$data['page'] = 'login';
       	return view('admin.login')->with($data);
   	}
   	public function login(Request $request){
   
   		if($request->session()->has('userId')){
   			return redirect('dashboard');
   		}else{
   			return view('admin.login');
   		}
   	}
   	
   	public function logout(Request $request) {
	   	$request->session()->forget('userId');
	   	$request->session()->forget('userName');
	   	$request->session()->forget('firstName');
	   	$request->session()->forget('lastName');
	   	$request->session()->forget('email');
	   	return redirect('admin');
   	}
   	
   	public function dashboard() {
   	
		$User=new User();
		$data['getTotalUsers']= $User->getTotalUsers();
		$data['getTotalTickets']= $User->getTotalTickets();
		$data['getTotalProducts']= $User->getTotalProducts();
		$data['getTotalPayments']= $User->getTotalPayments();
		$data['getTotalBundles']= $User->getTotalBundles();
		$data['getTotalBlogs']= $User->getTotalBlogs();
		$data['getTotalOrders']= $User->getTotalOrders();
		$data['getShippedOrders']= $User->getTotalShippedOrders();
		$data['getTotalTransactions']= $User->getTotalShippedOrders();
		$data['getTotalSubscriptions']= $User->getTotalSubscriptions();
		$data['getTotalReviews']= $User->getTotalReviews();
		$data['getTotalGivings']= $User->getTotalGivings();
   		$data['page'] = 'Dashboard';
   		return view('admin.dashboard')->with($data);
   	}
	public function viewAllSelfi() {

		$data['page'] = 'Snap Product Selfi';
		return view('admin.view-productselfi')->with($data);
	}
       /* Selfie  get and delete admin side start*/
	   public function deletSelectedSelfie(Request $request){
		
		// $ProductSelfiModel = new ProductSelfiModel();
		 
		$details = $_REQUEST ['details'];
		$id = $details['productSelectedSelfiID'];
		
		// $selfieDetail = $ProductSelfiModel->getSpecificSelfiAttachments($id);

		$result = DB::table('jb_product_selfi_images_tbl as a')
    	->where('a.IMAGE_ID', $id)
    	->get();

		if(isset($result) && !empty($result)){
			foreach ($result as $value){
				unlink($value->PATH);
			}
			
		}
		DB::table('jb_product_selfi_images_tbl')->where('IMAGE_ID', $id)->delete();
		
		  
		$arrRes['done']=true;
		$arrRes['id'] = $id;
		$arrRes['message']="Selfie deleted Successfully";
		return isset($arrRes) ? $arrRes : null;

     }
	   
	 public function deletespecificselfie(Request $request){
		
		$ProductSelfiModel = new ProductSelfiModel();
		 
		$details = $_REQUEST ['details'];
		$id = $details['productSelfiID'];
		
		$selfieDetail = $ProductSelfiModel->getSpecificSelfiAttachments($id);
		
		DB::table('jb_product_selfi_images_tbl')->where('SELFIE_ID', $id)->delete();
		DB::table('jb_product_selfi_tbl')->where('SELFIE_ID', $id)->delete();
		
		if(isset($selfieDetail) && !empty($selfieDetail)){
			foreach ($selfieDetail as $value){
				unlink($value['path']);
			}
		}
		
		
		  
		$arrRes['done']=true;
		$arrRes['message']="Selfie deleted Successfully";
		return isset($arrRes) ? $arrRes : null;

     }

	public function get_selfies(Request $request){
		 
		 $details = $_REQUEST ['details'];
		 $id= $details['productSelfiID'];

		 $result = DB::table('jb_product_selfi_images_tbl as a')->select('a.*')
		 ->where('a.SELFIE_ID', $id)
		 ->orderBy('a.SELFIE_ID','desc')
		 ->get();
		   
		//  dd($result);
         $i=0;
		 if($result != null){
		 foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->IMAGE_ID;
		   $arrRes[$i]['DOWNPATH'] = $row->DOWN_PATH;
		   $arrRes[$i]['FILE_TYPE'] = $row->FILE_TYPE;
		   $i++;
		 }
	 }
	 
		return isset($arrRes) ? $arrRes : null;

	}

	       /* Selfie  get and delete admin side End */


   	public function partners() {
   		
       	$data['page'] = 'Partners';
       	return view('admin.partners')->with($data);
   	}

//    	public function adminUsers() {
   		
//        	$data['page'] = 'Admin Users';
//        	return view('admin.admin-users')->with($data);
//    	}
   	public function adminProfile() {
   		 
   		$data['page'] = 'Admin Profile';
   		return view('admin.admin-profile')->with($data);
   	}

   	public function addAdminUser() {
   		
       	$data['page'] = 'add Admin User';
       	return view('admin.add-admin-user')->with($data);
   	}

   	public function websiteUsers() {
   		
       	$data['page'] = 'Website Users';
       	return view('admin.website-users')->with($data);
   	}

   	public function addWebsiteUser() {
   		
       	$data['page'] = 'Add Website User';
       	return view('admin.add-website-user')->with($data);
   	}

   	public function viewCategories() {
   		
       	$data['page'] = 'View Categories';
       	return view('admin.view-categories')->with($data);
   	}

   	public function viewProducts() {
   	
		$data ['page'] = 'View Products';
		return view ( 'admin.view-products' )->with ( $data );
	}

	public function getAllAdminProductSnapSelfielov() {
		$ProductSelfiModel = new ProductSelfiModel();

		$arrRes ['productselfi'] = $ProductSelfiModel->getAllAdminSelfie();
		   
		// dd($arrRes);
		echo json_encode ( $arrRes );
	}
	
	public function viewBundles() {
	
		$data ['page'] = 'View Bundles';
		return view ( 'admin.view-productbundles' )->with ( $data );
	}

      public function addProduct() {
   	
		 $data ['page'] = 'Add Product';
		return view ( 'admin.add-product' )->with ( $data );
	 }

	   //===============Routine ========================>

	   public function add_routine(){
		$data ['page'] = 'Add Routine';
		return view('admin.Routines.addroutine')->with( $data );
	   }
          
	   public function routine_type(){
		    $data ['page'] = 'Add Routine';
		    return view('admin.Routines.routine_type_new')->with( $data );
	   }


	   public function getTypeNameLov(Request $request){
    	 
		$details = $_REQUEST ['details'];
		$typeid= $details['typeid'];

		$result = DB::table('jb_type_name_tbl as a')->select('a.*')
		->where('a.STATUS','active')
		->where('a.TYPE_ID', $typeid)
		->orderBy('a.NAME_ID','desc')
		->get();
		 
		$i=0;
		foreach ($result as $row){
		   $arrRes[$i]['id'] = $row->CATEGORY_ID;
		   $arrRes[$i]['name'] = $row->CATEGORY_NAME;
		   $i++;
		}
	 
		return isset($arrRes) ? $arrRes : null;
	 }

	 public function remove_routine(Request $request){

		$details = $_REQUEST ['details'];
		$routineid = $details ['routineid'];
       
		$typename= TypeName::where('TYPE_ID',$routineid)->first();

		if($typename){
			$nameid=$typename->NAME_ID;
			$step = RoutineSteps::where('NAME_ID', $nameid)->delete();
			$typename= TypeName::where('TYPE_ID',$routineid)->delete();
			$routine= RoutineType::where('TYPE_ID',$routineid)->delete();

		}else{

			$routine= RoutineType::where('TYPE_ID',$routineid)->delete();

		}


		// $steps= new RoutineSteps();

		// $arrRes['typenamelov']= $typename->getTypeNameLov($typeid);
		// $arrRes['typedata']=$typename->getallnamedata($typeid);
		// $stepsarray=$steps->getstepsbasedonroutine($typenameid);

		// $arrRes['steps']=$stepsarray;

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Routine has been deleted with all of its contents.';
		echo json_encode ( $arrRes );
		  die ();


	 }

	 public function remove_routine_type_name(Request $request){

		      
		 $details = $_REQUEST ['details'];
		 $typenameid = $details ['typenameid'];

		 //  $typename= TypeName::where('NAME_ID',$typenameid)->first();
		 $typename=TypeName::where('NAME_ID',$typenameid)->delete();

	    //  $typeid=$typename->TYPE_ID;
		$typeid=$typenameid;
          
		 $step = RoutineSteps::where('NAME_ID', $typenameid)->delete();

		 $typename= TypeName::where('NAME_ID',$typenameid)->delete();

	     $steps= new RoutineSteps();
		 $typename= new TypeName();

		 $arrRes['typenamelov']= $typename->getTypeNameLov($typeid);
		 
		 $arrRes['typedata']=$typename->getallnamedata($typeid);

	     $stepsarray=$steps->getstepsbasedonroutine($typeid);

	     $arrRes['steps']=$stepsarray;

	     $arrRes ['done'] = true;
	     $arrRes ['msg'] = 'Routine type name and its Steps Deleted Successfully.';
	     echo json_encode ( $arrRes );
		   die ();

     }



	 public function removesteps(Request $request){
              
		     $details = $_REQUEST ['details'];
		     $stepid = $details ['stepid'];
		     $step = RoutineSteps::where('STEP_ID', $stepid)->first();
		     $name_id= $step->NAME_ID;
             $step_no=$step->STEP_NO;

		     $getallsteps=RoutineSteps::where('NAME_ID', $name_id)->get()->count();
		  if( $getallsteps == $step_no){
			 $step = RoutineSteps::where('STEP_ID', $stepid)->delete();
		  }else{
			 $arrRes ['done'] = false;
			 $arrRes ['msg'] = 'You must delete the steps in descending order.';
			 echo json_encode ( $arrRes );
				  die ();
		  }

		  $step = RoutineSteps::where('STEP_ID', $stepid)->delete();
          
		  $typename= TypeName::where('NAME_ID',$name_id)->first();
		  $typeid=$typename->TYPE_ID;

          $steps= new RoutineSteps();
		  $stepsarray=$steps->getstepsbasedonroutine($typeid);

		  $arrRes['steps']=$stepsarray;

		  $arrRes ['done'] = true;
		  $arrRes ['msg'] = 'Step Deleted Successfully.';
	       echo json_encode ( $arrRes );
				die ();

	 }
	 
	 public function addstep_routine(Request $request){
		 
		 $details = $_REQUEST ['details'];
		 $data = $details ['routinetype'];
		 $userId = $details ['userId'];
		 $typeid = $details['typeid'];

         if(!isset($data['P_7']['id'])){
			$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Select routine Type.';
				echo json_encode ( $arrRes );
				die ();
		 }
		 if(!isset($data['P_8']['id'])){
			$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Select category to procced.';
				echo json_encode ( $arrRes );
				die ();
		 }
		 if(!isset($data['P_11']['id'])){
			$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Select Product to procced.';
				echo json_encode ( $arrRes );
				die ();
		 }
		 $typeid= $data['P_7']['id'];

	
		 $arrRes = array ();
		 $arrRes ['done'] = false;
		 $arrRes ['msg'] = '';

	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			 if ($data['P_12'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description  is required.';
				echo json_encode ( $arrRes );
				die ();
			 } 

			 if($data['P_7']['id'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose routine to proceed.';
				echo json_encode ( $arrRes );
				die ();
			 }
			 if($data['P_11']['id'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose Product to proceed.';
				echo json_encode ( $arrRes );
				die ();

			 }
			 // if ($data ['P_2'] == '') {
					
			 // 	$arrRes ['done'] = false;
			 // 	$arrRes ['msg'] = 'Quantity is required.';
			 // 	echo json_encode ( $arrRes );
			 // 	die ();
			 // }

			 $ROUTINETYPE = new RoutineType();
			 $routinetypename= new TypeName();
			 $steps=new RoutineSteps();
           
			 $result = DB::table('jb_type_name_tbl as a')->select('a.*')
    	     ->where('a.NAME_ID',$data['P_7']['id'])
    	     ->first();

		     $recordId=$result->TYPE_ID;

				$result = DB::table ( 'jb_routine_steps_tbl' )->insertGetId (
						array ( 
								'USER_ID' => $userId, 
								'NAME_ID' => $data['P_7']['id'],
								'STEP_NO' =>  $data['P_13'],
								'PRODUCT_ID' => $data['P_11']['id'],
								'TYPE_ID'=>  $typeid,
								'DESCRIPTION' => $data['P_12'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )));

                         $stepsarray=$steps->getstepsbasedonroutine($recordId);

						 $arrRes['steps']=$stepsarray;

				 $arrRes ['done'] = true;
				 $arrRes ['msg'] = 'Routine Type Step Created Successfully';
				 // $arrRes ['ID'] = $result;
				 // $arrRes ['redirect_url'] = url('routine_type_new');
				 echo json_encode ( $arrRes );
				 die ();	
			} 
		}


	   public function add_routine_type_name(Request $request){
                 
		$details = $_REQUEST ['details'];
		$data = $details ['routinetype'];
		$userId = $details ['userId'];
		$typeid= $details['typeid'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['C_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}


			if($details['typeid'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Save the above section to proceed.';
				echo json_encode ( $arrRes );
				die ();
			}

			 $typename= TypeName::where('TYPE_ID','=',$typeid)->where('TYPE_NAME','=',$data['C_1'])->get();

			if($typename->count() > 0){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Routine Name Already Exists,Choose different Name.';
				echo json_encode ( $arrRes );
				die ();
			}
			// if ($data ['P_2'] == '') {
					
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Quantity is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
		    	$typename= new TypeName();
	
			if ($data ['ID'] == '') {



	
				$result = DB::table ( 'jb_type_name_tbl' )->insertGetId (
						array ( 
								'TYPE_ID' => $typeid,
								'TYPE_NAME' => $data['C_1'],
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						));
				$arrRes ['done'] = true;

				$arrRes['typenamelov']= $typename->getTypeNameLov($typeid);
				$arrRes['typedata']=$typename->getallnamedata($typeid);

				$arrRes ['msg'] = 'Routine Type Name Created Successfully';
				// $arrRes ['ID'] = $result;
				// $arrRes ['redirect_url'] = url('routine_type_new');
				echo json_encode ( $arrRes );
				die ();
	
			 } else {
	
				$result = DB::table ( 'jb_type_name_tbl' ) ->where ( 'NAME_ID', $data ['ID'] ) ->update (
						array ( 
							    'TYPE_ID' => $typeid,
								'TYPE_NAME' => $data['C_1'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes['typenamelov']= $typename->getTypeNameLov($typeid);
				$arrRes['typedata']=$typename->getallnamedata($typeid);

				$arrRes ['msg'] = 'Routine Type Name Updated Successfully';
				// $arrRes ['ID'] = $data ['ID'];
				// $arrRes ['redirect_url'] = url('view-ingredients');
				echo json_encode ( $arrRes );
				die ();
			 }
		 }
	 }

	   public function checksteps(Request $request){
          
		         $details= $_REQUEST['details'];
				 $type_id= $details['typeid'];

                 $name_id= $details['routinetypeid'];

			     if($details['routinetypeid'] == '' && $type_id == ''){       
				 
				 $arrRes ['done'] = false;
				 $arrRes ['msg'] = 'Please Select routine and routine type is required.';
				 echo json_encode ( $arrRes );
				 die ();

			     }

				 

			     $steps= RoutineSteps::where('NAME_ID', $name_id)->where('TYPE_ID', $type_id)->get();

			     if($steps){
				     $count=$steps->count();
			     }
				 $arrRes ['done'] = true;
                  $arrRes['count'] =$count+1;
				  echo json_encode ( $arrRes );


	     }
	   public function routine_type_add(Request $request){
                                 
		$details = $_REQUEST ['details'];
		$data = $details ['Routinename'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			// if ($data ['P_2'] == '') {
					
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Quantity is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if ($data ['P_3'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please Select Routine Category is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_4'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			

			$typename= new TypeName();

			if ($data['ID'] == '') {
				
				$routine= RoutineType::where('NAME','=',$data['P_1'])->get();
				if($routine->count() > 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Routine Name already Exist,Choose different Name.';
					echo json_encode ( $arrRes );
					die ();
				}
	
				$result = DB::table ( 'jb_routine_type_tbl' )->insertGetId (
						array ( 
								'NAME' => $data['P_1'],
								'IDENTIFY' => $data['P_3'],
								'DESCRIPTION' => $data['P_4'],
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Routine Name Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes['typenamelov']=  $typename->getTypeNameLov($data ['ID']);

				$arrRes ['redirect_url'] = url('routine_type_new');
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_routine_type_tbl' ) ->where ( 'TYPE_ID', $data ['ID'] ) ->update (
						array ( 
							'NAME' => $data ['P_1'],
							'IDENTIFY' => $data['P_3'],
							'DESCRIPTION' => $data['P_4'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Routine Name Updated Successfully';
				$arrRes['typenamelov']= $typename->getTypeNameLov($data ['ID']);

				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['redirect_url'] = url('view-ingredients');
				echo json_encode ( $arrRes );
				die ();
			}
		}
	   }

	   public function changeStatusRoutineType(Request $request) {
		$RoutineType = new RoutineType();
		
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$catDetail = $RoutineType->getSpecificRotineTypeData($recordId);
		
		if(isset($catDetail['STATUS']) && $catDetail['STATUS'] != 'active'){

			$status = 'active';
			$arrRes ['msg'] = 'Routine Name active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Routine Name Inactive successfully...';
		}
		
		$result = DB::table ( 'jb_routine_type_tbl' ) ->where ( 'TYPE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
		
		$arrRes ['done'] = true;
		
		echo json_encode ( $arrRes );
	
	}
	public function routine_type_name_edit(){

		$ROUTINETYPE = new RoutineType();
		$routinetypename= new TypeName();
  
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
  
		$arrRes['typename']= $routinetypename->getspecifictypename($recordId);

		 echo json_encode ( $arrRes );
  }

	   public function routine_type_edit(){

		  $ROUTINETYPE = new RoutineType();
		  $routinetypename= new TypeName();
		  $steps=new RoutineSteps();
	
		  $details = $_REQUEST ['details'];
		  $recordId = $details ['recordId'];
		  $userId = $details ['userId'];
	
		  $arrRes ['details'] = $ROUTINETYPE->getSpecificRotineTypeData($recordId);
		  $arrRes ['images'] = $ROUTINETYPE->getSpecificRoutineTypeAttachments($recordId);
		  $arrRes['typenamelov']= $routinetypename->getTypeNameLov($recordId);
		  $type=$routinetypename->getallnamedata($recordId);
		  $arrRes['alltypenamedata']= $type;
		  $typeid=[];


		  if($type){
		  foreach($type as $data){
              $typeid[]= $data['id'];
			  $typename[]=$data['name'];
		   }
              $k=0;
			  
		   foreach($typeid as $v=>$id_type){
		    foreach($typename as $b=>$name)
			if($v== $b){
			  $steps2=$steps->getsteps($id_type,$name);
               
			   if($steps2){
				$arr[$k]= $steps2 ; 
				$k++;
			 }
			}
			}
			$steps_array=[];
			$j=0;
			if(isset($arr)){
			foreach($arr as $r){
				foreach($r as $k){
					$steps_array[$j] = $k;
					$j++;
				}
			}
		}

			$arrRes['steps'] =	$steps_array;	
		 }			

		   echo json_encode ( $arrRes );
	}
	public function getAllAdminroutinetype() {
		
		$RoutineType = new RoutineType();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		

		$arrRes ['list'] = $RoutineType->getRoutineTypeDataAdmin();

		$TypeName=new TypeName();

		$arrRes ['routinetypes']=$TypeName->getAllRoutineTypes();
		
		// $arr['routinetypessteps']=$TypeName->getallroutinetypelov();
	
		// $arrRes ['listSubCat'] = $Category->getSubCategoryData();
		// $arrRes ['listSubSubCat'] = $Category->getSubSubCategoryData();
		
		// $arrRes ['list1'] = $Category->getCategoryLov();
		// $arrRes ['list2'] = $Category->getSubCategoryLov();
	
		echo json_encode ( $arrRes );
	}

	public function deleteRoutineTypeRecord(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$categoryId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$existCheckSubCategory = $CategoryModel->checkSubCategoryExistWrtCategory($categoryId);
		
		if($existCheckSubCategory == true){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Sub Categories exist against this category, kindly remove sub categories then proceed.';
			echo json_encode ( $arrRes );
			die();
		}
		
		$existCheckProduct = $ProductModel->checkProductExistWrtCategoryId($categoryId, '1');
		
		if($existCheckProduct == true){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Products exist against this category, kindly remove products then proceed.';
			echo json_encode ( $arrRes );
			die();
		}
		
		$delete = DB::table ( 'jb_category_tbl' )->where ( 'CATEGORY_ID', $categoryId )->delete ();
		
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Category deleted successfully...';
	
		echo json_encode ( $arrRes );
	}

	   //===============Routine End ===========================>

    	public function viewAllIngredients() {
   		
		     $data ['page'] = 'View All Ingredients';
		       return view ( 'admin.view-all-ingredients' )->with ( $data );
	 }

	 public function viewAllFeatures() {
   		
		$data ['page'] = 'View All Features';
		  return view ( 'admin.view-all-Features' )->with ( $data );
}


	
	public function addNewIngredient($id='') {
		
		$data ['page'] = 'Add New Ingredient';
		$data ['ingredientId'] = $id;
		return view ( 'admin.add-new-ingredient' )->with ( $data );
	}
	
	public function viewAllShades() {
		
		$data ['page'] = 'View All Shades';
		return view ( 'admin.view-all-shades' )->with ( $data );
	}
	public function viewAllBlogs() {
		
		$data ['page'] = 'View All Shades';
		return view ( 'admin.view-all-bloges' )->with ( $data );
	}
	
	public function addShade() {
		
		$data ['page'] = 'Add Shade';
		return view ( 'admin.add-shade' )->with ( $data );
	}
	
	public function blogs() {
		
		$data ['page'] = 'Blogs';
		return view ( 'admin.blogs' )->with ( $data );
	}
	
	public function addBlog() {
		
		$data ['page'] = 'Add Blog';
		return view ( 'admin.add-blog' )->with ( $data );
	}
	
	public function editBlog() {
		
		$data ['page'] = 'Edit Blogs';
		return view ( 'admin.edit-blog' )->with ( $data );
	}
	
	public function shadeFinderQuiz() {
		
		$data ['page'] = 'Shade Finder Quiz';
		return view ( 'admin.shade-finder-quiz' )->with ( $data );
	}
	public function shadeFinderQuizYes() {
	
		$data ['page'] = 'Shade Finder Quiz';
		return view ( 'admin.shade-finder-quiz-yes' )->with ( $data );
	}
	public function shadeFinderQuizNo() {
	
		$data ['page'] = 'Shade Finder Quiz';
		return view ( 'admin.shade-finder-quiz-no' )->with ( $data );
	}
	
	public function addShadeFinderQuiz() {
		
		$data ['page'] = 'Add Shade Finder Quiz';
		return view ( 'admin.add-shade-finder-quiz' )->with ( $data );
	}
	
	public function orders() {
		
		$data ['page'] = 'Orders';
		return view ( 'admin.orders' )->with ( $data );
	}
	public function shippedorders() {
	
		$data ['page'] = 'Shipped Orders';
		return view ( 'admin.shippedorders' )->with ( $data );
	}
	
	
	public function orderDetail() {
		
		$data ['page'] = 'Order Detail';
		return view ( 'admin.order-detail' )->with ( $data );
	}
	
	public function apis() {
		
		$data ['page'] = 'Apis';
		return view ( 'admin.apis' )->with ( $data );
	}
	
	public function addApi() {
		
		$data ['page'] = 'Add Api';
		return view ( 'admin.add-api' )->with ( $data );
	}
	
	public function editApi() {
		
		$data ['page'] = 'Edit Api';
		return view ( 'admin.edit-api' )->with ( $data );
	}
	
	public function viewApi() {
		
		$data ['page'] = 'View Api';
		return view ( 'admin.view-api' )->with ( $data );
	}
	
	public function smsApis() {
		
		$data ['page'] = 'Sms Apis';
		return view ( 'admin.sms-apis' )->with ( $data );
	}
	
	public function addSmsApi() {
		
		$data ['page'] = 'Add Sms Api';
		return view ( 'admin.add-sms-Api' )->with ( $data );
	}
	
	public function editSmsApi() {
		
		$data ['page'] = 'Edit Sms Api';
		return view ( 'admin.edit-sms-Api' )->with ( $data );
	}
	
	public function smsTemplates() {
		
		$data ['page'] = 'Sms Templates';
		return view ( 'admin.sms-templates' )->with ( $data );
	}
	
	public function addSmsTemplate() {
		
		$data ['page'] = 'Add SmsTemplate';
		return view ( 'admin.add-sms-template' )->with ( $data );
	}
	
	public function editSmsTemplate() {
		
		$data ['page'] = 'Edit SmsTemplate';
		return view ( 'admin.edit-sms-template' )->with ( $data );
	}
	
	public function header() {
		
		$data ['page'] = 'Header';
		return view ( 'admin.header' )->with ( $data );
	}
	
	public function footer() {
			
		
		$data ['page'] = 'Footer';
		return view ( 'admin.footer' )->with ( $data );
	

	}
	
	public function homePage() {
		
		$data ['page'] = 'Home Page';
		return view ( 'admin.home-page' )->with ( $data );
	}
	
	public function payments() {
		
		$data ['page'] = 'Payments';
		return view ( 'admin.payments' )->with ( $data );
	}
	
	public function viewPayment() {
		
		$data ['page'] = 'View Payment';
		return view ( 'admin.view-payment' )->with ( $data );
	}
	
	public function givings() {
		
		$data ['page'] = 'Givings';
		return view ( 'admin.givings' )->with ( $data );
	}
	
	public function Delivery() {
		
		$data ['page'] = 'Delivery';
		return view ( 'admin.delivery' )->with ( $data );
	}
	
	public function vieDelivery() {
		
		$data ['page'] = 'View Delivery';
		return view ( 'admin.view-delivery' )->with ( $data );
	}
	
	public function Questions() {
		
		$data ['page'] = 'Questions';
		return view ( 'admin.questions' )->with ( $data );
	}
	
	public function viewReview() {
		
		$data ['page'] = 'View Review';
		return view ( 'admin.view-review' )->with ( $data );
	}
	
	public function Reviews() {
		
		$data ['page'] = 'Reviews';
		return view ( 'admin.reviews' )->with ( $data );
	}
	
	public function shadeFinder() {
		
		$data ['page'] = 'Shade Finder';
		return view ( 'admin.shade-finder' )->with ( $data );
	}
	
	public function viewShadeFinder() {
		
		$data ['page'] = 'View Shade Finder';
		return view ( 'admin.view-shade-finder' )->with ( $data );
	}
	
	public function emailsSettings() {
		
		$data ['page'] = 'Emails Settings';
		return view ( 'admin.emails-settings' )->with ( $data );
	}
	
	public function emailsSent() {
		
		$data ['page'] = 'Emails Sent';
		return view ( 'admin.emails-sent' )->with ( $data );
	}
	
	public function allsub() {
		
		$data ['page'] = 'All Sub';
		return view ( 'admin.allsub' )->with ( $data );
	}
	
	public function editAllsub() {
		
		$data ['page'] = 'Edit All Sub';
		return view ( 'admin.edit-allsub' )->with ( $data );
	}
	
	public function addAllsub() {
		
		$data ['page'] = 'Add All Sub';
		return view ( 'admin.add-allsub' )->with ( $data );
	}
	
	public function userSubscriptions() {
		
		$data ['page'] = 'User Subscriptions';
		return view ( 'admin.user-subscriptions' )->with ( $data );
	}
	public function adminUserTickets() {
	
		$data ['page'] = 'Tickets';
		return view ( 'admin.view-tickets' )->with ( $data );
	}
	public function newsLatters() {
	
		$data ['page'] = 'News Latters';
		return view ( 'admin.view-newslatters' )->with ( $data );
	}
	public function snapSelfie() {
	
		$data ['page'] = 'Snap Selfi';
		return view ( 'admin.view-snapSelfie' )->with ( $data );
	}
	
	/*==================== admin categories code start ==========================*/
	
	public function getAllAdminCategorylov() {
		$Category = new CategoryModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		
		$arrRes ['listCat'] = $Category->getCategoryData();
		$arrRes ['listSubCat'] = $Category->getSubCategoryData();
		$arrRes ['listSubSubCat'] = $Category->getSubSubCategoryData();
		
		$arrRes ['list1'] = $Category->getCategoryLov();
		$arrRes ['list2'] = $Category->getSubCategoryLov();
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminCategory(Request $request) {
	
		$details = $_REQUEST ['details'];
		$data = $details ['category'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data ['C_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}

			
			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_category_tbl' ) ->where ( 'CATEGORY_NAME',  $data ['C_1'])->first();

				if($result != ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}
	
				$result = DB::table ( 'jb_category_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'CATEGORY_NAME' => $data['C_1'],
								'STATUS' => 'inactive',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
				);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Category Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {

				$result_if_ext = DB::table('jb_category_tbl')
								->where('CATEGORY_ID', '!=' , $data ['ID'])
								->where('CATEGORY_NAME',  $data ['C_1'])
								->get();
								
				
				if(count($result_if_ext) != 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}


				$result = DB::table ( 'jb_category_tbl' ) ->where ( 'CATEGORY_ID', $data ['ID'] ) ->update (
						array ( 'CATEGORY_NAME' => $data['C_1'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
				);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Category Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function editAdminCategory(){
		$Category = new CategoryModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $Category->getSpecificCategoryData($recordId);
	
		echo json_encode ( $arrRes );
	}
	
	public function changeStatusCategory(Request $request) {
		$Category = new CategoryModel();
		
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
		
		$result = DB::table('jb_category_tbl')->where( 'STATUS', 'active')->count();

		
		$catDetail = $Category->getSpecificCategoryData($recordId);
		
		if(isset($catDetail['STATUS']) && $catDetail['STATUS'] != 'active'){

			if($result >= 4){

				$arrRes ['msg'] = 'Can`t Activate More than Four(4) Categoriges At a Time...';
				$arrRes ['done'] = false;
			
				echo json_encode ( $arrRes );
				die ();
			}

			$status = 'active';
			$arrRes ['msg'] = 'Category active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Category Inactive successfully...';
		}
		
		$result = DB::table ( 'jb_category_tbl' ) ->where ( 'CATEGORY_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
		
		$arrRes ['done'] = true;
		
		echo json_encode ( $arrRes );
	
	}
	
	
	public function saveAdminSubCategory(Request $request) {
	
		$details = $_REQUEST ['details'];
		$data = $details ['subCategory'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if (!isset($data ['C_1']['id'])) {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['C_2'] == '') {
			
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data ['ID'] == '') {


				$result = DB::table ( 'jb_sub_category_tbl' ) ->where ( 'NAME',  $data ['C_2'])->first();

				if($result != ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}
	
				$result = DB::table ( 'jb_sub_category_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'CATEGORY_ID' => isset($data ['C_1']['id']) ? $data ['C_1']['id'] : '',
								'NAME' => $data['C_2'],
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Sub Category Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
				
				$result_if_ext = DB::table('jb_sub_category_tbl')
								->where('CATEGORY_ID', '!=' , $data ['ID'])
								->where('NAME', $data ['C_2'])
								->count();
				
				if($result_if_ext != 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}				
	
				$result = DB::table ( 'jb_sub_category_tbl' ) ->where ( 'SUB_CATEGORY_ID', $data ['ID'] ) ->update (
					array ( 'CATEGORY_ID' => isset($data ['C_1']['id']) ? $data ['C_1']['id'] : '',
							'NAME' => $data['C_2'],
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Sub Category Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminSubCategory(){
		$Category = new CategoryModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $Category->getSpecificSubCategoryData($recordId);
	
		echo json_encode ( $arrRes );
	}
	
	public function changeStatusSubCategory(Request $request) {
		$Category = new CategoryModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$catDetail = $Category->getSpecificSubCategoryData($recordId);
	
		if(isset($catDetail['STATUS']) && $catDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Sub Category active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Sub Category Inactive successfully...';
		}
	
		$result = DB::table ( 'jb_sub_category_tbl' ) ->where ( 'SUB_CATEGORY_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
	
		$arrRes ['done'] = true;
	
		echo json_encode ( $arrRes );
	
	}
	
	public function saveAdminSubSubCategory(Request $request) {
	
		$details = $_REQUEST ['details'];
		$data = $details ['subSubCategory'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if (!isset($data ['C_1']['id'])) {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Sub Category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['C_2'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data ['ID'] == '') {

				$result = DB::table ( 'jb_sub_sub_category_tbl' ) ->where ( 'NAME',  $data ['C_2'])->first();

				if($result != ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}
	
				$result = DB::table ( 'jb_sub_sub_category_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'SUB_CATEGORY_ID' => isset($data ['C_1']['id']) ? $data ['C_1']['id'] : '',
								'NAME' => $data['C_2'],
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Sub Sub Category Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {

				$result_if_ext = DB::table('jb_sub_sub_category_tbl')
								->where('SUB_SUB_CATEGORY_ID', '!=' , $data ['ID'])
								->where('NAME', $data ['C_2'])
								->count();
				
				if($result_if_ext != 0){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Name Must Be Unique.';
					echo json_encode ( $arrRes );
					die ();
				}	
	
				$result = DB::table ( 'jb_sub_sub_category_tbl' ) ->where ( 'SUB_SUB_CATEGORY_ID', $data ['ID'] ) ->update (
						array ( 'SUB_CATEGORY_ID' => isset($data ['C_1']['id']) ? $data ['C_1']['id'] : '',
								'NAME' => $data['C_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Sub Sub Category Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminSubSubCategory(){
		$Category = new CategoryModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $Category->getSpecificSubSubCategoryData($recordId);
	
		echo json_encode ( $arrRes );
	}
	
	public function changeStatusSubSubCategory(Request $request) {
		$Category = new CategoryModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$catDetail = $Category->getSpecificSubSubCategoryData($recordId);
	
		if(isset($catDetail['STATUS']) && $catDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Sub Sub Category active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Sub Sub Category Inactive successfully...';
		}
	
		$result = DB::table ( 'jb_sub_sub_category_tbl' ) ->where ( 'SUB_SUB_CATEGORY_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
	
		$arrRes ['done'] = true;
	
		echo json_encode ( $arrRes );
	}
	/*===================== admin categories code end ==========================*/

	/*======================admin feature Code start ===========================*/

	public function getAllAdminFeatureslov(Request $request) {
		$Feature = new Feature();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ingredientId = $details ['ingredientId'];
		

		$arrRes ['list'] = $Feature->getFeaturesData();
		    // $arrRes ['details'] = $ingredientDetails;
           // 		print_r('<pre>');
          // 		print_r($arrRes ['list']);
         // 		exit();
		echo json_encode ( $arrRes );
	}

	public function saveAdminFeature(Request $request) {
	
		$details = $_REQUEST ['details'];
		$data = $details ['feature'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_1']) > 100) {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less than 100 charactere.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_4'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_product_features_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'FEATURE_NAME' => $data ['P_1'],
								'FEATURE_DESCRIPTION' => base64_encode($data['P_4']),
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Feature Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['redirect_url'] = url('view-features');

				echo json_encode ( $arrRes );
				die ();
	
			} else {

				$result = DB::table ( 'jb_product_features_tbl' ) ->where ( 'FEATURE_ID', $data ['ID'] ) ->update (
						array ( 'FEATURE_NAME' => $data ['P_1'],
								'FEATURE_DESCRIPTION' => base64_encode($data['P_4']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Feature Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['redirect_url'] = url('view-features');

				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function editAdminFeature(Request $request) {
		$Ingredient = new Feature();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ingredientId = $details ['recordId'];
	
		$arrRes ['details'] = $Ingredient->getSpecificFeaturetData($ingredientId);
		$arrRes ['images'] = $Ingredient->getFeatureAttachments($ingredientId);
		echo json_encode ( $arrRes );
	
	 }
              
	  
	 public function deleteFeature(Request $request) {
		
			$Feature = new Feature();
			
			//  $ProductModel = ProductModel::where('FEATURE_ID');
			
			$details = $_REQUEST ['details'];
			$recordId = $details ['recordId'];
			
			// $userId = $details ['userId'];

			$ProductModel = DB::table('jb_product_tbl as a')
			->select('a.FEATURE_ID','a.PRODUCT_ID')
			->whereNotNull('a.FEATURE_ID')
			->get();

			
			foreach ($ProductModel as $value) {
				$productlov = explode(",",$value->FEATURE_ID);

				foreach($productlov as $key => $val){
					if ($val == $recordId){
					 	unset($productlov[$key]);
					}

				}

				$featuresArrayAfterUnset = implode(",",$productlov);
				
				DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $value->PRODUCT_ID ) ->update (
					array ( 'FEATURE_ID' => $featuresArrayAfterUnset,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);

				DB::table ( 'jb_product_features_tbl' )->where ( 'FEATURE_ID', $recordId )->delete ();
				
			}
			
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Feature deleted successfully...';
				echo json_encode ( $arrRes );


		    //  if($ProductModel == null){

			//  $delete = DB::table ( 'jb_product_features_tbl' )->where ( 'FEATURE_ID', $recordId )->delete ();
		 	// 	 $arrRes ['done'] = true;
	        //     	  $arrRes ['msg'] = 'FEATURE deleted successfully...';
		    //              echo json_encode ( $arrRes );
			//  }else {
			// 	 $arrRes ['done'] = false;
		    // 	 $arrRes ['msg'] = 'Feature already linked with product, kindly remove from product then proceed.';
			//      echo json_encode ( $arrRes );
			//      die();
			//  }
		
	}

	public function changeStatusFeature(Request $request) {
		    $Feature = new Feature();
	
	        	$details = $_REQUEST ['details'];
	            	$recordId = $details ['recordId'];
		                 $userId = $details ['userId'];
	
	 	$ingDetail = $Feature->getSpecificFeaturetData($recordId);
	
		if(isset($ingDetail['STATUS']) && $ingDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Feature active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Feature Inactive successfully...';
		}
	
		$result = DB::table ( 'jb_product_features_tbl' ) ->where ( 'FEATURE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
	
		$arrRes ['done'] = true;
	
		echo json_encode ( $arrRes );
	}
	
	
	/*===================== admin Ingredient code start ==========================*/
	
	public function getAllAdminIngredientlov(Request $request) {
		$Ingredient = new IngredientModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ingredientId = $details ['ingredientId'];
		
		if ($ingredientId != '') {
	
			$ingredientDetails = $Ingredient->getSpecificIngredientData($ingredientId);
	
		} else {
			$ingredientDetails = '';
		}

		$arrRes ['list'] = $Ingredient->getIngredientsData();
		$arrRes ['details'] = $ingredientDetails;
// 		print_r('<pre>');
// 		print_r($arrRes ['list']);
// 		exit();
		echo json_encode ( $arrRes );
	
	}
	public function saveAdminIngredient(Request $request) {
	
		$details = $_REQUEST ['details'];
		$data = $details ['ingredient'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			// if ($data ['P_2'] == '') {
					
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Quantity is required.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if ($data ['P_3'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Category is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_4'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_ingredient_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'TITLE' => $data ['P_1'],
								'QUANTITY' => $data['P_2'],
								'CATEGORY' => $data['P_3'],
								'DESCRIPTION' => base64_encode($data['P_4']),
								'STATUS' => 'active',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ingredient Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['redirect_url'] = url('view-ingredients');
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_ingredient_tbl' ) ->where ( 'INGREDIENT_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data ['P_1'],
								'QUANTITY' => $data['P_2'],
								'CATEGORY' => $data['P_3'],
								'DESCRIPTION' => base64_encode($data['P_4']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ingredient Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['redirect_url'] = url('view-ingredients');
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	
	public function editAdminIngredient(Request $request) {
		$Ingredient = new IngredientModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ingredientId = $details ['recordId'];
	
		$arrRes ['details'] = $Ingredient->getSpecificIngredientData($ingredientId);
		$arrRes ['images'] = $Ingredient->getIngredientAttachments($ingredientId);
		echo json_encode ( $arrRes );
	
	}
	public function changeStatusIngredient(Request $request) {
		$Ingredient = new IngredientModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$ingDetail = $Ingredient->getSpecificIngredientData($recordId);
	
		if(isset($ingDetail['STATUS']) && $ingDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Ingredient active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Ingredient Inactive successfully...';
		}
	
		$result = DB::table ( 'jb_ingredient_tbl' ) ->where ( 'INGREDIENT_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
	
		$arrRes ['done'] = true;
	
		echo json_encode ( $arrRes );
	}
	public function deleteIngredient(Request $request) {
		$Ingredient = new IngredientModel();
		$ProductIngredientModel = new ProductIngredientModel();
		
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		// $existCheck = $ProductIngredientModel->checkIngredientExistWrtIngredientId($recordId);
		$result = DB::table('jb_product_ingredient_tbl as a')->select('a.*')
    	->where('a.INGREDIENT_ID', $recordId)
    	->get();

		foreach ($result as $value) {
			DB::table ( 'jb_product_ingredient_tbl' )->where ( 'INGREDIENT_ID', $value->INGREDIENT_ID )->delete ();
		}

		$attDetail = $Ingredient->getIngredientAttachments($recordId);

		if(isset($attDetail) && !empty($attDetail)){
			foreach ($attDetail as $value){

				DB::table ( 'jb_ingredient_attachment_tbl' )->where ( 'INGREDIENT_ID', $value['ingredientId'] )->delete ();
				unlink($value['path']);
			}
		}

		DB::table ( 'jb_ingredient_tbl' )->where ( 'INGREDIENT_ID', $recordId )->delete ();
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient deleted successfully...';
	
		echo json_encode ( $arrRes );
		// if($existCheck == true){


		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Ingredient already linked with product, kindly remove from product then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		
		
		// $delete = DB::table ( 'jb_ingredient_tbl' )->where ( 'INGREDIENT_ID', $recordId )->delete ();
		// $delete = DB::table ( 'jb_ingredient_attachment_tbl' )->where ( 'INGREDIENT_ID', $recordId )->delete ();
		
		// if(isset($attDetail) && !empty($attDetail)){
		// 	foreach ($attDetail as $value){
		// 		unlink($value['path']);
		// 	}
		// }
		
		// $arrRes ['done'] = true;
		// $arrRes ['msg'] = 'Ingredient deleted successfully...';
	
		// echo json_encode ( $arrRes );
	}
	public function deleteIngredientAttachment(Request $request) {
		$Ingredient = new IngredientModel();
		
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$ingredientId = $details ['ingredientId'];
		$userId = $details ['userId'];
	
		$attDetail = $Ingredient->getSpecificIngredientAttachments($recordId);
		
		$delete = DB::table ( 'jb_ingredient_attachment_tbl' )->where ( 'ATTACHMENT_ID', $recordId )->delete ();
	
		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}
		
		$arrRes ['images'] = $Ingredient->getIngredientAttachments($ingredientId);
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	public function markPrimaryIngredientAttachment(Request $request) {
		$Ingredient = new IngredientModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$ingredientId = $details ['ingredientId'];
		$userId = $details ['userId'];
	
		DB::table ( 'jb_ingredient_attachment_tbl' ) ->where ( 'INGREDIENT_ID', $ingredientId ) ->update (
				array ( 'PRIMARY_FLAG' => '0')
			);
		
		$result = DB::table ( 'jb_ingredient_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $recordId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
	
		$arrRes ['images'] = $Ingredient->getIngredientAttachments($ingredientId);
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient image marked primary successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	
	/*===================== admin Ingredient code end ==========================*/


	/*===================== admin Shades code start ==========================*/
	
	public function getAllAdminBloglov(Request $request) {
		$Blogs = new BlogsModel();
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $Blogs ->getBlogsData();
		$arrRes ['ourBlog'] = $Blogs ->getSpecificOurBlogsData(1);
		
		echo json_encode ( $arrRes );
	}

	// add Blogs
	
	public function saveSingleAdminBlog(Request $request) {
		$details = $_REQUEST ['details'];
		$data = $details ['blogs'];

		if (isset ( $data ) && ! empty ( $data )) {
			if ($data['S_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(empty(DB::table('jb_our_blog_tbl')->count())){
				$result = DB::table ( 'jb_our_blog_tbl' )->insert (
					array ( 'NAME' => $data ['S_1'],
							'CREATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);
			 }
			 $result = DB::table ( 'jb_our_blog_tbl' ) ->where ( 'ID', '1' ) ->update (
				array ( 'NAME' => $data ['S_1'],
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
			
			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Blog Updated Successfully';
			echo json_encode ( $arrRes );
			die ();
		}


	}
	public function saveAdminBlogs(Request $request) {
	
		$details = $_REQUEST ['details'];
		$data = $details ['blogs'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_2'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_blogs_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'TITLE' => $data ['P_1'],
								'DESCRIPTION' => base64_encode($data['P_2']),
								'STATUS' => 'active',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Blogs Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BLOG_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data ['P_1'],
								'DESCRIPTION' => base64_encode($data['P_2']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Blogs Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function editAdminBlog(Request $request) {
		$Blogs = new BlogsModel();
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$blogId = $details ['recordId'];
		
		$arrRes ['details'] = $Blogs->getSpecificBlogsData($blogId);
		echo json_encode ( $arrRes );
	
	}
	
	
	public function getAllAdminShadeslov(Request $request) {
		$Shades = new ShadesModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $Shades->getShadesData();
		
		echo json_encode ( $arrRes );
	}
	public function saveAdminShades(Request $request) {
	
		$details = $_REQUEST ['details'];
		$data = $details ['shades'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_2'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_shades_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'TITLE' => $data ['P_1'],
								'DESCRIPTION' => base64_encode($data['P_2']),
								'STATUS' => 'active',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shades Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_shades_tbl' ) ->where ( 'SHADE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data ['P_1'],
								'DESCRIPTION' => base64_encode($data['P_2']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shades Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}

	public function editAdminShade(Request $request) {
		$Shades = new ShadesModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$shadeId = $details ['recordId'];
	
		$arrRes ['details'] = $Shades->getSpecificShadesData($shadeId);
		$arrRes ['images'] = $Shades->getShadeAttachments($shadeId);
		echo json_encode ( $arrRes );
	}
	
	public function changeStatusShade(Request $request) {
		$Shades = new ShadesModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$shadeDetail = $Shades->getSpecificShadesData($recordId);
	
		if(isset($shadeDetail['STATUS']) && $shadeDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Shade active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Shade Inactive successfully...';
		}
	
		$result = DB::table ( 'jb_shades_tbl' ) ->where ( 'SHADE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
	
		$arrRes ['done'] = true;
	
		echo json_encode ( $arrRes );
	}
	public function changeStatusBlogs(Request $request) {
		$Shades = new BlogsModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$shadeDetail = $Shades->getSpecificBlogsData($recordId);
	
		if(isset($shadeDetail['STATUS']) && $shadeDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Blog active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Blog Inactive successfully...';
		}
	
		$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BLOG_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
	
		$arrRes ['done'] = true;
	
		echo json_encode ( $arrRes );
	}
	public function updateSpecificUserSubscriptionStatusAdmin(Request $request){
		$SubscriptionModel = new SubscriptionModel();
   	
   		$details = $_REQUEST ['details'];
		

   		$userId = $details ['userId'];
   		$subsId = $details ['subsId'];
		$flag = $details ['flag'];

		if($flag == "0"){
			$flag_active = 'inactive';
		}else{
			$flag_active = 'active';
		}
			
		   $result = DB::table ( 'jb_user_subscription_tbl' ) ->where ( 'USER_SUBSCRIPTION_ID', $subsId ) ->update (
			array ( 'SUBSCRIPTION_STATUS' => $flag_active,
					'UPDATED_BY' => $userId,
					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			)
		);
			$arrRes ['done'] = true;
			
			echo json_encode ( $arrRes );
			
	}
	
	public function markPrimaryShadeAttachment(Request $request) {
		$Shades = new ShadesModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$shadeId = $details ['shadeId'];
		$userId = $details ['userId'];
	
		DB::table ( 'jb_shades_attachment_tbl' ) ->where ( 'SHADE_ID', $shadeId ) ->update (
				array ( 'PRIMARY_FLAG' => '0')
				);
	
		$result = DB::table ( 'jb_shades_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $recordId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
	
		$arrRes ['images'] = $Shades->getShadeAttachments($shadeId);
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Shade image marked primary successfully...';
	
		echo json_encode ( $arrRes );
	}
	public function deleteShadeAttachment(Request $request) {
		$Shades = new ShadesModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$shadeId = $details ['shadeId'];
		$userId = $details ['userId'];
	
		$attDetail = $Shades->getSpecificShadeAttachments($recordId);
		
		$delete = DB::table ( 'jb_shades_attachment_tbl' )->where ( 'ATTACHMENT_ID', $recordId )->delete ();
	
		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}
		
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Shade image deleted successfully...';
		$arrRes ['images'] = $Shades->getShadeAttachments($shadeId);
		
		echo json_encode ( $arrRes );
	}
	public function deleteBlogAttachment(Request $request) {
		$BlogsModel = new BlogsModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$attDetail = $BlogsModel->getSpecificBlogsData($recordId);
	
		$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BLOG_ID', $recordId ) ->update (
						array ( 'IMAGE_PATH' => '',
								'IMAGE_DOWN_PATH' => '',
								
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Blog image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	public function deletePicBlogDetail(Request $request) {
		$BlogsModel = new BlogsModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$attDetail = $BlogsModel->getSpecificBlogsData($recordId);
	
		$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BLOG_ID', $recordId ) ->update (
				array ( 'IMAGE_DETAIL_PATH' => '',
						'IMAGE_DETAIL_DOWN_PATH' => '',
	
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
	
		if(isset($attDetail['detailPath']) && $attDetail['detailPath'] != ''){
			unlink($attDetail['detailPath']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Blog detail image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	public function deletePicOurBlog(Request $request) {
		$BlogsModel = new BlogsModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$attDetail = $BlogsModel->getSpecificOurBlogsData($recordId);
	
		$result = DB::table ( 'jb_our_blog_tbl' ) ->where ( 'ID', $recordId ) ->update (
				array ( 'IMAGE_PATH' => '',
						'IMAGE_DOWN_PATH' => '',
	
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
	
		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Our Blog image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	public function deleteBlog(Request $request) {
		$Shades = new BlogsModel();
		
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];		
		$delete = DB::table ( 'jb_blogs_tbl' )->where ( 'BLOG_ID', $recordId )->delete ();
		$delete = DB::table ( 'jb_blogs_tbl' )->where ( 'BLOG_ID', $recordId )->delete ();
	
		if(isset($attDetail) && !empty($attDetail)){
			foreach($attDetail as $value){
				unlink($value['path']);
			}
		}
		
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	public function deleteShade(Request $request) {
		$Shades = new ShadesModel();
		$ProductShadeModel = new ProductShadeModel();
		
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		// $existCheck = $ProductShadeModel->checkShadeExistWrtShadeId($recordId);
		
		DB::table ( 'jb_shades_tbl' ) ->where ( 'SHADE_ID', $recordId ) ->update (
			array(
				'IS_DELETED' => 1,
				'STATUS' => 'inactive'
			)
			);
		// if($existCheck == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Shade already linked with product, kindly remove from product then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		// $attDetail = $Shades->getShadeAttachments($recordId);
		
		// $delete = DB::table ( 'jb_shades_tbl' )->where ( 'SHADE_ID', $recordId )->delete ();
		// $delete = DB::table ( 'jb_shades_attachment_tbl' )->where ( 'SHADE_ID', $recordId )->delete ();
	
		// if(isset($attDetail) && !empty($attDetail)){
		// 	foreach($attDetail as $value){
		// 		unlink($value['path']);
		// 	}
		// }
		
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	/*===================== admin Shades code end ==========================*/
	
	/*===================== admin Product code start ==========================*/
	
	public function getAllAdminProductlov(Request $request) {
		$Category = new CategoryModel();
		$Product = new ProductModel();
		$Shades = new ShadesModel();
		$features=new Feature();
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes['features']= $features->getactivefeaturesdata();
		$arrRes ['list'] = $Product->getAllProductsData();
		$arrRes ['list1'] = $Category->getCategoryLov();
		$arrRes ['list2'] = $Shades->getShadesLov();
	
		echo json_encode ( $arrRes );
	}
	public function getSubCategoriesWrtCategory(Request $request) {
		 
		 $Category = new CategoryModel();
		 $Product= new ProductModel();
	
		 $details = $_REQUEST ['details'];
		 $category = $details ['category'];
		 $userId = $details ['userId'];

		
		if(!isset($category['id'])){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'First choose category...';
			echo json_encode ( $arrRes );
			die();
		}
		$product_lov = DB::table('jb_product_tbl')->where('CATEGORY_ID',$category['id'])->orderby('PRODUCT_ID', 'desc')->get();
       
		// $arrRes['product']=$product_lov;
		$i=0;
		foreach ($product_lov as $row){
    		$arrRes['product'][$i]['id'] = $row->PRODUCT_ID;
    		$arrRes['product'][$i]['name'] = $row->NAME;
    		
    		$i++;
    	}
		$arrRes ['subCategory'] = $Category->getSubCategoryLovWrtCategory($category['id']);


		
		echo json_encode ( $arrRes );
	}
	public function getSubCategoriesWrtCategory1(Request $request) {
		$Category = new CategoryModel();
		$Product = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$category = $details ['category'];

		// dd($category);
		$userId = $details ['userId'];
	
		if(!isset($category['id'])){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'First choose category...';
			echo json_encode ( $arrRes );
			die();
		}
	
		$arrRes ['subCategory'] = $Category->getSubCategoryBundleLovWrtCategory($category['id']);
	
		echo json_encode ( $arrRes );
	}
        public function getproductswrtsubcategory(Request $request){


			$Product = new ProductModel();

			$details = $_REQUEST ['details'];
			$subsubcategory = $details ['subcategory'];
			$userId = $details ['userId'];
	   
			if(!isset($subsubcategory['id'])){
			   $arrRes ['done'] = false;
			   $arrRes ['msg'] = 'First choose sub category...';
			   echo json_encode ( $arrRes );
			   die();
			} 

			$product_lov = DB::table('jb_product_tbl')->where('SUB_SUB_CATEGORY_ID',$subsubcategory['id'])->orderby('PRODUCT_ID', 'desc')->get();
			// $arrRes['product']=$product_lov;
			$i=0;
			foreach ($product_lov as $row){
				$arrRes['product'][$i]['id'] = $row->PRODUCT_ID;
				$arrRes['product'][$i]['name'] = $row->NAME;
				
				$i++;
			}
		
	
			 echo json_encode ( $arrRes );

		}

	public function getSubSubCategoriesWrtSubCategory(Request $request) {
		 $Category = new CategoryModel();
		 $Product = new ProductModel();
	
		 $details = $_REQUEST ['details'];
		 $subcategory = $details ['subcategory'];
		 $userId = $details ['userId'];
	
		 if(!isset($subcategory['id'])){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'First choose sub category...';
			echo json_encode ( $arrRes );
			die();
		 } 
		 $product_lov = DB::table('jb_product_tbl')->where('SUB_CATEGORY_ID',$subcategory['id'])->orderby('PRODUCT_ID', 'desc')->get();
		// $arrRes['product']=$product_lov;
		$i=0;
		foreach ($product_lov as $row){
    		$arrRes['product'][$i]['id'] = $row->PRODUCT_ID;
    		$arrRes['product'][$i]['name'] = $row->NAME;
    		
    		$i++;
    	}
	
		 $arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory($subcategory['id']);

		 echo json_encode ( $arrRes );
	}
	public function getIngredientsWrtCategory(Request $request) {
		$Ingredient = new IngredientModel();
	
		$details = $_REQUEST ['details'];
		$category = $details ['category'];
		$userId = $details ['userId'];
	
		if(!isset($category) && $category == ''){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'First choose category...';
			echo json_encode ( $arrRes );
			die();
		}
	
		$arrRes ['ingredients'] = $Ingredient->getIngredientslovWrtCategory($category);
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminProductBasicInfo(Request $request) {
		$Product = new ProductModel();
		$details = $_REQUEST ['details'];
		$data = $details ['product'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';


	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_2']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Sub Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_3']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if ($data ['P_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Minimum Purchase Qty is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if ($data ['P_5'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tags is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_5']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tags must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_6']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Barcode must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (!isset($data ['P_8']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose Category.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			// if (!isset($data ['P_9']['id'])) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Please choose Sub Category.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			// if (!isset($data ['P_44']['id'])) {
			// 	$arrRes ['done'] = false;
			// 	$arrRes ['msg'] = 'Please choose Sub Sub Category.';
			// 	echo json_encode ( $arrRes );
			// 	die ();
			// }
			if ($data['P_10'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Slug is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_10']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Slug must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_11']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Short Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_12']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}

			   if(isset($data['P_45'])){
				$feature_id='';
				$total=count($data['P_45']);
				for($k=0; $k< $total; $k++){
					$feature_id.=$data['P_45'][$k]['id'].',';
			 }
		 }      
                    
		 $handpicked= new Handpicked;
		$recommend= new Recomended;

		
		 
				
			if ($data ['ID'] == '') {
	
				$duplicate = $Product->checkDuplicateSlug($data['P_10']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Slug is already exist, try different...';
					echo json_encode ( $arrRes );
					die ();
				}
				
				$result = DB::table ( 'jb_product_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'NAME' => $data['P_1'],
								'SUB_TITLE' => $data['P_2'],
								'UNIT' => $data ['P_3'],
								'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
								'TAGS' => $data ['P_5'],
								'BARCODE' => $data ['P_6'],
								'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
								'CATEGORY_ID' => isset($data ['P_8']['id']) ? $data ['P_8']['id'] : '',
								'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
								'SUB_SUB_CATEGORY_ID' => isset($data ['P_44']['id']) ? $data ['P_44']['id'] : '',
								'SLUG' => $data ['P_10'],
								'SHORT_DESCRIPTION' => $data ['P_11'],
								'DESCRIPTION_TITLE' => $data ['P_12'],
								'DESCRIPTION' => base64_encode($data['P_13']),
								'STATUS' => 'inactive',
								'FEATURE_ID' => isset($feature_id) ? rtrim($feature_id,',') : '',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Created Successfully';
				$arrRes ['ID'] = $result;

                   	/*  Recommended products start */
					

		if(isset($data['P_46']) && $data['P_46'] != ''){

			$delete=$recommend->deleteRecomended($data['P_46'],$result);
				if($delete->original['status'] == false){
					$arrRes ['done'] = false;
					  $arrRes ['msg'] = $delete->original['message'];
				 echo json_encode ( $arrRes );
			  die ();
		  }

		$delete= $recommend->insertRecomended($data['P_46'],$userId,$result);
		if($delete->original['status'] == false){
		    	 $arrRes ['done'] = false;
					  $arrRes ['msg'] = $delete->original['message'];
				  echo json_encode ( $arrRes );
			  die ();
		  }
	  }
					  /*  Recommended products end */
 
			  /*  Hadnpicked products start */
 
		 if(isset($data['P_47']) && $data['P_47'] != ''){
 
		 $delete= $handpicked->deleteHandpicked($data['P_47'],$result);
		 if($delete->original['status'] == false){
			     $arrRes ['done'] = false;
				 $arrRes ['msg'] =  $delete->original['message'];
			    	echo json_encode ( $arrRes );
				die ();
	  }
		 $insert= $handpicked->insertHandpicked($data['P_47'],$userId,$result);
		 if($delete->original['status'] == false){
			     $arrRes ['done'] = false;
				 $arrRes ['msg'] =  $delete->original['message'];
				 echo json_encode ( $arrRes );
				 die ();
	   }
 
		 }
					  /*  Hadnpicked products end */

				echo json_encode ( $arrRes );
				die ();
	
			} else {
				
				$duplicate = $Product->checkDuplicateSlug($data['P_10'], $data ['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Slug is already exist, try different...';
					echo json_encode ( $arrRes );
					die ();
				}
				
				$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $data ['ID'] ) ->update (
						array ( 'NAME' => $data['P_1'],
								'SUB_TITLE' => $data['P_2'],
								'UNIT' => $data ['P_3'],
								'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
								'TAGS' => $data ['P_5'],
								'BARCODE' => $data ['P_6'],
								'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
								'CATEGORY_ID' => isset($data ['P_8']['id']) ? $data ['P_8']['id'] : '',
								'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
								'SUB_SUB_CATEGORY_ID' => isset($data ['P_44']['id']) ? $data ['P_44']['id'] : '',
								'SLUG' => $data ['P_10'],
								'FEATURE_ID' =>  isset($feature_id) ? rtrim($feature_id,',') : '', 
								'SHORT_DESCRIPTION' => $data ['P_11'],
								'DESCRIPTION_TITLE' => $data ['P_12'],
								'DESCRIPTION' => base64_encode($data['P_13']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
              
				 	/*  Recommended products start */

		if( isset($data['P_46']) && $data['P_46'] != ''){
             

			$delete=$recommend->deleteRecomended($data['P_46'],$data ['ID']);
	  if($delete->original['status'] == false){
						 $arrRes ['done'] = false;
					  $arrRes ['msg'] = $delete->original['message'];
				 echo json_encode ( $arrRes );
			  die ();
		  }

		$delete=  $recommend->insertRecomended($data['P_46'],$userId,$data ['ID']);
			 if($delete->original['status'] == false){
						  $arrRes ['done'] = false;
					  $arrRes ['msg'] = $delete->original['message'];
				  echo json_encode ( $arrRes );
			  die ();
		  }
	  }
					  /*  Recommended products end */
 
			  /*  Hadnpicked products start */
 
		 if(isset($data['P_47']) && $data['P_47'] != ''){
 
		 $delete= $handpicked->deleteHandpicked($data['P_47'],$data ['ID']);
		 if($delete->original['status'] == false){
			$arrRes ['done'] = false;
				 $arrRes ['msg'] =  $delete->original['message'];
				echo json_encode ( $arrRes );
				die ();
	  }
		 $insert= $handpicked->insertHandpicked($data['P_47'],$userId,$data ['ID']);
		 if($delete->original['status'] == false){
			$arrRes ['done'] = false;
				 $arrRes ['msg'] =  $delete->original['message'];
				 echo json_encode ( $arrRes );
				 die ();
	   }
 
		 }
					  /*  Hadnpicked products end */


				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminProduct(Request $request) {
	
		$Category = new CategoryModel();
		$Product = new ProductModel();
		$ProductIngredient = new ProductIngredientModel();
		$ProductShade = new ProductShadeModel();
		$ProductUses = new ProductUsesModel();
		
		
		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];		
	
		$arrRes ['details'] = $Product->getSpecificProductData($productId);
		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'PRODUCT_IMG');
		$arrRes ['clinicalNoteImages'] = $Product->getSpecificProductImagesByCode($productId, 'CLINICAL_NOTE');
		$arrRes ['video'] = $Product->getSpecificProductVideo($productId);
		$arrRes ['ingredients'] = $ProductIngredient->getAllProductIngredientByProduct($productId);
		$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($productId);
		$arrRes ['productUses'] = $ProductUses->getAllProductUsesByProduct($productId);
		$arrRes ['subCategory'] = $Category->getSubCategoryLovWrtCategory($arrRes ['details']['P_8']);
		$arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory($arrRes ['details']['P_9']);

		echo json_encode ( $arrRes );
	}
	
	public function saveAdminProductVideoDetails(Request $request) {
		$Product = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$prod = $details ['product'];
		$data = $details ['video'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['V_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['V_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['V_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			
	
			if ($data ['ID'] == '') {
	
					$result = DB::table ( 'jb_product_video_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'PRODUCT_ID' => $prod['ID'],
								'VIDEO_TITLE' => $data['V_1'],
								'VIDEO_DESCRIPTION' => $data['V_2'] != '' ? base64_encode($data['V_2']) : '',
							
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Saved Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_product_video_tbl' ) ->where ( 'VIDEO_ID', $data ['ID'] ) ->update (
						array ( 'VIDEO_TITLE' => $data['V_1'],
								'VIDEO_DESCRIPTION' => $data['V_2'] != '' ? base64_encode($data['V_2']) : '',
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function markPrimaryProdImage(Request $request) {
		$Product = new ProductModel();
	
		$details = $_REQUEST ['details'];
		
		$imageId = $details ['imageId'];
		$flag = $details ['flag'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];
		

		if($flag == 1){

			DB::table('jb_product_images_tbl')
				->where ( 'PRODUCT_ID', $productId )
				->where ( 'SOURCE_CODE', 'PRODUCT_IMG' )
				->update (
					array ( 'PRIMARY_FLAG' => '0')
				);
			// dd($checkprimaryflag);
			// DB::table ( 'jb_product_images_tbl' ) 
			// ->where ( 'SOURCE_CODE', 'PRODUCT_IMG' ) 
			// ->update (array ( 'PRIMARY_FLAG' => '0'));
	
			$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);

			$arrRes ['msg'] = 'Product image marked primary successfully...';

		}else{

			DB::table ( 'jb_product_images_tbl' ) 
			->where ( 'PRODUCT_ID', $productId )
			->where ( 'SOURCE_CODE', 'PRODUCT_IMG' )
			->update (
				array ( 'SECONDARY_FLAG' => '0')
				);
	
			$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
					array ( 'SECONDARY_FLAG' => '1',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
			$arrRes ['msg'] = 'Product image marked Secondary successfully...';
		}
		
	
		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'PRODUCT_IMG');
		$arrRes ['done'] = true;
		
	
		echo json_encode ( $arrRes );
	}
	public function markPrimaryClinicalNoteImage(Request $request) {
		$Product = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];
	
		DB::table ( 'jb_product_images_tbl' ) ->where ( 'PRODUCT_ID', $productId )->where ( 'SOURCE_CODE', 'CLINICAL_NOTE' ) ->update (
				array ( 'PRIMARY_FLAG' => '0')
				);
	
		$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
				array ( 'PRIMARY_FLAG' => '1',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
	
		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'CLINICAL_NOTE');
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Image marked primary successfully...';
	
		echo json_encode ( $arrRes );
	}
	public function deleteProductImage(Request $request) {
		$Product = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];
	
		$attDetail = $Product->getSpecificImage($imageId);
	
		$delete = DB::table ( 'jb_product_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();
	
		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}
	
		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'PRODUCT_IMG');
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	public function deleteClinicalNoteImage(Request $request) {
		$Product = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$userId = $details ['userId'];
	
		$attDetail = $Product->getSpecificImage($imageId);
	
		$delete = DB::table ( 'jb_product_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();
	
		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}
	
		$arrRes ['images'] = $Product->getSpecificProductImagesByCode($productId, 'CLINICAL_NOTE');
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminProductPricingVat(Request $request) {
		$Product = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['product'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_14'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit Price is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_14'] <= 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit Price must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_15'] != '' && $data['P_16'] != '') {
				
				if ($data['P_15'] > $data['P_16']) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Discount end date must be greater then Discount start date.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data['P_17'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_17'] <= 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}	
			if ($data['P_18'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount type is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_18'] != '' && $data['P_18'] == 'Percent') {
				if($data['P_17'] < 0 || $data['P_17'] > 100){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Discount must be in between 0 to 100.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data['P_20'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Quantity is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_20'] <= 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Quantity must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_21']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'SKU must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_22']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'External link must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_23']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'External link text must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if ($data['P_24'] != '' && $data['P_24'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tax must be greater then or equal to zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_24'] > 0 && $data['P_25'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tax type is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_25'] != '' && $data['P_25'] == 'Percent') {
				if($data['P_24'] < 0 || $data['P_24'] > 100){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Tax must be in between 0 to 100.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data['P_26'] != '' && $data['P_26'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'VAT must be greater then or equal to zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_26'] > 0 && $data['P_27'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'VAT type is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_27'] != '' && $data['P_27'] == 'Percent') {
				if($data['P_26'] < 0 || $data['P_26'] > 100){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'VAT must be in between 0 to 100.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			
			if ($data ['ID'] == '') {
	
				
			} else {
	
				$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $data ['ID'] ) ->update (
						array ( 'UNIT_PRICE' => $data['P_14'],
								'DISCOUNT_START_DATE' => $data['P_15'],
								'DISCOUNT_END_DATE' => $data['P_16'],
								'DISCOUNT' => $data['P_17'],
								'DISCOUNT_TYPE' => $data['P_18'],
								'SET_POINT' => $data['P_19'],
								'QUANTITY' => $data['P_20'],
								'SKU' => $data['P_21'],
								'EXTERNAL_LINK' => $data['P_22'],
								'EXTERNAL_LINK_TEXT' => $data['P_23'],
								'TAX' => $data['P_24'],
								'TAX_TYPE' => $data['P_25'],
								'VAT' => $data['P_26'],
								'VAT_TYPE' => $data['P_27'],
								
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Pricing Added Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function saveAdminProductIngredient(Request $request) {
		$Ingredient = new ProductIngredientModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['ingredient'];
		$prod = $details ['product'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['I_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Ingredient Category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (!isset($data['I_2']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Ingredient first.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			$existCheck = $Ingredient->checkIngredientExistingCheckWrtproductId(isset($data['I_2']['id']) ? $data['I_2']['id'] : '',$prod['ID']);
			
			if($existCheck == true){
				
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Ingredient already added in product.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if ($data ['ID'] == '') {
				
				$result = DB::table ( 'jb_product_ingredient_tbl' )->insertGetId (
						array ( 'PRODUCT_ID' => $prod['ID'],
								'INGREDIENT_CATEGORY' => $data['I_1'],
								'INGREDIENT_ID' => isset($data['I_2']['id']) ? $data['I_2']['id'] : '',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ingredient Added Successfully';
				$arrRes ['ingredients'] = $Ingredient->getAllProductIngredientByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
				
			} else {
	
				$result = DB::table ( 'jb_product_ingredient_tbl' ) ->where ( 'PRODUCT_INGREDIENT_ID', $data ['ID'] ) ->update (
						array ( 'INGREDIENT_CATEGORY' => $data['I_1'],
								'INGREDIENT_ID' => isset($data['I_2']['id']) ? $data['I_2']['id'] : '',
	
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ingredient Updated Successfully';
				$arrRes ['ingredients'] = $Ingredient->getAllProductIngredientByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function deleteProductingredient(Request $request) {
		$Ingredient = new ProductIngredientModel();
	
		$details = $_REQUEST ['details'];
		$ingredientId = $details ['ingredientId'];
		$productId = $details['productId'];
		$userId = $details ['userId'];
	
		$delete = DB::table ( 'jb_product_ingredient_tbl' )->where ( 'PRODUCT_INGREDIENT_ID', $ingredientId )->delete ();
		
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Ingredient deleted successfully...';
		$arrRes ['ingredients'] = $Ingredient->getAllProductIngredientByProduct($productId);
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminProductShade(Request $request) {
		$ProductShade = new ProductShadeModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['shade'];
		$prod = $details ['product'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if (!isset($data['S_1']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Shade first.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if($data['S_2'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Inv. Quantity is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($data['S_2'] <= 0){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Inv. Quantity must be greater then Zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			
			
			if ($data ['ID'] == '') {
				
				$existCheck = $ProductShade->checkShadeExistCheckWrtProductId(isset($data['S_1']['id']) ? $data['S_1']['id'] : '',$prod['ID']);
				
				if ($existCheck == true) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Shade already added in product.';
					echo json_encode ( $arrRes );
					die ();
				}
				
				$result = DB::table ( 'jb_product_shades_tbl' )->insertGetId (
						array ( 'PRODUCT_ID' => $prod['ID'],
								'SHADE_ID' => isset($data['S_1']['id']) ? $data['S_1']['id'] : '',
								'QUANTITY' => isset($data['S_2']) ? $data['S_2'] : '',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shade Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
				
			} else {
	
				$existCheck = $ProductShade->checkShadeExistCheckWrtProductId(isset($data['S_1']['id']) ? $data['S_1']['id'] : '',$prod['ID'],$data ['ID']);
				
				if ($existCheck == true) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Shade already added in product.';
					echo json_encode ( $arrRes );
					die ();
				}
				
				$result = DB::table ( 'jb_product_shades_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $data ['ID'] ) ->update (
						array ( 'SHADE_ID' => isset($data['S_1']['id']) ? $data['S_1']['id'] : '',
								'QUANTITY' => isset($data['S_2']) ? $data['S_2'] : '',
								
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shade Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editProductShade(Request $request) {
		
		$ProductShade = new ProductShadeModel();
	
		$details = $_REQUEST ['details'];
		$productShadeId = $details ['shadeId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $ProductShade->getSpecificProductShade($productShadeId);
		$arrRes ['images'] = $ProductShade->getProductShadeImages($productShadeId);
	
		echo json_encode ( $arrRes );
	}
	
	public function markProductShadeImage(Request $request) {
		$ProductShade = new ProductShadeModel();
	
		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$productShadeId = $details ['shadeId'];
		$flag = $details ['flag'];
		$userId = $details ['userId'];
		
		if($flag == '1'){
			
			DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $productShadeId ) ->update (
					array ( 'PRIMARY_FLAG' => '0')
				);
			
			$result = DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
					array ( 'PRIMARY_FLAG' => '1',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
				);
			
			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Image marked primary successfully...';
		
		} else if($flag == '2'){
			
			DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'PRODUCT_SHADE_ID', $productShadeId ) ->update (
					array ( 'SECONDARY_FLAG' => '0')
					);
				
			$result = DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'IMAGE_ID', $imageId ) ->update (
					array ( 'SECONDARY_FLAG' => '1',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
				
			
			$arrRes ['msg'] = 'Image marked Secondary successfully...';
			
		}
		
		$arrRes ['done'] = true;
		$arrRes ['images'] = $ProductShade->getProductShadeImages($productShadeId);
		
	
		echo json_encode ( $arrRes );
	}
	public function deleteProductShadeImage(Request $request) {
		$ProductShade = new ProductShadeModel();
	
		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$productId = $details ['productId'];
		$productShadeId = $details ['productShadeId'];
		$userId = $details ['userId'];
	
		$attDetail = $ProductShade->getSpecificProductShadeImage($imageId);
	
		$delete = DB::table ( 'jb_product_shade_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();
	
		if(isset($attDetail['path']) && $attDetail['path'] != '' ){
			
			unlink($attDetail['path']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product Shade Image deleted successfully...';
		$arrRes ['images'] = $ProductShade->getProductShadeImages($productShadeId);
		
		echo json_encode ( $arrRes );
	}
	
	public function deleteProductShade(Request $request) {
		$ProductShade = new ProductShadeModel();
	
		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$productShadeId = $details ['productShadeId'];
		$userId = $details ['userId'];
	
		$attDetail = $ProductShade->getProductShadeImages($productShadeId);
	
		$delete = DB::table ( 'jb_product_shades_tbl' )->where ( 'PRODUCT_SHADE_ID', $productShadeId )->delete ();
		$delete = DB::table ( 'jb_product_shade_images_tbl' )->where ( 'PRODUCT_SHADE_ID', $productShadeId )->delete ();
	
		if(isset($attDetail) && !empty($attDetail) ){
			foreach($attDetail as $value){
				unlink($value['path']);
			}
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product Shade deleted successfully...';
		$arrRes ['shades'] = $ProductShade->getAllProductShadesByProduct($productId);
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminProductUses(Request $request) {
		$ProductUses = new ProductUsesModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['uses'];
		$prod = $details ['product'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['U_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Sequence Number is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['U_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['U_2']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['U_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['U_4']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
				
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_product_uses_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'PRODUCT_ID' => $prod['ID'],
								'SEQUENCE_NUM' => $data['U_1'],
								'USES_TITLE' => $data['U_2'],
								'USES_DESCRIPTION' => $data['U_4'],
								
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Uses Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_product_uses_tbl' ) ->where ( 'PRODUCT_USES_ID', $data ['ID'] ) ->update (
						array ( 'SEQUENCE_NUM' => $data['U_1'],
								'USES_TITLE' => $data['U_2'],
								'USES_DESCRIPTION' => $data['U_4'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Product Uses Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($prod['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function editProductUses(Request $request) {
	
		$ProductUses = new ProductUsesModel();
	
		$details = $_REQUEST ['details'];
		$productUsesId = $details ['productUsesId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $ProductUses->getSpecificProductUses($productUsesId);
		
		echo json_encode ( $arrRes );
	}
	public function deleteProductUses(Request $request) {
		$ProductUses = new ProductUsesModel();
	
		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$productUsesId = $details ['productUsesId'];
		$userId = $details ['userId'];
	
		$attDetail = $ProductUses->getSpecificProductUsesImage($productUsesId);
	
		$delete = DB::table ( 'jb_product_uses_tbl' )->where ( 'PRODUCT_USES_ID', $productUsesId )->delete ();
		
		if(isset($attDetail['path']) && $attDetail['path'] != '' ){
			unlink($attDetail['path']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product Uses deleted successfully...';
		$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($productId);
	
		echo json_encode ( $arrRes );
	}
	public function deleteProductUsesImage(Request $request) {
		$ProductUses = new ProductUsesModel();
	
		$details = $_REQUEST ['details'];
		$productId = $details ['productId'];
		$productUsesId = $details ['productUsesId'];
		$userId = $details ['userId'];
	
		$attDetail = $ProductUses->getSpecificProductUsesImage($productUsesId);
	
		$result = DB::table ( 'jb_product_uses_tbl' ) ->where ( 'PRODUCT_USES_ID', $productUsesId ) ->update (
							array ( 'PATH' => '',
									'DOWN_PATH' => '',
									'FILE_TYPE' => '',
									'FILE_NAME' => '',
									'FULL_NAME' => ''									
							)
						);
	
		if(isset($attDetail['path']) && $attDetail['path'] != '' ){
			unlink($attDetail['path']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product Uses Image deleted successfully...';
		$arrRes ['productuses'] = $ProductUses->getAllProductUsesByProduct($productId);
	
		echo json_encode ( $arrRes );
	}
	
	
	public function saveAdminProductOtherInfo(Request $request) {
		$Product = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['product'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_34'] != '' && $data['P_34'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Shipping Days must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_37'] != '' && $data['P_37'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_38'] != '' && $data['P_38'] == 'Percent') {
				if ($data['P_37'] < 0 || $data['P_37'] > 100) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Discount must be in between 0 to 100.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data['P_42'] != '' && $data['P_42'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Low Quantity Warning must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
			
				
			if ($data ['ID'] == '') {
	
			} else {
	
				$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $data ['ID'] ) ->update (
						array ( 'FREE_SHIPPING_FLAG' => $data ['P_28'] == 'true' ? '1' : '0',
								'PRODUCT_QUANTITY_MULTIPLY_FLAG' => $data ['P_29'] == 'true' ? '1' : '0',
								'FLAT_RATE_FLAG' => $data ['P_30'] == 'true' ? '1' : '0',
								'SHOW_STOCK_QUANTITY_FLAG' => $data ['P_31'] == 'true' ? '1' : '0',
								'SHOW_STOCK_TEXT_FLAG' => $data ['P_32'] == 'true' ? '1' : '0',
								'HIDE_STOCK_FLAG' => $data ['P_33'] == 'true' ? '1' : '0',
								
								'SHIPPING_DAYS' => $data ['P_34'] != '' ? $data ['P_34'] : '0',
								'TODAY_DEAL_FLAG' => $data ['P_35'] == 'true' ? '1' : '0',
								
								'ADD_TO_FLASH' => $data ['P_36'],
								'OTHER_DISCOUNT' => $data ['P_37'] != '' ? $data ['P_37'] : '0',
								'OTHER_DISCOUNT_TYPE' => $data ['P_38'],
								
								'CASH_ON_DELIVER_FLAG' => $data ['P_39'] == 'true' ? '1' : '0',
								'FEATURED_FLAG' => $data ['P_40'] == 'true' ? '1' : '0',
								'TODAY_DEAL_FLAG2' => $data ['P_41'] == 'true' ? '1' : '0',
								'LOW_QUANTITY_WARNING' => $data ['P_42'] != '' ? $data ['P_42'] : '0',
	
								'CLINICAL_NOTE_DESCRIPTION' => $data['P_43'] != '' ? base64_encode($data['P_43']) : '',
								
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Other Information Added Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	/*===================== admin Product code end ==========================*/
	
	/*===================== admin Shade Finder code start ==========================*/
	
	public function getAllAdminShadeFinderlov(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
		$Product = new ProductModel();
		
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$optionId = $details ['optionId'];
		
		$arrRes ['list1'] = $Product->getProductsLov();
		$arrRes ['optionDetail'] = $ShadeFinder->getSpecificShadeFinderOptionData($optionId);
		$level1Detail = $ShadeFinder->getSpecificShadeFinderLevel1Data($optionId);
		$arrRes ['level1Detail'] = $level1Detail;
		
		if(isset($level1Detail['ID'])){
			$arrRes ['level1TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel1TypesByLevel1Id($level1Detail['ID']);
		}else{
			$arrRes ['level1TypeListing'] = '';
		}
		
		$level2Detail = $ShadeFinder->getSpecificShadeFinderLevel2Data($optionId);
		$arrRes ['level2Detail'] = $level2Detail;
		
		if(isset($level2Detail['ID'])){
			$arrRes ['level2TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel2TypesByLevel2Id($level2Detail['ID']);
		}else{
			$arrRes ['level2TypeListing'] = '';
		}
		
		$level3Detail = $ShadeFinder->getSpecificShadeFinderLevel3Data($optionId);
		$arrRes ['level3Detail'] = $level3Detail;
		
		if(isset($level3Detail['ID'])){
			$arrRes ['level3TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel3TypesByLevel3Id($level3Detail['ID']);
		}else{
			$arrRes ['level3TypeListing'] = '';
		}
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminShadeFinderOptionInfo(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['option'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_1']) > 50) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 50 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Caption is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_2']) > 50) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Caption must be less then 50 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data ['ID'] == '') {
				
			} else {
	
				$result = DB::table ( 'jb_shade_finder_options_tbl' ) ->where ( 'OPTION_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['P_1'],
								'CAPTION' => $data['P_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Option Detail Updated Successfully';
// 				$arrRes ['ID'] = $data ['ID'];
// 				$arrRes ['optionDetail'] = $ShadeFinder->getSpecificShadeFinderOptionData($data ['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function saveAdminShadeFinderLevel1Info(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$data = $details ['level1'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['L_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['L_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if (strlen($data['L_2']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data ['ID'] == '') {
				
				$result = DB::table ( 'jb_shade_finder_level_one_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'OPTION_ID' => $option['ID'],
								'TITLE' => $data['L_1'],
								'DESCRITION' => $data['L_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',
								
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level One Info Added Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
				
			} else {
	
				$result = DB::table ( 'jb_shade_finder_level_one_tbl' ) ->where ( 'LEVEL_ONE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['L_1'],
								'DESCRITION' => $data['L_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level One Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function saveAdminShadeFinderLevel1TypeInfo(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$level1 = $details ['level1'];
		$data = $details ['level1Type'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
			
			$primaryProdIds = '';
			if( isset($data['LT_2'][0]) && !empty($data['LT_2'])){
				$productIds  = $data['LT_2'];
				
				foreach ($productIds  as $value){
					if($primaryProdIds == ''){
						$primaryProdIds = $value['id'];
					}else{
						$primaryProdIds = $primaryProdIds.','.$value['id'];
					}
				}
			}
			
			$recommandedProdIds = '';
			if( isset($data['LT_3'][0]) && !empty($data['LT_3'])){
				$productIds1  = $data['LT_3'];
			
				foreach ($productIds1  as $value){
					if($recommandedProdIds == ''){
						$recommandedProdIds = $value['id'];
					}else{
						$recommandedProdIds = $recommandedProdIds.','.$value['id'];
					}
				}
			}
			
			if ($data['LT_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['LT_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if($option['P_1'] == 'Yes'){
				if($primaryProdIds == ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Kindly choose Primary Product first.';
					echo json_encode ( $arrRes );
					die ();
				}
				if($recommandedProdIds == ''){
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Kindly choose Recommanded Product first.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			
			if ($data ['ID'] == '') {
				
				$duplicate = $ShadeFinder->checkDuplicatelevelTypeWrtlevelID($data['LT_1'],$level1['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist, try different...';
					echo json_encode ( $arrRes );
					die ();
				}
				
				$result = DB::table ( 'jb_shade_finder_level_one_type_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'LEVEL_ONE_ID' => $level1['ID'],
								'TITLE' => $data['LT_1'],
								'DESCRIPTION' => base64_encode($data['LT_4']),
								'PRIMARY_PRODUCT_IDS' => $primaryProdIds,
								'RECOMMANDED_PRODUCT_IDS' => $recommandedProdIds,
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',
	
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level One Type Info Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['level1TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel1TypesByLevel1Id($level1['ID']);
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$duplicate = $ShadeFinder->checkDuplicatelevelTypeWrtlevelID($data['LT_1'],$level1['ID'], $data ['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist, try different...';
					echo json_encode ( $arrRes );
					die ();
				}
				
				$result = DB::table ( 'jb_shade_finder_level_one_type_tbl' ) ->where ( 'LEVEL_ONE_TYPE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['LT_1'],
								'DESCRIPTION' => base64_encode($data['LT_4']),
								'PRIMARY_PRODUCT_IDS' => $primaryProdIds,
								'RECOMMANDED_PRODUCT_IDS' => $recommandedProdIds,
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level One Type Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['level1TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel1TypesByLevel1Id($level1['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function editAdminShadeFinderLevel1Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$level1TypeId = $details ['recordId'];
	
		$arrRes ['details'] = $ShadeFinder->getSpecificShadeFinderLevel1TypeDetails($level1TypeId);
		$arrRes ['images'] = $ShadeFinder->getSpecificShadeFinderLevel1TypeImages($level1TypeId);
	
		echo json_encode ( $arrRes );
	}
	public function deleteShadeFinderLevel1Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$level1ID = $details ['level1ID'];
		$userId = $details ['userId'];
	
		$check = $ShadeFinder->checklevel1TypeUsed($recordId);
		if($check == ''){
			
			$attDetail = $ShadeFinder->getSpecificShadeFinderLevel1TypeImages($recordId);
			
			$delete = DB::table ( 'jb_shade_finder_level_one_type_tbl' )->where ( 'LEVEL_ONE_TYPE_ID', $recordId )->delete ();
			$delete = DB::table ( 'jb_shade_finder_images_tbl' )->where ( 'LEVEL_ONE_TYPE_ID', $recordId )->delete ();
			
			if(isset($attDetail) && !empty($attDetail)){
				foreach ($attDetail as $value){
					unlink($value['path']);
				}
			}
			
			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Type deleted successfully...';
			$arrRes ['level1TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel1TypesByLevel1Id($level1ID);
		}else{
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Type is already used in level three, kindly remove this from level 3 then proceed.';
		}
		
		echo json_encode ( $arrRes );
	}
	public function deleteLevel1TypeImage(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$imageId = $details ['imageId'];
		$level1TypeId = $details ['level1TypeId'];
		$userId = $details ['userId'];
	
		$attDetail = $ShadeFinder->getSpecificLevel1TypeImage($imageId);
	
		$delete = DB::table ( 'jb_shade_finder_images_tbl' )->where ( 'IMAGE_ID', $imageId )->delete ();
		
		if(isset($attDetail['path']) && $attDetail['path'] != '' ){
			unlink($attDetail['path']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Type Image deleted successfully...';
		$arrRes ['images'] = $ShadeFinder->getSpecificShadeFinderLevel1TypeImages($level1TypeId);
	
		echo json_encode ( $arrRes );
	}
	
	
	
	public function saveAdminShadeFinderLevel2Info(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$data = $details ['level2'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['L_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['L_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
				
			if (strlen($data['L_2']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_shade_finder_level_two_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'OPTION_ID' => $option['ID'],
								'TITLE' => $data['L_1'],
								'DESCRIPTION' => $data['L_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',
	
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Two Info Added Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_shade_finder_level_two_tbl' ) ->where ( 'LEVEL_TWO_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['L_1'],
								'DESCRIPTION' => $data['L_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Two Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function getLevel1TypeLovForLevel2Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$level1Id = $details ['level1Id'];
		$userId = $details ['userId'];
	
		
		$arrRes ['level1TypeLov'] = $ShadeFinder->getShadeFinderLevel1TypesLov($level1Id);
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminShadeFinderLevel2TypeInfo(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$level2 = $details ['level2'];
		$data = $details ['level2Type'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
				
			
				
			if ($data['LT_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['LT_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (!isset($data['LT_2']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Level One Type first, then proceed.';
				echo json_encode ( $arrRes );
				die ();
			}
				
			
				
			if ($data ['ID'] == '') {
	
				$duplicate = $ShadeFinder->checkDuplicatelevel2TypeWrtlevel2ID($data['LT_1'],$level2['ID'],$data['LT_2']['id']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist against this level one type, try different...';
					echo json_encode ( $arrRes );
					die ();
				}
	
				$result = DB::table ( 'jb_shade_finder_level_two_type_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'LEVEL_TWO_ID' => $level2['ID'],
								'TITLE' => $data['LT_1'],
								'LEVEL_ONE_TYPE_ID' => isset($data['LT_2']['id']) ? $data['LT_2']['id'] : '',
								'DESCRIPTION' => base64_encode($data['LT_3']),
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',
	
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Two Type Info Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['level2TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel2TypesByLevel2Id($level2['ID']);
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$duplicate = $ShadeFinder->checkDuplicatelevel2TypeWrtlevel2ID($data['LT_1'],$level2['ID'],$data['LT_2']['id'],$data['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist against this level one type, try different...';
					echo json_encode ( $arrRes );
					die ();
				}
	
				$result = DB::table ( 'jb_shade_finder_level_two_type_tbl' ) ->where ( 'LEVEL_TWO_TYPE_ID', $data ['ID'] ) ->update (
						array ( 'LEVEL_TWO_ID' => $level2['ID'],
								'TITLE' => $data['LT_1'],
								'LEVEL_ONE_TYPE_ID' => isset($data['LT_2']['id']) ? $data['LT_2']['id'] : '',
								'DESCRIPTION' => base64_encode($data['LT_3']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Two Type Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['level2TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel2TypesByLevel2Id($level2['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function editAdminShadeFinderLevel2Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$level2TypeId = $details ['recordId'];
		$level1Id = $details ['level1Id'];
	
		$arrRes ['level1TypeLov'] = $ShadeFinder->getShadeFinderLevel1TypesLov($level1Id);
		$arrRes ['details'] = $ShadeFinder->getSpecificShadeFinderLevel2TypeDetails($level2TypeId);
	
		echo json_encode ( $arrRes );
	}
	public function deleteShadeFinderLevel2Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$level2ID = $details ['level2ID'];
		$userId = $details ['userId'];
		
		$check = $ShadeFinder->checklevel2TypeUsed($recordId);
		if($check == ''){
			
			$delete = DB::table ( 'jb_shade_finder_level_two_type_tbl' )->where ( 'LEVEL_TWO_TYPE_ID', $recordId )->delete ();
			
			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Type deleted successfully...';
			$arrRes ['level2TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel2TypesByLevel2Id($level2ID);
		}else{
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Type is already used in level three, kindly remove this from level 3 then proceed.';
		}
	
		echo json_encode ( $arrRes );
	}
	
	
	
	public function saveAdminShadeFinderLevel3Info(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$data = $details ['level3'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['L_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['L_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title Question must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if (strlen($data['L_2']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_shade_finder_level_three_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'OPTION_ID' => $option['ID'],
								'TITLE' => $data['L_1'],
								'DESCRIPTION' => $data['L_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',
	
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Three Info Added Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_shade_finder_level_three_tbl' ) ->where ( 'LEVEL_THREE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['L_1'],
								'DESCRIPTION' => $data['L_2'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Three Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function getLevel2TypeLovForLevel3Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$level2Id = $details ['level2Id'];
		$userId = $details ['userId'];
	
	
		$arrRes ['level2TypeLov'] = $ShadeFinder->getShadeFinderLevel2TypesLov($level2Id);
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminShadeFinderLevel3TypeInfo(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$option = $details ['option'];
		$level3 = $details ['level3'];
		$data = $details ['level3Type'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			$primaryProdIds = '';
			if( isset($data['LT_3'][0]) && !empty($data['LT_3'])){
				$productIds  = $data['LT_3'];
			
				foreach ($productIds  as $value){
					if($primaryProdIds == ''){
						$primaryProdIds = $value['id'];
					}else{
						$primaryProdIds = $primaryProdIds.','.$value['id'];
					}
				}
			}
			
			$recommandedProdIds = '';
			if( isset($data['LT_4'][0]) && !empty($data['LT_4'])){
				$productIds1  = $data['LT_4'];
					
				foreach ($productIds1  as $value){
					if($recommandedProdIds == ''){
						$recommandedProdIds = $value['id'];
					}else{
						$recommandedProdIds = $recommandedProdIds.','.$value['id'];
					}
				}
			}
				
			if ($data['LT_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['LT_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (!isset($data['LT_2']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Level Two Type first, then proceed.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			
			if($primaryProdIds == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Kindly choose Primary Product first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($recommandedProdIds == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Kindly choose Recommanded Product first.';
				echo json_encode ( $arrRes );
				die ();
			}
				
	
			if ($data ['ID'] == '') {
	
				$duplicate = $ShadeFinder->checkDuplicatelevel3TypeWrtlevel3ID($data['LT_1'],$level3['ID'],$data['LT_2']['id']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist against this level Two type, try different...';
					echo json_encode ( $arrRes );
					die ();
				}
	
				$result = DB::table ( 'jb_shade_finder_level_three_type_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'LEVEL_THREE_ID' => $level3['ID'],
								'TITLE' => $data['LT_1'],
								'LEVEL_TWO_TYPE_ID' => isset($data['LT_2']['id']) ? $data['LT_2']['id'] : '',
								'PRIMARY_PRODUCT_IDS' => $primaryProdIds,
								'RECOMMANDED_PRODUCT_IDS' => $recommandedProdIds,
								'DESCRIPTION' => base64_encode($data['LT_5']),
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'STATUS' => 'active',
	
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Three Type Info Added Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['level3TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel3TypesByLevel3Id($level3['ID']);
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$duplicate = $ShadeFinder->checkDuplicatelevel3TypeWrtlevel3ID($data['LT_1'],$level3['ID'],$data['LT_2']['id'],$data['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Type is already exist against this level one type, try different...';
					echo json_encode ( $arrRes );
					die ();
				}
	
				$result = DB::table ( 'jb_shade_finder_level_three_type_tbl' ) ->where ( 'LEVEL_THREE_TYPE_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['LT_1'],
								'LEVEL_TWO_TYPE_ID' => isset($data['LT_2']['id']) ? $data['LT_2']['id'] : '',
								'PRIMARY_PRODUCT_IDS' => $primaryProdIds,
								'RECOMMANDED_PRODUCT_IDS' => $recommandedProdIds,
								'DESCRIPTION' => base64_encode($data['LT_5']),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Level Three Type Info Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['level3TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel3TypesByLevel3Id($level3['ID']);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminShadeFinderLevel3Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$level3TypeId = $details ['recordId'];
		$level2Id = $details ['level2Id'];
	
		$arrRes ['level2TypeLov'] = $ShadeFinder->getShadeFinderLevel2TypesLov($level2Id);
		$arrRes ['details'] = $ShadeFinder->getSpecificShadeFinderLevel3TypeDetails($level3TypeId);
	
		echo json_encode ( $arrRes );
	}
	public function deleteShadeFinderLevel3Type(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$level3ID = $details ['level3ID'];
		$userId = $details ['userId'];
	
		$delete = DB::table ( 'jb_shade_finder_level_three_type_tbl' )->where ( 'LEVEL_THREE_TYPE_ID', $recordId )->delete ();
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Type deleted successfully...';
		$arrRes ['level3TypeListing'] = $ShadeFinder->getSpecificShadeFinderLevel3TypesByLevel3Id($level3ID);
	
		echo json_encode ( $arrRes );
	}
	/*===================== admin Shade Finder code end ==========================*/
	
	/*==================== admin Orders code start ==========================*/
	
	public function getAllAdminOrderslov() {
		$OrderModel = new OrderModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		
		$arrRes ['list'] = $OrderModel->getAllPlacedOrderData();
	
		echo json_encode ( $arrRes );
	}
	
	public function getSpecificOrderDetails() {
		$OrderModel = new OrderModel();
		$OrderDetailModel = new OrderDetailModel();
		$OrderShippingModel = new OrderShippingModel();
		$OrderPaymentModel = new OrderPaymentModel();
		$OrderShipmentModel = new OrderShipmentModel();
		$OrderShipmentTrackingModel = new OrderShippingTrackingModel();
		
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$orderId = $details ['orderId'];
	
		$arrRes ['order'] = $OrderModel->fetchSpecificOrderDetails($orderId);
		$arrRes ['details'] = $OrderDetailModel->getAllSpecificOrderData($orderId);
		$arrRes ['shipping'] = $OrderShippingModel->getAllSpecificOrderShippingData($orderId);
		$arrRes ['payment'] = $OrderPaymentModel->getAllSpecificOrderPaymentData($orderId);
		$arrRes ['shipment'] = $OrderShipmentModel->getAllSpecificOrderShipmentData($orderId);
		$arrRes ['tracking'] = $OrderShipmentTrackingModel->getAllTrackingByOrder($orderId);
		
		echo json_encode ( $arrRes );
	}
	
	public function orderStatusShipmentConfirm(Request $request) {
		$OrderModel = new OrderModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$orderId = $details ['orderId'];
	
		$result = DB::table ( 'jb_order_tbl' ) ->where ( 'ORDER_ID', $orderId ) ->update (
						array ( 'ORDER_STATUS' => 'shipped',
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
		
		$trackingId = DB::table ( 'jb_order_shippment_tracking_tbl' )->insertGetId (
				array ( 'ORDER_ID' => $orderId,
						'STATUS' => 'shipped',
						'DATE' => date ( 'Y-m-d H:i:s' ),
						'CREATED_BY' => $userId,
						'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
		
		$arrRes['done'] = true;
		$arrRes['msg'] = 'Order shipped succesfully.';
	
		echo json_encode ( $arrRes );
	}
	public function getAllAdminShippedOrderslov() {
		$OrderModel = new OrderModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $OrderModel->getAllShippedOrderData();
	
		echo json_encode ( $arrRes );
	}
	
	public function addOrderShipmentDetail(Request $request) {
		$OrderShipmentModel = new OrderShipmentModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['shipment'];
		$orderId = $details ['orderId'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
		$currentDate = date('Y-m-d');
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['S_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Shipping Company Name first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['S_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Delivery Status first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['S_3'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tracking Number is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['S_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Expected delivery date is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_order_shippment_detail_tbl' )->insertGetId (
						array ( 'ORDER_ID' => $orderId,
								'SHIPPING_COMPANY_NAME' => $data['S_1'],
								'TRACKING_NUMBER' => $data['S_3'],
								'EXPECTED_DELIVERY_DATE' => $data['S_4'],
								'STATUS' => $data['S_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				
				$trackingId = DB::table ( 'jb_order_shippment_tracking_tbl' )->insertGetId (
						array ( 'ORDER_ID' => $orderId,
								'STATUS' => $data['S_2'],
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shipment Details Added Successfully';
				$arrRes ['shipment'] = $OrderShipmentModel->getAllSpecificOrderShipmentData($orderId);
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_order_shippment_detail_tbl' ) ->where ( 'SHIPPING_ID', $data ['ID'] ) ->update (
						array ( 'SHIPPING_COMPANY_NAME' => $data['S_1'],
								'TRACKING_NUMBER' => $data['S_3'],
								'EXPECTED_DELIVERY_DATE' => $data['S_4'],
								'STATUS' => $data['S_2'],
	
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
			
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Shipment Details Updated Successfully';
				$arrRes ['shipment'] = $OrderShipmentModel->getAllSpecificOrderShipmentData($orderId);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function shipmentStatusUpdate(Request $request) {
		$OrderShipmentModel = new OrderShipmentModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$orderId = $details ['orderId'];
		$shippingId = $details ['shippingId'];
		$flag = $details ['flag'];
	
		if($flag == '1'){
			$status = 'Picked Up';
		}else if($flag == 2){
			$status = 'In-Transit';
		}else if($flag == 3){
			$status = 'Delivered';
		}
	
		$result = DB::table ( 'jb_order_shippment_detail_tbl' ) ->where ( 'SHIPPING_ID', $shippingId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
		
		$trackingId = DB::table ( 'jb_order_shippment_tracking_tbl' )->insertGetId (
				array ( 'ORDER_ID' => $orderId,
						'STATUS' => $status,
						'DATE' => date ( 'Y-m-d H:i:s' ),
						'CREATED_BY' => $userId,
						'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
		
		if($flag == 3){
			$result = DB::table ( 'jb_order_tbl' ) ->where ( 'ORDER_ID', $orderId ) ->update (
					array ( 'ORDER_STATUS' => 'delivered',
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
		}
	
		$arrRes['done'] = true;
		$arrRes['msg'] = 'Order shipping status updated successfully.';
		$arrRes['shipment'] = $OrderShipmentModel->getAllSpecificOrderShipmentData($orderId);
	
		echo json_encode ( $arrRes );
	}
	
	public function searchShipmentOrders(Request $request) {
		$OrderModel = new OrderModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$search = $details ['search'];
	
		$customerName = isset($search['S_1']) ? $search['S_1'] : ''; 
		$orderStatus = isset($search['S_2']) ? $search['S_2'] : '';
		$shippmentStatus = isset($search['S_3']) ? $search['S_3'] : '';
		$startDate = isset($search['S_4']) ? $search['S_4'] : '';
		$endDate = isset($search['S_5']) ? $search['S_5'] : '';
		
		if($customerName == '' && $orderStatus == '' && $shippmentStatus == '' && $startDate == '' && $endDate == ''){
			
			$arrRes['done'] = false;
			$arrRes['msg'] = 'Choose atleast one filter.';
		
		}else{
			
			$arrRes['done'] = true;
			$arrRes['msg'] = '';
			// 1 for placed order listing & 2 for shipped/delivered order listing
			$arrRes['order'] = $OrderModel->getAllSearchOrderData(2,$customerName,$orderStatus,$shippmentStatus,$startDate,$endDate);
			
		}
	
		echo json_encode ( $arrRes );
	}
	
	/*==================== admin Orders code end ==========================*/
	
	/*===================== admin Product Bundle code start ==========================*/
	
	public function getAllAdminProductBundlelov(Request $request) {
		$Category = new CategoryModel();
		$Bundle = new BundleProductModel();
		$Product = new ProductModel();
		$Shades = new ShadesModel();
	
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $Bundle->getAllBundleProductsData();
		$arrRes ['list1'] = $Category->getCategoryBundleLov();
		$arrRes ['list2'] = $Product->getProductsLov();
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminBundleProductBasicInfo(Request $request) {
		$Product = new BundleProductModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['bundle'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['P_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Name must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_2']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Sub Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_3']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Unit must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
				
			if ($data ['P_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Minimum Purchase Qty is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['P_4'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Minimum Purchase Qty must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
				
			if ($data ['P_5'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tags is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_5']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Tags must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_6']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Barcode must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (!isset($data ['P_8']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose Category.';
				echo json_encode ( $arrRes );
				die ();
			}
				
			if (!isset($data ['P_9']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose Sub Category.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (!isset($data ['P_11']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Please choose Sub Sub Category.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_10'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Slug is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_10']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Slug must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_12'] < 0 || $data['P_12'] > 100 ) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = "TAX Rate must be in between 0 to 100.";
				echo json_encode ( $arrRes );
				die ();
			}
// 			if ($data['P_13'] < 0) {
// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = "Total Amount must be greater then zero.";
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data['P_15'] < 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = "Discounted Amount must be greater then zero.";
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['P_16'] <= 0) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = "Inv. Quantity must be greater then zero.";
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['P_14']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Short Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			
	
			if ($data ['ID'] == '') {
	
// 				$duplicate = $Product->checkDuplicateSlug($data['P_10']);
// 				if ($duplicate != '') {
// 					$arrRes ['done'] = false;
// 					$arrRes ['msg'] = 'Slug is already exist, try different...';
// 					echo json_encode ( $arrRes );
// 					die ();
// 				}
	
				$result = DB::table ( 'jb_bundle_product_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'NAME' => $data['P_1'],
								'SUB_TITLE' => $data['P_2'],
								'UNIT' => $data ['P_3'],
								'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
								'TAGS' => $data ['P_5'],
								'BARCODE' => $data ['P_6'],
								'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
								'CATEGORY_ID' => isset($data ['P_8']['id']) ? $data ['P_8']['id'] : '',
								'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
								'SLUG' => $data ['P_10'],
								'SUB_SUB_CATEGORY_ID' => isset($data ['P_11']['id']) ? $data ['P_11']['id'] : '',
								'VAT_RATE' => $data ['P_12'],
// 								'TOTAL_AMOUNT' => $data ['P_13'],
								'SHORT_DESCRIPTION' => $data ['P_14'],
								'DISCOUNTED_AMOUNT' => $data ['P_15'],
								'QUANTITY' => $data ['P_16'],
								
								'STATUS' => 'inactive',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Bundle Header Info Added Successfully.';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
// 				$duplicate = $Product->checkDuplicateSlug($data['P_10'], $data ['ID']);
// 				if ($duplicate != '') {
// 					$arrRes ['done'] = false;
// 					$arrRes ['msg'] = 'Slug is already exist, try different...';
// 					echo json_encode ( $arrRes );
// 					die ();
// 				}
	
				$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $data ['ID'] ) ->update (
						array ( 'NAME' => $data['P_1'],
								'SUB_TITLE' => $data['P_2'],
								'UNIT' => $data ['P_3'],
								'MINIMUM_PURCHASE_QUANTITY' => $data ['P_4'],
								'TAGS' => $data ['P_5'],
								'BARCODE' => $data ['P_6'],
								'REFUNDABLE_FLAG' => $data ['P_7'] == 'true' ? '1' : '0',
								'CATEGORY_ID' => isset($data ['P_8']['id']) ? $data ['P_8']['id'] : '',
								'SUB_CATEGORY_ID' => isset($data ['P_9']['id']) ? $data ['P_9']['id'] : '',
								'SLUG' => $data ['P_10'],
								'SUB_SUB_CATEGORY_ID' => isset($data ['P_11']['id']) ? $data ['P_11']['id'] : '',
								'VAT_RATE' => $data ['P_12'],
// 								'TOTAL_AMOUNT' => $data ['P_13'],
								'SHORT_DESCRIPTION' => $data ['P_14'],
								'DISCOUNTED_AMOUNT' => $data ['P_15'],
								'QUANTITY' => $data ['P_16'],
								
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Bundle Header Info Updated Successfully.';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminBundleProduct(Request $request) {
		$Category = new CategoryModel();
		$Bundle = new BundleProductModel();
		$BundleLine = new BundleProductLineModel();
	
		$details = $_REQUEST ['details'];
		$bundleId = $details ['bundleId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $Bundle->getSpecificBundleProductData($bundleId);
		$arrRes ['bundleLines'] = $BundleLine->getAllBundleProductLines($bundleId);
		$arrRes ['subCategory'] = $Category->getSubCategoryLovWrtCategory($arrRes ['details']['P_8']);
		$arrRes ['subSubCategory'] = $Category->getSubSubCategoryLovWrtSubCategory($arrRes ['details']['P_9']);
	
		echo json_encode ( $arrRes );
	}
	
	public function deleteBundleProductImage(Request $request) {
		$Bundle = new BundleProductModel();
		
		$details = $_REQUEST ['details'];
		$bundleId = $details ['bundleId'];
		$userId = $details ['userId'];
	
		$attDetail = $Bundle->getSpecificBundleProductData($bundleId);
	
		$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update (
						array ( 'IMAGE_DOWN_PATH' => '',
								'IMAGE_PATH' => '',
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
		if(isset($attDetail['path']) && $attDetail['path'] != ''){
			unlink($attDetail['path']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Bundle image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminBundleProductLine(Request $request) {
		$Product = new ProductModel();
		$Bundle = new BundleProductModel();
		$BundleLine = new BundleProductLineModel();
		
	
		$details = $_REQUEST ['details'];
		$data = $details ['product'];
		$bundleId = $details ['bundleId'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if (!isset($data['P_1']['id'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Product first.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			$productDetails = $Product->getSpecificProductUnitPrice($data['P_1']['id']);
// 			print_r('<pre>');
// 			print_r($productDetails);
// 			exit();
			$productPrice = isset($productDetails['unitPrice']) ? $productDetails['unitPrice'] : '0';
			
			if ($data ['ID'] == '') {
	
				$duplicate = $BundleLine->checkDuplicateProductWrtBundleId($data['P_1']['id'], $bundleId);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Product is already exist in bundle, try different product...';
					echo json_encode ( $arrRes );
					die ();
				}
				
				
				
				$result = DB::table ( 'jb_bundle_product_line_tbl' )->insertGetId (
						array ( 'BUNDLE_ID' => $bundleId,
								'PRODUCT_ID' => isset($data['P_1']['id']) ? $data['P_1']['id'] : '',
								'PRODUCT_PRICE'=> $productPrice,
								
								'STATUS' => 'active',
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Bundle Line Info Added Successfully.';
				$arrRes ['ID'] = $result;
				$arrRes ['bundleLines'] = $BundleLine->getAllBundleProductLines($bundleId);
				
				$bundleDetails = $Bundle->getSpecificBundleProductData($bundleId);
				$totalBundleAmount = $bundleDetails['P_13'];
				
				$bundleAmount = $totalBundleAmount + $productPrice;
				
				$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update ( array ( 'TOTAL_AMOUNT' => $bundleAmount ) );
				
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$duplicate = $BundleLine->checkDuplicateProductWrtBundleId($data['P_1']['id'], $bundleId, $data['ID']);
				if ($duplicate != '') {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Product is already exist in bundle, try different product...';
					echo json_encode ( $arrRes );
					die ();
				}
				
				$result = DB::table ( 'jb_bundle_product_line_tbl' ) ->where ( 'BUNDLE_LINE_ID', $data ['ID'] ) ->update (
						array ( 'PRODUCT_ID' => isset($data['P_1']['id']) ? $data['P_1']['id'] : '',
								'PRODUCT_PRICE'=> $productPrice,
								
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Bundle Line Info Updated Successfully.';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['lines'] = $BundleLine->getAllBundleProductLines($bundleId);
				
				$bundleDetails = $Bundle->getSpecificBundleProductData($bundleId);
				$totalBundleAmount = $bundleDetails['P_13'];
				
				$bundleAmount = $totalBundleAmount + $productPrice;
				
				$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update ( array ( 'TOTAL_AMOUNT' => $bundleAmount ) );
				
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function deleteBundleProductLine(Request $request) {
		$Bundle = new BundleProductModel();
		$BundleLine = new BundleProductLineModel();
		$SubscriptionModel = new SubscriptionModel();
	
		$details = $_REQUEST ['details'];
		$bundleId = $details ['bundleId'];
		$bundleLineId = $details ['bundleLineId'];
		$userId = $details ['userId'];
	
		// $existCheckSubscription = $SubscriptionModel->checkSubscribedBundleExistWrtBundleId($bundleId);
		
		// if($existCheckSubscription == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Subscription exist against this Bundle, system will not able to delete this product, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		
		$detail = $Bundle->getSpecificBundleProductData($bundleId);
	
		$delete = DB::table ( 'jb_bundle_product_line_tbl' )->where ( 'BUNDLE_LINE_ID', $bundleLineId )->delete ();
	
		$linesTotalPrice = $BundleLine->getBundleLineAmountsSum($bundleId);
	
		$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update ( array ( 'TOTAL_AMOUNT' => $linesTotalPrice ) );
		
		$checkSingleBundleProducts = $BundleLine->getAllBundleProductLines($bundleId);
			
		if($checkSingleBundleProducts == null){

			$status = 'inactive';

			DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $bundleId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
		}

		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Bundle Line deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	/*===================== admin Product Bundle code end ==========================*/
	
	/*===================== admin Reviews code start ==========================*/
	
	public function getAllAdminReviewslov() {
		$ReviewsModel = new ReviewsModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['reviews'] = $ReviewsModel->getAllReviewsForAdmin();
		
		echo json_encode ( $arrRes );
	}

	public function deleteReviewDetails(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_reviews_tbl' )->where( 'REVIEW_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'Review delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}

	public function updateReviewStatus() {
		$ReviewsModel = new ReviewsModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$details = $ReviewsModel->getSpecificReviewDetailAdmin($recordId);
		
		if(isset($details['STATUS_FLAG']) && $details['STATUS_FLAG'] == '0'){
			$status = 'published';
			$arrRes ['msg'] = 'Review posted successfully...';
		}else{
			$status = 'inapproval';
			$arrRes ['msg'] = 'Review hide from site...';
			$result = DB::table ( 'jb_reviews_tbl' )->where ( 'REVIEW_ID', $recordId )->update
				( array (
					'ON_SITE_ENABLE' => '0',
					'UPDATED_ON' => date ( 'Y-m-d H:i:s' ) 
					) );
		}
		
		$result = DB::table ( 'jb_reviews_tbl' )->where ( 'REVIEW_ID', $recordId )->update ( array ( 'STATUS' => $status ) );
		
		
		$arrRes ['done'] = true;
		$arrRes ['reviews'] = $ReviewsModel->getAllReviewsForAdmin();
		
		echo json_encode ( $arrRes );
	}
	public function updateReviewOnSiteStatus() {
		$ReviewsModel = new ReviewsModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$details = $ReviewsModel->getSpecificReviewDetailAdmin($recordId);
	
		if(isset($details['ON_SITE_ENABLE']) && $details['ON_SITE_ENABLE'] == '0'){
			$status = '1';
			$arrRes ['msg'] = 'Review enabled successfully...';
		}else{
			$status = '0';
			$arrRes ['msg'] = 'Review disabled from site...';
		}
	
		$result = DB::table ( 'jb_reviews_tbl' )->where ( 'REVIEW_ID', $recordId )->update ( array ( 
			'ON_SITE_ENABLE' => $status,
			'UPDATED_ON' => date ( 'Y-m-d H:i:s' ) 
			) );
	
		$arrRes ['done'] = true;
		$arrRes ['reviews'] = $ReviewsModel->getAllReviewsForAdmin();
	
		echo json_encode ( $arrRes );
	}
	public function getSpecificReviewDetails() {
		$ReviewsModel = new ReviewsModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $ReviewsModel->getSpecificReviewDetailAdmin($recordId);
	
		echo json_encode ( $arrRes );
	}
	/*===================== admin Reviews code End ==========================*/
	
	/*===================== admin Questions code start ==========================*/
	
	public function getAllAdminQuestionslov() {
		$QuestionModel = new QuestionModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['questions'] = $QuestionModel->getAllPublishedQuestionsForAdmin();
	
		echo json_encode ( $arrRes );
	}

	public function deleteQuestionReply(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_questions_tbl' )->where( 'QUESTION_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'Question delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}

	public function updateQuestionStatus() {
		$QuestionModel = new QuestionModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$details = $QuestionModel->getSpecificQuestionDetails($recordId);
	
		if(isset($details['STATUS_FLAG']) && $details['STATUS_FLAG'] == '0'){
			$status = 'published';
			$arrRes ['msg'] = 'Question posted successfully...';
		}else{
			$status = 'inapproval';
			$arrRes ['msg'] = 'Question hide from site...';
		}
	
		$result = DB::table ( 'jb_questions_tbl' )->where ( 'QUESTION_ID', $recordId )->update ( array ( 
			'STATUS' => $status,
			'UPDATED_ON' => date ( 'Y-m-d H:i:s' ) 
			) );
	
		$arrRes ['done'] = true;
		$arrRes ['questions'] = $QuestionModel->getAllPublishedQuestionsForAdmin();
	
		echo json_encode ( $arrRes );
	}
	
	public function saveQuestionAnswer() {
		$QuestionModel = new QuestionModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['record'];
		$userId = $details ['userId'];
	
		if($data['answer'] == ''){
			
			$arrRes ['done'] = true;
			$arrRes ['msg'] = "Can't post empty answer...";
			echo json_encode ( $arrRes );
			die();
		}
		
		
		$result = DB::table ( 'jb_questions_tbl' )->where ( 'QUESTION_ID', $data['questionId'] )->update ( 
				array ( 'ANSWER' => $data['answer'],
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' ),
						'UPDATED_BY' => $userId
				) );
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = "Answer posted successfully.";
		$arrRes ['questions'] = $QuestionModel->getAllPublishedQuestionsForAdmin();
	
		echo json_encode ( $arrRes );
	}
	
	
	/*===================== admin Subscriptions code start ==========================*/
	
	public function getAllAdminSubscriptionlov() {
		$SubscriptionModel = new SubscriptionModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $SubscriptionModel->getAllSubscriptionsForAdmin();
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminSubscription(Request $request) {
		$SubscriptionModel = new SubscriptionModel();
		
		$details = $_REQUEST ['details'];
		$data = $details ['subscription'];
		$userId = $details ['userId'];
		$currentdate = date('Y-m-d');
		
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data ['S_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['S_1']) > 100) {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 charactres long.';
				echo json_encode ( $arrRes );
				die ();
			}
// 			if ($data ['S_2'] == '') {
			
// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Price is required.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
// 			if ($data ['S_2'] <= 0) {
					
// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Price must be greater then zero.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data ['S_3'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Effective Start Date is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			
// 			if ($data ['S_3'] < $currentdate) {
					
// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Effective Start Date must be equal to or greater then Current Date.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data ['S_4'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Effective End Date is required.';
				echo json_encode ( $arrRes );
				die ();
			}
// 			if ($data ['S_4'] < $currentdate) {
					
// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Effective End Date must be equal to or greater then Current Date.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data ['S_4'] < $data ['S_3']) {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Effective End Date must be greater then Effective Start Date.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_5'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subscription Note 1 is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['S_5']) > 200) {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subscription Note 1 must be less then 200 charactres long.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_6'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subscription Note 2 is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['S_6']) > 200) {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subscription Note 2 must be less then 200 charactres long.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_7'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Duration (Months) is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_8'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['S_8'] <= 0) {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Discount must be greater then zero.';
				echo json_encode ( $arrRes );
				die ();
			}
// 			if ($data ['S_9'] == '') {
					
// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Validity Days is required.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
// 			if ($data ['S_9'] <= 0) {
					
// 				$arrRes ['done'] = false;
// 				$arrRes ['msg'] = 'Validity Days must be greater then zero.';
// 				echo json_encode ( $arrRes );
// 				die ();
// 			}
			if ($data ['S_10'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Detail is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_subscription_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								
								'TITLE' => $data['S_1'],
// 								'PRICE' => $data['S_2'],
								'EFF_START_DATE' => $data['S_3'],
								'EFF_END_DATE' => $data['S_4'],
								'SUB_NOTE_1' => $data['S_5'],
								'SUB_NOTE_2' => $data['S_6'],
								'DURATION_MONTHS' => $data['S_7'],
								'DISCOUNT' => $data['S_8'],
// 								'VALIDITY_DAYS' => $data['S_9'],
								'DESCRIPTION' => $data['S_10'],
								'STATUS' => 'active',
								
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Subscription Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['list'] = $SubscriptionModel->getAllSubscriptionsForAdmin();
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_subscription_tbl' ) ->where ( 'SUBSCRIPTION_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['S_1'],
// 								'PRICE' => $data['S_2'],
								'EFF_START_DATE' => $data['S_3'],
								'EFF_END_DATE' => $data['S_4'],
								'SUB_NOTE_1' => $data['S_5'],
								'SUB_NOTE_2' => $data['S_6'],
								'DURATION_MONTHS' => $data['S_7'],
								'DISCOUNT' => $data['S_8'],
// 								'VALIDITY_DAYS' => $data['S_9'],
								'DESCRIPTION' => $data['S_10'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Subscription Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['list'] = $SubscriptionModel->getAllSubscriptionsForAdmin();
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editAdminSubscription() {
		$SubscriptionModel = new SubscriptionModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $SubscriptionModel->getSpecificSubscriptionData($recordId);
	
		echo json_encode ( $arrRes );
	}

	public function deleteAdminSubscription(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_subscription_tbl' )->where( 'SUBSCRIPTION_ID', $recordId ) ->update(
			array ( 'IS_DELETED' => 0,
					'STATUS' => 'inactive',
					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			)
		);

		$arrRes ['msg'] = 'Subscription delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}
	
	public function changeStatusSubscription(Request $request) {
		$SubscriptionModel = new SubscriptionModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$subDetail = $SubscriptionModel->getSpecificSubscriptionStatus($recordId);
	
		if(isset($subDetail['STATUS']) && $subDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Subscription active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Subscription Inactive successfully...';
		}
	
		$result = DB::table ( 'jb_subscription_tbl' ) ->where ( 'SUBSCRIPTION_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
	
		$arrRes ['done'] = true;
		$arrRes ['list'] = $SubscriptionModel->getAllSubscriptionsForAdmin();
	
		echo json_encode ( $arrRes );
	
	}
	
	
	/*===================== admin Subscriptions code end ==========================*/
	
	/*===================== admin home user page crud code start =========================*/
	
	public function getAllAdminHomeUserlov() {
		$UserdashboardModel = new UserdashboardModel();
		$ProductModel = new ProductModel();
		$CategoryModel = new CategoryModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['banners'] = $UserdashboardModel->getAllUserBanners();
		$arrRes ['bestExc'] = $UserdashboardModel->getAllUserBestExcData();
		$arrRes ['products'] = $ProductModel->getActiveProductsLov();
		$arrRes ['categories'] = $CategoryModel->getCategoryWithoutBundleLov();
		$arrRes ['trending'] = $UserdashboardModel->getAllUserHomeProductSectionData('trending');
		$arrRes ['foryou'] = $UserdashboardModel->getAllUserHomeProductSectionData('foryou');
		$arrRes ['offers'] = $UserdashboardModel->getAllUserHomeOfferSectionData();
		
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminHomeUserPageBanner(Request $request) {
		$UserdashboardModel = new UserdashboardModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['banner'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data['B_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['B_1']) > 100) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['B_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Button Text is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['B_2']) > 50) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Button Text must be less then 50 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['B_4'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Short Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['B_4']) > 500) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Short Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['B_6'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Upload Banner image first then proceed.';
				echo json_encode ( $arrRes );
				die ();
			}
				
			$detail = $UserdashboardModel->getSpecificUserBannerById($data ['ID']);
	
			if (empty($detail)) {
				
				$result = DB::table ( 'jb_user_home_banner_tbl' )->insertGetId (
						array ( 'BANNER_ID' => $data ['ID'],
								'USER_ID' => $userId,
								'TITLE' => $data['B_1'],
								'BUTTON_TEXT' => $data['B_2'],
								'BUTTON_LINK' => $data ['B_3'],
								'DESCRIPTION' => $data ['B_4'],
								'IMAGE_DOWNPATH' => $data ['B_5'],
								'IMAGE_PATH' => $data ['B_6'],
								
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Banner Created Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
				
				$result = DB::table ( 'jb_user_home_banner_tbl' ) ->where ( 'BANNER_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['B_1'],
								'BUTTON_TEXT' => $data['B_2'],
								'BUTTON_LINK' => $data ['B_3'],
								'DESCRIPTION' => $data ['B_4'],
								'IMAGE_DOWNPATH' => $data ['B_5'],
								'IMAGE_PATH' => $data ['B_6'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Banner Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function saveAdminHomeUserBestExc(Request $request) {
		$UserdashboardModel = new UserdashboardModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['bestexc'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			$detail = $UserdashboardModel->getSpecificUserBestExcById($data ['ID']);
	
			if (empty($detail)) {
	
				$result = DB::table ( 'jb_user_home_bestexclusive_tbl' )->insertGetId (
						array ( 'BESTEXC_ID' => $data ['ID'],
								'USER_ID' => $userId,
								'TITLE' => $data['B_1'],
								'HEADING' => $data['B_2'],
								'PRODUCT_ID' => $data ['B_3'],
								'IMAGE_DOWNPATH' => $data ['B_4'],
								'IMAGE_PATH' => $data ['B_5'],
	
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Saved Successfully';
				$arrRes ['ID'] = $result;
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_user_home_bestexclusive_tbl' ) ->where ( 'BESTEXC_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['B_1'],
								'HEADING' => $data['B_2'],
								'PRODUCT_ID' => $data ['B_3'],
								'IMAGE_DOWNPATH' => $data ['B_4'],
								'IMAGE_PATH' => $data ['B_5'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function deleteHomeBannerImage(Request $request) {
		$UserdashboardModel = new UserdashboardModel();
	
		$details = $_REQUEST ['details'];
		$bannerId = $details ['bannerId'];
		$userId = $details ['userId'];
	
		$attDetail = $UserdashboardModel->getSpecificUserBannerById($bannerId);
	
		$result = DB::table ( 'jb_user_home_banner_tbl' ) ->where ( 'BANNER_ID', $bannerId ) ->update (
				array ( 
						'IMAGE_DOWNPATH' => '',
						'IMAGE_PATH' => '',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
		
		if(isset($attDetail['IMAGE_PATH']) && $attDetail['IMAGE_PATH'] != ''){
			unlink($attDetail['IMAGE_PATH']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Banner image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	public function deleteHomeBestExcImage(Request $request) {
		$UserdashboardModel = new UserdashboardModel();
	
		$details = $_REQUEST ['details'];
		$bestexcId = $details ['bestexcId'];
		$userId = $details ['userId'];
	
		$attDetail = $UserdashboardModel->getSpecificUserBestExcById($bestexcId);
	
		$result = DB::table ( 'jb_user_home_bestexclusive_tbl' ) ->where ( 'BESTEXC_ID', $bestexcId ) ->update (
				array (
						'IMAGE_DOWNPATH' => '',
						'IMAGE_PATH' => '',
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
			);
	
		if(isset($attDetail['IMAGE_PATH']) && $attDetail['IMAGE_PATH'] != ''){
			unlink($attDetail['IMAGE_PATH']);
		}
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Image deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	public function getproductlovfromcategory(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();
		$BundleProductModel = new BundleProductModel();
		
		$details = $_REQUEST ['details'];
		$categoryId = $details ['categoryId'];
		$userId = $details ['userId'];
	
		$subCatIds = $CategoryModel->getAllSubCategoryIdsWrtCategoryId($categoryId);
			
		$subSubCatIds = $CategoryModel->getAllSubSubCategoryIdsWrtSubCategoryId($subCatIds);
		
		$arrRes ['productLov'] = $ProductModel->getProductsLovWrtCatSubCatSubSubCatIds($categoryId,$subCatIds,$subSubCatIds);
		
		echo json_encode ( $arrRes );
	}
	
	
	public function saveTrendingProductDetails(Request $request) {
		$UserdashboardModel = new UserdashboardModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['trending'];
		$userId = $details ['userId'];
		$code = $details ['code'];
		
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if(!isset($data['T_1']['id'])){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose product category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(!isset($data['T_2']['id'])){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose product first.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			if ($data['ID'] == '') {
	
				$result = DB::table ( 'jb_user_home_product_section_tbl' )->insertGetId (
						array (	'USER_ID' => $userId,
								'BATCH_CODE' => $code,
								'CATEGORY_ID' => isset($data['T_1']['id']) ? $data['T_1']['id'] : '',
								'PRODUCT_ID' => isset($data['T_2']['id']) ? $data['T_2']['id'] : '',
								'STATUS' => 'active',
								
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Saved Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['list'] = $UserdashboardModel->getAllUserHomeProductSectionData($code);
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_user_home_product_section_tbl' ) ->where ( 'SECTION_ID', $data ['ID'] ) ->update (
						array ( 'CATEGORY_ID' => isset($data['T_1']['id']) ? $data['T_1']['id'] : '',
								'PRODUCT_ID' => isset($data['T_2']['id']) ? $data['T_2']['id'] : '',
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['list'] = $UserdashboardModel->getAllUserHomeProductSectionData($code);
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	
	public function deleteSectionRecord(Request $request) {
		$UserdashboardModel = new UserdashboardModel();
	
		$details = $_REQUEST ['details'];
		$sectionId = $details ['sectionId'];
		$userId = $details ['userId'];
	
		$delete = DB::table ( 'jb_user_home_product_section_tbl' )->where ( 'SECTION_ID', $sectionId )->delete ();
		
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Record deleted successfully...';
		$arrRes ['trending'] = $UserdashboardModel->getAllUserHomeProductSectionData('trending');
		$arrRes ['foryou'] = $UserdashboardModel->getAllUserHomeProductSectionData('foryou');
		
		echo json_encode ( $arrRes );
	}
	
	public function saveTodayofferDetails(Request $request) {
		$UserdashboardModel = new UserdashboardModel();
	
		$details = $_REQUEST ['details'];
		$data = $details ['offer'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if($data['T_1'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(strlen($data['T_1']) > 100){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(!isset($data['T_2']['id'])){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose product category first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(!isset($data['T_3']['id'])){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose product first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($data['T_4'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Offer End Time is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			$currentDate = date('Y-m-d H:i:s');
			$endDate = date('Y-m-d H:i:s', strtotime($data['T_4']));

			if($endDate < $currentDate){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Offer End Time must be greater then current time.';
				echo json_encode ( $arrRes );
				die ();
			}
			if($data['T_5'] == ''){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if(strlen($data['T_5']) > 500){
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Description must be less then 500 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			
			
			if ($data['ID'] == '') {
	
				$result = DB::table ( 'jb_user_home_offer_section_tbl' )->insertGetId (
						array (	'USER_ID' => $userId,
								'OFFER_TITLE' => $data['T_1'],
								'CATEGORY_ID' => isset($data['T_2']['id']) ? $data['T_2']['id'] : '',
								'PRODUCT_ID' => isset($data['T_3']['id']) ? $data['T_3']['id'] : '',
								'OFFER_START_DATE' => date ( 'Y-m-d H:i:s' ),
								'OFFER_END_DATE' => $endDate,
								'DESCRIPTION' => $data['T_5'],
								'STATUS' => 'active',
	
								'DATE' => date ( 'Y-m-d H:i:s' ),
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Saved Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['list'] = $UserdashboardModel->getAllUserHomeOfferSectionData();
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_user_home_offer_section_tbl' ) ->where ( 'OFFER_ID', $data ['ID'] ) ->update (
						array ( 'OFFER_TITLE' => $data['T_1'],
								'CATEGORY_ID' => isset($data['T_2']['id']) ? $data['T_2']['id'] : '',
								'PRODUCT_ID' => isset($data['T_3']['id']) ? $data['T_3']['id'] : '',
								'OFFER_START_DATE' => date ( 'Y-m-d H:i:s' ),
								'OFFER_END_DATE' => $endDate,
								'DESCRIPTION' => $data['T_5'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Details Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['list'] = $UserdashboardModel->getAllUserHomeOfferSectionData();
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function editOfferRecord() {
		$UserdashboardModel = new UserdashboardModel();
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();
		
		$details = $_REQUEST ['details'];
		$offerId = $details ['offerId'];
		$userId = $details ['userId'];
	
		$arrRes ['details'] = $UserdashboardModel->getSpecificTodayOfferRecordById($offerId);
		
		$categoryId = isset($arrRes ['details']['T_2']) ? $arrRes ['details']['T_2'] : '';
		
		$subCatIds = $CategoryModel->getAllSubCategoryIdsWrtCategoryId($categoryId);
			
		$subSubCatIds = $CategoryModel->getAllSubSubCategoryIdsWrtSubCategoryId($subCatIds);
		
		$arrRes ['productLov'] = $ProductModel->getProductsLovWrtCatSubCatSubSubCatIds($categoryId,$subCatIds,$subSubCatIds);
		
		
		echo json_encode ( $arrRes );
	}
	
	public function deleteOfferRecord(Request $request) {
		$UserdashboardModel = new UserdashboardModel();
	
		$details = $_REQUEST ['details'];
		$offerId = $details ['offerId'];
		$userId = $details ['userId'];
	
		$delete = DB::table ( 'jb_user_home_offer_section_tbl' )->where ( 'OFFER_ID', $offerId )->delete ();
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Record deleted successfully...';
		$arrRes ['list'] = $UserdashboardModel->getAllUserHomeOfferSectionData();
	
		echo json_encode ( $arrRes );
	}
	/*===================== admin home user page crud code end =========================*/
	
	
	public function getAllAdminUserSubscriptionslov() {
		$SubscriptionModel = new SubscriptionModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $SubscriptionModel->getAllAdminUserSubscriptionsForAdmin($userId);
	
		echo json_encode ( $arrRes );
	}
	public function getSpecificAdminUserSubscriptionDetail() {
		$SubscriptionModel = new SubscriptionModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$subsId = $details ['subsId'];
	
		$arrRes ['detail'] = $SubscriptionModel->getSpecificUserSubscriptionDetails($subsId);
	
		echo json_encode ( $arrRes );
	}
	
	public function getAllAdminUserTicketslov() {
		$TicketsModel = new TicketsModel();
		$OrderModel = new OrderModel();
		
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
		$arrRes ['orders'] = $OrderModel->getOrdersLov($userId);
	
		echo json_encode ( $arrRes );
	}
	
	public function saveAdminTicketDetails(Request $request) {
		$TicketsModel = new TicketsModel();
		$OrderModel = new OrderModel();
		 
		$details = $_REQUEST ['details'];
		$data = $details ['ticket'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $data ) && ! empty ( $data )) {
	
			if ($data ['T_1'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Ticket Type first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['T_1'] == 'order' && !isset($data ['T_2']['name'])) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Order Number First.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			// if ($data ['T_1'] == 'order' && $data ['T_2'] != '') {
					
			// 	$temp = explode('#', $data ['T_2']);
					
			// 	$orderDetail = $OrderModel->validateOrderById(isset($temp[1])?$temp[1]:'');
					
			// 	if(empty($orderDetail)){
			// 		$arrRes ['done'] = false;
			// 		$arrRes ['msg'] = 'Document Number is not valid.';
			// 		echo json_encode ( $arrRes );
			// 		die ();
			// 	}
			// }
			if ($data ['T_3'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Username is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['T_3']) > 100) {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Username must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['T_4'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Email is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['T_4']) > 100) {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Email must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['T_4'] != "") {
				if (!filter_var( $data ['T_4'], FILTER_VALIDATE_EMAIL)) {
					$arrRes['done'] = false;
					$arrRes['msg'] = 'Please enter valid Email Address';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if ($data ['T_5'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Phone number is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['T_5']) != 11) {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Phone number must be less then equal to 11 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['T_8'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Choose Priority first.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['T_6'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subject is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['T_6']) > 200) {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subject must be less then 200 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['T_7'] == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Details is required.';
				echo json_encode ( $arrRes );
				die ();
			}
	
	
	
			if ($data ['ID'] == '') {
	
				$result = DB::table ( 'jb_user_tickets_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'TICKET_NUMBER' => 'TKT#'.date('YmdHis'),
								'TICKET_TYPE' => $data['T_1'],
								'DOCUMENT_NUMBER' => isset($data['T_2']['name']) ? $data['T_2']['name'] : '',
								'USER_NAME' => $data['T_3'],
								'EMAIL' => $data['T_4'],
								'PHONE_NUMBER' => $data['T_5'],
								'SUBJECT' => $data['T_6'],
								'DESCRIPTION' => $data['T_7'],
								'PRIORITY' => $data['T_8'],
								'STATUS' => 'open',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ticket Created Successfully';
				$arrRes ['ID'] = $result;
				$arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
				echo json_encode ( $arrRes );
				die ();
	
			} else {
	
				$result = DB::table ( 'jb_user_tickets_tbl' ) ->where ( 'TICKET_ID', $data ['ID'] ) ->update (
						array ( 'TICKET_TYPE' => $data['T_1'],
								'DOCUMENT_NUMBER' => isset($data['T_2']['name']) ? $data['T_2']['name'] : '',
								'USER_NAME' => $data['T_3'],
								'EMAIL' => $data['T_4'],
								'PHONE_NUMBER' => $data['T_5'],
								'SUBJECT' => $data['T_6'],
								'DESCRIPTION' => $data['T_7'],
								'PRIORITY' => $data['T_8'],
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
	
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Ticket Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				$arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
				echo json_encode ( $arrRes );
				die ();
			}
		}
	}
	public function changeAdminTicketStatus(Request $request) {
		$TicketsModel = new TicketsModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ticketId = $details ['ticketId'];
		$flag = $details ['flag'];
	
		 
	
		if(isset($flag) && $flag == '1'){
			$status = 'open';
			$arrRes ['msg'] = 'Ticket open successfully...';
		}else{
			$status = 'close';
			$arrRes ['msg'] = 'Ticket close successfully...';
		}
	
		$result = DB::table ( 'jb_user_tickets_tbl' ) ->where ( 'TICKET_ID', $ticketId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
	
		$arrRes ['done'] = true;
		$arrRes ['list'] = $TicketsModel->getAllTicketsForAdmin();
	
		echo json_encode ( $arrRes );
	
	}
	public function getSpecificAdminTicketDetails() {
		$TicketsModel = new TicketsModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$ticketId = $details ['ticketId'];
	
		$arrRes ['details'] = $TicketsModel->getSpecificTicketDetail($ticketId);
		$arrRes ['replies'] = $TicketsModel->getSpecificTicketReplies($ticketId);
		$arrRes ['images'] = $TicketsModel->getTicketAttachments($ticketId);
		
		echo json_encode ( $arrRes );
	}
	public function deleteTicketDetails(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_user_tickets_tbl' )->where( 'TICKET_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'Ticket delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}
	public function saveAdminTicketReplyDetail(Request $request) {
		$TicketsModel = new TicketsModel();
		$OrderModel = new OrderModel();
	
		$details = $_REQUEST ['details'];
		$ticketId = $details ['ticketId'];
		$ticketReply = $details ['ticketReply'];
		$userId = $details ['userId'];
	
		$arrRes = array ();
		$arrRes ['done'] = false;
		$arrRes ['msg'] = '';
	
	
		if (isset ( $ticketId ) && $ticketId != '') {
	
			if ($ticketReply == '') {
	
				$arrRes ['done'] = false;
				$arrRes ['msg'] = "Can't post empty reply.";
				echo json_encode ( $arrRes );
				die ();
			}
	
			$result = DB::table ( 'jb_user_ticket_reply_tbl' )->insertGetId (
					array ( 'TICKET_ID' => $ticketId,
							'REPLY_DESCRIPTION' => $ticketReply,
							'USER_TYPE' => 'admin',
							'DATE' => date ( 'Y-m-d H:i:s' ),
							'CREATED_BY' => $userId,
							'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					     ));
	
			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Ticket Reply added successfully.';
			$arrRes ['ID'] = $result;
			$arrRes ['replies'] = $TicketsModel->getSpecificTicketReplies($ticketId);
			echo json_encode ( $arrRes );
			die ();
		 
		 }else{
			$arrRes ['done'] = false;
			$arrRes ['msg'] = "Something went wrong...";
			echo json_encode ( $arrRes );
			die ();
		}
	}
	
	public function getAllAdminPaymentslov() {
		$OrderPaymentModel = new OrderPaymentModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['payments'] = $OrderPaymentModel->getAllOrderPaymentData();
			
		echo json_encode ( $arrRes );
	}
	public function getSpecificAdminPaymentDetail() {
		$OrderPaymentModel = new OrderPaymentModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$paymentId = $details ['paymentId'];
	
		$arrRes ['details'] = $OrderPaymentModel->getSpecficOrderPaymentData($paymentId);
			
		echo json_encode ( $arrRes );
	}
	
	public function getAllAdminGivings() {
		$givingsModel = new GivingModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['givings'] = $givingsModel->getAllAdminGivingsData();
			
		echo json_encode ( $arrRes );
	}
	public function getSpecificAdminGivingDetail() {
		$givingsModel = new GivingModel();

		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$givingId = $details ['givingId'];
	
		$arrRes ['details'] = $givingsModel->getSpecificAdminGivingDetailData($givingId);
			
		echo json_encode ( $arrRes );
	}
	public function getAllAdminNewslatterlov() {
		$FooterSubscriptionModel = new FooterSubscriptionModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		
		$arrRes ['list'] = $FooterSubscriptionModel->getAllSubscriptionForAdmin();
			
		echo json_encode ( $arrRes );
	}
	public function getAllAdminSnapSelfielov() {
		$ShadeFinderSelfieModel = new ShadeFinderSelfieModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $ShadeFinderSelfieModel->getAllShadeFinderSelfieForAdmin();
			
		echo json_encode ( $arrRes );
	}
	
	public function deleteSelfieDetails(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'jb_shade_finder_selfie_tbl' )->where( 'SELFIE_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'Selfi delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}

	public function getAllAdminEmaillov() {
		$EmailForwardModel = new EmailForwardModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $EmailForwardModel->getAllEmailsData();
			
		echo json_encode ( $arrRes );
	}
	
	public function deleteAdminSentEmail(){
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];


		DB::table( 'sys_email_tbl' )->where( 'EMAIL_ID', $recordId ) ->delete();

		$arrRes ['msg'] = 'E-mail delete successfully...';
		$arrRes ['done'] = true;

		echo json_encode ( $arrRes );
	}
	
	
	public function deleteCategoryRecord(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$categoryId = $details ['recordId'];
		$userId = $details ['userId'];


		$result = DB::table('jb_product_tbl')->where('CATEGORY_ID', $categoryId)->pluck('NAME');
		
		if(count($result) > 0){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'This Category is added in Products';
			$arrRes ['product_data'] = $result;

			echo json_encode ( $arrRes );
			die();

		}
		
		$subCatArray = $CategoryModel->getAllSubCategoryIdsWrtCategoryIdCaseDelete($categoryId);
		$subSubCatArray = $CategoryModel->getAllSubSubCategoryIdsWrtCategoryIdCaseDelete($subCatArray != null ? $subCatArray : array());
		
		if(isset($subSubCatArray) && count($subSubCatArray) > 0){
			foreach ($subSubCatArray as $subSubCatArrayList) {
				DB::table ( 'jb_sub_sub_category_tbl' )->where('SUB_SUB_CATEGORY_ID', $subSubCatArrayList)->delete();
			}
		}
		
		if(isset($subCatArray) && count($subCatArray) > 0){
			foreach ($subCatArray as $subCatArrayList) {
				DB::table('jb_sub_category_tbl')->where('SUB_CATEGORY_ID', $subCatArrayList)->delete();
			}
		}

		DB::table ( 'jb_category_tbl' )->where( 'CATEGORY_ID', $categoryId )->delete();

		//  $existCheckSubCategory = $CategoryModel->checkSubCategoryExistWrtCategory($categoryId);
		
		
		// if($existCheckSubCategory == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Sub Categories exist against this category, kindly remove sub categories then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		// $existCheckProduct = $ProductModel->checkProductExistWrtCategoryId($categoryId, '1');
		
		// if($existCheckProduct == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Products exist against this category, kindly remove products then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		// $delete = DB::table ( 'jb_category_tbl' )->where ( 'CATEGORY_ID', $categoryId )->delete ();
		
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Category deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	public function deleteSubCategoryRecord(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$categoryId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$existCheckSubCategory = $CategoryModel->checkSubSubCategoryExistWrtCategory($categoryId);
	
		if($existCheckSubCategory == true){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Sub Sub Categories exist against this sub category, kindly remove sub sub categories then proceed.';
			echo json_encode ( $arrRes );
			die();
		}
	
		$existCheckProduct = $ProductModel->checkProductExistWrtCategoryId($categoryId, '2');
	
		if($existCheckProduct == true){
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Products exist against this sub category, kindly remove products then proceed.';
			echo json_encode ( $arrRes );
			die();
		}
	
		$delete = DB::table ( 'jb_sub_category_tbl' )->where ( 'SUB_CATEGORY_ID', $categoryId )->delete ();
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Sub Category deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	public function deleteSubSubCategoryRecord(Request $request) {
		$CategoryModel = new CategoryModel();
		$ProductModel = new ProductModel();
	
		$details = $_REQUEST ['details'];
		

		$categoryId = $details ['recordId'];
		$userId = $details ['userId'];
		$proCatepara = $details ['proCatepara'];

		if($proCatepara == '3'){

			DB::table('jb_product_tbl')->where( 'SUB_SUB_CATEGORY_ID', $categoryId )->update(
				array(
					'SUB_SUB_CATEGORY_ID' => NULL,
				)
			);

			DB::table('jb_sub_sub_category_tbl')->where( 'SUB_SUB_CATEGORY_ID', $categoryId )->delete();
	
			
			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Sub Sub Category deleted successfully...';
	
			echo json_encode ( $arrRes );
			die();


		}else {
			// dd('no');

			// $result = DB::table('jb_product_tbl')->where('SUB_CATEGORY_ID', $categoryId)->get();

			// dd($result);

			

			DB::table ( 'jb_product_tbl' )->where( 'SUB_CATEGORY_ID', $categoryId )->update(
				array(
					'SUB_CATEGORY_ID' => NULL,
					'SUB_SUB_CATEGORY_ID' => NULL
				)
			);

			DB::table('jb_sub_sub_category_tbl')->where('SUB_CATEGORY_ID', $categoryId)->delete();

			DB::table('jb_sub_category_tbl')->where('SUB_CATEGORY_ID', $categoryId )->delete();

			$arrRes ['done'] = true;
			$arrRes ['msg'] = 'Sub Category deleted successfully...';
	
			echo json_encode ( $arrRes );
			die();


		}

// 		$result = DB::table ( 'jb_product_tbl' )->where( 'SUB_SUB_CATEGORY_ID', $categoryId )->get();
// 		dd($result);
		
		
		// $existCheckProduct = $ProductModel->checkProductExistWrtCategoryId($categoryId, '3');


	
		// if($existCheckProduct == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Products exist against this sub sub category, kindly remove products then proceed.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
	
		// $delete = 
	
		// $arrRes ['done'] = true;
		// $arrRes ['msg'] = 'Sub Sub Category deleted successfully...';
	
		// echo json_encode ( $arrRes );
	}
	
	public function changeStatusProduct(Request $request) {
		$ProductModel = new ProductModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$productDetail = $ProductModel->getSpecificProductStatus($recordId);
	
		if(isset($productDetail['STATUS']) && $productDetail['STATUS'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'Product active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Product Inactive successfully...';
		}
	
		$result = DB::table ( 'jb_product_tbl' ) ->where ( 'PRODUCT_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
	
		$arrRes ['done'] = true;
	
		echo json_encode ( $arrRes );
	
	}
	
	public function deleteSpecificProduct(Request $request) {
		// $ProductModel = new ProductModel();
		// $OrderModel = new OrderModel();
		// $SubscriptionModel = new SubscriptionModel();
		// $UserdashboardModel = new UserdashboardModel();
		// $BundleProductLineModel = new BundleProductLineModel();
	
		$details = $_REQUEST ['details'];
		$productId = $details ['recordId'];
		$userId = $details ['userId'];
	
		// $existCheckBundle = $BundleProductLineModel->checkProductBundleWrtProductId($productId);
		$result_jb_bundle_product_line_tbl = DB::table('jb_bundle_product_line_tbl as a')->select('a.*') ->where('a.PRODUCT_ID', $productId) ->get();
		
		if(sizeof($result_jb_bundle_product_line_tbl) != null){
			DB::table('jb_bundle_product_line_tbl')->where('PRODUCT_ID', $productId) ->delete();
		}

		// if($existCheckBundle == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'This product is link with  Bundle, kindly unlink product then proceed, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		//$existCheckOrder = $OrderModel->checkOrderProductExistWrtProductId($productId);

		// if($existCheckOrder == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Order exist against this product, system will not able to delete this product, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		// $existCheckSubscription = $SubscriptionModel->checkSubscribedProductExistWrtProductId($productId);
		
		// if($existCheckSubscription == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Subscription exist against this product, system will not able to delete this product, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		//  $existCheckTrendForyou = $UserdashboardModel->checkTrendingForyouExistWrtProductId($productId);
		
		// if($existCheckTrendForyou == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = "This product is link with Trending / For You section, kindly unlink product then proceed, Thanks.";
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }

		$result_jb_user_home_product_section_tbl = DB::table('jb_user_home_product_section_tbl as a')
													->where('a.PRODUCT_ID', $productId)
													->get();

		if(sizeof($result_jb_user_home_product_section_tbl) != null){
			DB::table('jb_user_home_product_section_tbl')
				->where('PRODUCT_ID', $productId)
				->delete();
		}
		// dd($result_jb_user_home_product_section_tbl);


		// $existCheckTodayOffer = $UserdashboardModel->checkTodayOfferExistWrtProductId($productId);
		
		// if($existCheckTodayOffer == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'This product is link with  Today Offer section, kindly unlink product then proceed, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
		
		// $existCheckOnlineExc = $UserdashboardModel->checkOnlineExcExistWrtProductId($productId);
		
		// if($existCheckOnlineExc == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'This product is link with  Best Seller / Online Exclusive section, kindly unlink product then proceed, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
			
		$result_jb_user_home_bestexclusive_tbl = DB::table('jb_user_home_bestexclusive_tbl as a')->select('a.*')
												->where('a.PRODUCT_ID', $productId)
												->get();

		if(sizeof($result_jb_user_home_bestexclusive_tbl) != null){
			
			DB::table('jb_user_home_bestexclusive_tbl')->where('PRODUCT_ID', $productId)->delete();
		}

		// $productAtt = $ProductModel->getSpecificProductImages($productId);
		
		DB::table ( 'jb_product_tbl' )->where ( 'PRODUCT_ID', $productId )->update (
			array ( 'IS_DELETED' => 1,
					'STATUS' => 'inactive',
					'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
			)
		);
		DB::table ( 'jb_user_wishlist_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productImageDelete = DB::table ( 'jb_product_images_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		
		// if(isset($productAtt) && !empty($productAtt)){
		// 	foreach ($productAtt as $value){
		// 		unlink($value['path']);
		// 	}
		// }
		
		// $productVideoDelete = DB::table ( 'jb_product_video_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productUsesDelete = DB::table ( 'jb_product_video_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productIngredientDelete = DB::table ( 'jb_product_ingredient_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productShadesDelete = DB::table ( 'jb_product_shades_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productShopingCartDelete = DB::table ( 'jb_shopping_cart_detail_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productReviewsDelete = DB::table ( 'jb_reviews_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		// $productQuestionDelete = DB::table ( 'jb_questions_tbl' )->where ( 'PRODUCT_ID', $productId )->delete ();
		
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Product deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	
	public function changeStatusBundle(Request $request) {
		$BundleProductModel = new BundleProductModel();
		$BundleLine = new BundleProductLineModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$bundleDetail = $BundleProductModel->getSpecificBundleStatus($recordId);
		$checkSingleBundleProducts = $BundleLine->getAllBundleProductLines($recordId);

		if(isset($bundleDetail['STATUS']) && $bundleDetail['STATUS'] != 'active'){


			if($checkSingleBundleProducts != null){

				$status = 'active';
				$arrRes ['msg'] = 'Bundle active successfully...';

				DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $recordId ) ->update (
					array ( 'STATUS' => $status,
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
					$arrRes ['done'] = true;
			}else{

				$arrRes ['msg'] = 'Please Add one or more products';
				$arrRes ['done'] = false;
			}


		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'Bundle Inactive successfully...';

			DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $recordId ) ->update (
				array ( 'STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
				$arrRes ['done'] = true;
		}
	
		echo json_encode ( $arrRes );
		
	}
	
	public function deleteSpecificBundle(Request $request) {
		// $ProductModel = new ProductModel();
		// $OrderModel = new OrderModel();
		// $SubscriptionModel = new SubscriptionModel();
		// $UserdashboardModel = new UserdashboardModel();
		// $BundleProductModel = new BundleProductModel();
		// $BundleProductLineModel = new BundleProductLineModel();
	
		$details = $_REQUEST ['details'];
		
		$bundleId = $details ['recordId'];
		$userId = $details ['userId'];
	
		
	
		// $existCheckOrder = $OrderModel->checkOrderBundleExistWrtBundleId($bundleId);
	
		// if($existCheckOrder == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Order exist against this bundle, system will not able to delete this bundle, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
	
		// $existCheckSubscription = $SubscriptionModel->checkSubscribedBundleExistWrtBundleId($bundleId);
	
		// if($existCheckSubscription == true){
		// 	$arrRes ['done'] = false;
		// 	$arrRes ['msg'] = 'Subscription exist against this bundle, system will not able to delete this bundle, Thanks.';
		// 	echo json_encode ( $arrRes );
		// 	die();
		// }
	
		
		
		// $bundleDetail = $BundleProductModel->getSpecificBundleProductData($bundleId);
	
		// $productDelete = 
		DB::table ( 'jb_bundle_product_tbl' )->where ( 'BUNDLE_ID', $bundleId )->update (
			array(
				'IS_DELETED' => 1,
				'STATUS' => 'inactive'
			
			)
		);
		// $productVideoDelete = DB::table ( 'jb_bundle_product_line_tbl' )->where ( 'BUNDLE_ID', $bundleId )->delete ();
		
		// if(isset($bundleDetail['path']) && !empty($bundleDetail['path'])){
		// 	unlink($bundleDetail['path']);
		// }
	
	
		$arrRes ['done'] = true;
		$arrRes ['msg'] = 'Bundle deleted successfully...';
	
		echo json_encode ( $arrRes );
	}
	
	public function getAllAdminEmailConfiglov() {
		$EmailConfigModel = new EmailConfigModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['list'] = $EmailConfigModel->getAllEmailConfigData();
			
		echo json_encode ( $arrRes );
	}
	public function editEmailConfigDetails() {
		$EmailConfigModel = new EmailConfigModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$emailConfigId = $details ['recordId'];
	
		$arrRes ['detail'] = $EmailConfigModel->getSpecificEmailConfigDetail($emailConfigId);
			
		echo json_encode ( $arrRes );
	}
	
	public function saveEmailConfigDetails() {
		$EmailConfigModel = new EmailConfigModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
		$data = $details ['email'];
	
		
		if (isset ( $data ) && ! empty ( $data )) {
		
			if ($data ['A_1'] == '') {
		
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['A_1']) > 100) {
			
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Title must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['A_2'] == '') {
			
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subject is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data ['A_2']) > 100) {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Subject must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['A_3'] == '') {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'From Email is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data ['A_3'] != '') {
				if (! filter_var ( $data ['A_3'], FILTER_VALIDATE_EMAIL )) {
					$arrRes ['done'] = false;
					$arrRes ['msg'] = 'Please enter valid Email Address.';
					echo json_encode ( $arrRes );
					die ();
				}
			}
			if (strlen($data ['A_3']) > 100) {
					
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'From Email must be less then 100 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			
		
		
			if ($data ['ID'] == '') {
	
			} else {
		
				$result = DB::table ( 'sys_email_config_tbl' ) ->where ( 'EMAIL_CONFIG_ID', $data ['ID'] ) ->update (
						array ( 'TITLE' => $data['A_1'],
								'SUBJECT' => $data['A_2'],
								'FROM_EMAIL' => $data['A_3'],
								'MESSAGE' => base64_encode($data['A_4']),
								
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
						);
		
				$arrRes ['done'] = true;
				$arrRes ['msg'] = 'Email Settings Updated Successfully';
				$arrRes ['ID'] = $data ['ID'];
				echo json_encode ( $arrRes );
				die ();
			}
		}else{
			$arrRes ['done'] = false;
			$arrRes ['msg'] = 'Something went wrong';
				
			echo json_encode ( $arrRes );
		}
		
	}
	
	public function getAllAdminWebsiteUserslov() {
		$UserModel = new UserModel();
	
		// $details = $_REQUEST ['details'];
		// $userId = $details ['userId'];
	
		$arrRes ['list'] = $UserModel->getAllWebsiteUserData();
			
		echo json_encode ( $arrRes );
	}
	
	public function changeStatusWebsiteUser(Request $request) {
		$UserModel = new UserModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$userDetail = $UserModel->getSpecificUserDetail($recordId);
	
		if(isset($userDetail['status']) && $userDetail['status'] != 'active'){
			$status = 'active';
			$arrRes ['msg'] = 'User Active successfully...';
		}else{
			$status = 'inactive';
			$arrRes ['msg'] = 'User Inactive successfully...';
		}
	
		$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $recordId ) ->update (
				array ( 'USER_STATUS' => $status,
						'UPDATED_BY' => $userId,
						'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
				)
				);
	
		$arrRes ['done'] = true;
	
		echo json_encode ( $arrRes );
	
	}
	
	public function getAllAdminProfilelov() {
		$UserModel = new UserModel();
	
		$details = $_REQUEST ['details'];
		$userId = $details ['userId'];
	
		$arrRes ['detail'] = $UserModel->getSpecificUserDetail($userId);
			
		echo json_encode ( $arrRes );
	}

	public function getSpecificUserShadeNameDetailsAdmin()  {
		$OrderDetailModel = new OrderDetailModel();

		$details = $_REQUEST ['details'];
   		$orderLineId = $details ['orderLineId'];
		
		$arrRes ['shadename'] = $OrderDetailModel->getOrderLineProductShadesNameDetail($orderLineId);
		
		echo json_encode ( $arrRes );
		
	}
	
	public function updateAdminProfile(Request $r){
		$UserModel=new UserModel();
	
		$detail=$_REQUEST['details'];
		$userId=$detail['userId'];
		$data=$detail['user'];
	
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
					$arrRes['msg'] = 'Please enter valid Email Address';
					echo json_encode ( $arrRes );
					die ();
				}
			}
	
			$userdetails = $UserModel->getspecificUserByEmail1($data ['A_3'],$userId);
			
			if(!empty($userdetails)){
				$arrRes['done'] = false;
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
			$userphone = $UserModel->getspecificUserByPhone1($data ['A_4'],$userId);
			if(!empty($userphone)){
				$arrRes['done'] = false;
				$arrRes['msg'] = 'Phone Number already registered';
				echo json_encode ( $arrRes );
				die ();
			}
	
			$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $data ['ID'] ) ->update (
					array ( 'FIRST_NAME' => $data ['A_1'],
							'LAST_NAME' => $data ['A_2'],
							'EMAIL' => $data ['A_3'],
							'PHONE_NUMBER' => $data ['A_4'],
	
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
	
			$arrRes['done'] = true;
			$arrRes['msg'] = 'Admin profile updated successfully...';
			echo json_encode ( $arrRes );
			die ();
	
		}
	}
	
	public function updateAdminPassword(Request $r){
		$UserModel=new UserModel();
	
		$detail=$_REQUEST['details'];
		$userId=$detail['userId'];
		$data=$detail['password'];
	
		if (isset ( $data ) && ! empty ( $data )) {
			if ($data['C_1'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Current Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}
	
			$userdetails = $UserModel->getspecificUserPasswordByUserId($userId);
	
			if($userdetails['ENCRYPTED_PASSWORD'] != $data['C_1']){
				$arrRes['done'] = false;
				$arrRes['msg'] = 'Current Password is incorrect.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['C_2'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'New Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if (strlen($data['C_2']) < 8) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'New Password must be minimum 8 characters.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['C_3'] == '') {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Confirm New Password is required.';
				echo json_encode ( $arrRes );
				die ();
			}
			if ($data['C_2'] != $data['C_3']) {
				$arrRes ['done'] = false;
				$arrRes ['msg'] = 'Confirm Password is not match with New Password.';
				echo json_encode ( $arrRes );
				die ();
			}
	
	
			$result = DB::table ( 'fnd_user_tbl' ) ->where ( 'USER_ID', $userId ) ->update (
					array ( 'ENCRYPTED_PASSWORD' => $data ['C_2'],
	
							'UPDATED_BY' => $userId,
							'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
					)
					);
	
			$arrRes['done'] = true;
			$arrRes['msg'] = 'Admin Password is updated...';
			echo json_encode ( $arrRes );
			die ();
	
		}
	}
	public function getSpecificWebsiteUserDetails() {
		$UserModel = new UserModel();
	
		$details = $_REQUEST ['details'];
		$recordId = $details ['recordId'];
		$userId = $details ['userId'];
	
		$arrRes ['detail'] = $UserModel->getSpecificUserDetail($recordId);
			
		echo json_encode ( $arrRes );
	}

	public function getAllRoutineTypes(){
	
		$TypeName =new TypeName();

		$results['getAllRoutineType']=$TypeName->getAllRoutineTypes();
		$results['routinetypenamelov']=$TypeName->getallroutinetypelov();

		echo json_encode ( $results );

	}

	
	
}
