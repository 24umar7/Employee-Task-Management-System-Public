@extends('layouts.masterLayoutSecond')

@section('title', 'Reset Password')

@section('content')



<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:500px">

        <div class="card-header bg-primary text-white">
            <h3>Reset Password</h3>
        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form method="POST"
                  action="{{ route('password.update') }}">

                @csrf

                <!-- Reset Token -->
                <input type="hidden"
                       name="token"
                       value="{{ $token }}">

                <!-- Email -->
                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ $email }}"
                        readonly>

                </div>

                <!-- New Password -->
                <div class="mb-3">

                    <label>New Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required>

                </div>

                <!-- Confirm Password -->
                <div class="mb-3">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required>

                </div>


                <button class="btn btn-success w-100">

                    Reset Password

                </button>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            </form>

        </div>

    </div>

</div>

@endsection