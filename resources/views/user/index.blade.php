@include ('user.headers.header')
 @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif       
      
 @include ('user.headers.slider') 
 
 
        <!-- Welcome Section Start -->
        <div id="welcome">
            <div class="container">
                <h3>Welcome to KZ Beach Resort</h3>
                <p>is a relaxing beachfront destination known for its peaceful atmosphere, scenic ocean views, and welcoming ambiance. Located along the coastline, it offers comfortable accommodations, an outdoor pool, and a variety of leisure activities such as snorkeling and kayaking. With its blend of natural beauty and modern amenities, the resort provides guests with a refreshing getaway ideal for both relaxation and adventure.</p>
                
            </div>
        </div>
        <!-- Welcome Section End -->
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                
  @include ('user.page.cottage')
  
   
        
 @include ('user.headers.footer')       