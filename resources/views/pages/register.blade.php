@extends('layout.app')

@section('content')


<div class="container mt-5">
    <div class="row">
    <div class="col-lg-7">
        <div class="register-form">
            <h2>Register for Event</h2>
            <form id="registration-form" action="">
                @csrf

                <!-- Hidden fields for event ID and Google UID -->
                <input type="hidden" name="event_id" id="event_id" value="{{ $selectedEvent ? $selectedEvent->id : '' }}">
                <input type="hidden" id="google_uid" name="google_uid" value="{{ Auth::check() ? Auth::user()->google_id : '' }}">
                <input type="hidden" name="totalValue_rj" id='totalValue_rj' value="{{ $selectedEvent ? $selectedEvent->amount : '' }}">

                <!-- Event Title (Dropdown) -->
                <div class="form-group">
                    <label for="event_title">Event:</label>
                    <select class="form-control" id="event_title" name="event_title" required>
                        <option value="">Select an Event</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" data-amount="{{ $event->amount }}" data-price-type="{{ $event->price_type }}" {{ $selectedEvent->id == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="registration_type">Registration Type:</label>
                    <select class="form-control" id="registration_type" name="registration_type" required>
                        <option value="individual">Individual</option>
                        <option value="group">Group</option>
                    </select>
                </div>

                <!-- Number of Members (Visible only if Group is selected) -->
                <div class="form-group" id="members-group" style="display: none;">
                    <label for="number_of_members">Number of Members (Max 3):</label>
                    <input type="number" class="form-control" id="number_of_members" name="number_of_members" min="1" max="3">
                </div>



                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ Auth::check() ? Auth::user()->name : old('name') }}"
                           pattern="[a-zA-Z\s]+" title="Only alphabets and spaces are allowed" required>
                </div>

                  <!-- Group Members' Names (Dynamically Generated) -->
                  <div id="members-names"></div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                           {{ Auth::check() ? 'readonly' : '' }} required>
                </div>

                <!-- Phone (with country dropdown and validation) -->
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" maxlength="15" title="Please enter a valid phone number" required>
                </div>



                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" pattern="[a-zA-Z0-9\s,.-]+" title="Please enter a valid address" required>
                </div>


                <!-- Country -->
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select class="form-control" id="country" name="country" required>
                        <option value="">Select Country</option>
                        <!-- Dynamically populated -->
                    </select>
                </div>

                <!-- State -->
                <div class="form-group">
                    <label for="state">State:</label>
                    <select class="form-control" id="state" name="state" required>
                        <option value="">Select State</option>
                        <!-- Dynamically populated -->
                    </select>
                </div>

                <!-- City -->
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ old('city') }}" pattern="[a-zA-Z\s]+" title="Only alphabets and spaces are allowed" required>
                </div>

                <!-- Pincode -->
                <div class="form-group">
                    <label for="pincode">Pincode:</label>
                    <input type="text" class="form-control" id="pincode" name="pincode"
                           pattern="\d{6}" title="Pincode must be 6 digits" maxlength="6" required>
                    <small id="pincode-error" class="text-danger"></small>
                </div>

                <!-- Amount -->
                <div class="form-group" id="amount-group">
                    <label for="amount">Amount (INR):</label>
                    <input type="number" class="form-control" id="amount" name="amount"
                           value="{{ $selectedEvent ? $selectedEvent->amount : '' }}" readonly>
                </div>

                <p class="description">By registering for this event, you agree to the <a href="#terms-and-conditions">terms and conditions</a> and <a href="#payment-policy">payment policy</a> outlined below. Please ensure you have read and understood them before proceeding with your registration.</p>

                <!-- Submit Button -->
                <button type="submit" class="default-btn">Register <span></span></button>
            </form>





        </div>
    </div>




    <div class="col-lg-5">
        <!-- Event details here -->
        <div class="captureCard card border-0">
            <div class="card-body d-flex flex-column justify-content-between text-white p-0">
                <div class="p-4 bg-top">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <h1 id="event-title" class="text-white text-align-center"></h1>
                            <span id="event-location" class="mb-2 text-white"></span>
                            <span id="event-date-time"></span>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <i class="fa fa-calendar fa-3x"></i>
                        </div>

                    </div>
                </div>
                <div class="bg-danger p-4">
                    <div class="d-flex flex-column justify-content-between">
                        <div class="d-flex flex-row justify-content-between text-center">
                            <div>
                                <span id="event-department" class="mb-2"></span> |
                                <span id="event-mode"></span>
                            </div>
                            <div>

                                <span id="event-price-type"></span>
                            </div>
                            <div>
                                <span class=" mb-2 font-weight-bold">Amount</span> -
                                <span id="event-amount"></span>
                            </div>
                        </div>
                        <div class="doted-lines">
                            <hr class="dotted-line">
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <div class="d-flex flex-column">
                                <div>

                                    <span id='event-venue'></span> |
                                    <span id="event-name">{{ Auth::check() ? Auth::user()->name : old('name') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-row justify-content-center">
                            <div class="d-flex flex-column">
                                <div class="qr-code">
                                    {!! $qrCode !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                                        @php
                        $welcomeMessage = 'Get ready for an unforgettable experience! I just registered for the event.';
                    @endphp

                <div class="card-footer bg-top p-3">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="d-flex flex-column">

                            <div class="social-icons d-flex flex-row">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}&quote={{ urlencode($welcomeMessage) }}" target="_blank" class="mr-5">
                                    <i class="bx bxl-facebook" style="font-size: 24px; color: #fff;"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ urlencode($welcomeMessage) }} {{ urlencode(request()->fullUrl()) }}" target="_blank" class="mr-5">
                                    <i class="bx bxl-whatsapp" style="font-size: 24px; color: #fff;"></i>
                                </a>

                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($welcomeMessage) }}&summary=&source=" target="_blank" class="mr-5">
                                    <i class="bx bxl-linkedin" style="font-size: 24px; color: #fff;"></i>
                                </a>

                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($welcomeMessage) }}" target="_blank" class="mr-5">
                                    <i class="bx bxl-twitter" style="font-size: 24px; color: #fff;"></i>
                                </a>

                                <a href="mailto:?subject={{ urlencode($welcomeMessage) }}&body={{ urlencode(request()->fullUrl()) }}" target="_blank" class="mr-5">
                                    <i class="bx bxs-envelope" style="font-size: 24px; color: #fff;"></i>
                                </a>

                                <a href="#" target="_blank" class="mr-5">
                                    <i class="bx bxl-rss" style="font-size: 24px; color: #fff;"></i>
                                </a>
                            </div>
                        </div>
                        {{-- <div class="d-flex flex-column">
                            <a href="#" id="download" class="btn btn-success"><i class="bx bx-download" style="font-size: 18px; margin-right: 5px;"></i> Download Image</a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class=" p-3">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex flex-column" id="total_hide">
                        <h5 class="card-title">Summary</h5>
                        <p>Price (Per Person): ₹<span id="item-price"></span></p>
                        <p id="total-amount">Total Amount: ₹0.00</p>
                        <p id="member-price-summary">0 x 0 = </p>
                        <p class="text-muted">2% Applicable on all transactions (Payment Gateway Fees) *</p>
                        <p class="text-muted">* 18% GST applicable</p>
                    </div>
                    <p id="event-summary" class="text-muted fs-25" style="
color: var(--bs-success) !important;
"></p>
                    </div>

                    <!-- Payment Form -->

                </div>
            </div>
        </div>

    </div>





    </div>
</div>



<style>
    .bg-blue {
        background: blue;
    }

    .dotted-line {
        border: 1px dashed #fff;
    }

    .img-fluid {
        width: 114px;
        height: auto;
    }

    .bg-top {
        background: #8E24AA;
    }

    .card-footer {
        border-top: 1px solid #ddd;
    }

    .qr-code {

        border: 1rem solid #fff;
        padding: 1rem;
        margin: 1rem
    }

    .qr-code svg {
        width: 100%;
        height: 100%;
    }


    .social-icons a {
margin-right: 10px;
color: #fff;
}

.social-icons a:hover {
/* color: #fff; */
text-decoration: none;
}

.card-footer .btn-success {
background-color: #dc3545;
border-color: #dc3545;
color: #fff;
}

.card-footer .btn-success:hover {
background-color: #dc354681;
border-color: #dc354681;
color: #fff;
}
.iti__search-input{
    padding: 1rem !important;
    text-transform: uppercase !important;
    font-weight: 700;
}

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/css/intlTelInput.css">
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Constants
    const rj_bookingFeePercentage = 2; // Booking fee percentage
    const rj_gstPercentage = 18; // GST percentage

    // Document Ready
    document.addEventListener("DOMContentLoaded", function() {
        initializeEventListeners();
        initializePhoneInput();
        initializeEventDetails();
    });

    // Initialize event listeners for form and event selection
    function initializeEventListeners() {
        const registrationType = document.getElementById('registration_type');
        const numberOfMembers = document.getElementById('number_of_members');
        const eventTitleSelect = document.getElementById('event_title');
        const registrationForm = document.getElementById('registration-form');

        registrationType.addEventListener('change', handleRegistrationTypeChange);
        numberOfMembers.addEventListener('input', handleNumberOfMembersInput);
        eventTitleSelect.addEventListener('change', handleEventTitleChange);
        registrationForm.addEventListener('submit', handleFormSubmit);
    }

    // Handle registration type change
    function handleRegistrationTypeChange() {
        const registrationType = document.getElementById('registration_type');
        const membersGroup = document.getElementById('members-group');
        const membersNames = document.getElementById('members-names');
        const numberOfMembers = document.getElementById('number_of_members');

        if (registrationType.value === 'group') {
            membersGroup.style.display = 'block';
            numberOfMembers.setAttribute('required', 'required');
        } else {
            membersGroup.style.display = 'none';
            membersNames.innerHTML = '';
            numberOfMembers.removeAttribute('required');
            updateTotalAmount();
        }
    }

    // Handle number of members input
    function handleNumberOfMembersInput() {
        const numberOfMembers = document.getElementById('number_of_members');
        const membersNames = document.getElementById('members-names');

        const membersCount = parseInt(numberOfMembers.value, 10);

        if (membersCount < 2 || membersCount > 3) {
    Swal.fire(
        'Error',
        membersCount < 2
            ? 'Please select the "Individual" option for single-member registration.'
            : 'You cannot register more than 3 members.',
        'error'
    );
    numberOfMembers.value = '';
    membersNames.innerHTML = '';
    updateTotalAmount();
    return;
}


        membersNames.innerHTML = '';
        for (let i = 1; i <= membersCount; i++) {
            const div = document.createElement('div');
            div.classList.add('form-group');
            div.innerHTML = `
                <label for="member_name_${i}">Member ${i} Name:</label>
                <input type="text" class="form-control" id="member_name_${i}" name="member_name_${i}" pattern="[a-zA-Z0-9\s,.-]+" title="Only alphabets and spaces are allowed" required>
            `;
            membersNames.appendChild(div);
        }
        updateTotalAmount();
    }

    const selectElement = document.getElementById('event_title');
    const footerMessageElement = document.getElementById("event-summary");
    const summaryDiv = document.getElementById("total_hide");

    selectElement.addEventListener('change', function() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectedAmount = parseFloat(selectedOption.getAttribute('data-amount'));
        const isFreeEvent = selectedOption.getAttribute('data-price-type') === 'free';

        if (!isNaN(selectedAmount)) {
            if (selectedAmount === 0 || isFreeEvent) {
                // Hide summary div and show footer message
                summaryDiv.style.setProperty('display', 'none', 'important');
                footerMessageElement.textContent = "This event is Free. To secure your spot, please click 'Register' to complete your registration process.";
            } else {
                // Calculate total price and update summary
                updateTotalAmount();

                // Show summary div and hide footer message
                summaryDiv.style.setProperty('display', 'flex', 'important');
                footerMessageElement.textContent = "";
            }
        }
    });

    // Update total amount based on selection and input
    function updateTotalAmount() {
        const registrationType = document.getElementById('registration_type').value;
        const numberOfMembers = registrationType === 'group' ? (parseInt(document.getElementById('number_of_members').value, 10) || 1) : 1;
        const selectedAmount = parseFloat(document.querySelector('#event_title').selectedOptions[0].getAttribute('data-amount')) || 0;

        const totalPricePerPerson = selectedAmount;
        const totalPrice = calculateTotalPrice(totalPricePerPerson, numberOfMembers);

        document.getElementById('item-price').textContent = totalPricePerPerson.toFixed(2);
        document.getElementById('total-amount').textContent = `Total Amount: ₹${totalPrice.toFixed(2)}`;
        document.getElementById('totalValue_rj').value = `${totalPrice.toFixed(2)}`;
        document.getElementById('member-price-summary').textContent = `${numberOfMembers} x ${totalPricePerPerson.toFixed(2)} = ₹${totalPrice.toFixed(2)}`;
    }

    // Calculate total price including booking fee and GST
    function calculateTotalPrice(amountPerPerson, numberOfPeople) {
        const amount = amountPerPerson * numberOfPeople;
        const bookingFee = (amount * rj_bookingFeePercentage) / 100;
        const gst = (amount * rj_gstPercentage) / 100;
        return amount + bookingFee + gst;
    }

    // Initialize phone input with intlTelInput
    function initializePhoneInput() {
    const input = document.querySelector("#phone");
    window.intlTelInput(input, {
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.3.4/build/js/utils.js",
        autoPlaceholder: "off",
        nationalMode: false,
        separateDialCode: true,
        initialCountry: "in",
        preferredCountries: ["in"],
        format: "international",
    });

    input.value = "+91";

    input.addEventListener("keyup", () => {
        const isValid = input.getAttribute("data-valid");
        if (isValid === "true") {
            input.classList.add("valid");
            input.classList.remove("error");
        } else {
            input.classList.add("error");
            input.classList.remove("valid");
        }
    });
}

// Initialize on document load
document.addEventListener("DOMContentLoaded", initializePhoneInput);


    // Initialize event details based on selection
    function initializeEventDetails() {
        const eventTitleSelect = document.getElementById('event_title');

        eventTitleSelect.addEventListener('change', handleEventTitleChange);
        eventTitleSelect.dispatchEvent(new Event('change')); // Trigger change on page load
    }

    // Handle event title change and update details
    function handleEventTitleChange() {
        const eventTitleSelect = document.getElementById('event_title');
        const selectedEventId = eventTitleSelect.value;
        const selectedEvent = @json($events).find(event => event.id == selectedEventId);

        if (selectedEvent) {
            document.getElementById('event-title').textContent = selectedEvent.title;
            document.getElementById('event-location').textContent = selectedEvent.location;
            document.getElementById('event-date-time').textContent = `${selectedEvent.date} ${selectedEvent.start_time}`;
            document.getElementById('event-department').textContent = selectedEvent.department;
            document.getElementById('event-mode').textContent = selectedEvent.mode;
            document.getElementById('event-price-type').textContent = selectedEvent.price_type;
            document.getElementById('event-amount').textContent = `${selectedEvent.amount} INR`;
            document.getElementById('event-venue').textContent = selectedEvent.venue;

            updateAmountFieldVisibility(selectedEvent);
            updateTotalAmount();
        }
    }

    // Update visibility of amount field based on event
    function updateAmountFieldVisibility(selectedEvent) {
        const amountGroup = document.getElementById('amount-group');
        const amountInput = document.getElementById('amount');

        if (selectedEvent.price_type === 'free' || selectedEvent.amount == 0) {
            amountGroup.style.display = 'none';
            amountInput.disabled = true;
        } else {
            amountGroup.style.display = '';
            amountInput.disabled = false;
        }
    }

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
        });

    // Handle country change
    countrySelect.addEventListener('change', function () {
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
                body: JSON.stringify({ iso2: countryCode })
            })
            .then(response => response.json())
            .then(data => {
                data.data.states.forEach(state => {
                    let option = document.createElement('option');
                    option.value = state.name;
                    option.text = state.name;
                    stateSelect.add(option);
                });
            });
        }
    });

    // Handle form submission and payment
    async function handleFormSubmit(e) {
    e.preventDefault();

    const formElement = document.getElementById('registration-form');
    const formData = new FormData(formElement);
    const totalValue = parseFloat(formData.get('totalValue_rj').replace('₹', '').trim());

    formData.forEach((value, key) => {
        console.log(`${key}: ${value}`);
    });

    try {
        if (totalValue > 0) {
            // Handle payment gateway logic
            const orderResponse = await axios.post('/create-razorpay-order', {
                amount: totalValue * 100
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const { order_id } = orderResponse.data;

            if (!order_id) {
                throw new Error('Failed to create order');
            }

            const options = {
                key: "{{ env('RAZORPAY_KEY_ID') }}",
                amount: totalValue * 100,
                currency: "INR",
                name: "{{ config('app.name') }}",
                description: "Event Registration",
                order_id: order_id,
                handler: async function(response) {
                    try {
                        console.table([
                            {
                                'Payment ID': response.razorpay_payment_id,
                                'Order ID': response.razorpay_order_id
                            }
                        ]);

                        formData.append('payment_id', response.razorpay_payment_id);
                        formData.append('order_id', response.razorpay_order_id);

                        // Proceed with registration after successful payment
                        const registrationResponse = await axios.post('/events/sessions/register', formData, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (registrationResponse.data.success) {
                            Swal.fire('Success', 'Your registration was successful!', 'success').then(() => {
                                window.location.href = '/events/sessions/thank-you';
                            });
                        } else {
                            throw new Error('Registration failed');
                        }
                    } catch (error) {
                        Swal.fire('Error', 'Payment was debited but registration failed. Please contact admin or team using web[at]egspec[dot]org or raghavan[at]egspec[dot]org.', 'error');
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

            const rzp = new Razorpay(options);
            rzp.open();

        } else {
            // Amount is zero or free, skip payment gateway and directly submit form
            formData.append('payment_id', '');
            formData.append('order_id', '');

            const registrationResponse = await axios.post('/events/sessions/register', formData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (registrationResponse.data.success) {
                Swal.fire('Success', 'Your registration was successful!', 'success').then(() => {
                    window.location.href = '/events/sessions/thank-you';
                });
            } else {
                throw new Error('Registration failed');
            }
        }
    } catch (error) {
        Swal.fire('Error', error.message || 'An unexpected error occurred. Please contact admin or team using web[at]egspec[dot]org or raghavan[at]egspec[dot]org.', 'error');
    }
}


</script>

@endsection
