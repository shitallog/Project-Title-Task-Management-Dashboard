<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} {{ Auth::guard('admin')->user()->name }} - ({{ Auth::guard('admin')->user()->email }})
        </h2>
    </x-slot>
<style>
    .custom-task-btn {
        background-color: #28a745;
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 50px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: background-color 0.3s ease;
    }

    .custom-task-btn:hover {
        background-color: #218838;
    }
</style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
					
		<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('tasks.create') }}" class="custom-task-btn">
        <i class="bi bi-plus-lg me-2"></i> Add Task button 
    </a>
</div>

                </div>
            </div>
        </div>
    </div>
	
	
	
</x-admin-layout>
