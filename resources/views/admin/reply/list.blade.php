@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Image</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($contact as $item)
                                <tr>
                                    <td class="col-2">
                                        @if ($item->user_name)
                                            {{ $item->user_name }}
                                        @else
                                            {{ $item->nickname }}
                                        @endif
                                    </td>
                                    <td class="col-2"></td>
                                    <td class="col-3">{{ $item->subject }}</td>
                                    <td class="col-4">{{ $item->message }}</td>
                                    <td>
                                        <a href="{{route('replyMessage',$item->id, $item->user_id)}}"><button class="btn btn-primary">Reply</button></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- <span class="d-flex justify-content-end">{{ $data->links() }}</span> --}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
