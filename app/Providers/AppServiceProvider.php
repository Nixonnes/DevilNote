<?php

namespace App\Providers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Gate::define('update-note', function(User $user, Note $note) {
            return $user->id === $note->user_id;
        });
    }
}
