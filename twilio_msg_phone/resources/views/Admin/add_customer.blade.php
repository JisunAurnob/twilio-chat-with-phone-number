@extends('layouts.app')
@section('title', 'Admin Panel')
@section('content')
    <div class="col-lg-12 text-center">
        <h2>Add Customer</h2>
    </div>
    <div class="row justify-content-center align-content-center" style="height: 80vh">
        <div class="col-lg-6">
            <form action="{{route('addCustomer')}}" class="col-md-6" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter Customer Phone Number" value="{{old('phone')}}" class="form-control">
                    @error('phone')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div><br>
                <input type="submit" class="btn btn-success" value="Add">
            </form>
    </div>
    <br><br>
@endsection
