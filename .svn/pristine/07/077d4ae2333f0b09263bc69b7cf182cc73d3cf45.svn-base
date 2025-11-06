<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your One-Time OTP for Email Verification – NHIDCL Recruitment Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
        }

        .otp {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 4px;
            background-color: #f2f2f2;
            padding: 15px;
            text-align: center;
            border-radius: 6px;
            margin: 20px 0;
        }

        .footer {
            font-size: 12px;
            color: #888;
            margin-top: 30px;
            text-align: left;
        }

        p {
            line-height: 1.6;
            margin: 12px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="text-align: center; margin-bottom: 30px;">
            @if (isset($message))
                <img src="{{ $message->embed(public_path('images/logo.png')) }}" style="width:150px;" alt="NHIDCL Logo">
            @else
                <img src="{{ public_path('images/logo.png') }}" style="width:150px;" alt="NHIDCL Logo">
            @endif
        </div>
        <p>Dear User,</p>

        <p>Your One-Time Password (OTP) for email verification on the NHIDCL Recruitment Portal is:</p>

        <div class="otp">{{ $otp }}</div>

        <p>This OTP is valid for the next 5 minutes. Please do not share it with anyone.</p>

        <p>If you did not request this verification, please ignore this email.</p>

        <p>Regards,<br>
            NHIDCL Recruitment Division</p>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name', 'NHIDCL') }}. All rights reserved.
        </div>
    </div>
</body>

</html>
