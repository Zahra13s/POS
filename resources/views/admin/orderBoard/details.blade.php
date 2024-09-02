@extends('admin.layouts.master')

@section('content')
    <div class="container m-3">
        <div class="row">
            <div class="col-8 offset-2 mt-3">
                <div class="">
                    <a href="{{ route('orderBoardList') }}"><button class="btn btn-outline-primary mb-2"><i
                                class="fa-solid fa-arrow-left me-2"></i> Back</button></a>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-8 offset-2">
                <table style="width: 100%">
                    <tbody class="rounded shadow-sm">
                        <tr class="d-flex justify-content-end mb-2 px-3 pt-3">
                            <td class="pr-3">
                                Name:
                                <br>
                                Order Code:
                                <br>
                                Payment Type:
                                <br>
                                Date:
                                <br>
                                Time:

                            </td>
                            <td>
                                @if ($orderDetails[0]->user_name)
                                    {{ $orderDetails[0]->user_name }}
                                @else
                                    {{ $orderDetails[0]->nickname }}
                                @endif
                                <br>
                                {{ $orderDetails[0]->order_code }}
                                <br>
                                Kpay
                                <br>
                                {{ $orderDetails[0]->created_at->format('j-M-Y') }}
                                <br>
                                {{ $orderDetails[0]->created_at->format('h:i:s') }}
                            </td>
                        </tr>


                        <tr class="border-bottom d-flex justify-content-between mb-2 px-3 pt-3">
                            <td class="col text-start">Name</td>
                            <td class="col text-center">Qty</td>
                            <td class="col text-center">Price</td>
                            <td class="col" style="text-align: end;">Total Price</td>
                        </tr>
                        @foreach ($orderDetails as $item)
                            <tr class="d-flex justify-content-between mt-1 px-3">
                                <td class="col text-start">
                                    {{ $item->product_name }}
                                </td>
                                <td class="col text-center">
                                    {{ $item->count }}
                                </td>
                                <td class="col text-center">
                                    {{ $item->product_price }}
                                </td>
                                <td class="col" style="text-align: end;">
                                    {{ $item->total_price }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="d-flex justify-content-between border-top mt-2 px-3">
                            <td class="col text-start">
                                Total Price:
                                <br>
                                Delivery
                            </td>
                            <td class="col text-center"></td>
                            <td class="col text-center"></td>
                            <td class="col" style="text-align: end;">
                                {{ $total }}
                                <br>
                                3000
                            </td>
                        </tr>
                        <tr class="d-flex justify-content-between border-top mt-2 px-3 pb-3">
                            <td class="col text-start"> Total Price: </td>
                            <td class="col text-center"></td>
                            <td class="col text-center"></td>
                            <td class="col" style="text-align: end;">
                                {{ $total + 3000 }}
                            </td>
                        </tr>
                        <tr class="d-flex justify-content-between border-top mt-2 px-3 pb-3">
                            <td class="col text-center">
                                <!-- Button trigger modal -->
                                <button type="button"
                                    class="btn border-secondary rounded-pill px-2 py-1 text-primary text-uppercase mt-3"
                                    data-toggle="modal" data-target="#exampleModal">
                                    Tap to See Pay Slip Info
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    <img src="{{ asset('payslipRecord/' . $payslipData->payslip_image) }}"
                                                        alt="" class="w-100 rounded">
                                                    <div class="d-flex justify-content-between w-100 px-3 mt-2">
                                                        <p>Order Code</p>
                                                        <p>{{ $payslipData->order_code }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 px-3 mt-2">
                                                        <p>Total Price</p>
                                                        <p>{{ $payslipData->order_amount }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 px-3 mt-2">
                                                        <p>Account Name</p>
                                                        <p>{{ $payslipData->customer_name }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 px-3 mt-2">
                                                        <p>Payment Method</p>
                                                        <p>
                                                            {{ $payslipData->type }}


                                                        </p>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 px-3 mt-2">
                                                        <p>Account Number</p>
                                                        <p>{{ $payslipData->phone }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
@endsection
