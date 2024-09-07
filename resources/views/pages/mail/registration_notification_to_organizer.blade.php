<!DOCTYPE html>
<html>
<head>
    <title>New Event Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header img {
            width: 100%;
            max-width: 200px;
            display: block;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            text-align: left;
        }
        .footer {
            font-size: 12px;
            color: #666;
            text-align: center;
            padding: 20px;
            border-top: 1px solid #ddd;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://egspec.blob.core.windows.net/egspec-assets/vegspec.png" alt="EGS Pillay Group of Institutions Logo">
        </div>
        <h1>New Registration Received</h1>
        <p>Dear Organizer,</p>
        <p>We are pleased to inform you that a new registration has been received for the event titled "{{ $data['eventName'] }}", scheduled for {{ $data['eventDate'] }}.</p>
        <table>
            <tr>
                <th>Detail</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Registration ID</td>
                <td>{{ $data['eventRegistrationId'] }}</td>
            </tr>
            <tr>
                <td>Invoice ID</td>
                <td>{{ $data['invoiceId'] }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $data['email'] }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $data['phone'] }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $data['address'] }}</td>
            </tr>
            <tr>
                <td>City</td>
                <td>{{ $data['city'] }}</td>
            </tr>
            <tr>
                <td>State</td>
                <td>{{ $data['state'] }}</td>
            </tr>
            <tr>
                <td>Country</td>
                <td>{{ $data['country'] }}</td>
            </tr>
            <tr>
                <td>Pincode</td>
                <td>{{ $data['pincode'] }}</td>
            </tr>
            <tr>
                <td>Amount Paid</td>
                <td>{{ $data['amountPaid'] }}</td>
            </tr>
            <tr>
                <td>Payment ID</td>
                <td>{{ $data['paymentId'] }}</td>
            </tr>
            <tr>
                <td>Order ID</td>
                <td>{{ $data['orderId'] }}</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>&copy; 2024 EGS Pillay Group of Institutions. All rights reserved.<br>
        Old Nagore Road, Thethi Village, Nagapattinam - 611002, Tamil Nadu</p>
        <p><a href="mailto:web@egspec.org">web@egspec.org</a> | <a href="mailto:raghavan@egspec.org">raghavan@egspec.org</a> | <a href="tel:+919942502245">+91 99425 02245</a></p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </div>
</body>
</html>
