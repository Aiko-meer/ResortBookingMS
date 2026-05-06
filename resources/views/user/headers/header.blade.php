<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Resort Booking Management System</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        
        <!-- Favicons -->
        <link href="{{ asset  ('assets/user/img/favicon.ico')}}" rel="icon">
        <link href="{{asset  ('assets/user/img/apple-favicon.png')}}" rel="apple-touch-icon">
        

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 

        <!-- Vendor CSS File -->
        <link href="{{asset ('assets/user/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset ('assets/user/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset ('assets/user/vendor/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset ('assets/user/vendor/slick/slick.css')}}" rel="stylesheet">
        <link href="{{asset ('assets/user/vendor/slick/slick-theme.css')}}" rel="stylesheet">
        <link href="{{asset ('assets/user/vendor/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

        <!-- Main Stylesheet File -->
        <link href="{{asset ('assets/user/css/hover-style.css')}}" rel="stylesheet">
        <link href="{{asset ('assets/user/css/style.css')}}" rel="stylesheet">
    </head>

    <body>
        <!-- Header Section Start -->
        <header id="header">
            <a href="index.html" class="logo"><img src="{{asset('assets/img/logo.jpg')}}" alt="logo"></a>
            <div class="phone"><i class="fa fa-phone"></i>09218562626</div>
            <div class="mobile-menu-btn"><i class="fa fa-bars"></i></div>
            <nav class="main-menu top-menu">
                <ul>
                    <li ><a href="{{ route('client') }}">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="{{ route('client.rooms') }}">Rooms</a></li>
                    <li><a href="{{ route('client.cottages') }}">Cottage</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </nav>
        </header>
        <!-- Header Section End -->