const rj_bookingFeePercentage = 2; // booking fee percentage
const rj_gstPercentage = 18; // GST percentage

document.addEventListener("DOMContentLoaded", function() {
    const selectElement = document.querySelector('select');
    const totalAmountElement = document.getElementById("total-amount");
    const itemPriceElement = document.getElementById("item-price");
    const eventSummaryElement = document.getElementById("event-summary");
    const paymentButtonElement = document.getElementById("payment-button");
    const footerMessageElement = document.getElementById("event-summary");
    const summaryDiv = document.getElementById("total_hide");
    const totalValueRjInput = document.getElementById('totalValue_rj');

    function updateUI(isFreeEvent, selectedAmount) {
        if (isFreeEvent || selectedAmount === 0) {
            hideSummary();
            footerMessageElement.textContent = "This event is Free. To secure your spot, please click 'Register' to complete your registration process.";
        } else {
            const totalPrice = calculateTotalPrice(selectedAmount);
            updateSummary(totalPrice, selectedAmount);
            showSummary();
            footerMessageElement.textContent = "";
        }
    }

    function hideSummary() {
        summaryDiv.style.setProperty('display', 'none', 'important');
    }

    function showSummary() {
        summaryDiv.style.setProperty('display', 'flex', 'important');
    }

    function calculateTotalPrice(amount) {
        const bookingFee = (amount * rj_bookingFeePercentage) / 100;
        const gst = (amount * rj_gstPercentage) / 100;
        return amount + bookingFee + gst;
    }

    function updateSummary(totalPrice, itemPrice) {
        totalAmountElement.textContent = `Total Amount: ₹${totalPrice.toFixed(2)}`;
        itemPriceElement.textContent = `₹${itemPrice.toFixed(2)}`;
        totalValueRjInput.value = totalPrice.toFixed(2);
    }

    function handleSelectChange() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectedAmount = parseFloat(selectedOption.getAttribute('data-amount'));
        const isFreeEvent = selectedOption.getAttribute('data-price-type') === 'free';
        if (!isNaN(selectedAmount)) {
            updateUI(isFreeEvent, selectedAmount);
        }
    }

    // Initialize the summary with the default selected amount
    handleSelectChange();
    selectElement.addEventListener('change', handleSelectChange);
});


document.addEventListener('DOMContentLoaded', function() {
    initializePhoneInput();
    initializeEventSelect();
    initializeNameInput();
    initializeLocationSelect();
    initializeDownloadButton();
    initializeFormSubmission();
});

function initializePhoneInput() {
    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/js/utils.js",
        autoPlaceholder: "off",
        nationalMode: false,
        separateDialCode: true,
        initialCountry: "in", // Set India as the default country
        preferredCountries: ["in"],
        format: "international" // Add this option to display country code
    });

    // Set the default country code to +91 (India)
    input.value = "+91";

    input.addEventListener("keyup", () => {
        const isValid = input.getAttribute("data-valid") === "true";
        input.classList.toggle("valid", isValid);
        input.classList.toggle("error", !isValid);
    });
}

function initializeEventSelect() {
    const eventTitleSelect = document.getElementById('event_title');
    const amountInput = document.getElementById('amount');
    const amountGroup = document.getElementById('amount-group');
    const eventIdInput = document.getElementById('event_id');
    const events = @json($events);

    eventTitleSelect.addEventListener('change', function() {
        const selectedEventId = eventTitleSelect.value;
        const selectedEvent = events.find(event => event.id == selectedEventId);

        if (selectedEvent) {
            eventIdInput.value = selectedEvent.id;
            amountInput.value = selectedEvent.amount;

            // Reflect ID and title in the URL
            const url = new URL(window.location.href);
            url.searchParams.set('id', selectedEvent.id);
            url.searchParams.set('title', encodeURIComponent(selectedEvent.title));
            window.history.replaceState({}, '', url);

            // Hide or disable the amount field if the event is free or the amount is 0
            if (selectedEvent.price_type === 'free' || selectedEvent.amount == 0) {
                amountGroup.style.display = 'none'; // Hide the amount field
                amountInput.disabled = true; // Disable the amount input
            } else {
                amountGroup.style.display = ''; // Show the amount field
                amountInput.disabled = false; // Enable the amount input
            }

            // Update event details display
            updateEventDetails(selectedEvent);
        }
    });

    // Trigger change event on page load to handle pre-selected event
    eventTitleSelect.dispatchEvent(new Event('change'));
}

function updateEventDetails(event) {
    document.getElementById('event-title').textContent = event.title;
    document.getElementById('event-location').textContent = event.location;
    document.getElementById('event-date-time').textContent = `${event.date} ${event.start_time}`;
    document.getElementById('event-department').textContent = event.department;
    document.getElementById('event-mode').textContent = event.mode;
    document.getElementById('event-price-type').textContent = event.price_type;
    document.getElementById('event-amount').textContent = `${event.amount} INR`;
    document.getElementById('event-venue').textContent = event.venue;
}

function initializeNameInput() {
    const eventNameSpan = document.getElementById('event-name');
    const nameInput = document.getElementById('name');

    nameInput.addEventListener('input', function() {
        eventNameSpan.textContent = nameInput.value;
    });
}

