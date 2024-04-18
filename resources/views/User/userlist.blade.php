@extends('layout')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h2>User List</h2>
            <h6>Manage your Users</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('add')}}" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img">Add User</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a href="{{ route('users.export.pdf') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="assets/img/icons/pdf.svg" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="assets/img/icons/excel.svg" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="assets/img/icons/printer.svg" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $key => $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->fullname}}</td>
                            <td>{{$item->address}}</td>
                            <td>
                                @php
                                $badgeColor = '';
                                switch ($item->role) {
                                    case 'admin':
                                        $badgeColor = 'success';
                                        break;
                                    case 'petugas':
                                        $badgeColor = 'primary';
                                        break;
                                    case 'peminjam':
                                        $badgeColor = 'warning';
                                        break;
                                    default:
                                        $badgeColor = 'secondary';
                                }
                                @endphp
                                <span class="badge bg-{{$badgeColor}}">{{$item->role}}</span>
                            </td>
                            <td class="d-flex align-items-center">
                                <a href="{{ route('editUser', $item->id) }}">
                                    <i class="fas fa-edit fa-lg" style="color: orange;"></i>
                                </a>
                                <form id="deleteForm_{{$item->id}}" method="POST" action="{{ route('deleteUser', ['id' => $item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn" onclick="confirmDelete({{$item->id}})">
                                        <i class="fas fa-trash-alt fa-lg" style="color: red;"></i>
                                    </button>
                                </form>                                
                            </td>
                            
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>   
<script>
    // Fungsi untuk menampilkan alert sebelum menghapus data
    function confirmDelete(id) {
        // Tampilkan pesan konfirmasi
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            // Jika user menekan tombol OK, submit form penghapusan
            document.getElementById('deleteForm_' + id).submit();
        }
    }
</script>
@endsection