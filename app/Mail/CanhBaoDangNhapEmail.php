<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CanhBaoDangNhapEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $thoigian;

    public function __construct($user)
    {
        $this->user = $user;
        // Lấy giờ Việt Nam hiện tại
        $this->thoigian = now()->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Cảnh báo đăng nhập hệ thống Techvina Shop', // Tiêu đề email
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.canhbaodangnhap',
        );
    }
}
