<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product)
            abort(404, 'Sản phẩm không tồn tại!');

        $numberProductOfCategory = Category::find($product->category_id)->products->count();
        $randNum = 0;
        $numberOfRelatedProduct = 4;
        if ($numberProductOfCategory > $numberOfRelatedProduct)
            $randNum = rand(1, $numberProductOfCategory - $numberOfRelatedProduct);
        $relatedProducts = Category::find($product->category_id)->products->where('id', '<>', $id)->skip($randNum)->take($numberOfRelatedProduct);
        return view('detail', compact('product', 'relatedProducts'));
    }
}