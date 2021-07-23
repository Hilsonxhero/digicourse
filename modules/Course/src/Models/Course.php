<?php

namespace Course\Models;

use Category\Models\Category;
use Course\Repositories\CourseRepo;
use Discount\Models\Discount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Media\Models\Media;
use Payment\Models\Payment;
use User\Models\User;

class Course extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'position',
        'price',
        'percent',
        'teacher_id',
        'status',
        'type',
        'category_id',
        'category_id',
        'banner_id',
        'body',
        'banner'
    ];
    const TYPE_FREE = 'free';
    const TYPE_CASH = 'cash';
    static $types = [self::TYPE_CASH, self::TYPE_FREE];

    const TYPE_COMPLETED = 'completed';
    const TYPE_NOT_COMPLETED = 'not-completed';
    const TYPE_LOCKED = 'lock';
    static $statuses = [self::TYPE_COMPLETED, self::TYPE_NOT_COMPLETED, self::TYPE_LOCKED];
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_REJECTED, self::CONFIRMATION_STATUS_PENDING];
    use HasFactory;

    public function getTeacherName()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDuration()
    {
        return (new CourseRepo())->geDuration($this->id);
    }

    public function getDiscountPercent()
    {
        return 0;
    }

    public function getDiscountAmount()
    {
        return 0;
    }

    public function getFinalPrice()
    {
        return $this->price - $this->getDiscountAmount();
    }

    public function formattedDuration()
    {
        $duration = $this->getDuration();
        $h = round($duration / 60) < 10 ? '0' . round($duration / 60) : round($duration / 60);
        $m = ($duration % 60) < 10 ? '0' . ($duration % 60) : ($duration % 60);
        return $h . ':' . $m . ":00";
    }

    public function lessonsCount()
    {
        return (new CourseRepo())->getLessonsCount($this->id);
    }

    public function path()
    {
        return route('course.page.show', $this->slug);
    }

    public function hasStudent($student_id)
    {
        return resolve(CourseRepo::class)->hasStudent($this, $student_id);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, "paymentable");
    }
    public function discounts(){
        return $this->morphToMany(Discount::class,"discountable");
    }

    public function payment()
    {
        return $this->payments()->latest()->first();
    }

}
