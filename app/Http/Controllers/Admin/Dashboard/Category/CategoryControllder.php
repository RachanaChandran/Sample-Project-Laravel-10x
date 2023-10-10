<?php

namespace App\Http\Controllers\Admin\Dashboard\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryControllder extends Controller
{

    public function index()
    {
        $categories = Categories::orderBy('CategoryId', 'asc')->get(); // Sắp xếp theo trường 'id' tăng dần
        return view('dashboard.category.index', ['categories' => $categories]);
    }

    // HomeController.php
    public function home()
    {
        $categories = Categories::all();
       /* $categories = Categories::orderBy('CategoryId', 'asc')->get();*/ // Sắp xếp theo trường 'CategoryId' tăng dần
        return view('frontend.components.hearder', compact($categories));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required|string|unique:categories',
        ]);

        try {
            Categories::create([
                'CategoryName' => $request->input('CategoryName'),
            ]);

            return redirect()->route('dashboard.category.index')->with('success', 'Category created successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Trường hợp lỗi khi thêm bản ghi có trường "name" đã tồn tại
            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                // mã 1062 xuất hiện khi name trùng lặp
                return redirect()->back()->withErrors(['CategoryName' => 'Category name already exists.'])->withInput();
            }

            // Xử lý các trường hợp lỗi khác nếu cần
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the category.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $category = Categories::findOrFail($id);
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'CategoryName' => 'required|string|unique:categories,CategoryName,' . $id . ',CategoryId',
        ]);

        try {
            // Lấy category cần cập nhật dựa trên $id
            $category = Categories::findOrFail($id);

            // Cập nhật thông tin category từ dữ liệu form
            $category->update([
                'CategoryName' => $request->input('CategoryName'),
            ]);

            return redirect()->route('dashboard.category.index')->with('success', 'Category updated successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode === 1062) {
                return redirect()->back()->withErrors(['CategoryName' => 'Category name already exists.'])->withInput();
            }
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while updating the category.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($CategoryId)
    {
        // Tìm danh mục cần xóa
        $category = Categories::findOrFail($CategoryId);

        // Kiểm tra xem danh mục này có sản phẩm nào được liên kết không
        if ($category->products()->count() > 0) {
            return redirect()->route('dashboard.category.index')->with('error', 'xóa cc đang có sản phẩm.');
        }

        // Nếu không có sản phẩm nào liên kết, thực hiện xóa
        $category->delete();

        // Chuyển hướng hoặc trả về trang danh sách danh mục sau khi xóa
        return redirect()->route('dashboard.category.index')->with('success', 'Category deleted successfully.');
    }

    // show products
    public function showProduct($CategoryId)
    {
        // Tìm danh mục cụ thể
        $category = Categories::findOrFail($CategoryId);

        // Lấy danh sách các sản phẩm liên quan thông qua phương thức products
        $products = $category->products;

        return view('dashboard.category.show_Products', compact('category', 'products'));
    }
}
