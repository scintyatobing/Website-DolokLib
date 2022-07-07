<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowDetail;
use Carbon\Carbon;

class BorrowController extends Controller
{
    // use ReplyJson;
    public function __construct()
    { 
        $this->middleware('auth:api');
    }

    public function borrow(Book $book)
    {
        $borrow = new Borrow;
        $borrow->id_user = request()->user()->id;
        $borrow->tanggal = now();
        $borrow->status = 'menunggu';
        $borrow->created_by = auth()->user()->id;
        $borrow->created_at = now();
        $borrow->updated_at = now();
        $borrow->save();
        
        if($book->status == 'tersedia'){
            $detail = new BorrowDetail;
            $detail->id_peminjaman = $borrow->id;
            $detail->id_buku = $book->id;
            $detail->save();
            $book->status = 'dipinjam';
            $book->update();
            return response()->json(['message'=>'Buku Berhasil Dipinjam! Menununggu konfirmasi admin untuk dapat menjemput buku'],201);
        }else{
            return response()->json(['message'=>'Buku tidak berhasil dipinjam , buku masih dipinjam oleh orang lain'],400);
        }
        // return response()->json(['message'=>'Buku Berhasil Dipinjam! Menununggu konfirmasi admin untuk dapat menjemput buku'],201);
    }

    // public function request($id){
    //     $data = Borrow::where('id', $id)->first();
    //     $data->st = 'menunggu';
      
    //     $data->update();
    //     $peminjaman = BorrowDetail::where('id_peminjaman', $id)->first();
    //     $peminjaman->st = 'menunggu';
    //     $peminjaman->update();
    //     return response()->json(['message'=>'Permintaan Berhasil Dikonfirmasi!'],201);
    // }

    public function extend($id){
        $data = Borrow::where('id', $id)->first();
        $data->status = 'menunggu perpanjangan';
        $data->update();
        return response()->json(['message'=>'Permintaan Perpanjangan Berhasil Dikirim!'],201);
    }
    
    // public function confirm($id){
    //     $data = Borrow::where('id', $id)->first();
    //     $data->st = 'dikonfirmasi';
    //     $data->update();
    //     $peminjaman = BorrowDetail::where('id_peminjaman', $id)->first();
    //     $peminjaman->st = 'dikonfirmasi';
    //     $peminjaman->update();
    //     return response()->json(['message'=>'Permintaan Berhasil Dikonfirmasi!'],201);
    // }
    
    public function return($id){
        // $data = Borrow::where('id', $id)->first();
        // $data->st = 'dikembalikan';

        // $data->update();
        // $peminjaman = BorrowDetail::where('id_peminjaman', $id)->first();
        // $peminjaman->tanggal_pengembalian = now();
        // $interval = $peminjaman->tanggal_pinjam->diffInDays($peminjaman->tanggal_pengembalian);
        // $days = $interval->format('%a');
        // dd($days);
        // $peminjaman->st = 'dikembalikan';
        // $peminjaman->update();
        $data = Borrow::where('id', $id)->first();
        $data->status = 'dikonfirmasi pengembalian';
        $data->update();
        $peminjaman = BorrowDetail::where('id_peminjaman', $id)->get();
        foreach($peminjaman as $peminjamanDetail):
            $diff = Carbon::parse($data->tanggal)->diffInDays(Carbon::parse($peminjamanDetail->tanggal_pengembalian));
            if($diff > 6){
                $peminjamanDetail->denda = 10000;
            }
            $peminjamanDetail->update();
        endforeach;
        return response()->json(['message'=>'Berhasil meminta untuk pengembalian!'],201);
    }
}
