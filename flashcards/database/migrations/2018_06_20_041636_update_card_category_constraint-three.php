<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCardCategoryConstraintThree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('card_category', function (Blueprint $table) {
			$table->dropForeign('card_category_card_id_foreign');
			$table->foreign('card_id')
				->references('id')->on('cards')
				->onDelete('cascade')
				->onUpdate('cascade');

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
