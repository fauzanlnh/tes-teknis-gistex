@extends('dashboard.template.main')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex mb-4 justify-content-between">
                    <div>
                        <h4>Data Pembelian Barang</h4>
                    </div>
                    <div>
                        <a class='btn btn-primary' href="{{ route('dashboard.pembelian-barang.create') }}">Tambah Data
                            Pembelian Barang</a>
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
                            <th scope="col">Kode Pembelian</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelianBarang as $item)
                            <tr class="text-center">
                                <td>{{ $item->nomor_pemelian }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class='btn btn-warning' style="margin-right:20px"
                                            href="{{ route('dashboard.pembelian-barang.edit', $item->nomor_pembelian) }}">Ubah</a>
                                        <form
                                            onsubmit="return confirm('Apakah Anda Yakin menghapus {{ $item->nomor_pembelian }}?');"
                                            action="{{ route('dashboard.pembelian-barang.destroy', $item->nomor_pembelian) }}"
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
