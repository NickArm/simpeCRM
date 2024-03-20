<!DOCTYPE html>
<html>
<head>
    <title>Service Expiration Reminder</title>
</head>
<body>
    <h1>Service Expiration Reminder</h1>
    <p>Dear {{ $data['customer_name'] }},</p>
    <p>Your service <strong>{{ $data['service_name'] }}</strong> is expiring soon on <strong>{{ $data['expiration'] }}</strong>.</p>
    <p>Please contact us if you have any questions or if you would like to renew your service.</p>
    <p>Thank you,</p>
    <p>Your Company Name</p>
</body>
</html>
