<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class FileService
{
    protected $defaultExtensions = ['pdf', 'jpeg', 'jpg', 'png', 'avi', 'mov', 'quicktime', 'mp4', 'kml', 'kmz'];

    /**
     * Store uploaded file
     */
    public function store(Request $request, string $folderPath, string $inputName, int $allowedFileSize = 2 * 1024 * 1024, array $allowedExt = [])
    {
        $ext = !empty($allowedExt) ? $allowedExt : $this->defaultExtensions;

        try {
            if ($request->ajax() && $request->hasFile($inputName)) {
                return storeMedia($request, $folderPath, $ext, $inputName, $allowedFileSize);
            }

            return response()->json([
                'status' => false,
                'message' => 'Invalid Request'
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'status' => false,
                'message' => 'OOPS, Something went wrong, please try again later'
            ]);
        }
    }

    /**
     * View file
     */
    public function viewFile(?string $pathName, ?string $fileName, ?string $fallbackRoute = null)
    {
        if (empty($pathName) || empty($fileName) || $pathName === 'null' || $fileName === 'null') {
            return response()->json([
                'success' => false,
                'message' => 'File not found or invalid parameters.'
            ], 400);
        }

        $file = viewFilePath($pathName) . urldecode($fileName);

        if (file_exists($file)) {
            return Response::make(file_get_contents($file), 200, [
                "Content-Type"              => mime_content_type($file),
                "Content-Length"            => filesize($file),
                "Content-Disposition"       => "inline; filename=" . basename($file),
                "Cache-Control"             => "public",
                "Content-Description"       => "File Transfer",
                "Content-Transfer-Encoding" => "binary"
            ]);
        }

        if ($fallbackRoute) {
            return redirect()->route($fallbackRoute);
        }

        return response()->json([
            'success' => false,
            'message' => 'File not found'
        ], 404);
    }
}
