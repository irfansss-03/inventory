<?php

namespace App;

use App\Models\Barang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CriticalStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Barang $barang)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Peringatan Stok Barang Kritis')
            ->line('Stok barang "' . $this->barang->nama . '" menurun hingga ' . $this->barang->stok . ' unit.')
            ->line('Kategori: ' . $this->barang->kategori)
            ->line('Segera lakukan pengecekan atau restock.');
    }
}
