<?php $__env->startSection('admin_content'); ?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div id="toast-container" aria-live="polite" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; z-index: 1050;">
            <!-- Toasts will be injected here by JavaScript -->
        </div>

        <h4 class="card-title">Sessions</h4>
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($session->is_hide !== 'block'): ?> <!-- Only show rows where is_hide is not 'block' -->
                        <tr>
                            <td><?php echo e($session->title); ?></td>
                            <td><?php echo e($session->department); ?></td>
                            <td>
                                <a href="<?php echo e(route('sessions.show', ['session' => $session->id, 'token' => $token])); ?>" class="btn btn-inverse-info btn-fw" style="display:inline-block;">
                                    <i class="mdi mdi-eye-outline"></i>
                                    View
                                </a>
                                <a href="<?php echo e(route('sessions.edit', ['session' => $session->id, 'token' => $token])); ?>" class="btn btn-inverse-success btn-fw" style="display:inline-block;">
                                    <i class="mdi mdi-pencil-outline"></i>
                                    Edit
                                </a>

                                <form action="<?php echo e(route('sessions.destroy', ['session' => $session->id, 'token' => $token])); ?>" method="POST" style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-inverse-danger btn-fw">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <?php if(session('success')): ?>
        showToast('<?php echo e(session('success')); ?>', 'success');
    <?php elseif(session('error')): ?>
        showToast('<?php echo e(session('error')); ?>', 'error');
    <?php endif; ?>
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\laragon\www\plevents\resources\views/admin/pages/sessions/index.blade.php ENDPATH**/ ?>