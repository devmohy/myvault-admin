<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PreviewFileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $storageConfig = config('filesystems.default');
    
        if ($storageConfig === 's3') {
            return response()->json([
                'path' => $request->file_path,
                'url' => Storage::temporaryUrl($request->file_path, now()->addMinutes(10))
            ]);
        } else {
            return response()->json([
                'path' => $request->file_path,
                'url' => asset($request->file_path)
            ]);
        }
    }
}
