@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <div class="row">
            <div class="col-4">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="">
                            <div class="">
                                <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('createPayment') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Type</label>
                                <input type="text" class="form-control @error('type') is-invalid @enderror"
                                    id="exampleFormControlInput1" placeholder="Account Type..." name="type"
                                    value="{{ old('type') }}">
                                @error('type')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Account Name</label>
                                <input type="text" class="form-control @error('accName') is-invalid @enderror"
                                    id="exampleFormControlInput1" placeholder="Account Name..." name="accName"
                                    value="{{ old('accName') }}">
                                @error('accName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Account Number</label>
                                <input type="text" class="form-control @error('accNo') is-invalid @enderror"
                                    id="exampleFormControlInput1" placeholder="Account Number..." name="accNo"
                                    value="{{ old('accNo') }}">
                                @error('accNo')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>


                            <input type="submit" value="Create" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Acc Name</th>
                            <th scope="col">Acc No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>

                                <td>{{ $item->type }}</td>
                                <td>{{ $item->account_name }}</td>
                                <td>{{ $item->account_number }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
