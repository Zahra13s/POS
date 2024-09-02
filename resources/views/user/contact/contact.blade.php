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
        <div class="card p-3">
            <form action="{{ route('contact') }}" method="POST" enctype="multipart/form-data">
                @csrf
               <div class="row">
                <div class="col">
                    <input type="hidden" name="userId" value="{{ Auth()->user()->id }}">
                    <div class="form-group">
                        <img src="{{ asset('defaultImg/defaultProductImg.avif') }}" id="output" alt=""
                            class="img-thumbnail">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" class="form-control" onchange="loadFile(event)">
                    </div>
                </div>
                <div class="col">
                    <h1 class="text-center">Contact Form</h1>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputPassword1">Message</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Send</button>
                </div>
               </div>
            </form>
        </div>
    </div>
@endsection
