<?php

declare(strict_types=1);

use App\Models\NhidclBankGuarantee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DepartmentMaster;
use App\Models\DesignationMaster;
use App\Models\Grievance;
use App\Models\NhidclProject;
use App\Models\SmsTemplate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\NhidclTwoFactorVerification;
use Illuminate\Support\Facades\Hash;

if (! function_exists('pr')) {
    function pr($request)
    {
        echo '<pre>';
        print_r($request);
        die;
    }
}

if (! function_exists('pra')) {
    function pra($request)
    {
        pr($request->toArray());
    }
}

function getDepartmentNameById($department_master_id)
{
    $result = DepartmentMaster::where('id', $department_master_id)->first();
    return $result->name ?? '';
}


function getDesignationameById($designation_id)
{
    $result = DesignationMaster::where('id', $designation_id)->first();
    return $result->name ?? '';
}

function getOfficeTypeNameById($office_type)
{
    $result = DB::table('category_master')->where('id', $office_type)->first();
    return $result->name ?? '';
}


function getStateByNameId($state_id)
{
    $result = DB::table('state_master')->where('id', $state_id)->first();
    return $result->name ?? '';
}


function getUserStatusId($userid_status)
{
    $userid_status_data = '';
    $result = DB::table('users')->where('userid_status', $userid_status)->first();
    if ($result->userid_status == 1) {
        $userid_status_data = "Active";
    } else if ($result->userid_status == 2) {
        $userid_status_data = "In active";
    }
    return $userid_status_data ?? '';
}

function getRoleByNameId($role_id)
{
    $result = DB::table('roles')->where('id', $role_id)->first();
    return $result->name ?? '';
}

function getEmployeeTypeNameById($employee_type_id)
{
    $result = DB::table('ref_employee_type')->where('id', $employee_type_id)->first();
    return $result->name ?? '';
}

function storeMedia($request, string $path, array $allowedExtensions, $fileKey, $allowedFileSize = 2 * 1024 * 1024): JsonResponse
{
    $filePath = getFilePath($path);
    $file = $request->file($fileKey);
    $name = uniqid() . '_' . str_replace([' ', '-', '*'], '', strtolower(trim($file->getClientOriginalName())));

    if (!$file || !$file->isValid()) {
        return response()->json(['status' => false, 'message' => 'Invalid file upload.']);
    }

    $originalName = $file->getClientOriginalName();
    $extension = strtolower($file->getClientOriginalExtension());
    $mime = $file->getMimeType();

    // Clean and generate new file name
    $fileName = uniqid() . '_' . preg_replace('/[\s\-\*]+/', '', strtolower(trim($originalName)));

    // Validate filename structure
    if (substr_count($originalName, '.') !== 1) {
        return response()->json(['status' => false, 'message' => 'File name is not valid!']);
    }

    // File size check (2MB) - adjust as needed
    if ($file->getSize() > $allowedFileSize) {
        return response()->json(['status' => false, 'message' => 'File size exceeds the allowed limit.']);
    }

    // Validate extension and MIME type
    $allowedMimes = [
        'image/jpeg',
        'image/png',
        'image/jpg',
        'application/pdf',
        'application/msword',
        'image/gif',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'video/mp4',
        'video/x-msvideo',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

        // // KML & KMZ
        // 'application/vnd.google-earth.kml+xml', // Official for .kml
        // 'application/vnd.google-earth.kmz',     // Official for .kmz

        // // // Fallbacks for some browsers
        // 'application/xml',
        // 'application/zip',
        // 'application/octet-stream' // Common for unknown file types
        "text/xml",
        'application/zip'
    ];

    if (!in_array($extension, $allowedExtensions) || !in_array($mime, $allowedMimes)) {
        return response()->json(['status' => false, 'message' => 'Invalid file type or extension.']);
    }



    // Optional PDF content check
    if ($mime === 'application/pdf') {
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($file->getRealPath());
            $pdfText = $pdf->getText();

            $maliciousPatterns = ['/script\b/i', '/<\?php/i', '/\{\{.*\}\}/', '/@if\s*\(/i'];
            foreach ($maliciousPatterns as $pattern) {
                if (preg_match($pattern, $pdfText)) {
                    Log::warning('Malicious content detected in PDF: ' . $originalName . ' | Pattern: ' . $pattern);
                    return response()->json([
                        'status' => false,
                        'message' => 'The uploaded PDF contains unsafe content (e.g., scripts or embedded code) and cannot be accepted for security reasons.'
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'PDF scan failed: ' . $e->getMessage()]);
        }
    }



    // Optional: ClamAV scan
    if (env('ENABLE_CLAMAV', false)) {
        $scanResult = exec("clamscan " . escapeshellarg($file->getRealPath()));
        if (strpos($scanResult, 'FOUND') !== false) {
            return response()->json(['status' => false, 'message' => 'Malware detected!']);
        }
    }

    // Your custom check (e.g., XSS file check)
    $checkFileUpload = checkUploadFileContent([
        'file_name' => $originalName,
        'file_tmp_name' => $file->getRealPath(),
        'file_mime_type' => $mime
    ]);



    if (!empty($checkFileUpload['error'])) {
        return response()->json([
            'status' => false,
            'message' => $checkFileUpload['message'],
            'file_name' => '',
            'file_path' => '',
        ]);
    }

    // Final move
    try {
        if ($request->$fileKey->move($filePath, $name)) {
            return response()->json([
                'status' => true,
                'message' => 'File uploaded successfully.',
                'file_name' => $name,
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName()
            ]);
        }
    } catch (\Exception $e) {
        Log::error("File upload failed: " . $e->getMessage());
        return response()->json(['status' => false, 'message' => 'OOPS, Something went wrong, please try again later' . $e->getMessage()]);
    }
}


function getFilePath($dir_path)
{

    // if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == "https://staging3.velocis.in:8243/eservices/") {
    //     $path = '../../u01-nfs/' . $dir_path;
    // } elseif (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == "http://localhost/edarshan/") {
    //     $path = '../../u01-nfs/' . $dir_path;
    // } else {
    //     $path = '../../u01-nfs/' . $dir_path;
    //     // $path = asset($dir_path);
    // }
    return Storage::disk('external')->path($dir_path);
    //return Storage::disk('private')->path($dir_path);
}

function viewFilePath($dir_path)
{
    $getFilePath = getFilePath($dir_path);
    if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == "https://staging3.velocis.in:8243/eservices/") {
        $path = (dirname($_SERVER['DOCUMENT_ROOT']) . $getFilePath);
        return $path;
    } else {
        return $getFilePath;
    }
}

