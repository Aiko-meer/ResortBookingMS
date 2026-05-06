@include ('user.headers.header')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
 <div class="container my-5">

    <div class="row g-4">

        <!-- ===================== -->
        <!-- ROOM DETAILS SECTION -->
        <!-- ===================== -->
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <!-- Image -->
                <img src="{{ asset('storage/' . $room->images->first()->image_path) }}"
                     class="img-fluid"
                     style="height: 280px; object-fit: cover;">

                <div class="card-body">

                    <h4 class="fw-bold">{{ $room->room_type }}</h4>

                    <p class="text-muted">{{ $room->description }}</p>

                    <hr>

                    <p class="mb-2">
                        <strong>Capacity:</strong> {{ $room->capacity_adult }} person
                    </p>

                    <h6 class="mt-3">Amenities</h6>

                    <ul class="list-unstyled">
                        @foreach(json_decode($room->amenities ?? '[]') as $amenity)
                            <li class="mb-1">
                                <i class="fa fa-check text-success me-2"></i>
                                {{ $amenity }}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

        </div>

        <!-- ===================== -->
        <!-- BOOKING FORM SECTION -->
        <!-- ===================== -->
        <div class="col-lg-7">

            <div class="card shadow-lg border-0 rounded-4">

                <!-- Header -->
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">Book Cottage {{ $room->room_number }}</h4>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('client.cottagebook') }}" method="POST">
                        @csrf

                        <input type="hidden" name="cottage_id" value="{{ $room->id }}">

                        <div class="row g-3">

                            <!-- Name -->
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="customer_name" required>
                            </div>

                            <!-- Contact -->
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="customer_contact" required>
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="customer_address" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="customer_email" required>
                            </div>

                            <div class="col-12 mb-2">
                                 <label class="form-label fw-semibold">Booking Type</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="booking_type" id="overnight" value="overnight" >
                                <label class="form-check-label" for="overnight">Overnight</label>
                            </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="booking_type" id="daytime" value="daytime" checked>
                                    <label class="form-check-label" for="daytime">Daytime</label>
                                </div>
                            </div>  

                            <!-- Check-in -->
                            <div class="col-md-6">
                                <label class="form-label">Check-in Date</label>
                                <input type="text" class="form-control" id="check_in" name="check_in" required>
                                <div id="check_in_datepicker_container" style="position: absolute; top: 0; left: 105%; z-index: 1055;"></div>
                            </div>

                            <!-- Check-out -->
                            <div class="col-md-6">
                                <label class="form-label">Check-out Date</label>
                                <input type="text" class="form-control" id="check_out" name="check_out" required>
                            </div>

                            <!-- Check-in Time -->
                            <div class="col-md-6">
                                <label class="form-label">Check-in Time</label>
                                <input type="time" class="form-control" name="check_in_time" id="check_in_time" required>
                            </div>

                            <!-- Check-out Time -->
                            <div class="col-md-6">
                                <label class="form-label">Check-out Time</label>
                                <input type="time" class="form-control" name="check_out_time" id="check_out_time" readonly>
                            </div>

                             

                            <!-- Days -->
                            <div class="col-md-6">
                                <label class="form-label">Days of Stay</label>
                                <input type="number" class="form-control" id="days_of_stay" name="days_of_stay" readonly>
                            </div>

                            <!-- Total -->
                            <div class="col-md-6">
                                <label class="form-label">Total Payment</label>
                                <input type="number" class="form-control fw-bold" id="total_payment" name="total_payment" readonly>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                Confirm Booking
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>
<!-- jQuery & jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
$(document).ready(function () {

    const checkIn = $('#check_in');
    const checkOut = $('#check_out');
    const checkInTime = $('#check_in_time');
    const checkOutTime = $('#check_out_time');
    const daysOfStay = $('#days_of_stay');
    const totalPayment = $('#total_payment');

    const overnight = $('#overnight');
    const daytime = $('#daytime');

    const priceOvernight = Number(@json($room->price_ov)) || 0;
    const priceDaytime = Number(@json($room->price_day)) || 0;

    function parseDate(val) {
        if (!val) return null;
        const p = val.split('-');
        if (p.length !== 3) return null;
        return new Date(p[0], p[1] - 1, p[2]);
    }

    function calculate() {

        const isDay = daytime.is(':checked');

        let inDate = parseDate(checkIn.val());
        let outDate = parseDate(checkOut.val());

        if (!inDate) return;

        let days = 1;

        if (isDay) {

            days = 1;
            checkOut.val(checkIn.val());
             checkOut.prop('readonly', true);
            checkOutTime.val("15:00");

        } else {
             checkInTime.val("16:00");
             checkInTime.prop('readonly', true);
            checkOutTime.val("10:00");
            checkOut.prop('readonly', false);
            if (!outDate) return;

            days = Math.ceil((outDate - inDate) / (1000 * 60 * 60 * 24));
            if (days < 1) days = 1;
        }

        let price = isDay
            ? priceDaytime
            : priceOvernight * days;

        daysOfStay.val(days);
        totalPayment.val(price.toFixed(2));
    }

    function forceUpdate() {
        setTimeout(calculate, 50); // 🔥 important delay for datepicker
    }

    // =========================
    // FORCE EVENTS (IMPORTANT FIX)
    // =========================

    checkIn.on('change input blur', forceUpdate);
    checkOut.on('change input blur', forceUpdate);

    $('input[name="booking_type"]').on('change', forceUpdate);

    checkInTime.on('change input', forceUpdate);

    // 🔥 detect ANY change (datepicker workaround)
    setInterval(calculate, 500); // safety net

    // initial run
    calculate();

});
</script>

<script>
    // Fetch unavailable dates for this Room
    const unavailableDates = @json($unavailableDates); // Array of yyyy-mm-dd strings from Room_customer

    function disableAndStyleDates(date) {
        const d = date.toISOString().split('T')[0];
        if (unavailableDates.includes(d)) return [false, 'unavailable-date', 'Booked'];
        return [true, '', ''];
    }

    // Initialize datepickers
    $("#check_in, #check_out").datepicker({
        dateFormat: "yy-mm-dd",
        beforeShowDay: disableAndStyleDates,
        minDate: 0,
        showOn: "focus",
        onClose: function(dateText, inst) {
            inst.dpDiv.hide();
        },
        beforeShow: function(input, inst) {
            setTimeout(function() {
                const $input = $(input);
                const offset = $input.offset();
                inst.dpDiv.css({
                    position: 'absolute',
                    top: offset.top,
                    left: offset.left + $input.outerWidth() + -50,
                    zIndex: 1000
                });
            }, 0);
        }
    });

</script>

@include ('user.headers.footer')