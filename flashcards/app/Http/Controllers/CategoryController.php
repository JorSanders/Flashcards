<?php

namespace App\Http\Controllers;

use App\Card;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
		$categories= Category::orderBy('title','asc')->get();

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

	public function store(Request $request)
	{
		if (!Auth::check())
		{
			return Redirect::back()->withInput(Input::all());
		}

		$category = Category::create([
			'title'       => $request->input('title'),
			'description' => $request->input('description'),
			'user_id'     => Auth::user()->id,
		]);


		if (!$category)
		{
			return back()->withInput()->with('errors', 'Category was not created');
		}

		$updateCards = $this->updateCards($request, $category);
		if ($updateCards !== null)
		{
			return $this->returnWithInput($updateCards);
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
		if (!Auth::check())
		{
			return $this->returnWithInput("You are not logged in");
		}

		if ($category->user_id != Auth::user()->id)
		{
			return $this->returnWithInput("You are not the owner of this category");
		}

		return view('categories.create', ['category' => $category]);
	}


	private function returnWithInput($errorMessage)
	{
		Session::put('message', $errorMessage);
		return Redirect::back()->withInput(Input::all());
	}

	public function update(Request $request, Category $category)
	{
		if (!Auth::check())
		{
			return $this->returnWithInput("You are not logged in");
		}

		if ($category->user_id != Auth::user()->id)
		{
			return $this->returnWithInput("You are not the owner of this category");
		}

		$categoryUpdate = Category::where('id', $category->id)
			->update([
				'title'       => $request->input('title'),
				'description' => $request->input('description'),
			]);

		if (!$categoryUpdate)
		{
			return $this->returnWithInput("Updating category failed");
		}

		$updateCards = $this->updateCards($request, $category);
		if ($updateCards !== null)
		{
			return $this->returnWithInput($updateCards);
		}

		return redirect()->route('categories.show', ['category' => $category->id])
			->with('success', 'Category created successfully');
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

	private function updateCards(Request $request, Category $category)
	{
		$newCards = [];
		$cardIds  = [];

		// Loop through the cards
		for ($i = 0; ; $i++)
		{
			// Check if the card exists
			if ($request->input('english-' . $i) !== null &&
				$request->input('pinyin-' . $i) !== null &&
				$request->input('character-' . $i) !== null
			)
			{
				// Check if the card already as an id
				$cardId    = $request->input('cardId-' . $i);
				$cardIds[] = $cardId;

				if ($cardId > 0)
				{
					$existingCard = Card::where('id', $cardId)->where('user_id', Auth::user()->id);

					$cardUpdate = true;

					if($existingCard){
						$cardUpdate = $existingCard->update([
							'english'   => $request->input('english-' . $i),
							'pinyin'    => $request->input('pinyin-' . $i),
							'character' => $request->input('character-' . $i),
						]);
					}

					if (!$cardUpdate)
					{
						return "Updating cards failed";
					}
				}
				// Card is newly added
				else
				{
					$newCard = Card::create([
						'english'   => $request->input('english-' . $i),
						'pinyin'    => $request->input('pinyin-' . $i),
						'character' => $request->input('character-' . $i),
						'user_id'   => Auth::user()->id,
					]);

					$newCards[] = $newCard;
				}
			}
			// No more cards
			else
			{
				break;
			}
		}

		// Delete all the cards that don't exist anymore
		foreach ($category->cards()->get() as $card)
		{
			if (!in_array($card->id, $cardIds))
			{
				$card->delete();
			}
		}

		// Attach the new cards
		foreach ($newCards as $newCard)
		{
			if (!$newCard)
			{
				return back()->withInput();
			}
			$category->cards()->attach($newCard->id);
		}

		return null;
	}
}
