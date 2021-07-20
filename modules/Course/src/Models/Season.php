<?php

namespace Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Models\User;

class Season extends Model
{
    protected $fillable = [
        'course_id',
        'user_id',
        'title',
        'position',
        'confirmation_status',
    ];
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_REJECTED, self::CONFIRMATION_STATUS_PENDING];

    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons()
    {
        return $this->hasMany(Season::class);
    }

    public function confiramation_status()
    {
        switch ($this->confirmation_status) {
            case Season::CONFIRMATION_STATUS_PENDING:
                return '<span class="text-warning">در حال انتظار</span>';
                break;
            case Season::CONFIRMATION_STATUS_ACCEPTED:
                return '<span class="text-success">تایید شده</span>';
                break;
            case Season::CONFIRMATION_STATUS_REJECTED:
                return '<span class="text-error">رد شده</span>';
                break;
        }
    }
}
