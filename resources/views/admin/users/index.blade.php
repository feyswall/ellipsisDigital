@extends('layouts.admin')

@section('title')
    <title>all users | page</title>
@endsection

@section('content')
    <div class="container">
        <div class="mt-5">
            <h2 class="text-center">All Users</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-sm btn-primary">Edit</a>
                            <button class="btn btn-sm btn-danger" onClick="deleteUser()">delete</button>
                            <a href="{{ route("admin.user.show", $user ) }}" class="btn btn-sm btn-info">view</a>
                            <form action="{{ route('admin.user.delete', $user) }}" method="post" id="deleteUserForm">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="mb-5">
            <span>{{ $users->links() }}</span>
        </div>
    </div>
@endsection


@section('js')
<script>
    function deleteUser(e) {
        if (confirm('Are you sure you want to delete the book?')) {
            var form = document.querySelector("#deleteUserForm");
            form.submit();
        }
    }
</script>
@endsection