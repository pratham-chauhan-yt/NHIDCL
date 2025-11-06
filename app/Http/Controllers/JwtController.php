<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class JwtController extends Controller
{

    public function getToken(Request $request)
    {   
        $issuerId = 'Y2lzY29zcGFyazovL3VzL09SR0FOSVpBVElPTi81NWViNmQ1NS05YjVkLTRiZTctODY2ZC0xMzc1NjJmNWMxZjU';
        $base64Secret = 'H2QkCpaYlkiPRyJgitl/r13I1BEAmdlmEk8Ej1KE9cQ=';
        $decodedSecret = base64_decode($base64Secret); // Decode as required
        
        $header = ['typ' => 'JWT', 'alg' => 'HS256'];
        $payload = [
            'sub' => 'guest-mayank-1994',
            'name' => 'VSPL Guest Joining',
            'iss' => 'Y2lzY29zcGFyazovL3VzL09SR0FOSVpBVElPTi81NWViNmQ1NS05YjVkLTRiZTctODY2ZC0xMzc1NjJmNWMxZjU',
            'exp' => time() + 3600,
        ];

        $encodedHeader = $this->base64UrlEncode(json_encode($header));
        $encodedPayload = $this->base64UrlEncode(json_encode($payload));
        $encodedData = $encodedHeader . '.' . $encodedPayload;
        $secret = base64_decode('YOUR_BASE64_SECRET');

        $signature = $this->base64UrlEncode(hash_hmac('sha256', $encodedData, $secret, true));
        $jwt = $encodedData . '.' . $signature;
        
        return response()->json([
            'jwt_token' => $jwt,
            'payload' => json_encode($payload),
        ]);
    }

    private function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}