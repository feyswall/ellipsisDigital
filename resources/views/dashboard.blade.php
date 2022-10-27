@extends("layouts.system")

@section("title")
    <title>dashboard | page</title>
    @endsection

@section("topJs")
    <script>
        function logoutUser() {
            if(confirm('Are you sure you want to delete the book?')){
                var form = document.querySelector("#logoutForm");
                form.submit();
            }
        }
    </script>
@endsection


@section("content")
    <div class="container mt-3">
        <h1>User Dashboard</h1>
        <a href="{{ route('book.index') }}">All Books</a>
    </div>
@endsection

