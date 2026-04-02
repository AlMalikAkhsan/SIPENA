@component('mail::message')
# ❌ Laporan Anda Ditolak

Halo, **{{ $laporan->user->name }}**!

Kami informasikan bahwa laporan yang Anda kirimkan **tidak dapat kami proses**.

---

**Detail Laporan:**

| | |
|---|---|
| **ID Laporan** | #{{ str_pad($laporan->id, 5, '0', STR_PAD_LEFT) }} |
| **Judul** | {{ $laporan->judul }} |
| **Tanggal Kirim** | {{ $laporan->created_at->format('d F Y, H:i') }} WIB |
| **Tanggal Ditolak** | {{ $laporan->updated_at->format('d F Y, H:i') }} WIB |

---

**⚠️ Alasan Penolakan:**

{{ $laporan->alasan_penolakan }}

---

Anda dapat mengirimkan laporan baru dengan informasi yang lebih lengkap sesuai alasan di atas.

@component('mail::button', ['url' => route('warga.laporan.show', $laporan->id), 'color' => 'red'])
Lihat Detail Laporan
@endcomponent

Terima kasih atas perhatian Anda.

Salam,
{{ config('app.name') }}
@endcomponent