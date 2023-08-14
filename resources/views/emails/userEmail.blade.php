<!DOCTYPE html>
<html>
<head>
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: auto;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            
            <h1>Email Notification</h1>
        </div>
        <div class="content">
        	
            <h2>Hello {{ $user->name }},</h2>
            <p>We're thrilled to welcome you to our platform!</p>
            <p>Your account details:</p>
            <ul>

                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Email:</strong> {{ $user->phone }}</li>
                <li><strong>Account Created:</strong> {{ $user->created_at->format('F j, Y') }}</li>
            </ul>
            <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
            <p>Thank you and enjoy your experience!</p>
            <p>Best regards,</p>
            <p>Your Application Team</p>
        </div>
    </div>
</body>
</html>
