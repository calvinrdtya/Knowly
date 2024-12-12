<?php

namespace App\Http\Controllers;

use App\Events\MeetingEnded;
use App\Events\MeetingStarted;
use App\Events\MeetingSummaryGenerated;
use App\Events\UserJoinedMeeting;
use App\Events\UserLeftMeeting;
use Illuminate\Http\Request;
use App\Models\Meeting;
use Illuminate\Support\Str;
use App\Events\WebRTCSignaling;
use App\Services\WebRTCService;
use App\User;

class MeetingController extends Controller
{

    public function index($host)
    {
        $teacher = User::where('code', $host)->first();

        if (!$teacher) {
            abort(404, 'Host not found');
        }

        $data = [
            'host' => $teacher->name,
            'code' => $teacher->code
        ];

        return view('pages.teacher.meeting', $data);
    }
    public function start($id)
    {
        // Cari meeting berdasarkan ID
        dd($id);
        $meeting = Meeting::findOrFail($id);
        $data = [
            'meeting' => $meeting
        ];

        // Kirim data meeting ke view
        return view('pages.teacher.start', $data);
    }


    public function startMeeting(Request $request)
    {
        $validated = $request->validate([
            'host' => 'required|string|max:255', // Nama guru/siswa
            'subject' => 'required|string|max:255', // Mata pelajaran
        ]);

        // Generate link unik untuk meeting
        $link = url('meeting/start'  . '/' . uniqid());

        $meeting = Meeting::create([
            'host' => $validated['host'],
            'subject' => $validated['subject'],
            'link' => $link,
        ]);

        // Trigger event
        event(new MeetingStarted($meeting->id, $validated['host'], $validated['subject']));

        return response()->json([
            'message' => 'Meeting started successfully!',
            'meeting_id' => $meeting->id,
            'link' => $link,
        ]);
    }

    public function generateSummary(Request $request)
{
    $validated = $request->validate([
        'meeting_id' => 'required|exists:meetings,id',
        'notes' => 'required|string',
    ]);

    $webRTCService = new WebRTCService();
    $summary = $webRTCService->generateSummary(
        $validated['meeting_id'], 
        $validated['notes']
    );

    return response()->json([
        'message' => 'Summary generated successfully!',
        'summary' => $summary,
    ]);
}
    public function signal(Request $request)
    {
        broadcast(new WebRTCSignaling($request->type, $request->data));
        return response()->json(['success' => true]);
    }

    private function summarizeText($text)
    {
        // Placeholder untuk meringkas teks
        return substr($text, 0, 100) . '...'; // Batasi hanya 100 karakter
    }

    public function joinMeeting(Request $request, $meetingId)
    {
        $user = auth()->user();
        $meeting = Meeting::findOrFail($meetingId);

        // Masukkan pengguna ke dalam meeting
        $meeting->users()->attach($user);

        // Pancar event
        event(new UserJoinedMeeting($user->toArray(), $meetingId));

        return response()->json(['message' => 'Joined meeting']);
    }
    public function leaveMeeting(Request $request, $meetingId)
    {
        $user = auth()->user();
        $meeting = Meeting::findOrFail($meetingId);

        // Hapus pengguna dari meeting
        $meeting->users()->detach($user);

        // Pancar event
        event(new UserLeftMeeting($user->toArray(), $meetingId));

        return response()->json(['message' => 'Left meeting']);
    }

    public function endMeeting($meetingId)
{
    $meeting = Meeting::findOrFail($meetingId);

    // Broadcast bahwa meeting berakhir
    event(new MeetingEnded($meetingId));

    return response()->json(['message' => 'Meeting ended successfully']);
}

}
