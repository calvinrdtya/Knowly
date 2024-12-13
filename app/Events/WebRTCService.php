<?php

namespace App\Services;

use App\Events\WebRTCSignaling;
use App\Models\Meeting;

class WebRTCService
{
    public function handleSignaling($type, $data, $meetingId)
    {
        // Broadcast signaling data for WebRTC peer connections
        event(new WebRTCSignaling($type, $data, $meetingId));
    }

    public function generateSummary($meetingId, $notes)
    {
        $meeting = Meeting::findOrFail($meetingId);

        // More sophisticated summarization using AI 
        $summary = $this->summarizeWithAI($notes);

        $meeting->update([
            'meeting_notes' => $notes,
            'summary' => $summary
        ]);

        return $summary;
    }

    private function summarizeWithAI($text)
    {
        // Implement OpenAI or other AI summarization service
        // This is a placeholder implementation
        $sentences = preg_split('/[.!?]/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $keyPoints = array_slice($sentences, 0, 3);
        
        return implode('. ', $keyPoints) . '.';
    }
}
