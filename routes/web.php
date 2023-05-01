<?php

use App\Models\Builder\HouseModel;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Traits\MainInfo;

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

Route::get('/', ['App\Http\Controllers\Controller', 'main']);

Route::prefix('profile')->middleware(['auth', 'session'])->group(function () {
  Route::get('/', ['App\Http\Controllers\User\ProfileController', 'index']);

  Route::middleware('CheckSubscription')->group(function () {
    Route::middleware('CheckRealtor')->group(function () {
    Route::get('/addedHouse', ['App\Http\Controllers\House\HouseController', 'createHouse']);
    Route::get('/edit/{house}', ['App\Http\Controllers\House\HouseController', 'edit']);
    Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'showHouse']);
    Route::get('/news', ['App\Http\Controllers\House\NewsController', 'index']);
    Route::get('/news/create', ['App\Http\Controllers\House\NewsController', 'createNews']);
    Route::get('/news/edit/{id}', ['App\Http\Controllers\House\NewsController', 'editNews']);
  });
    Route::get('/help', ['App\Http\Controllers\HelpController', 'getHelp']);
    Route::get('/compilation', ['App\Http\Controllers\User\CompilationController', 'index']);
    Route::get('/favorites', ['App\Http\Controllers\User\FavoriteController', 'index']);
    Route::get('/chat', ['App\Http\Controllers\User\ChatController', 'index']);
    Route::get('/chats', ['App\Http\Controllers\User\ChatController', 'getChats'])->name('chats');
    Route::get('/chat/{id}', ['App\Http\Controllers\User\ChatController', 'getChat']);
  });
});

Route::prefix('/compilation')->group(function () {
  Route::get('/{id}', ['App\Http\Controllers\User\CompilationController', 'show']);
  Route::get('/user/{id}/{house}', ['App\Http\Controllers\User\CompilationController', 'soloHouse']);
  Route::get('/{id}/{house}', ['App\Http\Controllers\User\CompilationController', 'house']);
});

Route::prefix('/house')->group(function () {
  Route::get('/success', ['App\Http\Controllers\AdminController', 'success']);
  Route::get('/failed', ['App\Http\Controllers\AdminController', 'failed']);
});

Route::middleware('auth', 'session', 'CheckSubscription')->group(function () {
  Route::middleware('CheckBuilder')->group(function () {
    Route::get('/houses', ['App\Http\Controllers\House\HouseController', 'index']);
    Route::get('/villages', ['App\Http\Controllers\House\HouseController', 'villages']);
  });
  Route::get('/house/{house}', ['App\Http\Controllers\House\HouseController', 'house']);
});

Route::get('test', ['App\Http\Controllers\House\HouseController', 'waterMark']);

Route::post('/bot/webhook', ['App\Http\Controllers\Bot\QuizController', 'index']);

Route::get('/setBot', function () {
    $token = '6172255563:AAHiCQlABKJMpQRJ6TDAxChK8Do5eTc49lU';

    $http = 'https://api.telegram.org/bot6172255563:AAHiCQlABKJMpQRJ6TDAxChK8Do5eTc49lU/setWebhook?url=https://b2bexchange.cc/bot/webhook';

    $http = Http::post($http);

    dd($http->body());
});

Route::get('/404', function () {
  return Inertia::render('AppError');
});

Route::post('mail', ['App\Http\Controllers\User\IndexController', 'sendRegister'])->name('mail');

Route::get('/privacy', ['App\Http\Controllers\PrivacyController', 'index']);
Route::get('/agree', ['App\Http\Controllers\PrivacyController', 'agree']);

require __DIR__ . '/auth.php';
