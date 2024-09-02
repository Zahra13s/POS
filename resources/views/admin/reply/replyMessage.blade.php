@extends('admin.layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="card p-3">
            <form action="{{ route('messageReply') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            @if ($contact->image)
                                <img src="{{ asset('defaultImg/defaultProductImg.avif') }}" id="output" alt=""
                                    class="img-thumbnail">
                            @else
                                <img src="{{ asset('defaultImg/noreport.jpg') }}" id="output" alt=""
                                    class="img-thumbnail">
                            @endif
                            <input type="hidden" name="contactId" value="{{$contact->id}}">
                            <input type="hidden" name="userId" value="{{$contact->user_id}}">
                            <p>Subject: <span class="ml-3">{{ $contact->subject }}</span></p>
                            <p>Message: <span class="ml-3">{{ $contact->message }}</span></p>
                        </div>
                    </div>
                    <div class="col">
                        <h1 class="text-center">Reply Form</h1>
                        <div class="form-group mt-3">
                            <label for="exampleInputEmail1">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleInputPassword1">Message</label>
                            <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
