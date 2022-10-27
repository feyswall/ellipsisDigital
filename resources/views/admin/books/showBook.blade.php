@extends("layouts.admin")

@section("title")
    <title>single | book</title>
@endsection

@section("content")
    <div>
        <a href="{{ route('admin.book.index') }}">All Books</a>
    </div>
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