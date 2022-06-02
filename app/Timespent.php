<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Timespent extends Model
{
   protected $primaryKey = 'id';
   protected $table='timespent';
   protected $fillable=['user_id','hoursSpent'];

   /*public function employee(){
   	return $this->belongsTo('App\Models\Employee');
   }*/
}
