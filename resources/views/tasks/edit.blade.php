<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            margin: 0;
            background:
                radial-gradient(circle at top, rgba(244, 201, 93, 0.22), transparent 22%),
                linear-gradient(135deg, #050505, #12100d 35%, #0f0f0f 100%);
            font-family: Arial, sans-serif;
            color: #f7f3e8;
        }

        .container {
            max-width: 760px;
            margin: 60px auto;
            padding: 24px;
        }

        .card {
            background: linear-gradient(180deg, rgba(23, 23, 23, 0.98), rgba(17, 15, 12, 0.98));
            border: 1px solid rgba(244, 201, 93, 0.3);
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(244, 201, 93, 0.08);
            padding: 28px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 24px;
            color: #f4c95d;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #f5df9e;
        }

        input, textarea, select, button {
            font: inherit;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(244, 201, 93, 0.35);
            background: rgba(15, 15, 15, 0.9);
            color: #f7f3e8;
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #f4c95d;
            box-shadow: 0 0 0 3px rgba(244, 201, 93, 0.15);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .inline-actions {
            display: flex;
            gap: 12px;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .btn {
            border: none;
            border-radius: 12px;
            padding: 12px 18px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #f4c95d, #c99b1e);
            color: #111;
        }

        .btn-secondary {
            background: rgba(244, 201, 93, 0.12);
            color: #f4c95d;
            border: 1px solid rgba(244, 201, 93, 0.3);
        }

        .alert {
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.4);
            color: #bbf7d0;
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Edit Task</h1>

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="task_name">Task Name</label>
                    <input id="task_name" name="task_name" type="text" value="{{ old('task_name', $task->task_name) }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}" required>
                </div>

                <div class="inline-actions">
                    <button type="submit" class="btn btn-primary">Update Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
