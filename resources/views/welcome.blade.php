@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @include('includes.message')
    <div class="row">
        <div class="col-6">
            <h3>Sign Up</h3>
            <form method="post" action="{{route('signup')}}">
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                    <label for="label">Your E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{ Request::old('email')}}"> 
                </div>
                 <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
                    <label for="label">Your First Name</label>
                    <input class="form-control" type="text" name="first_name" id="first_name" value="{{ Request::old('first_name')}}" > 
                </div>
                 <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label for="label">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password')}}"> 
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>

        </div>

        <div class="col-6">
            <h3>Sign In</h3>
            <form method="post" action="{{route('signin')}}">
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                    <label for="label">Your E-mail</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email')}}"> 
                </div>
                 <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                    <label for="label">Your Password</label>
                    <input class="form-control" type="password" name="password" id="password"> 
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}" value="{{ Request::old('password')}}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </div>
    </div>
@endsection