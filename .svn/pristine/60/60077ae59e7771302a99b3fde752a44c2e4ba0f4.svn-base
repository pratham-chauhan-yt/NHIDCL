<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        $ext = (isset($request->ext) && !empty($request->ext)) ? explode(',', $request->ext) : ['pdf', 'jpeg', 'jpg', 'png'];
        try {
            if ($request->ajax()) {
                if ($request->hasFile('upload_interview_call_letter_file')) {
                    return storeMedia($request, 'uploads/recruitment/applicant/', $ext, 'upload_interview_call_letter_file');
                }
                if ($request->hasFile('upload_upsc_cse_mains_score_file')) {
                    return storeMedia($request, 'uploads/recruitment/applicant/', $ext, 'upload_upsc_cse_mains_score_file');
                }

                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Request'
                ]);
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

    public function viewFiles(Request $request)
    {   
        $pathName = $request->pathName;
        $fileName = $request->fileName;
        $file = viewFilePath($pathName) . urldecode($fileName);
        if (file_exists($file)) {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: inline; filename=" . basename($file));
            header("Content-Type: " . mime_content_type($file));
            header("Content-Length: " . filesize($file));
            header("Content-Transfer-Encoding: binary");
            readfile($file);
            exit;
        } else {
            $currentUrl = $request->fullUrl();
            $referer = $request->headers->get('referer');

            if ($referer && $referer !== $currentUrl) {
                Alert::error('Sorry', 'File not found.');
                return redirect($referer)->with('error', 'File not found.');
            }
            Alert::error('Sorry', 'File not found.');
            return redirect()->back()->with('error', 'File not found.');
        }
    }

}