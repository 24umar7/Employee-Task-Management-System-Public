@extends('layouts.masterLayout')

@section('title')
Edit Task
@endsection

@section('nameofdashboard')
Admin Dashboard
@endsection

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-warning">

                    <h3>Edit Task</h3>

                </div>

                <div class="card-body">

                    @if(session('error'))

                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>

                    @endif

                    <form method="POST" action="{{ route('task.update', $task->taskId) }}">

        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Task Title

                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                value="{{ $task->title }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="4"
                                required>{{ $task->description }}</textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Deadline

                            </label>

                            <input
                                type="date"
                                name="deadline"
                                class="form-control"
                                value="{{ $task->deadline }}"
                                required>

                        </div>

                        <div class="d-flex justify-content-between">

                           <a href="{{ route('task.view', $task->userId) }}"
                            class="btn btn-secondary">
                                Cancel
                            </a>

                            <button class="btn btn-primary">

                                Update Task

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>

@endsection