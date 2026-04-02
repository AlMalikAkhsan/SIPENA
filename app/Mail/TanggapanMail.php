<?php

namespace App\Mail;

use App\Models\Tanggapan;
use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TanggapanMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Laporan $laporan,
        public Tanggapan $tanggapan
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ada Tanggapan Baru pada Laporan Anda: ' . $this->laporan->judul,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.tanggapan',
        );
    }
}