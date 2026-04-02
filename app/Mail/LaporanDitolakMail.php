<?php

namespace App\Mail;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LaporanDitolakMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Laporan $laporan
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '❌ Laporan Anda Ditolak - ' . $this->laporan->judul,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.laporan-ditolak',
        );
    }
}