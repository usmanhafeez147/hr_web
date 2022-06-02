<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Location extends Model
{
   protected $primaryKey = 'location_id';
   protected $table='locations';
   protected $fillable=['longitude','latitude','company_id','diameter'];
	public $timestamps=false;

	public function Company()
	{
		return	$this->belongsTo('App\Company');
	}
}
