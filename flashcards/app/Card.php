<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
	protected $fillable = [
		'english',
		'pinyin',
		'character',
		'comment',
		'user_id',
	];

	public function categories()
	{
		return $this->belongsToMany('App\Category');
	}
}