@extends('layouts.system')

@section('title')
    <title>single | book</title>
@endsection

@section('content')
    <div>
        <a href="{{ route('book.index') }}">All Books</a>
    </div>
    <div class="container">
        <div class="card">
            <img src="{{ asset('uploads/thumbnails/' . $book->thumbnail) }}" class="card-img-top w-25" alt="">
            <a href="{{ asset('uploads/books/' . $book->book_url) }}" download>download</a>
            <div class="card-body">
                <p class="card-text">
                    {{ $book->book_name }}
                </p>



                @php

                    $likesCount = \Illuminate\Support\Facades\DB::table('likes')
                        ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                        ->where('book_id', $book->id);

                    $FavourCount = \Illuminate\Support\Facades\DB::table('favouriates')
                        ->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)
                        ->where('book_id', $book->id);

                @endphp

                @if ($likesCount->count() <= 0)
                    <button form="likeBook" type="submit" class="btn btn-sm btn-warning">like</button>
                @else
                    <button form="unlikeBook" type="submit" class="btn btn-sm btn-outline-warning">dislike</button>
                @endif



                @if ($FavourCount->count() <= 0)
                    <button class="btn btn-sm btn-warning" form="addToFavourite">add to favourite</button>
                @else
                    <button class="btn btn-sm btn-outline-warning" form="removeFromFavourite">remove to favourite</button>
                @endif



                <form method="POST" action="{{ route('favorite.add') }}" id="addToFavourite">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                </form>
                <form method="POST" action="{{ route('favorite.remove') }}" id="removeFromFavourite">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                </form>



                <form id="likeBook" action="{{ route('like.likeBook') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                </form>
                <form id="unlikeBook" action="{{ route('like.dislikeBook') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                </form>




                <div id="comments">
                    <div class="container">
                        <div class="row">
                            <div class="panel panel-default widget">
                                <div class="panel-heading">
                                    <span class="glyphicon glyphicon-comment"></span>
                                    <h3 class="panel-title">
                                        Recent Comments ( {{ $book->comments()->count() }} )</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        @foreach ($book->comments as $comment)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-xs-2 col-md-1">
                                                        <img src="http://placehold.it/80" class="img-circle img-responsive"
                                                             alt="" />
                                                    </div>
                                                    <div class="col-xs-10 col-md-11">
                                                        <div>
                                                            <div class="mic-info">
                                                                By: <a href="#">{{ $comment->user->name }}</a>
                                                                {{ \Carbon\Carbon::parse($comment->created_at)->format('M d y H:ia') }}
                                                            </div>
                                                        </div>
                                                        <div class="comment-text">
                                                            {{ $comment->comment }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div>
                            <form action="{{ route('comment.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="comment">comment</label>
                                    <textarea type="text" name="comment" class="form-control" rows="3"></textarea>

                                    <input class="" type="hidden" name="book_id" value="{{ $book->id }}">
                                    <div>
                                        @error('comment')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-block btn-primary mt-2">submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        function deleteBook(e) {
            if (confirm('Are you sure you want to delete the book?')) {
                var form = document.querySelector("#deleteBookForm");
                form.submit();
            }
        }
    </script>
@endsection
