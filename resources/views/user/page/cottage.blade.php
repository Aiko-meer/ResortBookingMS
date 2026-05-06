 
 <!-- Room Section Start -->
  <hr>
        <div id="rooms">
            <div class="container">
                <div class="section-header">
                    <h2>Our Cottage</h2>
                    <p>
                        The rooms are designed to provide comfort and relaxation, featuring cozy interiors and essential modern amenities. Each room offers a clean, inviting space where guests can unwind, with options suited for individuals, couples, or groups. With a balance of simplicity and convenience, the accommodations ensure a pleasant and restful stay.
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                         @foreach ($cottages as $room)
                        <div class="row">
                            <div class="col-md-3">
                                <div class="room-img">
                                    <div class="box12">
                                        <img src="{{ asset('storage/' . $room->images->first()->image_path) }}">
                                        <div class="box-content">
                                            <h3 class="title">{{ $room->room_type }}</h3>
                                            <ul class="icon">
                                                <li><a href="{{ route('client.cottage', $room->id) }}" ><i class="fa fa-link"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="room-des">
                                    <h3><a href="#" data-toggle="modal" data-target="#modal-id">{{ $room->room_type }}</a></h3>
                                    <p>{{ $room->description }}</p>
                                    <ul class="room-size">
                                        <li><i class="fa fa-arrow-right"></i>Capacity: {{ $room->capacity_adult }} person</li>
                                    </ul>
                                    <ul class="room-icon">
                                        <li class="icon-1"></li>
                                        <li class="icon-2"></li>
                                        <li class="icon-3"></li>
                                        <li class="icon-4"></li>
                                        <li class="icon-5"></li>
                                        <li class="icon-6"></li>
                                        <li class="icon-7"></li>
                                        <li class="icon-8"></li>
                                        <li class="icon-9"></li>
                                        <li class="icon-10"></li>
                                    </ul>
                                </div>
                            </div>
                           <div class="col-md-3">
                                <div class="room-rate">
                                    <h3>From</h3>

                                    <p>Day: ₱{{ number_format($room->price_day, 2) }}</p>
                                    <p>Overnight: ₱{{ number_format($room->price_ov, 2) }}</p>

                                    <a href="{{ route('client.cottage', $room->id) }}" >
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                    <a href="{{ route('client.cottages') }}">See more..</a>
                </div>
            </div>
        </div>
        <!-- Room Section End -->