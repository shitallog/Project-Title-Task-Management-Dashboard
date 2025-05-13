<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} {{ Auth::user()->name }}
        </h2>
    </x-slot>

   <div class="container">

  <div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $task->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="pending" {{ old('status', $task->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in-progress" {{ old('status', $task->status ?? '') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
        <option value="completed" {{ old('status', $task->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Due Date</label>
    <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date ?? '') }}">
</div>

</div>
	</div>
</x-app-layout>
