<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Requirements extends Model
{
   protected $primaryKey = 'id';
   protected $table='requirements';
   protected $fillable=['user_id','required_hours','starting_time'];
   public $timestamps = false;
}
