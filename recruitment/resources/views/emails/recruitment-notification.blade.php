<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advance intimation regarding edit option to review and update online applications for the Post of Deputy Manager (Tech.)</title>
    <style>
        body{font-family: Arial, sans-serif;background: #ffffff;padding: 20px;color: #333;}
        .container{max-width: 600px;margin: auto;background: #ffffff;padding: 30px;}
        .footer{font-size: 12px;color: #888;margin-top: 30px;text-align: center;}
        p{line-height:1.6;margin:12px 0;}
    </style>
</head>
<body>
    <div class="container">
        <div style="text-align: center; margin-bottom: 30px;">
            @if(isset($message))
                <img src="{{ $message->embed(public_path('images/logo.png')) }}" style="width: 150px;" alt="NHIDCL Logo">
            @else
                <img src="{{ asset('images/logo.png') }}" style="width: 150px;" alt="NHIDCL Logo">
            @endif
        </div>
        <p>Dear Applicant,</p>
        <p>An edit option to all the applicants for the post of Deputy Manager (Tech.) will be available from 6.00 pm of 31.10.2025 to 6.00 pm of 03.11.2025 for 72 hours.</p>
        <p>Official notice regarding the above can be accessed at https://www.nhidcl.com/sites/default/files/2025-10/notice_edit_option.pdf</p>
        <p>Please edit your application during the above mentioned period.</p>
        <p>No further opportunity will be provided, thereafter.</p>
        <p>Helpdesk</p>
        <p>NHIDCL Recruitment Cell</p>
        <div class="footer">
            &copy; {{ date('Y') }} NHIDCL. All rights reserved.
        </div>
    </div>
</body>
</html>