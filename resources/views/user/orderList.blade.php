@extends('user.layouts.master')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">OrderList</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">OrderList</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">Order Code</th>
                            <th scope="col">Date</th>
                            <th scope="col">Price</th>
                            <th scope="col">Order Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order as $item)
                            <tr>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->order_code }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->created_at->format('j-m-Y') }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->total_price }}</p>
                                </td>
                                <td>
                                    @if ($item->status == 0)
                                        <button class="btn btn-warning">Pending</button>
                                    @elseif ($item->status == 1)
                                        <button class="btn btn-success">Approved</button>
                                    @elseif($item->status == 2)
                                        <button class="btn btn-danger">Denied</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
