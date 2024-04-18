@extends('layout')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h2>Book Management</h2>
            <h6>Edit Book</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('updateBook', ['id' => $books->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Book Title</label>
                            <input type="text" placeholder="Enter book title" name="title" value="{{ $books->title }}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Writer</label>
                            <input type="text" placeholder="Enter writer" name="writer" value="{{ $books->writer }}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" placeholder="Enter publish year" name="year" value="{{ $books->year }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="select" name="categoryId">
                                <option value="{{ $books->category->id}}">{{ $books->category->name}}</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>          
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="form-group">
                            <label>Publisher</label>
                            <input type="text" placeholder="Enter publisher" name="publisher" value="{{ $books->publisher }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Input Cover</label>
                        <div class="">
                            <input class="form-control" type="file" name="cover" id="coverInput">
                            <span>{{ $books->cover }}</span>
                        </div>
                    </div>                    
                    <div class="col-lg-12 mt-5">
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                        <button type="button" class="btn btn-cancel">Cancel</button>
                    </div>                                   
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
