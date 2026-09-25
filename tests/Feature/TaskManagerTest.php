<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_a_task(): void
    {
        $response = $this->post('/tasks', [
            'task_name' => 'Write project summary',
            'description' => 'Prepare the final project update for review.',
            'status' => 'Pending',
            'due_date' => '2026-10-05',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Write project summary',
            'status' => 'Pending',
        ]);
    }

    public function test_user_can_update_task_status(): void
    {
        $task = Task::create([
            'task_name' => 'Submit assignment',
            'description' => 'Upload the assignment before the deadline.',
            'status' => 'Pending',
            'due_date' => '2026-10-03',
        ]);

        $response = $this->put('/tasks/' . $task->id, [
            'task_name' => 'Submit assignment',
            'description' => 'Upload the assignment before the deadline.',
            'status' => 'Completed',
            'due_date' => '2026-10-03',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'Completed',
        ]);
    }

    public function test_user_can_delete_a_task(): void
    {
        $task = Task::create([
            'task_name' => 'Review notes',
            'description' => 'Read the revised chapter notes.',
            'status' => 'Pending',
            'due_date' => '2026-10-08',
        ]);

        $response = $this->delete('/tasks/' . $task->id);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
