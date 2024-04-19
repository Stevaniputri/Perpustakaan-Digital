@extends('layout')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h2>Book List</h2>
            <h6>Manage your Books</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('addBook')}}" class="btn btn-added"><img src={{asset("assets/img/icons/plus.svg")}} alt="img">Add Book</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src={{asset("assets/img/icons/search-white.svg")}}
                                alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a href="{{ route('books.export.pdf') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src={{asset("assets/img/icons/pdf.svg")}} alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src={{asset("assets/img/icons/excel.svg")}} alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src={{asset("assets/img/icons/printer.svg")}} alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Category</th>
                            <th>Publisher</th>
                            <th>Year</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataBook as $key => $item)
                        <tr>                         
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($item->cover)
                                <img src="{{ asset('images/' . $item->cover) }}" alt="Cover" style="max-width: 100px;"> <!-- Tambahkan tag img untuk menampilkan cover -->
                                @else
                                No Image <!-- Tampilkan pesan jika cover tidak tersedia -->
                                @endif
                            </td>   
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->writer }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->publisher }}</td>
                            <td>{{ $item->year }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- Icon untuk mengedit buku (Ukuran: 2x, Warna: Kuning) -->
                                    <a href="{{ route('editBook', $item->id) }}">
                                        <i class="fas fa-edit fa-lg" style="color: orange;"></i>
                                    </a>
                                    
                                    <!-- Form untuk menghapus buku (Ukuran: lg, Warna: Merah) -->
                                    <form id="deleteForm_{{ $item->id }}" method="POST" action="{{ route('deleteBook', ['id' => $item->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <i class="fas fa-trash-alt fa-lg" style="color: red;"></i>
                                        </button>
                                    </form>                  
                                </div>                        
                            </td>                                                                 
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  
@endsection
