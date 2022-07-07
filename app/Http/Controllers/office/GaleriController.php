<?php

namespace App\Http\Controllers\office;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GaleriResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax() ){
            $collection = GaleriResource::collection(
                Galeri::where('judul','like','%'.$request->keywords.'%')->orderBy('id','desc')->paginate(5)
            );
            return view('pages.office.gallery.list',compact('collection'));
        }
        return view('pages.office.gallery.main');
    }

    public function create()
    {
        return view('pages.office.gallery.input', ['galeri' => new Galeri]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required',
            'judul' => 'required',
            'tanggal_kegiatan' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('foto')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('foto'),
                ]);
            }else if($errors->has('judul')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('judul'),
                ]);
            }else if($errors->has('tanggal_kegiatan')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tanggal_kegiatan'),
                ]);
            }
        }
        $galeri = new Galeri;
        $galeri->id_user = $request->id_user;
        $foto = request()->file('foto')->store("galeri");
        $galeri->foto = $foto;
        $galeri->judul = $request->judul;
        $galeri->tanggal_kegiatan = $request->tanggal_kegiatan;
        $galeri->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Galeri Tersimpan',
        ]);
    }

    public function show(Galeri $galeri)
    {
        //
    }

    public function edit(Galeri $galeri)
    {
        return view('pages.office.gallery.input', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'tanggal_kegiatan' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('foto')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('foto'),
                ]);
            }else if($errors->has('judul')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('judul'),
                ]);
            }else if($errors->has('tanggal_kegiatan')){
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tanggal_kegiatan'),
                ]);
            }
        }
        if($request->foto){
            Storage::delete($galeri->foto);
            $file = request()->file('foto')->store("galeri");
             $galeri->foto = $file;
        }
        $galeri->judul = $request->judul;
        $galeri->tanggal_kegiatan = $request->tanggal_kegiatan;
        $galeri->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Galeri Terubah',
        ]);
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        Storage::delete($galeri->foto);
        return response()->json([
            'alert' => 'success',
            'message' => 'Galeri Terhapus',
        ]);
    }
}
