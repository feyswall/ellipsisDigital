<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $books = Book::paginate(2);
        return view("admin.books.books")
            ->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.books.createBook");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'book_title' => 'required|string|max:255',
            'book' => 'required|mimes:pdf|max:2048',
            'thumbnail' => 'required|mimes:png,jpg,jpeg|max:2048',
        ];

        Validator::make( $request->all(), $rules )->validate();

//        getClientOriginalName(); getting file origin name

        $fileName = time().'c.'.$request->book->extension();
        $thumbnail_Name = time().'.'.$request->thumbnail->extension();

        $request->book->move(public_path('uploads/books'), $fileName);
        $request->thumbnail->move(public_path('uploads/thumbnails'), $thumbnail_Name);


        $created = Book::create([
            "book_name" => $request['book_title'],
            "book_url" => $fileName,
            "thumbnail" => $thumbnail_Name,
        ]);

        if ( !$created ){
            return redirect()->back()->with('status', 'Profile updated!');
        }else{
            return redirect()->route("admin.book.show", $created);
        }
    }







    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return
     */
    public function show(Book $book)
    {
       return view("admin.books.showBook")
           ->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return
     */
    public function edit(Book $book)
    {
        return view("admin.books.editBook")
            ->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'book_title' => 'required|string|max:255',
            'thumbnail' => 'required|mimes:png,jpg,jpeg|max:2048',
        ];

        Validator::make( $request->all(), $rules )->validate();

        $thumbnail_Name = time().'.'.$request->thumbnail->extension();



        if (File::exists(public_path('uploads/thumbnails/'.$book->thumbnail))) {
            File::delete(public_path('uploads/thumbnails/'.$book->thumbnail));
        }

        $request->thumbnail->move(public_path('uploads/thumbnails'), $thumbnail_Name);

        $created = $book->update([
            "book_name" => $request['book_title'],
            "thumbnail" => $thumbnail_Name,
        ]);

        if ( !$created ){
            return redirect()->back()->with('error', 'fail to update book');
        }else{
            return redirect()->route("admin.book.show", $book);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if (File::exists(public_path('uploads/thumbnails/'.$book->thumbnail))) {
            File::delete(public_path('uploads/thumbnails/'.$book->thumbnail));
        }

        if (File::exists(public_path('uploads/books/'.$book->book_url))) {
            File::delete(public_path('uploads/books/'.$book->book_url));
        }

        $book->delete();

        return redirect()->route("admin.book.index");
    }
}
