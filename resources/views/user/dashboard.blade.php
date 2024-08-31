@extends('user.layout.user')
@section('user-content')



<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @if($eventRegistrations->isEmpty())
    <p>You have not registered for any events.</p>
@else
        <h4 class="card-title">{{$user->name}}</h4>
        <p class="card-description"> Your Event Registration <code>Data</code>
        </p>
        <table class="table">
          <thead>
            <tr>
                <th>Event Registration ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Payment ID</th>
                <th>Order ID</th>
                <th>Invoice ID</th>


            </tr>
          </thead>
          <tbody>
            @foreach($eventRegistrations as $registration)
            <tr>
                <td>{{ $registration->event_registration_id }}</td>

                <td>{{ $registration->name }}</td>
                <td>{{ $registration->email }}</td>

                <td>
                    @if(is_null($registration->summary_amount))
                        ------
                    @elseif($registration->summary_amount == 0)
                        Free
                    @else
                        ₹{{ $registration->summary_amount }}
                    @endif
                </td>

                <td>{{ $registration->payment_id }}</td>
                <td>{{ $registration->order_id }}</td>
                <td>{{ $registration->invoice_id }}</td>

            </tr>
        @endforeach
          </tbody>
        </table>

        @endif
      </div>
    </div>
  </div>





@endsection
