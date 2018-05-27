<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Card;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PractiseController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		//
		$categories = Category::all();

		return view('practise.index', ['categories' => $categories]);
	}

	/**
	 * @param $categoryId
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function show($categoryId)
	{
		//
		$category = Category::find((int) $categoryId);

		if (!$category)
		{
			return $this->returnWithError('Category not found');
		}

		$card = $this->findCard($category);

		return redirect()->route('practise.show.practise',
			['categoryId' => $category->id, 'cardId' => $card->id]);
	}

	/**
	 * @param $categoryId
	 * @param $cardId
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showPractise($categoryId, $cardId)
	{
		$category = Category::find((int) $categoryId);
		$card     = Card::find((int) $cardId);

		if (!$category)
		{
			return $this->returnWithError('Category not found');
		}

		if (!$card)
		{
			return $this->returnWithError('Card not found');
		}

		$preferences = $this->getPreferences();

		return view('practise.show-practise',
			['card' => $card, 'preferences' => $preferences, 'category' => $category]
		);
	}

	/**
	 * @param $categoryId
	 * @param $cardId
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showFull($categoryId, $cardId)
	{
		$category = Category::find((int) $categoryId);
		$card     = Card::find((int) $cardId);

		if (!$category)
		{
			return $this->returnWithError('Category not found');
		}

		if (!$card)
		{
			return $this->returnWithError('Card not found');
		}

		return view('practise.show-full', ['category' => $category, 'card' => $card]);
	}

	/**
	 * @return \stdClass
	 */
	private function getPreferences()
	{
		$preferences = new \stdClass();

		//todo If user is logged in get preferences from profile
		//todo if user is not logged in set preferences in a cookie
		//todo if no cookie is set set preferences to these defaults
		$preferences->english   = 1;
		$preferences->pinyin    = 0;
		$preferences->character = 0;
		$preferences->comment   = 0;


		return $preferences;
	}

	/**
	 * @param $errorMessage
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	private function returnWithError($errorMessage)
	{
		return view('practise.index')
			->with('errors', $errorMessage);
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		if (Auth::check())
		{
			$answer = Answer::create([
				'card_id' => $request->input('cardId'),
				'user_id' => Auth::user()->id,
				'correct' => $request->input('correct'),
			]);

			if (!$answer)
			{
				//todo check $answer
			}
		}

		if ((int) $request->input('correct') > 0)
		{
			return redirect()->route('practise.show',
				['categoryId' => $request->input('categoryId')])
				->with(['categoryId' => $request->input('categoryId')]);
		}
		else
		{
			return redirect()->route('practise.show.full',
				['categoryId' => $request->input('categoryId'), 'cardId' => $request->input('cardId')])
				->with(['categoryId' => $request->input('categoryId'), 'cardId' => $request->input('cardId')]);
		}

	}

	/**
	 * @param $category
	 *
	 * @return Card
	 */
	private function findCard($category)
	{
		$cards = $category->cards->all();

		if (!sizeof($cards) > 0)
		{
			$this->returnWithError('This category has no cards');
		}

		//todo this logic is flawed so now always just select a random card
		// If the user is logged in select the card the user hasn't answerred correctly in the longest time
		if (Auth::check() && false)
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

		return $card;
	}
}
