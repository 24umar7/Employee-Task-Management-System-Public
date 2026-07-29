@extends('layouts.masterLayout')

@section('title')
Admin Dashboard
@endsection

@section('nameofdashboard')
Admin Dashboard
@endsection

@section('content')
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Registered Employees</h3>
        </div>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Assign Task</th>
                    <th>View Tasks</th>
                    <th>Delete Employee</th>
                </tr>
            </thead>

            <tbody>

                @forelse($employees as $employee)

                    <tr>

                        <td>{{ $employee->userId }}</td>

                        <td>{{ $employee->username }}</td>

                        <td>{{ ucfirst($employee->role) }}</td>

                        <td>
                            <a href="{{ route('task.assign.form', $employee->userId) }}""
                               class="btn btn-primary btn-sm">
                                Assign Task
                            </a>
                        </td>

                        <td>
                            <a href="{{ route('task.view', $employee->userId) }}"
                               class="btn btn-success btn-sm">
                                View Tasks
                            </a>
                        </td>

                        <td>
                            <a href="{{ route('employee.delete', $employee->userId) }}"
                               class="btn btn-danger btn-sm">
                                Delete
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            No employees found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

        <a href="{{ route('employee.register') }}"
           class="btn btn-success">
            Register New Employee
        </a>

    </div>

@endsection