function checkFileExist($path, $file)
{

    $pathName = $path;
    $fileName = $file;

    $completeFile = viewFilePath($pathName) . urldecode($fileName);
    if (file_exists($completeFile)) {
        return $completeFile;
    } else {
        return 0;
    }
}


if (!function_exists('setCache')) {
    function setCache(string $key, $value, $minutes = 10): void
    {
        Cache::put($key, $value, now()->addMinutes($minutes));
    }
}

if (!function_exists('getCache')) {
    function getCache(string $key, $default = null)
    {
        return Cache::get($key, $default);
    }
}

if (!function_exists('forgetCache')) {
    function forgetCache(string $key): void
    {
        Cache::forget($key);
    }
}

if (!function_exists('hasCache')) {
    function hasCache(string $key): bool
    {
        return Cache::has($key);
    }
}

if (!function_exists('cacheTtl')) {
    function cacheTtl(string $key): int
    {
        return Cache::ttl($key);
    }
}

if (!function_exists('generateOtp')) {
    function generateOtp(): int
    {
        return rand(100000, 999999);
    }
}

if (!function_exists('user')) {
    function user()
    {
        return Auth::user();
    }
}


if (!function_exists('user_id')) {
    function user_id()
    {
        return optional(user())->id ?? 0;
    }
}

