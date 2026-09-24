@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">My Tasks</h3>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add Task</a>
    </div>

    <div class="card p-4">
        @if ($tasks->isEmpty())
            <p class="text-center text-muted mb-0 py-4">
                No tasks yet. Click <strong>"+ Add Task"</strong> to create your first one.
            </p>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Name</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $task->task_name }}</td>
                                <td>{{ Str::limit($task->description, 40) ?: '—' }}</td>
                                <td>{{ $task->due_date ? $task->due_date->format('M d, Y') : '—' }}</td>
                                <td>
                                    <span class="badge badge-status {{ $task->status === 'Completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ $task->status }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                            Mark as {{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
