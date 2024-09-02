@extends('user.layouts.master')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <form action="{{ route('shopList') }}" method="get">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" value="{{ request('searchKey') }}" name="searchKey"
                                            class="form-control" placeholder="Product name"
                                            aria-label="Recipient's username" aria-describedby="button-addon2">
                                        <button class="input-group-text p-3" type="submit"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            @foreach ($category as $item)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('shopList', $item->id) }}"><i
                                                                class="fa-solid fa-utensils me-2"></i>{{ $item->name }}</a>
                                                        <span></span>
                                                    </div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        <form action="{{ route('shopList') }}" method="get">
                                            <div class="row">
                                                <div class="col-4"><input type="text" name="minPrice" id=""
                                                        value="{{ request('minPrice') }}" class="form-control"
                                                        placeholder="Minimun Price"></div>
                                                <div class="col-4"><input type="text" name="maxPrice" id=""
                                                        value="{{ request('maxPrice') }}" class="form-control"
                                                        placeholder="Maximum Price"></div>
                                                <div class="col-4"><input type="submit" value="Filter"
                                                        class="btn btn-secondary"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @foreach ($product as $item)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <a href="{{ route('shopDetails', $item->id) }}">
                                                <div class="fruite-img">
                                                    <img src="{{ asset('productImage/' . $item->image) }}"
                                                        class="img-fluid w-100 rounded-top" alt=""
                                                        style="height: 250px; object-fit:cover;">
                                                </div>
                                            </a>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">{{ $item->category_name }}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $item->name }}</h4>
                                                <p>{{ Str::words($item->description, 10, '...') }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">{{ $item->price }}</p>
                                                    <a href="{{ route('shopDetails', $item->id) }}"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa-solid fa-circle-info me-2 text-primary"></i>
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        {{ $product->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
