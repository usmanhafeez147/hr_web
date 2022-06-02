<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class onTime extends Model
{
    protected $primarykey='id';
    protected $table='onTimes';
    protected $fillable=['check_id','user_id'];
}
