<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\MyClass;
use App\Models\StudentRecord;
use App\Models\Subject;
use App\User;
use DB;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Menampilkan daftar tugas untuk guru
    public function index()
    {
        $isTeacher = auth()->user()->user_type;
        if($isTeacher!=='teacher') {
            return redirect()->route('dashboard');
        }
        $assignments = Assignment::where('teacher_id', auth()->user()->id)->get();
        $data = [
            'assignments' => $assignments
        ];
        return view('pages.teacher.assignment', $data);
    }

    // Menampilkan form membuat tugas
    public function create()
    {
        // Ambil data kelas yang terkait dengan guru yang sedang login
        $classes = MyClass::whereHas('subjects', function ($query) {
            $query->where('teacher_id', auth()->user()->id);
        })->get();

        // Kirim data kelas ke view
        return view('pages.teacher.assignment_create', compact('classes'));
    }

    /**
     * Ambil data mata pelajaran berdasarkan kelas yang dipilih.
     */
    public function getSubjectsByClass(Request $request)
    {
        $classId = $request->class_id;

        // Validasi input
        if (!$classId) {
            return response()->json(['error' => 'ID kelas tidak valid.'], 400);
        }

        // Ambil data mata pelajaran yang sesuai dengan kelas yang dipilih
        $subjects = Subject::whereHas('my_class', function ($query) use ($classId) {
            $query->where('id', $classId);
        })->where('teacher_id', auth()->user()->id)->get();

        // Kembalikan data dalam format JSON
        return response()->json($subjects);
    }




    // Menyimpan tugas baru
    public function store(Request $request)
    {
        // dd($request->all());
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
        // dd($assignment);
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



    return view('pages.teacher.assignment_submissions', [
        'assignment' => $assignment,
        'submissions' => $submissions,
    ]);
}

}
