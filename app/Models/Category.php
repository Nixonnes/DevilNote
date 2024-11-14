<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'title',
    ];
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
