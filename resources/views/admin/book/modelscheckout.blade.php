<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="" method="POST" action="">
            @csrf
            <input type="hidden" name="cottage_id" id="checkout_cottage_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Cottage Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Customer info -->
                        <div class="col-md-6">
                            <label class="form-label">Customer Name</label>
                            <input type="text" id="checkout_customer_name" class="form-control" readonly>
                            <input type="text" >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cottage Number</label>
                            <input type="text" id="checkout_room_number" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Room Type</label>
                            <input type="text" id="checkout_room_type" class="form-control" readonly>
                        </div>

                        <!-- Check-in / Check-out -->
                        <div class="col-md-6">
                            <label class="form-label">Check-in</label>
                            <input type="text" id="checkout_checkin" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Check-out</label>
                            <input type="text" id="checkout_checkout" class="form-control" readonly>
                        </div>

                        <!-- Hours stayed & Overtime -->
                        <div class="col-md-4">
                            <label class="form-label">Hours Stayed</label>
                            <input type="text" id="checkout_hours_stayed" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Overtime Hours</label>
                            <input type="text" id="checkout_overtime_hours" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Overtime Pay (₱)</label>
                            <input type="text" id="checkout_overtime_pay" class="form-control" readonly>
                        </div>

                        <!-- Payment -->
                        <div class="col-md-6">
                            <label class="form-label">Cash Received (₱)</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="checkout_cash_received" name="cash_received">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Change (₱)</label>
                            <input type="text" class="form-control" id="checkout_change" readonly>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm Checkout</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Checkout room Modal -->
<div class="modal fade" id="checkoutroomModal" tabindex="-1" aria-labelledby="checkoutroomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="" method="POST" action="{{ route('checkout.room') }}">
            @csrf
            <input type="hidden" name="room_id" id="checkout_room_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutroomModalLabel">Room Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Customer info -->
                        <div class="col-md-6">
                            <label class="form-label">Customer Name</label>
                            <input type="text" id="checkoutroom_customer_name" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cottage Number</label>
                            <input type="text" id="checkoutroom_room_number" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Room Type</label>
                            <input type="text" id="checkoutroom_room_type" class="form-control" readonly>
                        </div>

                        <!-- Check-in / Check-out -->
                        <div class="col-md-6">
                            <label class="form-label">Check-in</label>
                            <input type="text" id="checkoutroom_checkin" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Check-out</label>
                            <input type="text" id="checkoutroom_checkout" class="form-control" readonly>
                        </div>

                        <!-- Hours stayed & Overtime -->
                        <div class="col-md-4">
                            <label class="form-label">Hours Stayed</label>
                            <input type="text" id="checkoutroom_hours_stayed" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Overtime Hours</label>
                            <input type="text" id="checkoutroom_overtime_hours" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Overtime Pay (₱)</label>
                            <input type="text" id="checkoutroom_overtime_pay" class="form-control" readonly>
                        </div>

                        <!-- Payment -->
                        <div class="col-md-6">
                            <label class="form-label">Cash Received (₱)</label>
                            <input type="number" min="0" step="0.01" class="form-control" id="checkoutroom_cash_received" name="cash_received">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Change (₱)</label>
                            <input type="text" class="form-control" id="checkoutroom_change" readonly>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm Checkout</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- EXTEND MODAL -->
