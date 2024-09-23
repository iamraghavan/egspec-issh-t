<?php $__env->startSection('content'); ?>



<?php if (isset($component)) { $__componentOriginal7148f0f889bac4df853ac91166bfc9ae = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7148f0f889bac4df853ac91166bfc9ae = $attributes; } ?>
<?php $component = App\View\Components\HeroSection::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hero-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\HeroSection::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7148f0f889bac4df853ac91166bfc9ae)): ?>
<?php $attributes = $__attributesOriginal7148f0f889bac4df853ac91166bfc9ae; ?>
<?php unset($__attributesOriginal7148f0f889bac4df853ac91166bfc9ae); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7148f0f889bac4df853ac91166bfc9ae)): ?>
<?php $component = $__componentOriginal7148f0f889bac4df853ac91166bfc9ae; ?>
<?php unset($__componentOriginal7148f0f889bac4df853ac91166bfc9ae); ?>
<?php endif; ?>




<div class="about-us-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="about-us-image">
                    <picture>
                        <source srcset="https://via.placeholder.com/800x800.jpg" type="image/webp">
                        <img src="https://via.placeholder.com/800x800.jpg" alt="About Us Image">
                    </picture>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="about-us-content">
                    <span>Lorem ipsum dolor sit amet</span>
                    <h3>ABOUT THIS EVENT</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin lorem quis bibendum auctor. Nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh.</p>

                    <ul class="list">
                        <li><i class="bx bx-check"></i> Lorem ipsum dolor sit amet</li>
                        <li><i class="bx bx-check"></i> Lorem ipsum dolor sit amet</li>
                        <li><i class="bx bx-check"></i> Lorem ipsum dolor sit amet</li>
                        <li><i class="bx bx-check"></i> Lorem ipsum dolor sit amet</li>
                    </ul>

                    <div class="about-btn">
                        <a href="#" class="default-btn"><i class="bx bx-chevron-right"></i> About Us <span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="benefits-area pt-100 pb-75">
    <div class="container">
        <div class="section-title">
            <h2>Who Benefits?</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/2920/2920073.png" alt="Get Inspired Icon" style="width: 100px; height: 100px;">
                    <h3>Get Inspired</h3>
                    <p>Get motivated by industry leaders and innovators who will share their success stories and strategies.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/2651/2651004.png" alt="Meet New Faces Icon" style="width: 100px; height: 100px;">
                    <h3>Meet New Faces</h3>
                    <p>Expand your professional network by meeting new people, from peers to mentors, in various industries.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/4760/4760444.png" alt="Fresh Tech Insights Icon" style="width: 100px; height: 100px;">
                    <h3>Fresh Tech Insights</h3>
                    <p>Stay updated with the latest technological advancements and how they can benefit your business or career.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/1256/1256655.png" alt="Networking Session Icon" style="width: 100px; height: 100px;">
                    <h3>Networking Session</h3>
                    <p>Join dedicated networking sessions to build meaningful connections with other professionals.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/3905/3905597.png" alt="Global Event Icon" style="width: 100px; height: 100px;">
                    <h3>Global Event</h3>
                    <p>Be a part of a global event that brings together diverse perspectives and experiences from around the world.</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single-benefits">
                    <img src="https://cdn-icons-png.flaticon.com/512/1680/1680005.png" alt="Free Swags Icon" style="width: 100px; height: 100px;">
                    <h3>Free Swags</h3>
                    <p>Enjoy exclusive giveaways and swags that are a token of our appreciation for your participation.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if (isset($component)) { $__componentOriginal74cd10e524500c84035c09a16e53cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74cd10e524500c84035c09a16e53cdc3 = $attributes; } ?>
<?php $component = App\View\Components\EventSchedule::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('event-schedule'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\EventSchedule::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eventDate' => 'Saturday, April 27, 2024','eventTitle' => 'Registration','registerUrl' => 'https://egspec.org/register']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74cd10e524500c84035c09a16e53cdc3)): ?>
<?php $attributes = $__attributesOriginal74cd10e524500c84035c09a16e53cdc3; ?>
<?php unset($__attributesOriginal74cd10e524500c84035c09a16e53cdc3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74cd10e524500c84035c09a16e53cdc3)): ?>
<?php $component = $__componentOriginal74cd10e524500c84035c09a16e53cdc3; ?>
<?php unset($__componentOriginal74cd10e524500c84035c09a16e53cdc3); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginal3bf97f8b59e6900e10d9dde890b0e11a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3bf97f8b59e6900e10d9dde890b0e11a = $attributes; } ?>
<?php $component = App\View\Components\SpeakersSection::resolve(['title' => $title,'description' => $description,'speakers' => $speakers,'viewAllUrl' => $viewAllUrl] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('speakers-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SpeakersSection::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3bf97f8b59e6900e10d9dde890b0e11a)): ?>
<?php $attributes = $__attributesOriginal3bf97f8b59e6900e10d9dde890b0e11a; ?>
<?php unset($__attributesOriginal3bf97f8b59e6900e10d9dde890b0e11a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3bf97f8b59e6900e10d9dde890b0e11a)): ?>
<?php $component = $__componentOriginal3bf97f8b59e6900e10d9dde890b0e11a; ?>
<?php unset($__componentOriginal3bf97f8b59e6900e10d9dde890b0e11a); ?>
<?php endif; ?>





<div class="partner-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2>Event &amp; Venue Partner</h2>


        </div>
       <div class="partner-box">
          <div class="partner-slides owl-carousel owl-theme owl-loaded owl-drag">
             <div class="owl-stage-outer owl-height" style="height: 54.7656px;">
                <div class="owl-stage" style="transform: translate3d(-2292px, 0px, 0px); transition: all 0.5s ease 0s; width: 4584px;">
                    <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="owl-item cloned" style="width: 199.2px; margin-right: 30px;">
                        <div class="single-partner">
                            <a href="#"><img src="<?php echo e($partner['image']); ?>" alt="<?php echo e($partner['name']); ?>"></a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
             </div>
             <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="bx bx-chevron-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="bx bx-chevron-right"></i></button></div>
             <div class="owl-dots disabled"></div>
          </div>
       </div>
    </div>
 </div>

 <!-- CTA -->

 <div class="overview-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12">
                <div class="overview-content">
                    <span>Hurry Up!</span>
                    <h3>Register Now</h3>
                    <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis that bibendum auctor, nisi elit consequat  nec sagittis sem nibh id lorem elit.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="overview-btn">
                    <a href="" class="default-btn"><i class="bx bx-arrow-to-right"></i> Register Now<span style="top: -12.0625px; left: 163.562px;"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\laragon\www\plevents\resources\views/pages/home.blade.php ENDPATH**/ ?>