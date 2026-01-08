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
                                                <h5>Cottage Table</h5>
                                                <button class="btn btn-success btn-sm " data-bs-toggle="modal" data-bs-target="#addModal">
                                                    + Add Room
                                                </button>
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
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                         <thead class="thead-light">
                                                                <tr>
                                                                    <th>Room #</th>
                                                                    <th>Room Type</th>
                                                                    <th>Price</th>
                                                                    <th>Status</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($rooms as $room)
                                                                <tr>
                                                                    <td>{{ $room->room_number }}</td>
                                                                    <td>{{ $room->room_type }}</td>
                                                                    <td>₱{{ number_format($room->price, 2) }}</td>
                                                                    <td>
                                                                      @if ($room->status == 0)
                                                                        <span class="badge bg-success">Available</span>
                                                                    @elseif ($room->status == 1)
                                                                        <span class="badge bg-danger">Occupied</span>
                                                                    @elseif ($room->status == 2)
                                                                        <span class="badge bg-warning text-dark">Maintenance</span>
                                                                    @else
                                                                        <span class="badge bg-secondary">Error</span>
                                                                    @endif
                                                                    </td>

                                                                    <td class="text-center">
                                                                        <a href="{{ route('room.view', $room->id) }}" class="btn btn-info btn-sm">View</a>
                                                                        <form action="{{ route('cottage.destroy', $room->id) }}" method="POST" class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this room?')">Delete</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                  

                                    <!-- Page-body end -->
                                </div>
                                  <!-- Add Cottage Modal -->
                                   <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl"> <!-- extra large for landscape -->
                                            <div class="modal-content">

                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="addModalLabel">Add Cottage</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>

                                                <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <!-- Left Column: General Info -->
                                                            <div class="col-lg-6">
                                                                <!-- Room Number -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Cottage #</label>
                                                                    <input type="text" name="room_number" class="form-control" value="{{ $nextRoomNumber }}" readonly>
                                                                </div>

                                                                <!-- Room Type -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Room Type</label>
                                                                    <select id="cottageType" name="room_type" class="form-select" required>
                                                                        <option disabled selected>Select type</option>
                                                                        <option value="Single Room" data-capacity="1">Single Room</option>
                                                                        <option value="Double Room" data-capacity="2">Double Room</option>
                                                                        <option value="Twin Room" data-capacity="2">Twin Room</option>
                                                                        <option value="Twin Room" data-capacity="2">Twin Room</option>
                                                                        <option value="Suite" data-capacity="2-4">Suite</option>
                                                                        <option value="Deluxe Room" data-capacity="2-3">Deluxe Room</option>
                                                                        <option value="Executive Room" data-capacity="1-2">Executive Room</option>
                                                                        <option value="Family Room" data-capacity="3-5">Family Room</option>
                                                                    </select>
                                                                </div>

                                                                 <!-- Description -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Description</label>
                                                                    <textarea name="description" id="" class="form-control" min="0" required></textarea>
                                                                    
                                                                </div>

                                                                <!-- Capacity -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Capacity</label>
                                                                    <input id="capacityInput" type="number" name="capacity_adult" class="form-control" min="0" placeholder="Capacity" required>
                                                                </div>

                                                                <!-- Price -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Price (₱)</label>
                                                                    <input type="number" name="price" class="form-control" min="0" placeholder="e.g. 1500" required>
                                                                </div>
                                                            </div>

                                                            <!-- Right Column: Amenities & Images -->
                                                            <div class="col-lg-6">
                                                                <!-- Amenities -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Amenities</label>
                                                                   <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Single bed" id="amenitySingleBed">
                                                                                <label class="form-check-label" for="amenitySingleBed">Single bed</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Double/Queen bed" id="amenityDoubleBed">
                                                                                <label class="form-check-label" for="amenityDoubleBed">Double/Queen bed</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Desk / chair" id="amenityDesk">
                                                                                <label class="form-check-label" for="amenityDesk">Desk / chair</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Seating area / sofa" id="amenitySofa">
                                                                                <label class="form-check-label" for="amenitySofa">Seating area / sofa</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Free WiFi" id="amenityWifi">
                                                                                <label class="form-check-label" for="amenityWifi">Free WiFi</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Flat-screen TV with cable/satellite" id="amenityTV">
                                                                                <label class="form-check-label" for="amenityTV">Flat-screen TV with cable/satellite</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Telephone" id="amenityTelephone">
                                                                                <label class="form-check-label" for="amenityTelephone">Telephone</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Mini fridge / minibar" id="amenityFridge">
                                                                                <label class="form-check-label" for="amenityFridge">Mini fridge / minibar</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Coffee / tea maker" id="amenityCoffee">
                                                                                <label class="form-check-label" for="amenityCoffee">Coffee / tea maker</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Closet / wardrobe with hangers" id="amenityCloset">
                                                                                <label class="form-check-label" for="amenityCloset">Closet / wardrobe with hangers</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Private bathroom with shower/bathtub, toiletries, towels" id="amenityBathroom">
                                                                                <label class="form-check-label" for="amenityBathroom">Private bathroom with shower/bathtub, toiletries, towels</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Bathrobe and slippers" id="amenityBathrobe">
                                                                                <label class="form-check-label" for="amenityBathrobe">Bathrobe and slippers</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Air conditioning / heating" id="amenityAC">
                                                                                <label class="form-check-label" for="amenityAC">Air conditioning / heating</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Safe" id="amenitySafe">
                                                                                <label class="form-check-label" for="amenitySafe">Safe</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Balcony / terrace" id="amenityBalcony">
                                                                                <label class="form-check-label" for="amenityBalcony">Balcony / terrace</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Jacuzzi / hot tub" id="amenityJacuzzi">
                                                                                <label class="form-check-label" for="amenityJacuzzi">Jacuzzi / hot tub</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Kitchenette / full kitchen" id="amenityKitchen">
                                                                                <label class="form-check-label" for="amenityKitchen">Kitchenette / full kitchen</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Fireplace" id="amenityFireplace">
                                                                                <label class="form-check-label" for="amenityFireplace">Fireplace</label>
                                                                            </div>
                                                                             <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Free Breakfast" id="amenityBreakfast">
                                                                                <label class="form-check-label" for="amenityFireplace">Free Breakfast</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Room Images -->
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Room Images (Max 5)</label>
                                                                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple onchange="previewImages(this, 5)" required>
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

                                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                                 <script>
                                function previewImages(input, max) {
                                    const preview = document.getElementById('imagePreview');
                                    preview.innerHTML = ''; // Clear previous previews

                                    if (input.files.length > max) {
                                        alert(`You can only upload up to ${max} images.`);
                                        input.value = '';
                                        return;
                                    }

                                    // Loop through all selected files
                                    for (let i = 0; i < input.files.length; i++) {
                                        const file = input.files[i];
                                        const reader = new FileReader();

                                        // Closure to capture the current file
                                        reader.onload = function(e) {
                                            const img = document.createElement('img');
                                            img.src = e.target.result;
                                            img.style.width = '80px';
                                            img.style.height = '80px';
                                            img.style.objectFit = 'cover';
                                            img.classList.add('border', 'rounded');
                                            preview.appendChild(img);
                                        }

                                        reader.readAsDataURL(file);
                                    }
                                }
                                </script>
                                <script>
document.getElementById('cottageType').addEventListener('change', function () {
    let capacity = this.options[this.selectedIndex].getAttribute('data-capacity');
    document.getElementById('capacityInput').value = capacity;
});
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
