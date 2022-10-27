@extends('layouts.admin')

@section('title')
    <title>edit user | page"</title>
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
          
                          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edit {{ $user->name }} Account</p>
          
                          <form class="mx-1 mx-md-4" method="POST" action="{{ route("admin.user.update", $user ) }}">
                            @csrf
                            @method('patch')
                            <div class="d-flex flex-row align-items-center mb-4">
                              <div class="form-outline flex-fill mb-0">
                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}"/>
                                <label class="form-label" for="name">Name</label>
                                @error("name")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
          
                            <div class="d-flex flex-row align-items-center mb-4">
                              <div class="form-outline flex-fill mb-0">
                                <input type="text" id="email" name="email" class="form-control" value="{{ $user->email }}" />
                                <label class="form-label" for="email">Email</label>
                                @error("email")
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>


                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                  <input type="password" id="password" name="password" class="form-control" />
                                  <label class="form-label" for="password">password</label>
                                  @error("password")
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                            </div>


                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" />
                                  <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                  @error("password_confirmation")
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                            </div>
            
                              
                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                              <button type="submit" class="btn btn-success btn-md">update</button>
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