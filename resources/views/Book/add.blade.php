@extends('layout')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h2>Book Management</h2>
            <h6>Add New Book</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('createBook')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Book Title</label>
                            <input type="text" placeholder="Enter book title" name="title">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Writer</label>
                            <input type="text" placeholder="Enter writer" name="writer">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" placeholder="Enter publish year" name="year">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" placeholder="Add stock" name="stock">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="select" name="categoryId">
                                <option>Choose Category</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>          
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="form-group">
                            <label>Publisher</label>
                            <input type="text" placeholder="Enter publisher" name="publisher">
                        </div>
                    </div>
                    <div class="custom-file-container" data-upload-id="myFirstImage">
                        <label>Upload Cover <a href="#"
                                class="custom-file-container__image-clear" title="Clear Image"></a></label>
                        <label class="custom-file-container__custom-file">
                            <input type="file" name="cover" class="custom-file-container__custom-file__custom-file-input"
                                accept="image/*">
                            <input type="hidden"/>
                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                        </label>
                        <div class="custom-file-container__image-preview"></div>
                    </div>
                    <div class="col-lg-12 mt-lg-3">
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                        <button type="button" class="btn btn-cancel">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>  
@endsection