@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                    </div>
                    <div class="">
                        <a href="{{ route('productCreatePage') }}"><i class="fa-solid fa-plus"></i> Add Product</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- search --}}
                <div class="col-4 offset-8 d-flex">

                    <form action="{{ route('productList') }}" method="get">
                        <div class="input-group mb-3">
                            <input type="text" value="{{ request('searchKey') }}" name="searchKey" class="form-control"
                                placeholder="Recipient's username" aria-label="Recipient's username"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="col-2"><img src="{{ asset('productImage/' . $item->image) }}"
                                            class="img-thumbnail w-100" alt=""> </td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->count }}</td>
                                    <td>
                                        <a href="{{ route('productDetails', $item->id) }}"
                                            class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-info"></i>
                                        </a>
                                        <a href="{{ route('productEdit', $item->id) }}" class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('productDelete', $item->id) }}" class="btn btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>


                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">{{ $products->links() }}</span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
