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
                                                
                                                    <h5 class="m-0">User Table</h5>

                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                                        + Add User
                                                    </button>
                                                

                                                <form method="GET" action="{{ route('user.index') }}" class="mb-3">
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
                                                                    <th>Name</th>
                                                                    <th>User Type</th>
                                                                    <th>Email</th>
                                                                    <th>Addresst</th>
                                                                    <th>Status</th>
                                                                    <th>Verification</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->first_name }} {{ $user->middle_initial ? $user->middle_initial.'. ' : '' }}{{ $user->last_name }} {{ $user->extension ?? '' }}</td>
            <td>{{ ucfirst($user->user_type) }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->street ?? '' }}, {{ $user->barangay ?? '' }}, {{ $user->city ?? '' }}, {{ $user->province ?? '' }}</td>
            <td>
                @if($user->status==1)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
               @if($user->user_type == 'super_admin')
                    <span class="badge bg-info">Super Admin</span>
                @elseif($user->user_type == 'admin')
                    <span class="badge bg-primary">Admin</span>
                @elseif($user->user_type == 'user')
                    @if($user->status == 0)
                        <span class="badge bg-secondary">Pending</span>
                    @else
                        <span class="badge bg-success">Verified</span>
                    @endif
                @endif
            </td>
            <td class="text-center">
                <!-- Edit Button -->
                <a href="{{ route('useredit.index', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <!-- Delete Button -->
                <form action="{{ route('useredit.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{route('user.store')}}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">

                        <!-- First Name -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>

                        <!-- Middle Initial -->
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-semibold">M.I.</label>
                            <input type="text" name="middle_initial" class="form-control" maxlength="1">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>

                        <!-- Extension -->
                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-semibold">Extension</label>
                            <input type="text" name="extension" class="form-control" placeholder="Jr, Sr, III">
                        </div>

                        <!-- Contact Number -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- Birthday -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Birthday</label>
                            <input type="date" name="birthday" class="form-control" required>
                        </div>

                        <!-- User Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">User Type</label>
                            <select name="user_type" class="form-select" required>
                                <option disabled selected>Select user type</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="super_admin">Super Admin</option>
                            </select>
                        </div>

                        <!-- Address Information -->
                        <div class="col-md-12 mb-2">
                            <label class="form-label fw-semibold">Street / House No.</label>
                            <input type="text" name="street" class="form-control" required>
                        </div>

                        <div class="row">
    <div class="col-md-4 mb-2">
        <label class="form-label fw-semibold">Province</label>
        <select id="province" name="province" class="form-control" required>
            <option value="">Select Province</option>
        </select>
    </div>

    <div class="col-md-4 mb-2">
        <label class="form-label fw-semibold">City / Municipality</label>
        <select id="city" name="city" class="form-control" required disabled>
            <option value="">Select City</option>
        </select>
    </div>

    <div class="col-md-4 mb-2">
        <label class="form-label fw-semibold">Barangay</label>
        <select id="barangay" name="barangay" class="form-control" required disabled>
            <option value="">Select Barangay</option>
        </select>
    </div>
</div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" required>
                        </div>

                        <div class="row">
    <!-- Password -->
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
        <small class="text-muted">Password must have:</small>
        <ul id="passwordRules" class="text-muted" style="list-style: none; padding-left: 0;">
            <li id="ruleLength">• At least 8 characters</li>
            <li id="ruleUpper">• 1 uppercase letter</li>
            <li id="ruleNumber">• 1 number</li>
            <li id="ruleSpecial">• 1 special character (@$!%*#?&)</li>
        </ul>
    </div>

    <!-- Confirm Password -->
    <div class="col-md-6 mb-3">
        <label class="form-label fw-semibold">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        <div id="confirmError" class="text-danger mt-1"></div>
    </div>
</div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>

            </form>

        </div>
    </div>
</div>
     
<script>
const provinceSelect = document.getElementById('province');
const citySelect = document.getElementById('city');
const barangaySelect = document.getElementById('barangay');

// 1️⃣ Load provinces
fetch('/api/provinces')
.then(res => res.json())
.then(data => {
    data.forEach(province => {
        // value = name (for saving), data-code = code (for API)
        provinceSelect.innerHTML += `
            <option value="${province.name}" data-code="${province.code}">
                ${province.name}
            </option>`;
    });
})
.catch(err => console.error('Error loading provinces:', err));


// 2️⃣ When province changes → load cities
provinceSelect.addEventListener('change', () => {
    const provinceName = provinceSelect.value; // value is now the name
    citySelect.innerHTML = '<option value="">Select City</option>';
    citySelect.disabled = false;
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    barangaySelect.disabled = true;

    if (!provinceName) return;

    // You still need province code to fetch cities from API
    // So find the code from selected option
    const selectedOption = provinceSelect.selectedOptions[0];
    const provinceCode = selectedOption.dataset.code; // optional if you keep code in dataset

    fetch(`/api/cities/${provinceCode}`)
    .then(res => res.json())
    .then(data => {
       data.forEach(city => {
    citySelect.innerHTML += `
        <option value="${city.name}" data-code="${city.code}">
            ${city.name}
        </option>`;
});
    })
    .catch(err => console.error('Error loading cities:', err));
});

// 3️⃣ When city changes → load barangays
citySelect.addEventListener('change', () => {
    const cityName = citySelect.value; // value is now the name
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    barangaySelect.disabled = false;

    if (!cityName) return;

    // Use city code to fetch barangays
    const selectedCityOption = citySelect.selectedOptions[0];
    const cityCode = selectedCityOption.dataset.code; // optional if you keep code in dataset

    fetch(`/api/barangays/${cityCode}`)
    .then(res => res.json())
    .then(data => {
       data.forEach(brgy => {
    barangaySelect.innerHTML += `
        <option value="${brgy.name}" data-code="${brgy.code}">
            ${brgy.name}
        </option>`;
});

    })
    .catch(err => console.error('Error loading barangays:', err));
});
</script>

<script>
const password = document.getElementById('password');
const confirmPassword = document.getElementById('password_confirmation');
const confirmError = document.getElementById('confirmError');

// Password rule elements
const ruleLength = document.getElementById('ruleLength');
const ruleUpper = document.getElementById('ruleUpper');
const ruleNumber = document.getElementById('ruleNumber');
const ruleSpecial = document.getElementById('ruleSpecial');

password.addEventListener('input', () => {
    const value = password.value;

    // Length check
    if (value.length >= 8) ruleLength.style.color = 'green';
    else ruleLength.style.color = 'red';

    // Uppercase check
    if (/[A-Z]/.test(value)) ruleUpper.style.color = 'green';
    else ruleUpper.style.color = 'red';

    // Number check
    if (/\d/.test(value)) ruleNumber.style.color = 'green';
    else ruleNumber.style.color = 'red';

    // Special character check
    if (/[@$!%*#?&]/.test(value)) ruleSpecial.style.color = 'green';
    else ruleSpecial.style.color = 'red';
});

// Confirm password live check
confirmPassword.addEventListener('input', () => {
    if (confirmPassword.value === password.value) {
        confirmError.textContent = '';
    } else {
        confirmError.textContent = 'Passwords do not match.';
    }
});
</script>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include ('admin.headers.footer')
