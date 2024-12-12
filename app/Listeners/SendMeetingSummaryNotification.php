<?php
namespace App\Listeners;

use App\Events\MeetingSummaryGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMeetingSummaryNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\MeetingSummaryGenerated  $event
     * @return void
     */
    public function handle(MeetingSummaryGenerated $event)
    {
        // Logika untuk menangani event, misalnya mengirim notifikasi
        // atau melakukan hal lain seperti menyimpan log
        \Log::info('Summary generated for meeting: ' . $event->meetingId);
        \Log::info('Summary: ' . $event->summary);
    }
}
