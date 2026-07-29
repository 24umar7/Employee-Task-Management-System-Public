<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // Employee Dashboard
    public function dashboard()
    {
        $user = User::with('tasks')->find(Auth::id());

        return view('employee.dashboard', compact('user'));
    }

    // Complete Task
    public function completeTask(Request $request)
    {
        $task = Task::find($request->taskId);

        if (!$task) {
            return back()->with('error', 'Task not found.');
        }

        if (!$request->hasFile('screenshot')) {
            return back()->with('error', 'Please upload a screenshot.');
        }

        $file = $request->file('screenshot');

        $fileName = time() . "_" . $file->getClientOriginalName();

        $file->move(public_path('uploads/task_screenshots'), $fileName);

        $task->status = "Completed";
        $task->screenshot = $fileName;

        $task->save();

        return back()->with('success', 'Task completed successfully.');
    }

    // Update Screenshot
    public function updateScreenshot(Request $request)
    {
        $task = Task::find($request->taskId);

        if (!$task) {
            return back()->with('error', 'Task not found.');
        }

        if (!$request->hasFile('screenshot')) {
            return back()->with('error', 'Please upload a screenshot.');
        }

        // Delete old screenshot if it exists
        if ($task->screenshot) {

            $oldImage = public_path('uploads/task_screenshots/' . $task->screenshot);

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        // Upload new screenshot
        $file = $request->file('screenshot');

        $fileName = time() . "_" . $file->getClientOriginalName();

        $file->move(public_path('uploads/task_screenshots'), $fileName);

        $task->screenshot = $fileName;

        // Status remains Completed
        $task->save();

        return back()->with('success', 'Screenshot updated successfully.');
    }

public function showChangePassword()
{
    return view('employee.changePassword');
}

 public function changePassword(Request $request)
 {
    $request->validate([
        'current_password'=> 'required',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = Auth::user();

     // Check if current password is correct
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    // Update password
    $user->password = Hash::make($request->password);

    $user->save();

    // return back()->with('success', 'Password changed successfully.');

     Auth::logout();

      return redirect()->route('login')
            ->with('success', 'Password changed successfully. Please login again.');

}
}
