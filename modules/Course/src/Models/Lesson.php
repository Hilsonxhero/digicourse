<?php

namespace Course\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Media\Models\Media;
use User\Models\User;

class Lesson extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'time',
        'free',
        'position',
        'season_id',
        'course_id',
        'user_id',
        'media_id',
        'body',
        'confirmation_status'
    ];
    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [self::CONFIRMATION_STATUS_ACCEPTED, self::CONFIRMATION_STATUS_REJECTED, self::CONFIRMATION_STATUS_PENDING];
    use HasFactory;


    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
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

    public function path()
    {

    }

//    public function is_free()
//    {
//        return $this->free;
//    }

    public function downloadLink()
    {
        return \URL::temporarySignedRoute('media.download', now()->addDay(), ['media' => $this->media]);
    }
}
