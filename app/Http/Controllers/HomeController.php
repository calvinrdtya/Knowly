<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;

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

        // Ambil my_class_id pengguna yang login
        $myClassId = auth()->user()->my_class_id;

        // Ambil data assignments yang memiliki class_id sama dengan pengguna yang login
        $assignments = Assignment::where('class_id', $myClassId)->get();
        // dd($myClassId);


        switch ($userType) {
            case 'super_admin':
                return view('back.dashboard');
            case 'admin':
                return view('back.dashboard');
            case 'teacher':
                return view('teacher.teacher');
            case 'student':
                return view('student.student', ['assignments' => $assignments]);
            case 'accountant':
                return view('back.dashboard');
            default:
                return redirect()->route('login')->with('danger', 'Tipe pengguna tidak dikenali.');
        }
    }




    // public function dashboard()
    // {
    //     $d=[];
    //     if(Qs::userIsTeamSAT()){
    //         $d['users'] = $this->user->getAll();
    //     }

    //     return view('pages.support_team.dashboard', $d);
    //     // return view('back.dashboard', $d);
    // }
}
