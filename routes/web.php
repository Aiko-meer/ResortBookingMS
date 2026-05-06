<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CottageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CottagecustomerController;
use App\Http\Controllers\RoomcustomerController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;
use Symfony\Component\Routing\Route as RoutingRoute;
Route::get('/', [ClientController::class, 'index'])->name('client.home');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.home')->middleware('auth');

//cottage
Route::get('/cottage', [CottageController::class, 'index'])->name('cottage.index');
Route::post('/cottage/store', [CottageController::class, 'store'])->name('cottage.store');
Route::get('/cottage/view/{id}', [CottageController::class, 'view'])->name('cottage.view');
Route::put('/cottage/update/{id}', [CottageController::class, 'update'])->name('cottage.update');
Route::delete('/cottage/delete/{id}', [CottageController::class, 'destroy'])->name('cottage.destroy');
Route::post('/cottage/cutomer', [CottagecustomerController::class, 'storeBooking'])->name('cottagebooking.store');
Route::post('/cottage/cutomer/checkout/{id}', [CottagecustomerController::class, 'checkout'])->name('cottage.checkout');
Route::post('/cottage/cutomer/extend/{id}', [CottagecustomerController::class, 'extend'])->name('cottage.extend');
Route::post('/cottage/cutomer/addcharges/{id}', [CottagecustomerController::class, 'addCharges'])->name('cottage.addCharges');
Route::post('/cottage/cutomer/accept/{id}', [CottagecustomerController::class, 'accept'])->name('cottagebooking.accept');
Route::delete('/cottage/cutomer/delte/{id}', [CottagecustomerController::class, 'destroy'])->name('cottagebooking.destroy');


//room
Route::get('/room', [RoomController::class, 'index'])->name('room.index');
Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
Route::get('/room/view/{id}', [RoomController::class, 'view'])->name('room.view');
Route::put('/room/update/{id}', [RoomController::class, 'update'])->name('room.update');
Route::delete('/room/delete/{id}', [RoomController::class, 'destroy'])->name('room.destroy');
Route::post('/room/cutomer', [RoomcustomerController::class, 'storeBooking'])->name('roombooking.store');
Route::post('/room/cutomer/checkout/{id}', [RoomcustomerController::class, 'checkout'])->name('room.checkout');
Route::post('/room/cutomer/extend/{id}', [RoomcustomerController::class, 'extend'])->name('room.extend');
Route::post('/room/cutomer/addcharges/{id}', [RoomcustomerController::class, 'addCharges'])->name('room.addCharges');
Route::post('/room/cutomer/accept/{id}', [RoomcustomerController::class, 'accept'])->name('roombooking.accept');
Route::delete('/room/cutomer/delte/{id}', [RoomcustomerController::class, 'destroy'])->name('roombooking.destroy');


//booked list
Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::post('//roomcheckin/{id}', [BookController::class, 'roomcheckin'])->name('book.roomcheckin');
Route::post('/cottagecheckin/{id}', [BookController::class, 'cottagecheckin'])->name('book.cottagecheckin');

//checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/room', [CheckoutController::class, 'checkoutroom'])->name('checkout.room');
Route::post('/checkout/cottage', [CheckoutController::class, 'checkoutcottage'])->name('checkout.cottage');

//users
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'view'])->name('useredit.index');
Route::put('/user/edit/store/{id}', [UserController::class, 'Update'])->name('useredit.store');
Route::put('/user/edit/address/{id}', [UserController::class, 'Address'])->name('editaddress.store');
Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('useredit.destroy');

//apis
Route::get('/api/provinces', [LocationController::class, 'provinces']);
Route::get('/api/cities/{provinceCode}', [LocationController::class, 'cities']);
Route::get('/api/barangays/{cityCode}', [LocationController::class, 'barangays']);

//login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/auth', [LoginController::class, 'login'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//client 
Route::get('/client', [ClientController::class, 'index'])->name('client');
Route::get('/client/roombook/{id}', [ClientController::class, 'room'])->name('client.room');
Route::get('/client/cottagebook/{id}', [ClientController::class, 'cottage'])->name('client.cottage');
Route::post('/client/roombook/reserved/', [ClientController::class, 'roombook'])->name('client.roombook');
Route::post('/client/cottagebook/reserved/', [ClientController::class, 'cottagebook'])->name('client.cottagebook');
Route::get('/client/rooms', [ClientController::class, 'rooms'])->name('client.rooms');
Route::get('/client/cottages', [ClientController::class, 'cottages'])->name('client.cottages');