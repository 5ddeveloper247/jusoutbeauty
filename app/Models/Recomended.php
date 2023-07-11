<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Recomended extends Model
{
    use HasFactory;
    protected $table="jb_product_recommend_tbl";

    protected $fillable = [
        'RECOMENDED_ID',
        'USER_ID',
        'RECOMEDEDPRODUCT_ID',
        'PRODUCT_ID',
    ];

    public function deleteRecomendedProducts($product,$product_id,$userId){

        /* First Deleting Recommended Products */
        foreach ($product as $p){
            $product=DB::table('jb_product_recommend_tbl')->where('PRODUCT_ID',$product_id)->delete();
        }
        //   $status=true;
        //   $message="success";
        //   return response()->json(['status' => $status,'message'=>$message]);

            $i=0;
            foreach ($product as $p){
              $result = DB::table ('jb_product_recommend_tbl' )->insertGetId (
                  array ( 'USER_ID' => $userId,
                          'RECOMEDEDPRODUCT_ID' => isset($p['id']) ? $p['id'] : $p[$i],
                          'PRODUCT_ID' => $product_id,
                          'DATE' => date ( 'Y-m-d H:i:s' ),
                          'CREATED_BY' => $userId,
                          'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
                          'UPDATED_BY' => $userId,
                          'UPDATED_ON' => date ( 'Y-m-d H:i:s' )));
                          $i++;
               }
            $status=true;
            $message="success";
            return response()->json(['status' => $status,'message'=>$message]);
    }


     public function deleteRecomended($product,$product_id){

         DB::beginTransaction();
     try{
         foreach ($product as $p){
             $product=DB::table('jb_product_recommend_tbl')->where('PRODUCT_ID',$product_id )->delete();
           }
          DB::commit();
          $status=true;
          $message="success";
          return response()->json(['status' => $status,'message'=>$message]);

         }catch(\Exception $e){

            DB::rollback();
            $status=false;
            $message=$e->getMessage();
              return response()->json(['status' => $status,'message' =>$message]);
         }
     }

     public function insertRecomended($product,$userId,$product_id){
        DB::beginTransaction();

        try{
                $i=0;
          foreach ($product as $p){
              $result = DB::table ('jb_product_recommend_tbl' )->insertGetId (
                  array ( 'USER_ID' => $userId,
                            'RECOMEDEDPRODUCT_ID' => isset($p['id']) ? $p['id'] : $p[$i],
                          'PRODUCT_ID' => $product_id,
                          'DATE' => date ( 'Y-m-d H:i:s' ),
                          'CREATED_BY' => $userId,
                          'CREATED_ON' => date ( 'Y-m-d H:i:s' ),
                          'UPDATED_BY' => $userId,
                          'UPDATED_ON' => date ( 'Y-m-d H:i:s' )));
                          $i++;
               }
                     DB::commit();

                     $status=true;
                     $message="success";
                     return response()->json(['status' => $status,'message'=>$message]);

        }catch(\Exception $e){

            DB::rollback();
            $status=false;
            $message=$e->getMessage();
            return response()->json(['status' => $status,'message'=>$message]);
        }

   }

   public function getspecificrecomendedlov($product_id){

             $result =DB::table('jb_product_recommend_tbl')->where('PRODUCT_ID',$product_id)->get();
               $i=0;
             foreach($result as $s){
                $arrRes[$i] = $s->RECOMEDEDPRODUCT_ID;
                $i++;
             }
             return isset($arrRes) ? $arrRes : null;
            }


            public function getrecomendedproducts($product_id){

                 $result =DB::table('jb_product_recommend_tbl')->where('PRODUCT_ID',$product_id)->get();

                 $id=array();

                 if($result->count() > 0){
                    $i=0;
                    $k=0;
                    foreach($result as $r){
                        $id[$k]=$r->RECOMEDEDPRODUCT_ID;
                        $k++;
                    }
                    $product=new ProductModel();
                    $ProductShadeModel = new ProductShadeModel();
                    $WishlistModel = new WishlistModel();
                    $ReviewsModel = new ReviewsModel();
                    $limit=4;
                    $userId = session('userId');

                //  foreach($result as $p){

                    $row1 =DB::table('jb_product_tbl as a')->select('a.*', 'jct.CATEGORY_NAME as categoryName', 'jsct.NAME as subCategoryName')
                    ->whereIn('PRODUCT_ID', $id)
                    ->leftJoin ( 'jb_category_tbl as jct', 'a.CATEGORY_ID', '=', 'jct.CATEGORY_ID' )
    	           ->leftJoin ( 'jb_sub_category_tbl as jsct', 'a.SUB_CATEGORY_ID', '=', 'jsct.SUB_CATEGORY_ID' )
    	            ->where('a.STATUS', 'active')
    	            ->orderBy('a.CREATED_BY','asc')->groupBy('a.PRODUCT_ID')
                    ->get();


                     if($row1 !=null){
                        foreach($row1 as $row){

                    $arrRes[$i]['seqNo'] = $i+1;
                    $arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
                    $arrRes[$i]['USER_ID'] = $row->USER_ID;
                    $arrRes[$i]['SLUG'] = $row->SLUG;
                    $arrRes[$i]['NAME'] = $row->NAME;
                    $arrRes[$i]['SUB_TITLE'] = $row->SUB_TITLE;
                    $arrRes[$i]['UNIT'] = $row->UNIT;
                    $arrRes[$i]['MINIMUM_PURCHASE_QUANTITY'] = $row->MINIMUM_PURCHASE_QUANTITY;
                    $arrRes[$i]['TAGS'] = $row->TAGS;
                    $arrRes[$i]['BARCODE'] = $row->BARCODE;
                    $arrRes[$i]['REFUNDABLE_FLAG'] = $row->REFUNDABLE_FLAG;
                    $arrRes[$i]['CATEGORY_ID'] = $row->CATEGORY_ID;
                    $arrRes[$i]['CATEGORY_NAME'] = $row->categoryName;

                    $name = $row->categoryName;
                    $words = explode(' ', $name);
                    if (count($words) > 1 || strpos($name, ' ') !== false) {
                        $name = implode('-', $words);
                    } else {
                        $name = $row->categoryName;
                    }
                    $arrRes[$i]['CATEGORY_SLUG'] = $name;

                    $arrRes[$i]['SUB_CATEGORY_ID'] = $row->SUB_CATEGORY_ID;
                    $arrRes[$i]['SUB_CATEGORY_NAME'] = $row->subCategoryName;

                    $name = $row->subCategoryName;
                    $words = explode(' ', $name);
                    if (count($words) > 1 || strpos($name, ' ') !== false) {
                        $name = implode('-', $words);
                    } else {
                        $name = $row->subCategoryName;
                    }
                    $arrRes[$i]['SUB_CATEGORY_SLUG'] = $name;

                    $arrRes[$i]['SHORT_DESCRIPTION'] = $row->SHORT_DESCRIPTION;
                    $arrRes[$i]['DESCRIPTION_TITLE'] = $row->DESCRIPTION_TITLE;

                    $arrRes[$i]['DESCRIPTION'] = base64_decode($row->DESCRIPTION);
                    $descText = strip_tags(base64_decode($row->DESCRIPTION));
                    $arrRes[$i]['DESCRIPTION_TEXT'] = strlen ( $descText ) > 50?substr ( $descText, 0, 50 )."..." :$descText;
                    $arrRes[$i]['UNIT_PRICE'] = number_format($row->UNIT_PRICE,2);
                    $arrRes[$i]['unitPrice'] = $row->UNIT_PRICE != null ? $row->UNIT_PRICE : '0';
                    $arrRes[$i]['STATUS'] = $row->STATUS;
                    $arrRes[$i]['DISCOUNT'] = $row->DISCOUNT;
                    $arrRes[$i]['DISCOUNT_TYPE'] = $row->DISCOUNT_TYPE;
                    $arrRes[$i]['TAX'] = $row->TAX;
                    $arrRes[$i]['TAX_TYPE'] = $row->TAX_TYPE;
                    $arrRes[$i]['CLINICAL_NOTE'] = base64_decode($row->CLINICAL_NOTE_DESCRIPTION);

                    $productImage = $product->getSpecificProductPrimaryImage($row->PRODUCT_ID);
                    $arrRes[$i]['primaryImage'] = isset($productImage['downPath']) != null ? $productImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

                    $productSecImage = $this->getSpecificProductSecondaryImage($row->PRODUCT_ID);
    		        $arrRes[$i]['secondaryImage'] = isset($productSecImage['downPath']) != null ? $productSecImage['downPath'] : url('assets-web')."/images/product_placeholder.png";

                    $arrRes[$i]['productShades'] = $ProductShadeModel->getAllProductShadesWithImagByProduct($row->PRODUCT_ID);
                    $arrRes[$i]['wishlistFlag'] = $WishlistModel->getSpecificProductExistByUser1($userId, $row->PRODUCT_ID, 1);

                    $reviews = $ReviewsModel->getAllPublishedReviewsByProductId($row->PRODUCT_ID,'');
                    $totalReviews=0;$allRatingSum=0;
                    if(isset($reviews) && !empty($reviews)){
                        $totalReviews = count($reviews);
                        foreach($reviews as $value){

                            $allRatingSum = $allRatingSum+$value['STAR_RATING'];
                        }
                    }

                    if($totalReviews > 0){
                        $averageRating = $allRatingSum/$totalReviews;
                        $averageRating = round($averageRating);
                    }else{
                        $averageRating = 0;
                    }

                    $arrRes[$i]['averageRating'] = $averageRating;

                    $arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
                    $arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
                    $arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
                    $arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

                    $i++;

                 }
             }

            }
             return isset($arrRes) ? $arrRes : null;

         }

         public function getSpecificProductSecondaryImage($id){

            $result = DB::table('jb_product_images_tbl as a')->select('a.*')
            ->where('a.PRODUCT_ID', $id)
            ->where('a.SOURCE_CODE', 'PRODUCT_IMG')
            ->where('a.SECONDARY_FLAG', '1')
            ->get();

            $i=0;
            foreach ($result as $row){
                $arrRes['ID'] = $row->IMAGE_ID;
                $arrRes['userId'] = $row->USER_ID;
                $arrRes['productId'] = $row->PRODUCT_ID;
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
