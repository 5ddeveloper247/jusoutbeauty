<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
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

    public function getTotalOrders(){

        $totalOrders=DB::table('jb_order_tbl')->count();
        return isset($totalOrders) ? $totalOrders : null;
    }

    public function getTotalPayments(){

        $Payments=DB::table('jb_order_payment_tbl')->count();
        $totalPayments=DB::table('jb_order_payment_tbl')
                       ->where('PAYMENT_STATUS','paid')
                       ->where('TRANSACTION_STATUS','succeeded')
                       ->select('TRANSACTION_RESPONSE')
                       ->get();

        $totalCost=0;
        for($i=0;$i<$Payments;$i++){
            $transactional_response=$totalPayments[$i]->TRANSACTION_RESPONSE;
            $decode_transactional_response=json_decode($transactional_response);
            $totalCost=$decode_transactional_response->amount + $totalCost;
        }

        $totalCostInDollars=round($totalCost / 100);

        if ($totalCostInDollars < 900) {
            // 0 - 900
            $n_format = number_format($totalCostInDollars, 1);
            $suffix = '';
        } else if ($totalCostInDollars < 900000) {
            // 0.9k-850k
            $n_format = number_format($totalCostInDollars / 1000, 1);
            $suffix = 'K';
        } else if ($totalCostInDollars < 900000000) {
            // 0.9m-850m
            $n_format = number_format($totalCostInDollars / 1000000, 1);
            $suffix = 'M';
        } else if ($totalCostInDollars < 900000000000) {
            // 0.9b-850b
            $n_format = number_format($totalCostInDollars / 1000000000, 1);
            $suffix = 'B';
        } else {
            // 0.9t+
            $n_format = number_format($totalCostInDollars / 1000000000000, 1);
            $suffix = 'T';
        }

        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"

        if ( 1 > 0 ) {
            $dotzero = '.' . str_repeat( '0', 1 );
            $n_format = str_replace( $dotzero, '', $n_format );
        }
        
        $totalCostInDollars=$n_format . $suffix;

        return isset($totalCostInDollars) ?  $totalCostInDollars :null;
            
    }

    public function getTotalProducts(){

        $totalProducts = DB::table('jb_product_tbl')->count();
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

        $totalBundles = DB::table('jb_bundle_product_tbl')->count();
        return isset($totalBundles) ?  $totalBundles:null;
    }

    public function getTotalShippedOrders(){

        $totalShippedOrders = DB::table('jb_order_shippment_tracking_tbl')
                              ->where('STATUS','shipped')
                              ->count();
        return isset( $totalShippedOrders) ? $totalShippedOrders : null;
    }

    public function getTotalSubscriptions(){

        $totalSubscriptions = DB:: table('jb_user_subscription_tbl')->count();
        return isset($totalSubscriptions ) ? $totalSubscriptions :null;
    }

    public function getTotalGivings(){

        $totalGivings = DB:: table('jb_giving_tbl')->count();
        return isset($totalGivings) ? $totalGivings :null;
    }

    public function getTotalReviews(){

        $totalReviews = DB::table('jb_reviews_tbl')->count();
        return isset( $totalReviews) ?  $totalReviews :null;
    }

}
