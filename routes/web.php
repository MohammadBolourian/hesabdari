<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HesabController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YadAvarController;
use App\Models\ExitMoney;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});


Route::get('/dashboard', function () {
    return redirect()->route('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('home.index');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::controller(UserController::class)->middleware(['auth'])->group(function () {
    Route::get('/user/edit/{user}', 'edit')->name('user.edit');
    Route::put('/user/update/{user}', 'update')->name('user.update');
});

Route::controller(HomeController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'index')->name('home.index');
});

//================>category
Route::controller(CategoryController::class)->middleware(['auth'])->group(function () {
    Route::get('/category/{user}', 'index')->name('category.index');
    Route::get('/category/create/{user}', 'create')->name('category.create');
    Route::post('/category/store/{user}', 'store')->name('category.store');
    Route::delete('/category/destroy/{category}', 'destroy')->name('category.destroy');
});
//================>Goal
Route::controller(GoalController::class)->middleware(['auth'])->group(function () {
    Route::get('/goal/{user}', 'index')->name('goal.index');
    Route::get('/goal/create/{user}', 'create')->name('goal.create');
    Route::post('/goal/store/{user}', 'store')->name('goal.store');
    Route::put('/goal/update/{goal}', 'update')->name('goal.update');
});

//================>Riz Hesab
Route::controller(HesabController::class)->middleware(['auth'])->group(function () {
    Route::get('/hesab/{user}', 'index')->name('hesab.index');
    Route::get('/hesab/show/{user}', 'show')->name('hesab.money');
});

//================>yad avar
Route::controller(YadAvarController::class)->middleware(['auth'])->group(function () {
    Route::get('/date/{user}', 'index')->name('date.index');
    Route::get('/date/create/{user}', 'create')->name('date.create');
    Route::post('/date/store/{user}', 'store')->name('date.store');
    Route::get('/date/show/{user}', 'show')->name('date.show');
    Route::delete('/date/destroy/{exitMoney}', 'destroy')->name('date.destroy');
});

//================>Money
Route::controller(MoneyController::class)->middleware(['auth'])->group(function () {
    Route::get('/money/{user}/{category}', 'index')->name('money.index');
    Route::get('/money/create/{user}/{category}', 'create')->name('money.create');
    Route::post('/money/store/{user}/{category}', 'store')->name('money.store');
    Route::get('/money/show/{user}/{category}/{money}', 'show')->name('money.show');
    Route::get('/money/edit/{user}/{category}/{money}', 'edit')->name('money.edit');
    Route::put('/money/update/{money}', 'update')->name('money.update');
    Route::delete('/money/destroy/{money}', 'destroy')->name('money.destroy');
    Route::get('/money/{user}', 'fastRecord')->name('money.fast-record');
    Route::post('/money/fast/{user}', 'fastStore')->name('money.fast-store');
});


//======>test
Route::get('/error', function () {
    return Inertia::render('Error');
});

Route::get('/t', function () {
    return Inertia::render('Test/Index',[
        'x'=>['10','20','15']
    ]);
});

//Route::controller(TestController::class)->middleware(['auth'])->group(function () {
Route::controller(TestController::class)->group(function () {
    Route::get('/test', 'index')->name('test.index');
    Route::get('/test/create', 'create')->name('test.create');
    Route::post('/test/store', 'store')->name('test.store');
    Route::get('/test/edit/{user}', 'edit')->name('test.edit');
    Route::put('/test/update/{user}', 'update')->name('test.update');
    Route::delete('/test/destroy/{user}', 'destroy')->name('test.destroy');
});
