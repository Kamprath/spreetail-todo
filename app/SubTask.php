<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubTask extends Model implements ApiModelInterface
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
            'task_id' => $this->task_id,
            'text' => $this->text,
            'is_complete' => (bool) $this->is_complete
        ];
    }

    /**
     * Get the parent task.
     *
     * @return BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
