@extends('layouts.masterLayout')

@section('title','Change Password')

@section('content')

<div class="container mt-5">

    <div class="card mx-auto shadow" style="max-width:500px">

        <div class="card-header bg-primary text-white">
            <h3>Change Password</h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form method="POST"
                  action="{{ route('employee.password.update') }}">

                @csrf

                <div class="mb-3">

                    <label>Current Password</label>

                    <input
                        type="password"
                        name="current_password"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>New Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control">

                </div>

                <button class="btn btn-primary">

                    Change Password

                </button>

            </form>

        </div>

    </div>
</div>
@endsection