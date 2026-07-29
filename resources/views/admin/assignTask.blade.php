@extends('layouts.masterLayout')
@section('title')
Assign Task
@endsection

@section('css')

<style>body{
    background:#f8f9fa;
}
.task-container{
    max-width:550px;
    margin:40px auto;
}</style>

@endsection

@section('nameofdashboard')
Admin Dashboard
@endsection

@section('content')
    <div class="task-container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">
                            Assign Task</h3>
                         </div>
                         <div class="card-body">
                            <p class="text-center">
                                Assigning to:
                                <strong>{{ $employee->username }}</strong>
                             </p>
                              @if(session('success'))
                              <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('task.assign') }}">
                    @csrf
                        <input type="hidden" name="userId" value="{{ $employee->userId }}"> <div class="mb-3">
                            <label class="form-label">
                                Task Title
                            </label>
                        <input type="text" name="title" class="form-control" required></div>
                        <div class="mb-3">
                            <label class="form-label">
                                Description
                            </label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                Deadline
                            </label>
                            <input type="date" name="deadline" class="form-control" required></div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.dashboard') }}"
                                class="btn btn-secondary">
                                    Back
                                </a>
                            <button
                            type="submit"
                            class="btn btn-primary">
                            Assign Task

                </button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>

@endsection