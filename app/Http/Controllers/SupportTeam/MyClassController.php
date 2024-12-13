<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\MyClass\ClassCreate;
use App\Http\Requests\MyClass\ClassUpdate;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class MyClassController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSA', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index()
    {
        $d['my_classes'] = $this->my_class->all();
        $d['class_types'] = $this->my_class->getTypes();

        return view('pages.support_team.classes.index', $d);
        // return view('back.pages.kelas.index', $d);
    }

    public function store(ClassCreate $req)
    {
        try {
            $data = $req->all();
            $mc = $this->my_class->create($data);

            $s = [
                'my_class_id' => $mc->id,
                'name' => 'A',
                'active' => 1,
                'teacher_id' => null,
            ];
            $this->my_class->createSection($s);

            return redirect()->back()->with('success', 'Kelas berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat kelas: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $d['c'] = $c = $this->my_class->find($id);

        return is_null($c) ? Qs::goWithDanger('classes.index') : view('pages.support_team.classes.edit', $d) ;
    }

    public function update(ClassUpdate $req, $id)
    {
        try {
            // Ambil data dari request
            $data = $req->only(['name']);

            // Update data kelas
            $this->my_class->update($id, $data);

            // Redirect dengan pesan sukses
            return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->back()->with('danger', 'Kelas gagal diperbarui ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $this->my_class->delete($id);
            return back()->with('error', 'Kelas Berhasil di Hapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Kelas Tidak Berhasil di Hapus');
        }
    }    
}