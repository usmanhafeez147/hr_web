<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Latecommers extends Model
{
   protected $primaryKey = 'id';
   protected $table='latecommers';
   protected $fillable=['user_id','date'];

  public function user(){
   	return $this->belongsTo('App\User');
   }
}
