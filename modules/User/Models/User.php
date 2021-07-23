<?php

namespace User\Models;

use Course\Models\Course;
use Course\Models\Lesson;
use Course\Models\Season;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Media\Models\Media;
use Payment\Models\Payment;
use Payment\Models\Settlement;
use RolePermissions\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use User\Notifications\ResetPasswordRequestNotification;
use User\Notifications\VerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BAN = 'ban';

    public static $statuses = [
        self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_BAN
    ];

    public static $defaultUsers = [
        [
            'email' => 'admin@gmail.com',
            'phone' => '090000000',
            'name' => 'Admin',
            'is_superuser' => 1,
            'password' => 'admin4030',
            'role' => Role::ROLE_SUPER_ADMIN
        ]
    ];
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'status',
        'phone',
        'thumb_id',
        'is_superuser',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());

    }

    public function sendResetPasswordRequestNotification()
    {

        $this->notify(new ResetPasswordRequestNotification());

    }

    public function isSuperUser()
    {
        return $this->is_superuser;
    }

    public function thumb()
    {
        return $this->belongsTo(Media::class, 'thumb_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'buyer_id');
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function isVerify()
    {
        return $this->hasVerifiedEmail() ? '<span class="text-success">فعال</span>' : '<span class="text-error">غیرفعال</span>';
    }

    public function image()
    {
        if ($this->thumb) {
            return '/storage/' . $this->thumb->files[300];
        } else {
            return asset('panel/assets/img/profile.jpg');
        }
    }

    public function studentsCount()
    {
        return \DB::table('courses')->select('course_id')->where('teacher_id', $this->id)
            ->join("course_user", 'courses.id', "=", "course_user.course_id")->count();
    }

    public function getCreateAtInJalali()
    {
        return verta($this->created_at)->format('%d %B %Y');
    }

    public function hasAccessToCourse($course)
    {
        if ($this->can('manage', Course::class) ||
            $this->id === $course->teacher_id ||
            $course->students->contains($this->id)
        ) return true;
        return false;
    }



}
