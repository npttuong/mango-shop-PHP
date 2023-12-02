<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $categories = Category::paginate($perPage);

        return view('admin.all-categories', compact('categories'));
    }
    public function showCreateCategory()
    {
        return view('admin.create-category');
    }
    public function createCategory(Request $request)
    {
        $formData = $request->validate([
            'category_name' => 'required|max:128'
        ], [
            'category_name.required' => 'Trường tên loại sản phẩm không được trống.',
            'category_name.max' => 'Trường tên loại sản phẩm không được vượt quá :max ký tự.',
        ]);

        $newCategory = Category::create($formData);
        if (empty($newCategory))
            return redirect()->back()->with('createFailed', 'Tạo loại sản phẩm mới thất bại.');

        return redirect()->back()->with('createSuccess', 'Tạo loại sản phẩm mới thành công.');
    }
    public function showUpdateCategory($id)
    {
        $category = Category::find($id);
        if (empty($category))
            abort(404, 'Tên loại sản phẩm không tồn tại.');
        return view('admin.update-category', compact('category'));
    }
    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if (empty($category))
            abort(404, 'Tên loại sản phẩm không tồn tại.');
        $rowEffect = $category->update([
            'category_name' => $request->input('category_name')
        ]);

        if ($rowEffect === 0)
            return redirect()->back()->with('updateFailed', 'Cập nhật loại sản phẩm mới thất bại.');

        return redirect()->back()->with('updateSuccess', 'Cập nhật loại sản phẩm mới thành công.');
    }
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (empty($category))
            abort(404, 'Tên loại sản phẩm không tồn tại.');
        $isDeleted = $category->delete();
        if (!$isDeleted)
            return redirect()->back()->with('deleteFailed', 'Xóa loại sản phẩm mới thất bại.');
        return redirect()->back()->with('deleteSuccess', 'Xóa loại sản phẩm mới thành công.');
    }
}