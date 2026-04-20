<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use App\Support\Tags;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SystemTagsTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_creation_syncs_system_tag_ids_only(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('tasks.store'), [
            'title' => 'Ship focus mode',
            'description' => 'Refactor the task system',
            'priority' => 'high',
            'effort_level' => 'hard',
            'tags' => [Tags::WORK, Tags::CODING, Tags::URGENT],
        ]);

        $response->assertRedirect(route('tasks.index'));

        $task = Task::firstOrFail();

        $tagIds = $task->fresh()->tagIds;
        sort($tagIds);

        $expected = [Tags::WORK, Tags::CODING, Tags::URGENT];
        sort($expected);

        $this->assertSame($expected, $tagIds);

        $this->assertDatabaseHas('tag_task', [
            'task_id' => $task->id,
            'tag_id' => Tags::WORK,
        ]);
    }

    public function test_task_creation_rejects_unknown_tag_ids(): void
    {
        $user = User::factory()->create();

        $response = $this->from(route('tasks.create'))
            ->actingAs($user)
            ->post(route('tasks.store'), [
                'title' => 'Invalid tag payload',
                'priority' => 'medium',
                'effort_level' => 'easy',
                'tags' => [999],
            ]);

        $response->assertRedirect(route('tasks.create'));
        $response->assertSessionHasErrors('tags.0');

        $this->assertDatabaseCount('tasks', 0);
        $this->assertDatabaseCount('tag_task', 0);
    }
}
