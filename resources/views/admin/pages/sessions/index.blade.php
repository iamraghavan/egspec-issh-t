@extends('admin.layouts.admin')
@section('admin_content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div id="toast-container" aria-live="polite" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; z-index: 1050;">
            <!-- Toasts will be injected here by JavaScript -->
        </div>

        <h4 class="card-title">Sessions</h4>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                    @if($session->is_hide !== 'block') <!-- Only show rows where is_hide is not 'block' -->
                        <tr>
                            <td>{{ $session->title }}</td>
                            <td>{{ $session->department }}</td>
                            <td>
                                <a href="{{ route('sessions.show', ['session' => $session->id, 'token' => $token]) }}" class="btn btn-inverse-info btn-fw" style="display:inline-block;">
                                    <i class="mdi mdi-eye-outline"></i>
                                    View
                                </a>
                                <a href="{{ route('sessions.edit', ['session' => $session->id, 'token' => $token]) }}" class="btn btn-inverse-success btn-fw" style="display:inline-block;">
                                    <i class="mdi mdi-pencil-outline"></i>
                                    Edit
                                </a>

                                <form action="{{ route('sessions.destroy', ['session' => $session->id, 'token' => $token]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-inverse-danger btn-fw">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    // Function to show toast
    function showToast(message, type) {
        var toastHTML = `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="min-width: 300px;">
                <div class="toast-header">
                    <strong class="mr-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                    <small>Now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        document.getElementById('toast-container').innerHTML = toastHTML;
        $('.toast').toast({ delay: 5000 }).toast('show');
    }

    // Show toasts based on session flash data
    @if (session('success'))
        showToast('{{ session('success') }}', 'success');
    @elseif (session('error'))
        showToast('{{ session('error') }}', 'error');
    @endif
  </script>

@endsection
