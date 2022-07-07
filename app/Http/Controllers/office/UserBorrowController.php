<?php

namespace App\Http\Controllers\office;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\BorrowDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ExcelUserBorrow;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UserBorrowController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax() ){
            $collection = Borrow::select('peminjaman.*')->join('users','peminjaman.created_by','=','users.id')
            ->where('users.role','=','member')
            ->orderBy('peminjaman.created_at','DESC')
            ->paginate(5);
            return view('pages.office.userBorrow.list',compact('collection'));
        }
        return view('pages.office.userBorrow.main');
    }

    public function confirm(Borrow $borrow)
    {
        $borrow->status = 'dikonfirmasi peminjaman';
        $borrow->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Dikonfirmasi',
        ]);
    }

    public function borrowed(Borrow $borrow)
    {
        $borrow->status = 'dipinjam';
        $borrow->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Dikonfirmasi',
        ]);
    }

    public function acc(Borrow $borrow)
    {
        $borrow->status = 'sudah diperpanjang';
        $borrow->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Dikonfirmasi',
        ]);
    }

    public function return(Borrow $borrow)
    {
        $detail = BorrowDetail::where('id_peminjaman',$borrow->id)->get();
        $borrow->status = 'dikembalikan';
        $borrow->update();
        foreach($detail as $peminjamanDetail):
            $book = Book::where('id',$peminjamanDetail->id_buku)->first();
            $book->status = 'tersedia';
            $peminjamanDetail->tanggal_pengembalian = now();
            $peminjamanDetail->update();
            $book->update();
        endforeach;
        return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Dikonfirmasi',
            'modal' => 'modal',
            'url' => route('office.user-borrow.edit',$borrow->id),
            'name' => '#userBorrowModal',
            'content' => '#contentUserBorrowModall',
        ]);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Borrow $borrow)
    {
        return view('pages.office.userBorrow.modal',compact('borrow'));
    }

    public function update(Request $request, Borrow $borrow)
    {
         $validator = Validator::make($request->all(), [
            'keadaan' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('keadaan')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('keadaan'),
                ]);
            }
        }
        
        $details = BorrowDetail::where('id_peminjaman',$borrow->id)->get();
        foreach($details as $key => $detail){
            $detail->keadaan = $request->keadaan;
            $detail->update();
        }
         return response()->json([
            'alert' => 'success',
            'message' => 'Peminjaman Dikembalikan dengan keadaan buku ' .$request->keadaan,
        ]);
    }

    public function destroy(Borrow $borrow)
    {
        //
    }

    public static function pdfDownload(){
        $data = Borrow::select('peminjaman.*','detail_peminjaman.*','buku.*','users.*')
        ->join('users','peminjaman.created_by','=','users.id')
        ->join('detail_peminjaman','peminjaman.id','=','detail_peminjaman.id_peminjaman')
        ->join('buku','buku.id','=','detail_peminjaman.id_buku')
        ->where('users.role','=','member')
        ->orderBy('peminjaman.created_at','DESC')->get();
        $pdf = PDF::loadView('pages.office.userBorrow.pdf',compact('data'));
        return $pdf->download('Data Peminjaman Buku.pdf');
    }

    public static function excelDownload(){
        return Excel::download(new ExcelUserBorrow, 'Data Peminjaman Buku.csv',null,["ID","Judul"]);
    }
}
