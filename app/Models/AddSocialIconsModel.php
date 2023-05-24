<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class AddSocialIconsModel extends Model
{
    use HasFactory;

	protected $table="jb_footer_control_tbl";

	public $timestamps=false;


public function getFooterdata(){

    $result = DB::table('jb_footer_control_tbl')->where('CONTROL_ID',1)->first();
	return  $result;
	}
	
	public function getAllFooterSpcialIcons(){
	
		$result = DB::table('jb_footer_control_tbl as a')->select('a.*')
		->where('a.CONTROL_ID','1')
		->get();
	
		$i=0;
		foreach ($result as $row){
			$arrRes['controlId'] = $row->CONTROL_ID;
			$arrRes['facebookLink'] = $row->FACEBOOK_ICON_LINK;
			$arrRes['facebookEnable'] = $row->FACEBOOK_ICON_ENABLE;
			$arrRes['instagramLink'] = $row->INSTAGRAM_ICON_LINK;
			$arrRes['instagramEnable'] = $row->INSTAGRAM_ICON_ENABLE;
			$arrRes['twitterLink'] = $row->TWITTER_ICON_LINK;
			$arrRes['twitterEnable'] = $row->TWITTER_ICON_ENABLE;
			$arrRes['linkedInLink'] = $row->LINKEDIN_ICON_LINK;
			$arrRes['linkedInEnable'] = $row->LINKEDIN_ICON_ENABLE;
			$arrRes['youtubeLink'] = $row->YOUTUBE_ICON_LINK;
			$arrRes['youtubeEnable'] = $row->YOUTUBE_ICON_ENABLE;
			
		}
	
		return isset($arrRes) ? $arrRes : null;
	}

}
