@extends('layouts.app')
@section('title', 'Admin Panel')
@section('content')
    <div class="col-lg-12 text-center">
        <h2>Chat</h2>
        <span style="color: green">
            @if (isset($successMSG))
                {{ $successMSG }}
            @endif
        </span>
        <span style="color: red">
            @if (isset($errorMSG))
                {{ $errorMSG }}
            @endif
        </span>

    </div>
    {{-- <br>{{$customer}} --}}
    <div class="shadowedBorderedContainer">
        @foreach ($customer->conversations as $conversation)
            @if ($conversation->status == 'received')
                <div class="float-start">
                    <p style="text-align: left"><b>{{ $customer->Phone }}</b></p>
                    <p style="text-align: left;">{{ $conversation->conversation }}</p>

                </div><br><br><br>
            @elseif ($conversation->status == 'sent')
                <div class="float-end">
                    <p style="text-align: right;"><b>Me</b></p>
                    <p style="text-align: right;">{{ $conversation->conversation }}</p>

                </div><br><br><br>
            @endif
        @endforeach
        <form id="msgForm" action="{{ route('sendSMS') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="customer_id" id="customer_id" value="{{$customer->customer_id}}">
            <input type="hidden" name="phone" id="phone" value="{{$customer->Phone}}">
            <div class="form-group">

                <textarea class="form-control" id="message" rows="2" name="message" form="msgForm"></textarea>
                @error('message')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div><br>
            <input type="submit" class="btn btn-info" value="Send">
        </form>
    </div><br>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection
