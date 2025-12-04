<?php

namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActivityLogClearedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $range, public int $count)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Log Aktivitas Dihapus')
            ->line('Log aktivitas telah dihapus untuk rentang: ' . $this->range)
            ->line('Total entri yang dihapus: ' . $this->count)
            ->line('Tindakan ini tercatat agar audit tetap terjaga.');
    }
}
