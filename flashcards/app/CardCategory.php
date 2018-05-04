<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardCategory extends Model
{
    //
	protected $fillable = [
		'card_id',
		'category_id',
	];
}
