@extends('layout')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>{{ $adminsCount }}</h4>
                    <h5>Total Admin</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4>{{ $officersCount }}</h4>
                    <h5>Total Petugas</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>{{ $borrowersCount }}</h4>
                    <h5>Total Peminjam</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>{{ $books->count() }}</h4>
                    <h5>Total Buku</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="book"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-0">
        <div class="card-body">
            <div class="table-top d-flex justify-content-between">
                <h4 style="font-weight: 600">Book List</h4>
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
                            <th>No</th>
                            <th>Book Title</th>
                            <th>Writer</th>
                            <th>Publisher</th>
                            <th>Publication Year</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->writer }}</td>
                                <td>{{ $item->publisher }}</td>
                                <td>{{ $item->year }}</td>
                                <td>
                                    @if ($item->status == 'borrowed')
                                        <span class="badge bg-danger">Borrowed</span>
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
</div>
@endsection