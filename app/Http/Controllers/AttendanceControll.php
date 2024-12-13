<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\MyClass;
use App\Models\StudentRecord;
use App\Models\Subject;
use Illuminate\Http\Request;

class AttendanceControll extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    private function sdfs($lat1, $lon1, $lat2, $lon2)
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
    public function index()
    {
        $student_id = auth()->user()->id;
        $student = StudentRecord::where('user_id', $student_id)->first();
        $subject = Subject::with('teacher')->where('my_class_id', $student->my_class_id)->get();
        $teachers = $subject->map(function ($item) {
            return $item->teacher;
        });

        // dd($teachers);
        $d = [];
        $d['subjects'] = $subject;
        $d['student'] = $student;

        // dd($d);
        return view('pages.student.subject', $d);
    }

    public function accessSubject($subject_id)
    {
        $student_id = auth()->user()->id;
        $student = StudentRecord::where('user_id', $student_id)->first();
        $subject = Subject::where('slug', $subject_id)->first();
        $teacher = $subject->teacher;
        $d = [];
        $d['subject'] = $subject;
        $d['subjects'] = Subject::where('my_class_id', $student->my_class_id)->get();
        $d['student'] = $student;
        $d['teacher'] = $teacher;
        // dd($d);

        return view('pages.student.detailSubject', $d);
    }

    public function subjects()
    {
        $teacher = auth()->user();

        if ($teacher->user_type !== 'teacher') {
            return redirect()->back()->with('error', 'Hanya guru yang dapat membuka presensi.');
        }

        // $classes = MyClass::where('teacher_id', $teacher->id)->get();
        $subjects = Subject::where('teacher_id', $teacher->id)->first();
        dd($subjects);

        return view('pages.teacher.subjects');
    }
    public function openAttendanceView($subject_id)
    {

        $teacher = auth()->user();

        if ($teacher->user_type !== 'teacher') {
            return redirect()->back()->with('error', 'Hanya guru yang dapat membuka presensi.');
        }
    }
    public function openAttendance($subject_id)
    {
        $teacher = auth()->user();

        // Pastikan user adalah guru
        if ($teacher->role !== 'teacher') {
            return redirect()->back()->with('error', 'Hanya guru yang dapat membuka presensi.');
        }

        // Cari mata pelajaran yang diajarkan oleh guru
        $subject = Subject::where('id', $subject_id)->where('teacher_id', $teacher->id)->first();

        if (!$subject) {
            return redirect()->back()->with('error', 'Mata pelajaran tidak ditemukan atau Anda bukan pengajar mata pelajaran ini.');
        }

        // Cek apakah presensi sudah ada untuk hari ini
        $attendance = Attendance::firstOrCreate([
            'subject_id' => $subject_id,
            'date' => now()->toDateString(),
        ], [
            'is_open' => true, // Membuka presensi
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil dibuka untuk mata pelajaran ' . $subject->name);
    }

    public function mark(Request $request)
    {
        $student_id = auth()->user()->id;
        $student = StudentRecord::where('user_id', $student_id)->first();
        $subject_id = $request->subject_id;
        $attend = $request->attend;
        $this->validate($request, [
            'subject_id' => 'required',
            'attend' => 'required',
        ]);
        $data = [
            'student_id' => $student_id,
            'subject_id' => $subject_id,
            'attend' => $attend,
        ];
        Attendance::create($data);
        return back()->with('flash_success', __('msg.attend_ok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
