<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Complaint;

class ComplaintResponded extends Notification
{
    use Queueable;

    private $complaint;
    private $response;

    public function __construct(Complaint $complaint, string $response)
    {
        $this->complaint = $complaint;
        $this->response = $response;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'complaint_id' => $this->complaint->id,
            'type' => 'complaint_responded',
            'response' => $this->response,
            'message' => 'Tenant responded: ' . ucfirst($this->response) . ' for complaint: ' . $this->complaint->subject,
            'url' => route('dashboard.landlord.complaints.show', $this->complaint->id),
            'created_at' => now(),
        ];
    }
}
