@include ('admin.headers.header')

  <body>
  <!-- Pre-loader start -->
  @include ('admin.headers.preloader')
  <!-- Pre-loader end -->
  <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
         @include ('admin.headers.nav')

          <div class="pcoded-main-container">
              <div class="pcoded-wrapper">

                 @include ('admin.headers.side')

                  <div class="pcoded-content">
                      <!-- Page-header start -->
                      <div class="page-header">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h5 class="m-b-10">Dashboard</h5>
                                          <p class="m-b-0">Welcome Admin</p>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <ul class="breadcrumb-title">
                                          <li class="breadcrumb-item">
                                              <a href="index.html"> <i class="fa fa-home"></i> </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                          <div class="card">
                                            <div class="card-header">
                                                
                                                    <h5 class="m-0">Booked Room Table</h5>

                                               <div class="mb-3">
                                                    <input type="text" id="searchInput1" class="form-control mt-3" placeholder="Search in Table 1...">
                                                </div>



                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                                        <li><i class="fa fa-trash close-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                           
                                            <div style="max-height: 400px; overflow-y: auto;">
                                                <table id="table1" class="table table-striped">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Room #</th>
                                                            <th>Name</th>
                                                            <th>Room Type</th>
                                                            <th>Check in Date</th>
                                                            <th>Check Out Date</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       @foreach ($rooms as $room)
                                                            @if ($room->status == 1 || $room->status == 0)
                                                                <!-- Table Row -->
                                                               <tr class="{{ \Carbon\Carbon::parse($room->check_in)->isToday() ? 'table-warning' : '' }}">
                                                                    <td>{{ $room->room->room_number }}</td>
                                                                    <td>{{ $room->customer_name }}</td>
                                                                    <td>{{ $room->room->room_type }}</td>
                                                                    @php
                                                                    $checkIn = \Carbon\Carbon::parse($room->check_in);
                                                                @endphp
                                                                <td class="
                                                                    {{ $checkIn->isToday() ? 'table-success' : '' }}
                                                                    {{ $checkIn->isSameDay(now()->addDays(2)) ? 'table-warning' : '' }}
                                                                ">
                                                                    {{ \Carbon\Carbon::parse($room->check_in)->format('F d, Y ') }}
                                                                </td>   
                                                                    <td>{{ \Carbon\Carbon::parse($room->check_out)->format('F d, Y ') }}</td>

                                                                    <td>
                                                                        @if ($room->status == 0)
                                                                            <span class="badge bg-secondary"><i class="bi bi-hourglass-split"></i> Pending</span>
                                                                        @elseif ($room->status == 1)
                                                                             @if(\Carbon\Carbon::parse($room->check_in)->isToday())
                                                                            <span class="badge bg-primary"><i class="bi bi-calendar-check-fill"></i> Booked</span>
                                                                            @endif
                                                                             @if(\Carbon\Carbon::parse($room->check_in)->isPast())
                                                                            <span class="badge bg-danger"><i class="bi bi-calendar-check-fill"></i> Failed</span>
                                                                             @endif
                                                                        @endif
                                                                    </td>

                                                                    <td class="text-center">

                                                                        @if ($room->status == 0)
                                                                            <form action="{{ route('roombooking.accept', $room->id) }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-success btn-sm">Accept Book</button>
                                                                            </form>

                                                                            <form action="{{ route('roombooking.destroy', $room->id) }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this booking?')">Delete</button>
                                                                            </form>

                                                                        @elseif ($room->status == 1)
                                                                            @if(\Carbon\Carbon::parse($room->check_in)->isToday())
                                                                                <form action="{{ route('book.roomcheckin', $room->id) }}" method="POST" class="d-inline">
                                                                                    @csrf
                                                                                    <button type="submit" class="btn btn-success btn-sm">Check in</button>
                                                                                </form>
                                                                            @endif
                                                                            @if(\Carbon\Carbon::parse($room->check_in)->isPast())
                                                                             <form action="{{ route('roombooking.destroy', $room->id) }}" method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this booking?')">Delete</button>
                                                                            </form>
                                                                            @endif
                                                                        @endif

                                                                            <button type="button" class="btn btn-info btn-sm view-room-btn" data-customer='@json($room)'>View</button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>                                            
                                        </div>

                                      


                                        <div class="card">
                                            <div class="card-header">
                                                
                                                    <h5 class="m-0">Booked Cottage Table</h5>

                                                <div class="mb-3">
                                                    <input type="text" id="searchInput2" class="form-control mt-3" placeholder="Search in Table 2...">
                                                </div>


                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                                        <li><i class="fa fa-trash close-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                           
                                            <div style="max-height: 400px; overflow-y: auto;">
                                                <table id="table2" class="table table-striped">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Room #</th>
                                                            <th>Name</th>
                                                            <th>Room Type</th>
                                                            <th>Check in Date</th>
                                                            <th>Check Out Date</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($cottages as $cottage)
                                                        @if ($cottage->status == 1 || $cottage->status == 0)
                                                        <tr>
                                                            <td>{{ $cottage->cottage->room_number }}</td>
                                                            <td>{{$cottage->customer_name}}</td>
                                                            <td>{{ $cottage->cottage->room_type}}</td>
                                                            <td>{{ $cottage->check_in }}</td>
                                                            <td>{{ $cottage->check_out }}</td>
                                                             <td>
                                                                @if ($cottage->status == 0)
                                                                    <span class="badge bg-secondary"><i class="bi bi-hourglass-split"></i> Pending</span>
                                                                @elseif ($cottage->status == 1)
                                                                    <span class="badge bg-primary"><i class="bi bi-calendar-check-fill"></i> Booked</span>
                                                                @endif
                                                            </td>
                                                             <td class="text-center">
                                                                @if ($cottage->status == 0)
                                                                    <form action="{{ route('cottagebooking.accept', $cottage->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-success btn-sm">Accept Book</button>
                                                                    </form>

                                                                    <form action="{{ route('cottagebooking.destroy', $cottage->id) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this booking?')">Delete</button>
                                                                    </form>

                                                                @elseif ($cottage->status == 1)
                                                                    @if(\Carbon\Carbon::parse($cottage->check_in)->isToday())
                                                                        <form action="{{ route('book.cottagecheckin', $cottage->id) }}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-success btn-sm">Check in</button>
                                                                        </form>
                                                                    @endif
                                                                @endif

                                                                 <button type="button" class="btn btn-info btn-sm view-cottage-btn" data-cottage='@json($cottage)'>View</button>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>          
                                        </div>
                                    </div>
                                    
       <div class="modal fade" id="roomModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Room Booking Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title" id="roomCustomerName"></h5>
                        <p class="card-text mb-1"><strong>Address:</strong> <span id="roomCustomerAddress"></span></p>
                        <p class="card-text mb-1"><strong>Contact:</strong> <span id="roomCustomerContact"></span></p>
                        <p class="card-text mb-1"><strong>Email:</strong> <span id="roomCustomerEmail"></span></p>
                        <p class="card-text mb-1"><strong>Check-in:</strong> <span id="roomCheckIn"></span></p>
                        <p class="card-text mb-1"><strong>Check-out:</strong> <span id="roomCheckOut"></span></p>

                        <div id="roomOtherChargesContainer" class="mt-3" style="display:none;">
                            <hr>
                            <h6>Other Charges</h6>
                            <ul id="roomOtherChargesList"></ul>
                        </div>

                        <hr>
                        <h6>Total Payment</h6>
                        <h5 id="roomTotalPayment" class="text-success fw-bold"></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cottageModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Cottage Booking Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title" id="cottageCustomerName"></h5>
                        <p class="card-text mb-1"><strong>Address:</strong> <span id="cottageCustomerAddress"></span></p>
                        <p class="card-text mb-1"><strong>Contact:</strong> <span id="cottageCustomerContact"></span></p>
                        <p class="card-text mb-1"><strong>Email:</strong> <span id="cottageCustomerEmail"></span></p>
                         <p class="card-text mb-1"><strong>Book Type:</strong> <span id="booktype"></span></p>
                          <p class="card-text mb-1"><strong>Days:</strong> <span id="days"></span></p>
                        <p class="card-text mb-1"><strong>Check-in:</strong> <span id="cottageCheckIn"></span></p>
                        <p class="card-text mb-1"><strong>Check-out:</strong> <span id="cottageCheckOut"></span></p>

                        <div id="cottageOtherChargesContainer" class="mt-3" style="display:none;">
                            <hr>
                            <h6>Other Charges</h6>
                            <ul id="cottageOtherChargesList"></ul>
                        </div>

                        <hr>
                        <h6>Total Payment</h6>
                        <h5 id="cottageTotalPayment" class="text-success fw-bold"></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const viewRoomButtons = document.querySelectorAll('.view-room-btn');

    viewRoomButtons.forEach(button => {
        button.addEventListener('click', function () {
            const customer = JSON.parse(this.getAttribute('data-customer'));

            document.getElementById('roomCustomerName').textContent = customer.customer_name || 'N/A';
            document.getElementById('roomCustomerAddress').textContent = customer.customer_address || 'N/A';
            document.getElementById('roomCustomerContact').textContent = customer.customer_contact || 'N/A';
            document.getElementById('roomCustomerEmail').textContent = customer.customer_email || 'N/A';

            const checkInTime = customer.check_in_time ? new Date('1970-01-01T' + customer.check_in_time).toLocaleTimeString([], { hour: '2-digit', minute:'2-digit', hour12: true }) : '';
            const checkOutTime = customer.check_out_time ? new Date('1970-01-01T' + customer.check_out_time).toLocaleTimeString([], { hour: '2-digit', minute:'2-digit', hour12: true }) : '';

            document.getElementById('roomCheckIn').textContent = (customer.check_in || 'N/A') + ' ' + checkInTime;
            document.getElementById('roomCheckOut').textContent = (customer.check_out || 'N/A') + ' ' + checkOutTime;

            const otherChargesList = document.getElementById('roomOtherChargesList');
            const otherChargesContainer = document.getElementById('roomOtherChargesContainer');
            otherChargesList.innerHTML = '';

            if (customer.other_charges) {
                try {
                    const charges = JSON.parse(customer.other_charges);
                    if (charges.length > 0) {
                        otherChargesContainer.style.display = 'block';
                        charges.forEach(charge => {
                            const li = document.createElement('li');
                            li.textContent = `${charge.description}: ₱${charge.amount}`;
                            otherChargesList.appendChild(li);
                        });
                    } else {
                        otherChargesContainer.style.display = 'none';
                    }
                } catch (error) {
                    otherChargesContainer.style.display = 'none';
                }
            } else {
                otherChargesContainer.style.display = 'none';
            }

            document.getElementById('roomTotalPayment').textContent = '₱' + (customer.total_payment || 0);

            const modal = new bootstrap.Modal(document.getElementById('roomModal'));
            modal.show();
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const viewCottageButtons = document.querySelectorAll('.view-cottage-btn');

    viewCottageButtons.forEach(button => {
        button.addEventListener('click', function () {
            const cottage = JSON.parse(this.getAttribute('data-cottage'));

            // Basic info
            document.getElementById('cottageCustomerName').textContent = cottage.customer_name || 'N/A';
            document.getElementById('cottageCustomerAddress').textContent = cottage.customer_address || 'N/A';
            document.getElementById('cottageCustomerContact').textContent = cottage.customer_contact || 'N/A';
            document.getElementById('cottageCustomerEmail').textContent = cottage.customer_email || 'N/A';
             document.getElementById('booktype').textContent = cottage.booking_type || 'N/A';
             document.getElementById('days').textContent = cottage.days_of_stay || 'N/A';

            // Check-in / Check-out times
            const checkInTime = cottage.check_in_time ? new Date('1970-01-01T' + cottage.check_in_time).toLocaleTimeString([], { hour: '2-digit', minute:'2-digit', hour12: true }) : '';
            const checkOutTime = cottage.check_out_time ? new Date('1970-01-01T' + cottage.check_out_time).toLocaleTimeString([], { hour: '2-digit', minute:'2-digit', hour12: true }) : '';

            document.getElementById('cottageCheckIn').textContent = (cottage.check_in || 'N/A') + ' ' + checkInTime;
            document.getElementById('cottageCheckOut').textContent = (cottage.check_out || 'N/A') + ' ' + checkOutTime;

            // Other charges
            const otherChargesList = document.getElementById('cottageOtherChargesList');
            const otherChargesContainer = document.getElementById('cottageOtherChargesContainer');
            otherChargesList.innerHTML = '';

            if (cottage.other_charges) {
                try {
                    const charges = JSON.parse(cottage.other_charges);
                    if (charges.length > 0) {
                        otherChargesContainer.style.display = 'block';
                        charges.forEach(charge => {
                            const li = document.createElement('li');
                            li.textContent = `${charge.description}: ₱${charge.amount}`;
                            otherChargesList.appendChild(li);
                        });
                    } else {
                        otherChargesContainer.style.display = 'none';
                    }
                } catch (error) {
                    otherChargesContainer.style.display = 'none';
                }
            } else {
                otherChargesContainer.style.display = 'none';
            }

            // Total payment
            document.getElementById('cottageTotalPayment').textContent = '₱' + (cottage.total_payment || 0);

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('cottageModal'));
            modal.show();
        });
    });
});
</script>

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


                                  

                                    <!-- Page-body end -->
                                </div>
                               

                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include ('admin.headers.footer')
