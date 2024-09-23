<div class="speakers-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2><?php echo e($title); ?></h2>
            <p><?php echo e($description); ?></p>
        </div>

        <div class="row justify-content-center">
            <?php $__currentLoopData = $speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6">
                    <div class="single-speakers">
                        <div class="speakers-image">
                            <a href="<?php echo e($speaker['profileUrl']); ?>"><img src="<?php echo e($speaker['profileUrl']); ?>" alt="image"></a>
                        </div>

                        <div class="speakers-content">
                            <h3>
                                <a href="<?php echo e($speaker['profileUrl']); ?>"><?php echo e($speaker['name']); ?></a>
                            </h3>
                            <span><?php echo e($speaker['title']); ?></span>

                            <ul class="social">
                                <?php $__currentLoopData = $speaker['socialLinks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e($url); ?>" target="_blank"><i class="bx bxl-<?php echo e($platform); ?>"></i></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="view-all-btn">
            <a href="<?php echo e($viewAllUrl); ?>" class="default-btn"><i class="bx bx-chevron-right"></i> View All Speakers<span></span></a>
        </div>
    </div>
</div>
<?php /**PATH F:\laragon\www\plevents\resources\views/components/speakers-section.blade.php ENDPATH**/ ?>