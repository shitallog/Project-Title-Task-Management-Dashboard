<x-app-layout>
    <x-slot name="header">
       <div class="modal fade" id="taskModal">
  <div class="modal-dialog">
    <form id="taskForm">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Add Task</h5></div>
        <div class="modal-body">
          <input name="title" class="form-control mb-2" placeholder="Title" required>
          <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
          <select name="status" class="form-control mb-2">
            <option value="pending">Pending</option>
            <option value="in-progress">In Progress</option>
            <option value="completed">Completed</option>
          </select>
          <input type="date" name="due_date" class="form-control mb-2">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetchTasks();

    document.getElementById('taskForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = new FormData(this);
        fetch('/api/tasks', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: form
        })
        .then(res => res.json())
        .then(task => {
            alert('Task added!');
            fetchTasks();
        });
    });
});

function fetchTasks() {
    fetch('/api/tasks')
    .then(res => res.json())
    .then(tasks => {
        const table = document.getElementById('taskTable');
        table.innerHTML = '';
        tasks.forEach(task => {
            table.innerHTML += `
                <tr>
                    <td>${task.title}</td>
                    <td>${task.status}</td>
                    <td>${task.due_date ?? '-'}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteTask(${task.id})">Delete</button>
                    </td>
                </tr>`;
        });
    });
}

function deleteTask(id) {
    fetch(`/api/tasks/${id}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    })
    .then(() => fetchTasks());
}

</script>

</x-app-layout>
