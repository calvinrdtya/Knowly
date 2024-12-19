<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Models\Jadwal;
use App\Models\MyClass;
use App\Models\StudentRecord;
use App\Models\Subject;
use App\User;
use DB;
use Illuminate\Http\Request;

class JadwalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (auth()->user()->user_type !== 'super_admin') {
            return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
        }
        $classes = MyClass::all();
        $data = [
            'classes' => $classes,
        ];
        // return view('pages.admin.jadwal.index', $data);
        return view('back.pages.jadwal.index', $data);
    }

    public function create()
    {
        if (auth()->user()->user_type !== 'super_admin') {
            return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
        }

        $classes = MyClass::all();
        $subjects = Subject::all();
        $teachers = User::where('user_type', 'teacher')->get();
        $day = Qs::getDaysOfTheWeek();

        $data = [
            'classes' => $classes,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'days' => $day
        ];
        return view('back.pages.jadwal.index', $data);
    }

    public function store(Request $request)
    {
        if (auth()->user()->user_type !== 'super_admin') {
            return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
        }
        $request->validate([
            'class_id' => 'required|exists:my_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'day' => 'required',
            'room' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $jadwal = Jadwal::create([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'hari' => $request->day,
            'jam_mulai' => $request->start_time,
            'jam_selesai' => $request->end_time,
            'room' => $request->room
        ]);

        return redirect()->route('jadwal.show')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // public function destroy(Jadwal $jadwal)
    // {
    //     if (auth()->user()->user_type !== 'super_admin') {
    //         return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
    //     }
    //     $jadwal->delete();
    //     return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    // }

    // public function edit($id)
    // {
    //     if (auth()->user()->user_type !== 'super_admin') {
    //         return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
    //     }
    //     $jadwal = Jadwal::findOrFail($id)->with('class', 'subject', 'teacher')->first();
    //     $class = $jadwal->class;
    //     if (!$class || !$jadwal) {
    //         return redirect()->route('jadwal.index')->with('error', 'Jadwal tidak ditemukan.');
    //     }


    //     $data = [
    //         'schedules' => $jadwal,
    //         'class' => $class,
    //     ];
    //     return view('pages.admin.jadwal.edit', $data);
    // }

    // public function update(Request $request, Jadwal $jadwal)
    // {
    //     if (auth()->user()->user_type !== 'super_admin') {
    //         return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
    //     }
    //     $request->validate([
    //         'class_id' => 'required',
    //         'subject_id' => 'required',
    //         'day' => 'required',
    //         'start_time' => 'required',
    //         'end_time' => 'required',
    //         'room' => 'required',
    //     ]);

    //     $jadwal->update([
    //         'class_id' => $request->class_id,
    //         'subject_id' => $request->subject_id,
    //         'hari' => $request->day,
    //         'jam_mulai' => $request->start_time,
    //         'jam_selesai' => $request->end_time,
    //         'room' => $request->room
    //     ]);

    //     return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    // }
    public function show($id)
    {
        if (auth()->user()->user_type !== 'super_admin') {
            return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
        }

        if (!$id) {
            return redirect()->route('jadwal.index')->with('error', 'Data tidak ditemukan.');
        }
        $jadwal = Jadwal::where('class_id', $id)->with('subject', 'teacher')->get();

        $kelas = MyClass::findOrFail($id);

        $teachers = User::where('user_type', 'teacher')->get();
        $day = Qs::getDaysOfTheWeek();
        $subject = Subject::findOrFail($id);

        $data = [
            'schedules' => $jadwal,
            'subject' => $subject,
            'teachers' => $teachers,
            'days' => $day,
            'kelas' => $kelas,
        ];
        return view('back.pages.jadwal.show', $data);
    }

    public function getSubjectsByClass($classId)
    {
        $subjects = DB::table('subjects')
            ->where('my_class_id', $classId)
            ->select('id', 'name')
            ->get();

        return response()->json($subjects);
    }

    public function getTeachersBySubject($subjectId)
    {
        $teacher = DB::table('subjects')
            ->join('users', 'subjects.teacher_id', '=', 'users.id')
            ->where('subjects.id', $subjectId)
            ->select('users.id', 'users.name')
            ->first();

        return response()->json($teacher);
    }

    public function studentSchedules()
    {
        if (auth()->user()->user_type !== 'student') {
            return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
        }

        $user = auth()->user();

        // Ambil my_class_id milik student
        $myClassId = $user->my_class_id;

        // Ambil jadwal berdasarkan class_id yang cocok dengan my_class_id dari subjects
        $jadwal = Jadwal::whereHas('subject', function ($query) use ($myClassId) {
                            $query->where('my_class_id', $myClassId);
                        })
                        ->with('subject', 'class')
                        ->get();

        // Periksa jika jadwal kosong
        if ($jadwal->isEmpty()) {
            return redirect()->route('jadwal.index')->with('error', 'Data tidak ditemukan.');
        }

        // Mendapatkan kelas pertama dari jadwal jika ada data
        $class = $jadwal->first()->class;

        // Jika kelas tidak ditemukan
        if (!$class) {
            return redirect()->route('jadwal.index')->with('error', 'Data kelas tidak ditemukan.');
        }

        // Mengelompokkan jadwal berdasarkan hari
        $schedules = $jadwal->groupBy('hari');

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'schedules' => $schedules,
            'class' => $class,
        ];

        // Mengembalikan view jadwal siswa
        return view('pages.student.jadwal', $data);
    }

    public function teacherSchedules()
    {
        if (auth()->user()->user_type !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Ups kamu tidak dapat mengakses halaman ini.');
        }

        $user = auth()->user();

        $jadwal = Jadwal::where('teacher_id', $user->id)
                        ->with('subject', 'class')
                        ->get();

        // Periksa jika jadwal kosong
        if ($jadwal->isEmpty()) {
            return redirect()->route('jadwal.index')->with('error', 'Data tidak ditemukan.');
        }

        // Mendapatkan kelas pertama dari jadwal jika ada data
        $class = $jadwal->first()->class; // Ini akan mengambil objek kelas terkait

        // Jika tidak ada kelas atau jadwal, redirect kembali dengan error
        if (!$class) {
            return redirect()->route('jadwal.index')->with('error', 'Data kelas tidak ditemukan.');
        }

        // Mengelompokkan jadwal berdasarkan hari
        $schedules = $jadwal->groupBy('hari');

        // Menyiapkan data untuk dikirim ke view
        $data = [
            'schedules' => $schedules,
            'class' => $class, // Mengirimkan data kelas
        ];

        return view('pages.teacher.jadwal', $data);
    }
}