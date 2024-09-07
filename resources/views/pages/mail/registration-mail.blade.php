<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 2rem;
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        header {
            text-align: center;
            margin: 2rem 0;
        }
        header img {
            max-width: 100%;
            height: auto;
        }
        h3 {
            font-size: 20px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 1rem;
            color: #fc5a1b;
            border-bottom: 2px solid #fc5a1b;
            padding-bottom: 0.5rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f7f7f7;
            color: #333;
        }
        footer {
            background-color: #1e1e1e;
            color: #fff;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }
        footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .signature {
            font-size: 14px;
            margin-top: 1rem;
            text-align: left;
        }
        @media screen and (max-width: 600px) {
            .container {
                padding: 1rem;
            }
            table {
                width: 100%;
                border: 0;
                border-collapse: collapse;
            }
            th, td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
            th {
                background-color: #f7f7f7;
                color: #333;
                text-align: left;
            }
            td {
                border-bottom: 1px solid #ddd;
            }
            td::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 0.5rem;
            }

            a{
                color: #fff;

            }
            a:visited {
  color: #fff;
  background-color: transparent;
  text-decoration: none;
}

a:hover {
  color: #fc5a1b;
  background-color: transparent;
  text-decoration: underline;
}

        }
    </style>
</head>
<body>
    <header>
        <img src="https://egspec.blob.core.windows.net/egspec-assets/vegspec.png" alt="EGS Pillay Group of Institutions Logo">
    </header>

    <div class="container">
        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 1rem;">
            Dear <span style="font-weight: bold;">{{ $name }}</span>,
        </p>
        <p style="font-size: 16px; line-height: 1.8; margin: 0 0 1rem;">
            Thank you for registering for our event. Your registration has been successfully processed. Below are the details of your registration.
        </p>

        <h3>Registration Details:</h3>
        <table>
            <tbody>
                <tr>
                    <th>Event Name</th>
                    <td data-label="Event Name">{{ $eventName }}</td>
                </tr>
                <tr>
                    <th>Event Date</th>
                    <td data-label="Event Date">{{ $eventDate }}</td>
                </tr>
                <tr>
                    <th>Registration ID</th>
                    <td data-label="Registration ID">{{ $eventRegistrationId }}</td>
                </tr>
                <tr>
                    <th>Invoice ID</th>
                    <td data-label="Invoice ID">{{ $invoiceId }}</td>
                </tr>
            </tbody>
        </table>

        <h3>Your Details:</h3>
        <table>
            <tbody>
                <tr>
                    <th>Name</th>
                    <td data-label="Name">{{ $name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td data-label="Email">{{ $email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td data-label="Phone">{{ $phone }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td data-label="Address">{{ $address }}, {{ $city }}, {{ $state }}, {{ $country }}, {{ $pincode }}</td>
                </tr>
            </tbody>
        </table>

        <h3>Payment Information:</h3>
        <table>
            <tbody>
                <tr>
                    <th>Amount Paid</th>
                    <td data-label="Amount Paid">{{ $amountPaid }}</td>
                </tr>
                <tr>
                    <th>Payment ID</th>
                    <td data-label="Payment ID">{{ $paymentId }}</td>
                </tr>
                <tr>
                    <th>Order ID</th>
                    <td data-label="Order ID">{{ $orderId }}</td>
                </tr>
            </tbody>
        </table>



        <footer>
            <p style="margin: 0; font-size: 16px;">&copy; 2024 EGS Pillay Group of Institutions. All rights reserved.</p>
            <p style="margin: 10px 0; font-size: 14px;">Old Nagore Road, Thethi Village, Nagapattinam - 611002, Tamil Nadu</p>
            <p style="margin: 10px 0; font-size: 14px;">
                <a href="mailto:web@egspec.org">web@egspec.org</a> | raghavan@egspec.org |
                <a href="tel:+91 99425 02245">+91 99425 02245</a>
            </p>
            <p style="margin: 10px 0; font-size: 14px;">
                <a href="#">Privacy Policy</a> |
                <a href="#">Terms of Service</a>
            </p>
        </footer>

    </div>

</body>
</html>
