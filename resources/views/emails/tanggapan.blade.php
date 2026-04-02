@component('mail::message')
# Ada Tanggapan Baru pada Laporan Anda

Halo, **{{ $laporan->user->name }}**!

Admin telah memberikan tanggapan pada laporan Anda.

---

**Judul Laporan:** {{ $laporan->judul }}
**Status Saat Ini:** {{ ucfirst($laporan->status) }}

---

**Tanggapan Admin:**

{{ $tanggapan->isi }}

---

@component('mail::button', ['url' => route('warga.laporan.show', $laporan->id)])
Lihat Laporan Saya
@endcomponent

Terima kasih,
{{ config('app.name') }}
@endcomponent