<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $book = Book::with('category')->get();
        return view('book.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::all();
        return view('book.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'cover' => 'required',
        ]);

        if($request->hasFile('cover')){
            $imageName = time().'.'.$request->file('cover')->getClientOriginalExtension();
              
             $request->cover->move(public_path('images'), $imageName);
            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'isbn' => $request->isbn,
                'category_id' => $request->category,
                'price' => $request->price,
                'description' => $request->description,
                'cover' => $imageName,
            ]);

            return redirect()->route('books.index')->with('msg','Succes Add Book');
        }

        return back()->with('msg','Error While Add Book');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        $book = Book::with('category')->find($book->id);
        $category = Category::all();
        return view('book.edit', compact('book', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
