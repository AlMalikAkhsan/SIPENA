@extends('layouts.app')

@section('content')
<h4 class="mb-4">Dashboard Admin</h4>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <small>Total Laporan</small>
                <h3 class="fw-bold">
                    {{ \App\Models\Laporan::count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-warning">
            <div class="card-body">
                <small>Menunggu</small>
                <h3 class="fw-bold text-warning">
                    {{ \App\Models\Laporan::where('status','menunggu')->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-primary">
            <div class="card-body">
                <small>Diproses</small>
                <h3 class="fw-bold text-primary">
                    {{ \App\Models\Laporan::where('status','diproses')->count() }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <small>Selesai</small>
                <h3 class="fw-bold text-success">
                    {{ \App\Models\Laporan::where('status','selesai')->count() }}
                </h3>
            </div>
        </div>
    </div>
</div>

<hr>

<h5 class="mt-4">Laporan Terbaru</h5>

<table class="table table-bordered bg-white shadow-sm">
    <tr>
        <th>Judul</th>
        <th>Warga</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>

    @foreach(\App\Models\Laporan::latest()->take(5)->get() as $item)
    <tr>
        <td>{{ $item->judul }}</td>
        <td>{{ $item->user->name }}</td>
        <td>
            <span class="badge 
                @if($item->status == 'menunggu') bg-warning
                @elseif($item->status == 'diproses') bg-primary
                @else bg-success @endif
            ">
                {{ ucfirst($item->status) }}
            </span>
        </td>
        <td>{{ $item->created_at->format('d M Y') }}</td>
    </tr>
    @endforeach
</table>
@endsection
