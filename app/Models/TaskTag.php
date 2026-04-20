<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskTag extends Model
{
    protected $table = 'tag_task';

    public $incrementing = false;

    protected $fillable = [
        'task_id',
        'tag_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'task_id' => 'integer',
        'tag_id' => 'integer',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
