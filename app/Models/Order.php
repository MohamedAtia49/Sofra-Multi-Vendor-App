<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('name','phone','address','note','payment_method','status','client_id','restaurant_id','cost','delivery_cost','total_price','commission','net');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

    public function meals()
    {
        return $this->belongsToMany('App\Models\Meal')->withPivot('price','quantity','note');
    }

}
