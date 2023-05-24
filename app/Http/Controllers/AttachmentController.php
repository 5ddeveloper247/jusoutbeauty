<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryModel;
use App\Models\IngredientModel;
use App\Models\ProductUsesModel;
use App\Models\ShadeFinderModel;
use DateTime;

class AttachmentController extends Controller
{
       

	  public function uploadRoutineAttachment  (Request $request){
		        
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
		    
			    $path = 	public_path()."/uploads/email/routine";
		    	$downpath= 	url('public')."/uploads/email/routine";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/

				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "170" || $height < "70") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					 $namefile = $sourceId;
					
				 	 $fullpath = $path."/".time().'-'.$namefile.".".$ext;
					 $downpath = $downpath."/".time().'-'.$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_routine_type_tbl' ) ->where ( 'TYPE_ID', $namefile ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
								        	)
									 );
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_routine_type_tbl' ) ->where ( 'TYPE_ID', $namefile ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	  }
	/*===================== admin Ingredient Attachment code start ==========================*/

	public function uploadFeatureAttachment(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
		    
			    $path = 	public_path()."/uploads/email/feature";
		    	$downpath= 	url('public')."/uploads/email/feature";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/

				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "170" || $height < "70") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					 $namefile = $sourceId;
					
				 	 $fullpath = $path."/".time().'-'.$namefile.".".$ext;
					 $downpath = $downpath."/".time().'-'.$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_features_tbl' ) ->where ( 'FEATURE_ID', $namefile ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
								        	)
									 );
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_features_tbl' ) ->where ( 'FEATURE_ID', $namefile ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
		/*===================== admin Ingredient Attachment code End ==========================*/

// 	public function index() {
		
