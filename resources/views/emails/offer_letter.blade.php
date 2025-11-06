<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Offer Letter – Resource Pool | NHIDCL</title>
</head>

<body style="font-family: Arial, sans-serif; background: #ffffff; color: #333;">
    <div style="max-width: 600px; margin: auto; padding: 20px; background: #ffffff;">
        <div style="text-align: left; margin-bottom: 30px;">
            @if (isset($message))
                <img src="{{ $message->embed(public_path('images/logo.png')) }}" style="width:150px;" alt="NHIDCL Logo">
            @else
                <img src="{{ asset('public/images/logo.png') }}" style="width:150px;" alt="NHIDCL Logo">
            @endif
        </div>
        <p>Dear {{ $user->name }},</p>

        <p>Congratulations! You have been selected. Please find the attached offer letter for further details.</p>

        <p>Date of Joining: {{ \Carbon\Carbon::parse($shortlist->date_of_joining)->format('d-m-Y') }}</p>

        <hr style="margin: 40px 0; border: none; border-top: 1px solid #ccc;">

        <p style="font-size: 12px; color: #777; text-align: center;">
            Sent by – <strong>National Highways & Infrastructure Development Corporation Ltd.<br>
                1st & 2nd Floor, Tower A, World Trade Centre, Nauroji Nagar, New Delhi – 110029</strong>
        </p>
    </div>
</body>

</html>
