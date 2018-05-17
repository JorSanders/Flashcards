<?php

namespace App\Http\Controllers;

use App\Card;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
		$categories = Category::all();

		return view('categories.index', ['categories' => $categories]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
		return view('categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
		$category = Category::create([
			'title'       => $request->input('title'),
			'description' => $request->input('description'),
		]);


		if (!$category)
		{
			return back()->withInput()->with('errors', 'Category was not created');
		}

		$cards = [];
		// Create the cards
		for ($i = 0; ; $i++)
		{
			if ($request->input('english-' . $i) !== null ||
				$request->input('pinyin-' . $i) !== null ||
				$request->input('character-' . $i) !== null ||
				$request->input('comment-' . $i) !== null
			)
			{
				$card    = Card::create([
					'english'   => $request->input('english-' . $i),
					'pinyin'    => $request->input('english-' . $i),
					'character' => $request->input('english-' . $i),
					'comment'   => $request->input('english-' . $i),
				]);
				$cards[] = $card;
			}
			else
			{
				break;
			}
		}

		// Attach the cards
		foreach ($cards as $card)
		{
			if (!$card)
			{
				return back()->withInput()->with('errors', 'Card could not be created');
			}
			$category->cards()->attach($card->id);
		}

		return redirect()->route('categories.show', ['category' => $category->id])
			->with('success', 'Category created successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Category $category
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category)
	{
		//
		$category = Category::find($category->id);

		return view('categories.show', ['category' => $category]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Category $category
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Category $category)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Category            $category
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Category $category)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Category $category
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Category $category)
	{
		//
	}
}
