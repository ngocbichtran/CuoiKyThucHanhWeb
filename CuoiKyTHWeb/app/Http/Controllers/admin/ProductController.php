<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $keyword = $request->input('keyword');

    $product = Product::when($keyword, function ($query) use ($keyword) {
        $query->where('name', 'like', '%' . $keyword . '%')
              ->orWhere('email', 'like', '%' . $keyword . '%');
    })
    ->paginate(7);

    return view('admin.products.index', compact('product', 'keyword'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryList = Category::all();
        return view('admin.products.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $product = Product::create([
            'CATE_ID'      => $request->CATE_ID,
            'NAME'         => $request->NAME,
            'DESCRIPTION'  => $request->DESCRIPTION,
            'IMG_URL'      => $request->IMG_URL,
            'ACTIVE_FLAG'  => $request->ACTIVE_FLAG,
            'CREATE_DATE'  => now(),
        ]);

        if($product){
            return redirect()->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công!');
        }

        return back()->with('error', 'Thêm sản phẩm thất bại!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $product = Product::findOrFail($id);

        $updated = $product->update([
            'CATE_ID'      => $request->CATE_ID,
            'NAME'         => $request->NAME,
            'DESCRIPTION'  => $request->DESCRIPTION,
            'IMG_URL'      => $request->IMG_URL,
            'ACTIVE_FLAG'  => $request->ACTIVE_FLAG,
            'UPDATE_DATE'  => now(),
        ]);

        if($updated){
            return redirect()->route('admin.products.index')
                ->with('success', 'Cập nhật thành công!');
        }

        return back()->with('error', 'Cập nhật thất bại!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('ID', $id)->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Xóa sản phẩm thành công!');
    }
}
