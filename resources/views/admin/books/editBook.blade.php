@extends("layouts.admin")

@section("title")
<title>edit | book</title>
@endsection

@section("content")
<div class="row justify-conte-center">
    <div class="col-md-12 col-sm-12">
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                  <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                      <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-8 col-xl-8 order-2 order-lg-1">

                          <div>
                            <img src="{{ asset('uploads/thumbnails/'.$book->thumbnail) }}" class="w-25 m-auto" alt="">
                            <h5>Book Title: {{ $book->book_name  }}</h5>
                          </div>
          
                          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Update Book</p>
          
                          <form class="mx-1 mx-md-4" method="POST" action="{{ route("admin.book.update", $book) }}" enctype="multipart/form-data">
                            @csrf
                            @method("patch")
                            <div class="d-flex flex-row align-items-center mb-4">
                              <div class="form-outline flex-fill mb-0">
                                <input type="text" id="book_title" name="book_title" class="form-control" value="{{ $book->book_name }}" />
                                <label class="form-label" for="book_title">Book Tittle</label>
                                @error("book_title")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
          
                            <div class="d-flex flex-row align-items-center mb-4">
                              <div class="form-outline flex-fill mb-0">
                                @error("thumbnail")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                                <input type="file" id="thumbnail" name="thumbnail" class="form-control" />
                                <label class="form-label" for="thumbnail">Thumbnail</label>
                              </div>
                              <div>

                              </div>
                            </div>
          
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                              <button type="submit" class="btn btn-primary btn-lg">update</button>
                            </div>
          
                          </form>
          
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </div>
</div>
@endsection