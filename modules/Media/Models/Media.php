<?php

namespace Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Media\Services\MediaFileService;

class Media extends Model
{

    protected $casts = [
        'files' => 'json'
    ];
    use HasFactory;

    public function thumb()
    {
        return MediaFileService::thumb($this);
    }
    protected static function booted()
    {
        static::deleting(function ($media) {
            MediaFileService::delete($media);
        });
    }
}
