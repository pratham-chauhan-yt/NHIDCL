<?php


use DB as DB;


function calculateRoundedYearDifference($from_date, $to_date) {

    $from_date_obj = DateTime::createFromFormat('Y-m-d', $from_date);
    $to_date_obj = DateTime::createFromFormat('Y-m-d', $to_date);


    if (!$from_date_obj || !$to_date_obj) {
        Log::error("Error in calculateRoundedYearDifference  Invalid date format");
        return "Invalid date format";
    }


    $from_date = $from_date_obj->format('Y-m-d');
    $to_date = $to_date_obj->format('Y-m-d');


    $interval = $from_date_obj->diff($to_date_obj);
    $years_diff = $interval->y + ($interval->m / 12) + ($interval->d / 365);


    if ($years_diff - floor($years_diff) >= 0.5) {
        $yearData =DB::table('ref_work_experience_year')->where('year',ceil($years_diff))->first();
        //dd($yearData,1111111);
       // return ceil($years_diff);
       return $yearData?$yearData->id:1;
    } else {
        $yearData =DB::table('ref_work_experience_year')->where('year',floor($years_diff))->first();
        //  dd(floor($years_diff),$yearData);
        // return floor($years_diff);
        return $yearData?$yearData->id:1;
    }
}


function SendSMS($type, $mob, $otp = null, $sender = null, $oil=null, $reciver=null, $tansfer_date=null)
{

    if ($type == 1) {
        // Otp on sign up page
        $msg = "Your OTP to Sign-up on NHIDCL Portal is: " . $otp . ". Please, use this code to complete your process. Do not share this OTP with anyone. Regards, NHIDCL.";
        $tmpid = 1307171316399921450;
    }
    header('Content-Type: text/html;');
    $username = "CPCB_IT"; //username of the department
    $password = "Cpcbsms#2020"; //password of the department
    $senderid = "CPCBUO"; //senderid of the deparment
    $message = $msg;
    $mobileno = $mob; //if single sms need to be send use mobileno keyword
    $deptSecureKey = "106a9ed9-00c4-442d-a857-3447d308c9d9"; //departsecure key for encryption of message...
    $encryp_password = sha1(trim($password));
    $templateid = $tmpid; //your DLT registered templateid for this perticular message
    $res = sendSingleSMS($username, $encryp_password, $senderid, $message, $mobileno, $deptSecureKey, $templateid);
    return $res;
}

function sendSingleSMS($username, $encryp_password, $senderid, $message, $mobileno, $deptSecureKey, $templateid)
{
    return true;
    //dd($username, $encryp_password, $senderid, $message, $mobileno, $deptSecureKey, $templateid);
    $key = hash('sha512', trim($username) . trim($senderid) . trim($message) . trim($deptSecureKey));
    $data = array(
        "username" => trim($username),
        "password" => trim($encryp_password),
        "senderid" => trim($senderid),
        "content" => trim($message),
        "smsservicetype" => "singlemsg",
        "mobileno" => trim($mobileno),
        "key" => trim($key),
        "templateid" => trim($templateid)
    );
    $url = "https://msdgweb.mgov.gov.in/esms/sendsmsrequestDLT";
    $fields = '';
    foreach ($data as $key => $value) {
        $fields .= $key . '=' . urlencode($value) . '&';
    }
    rtrim($fields, '&');
    $post = curl_init();
    curl_setopt($post, CURLOPT_SSLVERSION, 6); // use for systems supporting TLSv1.2 or comment the line
    curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($post, CURLOPT_URL, $url);
    curl_setopt($post, CURLOPT_POST, count($data));
    curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($post); //result from mobile seva server
    $result; //output from server displayed
    curl_close($post);
}

function extractFileDetails($url) {
    // Parse the URL
    $parsed_url = parse_url($url);

    // Parse the query parameters
    parse_str($parsed_url['query'], $query_params);

    // Decode the URL-encoded parameters
    $path_name = urldecode($query_params['pathName']);
    //$file_name = urldecode($query_params['fileName']);
    $file_name = urldecode(trim($query_params['fileName'] ?? $query_params['amp;fileName'] ?? ''));

    // Return the results as an associative array
    return array(
        'filePath' => $path_name,
        'fileName' => $file_name
    );
}






