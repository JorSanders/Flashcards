<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
	//
	protected $fillable = [
		'heading',
		'description',
	];

	public function cards()
	{
		return $this->belongsToMany('App\Card');
	}
}