<div class="modal fade" id="extendModal" tabindex="-1" aria-labelledby="extendModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="extendForm" method="POST" action="">
            @csrf
            <input type="hidden" name="room_id" id="extend_room_id">

            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="extendModalLabel">
                        <i class="bi bi-clock-history"></i> Extend Stay
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- ROOM INFO -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Customer Name</label>
                            <input type="text" id="extend_customer_name" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Room Number</label>
                            <input type="text" id="extend_room_number" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Room Type</label>
                            <input type="text" id="extend_room_type" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- ORIGINAL STAY -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Original Check-out</label>
                            <input type="text" id="extend_original_checkout" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">New Check-out</label>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                            <input type="date" id="extend_new_checkout" name="new_checkout" class="form-control" required>
                        </div>
                    </div>
                </div><!-- END BODY -->

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Confirm Extension
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- EXTEND cottage MODAL -->
<div class="modal fade" id="extendcottageModal" tabindex="-1" aria-labelledby="extendcottageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="extendcottageForm" method="POST" action="">
            @csrf
            <input type="hidden" name="cottage_id" id="extend_cottage_id">

            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="extendModalLabel">
                        <i class="bi bi-clock-history"></i> Extend Stay
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- ROOM INFO -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Customer Name</label>
                            <input type="text" id="extend_customercottage_name" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Room Number</label>
                            <input type="text" id="extend_roomcottage_number" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Room Type</label>
                            <input type="text" id="extend_roomcottage_type" class="form-control" readonly>
                        </div>
                    </div>

                    <!-- ORIGINAL STAY -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Original Check-out</label>
                            <input type="text" id="extend_originalcottage_checkout" class="form-control" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">New Check-out</label>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                            <input type="date" id="extend_new_checkoutcottage" name="check_out_update" class="form-control" required>
                        </div>
                    </div>
                </div><!-- END BODY -->

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Confirm Extension
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>





<!-- js search-->
<script>
document.addEventListener('DOMContentLoaded', function() {
    function setupTableSearch(inputId, tableId) {
        const searchInput = document.getElementById(inputId);
        const table = document.getElementById(tableId);
        const rows = table.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();

            rows.forEach(row => {
                let match = false;
                row.querySelectorAll('td').forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(filter)) {
                        match = true;
                    }
                });

                row.style.display = match ? '' : 'none';
            });
        });
    }

    // Apply to both tables
    setupTableSearch('searchInput1', 'table1');
    setupTableSearch('searchInput2', 'table2');
});
</script>

<!-- checkout cottage modal js -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const overtimeRate = 500;

    // Expose function to global scope
    window.openCheckoutModal = function(cottage) {
        document.getElementById('checkout_cottage_id').value = cottage.id;
        document.getElementById('checkout_customer_name').value = cottage.customer_name;
        document.getElementById('checkout_room_number').value = cottage.cottage.room_number;
        document.getElementById('checkout_room_type').value = cottage.cottage.room_type;
        document.getElementById('checkout_checkin').value = cottage.check_in + ' ' + cottage.check_in_time;
        document.getElementById('checkout_checkout').value = cottage.check_out + ' ' + cottage.check_out_time;

        // Calculate hours stayed
        const checkin = new Date(cottage.check_in + ' ' + cottage.check_in_time);
        const checkout = new Date(cottage.check_out + ' ' + cottage.check_out_time);
        let hoursStayed = (checkout - checkin) / (1000 * 60 * 60);
        hoursStayed = hoursStayed < 0 ? 0 : hoursStayed.toFixed(2);
        document.getElementById('checkout_hours_stayed').value = hoursStayed;

        // Overtime
        const now = new Date();
        let overtimeHours = 0;
        if (now > checkout) {
            overtimeHours = ((now - checkout) / (1000 * 60 * 60)).toFixed(2);
        }
        document.getElementById('checkout_overtime_hours').value = overtimeHours;
        document.getElementById('checkout_overtime_pay').value = (overtimeHours * overtimeRate).toFixed(2);

        document.getElementById('checkout_cash_received').value = '';
        document.getElementById('checkout_change').value = '';

        const modal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        modal.show();
    }

    // Cash input listener
    document.getElementById('checkout_cash_received').addEventListener('input', function() {
        const cash = parseFloat(this.value) || 0;
        const total = parseFloat(document.getElementById('checkout_overtime_pay').value) || 0;
        const change = (cash - total).toFixed(2);
        document.getElementById('checkout_change').value = change >= 0 ? change : '0.00';
    });
});
document.querySelectorAll('.checkout-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const cottage = JSON.parse(this.dataset.cottage);
        openCheckoutModal(cottage);
    });
});
</script>

