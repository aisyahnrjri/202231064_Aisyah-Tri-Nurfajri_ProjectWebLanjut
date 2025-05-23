@extends('layouts.user_type.guest')

@section('content')

<section class="min-vh-100 mb-8">
  <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center mx-auto">
          <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
          <p class="text-lead text-white">Silahkan login atau daftarkan akun anda.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
          <div class="card-header text-center pt-4">
            <h5>Daftar</h5>
          </div>
          <div class="card-body">
            <form role="form text-left" method="POST" action="{{ route('register') }}">
              @csrf
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Name" name="nama_pelanggan" id="nama_pelanggan" aria-label="nama_pelanggan" aria-describedby="nama_admin" value="{{ old('name') }}">
                @error('name')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Username" name="username" id="username" aria-label="username" aria-describedby="username-addon" value="{{ old('username  ') }}">
                @error('username')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                @error('password')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-3">
                <select class="form-select" name="id_tarif" required>
                  <option selected value="">-- Pilih Tarif --</option>
                  @foreach($tarifs as $tarif)
                  <option value='{{ $tarif->id_tarif }}'>{{$tarif->daya}} - Rp {{number_format($tarif->tarifperkwh, 0, ',', '.')}}</option>
                  @endforeach
                </select>
                @error('tarif')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-3">
                <textarea name="alamat" class="form-control" placeholder="Alamat" rows="5"></textarea>
                @error('tarif')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-check form-check-info text-left">
                <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault" checked>
                <label class="form-check-label" for="flexCheckDefault">
                  Saya setuju dengan <a href="javascript:;" class="text-dark font-weight-bolder">Syarat dan Ketentuan</a>
                </label>
                @error('agreement')
                <p class="text-danger text-xs mt-2">Pertama, setujui syarat dan ketentuan lalu coba daftar kembali.</p>
                @enderror
              </div>
              @if ($errors->any())
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
              @endif
              <div class="text-center">
                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
              </div>
              <p class="text-sm mt-3 mb-0">Sudah punya akun? <a href="login" class="text-dark font-weight-bolder">Masuk</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection