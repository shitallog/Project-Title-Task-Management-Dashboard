
<!DOCTYPE html>
<html>
<head>
    <title>Task Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Task Details</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <strong>{{ $task->title }}</strong>
            </div>
            <div class="card-body">
                <p><strong>Description:</strong> {{ $task->description }}</p>
                <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
                <p><strong>Created At:</strong> {{ $task->created_at->format('d M Y, h:i A') }}</p>
                <p><strong>Last Updated:</strong> {{ $task->updated_at->diffForHumans() }}</p>
            </div>
        </div>

        <a href="{{ route('tasks.index') }}" class="btn btn-primary mt-3">Back to Task List</a>
    </div>
</body>
</html>


