<!-- resources/views/partials/cookie-consent.blade.php -->

<?php if($show_cookie_notice ?? false): ?>
    <div id="cookieConsent" class="fixed bottom-0 left-0 p-4 bg-gray-800 text-white w-full z-50">
        <div class="container mx-auto flex justify-between items-center">
            <p class="text-sm">
                We use cookies to improve your experience. By using our site, you agree to our <a href="#" class="text-blue-400">Cookie Policy</a>.
            </p>
            <button id="acceptCookies" class="bg-blue-600 px-4 py-2 rounded text-white">Accept</button>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\laragon\laragon\www\plevents\resources\views/partials/cookie-consent.blade.php ENDPATH**/ ?>