<?php $__env->startSection('admin_content'); ?>


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Speaker Profiles</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> Profile </th>
                        <th> Full Name </th>
                        <th> Phone Number </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="py-1">
                                <img src="<?php echo e(url($speaker->profile_url)); ?>" alt="<?php echo e($speaker->full_name); ?> Image" width="50" height="50">
                            </td>
                            <td> <?php echo e($speaker->full_name); ?> </td>
                            <td> <?php echo e($speaker->phone_number); ?> </td>
                            <td>
                                <a href="" class="btn btn-info btn-sm">View</a>
                                <form action="" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="#" class="btn btn-success btn-sm">Send Invitation</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laragon\www\plevents\resources\views/admin/pages/speaker/index.blade.php ENDPATH**/ ?>