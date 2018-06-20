<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	protected $fillable = [
		'title',
		'description',
		'user_id',
	];

	public function cards()
	{
		return $this->belongsToMany('App\Card');
	}

}
