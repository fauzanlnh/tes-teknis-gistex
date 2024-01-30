@extends('dashboard.template.main')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex mb-4 justify-content-between">
                    <div>
                        <h4>Data User</h4>
                    </div>
                    <div>
                        <a class='btn btn-primary' href="{{ route('dashboard.user.create') }}">Tambah Data User</a>
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
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a class='btn btn-warning' style="margin-right:20px"
                                            href="{{ route('dashboard.user.edit', $user->email) }}">Ubah</a>

                                        <form onsubmit="return confirm('Apakah Anda Yakin menghapus {{ $user->email }}?');"
                                            action="{{ route('dashboard.user.destroy', $user->email) }}" method="POST">
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
