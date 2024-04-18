@extends('layout')
@section('content')
<div class="content">
    <div class="card mb-0">
        <div class="card-body">
            <div class="table-top d-flex justify-content-between">
                <h4 class="card-title">Book List</h4>
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src={{asset("assets/img/icons/search-white.svg")}}
                                alt="img"></a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table datanew ">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $item)
                            <tr>
                                <td>
                                    <span style="font-size: 16px; font-weight: 600; color: rgba(96, 122, 204, 0.933)">{{ $item->user->fullname }}</span>
                                    <p>{{ $item->user->username }}</p>
                                </td>
                                <td><a href="{{ route('book.detail', ['id' => $item->book->id]) }}"><span style="font-size: 16px; font-weight: 600; color: rgba(96, 122, 204, 0.933)">{{ $item->book->title }}</span></a></td>
                                <td>{{ $item->tanggal_peminjaman }}</td>
                                <td>{{ $item->tanggal_pengembalian }}</td>
                                <td>
                                    @if ($item->status == 'borrowed')
                                        <span class="badge bg-danger text-dark">Borrowed</span>
                                    @else
                                        <span class="badge bg-success">Available</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 'borrowed')
                                    <form action="{{ route('return-book', $item) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-primary" style="font-size: 12px">
                                            <i class="fa fa-share"></i> Return
                                        </button>
                                    </form>  
                                    @else
                                        <span class="badge bg-success">Returned</span>
                                    @endif
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