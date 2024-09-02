@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card">
            <div class="col-8 offset-2">
                <div class="row">
                    <div class="col-8 offset-2">
                        <img src="{{ asset('admin/img/undraw_posting_photo.svg') }}" alt="" class="w-100">
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

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
