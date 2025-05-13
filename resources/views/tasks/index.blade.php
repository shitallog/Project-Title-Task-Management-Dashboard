<!-- Add Bootstrap 5 & Bootstrap Icons CDN if not already included -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .container {
        max-width: 900px;
        margin: auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 8px;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    .btn-sm {
        margin-right: 5px;
    }

    .table thead {
        background-color: #343a40;
        color: white;
    }

    .alert-success {
        font-size: 14px;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4 text-center"><i class="bi bi-list-task"></i> Task List</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Add Task
        </a>
    </div>

<div class="mb-4">
    <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap gap-3 items-center">
        <!-- Title Search -->
        <input type="text" name="title" placeholder="Search by title"
               value="{{ request('title') }}"
               class="border rounded px-3 py-2" />

        <!-- Status Filter -->
        <select name="status" class="border rounded px-3 py-2">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>

        <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 underline">
            Reset
        </a>
    </form>
</div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><i class="bi bi-pin"></i> Title</th>
                <th><i class="bi bi-file-earmark-text"></i> Description</th>
                <th><i class="bi bi-card-checklist"></i> Status</th>
                <th><i class="bi bi-calendar-event"></i> Due Date</th>
                <th><i class="bi bi-gear"></i> Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        @if($task->status === 'completed')
                            <span class="badge bg-success">{{ ucfirst($task->status) }}</span>
                        @elseif($task->status === 'in-progress')
                            <span class="badge bg-warning text-dark">{{ ucfirst($task->status) }}</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $task->due_date ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
