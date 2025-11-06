<?php

namespace App\Services;

use App\Mail\OtpMail;
use App\Services\Sms\SmsGateway;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Illuminate\Support\Facades\Log;

class OtpService
{
    protected int $otpLength = 6;
    protected int $otpExpiryMinutes = 10;
    protected int $resendCooldownMinutes = 5;

    public $sms;

    public function  __construct(SmsGateway $sms)
    {
        $this->sms = $sms;
    }

    public function sendOtp(string $type, string $destination, $otp, $table, $appid=null): array
    {
        if ($type === 'email') {
            $this->sendEmailOtp($destination, $otp);
        } elseif ($type === 'mobile') {
            $this->sendSmsOtp($destination, $otp, $table);
        } elseif ($type === 'application') {
            $this->sendSmsOtp($destination, $otp, $table, $appid);
        } else {
            return ['success' => false, 'message' => 'Invalid OTP type'];
        }

        return ['success' => true, 'message' => 'OTP sent successfully.'];
    }

    /**
     * Verify OTP
     *
     * @param string $type 'email' or 'mobile'
     * @param string $destination
     * @param string $otpInput
     * @return array ['success' => bool, 'message' => string]
     */
    public function verifyOtp(string $type, string $destination, string $otpInput): array
    {
        $otpKey = $this->getOtpCacheKey($type, $destination);

        $cachedOtp = getCache($otpKey);


        if (!$cachedOtp) {
            return ['success' => false, 'message' => 'OTP expired or not found. Please request a new one.'];
        }

        if ($otpInput !== $cachedOtp) {
            return ['success' => false, 'message' => 'Invalid OTP.'];
        }

        forgetCache($otpKey);

        return ['success' => true, 'message' => 'OTP verified successfully.'];
    }

    protected function getOtpCacheKey(string $type, string $destination): string
    {
        return "{$type}_" . md5($destination);
    }

    protected function sendEmailOtp(string $email, $otp): void
    {
        try {
            Mail::to($email)->send(new OtpMail($otp));
        } catch (TransportExceptionInterface $e) {
            Log::error("OTP mail send failed: " . $e->getMessage());
            // Fallback logic: you can still continue if SMS was sent
        }

        
    }

    protected function sendSmsOtp(string $mobile, $otp, $smstype = 'OTP_TEMPLATE', $appid=null)
    {
        try {
            $template  = getSmsTemplate($smstype, [
                'var' => $otp,
                'varid' => $appid,
            ]);

            $res = [];

            if ($template) {

                $res = $this->sms->send(
                    $mobile,
                    $template['message'],
                    [
                        "entityId" => $template['event_id'],
                        "templateId" => $template['template_id']
                    ]
                );
                if ($res['ok']) {
                    return 'Message sent!';
                }

                return null;
            }
        } catch (\Exception $ex) {
            Log::error("OTP mail send failed: " . $ex->getMessage());
        }
    }

    protected function generateOtp(): string
    {
        return rand(100000, 999999);
    }
}
