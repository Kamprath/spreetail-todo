<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Task extends Model implements ApiModelInterface
{
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * Convert model to API-safe data
     *
     * @return array Returns an array of model data
     */
    public function toApi(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => (int) $this->status,
            'priority' => (int) $this->priority,
            'due_at' => $this->due_at
                ? (new \DateTime($this->due_at))->format('Y-m-d')
                : null,
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d'),
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d'),
            'subtasks' => collect($this->subtasks)->map(function (SubTask $subtask) {
                return $subtask->toApi();
            }),
            'color_class' => $this->color_class
        ];
    }

    /**
     * Get all tasks as API data
     *
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return self::query()
            ->with('subtasks')
            ->get()
            ->map(function(Task $task) {
                return $task->toApi();
            });
    }

    /**
     * Get all SubTasks that belong to the Task.
     *
     * @return HasMany
     */
    public function subtasks(): HasMany
    {
        return $this->hasMany(SubTask::class, 'task_id', 'id');
    }
}