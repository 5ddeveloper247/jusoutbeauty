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


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'fnd_user_tbl';
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

    public function getTotalUsers(){

        $totalUsers = DB::table('fnd_user_tbl')
                      ->where('USER_TYPE','user')
                      ->count();
        return isset($totalUsers) ? $totalUsers : null;
    }

    public function getAdminUsers(){

        $AdminUsers = DB::table('fnd_user_tbl')
                           ->where('USER_TYPE','admin')
                           ->select('FIRST_NAME','LAST_NAME','USER_ID')
                           ->get();
        return isset($AdminUsers) ? $AdminUsers : null;

    }

    public function getTotalOrders(){

        $totalOrders=DB::table('jb_order_tbl')->count();
        return isset($totalOrders) ? $totalOrders : null;
    }

    // public function getTotalPayments(){

    //     $Payments=DB::table('jb_order_payment_tbl')->count();
    //     $totalPayments=DB::table('jb_order_payment_tbl')
    //                    ->where('PAYMENT_STATUS','paid')
    //                    ->where('TRANSACTION_STATUS','succeeded')
    //                    ->select('TRANSACTION_RESPONSE')
    //                    ->get();

    //     $totalCost=0;
    //     for($i=0;$i<$Payments;$i++){
    //         $transactional_response=$totalPayments[$i]->TRANSACTION_RESPONSE;
    //         $decode_transactional_response=json_decode($transactional_response);
    //         $totalCost=$decode_transactional_response->amount + $totalCost;
    //     }
    //     dd($totalCost);
    //     $totalCostInDollars=round($totalCost / 100);

    //     if ($totalCostInDollars < 900) {
    //         // 0 - 900
    //         $n_format = number_format($totalCostInDollars, 1);
    //         $suffix = '';
    //     } else if ($totalCostInDollars < 900000) {
    //         // 0.9k-850k
    //         $n_format = number_format($totalCostInDollars / 1000, 1);
    //         $suffix = 'K';
    //     } else if ($totalCostInDollars < 900000000) {
    //         // 0.9m-850m
    //         $n_format = number_format($totalCostInDollars / 1000000, 1);
    //         $suffix = 'M';
    //     } else if ($totalCostInDollars < 900000000000) {
    //         // 0.9b-850b
    //         $n_format = number_format($totalCostInDollars / 1000000000, 1);
    //         $suffix = 'B';
    //     } else {
    //         // 0.9t+
    //         $n_format = number_format($totalCostInDollars / 1000000000000, 1);
    //         $suffix = 'T';
    //     }

    //     // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    //     // Intentionally does not affect partials, eg "1.50" -> "1.50"

    //     if ( 1 > 0 ) {
    //         $dotzero = '.' . str_repeat( '0', 1 );
    //         $n_format = str_replace( $dotzero, '', $n_format );
    //     }

    //     $totalCostInDollars=$n_format . $suffix;

    //     return isset($totalCostInDollars) ?  $totalCostInDollars :null;

    // }
    public function getTotalPayments()
{
    $Payments = DB::table('jb_order_payment_tbl')->count();

    $totalPayments = DB::table('jb_order_payment_tbl')
                    ->where('PAYMENT_STATUS', 'paid')
                    ->where('TRANSACTION_STATUS', 'succeeded')
                    ->select('TRANSACTION_RESPONSE')
                    ->get();

    $totalCost = 0;

    for ($i = 0; $i < $Payments; $i++) {
        $transactional_response = $totalPayments[$i]->TRANSACTION_RESPONSE;
        $decode_transactional_response = json_decode($transactional_response);
        $totalCost = $decode_transactional_response->amount + $totalCost;
    }

    // Debugging: Print the total cost
    // dd($totalCost);

    $totalCostInDollars = round($totalCost, 2);

    $suffixes = ['', 'K', 'M', 'B', 'T'];
    $suffixIndex = 0;

    while ($totalCostInDollars >= 900 && $suffixIndex < count($suffixes)) {
        $totalCostInDollars /= 1000;
        $suffixIndex++;
    }

    if (intval($totalCostInDollars) == $totalCostInDollars) {
        $totalCostInDollars = intval($totalCostInDollars);
    }

    $formattedValue = number_format($totalCostInDollars, 2) . $suffixes[$suffixIndex];

    return isset($formattedValue) ? $formattedValue : null;
}


    public function getTotalProducts(){

        $totalProducts = DB::table('jb_product_tbl')
                         ->where('IS_DELETED','0')
                         ->count();
        return isset($totalProducts) ? $totalProducts :null;
    }

    public function getTotalTickets(){

        $totalTickets = DB::table('jb_user_tickets_tbl')
                        ->where('STATUS','open')
                        ->count();
        return isset($totalTickets) ?  $totalTickets :null;
    }

    public function getTotalBlogs(){

        $totalBlogs = DB::table('jb_blogs_tbl')->count();
        return isset($totalBlogs) ?  $totalBlogs:null;
    }

    public function getTotalBundles(){

        $totalBundles = DB::table('jb_bundle_product_tbl')
                        ->where('IS_DELETED','0')
                        ->count();
        return isset($totalBundles) ?  $totalBundles:null;
    }

    public function getTotalShippedOrders(){

        $totalShippedOrders = DB::table('jb_order_shippment_tracking_tbl')
                              ->where('STATUS','shipped')
                              ->count();
        return isset( $totalShippedOrders) ? $totalShippedOrders : null;
    }

    public function getTotalSubscriptions(){

        $totalSubscriptions = DB:: table('jb_user_subscription_tbl')
                              ->where('SUBSCRIPTION_STATUS','active')
                              ->count();
        return isset($totalSubscriptions ) ? $totalSubscriptions :null;
    }


    public function getTotalGivings()
    {
        $totalGivings = DB::table('jb_giving_tbl')
                        ->where('PAYMENT_STATUS', 'PAID')
                        ->sum('AMOUNT');

        $totalCostInDollars = round($totalGivings, 2);

        $suffixes = ['', 'K', 'M', 'B', 'T'];
        $suffixIndex = 0;

        while ($totalCostInDollars >= 900 && $suffixIndex < count($suffixes)) {
            $totalCostInDollars /= 1000;
            $suffixIndex++;
        }

        $formattedValue = number_format($totalCostInDollars, 2) . $suffixes[$suffixIndex];

        return $formattedValue;
    }


    // public function getTotalGivings(){

    //     $totalGivings = DB:: table('jb_giving_tbl')
    //                     ->where('PAYMENT_STATUS', 'PAID')
    //                     ->sum('AMOUNT');


    //     // $totalCostInDollars=round($totalGivings / 100);
    //     $totalCostInDollars=round($totalGivings);

    //     // dd($totalCostInDollars);
    //     if ($totalCostInDollars < 900) {
    //         // 0 - 900
    //         $n_format = number_format($totalCostInDollars, 2);
    //         $suffix = '';
    //     } else if ($totalCostInDollars < 900000) {
    //         // 0.9k-850k
    //         $n_format = number_format($totalCostInDollars / 1000, 2);
    //         $suffix = 'K';
    //     } else if ($totalCostInDollars < 900000000) {
    //         // 0.9m-850m
    //         $n_format = number_format($totalCostInDollars / 1000000, 2);
    //         $suffix = 'M';
    //     } else if ($totalCostInDollars < 900000000000) {
    //         // 0.9b-850b
    //         $n_format = number_format($totalCostInDollars / 1000000000, 2);
    //         $suffix = 'B';
    //     } else {
    //         // 0.9t+
    //         $n_format = number_format($totalCostInDollars / 1000000000000, 2);
    //         $suffix = 'T';
    //     }

    //     // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
    //     // Intentionally does not affect partials, eg "1.50" -> "1.50"

    //     $dotzero = '.' . str_repeat( '0', 1 );
    //     $n_format = str_replace( $dotzero, '', $n_format );
    //     $totalCostInDollars=$n_format . $suffix;
    //     $totalGivings=$totalCostInDollars;

    //     return isset($totalGivings) ? $totalGivings :null;
    // }

    public function getTotalReviews(){

        $totalReviews = DB::table('jb_reviews_tbl')->count();
        return isset( $totalReviews) ?  $totalReviews :null;
    }

    public function getTotalInTransitOrders(){
        $getTotalInTransitOrders = DB::table('jb_order_shippment_detail_tbl')
            ->where('STATUS','In-Transit')
            ->count();
        return isset( $getTotalInTransitOrders) ?  $getTotalInTransitOrders :null;
    }

    public function mostSaleItems(){
		$result = DB::table('jb_product_tbl as p')
		->join('jb_order_detail_tbl as o', 'p.product_id', '=', 'o.product_id')
        ->join('jb_category_tbl as c','p.CATEGORY_ID','=','c.CATEGORY_ID')
		->select('p.PRODUCT_ID','p.name','c.CATEGORY_NAME','p.QUANTITY','p.UNIT_PRICE' ,'o.TOTAL_AMOUNT_INC_VAT')
		->distinct('p.product_id')
		->orderBy('o.TOTAL_AMOUNT_INC_VAT', 'DESC')
		->limit(10)
		->get();

        $arrRes = [];

    	for ($i=0 ; $i < count($result);$i++){
            $arrRes[$i]['productName'] = $result[$i]->name;
            $arrRes[$i]['categoryName'] = $result[$i]->CATEGORY_NAME;
            $arrRes[$i]['productTotalUnits'] = $this->getShadesQuantity($result[$i]->PRODUCT_ID) == null ?  $result[$i]->QUANTITY : $this->getShadesQuantity($result[$i]->PRODUCT_ID) ;
            $arrRes[$i]['productprice'] = $result[$i]->UNIT_PRICE;
            $arrRes[$i]['revenue'] = $this->getRevevueWRTProductID($result[$i]->PRODUCT_ID);
            $productimage = $this->getProductImage($result[$i]->PRODUCT_ID);
            $arrRes[$i]['productImage'] = isset($productimage->DOWN_PATH) ? $productimage->DOWN_PATH : '';
        }

        return isset( $arrRes) ?  $arrRes :null;
	}

    public function getShadesQuantity($PRODUCT_ID){
        $result = DB::table('jb_product_shades_tbl as j')
        ->select('j.Quantity')
        ->where('j.PRODUCT_ID',$PRODUCT_ID)
        ->select('j.Quantity')
        ->get();

        $totalShadeQuantity=0;
        for($i=0;$i<count($result);$i++){
            $shadeQuantity=$result[$i]->Quantity;
            $totalShadeQuantity=$shadeQuantity + $totalShadeQuantity;
        }

        return isset($totalShadeQuantity) ?  $totalShadeQuantity :null;
    }

    public function getRevevueWRTProductID($PRODUCT_ID)
    {
        // Calculation of Revenue Through Total Transaction Made with status PAID

        $result = DB::table('jb_order_detail_tbl as o')
        ->join('jb_order_payment_tbl as p','p.ORDER_ID','=','o.ORDER_ID')
        ->select('p.TRANSACTION_RESPONSE')
        ->where('o.PRODUCT_ID',$PRODUCT_ID)
        ->where('PAYMENT_STATUS','paid')
        ->where('TRANSACTION_STATUS','succeeded')
        ->select('TRANSACTION_RESPONSE')
        ->get();

        $totalRevenue=0;
        for($i=0;$i<count($result);$i++){
            $transactional_response=$result[$i]->TRANSACTION_RESPONSE;
            $decode_transactional_response=json_decode($transactional_response);
            $totalRevenue=$decode_transactional_response->amount + $totalRevenue;
        }

        $totalRevenue=round($totalRevenue / 100);

        if ($totalRevenue < 900) {
            // 0 - 900
            $n_format = number_format($totalRevenue, 1);
            $suffix = '';
        } else if ($totalRevenue < 900000) {
            // 0.9k-850k
            $n_format = number_format($totalRevenue / 1000, 1);
            $suffix = 'K';
        } else if ($totalRevenue < 900000000) {
            // 0.9m-850m
            $n_format = number_format($totalRevenue / 1000000, 1);
            $suffix = 'M';
        } else if ($totalRevenue< 900000000000) {
            // 0.9b-850b
            $n_format = number_format($totalRevenue / 1000000000, 1);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($totalRevenue / 1000000000000, 1);
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"

        if ( 1 > 0 ) {
            $dotzero = '.' . str_repeat( '0', 1 );
            $n_format = str_replace( $dotzero, '', $n_format );
        }

        $totalRevenue=$n_format . $suffix;

        return isset($totalRevenue) ?  $totalRevenue :null;

        // Calculation of Revenue Through Total Orders Price
        // $result = DB::table('jb_product_tbl as p')
        // ->join('jb_order_detail_tbl as o', 'p.product_id', '=', 'o.product_id')
        // ->select(DB::raw('SUM(o.total_amount)'))
        // ->where('p.product_id', '=', $PRODUCT_ID)
        // ->get();

        // return isset( $result[0]->SUM(o.total_amount) ) ?  $result[0] :null;
    }

    public function getProductImage($PRODUCT_ID)
    {
        $result = DB::table('jb_product_images_tbl as pi')
        ->where('pi.PRODUCT_ID', '=', $PRODUCT_ID)
        ->select('pi.DOWN_PATH')
        ->first();

        return isset( $result ) ?  $result :null;
    }

    public function getLineChartDetails()
    {
        $arrRes['month'] = [];
        $arrRes['total_orders'] = [];
        for ($i = 6; $i > 0; $i--) {
            $monthInterval = $i; // The number of months ago you want to query for
            $currentDate = now();
            $targetDate = $currentDate->subMonths($monthInterval);

            $result = DB::table('jb_order_detail_tbl')
            ->select(DB::raw("DATE_FORMAT((DATE_SUB(curdate(), INTERVAL $monthInterval MONTH)), '%b-%y') AS month"))
            ->selectRaw('COUNT(*) AS total_orders')
            ->whereRaw('DATE_FORMAT(CREATED_ON, "%m %Y") = ?', [$targetDate->format('m Y')])
            ->get('total_orders','month')[0];
            array_push($arrRes['month'],(string)$result->month);
            array_push($arrRes['total_orders'],(int)$result->total_orders);

        }
        // dd($arrRes);
        return isset( $arrRes) ?  $arrRes :null;

    }



    public function getAllAdminUsersWRTSubUsers($id){

             $result = DB::table('fnd_user_tbl')
				        ->where('USER_TYPE','admin')
                        ->select('USER_ID','EMAIL','USER_NAME','USER_TYPE','ENCRYPTED_PASSWORD','USER_STATUS','FIRST_NAME','LAST_NAME')
                        ->latest('CREATED_ON','UPDATED_ON')
				        ->get();

        return isset( $result) ?  $result :null;

    }

    public function getAdminUserDetails($id){

        $user_id = $id;

        $result = DB::table('fnd_user_tbl')
        ->where('USER_ID','=', $user_id)
        ->first();

        return isset( $result) ?  $result :null;
    }

    public function getAllNavLinks(){

       $result = DB :: table('fnd_user_menu_tbl')
                ->select('MENU_NAME','MENU_ID')
                ->get();

        return isset($result) ? $result :null;
    }

}
