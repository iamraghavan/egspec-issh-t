

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title', $session->title)); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Slug (URL)</label>
                            <div class="col-sm-9">
                                <input type="text" name="slug" id="slug" class="form-control" value="<?php echo e(old('slug', $session->slug)); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Conducted By</label>
                            <div class="col-sm-9">
                                <input type="text" name="conducted_by" id="conducted_by" class="form-control" value="<?php echo e(old('conducted_by', $session->conducted_by)); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-9">
                                <input type="date" name="date" id="date" class="form-control" value="<?php echo e(old('date', $session->date)); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Start Time</label>
                            <div class="col-sm-9">
                                <input type="text" name="start_time" id="start_time" class="form-control" value="<?php echo e(old('start_time', \Carbon\Carbon::parse($session->start_time)->format('h:i A'))); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">End Time</label>
                            <div class="col-sm-9">
                                <input type="text" name="end_time" id="end_time" class="form-control" value="<?php echo e(old('end_time', \Carbon\Carbon::parse($session->end_time)->format('h:i A'))); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Venue</label>
                            <div class="col-sm-9">
                                <input type="text" name="venue" id="venue" class="form-control" value="<?php echo e(old('venue', $session->venue)); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Price Type</label>
                            <div class="col-sm-9">
                                <select name="price_type" id="price_type" class="form-control">
                                    <option value="Free" <?php echo e(old('price_type', $session->price_type) === 'Free' ? 'selected' : ''); ?>>Free</option>
                                    <option value="Idle" <?php echo e(old('price_type', $session->price_type) === 'Idle' ? 'selected' : ''); ?>>Idle</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="amount-group">
                            <label class="col-sm-3 col-form-label">Amount (₹)</label>
                            <div class="col-sm-9">
                                <input type="number" name="amount" id="amount" class="form-control" value="<?php echo e(old('amount', $session->amount)); ?>" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" id="description" class="form-control"><?php echo e(old('description', $session->description)); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-9">
                                <input type="text" name="location" id="location" class="form-control" value="<?php echo e(old('location', $session->location)); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9">
                                <select name="department" id="department" class="form-control">
                                    <option value="Mechanical Engineering" <?php echo e(old('department', $session->department) === 'Mechanical Engineering' ? 'selected' : ''); ?>>Mechanical Engineering</option>
                                    <option value="Civil Engineering" <?php echo e(old('department', $session->department) === 'Civil Engineering' ? 'selected' : ''); ?>>Civil Engineering</option>
                                    <option value="Electrical and Electronics Engineering" <?php echo e(old('department', $session->department) === 'Electrical and Electronics Engineering' ? 'selected' : ''); ?>>Electrical and Electronics Engineering</option>
                                    <option value="Electronics and Communication Engineering" <?php echo e(old('department', $session->department) === 'Electronics and Communication Engineering' ? 'selected' : ''); ?>>Electronics and Communication Engineering</option>
                                    <option value="Computer Science and Engineering" <?php echo e(old('department', $session->department) === 'Computer Science and Engineering' ? 'selected' : ''); ?>>Computer Science and Engineering</option>
                                    <option value="Information Technology" <?php echo e(old('department', $session->department) === 'Information Technology' ? 'selected' : ''); ?>>Information Technology</option>
                                    <option value="Biomedical Engineering" <?php echo e(old('department', $session->department) === 'Biomedical Engineering' ? 'selected' : ''); ?>>Biomedical Engineering</option>
                                    <option value="Computer Science & Business Systems Engineering" <?php echo e(old('department', $session->department) === 'Computer Science & Business Systems Engineering' ? 'selected' : ''); ?>>Computer Science & Business Systems Engineering</option>
                                    <option value="Artificial Intelligence and Data Science" <?php echo e(old('department', $session->department) === 'Artificial Intelligence and Data Science' ? 'selected' : ''); ?>>Artificial Intelligence and Data Science</option>
                                    <option value="MCA" <?php echo e(old('department', $session->department) === 'MCA' ? 'selected' : ''); ?>>MCA</option>
                                    <option value="MBA" <?php echo e(old('department', $session->department) === 'MBA' ? 'selected' : ''); ?>>MBA</option>
                                    <option value="Science & Humanities" <?php echo e(old('department', $session->department) === 'Science & Humanities' ? 'selected' : ''); ?>>Science & Humanities</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mode</label>
                            <div class="col-sm-9">
                                <select name="mode" id="mode" class="form-control">
                                    <option value="Online" <?php echo e(old('mode', $session->mode) === 'Online' ? 'selected' : ''); ?>>Online</option>
                                    <option value="Offline" <?php echo e(old('mode', $session->mode) === 'Offline' ? 'selected' : ''); ?>>Offline</option>
                                    <option value="Hybrid" <?php echo e(old('mode', $session->mode) === 'Hybrid' ? 'selected' : ''); ?>>Hybrid</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="meeting-url-group">
                            <label class="col-sm-3 col-form-label">Meeting URL (if Online/Hybrid)</label>
                            <div class="col-sm-9">
                                <input type="url" name="meeting_url" id="meeting_url" class="form-control" value="<?php echo e(old('meeting_url', $session->meeting_url)); ?>">
                            </div>
                        </div>
                    </div>
                </div>


<style>

    #amount-group {
        display: none;
    }

    #meeting-url-group {
        display: none;
    }
</style>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const priceTypeSelect = document.getElementById('price_type');
    const amountGroup = document.getElementById('amount-group');
    const amountInput = document.getElementById('amount');
    const modeSelect = document.getElementById('mode');
    const meetingUrlGroup = document.getElementById('meeting-url-group');

    function toggleAmountField() {
        if (priceTypeSelect.value === 'Free') {
            amountGroup.style.display = 'none';
            amountInput.value = 0;
        } else {
            amountGroup.style.display = 'block';
        }
    }

    function toggleMeetingUrlField() {
        if (modeSelect.value === 'Online' || modeSelect.value === 'Hybrid') {
            meetingUrlGroup.style.display = 'block';
        } else {
            meetingUrlGroup.style.display = 'none';
        }
    }

    function updateSlug() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        document.getElementById('slug').value = slug;
    }

    priceTypeSelect.addEventListener('change', toggleAmountField);
    modeSelect.addEventListener('change', toggleMeetingUrlField);
    document.getElementById('title').addEventListener('input', updateSlug);

    toggleAmountField();
    toggleMeetingUrlField();
});

</script>
<?php /**PATH D:\laragon\laragon\www\plevents\resources\views/admin/pages/sessions/partials/form.blade.php ENDPATH**/ ?>