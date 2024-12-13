<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\MyClass;
use App\Models\StudentAttendance;
use App\Models\StudentRecord;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function openAttendance($subject_id, Request $request)
    {
        $teacher = auth()->user();


        if ($teacher->user_type !== 'teacher') {
            return redirect()->back()->with('error', 'Hanya guru yang dapat membuka presensi.');
        }

        
        $subject = Subject::where('id', $subject_id)->where('teacher_id', $teacher->id)->first();
        if (!$subject) {
            return redirect()->back()->with('error', 'Mata pelajaran tidak ditemukan.');
        }
        // dd($subject);

        $latitude = $request->latitude; // Koordinat lokasi guru
        $longitude = $request->longitude;

        // dd($subject);
        
        $attendance = Attendance::updateOrCreate(
            [
                'subject_id' => $subject_id,
                'date' => now()->toDateString(),
                'class_id' => $subject->my_class_id
            ],
            [
                'is_open' => true,
                'is_online' => $request->is_online, // Dari form: Online atau offline
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]
        );

        return redirect()->back()->with('success', 'Presensi berhasil dibuka.');
    }

    public function markAttendance(Request $request)
    {
        $student_id = auth()->user()->id;
        $subject_id = $request->subject_id;

        $attendance = Attendance::where('subject_id', $subject_id)
        ->where('date', now()->toDateString())
        ->where('is_open', true)
        ->first();
        
        
        if (!$attendance) {
            return back()->with('error', 'Presensi belum dibuka.');
        }
        
        // dd($student_id, $subject_id, $attendance);
        
        if (!$attendance->is_online) {
            // Mode offline: Periksa jarak
            $distance = $this->calculateDistance(
                $attendance->latitude,
                $attendance->longitude,
                $request->latitude,
                $request->longitude
            );

            if ($distance > 20) {
                return back()->with('error', 'Anda berada di luar jangkauan lokasi presensi.');
            }
        }

        // $time = now()->toTimeString();
        StudentAttendance::create([
            'student_id' => $student_id,
            'class_id' => $attendance->class_id,
            'subject_id' => $subject_id,
            'date' => now()->toDateString(),
            'is_online' => $attendance->is_online,
        ]);

        return back()->with('success', 'Presensi berhasil.');
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371 * 1000; // Radius bumi dalam meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Hasil dalam meter
    }

    public function openAttendanceView($subject_id)
    {

        $teacher = auth()->user();

        if(!$teacher){
            return redirect()->route('login');
        }
        
        if ($teacher->user_type !== 'teacher') {
            return redirect()->back()->with('error', 'Hanya guru yang dapat membuka presensi.');
        }
        
        $subject = Subject::where('slug', $subject_id)->where('teacher_id', $teacher->id)->first();
        
        $attendance = DB::table('attendances')
            ->where('subject_id', $subject->id)
            ->where('date', now()->toDateString())
            ->where('is_open', true)
            ->first();
        

        if (!$subject) {
            return redirect()->back()->with('error', 'Mata pelajaran tidak ditemukan atau Anda bukan pengajarnya.');
        }

        $data = [
            'subject' => $subject,
            'attendance' => $attendance,
        ];

        return view('pages.teacher.openAttendance', $data);
    }
    public function closeAttendance($attendance_id)
    {
        $attendance = Attendance::findOrFail($attendance_id);

        
        if (auth()->user()->user_type !== 'teacher' || $attendance->subject->teacher_id !== auth()->user()->id) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menutup presensi ini.');
        }
        
        $attendance->is_open = false;
        $attendance->save();

        return back()->with('success', 'Presensi berhasil ditutup.');
    }

    /**
     * Tampilan untuk siswa melakukan presensi.
     */
    public function markAttendanceView($subject_id)
    {
        $student_id = auth()->user()->id;
        $student = StudentRecord::where('user_id', $student_id)->first();
        $subject = Subject::where('slug', $subject_id)->first();
        
        if (!$student || !$subject) {
            return redirect()->back()->with('error', 'Data siswa atau mata pelajaran tidak ditemukan.');
        }
        
        $attendance = DB::table('attendances')->where('subject_id', $subject->id)->where('date', now()->toDateString())->first();
        
        
        $history = StudentAttendance::where('student_id', $student_id)->where('subject_id', $subject->id)->get();
        
        $data = [
            'subject' => $subject,
            'attendance' => $attendance,
            'history' => $history,
        ];

        return view('pages.student.markAttendance', $data);
    }
}
