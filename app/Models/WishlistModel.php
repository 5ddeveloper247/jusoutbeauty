<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class WishlistModel extends Model
{
    use HasFactory;

    public function getSpecificProductExistByUser($userId, $productId){

    	$result = DB::table('jb_user_wishlist_tbl as a')->select('a.*')
    	->where('a.USER_ID',$userId)
    	->where('a.PRODUCT_ID',$productId)
    	->get();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes = '1';
    	}

    	return isset($arrRes) ? $arrRes : '0';
    }
    public function getSpecificProductExistByUser1($userId, $productId, $flag){  // flag = 1 for product and 2 for bundle

    	if($flag == '1'){
    		$result = DB::table('jb_user_wishlist_tbl as a')->select('a.*')
    		->where('a.USER_ID',$userId)
    		->where('a.PRODUCT_ID',$productId)
    		->get();
    	}else if($flag == '2'){
    		$result = DB::table('jb_user_wishlist_tbl as a')->select('a.*')
    		->where('a.USER_ID',$userId)
    		->where('a.BUNDLE_ID',$productId)
    		->get();
    	}


    	$i=0;
    	foreach ($result as $row){
    		$arrRes = '1';
    	}

    	return isset($arrRes) ? $arrRes : '0';
    }

	public function getWishlistCountByUserId( $userId ){

    	$result = DB::table('jb_user_wishlist_tbl')->where('USER_ID', $userId)->count();

    	$i=0;
    	foreach ($result as $row){
    		$arrRes = $row;
    	}

    	return isset($arrRes) ? $arrRes : '0';
    }

    public function getAllWishlistDataByUser($userId){
    	$ProductModel = new ProductModel();
    	$ProductShade = new ProductShadeModel();
        $userDashboardModel = new UserdashboardModel();

    	// $result = DB::table('jb_user_wishlist_tbl as a')->select('a.*','a.PRODUCT_TYPE','jpt.NAME as productName',
		//     			'jpt.UNIT_PRICE as productPrice', 'jpt.UNIT as productUnit','jpt.CATEGORY_ID',
        //                 'jpt.SUB_CATEGORY_ID','ctbl.CATEGORY_NAME as categoryname','sctbL.NAME as subcategoryname',
        //                 'jbpt.CATEGORY_ID as bctid',
        //                 'jbpt.SUB_CATEGORY_ID as bsctid',
		//     			'jbpt.NAME as bundleName', 'jbpt.DISCOUNTED_AMOUNT as bundlePrice',
		//     			'jbpt.UNIT as bundleUnit','jbpt.IMAGE_DOWN_PATH as bundleImage')
        //         ->join('jb_category_tbl as ctbl','jpt.CATEGORY_ID','=','ctbl.CATEGORY_ID')
        //         ->join('jb_sub_category_tbl as sctbl','jpt.SUB_CATEGORY_ID','=','sctbl.SUB_CATEGORY_ID')
    	// 		->leftjoin ( 'jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID' )
    	// 		->leftjoin ( 'jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID' )
        //         ->join('jb_bundle_product_tbl as jbpt','jbpt.CATEGORY_ID','=','ctbl.CATEGORY_ID')
        //         ->join('jb_bundle_product_tbl as jbpt','jbpt.SUB_CATEGORY_ID','=','sctbl.SUB_CATEGORY_ID')
    	// 		->where('a.USER_ID', $userId)
    	// 		->orderBy('a.WISHLIST_ID', 'desc')
    	// 		->get();
        $result = DB::table('jb_user_wishlist_tbl as a')
    ->select('a.*', 'a.PRODUCT_TYPE', 'jpt.NAME as productName','jpt.SLUG', 'jpt.UNIT_PRICE as productPrice', 'jpt.UNIT as productUnit', 'jpt.CATEGORY_ID','jpt.DISCOUNT_TYPE','jpt.DISCOUNT',
        'jpt.SUB_CATEGORY_ID', 'ctbl.CATEGORY_NAME as categoryname', 'sctbl.NAME as subcategoryname','jpt.QUANTITY',
        'jbpt.CATEGORY_ID as bctid', 'jbpt.SUB_CATEGORY_ID as bsctid', 'jbpt.NAME as bundleName', 'jbpt.DISCOUNTED_AMOUNT as bundlePrice',
        'jbpt.UNIT as bundleUnit', 'jbpt.IMAGE_DOWN_PATH as bundleImage')
    ->leftjoin('jb_product_tbl as jpt', 'a.PRODUCT_ID', '=', 'jpt.PRODUCT_ID')
    ->leftjoin('jb_bundle_product_tbl as jbpt', 'a.BUNDLE_ID', '=', 'jbpt.BUNDLE_ID')
    ->join('jb_category_tbl as ctbl', 'jpt.CATEGORY_ID', '=', 'ctbl.CATEGORY_ID')
    ->leftJoin('jb_sub_category_tbl as sctbl', 'jpt.SUB_CATEGORY_ID', '=', 'sctbl.SUB_CATEGORY_ID')
    ->where('a.USER_ID', $userId)
    ->orderBy('a.WISHLIST_ID', 'desc')
    ->get();

        // dd($result);
    			$i=0;
    			foreach ($result as $row){
    				$arrRes[$i]['seqNo'] = $i+1;
    				$arrRes[$i]['WISHLIST_ID'] = $row->WISHLIST_ID;
    				$arrRes[$i]['USER_ID'] = $row->USER_ID;
    				$arrRes[$i]['DATE'] = date ( 'M d, Y', strtotime ( $row->DATE ) );

    				$arrRes[$i]['flag'] = $row->PRODUCT_TYPE;

    				if($row->PRODUCT_TYPE == 'product'){
    					$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    					$arrRes[$i]['productName'] = $row->productName;
                        $arrRes[$i]['SLUG'] = $row->SLUG;
                        $arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
                        $arrRes[$i]['CATEGORY_NAME'] = $row->categoryname;

                        $name = $row->categoryname;
                        $words = explode(' ', $name);
                        if (count($words) > 1 || strpos($name, ' ') !== false) {
                            $name = implode('-', $words);
                        } else {
                            $name = $row->categoryname;
                        }
                        $arrRes[$i]['CATEGORY_SLUG'] = $name;

                        $arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
                        $arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subcategoryname;

                        $name = $row->subcategoryname;
                        $words = explode(' ', $name);
                        if (count($words) > 1 || strpos($name, ' ') !== false) {
                            $name = implode('-', $words);
                        } else {
                            $name = $row->subcategoryname;
                        }

                        $productShades = $ProductShade->getAllProductShadesProduct($row->PRODUCT_ID);

                        if(!empty($productShades)){

                        	$arrRes[$i]['INV_QUANTITY_FLAG'] = 'shade';
                        	$arrRes[$i]['INV_QUANTITY'] = '';
                        }else{
                        	$arrRes[$i]['INV_QUANTITY_FLAG'] = 'inv';
                        	$arrRes[$i]['INV_QUANTITY'] = $row->QUANTITY != null ? $row->QUANTITY : '0';
                        }

    					$arrRes[$i]['productUnit'] = $row->productUnit;
    					$arrRes[$i]['unitPrice'] = number_format($row->productPrice,2);
                        $arrRes[$i]['DISC_AMOUNT'] = $userDashboardModel->get_discounted_value_of_product($row->productPrice,$row->DISCOUNT_TYPE,$row->DISCOUNT);

    					$productImage = $ProductModel->getSpecificProductPrimaryImage($row->PRODUCT_ID);
    					$arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

    				}else{

    					$arrRes[$i]['PRODUCT_ID'] = $row->BUNDLE_ID;
    					$arrRes[$i]['productName'] = $row->bundleName;
    					$arrRes[$i]['productUnit'] = $row->bundleUnit;
    					$arrRes[$i]['unitPrice'] = number_format($row->bundlePrice, 2);
                        $arrRes[$i]['SLUG'] = $row->SLUG;
                        $arrRes[$i]['CATEGORY_ID'] = $row->bctid;
                        $arrRes[$i]['CATEGORY_NAME'] = $row->categoryname;
                        $name = $row->categoryname;
                        $words = explode(' ', $name);
                        if (count($words) > 1 || strpos($name, ' ') !== false) {
                            $name = implode('-', $words);
                        } else {
                            $name = $row->categoryname;
                        }
                        $arrRes[$i]['CATEGORY_SLUG'] = $name;

                        $arrRes[$i]['SUB_CATEGORY_ID'] = $row->bsctid;
                        $arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subcategoryname;

                        $name = $row->subcategoryname;
                        $words = explode(' ', $name);
                        if (count($words) > 1 || strpos($name, ' ') !== false) {
                            $name = implode('-', $words);
                        } else {
                            $name = $row->subcategoryname;
                        }

    					$arrRes[$i]['primaryImage'] = isset($row->bundleImage) != null ? $row->bundleImage : url('assets-web')."/images/product_placeholder.png";
    				}

                    $arrRes[$i]['SUB_CATEGORY_SLUG'] = $name;
    				$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    				$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    				$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    				$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

    				$i++;
    			}

    			return isset($arrRes) ? $arrRes : null;
    }
//     public function getSpecificCategoryData($id){

//     	$result = DB::table('jb_category_tbl as a')->select('a.*')
//     	->where('a.CATEGORY_ID',$id)
//     	->orderBy('a.CATEGORY_ID','desc')
//     	->get();

//     	$i=0;
//     	foreach ($result as $row){
//     		$arrRes['ID'] = $row->CATEGORY_ID;
//     		$arrRes['NAME'] = $row->CATEGORY_NAME;
//     		$arrRes['USER_ID'] = $row->USER_ID;
//     		$arrRes['STATUS'] = $row->STATUS;
//     		$arrRes['DATE'] = $row->DATE;
//     		$arrRes['CREATED_BY'] = $row->CREATED_BY;
//     		$arrRes['CREATED_ON'] = $row->CREATED_ON;
//     		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
//     		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;

//     		$i++;
//     	}

//     	return isset($arrRes) ? $arrRes : null;
//     }


}
