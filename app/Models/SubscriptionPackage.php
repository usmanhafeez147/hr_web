<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPackage extends Model
{
    protected $primaryKey = 'id_package';
    
    protected $table = "subscription_packages";

    protected $fillable = [
    	'name','duration', 'no_of_users', 'price', 'description', 'image'
    ];
}
