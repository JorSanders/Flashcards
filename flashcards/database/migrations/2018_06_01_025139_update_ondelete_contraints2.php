<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOndeleteContraints2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('answers', function (Blueprint $table) {
			$table->dropForeign('answers_card_id_foreign');
			$table->foreign('card_id')
				->references('id')->on('cards')
				->onDelete('SET NULL');
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
