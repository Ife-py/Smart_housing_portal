<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Complaint;

class ComplaintResolutionReverted extends Notification
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
            'type' => 'complaint_resolution_reverted',
            'message' => 'Landlord has reverted the resolution for complaint: ' . $this->complaint->subject,
            'url' => route('dashboard.tenant.complaints.show', $this->complaint->id),
            'created_at' => now(),
        ];
    }
}
