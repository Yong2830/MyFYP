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
        <h2>Property Listing Status Notification</h2>
        <p>Dear Advertiser,</p>
        <p>We would like to inform you regarding the posting status of your property listings.</p>
        <p><strong>Property Name:</strong> {{ $property->property_name }}</p>
        <p><strong>Property Posting Status:</strong> {{ $property->property_posting_status }}</p>
        
        <p>Your Property Listing has been approved and it will be shown on the Tenant page!</p>
        <p>Thank you for using our rental system.</p>

        <br>
        <p>From: Web-Based Property Rental System Team with Love :)</p>
    </div>
</body>
</html>