@extends('layouts.masterLayout')

@section('title')
Employee Dashboard
@endsection

@section('nameofdashboard')
Employee Dashboard
@endsection

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            Welcome, {{ ucfirst(Auth::user()->username)}}
        </h2>

    </div>

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

    @if($user->tasks->isEmpty())

        <div class="alert alert-warning">
            No tasks assigned yet.
        </div>

    @else

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Action</th>
                <th>Screenshot</th>
            </tr>

        </thead>

        <tbody>

        @foreach($user->tasks as $task)

        <tr>

            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->deadline }}</td>
            <td>

                @if($task->status == "completed")

                    <span class="badge bg-success">
                        Completed
                    </span>
                @else
                    <span class="badge bg-warning text-dark">
                        Pending
                    </span>

                @endif

            </td>

            <td>

                @if($task->status == "pending")

                <form action="{{ route('task.complete') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="taskId" value="{{ $task->taskId }}">
                    <input type="file" name="screenshot" class="form-control mb-2" accept="image/*" required>
                    <button class="btn btn-success btn-sm">
                        Mark Completed
                    </button>
                </form>
                @else

                <form action="{{ route('task.screenshot.update') }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="taskId" value="{{ $task->taskId }}">
                    <input type="file" name="screenshot" class="form-control mb-2" required>
                    <button class="btn btn-primary btn-sm">
                        Update Screenshot
                    </button>
                </form>
                @endif
            </td>
            <td>
                @if($task->screenshot)
                <img
                src="{{ asset('uploads/task_screenshots/'.$task->screenshot) }}"
                width="120">
                @else
                    No Screenshot
                @endif
            </td>
        </tr>
        @endforeach
        
        </tbody>
    </table>
    <a href="{{ route('employee.password.form') }}"
   class="btn btn-warning">
    Change Password
</a>
    @endif
</div>
</body>
</html>
@endsection