<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Restaurant extends Authenticatable
{

    use HasApiTokens;
    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'minimum_charge', 'delivery_cost', 'image', 'whats_up', 'status', 'region_id','pin_code');

    public function meals()
    {
        return $this->hasMany('App\Models\Meal');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
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
