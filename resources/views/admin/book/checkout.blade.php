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
                                                
                                                    <h5 class="m-0">Room Table</h5>

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
                                                            <th>Check Out Date&Time</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
    $today = \Carbon\Carbon::today()->format('Y-m-d');
@endphp
                                                       @foreach ($rooms as $room)
                                                            @if ($room->status == 2)
                                                                <!-- Table Row -->
                                                               <tr class="{{ \Carbon\Carbon::parse($room->check_out)->isToday() ? 'table-warning' : '' }}">
                                                                    <td>{{ $room->room->room_number }}</td>
                                                                    <td>{{ $room->customer_name }}</td>
                                                                    <td>{{ $room->room->room_type }}</td>
                                                                    @php
                                                                    $checkIn = \Carbon\Carbon::parse($room->check_in);
                                                                @endphp
                                                               {{-- Checkout & Countdown --}}
            <td id="countdownroom-{{ $room->id }}">
                {{ \Carbon\Carbon::parse($room->check_out)->format('F d, Y') }}
                
                @if($room->check_out == $today)
                    <span class="time-remaining">Loading...</span>
                @endif
            </td>


                                                                    <td>
                                                                           @php
                                                                                $today = \Carbon\Carbon::today()->format('Y-m-d');
                                                                            @endphp
                                                                            @if($room->status == 2 && $room->check_out == $today)
                                                                            <span class="badge bg-danger"><i class="bi bi-hourglass-split"></i> For Checkout</span>
                                                                            @else
                                                                            <span class="badge bg-danger"><i class="bi bi-hourglass-split"></i> Occupied</span>
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
                                                                        @endif
                                                                    <button class="btn btn-primary btn-sm checkoutroom-btn" data-room='@json($room)'>Checkout</button>
                                                                    <button class="btn btn-warning btn-sm extend-btn" data-room='@json($room)'>
                                                                            <i class="bi bi-clock-history"></i> Extend
                                                                    </button>

                                                                    <a href="{{ route('room.view', $room->room_id) }}" class="btn btn-info btn-sm view-room-btn">View</a>
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
                                                
                                                    <h5 class="m-0">Cottage Table</h5>

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
                                                            <th>Check Out Date</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>
@php
    $today = \Carbon\Carbon::today()->format('Y-m-d');
@endphp

@foreach ($cottages as $cottage)
    @if ($cottage->status == 2)
        <tr class="{{ \Carbon\Carbon::parse($cottage->check_out)->isToday() ? 'table-warning' : '' }}">
            <td>{{ $cottage->cottage->room_number }}</td>
            <td>{{ $cottage->customer_name }}</td>
            <td>{{ $cottage->cottage->room_type }}</td>
            
            {{-- Checkout & Countdown --}}
            <td id="countdowncottage-{{ $cottage->id }}">
                {{ \Carbon\Carbon::parse($cottage->check_out)->format('F d, Y') }}
                
                @if($cottage->check_out == $today)
                    <span class="time-remaining">Loading...</span>
                @endif
            </td>

            {{-- Status Badge --}}
            <td>
                @if($cottage->status == 2 && $cottage->check_out == $today)
                    <span class="badge bg-danger"><i class="bi bi-hourglass-split"></i> For Checkout</span>
                @else
                    <span class="badge bg-danger"><i class="bi bi-hourglass-split"></i> Occupied</span>
                @endif
            </td>

            {{-- Actions --}}
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

                @elseif ($cottage->status == 1 && \Carbon\Carbon::parse($cottage->check_in)->isToday())
                    <form action="{{ route('book.cottagecheckin', $cottage->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Check in</button>
                    </form>
                @endif
              <button class="btn btn-primary btn-sm checkout-btn" data-cottage='@json($cottage)'>Checkout</button>   
              <button class="btn btn-warning btn-sm cottage-btn" data-cottage='@json($cottage)'>
                                                                            <i class="bi bi-clock-history"></i> Extend
                                                                    </button>                                     
                <a href="{{ route('cottage.view', $cottage->cottage_id) }}" class="btn btn-info btn-sm view-room-btn">View</a>
            </td>
        </tr>
    @endif
@endforeach
</tbody>
                                                </table>
                                            </div>          
                                        </div>
                                    </div>
       
@include ('admin.book.modelscheckout') 






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
