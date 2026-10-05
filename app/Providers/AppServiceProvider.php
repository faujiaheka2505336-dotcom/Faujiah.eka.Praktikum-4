<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Nama hari & bulan berbahasa Indonesia: translatedFormat('l, d F Y') => "Sabtu, 26 September 2026"
        Carbon::setLocale('id');
    }
}
