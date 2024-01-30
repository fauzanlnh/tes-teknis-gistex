@extends('dashboard.template.main')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex mb-4 justify-content-between">
                    <div>
                        <h4>Data Barang</h4>
                    </div>
                    <div>
                        <a class='btn btn-primary' href="{{ route('dashboard.barang.create') }}">Tambah Data Barang</a>
                    </div>
                </div>
                @if (session('success'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif

                <table class="table table-striped table-bordered ">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stuffs as $stuff)
                            <tr class="text-center">
                                <td>{{ $stuff->kode_barang }}</td>
                                <td>{{ $stuff->nama_barang }}</td>
                                <td>{{ $stuff->satuan }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class='btn btn-warning' style="margin-right:20px"
                                            href="{{ route('dashboard.barang.edit', $stuff->kode_barang) }}">Ubah</a>

                                        <form
                                            onsubmit="return confirm('Apakah Anda Yakin menghapus {{ $stuff->kode_barang }}?');"
                                            action="{{ route('dashboard.barang.destroy', $stuff->kode_barang) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i value="Delete">Hapus</button>
                                        </form>

                                    </div>

                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
