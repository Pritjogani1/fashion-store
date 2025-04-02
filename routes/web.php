<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SearchController;


// ... existing routes ...

Route::get('/search', [SearchController::class, 'search'])->name('search');

require __DIR__.'/user/user.php';
require __DIR__.'/admin/admin.php';







