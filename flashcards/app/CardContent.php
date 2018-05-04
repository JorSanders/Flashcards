<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardContent extends Model
{
    //
	protected $fillable = [
		'card_id',
		'content_id',
	];
}
