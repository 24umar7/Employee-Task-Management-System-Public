<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
// Show Assign Task Page
    public function showAssignTask($id)
    {
        $employee = User::find($id);

        if (!$employee) {
            return redirect()->route('admin.dashboard')
                    ->with('error', 'Employee not found.');
        }

        return view('admin.assignTask', compact('employee'));
    }

// Assign Task
    public function assignTask(Request $request)
    {
        Task::create([
            'userId'      => $request->userId,
            'title'       => $request->title,
            'description' => $request->description,
            'deadline'    => $request->deadline,
            'status'      => 'Pending',
        ]);
        return back()->with('success', 'Task assigned successfully.');
    }

// View Tasks of an Employee
    public function viewTasks($id)
    {
        $employee = User::with('tasks')->find($id);

        if (!$employee) {
            return redirect()->route('admin.dashboard')
                    ->with('error', 'Employee not found.');
        }

        return view('admin.viewTask', compact('employee'));
    }


    // Show Edit Task Page
    public function showEditTask($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('admin.dashboard')
                    ->with('error', 'Task not found.');
        }

        return view('admin.editTask', compact('task'));
    }

    
    // Update Task
    public function updateTask(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('admin.dashboard')
                    ->with('error', 'Task not found.');
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;

        $task->save();

        return redirect()->route('task.view', $task->userId)
                ->with('success', 'Task updated successfully.');
    }

    // Delete Task
    public function deleteTask($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('admin.dashboard')
                    ->with('error', 'Task not found.');
        }

        // Store employee ID before deleting
        $userId = $task->userId;

        $task->delete();

        return redirect()->route('task.view', $userId)
                ->with('success', 'Task deleted successfully.');
    }
}