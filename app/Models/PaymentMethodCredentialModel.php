<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class PaymentMethodCredentialModel extends Model
{
    use HasFactory;
 
    protected $table="jb_payment_method_credentials_tbl";
    
    public $timestamps=false;
    
    
    
    
}
