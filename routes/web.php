<?php

use App\Http\Controllers\Apelsin\Controller as ApelsinController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\Controller as DashboardController;
use App\Http\Controllers\Dashboard\User\Controller as UserController;
use App\Http\Controllers\Dashboard\Role\Controller as RoleController;
use App\Http\Controllers\Dashboard\Product\Controller as ProductController;
use App\Http\Controllers\Dashboard\Compilation\Controller as CompilationController;
use App\Http\Controllers\Dashboard\Orders\Controller as OrdersController;
use App\Http\Controllers\Dashboard\Brand\Controller as BrandController;
use App\Http\Controllers\Dashboard\Post\Controller as PostController;
use App\Http\Controllers\Dashboard\Slider\Controller as SliderController;
use App\Http\Controllers\Dashboard\Category\Controller as CategoryController;
use App\Http\Controllers\Dashboard\SpecialOffer\Controller as SpecialOfferController;
use App\Http\Controllers\Dashboard\Page\Controller as PageController;
use App\Http\Controllers\Dashboard\Feedback\Controller as FeedbackController;
use App\Http\Controllers\Dashboard\Comment\Controller as CommentController;
use App\Http\Controllers\Dashboard\Billing\Controller as BillingController;
use App\Http\Controllers\Dashboard\Region\Controller as RegionController;
use App\Http\Controllers\Dashboard\City\Controller as CityController;
use App\Http\Controllers\Dashboard\Notification\Controller as NotificationController;
use App\Http\Controllers\Dashboard\Log\Controller as LogController;
use App\Http\Controllers\Dashboard\Setting\Controller as SettingController;
use App\Http\Controllers\Dashboard\Currency\Controller as CurrencyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/sitemap.xml', 'Site\MainPageController@sitemap')->name('sitemap');

// Route::get('/payment/apelsin/{billing}', 'Apelsin\Controller@paymentOrder')->name('merchant.apelsin');
// Route::post('/payment/apelsin', 'Apelsin\Controller@payment');
// Route::any('/payment/{paysys}', function ($paysys) {
//     return (new Goodoneuz\PayUz\PayUz)->driver($paysys)->handle();
// });

// Route::match(['post', 'get'], 'pay/check/{order}', 'Site\CheckoutController@check')->name('pay_check');

