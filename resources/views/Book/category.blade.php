@extends('layout')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h2>Book Category</h2>
            <h6>Manage your Book Category</h6>
        </div>
        <div class="page-btn">
            <a id="addCategoryBtn" class="btn btn-added" href="#"><img src={{asset("assets/img/icons/plus.svg")}} alt="img">Add Category</a>
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
                            <a href="{{ route('categories.export.pdf') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
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
                <table class="table  datanew">
                    <thead>
                        <tr>
                            <th style="width: 8%">#</th>
                            <th style="width: 75%">Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataCategories as $key => $item)
                        <tr>
                            <td>{{ intval($key) + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="d-flex align-items-center">
                                <a class="btn" data-bs-toggle="modal" data-bs-target="#editCategoryModal-{{ $item->id }}">
                                    <i class="fas fa-edit fa-lg" style="color: orange;"></i>
                                </a>
                                <form id="deleteForm_{{ $item->id }}" method="POST" action="{{ route('deleteCategory', ['id' => $item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-category-btn">
                                        <i class="fas fa-trash-alt fa-lg" style="color: red;"></i>
                                    </button>
                                </form>                                   
                            </td>
                        </tr>  
                        <!-- Modal untuk Edit Category -->
                        <div class="modal fade" id="editCategoryModal-{{ $item->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel-{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editCategoryForm" method="POST" action="{{ route('updateCategory', ['id' => $item->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="editCategoryId" name="id">
                                            <div class="mb-3">
                                                <label for="editCategoryName" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" id="editCategoryName" name="name" value="{{$item->name}}">
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" method="POST" action="{{ route('createCategory') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
    </div>
</div> 
<script>
    // Fungsi untuk menampilkan modal saat tombol "Add Category" diklik
    document.getElementById('addCategoryBtn').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
        modal.show();
    });
</script>
<script>
    // Fungsi untuk menampilkan modal edit ketika tombol "Edit" diklik
    @foreach ($dataCategories as $item)
        document.getElementById('editCategoryBtn-{{ $item->id }}').addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('editCategoryModal-{{ $item->id }}'));
            modal.show();
        });
    @endforeach
</script>
@endsection