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
			//todo fix
			$card = [];
		}
		else
		{
			$card = $cards[rand(0, (int) sizeof($cards) - 1)];
		}

		return view('practise.show', ['card' => $card]);
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
