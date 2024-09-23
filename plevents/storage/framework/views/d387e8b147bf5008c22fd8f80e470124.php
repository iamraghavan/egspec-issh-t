<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginale0f6bf82b872605c3c11e5a0889fb708 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f6bf82b872605c3c11e5a0889fb708 = $attributes; } ?>
<?php $component = App\View\Components\PageBanner::resolve(['title' => 'Events','breadcrumbs' => [
        ['label' => 'Home', 'url' => route('index')],
        ['label' => 'Events', 'url' => '#'],
        // ['label' => ]
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
<div class="event-details-area ptb-100" id='vanakam_da_mapla'>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="event-details">
                    <div class="event-details-header">
                        <a href="<?php echo e(route('events.index')); ?>" class="back-all-event"><i class="bx bx-chevron-left"></i> Back To All Events</a>
                        <h3><?php echo e($eventDetails->title); ?></h3>
                        <ul class="event-info-meta">
                            <li><i class="bx bx-calendar"></i> <?php echo e(\Carbon\Carbon::parse($eventDetails->date)->format('d F, Y')); ?></li>
                            <li><i class="bx bx-time"></i> <?php echo e(\Carbon\Carbon::parse($eventDetails->start_time)->format('H:i')); ?> - <?php echo e(\Carbon\Carbon::parse($eventDetails->end_time)->format('H:i')); ?></li>
                        </ul>

                    </div>

                    <div class="event-details-image">
                        <img src="<?php echo e(asset('assets/images/events.webp')); ?>" alt="<?php echo e($eventDetails->title); ?>">
                    </div>

                    <div class="event-details-desc">
                        
                    </div>



                    <div class="event-info-links">
                        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=<?php echo e(urlencode($eventDetails->title)); ?>&dates=<?php echo e(\Carbon\Carbon::parse($eventDetails->date . ' ' . $eventDetails->start_time)->format('Ymd\THis\Z')); ?>/<?php echo e(\Carbon\Carbon::parse($eventDetails->date . ' ' . $eventDetails->end_time)->format('Ymd\THis\Z')); ?>&details=<?php echo e(urlencode($eventDetails->description)); ?>&location=<?php echo e(urlencode($eventDetails->venue)); ?>" target="_blank">+ Google Calendar</a>
                        
                    </div>


                    <div class="post-navigation">
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <aside class="widget-area" id="secondary">
                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Details</h3>

                        <ul>
                            <li><span>Department:</span> <?php echo e($eventDetails->department); ?></li>
                            <li><span>Mode:</span> <?php echo e($eventDetails->mode); ?></li>
                            <li><span>Location:</span> <?php echo e($eventDetails->location); ?></li>
                            <li><span>Venue:</span> <?php echo e($eventDetails->venue); ?></li>
                            <?php if($eventDetails->price_type !== 'Idle'): ?>
    <li><span>Price Type:</span> <?php echo e($eventDetails->price_type); ?></li>
<?php else: ?>
    <li><span>Price Type:</span> Paid</li>
<?php endif; ?>

                            <li><span>Amount:</span> <?php echo e($eventDetails->amount); ?></li>
                            <li><span>Created At:</span> <?php echo e(\Carbon\Carbon::parse($eventDetails->created_at)->format('d F, Y H:i')); ?></li>
                            <li><span>Updated At:</span> <?php echo e(\Carbon\Carbon::parse($eventDetails->updated_at)->format('d F, Y H:i')); ?></li>
                        </ul>
                    </div>

                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Organizer</h3>

                        <ul>
                            <li><span>Conducted By:</span> <?php echo e($eventDetails->conducted_by); ?></li>
                        </ul>
                    </div>

                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Venue</h3>

                        <ul>
                            <li><a href="https://www.google.com/maps/search/?api=1&query=<?php echo e(urlencode($eventDetails->venue)); ?>" target="_blank"><?php echo e($eventDetails->venue); ?></a></li>
                            <li><a href="https://www.google.com/maps/search/?api=1&query=<?php echo e(urlencode($eventDetails->venue)); ?>" target="_blank">+ Google Map</a></li>
                        </ul>
                    </div>

                    <div class="widget widget_event_details">
                        <h3 class="widget-title">Register Here</h3>

                    <!-- Button to Open Google Sign-In -->
                    <div class="event-details">
                        <div class="event-info-links">
                            <form action="<?php echo e(route('register.page', ['id' => $eventDetails->id])); ?>" method="GET">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="event_id" value="<?php echo e($eventDetails->id); ?>">
                                <button type="submit" class="default-btn" id="book-btn">Register</button>
                            </form>
                        </div>
                    </div>


<!-- Include Google API script -->


                    </div>

                     <!-- Google One Tap Container -->
    <div id="g_id_onetap_container"></div>


                </aside>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://accounts.google.com/gsi/client" async defer></script>



<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laragon\www\plevents\resources\views/pages/show-event-details.blade.php ENDPATH**/ ?>