function initializeLocationSelect() {
    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');

    // Fetch countries from Rest Countries API
    fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
            data.forEach(country => {
                let option = document.createElement('option');
                option.value = country.cca2; // Use country code for fetching states
                option.text = country.name.common;
                countrySelect.add(option);
            });
        })
        .catch(error => console.error('Error fetching countries:', error));

    // Handle country change
    countrySelect.addEventListener('change', function() {
        const countryCode = this.value;

        // Clear previous state and city options
        stateSelect.innerHTML = '<option value="">Select State</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';

        if (countryCode) {
            // Fetch states from CountryStateCity API
            fetch(`https://countriesnow.space/api/v0.1/countries/states`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        iso2: countryCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    data.data.states.forEach(state => {
                        let option = document.createElement('option');
                        option.value = state.name;
                        option.text = state.name;
                        stateSelect.add(option);
                    });
                })
                .catch(error => console.error('Error fetching states:', error));
        }
    });
}

function initializeDownloadButton() {
    const downloadButton = document.getElementById('download');

    downloadButton.addEventListener('click', () => {
        const card = document.querySelector('.captureCard');
        if (!card) {
            console.error("Element with class 'captureCard' not found!");
            return;
        }

        // Hide the footer content
        const footer = card.querySelector('.card-footer');
        if (footer) footer.style.display = 'none';

        // Add the thanks note
        const thanksNote = document.createElement('div');
        thanksNote.innerHTML = `
                    Thank you so much for registering for the event! We’re excited to have you join us and look forward to seeing you there. Please don't hesitate to reach out if you have any questions or need further information.

                    Best regards,
                    Dr. S.Palani Murugan
                    E.G.S Pillay Engineering College
                `;
        thanksNote.style.fontSize = '18px';
        thanksNote.style.fontWeight = 'bold';
        thanksNote.style.color = '#000';
        thanksNote.style.padding = '10px';
        thanksNote.style.background = '#fff';
        card.appendChild(thanksNote);

        // Add the logo
        const logo = document.createElement('img');
        logo.src = '/assets/images/logo_tran.svg';
        logo.crossOrigin = 'anonymous'; // Add this attribute
        logo.style.width = 'auto';
        logo.style.height = '100px';
        logo.style.margin = '20px auto';
        logo.style.display = 'block';
        card.appendChild(logo);

        // Add a white header background
        const header = card.querySelector('.card-body');
        if (header) header.style.background = '#fff';

        // Delay the html2canvas call until the elements are visible in the DOM
        setTimeout(() => {
            html2canvas(card, {
                useCORS: true,
                logging: true,
                scale: 2
            }).then(canvas => {
                const link = document.createElement('a');
                const randomNumber = Math.floor(10000 + Math.random() * 90000);
                link.download = `egspec-event-${randomNumber}.png`;
                link.href = canvas.toDataURL();
                link.click();

                // Remove the added elements
                thanksNote.remove();
                logo.remove();
                if (footer) footer.style.display = 'block';
                if (header) header.style.background = '';
            }).catch(error => console.error('Error generating screenshot:', error));
        }, 100);
    });
}

function initializeFormSubmission() {
    const registrationForm = document.getElementById('registration-form');

    registrationForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        try {
            // Get and validate form data
            const formData = new FormData(this);
            const totalValue = parseFloat(formData.get('totalValue_rj').replace('₹').trim());

            if (isNaN(totalValue) || totalValue <= 0) {
                throw new Error('Invalid total value');
            }

            // Display form data for debugging
            formData.forEach((value, key) => {
                console.log(`${key}: ${value}`);
            });

            // Create a new Razorpay order on the server
            const orderResponse = await axios.post('/create-razorpay-order', {
                amount: totalValue * 100 // Convert amount to paise
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const {
                order_id
            } = orderResponse.data;

            if (!order_id) {
                throw new Error('Failed to create order');
            }

            // Configure Razorpay options
            const options = {
                key: "{{ env('RAZORPAY_KEY_ID') }}", // Razorpay key ID from env
                amount: totalValue * 100, // Amount in paise
                currency: "INR",
                name: "{{ config('app.name') }}",
                description: "Event Registration",
                order_id: order_id,
                handler: async function(response) {
                    try {
                        // Log payment details
                        console.log('Payment ID:', response.razorpay_payment_id);
                        console.log('Order ID:', response.razorpay_order_id);

                        // Append payment details to form data
                        formData.append('payment_id', response.razorpay_payment_id);
                        formData.append('order_id', response.razorpay_order_id);

                        // Send data to server for registration processing
                        const registrationResponse = await axios.post('/events/sessions/register', formData, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (registrationResponse.data.success) {
                            Swal.fire('Success', 'Your registration was successful!', 'success').then(() => {
                                window.location.href = '/events/thank-you';
                            });
                        } else {
                            throw new Error('Registration failed');
                        }
                    } catch (error) {
                        console.error('Error during registration:', error);
                        Swal.fire('Error', 'An error occurred while processing your registration.', 'error');
                    }
                },
                prefill: {
                    name: formData.get('name'),
                    email: formData.get('email'),
                    contact: formData.get('phone')
                },
                theme: {
                    color: "#3399cc"
                }
            };

            const rzp1 = new Razorpay(options);
            rzp1.open();
        } catch (error) {
            console.error('Error initiating payment:', error);
            Swal.fire('Error', error.message || 'An error occurred while initiating the payment.', 'error');
        }
    });
}
