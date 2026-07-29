@extends('layouts.masterLayout')
@section('title')
View Assigned Tasks
@endsection

@section('nameofdashboard')
Admin Dashboard
<a href="{{ route('admin.dashboard') }}" class="btn btn-light position-absolute end-0 top-50 translate-middle-y me-5">
    Back
</a>
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">
        Tasks of {{ ucfirst($employee->username) }}
    </h2>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if($employee->tasks->isEmpty())
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
            @foreach($employee->tasks as $task)
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
                    <a href="{{ route('task.edit.form', $task->taskId) }}"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    <a href="{{ route('task.delete', $task->taskId) }}"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this task?')">
                        Delete
                    </a>
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
    @endif
</div>
</body>
</html>

@endsection