
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ Auth::user()->profile_url }}" rel="icon" />
<title>{{ config('app.name') }} - {{ $registration->name }} - {{ $registration->event_registration_id }}</title>


<!-- Web Fonts
======================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
======================= -->
<link rel="stylesheet" href="{{ asset("/assets/css/bootstrap.min.css") }}">
<link rel="stylesheet" type="text/css" href="https://harnishdesign.net/demo/html/koice/vendor/font-awesome/css/all.min.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('/assets/pdf/style.css')}}"/>
<link rel="stylesheet" href="{{ asset("/assets/css/boxicons.min.css") }}">
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
    <div class="row align-items-center gy-3">
      <div class="col-sm-7 text-center text-sm-start"> <img id="logo" src="{{ asset('assets/egspec-r1.png') }}" title="EVENT" alt="EVENT" /> </div>
      <div class="col-sm-5 text-center text-sm-end">
        <h4 class="mb-0">Registration</h4>
        <p class="mb-0">{{$registration->event_registration_id}}</p>
      </div>
    </div>
    <hr>
  </header>
  <!-- Main Content -->
  <main>
    <p class="text-1 text-center text-muted">
        This e-ticket grants entry to the event or session. Present it at the venue or online platform, and follow all event guidelines for a smooth experience.
    </p>

    <!-- Passenger Details -->
    <h4 class="text-4">Registration Details</h4>
    <div class="table-responsive">
        <table class="table table-bordered text-1 table-sm table-striped">
            <thead>
                <tr>
                    <td colspan="4">
                        <span class="fw-600">Reference ID</span>: {{ $registration->invoice_id ?? 'N/A' }}
                        <span class="float-end">
                            <span class="fw-600">Date of Booking</span>: {{ $registration->created_at ? $registration->created_at->format('d M, Y') : 'N/A' }} at {{ $registration->created_at ? $registration->created_at->format('h:i A') : 'N/A' }}
                        </span>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-600 col-2">Event ID</td>
                    <td class="col-4">{{ $registration->event_registration_id ?? 'N/A' }}</td>
                    <td class="fw-600 col-2">Name</td>
                    <td class="col-4">{{ $registration->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="fw-600">Email</td>
                    <td>{{ $registration->email ?? 'N/A' }}</td>
                    <td class="fw-600">Phone</td>
                    <td>{{ $registration->phone ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="fw-600">Address</td>
                    <td colspan="3">
                        {{ $registration->address ?? 'N/A' }},
                        {{ $registration->city ?? 'N/A' }},
                        {{ $registration->state ?? 'N/A' }} -
                        {{ $registration->pincode ?? 'N/A' }},
                        {{ $registration->country ?? 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <td class="fw-600">Amount</td>
                    <td>{{ $registration->amount ?? 'N/A' }}</td>
                    <td class="fw-600">Total Value</td>
                    <td>{{ $registration->summary_amount ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="fw-600">Payment ID</td>
                    <td>{{ $registration->payment_id ?? 'N/A' }}</td>
                    <td class="fw-600">Order ID</td>
                    <td>{{ $registration->order_id ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="fw-600">Registration Type</td>
                    <td>{{ ucfirst($registration->registration_type ?? 'N/A') }}</td>
                    @if(!empty($registration->members))
                    <tr>
                        <td class="fw-600">Members Details</td>
                        <td>
                            @foreach($registration->members as $member)
                                {{ $member }}<br>
                            @endforeach
                        </td>
                    </tr>
                @endif

                </tr>
                @if($registration->registration_type === 'group' && !empty($registration->members))
                    <tr>
                        <td class="fw-600">Members</td>
                        <td colspan="3">
                            @forelse($registration->members as $member)
                                {{ $member }}<br>
                            @empty
                                N/A
                            @endforelse
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>


    <!-- Passenger Details -->
    <h4 class="text-4 mt-2">Session / Events Details</h4>
    <div class="table-responsive">
      <table class="table table-bordered text-1 table-sm">
        <thead>
          <tr class="bg-light">
            <th>S. NO.</th>
            <th>Title</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>


          </tr>
        </thead>
        <tbody>
          @foreach($sessionEvents as $index => $session)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $session->title ?? 'N/A' }}</td>
              <td>{{ $session->date ? $session->date->format('d M, Y') : 'N/A' }}</td>
          <td>{{ $session->start_time ? $session->start_time->format('h:i A') : 'N/A' }}</td>
          <td>{{ $session->end_time ? $session->end_time->format('h:i A') : 'N/A' }}</td>


            </tr>

          @endforeach
        </tbody>
      </table>

      <table class="table table-bordered text-1 table-sm">
        <tbody>
            <tr style="text-align: center !important;">
                <td colspan="3"><span class="fw-600"></span> {{ $session->description ?? 'N/A' }}</td>
              </tr>
        </tbody>
      </table>

    </div>

    <div class="table-responsive">
      <table class="table table-bordered text-1 table-sm">
        <tbody>
          <tr style="text-align: center !important;">
            <td class="col-4"><span class="fw-600">{{ $session->location ?? 'N/A' }}</td>
            <td class="col-4"><span class="fw-600">{{ $session->venue ?? 'N/A' }}</td>
            <td class="col-4"><span class="fw-600">{{ $session->conducted_by ?? 'N/A' }}</td>
          </tr>
          <tr style="text-align: center !important;">
            <td colspan="3"><span class="fw-600">Address:</span> {{ config('app.company_address') }}</td>
          </tr>
        </tbody>
      </table>
    </div>


    <!-- Important Info -->
    <h4 class="text-4 mt-2">Important Instruction &amp; Terms &amp; Conditions</h4>
    <ul class="text-1">
        <li>Participants must adhere to the event's code of conduct and follow all health and safety guidelines.</li>
        <li>No cancellations or refunds will be processed once registration is completed.</li>
        <li>By attending the event, participants consent to photography and the use of media.</li>
        <li>For any queries, please contact Dr. S. Palani Murugan at <a href="mailto:palanimurugan@egspec.org">palanimurugan@egspec.org</a>.</li>
    </ul>

  </main>
  <!-- Footer -->
  <footer class="text-center">
    <hr>
    <p style="font-size: smaller;">
        Copyright © 2006 - 2024 All Rights Reserved by EGS Pillay Group of Institutions. Developed By <a href="https://jsraghavan.me">Raghavan Jeeva</a>.
    </p>
    <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none">
        <i class='bx bx-printer'></i> Print</a> </div>

        <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none">
            <i class='bx bxs-file-pdf' ></i> Download PDF</a> </div>


  </footer>
</div>
<!-- Back to My Account Link -->
<p class="text-center d-print-none"><a href="{{ route('user.dashboard', ['google_uid' => Auth::user()->google_id]) }}">&laquo; Back to My Account</a></p>
</body>
</html>
