<!-- resources/views/emails/lead-submission.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Submission</title>
</head>
<body>
    <h2>New Lead Submission</h2>
    <p><strong>Branch:</strong> {{ $leadData['branch'] }}</p>
    <p><strong>Customer Full Name:</strong> {{ $leadData['customer_name'] }}</p>
    <p><strong>Customer Address:</strong> {{ $leadData['customer_address'] }}</p>
    <p><strong>Landmark:</strong> {{ $leadData['landmark'] }}</p>
    <p><strong>Contact Number:</strong> {{ $leadData['contact_number'] }}</p>
    <p><strong>Alternate Number:</strong> {{ $leadData['alternate_number'] }}</p>
    <p><strong>Email:</strong> {{ $leadData['email'] }}</p>
    <p><strong>Service:</strong> {{ $leadData['service'] }}</p>
    <p><strong>Comments:</strong> {{ $leadData['comments'] }}</p>
    <p><em>Submitted on {{ now()->format('Y-m-d H:i:s') }}</em></p>
</body>
</html>
