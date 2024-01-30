@extends('dashboard.template.main')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="card-title">{{ isset($stuff) ? 'Edit' : 'Tambah' }} Data Barang</h4>
                    <div class="card-body">
                        <form
                            action="{{ isset($stuff) ? route('dashboard.barang.update', $stuff->kode_barang) : route('dashboard.barang.store') }}"
                            method="POST">
                            {{ csrf_field() }}
                            @if (isset($stuff))
                                {{ method_field('patch') }}
                            @endif

                            {{--  --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail" class="form-label ">Nama barang</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}"
                                    id="exampleInputEmail" aria-describedby="nama_barangHelp" name="nama_barang"
                                    value="{{ old('nama_barang', isset($stuff) ? $stuff->nama_barang : '') }}">
                                <div class="invalid-feedback">
                                    @error('nama_barang')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            {{--  --}}
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label ">Satuan</label>
                                <input type="text" class="form-control {{ $errors->has('satuan') ? 'is-invalid' : '' }}"
                                    id="exampleInputName" aria-describedby="satuanHelp" name="satuan"
                                    value="{{ old('satuan', isset($stuff) ? $stuff->satuan : '') }}">
                                <div class="invalid-feedback">
                                    @error('satuan')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            {{--  --}}
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label ">Qty</label>
                                <input type="number" class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}"
                                    id="exampleInputName" aria-describedby="qtyHelp" name="qty"
                                    value="{{ old('qty', isset($stuff) ? $stuff->qty : '') }}">
                                <div class="invalid-feedback">
                                    @error('qty')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            {{--  --}}
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label ">Harga</label>
                                <input type="number" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}"
                                    id="exampleInputName" aria-describedby="hargaHelp" name="harga"
                                    value="{{ old('harga', isset($stuff) ? $stuff->harga : '') }}">
                                <div class="invalid-feedback">
                                    @error('harga')
                                        {{ $message }}
                                    @enderror
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
