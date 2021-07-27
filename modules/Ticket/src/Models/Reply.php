<?php

namespace Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Media\Models\Media;
use User\Models\User;

class Reply extends Model
{

    protected $guarded = [];
    protected $table = "ticket_replies";
    const STATUS_PENDING = 'pending';
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

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function downloadLink()
    {
        if ($this->media)
            return \URL::temporarySignedRoute('media.download', now()->addDay(), ['media' => $this->media]);
    }
}
