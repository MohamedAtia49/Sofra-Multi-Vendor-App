<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('phone');
			$table->string('address');
			$table->string('note')->nullable();
			$table->enum('payment_method', array('cash_delivery', 'online_payment'));
			$table->enum('state', array('pending', 'accepted', 'rejected', 'delivered', 'declined'))->default('pending');
			$table->integer('client_id')->unsigned();
			$table->integer('restaurant_id')->unsigned();
			$table->double('cost', 8,2)->default(0);
			$table->double('delivery_cost', 8,2)->default(0);
			$table->double('total_price', 8,2)->default(0);
			$table->double('commission', 8,2)->default(0);
			$table->double('net', 8,2)->default(0);
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
