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
                                       <div class="container ">

                                                                <!-- Back Button -->
                                                                <a href="{{route('cottage.index')}}" class="btn btn-secondary mb-3">← Back</a>
                                                                 <button class="btn btn-success mb-3 " data-bs-toggle="modal" data-bs-target="#addModal">
                                                                    Update Cottage
                                                                </button>
                                                                <div class="card shadow-sm">
                                                                    <div class="row g-0">

                                                                          <div class="col-md-5">
                                                                                <img src="{{ asset('storage/' . $cottage->images->first()->image_path) }}" 
                                                                                    class="img-fluid rounded-start h-100" 
                                                                                    alt="Room Image" 
                                                                                    style="object-fit: cover;">
                                                                            </div>
                                                                            <!-- Room Info -->
                                                                            <div class="col-md-7">
                                                                                <div class="card-body">
                                                                                    <h3 class="card-title">{{$cottage->room_type}}</h3>

                                                                                    <h4 class="text-primary">₱{{$cottage->price_day}} Day</h4>
                                                                                    <h4 class="text-primary">₱{{$cottage->price_ov}} Overnight</h4>
                                                                                    <p class="text-muted mb-2">
                                                                                        <i class="fa fa-users"></i> Capacity:{{$cottage->capacity_adult}}
                                                                                    </p>

                                                                                    <p class="card-text">
                                                                                        {{$cottage->description}}
                                                                                    </p>

                                                                                    <hr>

                                                                                    <!-- Amenities -->
                                                                                    <h5>Amenities:</h5>
                                                                                        <ul class="list-unstyled">
                                                                                            @foreach(json_decode($cottage->amenities) as $amenity)
                                                                                                <li><i class="fa fa-check text-success"></i> {{ $amenity }}</li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    <hr>

                                                                                <div class="mt-4">

                                                                                        @if($cottage->status == 0)
                                                                                        <!-- Only show if room is available -->
                                                                                          <div class="alert alert-warning">
                                                                                            <p>No customer is currently occupying this cottage.</p>
                                                                                        </div>
                                                                                            <a href="#" class="btn btn-primary btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#bookModal">
                                                                                                Book Now
                                                                                            </a>
                                                                                        @elseif($cottage->status == 1 )
                                                                                            <!-- Occupied Customer Info -->
                                                                                            <div class="card border-danger mb-3 shadow-sm">
                                                                                                @if($cottage->currentCustomer)
                                                                                                    <div class="card-header bg-danger text-white">
                                                                                                        Occupied {{ $cottage->currentCustomer->booking_type }}
                                                                                                    </div>
                                                                                                    <div class="card-body">
                                                                                                        
                                                                                                            <h5 class="card-title">Name: {{ $cottage->currentCustomer->customer_name }}</h5>
                                                                                                            <p class="card-text mb-1"><strong>Address:</strong> {{ $cottage->currentCustomer->customer_address }}</p>
                                                                                                            <p class="card-text mb-1"><strong>Contact:</strong> {{ $cottage->currentCustomer->customer_contact }}</p>
                                                                                                            <p class="card-text mb-1"><strong>Email:</strong> {{ $cottage->currentCustomer->customer_email }}</p>
                                                                                                            <p class="card-text mb-1"><strong>Check-in:</strong> {{ $cottage->currentCustomer->check_in }} {{ \Carbon\Carbon::parse($cottage->currentCustomer->check_in_time)->format('h:i A') }}</p>
                                                                                                            <p class="card-text"><strong>Check-out:</strong> {{ $cottage->currentCustomer->check_out }} {{ \Carbon\Carbon::parse($cottage->currentCustomer->check_out_time)->format('h:i A') }}</p>

                                                                                                            @php
                                                                                                                $otherCharges = json_decode($cottage->currentCustomer->other_charges, true);
                                                                                                            @endphp

                                                                                                           
                                                                                                                <hr>
                                                                                                                <h6>Other Charges:</h6>
                                                                                                                <button class="btn btn-info btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#otherChargesModal{{ $cottage->id }}">
                                                                                                                    Add Other Charges
                                                                                                                </button>

                                                                                                                <ul>
                                                                                                                    @foreach($otherCharges as $charge)
                                                                                                                        <li>{{ $charge['description'] }}: ₱{{ $charge['amount'] }}</li>
                                                                                                                    @endforeach
                                                                                                                </ul>
                                                                                                           
                                                                                                            <hr>
                                                                                                            <h6>Total Payment</h6>
                                                                                                            <h5>₱{{ $cottage->currentCustomer->total_payment }}</h5>

                                                                                                        @else
                                                                                                            <p>No customer is currently occupying this cottage.</p>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Action Buttons -->
                                                                                                <div class="mt-3">
                                                                                                    <!-- Extend Stay Button -->
                                                                                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#extendModal{{ $cottage->id }}">
                                                                                                        Extend Stay
                                                                                                    </button>

                                                                                                    <!-- Checkout Button -->
                                                                                                   <button class="btn btn-primary btn-sm checkout-btn" data-cottage='@json($cottage->currentCustomer)'>Checkout</button>   
                                                                                                     <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bookModal">
                                                                                                Book Now
                                                                                            </a>
                                                                                                </div>
                                                                                                
                                                                                                <!-- EXTEND STAY MODAL -->
                                                                                                <div class="modal fade" id="extendModal{{ $cottage->id }}" tabindex="-1">
                                                                                                    <div class="modal-dialog">
                                                                                                        <form action="{{ route('cottage.extend', $cottage->currentCustomer->id) }}" method="POST">
                                                                                                            @csrf
                                                                                                            <div class="modal-content">

                                                                                                                <div class="modal-header bg-warning">
                                                                                                                    <h5 class="modal-title">Extend Stay</h5>
                                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                                                </div>

                                                                                                                <div class="modal-body">
                                                                                                                    <div class="col-md-6" style="position: relative;">
                                                                                                                        <label class="form-label">Check-Out Date</label>
                                                                                                                        <input type="text" class="form-control" id="check_in" name="check_out_update" required>
                                                                                                                        <div id="check_in_datepicker_container" style="position: absolute; top: 0; left: 105%; z-index: 1055;"></div>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                                                                                </div>

                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                               <!-- Checkout Modal -->
                                                                                                <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                                                                                                    <div class="modal-dialog modal-lg">
                                                                                                        <form id="checkout_form" method="POST" action="{{route('cottage.checkout', $cottage->currentCustomer->cottage_id)}}">
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
                                                        
                                                                                                                        </div>
                                                                                                                        <div class="col-md-6">
                                                                                                                            <label class="form-label">Cottage Number</label>
                                                                                                                            <input type="text" value="{{$cottage->room_number}}" class="form-control" readonly>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-6">
                                                                                                                            <label class="form-label">Room Type</label>
                                                                                                                            <input type="text" value="{{$cottage->room_type}}" class="form-control" readonly>
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
                                                                                                                            <label class="form-label">Days Stayed</label>
                                                                                                                            <input type="text" id="checkout_days_stayed" class="form-control" readonly>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-4">
                                                                                                                            <label class="form-label">Overtime Hours</label>
                                                                                                                            <input type="text" id="checkout_overtime_hours" class="form-control" readonly>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-4">
                                                                                                                            <label class="form-label">Overtime Pay (₱)</label>
                                                                                                                            <input type="text" id="checkout_overtime_pay" class="form-control" readonly>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-4">
                                                                                                                            <label class="form-label">Room Payment (₱)</label>
                                                                                                                            <input type="text" id="room_payment" class="form-control" readonly>
                                                                                                                        </div>

                                                                                                                        <!-- Payment -->
                                                                                                                          <div class="col-md-4">
                                                                                                                            <label class="form-label">Total Payment (₱)</label>
                                                                                                                            <input type="text" id="total_payment" class="form-control" readonly>
                                                                                                                        </div>
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
                                                                                                <!-- Other Charges Modal -->
                                                                                                <div class="modal fade" id="otherChargesModal{{ $cottage->id }}" tabindex="-1">
                                                                                                    <div class="modal-dialog modal-lg">
                                                                                                        <form action="{{ route('cottage.addCharges', $cottage->currentCustomer->id) }}" method="POST">
                                                                                                            @csrf
                                                                                                            <div class="modal-content">

                                                                                                                <div class="modal-header bg-info text-white">
                                                                                                                    <h5 class="modal-title">Add Other Charges</h5>
                                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                                                </div>

                                                                                                                <div class="modal-body">

                                                                                                                    <div id="chargesContainer{{ $cottage->id }}">
                                                                                                                        <div class="row mb-2 charge-group">
                                                                                                                            <div class="col-md-7">
                                                                                                                                <label>Description</label>
                                                                                                                                <input type="text" name="description[]" class="form-control" required>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-3">
                                                                                                                                <label>Amount</label>
                                                                                                                                <input type="number" name="amount[]" class="form-control" required>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-2 d-flex align-items-end">
                                                                                                                                <button type="button" class="btn btn-danger removeChargeBtn">X</button>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                    <button type="button" class="btn btn-secondary btn-sm" id="addChargeBtn{{ $cottage->id }}">
                                                                                                                        + Add Another Charge
                                                                                                                    </button>

                                                                                                                </div>

                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                                                                    <button type="submit" class="btn btn-info">Save Charges</button>
                                                                                                                </div>

                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                              


                                                                                        @else
                                                                                            <!-- Maintenance or other -->
                                                                                            <div class="alert alert-warning">
                                                                                                <p>No customer is currently occupying this cottage.</p>
                                                                                            </div>
                                                                                            <button class="btn btn-secondary btn-lg mt-2" disabled>Book Now</button>
                                                                                        @endif

                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <!-- Gallery Section -->
                                                                <div class="mt-4">
                                                                    <h4>Room Gallery</h4>

                                                                    <div class="row mt-3">
                                                                        @foreach($cottage->images as $image)
                                                                        <div class="col-6 col-md-3 mb-3">       
                                                                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                                                    class="img-fluid rounded" 
                                                                                    alt="Cottage Image">
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                        <div>
                                    </div>
                                  <h3>History Customers {{ $cottage->name }}</h3>

                                            @if($cottage->cottageCustomers->isEmpty())
                                                <p>No customers have booked this cottage yet.</p>
                                            @else
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Customer Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Check-in</th>
                                                            <th>Check-out</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($cottage->cottageCustomers as $index => $customer)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $customer->customer_name }}</td>
                                                                <td>{{ $customer->email }}</td>
                                                                <td>{{ $customer->phone }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($customer->check_in)->format('M d, Y') }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($customer->check_out)->format('M d, Y') }}</td>
                                                                <td>
                                                                    @if($customer->status == '1')
                                                                            <span class="badge bg-primary">
                                                                                <i class="bi bi-calendar-check-fill"></i> Booked
                                                                            </span>
                                                                        @elseif($customer->status == '4')
                                                                            <span class="badge bg-danger">
                                                                                <i class="bi bi-x-circle-fill"></i> Cancelled
                                                                            </span>
                                                                        @elseif($customer->status == '2')
                                                                            <span class="badge bg-warning text-dark">
                                                                                <i class="bi bi-door-closed-fill"></i> Occupied
                                                                            </span>
                                                                        @elseif($customer->status == '3')
                                                                            <span class="badge bg-success">
                                                                                <i class="bi bi-check-circle-fill"></i> Complete
                                                                            </span>
                                                                    @else
                                                                        <span class="badge bg-warning">Pending</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif

                                  <!--modal-->
                                 <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="bookModalLabel">Book Cottage {{ $cottage->room_number }}</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Booking Form -->
                                                    <form action="{{route('cottagebooking.store')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="cottage_id" value="{{ $cottage->id }}">

                                                        <div class="modal-body">

                                                            <div class="row g-3">
                                                                <!-- Customer Name -->
                                                                <div class="col-md-6">
                                                                    <label for="customer_name" class="form-label">Customer Name</label>
                                                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="John Doe" required>
                                                                </div>

                                                                <!-- Customer Contact -->
                                                                <div class="col-md-6">
                                                                    <label for="customer_contact" class="form-label">Contact Number</label>
                                                                    <input type="text" class="form-control" id="customer_contact" name="customer_contact" placeholder="+63 912 345 6789" required>
                                                                </div>

                                                                <!-- Customer Address -->
                                                                <div class="col-md-6">
                                                                    <label for="customer_address" class="form-label">Address</label>
                                                                    <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="123 Street, City" required>
                                                                </div>

                                                                <!-- Customer Email -->
                                                                <div class="col-md-6">
                                                                    <label for="customer_email" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="example@mail.com" required>
                                                                </div>
                                                                
                                                               <div class="row mb-3">
                                                                    <!-- Booking Type -->
                                                                        <div class="col-12 mb-2">
                                                                            <label class="form-label fw-semibold">Booking Type</label>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="booking_type" id="overnight" value="overnight" checked>
                                                                                <label class="form-check-label" for="overnight">Overnight</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="booking_type" id="daytime" value="daytime">
                                                                                <label class="form-check-label" for="daytime">Daytime</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
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
                                                                            <input type="time" class="form-control" id="check_out_time" name="check_out_time" readonly>
                                                                        </div>


                                                                </div>

                                                                 <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Status</label>
                                                                    <select name="room_status" class="form-select">
                                                                        <option value="1">Booked</option>
                                                                        <option value="2">Check In</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Notes -->
                                                                <div class="col-12">
                                                                    <label for="notes" class="form-label">Notes</label>
                                                                    <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Additional requests or notes..."></textarea>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Other Charges</label>

                                                                    <div id="otherChargesContainer">
                                                                        <div class="input-group mb-2">
                                                                            <input type="text" name="other_charges[]" class="form-control" placeholder="Charge description">
                                                                            <input type="number" name="other_amounts[]" class="form-control" placeholder="Amount (₱)" min="0">
                                                                            <button type="button" class="btn btn-danger remove-btn">Remove</button>
                                                                        </div>
                                                                    </div>

                                                                    <button type="button" id="addChargeBtn" class="btn btn-primary mt-2">Add Another Charge</button>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <label for="days_of_stay" class="form-label">Days of Stay</label>
                                                                    <input type="number" class="form-control" id="days_of_stay" name="days_of_stay" readonly>
                                                                </div>

                                                                <!-- Total Payment -->
                                                                <div class="col-12">
                                                                    <label for="total_payment" class="form-label">Total Payment (₱)</label>
                                                                    <input type="number" class="form-control fw-bold" id="total_payment" name="total_payment" readonly>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <!-- Modal Footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                 </div>

                                  <!-- update Cottage Modal -->
                                   <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl"> <!-- extra large for landscape -->
                                            <div class="modal-content">

                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="addModalLabel">Update Cottage</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>

                                               <form action="{{ route('cottage.update', $cottage->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <!-- Left Column: General Info -->
                                                            <div class="col-lg-6">
                                                                <!-- Room Number -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Cottage #</label>
                                                                    <input type="text" name="room_number" class="form-control" value="{{$cottage->room_number}}" readonly>
                                                                </div>

                                                                <!-- Room Type -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Room Type</label>
                                                                    <select id="cottageType" name="room_type" class="form-select" required>
                                                                        <option disabled>Select type</option>

                                                                        <option value="Standard Cottage" data-capacity="4"
                                                                            {{ $cottage->room_type == 'Standard Cottage' ? 'selected' : '' }}>
                                                                            Standard Cottage
                                                                        </option>

                                                                        <option value="Deluxe Cottage" data-capacity="6"
                                                                            {{ $cottage->room_type == 'Deluxe Cottage' ? 'selected' : '' }}>
                                                                            Deluxe Cottage
                                                                        </option>

                                                                        <option value="Family Cottage" data-capacity="10"
                                                                            {{ $cottage->room_type == 'Family Cottage' ? 'selected' : '' }}>
                                                                            Family Cottage
                                                                        </option>

                                                                        <option value="Couple Cottage" data-capacity="2"
                                                                            {{ $cottage->room_type == 'Couple Cottage' ? 'selected' : '' }}>
                                                                            Couple Cottage
                                                                        </option>

                                                                        <option value="Group Cottage" data-capacity="15"
                                                                            {{ $cottage->room_type == 'Group Cottage' ? 'selected' : '' }}>
                                                                            Group Cottage
                                                                        </option>

                                                                        <option value="VIP Cottage" data-capacity="12"
                                                                            {{ $cottage->room_type == 'VIP Cottage' ? 'selected' : '' }}>
                                                                            VIP Cottage
                                                                        </option>

                                                                        <option value="Premium Cottage" data-capacity="8"
                                                                            {{ $cottage->room_type == 'Premium Cottage' ? 'selected' : '' }}>
                                                                            Premium Cottage
                                                                        </option>

                                                                        <option value="Executive Cottage" data-capacity="10"
                                                                            {{ $cottage->room_type == 'Executive Cottage' ? 'selected' : '' }}>
                                                                            Executive Cottage
                                                                        </option>
                                                                    </select>
                                                                </div>


                                                                 <!-- Description -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Description</label>
                                                                    <textarea name="description" id="" class="form-control" min="0" required>{{$cottage->description}}</textarea>
                                                                    
                                                                </div>

                                                                <!-- Capacity -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Capacity</label>
                                                                    <input id="capacityInput" type="number" name="capacity_adult" value="{{$cottage->capacity_adult}}" class="form-control" min="0" placeholder="Capacity" required>
                                                                </div>

                                                                <!-- Price -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Price (₱) day </label>
                                                                    <input type="number" name="price_day" class="form-control" min="0" value="{{$cottage->price_day}}" placeholder="e.g. 1500" required>
                                                                </div>
                                                                 <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Price (₱) Overnight</label>
                                                                    <input type="number" name="price_ov" class="form-control" min="0" value="{{$cottage->price_ov}}" placeholder="e.g. 1500" required>
                                                                </div>
                                                            </div>

                                                            <!-- Right Column: Amenities & Images -->
                                                            <div class="col-lg-6">
                                                                <!-- Amenities -->
                                                               <!-- Amenities -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Amenities</label>
                                                                    <div class="row">

                                                                        <div class="col-md-6">

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Air Conditioned" id="amenityAC"
                                                                                    {{ isset($amenities) && in_array('Air Conditioned', $amenities) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="amenityAC">Air Conditioned</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Electric Fan" id="amenityEF"
                                                                                    {{ isset($amenities) && in_array('Electric Fan', $amenities) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="amenityEF">Electric Fan</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Free WiFi" id="amenityWiFi"
                                                                                    {{ isset($amenities) && in_array('Free WiFi', $amenities) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="amenityWiFi">Free WiFi</label>
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-md-6">

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Charging Outlet" id="amenityCO"
                                                                                    {{ isset($amenities) && in_array('Charging Outlet', $amenities) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="amenityCO">Charging Outlet</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="LED Lights / Ambient Lighting" id="amenityLED"
                                                                                    {{ isset($amenities) && in_array('LED Lights / Ambient Lighting', $amenities) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="amenityLED">LED Lights / Ambient Lighting</label>
                                                                            </div>

                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Private Bathroom" id="amenityPB"
                                                                                    {{ isset($amenities) && in_array('Private Bathroom', $amenities) ? 'checked' : '' }}>
                                                                                <label class="form-check-label" for="amenityPB">Private Bathroom</label>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- Room Images -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Room Images (Max 5)</label>
                                                                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple onchange="previewImages(this, 5)" >
                                                                    <div id="imagePreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                                                                </div>
                                                            </div>

                                                        </div> <!-- row -->
                                                    </div> <!-- modal-body -->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save Cottage</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-body end -->
<!-- jQuery & jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
$(document).ready(function() {
    // Inputs
    const checkIn = $('#check_in');
    const checkOut = $('#check_out');
    const checkInTime = $('#check_in_time');
    const checkOutTime = $('#check_out_time');
    const daysOfStay = $('#days_of_stay');
    const totalPayment = $('#total_payment');

    const overnight = $('#overnight');
    const daytime = $('#daytime');

    // Other charges
    const addChargeBtn = $('#addChargeBtn');
    const otherChargesContainer = $('#otherChargesContainer');

    // Prices from backend
    const priceOvernight = @json($cottage->price_ov);
    const priceDaytime = @json($cottage->price_day);

    // Booking type logic
    function updateCheckOut() {
        const inDateVal = checkIn.val();
        if (!inDateVal) return;

        const inDate = new Date(inDateVal);
        const isDaytime = daytime.is(':checked');

        if (isDaytime) {
            checkOut.val(checkIn.val());          // same day
            checkOutTime.val("15:00");            // 3 PM
            checkOut.prop('readonly', true);
        } else {
            const nextDay = new Date(inDate);
            nextDay.setDate(nextDay.getDate() + 1);
            checkOut.val(nextDay.toISOString().split('T')[0]);
            checkOutTime.val("12:00");            // 12 PM
            checkOut.prop('readonly', false);
        }

        calculateTotal();
    }

    // Total calculation
    function calculateTotal() {
        const inDate = new Date(checkIn.val());
        const outDate = new Date(checkOut.val());
        const isDaytime = daytime.is(':checked');

        if (!isNaN(inDate) && !isNaN(outDate)) {
            const diffDays = isDaytime ? 0 : Math.ceil((outDate - inDate)/(1000*60*60*24));
            let payment = isDaytime ? parseFloat(priceDaytime) : parseFloat(priceOvernight) * diffDays;

            // Add other charges
            otherChargesContainer.find('input[name="other_amounts[]"]').each(function() {
                payment += parseFloat($(this).val() || 0);
            });

            payment = Math.round(payment * 100) / 100;

            daysOfStay.val(diffDays);
            totalPayment.val(payment);
        } else {
            daysOfStay.val(0);
            totalPayment.val(0);
        }
    }

    // Event listeners
    checkIn.on('change', updateCheckOut);
    checkOut.on('change', calculateTotal);
    $(document).on('change', '#overnight, #daytime', updateCheckOut);
    otherChargesContainer.on('input', calculateTotal);

    // Add/remove charges dynamically
    addChargeBtn.on('click', function() {
        const div = $(`
            <div class="input-group mb-2">
                <input type="text" name="other_charges[]" class="form-control" placeholder="Charge description">
                <input type="number" name="other_amounts[]" class="form-control" placeholder="Amount (₱)" min="0">
                <button type="button" class="btn btn-danger remove-btn">Remove</button>
            </div>
        `);
        otherChargesContainer.append(div);
    });

    otherChargesContainer.on('click', '.remove-btn', function() {
        $(this).closest('.input-group').remove();
        calculateTotal();
    });

    // Datepicker
    const unavailableDates = @json($unavailableDates);

    function disableAndStyleDates(date) {
        const d = $.datepicker.formatDate('yy-mm-dd', date);
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
                    left: offset.left + $input.outerWidth() + 5,
                    zIndex: 1055
                });
            }, 0);
        }
    });
    // Initial calculation
    updateCheckOut();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let container = document.querySelector('#chargesContainer{{ $cottage->id }}');
    let addBtn = document.querySelector('#addChargeBtn{{ $cottage->id }}');

    addBtn.addEventListener('click', function () {
        let newField = `
            <div class="row mb-2 charge-group">
                <div class="col-md-7">
                    <label>Description</label>
                    <input type="text" name="description[]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Amount</label>
                    <input type="number" name="amount[]" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger removeChargeBtn">X</button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newField);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeChargeBtn')) {
            e.target.closest('.charge-group').remove();
        }
    });

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
        document.getElementById('room_payment').value = '₱' + cottage.total_payment;
        document.getElementById('checkout_checkin').value = cottage.check_in + ' ' + cottage.check_in_time;
        document.getElementById('checkout_checkout').value = cottage.check_out + ' ' + cottage.check_out_time;

        // Calculate days stayed
const checkin = new Date(cottage.check_in + ' ' + cottage.check_in_time);
const checkout = new Date(cottage.check_out + ' ' + cottage.check_out_time);

let daysStayed = (checkout - checkin) / (1000 * 60 * 60 * 24);

// Round up to whole day
daysStayed = daysStayed <= 0 ? 1 : Math.ceil(daysStayed);

document.getElementById('checkout_days_stayed').value = daysStayed;



        // Overtime
        const now = new Date();
        let overtimeHours = 0;
        if (now > checkout) {
            overtimeHours = ((now - checkout) / (1000 * 60 * 60)).toFixed(2);
        }
        document.getElementById('checkout_overtime_hours').value = overtimeHours;
        document.getElementById('checkout_overtime_pay').value = (overtimeHours * overtimeRate).toFixed(2);

        //sum of payment #
const roompayment = cottage.total_payment;
const overtime = (overtimeHours * overtimeRate);

let total_payment = roompayment + overtime;
document.getElementById('total_payment').value = total_payment;


        document.getElementById('checkout_cash_received').value = '';
        document.getElementById('checkout_change').value = '';

        const modal = new bootstrap.Modal(document.getElementById('checkoutModal'));
        modal.show();
    }

    // Cash input listener
    document.getElementById('checkout_cash_received').addEventListener('input', function() {
        const cash = parseFloat(this.value) || 0;
        const total = parseFloat(document.getElementById('total_payment').value) || 0;
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

// action URL
        document.getElementById('checkout_form').action = "/cottage/cutomer/checkout/" + room.id;
</script>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include ('admin.headers.footer')
