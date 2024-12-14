<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\MyClass;
use App\Models\StudentAttendance;
use App\Models\StudentRecord;
use App\Models\Subject;
use Geotools\Coordinate\Coordinate;
use Geotools\Distance\Distance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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

        $latitude = $request->latitude; // Koordinat lokasi guru
        $longitude = $request->longitude;

        // dd($request->all());

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

        $history = StudentAttendance::where('student_id', $student_id)->where('subject_id', $subject_id)->get();



        if (!$attendance->is_online) {
            // Mode offline: Periksa jarak
            $distance = $this->calculateDistance(
                $attendance->latitude,
                $attendance->longitude,
                $request->latitude,
                $request->longitude
            );

            // dd($attendance->latitude,$attendance->longitude,$request->latitude,$request->longitude,$distance);
            if ($distance > 50) {
                return back()->with('error', 'Anda berada di luar jangkauan lokasi presensi.');
            }
        }


        $historyExists = $history->isNotEmpty();

        if ($historyExists) {
            return redirect()->route('attendance.mark.view', $subject_id)->with('error', 'Anda sudah melakukan presensi pada hari ini.');
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

    private function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        // Radius Bumi dalam kilometer
        $earthRadius = 6371;
    
        // Konversi derajat ke radian
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);
    
        // Rumus Haversine
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
    
        $a = sin($dlat / 2) * sin($dlat / 2) +
             cos($lat1) * cos($lat2) *
             sin($dlon / 2) * sin($dlon / 2);
    
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        // Hitung jarak
        $distance = $earthRadius * $c;
    
        return $distance; // Jarak dalam kilometer
    }
    

    public function openAttendanceView($subject_id)
    {

        $teacher = auth()->user();

        if (!$teacher) {
            return redirect()->route('login');
        }

        if ($teacher->user_type !== 'teacher') {
            return redirect()->back()->with('error', 'Hanya guru yang dapat membuka presensi.');
        }

        $subject = Subject::where('slug', $subject_id)->where('teacher_id', $teacher->id)->first();

        if (!$subject) {
            return redirect()->back()->with('error', 'Mata pelajaran tidak ditemukan atau Anda bukan pengajarnya.');
        }

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

        // if (!$student || !$subject) {
        //     return redirect()->back()->with('error', 'Data siswa atau mata pelajaran tidak ditemukan.');
        // }

        // dd($subject, $student);

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
