@include ('user.headers.header')

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
                    <h4 class="mb-0">Book Room {{ $room->room_number }}</h4>
                    <h5>Price: ₱{{ $room->price }}</h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('client.roombook') }}" method="POST">
                        @csrf

                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" id="price_per_day" value="{{ $room->price }}">
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

                             <div class="row mb-3">    
                                                                       <div class="col-md-6" style="position: relative;">
                                                                            <label class="form-label">Check-in Date</label>
                                                                            <input type="text" class="form-control" id="check_in" name="check_in" required>
                                                                            <div id="check_in_datepicker_container" style="position: absolute; top: 0; left: 105%; z-index: 1055;"></div>
                                                                        </div>

                                                                        <div class="col-md-6" style="position: relative;">
                                                                            <label class="form-label">Check-out Date</label>
                                                                            <input type="text" class="form-control" id="check_out" name="check_out" required>
                                                                            <div id="check_out_datepicker_container" style="position: absolute; top: 0; left: 105%; z-index: 1055;"></div>
                                                                        </div>

                                                                        <!-- Check-in Time -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Check-in Time</label>
                                                                            <input type="time" class="form-control" id="check_in_time" name="check_in_time" required>
                                                                        </div>

                                                                        <!-- Check-out Time -->
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Check-out Time</label>
                                                                            <input type="time"class="form-control" id="check_out_time" name="check_out_time" value="14:00" readonly>

                                                                        </div>


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
</div>
<!-- jQuery & jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
$(document).ready(function () {

    const checkIn = $('#check_in');
    const checkOut = $('#check_out');
    const daysOfStay = $('#days_of_stay');
    const totalPayment = $('#total_payment');

    const price = parseFloat(@json($room->price)) || 0;

    function parseDate(val) {
        if (!val) return null;

        const parts = val.split('-');
        if (parts.length !== 3) return null;

        return new Date(parts[0], parts[1] - 1, parts[2]);
    }

    function calculate() {

        const inVal = checkIn.val();
        const outVal = checkOut.val();

        console.log("RAW IN:", inVal);
        console.log("RAW OUT:", outVal);

        const inDate = parseDate(inVal);
        const outDate = parseDate(outVal);

        if (!inDate || !outDate) {
            daysOfStay.val(0);
            totalPayment.val(0);
            return;
        }

        const diffDays = Math.ceil((outDate - inDate) / (1000 * 60 * 60 * 24));

        if (diffDays > 0) {
            daysOfStay.val(diffDays);
            totalPayment.val((diffDays * price).toFixed(2));
        } else {
            daysOfStay.val(0);
            totalPayment.val(0);
        }
    }

    // 🔥 IMPORTANT: listen to BOTH change + input
    checkIn.on('change input', calculate);
    checkOut.on('change input', calculate);

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
    onSelect: function () {
        $(this).trigger("change"); // 🔥 FORCE VALUE UPDATE
    }
});
</script>
@include ('user.headers.footer')