<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $category=$request->validate([
            'name' => 'required',
        ]);

        if(Category::create($category)){
            return redirect()->route('category.index')->with('success', 'Category created successfully');
        }
        return back()->with('error', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //

        return view('category.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //

        $request->validate([
            'name' => 'required',
        ]);

        if($category->update($request->all())){
            return redirect()->route('category.index')->with('success', 'Category updated successfully');
        }
        return back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        if($category->delete()){
            return redirect()->route('category.index')->with('success', 'Category deleted successfully');
        }
    }
}
