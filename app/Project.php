<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $guarded = [];

    public function path() {
        return '/projects/' . $this->id;
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
