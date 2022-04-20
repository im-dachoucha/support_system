@extends('layouts.master')

@section('title', 'Login')


@section('content')
    <div class="hero min-h-[80vh]">
        <div class="hero-content flex-col w-full">
            @error('message')
                <div class="alert alert-error shadow-lg max-w-md">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                </div>
            @enderror
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Login</h1>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form action="{{ route('auth.login') }}" method="POST" class="card-body">
                    @csrf
                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="text" id="email" placeholder="email" name="email" class="input input-bordered"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="  text-red-500 text-sm">{{ $message }}</p>
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
                    <p class="text-gray-500 text-sm text-center">Dont't have an account?
                        <a href="{{ route('auth.register') }}" class="link link-primary">Register</a>
                    </p>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
