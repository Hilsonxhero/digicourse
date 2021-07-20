<?php

namespace Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Media\Models\Media;
use Media\Services\MediaFileService;

class MediaController extends Controller
{
    public function download($media, Request $request)
    {
        $media = Media::find($media);
//        dd($media);

        if (!$request->hasValidSignature()) {
            abort(401);
        }
        return MediaFileService::stream($media);
    }
}
