<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\MyClass;
use App\Models\StudentRecord;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Menampilkan daftar tugas untuk guru
    public function index()
    {
        $teacher_id = Auth::id();

        // Ambil data subject berdasarkan teacher_id
        $subjects = Subject::where('teacher_id', $teacher_id)->get();

        $isTeacher = auth()->user()->user_type;
        if ($isTeacher !== 'teacher') {
            return redirect()->route('dashboard');
        }
        $assignments = Assignment::where('teacher_id', auth()->user()->id)->get();
        $data = [
            'assignments' => $assignments,
            'subjects' => $subjects,
        ];
        return view('teacher.pages.tugas.index', $data);
    }

    public function create($subject_id)
    {
        // Ambil data kelas yang terkait dengan guru yang sedang login
        $classes = MyClass::whereHas('subjects', function ($query) {
            $query->where('teacher_id', auth()->user()->id);
        })->get();
    
        return view('teacher.pages.tugas.create', [
        // return view('pages.teacher.assignment_create', [
            'classes' => $classes,
            'subject_id' => $subject_id,
        ]);
    }    
    public function getSubjectsByClass(Request $request)
    {
        $classId = $request->class_id;

        if (!$classId) {
            return response()->json(['error' => 'ID kelas tidak valid.'], 400);
        }

        $subjects = Subject::whereHas('my_class', function ($query) use ($classId) {
            $query->where('id', $classId);
        })->where('teacher_id', auth()->user()->id)->get();

        return response()->json($subjects);
    }

    // Menyimpan tugas baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'class_id' => 'required|exists:my_classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);


        $validated['teacher_id'] = auth()->id();

        Assignment::create($validated);

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil dibuat!');
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id)->where('teacher_id', auth()->user()->id)->first();
        $classes = MyClass::whereHas('subjects', function ($query) {
            $query->where('teacher_id', auth()->user()->id);
        })->get();
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();

        $data = [
            'assignment' => $assignment,
            'classes' => $classes,
            'subjects' => $subjects
        ];
        return view('pages.teacher.assignment_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'class_id' => 'required|exists:my_classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $assignment = Assignment::findOrFail($id);

        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('pages.teacher.assignment_show', compact('assignment'));
    }

    public function submissions($assignmentId)
    {
        // Ambil data assignment dan submission yang terkait dengan assignment tersebut
        $assignment = Assignment::findOrFail($assignmentId);

        // Ambil data submission yang sudah dikumpulkan
        $submissions = DB::table('assignment_submissions')
            ->where('assignment_id', $assignmentId)
            ->join('student_records', 'assignment_submissions.student_id', '=', 'student_records.id')
            ->get();

        // Ambil data submission yang sudah dikumpulkan
        $submissions = AssignmentSubmission::with('student')->where('assignment_id', $assignmentId)->get();

        return view('pages.teacher.assignment_submissions', [
            'assignment' => $assignment,
            'submissions' => $submissions,
        ]);
    }
    public function openAssignmentView($subject_id)
    {
        $teacher = auth()->user();
        $student_id = auth()->user()->id;

        $student = StudentRecord::where('user_id', $student_id)->first();

        if(!$teacher){
            return redirect()->route('login');
        }
        
        if ($teacher->user_type !== 'teacher') {
            return redirect()->back()->with('error', 'Hanya guru yang dapat membuka presensi.');
        }
        
        $subject = Subject::where('id', $subject_id)->where('teacher_id', $teacher->id)->first();
        
        $attendance = DB::table('attendances')
            ->where('subject_id', $subject->id)
            ->where('date', now()->toDateString())
            ->where('is_open', true)
            ->first();

        $history = \App\Models\StudentAttendance::orderBy('created_at', 'desc')->get();

        if (!$subject) {
            return redirect()->back()->with('error', 'Mata pelajaran tidak ditemukan atau Anda bukan pengajarnya.');
        }
        $students = DB::table('users')
            ->select('absen', 'name', 'username', 'gender')
            ->where('user_type', 'student')
            ->where('my_class_id', $subject->id) 
            ->get();

        $assignments = DB::table('assignments')
            ->where('teacher_id', $teacher->id)
            ->where('subject_id', $subject->id)
            ->get();
   
           $totalMale = $students->where('gender', 'L')->count();
           $totalFemale = $students->where('gender', 'P')->count();

        $data = [
            'subject' => $subject,
            'attendance' => $attendance,
            'history' => $history,
            'students' => $students,
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
            'assignments' => $assignments,
        ];
        return view('teacher.pages.tugas.show', $data);
    }
    
    public function assignmentShow($assignment_id)
    {
        // Ambil data assignment berdasarkan ID
        $assignment = Assignment::with('submissions')->findOrFail($assignment_id);

        // Periksa apakah user sudah mengirim submission
        $submission = $assignment->submissions->where('student_id', auth()->id())->first();
        $isSubmitted = $submission !== null;
        $isEditing = $isSubmitted;

        // Siapkan data untuk dikirim ke view
        $data = [
            'assignment' => $assignment,
            'submission' => $submission,
            'isSubmitted' => $isSubmitted,
            'isEditing' => $isEditing,
        ];

        // Tampilkan view assignment show
        return view('teacher.pages.tugas.show', $data);
        // return view('pages.teacher.assignment_submissions', $data);
    }
}
