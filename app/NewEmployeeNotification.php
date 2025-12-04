<?php

namespace App;

use App\Models\Karyawan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEmployeeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Karyawan $karyawan)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Karyawan Baru Ditambahkan')
            ->line('Karyawan baru bernama ' . $this->karyawan->nama . ' telah ditambahkan.')
            ->line('Jabatan: ' . $this->karyawan->jabatan)
            ->line('Silakan pastikan data karyawan sudah lengkap.');
    }
}
