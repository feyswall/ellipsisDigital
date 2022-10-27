@extends("layouts.system")

@section("title")
    <title>all books | page</title>
@endsection

@section("content")

    <div class="container">

        <div class="row justify-content-center">
            @foreach( $favors as  $favor )
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('uploads/thumbnails/'.$favor->book->thumbnail) }}" class="card-img-top" alt="">
                        <a href="{{ asset('uploads/books/'.$favor->book->book_url) }}" download >download</a>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $favor->book->book_name}}
                            </p>
                            <a href="{{ route("book.show", $favor->book) }}" class="btn btn-sm btn-info">view</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div>
                <span> {{ $favors->links() }}</span>
            </div>

        </div>
    </div>

@endsection


@section('js')

@endsection