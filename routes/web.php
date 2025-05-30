<?php
// Import các Controller phục vụ trang quản trị (Admin)
use App\Http\Controllers\BookingTicketController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SystemSettingController;
use App\Http\Controllers\ImageController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminTicketController;

use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth; // Hỗ trợ xác thực đăng nhập/đăng xuất

// Import các Controller phục vụ trang người dùng (Client)
use App\Http\Controllers\Client\CollectionController as ClientCollectionController;
use App\Http\Controllers\Client\ExhibitionController as ClientExhibitionController;
use App\Http\Controllers\Client\PostController as ClientPostController;
use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\UserController as ClientUserController;
use App\Http\Controllers\Client\ShopController as ClientShopController;
use App\Http\Controllers\Client\MuseumTicketController;

// Xác thực người dùng
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Nhóm route dành cho Bộ sưu tập (Collection) của khách hàng
Route::prefix('collection')->group(function () {
  Route::get('/', [ClientCollectionController::class, 'index'])->name('client.collection');
  Route::get('/{id}', [ClientCollectionController::class, 'details'])->name('client.collection.details');
});


//dat ve tham quan bao tàng

Route::middleware('auth')->prefix('museum-ticket')->group(function () {
  Route::get('/', [MuseumTicketController::class, 'create'])->name('client.museum_ticket.create');
  Route::post('/', [MuseumTicketController::class, 'store'])->name('client.museum_ticket.store');
  Route::get('/history', [MuseumTicketController::class, 'history'])->name('client.museum_ticket.history');
});



// Nhóm route dành cho Bộ sưu tập (SHOP) của khách hàng
Route::prefix('shop')->group(function () {
  Route::get('/', [ClientShopController::class, 'index'])->name('client.shop');
  Route::get('/{id}', [ClientShopController::class, 'details'])->name('client.shop.details');
});


// Nhóm route dành cho Bài viết (Post) của khách hàng
Route::prefix('post')->group(function () {
  Route::get('/', [ClientPostController::class, 'index'])->name('client.post');
  Route::get('/{id}', [ClientPostController::class, 'details'])->name('client.post.details')->middleware('auth');

  Route::post('/{id}/view', [ClientPostController::class, 'increaseView'])->name('post.increase.view');
  Route::get('/history/view', [ClientPostController::class, 'history'])->name('client.post.history')->middleware('auth');
});



// Nhóm route dành cho Triển lãm (Exhibition) của khách hàng
Route::prefix('exhibition')->group(function () {
  Route::get('/', [ClientExhibitionController::class, 'index'])->name('client.exhibition');
  Route::get('/{id}', [ClientExhibitionController::class, 'details'])->name('client.exhibition.details');

  Route::get('/booking/{id}', [ClientExhibitionController::class, 'showBooking'])->name('client.exhibition.booking')->middleware('auth');
  Route::post('/booking/{id}', [ClientExhibitionController::class, 'booking'])->name('client.exhibition.booking')->middleware('auth');
  Route::get('/ticket/history', [ClientExhibitionController::class, 'ticketHistory'])->name('client.exhibition.ticket.history')->middleware('auth');
});



// Nhóm route dành cho Giỏ hàng (Cart)
Route::prefix('cart')->group(function () {
  Route::get('/', [ClientCartController::class, 'index'])->name('cart');
  Route::get('/add/{id}', [ClientCartController::class, 'addToCart'])->name('cart.add');
  Route::get('/remove/{id}', [ClientCartController::class, 'removeFromCart'])->name('cart.remove');
});




// Nhóm route dành cho Đơn hàng (Order), yêu cầu đăng nhập
Route::middleware('auth')->prefix('order')->group(function () {
  Route::get('/history', [ClientOrderController::class, 'history'])->name('order.history');
  Route::get('/create', [ClientOrderController::class, 'showBooking'])->name('order.create');
  Route::post('/create', [ClientOrderController::class, 'create'])->name('order.create');
  Route::get('/{id}', [ClientOrderController::class, 'details'])->name('order.details');
});


// Nhóm route dành cho user AccountSetting
Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/setting', [ClientUserController::class, 'setting'])->name('client.user.setting');
    Route::post('/setting', [ClientUserController::class, 'updateSetting'])->name('client.user.setting');
});



// Nhóm route dành cho Quản trị viên (Admin), yêu cầu đăng nhập và quyền admin
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
  // Quản lý bài viết
  Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('admin.post');
    Route::get('/trash', [PostController::class, 'showTrash'])->name('admin.post.trash');

    Route::get('/create', [PostController::class, 'showCreate'])->name('admin.post.create');
    Route::post('/create', [PostController::class, 'store'])->name('admin.post.create');

    Route::get('/edit/{id}', [PostController::class, 'showEdit'])->name('admin.post.edit');
    Route::post('/edit/{id}', [PostController::class, 'update'])->name('admin.post.edit');

    Route::get('/delete/{id}', [PostController::class, 'showDelete'])->name('admin.post.delete');
    Route::post('/delete/{id}', [PostController::class, 'delete'])->name('admin.post.delete');

    Route::get('/restore/{id}', [PostController::class, 'showRestore'])->name('admin.post.restore');
    Route::post('/restore/{id}', [PostController::class, 'restore'])->name('admin.post.restore');
  });


