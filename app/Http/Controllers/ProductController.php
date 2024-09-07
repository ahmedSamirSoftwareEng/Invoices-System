<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $products = Product::all();
        return view('products.index', compact('products', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'product_name' => 'required|max:255',
                'section_id' => 'required',
            ],
            [
                'product_name.required' => 'يرجي ادخال اسم المنتج',
                'section_id.required' => 'يرجي اختيار القسم',
            ]
        );
        //    check if name of new product is exist in same section 

        $product = Product::where('section_id', $request->section_id)->where('product_name', $request->product_name)->first();
        if ($product) {
            $section = Section::where('id', $request->section_id)->first();
            session()->flash('Error', ' المنتج موجود مسبقا في' . ' ' . $section->section_name);
            return redirect('/products');
        }


        Product::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
            'created_by' => Auth::user()->name,
        ]);
        session()->flash('Add', 'تمت الاضافة بنجاح');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $section_id = Section::where('section_name', $request->section_name)->first()->id;

        $products = Product::findorfail($request->id);
        $products->update([
            'product_name' => $request->product_name,
            'section_id' => $section_id,
            'description' => $request->description,
            'updated_by' => Auth::user()->name,
        ]);
        session()->flash('edit', 'تم تعديل المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $products = Product::find($id);
        $products->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return redirect('/products');
    }
}
