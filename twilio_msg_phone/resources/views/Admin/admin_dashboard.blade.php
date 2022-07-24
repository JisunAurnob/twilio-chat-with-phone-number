@extends('layouts.app')
@section('title', 'Admin Panel')
@section('content')
    <div class="col-lg-12 text-center">
        <h2>Admin Dashboard</h2>
        {{-- {{dd(Auth::user())}} --}}
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
    <div class="row" style="height: 80vh">
        <div class="col-lg-3">
            <div style="height: 500px; overflow: auto; border-style: none;">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td id="{{ $customer->customer_id }}" onclick="msgVisible(this.innerHTML)">{{ $customer->Phone }}</td>
                                <td><a href="/chat/{{$customer->customer_id}}" class="btn btn-primary">Send Message</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="msgDiv" class="col-lg-5 token-hidden">
            <div style="height: 500px; overflow: auto; border-style: none;">
                    <form id="" action="{{route('sendSMS')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="msg">Message</label>
                            <input type="hidden" name="phone" id="phone" value="">
                            <input type="text" name="msg" id="msg" placeholder="Enter Your Message" value="" class="form-control">
                            @error('message')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div><br>
                        <input type="submit" class="btn btn-success" value="Send">
                    </form>
                
            </div>
        </div>
        <br><br>
        <script>
            function msgVisible(phone) {
        document.getElementById("msgDiv").style.display = "block";
        document.getElementById("phone").value = phone;
}
        </script>
    @endsection
