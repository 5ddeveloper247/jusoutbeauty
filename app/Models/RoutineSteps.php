<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class RoutineSteps extends model
{

  protected $table = "jb_routine_type_steps_tbl";
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'STEP_ID',
    'USER_ID',
    'ROUTINETYPE_ID',
    'ROUTINE_ID',
    'PRODUCT_ID',
    'STEP_NO',
    'DESCRIPTION',
    'DATE',
    'CREATED_BY',
    'CREATED_ON',
    'UPDATED_BY',
    'UPDATED_ON',
  ];

  public function getsteps($id, $typename)
  {

    $result = DB::table('jb_routine_type_steps_tbl as a')->select('a.*')
      ->where('a.ROUTINETYPE_ID', $id)
      ->orderBy('a.UPDATED_ON', 'desc')
      ->get();


    if ($result) {

      $i = 0;

      foreach ($result as $row) {

        // foreach ($result as $row){
        $arrRes[$i]['seqNo'] = $row->STEP_ID; //$i+1;
        $arrRes[$i]['USER_ID'] = $row->USER_ID;
        $arrRes[$i]['NAME'] = $typename;
        $arrRes[$i]['DESCRIPTION'] = $row->DESCRIPTION;
        $arrRes[$i]['STEP_NO'] = $row->STEP_NO;
        $result = DB::table('jb_product_tbl as a')->select('a.*')
          ->where('a.PRODUCT_ID', $row->PRODUCT_ID)
          ->orderBy('a.UPDATED_ON', 'desc')
          ->first();

        $arrRes[$i]['PRODUCT_NAME'] = isset($result->NAME) ? $result->NAME : '';
        $arrRes[$i]['PRODUCT_ID'] = isset($result->PRODUCT_ID) ? $result->PRODUCT_ID : '';

        $result2 = DB::table('jb_product_images_tbl as a')->select('a.*')
          ->where('a.PRODUCT_ID', $row->PRODUCT_ID)
          ->first();

        $arrRes[$i]['downPath'] = isset($result2->DOWN_PATH) ? $result2->DOWN_PATH : '';
        $arrRes[$i]['DATE'] = $row->DATE;
        $arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
        $arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
        $arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
        $arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;

        $i++;
      }
    }


    // }

    return isset($arrRes) ? $arrRes : null;
  }
  public function getRoutineSteps($id)
  {

    $result = DB::table('jb_routine_type_steps_tbl as a')->select('a.*','b.TYPE_NAME')
      ->join('jb_routine_type_tbl as b','a.ROUTINETYPE_ID','=','b.ROUTINETYPE_ID')
      ->where('a.ROUTINE_ID', $id)
      ->orderBy('a.CREATED_ON', 'desc')
      ->get();


    if ($result) {

      $i = 0;

      foreach ($result as $row) {

        // foreach ($result as $row){
        $arrRes[$i]['seqNo'] = $row->STEP_ID; //$i+1;
        $arrRes[$i]['USER_ID'] = $row->USER_ID;
        $arrRes[$i]['TYPE_NAME'] = $row->TYPE_NAME;
        $arrRes[$i]['PRODUCT_NAME'] = $this->getProductName($row->PRODUCT_ID);
        // $arrRes[$i]['IS_DELETED'] = $this->getProductDeleteStatus($row->PRODUCT_ID);
        $arrRes[$i]['DESCRIPTION'] = $row->DESCRIPTION;
        $arrRes[$i]['STEP_NO'] = $row->STEP_NO;
        $arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
        $arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
        $arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
        $arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;



        $i++;
      }
    }


    // }

    return isset($arrRes) ? $arrRes : null;
  }
  public function getProductName($productID){
    $result = DB::table('jb_product_tbl as a')->select('a.NAME','a.IS_DELETED')
            ->where('a.PRODUCT_ID',$productID)->first();

      return isset($result) ? $result : null;
  }

  public function getProductDeleteStatus($productID){
    $result = DB::table('jb_product_tbl as a')->select('a.IS_DELETED')
            ->where('a.PRODUCT_ID',$productID)->first();

      return isset($result->NAME) ? $result->NAME : null;
  }

  public function getstepsbasedonroutine($recordId)
  {

    $ROUTINETYPE = new RoutineType();
    $routinetypename = new TypeName();

    $type = $routinetypename->getallnamedata($recordId);
    $arrRes['alltypenamedata'] = $type;
    $typeid = [];
    $steps_array = [];


    if ($type) {
      foreach ($type as $data) {
        $typeid[] = $data['id'];
        $typename[] = $data['name'];
      }
      $k = 0;

      foreach ($typeid as $v => $id_type) {
        foreach ($typename as $b => $name)
          if ($v == $b) {
            $steps2 = $this->getsteps($id_type, $name);

            if ($steps2) {
              $arr[$k] = $steps2;
              $k++;
            }
          }
      }
      $j = 0;
      if (isset($arr)) {
        foreach ($arr as $r) {
          foreach ($r as $k) {
            $steps_array[$j] = $k;
            $j++;
          }
        }
      }
    }

    return  $steps_array;
  }
}
