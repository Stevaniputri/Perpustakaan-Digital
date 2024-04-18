@extends('layout')
@section('content')
<div class="content">
    <div class="card mb-0">
        <div class="card-body">
            <div class="table-top d-flex justify-content-between">
                <h4 class="card-title">Collection List</h4>
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
                            <th>Book Title</th>
                            <th>Writer</th>
                            <th>Publisher</th>
                            <th>Publication Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collectionBooks as $item)
                        <tr>
                            <td>
                                <div class="">
                                    <span style="font-weight: 600; color: rgb(89, 128, 211)">
                                        @if($item->book)
                                            {{ $item->book->title }}
                                        @else
                                            Book not available
                                        @endif
                                    </span>
                                    <p>
                                        @if($item->book)
                                            @if($item->book->category)
                                                {{ $item->book->category->name }}
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                            </td>
                            <td>
                                @if($item->book)
                                    {{ $item->book->writer }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->book)
                                    {{ $item->book->publisher }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->book)
                                    {{ $item->book->year }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <form action="{{ route('uncollection', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-2"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @if($item->book->borrows()->where('user_id', auth()->id())->where('status', 'borrowed')->exists())
                                        <span class="badge bg-danger d-flex align-center">Borrowed</span>
                                    @else
                                        <form action="{{ route('borrow', ['book' => $item->book->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm me-2"><i class="fas fa-book"></i> Borrow</button>
                                        </form>
                                    @endif
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
