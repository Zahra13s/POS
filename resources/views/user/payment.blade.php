@extends('user.layouts.master')

@section('css-section')
    <style>
        /* form */
        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .background {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
@endsection
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
        <h1 class="text-center text-white display-6">Payment</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Payment</li>
        </ol>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="card mb-2">
                <div class="card-header text-center">
                    Payment Informations
                </div>
                <div class="card-body">
                    <p>Order Code: {{ $orderProduct[0]['order_code'] }}</p>
                    <p>Total Price: {{ $total + 3000 }}</p>
                </div>
            </div>
            <div class="col">
                @foreach ($payment as $item)
                    <div class="card mb-2">
                        <div class="card-header">
                            {{ $item->type }}
                        </div>
                        <div class="card-body">
                            <p>Account Name: {{ $item->account_name }}</p>
                            <p>Account No.: {{ $item->account_number }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col">
                <div class=".background">
                    <form action="{{ route('orderProduct') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="fname">Name</label>
                        <input type="text" id="fname" name="name" placeholder="Name.."
                            class="@error('name') is-invalid @enderror">
                        @error('name')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                        <label for="lname">Account No.</label>
                        <input type="text" id="lname" name="phone" placeholder="Account Name.."
                            class="@error('phone') is-invalid @enderror">
                        @error('phone')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                        <label for="country">Payment Method</label>
                        <select id="country" name="paymentMethod" class="@error('paymentMethod') is-invalid @enderror">
                            @foreach ($payment as $item)
                                <option value="{{ $item->id }}">{{ $item->type }}</option>
                            @endforeach
                        </select>
                        @error('paymentMethod')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                        <label for="lname">Paymet Screenshot</label>
                        <input type="file" id="lname" name="payslipImg" placeholder="Account Name.."
                            class="@error('payslipImg') is-invalid @enderror">
                        @error('payslipImg')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                        <input type="hidden" name="orderCode" value="{{ $orderProduct[0]['order_code'] }}">
                        <input type="hidden" name="totalAmount" value="{{ $total + 3000 }}">
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
