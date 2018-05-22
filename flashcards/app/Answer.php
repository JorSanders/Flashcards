<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
	protected $fillable = [
		'card_id',
		'user_id',
	];
}
