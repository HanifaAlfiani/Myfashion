<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web;
use App\Models\Outer;
use Storage;
use Alert;

class OuterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['outer'] = Outer::paginate(6);
        $data['web'] = Web::all();
        return view('back.outer.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['web'] = Web::all();
        return view('back.outer.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:200|unique:outer',
            'harga' => 'required',
            'link' => 'required',
            'gambar' => 'required',
        ],
        [
            'nama.required' => 'Nama harus di isi.',
            'nama.min' => 'Minimal karakter tidak boleh kurang dari 3 karakter',
            'nama.max' => 'Maksimal karakter tidak boleh lebih dari 200 karakter',
            'nama.unique' => 'Nama sudah tersedia.',
            'harga.required' => 'Harga harus di isi.',
            'link.required' => 'Link harus di isi.',
            'gambar.required' => 'Gambar harus di isi.',
        ]);

        $gambar = ($request->gambar) ? $request->file('gambar')->store("/public/input/outer") : null;
        
        $data = [
            'nama' => $request->nama,
            'harga' => $request->harga,
            'link' => $request->link,
            'gambar' => $gambar
        ];

        Outer::create($data)
        ? Alert::success('Berhasil', 'Outer telah berhasil ditambahkan!')
        : Alert::error('Error', 'Outer gagal ditambahkan!');

        return redirect()->route('outer-cms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['outer'] = Outer::find($id);
        $data['web'] = Web::all();
        return view('back.outer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $outer = Outer::findOrFail($id);

        $request->validate([
            'edit_nama' => "required|min:3|max:200|unique:outer,nama,$outer->id",
            'edit_harga' => 'required',
            'edit_link' => 'required',
        ],
        [
            'nama.required' => 'Nama harus di isi.',
            'nama.min' => 'Minimal karakter tidak boleh kurang dari 3 karakter',
            'nama.max' => 'Maksimal karakter tidak boleh lebih dari 200 karakter',
            'nama.unique' => 'Nama sudah tersedia.',
            'harga.required' => 'Harga harus di isi.',
            'link.required' => 'Link harus di isi.',
        ]);

        if($request->hasFile('edit_gambar')) {
            if(Storage::exists($outer->gambar) && !empty($outer->gambar)) {
                Storage::delete($outer->gambar);
            }

            $edit_gambar = $request->file("edit_gambar")->store("/public/input/outer");
        }
        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $outer->nama,
            'harga' => $request->edit_harga ? $request->edit_harga : $outer->harga,
            'link' => $request->edit_link ? $request->edit_link : $outer->link,
            'gambar' => $request->hasFile('edit_gambar') ? $edit_gambar : $outer->gambar
           
        ];

        $outer->update($data)
        ? Alert::success('Berhasil', "Outer telah berhasil diubah!")
        : Alert::error('Error', "Outer gagal diubah!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outer = Outer::findOrFail($id);
        Storage::delete($outer->gambar);
        $outer->delete()
            ? Alert::success('Berhasil', "Outer telah berhasil dihapus.")
            : Alert::error('Error', "Outer gagal dihapus!");

        return redirect()->back();
    }
}
