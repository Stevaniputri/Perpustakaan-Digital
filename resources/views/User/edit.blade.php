@extends('layout')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h2>Customer Management</h2>
            <h6>Edit Customer</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('updateUser', ['id' => $users->id]) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" placeholder="Enter your fullname" name="fullname" value="{{ $users->fullname }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" placeholder="Enter username" name="username" value="{{ $users->username }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" placeholder="Enter your email" name="email" value="{{ $users->email }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" placeholder="Enter your password" name="password" value="{{ $users->password }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="select" name="role">
                                <option value="{{ $users->role }}">{{ $users->role }}</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                                <option value="peminjam">Peminjam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" placeholder="Enter your address" name="address" value="{{ $users->address }}">
                        </div>
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