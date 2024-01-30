<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard.index') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (auth()->user()->role === 'Admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.user.index') }}">Master User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.barang.index') }}">Master barang</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">Pembelian Barang</a></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">Report Rekap Pembelian</a></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
