

<?php $__env->startSection('admin_content'); ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4><?php echo e($session->title); ?></h4>
                </div>
                <div class="card-body">
                    <h4>Description:</h4>
                    <p><?php echo e($session->description); ?></p>

                    <h4>Session Details:</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <th>Conducted By</th>
                                    <td><?php echo e($session->conducted_by); ?></td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <td><?php echo e($session->date); ?></td>
                                </tr>
                                <tr>
                                    <th>Start Time</th>
                                    <td><?php echo e($session->start_time); ?></td>
                                </tr>
                                <tr>
                                    <th>End Time</th>
                                    <td><?php echo e($session->end_time); ?></td>
                                </tr>
                                <tr>
                                    <th>Location</th>
                                    <td><?php echo e($session->location); ?></td>
                                </tr>
                                <tr>
                                    <th>Venue</th>
                                    <td><?php echo e($session->venue); ?></td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td><?php echo e($session->department); ?></td>
                                </tr>
                                <tr>
                                    <th>Mode</th>
                                    <td><?php echo e($session->mode); ?></td>
                                </tr>
                                <?php if($session->mode === 'Online' || $session->mode === 'Hybrid'): ?>
                                    <tr>
                                        <th>Meeting URL</th>
                                        <td><a href="<?php echo e($session->meeting_url); ?>"><?php echo e($session->meeting_url); ?></a></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th>Price</th>
                                    <td><?php echo e($session->price_type === 'Free' ? 'Free' : '₹' . $session->amount); ?></td>
                                </tr>
                                <tr>
                                    <th>Actions</th>
                                    <td>

                                        <a href="<?php echo e(route('sessions.edit', ['session' => $session->id, 'token' => $token])); ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                        <form action="<?php echo e(route('sessions.destroy', ['session' => $session->id, 'token' => $token])); ?>" method="POST" style="display:inline-block;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\laragon\www\plevents\resources\views/admin/pages/sessions/show.blade.php ENDPATH**/ ?>