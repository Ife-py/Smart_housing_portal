<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Complaint;

class ComplaintCreated extends Notification
{
    use Queueable;

    private $complaint;

    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'complaint_id' => $this->complaint->id,
            'type' => 'complaint_created',
            'message' => 'A new complaint was filed by ' . optional($this->complaint->tenant)->name,
            'subject' => $this->complaint->subject,
            'url' => route('dashboard.landlord.complaints.show', $this->complaint->id),
            'created_at' => now(),
        ];
    }
}
