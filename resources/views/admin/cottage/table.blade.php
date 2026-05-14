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
                                                
                                                    <h5 class="m-0">Cottage Table</h5>

                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                                        + Add Cottage
                                                    </button>
                                                

                                                <form method="GET" action="{{ route('cottage.index') }}" class="mb-3">
                                                    <div class="input-group">
                                                        <input type="text" name="search" class="form-control mt-3"
                                                            placeholder="Search room type or number..." value="{{ request('search') }}">
                                                        <button class="btn btn-primary mt-3" type="submit">Search</button>
                                                    </div>
                                                </form>


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
                                                                    <th>Price Day</th>
                                                                    <th>Price Over Night</th>
                                                                    <th>Status</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($rooms as $room)
                                                                <tr>
                                                                    <td>{{ $room->room_number }}</td>
                                                                    <td>₱{{ number_format($room->price_day, 2) }}</td>
                                                                     <td>₱{{ number_format($room->price_ov, 2) }}</td>

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
                                                                        <a href="{{ route('cottage.view', $room->id) }}" class="btn btn-info btn-sm">View</a>
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

                                                <form action="{{ route('cottage.store') }}" method="POST" enctype="multipart/form-data">
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
                                                                    <label class="form-label fw-semibold">Price (₱) day </label>
                                                                    <input type="number" name="price_day" class="form-control" min="0" placeholder="e.g. 1500" required>
                                                                </div>
                                                                 <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Price (₱) Overnight</label>
                                                                    <input type="number" name="price_ov" class="form-control" min="0" placeholder="e.g. 1500" required>
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
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Electric Fan" id="amenityEF">
                                                                                <label class="form-check-label" for="amenityEF">Electric Fan</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Free WiFi" id="amenityWifi">
                                                                                <label class="form-check-label" for="amenityWifi">Free WiFi</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Chargin Outlet" id="amenityTV">
                                                                                <label class="form-check-label" for="amenityTV">Chargin Outlet</label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" name="amenities[]" value="LED Lights / Ambient Lighting" id="amenityBreakfast">
                                                                                <label class="form-check-label" for="amenityBreakfast">LED Lights / Ambient Lighting</label>
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
