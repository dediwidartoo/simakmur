<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Category;
use Str;
use Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::latest()->paginate(15);
        return view('admin.artikel.index', compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Category::select('id', 'nama_kategori')->get();
        return view('admin.artikel.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $image = $request->file('gambar')->store('artikel');
        Artikel::create([
            'judul' => Str::slug($request->judul),
            'body'  => $request->body,
            'gambar' => $image,
            'kategori_id'   => $request->kategori_id
        ]);
        return redirect()->route('artikel.index');
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
        $kategori = Category::select('id', 'nama_kategori')->get();
        $artikel = Artikel::find($id);
        return view('admin.artikel.edit', compact('kategori', 'artikel'));
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
        $artikel=Artikel::find($id);
        if ($request->file('gambar') == null) {
            $artikel->update([
                'judul'         => Str::slug($request->judul),
                'body'          => $request->body,
                'kategori_id'   => $request->kategori_id
            ]);
        } else {
            Storage::delete($artikel->gambar);
            $artikel->update([
                'judul'         => Str::slug($request->judul),
                'body'          => $request->body,
                'gambar'        => $request->file('gambar')->store('artikel'),
                'kategori_id'   => $request->kategori_id
            ]);
        }
        

        return redirect()->route('artikel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = Artikel::find($id);
        if (!$artikel) {
            return redirect()->back();
        }

        Storage::delete($artikel->gambar);
        $artikel->delete();
        return redirect()->route('artikel.index');
    }
}
