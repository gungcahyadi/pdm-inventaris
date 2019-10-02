@extends('layouts.auth') 
@section('content')
<div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
    <div class="row w-100">
        <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                        <label class="label">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                        @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif 
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="*********">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary submit-btn btn-block">Login</button>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <div class="form-check form-check-flat mt-0">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}> Keep me signed in
                            </label>
                        </div>
                    </div>
                    <div class="text-block text-center my-3">
                        <span class="text-small font-weight-semibold">Not a member ?</span>
                        <a href="{{ url('/register') }}" class="text-black text-small">Create new account</a>
                    </div>
                </form>
            </div>
            <ul class="auth-footer">
            </ul>
            <p class="footer-text text-center">copyright © 2019. Created by Gung Cahyadi.</p>
        </div>
    </div>
</div>

@endsection