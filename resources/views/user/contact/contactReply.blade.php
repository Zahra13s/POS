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
        <h1 class="text-center text-white display-6">Change Password</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Change Password</li>
        </ol>
    </div>

    <div class="container mt-3">
       @foreach ($contact as $item)
       <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    You
                </div>
                <div class="card-body">
                    <p class="text-secondaty">Subject: {{$item->subject}}</p>
                    <p class=" text-dark">Message: {{$item->message}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-6">
            <div class="card">
                <div class="card-header">
                    Admin
                </div>
                <div class="card-body">
                    <p class="text-secondaty">Subject: {{$item->reply_subject}}</p>
                    <p class=" text-dark">Reply: {{$item->reply_message}}</p>
                </div>
            </div>
        </div>
    </div>
       @endforeach

    </div>
@endsection
