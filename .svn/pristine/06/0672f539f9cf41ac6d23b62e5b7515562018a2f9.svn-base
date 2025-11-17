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
                if ($request->hasFile('upload_file')) {
                    return storeMedia($request, 'uploads/employee/training/', $ext, 'upload_file');
                }
                if ($request->hasFile('upload_profile')) {
                    return storeMedia($request, 'uploads/employee/profile/', $ext, 'upload_profile');
                }
                if ($request->hasFile('upload_signature')) {
                    //dd($request->all());
                    return storeMedia($request, 'uploads/employee/signature/', $ext, 'upload_signature');
                }
                if ($request->hasFile('upload_dob_proof')) {
                    return storeMedia($request, 'uploads/employee/dob_proof/', $ext, 'upload_dob_proof');
                }
                if ($request->hasFile('upload_resume')) {
                    return storeMedia($request, 'uploads/employee/resume/', $ext, 'upload_resume');
                }
                if ($request->hasFile('upload_pancard')) {
                    return storeMedia($request, 'uploads/employee/pancard/', $ext, 'upload_pancard');
                }
                if ($request->hasFile('upload_aadhar')) {
                    return storeMedia($request, 'uploads/employee/aadhar/', $ext, 'upload_aadhar');
                }
                if ($request->hasFile('upload_address')) {
                    return storeMedia($request, 'uploads/employee/address/', $ext, 'upload_address');
                }
                if ($request->hasFile('upload_degree_files')) {
                    return storeMedia($request, 'uploads/employee/degree/', $ext, 'upload_degree_files');
                }
                if ($request->hasFile('experience_certificate')) {
                    return storeMedia($request, 'uploads/employee/experience_certificate/', $ext, 'experience_certificate');
                }
                if ($request->hasFile('training_certificate')) {
                    return storeMedia($request, 'uploads/employee/training_certificate/', $ext, 'training_certificate');
                }
                if ($request->hasFile('upload_salary_slip')) {
                    return storeMedia($request, 'uploads/employee/salary_slip/', $ext, 'upload_salary_slip');
                }
                if ($request->hasFile('upload_offer_letter')) {
                    return storeMedia($request, 'uploads/employee/offer_letter/', $ext, 'upload_offer_letter');
                }
                if ($request->hasFile('upload_nda_agreement')) {
                    return storeMedia($request, 'uploads/employee/nda_agreement/', $ext, 'upload_nda_agreement');
                }
                if ($request->hasFile('upload_background_verification')) {
                    return storeMedia($request, 'uploads/employee/background_verification/', $ext, 'upload_background_verification');
                }
                if ($request->hasFile('upload_disciplinary_status')) {
                    return storeMedia($request, 'uploads/employee/disciplinary_status/', $ext, 'upload_disciplinary_status');
                }
                if ($request->hasFile('upload_vigilance_clearance')) {
                    return storeMedia($request, 'uploads/employee/vigilance_clearance/', $ext, 'upload_vigilance_clearance');
                }
                if ($request->hasFile('upload_medical_fitness')) {
                    return storeMedia($request, 'uploads/employee/medical_fitness/', $ext, 'upload_medical_fitness');
                }
                if ($request->hasFile('upload_marriage_certificate')) {
                    return storeMedia($request, 'uploads/employee/marriage_certificate/', $ext, 'upload_marriage_certificate');
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