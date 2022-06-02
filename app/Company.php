<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company';
	public $timestamps=false;

    protected $fillable=[
        'first_name',
        'last_name',
        'address',
        'company_size',
        'phone',
        'website',
        'company_name',
        'email',
        'password',
        'company_enc'
    ];

    protected $hidden = [
        'password',
    ];

    public function user()
    {
        return  $this->hasMany('App\User');
    }

}
