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
        <h1 class="text-center text-white display-6">Profile</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Profile</li>
        </ol>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card">
            <div class="col-8 offset-2">
                <div class="row">
                    <div class="col-8 offset-2">
                        @if ($account->profile)
                            <img src="{{ asset('userProfile/' . $account->profile) }}" alt="" class="w-100">
                        @else
                            <img src="{{ asset('admin/img/undraw_posting_photo.svg') }}" alt="" class="w-100">
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 d-flex justify-content-between">
                        <p>Name</p>
                        <p>
                            @if ($account->name)
                                {{ $account->name }}
                            @else
                                {{ $account->nickname }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-10 offset-1 d-flex justify-content-between">
                        <p>Email</p>
                        <p>
                            {{ $account->email }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-10 offset-1 d-flex justify-content-between">
                        <p>Phone Number</p>
                        <p>
                            @if ($account->phone)
                                {{ $account->phone }}
                            @else
                                No Data Yet
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-10 offset-1 d-flex justify-content-between">
                        <p>Address</p>
                        <p>
                            @if ($account->address)
                                {{ $account->address }}
                            @else
                                No Data Yet
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-4 offset-4">
                        <a href="{{ route('userProfileDetails', auth()->user()->id) }}"
                            class="btn border border-secondary rounded-pill px-3 text-primary">Update Profile</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
