<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PractiseController extends Controller
{
	/**
	 * Display page with option to select a category.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
		$categories = Category::all();

		return view('practise.index', ['categories' => $categories]);
	}

	/**
	 * Display the a card from the category.
	 *
	 * @param  \App\Category $category
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($categoryId)
	{
		//
		$category = Category::find((int) $categoryId);

		if (!$category)
		{
			$this->returnWithError('Category not found');
		}

		$cards = $category->cards->all();

		if (!sizeof($cards) > 0)
		{
			$this->returnWithError('This category has no cards');
		}

		if (Auth::check())
		{

			// Check if any cards have never been correctly answered
			$neverCorrect = [];
			foreach ($cards as $card)
			{
				if ($card->lastTimeCorrect === null)
				{
					$neverCorrect[] = $card;
				}
			}

			// get the one which one to longest ago to be incorrect
			if (sizeof($neverCorrect) > 0)
			{
				usort($neverCorrect, function ($a, $b) {
					return strtotime($a['lastTimeIncorrect']) - strtotime($b['lastTimeIncorrect']);
				});
				$card = reset($neverCorrect);
			}
			// Get the one which was longest ago to be correct
			else
			{
				usort($cards, function ($a, $b) {
					return strtotime($a['lastTimeCorrect']) - strtotime($b['lastTimeCorrect']);
				});
				$card = reset($cards);
			}
		}
		else
		{
			$card = $cards[rand(0, (int) sizeof($cards) - 1)];
		}

		$preferences = new \stdClass();
		if (Auth::check())
		{
			$preferences->english   = 1;
			$preferences->pinyin    = 0;
			$preferences->character = 0;
			$preferences->comment   = 0;
		}
		else
		{
			$preferences->english   = 1;
			$preferences->pinyin    = 0;
			$preferences->character = 0;
			$preferences->comment   = 0;
		}

		return view('practise.show', ['card' => $card, 'preferences' => $preferences]);
	}

	/**
	 * @param string $errorMessage
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	private function returnWithError($errorMessage)
	{
		$categories = Category::all();

		return view('practise.index', ['categories' => $categories])
			->with('errors', $errorMessage);
	}
}
