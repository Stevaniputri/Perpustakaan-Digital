<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Borrow;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
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

    public function booklist()
    {
        $dataBook = Book::latest()->get();
        return view('Book.booklist', compact('dataBook'));
    }

    public function add()
    {
        $categories = Category::all();
        return view('Book.add', compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $books = Book::where('id', $id)->first();
        return view('Book.edit', compact('books', 'categories'));
    }

    public function exportBooksPDF()
    {
        $books = Book::all();
        return $this->generatePDF('pdf.book', compact('books'), 'books.pdf');
    }

    public function detail($id)
    {
        $books = Book::findOrFail($id);
    
        // Periksa apakah pengguna telah meminjam buku tersebut
        $hasBorrowed = Borrow::where('user_id', auth()->id())
                             ->where('book_id', $books->id)
                             ->where('status', 'borrowed')
                             ->exists();
    
        // Hitung rata-rata rating buku
        $averageRating = $books->reviews->avg('rating');
    
        return view('Book.detail', compact('books', 'hasBorrowed', 'averageRating'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'writer' => 'required',
            'categoryId' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'stock' => 'required|integer|min:0', // Menambahkan validasi untuk stok buku
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Hapus 'file' dari aturan validasi
        ]);
    
        if ($request->hasFile('cover')) {
            $cover = time() . '.' . $request->file('cover')->getClientOriginalExtension();
            $request->file('cover')->move(public_path('images'), $cover);
        } else {
            $cover = null;
        }
    
        Book::create([
            'title' => $request->title,
            'writer' => $request->writer,
            'categoryId' => $request->categoryId,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'stock' => $request->stock, // Menyimpan stok buku
            'cover' => $cover // Menyimpan nama file gambar
        ]);
    
        return redirect()->route('booklist')->with('success', 'Berhasil menambahkan buku');
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
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'writer' => 'required',
            'categoryId' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'stock' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $book = Book::findOrFail($id); // Ambil data buku yang akan diupdate

        // Proses penyimpanan gambar
        if ($request->hasFile('cover')) {
            $cover = time() . '.' . $request->file('cover')->getClientOriginalExtension();
            $request->file('cover')->move(public_path('images'), $cover);
            // Hapus gambar lama jika ada
            if ($book->cover) {
                Storage::delete('images/' . $book->cover);
            }
            // Update kolom cover dengan nama gambar yang baru
            $book->cover = $cover;
        }

        // Update data buku lainnya
        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->categoryId = $request->categoryId;
        $book->publisher = $request->publisher;
        $book->year = $request->year;
        $book->stock = $request->stock;
        $book->save();

        return redirect()->route('booklist')->with('success', 'Berhasil memperbarui buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Book::where('id', '=', $id)->delete();
        return redirect()->back();
    }
}
