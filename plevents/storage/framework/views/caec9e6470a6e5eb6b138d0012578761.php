<!-- resources/views/components/page-banner.blade.php -->
<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content">
            <h2><?php echo e($title); ?></h2>

            <ul class="pages-list">
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->last): ?>
                        <li><?php echo e($breadcrumb['label']); ?></li>
                    <?php else: ?>
                        <li><a href="<?php echo e($breadcrumb['url']); ?>"><?php echo e($breadcrumb['label']); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH F:\laragon\www\plevents\resources\views/components/page-banner.blade.php ENDPATH**/ ?>