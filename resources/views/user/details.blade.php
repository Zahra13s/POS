@extends('user.layouts.master')


@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 offset-2">
                    <a href="{{ route('shopList') }}"><button class="btn btn-outline-success mb-2"><i
                                class="fa-solid fa-arrow-left me-2"></i> Back</button></a>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('productImage/' . $product->image) }}"
                                        class="img-fluid rounded img-thumbnail" alt="Image" height="250px"
                                        style="object-fit: cover">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $product->name }}
                            </h4>
                            <p class="mb-3">Category: {{ $product->category_name }}</p>
                            <p>{{ $product->category_id }}</p>
                            <h5 class="fw-bold mb-3">{{ $product->price }} MMK</h5>
                            <div class="d-flex mb-4">
                                @php $stars = number_format($productRating) @endphp
                                @for ($i = 1; $i <= $stars; $i++)
                                    <i class="fa fa-star text-secondary"> </i>
                                @endfor
                                @for ($j = $stars + 1; $j <= 5; $j++)
                                    <i class="fa fa-star "> </i>
                                @endfor
                                <span>/ {{ $ratingCount->count() }}Ratings</span>
                            </div>
                            <p class="mb-4">{{ $product->description }}</p>
                            <form action="{{ route('addToCart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="qty"
                                        class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </button>

                            </form>
                            {{-- rating start --}}
                            {{-- <button type="button"
                            class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"
                            @if ($ratingStatus != null)
                            disabled
                            @endif
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-face-smile me-2 text-primary"></i> Rate This Product
                        </button> --}}

                            <button type="button"
                                class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-face-smile me-2 text-primary"></i> Rate This Product
                            </button>
                            <!-- Vertically centered modal -->

                            <!-- Button trigger modal -->
                            <form action="{{ route('addRating') }}" method="post">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                <input type="hidden" name="userId" value="{{ auth()->user()->id }}">


                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card card-body mb-2">
                                                    <div class="rating-css">
                                                        <div class="star-icon">
                                                            @if ($userRating != 0)
                                                                @php $stars = number_format($userRating) @endphp
                                                                @if ($userRating)
                                                                    @for ($i = 1; $i <= $userRating; $i++)
                                                                        <input type="radio" value={{ $i }}
                                                                            name="productRating" checked
                                                                            id="rating{{ $i }}">
                                                                        <label for="rating{{ $i }}"
                                                                            class="fa fa-star checked"></label>
                                                                    @endfor

                                                                    @for ($j = $userRating + 1; $j <= 5; $j++)
                                                                        <input type="radio" value={{ $j }}
                                                                            name="productRating"
                                                                            id="rating{{ $j }}">
                                                                        <label for="rating{{ $j }}"
                                                                            class="fa fa-star"></label>
                                                                    @endfor
                                                                @endif
                                                            @else
                                                                <input type="radio" value="1" name="productRating"
                                                                    checked id="rating1">
                                                                <label for="rating1" class="fa fa-star"></label>
                                                                <input type="radio" value="2" name="productRating"
                                                                    id="rating2">
                                                                <label for="rating2" class="fa fa-star"></label>
                                                                <input type="radio" value="3" name="productRating"
                                                                    id="rating3">
                                                                <label for="rating3" class="fa fa-star"></label>
                                                                <input type="radio" value="4" name="productRating"
                                                                    id="rating4">
                                                                <label for="rating4" class="fa fa-star"></label>
                                                                <input type="radio" value="5" name="productRating"
                                                                    id="rating5">
                                                                <label for="rating5" class="fa fa-star"></label>
                                                            @endif

                                                            {{-- @endif --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Rate</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            {{-- rating end  --}}
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-about" aria-controls="nav-about"
                                        aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p>{{ $product->description }} </p>

                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">

                                    @foreach ($comment as $item)
                                        <div class="d-flex">
                                            @if ($item->user_profile != null)
                                                <img src="{{ asset('userProfile/' . $item->user_profile) }}"
                                                    class="img-fluid rounded-circle p-3"
                                                    style="width: 100px; height: 100px;" alt="">
                                            @else
                                                <img src="{{ asset('customer/img/avatar.jpg') }}"
                                                    class="img-fluid rounded-circle p-3"
                                                    style="width: 100px; height: 100px;" alt="">
                                            @endif
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">{{ $item->created_at }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>
                                                        @if ($item->user_name == null)
                                                            {{ $item->nickname }}
                                                        @else
                                                            {{ $item->name }}
                                                        @endif
                                                    </h5>
                                                </div>
                                                <p>{{ $item->message }} </p>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach

                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor
                                        sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="message" id="" class="form-control border-0 @error('message') is-invalid @enderror"
                                            cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                        @error('message')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        {{-- <div class="d-flex align-items-center">
                                                <p class="mb-0 me-3">Please rate:</p>
                                                <div class="d-flex align-items-center" style="font-size: 12px;">
                                                    <i class="fa fa-star text-muted"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div> --}}
                                        <input type="submit"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3"
                                            value="Post Comment">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">

                    @foreach ($productList as $item)
                        @if ($item->category_name == $product->category_name && $product->id != $item->id)
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <a href="{{ route('shopDetails', $item->id) }}">
                                        <img src="{{ asset('productImage/' . $item->image) }}"
                                            class="img-fluid w-100 rounded-top" alt=""
                                            style="height: 250px; object-fit:cover;">
                                    </a>
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">{{ $item->category_name }}</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>{{ $item->name }}</h4>
                                    <p>{{ Str::words($item->description, 10, '...') }}</p>
                                    <div class="d-flex flex-column flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">{{ $item->price }} mmk</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach


                    @foreach ($productList as $item)
                        @if ($item->category_name != $product->category_name && $product->id != $item->id)
                            <div class="border border-primary rounded position-relative vesitable-item">
                                <div class="vesitable-img">
                                    <a href="{{ route('shopDetails', $item->id) }}"><img
                                            src="{{ asset('productImage/' . $item->image) }}"
                                            class="img-fluid w-100 rounded-top" alt=""
                                            style="height: 250px; object-fit:cover;"></a>
                                </div>
                                <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">{{ $item->category_name }}</div>
                                <div class="p-4 pb-0 rounded-bottom">
                                    <h4>{{ $item->name }}</h4>
                                    <p>{{ Str::words($item->description, 10, '...') }}</p>
                                    <div class="d-flex flex-column flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold">{{ $item->price }} mmk</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