//     	$data['page'] = 'login';
//        	return view('admin.login')->with($data);
//    	}
   	
	/*===================== admin Ingredient Attachment code start ==========================*/
	
	public function uploadIngredientAttachment(Request $request) {

		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
		
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/ingredient";
			$downpath= 	url('public')."/uploads/ingredient";
			
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
				
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
		
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "125" || $height < "125") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
						
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
					
					print(json_encode(array(01)));
					exit;
				}else{
					
					//insert code here
					$namefile = DB::table ( 'jb_ingredient_attachment_tbl' )->insertGetId (
							array ( 'USER_ID' => $userId,
									'INGREDIENT_ID' => $sourceId,
									'SOURCE_CODE' => $sourceCode,
									'FILE_TYPE' => $ext,
									'FILE_NAME' => $fileName,
									'FULL_NAME' => $fileNameFull,
									'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
									'PRIMARY_FLAG' => '0',
									'SECONDARY_FLAG' => '0',
									'CREATED_BY' => $userId,
									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
									'UPDATED_BY' => $userId,
									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
						);
					
					$fullpath = $path."/".$namefile.".".$ext;
					$downpath = $downpath."/".$namefile.".".$ext;
		
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
						
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
							
							$result = DB::table ( 'jb_ingredient_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
								);
							
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
								
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
								
							$result = DB::table ( 'jb_ingredient_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
								);
							
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Ingredient Attachment code end ==========================*/
	
	/*===================== admin Shades Attachment code start ==========================*/

	/*===================== admin Blogs Attachment code start ==========================*/
	
	public function uploadBlogAttachmentSingle(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');

		if (isset($_FILES['uploadatt2']) && ($_FILES['uploadatt2']['size']>0)){
			$path = 	public_path()."/uploads/ourblog";
			$downpath= 	url('public')."/uploads/ourblog";
			if(isset($_FILES['uploadatt2']) && $_FILES['uploadatt2']['error'] == 0){
				
				// $userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				// $sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				// $sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadatt2']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadatt2']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
			 	// if($sourceId == '' ) {
						
				// 	print(json_encode(array(03)));
				// 	exit;
				// }else 
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "620" || $height < "620") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if(!in_array($ext,$allowed) ) {
						
					print(json_encode(array(01)));
					exit;
				}else{
						
					//insert code here
					$namefile = "1";
					
				
					$fullpath = $path."/".time().'_'.$namefile.".".$ext;
					$downpath = $downpath."/".time().'_'.$namefile.".".$ext;
					
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
						if(move_uploaded_file($_FILES['uploadatt2']['tmp_name'], $fullpath)){
								
							$result = DB::table ( 'jb_our_blog_tbl' )->where ( 'ID', '1' )->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											// 'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadatt2']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadatt2']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_our_blog_tbl' ) ->where ( 'ID', '1' ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											// 'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadatt2']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	public function uploadBlogAttachment(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');

		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/blog";
			$downpath= 	url('public')."/uploads/blog";
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
				
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "390" || $height < "150") {
				
					print(json_encode(array(04)));
					exit;
				
				}
			 	if($sourceId == '' ) {
						
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
						
					print(json_encode(array(01)));
					exit;
				}else{
						
					//insert code here
					$namefile = $sourceId;
					
				
					$fullpath = $path."/".time().'_'.$namefile.".".$ext;
					$downpath = $downpath."/".time().'_'.$namefile.".".$ext;
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
								
							$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BlOG_ID', $namefile ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BlOG_ID', $namefile ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	public function uploadBlogDetailAttachment(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/blog";
			$downpath= 	url('public')."/uploads/blog";
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "620" || $height < "620") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					//insert code here
					$namefile = $sourceId;
						
	
					$fullpath = $path."/".time().'_'.$namefile.".".$ext;
					$downpath = $downpath."/".time().'_'.$namefile.".".$ext;
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BlOG_ID', $namefile ) ->update (
									array ( 'IMAGE_DETAIL_PATH' => $fullpath,
											'IMAGE_DETAIL_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_blogs_tbl' ) ->where ( 'BlOG_ID', $namefile ) ->update (
									array ( 'IMAGE_DETAIL_PATH' => $fullpath,
											'IMAGE_DETAIL_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	public function uploadShadesAttachment(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/shades";
			$downpath= 	url('public')."/uploads/shades";
				
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
				
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "24" || $height < "24") {
						
					print(json_encode(array(04)));
					exit;
				
				}
			 	if($sourceId == '' ) {
						
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
						
					print(json_encode(array(01)));
					exit;
				}else{
						
					//insert code here
					$namefile = DB::table ( 'jb_shades_attachment_tbl' )->insertGetId (
							array ( 'USER_ID' => $userId,
									'SHADE_ID' => $sourceId,
									'SOURCE_CODE' => $sourceCode,
									'FILE_TYPE' => $ext,
									'FILE_NAME' => $fileName,
									'FULL_NAME' => $fileNameFull,
									'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
									'PRIMARY_FLAG' => '0',
									'SECONDARY_FLAG' => '0',
									'CREATED_BY' => $userId,
									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
									'UPDATED_BY' => $userId,
									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
							);
						
					$fullpath = $path."/".$namefile.".".$ext;
					$downpath = $downpath."/".$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
								
							$result = DB::table ( 'jb_shades_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_shades_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
						
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Shades Attachment code end ==========================*/
	
	/*===================== admin Product Image Attachment code start ==========================*/
	
	public function uploadProductImageAttachment(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/product/images";
			$downpath= 	url('public')."/uploads/product/images";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "270" || $height < "370") {
					
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					//insert code here
					$namefile = DB::table ( 'jb_product_images_tbl' )->insertGetId (
							array ( 'USER_ID' => $userId,
									'PRODUCT_ID' => $sourceId,
									'SOURCE_CODE' => $sourceCode,
									'FILE_TYPE' => $ext,
									'FILE_NAME' => $fileName,
									'FULL_NAME' => $fileNameFull,
									'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
									'PRIMARY_FLAG' => '0',
									'SECONDARY_FLAG' => '0',
									'CREATED_BY' => $userId,
									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
									'UPDATED_BY' => $userId,
									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
							);
	
					$fullpath = $path."/".$namefile.".".$ext;
					$downpath = $downpath."/".$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_images_tbl' ) ->where ( 'IMAGE_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Product Image Attachment code end ==========================*/
	
	/*===================== admin Product Video Attachment code start ==========================*/
	
	public function uploadProductVideoAttachment(Request $request) {
	
		$allowed =  array('mp4','MP4','webm','WEBM','mov','MOV','wmv','WMV','html5','HTML5','mpeg-2', 'MPEG-2');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/product/videos";
			$downpath= 	url('public')."/uploads/product/videos";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$videoId = isset($_REQUEST['videoId'])?$_REQUEST['videoId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
				
				
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					//insert code here
					if($videoId == ''){
						$namefile = DB::table ( 'jb_product_video_tbl' )->insertGetId (
								array ( 'USER_ID' => $userId,
										'PRODUCT_ID' => $sourceId,
										'SOURCE_CODE' => $sourceCode,
										'FILE_TYPE' => $ext,
										'FILE_NAME' => $fileName,
										'FULL_NAME' => $fileNameFull,
										'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
										'PRIMARY_FLAG' => '0',
										'SECONDARY_FLAG' => '0',
										'CREATED_BY' => $userId,
										'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
										'UPDATED_BY' => $userId,
										'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
								)
							);
					}else{
						$namefile = $videoId;
						$result = DB::table ( 'jb_product_video_tbl' ) ->where ( 'VIDEO_ID', $videoId ) ->update (
								array ( 'USER_ID' => $userId,
										'PRODUCT_ID' => $sourceId,
										'SOURCE_CODE' => $sourceCode,
										'FILE_TYPE' => $ext,
										'FILE_NAME' => $fileName,
										'FULL_NAME' => $fileNameFull,
										'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
										'PRIMARY_FLAG' => '0',
										'SECONDARY_FLAG' => '0',
										'UPDATED_BY' => $userId,
										'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
								)
								);
					}
				
					$fullpath = $path."/".$namefile.".".$ext;
					$downpath = $downpath."/".$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_video_tbl' ) ->where ( 'VIDEO_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_video_tbl' ) ->where ( 'VIDEO_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Product Video Attachment code end ==========================*/
	

	/*===================== admin Product Video Attachment code start ==========================*/
	
	public function uploadProductImageVideoSelfi(Request $request) {
	
		$allowed =  array('mp4','MP4','webm','WEBM','mov','MOV','wmv','WMV','html5','HTML5','mpeg-2', 'MPEG-2',
		'png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadatt6']) && ($_FILES['uploadatt6']['size']>0)){
			$path = 	public_path()."/uploads/productselfie/images";
			$downpath= 	url('public')."/uploads/productselfie/images";
	
			if(isset($_FILES['uploadatt6']) && $_FILES['uploadatt6']['error'] == 0){
	
				
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$pathInfo = pathinfo($_FILES['uploadatt6']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadatt6']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					//insert code here
					$namefile = DB::table ( 'jb_product_selfi_images_tbl' )->insertGetId (
						array ( 'USER_ID' => $userId,
								'SELFIE_ID' => $sourceId,
								'SOURCE_CODE' => $sourceCode,
								'FILE_TYPE' => $ext,
								'FILE_NAME' => $fileName,
								'FULL_NAME' => $fileNameFull,
								'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
								'PRIMARY_FLAG' => '0',
								// 'SECONDARY_FLAG' => '0',
								'CREATED_BY' => $userId,
								'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
								'UPDATED_BY' => $userId,
								'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
						)
					);
					$fullpath = $path."/".$fileName.".".$ext;
					$downpath = $downpath."/".$fileName.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadatt6']['tmp_name'], $fullpath)){
	
							

									$result = DB::table ( 'jb_product_selfi_images_tbl' ) ->where ( 'IMAGE_ID', $namefile ) ->update (
										array ( 'PATH' => $fullpath,
												'DOWN_PATH' => $downpath,
												'UPDATED_BY' => '0',
												'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
										)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadatt6']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	  
					}else{
						if(move_uploaded_file($_FILES['uploadatt6']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_selfi_images_tbl' ) ->where ( 'IMAGE_ID', $namefile ) ->update (
								array ( 'PATH' => $fullpath,
										'DOWN_PATH' => $downpath,
										'UPDATED_BY' => '0',
										'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
								)
							);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadatt6']['name'], '2',$ext)));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Product Video selfi code end ==========================*/
	/*===================== admin Product Image Attachment code start ==========================*/
	
	public function uploadProductShadeImage(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/product/shades";
			$downpath= 	url('public')."/uploads/product/shades";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "270" || $height < "370") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					//insert code here
					$namefile = DB::table ( 'jb_product_shade_images_tbl' )->insertGetId (
							array ( 'USER_ID' => $userId,
									'PRODUCT_SHADE_ID' => $sourceId,
									'SOURCE_CODE' => $sourceCode,
									'FILE_TYPE' => $ext,
									'FILE_NAME' => $fileName,
									'FULL_NAME' => $fileNameFull,
									'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
									'PRIMARY_FLAG' => '0',
									'SECONDARY_FLAG' => '0',
									'CREATED_BY' => $userId,
									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
									'UPDATED_BY' => $userId,
									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
							);
	
					$fullpath = $path."/".$namefile.".".$ext;
					$downpath = $downpath."/".$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'IMAGE_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_shade_images_tbl' ) ->where ( 'IMAGE_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Product Image Attachment code end ==========================*/
	
	/*===================== admin Product Uses Attachment code start ==========================*/
	
	public function uploadProductUsesImage(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/product/uses";
			$downpath= 	url('public')."/uploads/product/uses";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$productUsesId = isset($_REQUEST['usesId'])?$_REQUEST['usesId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "360" || $height < "450") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
					
					$ProductUses = new ProductUsesModel();
					
					$attDetail = $ProductUses->getSpecificProductUsesImage($productUsesId);
					if(isset($attDetail['path']) && $attDetail['path'] != '' ){
						unlink($attDetail['path']);
					}
					
					
					$namefile = $productUsesId;
					$result = DB::table ( 'jb_product_uses_tbl' ) ->where ( 'PRODUCT_USES_ID', $productUsesId ) ->update (
							array ( 'USER_ID' => $userId,
									'PRODUCT_ID' => $sourceId,
									'SOURCE_CODE' => $sourceCode,
									'FILE_TYPE' => $ext,
									'FILE_NAME' => $fileName,
									'FULL_NAME' => $fileNameFull,
									'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
									'PRIMARY_FLAG' => '0',
									'SECONDARY_FLAG' => '0',
									'UPDATED_BY' => $userId,
									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
						);
					
	
					$fullpath = $path."/".time().'-'.$namefile.".".$ext;
					$downpath = $downpath."/".time().'-'.$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_uses_tbl' ) ->where ( 'PRODUCT_USES_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_product_uses_tbl' ) ->where ( 'PRODUCT_USES_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Product Uses Attachment code end ==========================*/
	
	/*===================== admin Shade Finder Attachment code start ==========================*/
	
	public function uploadshadeFinderTypeImage(Request $request) {
		$ShadeFinder = new ShadeFinderModel();
		
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/shadefinder";
			$downpath= 	url('public')."/uploads/shadefinder";
				
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
				
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				$attachmentCounts = $ShadeFinder->getSpecificShadeFinderLevelTypeImagesCount($sourceId);
				
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "200" || $height < "300") {
				
					print(json_encode(array(05)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
						
					print(json_encode(array(01)));
					exit;
				}else if($attachmentCounts >= 3 ) { // allowed attachments
						
					print(json_encode(array(04)));
					exit;
				}else{
						
					//insert code here
					$namefile = DB::table ( 'jb_shade_finder_images_tbl' )->insertGetId (
							array ( 'USER_ID' => $userId,
									'LEVEL_ONE_TYPE_ID' => $sourceId,
									'SOURCE_CODE' => $sourceCode,
									'FILE_TYPE' => $ext,
									'FILE_NAME' => $fileName,
									'FULL_NAME' => $fileNameFull,
									'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
									'PRIMARY_FLAG' => '0',
									'SECONDARY_FLAG' => '0',
									'CREATED_BY' => $userId,
									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
									'UPDATED_BY' => $userId,
									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
							);
						
					$fullpath = $path."/".$namefile.".".$ext;
					$downpath = $downpath."/".$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
								
							$result = DB::table ( 'jb_shade_finder_images_tbl' ) ->where ( 'IMAGE_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_shade_finder_images_tbl' ) ->where ( 'IMAGE_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Shade Finder Attachment code end ==========================*/
	
	/*===================== admin Bundle Product Image code start ==========================*/
	
	public function uploadBundleProductImage(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/bundle/images";
			$downpath= 	url('public')."/uploads/bundle/images";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "270" || $height < "370") {
				
					print(json_encode(array(05)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					//insert code here
// 					$namefile = DB::table ( 'jb_product_images_tbl' )->insertGetId (
// 							array ( 'USER_ID' => $userId,
// 									'PRODUCT_ID' => $sourceId,
// 									'SOURCE_CODE' => $sourceCode,
// 									'FILE_TYPE' => $ext,
// 									'FILE_NAME' => $fileName,
// 									'FULL_NAME' => $fileNameFull,
// 									'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
// 									'PRIMARY_FLAG' => '0',
// 									'SECONDARY_FLAG' => '0',
// 									'CREATED_BY' => $userId,
// 									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
// 									'UPDATED_BY' => $userId,
// 									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
// 							)
// 						);

					$namefile = $sourceId;
					
					$fullpath = $path."/".time().'-'.$namefile.".".$ext;
					$downpath = $downpath."/".time().'-'.$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $namefile ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_bundle_product_tbl' ) ->where ( 'BUNDLE_ID', $namefile ) ->update (
									array ( 'IMAGE_PATH' => $fullpath,
											'IMAGE_DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	/*===================== admin Bundle Product Image code end ==========================*/
	
	public function uploadBannerImage(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/banner/images";
			$downpath= 	url('public')."/uploads/banner/images";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "1170" || $height < "880") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					$namefile = $sourceId;
						
					$fullpath = $path."/".time().'-'.$namefile.".".$ext;
					$downpath = $downpath."/".time().'-'.$namefile.".".$ext;
	
					if (!file_exists($path)) {
	
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){ // success case
							print(json_encode(array(00, $namefile, $downpath, $fullpath, $_FILES['uploadattl']['name'], '1')));
							exit;
						}else{			// error case
							print(json_encode(array(02)));
							exit;
						}
						
					}else{
						
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){		// success case
							print(json_encode(array(00, $namefile, $downpath, $fullpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{				// error case
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	public function uploadBestSellerImage(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/bestexc/images";
			$downpath= 	url('public')."/uploads/bestexc/images";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "630" || $height < "580") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					$namefile = $sourceId;
	
					$fullpath = $path."/".time().'-'.$namefile.".".$ext;
					$downpath = $downpath."/".time().'-'.$namefile.".".$ext;
	
					if (!file_exists($path)) {
	
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){ // success case
							print(json_encode(array(00, $namefile, $downpath, $fullpath, $_FILES['uploadattl']['name'], '1')));
							exit;
						}else{			// error case
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){		// success case
							print(json_encode(array(00, $namefile, $downpath, $fullpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{				// error case
							print(json_encode(array(02)));
							exit;
						}
					}
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	public function uploadTicketAttachment(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/tickets";
			$downpath= 	url('public')."/uploads/tickets";
				
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
						
					print(json_encode(array(01)));
					exit;
				}else{
						
					//insert code here
					$namefile = DB::table ( 'jb_user_tickets_attachment_tbl' )->insertGetId (
							array ( 'USER_ID' => $userId,
									'TICKET_ID' => $sourceId,
									'SOURCE_CODE' => $sourceCode,
									'FILE_TYPE' => $ext,
									'FILE_NAME' => $fileName,
									'FULL_NAME' => $fileNameFull,
									'UPLOAD_DATE_TIME' => date ( 'Y-m-d H:i:s' ),
									'PRIMARY_FLAG' => '0',
									'SECONDARY_FLAG' => '0',
									'CREATED_BY' => $userId,
									'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
									'UPDATED_BY' => $userId,
									'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
							)
							);
						
					$fullpath = $path."/".$namefile.".".$ext;
					$downpath = $downpath."/".$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
								
							$result = DB::table ( 'jb_user_tickets_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'jb_user_tickets_attachment_tbl' ) ->where ( 'ATTACHMENT_ID', $namefile ) ->update (
									array ( 'PATH' => $fullpath,
											'DOWN_PATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
								
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
	
	public function uploadEmailConfigLogo(Request $request) {
	
		$allowed =  array('png','jpg','jpeg','JPEG','PNG','JPG','jpe','jpge','JPGE','JPE','jfif', 'svg', 'SVG', 'gif', 'GIF', 'webp', 'WEBP');
	
		if (isset($_FILES['uploadattl']) && ($_FILES['uploadattl']['size']>0)){
			$path = 	public_path()."/uploads/email/logo";
			$downpath= 	url('public')."/uploads/email/logo";
	
			if(isset($_FILES['uploadattl']) && $_FILES['uploadattl']['error'] == 0){
	
				$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:"0";
				$sourceId = isset($_REQUEST['sourceId'])?$_REQUEST['sourceId']:"";
				$sourceCode = isset($_REQUEST['sourceCode'])?$_REQUEST['sourceCode']:"";
				$pathInfo = pathinfo($_FILES['uploadattl']['name']);
				$ext = $pathInfo['extension'];
				$size = filesize($_FILES['uploadattl']['tmp_name']);//print_r($size);exit;
				$fileName = $pathInfo['filename'];
				$fileNameFull = $pathInfo['filename'].".".$ext;
	
				/*if($size > 5242880){//3145728 now:5mp
				 print(JsonHelper::encode(array(03)));
				 exit;
				 }else{
				 //echo $size;
				 print(JsonHelper::encode(array(02)));
				 exit;
				 }*/
				list ( $width, $height ) = getimagesize ( $_FILES['uploadattl']['tmp_name'] );
				
				if ($width < "170" || $height < "70") {
				
					print(json_encode(array(04)));
					exit;
				
				}
				if($sourceId == '' ) {
	
					print(json_encode(array(03)));
					exit;
				}else if(!in_array($ext,$allowed) ) {
	
					print(json_encode(array(01)));
					exit;
				}else{
	
					$namefile = $sourceId;
					
					$fullpath = $path."/".time().'-'.$namefile.".".$ext;
					$downpath = $downpath."/".time().'-'.$namefile.".".$ext;
	
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
	
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'sys_email_config_tbl' ) ->where ( 'EMAIL_CONFIG_ID', $namefile ) ->update (
									array ( 'LOGO_PATH' => $fullpath,
											'LOGO_DOWNPATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '1')));
							exit;
	
						}else{
							print(json_encode(array(02)));
							exit;
						}
	
					}else{
						if(move_uploaded_file($_FILES['uploadattl']['tmp_name'], $fullpath)){
	
							$result = DB::table ( 'sys_email_config_tbl' ) ->where ( 'EMAIL_CONFIG_ID', $namefile ) ->update (
									array ( 'LOGO_PATH' => $fullpath,
											'LOGO_DOWNPATH' => $downpath,
											'UPDATED_BY' => $userId,
											'UPDATED_ON' => date ( 'Y-m-d H:i:s' )
									)
									);
	
							print(json_encode(array(00, $namefile, $downpath, $_FILES['uploadattl']['name'], '2')));
							exit;
						}else{
							print(json_encode(array(02)));
							exit;
						}
					}
	
				}
			}else{
				print(json_encode(array(02)));
				exit;
			}
	
		}else{
			print(json_encode(array(02)));
			exit;
		}
	}
}
?>
