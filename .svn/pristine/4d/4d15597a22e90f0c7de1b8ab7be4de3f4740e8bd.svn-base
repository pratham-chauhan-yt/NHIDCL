<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Edit Permission - NHIDCL Recruitment Portal</title>
    <style>
        body{font-family: Arial, sans-serif;background: #ffffff;padding: 20px;color: #333;}
        .container{max-width: 600px;margin: auto;background: #ffffff;padding: 30px;}
        .footer{font-size: 12px;color: #888;margin-top: 30px;text-align: center;}
        p{line-height:1.6;margin:12px 0;}
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 30px;">
            @if(isset($message))
                <img src="{{ $message->embed(public_path('images/logo.png')) }}" style="width: 150px;" alt="NHIDCL Logo">
            @else
                <img src="{{ asset('images/logo.png') }}" style="width: 150px;" alt="NHIDCL Logo">
            @endif
        </div>
        <p>Dear Applicant,</p>
        <p>Based on your request, you can now make changes to your application ID <strong>{{ $applicationId }}</strong>.</p>
        <p>Please note that this window is open only for 72 hours from the date and time of receipt of this email. No further opportunity for editing your application shall be granted thereafter.</p>
        <p>Regards,<br>
        <p>NHIDCL Recruitment Division</p></p>
        <div class="footer">
            &copy; {{ date('Y') }} NHIDCL. All rights reserved.
        </div>
    </div>
</body>
</html>