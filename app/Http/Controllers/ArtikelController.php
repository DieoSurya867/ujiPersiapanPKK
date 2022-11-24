<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::all();
        return view('pages.admin.artikel', compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('pages.admin.artikel.tambah', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'foto' => 'required|image|max:10000|mimes:png,jpg',
            'kategori_id' => 'required',
        ]);
        $file = $request->file('foto')->store('artikel');
        $validator['foto'] = $file;
        Artikel::create($validator);
        return redirect('admin/artikel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        $kategori = Kategori::all();
        return view('pages.admin.artikel.edit', [
            'artikel' => $artikel,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $artikel = Artikel::findOrFail($id);
        $validator = $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'kategori_id' => 'required'
        ]);
        $artikel->update($validator);

        $dataLama = Artikel::where('id', $id)->first();
        if ($request->file('foto')) {
            $foto1 = public_path('storage/' . $dataLama->foto);
            if (File::exists($foto1)) {
                File::delete($foto1);
            }
            $file = $request->file('foto')->store('artikel');
            $artikel->update([
                'foto' => $file,
            ]);
            return redirect('admin/artikel');
        }
        return redirect('admin/artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataLama = Artikel::where('id', $id)->first();
        $foto1 = public_path('storage/' . $dataLama->foto);
        if (File::exists($foto1)) {
            File::delete($foto1);
        }
        Artikel::where('id', $id)->delete();
        return redirect('admin/artikel');
    }
}
