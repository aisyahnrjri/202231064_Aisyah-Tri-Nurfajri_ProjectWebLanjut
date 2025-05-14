@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Pengaturan Level</h5>
                            <form action="{{route('level-management.index')}}" class="my-3" method="get">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                                    <button type="submit" class="btn bg-gradient-primary m-0"><i class="fas fa-search" aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex align-items-start">
                            @include('dashboard.level-management.tambah.tambah-level-management')
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
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        no
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Level
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($level as $index => $levels)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $level->firstItem() + $index }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $levels->nama_level }}</p>
                                    </td>
                                    <td class="d-flex justify-content-center gap-2">
                                        <a href="javascript:" data-id="{{ $levels->id_level }}" onclick="editLevel(this)" class="btn bg-gradient-secondary btn-sm m-0">
                                            Ubah
                                        </a>
                                        <a href="{{ url('pengaturan-level/delete/' . $levels->id_level) }}" class="btn bg-gradient-danger btn-sm m-0" onclick="event.preventDefault(); confirmDelete(this)">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('dashboard.level-management.ubah.ubah-level-management')
                        <div class="px-3 pt-3">
                            {{ $level->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(link) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika dikonfirmasi, arahkan ke link penghapusan
                window.location.href = link.href;
            }
        });
    }
</script>

@endsection