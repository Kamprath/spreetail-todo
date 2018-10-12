<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'priority', 'due_at'];

    /**
     * @var bool
     */
    public $timestamps = true;

    public function subtasks(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'task_id', 'id');
    }

    public static function getAll(): Collection
    {
        return self::query()
            ->with(['subtasks', 'comments'])
            ->get();
    }
}