<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $pinjam = Peminjaman::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::user()->id,
            'tanggal_pinjam' => $request->borrow_date,
            'tanggal_kembali' => $request->return_date,
            'status' => 'pinjam',
            'denda' => 0,
        ]);

        if($pinjam){
            return redirect()->route('book.user')->with('success', 'Buku berhasil dipinjam');
        }

        return back()->with('error', 'Gagal meminjam buku');


    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
