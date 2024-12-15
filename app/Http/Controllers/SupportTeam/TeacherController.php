<?php

namespace App\Http\Controllers\SupportTeam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Section;
use App\Models\StudentRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function showSchedule()
    {
        // Ambil ID guru yang sedang login
        $teacher_id = Auth::id();

        // Ambil data subject berdasarkan teacher_id
        $subjects = Subject::where('teacher_id', $teacher_id)->get();

        // Mengirimkan data ke view untuk menampilkan jadwal
        return view('teacher.pages.siswa.index', compact('subjects'));
    }
    
    public function showStudentRecords($teacher_id)
    {
        // Ambil semua sections yang diampu oleh teacher_id
        $sections = Section::where('teacher_id', $teacher_id)->get();
    
        $students = [];
        foreach ($sections as $section) {
            // Ambil semua siswa berdasarkan my_class_id dari section
            $students = array_merge($students, StudentRecord::where('my_class_id', $section->my_class_id)->get()->toArray());
        }
    
        // Menampilkan data siswa pada view tertentu
        return view('teacher.pages.siswa.show', compact('students'));
    }
}
