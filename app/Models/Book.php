<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = "books";
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    // Definisikan relasi dengan Collection
    public function collections()
    {
        return $this->hasMany(Collection::class, 'book_id');
    }

    // Method untuk memeriksa apakah buku sudah ada dalam koleksi pengguna
    public function isInCollection($userId)
    {
        return $this->collections()->where('user_id', $userId)->exists();
    }

    public function isAvailable()
    {
        // Cek apakah buku ini sedang dipinjam
        return $this->borrows()->where('status', 'borrowed')->count() == 0;
    }    

    public function isBorrowed($userId)
    {
        return $this->borrows()->where('status', 'borrowed')->where('user_id', $userId)->exists();
    }    

    // Tambahkan relasi dengan tabel `borrows`
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function borrowedBooks()
    {
        return $this->belongsToMany(Borrow::class, 'borrowed_book')->withPivot('status', 'tanggal_peminjaman', 'tanggal_pengembalian');
    }

    // Define the relationship with Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
