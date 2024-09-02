@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Admin List</h6>
                    </div>
                    <div class="">
                        <a href="{{ route('createAdminAccount') }}"><i class="fa-solid fa-plus"></i> Add Admin</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('adminList') }}" class="btn btn-secondary">Admin List <span
                            class="badge badge-secondary">{{ $data->total() }}</span></a>
                    <a href="{{ route('userList') }}" class="btn btn-secondary ml-3">User List <span
                            class="badge badge-secondary">{{ $userCount }}</span></a>
                </div>
                {{-- search --}}
                <div class="col-4 offset-8">
                    <div class="input-group mb-3">
                        <form action="{{ route('adminList') }}" method="get">
                            <input type="text" value="{{ request('searchKey') }}" name="searchKey" class="form-control"
                                placeholder="Product name" aria-label="Recipient's username"
                                aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        @if ($item->name != null)
                                            {{ $item->name }}
                                        @else
                                            {{ $item->nickname }}
                                        @endif
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        @if (auth()->user()->role == 'superadmin')
                                            @if (auth()->user()->id != $item->id)
                                                <a href="{{ route('admindelete', $item->id) }}">
                                                    <button class="btn btn-outline-danger"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                </a>

                                                <a href="{{ route('changeUserRole', $item->id) }}">
                                                    <button class="btn btn-outline-primary"><i
                                                            class="fa-solid fa-people-arrows"></i></button>
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">{{ $data->links() }}</span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
