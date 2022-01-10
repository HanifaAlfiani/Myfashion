<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web;
use App\Models\Celana;
use Storage;
use Alert;

class CelanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['celana'] = Celana::paginate(6);
        $data['web'] = Web::all();
        return view('back.celana.data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['web'] = Web::all();
        return view('back.celana.create', $data);
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
            'nama' => 'required|min:3|max:200|unique:celana',
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

        $gambar = ($request->gambar) ? $request->file('gambar')->store("/public/input/celana") : null;
        
        $data = [
            'nama' => $request->nama,
            'harga' => $request->harga,
            'link' => $request->link,
            'gambar' => $gambar
        ];

        Celana::create($data)
        ? Alert::success('Berhasil', 'Celana telah berhasil ditambahkan!')
        : Alert::error('Error', 'Celana gagal ditambahkan!');

        return redirect()->route('celana-cms.index');
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
        $data['celana'] = Celana::find($id);
        $data['web'] = Web::all();
        return view('back.celana.edit', $data);
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
        $celana = Celana::findOrFail($id);

        $request->validate([
            'edit_nama' => "required|min:3|max:200|unique:celana,nama,$celana->id",
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
            if(Storage::exists($celana->gambar) && !empty($celana->gambar)) {
                Storage::delete($celana->gambar);
            }

            $edit_gambar = $request->file("edit_gambar")->store("/public/input/celana");
        }
        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $celana->nama,
            'harga' => $request->edit_harga ? $request->edit_harga : $celana->harga,
            'link' => $request->edit_link ? $request->edit_link : $celana->link,
            'gambar' => $request->hasFile('edit_gambar') ? $edit_gambar : $celana->gambar
           
        ];

        $celana->update($data)
        ? Alert::success('Berhasil', "Celana telah berhasil diubah!")
        : Alert::error('Error', "Celana gagal diubah!");

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
        $celana = Celana::findOrFail($id);
        Storage::delete($celana->gambar);
        $celana->delete()
            ? Alert::success('Berhasil', "Celana telah berhasil dihapus.")
            : Alert::error('Error', "Celana gagal dihapus!");

        return redirect()->back();
    }
}