Route::any('/pay/{paysys}/{key}/{amount}', function ($paysys, $key, $amount) {
    $billing = App\Models\Billing::find($key);
    $model = Goodoneuz\PayUz\Services\PaymentService::convertKeyToModel($key);
    $url = route('pay_check', $billing->order_id); //request('redirect_url','/');
    $pay_uz = new Goodoneuz\PayUz\PayUz;
    $pay_uz
        ->driver($paysys)
        ->redirect($model, $amount, 860, $url);
})->name('payment.merchant');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Route::group(['prefix' => 'credit/apelsin/handle', 'namespace' => 'Apelsin'], function () {
//     Route::post('confirm', [ApelsinController::class, 'confirm']);
//     Route::post('confirm/status', 'Controller@status');

//     //    Route::post('send/test', 'Controller@test');
//     Route::post('comment', 'Controller@comment');
// });

// Route::get('/testt/{order}', 'Apelsin\Controller@delivered');

Route::middleware(['blocked'])->get('/test', function () {
    return 'This route uses the blocked middleware';
});


Route::middleware([
    'auth:staff',
    // 'blocked'
])
    ->prefix('dashboard')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/count', [DashboardController::class, 'count'])->name('dashboard.count');

        // Route::group(['prefix' => '/dashboard', 'namespace' => 'Dashboard', 'middleware' => ['auth:staff', 'blocked']], function () {
        //      Route::get('/', 'Controller@index')->name('dashboard');
        //      Route::post('/count', 'Controller@count')->name('dashboard.count');
        // });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('dashboard.users');
            Route::get('/import', [UserController::class, 'import']);
            Route::get('/export', [UserController::class, 'export'])->name('dashboard.users.export');
            Route::get('add/hours', [UserController::class, 'addHours'])->name('dashboard.users.add.hours');
            //Route::match(['get', 'post'], 'update/{user}', 'Controller@edit')->name('dashboard.users.update');
        });

        Route::group(['prefix' => 'logs'], function () {
            Route::get('/', [LogController::class, 'index'])->name('dashboard.logs');
        });

        Route::prefix('staffs')->group(function () {
            Route::get('/', [UserController::class, 'getStaffs'])->name('dashboard.staffs');
            Route::match(['get', 'post'], 'store', [UserController::class, 'store'])->name('dashboard.staffs.store');
            Route::match(['get', 'post'], 'update/{staff}', [UserController::class, 'update'])->name('dashboard.staffs.update');
            Route::get('block/{staff}', [UserController::class, 'block'])->name('dashboard.staffs.block');
        });

        // Route::namespace('Notification')->prefix('notifications')->group(function () {
        //     Route::get('/', 'Controller@index')->name('dashboard.notifications');
        //     Route::post('/store', 'Controller@store')->name('dashboard.notifications.store');
        // });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrdersController::class, 'index'])->name('dashboard.orders');
            Route::get('/invoice/{order}', [OrdersController::class, 'invoice_print'])->name('dashboard.invoice_print');
            Route::get('/view/{order}', [OrdersController::class, 'view'])->name('dashboard.orders.view');
            Route::get('/search', [OrdersController::class, 'search'])->name('dashboard.orders.search');
            Route::match(['get', 'post'], '/update/{order}', [OrdersController::class, 'update'])->name('dashboard.orders.edit');

            Route::get('/filter', [OrdersController::class, 'filter'])->name('dashboard.orders.filter');
            Route::get('/archive', [OrdersController::class, 'archive'])->name('dashboard.orders.archive');
            Route::post('/archive', [OrdersController::class, 'mass_archived'])->name('dashboard.orders.mass_archived');

            Route::get('/export', [OrdersController::class, 'export'])->name('dashboard.orders.export');

            Route::get('/products/{product}', [OrdersController::class, 'product']);
            Route::post('/product/search', [OrdersController::class, 'search_update']);
            Route::post('/product/info/{product}', [OrdersController::class, 'product_info']);
            Route::get('/status/{order}/{status}', [OrdersController::class, 'change_status'])->name('dashboard.orders.status');
            Route::post('/status', [OrdersController::class, 'comments'])->name('dashboard.orders.comments_status');
        });

        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('dashboard.brands');
            Route::match(['get', 'post'], '/update/{brand}', [BrandController::class, 'update'])->name('dashboard.brand.update');
            Route::match(['get', 'post'], '/store', [BrandController::class, 'store'])->name('dashboard.brand.store');
            Route::get('/delete/{brand}', [BrandController::class, 'delete'])->name('dashboard.brand.delete');
        });

        // Route::group(['prefix' => 'partners', 'namespace' => 'Partner'], function () {
        //     Route::get('/', 'Controller@index')->name('dashboard.partners');
        //     Route::match(['get', 'post'], '/update/{partner}', 'Controller@update')->name('dashboard.partner.update');
        //     Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.partner.store');
        //     Route::get('/delete/{partner}', 'Controller@delete')->name('dashboard.partner.delete');
        // });

        Route::group(['prefix' => 'posts'], function () {
            Route::get('/{lang}', [PostController::class, 'index'])->name('dashboard.posts');
            Route::match(['get', 'post'], '/update/{lang}/{post}', [PostController::class, 'update'])->name('dashboard.post.update');
            Route::match(['get', 'post'], '/store/{lang}', [PostController::class, 'store'])->name('dashboard.post.store');
            Route::get('/delete/{post}', [PostController::class, 'delete'])->name('dashboard.post.delete');

            Route::post('upload/image', [PostController::class, 'image_upload'])->name('dashboard.posts.image_upload');
        });

        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/', [SliderController::class, 'index'])->name('dashboard.sliders');
            Route::match(['get', 'post'], '/update/{slider}', [SliderController::class, 'update'])->name('dashboard.slider.update');
            Route::match(['get', 'post'], '/store', [SliderController::class, 'store'])->name('dashboard.slider.store');
            Route::get('/delete/{slider}', [SliderController::class, 'delete'])->name('dashboard.slider.delete');
            Route::post('position', [SliderController::class, 'position']);
        });

        Route::group(['prefix' => 'currency'], function () {
            Route::get('/', [CurrencyController::class, 'index'])->name('dashboard.currency');
            Route::match(['get', 'post'], '/store', [CurrencyController::class, 'store'])->name('dashboard.currency.store');
        });

        // Route::group(['prefix' => 'branches', 'namespace' => 'Branch'], function () {
        //     Route::get('/', 'Controller@index')->name('dashboard.branches');
        //     Route::get('/preview/{branch}', 'Controller@show')->name('dashboard.branches.show');
        //     Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.branches.store');
        //     Route::match(['get', 'post'], '/update/{branch}', 'Controller@update')->name('dashboard.branches.update');
        //     Route::get('delete/{branch}', 'Controller@destroy')->name('dashboard.branches.delete');
        // });

        Route::group(['prefix' => 'specialOffers'], function () {
            Route::get('/', [SpecialOfferController::class, 'index'])->name('dashboard.specialOffers');
            Route::get('/preview/{specialOffer}', [SpecialOfferController::class, 'show'])->name('dashboard.specialOffers.show');
            Route::match(['get', 'post'], '/store', [SpecialOfferController::class, 'store'])->name('dashboard.specialOffers.store');
            Route::match(['get', 'post'], '/update/{specialOffer}', [SpecialOfferController::class, 'update'])->name('dashboard.specialOffers.update');
            Route::get('delete/{specialOffer}', [SpecialOfferController::class, 'delete'])->name('dashboard.specialOffers.delete');
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [SettingController::class, 'index'])->name('dashboard.settings');
            Route::post('/update/{setting}', [SettingController::class, 'update'])->name('dashboard.settings.update');
            Route::match(['get', 'post'], '/delivery', [SettingController::class, 'delivery'])->name('dashboard.settings.delivery');
        });

        Route::group(['prefix' => 'compilations'], function () {
            Route::get('/', [CompilationController::class, 'index'])->name('dashboard.compilations');
            Route::match(['get', 'post'], '/store', [CompilationController::class, 'store'])->name('dashboard.compilations.store');
            Route::match(['get', 'post'], '/update/{compilation}', [CompilationController::class, 'update'])->name('dashboard.compilations.update');
            Route::post('/product/search', [CompilationController::class, 'search']);
            Route::get('/delete/{compilation}', [CompilationController::class, 'delete'])->name('dashboard.compilations.delete');
        });

        // Route::group(['prefix' => 'files', 'namespace' => 'File'], function () {
        //     Route::get('/', 'Controller@index')->name('dashboard.files');
        //     Route::post('/store', 'Controller@store')->name('dashboard.file.store');
        //     Route::get('/delete/{file}', 'Controller@delete')->name('dashboard.file.delete');
        // });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('dashboard.products');
            Route::match(['get', 'post'], '/import', [ProductController::class, 'import'])->name('dashboard.products.import');

            Route::get('/export', [ProductController::class, 'export'])->name('dashboard.products.export');

            Route::post('/preview/store', [ProductController::class, 'previewStore'])->name('dashboard.products.preview.store');
            Route::match(['get', 'post'], '/store', [ProductController::class, 'store'])->name('dashboard.product.store');
            Route::match(['get', 'post'], '/update/{product}', [ProductController::class, 'update'])->name('dashboard.product.update');
            Route::get('/delete/{product}', [ProductController::class, 'delete'])->name('dashboard.product.delete');
            Route::post('/delete/screen/{screen}', [ProductController::class, 'delete_screen'])->name('dashboard.product.screen.delete');
            Route::get('/search', [ProductController::class, 'search'])->name('dashboard.product.search');
            Route::get('/characteristics/{id}', [ProductController::class, 'characteristics'])->name('dashboard.product.characteristics');
            Route::post('/mass/action', [ProductController::class, 'massAction'])->name('dashboard.products.mass.action');
        });

        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('dashboard.categories');
            Route::get('/json', [CategoryController::class, 'json']);
            Route::match(['get', 'post'], '/store', [CategoryController::class, 'store'])->name('dashboard.categories.store');
            Route::match(['get', 'post'], '/update/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
            Route::get('/delete/{category}', [CategoryController::class, 'delete'])->name('dashboard.categories.delete');
            Route::post('/position', [CategoryController::class, 'position_save']);
            Route::get('/test', [CategoryController::class, 'test']);
        });

        // Route::group(['prefix' => 'colors', 'namespace' => 'Color'], function () {
        //     Route::get('/', 'Controller@index')->name('dashboard.colors');
        //     Route::match(['get', 'post'], '/store', 'Controller@store')->name('dashboard.colors.store');
        //     Route::match(['get', 'post'], '/update/{color}', 'Controller@update')->name('dashboard.colors.update');
        //     Route::get('/delete/{color}', 'Controller@delete')->name('dashboard.colors.delete');
        // });

        Route::group(['prefix' => 'pages'], function () {
            Route::match(['get', 'post'], '/store', [PageController::class, 'store'])->name('dashboard.pages.store');
            Route::match(['get', 'post'], '/update/{page}', [PageController::class, 'update'])->name('dashboard.pages.update');
            Route::get('/delete/{page}', [PageController::class, 'destroy'])->name('dashboard.pages.destroy');

            Route::post('upload/image', [PageController::class, 'image_upload'])->name('dashboard.pages.image_upload');
        });

        Route::group(['prefix' => 'feedback'], function () {
            Route::get('/', [FeedbackController::class, 'index'])->name('dashboard.feedback.index');
            Route::get('{feedback}', [FeedbackController::class, 'show'])->name('dashboard.feedback.show');
            Route::get('delete/{feedback}', [FeedbackController::class, 'destroy'])->name('dashboard.feedback.delete');
        });

        Route::group(['prefix' => 'comments'], function () {
            Route::get('/', [CommentController::class, 'index'])->name('dashboard.comments');
            Route::get('/view/{comment}', [CommentController::class, 'update'])->name('dashboard.comment.update');
            Route::get('/publish/{comment}', [CommentController::class, 'publish'])->name('dashboard.comment.publish');
            Route::get('/delete/{comment}', [CommentController::class, 'delete'])->name('dashboard.comment.delete');
        });

        Route::group(['prefix' => 'billings'], function () {
            Route::get('/', [BillingController::class, 'index'])->name('billing');
            Route::get('/search', [BillingController::class, 'search'])->name('billing.search');
        });

        Route::group(['prefix' => 'regions'], function () {
            Route::get('/', [RegionController::class, 'index'])->name('dashboard.regions');
            Route::match(['get', 'post'], '/store', [RegionController::class, 'store'])->name('dashboard.region.store');
            Route::match(['get', 'post'], '/update/{region}', [RegionController::class, 'update'])->name('dashboard.region.update');
            Route::get('/delete/{region}', [RegionController::class, 'delete'])->name('dashboard.region.delete');
        });

        Route::group(['prefix' => 'notification'], function () {
            Route::get('/', [NotificationController::class, 'notification_available'])->name('dashboard.notification_available');
            Route::get('/view/{product}', [NotificationController::class, 'notification_available_view'])->name('dashboard.notification_available.view');
        });

        Route::group(['prefix' => 'cities'], function () {
            Route::get('/', [CityController::class, 'index'])->name('dashboard.cities');
            Route::match(['get', 'post'], '/store', [CityController::class, 'store'])->name('dashboard.city.store');
            Route::match(['get', 'post'], '/update/{city}', [CityController::class, 'update'])->name('dashboard.city.update');
            Route::get('/delete/{city}', [CityController::class, 'delete'])->name('dashboard.city.delete');
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('dashboard.roles');
            Route::match(['get', 'post'], '/store', [RoleController::class, 'store'])->name('dashboard.role.store');
            Route::match(['get', 'post'], '/update/{role}', [RoleController::class, 'update'])->name('dashboard.role.update');
            Route::get('/delete/{role}', [RoleController::class, 'delete'])->name('dashboard.role.delete');
        });
    });
