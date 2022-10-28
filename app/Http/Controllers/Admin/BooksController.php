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
        $books = Book::latest()->paginate(20);
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
            'book' => 'nullable|mimes:pdf|max:2048',
            'thumbnail' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ];

        Validator::make( $request->all(), $rules )->validate();

        $uploader = [
            "book_name" => $request['book_title'],
        ];

        if ( $request->book != null ){

            $image = $request->file('book');
            $extension = $image->getClientOriginalExtension();//Getting extension
            $originalname = $image->getClientOriginalName();//Getting original name
            $path = $image->move('uploads/books/' , $originalname);

            $fileName = $originalname;
            
            $uploader["book_url"] = $fileName;
        }else{
            $uploader["book_url"] = 'default_pdf.pdf';
        }

        if ( $request->thumbnail != null ){
            $thumbnail_Name = time().'.'.$request->thumbnail->extension();
            $request->thumbnail->move(public_path('uploads/thumbnails'), $thumbnail_Name);

            $uploader["thumbnail"] = $thumbnail_Name;
        }else{
            $uploader['thumbnail'] = 'default_thumbnail.png';
        }

        $created = Book::create($uploader);

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
        ];

        if ( $request->thumbnail != null ){
            $rules['thumbnail']  = 'required|mimes:png,jpg,jpeg|max:2048';
        }

        Validator::make( $request->all(), $rules )->validate();


        $updator = [ "book_name" => $request['book_title'] ];

        if ( $request->thumbnail != null ){

            $thumbnail_Name = time().'.'.$request->thumbnail->extension();

            if (File::exists(public_path('uploads/thumbnails/'.$book->thumbnail))) {
                if ( $book->thumbnail != 'default_thumbnail.png') {
                    File::delete(public_path('uploads/thumbnails/' . $book->thumbnail));
                }
            }
            $request->thumbnail->move(public_path('uploads/thumbnails'), $thumbnail_Name);

            $updator["thumbnail"] = $thumbnail_Name;
        }

        $created = $book->update($updator);

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
            if ( $book->thumbnail != 'default_thumbnail.png'){
                File::delete(public_path('uploads/thumbnails/'.$book->thumbnail));
            }
        }

        if (File::exists(public_path('uploads/books/'.$book->book_url))) {
            if ( $book->book_url != 'default_pdf.pdf'){
                File::delete(public_path('uploads/books/'.$book->book_url));
            }
        }

        $book->delete();

        return redirect()->route("admin.book.index");
    }
}
