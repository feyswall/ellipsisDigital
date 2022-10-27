

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('title')

    @yield('topJs')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script>
        function logoutUser() {
            if(confirm('Are you sure you want to logout?')){
                var form = document.querySelector("#logoutForm");
                form.submit();
            }
        }
    </script>
</head>
<body>
    <div class="mt-4 p-5 bg-success text-white rounded">
        <h1>Admin Panel</h1>
        <p>Welcome {{ Auth::user()->name }}</p>
        Today is {{ Carbon\Carbon::now()->format("M d y H:i") }}
    </div>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Ellipsis Digital</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route("admin.dashboard") }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.book.index') }}">books</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.index') }}">users</a>
              </li>

              {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Link
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li> --}}
            </ul>
            <form action="{{ route("logout") }}" method="post" id="logoutForm">
                @csrf
                <button class="btn btn-sm btn-danger" type="button" onclick="logoutUser()">logout</button>
            </form>
          </div>
        </div>
      </nav>

    @if ( session()->has('status'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session()->get('status') }}
        </div>
    @endif

    @if ( session()->has('error'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif

    @yield("content")

    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


