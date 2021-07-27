<?php

namespace Course\Models;

use Category\Models\Category;
use Course\Repositories\CourseRepo;
use Discount\Models\Discount;
use Discount\Repositories\DiscountRepo;
use Discount\Services\DiscountService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Media\Models\Media;
use Payment\Models\Payment;
use Ticket\Models\Ticket;
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

    public function payments()
    {
        return $this->morphMany(Payment::class, "paymentable");
    }

    public function discounts()
    {
        return $this->morphToMany(Discount::class, "discountable");
    }

    public function tickets()
    {
        return $this->morphMany(Ticket::class, "ticketable");
    }

    public function getDuration()
    {
        return (new CourseRepo())->geDuration($this->id);
    }

    public function getDiscount()
    {
        $discountRepo = new DiscountRepo();
        // specific Discount
        $discount = $discountRepo->getCourseBiggerDiscount($this->id);
        // global Discount
        $globalDiscount = $discountRepo->getGlobalBiggerDiscount();
        if ($discount == null && $globalDiscount == null) return null;
        if ($discount == null && $globalDiscount != null) return $globalDiscount;
        if ($discount != null && $globalDiscount == null) return $discount;
        if ($globalDiscount->percent > $discount->percent) return $globalDiscount;
        return $discount;

    }

    public function getDiscountPercent()
    {
        $discount = $this->getDiscount();
        if ($discount) return $discount->percent;
        return 0;
    }

    public function getDiscountAmount($percent = null)
    {
        if ($percent == null) {
            $discount = $this->getDiscount();
            $percent = $discount ? $discount->percent : 0;
        }
        return DiscountService::calculateDiscountAmount($this->price, $percent);
    }

    public function getFinalPrice($code = null, $withDiscounts = false)
    {
        $discount = $this->getDiscount();
        $amount = $this->price;

        $discounts = [];
        if ($discount) {
            $discounts[] = $discount;
            $amount = $this->price - $this->getDiscountAmount($discount->percent);
        }


        if ($code) {
            $repo = new DiscountRepo();
            $discountFromCode = $repo->getValidDiscountByCode($code, $this->id);
            if ($discountFromCode) {
                $discounts[] = $discountFromCode;
                $amount = $amount - DiscountService::calculateDiscountAmount($amount, $discountFromCode->percent);
            }
        }
        if ($withDiscounts)
            return [$amount, $discounts];

        return $amount;
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

    public function payment()
    {
        return $this->payments()->latest()->first();
    }

}
