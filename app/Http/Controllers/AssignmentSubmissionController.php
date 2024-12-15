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

    $student = StudentRecord::where('user_id', auth()->id())->firstOrFail();
    $validated = $request->validate([
        'notes' => 'required|string',
        'file' => 'nullable|file|max:2048|mimes:pdf,docx,txt', 
    ], [
        'file.max' => 'File tidak boleh lebih dari 2MB.',
        'file.mimes' => 'Format file harus PDF, DOCX, atau TXT.',
        'notes.required' => 'Catatan harus diisi.',
    ]);

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $nama = $file->getClientOriginalName();
        $path = $file->storeAs('submissions', $nama);
        $filePath = 'storage/' . $path;
    } else {
        $filePath = null;
    }


    AssignmentSubmission::create([
        'assignment_id' => $assignmentId,
        'student_id' => $student->user_id,
        'notes' => $validated['notes'],
        'file_path' => $filePath,
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
        
        if ($submission->student_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit tugas ini.');
        }

        $path = $request->file('file') ? $request->file('file')->store('submissions', 'public') : null;
        dd($path);

        $submission->update([
            'notes' => $request->notes,
            'file_path' => $path
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
