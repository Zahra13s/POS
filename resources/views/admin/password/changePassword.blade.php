@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-5">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('changePassword') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                        <input type="password" class="form-control @error('oldPassword') is-invalid @enderror"
                            id="exampleFormControlInput1" placeholder="Old Password..." name="oldPassword"
                            value="{{ old('oldPassword') }}">
                        @error('oldPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                            id="exampleFormControlInput1" placeholder="New Password..." name="newPassword"
                            value="{{ old('newPassword') }}">
                        @error('newPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
                            id="exampleFormControlInput1" placeholder="Confirm Password..." name="confirmPassword"
                            value="{{ old('confirmPassword') }}">
                        @error('confirmPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="submit" value="Change" class="btn btn-primary">
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
