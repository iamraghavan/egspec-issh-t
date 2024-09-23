<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginale0f6bf82b872605c3c11e5a0889fb708 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f6bf82b872605c3c11e5a0889fb708 = $attributes; } ?>
<?php $component = App\View\Components\PageBanner::resolve(['title' => 'Events','breadcrumbs' => [
        ['label' => 'Home', 'url' => route('index')],
        ['label' => 'Pages', 'url' => '#'],
        ['label' => 'Events']
    ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PageBanner::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f6bf82b872605c3c11e5a0889fb708)): ?>
<?php $attributes = $__attributesOriginale0f6bf82b872605c3c11e5a0889fb708; ?>
<?php unset($__attributesOriginale0f6bf82b872605c3c11e5a0889fb708); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f6bf82b872605c3c11e5a0889fb708)): ?>
<?php $component = $__componentOriginale0f6bf82b872605c3c11e5a0889fb708; ?>
<?php unset($__componentOriginale0f6bf82b872605c3c11e5a0889fb708); ?>
<?php endif; ?>
<?php
  use App\Helpers\SlugHelper;
?>
<div class="events-schedules-area ptb-100">
    <div class="container">
        <div class="row">
            <!-- Mobile Filter Button -->
            <div class="col-12 d-md-none mb-3">
                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#filterCanvas" aria-controls="filterCanvas">
                    <i class="bx bx-slider-alt"></i> Filters
                </button>
            </div>


            <!-- Event Listings -->
            <div class="col-md-9">
                <div class="section-title">
                    <span>Event Schedules</span>
                    <h2>Upcoming Event Schedules</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis nostrud exercitation ullamco.</p>
                </div>

                <div class="row justify-content-center">
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="single-events-schedules">
                                <div class="events-image">
                                    <a href="<?php echo e(route('index', $event->id)); ?>">
                                        <img src="<?php echo e(asset('assets/images/events.webp')); ?>" alt="image">
                                    </a>
                                    <div class="tag">
                                        <a href="<?php echo e(route('events.index', ['category' => $event->department])); ?>">
                                            <?php echo e($event->department); ?>

                                        </a>
                                    </div>
                                </div>

                                <div class="events-content">
                                    <span>
                                        <i class="bx bx-calendar"></i>
                                        <?php echo e(\Carbon\Carbon::parse($event->start_time)->format('d/m/Y')); ?>

                                    </span>
                                    <h3>
                                        <a href="<?php echo e(route('index', $event->id)); ?>">
                                            <?php echo e($event->title); ?>

                                        </a>
                                    </h3>
                                    <p><?php echo e($event->description); ?></p>

<hr>

                                    <p><?php echo e($event->conducted_by); ?></p>
                                            <p><?php echo e($event->location); ?> - <?php echo e($event->venue); ?></p>
                                            <hr>
                                    <div class="bottom-content">
                                        <div class="">
                                            <a href="<?php echo e(route('events.show', ['slug' => $event->slug])); ?>" class="book-btn-one">
                                                <i class="bx bx-arrow-to-right"></i> View Event
                                            </a>




                                        </div>

                                        <div class="book-btn">
                                            <a href="<?php echo e($event->mode == 'online' ? $event->meeting_url : route('index')); ?>" class="book-btn-one">
                                                <i class="bx bx-arrow-to-right"></i>
                                                <?php echo e($event->mode == 'online' ? 'Join Now' : 'Book Now'); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="pagination-area">
                            <?php echo e($events->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<?php $__env->stopSection(); ?>

<style>
    .form-group .form-control {
    height: auto;
    color: #a0a6ab;
    border: 1px solid #ebebeb;
    background-color: #ffffff;
    display: block;
    width: 100%;
    border-radius: 10px;
    padding: 25px;
    transition: 0.6s;
    font-size: 15px;
    font-weight: 400;
    outline: 0;
    font-family: "Poppins", sans-serif;
}
</style>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laragon\www\plevents\resources\views/pages/get-events.blade.php ENDPATH**/ ?>