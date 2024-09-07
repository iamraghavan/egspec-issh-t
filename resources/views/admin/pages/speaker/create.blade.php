@extends('admin.layouts.admin')
@section('admin_content')


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

<form class="form-sample" method="POST" action="{{ route('speaker.store', ['token' => $token]) }}" enctype="multipart/form-data">
    @csrf
    <p class="card-description">Personal Info</p>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Full Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="full_name" required>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Job Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="job_title" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Organization</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="organization" required>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Phone Number</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="phone_number" required>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">LinkedIn Profile</label>
                <div class="col-sm-9">
                    <input type="url" class="form-control" name="linkedin_profile">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Website URL</label>
                <div class="col-sm-9">
                    <input type="url" class="form-control" name="website_url">
                </div>
            </div>
        </div>
    </div>
    <p class="card-description">Biography</p>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Biography</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="bio" rows="4" required></textarea>
                </div>
            </div>
        </div>
    </div>
    <p class="card-description">Additional Info</p>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Education</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="education" rows="2"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Achievements</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="achievements" rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Social Media Handles</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="social_media_handles" rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Profile Image</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="profile_image" accept=".jpg, .jpeg, .png" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    const notyf = new Notyf();

    // Example of how to show success message
    function showSuccess(message) {
        notyf.success(message);
    }

    // Example of how to show error message
    function showError(message) {
        notyf.error(message);
    }

    // Example validation error handling (you'll need to implement actual error handling)
    document.querySelector('form').addEventListener('submit', function(event) {
        // Replace this with your actual validation logic
        let hasErrors = false; // Example: this should be based on actual validation results

        if (hasErrors) {
            event.preventDefault(); // Prevent form submission
            showError('Please correct the errors in the form.');
        } else {
            showSuccess('Form submitted successfully!');
        }
    });
</script>
@endsection
