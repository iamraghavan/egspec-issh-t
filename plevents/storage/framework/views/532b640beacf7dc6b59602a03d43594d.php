

<?php $__env->startSection('admin_content'); ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5>Create Session</h5>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Session Details</h4>


                                    <p class="card-description"> Session Info </p>
                        <form action="<?php echo e(route('sessions.store', ['token' => $token])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('admin.pages.sessions.partials.form', ['session' => new App\Models\Session], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary btn-block">Save Session</button>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\laragon\www\plevents\resources\views/admin/pages/sessions/create.blade.php ENDPATH**/ ?>