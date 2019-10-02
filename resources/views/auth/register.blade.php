@extends('layouts.auth') @section('content')
<div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
    <div class="row w-100">
        <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4 text-light">Register</h2>
            <div class="auto-form-wrapper">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('nama_petugas') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_petugas" value="{{ old('nama_petugas') }}" required placeholder="Fullname">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div> 
                        @if ($errors->has('nama_petugas'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama_petugas') }}</strong>
                        </span>
                        @endif                       
                    </div>
                    <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" required placeholder="Username">
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
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" required placeholder="Password">
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
                        <div class="input-group">
                            <input type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary submit-btn btn-block">Register</button>
                    </div>
                    <div class="text-block text-center my-3">
                        <span class="text-small font-weight-semibold">Already have and account ?</span>
                        <a href="{{ url('/login') }}" class="text-black text-small">Login</a>
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