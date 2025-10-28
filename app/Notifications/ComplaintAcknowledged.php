<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Complaint;

class ComplaintAcknowledged extends Notification
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
            'type' => 'complaint_acknowledged',
            'message' => 'Tenant has acknowledged the landlord action for complaint: ' . $this->complaint->subject,
            'subject' => $this->complaint->subject,
            'url' => route('dashboard.landlord.complaints.show', $this->complaint->id),
            'created_at' => now(),
        ];
    }
}
