<?php

namespace App\Http\Controllers\SupportTeam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Section;
use App\Models\StudentRecord;

class TeacherController extends Controller
{
    public function showSchedule()
    {
        // Ambil teacher_id dari pengguna yang sedang login
        $teacher_id = auth()->id();
        
        // Ambil semua data subjects yang ada di tabel subjects
        // Jika Anda ingin menampilkan semua mata pelajaran yang ada, cukup ambil semua data dari tabel subjects
        $subjects = Subject::all();

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
