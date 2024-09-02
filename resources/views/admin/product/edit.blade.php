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
            <form action="{{ route('productUpdate') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="productId" value="{{ $products->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            {{-- image --}}
                            <div class="mb-3">
                                <input type="hidden" name="oldImage" value="{{ $products->image }}">
                                <img src="{{ asset('productImage/' . $products->image) }}" id="output" alt=""
                                    class="img-thumbnail">
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
                                        <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="Name..." name="name"
                                            value="{{ old('name', $products->name) }}">
                                        @error('name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Product Price (mmk)</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="Price..." name="price"
                                            value="{{ old('price', $products->price) }}">
                                        @error('price')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- category id and product count --}}
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Product Category IDs</label>
                                        <select name="categoryName" id="categoryName"
                                            class="form-control @error('categoryName') is-invalid @enderror">
                                            <option value="">Choose Category Name</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (old('categoryName', $products->category_id) == $item->id) selected @endif>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categoryName')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Product Count</label>
                                        <input type="text" class="form-control @error('count') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="Count..." name="count"
                                            value="{{ old('count', $products->count) }}">
                                        @error('count')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- description --}}
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Product Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id=""
                                    cols="30" rows="5">{{ old('description', $products->description) }}</textarea>
                                @error('description')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <input type="submit" value="Update" class="btn btn-primary">


                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
