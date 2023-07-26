<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #0066cc;
        }
        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Property Price Change Notification</h2>
        <p>Dear Tenant,</p>
        <p>We would like to inform you that the price of a property in your reminder list has changed.</p>
        <p><strong>Property Name:</strong> {{ $property->property_name }}</p>
        <p><strong>Original Price:</strong> {{ $property->property_price }}</p>
        <p><strong>Desired Price:</strong> {{ $reminder->desired_price }}</p>
        <p>The property price has decreased. You can now consider renting it at a lower price.</p>
        <p>Thank you for using our rental system.</p>

        <br>
        <p>From: Web-Based Property Rental System Team with Love :)</p>
    </div>
</body>
</html>