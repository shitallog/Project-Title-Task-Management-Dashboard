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
        margin-top: 40px;
    }

    h2 {
        margin-bottom: 25px;
        font-weight: 600;
    }

    .form-group label {
        font-weight: 500;
    }

    .form-control {
        margin-bottom: 15px;
    }

    .btn-primary {
        padding: 8px 20px;
    }

    .alert-success {
        font-size: 14px;
    }
</style>

<div class="container">
    <h2>Create New Task</h2>

    {{-- Show validation errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in-progress" {{ old('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label>Due Date</label>
            <input type="date" name="due_date" class="form-control" value="{{ old('due_date') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary ml-2">Cancel</a>
    </form>
</div>