//  Nhóm route quản lý vé (Ticket)
Route::prefix('ticketmuseum')->group(function () {
  Route::get('/', [AdminTicketController::class, 'index'])->name('admin.ticketmuseum');

  Route::get('/{id}/accept', [AdminTicketController::class, 'accept'])->name('admin.ticketmuseum.accept');
  Route::get('/{id}/reject', [AdminTicketController::class, 'reject'])->name('admin.ticketmuseum.reject');
  Route::get('/{id}/paid', [AdminTicketController::class, 'markAsPaid'])->name('admin.ticketmuseum.markAsPaid');
});




  // Quản lý đơn hàng
  Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('admin.order');
    Route::get('/create', [OrderController::class, 'showCreate'])->name('admin.order.create');
    Route::post('/create', [OrderController::class, 'create'])->name('admin.order.create');

    Route::get('/edit/{id}', [OrderController::class, 'showEdit'])->name('admin.order.edit');
    Route::post('/edit/{id}', [OrderController::class, 'edit'])->name('admin.order.edit');

    Route::get('/delete/{id}', [OrderController::class, 'showDelete'])->name('admin.order.delete');
    Route::post('/delete/{id}', [OrderController::class, 'delete'])->name('admin.order.delete');
  });



   // Quản lý người dùng
  Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.user');
    Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/create', [UserController::class, 'createUser'])->name('admin.user.create');

    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/edit/{id}', [UserController::class, 'editUser'])->name('admin.user.edit');

    Route::get('/ban/{id}', [UserController::class, 'ban'])->name('admin.user.ban');
    Route::post('/ban/{id}', [UserController::class, 'banUser'])->name('admin.user.ban');

    Route::get('/unlock/{id}', [UserController::class, 'unBan'])->name('admin.user.unBan');
    Route::post('/unlock/{id}', [UserController::class, 'unBanUser'])->name('admin.user.unBan');
  });



   // Quản lý buổi triển lãm
  Route::prefix('exhibition')->group(function () {
    Route::get('/', [ExhibitionController::class, 'index'])->name('admin.exhibition');
    Route::get('/create', [ExhibitionController::class, 'showCreate'])->name('admin.exhibition.create');
    Route::post('/create', [ExhibitionController::class, 'create'])->name('admin.exhibition.create');

    Route::get('/edit/{id}', [ExhibitionController::class, 'showEdit'])->name('admin.exhibition.edit');
    Route::post('/edit/{id}', [ExhibitionController::class, 'update'])->name('admin.exhibition.edit');

    Route::get('/delete/{id}', [ExhibitionController::class, 'showDelete'])->name('admin.exhibition.delete');
    Route::post('/delete/{id}', [ExhibitionController::class, 'delete'])->name('admin.exhibition.delete');

    Route::get('/trash', [ExhibitionController::class, 'showTrash'])->name('admin.exhibition.trash');

    Route::post('/restore/{id}', [ExhibitionController::class, 'restore'])->name('admin.exhibition.restore');

  });



   // Quản lý vé
  Route::prefix('ticket')->group(function () {
    Route::get('/', [BookingTicketController::class, 'index'])->name('admin.ticket');
    Route::get('/create', [BookingTicketController::class, 'showCreate'])->name('admin.ticket.create');
    Route::post('/create', [BookingTicketController::class, 'create'])->name('admin.ticket.create');

    Route::get('/edit/{id}', [BookingTicketController::class, 'showEdit'])->name('admin.ticket.edit');
    Route::post('/edit/{id}', [BookingTicketController::class, 'update'])->name('admin.ticket.edit');

    Route::get('/delete/{id}', [BookingTicketController::class, 'showDelete'])->name('admin.ticket.delete');
    Route::post('/delete/{id}', [BookingTicketController::class, 'delete'])->name('admin.ticket.delete');
  });


  
   // Quản lý bộ sưu tập
  Route::prefix('collection')->group(function () {
    Route::get('/', [CollectionController::class, 'index'])->name('admin.collection');
    Route::get('/create', [CollectionController::class, 'showCreate'])->name('admin.collection.create');
    Route::post('/create', [CollectionController::class, 'create'])->name('admin.collection.create');

    Route::get('/edit/{id}', [CollectionController::class, 'showEdit'])->name('admin.collection.edit');
    Route::post('/edit/{id}', [CollectionController::class, 'update'])->name('admin.collection.edit');

    Route::get('/delete/{id}', [CollectionController::class, 'showDelete'])->name('admin.collection.delete');
    Route::post('/delete/{id}', [CollectionController::class, 'delete'])->name('admin.collection.delete');
  });


// Quản lý shop
Route::prefix('shop')->group(function () {
  Route::get('/', [ShopController::class, 'index'])->name('admin.shop');
  Route::get('/create', [ShopController::class, 'showCreate'])->name('admin.shop.create');
  Route::post('/create', [ShopController::class, 'create'])->name('admin.shop.create');

  Route::get('/edit/{id}', [ShopController::class, 'showEdit'])->name('admin.shop.edit');
  Route::post('/edit/{id}', [ShopController::class, 'update'])->name('admin.shop.edit');

  Route::get('/delete/{id}', [ShopController::class, 'showDelete'])->name('admin.shop.delete');
  Route::post('/delete/{id}', [ShopController::class, 'delete'])->name('admin.shop.delete');
});




  // Quản lý cấu hình
  Route::prefix('settings')->group(function () {
    Route::get('/', [SystemSettingController::class, 'index'])->name('admin.system_settings');
    Route::post('/', [SystemSettingController::class, 'update'])->name('admin.system_settings.update');
  });




//image
  Route::get('/photo', [ImageController::class, 'index'])->name('admin.photo');
  Route::get('/photo/create', [ImageController::class, 'create'])->name('admin.photo.create');
  Route::post('/photo', [ImageController::class, 'store'])->name('admin.photo.store');
  Route::get('/photo/{id}/edit', [ImageController::class, 'edit'])->name('admin.photo.edit');
  Route::put('/photo/{id}', [ImageController::class, 'update'])->name('admin.photo.update');
  Route::delete('/photo/{id}', [ImageController::class, 'destroy'])->name('admin.photo.delete');
  
});