<!-- checkout room modal js-->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const overtimeRate = 500; // 1 hour = 500

    document.querySelectorAll('.checkoutroom-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const room = JSON.parse(this.dataset.room);

            // Check if room.cottage exists; fallback to room itself
            const roomNumber = room.room ? room.room.room_number : room.room_number;
            const roomType = room.room ? room.room.room_type : room.room_type;

            // Fill modal fields
            document.getElementById('checkout_room_id').value = room.id;
            document.getElementById('checkoutroom_customer_name').value = room.customer_name || '';
            document.getElementById('checkoutroom_room_number').value = room.room.room_number || '';
            document.getElementById('checkoutroom_room_type').value = room.room.room_type || '';
             document.getElementById('checkoutroom_checkin').value = room.check_in + ' ' + room.check_in_time;
            document.getElementById('checkoutroom_checkout').value = room.check_out + ' ' + room.check_out_time;

            // Calculate hours stayed
        const checkinn = new Date(room.check_in + ' ' + room.check_in_time);
        const checkoutt = new Date(room.check_out + ' ' + room.check_out_time);
        let hoursStayeds = (checkoutt - checkinn) / (1000 * 60 * 60);
        hoursStayeds = hoursStayeds < 0 ? 0 : hoursStayeds.toFixed(2);
        document.getElementById('checkoutroom_hours_stayed').value = hoursStayeds;


            // Overtime
        const now = new Date();
        let overtimeHours = 0;
        if (now > checkoutt) {
            overtimeHours = ((now - checkoutt) / (1000 * 60 * 60)).toFixed(2);
        }
        document.getElementById('checkoutroom_overtime_hours').value = overtimeHours;
        document.getElementById('checkoutroom_overtime_pay').value = (overtimeHours * overtimeRate).toFixed(2);

            // Reset cash & change
            document.getElementById('checkoutroom_cash_received').value = '';
            document.getElementById('checkoutroom_change').value = '';

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('checkoutroomModal'));
            modal.show();
        });
    });

    // Calculate change
    document.getElementById('checkoutroom_cash_received').addEventListener('input', function() {
        const cash = parseFloat(this.value) || 0;
        const total = parseFloat(document.getElementById('checkoutroom_overtime_pay').value) || 0;
        const change = (cash - total).toFixed(2);
        document.getElementById('checkoutroom_change').value = change >= 0 ? change : '0.00';
    });
});
</script>

<!-- extend modal js room-->
<script>
// Open Extend Modal
document.querySelectorAll('.extend-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const room = JSON.parse(this.dataset.room);

        document.getElementById('extend_room_id').value = room.id;
        document.getElementById('extend_customer_name').value = room.customer_name;
        document.getElementById('extend_room_number').value = room.room.room_number;
        document.getElementById('extend_room_type').value = room.room.room_type;

        // original checkout
        document.getElementById('extend_original_checkout').value =
            room.check_out + " " + room.check_out_time;
        
        

        // action URL
        document.getElementById('extendForm').action = "/room/extend/" + room.id;

        new bootstrap.Modal(document.getElementById('extendModal')).show();
    });
});
</script>

<!-- extend modal js room-->
<script>
// Open Extend cottage Modal
document.querySelectorAll('.cottage-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const cottage = JSON.parse(this.dataset.cottage);

        document.getElementById('extend_cottage_id').value = cottage.id;
        document.getElementById('extend_customercottage_name').value = cottage.customer_name;
        document.getElementById('extend_roomcottage_number').value = cottage.cottage.room_number;
        document.getElementById('extend_roomcottage_type').value = cottage.cottage.room_type;

        // original checkout
        document.getElementById('extend_originalcottage_checkout').value =
            cottage.check_out + " " + cottage.check_out_time;
        
        

        // action URL
        document.getElementById('extendcottageForm').action = "/cottage/cutomer/extend/" + cottage.id;

        new bootstrap.Modal(document.getElementById('extendcottageModal')).show();
    });
});
</script>


<!--date validation-->
<script>
document.getElementById('extend_new_checkout').addEventListener('change', function () {
    const selected = this.value;

    // ❌ If selected date is unavailable → reset + warning
    if (unavailableDates.includes(selected)) {
        Swal.fire({
            icon: 'error',
            title: 'Unavailable Date',
            text: 'This date is already booked. Please choose another date.',
        });

        this.value = "";
        return;
    }

    // If allowed → continue auto-calculation logic
    const original = new Date(
        document.getElementById('extend_original_checkout').value
    );
    const newCheckout = new Date(this.value);

    if (newCheckout <= original) {
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Extension',
            text: 'New checkout must be later than the current checkout.',
        });

        this.value = "";
        return;
    }

    const diffMs = newCheckout - original;
    const addedHours = Math.ceil(diffMs / (1000 * 60 * 60));

    document.getElementById('extend_added_hours').value = addedHours;

    const rate = parseFloat(document.getElementById('extend_rate').value);
    document.getElementById('extend_total_pay').value = (addedHours * rate).toFixed(2);
});
</script>

