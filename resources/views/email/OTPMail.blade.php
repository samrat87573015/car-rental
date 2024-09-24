<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Email</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="width: 100%; padding: 20px; background-color: #f4f4f4;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
            <h2 style="color: #333333; text-align: center;">Your OTP Code</h2>
            <p style="font-size: 16px; color: #333333;">Dear User,</p>
            <p style="font-size: 16px; color: #333333;">We received a request to access your account. Use the OTP below to complete your verification process:</p>
            <div style="text-align: center; margin: 20px 0;">
                <span style="display: inline-block; font-size: 22px; color: #ffffff; background-color: #4CAF50; padding: 10px 20px; border-radius: 4px; letter-spacing: 4px;">{{ $otp }}</span>
            </div>
            <p style="font-size: 16px; color: #333333;">This OTP is valid for the next 10 minutes. If you did not request this, please ignore this email.</p>
            <p style="font-size: 16px; color: #333333;">Best regards,<br>Car Rental</p>
            <hr style="border: 1px solid #dddddd; margin-top: 30px;">
            <p style="font-size: 12px; color: #999999; text-align: center;">© 2023 Car Rental. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
