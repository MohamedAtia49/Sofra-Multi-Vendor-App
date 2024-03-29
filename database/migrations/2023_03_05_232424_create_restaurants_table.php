<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('phone');
			$table->integer('minimum_charge');
			$table->double('delivery_cost', 8,2)->default(0);
			$table->string('image')->nullable();
			$table->string('whats_up');
			$table->enum('status',['opened' , 'closed'])->default('opened');
			$table->integer('region_id')->unsigned();
            $table->string('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
