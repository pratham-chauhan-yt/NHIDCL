<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Application submitted successfully - Resource Pool | NHIDCL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            text-align: center;
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; background: #ffffff; color: #333;">
    <div style="max-width: 600px; margin: auto; padding: 20px; background: #ffffff;">
        <div style="text-align: left; margin-bottom: 30px;">
            @if(isset($message))
            <img src="{{ $message->embed(public_path('images/logo.png')) }}" style="width:150px;" alt="NHIDCL Logo">
            @else
            <img src="{{ asset('public/images/logo.png') }}" style="width:150px;" alt="NHIDCL Logo">
            @endif
        </div>
        <div class="container">
            <h2>Dear Candidate,</h2>
            <p>You have successfully completed your profile on the Resource Pool of NHIDCL.</p>

            <p>Your Application ID is {{ $userId }}</p>

            <p>Thank you</p>

            <div class="footer">
                <p>
                    Sent by – <strong>National Highways & Infrastructure Development Corporation Ltd.<br>
                    1st & 2nd Floor, Tower A, World Trade Centre, Nauroji Nagar, New Delhi – 110029</strong>
                </p>
            </div>
        </div>
    </div>
</body>
</html>