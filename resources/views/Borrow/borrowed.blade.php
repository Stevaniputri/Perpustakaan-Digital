@extends('layout')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h2>Borrow List</h2>
            <h6>Manage your Books</h6>
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
                            <a href="{{ route('borrows.export.pdf') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
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
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td>
                                    <span style="font-size: 16px; font-weight: 600; color: rgba(96, 122, 204, 0.933)">{{ $borrow->user->fullname }}</span>
                                    <p>{{ $borrow->user->username }}</p>
                                </td>
                                <td>{{ $borrow->book->title }}</td>
                                <td>{{ $borrow->tanggal_peminjaman }}</td>
                                <td>
                                    @if ($borrow->status === 'borrowed')
                                        <span class="badge bg-danger text-dark">Borrowed</span>
                                    @else
                                        {{ $borrow->tanggal_pengembalian }}
                                    @endif
                                </td>
                                <td>
                                    @if ($borrow->status == 'borrowed')
                                        <span class="badge bg-danger text-dark">Borrowed</span>
                                    @else
                                        <span class="badge bg-success">Available</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="card mb-0">
        <div class="card-body">
            <h4 class="card-title">Book List</h4>
            <div class="table-responsive">
                <table class="table datanew ">
                    <thead>
                        <tr>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrows as $borrow)
                            <tr>
                                <td>
                                    <span style="font-size: 16px; font-weight: 600; color: rgba(96, 122, 204, 0.933)">{{ $borrow->user->fullname }}</span>
                                    <p>{{ $borrow->user->username }}</p>
                                </td>
                                <td>{{ $borrow->book->title }}</td>
                                <td>{{ $borrow->tanggal_peminjaman }}</td>
                                <td>{{ $borrow->tanggal_pengembalian }}</td>
                                <td>
                                    @if ($borrow->status == 'borrowed')
                                        <span class="badge bg-danger text-dark">Borrowed</span>
                                    @else
                                        <span class="badge bg-success">Available</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div> --}}
</div>   
@endsection