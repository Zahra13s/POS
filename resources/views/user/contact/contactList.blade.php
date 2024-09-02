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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> Image </th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Stauts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contact as $item)
                    <tr>
                        <td class="row col-2">
                            @if ($item->image)
                                <img src="{{ asset('defaultImg/', $item->image) }}" alt="" class="w-50">
                            @else
                                <img src="{{ asset('defaultImg/noreport.jpg') }}" alt="" class="w-50">
                            @endif
                        </td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->message }}</td>
                        <td>
                            @if ($item->id == $reply->contact_id)
                                <a href="{{route('contactReply',$item->id)}}">
                                    <button
                                        class="btn border-secondary rounded-pill px-2 py-1 text-primary text-uppercase">Reply</button>
                                </a>
                            @else
                                <button
                                    class="btn border-secondary rounded-pill px-2 py-1 text-danger text-uppercase disabled">No
                                    Reply Yet</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
