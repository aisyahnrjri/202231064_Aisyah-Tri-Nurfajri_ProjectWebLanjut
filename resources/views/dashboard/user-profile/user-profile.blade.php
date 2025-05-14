@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ Auth::guard('admin')->user()->nama_admin }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ Auth::guard('admin')->user()->level->nama_level }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/user-profile" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_admin" class="form-control-label">{{ __('Nama Lengkap') }}</label>
                                <div class="@error('nama_admin') border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ Auth::guard('admin')->user()->nama_admin }}" type="text" placeholder="Nama Lengkap" id="nama_admin" name="nama_admin">
                                    @error('nama_admin')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-control-label">{{ __('Username') }}</label>
                                <div class="@error('username') border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ Auth::guard('admin')->user()->username }}" type="text" placeholder="Username" id="username" name="username" disabled>
                                    @error('username')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{ __('Password Baru') }}</label>
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="password" placeholder="Password Baru" id="password" name="password">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan Perubahan' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection