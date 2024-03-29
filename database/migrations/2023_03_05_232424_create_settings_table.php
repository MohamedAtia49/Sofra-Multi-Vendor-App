<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->longText('about_app');
            $table->double('commission', 8,2)->default(.1);
			$table->string('app_commissions_text');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
