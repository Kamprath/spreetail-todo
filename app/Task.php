<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Task extends Model
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
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d')
        ];
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'task_id', 'id');
    }

    /**
     * Get all tasks as API data
     *
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return self::query()
            ->with('comments')
            ->get()
            ->map(function(Task $task) {
                return $task->toApi();
            });
    }
}