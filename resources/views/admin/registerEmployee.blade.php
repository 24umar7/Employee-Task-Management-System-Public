@extends('layouts.masterLayout')
@section('title')
Register Employee
@endsection

@section('nameofdashboard')
Admin Dashboard
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width:500px;">
            <div class="card-header bg-primary text-white">
                <h3>Register Employee</h3>
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
                <form method="POST" action="{{ route('employee.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" >
                       <span class="text-danger">
                        @error('username')
                        {{ $message }}
                        @enderror
                        </span>
                    </div>
                  <div class="mb-3">
                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password"  name="password" class="form-control" >
                        <span class="text-danger">
                        @error('password')
                        {{ $message }}
                        @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                        <span class="text-danger">
                        @error('confirm_password')
                        {{ $message }}
                        @enderror
                        </span>
                    </div>
                    <button class="btn btn-primary">
                        Register Employee
                    </button>
                   <a href="{{ route('admin.dashboard') }}"
                    class="btn btn-secondary">
                        Back
                    </a>
            </form>
        </div>
    </div>
</div>
</body>
</html>

@endsection