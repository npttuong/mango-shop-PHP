<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Illustration;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Str;

class ProductController extends Controller
{
	//Show all product  
	public function index()
	{
		$perPage = 10;
		$products = Product::with('category')->paginate($perPage);


		return view('admin.all-products', compact('products'));
	}

	public function showCreateProduct()
	{
		$sizes = Size::all();
		$colors = Color::all();
		$categories = Category::all();

		return view('admin.create-product', compact('sizes', 'colors', 'categories'));
	}

	public function createProduct(Request $request)
	{
		$sizesReq = [];
		$colorsReq = [];
		foreach ($request->all() as $key => $value) {
			if (strpos($key, "colorProduct") === 0) {
				if (array_key_exists($value[1], $colorsReq))
					$colorsReq[$value[1]] += $value[0];
				else
					if ($value[0] > 0)
						$colorsReq += [$value[1] => (int) $value[0]];
			} else if (strpos($key, "sizeProduct") === 0) {
				if (array_key_exists($value[1], $sizesReq))
					$sizesReq[$value[1]] += $value[0];
				else
					if ($value[0] > 0)
						$sizesReq += [$value[1] => (int) $value[0]];
			}
		}

		$request->validate([
			'product_name' => 'required|max:256',
			'category_id' => 'required',
			'unit_price' => 'required|regex:/^\d+$/',
			'illustrations.*' => 'required|image|mimes:jpeg,jpg,png,gif|max:5120',
			'product_short_des' => 'required',
		], [
			'product_name.required' => 'Trường tên sản phẩm không được trống',
			'product_name.max' => 'Trường tên sản phẩm không được vượt quá :max ký tự',
			'category_id.required' => 'Trường loại sản phẩm không được trống',
			'unit_price.required' => 'Trường giá sản phẩm không được trống',
			'unit_price.regex' => 'Trường giá sản phẩm phải là số',
			'illustrations.required' => 'Trường hình ảnh sản phẩm không được trống',
			'illustrations.mimes' => 'File tải lên phải có định dạng là :mimes',
			'illustrations.max' => 'Dung lượng file tải lên vượt quá :max byte',
			'product_short_des.required' => 'Trường mô tả ngắn về sản phẩm không được trống',
		]);

		// Nếu số lượng size trống thì trở về trang thêm
		if (empty($sizesReq)) {
			return redirect()->back()->with('messageSize', 'Trường số lượng kích cỡ không được trống');
		}
		// Kiểm tra nếu trường số lượng color trống thì trở về trang thêm 
		if (empty($colorsReq)) {
			return redirect()->back()->with('messageColor', 'Trường số lượng màu sắc không được trống');
		}



		// Tạo sản phẩm
		$product = Product::create([
			'product_name' => $request->input('product_name'),
			'category_id' => $request->input('category_id'),
			'unit_price' => $request->input('unit_price'),
			'discount' => $request->input('discount') ?? 0,
			'product_short_des' => $request->input('product_short_des'),
			'product_info' => $request->input('product_info'),
			'product_description' => $request->input('product_description'),
		]);
		if (empty($product))
			return redirect('/admin/create-product')->with('createFailed', 'Lỗi! Không thể thêm mới sản phẩm');

		// Tạo illustration cho product vừa thêm
		foreach ($request->illustrations as $value) {
			$imageName = Str::random(5) . '_' . $value->getClientOriginalName();
			while (file_exists($imageName)) {
				$imageName = Str::random(5) . '_' . $value->getClientOriginalName();
			}
			$value->move(public_path('img'), $imageName);

			Illustration::create([
				'illustration_path' => $imageName,
				'product_id' => $product->id
			]);
		}


		// Tạo sizes cho product
		$dataSizeProduct = [];
		foreach ($sizesReq as $key => $value) {
			$dataSizeProduct += [$key => ['quantity' => $value]];
		}
		$product->sizes()->attach($dataSizeProduct);

		$dataColorProduct = [];
		foreach ($colorsReq as $key => $value) {
			$dataColorProduct += [$key => ['quantity' => $value]];
		}
		$product->colors()->attach($dataColorProduct);

		return redirect('/admin/create-product')->with('createSuccess', 'Thêm mới sản phẩm thành công');
	}
	// Show form update
	public function showUpdateProduct($id)
	{
		$product = Product::with('sizes')->with('colors')->where('id', $id)->first();
		if (empty($product))
			abort(404, "Không tìm sản phẩm!");
		$sizes = Size::all();
		$colors = Color::all();
		$categories = Category::all();
		$illustrations = Illustration::with('product')->where('product_id', $id)->get();

		return view('admin.update-product', compact('product', 'sizes', 'colors', 'categories', 'illustrations'));
	}
	// Xử lý update
	public function updateProduct(Request $request, $id)
	{
		$sizesReq = [];
		$colorsReq = [];

		$product = Product::find($id);
		if (empty($product))
			abort(404, "Không tìm sản phẩm!");
		foreach ($request->all() as $key => $value) {
			if (strpos($key, "colorProduct") === 0) {
				if (array_key_exists($value[1], $colorsReq))
					$colorsReq[$value[1]] += $value[0];
				else
					if ($value[0] > 0)
						$colorsReq += [$value[1] => (int) $value[0]];
			} else if (strpos($key, "sizeProduct") === 0) {
				if (array_key_exists($value[1], $sizesReq))
					$sizesReq[$value[1]] += $value[0];
				else
					if ($value[0] > 0)
						$sizesReq += [$value[1] => (int) $value[0]];
			}
		}

		$request->validate([
			'product_name' => 'required|max:256',
			'category_id' => 'required',
			'unit_price' => 'required|regex:/^\d+$/',
			'illustrations.*' => 'image|mimes:jpeg,jpg,png,gif|max:5120',
			'product_short_des' => 'required',
		], [
			'product_name.required' => 'Trường tên sản phẩm không được trống',
			'product_name.max' => 'Trường tên sản phẩm không được vượt quá :max ký tự',
			'category_id.required' => 'Trường loại sản phẩm không được trống',
			'unit_price.required' => 'Trường giá sản phẩm không được trống',
			'unit_price.regex' => 'Trường giá sản phẩm phải là số',
			// 'illustrations.required' => 'Trường hình ảnh sản phẩm không được trống',
			'illustrations.mimes' => 'File tải lên phải có định dạng là :mimes',
			'illustrations.max' => 'Dung lượng file tải lên vượt quá :max byte',
			'product_short_des.required' => 'Trường mô tả ngắn về sản phẩm không được trống',
		]);

		// Nếu số lượng size trống thì trở về trang thêm
		if (empty($sizesReq)) {
			return redirect()->back()->with('messageSize', 'Trường số lượng kích cỡ không được trống');
		}
		// Kiểm tra nếu trường số lượng color trống thì trở về trang thêm 
		if (empty($colorsReq)) {
			return redirect()->back()->with('messageColor', 'Trường số lượng màu sắc không được trống');
		}

		// Update product
		$updateRowEffect = $product->update([
			'product_name' => $request->input('product_name'),
			'category_id' => $request->input('category_id'),
			'unit_price' => $request->input('unit_price'),
			'discount' => $request->input('discount') ?? 0,
			'product_short_des' => $request->input('product_short_des'),
			'product_info' => $request->input('product_info'),
			'product_description' => $request->input('product_description'),
		]);

		if ($updateRowEffect === 0)
			return redirect('/admin/update-product/' . $id)->with('updateFailed', 'Lỗi! Cập nhật sản phẩm không thành công!');

		// Tạo illustration cho product vừa thêm
		if (!empty($request->illustrations)) {
			foreach ($request->illustrations as $value) {
				$imageName = Str::random(5) . '_' . $value->getClientOriginalName();
				while (file_exists($imageName)) {
					$imageName = Str::random(5) . '_' . $value->getClientOriginalName();
				}
				$value->move(public_path('img'), $imageName);

				Illustration::create([
					'illustration_path' => $imageName,
					'product_id' => $id
				]);
			}
		}

		// Sync size_product

		$dataSizeProduct = [];
		foreach ($sizesReq as $key => $value) {
			$dataSizeProduct += [$key => ['quantity' => $value]];
		}
		$product->sizes()->sync($dataSizeProduct);

		// Sync color_product
		$dataColorProduct = [];
		foreach ($colorsReq as $key => $value) {
			$dataColorProduct += [$key => ['quantity' => $value]];

		}
		$product->colors()->sync($dataColorProduct);


		return redirect('/admin/update-product/' . $id)->with('updateSuccess', 'Cập nhật sản phẩm thành công');
	}

