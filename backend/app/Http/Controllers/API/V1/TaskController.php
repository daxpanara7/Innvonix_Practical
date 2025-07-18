<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Mail\TaskAssigned;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Task::with(['assignedTo', 'creator'])->where('created_by', auth()->id());

        // Optional filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->has('due_date_from') && $request->has('due_date_to')) {
            $query->whereBetween('due_date', [$request->due_date_from, $request->due_date_to]);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        return response()->json($query->orderByDesc('created_at')->paginate(10));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'priority' => 'in:low,medium,high',
            'due_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $validated['created_by'] = auth()->id();

        $task = Task::create($validated);

        // send notification to assigned user
        $assignedUser = \App\Models\User::find($task->user_id);
        if ($assignedUser && $assignedUser->email) {
            Mail::to($assignedUser->email)->send(new TaskAssigned($task));
        }

        return response()->json($task, 201);
    }

    
    public function show($id)
    {
        $task = Task::where('id', $id)
            ->where('created_by', auth()->id())
            ->with(['assignedTo', 'creator'])
            ->firstOrFail();

        return response()->json($task);
    }


    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)
            ->where('created_by', auth()->id())
            ->firstOrFail();

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'priority' => 'in:low,medium,high',
            'due_date' => 'nullable|date',
            'user_id' => 'exists:users,id',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::where('id', $id)
            ->where('created_by', auth()->id())
            ->firstOrFail();

        $task->delete();

        return response()->json(['message' => 'Task deleted']);
    }
    public function adminIndex()
    {
        return Task::with(['assignedTo', 'creator'])->orderByDesc('created_at')->paginate(10);
    }

}
