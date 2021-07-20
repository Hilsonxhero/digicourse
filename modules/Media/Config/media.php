<?php
return [
    "MediaTypeServices" => [
        "image" => [
            "extensions" => [
                "png", "jpg", "jpeg"
            ],
            "handler" => \Media\Services\ImageFileService::class
        ],
        "video" => [
            "extensions" => [
                "mp4", "avi"
            ],
            "handler" => \Media\Services\VideoFileService::class
        ],
        "zip" => [
            "extensions" => [
                "rar", "zip"
            ],
            "handler" => \Media\Services\ZipFileService::class
        ]
    ]
];
