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
                                                                    <th>Name</th>
                                                                    <th>User Type</th>
                                                                    <th>Email</th>
                                                                    <th>Addresst</th>
                                                                    <th>Status</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                           
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

            <form action="" method="POST">
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

                        <!-- Permanent Address -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">Permanent Address</label>
                            <textarea name="permanent_address" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
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




                               

                                <div id="styleSelector"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include ('admin.headers.footer')
