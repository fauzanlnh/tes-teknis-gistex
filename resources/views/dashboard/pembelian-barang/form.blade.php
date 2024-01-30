@extends('dashboard.template.main')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="card-title">{{ isset($pembelianBarang) ? 'Edit' : 'Tambah' }} Data Pembelian Barang</h4>
                    <div class="card-body">
                        <form
                            action="{{ isset($pembelianBarang) ? route('dashboard.pembelian-barang.update', $pembelianBarang->kode_barang) : route('dashboard.pembelian-barang.store') }}"
                            method="POST">
                            {{ csrf_field() }}
                            @if (isset($pembelianBarang))
                                {{ method_field('patch') }}
                            @endif

                            {{--  --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail" class="form-label ">Tanggal Pembelian</label>
                                <input type="date" class="form-control " id="exampleInputEmail"
                                    aria-describedby="tanggal_pembelianHelp" name="tanggal"
                                    value="{{ old('tanggal_pembelian', isset($stuff) ? $stuff->tanggal_pembelian : now()->toDateString()) }}"
                                    readonly>
                                <div class="mt-4">
                                    <table class="table table-striped table-bordered ">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Diskon</th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barang as $stuff)
                                                <tr class="text-center">
                                                    <td>
                                                        <input type="text" class="form-control " id="exampleInputEmail"
                                                            aria-describedby="tanggal_pembelianHelp" name="kode_barang[]"
                                                            value="{{ $stuff->kode_barang }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control " id="exampleInputEmail"
                                                            aria-describedby="tanggal_pembelianHelp"
                                                            value="{{ $stuff->nama_barang }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control " id="exampleInputEmail"
                                                            aria-describedby="tanggal_pembelianHelp" name="qty[]"
                                                            value="{{ old('qty', isset($pembelianBarang) ? $pembelianBarang->qty : '') }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control " id="exampleInputEmail"
                                                            aria-describedby="tanggal_pembelianHelp"
                                                            value="{{ $stuff->satuan }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control " id="exampleInputEmail"
                                                            aria-describedby="tanggal_pembelianHelp" name="harga[]"
                                                            value="{{ old('harga', isset($pembelianBarang) ? $pembelianBarang->harga : $stuff->harga) }}"
                                                            readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control " id="exampleInputEmail"
                                                            aria-describedby="tanggal_pembelianHelp" name="diskon[]"
                                                            value="{{ old('diskon', isset($pembelianBarang) ? $pembelianBarang->diskon : '') }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control " id="exampleInputEmail"
                                                            aria-describedby="tanggal_pembelianHelp" name="subtotal[]"
                                                            value="{{ old('diskon', isset($pembelianBarang) ? $pembelianBarang->subotal : '') }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            {{--  --}}
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
