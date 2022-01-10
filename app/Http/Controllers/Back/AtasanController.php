<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web;
use App\Models\Atasan;
use Storage;
use Alert;

class AtasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['atasan'] = Atasan::paginate(6);
        $data['web'] = Web::all();
        return view('back.atasan.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['web'] = Web::all();
        return view('back.atasan.create', $data);
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
            'nama' => 'required|min:3|max:200|unique:atasan',
            'harga' => 'required',
            'link' => 'required',
            'gambar' => 'required',
        ],
        [
            'nama.required' => 'Nama Atasan harus di isi.',
            'nama.min' => 'Minimal karakter tidak boleh kurang dari 3 karakter',
            'nama.max' => 'Maksimal karakter tidak boleh lebih dari 200 karakter',
            'nama.unique' => 'Nama Atasan sudah tersedia.',
            'harga.required' => 'Harga harus di isi.',
            'link.required' => 'Link harus di isi.',
            'gambar.required' => 'Gambar harus di isi.',
        ]);

        $gambar = ($request->gambar) ? $request->file('gambar')->store("/public/input/atasan") : null;
        
        $data = [
            'nama' => $request->nama,
            'harga' => $request->harga,
            'link' => $request->link,
            'gambar' => $gambar
        ];

        Atasan::create($data)
        ? Alert::success('Berhasil', 'Atasan telah berhasil ditambahkan!')
        : Alert::error('Error', 'Atasan gagal ditambahkan!');

        return redirect()->route('atasan-cms.index');
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
        $data['atasan'] = Atasan::find($id);
        $data['web'] = Web::all();
        return view('back.atasan.edit', $data);
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
        $atasan = Atasan::findOrFail($id);

        $request->validate([
            'edit_nama' => "required|min:3|max:200|unique:atasan,nama,$atasan->id",
            'edit_harga' => 'required',
            'edit_link' => 'required',
        ],
        [
            'nama.required' => 'Nama Atasan harus di isi.',
            'nama.min' => 'Minimal karakter tidak boleh kurang dari 3 karakter',
            'nama.max' => 'Maksimal karakter tidak boleh lebih dari 200 karakter',
            'nama.unique' => 'Nama Atasan sudah tersedia.',
            'harga.required' => 'Harga harus di isi.',
            'link.required' => 'Link harus di isi.',
        ]);

        if($request->hasFile('edit_gambar')) {
            if(Storage::exists($atasan->gambar) && !empty($atasan->gambar)) {
                Storage::delete($atasan->gambar);
            }

            $edit_gambar = $request->file("edit_gambar")->store("/public/input/atasan");
        }
        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $atasan->nama,
            'harga' => $request->edit_harga ? $request->edit_harga : $atasan->harga,
            'link' => $request->edit_link ? $request->edit_link : $atasan->link,
            'gambar' => $request->hasFile('edit_gambar') ? $edit_gambar : $atasan->gambar
           
        ];

        $atasan->update($data)
        ? Alert::success('Berhasil', "Atasan telah berhasil diubah!")
        : Alert::error('Error', "Atasan gagal diubah!");

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
        $atasan = Atasan::findOrFail($id);
        Storage::delete($atasan->gambar);
        $atasan->delete()
            ? Alert::success('Berhasil', "Atasan telah berhasil dihapus.")
            : Alert::error('Error', "Atasan gagal dihapus!");

        return redirect()->back();
    }
}
