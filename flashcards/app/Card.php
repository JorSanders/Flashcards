<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Card extends Model
{
	protected $table = 'cards';
	protected $appends = ['lastTimeCorrect', 'lastTimeIncorrect'];
	protected $fillable = [
		'english',
		'pinyin',
		'character',
		'comment',
		'user_id',
	];

	public function getLastTimeCorrectAttribute()
	{
		return $this->lastTimeCorrect();
	}

	public function getLastTimeIncorrectAttribute()
	{
		return $this->lastTimeIncorrect();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function categories()
	{
		return $this->belongsToMany('App\Category');
	}

	private function lastTimeCorrect()
	{
		if (!Auth::check())
		{
			return false;
		}

		return Answer::where('user_id', (int) Auth::user()->id)
			->where('correct', 1)
			->where('card_id', $this->id)
			->max('updated_at');
	}

	private function lastTimeIncorrect()
	{
		if (!Auth::check())
		{
			return false;
		}

		return Answer::where('user_id', (int) Auth::user()->id)
			->where('correct', 0)
			->where('card_id', $this->id)
			->max('updated_at');
	}
}
