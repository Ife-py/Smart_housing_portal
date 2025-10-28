<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Complaint;

class ComplaintResolved extends Notification
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
            'type' => 'complaint_resolved',
            'message' => 'Your complaint has been marked as resolved by the landlord',
            'subject' => $this->complaint->subject,
            'url' => route('dashboard.tenant.complaints.show', $this->complaint->id),
            'created_at' => now(),
        ];
    }
}
