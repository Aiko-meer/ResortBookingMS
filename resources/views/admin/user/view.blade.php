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
                                          <div class="container">
   <div class="row justify-content-center">
    <div class="col-md-10">

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="fa fa-user-edit me-2"></i> Edit User
            </div>
            <div class="card-body">
                <form action="{{ route('useredit.store', $user->id) }}" method="POST" >
                    @csrf
                    @method('PUT')

                    <!-- Profile Image -->
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto"
                             style="width:120px; height:120px; border:2px solid #dee2e6;">
                            <i class="fa fa-user text-secondary" style="font-size:60px;"></i>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <h5 class="mb-3 fw-bold">Personal Information</h5>
                    <hr class="mb-4">

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">First Name</label>
                            <input type="text" name="fname" class="form-control"
                                   value="{{ $user->first_name ?? '' }}" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Middle Initial</label>
                            <input type="text" name="mname" class="form-control"
                                   value="{{ $user->middle_initial ?? '' }}"  placeholder="Optional">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Last Name</label>
                            <input type="text" name="lname" class="form-control"
                                   value="{{ $user->last_name ?? '' }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="contact_number" class="form-control"
                                   value="{{ $user->contact_number ?? '' }}" placeholder="09XXXXXXXXX">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Birthday</label>
                            <input type="date" name="birthday" class="form-control"
                                   value="{{ $user->birthday ?? '' }}">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email"  class="form-control"
                                   placeholder="{{ $user->email ?? '' }}" readonly>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">User Type</label>
                            <select name="user_type" class="form-control" required>
                                <option value="super_admin" {{ $user->user_type == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Verified</option>
                                <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Locked</option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2 mb-5">
                        <a href="{{ route('user.index') }}" class="btn btn-light border">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-1"></i> Update User
                        </button>
                    </div>
                </form>
                <!-- Address -->
                    <h5 class="mt-4 mb-3 fw-bold"><i class="fa fa-map-marker-alt me-2"></i> Address</h5>
                    <div class="p-3 border rounded bg-light d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <p class="mb-1"><strong>Street:</strong> {{ $user->street ?? '—' }}</p>
                            <p class="mb-1"><strong>Barangay:</strong> {{ $user->barangay ?? '—' }}</p>
                            <p class="mb-1"><strong>City / Municipality:</strong> {{ $user->city ?? '—' }}</p>
                            <p class="mb-0"><strong>Province:</strong> {{ $user->province ?? '—' }}</p>
                        </div>

                        <button class="btn btn-outline-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editAddressModal">
                            <i class="fa fa-edit me-1"></i> Edit
                        </button>
                    </div>

                <!-- Send Email Section -->
                <div class="card shadow-sm mt-5">
                    <div class="card-header bg-secondary text-white fw-semibold">
                        <i class="fa fa-envelope me-2"></i> Send Email to User
                    </div>

                    <div class="card-body">
                        <form id="emailForm">
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">To</label>
                                <input type="email" class="form-control bg-light" value="{{ $user->email }}" id="to_email" readonly>
                                <input type="text" id="sender" value=" {{ Auth::user()->email }}" id="sender" hidden>
                                <small class="text-muted">This email will be sent to the user's registered address.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter email subject" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="6" placeholder="Write your message here..." required></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fa fa-paper-plane me-1"></i> Send Email
                                </button>
                            </div>
                        </form>
                        <script>
document.getElementById('emailForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent page reload

    emailjs.send(
        'service_l1csmj8', // Replace with your EmailJS service ID
        'template_z2mb2tl', // Replace with your EmailJS template ID
        {
            to_email: this.to_email.value,
            subject: this.subject.value,
            message: this.message.value,
            sender: this.sender.value
        }
    ).then(function(response) {
        console.log('SUCCESS!', response.status, response.text);
        alert('Email sent successfully!');
        document.getElementById('emailForm').reset();
    }, function(error) {
        console.log('FAILED...', error);
        alert('Failed to send email. Please try again.');
    });
});
</script>

                    </div>
                </div>

            </div> <!-- card-body -->
        </div> <!-- card -->
    </div> <!-- col -->
</div> <!-- row -->

           
                                                <!-- Page-body end -->
                            </div>
                             <!--edit address-->
            <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModal" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{route('editaddress.store', $user->id)}}" method="POST">
                            @csrf
                              @method('PUT')
                            <div class="modal-body">
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
                                     <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Street</label>
                                        <input type="text" name="street" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Address</button>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- Success/Error Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white" id="sessionModalHeader">
                <h5 class="modal-title" id="sessionModalTitle">Success</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="sessionModalBody">
                <!-- Message will go here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    @if(session('success'))
        const successModal = new bootstrap.Modal(document.getElementById('sessionModal'));
        document.getElementById('sessionModalHeader').classList.remove('bg-danger');
        document.getElementById('sessionModalHeader').classList.add('bg-success');
        document.getElementById('sessionModalTitle').innerText = 'Success';
        document.getElementById('sessionModalBody').innerText = "{{ session('success') }}";
        successModal.show();
    @endif

    @if(session('error'))
        const errorModal = new bootstrap.Modal(document.getElementById('sessionModal'));
        document.getElementById('sessionModalHeader').classList.remove('bg-success');
        document.getElementById('sessionModalHeader').classList.add('bg-danger');
        document.getElementById('sessionModalTitle').innerText = 'Error';
        document.getElementById('sessionModalBody').innerText = "{{ session('error') }}";
        errorModal.show();
    @endif
});
</script>

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
<script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
<script>
    (function(){
        emailjs.init("hIV1zdcjFxV44vrqb"); // Replace with your EmailJS Public Key
    })();
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
