@extends("layouts.admin")

@section("title")
    <title>dashboard | page</title>
@endsection

@section('topJs')

@endsection

@section("content")
    <div class="container-fluid">

        <h1>Admin Dashboard</h1>
        <a href="{{ route("admin.book.index") }}">View Books</a>
    </div>
@endsection