	public function deleteIllutration($illustration_path)
	{
		Illustration::destroy($illustration_path);
		$path_illustration = "img/" . $illustration_path;
		if (file_exists(public_path($path_illustration)))
			File::delete(public_path($path_illustration));

		return redirect()->back();
	}

	public function deleteProduct($id)
	{
		$product = Product::find($id);
		if (empty($product))
			abort(404, "Không tìm sản phẩm!");

		// Delete size_product
		$product->sizes()->detach();

		// Delete color_product
		$product->colors()->detach();

		// Delete illustrations
		$illustrations = $product->with('illustrations')->where('id', $id)->first()->illustrations;
		$illustration_paths = [];
		foreach ($illustrations as $item) {
			array_push($illustration_paths, $item->illustration_path);
			$path_illustration = "img/" . $item->illustration_path;
			if (file_exists(public_path($path_illustration)))
				File::delete(public_path($path_illustration));
		}

		Illustration::destroy($illustration_paths);

		$isDeleted = $product->delete();
		if (!$isDeleted)
			return redirect("/admin/products")->with("deleteFailed", "Xóa sản phẩm không thành công");

		return redirect("/admin/products")->with("deleteSuccess", "Xóa sản phẩm thành công");
	}

	public function addCart(Request $request, $id)
	{
		$product = Product::find($id);
		if (empty($product))
			abort(404, "Không tìm thấy sản phẩm!");
		$quantity = $request->query->quantity ?? 1;
		$cart = session()->get('cart', []);
		if (isset($cart[$id])) {
			$cart[$id]['quantity'] += $quantity;
		} else {
			$cart[$id] = [
				"name" => $product->product_name,
				"quantity" => $quantity,
				"price" => $product->unit_price,
				"image" => $product->illustrations[0]->illustration_path,
			];
		}

		session()->put('cart', $cart);

		return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
	}
}