<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
	protected $fillable = [

	];

	public function contents()
	{
		return $this->belongsToMany('App\Content');
	}

	public function categories()
	{
		return $this->belongsToMany('App\Category');
	}
}
