<?php

namespace Discount\Models;

use Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function courses()
    {
        $this->morphedByMany(Course::class, "discountable");
    }
}
