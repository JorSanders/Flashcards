<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOndeleteContraints extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('cards', function (Blueprint $table) {
			$table->dropForeign('cards_user_id_foreign');
			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('SET NULL');
		});
		Schema::table('answers', function (Blueprint $table) {
			$table->dropForeign('answers_user_id_foreign');
			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('SET NULL');
		});
		Schema::table('card_category', function (Blueprint $table) {
			$table->dropForeign('card_category_card_id_foreign');
			$table->foreign('card_id')
				->references('id')->on('cards')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
