@extends('layouts.user_type.pelanggan')

@section('content')

<main class="main-content  mt-0">
  <section>
    <div class="page-header min-vh-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Selamat Datang Kembali</h3>
                <p class="mb-0">Buat akun baru<br></p>
                <p class="mb-0">Atau Masuk dengan akun yang sudah terdaftar</p>
              </div>
              @if(session()->has('success'))
              <div x-data="{ show: true}"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                class="position-relative bg-success rounded text-sm py-2 px-4 my-2">
                <p class="m-0">{{ session('success')}}</p>
              </div>
              @endif
              <div class="card-body">
                <form role="form" method="POST" action="/auth">
                  @csrf
                  <label>Username</label>
                  <div class="mb-3">
                    <input type="username" class="form-control" name="username" id="username" placeholder="Username" aria-label="username" aria-describedby="username-addon">
                    @error('username')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                    @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                    <label class="form-check-label" for="rememberMe">Ingat saya</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Belum punya akun?
                  <a href="register" class="text-info text-gradient font-weight-bold">Daftar</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection