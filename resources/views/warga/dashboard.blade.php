@extends('layouts.app')

@section('content')
<h4 class="mb-4">Dashboard Warga</h4>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <small>Total Laporan</small>
                <h3 class="fw-bold">
                    {{ \App\Models\Laporan::where('user_id', auth()->id())->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-warning">
            <div class="card-body">
                <small>Menunggu</small>
                <h3 class="fw-bold text-warning">
                    {{ \App\Models\Laporan::where('user_id', auth()->id())->where('status','menunggu')->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-primary">
            <div class="card-body">
                <small>Diproses</small>
                <h3 class="fw-bold text-primary">
                    {{ \App\Models\Laporan::where('user_id', auth()->id())->where('status','diproses')->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <small>Selesai</small>
                <h3 class="fw-bold text-success">
                    {{ \App\Models\Laporan::where('user_id', auth()->id())->where('status','selesai')->count() }}
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('warga.laporan.create') }}" class="btn btn-primary">
        + Buat Laporan Baru
    </a>
</div>
@endsection
