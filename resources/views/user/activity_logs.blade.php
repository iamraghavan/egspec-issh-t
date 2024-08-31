@extends('user.layout.user')
@section('user-content')



<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">


        <h4 class="card-title">{{$user->name}}</h4>
        <p class="card-description"> Activity Logs
        </p>
        <table class="table">
          <thead>
            <tr>
                <th>S.No</th>
                <th>User ID</th>
                <th>Description</th>
                <th>Properties</th>
                <th>Created At</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($activityLogs as $log)
                    <tr>
                        <td></td>
                        <td>{{ $log->user_id }}</td>
                        <td>{{ $log->description }}</td>
                        <td>
                            @if ($log->properties)
                                {{ json_encode($log->properties) }}
                            @endif
                        </td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>





@endsection
