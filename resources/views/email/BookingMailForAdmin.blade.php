<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Booking Confirmation</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="width: 100%; background-color: #f4f4f4; padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 5px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);">
            <h1 style="color: #333333; font-size: 24px; text-align: center;">Car Booking Confirmation</h1>
            
            <p style="color: #555555; font-size: 16px;">Hello Admin,</p>
            <p style="color: #555555; font-size: 16px;">We have received a booking request for the following car:</p>

            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Customer Name:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['profile']['name'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Customer Email:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['profile']['email'] }}</td>
                </tr>
                
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Customer Phone:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['profile']['phone'] }}</td>
                </tr>

                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Customer Address:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['profile']['address'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Car Name:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['car']['name'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Brand:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['car']['brand'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Model:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['car']['model'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Year:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['car']['year'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Start Date:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['start_date']->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">End Date:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['end_date']->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px; font-weight: bold; color: #333;">Total Cost:</td>
                    <td style="padding: 4px; color: #555;">{{ $carBookingDetails['total_cost'] }}</td>
                </tr>
            </table>

            <p style="color: #555555; font-size: 16px;">Thank you </p>


            <hr style="border: none; border-top: 1px solid #e4e4e4; margin: 20px 0;">
            <p style="color: #999999; font-size: 12px; text-align: center;">© Year Car Rental. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