<script>
    const unavailableDates = @json($unavailableDates);

    flatpickr("#extend_new_checkout", { 
        dateFormat: "Y-m-d",
        disable: unavailableDates,
        minDate: "today"
    });
</script>

@php
    // Build two arrays of countdown targets (rooms and cottages) with ISO datetimes
    $roomCountdowns = [];
    foreach ($rooms as $r) {
        if ($r->status == 2 && \Carbon\Carbon::parse($r->check_out)->isToday()) {
            // format as ISO 'Y-m-d\TH:i:s' so JS Date parses reliably
            $roomCountdowns[] = [
                'targetId' => "countdownroom-{$r->id}",
                'datetime' => \Carbon\Carbon::parse($r->check_out . ' ' . $r->check_out_time)->format('Y-m-d\TH:i:s'),
            ];
        }
    }

    $cottageCountdowns = [];
    foreach ($cottages as $c) {
        if ($c->status == 2 && \Carbon\Carbon::parse($c->check_out)->isToday()) {
            $cottageCountdowns[] = [
                'targetId' => "countdowncottage-{$c->id}",
                'datetime' => \Carbon\Carbon::parse($c->check_out . ' ' . $c->check_out_time)->format('Y-m-d\TH:i:s'),
            ];
        }
    }
@endphp

<script>
    (function() {
        const overtimeRate = 500; // ₱ per full hour

        // combined targets
        const targets = [
            // rooms
            @foreach($roomCountdowns as $t)
                { id: "{{ $t['targetId'] }}", datetime: "{{ $t['datetime'] }}" },
            @endforeach
            // cottages
            @foreach($cottageCountdowns as $t)
                { id: "{{ $t['targetId'] }}", datetime: "{{ $t['datetime'] }}" },
            @endforeach
        ];

        // Prepare DOM: ensure each target has a .time-remaining span so selector queries succeed
        targets.forEach(t => {
            const container = document.getElementById(t.id);
            if (!container) return;
            // If span.time-remaining doesn't exist, create it (keeps HTML safe)
            if (!container.querySelector('.time-remaining')) {
                const span = document.createElement('span');
                span.className = 'time-remaining';
                span.textContent = 'Loading...';
                container.appendChild(span);
            } else {
                // initial text
                container.querySelector('.time-remaining').textContent = 'Loading...';
            }
            // parse and store epoch
            t.epoch = new Date(t.datetime).getTime();
        });

        // single interval updates all targets
        const tick = function() {
            const now = Date.now();

            targets.forEach(t => {
                if (typeof t.epoch !== 'number' || isNaN(t.epoch)) return;
                const container = document.getElementById(t.id);
                if (!container) return;
                const span = container.querySelector('.time-remaining');
                if (!span) return;

                let diff = t.epoch - now; // ms until checkout (positive = remaining, negative = overtime)
                if (diff > 0) {
                    // time remaining
                    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    // display: if days exist show days, else show h m s
                    if (days > 0) {
                        span.textContent = `${days}d ${hours}h ${minutes}m`;
                    } else {
                        span.textContent = `${hours}h ${minutes}m ${seconds}s remaining`;
                    }
                    span.classList.remove('text-danger','fw-bold');
                } else {
                    // overtime
                    diff = Math.abs(diff);
                    const overtimeHoursFull = Math.floor(diff / (1000 * 60 * 60)); // full hours for pay
                    const overtimeMinutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const overtimeSeconds = Math.floor((diff % (1000 * 60)) / 1000);
                    const overtimePay = overtimeHoursFull * overtimeRate;

                    span.textContent = `Overtime: ${overtimeHoursFull}h ${overtimeMinutes}m ${overtimeSeconds}s - Pay: ₱${overtimePay}`;
                    span.classList.add('text-danger','fw-bold');
                }
            });
        };

        // run immediately and then every second
        tick();
        window.__roomCountdownInterval = setInterval(tick, 1000);

    })();
</script>