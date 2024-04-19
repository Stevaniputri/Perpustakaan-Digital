<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function generatePDF($view, $data, $filename)
    {

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view($view, $data)->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($filename);
    }

    public function exportBorrowsPDF()
    {
        $borrows = Borrow::all();
        return $this->generatePDF('pdf.borrow', compact('borrows'), 'borrows.pdf');
    }

    public function borrowedUser()
    {
        $user_id = auth()->id();

        // Ambil data peminjaman buku berdasarkan user_id yang sedang login
        $books = Borrow::where('user_id', $user_id)
                       ->with('book')
                       ->orderby('status', 'asc')
                       ->get();
    
        return view('Borrow.borrowedUser', compact('books'));
    }

    public function borrowedAdmin()
    {
        $borrows = Borrow::with('book', 'user')->get();
        return view('Borrow.borrowed', compact('borrows'));
    }

    public function borrowBook($bookId)
    {
        $userId = Auth::id();
        $book = Book::findOrFail($bookId);
    
        // Periksa apakah masih ada stok buku yang tersedia
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Maaf, buku ini sudah tidak tersedia untuk dipinjam.');
        }
    
        // Simpan data peminjaman buku ke dalam tabel 'borrows'
        Borrow::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'tanggal_peminjaman' => now(),
            'status' => 'borrowed',
        ]);
    
        // Kurangi stok buku yang tersedia
        $book->decrement('stock');
    
        return redirect()->route('borrowedUser')->with('success', 'Buku berhasil dipinjam.');
    }    

    public function returnBook(Borrow $borrow)
    {
        // Periksa apakah buku sudah dikembalikan sebelumnya
        if ($borrow->status !== 'borrowed') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }
    
        // Update status peminjaman menjadi "returned" dan isi tanggal pengembalian
        $borrow->update([
            'status' => 'returned',
            'tanggal_pengembalian' => now(),
        ]);
    
        // Ubah status buku menjadi "available"
        $borrow->book->update(['status' => 'available']);
        $borrow->book->increment('stock');
    
        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrow $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        //
    }
}
