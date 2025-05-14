@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Tagihan Listrik</h5>
                            <form action="{{route('tagihan-management.index')}}" class="my-3" method="get">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                                    <button type="submit" class="btn bg-gradient-primary m-0"><i class="fas fa-search" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if($errors->any())
                    <div class="mt-3  alert alert-primary alert-dismissible fade show mx-4" role="alert">
                        <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show mx-4" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    <span class="px-4 text-xs text-danger">*Pelanggan menunggak lebih dari 3 bulan berwarna merah</span>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        no
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Pelanggan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nomor KWH
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Alamat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penggunaans as $index => $penggunaan)
                                @php
                                $pendingTagihans = $tagihans->filter(function($tagihan) use ($penggunaan) {
                                return $tagihan->id_pelanggan == $penggunaan->id_pelanggan && $tagihan->status == 'pending';
                                })->count();
                                @endphp

                                @if($pendingTagihans >= 3)
                                <tr class="bg-gradient-danger text-white">
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $penggunaans->firstItem() + $index }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $penggunaan->nama_pelanggan }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $penggunaan->nomor_kwh }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 150px;">{{ $penggunaan->alamat }}</p>
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-center gap-2">
                                        <a href="{{ url('detail-tagihan-listrik/' . $penggunaan->id_pelanggan) }}" class="btn btn-outline-white btn-sm m-0">
                                            Detail Tagihan
                                        </a>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $penggunaans->firstItem() + $index }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $penggunaan->nama_pelanggan }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $penggunaan->nomor_kwh }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 150px;">{{ $penggunaan->alamat }}</p>
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-center gap-2">
                                        <a href="{{ url('detail-tagihan-listrik/' . $penggunaan->id_pelanggan) }}" class="btn btn-outline-primary btn-sm m-0">
                                            Detail Tagihan
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-3 pt-3">
                            {{ $penggunaans->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection