<?php

namespace Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User\Models\User;

class Settlement extends Model
{
    protected $guarded = [];

    protected $casts = [
        "to" => "json",
        "from" => "json",
        'settled_at' => 'datetime'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_CANCELED = 'canceled';
    const STATUS_SETTLED = 'settled';
    const STATUS_REJECTED = 'rejected';


    public static $statuses = [
        self::STATUS_PENDING,
        self::STATUS_CANCELED,
        self::STATUS_SETTLED,
        self::STATUS_REJECTED
    ];

    use HasFactory;



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        switch ($this->status) {
            case Settlement::STATUS_PENDING:
                return '<span class="text-warning">در حال انتظار</span>';
                break;
            case Settlement::STATUS_SETTLED:
                return '<span class="text-success">تسویه شده</span>';
                break;
            case Settlement::STATUS_REJECTED:
                return '<span class="text-error">رد شده</span>';
                break;
            case Settlement::STATUS_CANCELED:
                return '<span class="text-error">کنسل شده</span>';
                break;
        }
    }
}
