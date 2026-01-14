 <nav class="pcoded-navbar">
                      <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                      <div class="pcoded-inner-navbar main-menu">
                          <div class="">
                              <div class="main-menu-header">
                                  <img class="img-80 img-radius" src="{{asset('assets/images/faq_man.png')}}" alt="User-Profile-Image">
                                  <div class="user-details">
                                      <span id="more-details"> {{ Auth::user()->first_name }}<i class="fa fa-caret-down"></i></span>
                                  </div>
                              </div>
        
                              <div class="main-menu-content">
                                  <ul>
                                      <li class="more-details">
                                          <a href="{{route('logout')}}"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                          
                          <div class="pcoded-navigation-label" data-i18n="nav.category.navigation"></div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="">
                                  <a href="{{ route('admin.home') }}" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                            
                          </ul>
                          <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Cottage &amp; Rooms</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li>
                                  <a href="{{route('cottage.index')}}" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fas fa-chair"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Cottage</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li>
                                  <a href="{{route('room.index')}}" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa fa-bed"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Room</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
        
                          </ul>
        
                          <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Book &amp; Checkout</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li>
                                  <a href="{{route('book.index')}}" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-book"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Booked</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                              <li>
                                  <a href="{{route('checkout.index')}}" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-alarm-clock"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Checkout</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li> 
                          </ul>
                          <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Accounts</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li>
                                  <a href="{{route('user.index')}}" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-user"></i><b>FC</b></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Users</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>
        
                         

                      </div>
                  </nav>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentUrl = window.location.href;

    // Highlight sidebar navigation links
    document.querySelectorAll('.pcoded-item a').forEach(link => {
        link.closest('li')?.classList.remove('active');

        // Highlight if current URL starts with link href
        if (currentUrl.startsWith(link.href)) {
            link.closest('li')?.classList.add('active');
        }
    });

    // Highlight "View" buttons
    document.querySelectorAll('a.btn').forEach(button => {
        button.classList.remove('active');
        if (currentUrl === button.href) { // exact match for buttons
            button.classList.add('active');
        }
    });
});
</script>




