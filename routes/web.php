<?php


use App\Http\Controllers\admin\AdminOrderController;
use App\Http\Controllers\admin\indexController;
use App\Http\Controllers\admin\manageToyController;
use App\Http\Controllers\admin\orderPreview;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\ToysCRUD\CRUDcontroller;
use App\Http\Controllers\admin\usersFeedbackController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Stripe\StripeController;
use App\Http\Controllers\user\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\feedbackController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\user\previewOrderController;
use App\Http\Controllers\Stripe\StripeSuccessController;
use App\Http\Controllers\user\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ............user Routes............
Route::get('/', [HomeController::class, 'Home'])->name('home');

// Search Route
Route::get('/search', [HomeController::class, 'home'])->name('search.toys');

// Checkout
Route::get('/checkout/{id}', [CheckoutController::class, 'checkout'])->name('checkout');

// About
Route::get('/about', [AboutController::class, 'About'])->name('about');

// User Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'userDashboard'])->name('user.dashboard');

    // Feedback
    Route::post('/user/feedback', [feedbackController::class, 'postFeedback'])->name('user.feedback');

    // Order Now if user id authenticated
    Route::post('/order/details', [OrderController::class, 'storeOrderDetails'])->name('order.details');

    // Preview User's order
    Route::get('/my/orders/{id}', [previewOrderController::class, 'previewOrder'])->name('preview.order');

    // Cancel the order
    Route::post('/cancel/order/{id}', [OrderController::class, 'cancelOrder'])->name('order.cancel');

    // Authenticated user make the payment
    Route::post('/session/{id}', [StripeController::class, 'session'])->name('stripe.session');

    // Stripe Success Page
    Route::get('payment/success/{id}', [StripeSuccessController::class, 'stripeSuccess'])->name('stripe.success');
});




// .........Admin Routes..............
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [indexController::class, 'adminIndex'])->name('admin.index');
    Route::get('/admin/toyManagement', [manageToyController::class, 'toyManagement'])->name('admin.manageToy');


    // Toy CRUD Routes
    Route::get('addToys', [CRUDcontroller::class, 'toyAddForm'])->name('add.toy');
    Route::post('storeToys', [CRUDcontroller::class, 'store'])->name('toy.store');
    Route::get('editToys/{id}', [CRUDcontroller::class, 'toyEditForm'])->name('edit.toy');
    Route::put('updateToys/{id}', [CRUDcontroller::class, 'update'])->name('update.toy');
    Route::get('previewToys/{id}', [CRUDcontroller::class, 'toyPreview'])->name('preview.toy');
    Route::post('delete-toy/{id}', [CRUDcontroller::class, 'delete'])->name('toy.delete');

    // Feedback
    Route::get('/user/feedbacks', [usersFeedbackController::class, 'usersFeedback'])->name('admin.feedback');

    // Orders
    Route::get('/all/orders', [AdminOrderController::class, 'Orders'])->name('admin.orders');

    // Orders Preview
    Route::get('/order/preview/{id}', [orderPreview::class, 'orderPreview'])->name('order.preview');

    // Delete Order if user cancelled that
    Route::post('/delete/order', [orderPreview::class, 'deleteOrder'])->name('order.delete');

    // Reports tab
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
});

require __DIR__ . '/auth.php';
