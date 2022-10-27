@extends("layouts.admin")

@section("title")
    <title>all books | page</title>
    @endsection

@section("content")

    <div class="container">
        <a href="{{ route("admin.book.create") }}" class="btn btn-sm btn-success">+ Add book</a>
        <div class="row justify-content-center">

            @foreach( $books as  $book )
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('uploads/thumbnails/'.$book->thumbnail) }}" class="card-img-top" alt="">
                        <a href="{{ asset('uploads/books/'.$book->book_url) }}" download >download</a>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $book->book_name}}
                            </p>
                            <form action="{{ route("admin.book.delete", $book)  }}" method="post" id="deleteBookForm">
                                @csrf
                                @method('delete')
                            </form>
                            <button class="btn btn-sm btn-danger" onClick="deleteBook()">delete</button>
                            <a href="{{ route("admin.book.edit", $book ) }}" class="btn btn-sm btn-primary">edit</a>
                            <a href="{{ route("admin.book.show", $book) }}" class="btn btn-sm btn-info">view</a>
                        </div>
                    </div>
                </div>
            @endforeach
                <div>
                    <span> {{ $books->links() }}</span>
                </div>

        </div>
    </div>

    @endsection


@section('js')
    <script>
        function deleteBook(e) {
            if(confirm('Are you sure you want to delete the book?')){
                var form = document.querySelector("#deleteBookForm");
                form.submit();
            }
        }
    </script>
@endsection