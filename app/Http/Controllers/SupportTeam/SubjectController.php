<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\Subject\SubjectCreate;
use App\Http\Requests\Subject\SubjectUpdate;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Attendance;

class SubjectController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSA', ['except' => ['destroy',]]);
        $this->middleware('super_admin', ['only' => ['destroy',]]);

        $this->my_class = $my_class;
        $this->user = $user;
    }
    public function index()
    {
        // Mengambil semua kelas
        $d['my_classes'] = $this->my_class->all();
        $d['teachers'] = DB::table('users')->where('user_type', 'teacher')->get();
        // $d['classes'] = DB::table('my_classes')->get();

        // Mengambil user dengan tipe 'teacher'
        // $d['teachers'] = DB::table('users')->where('user_type', 'teacher')->get();

        // Mengambil semua mata pelajaran
        $d['subjects'] = $this->my_class->getAllSubjects();

        // Return data ke view
        return view('back.pages.mata_pelajaran.index', $d);

        return view('pages.support_team.subjects.index', $d);
    }

    // public function index()
    // {
    //     $d['my_classes'] = $this->my_class->all();
    //     $d['teachers'] = $this->user->getUserByType('teacher');
    //     $d['subjects'] = $this->my_class->getAllSubjects();
        
    //     return view('back.pages.mata_pelajaran.index', $d);
    // }
    // $teachers = UserType::where('user_type', 'teacher')->get();
    // return view('pages.support_team.subjects.index', $d);

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:subjects,slug',
            'my_class_id' => 'required|exists:my_classes,id',
            'teacher_id' => 'required|exists:users,id',
            'hari' => 'required|integer|min:1|max:7',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);
    
        // Simpan data mata pelajaran
        DB::table('subjects')->insert([
            'name' => $request->name,
            'slug' => $request->slug,
            'my_class_id' => $request->my_class_id,
            'teacher_id' => $request->teacher_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }


    // public function store(SubjectCreate $req)
    // {
    //     try {
    //         // Menyimpan data subject
    //         $data = $req->all();
    //         $this->my_class->createSubject($data);

    //         // Mengembalikan response sukses
    //         return redirect()->route('mapel.index')->with('success', 'Mata Pelajaran Berhasil Ditambahkan.');
    //     } catch (\Exception $e) {
    //         // Mengembalikan error jika gagal
    //         return redirect()->back()->with('error', 'Mata Pelajaran Gagal Ditambahkan. Kesalahan: ' . $e->getMessage());
    //     }
    // }
    public function edit($id)
    {
        $d['s'] = $sub = $this->my_class->findSubject($id);
        $d['my_classes'] = $this->my_class->all();
        $d['teachers'] = $this->user->getUserByType('teacher');

        return is_null($sub) ? Qs::goWithDanger('subjects.index') : view('pages.support_team.subjects.edit', $d);
    }

    public function update(SubjectUpdate $req, $id)
    {
        $data = $req->all();
        $this->my_class->updateSubject($id, $data);

        return Qs::jsonUpdateOk();
    }

    public function destroy($id)
    {
        $this->my_class->deleteSubject($id);
        return back()->with('flash_success', __('msg.del_ok'));
    }
}