if (!function_exists('format_datetime')) {
    function format_datetime($date, $format = 'd-m-Y')
    {
        if (!$date) return 'N/A';
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('encryptId')) {
    function encryptId($id)
    {
        return Crypt::encrypt($id);
    }
}





if (!function_exists('getBgStatus')) {
    function getBgStatus($key = null)
    {
        $statusLabels = [
            'P'               => 'Pending By Technical Department',
            'F'               => 'Forwarded to Finance Department',
            'FR'               => 'Forwarded to Verifier Department',
            'Received'        => 'Received by Finance Department',
            'R'               => 'Refer Back to Technical Department',
            'RR'               => 'Return to Finance Department',
            'Request'         => 'BG Request Sent to Finance Department',
            'Renew Request'   => 'Renew BG Request Sent to Finance Department',
            'A'               => 'Accepted by Finance Department',
            'FRT'             => 'Final Return to Technical by Finance Department',
            'Archive'         => 'Returned to Contractor',
            'Encashed'        => 'BG Encashed',
            'SE'              => 'BG Sent for Encashment',
            'Renew'           => 'Renew BG Forwarded to Finance',
            'Renew Receive'   => 'Renew BG Received by Finance',
            'Renew Accept'    => 'Renew BG Accepted by Finance Department',
            'Renew Refer'     => 'Renew BG Refer back to Technical Department',
        ];

        if (array_key_exists((string) $key, $statusLabels)) {
            return $statusLabels[(string) $key];
        }

        return 'Pending By Technical Department';
    }
}



if (!function_exists('getUserPermissions')) {
    function getUserPermissions($key = null)
    {
        $user = Auth::user();
        // $userRole = $user->getRoleNames()->first();
        $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();

        return $userPermissions;
    }
}








if (!function_exists('renewStatus')) {
    function renewStatus($key = null)
    {

        $status = [
            '0' => 'Pending',
            '1' => 'Accepted',
            '2' => 'Rejected'
            // '3' => 'Rejected'
        ];

        if (is_null($key)) {
            return $status;
        }

        if (array_key_exists((string) $key, $status)) {
            return $status[(string) $key];
        }

        $id = array_search($key, $status);
        return $id !== false ? $id : '55';
    }
}

if (!function_exists('decryptId')) {
    function decryptId($encryptedId)
    {
        try {
            return Crypt::decrypt($encryptedId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return null;
        }
    }
}

if (!function_exists('canAccess')) {
    function canAccess($action, $permissions, $module)

    {
        return in_array(trim($module . '-' . $action), array_map('trim', $permissions));
    }
}

if (!function_exists('getGrievanceId')) {
    function getGrievanceId()
    {
        do {
            $randomId = 'GRV' . rand(100, 9999999);
            $exists = Grievance::where('grievance_id', $randomId)->exists();
        } while ($exists);

        return $randomId;
    }
}

if (!function_exists('getProjectId')) {
    function getProjectId()
    {
        do {
            $randomId = 'PROJ' . rand(100, 9999999);
            $exists = NhidclProject::where('project_id', $randomId)->exists();
        } while ($exists);

        return $randomId;
    }
}
if (!function_exists('getBgId')) {
    function getBgId()
    {
        do {
            $randomId = 'BG' . rand(100, 9999999);
            $exists = NhidclBankGuarantee::where('bg_id', $randomId)->exists();
        } while ($exists);

        return $randomId;
    }
}

if (!function_exists('bgmsAssignedState')) {
    function bgmsAssignedState()
    {
        $user =  user();

        return $user->bgms_assigned_state;
    }
}

function checkUploadFileContent(array $filedata = [])
{
    $filename = $filedata['file_name'] ?? '';
    $tempPath = $filedata['file_tmp_name'] ?? '';
    $mimeType = $filedata['file_mime_type'] ?? '';

    // Validate filename and temp path
    if (empty($filename) || empty($tempPath)) {
        return ['error' => 1, 'message' => 'File name or temporary path is missing.'];
    }

    // Disallow multiple dots in filename
    if (substr_count($filename, '.') !== 1) {
        return ['error' => 1, 'message' => 'File name is not valid (contains multiple dots).'];
    }

    // Check file size
    if (!file_exists($tempPath)) {
        return ['error' => 1, 'message' => 'Temporary file does not exist.'];
    }

    $fileSize = filesize($tempPath);
    if ($fileSize === false || $fileSize === 0) {
        return ['error' => 1, 'message' => 'File is empty or unreadable.'];
    }

    // Read file content safely
    $content = file_get_contents($tempPath);
    if ($content === false) {
        return ['error' => 1, 'message' => 'Unable to read file content.'];
    }

    // Scan for malicious strings
    $lowerContent = strtolower($content);
    $maliciousStrings = ['<script', 'alert(', '<?php', 'onerror=', 'onload='];

    foreach ($maliciousStrings as $badString) {
        if (strpos($lowerContent, $badString) !== false) {
            return ['error' => 1, 'message' => 'File content contains potentially malicious code.'];
        }
    }

    return ['error' => 0, 'message' => 'File content is clean.'];
}


if (!function_exists('getSmsTemplate')) {
    function getSmsTemplate($idOrName, $variables = [])
    {
        try {
            $query = SmsTemplate::query();

            if (is_numeric($idOrName)) {
                $data = $query->where('id', (int) $idOrName)->first();
            } else {
                $data = $query->where('template_name', $idOrName)->first();
            }

            if ($data) {

                $message = $data->message;

                foreach ($variables as $key => $value) {

                    $replacement = !empty($value) ? $value : '';

                    $message = str_replace("{" . $key . "}", (string) ($replacement ?? ''), $message);
                }
                return [
                    'id'            => $data->id,
                    'template_name' => $data->template_name,
                    'template_id'   => $data->template_id,
                    'event_id'      => $data->event_id,
                    'message'       => $message,
                    'status'        => (bool) $data->status,
                ];
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}



if (!function_exists('generateOrderId')) {
    function generateOrderId($inputs)
    {
        $from = $inputs['from'] ?? 'advertisement';

        $id   = $inputs['id'] ?? 1;

        return strtoupper($from) .  '-' . date('ymdHis') . '-' . Str::upper(Str::random(4)) . '-' . $id;
    }
}

    /**
     * Handle redirect back with errors + session reset.
     */
    if (! function_exists('decryptPassword')) {
        /**
         * Decrypts a password that was encrypted on the frontend using AES-128-CBC
         * with a salt stored in the session.
         */
        function decryptPassword(?string $encrypted, ?string $salt): ?string
        {
            if (empty($encrypted) || empty($salt)) {
                return null;
            }

            // If password came URL-encoded from the client
            $encrypted = urldecode($encrypted);

            // Key & IV derived from salt the same way as your frontend/server agreement
            $key = str_repeat($salt, 4);
            $iv  = $key;

            // base64 decode (strict) -> false on invalid input
            $cipherText = base64_decode($encrypted, true);
            if ($cipherText === false) {
                return null;
            }

            $decrypted = openssl_decrypt(
                $cipherText,
                'AES-128-CBC',
                $key,
                OPENSSL_RAW_DATA,
                $iv
            );

            return $decrypted !== false ? $decrypted : null;
        }
    }

    if (! function_exists('redirectBack')) {
        /**
         * Centralized redirect with session reset and error flashing.
         */
        function redirectBack(Request $request, array $errors): RedirectResponse
        {
            $route = $request->input('action') === 'recruitment' ? 'recruitment.login' : 'login';

            // Clear session and regenerate CSRF token
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route($route)
                ->withErrors($errors)
                ->withInput();
        }
    }

    if (! function_exists('getUserFromSession')) {
        function getUserFromSession(Request $request): ? User
        {
            $userId = $request->session()->get('otp_user_id');
            return User::find($userId);
        }
    }

    if (! function_exists('expireSession')) {
        function expireSession(Request $request, string $message)
        {
            Auth::logout();
            $request->session()->forget(['salt', 'otp_user_id', 'remember_me']);
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirectBack($request, ['error' => $message]);
        }
    }

    if (! function_exists('storeOtp')) {
        function storeOtp(User $user, int $code): void
        {
            $hashedOtp = Hash::make($code);

            $exists = NhidclTwoFactorVerification::where('email_id', $user->email)
                ->where('mobile_no', $user->mobile)
                ->where('type', 2)
                ->whereNull('deleted_at')
                ->exists();

            if ($exists) {
                DB::table('nhidcl_two_factor_verification')
                    ->where('email_id', $user->email)
                    ->where('mobile_no', $user->mobile)
                    ->where('type', 2)
                    ->whereNull('deleted_at')
                    ->update([
                        'otp'        => $hashedOtp,
                        'otp_count'  => DB::raw('otp_count + 1'),
                        'updated_at' => now(),
                    ]);
            } else {
                NhidclTwoFactorVerification::create([
                    'email_id'  => $user->email,
                    'mobile_no' => $user->mobile,
                    'type'      => 2,
                    'otp_count' => 1,
                    'otp'       => $hashedOtp,
                ]);
            }
        }
    }

      function getUserById($id) {
    return DB::table('ref_users')
             ->where('id', $id)
             ->value('name') ?? 'Unknown User';
}

function getModeConfirmationbyId($id) {
    return DB::table('mode_of_confirmation_master')
             ->where('id', $id)
             ->value('name') ?? 'Unknown User';
}
