<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/tweet/red', [TweetController::class, 'red'])->name('tweet.red');
    // 🔽 追加（検索画面）
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');
    // 🔽 追加（検索処理）
    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');

    Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');

    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');

    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');

    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    Route::resource('tweet', TweetController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
