<div class="events-schedules-area ptb-100">
    <div class="container">
        <div class="section-title text-center mb-4">
            <span>Monthly Event Schedules</span>
            <h2>Upcoming Events</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis nostrud exercitation ullamco.</p>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="departmentTabs" role="tablist">
            @foreach($departments as $department => $events)
                <li class="nav-item" role="presentation">
                    <a class="nav-link{{ $loop->first ? ' active' : '' }}" id="tab-{{ str_replace(' ', '-', $department) }}" data-bs-toggle="tab" href="#content-{{ str_replace(' ', '-', $department) }}" role="tab">{{ $department }}</a>
                </li>
            @endforeach
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="departmentTabsContent">
            @foreach($departments as $department => $events)
                <div class="tab-pane fade{{ $loop->first ? ' show active' : '' }}" id="content-{{ str_replace(' ', '-', $department) }}" role="tabpanel">
                    <div class="events-schedules-table">
                        @foreach($events->take(5) as $event)
                            <div class="row align-items-start mb-4" data-event='@json($event)'>
                                <!-- Event Date and Time -->
                                <div class="col-lg-2 col-md-4 mb-3 mb-md-0">
                                    <div class="time-content">
                                        <p><i class="bx bx-calendar"></i> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                                        <span>{{ \Carbon\Carbon::parse($event->start_time)->format('h:i a') }} – {{ \Carbon\Carbon::parse($event->end_time)->format('h:i a') }}</span>

                                    </div>
                                </div>

                                <!-- Event Title and Description -->
                                <div class="col-lg-5 col-md-8 mb-3 mb-md-0">
                                    <div class="content-title">
                                        <h3><a target="_blank" rel="noopener" href="{{ route('events.show', ['slug' => $event->slug]) }}">{{ $event->title }}</a></h3>
                                        <p><strong>Venue:</strong> {{ $event->venue }}</p>


                                    </div>
                                </div>

                                <!-- Speaker Information -->
                                <div class="col-lg-3 mb-3 mb-md-0">
                                    <div class="content-info">

                                        <h4>{{ $event->conducted_by }}</h4>
                                        <p><strong>Mode:</strong> {{ $event->mode }}</p>

                                    </div>
                                </div>

                                <!-- Pricing and Register Button -->
                                <div class="col-lg-2">
                                    <div class="content-btn">
                                        @if($event->price_type == 'Idle' && !is_null($event->amount) && is_numeric($event->amount))
                                            <!-- Display the amount if price_type is 'Idle' and amount is valid -->
                                            <p class="pricing">Price: ₹{{ number_format($event->amount, 2) }}</p>
                                        @elseif($event->price_type == 'Free')
                                            <!-- Display 'Free' if price_type is 'Free' -->
                                            <p class="free">Free</p>
                                        @else
                                            <!-- Handle unexpected cases -->
                                            <p class="pricing">Price Information Unavailable</p>
                                        @endif
                                        <!-- Registration Button -->
                                        <a href="{{ route('register.page', ['id' => $event->id]) }}" rel="noopener" target="_blank" class="default-btn">
                                            Register<span></span>
                                        </a>




                                    </div>
                                </div>







                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>





    </div>
</div>

<style>
    .hystmodal__window {

        padding: 20px;

    }

#register-button, #view-details-button{
    color: #fff !important;
}


    .modal-content h2 {
        margin-top: 0;
        font-size: 24px;
        color: #333;
    }

    .modal-content p {
        margin: 10px 0;
        color: #555;
    }

    .modal-content strong {
        color: #333;
    }

    .modal-content span {
        color: #777;
        font-size: 16px;
    }

    .modal-content a {
        color: #3498db;
        text-decoration: none;
        font-weight: bold;
    }

    .modal-content a:hover {
        text-decoration: underline;
    }

    .modal-content p {
        line-height: 1.6;
    }
</style>

<!-- Event Details Modal -->

<div class="hystmodal" id="eventDetailsModal" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <button data-hystclose class="hystmodal__close">Close</button>
            <div class="modal-content">
                <h2 id="modal-title"></h2>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td id="modal-date"></td>
                        </tr>
                        <tr>
                            <td><strong>Time:</strong></td>
                            <td id="modal-time"></td>
                        </tr>
                        <tr>
                            <td><strong>Venue:</strong></td>
                            <td id="modal-venue"></td>
                        </tr>
                        <tr>
                            <td><strong>Mode:</strong></td>
                            <td id="modal-mode"></td>
                        </tr>
                        <tr>
                            <td><strong>Description:</strong></td>
                            <td id="modal-description"></td>
                        </tr>
                        <tr>
                            <td><strong>Conducted By:</strong></td>
                            <td id="modal-conducted-by"></td>
                        </tr>
                        <tr>
                            <td><strong>Location:</strong></td>
                            <td id="modal-location"></td>
                        </tr>
                        <tr>
                            <td><strong>Price:</strong></td>
                            <td id="modal-price"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal-buttons">
                    <a id="register-button" href="#" class="btn btn-primary">Register</a>
                    <a id="view-details-button" href="#" class="btn btn-secondary">View Full Details</a>
                </div>
                <div class="modal-footer">
                    <p>For technical support, email us at <a href="mailto:web@egspec.org">web[at]egspec[dot]org</a> or <a href="mailto:raghavan@egspec.org">raghavan[at]egspec[dot]org</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- HystModal CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/hystmodal@0.7.7/dist/hystmodal.min.css">
<!-- HystModal JS -->
<script src="https://cdn.jsdelivr.net/npm/hystmodal@0.7.7/dist/hystmodal.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        initializeBootstrapTabs();
        initializeHystModal();
        addEventListenersToRows();
    });

    function initializeBootstrapTabs() {
        var tabTriggerList = [].slice.call(document.querySelectorAll('#departmentTabs a'));
        tabTriggerList.forEach(function (tabTriggerEl) {
            var tabTrigger = new bootstrap.Tab(tabTriggerEl);
            tabTrigger.show();
        });
    }

    function initializeHystModal() {
        new HystModal({ linkAttributeName: "data-hystmodal" });
    }

    function openEventDetails(event) {
        updateModalContent(event);
        const modal = document.querySelector('#eventDetailsModal');
        if (modal) {
            modal.open('#eventDetailsModal');
        } else {
            console.error('Modal not found');
        }
    }

    function updateModalContent(event) {
        document.getElementById('modal-title').textContent = event.title;
        document.getElementById('modal-date').textContent = event.date;
        document.getElementById('modal-time').textContent = `${event.start_time} – ${event.end_time}`;
        document.getElementById('modal-venue').textContent = event.venue;
        document.getElementById('modal-mode').textContent = event.mode;
        document.getElementById('modal-description').textContent = event.description;
        document.getElementById('modal-conducted-by').textContent = event.conducted_by;
        document.getElementById('modal-location').textContent = event.location;
        document.getElementById('modal-price').textContent = event.price_type === 'Idle' ? `₹${parseFloat(event.amount).toFixed(2)}` : 'Free';

        // Update button URLs
        document.getElementById('register-button').href = `{{ route('register.page', '') }}/${event.id}`;
        document.getElementById('view-details-button').href = `{{ route('events.show', '') }}/${event.slug}`;
    }

    function addEventListenersToRows() {
        document.querySelectorAll('.row[data-event]').forEach(row => {
            row.addEventListener('click', function () {
                const eventData = JSON.parse(this.dataset.event);
                openEventDetails(eventData);
            });
        });
    }
    </script>


