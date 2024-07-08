@extends('layouts.app')

@section('title')
    Login
@endsection

@section('style')
    <style>
        .register-input {
            border: 1px solid #A50000;
            border-color: #A50000;
        }

        .register-input:focus {
            box-shadow: 0 0 10px #E39292;
            border-color: #E39292;
        }
    </style>
@endsection

@section('content')
    <div class="row mx-auto d-flex align-items-center justify-content-center w-50 mt-5 card" style="height: 70vh;">
        {{-- <div class="col-md-4"> --}}
        <div class="d-flex justify-content-center align-item-center my-3">
            <form action="{{ route('auth.login') }}" class="col-md-12 row d-flex justify-content-center align-item-center"
                method="POST">
                @csrf
                <h2 class="text-center">Login</h2>
                <div class="col-md-12 mb-2">
                    <input class="form-control register-input" placeholder="Username/Email" name="email" value="{{session('email')}}">
                </div>
                <div class="col-md-12 mb">
                    <input type="password" class="form-control register-input" placeholder="Kata Sandi" name="password">
                    <p><small>Lupa kata sandi? <a href="#" style="text-decoration: none; color: #A50000;">Ganti kata
                                sandi.</a></small></p>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <button class="btn btn-md text-light col-md-4" style="background-color: #A50000; ">Masuk</button>

                </div>
                <div class="col-md-12 text-center">
                    <p class="">
                        <small>Belum punya akun? <a href="{{route('auth.register')}}"
                                style="text-decoration: none; color: #A50000;">Daftar</a><small>

                    </p>
                </div>
            </form>
        </div>
        {{-- </div> --}}
    </div>
@endsection
