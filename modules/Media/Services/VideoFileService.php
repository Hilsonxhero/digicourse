<?php


namespace Media\Services;


use Media\Contracts\FileServiceContract;
use Media\Models\Media;

class VideoFileService extends DefaultFileService implements FileServiceContract
{
    public static function upload($file, string $filename, $dir): array
    {
        $ex = $file->getClientOriginalExtension();
        $file->move(storage_path($dir), $filename . '.' . $ex);
        return ['video' => $filename . '.' . $ex];
    }

    public static function thumb(Media $media)
    {
        return asset('panel/assets/img/video-icon.svg');
    }

    static function getFileName()
    {
        return (static::$media->is_private ? 'private/' : 'public/') . static::$media->files['video'];
    }
}
