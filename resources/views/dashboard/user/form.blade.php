@extends('dashboard.template.main')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="card-title">{{ isset($user) ? 'Edit' : 'Tambah' }} Data User</h4>
                    <div class="card-body">
                        <form
                            action="{{ isset($user) ? route('dashboard.user.update', $user->email) : route('dashboard.user.store') }}"
                            method="POST">
                            {{ csrf_field() }}
                            @if (isset($user))
                                {{ method_field('patch') }}
                            @endif

                            {{--  --}}
                            <div class="mb-3">
                                <label for="exampleInputEmail" class="form-label ">E-Mail</label>
                                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                    value="{{ old('email', isset($user) ? $user->email : '') }}">
                                <div class="invalid-feedback">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            {{--  --}}
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label ">Nama</label>
                                <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                    id="exampleInputName" aria-describedby="namaHelp" name="nama"
                                    value="{{ old('nama', isset($user) ? $user->nama : '') }}">
                                <div class="invalid-feedback">
                                    @error('nama')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label ">Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    id="exampleInputName" aria-describedby="passwordHelp" name="password">
                                <div class="invalid-feedback">
                                    @error('password')
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
