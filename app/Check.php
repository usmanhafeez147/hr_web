<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Check extends Model
{
   	protected $primaryKey = 'id';
   	protected $table='checks';
   	protected $fillable=[
	   'user_id',
	   'latitude',
	   'logitude',
	   'date_time',
	   'checked',
	   'is_manual',
	   'approved'
	];

   	public function user(){
   		return $this->belongsTo('App\User','user_id');
   	}
}
