@if (!Auth::check())
    <!-- Google One Tap Prompt -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <div id="g_id_onload"
         data-client_id="{{ env('GOOGLE_CLIENT_ID') }}"
         data-callback="handleOneTapLogin"
         data-auto_prompt="true"
         data-auto_select="false"
         data-context="use"
         data-login_uri="{{ route('google.one-tap-callback') }}"
         data-cancel_on_tap_outside="true">
    </div>

    <script>
        window.onload = initializeAuthentication;

        // Initializes authentication process
        function initializeAuthentication() {
            if (window.FedCM) {
                initializeFedCM();
            } else {
                initializeGoogleOneTap();
            }
        }

        // Initializes FedCM and falls back to Google One Tap if failed
        function initializeFedCM() {
            FedCM.initialize({
                autoPrompt: true,
                context: 'use',
                loginUri: '{{ route('google.one-tap-callback') }}'
            }).catch(error => {
                console.warn('FedCM initialization error:', error);
                initializeGoogleOneTap(); // Fallback to Google One Tap
            });
        }

        // Initializes Google One Tap
        function initializeGoogleOneTap() {
            google.accounts.id.initialize({
                client_id: "{{ env('GOOGLE_CLIENT_ID') }}",
                callback: handleOneTapLogin
            });
            google.accounts.id.prompt(); // Prompt the Google One Tap dialog
        }

        // Handles the One Tap login response
        function handleOneTapLogin(response) {
            if (response.error) {
                handleError(response.error);
                return;
            }

            const token = response.credential;
            submitToken(token);
        }

        // Submits token to the server and handles the response
        function submitToken(token) {
            fetch('{{ route('google.one-tap-callback') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ credential: token })
            }).then(response => response.json())
              .then(data => handleLoginResponse(data))
              .catch(handleFetchError);
        }

        // Processes the server's login response
        function handleLoginResponse(data) {
            if (data.success) {
                showModal('Login successful', 'Review All Events and Complete Your Registration', () => {
                    window.location.reload(); // Refresh the page
                });
            } else {
                showModal('Login failed', 'There was a problem logging you in. Please try again.');
            }
        }

        // Handles Google One Tap errors
        function handleError(error) {
            console.error('Google One Tap error:', error);
            showModal('Login failed', 'There was a problem logging you in. Please try again.');
        }

        // Handles fetch errors
        function handleFetchError(error) {
            console.error('Error during fetch:', error);
            showModal('Login failed', 'There was a problem logging you in. Please try again.');
        }

        // Displays modal with a message
        function showModal(title, message, callback = null) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalMessage').innerText = message;

            const myModal = new HystModal({
                linkAttributeName: "data-hystmodal"
            });

            myModal.open('#myModal');

            // Execute callback function if provided
            if (callback) {
                setTimeout(callback, 2000); // Call the callback after 2 seconds
            }
        }
    </script>
@endif
