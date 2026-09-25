<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>
    <style>
        :root {
            --bg: #0b0b0b;
            --bg-soft: #121212;
            --panel: #171717;
            --panel-alt: #1f1b12;
            --gold: #f4c95d;
            --gold-deep: #c99b1e;
            --gold-soft: rgba(244, 201, 93, 0.14);
            --text: #f7f3e8;
            --muted: #d8cba4;
            --border: rgba(244, 201, 93, 0.25);
            --danger: #ef4444;
            --pending-bg: rgba(244, 201, 93, 0.16);
            --pending-text: #f7d76d;
            --done-bg: rgba(73, 222, 128, 0.14);
            --done-text: #a7f3d0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top, rgba(244, 201, 93, 0.22), transparent 35%),
                linear-gradient(135deg, #050505, #12100d 35%, #0f0f0f 100%);
            color: var(--text);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        h1 {
            margin: 0;
            font-size: 2.5rem;
            color: var(--gold);
            letter-spacing: 0.04em;
        }

        .subtitle {
            color: var(--muted);
            margin-top: 8px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.1fr 2.2fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        .card {
            background: linear-gradient(180deg, rgba(23, 23, 23, 0.98), rgba(17, 15, 12, 0.98));
            padding: 24px;
            border-radius: 18px;
            border: 1px solid var(--border);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(244, 201, 93, 0.08);
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 18px;
            font-size: 1.4rem;
            color: var(--gold);
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #f5df9e;
        }

        input, textarea, select, button {
            font: inherit;
        }

        input, textarea, select {
            width: 100%;
            border: 1px solid rgba(244, 201, 93, 0.35);
            border-radius: 12px;
            padding: 12px 14px;
            background: rgba(15, 15, 15, 0.9);
            color: var(--text);
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(244, 201, 93, 0.15);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .btn {
            border: none;
            border-radius: 12px;
            padding: 12px 18px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .btn:hover { transform: translateY(-1px); filter: brightness(1.05); }

        .btn-primary {
            background: linear-gradient(135deg, var(--gold), var(--gold-deep));
            color: #111;
        }

        .btn-secondary {
            background: rgba(244, 201, 93, 0.12);
            color: var(--gold);
            border: 1px solid rgba(244, 201, 93, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            color: #fff;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            text-align: left;
            padding: 14px 12px;
            border-bottom: 1px solid rgba(244, 201, 93, 0.15);
            vertical-align: top;
        }

        th {
            background: rgba(244, 201, 93, 0.08);
            color: var(--gold);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        td {
            color: #f4efe5;
        }

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .badge.pending {
            background: var(--pending-bg);
            color: var(--pending-text);
        }

        .badge.completed {
            background: var(--done-bg);
            color: var(--done-text);
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .status-form {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .status-form select {
            width: auto;
            min-width: 120px;
            padding: 8px 10px;
        }

        .status-form button {
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            background: rgba(244, 201, 93, 0.18);
            color: var(--gold);
            cursor: pointer;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 18px;
            border: 1px solid transparent;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.12);
            border-color: rgba(34, 197, 94, 0.4);
            color: #bbf7d0;
        }

        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #fecaca;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 20px;
        }

        .empty {
            padding: 22px;
            text-align: center;
            color: var(--muted);
            background: rgba(244, 201, 93, 0.04);
            border: 1px dashed rgba(244, 201, 93, 0.28);
            border-radius: 12px;
        }

        @media (max-width: 880px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <div>
                <h1>Personal Task Manager</h1>
                <div class="subtitle">Stay organized, meet deadlines, and track progress.</div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-box">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid">
            <section class="card">
                <h2>Add New Task</h2>
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="task_name">Task Name</label>
                        <input id="task_name" name="task_name" type="text" value="{{ old('task_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Task</button>
                </form>
            </section>

            <section class="card">
                <h2>Task List</h2>

                @if ($tasks->isEmpty())
                    <div class="empty">
                        No tasks added yet. Create your first task to get started.
                    </div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td><strong>{{ $task->task_name }}</strong></td>
                                        <td>{{ $task->description ?: 'No description provided.' }}</td>
                                        <td>
                                            <span class="badge {{ strtolower($task->status) == 'completed' ? 'completed' : 'pending' }}">
                                                {{ $task->status }}
                                            </span>
                                        </td>
                                        <td>{{ $task->due_date->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="actions">
                                                <form method="POST" action="{{ route('tasks.status', $task) }}" class="status-form">
                                                    @csrf
                                                    <select name="status" aria-label="Update status">
                                                        <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                    <button type="submit">Update</button>
                                                </form>

                                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary">Edit</a>

                                                <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </div>
    </div>
</body>
</html>
