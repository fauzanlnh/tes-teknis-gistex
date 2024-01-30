@extends('dashboard.template.main')
@section('content')
    <div class="container mt-4">
        Selamat Datang {{ Auth::user()->nama }}
    </div>
@endsection
