<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class QuestionModel extends Model
{
    use HasFactory;
    
    public function getAllPublishedQuestionsByProductId($productId='',$bundleId=''){
    
    	if($productId != ''){
    		$where =array(['a.PRODUCT_ID','=',$productId]);
    	}else if($bundleId != ''){
    		$where =array(['a.BUNDLE_ID','=',$bundleId]);
    	}
    	
    	$result = DB::table('jb_questions_tbl as a')->select('a.*')
    	->where($where)
    	->where('a.STATUS', 'published')
    	->orderBy('a.QUESTION_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['QUESTION_ID'] = $row->QUESTION_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['USERNAME'] = $row->USERNAME;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['QUESTION'] = $row->QUESTION;
    		$arrRes[$i]['ANSWER'] = $row->ANSWER != null ? $row->ANSWER : '';
    		$arrRes[$i]['DATE'] = date("M d, Y", strtotime($row->DATE));
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getAllPublishedQuestionsForAdmin(){
    
    	$result = DB::table('jb_questions_tbl as a')->select('a.*')
    	->orderBy('a.UPDATED_ON','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes[$i]['seqNo'] = $row->QUESTION_ID;//$i+1;
    		$arrRes[$i]['QUESTION_ID'] = $row->QUESTION_ID;
    		$arrRes[$i]['USER_ID'] = $row->USER_ID;
    		$arrRes[$i]['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes[$i]['USERNAME'] = $row->USERNAME;
    		$arrRes[$i]['EMAIL'] = $row->EMAIL;
    		$arrRes[$i]['QUESTION'] = $row->QUESTION;
    		$arrRes[$i]['ANSWER'] = $row->ANSWER != null ? $row->ANSWER : '';
    		$arrRes[$i]['DATE'] = date("M d, Y", strtotime($row->DATE));
    		$arrRes[$i]['STATUS'] = $row->STATUS;
    		$arrRes[$i]['STATUS_FLAG'] = $row->STATUS == 'published' ? '1' : '0';
    		$arrRes[$i]['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes[$i]['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes[$i]['UPDATED_ON'] = $row->UPDATED_ON;
    		$arrRes[$i]['UPDATED_BY'] = $row->UPDATED_BY;
    		$i++;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
    
    public function getSpecificQuestionDetails($questionId){
    
    	$result = DB::table('jb_questions_tbl as a')->select('a.*')
    	->where('a.QUESTION_ID',$questionId)
    	->orderBy('a.QUESTION_ID','desc')
    	->get();
    
    	$i=0;
    	foreach ($result as $row){
    		$arrRes['seqNo'] = $i+1;
    		$arrRes['QUESTION_ID'] = $row->QUESTION_ID;
    		$arrRes['USER_ID'] = $row->USER_ID;
    		$arrRes['PRODUCT_ID'] = $row->PRODUCT_ID;
    		$arrRes['USERNAME'] = $row->USERNAME;
    		$arrRes['EMAIL'] = $row->EMAIL;
    		$arrRes['QUESTION'] = $row->QUESTION;
    		$arrRes['ANSWER'] = $row->ANSWER != null ? $row->ANSWER : '';
    		$arrRes['DATE'] = date("M d, Y", strtotime($row->DATE));
    		$arrRes['STATUS'] = strtoupper($row->STATUS);
    		$arrRes['STATUS_FLAG'] = $row->STATUS == 'published' ? '1' : '0';
    		$arrRes['CREATED_ON'] = $row->CREATED_ON;
    		$arrRes['CREATED_BY'] = $row->CREATED_BY;
    		$arrRes['UPDATED_ON'] = $row->UPDATED_ON;
    		$arrRes['UPDATED_BY'] = $row->UPDATED_BY;
    	}
    
    	return isset($arrRes) ? $arrRes : null;
    }
}
