<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Database::class, function ($app) {
            $factory = (new Factory)
    ->withServiceAccount(storage_path('app/firebase_credentials.json'))
    ->withDatabaseUri('https://aobmate-default-rtdb.firebaseio.com'); // Add this line
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}