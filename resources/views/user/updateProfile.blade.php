@extends('user.layouts.master')

@section('content')
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Update Profile</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Update Profile</li>
        </ol>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid mt-2">

<div class="row">
    <div class="col-8 offset-2">

        <!-- productsTales Example -->
        <div class="card shadow mb-4 col-12">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Products Page</h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('userprofileUpdate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            {{-- image --}}
                            <div class="mb-3">
                                <input type="hidden" name="oldImage" value="{{ auth()->user()->profile }}">
                                @if (auth()->user()->profile == null)
                                    <img src="{{ asset('admin/img/undraw_profile.svg') }}" id="output" alt=""
                                        class="img-thumbnail">
                                @else
                                    <img src="{{ asset('userProfile/' . auth()->user()->profile) }}" id="output"
                                        alt="" class="img-thumbnail">
                                @endif
                                <input type="file" name="image"
                                    class="form-control mt-2 @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                @error('image')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-8">
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

                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="phone..." name="phone"
                                            value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>

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

                            <a href="{{ route('changeUserPassword') }}">Change Password</a>
                            <input type="submit" value="Update" class="btn btn-primary">


                        </div>

                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
    </div>

    </div>
    <!-- /.container-fluid -->
@endsection
