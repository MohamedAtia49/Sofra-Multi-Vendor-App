<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationRestaurantTable extends Migration {

	public function up()
	{
		Schema::create('notification_restaurant', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('notification_id')->unsigned();
			$table->integer('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('notification_restaurant');
	}
}