<?php

namespace Modules\Library\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LibraryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Group 'web' agar session, cookie, dan CSRF aktif
        Route::middleware('web')->group(__DIR__ . '/../routes/web.php');
    }
}