<?php

namespace Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function sub()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getParentName()
    {
        return is_null($this->parent) ? 'ندارد' : $this->parent->name;
    }

    public function path()
    {
        return route('categories.show', $this->id);
    }
}
