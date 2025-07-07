<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GameListController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //rotas pra reviews
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{game}', [ReviewController::class, 'showReviewForm'])->name('reviews.showForm');
    Route::get('/reviews/{game}', [ReviewController::class, 'showReviewForm'])->name('reviews.game');
    Route::get('/dashboard', [ReviewController::class, 'dashboard'])->name('dashboard');
    Route::resource('reviews', ReviewController::class);
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    //rotas pra aba de favoritos
    Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::delete('/favorite/{game_title}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

    // rotas pra gamelist
    Route::post('/gamelist', [GameListController::class, 'store'])->name('gamelist.store');
    Route::delete('/gamelist/{game_title}', [GameListController::class, 'destroy'])->name('gamelist.destroy');
    Route::get('/gamelist', [GameListController::class, 'index'])->name('gamelist.index')->middleware('auth');

    //rotas pra pagina journal
    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');

});
    //admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/urls/{id}/edit', [AdminController::class, 'edit'])->name('urls.edit');
    Route::put('/admin/urls/{id}', [AdminController::class, 'update'])->name('urls.update');
    Route::delete('/admin/urls/{id}', [AdminController::class, 'destroy'])->name('urls.destroy');

    //editar e excluir as historias e criar
    Route::get('/admin/journals/{id}/edit', [JournalController::class, 'edit'])->name('journals.edit');
    Route::put('/admin/journals/{id}', [JournalController::class, 'update'])->name('journals.update');
    Route::delete('/admin/journals/{id}', [JournalController::class, 'destroy'])->name('journals.destroy');
    Route::get('/admin/journals', [JournalController::class, 'index'])->name('journals.index');
    
    Route::get('/admin/journals/create', [JournalController::class, 'create'])->name('journals.create');
    Route::post('/admin/journals', [JournalController::class, 'store'])->name('journals.store');
});

require __DIR__.'/auth.php';
