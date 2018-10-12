<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = true;

    public $id;

    public $task_id;

    public $text;

    public $created_at;

    public $updated_at;
}
