<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function (Blueprint $table) {
			$table->increments('id');
			$table->string('template')->nullable();
			$table->string('name');
			$table->string('title');
			$table->string('slug');
			$table->text('content')->nullable();
			$table->text('images')->nullable();
			$table->text('extras')->nullable();
			$table->string('meta_description')->nullable();
			$table->string('meta_title')->nullable();
			$table->string('og_image')->nullable();
			$table->string('og_image_name')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('pages');
	}
}
