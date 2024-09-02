@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- productsTales Example -->
        <div class="card shadow mb-4 col-12">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Products Page</h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('profileUpdate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            {{-- image --}}
                            <div class="mb-3">
                                <input type="hidden" name="oldImage" value="{{ auth()->user()->profile }}">
                                @if (auth()->user()->profile == null)
                                    <img src="{{ asset('admin/img/undraw_profile.svg') }}" id="output" alt=""
                                        class="img-thumbnail">
                                @else
                                    <img src="{{ asset('adminProfile/' . auth()->user()->profile) }}" id="output"
                                        alt="" class="img-thumbnail">
                                @endif
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                @error('image')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            {{-- name and price --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="Name..." name="name"
                                            value=" {{ auth()->user()->name == null ? auth()->user()->nickname : auth()->user()->name }}">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="text" @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="Price..." name="email"
                                            value="{{ auth()->user()->email }}">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- category id and product count --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="phone..." name="phone"
                                            value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="address..." name="address"
                                            value="{{ auth()->user()->address }}">
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->provider == 'simple')
                                <a href="{{ route('changePassword') }}">Change Password?</a>
                            @endif

                            <input type="submit" value="Update" class="btn btn-primary">


                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
