@extends('layouts.app')

@section('content')
<h4 class="mb-4">Semua Laporan Warga</h4>

<div class="row g-3">
    @forelse($laporans as $item)
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                @if($item->foto)
                    <img src="{{ asset('uploads/'.$item->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                @endif

                <div class="card-body">
                    <h6 class="fw-bold">{{ $item->judul }}</h6>

                    <small class="text-muted">
                        Oleh: {{ $item->user->name }}
                    </small>

                    <p class="text-muted small mt-2">
                        {{ Str::limit($item->isi_laporan, 80) }}
                    </p>

                    <span class="badge 
                        @if($item->status == 'menunggu') bg-warning
                        @elseif($item->status == 'diproses') bg-primary
                        @else bg-success @endif
                    ">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>

                <div class="card-footer bg-white d-flex justify-content-between">
                    <small class="text-muted">
                        {{ $item->created_at->format('d M Y') }}
                    </small>
                    <a href="{{ route('admin.laporan.show', $item->id) }}" class="btn btn-sm btn-outline-primary">
                        Detail
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                Belum ada laporan.
            </div>
        </div>
    @endforelse
</div>
@endsection
