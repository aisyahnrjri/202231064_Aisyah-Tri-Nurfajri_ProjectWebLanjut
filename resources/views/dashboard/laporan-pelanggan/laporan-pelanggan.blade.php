@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Laporan Pelangggan</h5>
                            <form action="{{route('laporan-pelanggan.index')}}" class="my-3" method="get">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                                    <button type="submit" class="btn bg-gradient-primary m-0"><i class="fas fa-search" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex align-items-start">
                            <form action="{{ url('laporan-pelanggan/export') }}" method="get">
                                <button type="submit" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#tambah-user">
                                    <i class="fa-solid fa-download fs-6 me-1"></i> Export Excel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
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
                                        Username
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nomor KWH
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Alamat
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Daya
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pelanggans as $index => $pelanggan)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $pelanggans->firstItem() + $index }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $pelanggan->nama_pelanggan }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $pelanggan->username }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $pelanggan->nomor_kwh }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 100px;">{{ $pelanggan->alamat }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $pelanggan->tarif->daya }}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-3 pt-3">
                            {{ $pelanggans->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection