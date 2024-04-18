<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Di dalam Controller, tambahkan logika untuk mengambil daftar buku berserta statusnya di koleksi pengguna
    public function mycollection()
    {
        $user_id = auth()->id();

        $collectionBooks = Collection::where('user_id', $user_id)
            ->with('book')
            ->get();

        return view('mycollection', compact('collectionBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->id();
        $book_id = $request->book;

        // Lakukan validasi untuk memastikan book_id tidak kosong
        if (!$book_id) {
            return redirect()->route('booklist')->with('error', 'Invalid book selection.');
        }

        // Lakukan validasi apakah buku sudah ada di koleksi pengguna
        $existingCollection = Collection::where('user_id', $user_id)
            ->where('book_id', $book_id)
            ->exists();

        if (!$existingCollection) {
            // Jika buku belum ada di koleksi pengguna, simpan ke dalam tabel collections
            Collection::create([
                'user_id' => $user_id,
                'book_id' => $book_id,
            ]);

            return redirect()->route('mycollection')->with('success', 'Book added to your collection successfully.');
        } else {
            return redirect()->route('booklist')->with('error', 'Book already exists in your collection.');
        }
    }

    public function uncollection($id)
    {
        // Temukan koleksi berdasarkan ID
        $collection = Collection::find($id);

        // Pastikan koleksi ditemukan
        if (!$collection) {
            return redirect()->back()->with('error', 'Collection not found.');
        }

        // Hapus koleksi
        $collection->delete();

        return redirect()->back()->with('success', 'Book removed from your collection.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        //
    }
}
