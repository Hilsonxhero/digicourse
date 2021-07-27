<?php

namespace Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Models\User;

class Ticket extends Model
{
    protected $guarded = [];
    const STATUS_PENDING = 'pending';
    const STATUS_ANSWERED = 'answered';
    const STATUS_OPEN = 'open';
    const STATUS_CLOSE = 'close';
    const STATUS_REJECTED = 'rejected';


    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_OPEN,
        self::STATUS_CLOSE,
        self::STATUS_REJECTED
    ];
    use HasFactory;

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function ticketable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        switch ($this->status) {
            case Ticket::STATUS_PENDING:
                return '<span class="text-warning">در حال انتظار</span>';
                break;
            case Ticket::STATUS_OPEN:
                return '<span class="text-primary">باز</span>';
                break;
            case Ticket::STATUS_ANSWERED:
                return '<span class="text-success">پاسخ داده شد</span>';
                break;
            case Ticket::STATUS_CLOSE:
                return '<span class="text-error">بسته شده</span>';
                break;
            case Ticket::STATUS_REJECTED:
                return '<span class="text-error">رد شده</span>';
                break;
        }
    }
}
