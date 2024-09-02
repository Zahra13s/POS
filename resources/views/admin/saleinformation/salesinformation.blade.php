@extends('admin.layouts.master')

@section('content')

      <!-- Begin Page Content -->
      <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Sales Information</h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Date</th>
                                <th>Count</th>
                                <th>Amount</th>
                                <th>Order Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                <tr>
                                    <td class="col-2">
                                        <img src="{{asset('productImage/'.$item->product_img)}}" alt="" class="w-100">
                                    </td>
                                    <td>{{$item->product_name}}</td>
                                    <td>
                                        @if($item->user_name)
                                        {{$item->user_name}}
                                        @else
                                        {{$item->nickname}}
                                        @endif
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->count}}</td>
                                    <td>{{$item->total_price}}</td>
                                    <td>{{$item->order_code}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">
                        {{$order->links()}}
                    </span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
