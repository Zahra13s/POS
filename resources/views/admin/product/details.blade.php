@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-12">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Details Products Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        {{-- image --}}
                        <div class="mb-3">
                            <img src="{{ asset('productImage/' . $data->image) }}" id="output" alt=""
                                class="img-thumbnail">
                        </div>
                    </div>
                    <div class="col">
                        {{-- name and price --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                    <h5>{{ $data->name }}</h5>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product Price (mmk)</label>
                                    <h5>{{ $data->price }}</h5>
                                </div>
                            </div>
                        </div>

                        {{-- category id and product count --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product Category IDs</label>
                                    <h5>{{ $data->category_name }}</h5>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product Count</label>
                                    <h5>{{ $data->count }}</h5>
                                </div>
                            </div>
                        </div>

                        {{-- description --}}
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Product Description</label>
                            <h5>{{ $data->description }}</h5>
                        </div>

                        <a href="{{ route('productList') }}"><input type="button" value="Back" class="btn btn-primary">
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
