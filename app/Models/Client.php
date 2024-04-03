<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'region_id','is_active','pin_code');

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

}
