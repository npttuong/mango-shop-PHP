<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
	public function index(Request $request)
	{
		$categoryFilter = $request->type;
		$defaultPerPage = 8;
		$perPage = $request->perPage ?? $defaultPerPage;
		$searchString = $request->words;
		$sizes = Size::all();
		$colors = Color::all();

		$quantitySizes = [];
		$quantityColors = [];

		// Calculate Number of sizes
		foreach ($sizes as $item) {
			$sumEachItem = 0;
			foreach ($item->products as $sizeProduct) {
				$sumEachItem += $sizeProduct->getOriginal('pivot_quantity');
			}
			$quantitySizes += [$item->size => $sumEachItem];
		}

		// Calculate Number of colors
		foreach ($colors as $item) {
			$sumEachItem = 0;
			foreach ($item->products as $colorProduct) {
				$sumEachItem += $sizeProduct->getOriginal('pivot_quantity');
			}
			$quantityColors += [
				$item->color_code => [$item->color, $sumEachItem]
			];
		}

		// filter product module
		$reqSize = [];
		$reqColor = [];

		// Get query parameter values
		foreach ($request->query as $key => $value) {
			if ($key[0] == 'c') {
				array_push($reqColor, $value);
			} else if ($key[0] == 's') {
				array_push($reqSize, $value);
			}
		}

		$products = Product::query();
		// Have color filter
		if (empty($reqColor)) {
			$products->has('colors');
		} else {
			$products->whereHas('colors', function ($query) use ($reqColor) {
				$query->whereIn('colors.color_code', $reqColor);
			});
		}
		// Have size filter
		if (empty($reqSize)) {
			$products->has('sizes');
		} else {
			$products->whereHas('sizes', function ($query) use ($reqSize) {
				$query->whereIn('sizes.size', $reqSize);
			});
		}

		// sort by price
		$sortPrice = $request->priceBySort ?? 'asc';
		$products->orderBy('unit_price', $sortPrice);

		// filter category
		if ($categoryFilter) {
			$products->where('category_id', $categoryFilter);
		}

		// search name product
		if (strlen($searchString) > 0) {
			$products->where('product_name', 'like', '%' . $searchString . '%');
		}

		$products = $products->paginate($perPage)->withQueryString();

		return view('shop', compact('products', 'quantityColors', 'quantitySizes', 'reqColor', 'reqSize'));
	}
}