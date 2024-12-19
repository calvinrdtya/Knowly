<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $user;
    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('home');
        }
    }
    public function privacy_policy()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');

        return view('pages.other.privacy_policy', $data);
    }
    public function terms_of_use()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.terms_of_use', $data);
    }


public function dashboard()
    {
        $userType = auth()->user()->user_type;
        $myClassId = auth()->user()->my_class_id;
        $userId = auth()->user()->id;

        // Query untuk tugas dan mata pelajaran
        $assignments = Assignment::where('class_id', $myClassId)->get();
        $jumlahTugas = Assignment::where('class_id', $myClassId)->count();
        $subjects = Subject::where('teacher_id', $userId)->get();

        // Hitung total student dan teacher dari tabel users
        $totalStudents = DB::table('users')->where('user_type', 'student')->count();
        $totalTeachers = DB::table('users')->where('user_type', 'teacher')->count();

        switch ($userType) {
            case 'super_admin':
                return view('back.dashboard', [
                    'totalStudents' => $totalStudents,
                    'totalTeachers' => $totalTeachers,
                ]);
            case 'admin':
                return view('back.dashboard', [
                    'totalStudents' => $totalStudents,
                    'totalTeachers' => $totalTeachers
                ]);
            case 'teacher':
                return view('teacher.teacher', [
                    'assignments' => $assignments,
                    'subjects' => $subjects,
                    'jumlahTugas' => $jumlahTugas,
                    'totalStudents' => $totalStudents,
                    'totalTeachers' => $totalTeachers
                ]);
            case 'student':
                return view('student.student', [
                    'assignments' => $assignments,
                    'jumlahTugas' => $jumlahTugas,
                    'totalStudents' => $totalStudents,
                    'totalTeachers' => $totalTeachers
                ]);
            case 'accountant':
                return view('back.dashboard', [
                    'totalStudents' => $totalStudents,
                    'totalTeachers' => $totalTeachers
                ]);
            default:
                return redirect()->route('login')->with('danger', 'Tipe pengguna tidak dikenali.');
        }
    }

    public function kalender()
    {
        $userType = Auth::user()->user_type;

        if ($userType === 'super_admin') {
            return view('back.kalender');
        } elseif ($userType === 'student') {
            return view('student.kalender');
        } elseif ($userType === 'teacher') {
            return view('teacher.kalender');
        } else {
            abort(403, 'Akses Tidak Diberikan');
        }
    }
}