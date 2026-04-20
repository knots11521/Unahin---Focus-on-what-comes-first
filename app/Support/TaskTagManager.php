<?php

namespace App\Support;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class TaskTagManager
{
    public function __construct(
        private readonly Task $task
    ) {
    }

    /**
     * @return \Illuminate\Support\Collection<int, array{id:int,name:string,color:string,weight:int}>
     */
    public function all(): Collection
    {
        return collect($this->ids())
            ->map(fn (int $id) => Tags::details($id))
            ->filter();
    }

    /**
     * @return list<int>
     */
    public function ids(): array
    {
        if ($this->task->relationLoaded('tagAssignments')) {
            return Tags::normalize(
                $this->task->tagAssignments->pluck('tag_id')->all()
            );
        }

        return Tags::normalize(
            $this->task->tagAssignments()->pluck('tag_id')->all()
        );
    }

    /**
     * @param  array<int, int|string>|null  $tagIds
     */
    public function sync(?array $tagIds): void
    {
        $tagIds = Tags::normalize($tagIds);
        $current = $this->ids();

        $toDelete = array_diff($current, $tagIds);
        $toInsert = array_diff($tagIds, $current);

        if ($toDelete !== []) {
            $this->task->tagAssignments()
                ->whereIn('tag_id', $toDelete)
                ->delete();
        }

        if ($toInsert !== []) {
            $timestamp = Carbon::now();

            $this->task->tagAssignments()->createMany(
                collect($toInsert)->map(static fn (int $tagId) => [
                    'tag_id' => $tagId,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ])->all()
            );
        }

        $this->task->unsetRelation('tagAssignments');
    }
}
