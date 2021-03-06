<?php


namespace Media\Contracts;


use Media\Models\Media;

interface FileServiceContract
{
    public static function upload($file, string $filename, $dir): array;

    public static function delete($media);

    public static function thumb(Media $media);
    public static function stream(Media $media);
}
