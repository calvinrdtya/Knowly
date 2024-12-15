<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\StudentRecord;
use Illuminate\Http\Request;

class AssignmentSubmissionController extends Controller
{
    // Menampilkan daftar tugas siswa
    public function index()
    {
        $isStudent = auth()->user()->user_type;
        if ($isStudent !== 'student') {
            return redirect()->route('dashboard');
        }

        $student = StudentRecord::where('user_id', auth()->user()->id)->firstOrFail();
        
        $assignments = Assignment::where('class_id', $student->my_class_id)
            ->with(['submissions' => function ($query) {
                $query->where('student_id', auth()->id());
            }])
            ->get();


        $data = [
            'assignments' => $assignments
        ];

        return view('pages.student.assignment', $data);
    }

    // Menampilkan detail tugas
    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        $isSubmitted = $assignment->submissions->where('student_id', auth()->id())->first() !== null;
        $submission = $assignment->submissions->where('student_id', auth()->id())->first();$isEditing =  $assignment->submissions->where('student_id', auth()->id())->first() !== null;

        $data = [
            'assignment' => $assignment,
            'submission' => $submission,
            'isSubmitted' => $isSubmitted,
            'isEditing' => $isEditing
        ];
        return view('pages.student.assignment_show', $data);
    }

    // Menyimpan pengumpulan tugas
    public function submit(Request $request, $assignmentId)
{
    $validated = $request->validate([
        'notes' => 'required|string',
        'file' => 'nullable|file|max:2048', // Maksimal 2MB
    ]);

    $filePath = $request->file('file') ? $request->file('file')->store('submissions', 'public') : null;

    AssignmentSubmission::create([
        'assignment_id' => $assignmentId,
        'student_id' => auth()->id(),
        'notes' => $validated['notes'],
        'file' => $filePath,
    ]);

    return redirect()->route('student.assignments.show', $assignmentId)->with('success', 'Tugas berhasil dikumpulkan.');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,docx,txt|max:2048',
        ]);


        $submission = AssignmentSubmission::where('id', $id)->where('student_id', auth()->id())->firstOrFail();
                
        $submission->update([
            'notes' => $request->notes,
            'file_path' => $request->file ? $request->file->store('submissions') : $submission->file_path,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil diperbarui.');
    }

    public function edit($submissionId)
{
    $submission = AssignmentSubmission::findOrFail($submissionId);
    $assignment = $submission->assignment;

    if ($submission->student_id !== auth()->id()) {
        abort(403, 'Anda tidak memiliki izin untuk mengedit tugas ini.');
    }

    return view('assignments.show', [
        'assignment' => $assignment,
        'submission' => $submission,
        'isSubmitted' => true,
        'isEditing' => true,
    ]);
}

}
