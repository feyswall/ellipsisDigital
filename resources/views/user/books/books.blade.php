@extends("layouts.system")

@section("title")
    <title>all books | page</title>
@endsection

@section("content")

    <div class="container">

        <div class="row justify-content-center">


            <main>

                <div class="mt-5 mb-1">
                    <span> {{ $books->links() }}</span>
                </div>


                <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                    <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                        @foreach ($books as $book)
                        <div class="col">
                            <div class="card h-100 shadow-sm"> <img
                                    src="{{ asset('uploads/thumbnails/' . $book->thumbnail) }}" class="card-img-top w-75 mx-auto mt-1"
                                    alt="...">
                                <div class="card-body">
                                    <div class="clearfix mb-3">
                                        <span class="float-end">
                                            <a class="text-muted small"
                                                href="{{ asset('uploads/books/' . $book->book_url) }}"
                                                download="download">Download</a></span>
                                    </div>
                                    <h5 class="card-title"> {{ $book->book_name }}</h5>

                                    <div class="text-center my-4"> 
                                        <a href="{{ route("book.show", $book) }}" class="btn btn-success">view</a>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                
            <div class="mb-5">
                <span> {{ $books->links() }}</span>
            </div>

            </main>

        </div>
    </div>

@endsection


@section('js')

@endsection