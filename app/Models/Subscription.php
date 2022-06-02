<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
     protected $primaryKey = 'id_subscription';
    
    protected $table = "subscriptions";

    protected $fillable = [
    	'id_package', 'id_company', 'is_paid'
    ];
}
