@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Order Board</h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>User Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($order as $item)
                                <tr>
                                    <input type="hidden" name="" class="orderCode" value="{{ $item->order_code }}">
                                    <td>{{ $item->created_at->format('j-m-Y') }}</td>
                                    <td><a
                                            href="{{ route('userOrderdetails', $item->order_code) }}">{{ $item->order_code }}</a>
                                    </td>
                                    <td>
                                        @if ($item->user_name != null)
                                            {{ $item->user_name }}
                                        @else
                                            {{ $item->nickname }}
                                        @endif
                                    </td>

                                    <td>
                                        <select name=""
                                            class="form-control

                                statusChange">
                                            <option value="0" @if ($item->status == 0) selected @endif
                                                class="text-warning">Pending</option>
                                            <option value="1" @if ($item->status == 1) selected @endif
                                                class="text-success">Approved</option>
                                            <option value="2" @if ($item->status == 2) selected @endif
                                                class="text-danger">Denied</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">
                        {{ $order->links() }}
                    </span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@section('js-section')
    <script>
        $(document).ready(function() {
            $(".statusChange").change(function() {
                console.log("Change Event Running")
                $currentStatus = $(this).val();
                $orderCode = $(this).parents("tr").find(".orderCode").val();
                console.log($orderCode);

                $data = {
                    'status': $currentStatus,
                    'order_code': $orderCode
                }

                $.ajax({
                    type: 'get',
                    url: 'change/status',
                    data: $data,
                    dataType: 'json'
                })
            })
        })
    </script>
@endsection
