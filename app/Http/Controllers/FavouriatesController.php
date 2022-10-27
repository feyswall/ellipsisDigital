<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favouriate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favors = Auth::user()->favouriates()->with('book')->paginate(20);
        return view("user.favourites.favourites")
            ->with('favors', $favors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function addToFavourite(Request $request)
    {
        $this->removeFromFavorite($request);

        $user_id = Auth::user()->id;
        Favouriate::create([
            'user_id' => $user_id,
            'book_id' => $request->book_id
        ]);
        $book = Book::find($request->book_id);
        return redirect()->back()->with('status', ' '.$book->book_name.' was added to your favourite');
    }


    public function removeFromFavorite(Request $request)
    {
        $user_id = Auth::user()->id;
        $favours = Favouriate::select('*')->where('user_id', $user_id)
            ->where('book_id', $request['book_id'])
            ->get();
        foreach ( $favours as $favour ){
            $favour->delete();
        }
        return redirect()->back();
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favouriate  $favouriate
     * @return \Illuminate\Http\Response
     */
    public function show(Favouriate $favouriate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favouriate  $favouriate
     * @return \Illuminate\Http\Response
     */
    public function edit(Favouriate $favouriate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favouriate  $favouriate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favouriate $favouriate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favouriate  $favouriate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favouriate $favouriate)
    {
        //
    }
}
