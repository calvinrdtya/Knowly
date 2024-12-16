<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use App\Models\Subject;

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

        $assignments = Assignment::where('class_id', $myClassId)->get();

        $subjects = Subject::where('teacher_id', $userId)->get();

        switch ($userType) {
            case 'super_admin':
                return view('back.dashboard');
            case 'admin':
                return view('back.dashboard');
            case 'teacher':
                return view('teacher.teacher', ['assignments' => $assignments, 'subjects' => $subjects]);
            case 'student':
                return view('student.student', ['assignments' => $assignments]);
            case 'accountant':
                return view('back.dashboard');
            default:
                return redirect()->route('login')->with('danger', 'Tipe pengguna tidak dikenali.');
        }
    }

    public function kalender()
    {
        return view('kalender');
    }
}