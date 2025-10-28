<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Complaint;

class ComplaintResponseReverted extends Notification
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
            'type' => 'complaint_response_reverted',
            'message' => 'Tenant has reverted their response for complaint: ' . $this->complaint->subject,
            'url' => route('dashboard.landlord.complaints.show', $this->complaint->id),
            'created_at' => now(),
        ];
    }
}
