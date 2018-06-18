<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Card;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class PractiseController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		//
		$categories = Category::all();

		foreach ($categories as $key => $category)
		{
			if ($category->cards()->count() <= 0)
			{
				$categories->pull($key);
			}
		}

		return view('practise.index', ['categories' => $categories]);
	}

	/**
	 * @param $categoryId
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function show($categoryId)
	{
		$category = Category::find((int) $categoryId);

		if (!$category)
		{
			return $this->returnWithMessage('Category not found');
		}

		if (count($category->cards) <= 0)
		{
			return $this->returnWithMessage('No cards in this category');
		}

		$cardIdsJson = Cookie::get($category->title);

		if ($cardIdsJson === null)
		{
			$cardIdsJson = $this->getCardsCookie($category);
		}

		$cardIds = json_decode($cardIdsJson);

		if (!is_array($cardIds))
		{
			$cardIds = [$cardIds];
		}

		if (count($cardIds) <= 0)
		{
			Cookie::queue(
				Cookie::forget($category->title)
			);

			return $this->returnWithMessage('Complete');
		}

		$card = Card::find((int) $cardIds[0]);

		if ($card === null)
		{
			return $this->returnWithMessage('Card couldn\'t be found');
		}

		return redirect()->route('practise.show.practise',
			['categoryId' => $category->id, 'cardId' => $card->id]);
	}

	private function getCardsCookie(Category $category)
	{
		$cards = $category->cards;

		$cardIds = [];

		foreach ($cards as $card)
		{
			$cardIds[] = $card->id;
		}

		//todo shufle the array

		$cookie = cookie($category->title, json_encode($cardIds));
		Cookie::queue($cookie);

		return $cookie->getValue();
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
			return $this->returnWithMessage('Category not found');
		}

		if (!$card)
		{
			return $this->returnWithMessage('Card not found');
		}

		return view('practise.show-practise',
			['card' => $card, 'category' => $category]
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
			return $this->returnWithMessage('Category not found');
		}

		if (!$card)
		{
			return $this->returnWithMessage('Card not found');
		}

		return view('practise.show-full', ['category' => $category, 'card' => $card]);
	}

	/**
	 * @param $message
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	private function returnWithMessage($message)
	{
		Session::put('message', $message);

		return redirect(route('practise.index'));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$category = Category::find((int) $request->input('categoryId'));

		$cardIdsJson = Cookie::get($category->title);
		$cardIds     = json_decode($cardIdsJson);
		if (!is_array($cardIds))
		{
			$cardIds = [$cardIds];
		}

		$cardId = array_shift($cardIds);

		if (!(bool) $request->input('correct'))
		{
			$cardIds[] = $cardId;
		}

		$cookie = cookie($category->title, json_encode($cardIds));
		Cookie::queue($cookie);

		if (Auth::check())
		{
			$answer = Answer::create([
				'card_id' => $request->input('cardId'),
				'user_id' => Auth::user()->id,
				'correct' => (int) $request->input('correct'),
			]);

			if (!$answer)
			{
				//todo check $answer
			}
		}

		return redirect()->route('practise.show',
			['categoryId' => $request->input('categoryId')]);
	}

	public function save(Request $request)
	{
		$english   = cookie('english', $request->input('english'));
		$pinyin    = cookie('pinyin', $request->input('pinyin'));
		$character = cookie('character', $request->input('character'));
		$comment   = cookie('comment', $request->input('comment'));

		Cookie::queue($english);
		Cookie::queue($pinyin);
		Cookie::queue($character);
		Cookie::queue($comment);

		return redirect()->route('practise.show.full',
			['categoryId' => $request->input('categoryId'),
			 'cardId'     => $request->input('cardId')]);
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
			return null;
		}

		$card = $cards[0];

		return $card;
	}
}
