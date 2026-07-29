@extends('layouts.masterLayoutSecond')
@section('title')
Login
@endsection

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">
                        Employee Task Management System
                    </h3>
                </div>
                <div class="card-body p-4">
                    <h4 class="text-center mb-4">
                        Login
                    </h4>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST"
                          action="{{ route('login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <hr>
                            <a href="{{ route('google.login') }}"
                            class="btn btn-danger w-100">
                                Login with Google
                            </a>
                            <a href="{{ route('github.login') }}"
                            class="btn btn-dark w-100 mt-2">
                                Login with GitHub
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection