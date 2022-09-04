<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\StatusCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
	// show all products
	public function index(Request $request)
	{
		// query parameters = category, orderDir, orderBy, page, limit, rating
		$response = [];
		$orderBy = 'id';
		$limit = 10;
		//
		if ($request->has('limit') && $request->limit != '')
			$limit = intval($request->limit);
		$orderDir = $request->has('orderDir') && $request->orderDir != '' ? $request->orderDir : 'desc';
		if ($request->has('orderBy') && $request->orderBy != '')
			$orderBy = $request->orderBy;

		// 	uncategorized products
		$response = Product::with(['categories', 'tags', 'reviews'])
			->orderBy($orderBy, $orderDir)
			->paginate($limit);

		//	categorized products
		if ($request->has('category') && $request->category != '') {

			if (Category::where('name', $request->category)->value('parent_id')) {
				// when sub category name is given
				$response = Product::whereHas('categories', function ($query) use ($request) {
					$query->where('name', $request->category);
				})->with(['categories', 'tags', 'reviews'])
					->orderBy($orderBy, $orderDir)
					->paginate($limit);
			} else {
				// when parent category name is given
				$subCategoryIds = Category::where('parent_id', $parentId = Category::where('name', $request->category)->value('id'))
					->pluck('id')->push($parentId)->all();
				$response = Product::whereHas('categories', function ($query) use ($subCategoryIds) {
					$query->whereIn('id', $subCategoryIds);
				})->with(['categories', 'tags', 'reviews'])
					->orderBy($orderBy, $orderDir)
					->paginate($limit);
			}
		}

		//	categorized products with rating filter
		if ($request->has('rating') && $request->rating != '')
			/*	non paginable collection 
				$response = Category::where('name', $request->category)->first()
					->products()->orderBy($orderBy, $orderDir)->with(['categories', 'tags', 'reviews'])->get()
					->filter(function ($product) use ($request) {
						return $product->reviews()->avg('rating') == $request->rating;
					}); */
			// paginable query
			$response = Product::whereHas('categories', function ($query) use ($request) {
				$query->where('name', $request->category);
			})->with(['categories', 'tags', 'reviews'])
				->leftJoin('product_reviews', 'product_reviews.product_id', '=', 'products.id')
				->select(['products.*', DB::raw('ROUND(AVG(rating), 1) as average_rating')])
				->groupBy('id')
				->having('average_rating', $request->rating)
				->orderBy($orderBy, $orderDir)
				->paginate($limit);

		return response()->json($response, StatusCode::OK);
	}

	public function show()
	{
	}

	public function store()
	{
	}

	public function update()
	{
	}

	public function destroy()
	{
	}
}
