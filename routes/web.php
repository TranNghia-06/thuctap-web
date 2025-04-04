<?php
// Import các Controller phục vụ trang quản trị (Admin)
use App\Http\Controllers\BookingTicketController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

use App\Http\Middleware\IsAdmin;

use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth; // Hỗ trợ xác thực đăng nhập/đăng xuất

// Import các Controller phục vụ trang người dùng (Client)
use App\Http\Controllers\Client\CollectionController as ClientCollectionController;
use App\Http\Controllers\Client\ExhibitionController as ClientExhibitionController;
use App\Http\Controllers\Client\PostController as ClientPostController;
use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;

// Xác thực người dùng
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Nhóm route dành cho Bộ sưu tập (Collection) của khách hàng
Route::prefix('collection')->group(function () {
  Route::get('/', [ClientCollectionController::class, 'index'])->name('client.collection');
  Route::get('/{id}', [ClientCollectionController::class, 'details'])->name('client.collection.details');
});



// Nhóm route dành cho Bài viết (Post) của khách hàng
Route::prefix('post')->group(function () {
  Route::get('/', [ClientPostController::class, 'index'])->name('client.post');
  Route::get('/{id}', [ClientPostController::class, 'details'])->name('client.post.details');

  Route::post('/{id}/view', [ClientPostController::class, 'increaseView'])->name('post.increase.view');
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



  // Quản lý đơn hàng
  Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('admin.order');

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
});

