<!-- resources/views/components/hero-section.blade.php -->
<div class="main-banner-area-box" x-data="countdownTimer()" x-init="startTimer()">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="main-banner-content-box">
                    <p class="sub-title wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">Our Upcoming Events:</p>
                    <h1 class="wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1000ms">EGSPEC Biggest Event 2024</h1>

                    <div class="banner-soon-content wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">
                        <div id="timer">
                            <div id="days"></div>
                            <div id="hours"></div>
                            <div id="minutes"></div>
                            <div id="seconds"></div>
                        </div>
                    </div>

                    <ul class="banner-list wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">
                        <li><i class="bx bx-calendar"></i> 05/08/2024</li>
                        <li>GLOBAL AZURE 2024-CHENNAI</li>
                    </ul>

                    <ul class="banner-btn-list wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">
                        <li><a href="<?php echo e(route('google.popup.login')); ?>" class="default-btn"><i class="bx bx-arrow-to-right"></i> Register Now<span></span></a></li>
                        <li class="calender-btn"><i class="bx bxs-plus-circle"></i> <a href="#">Add a Calendar</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="main-banner-image-wrap wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="2000ms">
                    <img src="<?php echo e(asset('assets/h-img.webp')); ?>" alt="image">
                </div>
            </div>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    // Function to format numbers to two digits
    function formatNumber(num) {
        return num < 10 ? '0' + num : num;
    }

    // Function to update the countdown timer
    function updateCountdown(endTime) {
        try {
            const now = Math.floor(Date.now() / 1000);
            const timeLeft = endTime - now;

            if (timeLeft < 0) {
                document.getElementById('countdown').innerHTML = "Countdown Ended";
                return;
            }

            const days = Math.floor(timeLeft / 86400);
            const hours = Math.floor((timeLeft % 86400) / 3600);
            const minutes = Math.floor((timeLeft % 3600) / 60);
            const seconds = Math.floor(timeLeft % 60);

            document.getElementById('days').innerHTML = `${days}<span> Days</span>`;
            document.getElementById('hours').innerHTML = `${formatNumber(hours)}<span> Hours</span>`;
            document.getElementById('minutes').innerHTML = `${formatNumber(minutes)}<span> Minutes</span>`;
            document.getElementById('seconds').innerHTML = `${formatNumber(seconds)}<span> Seconds</span>`;
        } catch (error) {
            console.error('An error occurred while updating the countdown:', error);
            document.getElementById('countdown').innerHTML = "Error in countdown.";
        }
    }

    // Initialize the countdown
    function initializeCountdown(endDate) {
        const endTime = new Date(endDate).getTime() / 1000;
        updateCountdown(endTime);
        setInterval(() => updateCountdown(endTime), 1000);
    }

    // Example usage
    initializeCountdown("September 11, 2024 11:30:00 GMT+0530");
</script>
<?php /**PATH D:\laragon\laragon\www\plevents\resources\views/components/hero-section.blade.php ENDPATH**/ ?>