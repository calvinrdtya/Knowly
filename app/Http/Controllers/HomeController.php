<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Auth;

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
        // Ambil tipe user yang sedang login
        $userType = auth()->user()->user_type;

        // Cek tipe user dan arahkan ke dashboard yang sesuai
        switch ($userType) {
            case 'super_admin':
                return view('back.dashboard');
                // return view('pages.support_team.dashboard', $d);
            case 'admin':
                return view('back.dashboard');
                // return view('pages.support_team.dashboard', $d);
            case 'teacher':
                return view('teacher.teacher');
                // return view('pages.support_team.dashboard');
            case 'student':
                return view('student.student');
                // return view('pages.support_team.dashboard', $d);
            case 'accountant':
                return view('back.dashboard');
                // return view('pages.support_team.dashboard', $d);
            default:
                // Redirect ke halaman error jika tipe user tidak valid
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
