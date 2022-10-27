@extends('layouts.admin')

@section('title')
    <title>all users | page</title>
@endsection

@section("topJs")
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    @endsection

@section('content')

        <div class="container">
            <div class="row mt-3 justify-content-start">
                <div class=" col-md-10 col-lg-6">
                 <div class="well profile">
                    <div class="col-sm-12">
                        <div class="col-xs-12 col-sm-8">
                            <h2>Name: {{ $user->name }}</h2>
                            <p><strong>Email: </strong> {{ $user->email }} </p>
                            <p>
                                <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger" onClick="deleteUser()">delete</button>

                                <form action="{{ route('admin.user.delete', $user) }}" method="post" id="deleteUserForm">
                                    @csrf
                                    @method('delete')
                                </form>
                            </p>

                        </div>
                    </div>
                 </div>                 
                </div>
            </div>
        </div>
@endsection

<script>
    function deleteUser(e) {
        if (confirm('Are you sure you want to delete the book?')) {
            var form = document.querySelector("#deleteUserForm");
            form.submit();
        }
    }
</script>
