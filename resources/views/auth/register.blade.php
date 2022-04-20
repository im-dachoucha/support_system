@extends('layouts.master')

@section('title', 'Register')


@section('content')
    <div class="hero min-h-screen">
        <div class="hero-content flex-col w-full">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Register</h1>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form action="{{ route('auth.register') }}" method="POST" class="card-body">
                    @csrf
                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="text" id="email" placeholder="email" name="email" class="input input-bordered"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="username">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" name="username" id="username" placeholder="username"
                            value="{{ old('username') }}" class="input input-bordered">
                        @error('username')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="password">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" id="password" name="password" placeholder="**********"
                            class="input input-bordered">
                        @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-control">
                        <label class="label" for="password_confirmation">
                            <span class="label-text">Confirm your Password</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="**********" class="input input-bordered">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <p class="text-gray-500 text-sm text-center">Already have an account?
                        <a href="{{ route('auth.login') }}" class="link link-primary">Login</a>
                    </p>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
