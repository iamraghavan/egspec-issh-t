<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Event Registration</title>
</head>
<body style="margin: 0; padding: 10mm; font-family: Arial, sans-serif; font-size: 12px; line-height: 1.5;">

<div style="width: 100%;">

    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">
        <img src="{{ asset('assets/egspec-r1.png') }}" alt="Logo" style="height: 50px;" />
        <div style="text-align: right; font-size: 14px; font-weight: bold;">
           {{ $registration->event_registration_id }}
        </div>
    </div>

    <!-- Content -->
    <div style="margin-top: 20px;">

        <!-- Welcome Message -->
        <p style="margin: 0 0 20px;">
            This e-ticket grants entry to the event or session. Present it at the venue or online platform, and follow all event guidelines for a smooth experience.
        </p>

        <!-- Registration Details -->
        <div style="margin-bottom: 20px;">
            <h2 style="font-size: 14px; margin: 0 0 10px; border-bottom: 2px solid #000; padding-bottom: 5px;">
                Registration Details
            </h2>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Reference ID</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->invoice_id ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Date of Booking</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">
                        {{ $registration->created_at ? $registration->created_at->format('d M, Y') : 'N/A' }} at {{ $registration->created_at ? $registration->created_at->format('h:i A') : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Event ID</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->event_registration_id ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Name</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Email</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->email ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Phone</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->phone ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Address</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">
                        {{ $registration->address ?? 'N/A' }},
                        {{ $registration->city ?? 'N/A' }},
                        {{ $registration->state ?? 'N/A' }} -
                        {{ $registration->pincode ?? 'N/A' }},
                        {{ $registration->country ?? 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Amount</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->amount ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Total Value</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->summary_amount ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Payment ID</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->payment_id ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Order ID</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $registration->order_id ?? 'N/A' }}</td>
                </tr>
                @if($registration->registration_type === 'group' && !empty($registration->members))
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Members</th>
                        <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">
                            @forelse($registration->members as $member)
                                {{ $member }}<br>
                            @empty
                                N/A
                            @endforelse
                        </td>
                    </tr>
                @endif
            </table>
        </div>

        <!-- Session / Events Details -->
        <div style="margin-bottom: 20px;">
            <h2 style="font-size: 14px; margin: 0 0 10px; border-bottom: 2px solid #000; padding-bottom: 5px;">
                Session / Events Details
            </h2>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">S. NO.</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Title</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Date</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">Start Time</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: left; font-size: 12px; font-weight: bold;">End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessionEvents as $index => $session)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $index + 1 }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">{{ $session->title ?? 'N/A' }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">
                                {{ $session->date ? $session->date->format('d M, Y') : 'N/A' }}
                            </td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">
                                {{ $session->start_time ? $session->start_time->format('h:i A') : 'N/A' }}
                            </td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px;">
                                {{ $session->end_time ? $session->end_time->format('h:i A') : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; border: 1px solid #ddd; padding: 8px; font-size: 12px;">
                                {{ $session->description ?? 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Important Information -->
        <div style="margin-bottom: 20px;">
            <h2 style="font-size: 14px; margin: 0 0 10px; border-bottom: 2px solid #000; padding-bottom: 5px;">
                Important Instructions & Terms & Conditions
            </h2>
            <ul style="padding-left: 20px;">
                <li style="margin-bottom: 5px;">Participants must adhere to the event's code of conduct and follow all health and safety guidelines.</li>
                <li style="margin-bottom: 5px;">No cancellations or refunds will be processed once registration is completed.</li>
                <li style="margin-bottom: 5px;">For any queries, please contact Dr. S. Palani Murugan at <a href="mailto:palanimurugan@egspec.org" style="text-decoration: underline;">palanimurugan@egspec.org</a>.</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <div style="margin-top: 20px; font-size: 10px; text-align: center; color: #555;">
        <p>Copyright © 2006 - 2024 All Rights Reserved by EGS Pillay Group of Institutions. Developed By <a href="https://jsraghavan.me">Raghavan Jeeva</p>
    </div>
</div>

</body>
</html>
